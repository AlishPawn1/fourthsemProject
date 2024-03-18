<?php
if(isset($_GET['edit_product'])){
    $edit_id  = $_GET['edit_product'];

    $get_data = "SELECT * FROM `products` WHERE id='$edit_id'";
    $result_data = mysqli_query($conn, $get_data);
    $row=mysqli_fetch_assoc($result_data);
    $product_name = $row['product_name'];
    $product_description = $row['product_description'];
    $tag_id  = $row['tag_id'];
    $category_id  = $row['category_id'];
    $product_image_1 = $row['product_image_1'];
    $product_image_2 = $row['product_image_2'];
    $product_price = $row['product_price'];
}

?>

<section class="edit-product w-50 m-auto">
    <div class="container">
        <div class="title text-center">
            <h1 class="heading">Edit Product</h1>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="product_name">Product name <span class="required">*</span></label>
                <input type="text" id="product_name" required name="product_name" class="form-control" value="<?php echo $product_name; ?>">
            </div>
            <div class="form-group">
                <label for="product_description">Product description <span class="required">*</span></label>
                <input type="text" id="product_description" required name="product_description" class="form-control" value="<?php echo $product_description; ?>">
            </div>
            <div class="form-group">
                <label for="select_tags">Tags</label>
                <select name="select_tags" id="select_tags" class="form-control">
                    <option value="">Select tags</option>
                    <?php
                    $sql = "SELECT * FROM `tags`";
                    $res = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($res)) {
                        echo "<option value='" . $row['id'] . "'";
                        if ($row['id'] == $tag_id) {
                            echo " selected";
                        }
                        echo ">" . $row['tag_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="select_categories">Categories</label>
                <select name="select_categories" id="select_categories" class="form-control">
                    <option value="">Select categories</option>
                    <?php
                    $sql = "SELECT * FROM `categories`";
                    $res = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($res)) {
                        echo "<option value='" . $row['id'] . "'";
                        if ($row['id'] == $category_id) {
                            echo " selected";
                        }
                        echo ">" . $row['category_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="product_price">Product price <span class="required">*</span></label>
                <input type="text" id="product_price" required name="product_price" class="form-control" value="<?php echo $product_price; ?>">
            </div>
            <div class="form-group">
                <label for="product_image_1">Product image 1 <span class="required">*</span></label>
                <div class="d-flex">
                    <input type="file" name="product_image_1" required id="product_image_1" class="form-control">
                    <img class="product-image" src="./product_images/<?php echo $product_image_1; ?>" alt="">
                </div>
            </div>
            <div class="form-group">
                <label for="product_image_2">Product image 2 <span class="required">*</span></label>
                <div class="d-flex">
                    <input type="file" name="product_image_2" required id="product_image_2" class="form-control">
                    <img class="product-image" src="./product_images/<?php echo $product_image_2; ?>" alt="">
                </div>
            </div>

            <input type="submit" class="btn btn-primary" name="update_product" value="Update Product">
        </form>
    </div>
</section>
