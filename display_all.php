<?php
$dynamicTitle = "All product";
include ("header.php");
include ('function/commonfunction.php');

$limit = 2; // Number of products per page

// Fetch total number of products
$sql = "SELECT COUNT(id) AS total FROM products";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total_products = $row['total'];

// Calculate total pages
$total_pages = ceil($total_products / $limit);

// Get current page from URL, default to 1 if not set
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
if ($page > $total_pages) $page = $total_pages;

$start = ($page - 1) * $limit;

?>


<section class="single-banner bg-light-white margin-top-header">
    <div class="container">
        <h1 class="heading">All Product</h1>
        <div class="breadcrumb m-0">
            <a href="index.php">Home</a>
            <span>/</span>
            <span>All product</span>
        </div>
    </div>
</section>
<section class="pb-5 padding-top-section">
    <div class="container">
        <h3 class="heading underline center text-center">Display all product</h3>
        <div class="row g-xl-5 g-4 ">
            <?php
            allproduct($start, $limit);
            ?>
        </div>
        
        <!-- Pagination -->
        <ul class="pagination">
            <li>
                <a href="?page=<?php echo max(1, $page - 1); ?>" class="page-numbers prev"><</a>
            </li>
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li>
                    <?php if ($i == $page): ?>
                        <span class="page-numbers current"><?php echo $i; ?></span>
                    <?php else: ?>
                        <a href="?page=<?php echo $i; ?>" class="page-numbers"><?php echo $i; ?></a>
                    <?php endif; ?>
                </li>
            <?php endfor; ?>
            <li>
                <a href="?page=<?php echo min($total_pages, $page + 1); ?>" class="page-numbers next">></a>
            </li>
        </ul>
    </div>
</section>

<?php include ("footer.php"); ?>
