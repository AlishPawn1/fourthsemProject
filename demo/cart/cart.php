<?php include("header.php"); ?>

<section class="cart-section">
    <div class="container">
        <div class="notice">
            <div class="update-message">
                <i class="fa-solid fa-circle-check"></i>
                <span>Cart updated.</span>
            </div>
        </div>
        <!-- Use the updateCartForm to submit the cart updates -->
        <form id="updateCartForm" action="update_cart.php" method="post">
            <table class="cart-list margin-bottom-cart">
                <thead>
                    <th class="product-remove"></th>
                    <th class="product-thumbnail"></th>
                    <th class="product-name">Product</th>
                    <th class="product-price">Price</th>
                    <th class="product-quantity">Quantity</th>
                    <th class="product-subtotal">Total</th>
                </thead>
                <tbody id="cartBody">
                    <!-- This is where the dynamically added rows will go -->
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                <input type="submit" id="updateButton" name="update_cart" class="btn white-btn checkout-btn"
                    disabled value="Update Cart">
            </div>
        </form>
    </div>
</section>

<?php include("footer.php"); ?>
