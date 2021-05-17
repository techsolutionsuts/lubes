<?php
	include('db/connect.php');
	$id=$_GET['id'];
	$qty=$_GET['quantity'];
	
	$result = $db->prepare("SELECT * FROM tbproduct WHERE id= :userid");
$result->bindParam(':userid', $b);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$qty=$row['quantity'];
}

	$sql = "UPDATE products 
        SET qty=qty+?
		WHERE product_id=?";

	
	$result = $db->prepare("DELETE FROM sales_order WHERE transaction_id= :id");
	$result->bindParam(':id', $id);
	$result->execute();
		header("location: sales_inventory.php");
?>