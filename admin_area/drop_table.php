<?php
include '../include/connect_database.php';

// Drop tables in reverse order to avoid foreign key constraints
mysqli_query($conn, "DROP TABLE IF EXISTS images");
mysqli_query($conn, "DROP TABLE IF EXISTS tags");
mysqli_query($conn, "DROP TABLE IF EXISTS categories");
mysqli_query($conn, "DROP TABLE IF EXISTS products");
mysqli_query($conn, "DROP TABLE IF EXISTS sub_sub_menu");
mysqli_query($conn, "DROP TABLE IF EXISTS sub_menu");
mysqli_query($conn, "DROP TABLE IF EXISTS menu");

// Check for errors
if (mysqli_errno($conn)) {
    echo "Error dropping tables: " . mysqli_error($conn);
} else {
    echo "Tables dropped successfully!";
}

// Close the connection
mysqli_close($conn);
?>