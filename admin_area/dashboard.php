<?php

$sql_sales = "SELECT SUM(amount_due) AS total_sales FROM user_order WHERE order_status = 'complete'";
$result_sales = mysqli_query($conn, $sql_sales);

$totalSales = 0;
if ($result_sales) {
    $row_sales = mysqli_fetch_assoc($result_sales);
    if ($row_sales) {
        $totalSales = $row_sales['total_sales'];
    }
} else {
    echo "Error: " . mysqli_error($conn);
}

$sql_users = "SELECT COUNT(*) AS total_users FROM user_table";
$result_users = mysqli_query($conn, $sql_users);

$totalUsers = 0;
if ($result_users) {
    $row_users = mysqli_fetch_assoc($result_users);
    if ($row_users) {
        $totalUsers = $row_users['total_users'];
    }
} else {
    echo "Error: " . mysqli_error($conn);
}

$sql_feedback = "SELECT COUNT(*) AS total_feedback FROM contact_message";
$result_feedback = mysqli_query($conn, $sql_feedback);

$totalFeedback = 0;
if ($result_feedback) {
    $row_feedback = mysqli_fetch_assoc($result_feedback);
    if ($row_feedback) {
        $totalFeedback = $row_feedback['total_feedback'];
    }
} else {
    echo "Error: " . mysqli_error($conn);
}
$sql_pending = "SELECT COUNT(*) AS total_pending FROM user_order WHERE order_status = 'pending'";
$result_pending = mysqli_query($conn, $sql_pending);

$total_pending = 0;
if ($result_pending) {
    $row_pending = mysqli_fetch_assoc($result_pending);
    if ($row_pending) {
        $total_pending = $row_pending['total_pending'];
    }
}

// Fetch total complete orders
$sql_complete = "SELECT COUNT(*) AS total_complete FROM user_order WHERE order_status = 'complete'";
$result_complete = mysqli_query($conn, $sql_complete);

$total_complete = 0;
if ($result_complete) {
    $row_complete = mysqli_fetch_assoc($result_complete);
    if ($row_complete) {
        $total_complete = $row_complete['total_complete'];
    }
}
?>

<section class="dashboard-section">
    <div class="container">
        <div class='row g-4'>
            <div class='col-4'>
                <div class='dashboard-box'>
                    <div class="icon">
                        <i class="fa-solid fa-dollar-sign"></i>
                    </div>
                    <div class="content">
                        <h3 class='title'>Total Sales</h3>
                        <span>Rs. <?php echo number_format($totalSales, 2); ?></span>
                    </div>
                </div>
            </div>
            <div class='col-4'>
                <div class='dashboard-box'>
                    <div class="icon">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="content">
                        <h3 class='title'>Total Users</h3>
                        <span><?php echo $totalUsers; ?></span>
                    </div>
                </div>
            </div>
            <div class='col-4'>
                <div class='dashboard-box'>
                    <div class="icon">
                        <i class="fa-solid fa-comments"></i>
                    </div>
                    <div class="content">
                        <h3 class='title'>Feedback</h3>
                        <span><?php echo $totalFeedback; ?></span>
                    </div>
                </div>
            </div>
            <div class='col-4'>
                <div class='dashboard-box'>
                    <div class="icon">
                        <i class="fa-solid fa-hourglass-start"></i>
                    </div>
                    <div class="content">
                        <h3 class='title'>Pending Orders</h3>
                        <span><?php echo $total_pending; ?></span>
                    </div>
                </div>
            </div>
            <div class='col-4'>
                <div class='dashboard-box'>
                    <div class="icon">
                        <i class="fa-regular fa-circle-check"></i>
                    </div>
                    <div class="content">
                        <h3 class='title'>Complete Orders</h3>
                        <span><?php echo $total_complete; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>