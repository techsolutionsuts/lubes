<?php
session_start();
include('db/connect.php');
if(isset($_POST['save']))
{
$a = $_GET['invoice'];
$b = $_POST['product'];
$c = $_POST['qty'];
$w = $_POST['pt'];
$sp = $_POST['selperson'];
$date = $_POST['aridate'];
$discount = $_POST['discount'];
$result = $db->prepare("SELECT * FROM tbproduct WHERE id= :userid");
$result->bindParam(':userid', $b);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$asasa=$row['price'];
$code=$row['prod_code'];
$gen=$row['cat_id'];
$name=$row['product_name'];
$p=$row['content'];
$discrpt = $row['Description'];
}

//edit qty
$sql = "UPDATE tbproduct 
        SET quantity=quantity-?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($c,$b));
if($discount<0){

	$d=$c*$asasa;
	$content=$p*$c;
	//query
$sql = "INSERT INTO salesdetails (invoice,ProductCode,ProductName,Quantity,Amount,Content,Description,Liters,Price,Discount,date) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,:k)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$code,':c'=>$b,':d'=>$c,':e'=>$d,':f'=>$p,':g'=>$discrpt, ':h'=>$content,':i'=>$asasa,':j'=>$discount,':k'=>$aridate));
header("location: sales.php?id=$w&invoice=$a");

}else{

$fffffff=($asasa*$discount)/100;
$d=$fffffff*$c;
$content=$p*$c;

$sql = "INSERT INTO salesdetails (invoice,ProductCode,ProductName,Quantity,Amount,Content,Description,Liters,Price,Discount,date) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,:k)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$code,':c'=>$b,':d'=>$c,':e'=>$d,':f'=>$p,':g'=>$discrpt, ':h'=>$content,':i'=>$asasa,':j'=>$discount,':k'=>$aridate));
header("location: sales.php?id=$w&invoice=$a");

}
}
?>