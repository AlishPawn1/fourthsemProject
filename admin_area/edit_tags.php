<?php

if(isset($_GET['edit_tags'])){
    $tag_id = $_GET['edit_tags'];

    $select_query = "SELECT * FROM tags WHERE id=$tag_id";
    $result = mysqli_query($conn, $select_query);
    $row = mysqli_fetch_assoc($result);
    $tag_name = $row['tag_name'];
}

if(isset($_POST['update_tag'])) {
    $tag_id = $_GET['edit_tags'];
    $tag_name = $_POST['edit_tag'];

    // Escaping special characters to prevent SQL injection
    // $cat_name = mysqli_real_escape_string($conn, $cat_name);

    $update_query = "UPDATE tags SET tag_name='$tag_name' WHERE id=$tag_id";
    $result = mysqli_query($conn, $update_query);

    if($result){
        echo "<script>alert('tag is updated')</script>";
    } else{
        echo "<script>alert('Error')</script>";
    }
}

?>

<div class="section-gaps edit-tag">
    <div class="container">
        <h1 class="heading text-center mb-5">Edit tag</h1>
        <form action="" method="post" class=" m-auto w-50">
            <div class="form-group">
                <label for="edit_category">Edit tag</label>
                <input type="text" name="edit_tag" value="<?php echo $tag_name?>" class="form-control" id="edit_tag">
            </div>
            <input type="submit" name="update_tag" value="Update tag" class="btn btn-success">
        </form>
    </div>
</div>
