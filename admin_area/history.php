<?php
include ("../include/connect_database.php");

function getOrderHistory($conn, $days)
{
    $date_filter = date('Y-m-d H:i:s', strtotime("-$days days"));
    // SQL query with JOINs to get product name and user name
    $sql = "SELECT 
                uo.order_id as order_id, 
                u.user_name, 
                p.product_name, 
                uo.amount_due, 
                uo.invoice_number, 
                uo.total_products, 
                uo.order_date, 
                uo.order_status 
            FROM 
                user_order uo 
            JOIN 
                user_table u ON uo.user_id = u.user_id 
            JOIN 
                products p ON uo.product_id = p.id 
            WHERE 
                uo.order_date >= '$date_filter'";
    $result = mysqli_query($conn, $sql);

    return $result;
}

$selected_days = 7; // Default to 7 days
if (isset($_POST['filter'])) {
    $selected_days = $_POST['days'];
}

// Fetch order history for the selected date range
$orders = getOrderHistory($conn, $selected_days);
?>

<section>
    <div class="container">
        <div class="main-title">
            <h1 class="title">Order History</h1>
        </div>
    </div>
</section>

<section class="filter-form py-3">
    <div class="container">
        <!-- Filter Form -->
        <form method="post" action="" class="d-flex gap-2 align-items-center">
            <label for="days">Select Date Range:</label>
            <select name="days" id="days" class="form-control w-25">
                <option value="7" <?php if ($selected_days == 7)
                    echo 'selected'; ?>>Last 7 Days</option>
                <option value="30" <?php if ($selected_days == 30)
                    echo 'selected'; ?>>Last 1 Month</option>
                <option value="90" <?php if ($selected_days == 90)
                    echo 'selected'; ?>>Last 3 Months</option>
                <option value="365" <?php if ($selected_days == 365)
                    echo 'selected'; ?>>Last 1 Year</option>
            </select>
            <input type="submit" name="filter" class="btn btn-primary" value="Filter">
        </form>
    </div>
</section>

<section class="history-table">
    <div class="container">
        <h2 class="title text-center mb-4">Order History for the Last <?php echo $selected_days; ?> Days</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User Name</th>
                    <th>Product Name</th>
                    <th>Amount Due</th>
                    <th>Invoice Number</th>
                    <th>Total Products</th>
                    <th>Order Date</th>
                    <th>Order Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($orders)) { ?>
                    <tr>
                        <td><?php echo $row['order_id']; ?></td>
                        <td><?php echo $row['user_name']; ?></td>
                        <td><?php echo $row['product_name']; ?></td>
                        <td><?php echo $row['amount_due']; ?></td>
                        <td><?php echo $row['invoice_number']; ?></td>
                        <td><?php echo $row['total_products']; ?></td>
                        <td><?php echo $row['order_date']; ?></td>
                        <td><?php echo $row['order_status']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>