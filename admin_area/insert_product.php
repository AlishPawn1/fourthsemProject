<?php 
include('../include/connect_database.php');

if(isset($_POST['insert_product'])) {
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $select_tags = $_POST['select_tags'];
    $select_categories = $_POST['select_categories'];
    $product_price = $_POST['product_price'];
    $product_in_store = $_POST['product_in_store'];
    $product_status = 'true';

    $product_image_1 = $_FILES['product_image_1']['name'];
    $product_image_2 = $_FILES['product_image_2']['name'];
    $product_image_1_temp = $_FILES['product_image_1']['tmp_name'];
    $product_image_2_temp = $_FILES['product_image_2']['tmp_name'];

    move_uploaded_file($product_image_1_temp, "./product_images/$product_image_1");
    move_uploaded_file($product_image_2_temp, "./product_images/$product_image_2");

    $sql = "INSERT INTO `products`(`product_name`, `product_description`, `tag_id`, `category_id`, `product_image_1`, `product_image_2`, `product_price`, `product_in_store`, `date`, `status`) VALUES ('$product_name', '$product_description', '$select_tags', '$select_categories', '$product_image_1', '$product_image_2', '$product_price', '$product_in_store', NOW(), '$product_status')";
    
    $res = mysqli_query($conn, $sql);
    if(!$res){
        echo "Error: " . mysqli_error($conn) . "<br>";
    } else {
        echo "<script>alert('Product inserted successfully');</script>";
    }
}
?>

<div class="insert_product w-50 m-auto pt-5">
    <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
        <div class="form-group">
            <label for="product_name">Product name <span class="required">*</span></label>
            <input type="text" id="product_name" required name="product_name" class="form-control"/>
            <small id="product_name_error" class="text-danger"></small>
        </div>
        <div class="form-group">
            <label for="product_description">Product description <span class="required">*</span></label>
            <input type="text" id="product_description" required name="product_description" class="form-control"/>
            <small id="product_description_error" class="text-danger"></small>
        </div>
        <div class="form-group">
            <label for="tags">Tags</label>
            <select name="select_tags" class="form-control">
                <option value="">Select tags</option>
                <?php
                $sql = "SELECT * FROM `tags`";
                $res = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($res)) {
                    echo "<option value='" . $row['id'] . "'>" . $row['tag_name'] . "</option>";
                }
                ?>
            </select>
            <small id="select_tags_error" class="text-danger"></small>
        </div>
        <div class="form-group">
            <label for="categories">Categories</label>
            <select name="select_categories" class="form-control">
                <option value="">Select categories</option>
                <?php
                $sql = "SELECT * FROM `categories`";
                $res = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($res)) {
                    echo "<option value='" . $row['id'] . "'>" . $row['category_name'] . "</option>";
                }
                ?>
            </select>
            <small id="select_categories_error" class="text-danger"></small>
        </div>
        <div class="form-group">
            <label for="product_price">Product price <span class="required">*</span></label>
            <input type="text" id="product_price" required name="product_price" class="form-control"/>
            <small id="product_price_error" class="text-danger"></small>
        </div>
        <div class="form-group">
            <label for="product_image_1">Product image 1 <span class="required">*</span></label>
            <input type="file" name="product_image_1" required class="form-control">
            <small id="product_image_1_error" class="text-danger"></small>
        </div>
        <div class="form-group">
            <label for="product_image_2">Product image 2 <span class="required">*</span></label>
            <input type="file" name="product_image_2" required class="form-control">
            <small id="product_image_2_error" class="text-danger"></small>
        </div>
        <div class="form-group">
            <label for="product_in_store">Product quantity in store <span class="required">*</span></label>
            <input type="number" id="product_in_store" required name="product_in_store" class="form-control"/>
            <small id="product_in_store_error" class="text-danger"></small>
        </div>

        <input type="submit" class="btn btn-primary" name="insert_product" value="Insert Product">
    </form>
</div> 

<script>
function validateForm() {
    var isValid = true;

    var productName = document.getElementById('product_name').value;
    var productDescription = document.getElementById('product_description').value;
    var productPrice = document.getElementById('product_price').value;
    var productInStore = document.getElementById('product_in_store').value;

    var letters = /^[A-Za-z\s]+$/;
    var pricePattern = /^[0-9]+(\.[0-9]{1,2})?$/;
    var quantityPattern = /^[1-9]\d*$/;

    // Product Name Validation
    var productNameError = document.getElementById('product_name_error');
    if (!productName.match(letters)) {
        productNameError.textContent = "Product name can only contain letters and spaces";
        isValid = false;
    } else {
        var wordCount = productName.trim().split(/\s+/).length;
        if (wordCount < 3) {
            productNameError.textContent = "Product name must be at least 3 words long";
            isValid = false;
        } else {
            productNameError.textContent = "";
        }
    }

    // Product Description Validation
    var productDescriptionError = document.getElementById('product_description_error');
    if (!productDescription.match(letters)) {
        productDescriptionError.textContent = "Product description can only contain letters and spaces";
        isValid = false;
    } else if (productDescription.length < 10 || productDescription.length > 200) {
        productDescriptionError.textContent = "Product description must be between 10 and 200 characters long";
        isValid = false;
    } else {
        productDescriptionError.textContent = "";
    }

    // Product Price Validation
    var productPriceError = document.getElementById('product_price_error');
    if (!productPrice.match(pricePattern)) {
        productPriceError.textContent = "Product price must be a positive number";
        isValid = false;
    } else {
        productPriceError.textContent = "";
    }

    // Product Quantity Validation
    var productInStoreError = document.getElementById('product_in_store_error');
    if (!productInStore.match(quantityPattern)) {
        productInStoreError.textContent = "Product quantity in store must be a positive integer";
        isValid = false;
    } else {
        productInStoreError.textContent = "";
    }

    return isValid;
}

// Add event listeners for real-time validation
document.getElementById('product_name').addEventListener('input', function() {
    var productName = document.getElementById('product_name').value;
    var productNameError = document.getElementById('product_name_error');
    var letters = /^[A-Za-z\s]+$/;

    if (!productName.match(letters)) {
        productNameError.textContent = "Product name can only contain letters and spaces";
    } else {
        var wordCount = productName.trim().split(/\s+/).length;
        if (wordCount < 3) {
            productNameError.textContent = "Product name must be at least 3 words long";
        } else {
            productNameError.textContent = "";
        }
    }
});

document.getElementById('product_description').addEventListener('input', function() {
    var productDescription = document.getElementById('product_description').value;
    var productDescriptionError = document.getElementById('product_description_error');
    var letters = /^[A-Za-z\s]+$/;

    if (!productDescription.match(letters)) {
        productDescriptionError.textContent = "Product description can only contain letters and spaces";
    } else if (productDescription.length < 10 || productDescription.length > 200) {
        productDescriptionError.textContent = "Product description must be between 10 and 200 characters long";
    } else {
        productDescriptionError.textContent = "";
    }
});

document.getElementById('product_price').addEventListener('input', function() {
    var productPrice = document.getElementById('product_price').value;
    var productPriceError = document.getElementById('product_price_error');
    var pricePattern = /^[0-9]+(\.[0-9]{1,2})?$/;

    if (!productPrice.match(pricePattern)) {
        productPriceError.textContent = "Product price must be a positive number";
    } else {
        productPriceError.textContent = "";
    }
});

document.getElementById('product_in_store').addEventListener('input', function() {
    var productInStore = document.getElementById('product_in_store').value;
    var productInStoreError = document.getElementById('product_in_store_error');
    var quantityPattern = /^[1-9]\d*$/;

    if (!productInStore.match(quantityPattern)) {
        productInStoreError.textContent = "Product quantity in store must be a positive integer";
    } else {
        productInStoreError.textContent = "";
    }
});
</script>
