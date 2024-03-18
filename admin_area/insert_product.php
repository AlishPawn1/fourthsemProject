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
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="product_name">Product name <span class="required">*</span></label>
            <input type="text" id="product_name" required name="product_name" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="product_description">Product description <span class="required">*</span></label>
            <input type="text" id="product_description" required name="product_description" class="form-control"/>
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
        </div>
        <div class="form-group">
            <label for="product_price">Product price <span class="required">*</span></label>
            <input type="text" id="product_price" required name="product_price" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="product_image_1">Product image 1 <span class="required">*</span></label>
            <input type="file" name="product_image_1"  required class="form-control">
        </div>
        <div class="form-group">
            <label for="product_image_2">product image 2<span class="required">*</span></label>
            <input type="file" name="product_image_2" required class="form-control">
        </div>
        <div class="form-group">
            <label for="product_in_store">Product quantity in store <span class="required">*</span></label>
            <input type="number" id="product_in_store" required name="product_in_store" class="form-control"/>
        </div>

        <input type="submit" class="btn btn-primary" name="insert_product" value="insert product">
    </form>
</div>