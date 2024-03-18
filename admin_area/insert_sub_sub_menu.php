<?php 
include('../include/connect_database.php');

// Handle delete sub-sub-menu request
if(isset($_POST['delete_menu'])){
    $sub_sub_menu_id = $_POST['sub_menu_id'];

    // Check if the user has confirmed the deletion
    if(isset($_POST['confirm_delete']) && $_POST['confirm_delete'] === 'yes') {
        $delete_query = "DELETE FROM `sub_menu` WHERE `id` = $sub_sub_menu_id";
        $delete_result = mysqli_query($conn, $delete_query);
        if($delete_result){
            echo "<script>alert('Sub-sub-menu deleted successfully.')</script>";
        } else {
            echo "<script>alert('Failed to delete sub-sub-menu.')</script>";
        }
    }
}

// Handle insert sub-sub-menu request
if(isset($_POST['insert_sub_sub_menu'])){
    $menu_id = $_POST['select_menu'];
    $sub_menu_id = $_POST['select_sub_menu'];
    $sub_sub_menu_name = $_POST['sub_sub_menu'];
    $sub_sub_menu_url = $_POST['sub_sub_menu_url'];

    $sql = "SELECT * FROM `sub_sub_menu` WHERE sub_sub_menu_name = '$sub_sub_menu_name'";
    $result_select = mysqli_query($conn, $sql);
    $number = mysqli_num_rows($result_select);
    if($number > 0){
        echo "<script>alert('Sub-sub-menu already exists in the database.')</script>";
    }
    else{
        if(!empty($menu_id) && !empty($sub_menu_id) && !empty($sub_sub_menu_name) && !empty($sub_sub_menu_url)){
            $insert_query = "INSERT INTO `sub_sub_menu` (`menu_id`, `sub_menu_id`, `sub_sub_menu_name`, `sub_sub_menu_url`) VALUES ('$menu_id','$sub_menu_id', '$sub_sub_menu_name', '$sub_sub_menu_url')";
            $insert_res = mysqli_query($conn, $insert_query);
            if($insert_res) {
                echo "<script>alert('Your sub-sub-menu is added successfully.');
                        console.log('$sub_sub_menu_name is insert in $menu_id and $sub_menu_id');
                </script>";
            } else {
                echo "<script>alert('Failed to add sub-sub-menu. Please try again.')</script>";
            }
        }
        else {
            echo "<script>alert('Please enter both sub-sub-menu name and sub-sub-menu URL.')</script>";
        }
    }
}
?>

<div class="row pt-5">
    <div class="col-9">
        <div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Menu name</th>
                        <th>Sub menu name</th>
                        <th>Sub sub menu name</th>
                        <th>Sub sub menu url</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $list_sub_sub_menu = "SELECT sub_sub_menu.*, menu.menu_name, sub_menu.sub_menu_name FROM `sub_sub_menu` INNER JOIN sub_menu ON sub_sub_menu.sub_menu_id = sub_menu.id INNER JOIN menu ON sub_menu.menu_id = menu.id ORDER BY sub_sub_menu.id";
                    $res = mysqli_query($conn, $list_sub_sub_menu);
                    while ($row = mysqli_fetch_assoc($res)) {
                ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['menu_name']; ?></td>
                        <td><?php echo $row['sub_menu_name']; ?></td>
                        <td><?php echo $row['sub_sub_menu_name']; ?></td>
                        <td><?php echo $row['sub_sub_menu_url']; ?></td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="sub_menu_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="delete_menu" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this sub-sub-menu?')">Delete</button>
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
    <div class="col-3">
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
                    <label for="select_sub_menu">Select Sub Menu</label>
                    <select name="select_sub_menu" class="form-control" required>
                        <option value="">Select Sub Menu</option>
                        <?php 
                            $sql = "SELECT * FROM sub_menu";
                            $result = mysqli_query($conn, $sql);
                            
                            while ($row = mysqli_fetch_assoc($result)) { 
                            ?>
                                <option value="<?= $row["id"] ?>"><?= $row["sub_menu_name"] ?></option>
                        <?php 
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sub_sub_menu">Sub Sub Menu</label>
                    <input type="text" name="sub_sub_menu" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="sub_sub_menu_url">Sub Sub Menu Url</label>
                    <input type="text" name="sub_sub_menu_url" class="form-control" required>
                </div>
                <input type="submit" name="insert_sub_sub_menu" class="btn btn-primary" value="Insert Sub Sub Menu">
            </form>
        </div>
    </div>
</div>
