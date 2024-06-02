<?php 
session_start();
include("../include/connect_database.php");
include("../function/commonfunction.php");

if(isset($_POST['user_login'])){
    // $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    $select_query = "SELECT * FROM `user_table` WHERE user_email = '$user_email'";
    $result = mysqli_query($conn, $select_query);
    $row = mysqli_num_rows($result);
    $row_data = mysqli_fetch_array($result);
    $user_ip = getIPAddress();

    // Cart items
    $select_query_cart = "SELECT * FROM `cart_details` WHERE ip_address = '$user_ip'";
    $select_result = mysqli_query($conn, $select_query_cart);
    $row_cart = mysqli_num_rows($select_result);

    if($row > 0){
        // $_SESSION["username"] = $user_name;
        if($user_password === $row_data['user_password']){ // Compare plain text passwords
            if($row_data['email_verified']){ // Check if email is verified
                $_SESSION["username"] = $row_data['user_name'];
                if($row_cart > 0){
                    echo "<script>alert('Login successfully')</script>";
                    echo "<script>window.open('payment.php','_self')</script>";
                } else {
                    echo "<script>alert('Login successfully')</script>";
                    echo "<script>window.open('profile.php','_self')</script>";
                }
            } else {
                echo "<script>alert('Please verify your email before logging in')</script>";
                echo "<script>window.open('login-user.php','_self')</script>";
            }
        } else {
            echo "<script>alert('Invalid Credentials')</script>";
            echo "<script>window.open('login-user.php','_self')</script>";
        }
    } else {
        echo "<script>alert('Invalid Credentials')</script>";
        echo "<script>window.open('login-user.php','_self')</script>";

    }
}

?>
