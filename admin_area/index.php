<?php


include ("../include/connect_database.php");
include ("../function/commonfunction.php");
session_start();

// Check if the user is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    // Redirect to the login page
    header("Location: admin_login.php");
    exit(); // Stop further execution
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" integrity="sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="style.css">
    <!-- Add your custom CSS file if needed -->
    <style>

    </style>
</head>

<body>
    <header>
        <nav>
            <div class="logo-name">
                <span class="logo_name">ADMIN</span>
            </div>
            <div class="menu-items">
                <ul class="primary-menu">
                    <li>
                        <a href="http://localhost/fourthsemProject">
                            <i class="fa-solid fa-house-chimney"></i>
                            <span class="text">View site</span>
                        </a>
                    </li>
                    <li>
                        <a href="index.php">
                            <i class="fa-solid fa-house"></i>
                            <span class="text">Dashdoard</span>
                        </a>
                    </li>
                    <li>
                        <a href="index.php?view_products">
                            <i class="fa-solid fa-eye"></i>
                            <span class="text">View product</span>
                        </a>
                    </li>
                    <li>
                        <a href="index.php?add_stock">
                            <i class="fa-solid fa-arrow-trend-up"></i>
                            <span class="text">Add stock</span>
                        </a>
                    </li>
                    <li>
                        <a href="index.php?history">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                            <span class="text">History</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-solid fa-download"></i>
                            <span class="text">Insert</span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="index.php?insert_product">Insert product</a></li>
                            <li><a href="index.php?insert_categories">Insert Categories</a></li>
                            <li><a href="index.php?insert_tags">Insert tags</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-solid fa-list"></i>
                            <span class="text">List</span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="index.php?list_order">All order</a></li>
                            <li><a href="index.php?list_payment">All payment</a></li>
                            <li><a href="index.php?list_report">List Report</a></li>
                            <li><a href="index.php?list_user">List user</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="index.php?feedback">
                            <i class="fa-solid fa-comments"></i>
                            <span class="text">Feedback</span>
                        </a>
                    </li>
                </ul>
                <div class="logout-btn">
                    <a href="logout.php">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Logout</a>
                </div>
            </div>
        </nav>
    </header>

    <section class="dashboard">
        <div class="container">
            <div class="top">
                <h1 class="title">Traditional Newari Dress</h1>
                <?php

                if (isset($_SESSION['admin_name'])) {
                    echo "<h5 class='admin-name'>Welcome, " . $_SESSION['admin_name'] . "</h5>";
                }

                ?>
            </div>
            <?php
            if (isset($_GET['insert_product'])) {
                include ('insert_product.php');
            } elseif (isset($_GET['insert_tags'])) {
                include ('insert_tags.php');
            } elseif (isset($_GET['insert_categories'])) {
                include ('insert_categories.php');
            } elseif (isset($_GET['view_products'])) {
                include ('view_products.php');
            } elseif (isset($_GET['edit_product'])) {
                include ('edit_product.php');
            } elseif (isset($_GET['add_stock'])) {
                include ('add_stock.php');
            } elseif (isset($_GET['add_stock_edit'])) {
                include ('add_stock_edit.php');
            } elseif (isset($_GET['delete_product'])) {
                include ('delete.php');
            } elseif (isset($_GET['order_id'])) {
                include ('delete.php');
            } elseif (isset($_GET['user_id'])) {
                include ('delete.php');
            } elseif (isset($_GET['edit_categories'])) {
                include ('edit_categories.php');
            } elseif (isset($_GET['edit_tags'])) {
                include ('edit_tags.php');
            } elseif (isset($_GET['list_order'])) {
                include ('list_order.php');
            } elseif (isset($_GET['list_payment'])) {
                include ('list_payment.php');
            } elseif (isset($_GET['list_user'])) {
                include ('list_user.php');
            } elseif (isset($_GET['list_report'])) {
                include ('list_report.php');
            } elseif (isset($_GET['feedback'])) {
                include ('feedback.php');
            } elseif (isset($_GET['history'])) {
                include ('history.php');
            } else {
                include ('dashboard.php');
            }


            ?>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"
        integrity="sha512-X/YkDZyjTf4wyc2Vy16YGCPHwAY8rZJY+POgokZjQB2mhIRFJCckEGc6YyX9eNsPfn0PzThEuNs+uaomE5CO6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js" integrity="sha512-X/YkDZyjTf4wyc2Vy16YGCPHwAY8rZJY+POgokZjQB2mhIRFJCckEGc6YyX9eNsPfn0PzThEuNs+uaomE5CO6A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <script src="script.js"></script>

</body>

</html>