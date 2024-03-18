<?php

if(isset($_GET['delete_product'])){
    $delete_id = $_GET['delete_product'];
    // echo $delete_id;
    // delete query
    
    $delete_query = "delete from `products` where id=$delete_id";
    $result= mysqli_query($conn, $delete_query);
    if($result){
        echo "<script>alert('delete successfully')</script>";
    }
}

?>