<!------------------------------  Header section  ------------------------------>
<?php
$dynamicTitle = "Newari shop";
include ("header.php");
include ("function/commonfunction.php");
cart();
?>
<!------------------------------ End  header section  ------------------------------>
<section class="main-banner secondary-bg">
    <div class="splide banner-slide">
        <div class="splide__track">
            <ul class="splide__list">
                <li class="splide__slide">
                    <div class="banner"
                        style="background-image: url('image/newari-dress-girl.png'); background-position: 120% 100px; background-size: contain;">
                        <div class="container">
                            <div
                                class="content d-flex align-items-center justify-content-start h-100 wow animate__delay-slow">
                                <div class="col-xl-6">
                                    <h1 class="heading underline"><span>the best</span> products</h1>
                                    <p>Create a diverse and authentic collection of Newari clothes.</p>
                                    <a href="#other_section" class="btn read-more mt-1">read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="splide__slide">
                    <div class="banner"
                        style="background-image: url('image/Vector.png'); background-position: left bottom; background-size: contain;">
                        <div class="container">
                            <div
                                class="content d-flex align-items-center justify-content-end h-100 wow animate__delay-slow">
                                <div class="col-xl-6">
                                    <h1 class="heading underline"><span>Follow</span>Us</h1>
                                    <p>Follow us for new product in local.</p>
                                    <a href="#other_section" class="btn read-more mt-1">read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</section>
<section id="other_section" class="shop-categorie section-gap">
    <div class="container">
        <div class="row g-sm-4 g-2">
            <div class="col-sm-4 d-flex">
                <div class="shop-small ">
                    <div class="row gy-sm-4 gy-2">
                        <div class="col-12">
                            <div class="image overflow-hidden wow animate__animated animate__fadeInLeft">
                                <a href="#"><img src="image/image_1.jpg" alt=""></a>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="image overflow-hidden wow animate__animated animate__fadeInLeft">
                                <a href="#"><img src="image/image_2.jpg" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-8 d-flex">
                <div class="shop-big w-100 wow animate__animated animate__fadeInRight">
                    <div class="image overflow-hidden">
                        <a href="#"><img src="image/image_3.jpg" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="deal-section section-gap">
    <div class="container">
        <div class="d-flex justify-content-sm-end justify-content-center">
            <div class="col-sm-7">
                <div class="d-flex justify-content-center wow animate__animated animate__zoomIn">
                    <div class="text-center">
                        <div class="title">
                            <h3 class="heading">Visit our all product</h3>
                        </div>
                        <p>Promote cultural exchange by making Newari products </p>
                        <a href="display_all.php" class="white-btn btn">shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="shop-collection section-gap wow animate__animated animate__backInUp">
    <div class="container">
        <div class="content text-center">
            <div class="title kaushan">
                <h5 class="heading">Shop Collection</h5>
            </div>
            <h3 class="heading underline">New Arrivals</h3>
            <p>Experience the fascinating world of Newari culture with Newari shop, where traditions and style combine.
            </p>
        </div>

        <div class="row g-xl-5 g-4">
            <?php displayProducts(8); ?>
        </div>
    </div>
</section>
<section class="section-gap main-shop">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-8">
                <div class="content text-center wow animate__animated animate__zoomIn">
                    <div class="title">
                        <h4 class="heading">Visit our all product</h4>
                    </div>
                    <p>Promote cultural exchange by making Newari products</p>
                    <a href="display_all.php" class="white-btn btn">shop now</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="main-top-rate main-product-box section-gap wow animate__animated animate__backInUp">
    <div class="container">
        <div class="title">
            <h5 class="heading">Top Rated Products</h5>
        </div>
        <div class="row g-xl-5 g-4">
            <?php displayProducts(4) ?>
        </div>
        <div id="cartBody"></div>
    </div>
</section>

<!------------------------------  Footer section  ------------------------------>
<?php include ("footer.php"); ?>
<!------------------------------ End  Footer section  ------------------------------>