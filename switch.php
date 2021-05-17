<?php 
if (isset($_GET['Pno'])) {

	               $pn=$_GET['Pno'];
                   include('db/connect.php');
                   $result = $db->prepare("SELECT * FROM tbpayments WHERE Pno= :userid");
                   $result->bindParam(':userid', $pn);
                   $result->execute();
                   for($i=0; $row = $result->fetch(); $i++){
                   $paymode = $row['PaymentMode'];
                   if ($paymode=='Cash') {
                 header("location: paycashreceiptd.php?Pno=$pn");
                   }
                   else{
                 header("location: payreceiptd.php?Pno=$pn");
	
                   }
}
}

?>