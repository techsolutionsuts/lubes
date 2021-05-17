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

$pn=$_GET['pno'];
include('db/connect.php');
$result = $db->prepare("SELECT * FROM tbpayments WHERE Pno= :userid");
$result->bindParam(':userid', $pn);
$result->execute();
for($i=0; $row = $result->fetch(); $i++)
{
$pn=$row['Pno'];
$customer=$row['Customer'];
$dest=$row['Description'];
$amount=$row['AmountC'];
$date=$row['date'];
$bal = $row['Balance'];

}
?>


 <body>

	
	<div class="container-fluid">
      <div class="row-fluid">	
	<div class="span10">
	<a href="sales.php?id=cash&invoice=<?php echo $finalcode ?>"><button class="btn btn-default"><i class="icon-arrow-left"></i> Back to Payment</button></a>

<div class="content" id="content">
<div style="margin: 0 auto; padding: 20px; width: 900px; font-weight: normal;">
	<div style="width: 100%; height: 190px;" >
	<div style="width: 900px; float: left;">
	<center><div style="font:bold 25px 'Aleo';">Sunyani Shell Service Station</div>
	Sunyani Shell, Opp. Jubilee Park<br>
	Payment Receipt	<br>	<br>
	</center>
	<div>
	<?php
	$resulta = $db->prepare("SELECT * FROM customer WHERE FullName= :a");
	$resulta->bindParam(':a', $customer);
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
			<td></td>
			<td><?php echo $customer ?></td>
		</tr>
		<tr>
			<td></td>
			<td><?php echo $address ?></td>
		</tr>
		<tr style="margin-top: 2344px">
			<td></td>
			<td><?php echo $contact; ?></td>
		</tr>
		<tr style="margin-top: 2344px">
			<td></td>
		</tr>
	</table>


	<div class="pull-right" style="margin-right:100px;">
		<a href="javascript:Clickheretoprint()" style="font-size:20px; position:absolute; margin-top: -40px; left: 800px"><button class="btn btn-success btn-large"><i class="icon-print"></i> Print</button></a>
		</div>
<br><br><br><br>
	</div>
	<div class="clearfix"></div>
	</div>
	<div style="width: 100%; margin-top:-70px;">
	
	<br>
		<div class="clearfix"></div>
	<div style="width: 100%; margin-top:-70px;">
	<table border="0" cellpadding="4" cellspacing="0" style="font-family: arial; font-size: 12px;	text-align:left;" width="100%">
	<br><br><br><br>
		<thead><center>
Cash payment made for lubricants purchased	<br><br>		
                <tr>
				<th>Date:</th>
                <th>Description:</th>
                <th>Payment By:</th>
                 
			</tr>
		</thead>
		<tbody>
			
				<?php
					$pn=$_GET['pno'];
                   include('db/connect.php');
                   $result = $db->prepare("SELECT * FROM tbpayments WHERE Pno= :userid");
                   $result->bindParam(':userid', $pn);
                   $result->execute();
                   for($i=0; $row = $result->fetch(); $i++){
				?>
				<tr class="record">
				<td><?php echo $row['date']; ?></td>
				<td><?php echo $row['Description']; ?></td>
				<td><?php echo $row['CustomerRep']; ?></td>
				<?php
					}
				?>
			    
				<tr>
					<td colspan="2" style=" text-align:right;"><strong style="font-size: 12px;">Amount: &nbsp;</strong></td>
					<td colspan="2"><strong style="font-size: 12px;">
					<?php
					$pn=$_GET['pno'];
                   include('db/connect.php');
                   $result = $db->prepare("SELECT * FROM tbpayments WHERE Pno= :userid");
                   $result->bindParam(':userid', $pn);
                   $result->execute();
                   for($i=0; $row = $result->fetch(); $i++)
                    {
					$fgfg=$row['AmountC'];
					echo formatMoney($fgfg, true);
					}
					?>
					</strong></td></tr><tr>
					<td colspan="2" style=" text-align:right;"><strong style="font-size: 12px;">Balance: &nbsp;</strong></td>
					<td colspan="2"><strong style="font-size: 12px;">
					<?php
					$pn=$_GET['pno'];
                   include('db/connect.php');
                   $result = $db->prepare("SELECT * FROM tbpayments WHERE Pno= :userid");
                   $result->bindParam(':userid', $pn);
                   $result->execute();
                   for($i=0; $row = $result->fetch(); $i++)
                    {
					$fgfg=$row['Balance'];
					echo formatMoney($fgfg, true);
					}
					?>
					</strong></td>
				</tr>
		</tbody>
	</table>
	<br>
		Sign......................................<br><br>
		<?php echo date('d-M-Y h:i:s'); ?>
			<br><br>
			<center>
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



