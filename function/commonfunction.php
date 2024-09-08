<?php

// include './include/connect_database.php';


function displayProducts($limit)
{
    global $conn;
    $sql_query = "SELECT * FROM `products` LIMIT {$limit}";
    $result = mysqli_query($conn, $sql_query);

    while ($row = mysqli_fetch_assoc($result)) {
        $product_id = $row['id'];
        $product_name = $row['product_name'];
        $product_price = $row['product_price'];
        $product_image = $row['product_image_1'];
        $product_in_store = $row['product_in_store'];

        // Output HTML code to display product
        echo "<div class='col-lg-3 col-sm-6'>
            <div class='new-arrival-box'>
                <a href='shop-single.php?id=$product_id'>
                <div class='image'>
                    <img src='./admin_area/product_images/$product_image' alt='$product_name'>";
        if ($product_in_store <= 0 || $product_in_store == 1) {
            echo "<div class='sale-btn'>
                            <span class='btn read-more'>out of stock</span>
                        </div>";
        }
        echo "
                </div>
                <div class='content'>
                        <h4 class='heading'>$product_name</h4>
                        <div class='price-tag'>";

        echo "<ins><span class='price-symbol'>Rs.</span><span>$product_price</span></ins>
                            </div>
                        </div>
                </a>
                    </div>
                </div>";

    }
}

function search_product()
{
    global $conn;

    // Check if the search keyword is set
    if (isset($_GET['search_keyword']) && !empty($_GET['search_keyword'])) {
        $user_search_data_value = $_GET['search_keyword'];

        // Escape the search keyword to prevent SQL injection
        $search_keyword = '%' . mysqli_real_escape_string($conn, $user_search_data_value) . '%';

        // Construct the SQL query
        $search_product_query = "
            SELECT p.* 
            FROM products p
            INNER JOIN tags t ON p.tag_id = t.id
            INNER JOIN categories c ON p.category_id = c.id
            WHERE c.category_name LIKE ? OR t.tag_name LIKE ? OR p.product_name LIKE ?";

        // Prepare the statement
        $stmt = mysqli_prepare($conn, $search_product_query);
        mysqli_stmt_bind_param($stmt, 'sss', $search_keyword, $search_keyword, $search_keyword);

        // Execute the query
        mysqli_stmt_execute($stmt);
        $result_query = mysqli_stmt_get_result($stmt);

        // Check if there are any search results
        if (mysqli_num_rows($result_query) == 0) {
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
            while ($row = mysqli_fetch_assoc($result_query)) {
                $product_id = $row['id'];
                $product_name = $row['product_name'];
                $product_price = $row['product_price'];
                $product_image = $row['product_image_1'];
                $product_in_store = $row['product_in_store'];

                // Output HTML code to display product
                echo "<div class='col-lg-3 col-sm-6'>
                        <div class='new-arrival-box'>
                            <a href='shop-single.php?id=$product_id'>
                                <div class='image'>
                                    <img src='./admin_area/product_images/$product_image' alt='$product_name'>";
                if ($product_in_store <= 0) {
                    echo "<div class='sale-btn'>
                                            <span class='btn read-more'>out of stock</span>
                                        </div>";
                }
                echo "
                                </div>
                                <div class='content'>
                                    <h4 class='heading'>$product_name</h4>
                                    <div class='price-tag'>
                                        <ins><span class='price-symbol'>Rs.</span><span>$product_price</span></ins>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>";
            }
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "<section class='search-result-section pb-5 mb-sm-5'>
                <div class='container'>
                    <div class='content'>
                        <h4 class='heading'>No search Results</h4>
                        <p>Please enter a search keyword.</p>
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
    }
}

function allproduct($start, $limit)
{
    global $conn;
    $sql_query = "SELECT * FROM `products` LIMIT $start, $limit";
    $result = mysqli_query($conn, $sql_query);

    while ($row = mysqli_fetch_assoc($result)) {
        $product_id = $row['id'];
        $product_name = $row['product_name'];
        $product_price = $row['product_price'];
        $product_image = $row['product_image_1'];
        $product_in_store = $row['product_in_store'];

        echo "<div class='col-lg-3 col-sm-6'>
        <div class='new-arrival-box'>
            <a href='shop-single.php?id=$product_id'>
            <div class='image'>
                <img src='./admin_area/product_images/$product_image' alt='$product_name'>";
        if ($product_in_store <= 0) {
            echo "<div class='sale-btn'>
                        <span class='btn read-more'>out of stock</span>
                    </div>";
        }
        echo "
            </div>
            <div class='content'>
                    <h4 class='heading'>$product_name</h4>
                    <div class='price-tag'>";
        echo "<ins><span class='price-symbol'>Rs.</span><span>$product_price</span></ins>
                        </div>
                    </div>
            </a>
                </div>
            </div>";
    }
}


function productdetail()
{
    global $conn;
    $quantity = 1;

    if (isset($_POST["shop_single_add_to_cart"])) {
        if (!isset($_SESSION["userid"])) {
            echo "<script>alert('Please log in to add items to the cart');</script>";
            echo "<script>window.open('./user_area/login-user.php','_self');</script>";
            return;
        }

        $get_product_id = $_GET['id'];
        $quantity = $_POST['quantity'];
        $userid = $_SESSION["userid"];

        $sql = "SELECT * FROM `cart_details` WHERE userid = '$userid' AND product_id = $get_product_id";
        $result = mysqli_query($conn, $sql);
        $num_of_rows = mysqli_num_rows($result);

        // Retrieve product_in_store from the database
        $product_in_store = 0;
        $query_store = "SELECT product_in_store FROM products WHERE id = '$get_product_id'";
        $result_store = mysqli_query($conn, $query_store);
        if ($row_store = mysqli_fetch_assoc($result_store)) {
            $product_in_store = $row_store['product_in_store'];
        }

        if ($num_of_rows > 0) {
            echo "<script>alert('Item already in cart');</script>";
        } else {
            if ($quantity > $product_in_store) {
                echo "<script>alert('You have exceeded the quantity in store');</script>";
            } else {
                $insert_query = "INSERT INTO `cart_details` (product_id, userid, quantity) VALUES ($get_product_id, '$userid', $quantity)";
                $result_query = mysqli_query($conn, $insert_query);

                if ($result_query) {
                    echo "<script>alert('Item added to cart successfully');</script>";
                } else {
                    echo "<script>alert('Error adding item to cart');</script>";
                }
            }
        }
    }

    if (isset($_GET['id'])) {
        $product_id = $_GET['id'];

        $sql_query = "SELECT products.*, tags.tag_name, categories.category_name 
                      FROM products 
                      INNER JOIN tags ON products.tag_id = tags.id 
                      INNER JOIN categories ON products.category_id = categories.id
                      WHERE products.id = '$product_id'";

        $result = mysqli_query($conn, $sql_query);
        while ($row = mysqli_fetch_assoc($result)) {
            $product_id = $row['id'];
            $product_name = $row['product_name'];
            $product_description = $row['product_description'];
            $product_price = $row['product_price'];
            $product_image_1 = $row['product_image_1'];
            $product_image_2 = $row['product_image_2'];
            $tags = $row['tag_name'];
            $category = $row["category_name"];
            $product_in_store = $row['product_in_store'];
            $category_id = $row['category_id'];
            $tag_id = $row['tag_id'];

            echo "<section class='single-banner bg-light-white margin-top-header'>
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
                                        </div>
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
                                            <ins><span class='price-symbol'>Rs.</span><span>{$product_price}</span></ins>
                                        </div>
                                    </div>
                                    <div class='product-price-description product-box-list'>
                                        <p>{$product_description}</p>
                                    </div>
                                    <div class='product-price-input product-box-list'>
                                        <form action='' method='post'>";

            if ($product_in_store <= 0) {
                echo "<span class='out-of-stock'>Out of stock</span>";
            } else {
                echo "<div class='product-number position-relative d-flex'>
                                                <div class='d-xl-none product-btn plus'>+</div>
                                                <input type='number' name='quantity' min='1' max='{$product_in_store}' value='1' class='quantity-product'>
                                                <div class='d-xl-none product-btn minus'>-</div>
                                            </div>
                                            <input type='submit' name='shop_single_add_to_cart' value='ADD TO CART' class='read-more'>";
            }

            echo "</form>
                                        </div>
                    <div class='product-price-detail-category'>
                        <div class='d-flex gap-2 align-items-center'>
                            <h5 class='heading'>Category:</h5>
                            <a href='category.php?cat_id={$category_id}'>{$category}</a>
                        </div>
                        <div class='d-flex gap-2 align-items-center'>
                            <h5 class='heading'>Tags:</h5>
                            <div class='d-flex gap-1'>
                                <a href='tag.php?tag_id={$tag_id}'>{$tags}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>";
        }
    }
}




function cart()
{
    global $conn;

    if (isset($_POST['add_to_cart'])) {
        $userid = $_SESSION["userid"];
        $product_id = $_POST['add_to_cart'];

        // Check if the item is already in the cart
        $check_query = "SELECT * FROM `cart_details` WHERE userid = '$userid' AND product_id = $product_id";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            // Item already in cart
            echo "Item already in cart";
        } else {
            // Insert the item into the cart
            $insert_query = "INSERT INTO `cart_details` (product_id, userid, quantity) VALUES ($product_id, '$userid', 1)";
            $insert_result = mysqli_query($conn, $insert_query);

            if ($insert_result) {
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

function total_product_cart()
{
    if (isset($_SESSION["userid"])) {
        global $conn;
        $userid = $_SESSION["userid"];

        $sql = "SELECT * FROM `cart_details` WHERE userid = '$userid'";
        $result = mysqli_query($conn, $sql);
        $num_of_sqli = mysqli_num_rows($result);

        echo $num_of_sqli;
    } else {
        echo "0"; // If userid is not set, return 0
    }
}



function displayCart()
{
    global $conn;

    $userid = $_SESSION["userid"];
    $cart_query = "SELECT cd.product_id, cd.quantity, p.product_image_1, p.product_price, p.product_name, p.product_in_store FROM cart_details cd JOIN products p ON cd.product_id = p.id WHERE cd.userid='$userid'";
    $run_cart = mysqli_query($conn, $cart_query);

    $total = 0;

    if (isset($_GET['remove_product'])) {
        $product_id_to_remove = $_GET['remove_product'];
        if (isset($_GET['confirm_delete'])) {
            $sql = "DELETE FROM cart_details WHERE product_id = $product_id_to_remove AND userid = '$userid'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>alert('Product with ID $product_id_to_remove removed successfully')</script>";
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
            $update_cart_query = "UPDATE cart_details SET quantity = $quantity WHERE product_id = $product_id AND userid = '$userid'";
            $update_result = mysqli_query($conn, $update_cart_query);
            if (!$update_result) {
                echo "<script>alert('Failed to update quantity.')</script>";
            }
        }
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
                                <tr>
                                    <th class='product-remove'></th>
                                    <th class='product-thumbnail'>Image</th>
                                    <th class='product-name'>Product Name</th>
                                    <th class='product-price'>Price</th>
                                    <th class='product-quantity'>Quantity</th>
                                    <th class='product-subtotal'>Total</th>
                                </tr>
                            </thead>
                            <tbody>";

        while ($row_cart = mysqli_fetch_array($run_cart)) {
            $pro_id = $row_cart['product_id'];
            $quantity = $row_cart['quantity'];
            $image = $row_cart['product_image_1'];
            $price = $row_cart['product_price'];
            $product_name = $row_cart['product_name'];
            $product_in_store = $row_cart['product_in_store'];

            echo "<tr>
                    <td class='product-remove'>
                        <a href='{$_SERVER['PHP_SELF']}?remove_product=$pro_id&confirm_delete' onclick='return confirm(\"Are you sure you want to delete this product?\")'>x</a>
                    </td>
                    <td class='product-thumbnail'>
                        <img src='./admin_area/product_images/$image' alt='$product_name'>
                    </td>
                    <td class='product-name'>
                        $product_name
                    </td>
                    <td class='product-price'>
                        <span class='price-symbol'>Rs.</span> $price
                    </td>
                    <td class='product-quantity'>
                        <input type='number' min='1' max='$product_in_store' value='$quantity' class='quantity-product' name='qty[$pro_id]' onchange='validateQuantity(this, $product_in_store)'>
                    </td>
                    <td class='product-subtotal'>
                        <span class='price-symbol'>Rs.</span> " . ($price * $quantity) . "
                    </td>
                </tr>";
            $total += ($price * $quantity);
        }

        echo "
        <tr>
            <td class='text-end pt-5' colspan='6'>
            <input type='submit' name='update_cart' class='btn read-more checkout-btn' value='Update Cart'>
            </td> 
        </tr> 
        </tbody></table>
              <div class='cart-collaterals margin-bottom-cart'>
                <div class='row justify-content-end'>
                    <div class='col-sm-6'>
                        <h2 class='heading underline'>Cart totals</h2>
                        <table>
                            <tbody>
                                <tr class='cart-subtotal'>
                                    <th>Subtotal</th>
                                    <td><span class='price-symbol'>Rs.</span> $total</td>
                                </tr>
                                <tr class='order-total'>
                                    <th>Total</th>
                                    <td><strong><span class='price-symbol'>Rs.</span> $total</strong></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class='proceed-to-checkout'>
                            <a href='./user_area/order.php?user_id=$userid' class='btn read-more checkout-btn'>Proceed to checkout</a>
                        </div>
                    </div>
                </div>
              </div>
              </form>
              </div>
              </section>";
    } else {
        echo "<section class='section-gap'>
                <div class='container'>
                    <h2 class='heading underline center text-center'>Your shopping cart is empty.</h2>
                    <p class='lead text-center'>Add some products to your cart before proceeding. You can also browse our collection of items or visit our shop page for more options.</p>
                </div>
            </section>";
    }

    // JavaScript code for quantity validation
    echo "<script>
        function validateQuantity(input, maxQty) {
            if (parseInt(input.value) > maxQty) {
                alert('Cannot exceed available stock (' + maxQty + ')');
                input.value = maxQty; // Set the quantity to maximum allowed
            }
        }
        </script>";
}

// function totalcart

function total_price_cart()
{
    global $conn;
    $total = 0;
    $userid = $_SESSION["userid"];
    $cart_query = "SELECT * FROM `cart_details` WHERE userid='$userid'";
    $run_cart = mysqli_query($conn, $cart_query);

    while ($row = mysqli_fetch_array($run_cart)) {
        $product_id = $row["product_id"];
        $select_products = "SELECT * FROM `products` WHERE id ='$product_id'";
        $result_products = mysqli_query($conn, $select_products);
        while ($row_products_price = mysqli_fetch_array($result_products)) {
            $product_price = array($row_products_price['product_price']);
            $product_value = array_sum($product_price);
            $total += $product_value;
        }
    }

    echo $total;
}


function user_order()
{
    global $conn;
    $username = $_SESSION["username"];
    $get_details = "SELECT * FROM `user_table` WHERE user_name = '$username'";
    $result_detail = mysqli_query($conn, $get_details);

    // Initialize a variable to keep track of whether the pending order message has been displayed
    $pending_order_displayed = false;

    while ($row_query = mysqli_fetch_array($result_detail)) {
        $user_id = $row_query["user_id"];

        if (!isset($_GET['edit_account']) && !isset($_GET['user_order']) && !isset($_GET['delete_account'])) {
            $get_order = "SELECT * FROM `user_order` WHERE user_id = $user_id AND order_status = 'pending'";
            $result_order_query = mysqli_query($conn, $get_order);
            $row_count = mysqli_num_rows($result_order_query);

            if ($row_count > 0 && !$pending_order_displayed) {
                echo "<div class='pending-order-fn'>
                    <h3 class='heading text-center '>You have <span>$row_count</span> pending orders</h3>
                    <p class='text-center'><a href='../user_area/profile.php?user_order'>Order Details</a></p>
                </div>";
                // Set the flag to true to indicate that the pending order message has been displayed
                $pending_order_displayed = true;
            } elseif (!$pending_order_displayed) {
                echo "<div class='pending-order-fn'>
                    <h3 class='heading text-center '>You have <span>$row_count</span> pending orders</h3>
                    <p class='text-center'><a href='../index.php'>Explore products  </a></p>
                </div>";
                // Set the flag to true to indicate that the pending order message has been displayed
                $pending_order_displayed = true;
            }
        }
    }
}

function category_list()
{
    global $conn;

    if (isset($_GET['cat_id'])) {
        $cat_id = $_GET['cat_id'];

        $sql_query = "SELECT * FROM `products` where category_id = $cat_id ";
        $result = mysqli_query($conn, $sql_query);

        while ($row = mysqli_fetch_assoc($result)) {
            $product_id = $row['id'];
            $product_name = $row['product_name'];
            $product_price = $row['product_price'];
            $product_image = $row['product_image_1'];
            $product_in_store = $row['product_in_store'];

            // $filled_stars = floor($product_rating); 

            // Output HTML code to display product
            echo "<div class='col-lg-3 col-sm-6'>
            <div class='new-arrival-box'>
                <a href='shop-single.php?id=$product_id'>
                <div class='image'>
                    <img src='./admin_area/product_images/$product_image' alt='$product_name'>";
            if ($product_in_store <= 0 || $product_in_store == 1) {
                echo "<div class='sale-btn'>
                            <span class='btn read-more'>out of stock</span>
                        </div>";
            }
            echo "
                </div>
                <div class='content'>
                        <h4 class='heading'>$product_name</h4>
                        <div class='price-tag'>";

            echo "<ins><span class='price-symbol'>Rs.</span><span>$product_price</span></ins>
                            </div>
                        </div>
                </a>
                    </div>
                </div>";
        }
    }
}
function tag_list()
{
    global $conn;

    if (isset($_GET['tag_id'])) {
        $tag_id = $_GET['tag_id'];

        $sql_query = "SELECT * FROM `products` where tag_id = $tag_id ";
        $result = mysqli_query($conn, $sql_query);

        while ($row = mysqli_fetch_assoc($result)) {
            $product_id = $row['id'];
            $product_name = $row['product_name'];
            $product_price = $row['product_price'];
            $product_image = $row['product_image_1'];
            $product_in_store = $row['product_in_store'];

            // $filled_stars = floor($product_rating); 

            // Output HTML code to display product
            echo "<div class='col-lg-3 col-sm-6'>
            <div class='new-arrival-box'>
                <a href='shop-single.php?id=$product_id'>
                <div class='image'>
                    <img src='./admin_area/product_images/$product_image' alt='$product_name'>";
            if ($product_in_store <= 0 || $product_in_store == 1) {
                echo "<div class='sale-btn'>
                            <span class='btn read-more'>out of stock</span>
                        </div>";
            }
            echo "
                </div>
                <div class='content'>
                        <h4 class='heading'>$product_name</h4>
                        <div class='price-tag'>";

            echo "<ins><span class='price-symbol'>Rs.</span><span>$product_price</span></ins>
                            </div>
                        </div>
                </a>
                    </div>
                </div>";
        }
    }
}

function isotop_category() {
    global $conn;
    
    // Retrieve all categories
    $sql_query = "SELECT * FROM `categories`";
    $result = mysqli_query($conn, $sql_query);
    
    echo "<div id='isotope-filters' class='isotope-filters'>";
    echo "<button class='active' data-filter='*'>All</button>";
    
    while ($row = mysqli_fetch_assoc($result)) {
        $cat_id = $row['id'];
        $cat_name = $row['category_name'];
        
        // Output category filter button
        echo "<button data-filter='.cat-$cat_id'>$cat_name</button>";
    }
    
    echo "</div>"; // End of isotope filters
    
    // Retrieve and display products based on category
    $sql_query = "SELECT * FROM `products`";
    $result = mysqli_query($conn, $sql_query);
    
    echo "<div id='isotope-container' class='row'>";
    
    while ($row = mysqli_fetch_assoc($result)) {
        $product_id = $row['id'];
        $product_name = $row['product_name'];
        $product_price = $row['product_price'];
        $product_image = $row['product_image_1'];
        $product_in_store = $row['product_in_store'];
        $cat_id = $row['category_id'];
        
        // Output product HTML
        echo "<div class='col-lg-3 col-sm-6 isotope-item cat-$cat_id'>
                <div class='new-arrival-box'>
                    <a href='shop-single.php?id=$product_id'>
                        <div class='image'>
                            <img src='./admin_area/product_images/$product_image' alt='$product_name'>";
        
        if ($product_in_store <= 0 || $product_in_store == 1) {
            echo "<div class='sale-btn'>
                      <span class='btn read-more'>Out of Stock</span>
                  </div>";
        }
        
        echo        "</div>
                    <div class='content'>
                        <h4 class='heading'>$product_name</h4>
                        <div class='price-tag'>
                            <ins><span class='price-symbol'>Rs.</span><span>$product_price</span></ins>
                        </div>
                    </div>
                    </a>
                </div>
            </div>";
    }
    
    echo "</div>"; // End of isotope container
}


?>