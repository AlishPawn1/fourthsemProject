<?php
session_start();
include ('../header.php');
include ("../include/connect_database.php");
// include('../function/commonfunction.php');

// use PHPMailer\PHPMailer\PHPMailer;

// Include PHPMailer Autoload file
// Include PHPMailer classes
require 'C:/xampp/htdocs/fourthsemProject/PHPMailer-master/src/Exception.php';
require 'C:/xampp/htdocs/fourthsemProject/PHPMailer-master/src/PHPMailer.php';
require 'C:/xampp/htdocs/fourthsemProject/PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


// Function to generate a random verification code
function generateVerificationCode()
{
    return rand(100000, 999999); // Generates a 6-digit code
}

// Create a new instance of the PHPMailer class
$mail = new PHPMailer();

// Set up SMTP configuration
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'alishpawn00@gmail.com';
$mail->Password = 'lupfmoliqmhqwumu';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$errors = []; // Define an empty array to store errors

if (isset($_POST['user_register'])) {
    $user_name = $_POST['user_name'];
    $user_lname = $_POST['user_lname'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $conform_user_password = isset($_POST['conform_user_password']) ? $_POST['conform_user_password'] : '';
    $user_address = $_POST['user_address'];
    $user_phone = $_POST['user_contact'];

    $existing_email_query = "SELECT * FROM user_table WHERE user_email = '$user_email'";
    $existing_email_result = mysqli_query($conn, $existing_email_query);
    if (mysqli_num_rows($existing_email_result) > 0) {
        // Email already exists, display error message
        echo "<script>alert('Email is already registered. Please use a different email address.')</script>";
    } else {
        // Generate verification code
        $verification_code = generateVerificationCode();

        // Handle file upload
        if (!empty($_FILES['user_image']['name'])) {
            $user_image = $_FILES['user_image']['name'];
            $user_image_temp = $_FILES['user_image']['tmp_name'];

            // Move uploaded file to the appropriate directory
            $target_path = "./user_image/$user_image";
            move_uploaded_file($user_image_temp, $target_path);
        } else {
            $user_image = ""; // Set default value or handle case accordingly
        }

        // Construct and execute the SQL query
        $insert_query = "INSERT INTO `user_table`(`user_name`, `user_lname`, `user_email`, `user_password`, `user_image`, `user_address`, `user_mobile`, `verification_code`) VALUES ('$user_name', '$user_lname','$user_email','$user_password','$user_image','$user_address','$user_phone', '$verification_code')";
        $result = mysqli_query($conn, $insert_query);

        if ($result) {
            // Send verification email
            $mail->setFrom('alishpawn00@gmail.com', 'Newari shop');
            $mail->addAddress($user_email, $user_name);
            $mail->Subject = 'Verify your email address for registration';
            $mail->isHTML(true);
            $mail->Body = "Please use the following verification code to verify your email address: <strong>$verification_code</strong><br>Enter the code on the following page: <a href='http://localhost/fourthsemProject/user_area/verify_email_click.php?code=$verification_code'>Verify Email</a>";

            if (!$mail->send()) {
                // Display error message if email sending fails
                echo "<script>alert('Failed to send verification email.')</script>";
            } else {
                // Display success message if email sending succeeds
                echo "<script>alert('Registration successful. Please check your email to verify your account.')</script>";
                echo "<script>window.open('verify_email.php', '_self')</script>";
            }
        } else {
            echo "<script>alert('Failed to insert user.')</script>";
        }
    }
}

?>


<section class="single-banner bg-light-white margin-top-header">
    <div class="container">
        <div class="content">
            <h1 class="heading">My Account</h1>
            <div class="breadcrumb m-0">
                <a href="../index.php">Home</a>
                <span>/</span>
                <span>My Account</span>
            </div>
        </div>
    </div>
</section>

<section class="login-user padding-top-section">
    <div class="container">
        <h4 class="heading">New Registration Form</h4>
        <form id="registrationForm" action="" method="post" enctype="multipart/form-data">
            <div class="row pb-5">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="username">Username <span class="required">*</span></label>
                        <input type="text" id="user_name" name="user_name" class="form-input">
                        <span id="usernameError" class="error"></span>
                    </div>
                    <div class="form-group">
                        <label for="user_lname">Last name</label>
                        <input type="text" id="user_lname" name="user_lname" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="user_email">Email <span class="required">*</span></label>
                        <input type="text" id="user_email" name="user_email" class="form-input">
                        <span id="emailError" class="error"></span>
                    </div>
                    <div class="form-group">
                        <label for="User_image">Image <span class="optional">(optional)</span></label>
                        <input type="file" id="user_image" name="user_image" class="form-input form-control">
                    </div>
                    <div class="form-group">
                        <label for="user_password">Password <span class="required">*</span></label>
                        <input type="password" id="user_password" name="user_password" class="form-input password">
                        <input type="checkbox" class="showPassword">
                        <span id="passwordError" class="error"></span>
                    </div>
                    <div class="form-group">
                        <label for="conform_user_password">Confirm Password <span class="required">*</span></label>
                        <input type="password" id="conform_user_password" name="conform_user_password"
                            class="form-input password">
                        <input type="checkbox" class="showPassword">
                        <span id="confirmPasswordError" class="error"></span>
                    </div>
                    <div class="form-group">
                        <label for="user_address">Address <span class="required">*</span></label>
                        <input type="text" id="user_address" name="user_address" class="form-input">
                        <span id="addressError" class="error"></span>
                    </div>
                    <div class="form-group">
                        <label for="user_contact">Contact <span class="required">*</span></label>
                        <input type="tel" id="user_contact" name="user_contact" class="form-input">
                        <span id="contactError" class="error"></span>
                    </div>
                    <div>
                        <input type="submit" value="Register" class="read-more btn" name="user_register">
                        <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="login-user.php"
                                class="text-danger">Login</a></p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<?php include ('../Footer.php'); ?>