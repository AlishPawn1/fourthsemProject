<?php
require '../vendor/autoload.php';
\Stripe\Stripe::setApiKey('sk_test_51PhZNfRqbIai3bkj3wSIoLzsLBorzOA2ICDy6hckrO936PKz26Lsu4hEqudTwlFwU6c0Tz1do7ZN7kd5jEg8pi4M00Y0Lap67P'); // Replace with your actual secret key

$order_id = $_GET['order_id'];

// Fetch order details from the database
include ("../include/connect_database.php");
$select_data = "SELECT * FROM `user_order` WHERE order_id = $order_id";
$query_select = mysqli_query($conn, $select_data);
$row_fetch = mysqli_fetch_assoc($query_select);
$amount_due = $row_fetch['amount_due'];
$currency = 'usd'; // Set your currency

// Create a PaymentIntent
$intent = \Stripe\PaymentIntent::create([
    'amount' => $amount_due * 100, // Convert amount to cents
    'currency' => $currency,
    'metadata' => ['order_id' => $order_id]
]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stripe Payment</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        #card-element {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            background-color: white;
        }
        #submit {
            margin-top: 20px;
        }
        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Stripe Payment</h2>
        <form id="payment-form">
            <div class="form-group">
                <label for="card-element">Credit or debit card</label>
                <div id="card-element">
                    <!-- Elements will create input elements here -->
                </div>
            </div>

            <div id="error-message" class="error-message" role="alert"></div>
            <button id="submit" class="btn btn-primary btn-block">Pay</button>
        </form>
    </div>

    <script>
        var stripe = Stripe('pk_test_51PhZNfRqbIai3bkjE0q5aoFLz1EqrFtsea3VmYFT4DUnvEcxGOd6u2MiGzxxxLRXbNDVj27u3E0nPxT8nFj1LhCj00SDjGNrdO'); // Replace with your publishable key
        var elements = stripe.elements();

        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        var cardElement = elements.create('card', { style: style });
        cardElement.mount('#card-element');

        var form = document.getElementById('payment-form');
        var errorMessage = document.getElementById('error-message');

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.confirmCardPayment('<?php echo $intent->client_secret; ?>', {
                payment_method: {
                    card: cardElement
                }
            }).then(function(result) {
                if (result.error) {
                    errorMessage.textContent = result.error.message;
                } else {
                    if (result.paymentIntent.status === 'succeeded') {
                        window.location.href = 'success.php?order_id=<?php echo $order_id; ?>';
                    }
                }
            });
        });
    </script>
</body>
</html>
