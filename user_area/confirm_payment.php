<?php
include ('user_header.php');
include ("../include/connect_database.php");
// include("../function/commonfunction.php");
@session_start();

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $select_data = "select * from `user_order` where order_id = $order_id";
    $query_select = mysqli_query($conn, $select_data);
    $row_fetch = mysqli_fetch_assoc($query_select);
    $invoice_number = $row_fetch['invoice_number'];
    $amount_due = $row_fetch['amount_due'];

    // if(mysqli_num_rows($query_select) > 0) {
    //     $row_fetch = mysqli_fetch_assoc($query_select);
    //     $invoice_number = $row_fetch['invoice_number'];
    //     $amount_due = $row_fetch['amount_due'];
    // } else {
    //     echo "Order not found";
    // }
}

if (isset($_POST["conform_payment"])) {
    $invoice_number = $_POST['invoice_number'];
    $amount = $_POST['amount'];
    $payment_mode = $_POST['payment_mode'];

    // Construct the SQL query
    $insert_query = "INSERT INTO `user_payments` (order_id, invoice_number, amount, payment_mode) VALUES ('$order_id', '$invoice_number', '$amount', '$payment_mode')";

    // Execute the query
    $result = mysqli_query($conn, $insert_query);

    // Check if the query was successful
    if ($result) {
        echo "<script>alert('Successfully completed the payment')</script>";
        echo "<script>window.open('profile.php?user_order', '_self')</script>";
    } else {
        // If the query fails, display an error message
        echo "<h1 class='heading'>Error occurred while processing your payment</script>";
        echo "<p>Please try again later.</p>";
        echo "<p>Error message: " . mysqli_error($conn) . "</p>";
    }

    $update_order = "update `user_order` set order_status = 'complete' where order_id = $order_id ";
    $result_order = mysqli_query($conn, $update_order);
}






?>


<section class="py-5 margin-top-header text-center">
    <div class="container">
        <h1 class="heading">Confirm payment</h1>
        <form action="" method="post">
            <div class="form-outline mt-4 w-50 m-auto">
                <input readonly type="text" class="form-control w-50 m-auto" value="<?php echo $invoice_number ?>"
                    name="invoice_number">
            </div>
            <div class="form-outline mt-4 w-50 m-auto">
                <label for="amount">amount</label>
                <input readonly type="text" class="form-control w-50 m-auto" value="<?php echo $amount_due ?>"
                    name="amount">
            </div>
            <div class="form-outline mt-4 w-50 m-auto">
                <select name="payment_mode" class="form-select w-50 m-auto" id="">
                    <option>Cash on delivery</option>
                    <option>Offline Payment</option>
                </select>
            </div>
            <input type="submit" class="btn read-more mt-4" value="confirm" name="conform_payment">
        </form>
    </div>
</section>

<?php include ("user_footer.php"); ?>