<?php
// include("user_header.php");
include ("../include/connect_database.php");
@session_start();

?>

<!-- <section class="single-banner bg-light-white margin-top-header">
    <div class="container">
        <div class="content">
            <h1 class="heading">Checkout</h1>
            <div class="breadcrumb m-0">
                <a href="index.php">Home</a>
                <span>/</span>
                <span>Checkout</span>
            </div>
        </div>
    </div>
</section> -->
<section class="">
    <?php
    include ('payment.php');
    ?>
</section>


<?php

// include("user_footer.php");
?>