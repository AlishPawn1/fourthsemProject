<?php 
include('../include/connect_database.php');

// Handle delete sub-menu request
if(isset($_POST['delete_menu'])){
    $sub_menu_id = $_POST['sub_menu_id'];

    // Check if the user has confirmed the deletion
    if(isset($_POST['confirm_delete']) && $_POST['confirm_delete'] === 'yes') {
        $delete_query = "DELETE FROM `sub_menu` WHERE `id` = $sub_menu_id";
        $delete_result = mysqli_query($conn, $delete_query);
        if($delete_result){
            echo "<script>alert('Sub-menu deleted successfully.')</script>";
        } else {
            echo "<script>alert('Failed to delete sub-menu.')</script>";
        }
    }
}

// Handle insert sub-menu request
if(isset($_POST['insert_sub_menu'])){
    $menu_id = $_POST['select_menu'];
    $sub_menu_name = $_POST['sub_menu'];
    $sub_menu_url = $_POST['sub_menu_url'];

    $sql = "SELECT * FROM `sub_menu` WHERE sub_menu_name = '$sub_menu_name'";
    $result_select = mysqli_query($conn, $sql);
    $number = mysqli_num_rows($result_select);
    if($number > 0){
        echo "<script>alert('Sub-menu already exists in the database.')</script>";
    }
    else{
        if(!empty($menu_id) && !empty($sub_menu_name) && !empty($sub_menu_url)){
            $insert_query = "INSERT INTO `sub_menu` (`menu_id`, `sub_menu_name`, `sub_menu_url`) VALUES ('$menu_id', '$sub_menu_name', '$sub_menu_url')";
            $insert_res = mysqli_query($conn, $insert_query);
            if($insert_res) {
                echo "<script>alert('Your sub-menu is added successfully.');
                        console.log('$sub_menu_name is insert in $menu_id');
                </script>";
            } else {
                echo "<script>alert('Failed to add sub-menu. Please try again.')</script>";
            }
        }
        else {
            echo "<script>alert('Please enter both sub-menu name and sub-menu URL.')</script>";
        }
    }
}
?>

<div class="row pt-5">
    <div class="col-8">
        <div>
            <table class="table table-bordered">
                <thead class="">
                    <tr>
                        <th>S.No.</th>
                        <th>Menu name</th>
                        <th>Sub menu name</th>
                        <th>Sub menu url</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $list_sub_menu = "SELECT sub_menu.*, menu.menu_name FROM `sub_menu` INNER JOIN menu ON sub_menu.menu_id = menu.id ORDER BY sub_menu.id";
                    $res_sub_menu = mysqli_query($conn, $list_sub_menu);
                    while ($row_sub_menu = mysqli_fetch_assoc($res_sub_menu)) {
                ?>
                    <tr>
                        <td><?php echo $row_sub_menu['id']; ?></td>
                        <td><?php echo $row_sub_menu['menu_name']; ?></td>
                        <td><?php echo $row_sub_menu['sub_menu_name']; ?></td>
                        <td><?php echo $row_sub_menu['sub_menu_url']; ?></td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="menu_id" value="<?php echo $row_sub_menu['id']; ?>">
                                <button type="submit" name="delete_sub_menu" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this sub-menu?')">Delete</button>
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
    <div class="col-4">
        <div>
            <form action="" method="post">
                <div class="form-group">
                    <label for="select_menu">Select Menu</label>
                    <select name="select_menu" class="form-control" required>
                        <option value="">Select Menu</option>
                        <?php 
                            $sql = "SELECT * FROM menu";
                            $result = mysqli_query($conn, $sql);
                            
                            while ($row = mysqli_fetch_assoc($result)) { 
                            ?>
                                <option value="<?= $row["id"] ?>"><?= $row["menu_name"] ?></option>
                        <?php 
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sub_menu">Sub Menu</label>
                    <input type="text" name="sub_menu" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="sub_menu_url">Sub Menu Url</label>
                    <input type="text" name="sub_menu_url" class="form-control" required>
                </div class="form-group">
                <input type="submit" name="insert_sub_menu" class="btn btn-primary" value="Insert Sub Menu">
            </form>
        </div>
    </div>
</div>
