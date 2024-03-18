<?php 

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


<!-- <section class="cart-section padding-top-section">
    <div class="container">
        <div class="notice">
            <div class="update-message">
                <i class="fa-solid fa-circle-check"></i>
                <span>Cart updated.</span>
            </div>
        </div>
        <form action="">
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
                    <tr>
                        <td class="product-remove">
                            <a href="#">x</a>
                        </td>
                        <td data-label="Product Image" class="product-thumbnail">
                            <a href="shop-single.php">
                                <img src="image/shop-3.jpg" alt="">
                            </a>
                        </td>
                        <td data-label="Product Name" class="product-name">
                            <a href="shop-single.php">Board Wooden Clock</a>
                        </td>
                        <td data-label="Product Price" class="product-price">
                            <span class="product-amount">
                                <span class="price-symbol">$</span>
                                95.00
                            </span>
                        </td>
                        <td data-label="Product Quantity" class="product-quantity">
                            <div class="quantity product-number position-relative d-flex">
                                <div class="d-xl-none product-btn plus">+</div>
                                <input type="number" min="1" value="1" class="quantity-product" id="quantityInput">
                                <div class="d-xl-none product-btn minus">-</div>
                            </div>
                        </td>
                        <td data-label="Product Subtotal" class="product-subtotal">
                            <span class="product-amount">
                                <span class="price-symbol">$</span>
                                95.00
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="action">
                            <div class="d-flex justify-content-end">
                                <input type="button" id="updateButton" name="update_cart" class="btn white-btn checkout-btn" disabled value="update cart" >
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <div class="cart-collaterals margin-bottom-cart">
            <div class="row justify-content-end">
                <div class="col-sm-6">
                    <div class="cart_total">
                        <h2 class="heading underline">Cart totals</h2>
                        <table>
                            <tbody>
                                <tr class="cart-subtotal">
                                    <th>Subtotal</th>
                                    <td class="text-end" id="subtotal">
                                        <span class="product-amount">
                                            <span class="price-symbol">$</span>
                                            0.00 
                                        </span>
                                    </td>
                                </tr>
                                <tr class="order-total">
                                    <th>Total</th>
                                    <td class="text-end" id="total">
                                        <strong>
                                            <span class="product-amount">
                                                <span class="price-symbol">$</span>
                                                0.00 
                                            </span>
                                        </strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="proceed-to-checkout">
                            <a href="checkout.php" class="btn read-more checkout-btn">Proceed to checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->


<?php include("footer.php"); ?>