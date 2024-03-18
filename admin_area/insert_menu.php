<?php 
include('../include/connect_database.php');

// Handle delete menu request
if(isset($_POST['delete_menu'])){
    $menu_id = $_POST['menu_id'];

    // Check if the user has confirmed the deletion
    if(isset($_POST['confirm_delete']) && $_POST['confirm_delete'] === 'yes') {
        $delete_query = "DELETE FROM `menu` WHERE `id` = $menu_id";
        $delete_result = mysqli_query($conn, $delete_query);
        if($delete_result){
            echo "<script>alert('Menu deleted successfully.')</script>";
        } else {
            echo "<script>alert('Failed to delete menu.')</script>";
        }
    }
}

// Add new menu
if(isset($_POST['menu_submit'])){
    $menu_name = $_POST['menu_name'];
    $menu_url = $_POST['menu_url'];
    $menu_select = $_POST['menu_select'];

    $menu_query = "SELECT * FROM `menu` WHERE menu_name = '$menu_name'";
    $result_select = mysqli_query($conn, $menu_query);
    $number = mysqli_num_rows($result_select);
    if($number > 0){
        echo "<script>alert('Menu already exists in the database.')</script>";
    }
    else{
        if(!empty($menu_name) && !empty($menu_url)){
            // Insert the new menu
            $insertqry = "INSERT INTO `menu`(`menu_name`, `menu_url`, `menu_select`) VALUES ('$menu_name', '$menu_url', '$menu_select')";
            $insertres = mysqli_query($conn, $insertqry);
            if($insertres) {
                echo "<script>alert('Your menu is added successfully.');
                        console.log('$menu_name');
                </script>";
            } else {
                echo "<script>alert('Failed to add menu. Please try again.')</script>";
            }
        } else {
            echo "<script>alert('Please enter both menu name and menu URL.')</script>";
        }
    }
}
?>


<div class="row pt-5">
    <div class="col-6">
        <div>
            <h4>Add New menu</h4>
            <table class="table table-bordered">
                <thead>
                    <th>Menu id</th>
                    <th>Menu name</th>
                    <th>Menu link</th>
                    <th>Action</th>
                </thead>
                <tbody>
                <?php 
                    $list_menu = "SELECT * FROM `menu` ORDER BY `id`";
                    $res_menu = mysqli_query($conn, $list_menu);
                    while ($row_menu = mysqli_fetch_assoc($res_menu)) {
                ?>
                    <tr>
                        <td><?php echo $row_menu['id']; ?></td>
                        <td><?php echo $row_menu['menu_name']; ?></td>
                        <td><?php echo $row_menu['menu_url']; ?></td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="menu_id" value="<?php echo $row_menu['id']; ?>">
                                <button type="submit" name="delete_menu" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this menu?')">Delete</button>
                                <input type="hidden" name="confirm_delete" value="yes">
                            </form>
                        </td>
                    </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-6">
        <div>
            <form action="" method="post">
                <div class="form-group">
                    <label for="menu_name">Menu Name</label>
                    <input type="text" class="form-control" name="menu_name" required>
                </div>
                <div class="form-group">
                    <label for="menu_url">Menu Url</label>
                    <input type="text" class="form-control" name="menu_url" required>
                </div>
                <div class="form-group">
                    <select name="menu_select" class="form-control" required>
                        <option value="">select an option</option>
                        <option value="right">right</option>
                        <option value="left">left</option>
                    </select>
                </div>
                <input type="submit" name="menu_submit" class="btn btn-primary" value="Insert menu">
            </form>
        </div>
    </div>
</div>
                    