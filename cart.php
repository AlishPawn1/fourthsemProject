<?php 
$dynamicTitle = "Cart";
include("header.php"); 
include("function/commonfunction.php");

?>

<section class="single-banner bg-light-white margin-top-header">
    <div class="container">
        <div class="content">
            <h1 class="heading">Cart</h1>
            <div class="breadcrumb m-0">
                <a href="index.php">Home</a>
                <span>/</span>
                <span>Cart</span>
            </div>
        </div>
    </div>
</section>
<?php 
displayCart();
?>

<?php include("footer.php"); ?>