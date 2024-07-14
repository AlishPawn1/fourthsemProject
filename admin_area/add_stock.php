<?php

if (isset($_GET['add_stock'])) {
    $select_query = "SELECT * FROM products";
    $result = mysqli_query($conn, $select_query);
}

?>

<section class="add-stock section-gaps">
    <div class="container">
        <div class="title text-center">
            <h1 class="heading">Add stock</h1>
        </div>
        <div class="product_list">
            <table class="table text-center table-bordered mt-5">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Product Image</th>
                        <th>Stock Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                        $product_name = $row['product_name'];
                        $product_image_1 = $row['product_image_1'];
                        $product_in_store = $row['product_in_store'];
                        $product_id = $row['id'];
                        echo "
                        <tr>
                            <td>$product_name</td>
                            <td><img src='./product_images/$product_image_1' height='80' width='80'></td>
                            <td>$product_in_store</td>
                            <td>
                                <a href='index.php?add_stock_edit=$product_id' class='btn btn-danger'>Edit</a>
                            </td>
                        </tr>
                        ";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>