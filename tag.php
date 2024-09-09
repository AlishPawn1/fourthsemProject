<?php

$dynamicTitle = "tag";
include("header.php");
// include("function/commonfunction.php");
include('include/connect_database.php');

if (isset($_GET['tag_id'])) {
    $tag_id = intval($_GET['tag_id']); // Ensure tag_id is an integer for security

    // Fetch the tag name from the database
    $select = "SELECT tag_name FROM tags WHERE id = $tag_id";
    $result = mysqli_query($conn, $select);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $tag_name = htmlspecialchars($row['tag_name']); // Sanitize the output
    } else {
        // Handle case where the tag is not found
        $tag_name = "Unknown Tag";
    }
} else {
    // Handle case where no tag_id is provided
    $tag_name = "No Tag Selected";
}

?>

<section class="single-banner bg-light-white margin-top-header">
    <div class="container">
        <div class="content">
            <h1 class="heading">Tag item</h1>
            <div class="breadcrumb m-0">
                <a href="index.php">Home</a>
                <span>/</span>
                <span><?php echo $tag_name; ?></span>
            </div>
        </div>
    </div>
</section>

<section class="tag-list section-gap">
    <div class="container">
        <div class="main-title text-center pb-5">
            <h2 class="title">Tag List</h2>
        </div>
        <div class="row">
            <?php
            tag_list(); // Assuming this function outputs the list of items associated with the tag
            ?>
        </div>
    </div>
</section>

<?php

include('footer.php');

?>
