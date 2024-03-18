<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = mysqli_connect($servername,  $username, $password);
if (!$conn) { 
    die("Connection failed: " . mysqli_connect_error());
}
else{
    echo "<script>console.log('Connected Successfully')</script>";
}

$server_query = "create database shop";
$run = mysqli_query($conn, $server_query);

if (!$run) {
    echo "Error  creating database: " . mysqli_error($conn);
}
else{
    echo "Database created successfully.";
}
?>