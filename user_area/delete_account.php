<section class="delete_account text-center">
    <div class="container">
        <h3 class="heading">Delete Account</h3>
        <form action="" method="post" class="mt-5">
            <div class="form-outline mb-4">
                <input type="submit" class="w-50 m-auto form-control" name="delete" value="delete">
            </div>
            <div class="form-outline mb-4">
                <input type="submit" class="w-50 m-auto form-control" name="dont_delete" value="dont delete account">
            </div>
        </form>
    </div>
</section>

<?php

$username = $_SESSION["username"];

if (isset($_POST['delete'])) {
    $delete_user = "DELETE FROM user_table WHERE user_name= '$username'";
    $result = mysqli_query($conn, $delete_user);

    if ($result) {
        session_destroy();
        echo "<script>alert('Account deleted')</script>";
        echo "<script>window.open('../index.php','_self')</script>";
    }
}
if (isset($_POST['delete'])) {
    echo "<script>widow.open('profile.php','_self')</script>";
}

?>