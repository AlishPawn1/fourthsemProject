<?php
include ("../include/connect_database.php");

if (isset($_GET['order_id']) && isset($_GET['invoice_number']) && isset($_GET['amount']) && isset($_GET['payment_mode'])) {
    $order_id = $_GET['order_id'];
    $invoice_number = $_GET['invoice_number'];
    $amount = $_GET['amount'];
    $payment_mode = $_GET['payment_mode'];

    // Insert the payment details into tbl_user_payments
    $insert_query = "INSERT INTO `user_payments` (order_id, invoice_number, amount, payment_mode) 
                     VALUES ('$order_id', '$invoice_number', '$amount', '$payment_mode')";
    $result = mysqli_query($conn, $insert_query);

    // Update the order status to 'complete'
    $update_order = "UPDATE `user_order` SET order_status = 'complete' WHERE order_id = $order_id";
    $result_order = mysqli_query($conn, $update_order);

    if ($result && $result_order) {
        echo "<script>alert('Payment successful! Your order is complete.')</script>";
        echo "<script>window.open('profile.php?user_order', '_self')</script>";
    } else {
        echo "<h1 class='heading'>Error occurred while updating your order status</h1>";
        echo "<p>Please try again later.</p>";
        echo "<p>Error message: " . mysqli_error($conn) . "</p>";
    }
} else {
    echo "<h1 class='heading'>Invalid request!</h1>";
}
?>


