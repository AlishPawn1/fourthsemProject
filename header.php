
<?php 
session_start();
include('include/connect_database.php');

$user_search_data_value = "";
if(isset($_GET['search_keyword'])){
    $user_search_data_value = $_GET['search_keyword'];
}

if(isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    // echo "Welcome, $username!";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Newari Shop</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css">
    <link rel="stylesheet" type="text/css" href="css/all.css">
    <link rel="stylesheet" href="css/splide.min.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="icon" href="image/newari_favicon.jpg" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">  
</head>
<body>
<header class="header">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center nav-bar position-relative">
            <div class="main-logo">
                <a href="index.php"><img src="image/logo.png" alt=""></a>
            </div>
            <nav>
                <ul class="primary-menu">
                    <?php
                    $menuListQuery = "SELECT * FROM menu";
                    $menuListResult = mysqli_query($conn, $menuListQuery);

                    while ($menuData = mysqli_fetch_assoc($menuListResult)) {
                        $menuId = $menuData['id'];
                        $menuName = $menuData['menu_name'];
                        $menuUrl = $menuData['menu_url'];
                        $dropDownOption = $menuData['menu_select'];
                        
                        $class = '';
                        if ($dropDownOption == 'right') {
                            $class = 'right';
                        } elseif ($dropDownOption == 'left') {
                            $class = 'left';
                        }
                        echo "<li class='$class'>";
                        echo "<a href='$menuUrl'>$menuName</a>";

                        // Fetch and display sub-menu items
                        $subMenuQuery = "SELECT * FROM sub_menu WHERE menu_id = '$menuId'";
                        $subMenuResult = mysqli_query($conn, $subMenuQuery);

                        if (mysqli_num_rows($subMenuResult) > 0) {
                            echo "<ul class='sub-menu'>";
                            while ($subMenuData = mysqli_fetch_assoc($subMenuResult)) {
                                $subMenuId = $subMenuData['id'];
                                $subMenuName = $subMenuData['sub_menu_name'];
                                $subMenuUrl = $subMenuData['sub_menu_url'];
                                echo "<li><a href='$subMenuUrl'><span>$subMenuName</span></a>";

                                $subSubMenuQuery = "SELECT * FROM sub_sub_menu WHERE id = '$subMenuId'";
                                $subSubMenuResult = mysqli_query($conn, $subSubMenuQuery);

                                if (mysqli_num_rows($subSubMenuResult) > 0) {
                                    echo "<ul class='sub-menu'>";
                                    while ($subSubMenuData = mysqli_fetch_assoc($subSubMenuResult)) {
                                        $subSubMenuName = $subSubMenuData['sub_sub_menu_name'];
                                        $subSubMenuUrl = $subSubMenuData['sub_sub_menu_url'];
                                        echo "<li><a href='$subSubMenuUrl'><span>$subSubMenuName</span></a></li>";
                                    }
                                    echo "</ul>"; 
                                }

                                echo "</li>"; 
                            }
                            echo "</ul>"; 
                        }
                        echo "</li>";
                    }
                    ?>
                    <?php if(!isset($_SESSION["username"])): ?>
                        <li class="right">
                            <a href="#">Login</a>
                            <ul class="sub-menu">
                                <li><a href="./user_area/login-user.php"><span>Login</span></a></li>
                                <li><a href="user_area/user_registration.php"><span>Register</span></a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="right">
                            <a href="#">Welcome, <?php echo $_SESSION["username"]; ?></a>
                            <ul class="sub-menu">
                                <li><a href="user_area/profile.php?user=<?php echo $_SESSION["username"]; ?>"><span>Profile</span></a></li>
                                <li><a href="user_area/logout.php"><span>Log Out</span></a></li>
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
