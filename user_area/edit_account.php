<?php 
if(isset($_GET['edit_account'])) {
    $username = $_SESSION["username"];
    $select_query = "select * from `user_table` where user_name = '$username'";
    $result_query = mysqli_query($conn, $select_query);
    $row_query = mysqli_fetch_array($result_query);
    $user_id = $row_query['user_id'];
    $user_name = $row_query['user_name'];
    $user_email = $row_query['user_email'];
    $user_address = $row_query['user_address'];
    $user_mobile = $row_query['user_mobile'];
    $user_image = $row_query['user_image']; // Existing user image

    if(isset($_POST['user_update'])){
        $update_id = $user_id;
        $user_name = $_POST['user_name'];
        $user_email = $_POST['user_email'];
        $user_address = $_POST['user_address'];
        $user_mobile = $_POST['user_mobile'];
        $user_image = $_FILES['user_image']['name']; // New user image
        $user_image_temp = $_FILES['user_image']['tmp_name'];

        // Check if a new image has been uploaded
        if(!empty($user_image)) {
            // Move the uploaded image to the appropriate directory
            move_uploaded_file($user_image_temp, "./user_image/$user_image");
        } else {
            // If no new image is uploaded, retain the existing image
            $user_image = $row_query['user_image'];
        }

        // Update query
        $update_data = "UPDATE `user_table` SET user_name = '$username', user_email = '$user_email', user_address = '$user_address', user_mobile = $user_mobile, user_image = '$user_image' WHERE user_id = $user_id";
        $result_query = mysqli_query($conn, $update_data);

        if($result_query){
            echo "<script>alert('Data updated successfully')</script>";
        }
    }
}
?>


<section class="edit-account">
    <div class="edit_form">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-outline">
                <input type="text" class="form-input" value="<?php echo $user_name?>" name="user_name">
            </div>
            <div class="form-outline">
                <input type="email" class="form-input" value="<?php echo $user_email?>" name="user_email">
            </div>
            <div class="form-outline mb-1">
                <input type="file" class="form-control" name="user_image">
                <img src='./user_image/<?php echo "$user_image"?>' alt='$username'>
            </div>
            <div class="form-outline">
                <input type="text" class="form-input" value="<?php echo $user_address?>" name="user_address">
            </div>
            <div class="form-outline">
                <input type="text" class="form-input" value="<?php echo $user_mobile?>" name="user_mobile">
            </div>
            <input type="submit" class="read-more btn" value="update" name="user_update">
        </form>
    </div>
</section>