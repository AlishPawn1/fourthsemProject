<?php
include ('./include/connect_database.php');
$select_query = "SELECT * FROM products WHERE id='" . $_GET['id'] . "' ";
$result_query = mysqli_query($conn, $select_query);
$row = mysqli_fetch_assoc($result_query);
$product_name = $row["product_name"];
$dynamicTitle = "$product_name";
include ("header.php");
include ('function/commonfunction.php');

?>
<?php
// Display breadcrumb and product details
productdetail();
?>

<?php include ("footer.php"); ?>