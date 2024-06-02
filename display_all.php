<?php
$dynamicTitle = "All product";
include("header.php");
include('function/commonfunction.php');


?>
<section class="single-banner bg-light-white margin-top-header">
    <div class="container">
        <h1 class="heading">All Product</h1>
        <div class="breadcrumb m-0">
            <a href="index.php">Home</a>
            <span>/</span>
            <span>All product</span>
        </div>
    </div>
</section>
<section class="pb-5 padding-top-section">
    <div class="container">
        <h3 class="heading underline center text-center">Display all product</h3>
        <div class="row g-xl-5 g-4 ">
       <?php
            allproduct();
        ?>
        </div>
    </div>
</section>


<?php include("footer.php");?>