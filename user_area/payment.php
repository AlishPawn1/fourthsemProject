<?php
include ('user_header.php');
include ("../include/connect_database.php");
// include("../function/commonfunction.php");


$user_ip = $_SESSION["userid"];
$get_user = "select * from `user_table` where user_id = '$user_ip'";
$run_user = mysqli_query($conn, $get_user);
$row_user = mysqli_fetch_array($run_user);
$user_id = $row_user['user_id'];
?>

<section class="single-banner bg-light-white margin-top-header">
    <div class="container">
        <div class="content">
            <h1 class="heading">Payment</h1>
            <div class="breadcrumb m-0">
                <a href="../index.php">Home</a>
                <span>/</span>
                <span>Payment</span>
            </div>
        </div>
    </div>
</section>
<section class="payment_method section-gap">
    <div class="container">
        <h4 class="heading text-center text-info">Payment Method</h4>
        <div class="row justify-content-center pt-5 text-center">
            <div class="col-md-6">
                <a href="order.php?user_id=<?php echo $user_id; ?> " >
                    <h2 class="heading">Pay offline</h2>
                </a>
            </div>
        </div>
    </div>
</section>

<?php include ("user_footer.php"); ?>