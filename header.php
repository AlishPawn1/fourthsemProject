<?php
session_start();
include ('include/connect_database.php');
include("function/commonfunction.php");

$user_search_data_value = "";
if (isset($_GET['search_keyword'])) {
    $user_search_data_value = $_GET['search_keyword'];
}

if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    // echo "Welcome, $username!";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php
        // $dynamicTitle = '';
        
        if (isset($dynamicTitle) && $dynamicTitle !== '') {
            echo $dynamicTitle;
        } else {
            echo 'Newari shop';
        }
        ?>
    </title>
    <link rel="stylesheet" type="text/css" href="http://localhost/fourthsemProject/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/fourthsemProject/css/animate.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/fourthsemProject/css/jquery.fancybox.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/fourthsemProject/css/all.css">
    <link rel="stylesheet" href="http://localhost/fourthsemProject/css/splide.min.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/fourthsemProject/styles.css">
    <link rel="icon" href="http://localhost/fourthsemProject/image/newari_favicon.jpg" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="http://localhost/fourthsemProject/css/responsive.css">
</head>

<body>
    <header class="header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center nav-bar position-relative">
                <div class="main-logo">
                    <a href="http://localhost/fourthsemProject/index.php"><img src="http://localhost/fourthsemProject/image/logo.png" alt=""></a>
                </div>
                <nav>
                    <ul class="primary-menu">
                        <li>
                            <a href="http://localhost/fourthsemProject/">home</a>
                        </li>
                        <li>
                            <a href="http://localhost/fourthsemProject/display_all.php">shop</a>
                        </li>
                        <li>
                            <a href="#">Tag</a>
                            <?php 
                                $select_tag = "SELECT * FROM tags";
                                $result_tag = mysqli_query($conn, $select_tag);

                                // Check if there are any tags
                                if (mysqli_num_rows($result_tag) > 0) {
                                    echo '<ul class="sub-menu">';
                                    
                                    while ($row_tag = mysqli_fetch_assoc($result_tag)) {
                                        $tag_name = $row_tag['tag_name'];
                                        $tag_id = $row_tag['id']; 
                                        ?>
                                        <li>
                                            <a href="http://localhost/fourthsemProject/tag.php?tag_id=<?php echo $tag_id; ?>"><span><?php echo $tag_name; ?></span></a>
                                        </li>
                                        <?php
                                    }

                                    echo '</ul>';
                                }
                            ?>
                        </li>
                        <li>
                            <a href="#">categories</a>
                            <?php 
                                $select_categories = "SELECT * FROM categories";
                                $result_categories = mysqli_query($conn, $select_categories);

                                // Check if there are any tags
                                if (mysqli_num_rows($result_categories) > 0) {
                                    echo '<ul class="sub-menu">';
                                    
                                    while ($row_category = mysqli_fetch_assoc($result_categories)) {
                                        $category_name = $row_category['category_name'];
                                        $category_id = $row_category['id']; 
                                        ?>
                                        <li>
                                            <a href="http://localhost/fourthsemProject/category.php?cat_id=<?php echo $category_id; ?>"><span><?php echo $category_name; ?></span></a>
                                        </li>
                                        <?php
                                    }

                                    echo '</ul>';
                                }
                            ?>
                        </li>
                        <li>
                            <a href="http://localhost/fourthsemProject/contact-two.php">contact</a>
                        </li>

                        <?php if (!isset($_SESSION["username"])): ?>
                            <li class="right">
                                <a href="#">Login</a>
                                <ul class="sub-menu">
                                    <li><a href="http://localhost/fourthsemProject/user_area/login-user.php"><span>Login</span></a></li>
                                    <li><a href="http://localhost/fourthsemProject/user_area/user_registration.php"><span>Register</span></a></li>
                                </ul>
                            </li>
                        <?php else: ?>
                            <li class="right">
                                <a href="#">Welcome, <?php echo $_SESSION["username"]; ?></a>
                                <ul class="sub-menu">
                                    <li><a
                                            href="http://localhost/fourthsemProject/user_area/profile.php?user=<?php echo $_SESSION["username"]; ?>"><span>Profile</span></a>
                                    </li>
                                    <li><a href="http://localhost/fourthsemProject/user_area/logout.php"><span>Log Out</span></a></li>
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
            <div class="overlay"></div>
        </div>
    </header>