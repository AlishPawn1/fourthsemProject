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


if(isset($_GET['order_id'])){
    $order_id = $_GET['order_id'];
    // echo  "Order ID: ". $order_id;

    $delete_query = "DELETE FROM `user_order` WHERE order_id = $order_id";
    $result= mysqli_query($conn, $delete_query);
    if($result){
        echo "<script>alert('delete successfully')</script>";
    }
}

if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
    // echo  "Order ID: ". $user_id;

    $delete_query = "DELETE FROM `user_table` WHERE user_id = $user_id";
    $result= mysqli_query($conn, $delete_query);
    if($result){
        echo "<script>alert('delete successfully')</script>";
    }
}

?>