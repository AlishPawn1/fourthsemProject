<?php
include '../include/connect_database.php';

// $menu = "CREATE TABLE menu(
//    id INT AUTO_INCREMENT PRIMARY KEY,
//    menu_name VARCHAR(50) NOT NULL,
//    menu_url VARCHAR(255)
// )";
// $sub_menu = "CREATE TABLE sub_menu(
//    id INT AUTO_INCREMENT PRIMARY KEY,
//    menu_id INT,
//    sub_menu_name VARCHAR(50) NOT NULL,
//    sub_menu_url VARCHAR(255),
//    FOREIGN KEY (menu_id) REFERENCES menu(id) ON DELETE CASCADE
// )";
// $sub_sub_menu = "CREATE TABLE sub_sub_menu(
//    id INT AUTO_INCREMENT PRIMARY KEY,
//    menu_id INT,
//    sub_menu_id INT,
//    sub_sub_menu_name VARCHAR(50) NOT NULL,
//    sub_sub_menu_url VARCHAR(255),
//    FOREIGN KEY (menu_id) REFERENCES menu(id) ON DELETE CASCADE,
//    FOREIGN KEY (sub_menu_id) REFERENCES sub_menu(id) ON DELETE CASCADE
// )";
// $products  = "CREATE TABLE products(
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     product_name VARCHAR(100) NOT NULL,
//     product_description VARCHAR(255),
//     tag_id INT,
//     category_id INT,
//     product_image_id INT,
//     product_option VARCHAR(50),
//     product_price DECIMAL(10, 2),
//     discounted_product_price DECIMAL(10, 2),
//     product_rating INT,
//     FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE,
//     FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE,
//     FOREIGN KEY (product_image_id) REFERENCES images(id) ON DELETE CASCADE
// )";

// $tags = "CREATE TABLE tags(
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     product_id INT,
//     tag_name VARCHAR(100),
//     FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
// )";
// $categories = "CREATE TABLE categories(
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     product_id INT,
//     category_name VARCHAR(100),
//     FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
// )";
// $product_images = "CREATE TABLE images(
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     product_id INT,
//     image_path VARCHAR(255),
//     is_main BOOLEAN DEFAULT FALSE,
//     FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
// )";



// $menu = "CREATE TABLE menu(
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     menu_name VARCHAR(50) NOT NULL,
//     menu_url VARCHAR(255),
//     menu_select VARCHAR(100)
//  )";
//  $sub_menu = "CREATE TABLE sub_menu(
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     menu_id INT,
//     sub_menu_name VARCHAR(50) NOT NULL,
//     sub_menu_url VARCHAR(255),
//     FOREIGN KEY (menu_id) REFERENCES menu(id) ON DELETE CASCADE
//  )";
//  $sub_sub_menu = "CREATE TABLE sub_sub_menu(
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     menu_id INT,
//     sub_menu_id INT,
//     sub_sub_menu_name VARCHAR(50) NOT NULL,
//     sub_sub_menu_url VARCHAR(255),
//     FOREIGN KEY (menu_id) REFERENCES menu(id) ON DELETE CASCADE,
//     FOREIGN KEY (sub_menu_id) REFERENCES sub_menu(id) ON DELETE CASCADE
//  )";
//  $products  = "CREATE TABLE products(
//      id INT AUTO_INCREMENT PRIMARY KEY,
//      product_name VARCHAR(100) NOT NULL,
//      product_description VARCHAR(255),
//      tag_id INT,
//      category_id INT,
//      product_image_id INT,
//      product_option VARCHAR(50),
//      product_price DECIMAL(10, 2),
//      discounted_product_price DECIMAL(10, 2),
//      product_rating INT,
//      FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE,
//      FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE,
//      FOREIGN KEY (product_image_id) REFERENCES images(id) ON DELETE CASCADE
//  )";
 
//  $tags = "CREATE TABLE tags(
//      id INT AUTO_INCREMENT PRIMARY KEY,
//      tag_name VARCHAR(100)
//  )";
//  $categories = "CREATE TABLE categories(
//      id INT AUTO_INCREMENT PRIMARY KEY,
//      category_name VARCHAR(100)
//  )";
//  $product_images = "CREATE TABLE images(
//      id INT AUTO_INCREMENT PRIMARY KEY,
//      image_path VARCHAR(255),
//      is_main BOOLEAN DEFAULT FALSE
//  )";
// $cart = "
// CREATE TABLE cart (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     product_id INT,
//     product_name VARCHAR(255),
//     price DECIMAL(10, 2),
//     quantity INT,
//     total DECIMAL(10, 2)
// )";




// CREATE TABLE menu (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     menu_name VARCHAR(50) NOT NULL,
//     menu_url VARCHAR(255)
// );

// CREATE TABLE sub_menu (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     menu_id INT,
//     sub_menu_name VARCHAR(50) NOT NULL,
//     sub_menu_url VARCHAR(255),
//     FOREIGN KEY (menu_id) REFERENCES menu(id) ON DELETE CASCADE
// );

// CREATE TABLE sub_sub_menu (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     menu_id INT,
//     sub_menu_id INT,
//     sub_sub_menu_name VARCHAR(50) NOT NULL,
//     sub_sub_menu_url VARCHAR(255),
//     FOREIGN KEY (menu_id) REFERENCES menu(id) ON DELETE CASCADE,
//     FOREIGN KEY (sub_menu_id) REFERENCES sub_menu(id) ON DELETE CASCADE
// );

// CREATE TABLE tags (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     tag_name VARCHAR(100)
// );

// CREATE TABLE categories (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     category_name VARCHAR(100)
// );

// CREATE TABLE images (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     image_path VARCHAR(255),
//     is_main BOOLEAN DEFAULT FALSE
// );

// CREATE TABLE products (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     product_name VARCHAR(100) NOT NULL,
//     product_description VARCHAR(255),
//     tag_id INT,
//     category_id INT,
//     product_image_id INT,
//     product_option VARCHAR(50),
//     product_price DECIMAL(10, 2),
//     discounted_product_price DECIMAL(10, 2),
//     product_rating INT,
//     FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE,
//     FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE,
//     FOREIGN KEY (product_image_id) REFERENCES images(id) ON DELETE CASCADE
// );
// CREATE TABLE cart (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     product_id INT,
//     product_name VARCHAR(255),
//     price DECIMAL(10, 2),
//     quantity INT,
//     total DECIMAL(10, 2)
// );
// CREATE TABLE cart_details (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     product_id INT NOT NULL,
//     ip_address VARCHAR(255) NOT NULL,
//     quantity INT NOT NULL DEFAULT 0,
//     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
// );



mysqli_query($conn, $menu);
mysqli_query($conn, $sub_menu);
mysqli_query($conn, $sub_sub_menu);
mysqli_query($conn, $products);
mysqli_query($conn, $categories);
mysqli_query($conn, $tags);
mysqli_query($conn, $product_images);
mysqli_query($conn, $cart);

// Check for errors
if(mysqli_errno($conn)) {
    echo "Error creating tables: " . mysqli_error($conn);
} else {
    echo "Tables created successfully!";
}

// Close the connection
mysqli_close($conn);
?>


<!-- $products  = "CREATE TABLE products(
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(100) NOT NULL,
    product_description VARCHAR(255),
    tag_id INT,
    category_id INT,
    product_image_id INT,
    product_price DECIMAL(10, 2),
    product_in_store INT,
    FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE,
    FOREIGN KEY (product_image_id) REFERENCES images(id) ON DELETE CASCADE
)"; -->