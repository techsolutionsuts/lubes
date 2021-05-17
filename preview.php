<?php include_once('headerad.php');?>

 <link href="css/bootstrap.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">
  
  <link rel="stylesheet" href="css/font-awesome.min.css">
    <style type="text/css">
    
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="lib/jquery.js" type="text/javascript"></script>
<script src="src/facebox.js" type="text/javascript"></script>
<?php

$invoice=$_GET['invoice'];
include('db/connect.php');
$result = $db->prepare("SELECT * FROM sales WHERE invoice= :userid");
$result->bindParam(':userid', $invoice);
$result->execute();
for($i=0; $row = $result->fetch(); $i++)
{
$invoice=$row['invoice'];
$cashier=$row['cashier'];
$date=$row['salesDate'];
$cname=$row['Customer'];
$sp=$row['salesperson'];
}
?>


 <body>

	
	<div class="container-fluid">
      <div class="row-fluid">	
	<div class="span10">
	<a href="sales.php?id=cash&invoice=<?php echo $finalcode ?>"><button class="btn btn-default"><i class="icon-arrow-left"></i> Back to Sales</button></a>
		<a href="javascript:Clickheretoprint()" style="font-size:20px; position:absolute; margin-top: 70px; left: 800px"><button class="btn btn-success btn-large"><i class="icon-print"></i> Print</button></a>

<div class="content" id="content">
<div style="margin: 0 auto; padding: 20px; width: 900px; font-weight: normal;">
	<div style="width: 100%; height: 190px;" >
	<div style="width: 900px; float: left;">
	<center><div style="font:bold 25px 'Aleo';">Sunyani Shell Service Station</div>
	Lubricants Sales Summary<br>
	Sunyani Shell, Opp. Jubilee Park
	<img width="50" height="50" style="float: right; left: 690px; position: absolute;" src="images/slide/slide1.png">
	</center>
	<div>
	<?php
	$resulta = $db->prepare("SELECT * FROM customer WHERE FullName= :a");
	$resulta->bindParam(':a', $cname);
	$resulta->execute();
	for($i=0; $rowa = $resulta->fetch(); $i++){
	$address=$rowa['Location'];
	$contact=$rowa['PhoneNumber'];
	}
	?>
	</div>
	</div>
	<div style="width: 136px; float: left; height: 70px;">
	<table cellpadding="3" cellspacing="0" style="font-family: arial; font-size: 12px;text-align:left;width : 100%;">

		<tr>
			<td>Sales ID:</td>
			<td><?php echo $invoice ?></td>
		</tr>
		<tr>
			<td>Date:</td>
			<td><?php echo $date; ?></td>
		</tr>
		<tr style="margin-top: 2344px">
			<td>Sales Rep:</td>
			<td><?php echo $sp; ?></td>
		</tr>
		<tr>
		<?php if ($cname=="") {
			echo ("");
			} 
          else{
          echo "Customer: ".$cname.'<br>';
          }
			?>
		</tr>

	</table>
	<div class="pull-right" style="margin-right:100px;">
		</div>
			
<br><br><br><br>
	</div>
	<div class="clearfix"></div>
	</div>
	<div style="width: 100%; margin-top:-70px;">
	<table border="1" cellpadding="4" cellspacing="0" style="font-family: arial; font-size: 12px;	text-align:left;" width="100%">
	<br><br><br><br>
		<thead>
			<tr>
				<th>ProductName</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Content</th>
                <th>Discount</th>
                <th>Liters</th>
                <th>Amount</th>
			</tr>
		</thead>
		<tbody>
			
				<?php
					$id=$_GET['invoice'];
					$result = $db->prepare("SELECT * FROM salesdetails WHERE invoice= :userid");
					$result->bindParam(':userid', $id);
					$result->execute();
					for($i=0; $row = $result->fetch(); $i++){
				?>
				<tr class="record">
				<td><?php echo $row['ProductName']; ?></td>
				<td><?php echo $row['Description']; ?></td>
				<td><?php echo $row['Quantity']; ?></td>
				<td>
				<?php
				$ppp=$row['Price'];
				echo formatMoney($ppp, true);
				?>
				</td>
				<td><?php echo $row['Content']; ?></td>
				<td>
				<?php
				$ddd=$row['Discount'];
				echo formatMoney($ddd, true);
				?>
				</td>
				<td>
				<?php
				$dfdf=$row['Liters'];
				echo formatMoney($dfdf, true);
				?>
				</td>
				<td><?php echo $row['Amount']; ?></td>
                
				</tr>
				<?php
					}
				?>
			    
				<tr>
				<td></td>
				<td></td>
					<td colspan="5" style=" text-align:right;"><strong style="font-size: 12px;">Discount: &nbsp;</strong></td>
					<td colspan="2"><strong style="font-size: 12px;">
					<?php
					$sdsd=$_GET['invoice'];
					$resultas = $db->prepare("SELECT sum(Discount) FROM salesdetails WHERE invoice= :a");
					$resultas->bindParam(':a', $sdsd);
					$resultas->execute();
					for($i=0; $rowas = $resultas->fetch(); $i++){
					$fgfg=$rowas['sum(Discount)'];
					echo formatMoney($fgfg, true);
					}
					?>
					</strong></td>
				</tr>

				<tr>
				<td></td>
				<td></td>
				<td colspan="5" style=" text-align:right;"><strong style="font-size: 12px;">Total: &nbsp;</strong></td>
					<td colspan="2"><strong style="font-size: 12px;">
					<?php
					$sdsd=$_GET['invoice'];
					$resultas = $db->prepare("SELECT sum(Amount) FROM salesdetails WHERE invoice= :a");
					$resultas->bindParam(':a', $sdsd);
					$resultas->execute();
					for($i=0; $rowas = $resultas->fetch(); $i++){
					$fgfg=$rowas['sum(Amount)'];
					echo formatMoney($fgfg, true);
					}
					?>
					</strong></td>
				</tr>
				
			
		</tbody>
	</table>
	<br>
	<center><div style="font:bold 12px 'Aleo';"></div>
	Thank you for doing business with us<br>
	God bless you.<br>	<br>
	</center>
	
	</div>
	</div>
	</div>
	</div>
	
</div>
</div>
<?php include_once('footer.php');?>



