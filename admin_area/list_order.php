<section class="section-gaps list-order">
    <div class="container">

        <?php
        $get_order = "SELECT * FROM `user_order`"; // Corrected 'select' to 'SELECT'
        $result = mysqli_query($conn, $get_order);
        $row = mysqli_num_rows($result);

        if ($row == 0) {
            echo "<h1 class='heading text-center'>No Order Found!</h1>";
        } else {
            echo "
        <h3 class='text-center heading'>All order</h3>
            
            <table class='table table-bordered mt-5'>
                    <thead>
                        <tr>
                            <th>S .No</th>
                            <th>Due Amount</th>
                            <th>Invoice number</th>
                            <th>Total product</th>
                            <th>Order due</th>
                            <th>Status</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>";

            $number = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $order_id = $row['order_id'];
                $user_id = $row['user_id'];
                $amount_due = $row['amount_due'];
                $invoice_number = $row['invoice_number'];
                $total_products = $row['total_products'];
                $order_date = $row['order_date'];
                $order_status = $row['order_status'];
                $number++;

                echo "
                <tr>
                    <td data-label='S. No'>$number</td>
                    <td data-label='Due Amount'>$amount_due</td>
                    <td data-label='Invoice number'>$invoice_number</td>
                    <td data-label='Total Amount'>$total_products</td>
                    <td data-label='Order due'>$order_date</td>
                    <td data-label='Status'>$order_status</td>
                    <td data-label='Delete'>";

                // Only show delete button if status is not complete
                if ($order_status != "complete") {
                    echo "<a href='index.php?order_id=$order_id' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this order?\")'>Delete</a>";
                }

                echo "</td>
                </tr>";
            }

            echo "</tbody></table>";
        }
        ?>

    </div>
</section>