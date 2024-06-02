<?php 

$dynamicTitle = "category";
include("header.php"); 
include("function/commonfunction.php");

?>

<section class="single-banner bg-light-white margin-top-header">
    <div class="container">
        <div class="content">
            <h1 class="heading">Category item</h1>
            <div class="breadcrumb m-0">
                <a href="index.php">Home</a>
                <span>/</span>
                <span>Category</span>
            </div>
        </div>
    </div>
</section>

<section class="category-list section-gap">
    <div class="container">
        <div class="main-title text-center pb-5">
            <h2 class="title">Category List</h2>
        </div>
        <div class="row">
            <?php
            
            category_list()
            
            ?>
        </div>
    </div>
</section>


<?php 

include('footer.php');

?>