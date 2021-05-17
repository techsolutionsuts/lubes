<?php
	include('db/connect.php');
	include('db/db.php');

	$id=$_GET['id'];
	$c=$_GET['invoice'];
	$sdsd=$_GET['dle'];
	$qty=$_GET['qty'];
	$wapak=$_GET['code'];
	$phid = $_GET['ID'];
	//edit qty
	$sql = "UPDATE tbproduct 
			SET Qty_Left=Qty_Left -?
			WHERE prod_code=?";
	$q = $db->prepare($sql);
	$q->execute(array($qty,$wapak));

	$result = $db->prepare("DELETE FROM tballproduct WHERE id= :memid");
	$result->bindParam(':memid', $id);
	$result->execute();

   $result = $db->prepare("DELETE FROM tb_stock_dynamics WHERE sid= :memid");
	$result->bindParam(':memid', $id);
	$result->execute();

    $id=$_GET['invoice'];
          $result = $db->prepare("SELECT * FROM tballproduct WHERE invoice= :userid");
          $result->bindParam(':userid', $id);
          $result->execute();
          for($i=0; $row = $result->fetch(); $i++){
          $bringd = $row['date'];
          }
          if($bringd===null)
          {
	header("location: restock.php?id=$sdsd&invoice=$c");
          }
          else
          {
	header("location: restock1.php?id=$sdsd&invoice=$c");
          }
?>