<?php include('header.php'); 

$sms = '';
if(isset($_GET['idd']))
{
$id = $_GET['idd'];
mysql_query("delete from customer where CustomerID ='$id'");
$sms.="Deleted Sucessfuly";
}
?>

<br>
<div class="contentheader" style="float: left;">
			<i class="icon-table"></i> Customers
			</div><br>
<ul class="breadcrumb" style="float: left; width: 845;">
			<li style="float: left;"><a href="activities.php">Activities</a></li> 
			<li class="active" style="float: left;">Customers</li>
			</ul><br>
<div style="margin-top: -19px; margin-bottom: 21px; "><br><br>
<a  href="activities.php"><button class="btn btn-default btn-large" style="float: right;"><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>
</div><br>
<a href="add_customer.php?id=newcust&customerID=<?php echo $custid ?>" style="float: left;">Add New</a><br>
<center><h5 style="color:red;"><?php if(isset($sms)) {echo $sms;} ?></h5></center>
           <table class="table table-bordered" id="resultTable" data-responsive="table">
     <thead>
	 <tr>
	 <th>ID</th>
	 <th>Customer Name</th>
	 <th>Customer Location</th>
	 <th>Customer Phone</th>
	 <th>Current Bal</th>
	 <th>Manage</th>
	 </tr>
	 </thead>
	 <tbody>
	 <?php
	 $q = mysql_query("select * from customer");
	 while($row=mysql_fetch_object($q))
	 {
	 ?>
	 <tr>
	 <td><?= $row->cust_code ?></td>
	  <td><?= $row->FullName ?></td>
	  <td><?= $row->Location ?></td>
	  <td><?= $row->PhoneNumber ?></td>
	  <td><?=formatMoney($row->Balance, true)?>
	  </td>
	  <td><a href="edit_customer.php?CustomerID=<?= $row->CustomerID ?>">Edit</a><a hidden href="customer.php?idd=<?= $row->CustomerID ?>">Remove</a>
	 </tr>
	 <?php
	 }
	 
	 ?>
	 </tbody>
</table>
<?php include('footer.php'); ?>
