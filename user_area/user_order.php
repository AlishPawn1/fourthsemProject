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
