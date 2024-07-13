<?php

if (isset($_GET['order_id'])) {
    $order_id = mysqli_real_escape_string($conn, $_GET['order_id']);
    $order_id = (int)$order_id;  // Ensure order_id is an integer

    // Fetch order details
    $update_store_query = "SELECT * FROM user_order WHERE order_id = $order_id AND order_status = 'pending'";
    $result_update = mysqli_query($conn, $update_store_query);

    if ($result_update && mysqli_num_rows($result_update) > 0) {
        while ($row = mysqli_fetch_assoc($result_update)) {
            $product_id = (int)$row['product_id'];
            $quantity = (int)$row['total_products'];

            // Ensure both product_id and quantity are valid numbers
            if ($product_id > 0 && $quantity > 0) {
                $update_query = "UPDATE products SET product_in_store = product_in_store - $quantity WHERE id = $product_id";
                if (mysqli_query($conn, $update_query)) {
                    // Update order status to complete
                    $complete_order_query = "UPDATE user_order SET order_status = 'complete' WHERE order_id = $order_id";
                    if (mysqli_query($conn, $complete_order_query)) {
                        echo "<script>alert('Payment confirmed and product stock updated successfully.');</script>";
                        echo "<script>window.open('profile.php', '_self');</script>";
                    } else {
                        echo "<script>alert('Error updating order status: " . mysqli_error($conn) . "');</script>";
                    }
                } else {
                    echo "<script>alert('Error updating product stock: " . mysqli_error($conn) . "');</script>";
                }
            } else {
                echo "<script>alert('Invalid product ID or quantity.');</script>";
            }
        }
    } else {
        echo "<script>alert('Error fetching pending orders or no matching order found: " . mysqli_error($conn) . "');</script>";
    }
}
//  else {
//     echo "<script>alert('Invalid order ID.');</script>";
// }
?>

<section class="order_user">
    <div class="container">
        <?php 
            $user_name = $_SESSION['username'];
            $get_user = "SELECT * FROM `user_table` WHERE user_name = '$user_name'";
            $result_query = mysqli_query($conn, $get_user);
            $row = mysqli_fetch_assoc($result_query);    
            $user = $row['user_id'];
        ?>

        <h1 class="heading">All Orders</h1>
        <table class="table table-bordered mt-5">
            <thead>
                <tr>
                    <td>S.No</td>
                    <td>Product Image</td>
                    <td>Amount Due</td>
                    <td>Total Products</td>
                    <td>Invoice Number</td>
                    <td>Date</td>
                    <td>Status</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                <?php 
                $number = 1;
                $get_order_details = "SELECT uo.*, p.product_image_1 
                FROM `user_order` uo 
                JOIN `products` p ON uo.product_id = p.id
                WHERE uo.user_id = '$user'";
                $result_order = mysqli_query($conn, $get_order_details);
                while($row_order = mysqli_fetch_assoc($result_order)){
                    $order_id = $row_order['order_id']; // Retrieve order_id
                    $amount_due = $row_order['amount_due'];
                    $total_product = $row_order['total_products'];
                    $invoice_number = $row_order['invoice_number'];
                    $order_status = $row_order['order_status'];
                    $image = $row_order['product_image_1'];

                    if($order_status == 'pending'){
                        $order_status = 'Incomplete';
                    }else{
                        $order_status = 'Complete';
                    }

                    $order_date = $row_order['order_date'];
                    
                    echo "<tr>
                            <td>$number</td>
                            <td><img src='../admin_area/product_images/$image' height='80' width='80'/></td>
                            <td>$amount_due</td>
                            <td>$total_product</td>
                            <td>$invoice_number</td>
                            <td>$order_date</td>
                            <td>$order_status</td>";

                    if($order_status == 'Complete') {
                        echo "<td>Paid</td>";
                    } else {
                        echo "<td><a href='confirm_payment.php?order_id=$order_id'>Confirm</a></td>";
                    }

                    echo "</tr>";
                    $number++;
                }
                ?>
            </tbody>
        </table>
    </div>
</section>

