<?php
include ('../include/connect_database.php');

// if(isset($_POST['edit_category'])) {
//     $category_id = $_POST['category_id'];
//     // Handle edit operation
//     // Redirect or display a message after updating the category
// }

if (isset($_POST['delete_category'])) {
    $category_id = $_POST['category_id'];
    $delete_query = "DELETE FROM categories WHERE id = $category_id";
    $delete_result = mysqli_query($conn, $delete_query);
    if ($delete_result) {
        // Tag deleted successfully
        // Redirect or display a success message
    } else {
        // Error deleting category
        echo "Error: " . mysqli_error($conn);
    }
}
if (isset($_POST['insert_category'])) {
    $category_name = $_POST['category'];

    $check_query = "SELECT * FROM categories WHERE category_name = '$category_name'";
    $check_result = mysqli_query($conn, $check_query);
    $number = mysqli_num_rows($check_result);

    if ($number > 0) {
        echo "<script>alert('Tag is already in the database');</script>";
    } else {
        $insert_query = "INSERT INTO categories (category_name) VALUES ('$category_name')";
        $insert_result = mysqli_query($conn, $insert_query);

        if (!$insert_result) {
            echo "Error: " . mysqli_error($conn) . "<br>";
        } else {
            echo "<script>console.log('$category_name is inserted')</script>";
        }
    }
}
?>

<div class="row pt-5">
    <div class="col-6">
        <div>
            <table class="table table-bordered">
                <thead>
                    <th>Id</th>
                    <th>Tag Name</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php
                    $select = "SELECT * FROM  `categories`";
                    $result = mysqli_query($conn, $select);

                    while ($data = mysqli_fetch_array($result)) { ?>
                        <tr>
                            <td><?= $data["id"] ?></td>
                            <td><?= $data["category_name"] ?></td>
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="category_id" value="<?php echo $data['id']; ?>">
                                    <button type="submit" name="delete_category" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                    <a class="text-white text-decoration-none btn btn-success btn-sm"
                                        href="index.php?edit_categories=<?php echo $data["id"] ?>">Edit</a>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-6">
        <div>
            <form action="" method="post">
                <div class="form-group">
                    <label for="category">Add category: <span class="required">*</span></label>
                    <input type="text" name="category" class="form-control">
                </div>
                <input type="submit" value="Insert Value" class="btn btn-primary" name="insert_category">
            </form>
        </div>

    </div>
</div>