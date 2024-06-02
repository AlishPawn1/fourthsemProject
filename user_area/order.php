<?php 
include('user_header.php'); 
include("../include/connect_database.php");
// include("../function/commonfunction.php");

// Check if user_id is set
if(isset($_GET['user_id'])){
    $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
}

// Initialize variables
$get_ip_address = getIPAddress();
$invoice_number = mt_rand();
$status = 'pending';
$total_price = 0;
$total_quantity = 0;

// Sanitize input
$get_ip_address = mysqli_real_escape_string($conn, $get_ip_address);

// Calculate total price and count product
$cart_query_price = "SELECT cart_details.*, products.product_price FROM `cart_details` 
                    INNER JOIN products ON cart_details.product_id = products.id
                    WHERE cart_details.ip_address = '$get_ip_address'";
$result_price = mysqli_query($conn, $cart_query_price);

if ($result_price) {
    while ($row_price = mysqli_fetch_assoc($result_price)) {
        $product_id = $row_price['product_id'];
        $quantity = $row_price['quantity'];
        $product_price = $row_price['product_price'];
        $total_price += $product_price * $quantity;
        $total_quantity += $quantity;
    }
}

// Insert order
$insert_orders = "INSERT INTO `user_order` (user_id, product_id, amount_due, invoice_number, total_products, order_date, order_status) VALUES ('$user_id', '$product_id', '$total_price', '$invoice_number', '$total_quantity', NOW(), '$status')";
$result_query = mysqli_query($conn, $insert_orders);

if ($result_query) {
    echo "<script>alert('Order was submitted successfully');</script>";
    echo "<script>window.open('profile.php', '_self');</script>";
} else {
    echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
}

// Insert pending orders and delete items from cart
$get_cart = "SELECT * FROM `cart_details` WHERE ip_address = '$get_ip_address'";
$run_cart = mysqli_query($conn, $get_cart);

while ($get_item_quantity = mysqli_fetch_assoc($run_cart)) {
    $quantity = $get_item_quantity['quantity'];
    $product_id = $get_item_quantity['product_id'];

    // Update the product_in_store column in the database
    $update_query = "UPDATE `products` SET product_in_store = product_in_store - $quantity WHERE id = $product_id";
    if (!mysqli_query($conn, $update_query)) {
        echo "<script>alert('Error updating product stock: " . mysqli_error($conn) . "');</script>";
    }

    // Insert pending orders
    $insert_pending_orders = "INSERT INTO `order_pending` (`user_id`, `invoice_number`, `product_id`, `quantity`, `order_status`) VALUES ('$user_id', '$invoice_number', '$product_id', '$quantity', '$status')";
    if (!mysqli_query($conn, $insert_pending_orders)) {
        echo "<script>alert('Error inserting pending order: " . mysqli_error($conn) . "');</script>";
    }
}

// Delete items from cart
$empty_cart = "DELETE FROM `cart_details` WHERE ip_address = '$get_ip_address'";
if (!mysqli_query($conn, $empty_cart)) {
    echo "<script>alert('Error emptying cart: " . mysqli_error($conn) . "');</script>";
}
?>
