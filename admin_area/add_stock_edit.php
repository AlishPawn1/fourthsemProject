<?php
if (isset($_GET['add_stock_edit'])) {
    $product_id = $_GET['add_stock_edit'];
    $select_query = "SELECT * FROM products WHERE id = '$product_id'";
    $result = mysqli_query($conn, $select_query);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $product_name = $row['product_name'];

        // Initialize $add_stock to prevent undefined variable error
        $add_stock = 0;

        if (isset($_POST['submit_stock'])) {
            // Get and sanitize input value
            $add_stock = isset($_POST['add_stock']) ? intval($_POST['add_stock']) : 0;
            // Update stock quantity, quantity_added, and date
            $current_date = date('Y-m-d H:i:s');
            $update_stock_query = "UPDATE products SET product_in_store = product_in_store + $add_stock, quantity_added = $add_stock, stock_update_date = '$current_date' WHERE id = $product_id";
            $update_result = mysqli_query($conn, $update_stock_query);

            // Check if update was successful
            if ($update_result) {
                echo "<script>alert('Stock added successfully.')</script>";
                // Redirect or perform any other action after successful update
            } else {
                echo "<script>alert('Failed to add stock.')</script>";
            }
        }
    } else {
        echo "<script>alert('Failed to fetch product details.')</script>";
    }
}
?>




<section class="section-gaps">
    <div class="container">
        <h1 class="heading text-center">Add stock</h1>
        <form action="" method="post" class="w-50 m-auto">
            <div class="form-group">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" value="<?php echo $product_name; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="add_stock" class="form-label">Add stock</label>
                <input type="number" class="form-control" name="add_stock">
            </div>
            <input type="submit" name="submit_stock" class="btn btn-success" value="Add stock">
        </form>
    </div>
</section>