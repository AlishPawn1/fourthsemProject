<?php
@session_start();
include ('../include/connect_database.php');
include ("../function/commonfunction.php");

$user_search_data_value = "";
if (isset($_GET['search_keyword'])) {
    $user_search_data_value = $_GET['search_keyword'];
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Newari Shop</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/slick.css">
    <link rel="stylesheet" type="text/css" href="../css/animate.css">
    <link rel="stylesheet" type="text/css" href="../css/jquery.fancybox.css">
    <link rel="stylesheet" type="text/css" href="../css/all.css">
    <!-- <link rel="icon" href="../image/newari_favicon.jpg" type="image/x-icon"> -->
    <link rel="stylesheet" href="../css/splide.min.css">
    <link rel="stylesheet" type="text/css" href="../styles.css">
    <link rel="stylesheet" type="text/css" href="../css/responsive.css">
    <!-- <link rel="icon" href="../image/newari_favicon.jpg" type="image/x-icon"> -->
    <link rel="icon" href="../image/newari_favicon.jpg">
</head>

<body>
    <header class="header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center nav-bar position-relative">
                <div class="main-logo">
                    <a href="../index.php"><img src="../image/logo.png" alt=""></a>
                </div>
                <nav>
                    <ul class="primary-menu">
                        <li>
                            <a href="http://localhost/fourthsemProject/">home</a>
                        </li>
                        <li>
                            <a href="http://localhost/fourthsemProject/contact-two.php">contact</a>
                        </li>
                        <li>
                            <a href="http://localhost/fourthsemProject/display_all.php">shop</a>
                        </li>
                        <?php if (!isset($_SESSION["username"])): ?>
                            <li class="right">
                                <a href="#">Login</a>
                                <ul class="sub-menu">
                                    <li><a href="login-user.php"><span>Login</span></a></li>
                                    <li><a href=" #user_registration.php"><span>Register</span></a></li>
                                </ul>
                            </li>
                        <?php else: ?>
                            <li class="right">
                                <a href="#">Welcome, <?php echo $_SESSION["username"]; ?></a>
                                <ul class="sub-menu">
                                    <li><a
                                            href="profile.php?user=<?php echo $_SESSION["username"]; ?>"><span>Profile</span></a>
                                    </li>
                                    <li><a href="logout.php"><span>Log Out</span></a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    </ul>
                    <div class="hamburger">
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                    </div>
                </nav>
            </div>
            <!-- <div class="overlay"></div> -->
        </div>
    </header>