<?php
include ("../include/connect_database.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['complete_order'])) {
        $order_id = $_POST['order_id'];

        // Update admin_status to 'complete'
        $update_order = "UPDATE `user_order` SET `admin_status` = 'complete' WHERE `order_id` = '$order_id'";
        if (mysqli_query($conn, $update_order)) {
            // Fetch the ordered products and quantities
            $get_order_details = "SELECT product_id, quantity FROM `order_status` WHERE `order_id` = '$order_id'";
            $result_order_details = mysqli_query($conn, $get_order_details);

            if ($result_order_details) {
                $update_order_status = "UPDATE `order_status` SET `order_status` = 'complete' WHERE `order_id` = '$order_id'";
                $result_order_status = mysqli_query($conn, $update_order_status);

                while ($row_order_details = mysqli_fetch_assoc($result_order_details)) {
                    $product_id = $row_order_details['product_id'];
                    $quantity = $row_order_details['quantity'];

                    // Update the product quantity in the products table
                    $update_product = "UPDATE `products` SET `product_in_store` = `product_in_store` - $quantity WHERE `id` = '$product_id'";
                    mysqli_query($conn, $update_product);
                }
                $message = "Order marked as complete successfully";
            } else {
                $message = "Error fetching order details: " . mysqli_error($conn);
            }
        } else {
            $message = "Error updating order: " . mysqli_error($conn);
        }
    }

    if (isset($_POST['delete_order'])) {
        $order_id = $_POST['order_id'];
        $delete_order = "DELETE FROM `user_order` WHERE `order_id` = '$order_id'";
        if (mysqli_query($conn, $delete_order)) {
            $message = "Order deleted successfully";
        } else {
            $message = "Error deleting order: " . mysqli_error($conn);
        }
    }
}

// Fetch orders
$get_order = "SELECT * FROM `user_order`";
$result = mysqli_query($conn, $get_order);
$row_count = mysqli_num_rows($result);
?>


<section class="section-gaps list-order">
    <div class="container">
        <?php
        if (isset($message)) {
            echo "<div class='alert alert-info'>$message</div>";
        }

        if ($row_count == 0) {
            echo "<h1 class='heading text-center'>No Order Found!</h1>";
        } else {
            echo "
            <h3 class='text-center heading'>All Orders</h3>
            <table class='table table-bordered mt-5'>
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Due Amount</th>
                        <th>Invoice Number</th>
                        <th>Total Products</th>
                        <th>Order Date</th>
                        <th>User Status</th>
                        <th>Admin Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>";
            
            $number = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                $order_id = $row['order_id'];
                $amount_due = $row['amount_due'];
                $invoice_number = $row['invoice_number'];
                $total_products = $row['total_products'];
                $order_date = $row['order_date'];
                $order_status = $row['order_status'];
                $admin_status = $row['admin_status'];

                echo "
                <tr id='order_$order_id'>
                    <td>$number</td>
                    <td>$amount_due</td>
                    <td>$invoice_number</td>
                    <td>$total_products</td>
                    <td>$order_date</td>
                    <td>$order_status</td>
                    <td>$admin_status</td>
                    <td>";
                        // Show "Complete" button only if admin_status is not 'complete' and order_status is 'complete'
                        if ($admin_status != 'complete' && $order_status == 'complete') {
                            echo "
                            <form method='POST' style='display:inline;'>
                                <input type='hidden' name='order_id' value='$order_id'>
                                <button type='submit' name='complete_order' class='btn btn-warning'>Complete</button>
                            </form>";
                        }
                        // Show "Delete" button only if both admin_status and order_status are not 'complete'
                        if ($admin_status != 'complete' || $order_status != 'complete') {
                            echo "
                            <form method='POST' style='display:inline;'>
                                <input type='hidden' name='order_id' value='$order_id'>
                                <button type='submit' name='delete_order' class='btn btn-danger'>Delete</button>
                            </form>";
                        }
                echo "</td>
                </tr>";
                $number++;
            }

            echo "</tbody></table>";
        }
        ?>
    </div>
</section>

<?php mysqli_close($conn); // Close the database connection ?>
</body>
</html>
