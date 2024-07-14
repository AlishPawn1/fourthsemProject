<?php
$dynamicTitle = "Contact";
include ("header.php"); ?>

<?php

// Include the PHPMailer Autoload file
require 'C:/xampp/htdocs/shop/PHPMailer-master/src/PHPMailer.php';
require 'C:/xampp/htdocs/shop/PHPMailer-master/src/SMTP.php'; // Include the SMTP class

// Check if form is submitted and 'name', 'email', and 'message' fields are set
if (isset($_POST['name'], $_POST['email'], $_POST['message'])) {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Create a new instance of the PHPMailer class
    $mail = new PHPMailer\PHPMailer\PHPMailer();

    // Set up SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'alishpawn00@gmail.com';
    $mail->Password = 'lupfmoliqmhqwumu';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Set email parameters
    $mail->setFrom($email, $name); // Set sender email address
    $mail->addAddress('alishpawn00@gmail.com'); // Set recipient email address
    $mail->Subject = 'Subject of the Email';
    $mail->Body = $message;

    // Send email
    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }
} else {
    echo 'Please fill out all required fields.';
}
?>




<section class="contact-banner section-gap margin-top-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 d-flex align-items-center">
                <div class="content">
                    <div class="title">
                        <h3 class="heading">Get in Touch</h3>
                    </div>
                    <h1 class="heading">Contact</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-gap contact-detail">
    <div class="container">
        <div class="row gy-5 contact-row">
            <div class="col-md-6">
                <div class="contact-content">
                    <div class="pb-4">
                        <h4 class="heading underline black">Location</h4>
                        <p>90-120 Swanston St,Melbourne, Australia</p>
                    </div>
                    <div class="">
                        <h4 class="heading underline black">Follow us</h4>
                        <div class="social-icon contact-icon">
                            <div class="icon">
                                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                            </div>
                            <div class="icon">
                                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                            </div>
                            <div class="icon">
                                <a href="#"><i class="fa-brands fa-google-plus-g"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-form">
                    <h4 class="heading underline black">Contact Form</h4>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-12">
                                <input type="text" name="name" placeholder="Enter your Name" class="form-input">
                            </div>
                            <div class="col-12">
                                <input type="email" name="email" placeholder="Enter your email address"
                                    class="form-input">
                            </div>
                            <div class="col-12">
                                <textarea name="message" placeholder="Enter your Message" cols="40" rows="5"
                                    class="form-textarea form-input"></textarea>
                            </div>
                            <div class="col-12">
                                <input type="submit" value="submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include ("footer.php"); ?>