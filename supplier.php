<?php include('headerad.php'); 

$sms = '';
if(isset($_GET['idd']))
{
$id = $_GET['idd'];
mysql_query("delete from supliers where suplierid ='$id'");
$sms.="Deleted Sucessfuly";
}
?>

<br>
<div class="contentheader" style="float: left;">
			<i class="icon-table"></i> Suppliers
			</div><br>
<ul class="breadcrumb" style="float: left; width: 845;">
			<li style="float: left;"><a href="activities.php">Activities</a></li> 
			<li class="active" style="float: left;">Suppliers</li>
			</ul><br>
<div style="margin-top: -19px; margin-bottom: 21px; "><br><br>
<a  href="activities.php"><button class="btn btn-default btn-large" style="float: right;"><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>
</div><br>
<a href="add_supplier.php" style="float: left;">Add New</a><br>
<center><h5 style="color:red;"><?php if(isset($sms)) {echo $sms;} ?></h5></center>
           <table class="table table-bordered" id="resultTable" data-responsive="table">
     <thead>
	 <tr>
	 <th>ID</th>
	 <th>Supplier Name</th>
	 <th>Supplier Address</th>
	 <th>Supplier Contact</th>
	 <th>Manage</th>
	 </tr>
	 </thead>
	 <tbody>
	 <?php
	 $q = mysql_query("select * from supliers");
	 while($row=mysql_fetch_object($q))
	 {
	 ?>
	 <tr>
	 <td><?= $row->suplierid ?></td>
	  <td><?= $row->suplier_name ?></td>
	  <td><?= $row->suplier_address ?></td>
	  <td><?= $row->suplier_contact ?></td>
	  <td><a href="edit_supplier.php?suplierid=<?= $row->suplierid ?>">Edit</a>|<a href="supplier.php?idd=<?= $row->suplierid ?>">Remove</a>
	 </tr>
	 <?php
	 }
	 
	 ?>
	 </tbody>
</table>
<?php include('footer.php'); ?>
