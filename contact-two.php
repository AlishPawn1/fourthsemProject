<?php
include ("header.php");
include("function/commonfunction.php");
// Include the PHPMailer Autoload file
require 'C:/xampp/htdocs/shop/PHPMailer-master/src/PHPMailer.php';
require 'C:/xampp/htdocs/shop/PHPMailer-master/src/SMTP.php'; // Include the SMTP class
require 'C:/xampp/htdocs/shop/PHPMailer-master/src/Exception.php'; // Include the Exception class

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Check if form is submitted and 'name', 'email', and 'message' fields are set
if(isset($_POST['name'], $_POST['email'], $_POST['message'])) {
    // Get form data
    $name = $_POST['name']; 
    $email = $_POST['email']; 
    $message = $_POST['message']; 
    $subject = $_POST['subject'];

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

    // Set email parameters
    $mail->setFrom($email, $name); // Set sender email address
    $mail->addAddress('alishpawn00@gmail.com'); // Set recipient email address
    $mail->Subject = $subject; // Set email subject
    $mail->Body = $message; // Set email body

    // Send email
    if(!$mail->send()) {
        // Display error message if email sending fails
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        // Display success message if email sending succeeds
        echo 'Message has been sent';
    }
} else {
    // Display error message if required fields are not filled
    echo 'Please fill out all required fields.';
}
?>



<section class="contact-two margin-top-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="content">
                    <span>say hi to the team</span>
                    <h1 class="heading">Contact us</h1>
                    <div class="contact-form-two d-flex justify-content-lg-center">
                        <div class="content">
                            <p>feel free to contact us and we will get back to you as soon as we can.</p>
                            <form action="" method="post">
                                <div class="contact-inputs">
                                    <input class="contact-input" name="name" pattern="^[A-Za-z]+$" type="text" placeholder="name" required>
                                </div>
                                <div class="contact-inputs">
                                    <input class="contact-input" name="email" type="email" placeholder="email">
                                </div>
                                <div class="contact-inputs">
                                    <input class="contact-input" name="subject" type="text" placeholder="subject">
                                </div>
                                <div class="contact-inputs">
                                    <textarea class="contact-input" name="message" placeholder="message us"></textarea>
                                </div>
                                <input type="submit" class="white-btn" value="send">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-flex justify-content-lg-center">
                <div class="">
                    <div class="contact-two-info py-5">
                        <div class="pb-4">
                            <h5 class="heading">Address</h5>
                            <p>90-120 Swanston St,Melbourne VIC 3000, Australia</p>
                        </div>
                        <div class="pb-4">
                            <h5 class="heading">Support</h5>
                            <a href="mailto:support@gtcreators.com" type="">support@gtcreators.com</a>
                        </div>
                        <div class="">
                            <h5 class="heading">Call us</h5>
                            <a href="tel:+61 3 9559 9559" type="">+61 3 9559 9559</a>
                        </div>
                    </div>
                    <div class="contact-link ">
                        <a href="#" class="">
                            <div class="icon d-none"></div>
                            <div class="text">Instagram</div>
                        </a>
                        <a href="#" class="">
                            <div class="icon d-none"></div>
                            <div class="text">Facebook</div>
                        </a>
                        <a href="#" class="">
                            <div class="icon d-none"></div>
                            <div class="text">Linkedin</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include("footer.php"); ?>
