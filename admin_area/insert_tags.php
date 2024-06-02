<?php 
include('../include/connect_database.php');

// if(isset($_POST['edit_tag'])) {
//     $tag_id = $_POST['tag_id'];
//     // Handle edit operation
//     // Redirect or display a message after updating the tag
// }

if(isset($_POST['delete_tag'])) {
    $tag_id = $_POST['tag_id'];
    $delete_query = "DELETE FROM tags WHERE id = $tag_id";
    $delete_result = mysqli_query($conn, $delete_query);
    if($delete_result) {
        // Tag deleted successfully
        // Redirect or display a success message
    } else {
        // Error deleting tag
        echo "Error: " . mysqli_error($conn);
    }
}

if(isset($_POST['insert_tag'])){
    $tag_name = $_POST['tag'];
    
    $check_query = "SELECT * FROM tags WHERE tag_name = '$tag_name'";
    $check_result = mysqli_query($conn, $check_query);
    $number = mysqli_num_rows($check_result);

    if ($number > 0){
        echo "<script>alert('Tag is already in the database');</script>";
    } else {
        $insert_query = "INSERT INTO tags (tag_name) VALUES ('$tag_name')";
        $insert_result = mysqli_query($conn, $insert_query);
        
        if(!$insert_result){
            echo "Error: " . mysqli_error($conn) . "<br>";
        } else {
            echo "<script>console.log('$tag_name is inserted')</script>";
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
                    $select = "SELECT * FROM  `tags`";
                    $result = mysqli_query($conn, $select);
                    
                    while ($data=mysqli_fetch_array($result)) { ?>
                        <tr>
                            <td><?=$data["id"] ?></td>
                            <td><?=$data["tag_name"] ?></td>
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="tag_id" value="<?php echo $data['id']; ?>">
                                    <button type="submit" name="delete_tag" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this tag?')">Delete</button>
                                    <a href="index.php?edit_tags=<?php echo $data["id"] ?>" class="btn btn-success btn-sm">Edit</a>
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
                    <label for="tag">Add Tag: <span class="required">*</span></label>
                    <input type="text" name="tag" class="form-control">
                </div>
                <input type="submit" value="Insert Value" class="btn btn-primary" name="insert_tag">
            </form>
        </div>
    </div>
</div>
