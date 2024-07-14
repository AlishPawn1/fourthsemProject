<?php
include ("../include/connect_database.php");

// Retrieve verification code from URL parameters
$verification_code = $_GET['code'];

// Verify the code against the database
$query = "SELECT * FROM user_table WHERE verification_code = '$verification_code'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {
    // Update user's email verification status
    $update_query = "UPDATE user_table SET email_verified = 1 WHERE verification_code = '$verification_code'";
    mysqli_query($conn, $update_query);
    echo "Your email has been successfully verified.";
} else {
    echo "Invalid verification code.";
}
?>