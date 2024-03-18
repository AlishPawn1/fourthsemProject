<?php 
include("header.php"); 
include("function/commonfunction.php");
cart();
?>


<section class="single-banner bg-light-white margin-top-header">
    <div class="container">
        <div class="content">
            <h1 class="heading">Shop</h1>
            <div class="breadcrumb m-0">
                <a href="index.php">Home</a>
                <span>/</span>
                <span>Shop</span>
            </div>
        </div>
    </div>
</section>
<section class="shop-list-detail pb-5 padding-top-section">
    <div class="container">
        <div class="search-product">
            <form action="search.php" method="get">
                <div class="position-relative d-flex gap-3">
                    <input type="search" name="search_keyword" placeholder="Search products...">
                    <input type="submit" name="search_product" class="read-more btn" value="Search">
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="shop-filter">
                    <div class="product-filter">
                        <div class="total-product-list">
                            <span>Showing 1–8 of 16 results</span>
                        </div>
                        <form>
                            <select name="orderby" class="orderby">
                                <option value="menu_order" selected="selected">Default sorting</option>
                                <option value="popularity">Sort by popularity</option>
                                <option value="rating">Sort by average rating</option>
                                <option value="date">Sort by latest</option>
                                <option value="price">Sort by price: low to high</option>
                                <option value="price-desc">Sort by price: high to low</option>
                            </select>
                        </form>
                    </div>
                    <div class="mb-xl-5 pb-ms-5 pb-3">
                        <div class="row g-xl-5 g-md-4 gy-4">
                            <?php allproduct()?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php include("footer.php"); ?>
