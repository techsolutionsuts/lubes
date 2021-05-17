<?php
	include('db/connect.php');

	$id=$_GET['id'];
	$c=$_GET['invoice'];
	$sdsd=$_GET['dle'];
	$qty=$_GET['qty'];
	$wapak=$_GET['code'];
	//edit qty
	$sql = "UPDATE tbproduct 
			SET Qty_Left=Qty_Left +?
			WHERE id=?";
	$q = $db->prepare($sql);
	$q->execute(array($qty,$wapak));

	$result = $db->prepare("DELETE FROM salesdetails WHERE salesDid= :memid");
	$result->bindParam(':memid', $id);
	$result->execute();

	$result = $db->prepare("DELETE FROM tb_stock_dynamics WHERE sid= :memid");
	$result->bindParam(':memid', $id);
	$result->execute();


    $id=$_GET['invoice'];
          $result = $db->prepare("SELECT * FROM salesdetails WHERE invoice= :userid");
          $result->bindParam(':userid', $id);
          $result->execute();
          for($i=0; $row = $result->fetch(); $i++){
          $bringd = $row['date'];
          }
          if($bringd===null)
          {
	header("location: credit_sales.php?id=$sdsd&invoice=$c");
          }
          else
          {
	header("location: credit_sales2.php?id=$sdsd&invoice=$c");
          }
?>