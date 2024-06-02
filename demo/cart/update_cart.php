<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Check if the cart item name array is set
    if (isset($_POST['cart_item_name'])) {

        // Retrieve the cart item details from the form
        $itemNames = $_POST['cart_item_name'];
        $itemPrices = $_POST['cart_item_price'];
        $itemQuantities = $_POST['cart_item_quantity'];

        // Perform the cart update logic here
        // For example, you might have a session-based cart and update it like this:

        // Start the session
        session_start();

        // Loop through the submitted items and update the cart
        for ($i = 0; $i < count($itemNames); $i++) {
            $itemName = $itemNames[$i];
            $itemPrice = $itemPrices[$i];
            $itemQuantity = $itemQuantities[$i];

            // Update or add the item to the session-based cart
            $_SESSION['cart'][$itemName] = array(
                'name' => $itemName,
                'price' => $itemPrice,
                'quantity' => $itemQuantity
            );
        }

        // Optional: You might want to redirect the user back to the cart page
        header('Location: cart.php');
        exit;
    }
}

// Handle cases where the form wasn't submitted properly
echo "Invalid request";

?>
