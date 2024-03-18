<?php

// include './include/connect_database.php';


function displayProducts($limit){
    global $conn;
    $sql_query = "SELECT * FROM `products` LIMIT {$limit}";
    $result = mysqli_query($conn, $sql_query); 

    while($row = mysqli_fetch_assoc($result)){
        $product_id = $row['id']; 
        $product_name = $row['product_name'];
        $product_price = $row['product_price'];
        $product_image = $row['product_image_1'];

        // Output HTML code to display product
        echo "<div class='col-lg-3 col-sm-6'>
                <div class='new-arrival-box'>
                    <div class='image'>
                        <img src='./admin_area/product_images/$product_image' alt='$product_name'>
                        <div class='hidden-btn product-button-container'>
                        <a href='#' data-quantity='1' class='btn white-btn add_to_cart_button'
                        data-image='$product_image' data-name='$product_name'
                        data-price='$product_price' rel='nofollow' data-product-id='$product_id'>Add to cart</a>
                            <a href='cart.php' class='btn white-btn added_to_cart' title='View cart'>View cart</a>
                        </div>
                        </div>
                                <div class='content'>
                                    <a href='shop-single.php?id=$product_id'>
                                        <div class='rateing'>

                        </div>
                                    <h4 class='heading'>$product_name</h4>
                                    <div class='price-tag'>";

                        echo "<ins><span class='price-symbol'>$</span><span>$product_price</span></ins>
                                </div>
                                </a>
                            </div>
                        </div>
                    </div>";

    }
}

function search_product() {
    global $conn;

    // Check if the search keyword is set
    if(isset($_GET['search_keyword'])){
        $user_search_data_value = $_GET['search_keyword'];

        // Escape the search keyword to prevent SQL injection
        $search_keyword = '%' . mysqli_real_escape_string($conn, $user_search_data_value) . '%';

        // Construct the SQL query
        $search_product_query = "SELECT p.* 
                                FROM products p
                                INNER JOIN tags t ON p.tag_id = t.id
                                WHERE t.tag_name LIKE '$search_keyword'";

        // Execute the query
        $result_query = mysqli_query($conn, $search_product_query);

        // Check if there are any search results
        if(mysqli_num_rows($result_query) == 0) {
            echo "<section class='search-result-section pb-5 mb-sm-5'>
                    <div class='container'>
                        <div class='content'>
                            <h4 class='heading'>No search Results</h4>
                            <p>There are no products matching your query</p>
                            <div class='search-product search-result'>
                                <form action='search.php' method='get'>
                                    <div class='position-relative d-flex gap-3'>
                                        <input type='search' name='search_keyword' placeholder='Search...'>
                                        <input type='submit' name='search_product' class='read-more btn' value='Search'>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>";
        } else {
            while($row = mysqli_fetch_assoc($result_query)){
                // Extract product details
                $product_id = $row['id']; 
                $product_name = $row['product_name'];
                $product_price = $row['product_price'];
                $product_image = $row['product_image_1'];

                // Output HTML code to display product
                echo "<div class='col-lg-3 col-sm-6'>
                        <div class='new-arrival-box'>
                            <div class='image'>
                                <img src='./admin_area/product_images/$product_image' alt='$product_name'>
                                <div class='hidden-btn product-button-container'>
                                    <a href='#' data-quantity='1' class='btn white-btn add_to_cart_button'
                                    data-image='$product_image' data-name='$product_name'
                                    data-price='$product_price' rel='nofollow' data-product-id='$product_id'>Add to cart</a>
                                    <a href='cart.php' class='btn white-btn added_to_cart' title='View cart'>View cart</a>
                                </div>
                            </div>
                            <div class='content'>
                                <a href='shop-single.php?id=$product_id'>
                                    <h4 class='heading'>$product_name</h4>
                                    <div class='price-tag'>
                                        <ins><span class='price-symbol'>$</span><span>$product_price</span></ins>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>";

            } 
        }
    }
}

function allproduct(){
    global $conn;
    $sql_query = "SELECT * FROM `products`";
    $result = mysqli_query($conn, $sql_query); 

    while($row = mysqli_fetch_assoc($result)){
        $product_id = $row['id']; 
        $product_name = $row['product_name'];
        $product_price = $row['product_price'];
        $product_rating = $row['product_rating'];
        $product_image = $row['product_image_1'];

        $filled_stars = floor($product_rating); 

        // Output HTML code to display product
        echo "<div class='col-lg-3 col-sm-6'>
                <div class='new-arrival-box'>
                    <div class='image'>
                        <img src='./admin_area/product_images/$product_image' alt='$product_name'>
                        <div class='hidden-btn product-button-container'>
                            <a href='#' data-quantity='1' class='btn white-btn add_to_cart_button'
                            data-image='$product_image' data-name='$product_name'
                            data-price='$product_price' rel='nofollow' data-product-id='$product_id'>Add to cart</a>
                            <a href='cart.php' class='btn white-btn added_to_cart' title='View cart'>View cart</a>
                        </div>
                    </div>
                    <div class='content'>
                        <a href='shop-single.php?id=$product_id'>
                            <div class='rateing'>";

        for ($i = 0; $i < $filled_stars; $i++) {
            echo "<i class='fa-solid fa-star'></i>";
        }

        $empty_stars = 5 - ceil($product_rating); 
        for ($i = 0; $i < $empty_stars; $i++) {
            echo "<i class='fa-regular fa-star'></i>";
        }

        echo "</div>
                <h4 class='heading'>$product_name</h4>
                <div class='price-tag'>
                    <ins><span class='price-symbol'>$</span><span>$product_price</span></ins>
                </div>
                </a>
            </div>
        </div>
    </div>";

    }
}

function productdetail(){
    global $conn;
    if(isset($_POST["shop_single_add_to_cart"])){
        global $conn;
        $ipAddress = getIPAddress();
        $get_product_id =  $_GET['id']; // Assuming the product ID is passed via GET parameter 'id'
        $quantity = $_POST['quantity'];
    
        $sql = "SELECT * FROM `cart_details` WHERE ip_address = '$ipAddress' AND product_id = $get_product_id";
        $result = mysqli_query($conn, $sql);
        $num_of_rows = mysqli_num_rows($result);
    
        if($num_of_rows > 0){
            echo "<script>alert('Item already in cart');</script>";
        } else {
            $insert_query = "INSERT INTO `cart_details` (product_id, ip_address, quantity) VALUES ($get_product_id, '$ipAddress', $quantity)";
            $result_query = mysqli_query($conn, $insert_query);
    
            if($result_query){
                echo "<script>alert('Item added to cart successfully');</script>";
            } else {
                echo "<script>alert('Error adding item to cart');</script>";
            }
        }
    }    
    if(isset($_GET['id'])){
        $product_id = $_GET['id'];
        
        $sql_query = "SELECT products.*, tags.tag_name, categories.category_name 
                      FROM products 
                      INNER JOIN tags ON products.tag_id = tags.id 
                      INNER JOIN categories ON products.category_id = categories.id 
                      WHERE products.id = '$product_id'";

        $result = mysqli_query($conn, $sql_query); 
        while($row = mysqli_fetch_assoc($result)){
            $product_id = $row['id']; 
            $product_name = $row['product_name'];
            $product_description = $row['product_description'];
            $product_price = $row['product_price'];
            $product_image_1 = $row['product_image_1'];
            $product_image_2 = $row['product_image_2'];
            $tags = $row['tag_name'];
            $category = $row["category_name"];

            echo "
            <section class='single-banner bg-light-white margin-top-header'>
                <div class='container'>
                    <div class='content'>
                        <h1 class='heading'>Shop</h1>
                        <div class='breadcrumb m-0'>
                            <a href='index.php'>Home</a>
                            <span>/</span>
                            <span>{$category}</span>
                            <span>/</span>
                            <span>{$product_name}</span>
                        </div>
                    </div>
                </div>
            </section>
            <section class='pb-5 padding-top-section'>
                <div class='container'>
                    <div class='row g-sm-4 gy-5 mb-5'>
                        <div class='col-sm-6'>
                            <div class=''>
                                <div class='zoom image image-change position-relative overflow-hidden' id='zoom1'>
                                    <img class='zoomable-image' src='./admin_area/product_images/{$product_image_1}' alt='{$product_name}'>
                                    <div class='image-change-full-width'>
                                        <i class='fas fa-magnifying-glass' onclick='openFancybox(this)'></i>
                                    </div>";
                                    echo "
                                </div>
                                <div class='for_change-image d-flex gap-2 pt-2'>
                                    <a href='./admin_area/product_images/{$product_image_1}' data-fancybox='images' data-caption='{$product_name}'>
                                        <img src='./admin_area/product_images/{$product_image_1}' alt='{$product_name}'>
                                    </a>
                                    <a href='./admin_area/product_images/{$product_image_2}' data-fancybox='images' data-caption='{$product_name}'>
                                        <img src='./admin_area/product_images/{$product_image_2}' alt='{$product_name}'>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class='product-price-detail ps-sm-5'>
                                <div class='content product-box-list'>
                                    <div class='title'>
                                        <h4 class='heading'>{$product_name}</h4>
                                    </div>
                                    <div class='price-tag'>
                                        <ins><span class='price-symbol'>$</span><span>{$product_price}</span></ins>
                                    </div>
                                </div>
                                <div class='product-price-description product-box-list'>
                                    <p>{$product_description}</p>
                                </div>
                                <div class='product-price-input product-box-list'>
                                <form action='' method='post'>
                                    <div class='product-number position-relative d-flex'>
                                        <div class='d-xl-none product-btn plus'>+</div>
                                        <input type='number' name='quantity' min='1' value='1' class='quantity-product'>
                                        <div class='d-xl-none product-btn minus'>-</div>
                                    </div>
                                    <input type='submit' name='shop_single_add_to_cart' value='ADD TO CART' class='read-more'>
                                </form>                            
                                </div>
                                <div class='product-price-detail-category'>
                                    <div class='d-flex gap-2 align-items-center'>
                                        <h5 class='heading'>Category:</h5>
                                        <a href='#'>{$category}</a>
                                    </div>
                                    <div class='d-flex gap-2 align-items-center'>
                                        <h5 class='heading'>Tags:</h5>
                                        <div class='d-flex gap-1'>
                                        <a href='#'>{$tags}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>";
                    echo "
                </div>
            </section>";
        }
    }
}

function getIPAddress() {
    // Check for shared internet/ISP IP
    if (!empty($_SERVER['HTTP_CLIENT_IP']) && filter_var($_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }

    // Check for IP addresses passing through proxies
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // Extract IP addresses from CSV list
        $ipList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        foreach ($ipList as $ip) {
            if (filter_var($ip, FILTER_VALIDATE_IP)) {
                return $ip;
            }
        }
    }

    // Check for the remote address
    if (!empty($_SERVER['REMOTE_ADDR']) && filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) {
        return $_SERVER['REMOTE_ADDR'];
    }

    // Return a default value if IP address cannot be determined
    return '0.0.0.0';
}

function cart(){
    global $conn;

    if(isset($_POST['add_to_cart'])) {
        $ipAddress = getIPAddress();
        $product_id = $_POST['add_to_cart'];

        // Check if the item is already in the cart
        $check_query = "SELECT * FROM `cart_details` WHERE ip_address = '$ipAddress' AND product_id = $product_id";
        $check_result = mysqli_query($conn, $check_query);

        if(mysqli_num_rows($check_result) > 0) {
            // Item already in cart
            echo "Item already in cart";
        } else {
            // Insert the item into the cart
            $insert_query = "INSERT INTO `cart_details` (product_id, ip_address, quantity) VALUES ($product_id, '$ipAddress', 1)";
            $insert_result = mysqli_query($conn, $insert_query);

            if($insert_result) {
                // Item successfully added to cart
                echo "Item added to cart";
            } else {
                // Error adding item to cart
                echo "Failed to add item to cart";
            }
        }
    }
}
cart();

function total_product_cart(){
    if(isset($_GET['add_to_cart'])){
        global $conn;
        $ipAddress = getIPAddress();

        $sql = "SELECT * FROM `cart_details` where ip_address = '$ipAddress'";
        $result = mysqli_query($conn, $sql);
        $num_of_sqli = mysqli_num_rows($result);
    }
    else{
        global $conn;
        $ipAddress = getIPAddress();

        $sql = "SELECT * FROM `cart_details` where ip_address = '$ipAddress'";
        $result = mysqli_query($conn, $sql);
        $num_of_sqli = mysqli_num_rows($result);
    }
    echo $num_of_sqli;
}


function displayCart() {
    global $conn;
    $ipAddress = getIPAddress();
    $cart_query = "SELECT cd.product_id, cd.quantity, p.product_image_1, p.product_price, p.product_name FROM cart_details cd JOIN products p ON cd.product_id = p.id WHERE cd.ip_address='$ipAddress'";
    $run_cart = mysqli_query($conn, $cart_query);

    $total = 0;

    if (isset($_GET['remove_product'])) {
        $product_id_to_remove = $_GET['remove_product'];
        if (isset($_GET['conform_deket'])) {
            $sql = "DELETE FROM cart_details WHERE product_id = $product_id_to_remove AND ip_address = '$ipAddress'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>alert('Product with ID $product_id_to_remove removed successfully')</script>";
                // Redirect to prevent resubmission of form
                header("Location: {$_SERVER['PHP_SELF']}");
                exit();
            } else {
                echo "<script>alert('Failed to delete product.')</script>";
            }
        }
    }

    if (isset($_POST['update_cart'])) {
        $quantities = $_POST['qty'];
        foreach ($quantities as $product_id => $quantity) {
            $update_cart_query = "UPDATE cart_details SET quantity = $quantity WHERE product_id = $product_id AND ip_address = '$ipAddress'";
            $update_result = mysqli_query($conn, $update_cart_query);
            if (!$update_result) {
                echo "<script>alert('Failed to update quantity.')</script>";
            }
        }
        // Redirect to prevent resubmission of form
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    }

    if (mysqli_num_rows($run_cart) > 0) {
        echo "<section class='cart-section padding-top-section'>
                <div class='container'>
                    <div class='notice'>
                        <div class='update-message'>
                            <i class='fa-solid fa-circle-check'></i>
                            <span>Cart updated.</span>
                        </div>
                    </div>
                    <form action='' method='post'>
                        <table class='cart-list margin-bottom-cart'>
                            <thead>
                                <th class='product-remove'></th>
                                <th class='product-thumbnail'></th>
                                <th class='product-name'>Product</th>
                                <th class='product-price'>Price</th>
                                <th class='product-quantity'>Quantity</th>
                                <th class='product-subtotal'>Total</th>
                            </thead>
                            <tbody id='cartBody'>";

        while ($row_cart = mysqli_fetch_array($run_cart)) {
            $pro_id = $row_cart['product_id'];
            $quantity = $row_cart['quantity'];
            $image = $row_cart['product_image_1'];
            $price = $row_cart['product_price'];
            $product_name = $row_cart['product_name'];

            echo "<tr>
                    <td class='product-remove'>
                        <a href='{$_SERVER['PHP_SELF']}?remove_product=$pro_id&conform_deket' onclick='return confirm(\"Are you sure you want to delete this product?\")'>x</a>
                    </td>
                    <td data-label='Product Image' class='product-thumbnail'>
                        <a href='shop-single.php'>
                            <img src='./admin_area/product_images/$image' alt=''>
                        </a>
                    </td>
                    <td data-label='Product Name' class='product-name'>
                            <a href='shop-single.php?id=$pro_id'>$product_name</a>
                        </td>
                        <td data-label='Product Price' class='product-price'>
                            <span class='product-amount'>
                                <span class='price-symbol'>$</span>
                                $price
                            </span>
                        </td>
                        <td data-label='Product Quantity' class='product-quantity'>
                            <div class='quantity product-number position-relative d-flex'>
                                <div class='d-xl-none product-btn plus'>+</div>
                                <input type='number' min='1' value='$quantity' class='quantity-product' name='qty[$pro_id]'>
                                <div class='d-xl-none product-btn minus'>-</div>
                            </div>
                        </td>
                        <td data-label='Product Subtotal' class='product-subtotal'>
                            <span class='product-amount'>
                                <span class='price-symbol'>$</span>
                                " . ($price * $quantity) . "
                            </span>
                        </td>
                    </tr>";
            $total += ($price * $quantity);
        }

        echo "
                <tr>
                    <td colspan='6' class='action'>
                        <div class='d-flex justify-content-end'>
                            <input type='submit' name='update_cart' class='btn white-btn checkout-btn' value='Update Cart'>
                        </div>
                    </td>
                </tr>
                </tbody>
              </table>
              </form>
              <div class='cart-collaterals margin-bottom-cart'>
                    <div class='row justify-content-end'>
                        <div class='col-sm-6'>
                            <div class='cart_total'>
                                <h2 class='heading underline'>Cart totals</h2>
                                <table>
                                    <tbody>
                                        <tr class='cart-subtotal'>
                                            <th>Subtotal</th>
                                            <td class='text-end' id='subtotal'>
                                            <span class='price-symbol'>$</span>
                                            $total
                                        </td>
                                        </tr>
                                        <tr class='order-total'>
                                            <th>Total</th>
                                            <td class='text-end' id='total'>
                                                <strong>
                                                    <span class='price-symbol'>$</span>
                                                    $total
                                                </strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class='proceed-to-checkout'>
                                    <a href='./user_area/checkout.php' class='btn read-more checkout-btn'>Proceed to checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </section>";
    } else {
        echo "
        <section class='section-gap'>
            <div class='container'>
                <div class=''>
                    <h2 class='heading underline center text-center'>Your shopping cart is empty.</h1>
                    <p class='lead text-center'>Browse our store and add items to your cart. We offer a wide range of products for men, women and kids. If you
                    <p class='lead text-center'>Add some products to your cart before proceeding. You can also browse our collection of items or visit our shop page for more options.</
                    <p class='lead text-center'>Add some products to your cart before proceeding. We’ll remind you when it’s time for checkout!</p>
                    <p class='lead text-center'>No items in the cart.</p>
                </div>
            </div>
        </section>
        ";
    }
}


// function totalcart

function total_price_cart(){
    global $conn;
    $total = 0;
    $ipAddress = getIPAddress();
    $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$ipAddress'";
    $run_cart = mysqli_query($conn, $cart_query);

    while($row = mysqli_fetch_array($run_cart)){
        $product_id = $row["product_id"];
        $select_products = "SELECT * FROM `products` WHERE id ='$product_id'";
        $result_products = mysqli_query($conn, $select_products);
        while($row_products_price = mysqli_fetch_array($result_products)){
            $product_price = array($row_products_price['product_price']);
            $product_value = array_sum($product_price);
            $total += $product_value;
        }
    }

    echo $total;
}


// get user order detail

function user_order(){
    global $conn;
    $username = $_SESSION["username"];
    $get_details = "SELECT * FROM `user_table` WHERE user_name = '$username'";
    $result_detail = mysqli_query($conn, $get_details);

    while($row_query = mysqli_fetch_array($result_detail)){
        $user_id = $row_query["user_id"];

        if(!isset($_GET['edit_account']) && !isset($_GET['my_order']) && !isset($_GET['delete_account'])){
            $get_order = "SELECT * FROM `user_order` WHERE user_id = $user_id AND order_status = 'pending'";
            $result_order_query = mysqli_query($conn, $get_order);
            $row_count = mysqli_num_rows($result_order_query);

            if ($row_count > 0){
                echo "<div class='pending-order-fn'>
                    <h3 class='heading text-center '>You have <span>$row_count</span> pending orders</h3>
                <p class='text-center'><a href='../user_area/profile.php?user_order'>Order Details</a></p>
                </div>";
            }else{
                echo "<div class='pending-order-fn'>
                    <h3 class='heading text-center '>You have <span>$row_count</span> pending orders</h3>
                <p class='text-center'><a href='../index.php'>Explore products  </a></p>
                </div>";
            }
        }
    }
}


?>