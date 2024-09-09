<?php

$dynamicTitle = "category";
include("header.php");
// include("function/commonfunction.php");
include('include/connect_database.php');

if (isset($_GET['cat_id'])) {
    $category_id = intval($_GET['cat_id']); // Ensure category_id is an integer for security

    // Fetch the category name from the database
    $select = "SELECT category_name FROM categories WHERE id = $category_id";
    $result = mysqli_query($conn, $select);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $category_name = htmlspecialchars($row['category_name']); // Sanitize the output
    } else {
        // Handle case where the category is not found
        $category_name = "Unknown category";
    }
} else {
    // Handle case where no category_id is provided
    $category_name = "No category Selected";
}

?>

<section class="single-banner bg-light-white margin-top-header">
    <div class="container">
        <div class="content">
            <h1 class="heading">Category item</h1>
            <div class="breadcrumb m-0">
                <a href="index.php">Home</a>
                <span>/</span>
                <span><?php echo $category_name; ?></span>
            </div>
        </div>
    </div>
</section>

<section class="category-list section-gap">
    <div class="container">
        <div class="main-title text-center pb-5">
            <h2 class="title">Category List</h2>
        </div>
        <div class="row">
            <?php
            category_list()
            ?>
        </div>
    </div>
</section>
<?php
    include ('footer.php');
?>
