<?php 
session_start();
include("../include/connect_database.php");
include("../function/commonfunction.php");
$_SESSION['admin_logged_in'] = true;

if(isset($_POST['admin_login'])){
    $admin_name = $_POST['admin_name'];
    $admin_password = $_POST['admin_password'];
    $_SESSION['admin_name'] = $admin_name;


    $select_query = "SELECT * FROM `admin_table` WHERE admin_name = '$admin_name'";
    $result = mysqli_query($conn, $select_query);
    $row = mysqli_num_rows($result);
    $row_data = mysqli_fetch_array($result);

    if($row > 0){
        if($admin_password === $row_data['admin_password']){ // Compare plain text passwords
            if($row_data['email_verified']){ // Check if email is verified
                $_SESSION["admin_name"] = $admin_name;
                echo "<script>alert('Login successfully')</script>";
                echo "<script>window.open('index.php','_self')</script>";
            } else {
                echo "<script>alert('Please verify your email before logging in')</script>";
                echo "<script>window.open('admin_login.php','_self')</script>";
            }
        } else {
            echo "<script>alert('Invalid Credentials')</script>";
            echo "<script>window.open('admin_login.php','_self')</script>";
        }
    } else {
        echo "<script>alert('Invalid Credentials')</script>";
        echo "<script>window.open('admin_login.php','_self')</script>";

    }
}

?>
