<?php
$dynamicTitle = "Contact";
include ("header.php");
include './include/connect_database.php';
include ("function/commonfunction.php");

if (isset($_POST['submit'])) {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];


    $insert_query = "INSERT INTO contact_message (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
    $result = mysqli_query($conn, $insert_query);
    if ($result) {
        echo "<script>alert('Message sent successfully.')</script>";
    } else {
        echo "Error: " . $insert_query . "<br>" . mysqli_error($conn);
    }

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
                                    <input class="contact-input" name="name" type="text" placeholder="name">
                                </div>
                                <div class="contact-inputs">
                                    <input class="contact-input" name="email" type="email"
                                        pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" placeholder="email">
                                </div>
                                <div class="contact-inputs">
                                    <input class="contact-input" name="subject" type="text" placeholder="subject">
                                </div>
                                <div class="contact-inputs">
                                    <textarea class="contact-input" name="message" placeholder="message us"></textarea>
                                </div>
                                <input type="submit" class="white-btn" name="submit" value="send">
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
                            <p>Bhaktapur, Nepal</p>
                        </div>
                        <div class="pb-4">
                            <h5 class="heading">Support</h5>
                            <a href="mailto:ronitchauguthi321@gmail.com" type="">ronitchauguthi321@gmail.com</a>
                        </div>
                        <div class="">
                            <h5 class="heading">Call us</h5>
                            <a href="tel:+977 9876543210" type="">+977 9876543210</a>
                        </div>
                    </div>
                    <div class="contact-link ">
                        <a href="#" class="">
                            <div class="icon d-none"></div>
                            <div class="text">Instagram</div>
                        </a>
                        <a href="https://www.facebook.com/newarishop/" class="">
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

<?php include ("footer.php"); ?>