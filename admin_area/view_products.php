<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<script>
function confirmDelete(product_id) {
    if(confirm("Are you sure you want to delete this product?")) {
        window.location.href = "index.php?delete_product=" + product_id;
    }
}
</script>


<body>
    <section class="section-gaps">
        <div class="container">
            <div class="title text-center">
                <h1 class="heading">view product</h1>
            </div>
            <table class="table table-bordered mt-5">
                <thead>
                    <tr>
                        <th>product id</th>
                        <th>product title</th>
                        <th>product image</th>
                        <th>product price</th>
                        <th>total sold</th>
                        <th>status</th>
                        <th>edit</th>
                        <th>delete</th>
                        <th>quantity left</th>
                    </tr>
                </thead>
                <?php
                $get_product = "SELECT * FROM `products`";
                $result = mysqli_query($conn, $get_product);
                $number = 1; // Initialize the number counter
                while ($row = mysqli_fetch_assoc($result)) {
                    $product_id = $row['id'];
                    $product_title = $row['product_name'];
                    $product_image = $row['product_image_1'];
                    $product_price = $row['product_price'];
                    $status = $row['status'];
                    $product_in_store = $row['product_in_store'];

                    // Query to get the count of pending orders for this product
                    $get_count = "SELECT * FROM `order_pending` WHERE product_id = $product_id"; // Using SUM() to get the total quantity
                    $result_count = mysqli_query($conn, $get_count);
                    $row_count = mysqli_fetch_assoc($result_count); // Fetching the row as an associative array
                    
                    // Check if $row_count is not null before accessing its elements
                    if ($row_count !== null) {
                        $quantity = $row_count['quantity'];
                    } else {
                        $quantity = 0; // Set a default value if $row_count is null
                    }
                
                    // Calculate the total quantity remaining in the store after deducting pending orders
                    $quantity_remaining = $product_in_store - $quantity;
                    ?>
                    <tr class='text-center'>
                        <td data-label='id'>
                            <?php echo $number; ?>
                        </td>
                        <td data-label='title'>
                            <?php echo $product_title; ?>
                        </td>
                        <td data-label='image'><img src='./product_images/<?php echo $product_image; ?>' alt='Product Image'
                                style='width: 100px; height: auto;'></td>
                        <td data-label='price'>
                            <?php echo $product_price; ?>
                        </td>
                        <td data-label='sold'>
                            <?php echo $quantity; ?>
                        </td> <!-- Display the total quantity of pending orders -->
                        <td data-label='status'>
                            <?php echo $status; ?>
                        </td>
                        <td data-label='edit'><a href='index.php?edit_product=<?php echo $product_id ?>' class=''><i
                                    class='fa-solid fa-pen-to-square'></i></a></td>
                        <!-- <td data-label='delete'><a href='index.php?delete_product=<?php echo $product_id ?>' class=''><i class='fa-solid fa-trash'></i></a></td> -->
                        <td data-label='delete'><a href='#' onclick='confirmDelete(<?php echo $product_id ?>)'><i class='fa-solid fa-trash'></i></a></td>
                        <td data-label='total in store'>
                            <?php echo $quantity_remaining; ?>
                        </td> <!-- Display the total quantity remaining in the store -->
                    </tr>
                <?php 
                    $number++; // Increment the counter for the next iteration
                } ?>
                </tbody>
            </table>
        </div>
    </section>
</body>

</html>
