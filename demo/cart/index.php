<?php include("header.php"); ?>

<section class="main-top-rate main-product-box section-gap wow animate__animated animate__fadeInDown">
    <div class="container">
        <div class="title">
            <h5 class="heading">Top Rated Products</h5>
        </div>
        <div class="row g-xl-5 g-4">
            <!-- Add the form for cart updates -->
            <form id="updateCartForm" action="update_cart.php" method="post">
                <!-- Optional: Include hidden input fields for each item in the cart -->
                <!-- These hidden fields will be submitted when the form is submitted -->
                <!-- You can use JavaScript to dynamically update these fields as items are added to the cart -->

                <!-- Example hidden field for item name -->
                <!-- <input type="hidden" name="cart_item_name[]" value=""> -->

                <!-- Example hidden field for item price -->
                <!-- <input type="hidden" name="cart_item_price[]" value=""> -->

                <!-- Example hidden field for item quantity -->
                <!-- <input type="hidden" name="cart_item_quantity[]" value=""> -->

                <!-- Repeat these fields for each item in the cart -->

                <!-- Add a submit button to submit the form -->
                <!-- This button is hidden and will be triggered by the 'Add to Cart' button -->
                <input type="submit" style="display: none;">
            </form>

            <div class="col-lg-3 col-sm-6">
                <!-- Your product details go here -->
                <!-- Example: -->
                <div class="new-arrival-box">
                    <div class="image">
                        <img src="image/new-arrival-1.jpg" alt="">
                        <div class="hidden-btn product-button-container">
                            <a href="#" data-quantity="1" class="btn white-btn add_to_cart_button"
                                data-image="image/new-arrival-1.jpg" data-name="Clock Gold Arrows" data-price="956.00"
                                rel="nofollow">Add to cart</a>
                            <a href="cart.php" class="btn white-btn added_to_cart wc-forward" title=""
                                style="display: none;">View cart</a>
                        </div>
                    </div>
                    <div class="content">
                        <a href="shop-single.php">
                            <div class="rateing">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <h4 class="heading">Clock Gold Arrows</h4>
                            <div class="price-tag">
                                <span>$956.00</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Repeat these product details for each product -->

        </div>
    </div>
</section>

<?php include("footer.php"); ?>
