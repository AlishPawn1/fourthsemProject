<?php
include ("../include/connect_database.php");
// test_secret_key_e78b6608052b4d388f6455ae0df8d9b7
// test_public_key_3349c4f953df407591d450fb1a890d90
// https://admin.khalti.com/
// qweasdany@gmai.com
// Alish123@


$error_message = "";
$khalti_public_key = "test_public_key_3349c4f953df407591d450fb1a890d90";


// Check if the order_id is set in the GET request
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Fetch order and product details
    $select_product = "SELECT user_order.*, products.product_name, products.product_price 
                       FROM `user_order` 
                       INNER JOIN `products` ON user_order.product_id = products.id 
                       WHERE user_order.order_id = $order_id";
    $result = mysqli_query($conn, $select_product);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $product_id = $row['product_id'];
        $product_price = $row['product_price'];
        $product_name = $row['product_name'];
    } else {
        echo "No order found with the given ID.";
        exit;
    }
} else {
    echo "Order ID not specified.";
    exit;
}

$amount = $product_price * 100; // Amount in paisa
$uniqueProductId = $product_id;
$uniqueUrl = "http://localhost/fourthsemProject/user_area/product/$product_id";
$uniqueProductName = $product_name;
$successRedirect = "http://localhost/fourthsemProject/user_area/profile.php?user_order";

function checkValid($data)
{
    global $amount;
    return (float) $data["amount"] == $amount;
}

// Handle payment initiation
if (isset($_POST["mobile"]) && isset($_POST["mpin"])) {
    try {
        $mobile = $_POST["mobile"];
        $mpin = $_POST["mpin"];
        $price = (float) $amount;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://khalti.com/api/v2/payment/initiate/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode([
                "public_key" => $khalti_public_key,
                "mobile" => $mobile,
                "transaction_pin" => $mpin,
                "amount" => $amount,
                "product_identity" => $uniqueProductId,
                "product_name" => $uniqueProductName,
                "product_url" => $uniqueUrl
            ]),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $parsed = json_decode($response, true);

        if (isset($parsed["token"])) {
            $token = $parsed["token"];
        } else {
            $error_message = "Incorrect mobile or mpin";
        }
    } catch (Exception $e) {
        $error_message = "Incorrect mobile or mpin";
    }
}

// Handle OTP verification
if (isset($_POST["otp"]) && isset($_POST["token"]) && isset($_POST["mpin"])) {
    try {
        $otp = $_POST["otp"];
        $token = $_POST["token"];
        $mpin = $_POST["mpin"];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://khalti.com/api/v2/payment/confirm/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode([
                "public_key" => $khalti_public_key,
                "transaction_pin" => $mpin,
                "confirmation_code" => $otp,
                "token" => $token
            ]),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $parsed = json_decode($response, true);

        if (isset($parsed["token"]) && checkValid($parsed)) {
            // Payment is valid
            $update_order = "UPDATE `user_order` SET `order_status` = 'complete' WHERE `order_id` = $order_id";
            if (mysqli_query($conn, $update_order)) {
                $error_message = "<span style='color:green'>Payment success</span> <script> window.location='" . $successRedirect . "'; </script>";
            } else {
                $error_message = "Error updating order status: " . mysqli_error($conn);
            }
        } else {
            $error_message = "Could not process the transaction at the moment.";
            if (isset($parsed["detail"])) {
                $error_message = $parsed["detail"];
            }
        }
    } catch (Exception $e) {
        $error_message = "Could not process the transaction at the moment.";
    }
}
?>

<div class="khalticontainer">
    <center>
        <div><img src="khalti.png" alt="khalti" width="200"></div>
    </center>
    <?php if (!isset($token) || $token == "") { ?>
    <form action="khalti_payment.php?order_id=<?php echo $order_id; ?>" method="post">
        <small>Mobile Number:</small> <br>
        <input type="number" class="number" minlength="10" maxlength="10" name="mobile" placeholder="98xxxxxxxx">
        <small>Khalti Mpin:</small> <br>
        <input type="password" class="mpin" name="mpin" minlength="4" maxlength="6" placeholder="xxxx">
        <small>Price:</small> <br>
        <input type="text" class="price" value="Rs. <?php echo $product_price; ?>" disabled>
        <input type="hidden" class="price" name="amount" value="<?php echo $product_price; ?>">
        <br>
        <span style="display:block;color:red;">
            <?php echo $error_message; ?>
        </span>
        <button>Pay Rs. <?php echo $product_price; ?></button>
        <br>
        <small>We don't store your credentials for some security reasons. You will have to re-enter your details every time.</small>
    </form>
    <?php } else { ?>
    <form action="khalti_payment.php?order_id=<?php echo $order_id; ?>" method="post">
        <input type="hidden" name="token" value="<?php echo $token; ?>">
        <input type="hidden" name="mpin" value="<?php echo $mpin; ?>">
        <small>OTP:</small> <br>
        <input type="number" value="" name="otp" placeholder="xxxx">
        <span style="display:block;color:red;">
            <?php echo $error_message; ?>
        </span>
        <button>Pay Rs. <?php echo $product_price; ?></button>
    </form>
    <?php } ?>
</div>

<style>
.khalticontainer {
    width: 300px;
    border: 2px solid #5C2D91;
    margin: 0 auto;
    padding: 8px;
}

input {
    display: block;
    width: 98%;
    padding: 8px;
    margin: 2px;
}

button {
    display: block;
    background-color: #5C2D91;
    border: none;
    color: white;
    cursor: pointer;
    width: 98%;
    padding: 8px;
    margin: 2px;
}

button:hover {
    opacity: 0.8;
}
</style>
