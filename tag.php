<?php 

$dynamicTitle = "tag";
include("header.php"); 
include("function/commonfunction.php");

?>

<section class="single-banner bg-light-white margin-top-header">
    <div class="container">
        <div class="content">
            <h1 class="heading">Tag item</h1>
            <div class="breadcrumb m-0">
                <a href="index.php">Home</a>
                <span>/</span>
                <span>Tag</span>
            </div>
        </div>
    </div>
</section>

<section class="category-list section-gap">
    <div class="container">
        <div class="main-title text-center pb-5">
            <h2 class="title">Tag List</h2>
        </div>
        <div class="row">
            <?php
            
            tag_list()
            
            ?>
        </div>
    </div>
</section>


<?php 

include('footer.php');

?>