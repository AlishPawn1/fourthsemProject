<?php
include ('user_header.php');
include ("../include/connect_database.php");
// include("../function/commonfunction.php");
@session_start();

?>

<section class="single-banner bg-light-white margin-top-header">
    <div class="container">
        <div class="content">
            <h1 class="heading">My Account</h1>
            <div class="breadcrumb m-0">
                <a href="../index.php">Home</a>
                <span>/</span>
                <span>My Account</span>
            </div>
        </div>
    </div>
</section>
<section class="section-gap profile-section">
    <div class="container">
        <div class="row">
            <div class="col-3">
                <ul class="navbar-nav shadow p-3">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <h4 class="heading">Your Profile</h4>
                        </a>
                    </li>

                    <?php
                    $username = $_SESSION["username"];
                    $user_image = "select * from `user_table` where user_name = '$username'";
                    $result_image = mysqli_query($conn, $user_image);
                    $row_image = mysqli_fetch_array($result_image);
                    $user_image = $row_image['user_image'];
                    echo "
                        <li class='nav-item'>
                            <div class='image user-image'>
                                <img src='./user_image/$user_image' alt='$username'>
                            </div>
                        </li>
                        ";
                    ?>

                    <li class="nav-item">
                        <a class="nav-link" href="profile.php"><span>Pending order</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php?edit_account"><span>Edit account</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php?user_order"><span>My order</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php?delete_account"><span>Delete account</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php"><span>Log out</span></a>
                    </li>
                </ul>
            </div>
            <div class="col-9">
                <?php
                user_order();
                if (isset($_GET['edit_account'])) {
                    include ('edit_account.php');
                }
                if (isset($_GET['user_order'])) {
                    include ('user_order.php');
                }
                if (isset($_GET['delete_account'])) {
                    include ('delete_account.php');
                }
                ?>
            </div>
        </div>
    </div>
</section>

<?php include ("user_footer.php"); ?>