<?php
include("../include/connect_database.php");

$get_product = "SELECT * FROM `products`";
$result = mysqli_query($conn, $get_product);
$number = 1; // Initialize the number counter

?>

<section class="">
    <div class="container">
        <div class="title text-center">
            <h1 class="heading">View Products</h1>
        </div>
        <table class="table table-bordered mt-5">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Title</th>
                    <th>Product Image</th>
                    <th>Product Price</th>
                    <th>Total Sold</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>Quantity Left</th>
                </tr>
            </thead>
            <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                $product_id = $row['id'];
                $product_title = $row['product_name'];
                $product_image = $row['product_image_1'];
                $product_price = $row['product_price'];
                $status = $row['status'];
                $product_in_store = $row['product_in_store'];

                // Query to get the count of pending orders for this product
                $get_count = "SELECT COALESCE(SUM(quantity), 0) AS total_orders FROM `order_pending` WHERE product_id = $product_id"; // Using COALESCE to handle NULL values
                $result_count = mysqli_query($conn, $get_count);
                if ($result_count) {
                    $row_count = mysqli_fetch_assoc($result_count); // Fetching the row as an associative array
                    $total_orders = $row_count['total_orders']; // Get the total number of pending orders
                } else {
                    // Handle query error
                    $total_orders = 0;
                    echo "Error fetching total orders for product ID: $product_id <br>";
                }

                // Calculate the total quantity remaining in the store after deducting pending orders
                $quantity_remaining = max(0, $product_in_store - $total_orders); // Ensure quantity left is not negative

                // Update the total sold column by deducting the total orders
                $total_sold = $product_in_store - $quantity_remaining;
                ?>
                <tr class='text-center'>
                    <td data-label='id'>
                        <?php echo $number; ?>
                    </td>
                    <td data-label='title'>
                        <?php echo $product_title; ?>
                    </td>
                    <td data-label='image'><img src='./product_images/<?php echo $product_image; ?>' alt='Product Image' style='width: 100px; height: auto;'></td>
                    <td data-label='price'>
                        <?php echo $product_price; ?>
                    </td>
                    <td data-label='sold'>
                        <?php echo $total_sold; ?>
                    </td>
                    <td data-label='status'>
                        <?php echo $status; ?>
                    </td>
                    <td data-label='edit'><a href='index.php?edit_product=<?php echo $product_id ?>' class='btn btn-success'>Edit</a></td>
                    <td data-label='delete'><a href='#' onclick='confirmDelete(<?php echo $product_id ?>)' class="btn btn-danger">Delete</a></td>
                    <td data-label='total in store'>
                        <?php echo $product_in_store; ?>
                    </td>
                </tr>
                
            <?php
            // echo "Product ID: $product_id, Product in Store: $product_in_store, Total Orders: $total_orders <br>"; 
                $number++;
            } ?>
            </tbody>
        </table>
    </div>
</section>

<script>
function confirmDelete(product_id) {
    if(confirm("Are you sure you want to delete this product?")) {
        window.location.href = "index.php?delete_product=" + product_id;
    }
}
</script>


</body>
</html>
