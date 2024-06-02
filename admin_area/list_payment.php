<section class="section-gaps list-order">
    <div class="container">

        <?php 
        $get_payment = "SELECT * FROM `user_payments`"; // Corrected 'select' to 'SELECT'
        $result = mysqli_query($conn, $get_payment);
        $row  = mysqli_num_rows($result);

        if($row == 0){
            echo "<h1 class='heading text-center'>No Payment Found!</h1>";
        } else {
            echo "
        <h3 class='text-center heading'>All payment</h3>
            
            <table class='table table-bordered mt-5'>
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Invoice number</th>
                            <th>Amount</th>
                            <th>Payment mode</th>
                            <th>Order due</th>
                        </tr>
                    </thead>
                    <tbody>";

            $number = 0;
            while($row = mysqli_fetch_assoc($result)){
                $order_id = $row['order_id'];
                $payment_id = $row['payment_id'];
                $amount = $row['amount'];
                $invoice_number = $row['invoice_number'];
                $payment_mode = $row['payment_mode'];
                $order_date = $row['date'];
                $number++;

                echo "
                <tr>
                    <td data-label='S. No'>$number</td>
                    <td data-label='Invoice number'>$invoice_number</td>
                    <td data-label='Amount'>$amount</td>
                    <td data-label='Payment mode'>$payment_mode</td>
                    <td data-label='Order due'>$order_date</td>
                </tr>
                ";
            }

            echo "</tbody></table>";
        }
        ?>

    </div>
</section>
