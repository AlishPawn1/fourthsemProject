<section class="section-gaps list-order">
    <div class="container">

        <?php
        $get_user = "SELECT * FROM `user_table`";
        $result = mysqli_query($conn, $get_user);
        $row = mysqli_num_rows($result);

        if ($row == 0) {
            echo "<h1 class='heading text-center'>No User Found!</h1>";
        } else {
            echo "
        <h3 class='text-center heading'>All user</h3>
            
            <table class='table table-bordered mt-5'>
                    <thead>
                        <tr>
                            <th>S .No</th>
                            <th>User name</th>
                            <th>User email</th>
                            <th>User image</th>
                            <th>User address</th>
                            <th>user mobile</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>";

            $number = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $user_id = $row['user_id'];
                $user_name = $row['user_name'];
                $user_email = $row['user_email'];
                $user_image = $row['user_image'];
                $user_address = $row['user_address'];
                $user_mobile = $row['user_mobile'];
                $number++;

                echo "
                <tr class='text-center'>
                    <td data-label='S. No'>$number</td>
                    <td data-label='User name'>$user_name</td>
                    <td data-label='User email'>$user_email</td>
                    <td data-label='User image'><img src='../user_area/user_image/$user_image' height='100' width='100' alt='$user_name'/></td>
                    <td data-label='User address'>$user_address</td>
                    <td data-label='User mobile'>$user_mobile</td>
                    <td data-label='Delete'>
                        <a href='index.php?user_id=$user_id' class='btn btn-danger' onclick=\"return confirm('Are you sure you want to delete this user?')\">Delete</a>
                    </td>
                </tr>
                ";
            }


            echo "</tbody></table>";
        }
        ?>

    </div>
</section>