
<?php
session_start();
include('header.php');  
include("../include/connect_database.php");
include('../function/commonfunction.php');
// use PHPMailer\PHPMailer\PHPMailer;

// // Include PHPMailer Autoload file
// require 'C:/xampp/htdocs/shop/PHPMailer-master/src/PHPMailer.php';

// Debugging: Output current working directory
// echo "Current working directory: " . getcwd() . "<br>";

// Attempt to require PHPMailer using different relative paths
$relative_paths = [
    './PHPMailer-master/src/PHPMailer.php',
    '../../fourthsemProject/PHPMailer-master/src/PHPMailer.php'
];

$file_found = false;
foreach ($relative_paths as $relative_path) {
    if (file_exists($relative_path)) {
        $file_found = true;
        require $relative_path;
        break;
    }
}

// If file not found using any relative paths, display an error message
if (!$file_found) {
    echo "Error: PHPMailer library not found.<br>";
}

use PHPMailer\PHPMailer\PHPMailer;

// Function to generate a random verification code
function generateVerificationCode() {
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

if(isset($_POST['admin_register'])){
    $admin_name = $_POST['admin_name'];
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];
    $conform_password = isset($_POST['admin_conform_password']) ? $_POST['admin_conform_password'] : '';

    // Check if email already exists in the database
    $existing_email_query = "SELECT * FROM admin_table WHERE admin_email = '$admin_email'";
    $existing_email_result = mysqli_query($conn, $existing_email_query);
    if (mysqli_num_rows($existing_email_result) > 0) {
        // Email already exists, display error message
        echo "<script>alert('Email is already registered. Please use a different email address.')</script>";
    } else {
        // Generate verification code
        $verification_code = generateVerificationCode();

        // Construct and execute the SQL query
        $insert_query = "INSERT INTO `admin_table`(`admin_name`, `admin_email`, `admin_password`, `verification_code`) VALUES ('$admin_name','$admin_email','$admin_password', '$verification_code')";
        $result = mysqli_query($conn, $insert_query);

        if ($result) {
            // Send verification email
            $mail->setFrom('alishpawn00@gmail.com', 'Your Name');
            $mail->addAddress($admin_email, $admin_name);
            $mail->Subject = 'Verify your email address for registration';
            $mail->isHTML(true);
            $mail->Body = "Please click the following link to verify your email address: <a href='http://localhost/shop/admin_area/verify_email.php?code=$verification_code'>Verify Email</a>";
    
            if (!$mail->send()) {
                // Display error message if email sending fails
                echo "<script>alert('Failed to send verification email.')</script>";
            } else {
                // Display success message if email sending succeeds
                echo "<script>alert('Registration successful. Please check your email to verify your account.')</script>";
                echo "<script>window.open('admin_login.php', '_self')</script>";
            }
        } else {
            echo "<script>alert('Failed to insert admin.')</script>";
        }
    }
}


?>


<section class="admin_register login-user section-gaps">
    <div class="container">
        <h4 class="heading text-center mb-5">New Registration Form</h4>
        <form id="admin_registrationForm" action="" method="post" enctype="multipart/form-data">
            <div class="row pb-5">
                <div class="col-sm-6 offset-3">
                    <div class="form-group">
                        <label for="admin_name">Admin name <span class="required">*</span></label>
                        <input type="text" id="admin_name" name="admin_name" class="form-input">
                        <span id="admin_nameError" class="error"></span>
                    </div>
                    <div class="form-group">
                        <label for="admin_email">Email <span class="required">*</span></label>
                        <input type="text" id="admin_email" name="admin_email" class="form-input">
                        <span id="admin_emailError" class="error"></span>
                    </div>
                    <div class="form-group">
                        <label for="admin_password">Password <span class="required">*</span></label>
                        <input type="password" id="admin_password" name="admin_password" class="form-input password">
                        <input type="checkbox" class="showPassword">
                        <span id="admin_passwordError" class="error"></span>
                    </div>
                    <div class="form-group">
                        <label for="admin_conform_password">Confirm Password <span class="required">*</span></label>
                        <input type="password" id="admin_conform_password" name="admin_conform_password" class="form-input password">
                        <input type="checkbox" class="showPassword">
                        <span id="admin_confirmPasswordError" class="error"></span>
                    </div>
                    <div>
                        <input type="submit" value="Register" class="read-more btn" name="admin_register">
                        <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="admin_login.php" class="text-danger">Login</a></p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<script>
    // admin validation
    // Function to validate name
    function validateAdminUsername() {
      const adminUsernameInput = document.getElementById("admin_name");
      const adminUsernameError = document.getElementById("admin_nameError");
      if (adminUsernameInput.value.trim().length < 3) {
          adminUsernameError.textContent = "Username must be at least 3 characters long.";
          return false;
      } else {
          adminUsernameError.textContent = "";
          return true;
      }
  }

  // Function to validate email
  function validateAdminEmail() {
      const adminEmailInput = document.getElementById("admin_email");
      const adminEmailError = document.getElementById("admin_emailError");
      if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(adminEmailInput.value.trim())) {
          adminEmailError.textContent = "Enter a valid email address.";
          return false;
      } else {
          adminEmailError.textContent = "";
          return true;
      }
  }

  // Function to validate password
  function validateAdminPassword() {
      const adminPasswordInput = document.getElementById("admin_password");
      const adminPasswordError = document.getElementById("admin_passwordError");
      if (adminPasswordInput.value.trim().length < 6 || !/[A-Z]/.test(adminPasswordInput.value) || !/[a-z]/.test(adminPasswordInput.value) || !/\d/.test(adminPasswordInput.value)) {
          adminPasswordError.textContent = "Password must contain at least 1 lowercase, 1 uppercase, and 1 number, and be 6 characters long.";
          return false;
      } else {
          adminPasswordError.textContent = "";
          return true;
      }
  }

  // Function to validate confirm password
  function validateAdminConfirmPassword() {
      const adminPasswordInput = document.getElementById("admin_password");
      const adminConfirmPasswordInput = document.getElementById("admin_conform_password");
      const adminConfirmPasswordError = document.getElementById("admin_confirmPasswordError");
      if (adminPasswordInput.value.trim() !== adminConfirmPasswordInput.value.trim()) {
          adminConfirmPasswordError.textContent = "Passwords do not match.";
          return false;
      } else {
          adminConfirmPasswordError.textContent = "";
          return true;
      }
  }



  // Add event listeners for input events
  document.getElementById("admin_name").addEventListener("input", validateAdminUsername);
  document.getElementById("admin_email").addEventListener("input", validateAdminEmail);
  document.getElementById("admin_password").addEventListener("input", validateAdminPassword);
  document.getElementById("admin_conform_password").addEventListener("input", validateAdminConfirmPassword);

  // Add event listener for form submission
  document.getElementById("admin_registrationForm").addEventListener("submit", function(event) {
      // Prevent form submission if any of the validations fail
      if (!validateAdminUsername() || !validateAdminEmail() || !validateAdminPassword() || !validateAdminConfirmPassword()) {
          event.preventDefault();
      }
  });
</script>
<?php 

include('footer.php'); 

?>