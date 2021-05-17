<?php include_once('headerad.php');
$sms = '';
if(isset($_GET['idd']))
{
$id = $_GET['idd'];
mysql_query("delete from tbcategory where id ='$id'");
$sms.="Deleted Sucessfuly";
}
?>

<br>
<div class="contentheader" style="float: left;">
			<i class="icon-table"></i> Product Category
			</div><br>
<ul class="breadcrumb" style="float: left; width: 845;">
			<li style="float: left;"><a href="activities.php">Activities</a></li> 
			<li class="active" style="float: left;">Category</li>
			</ul><br>
<div style="margin-top: -19px; margin-bottom: 21px; "><br><br>
<a  href="activities.php"><button class="btn btn-default btn-large" style="float: right;"><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>
</div><br>
<a href="add_category.php" style="float: left;">Add New</a><br>
<center><h5 style="color:red;"><?php if(isset($sms)) {echo $sms;} ?></h5></center>
           <table class="table table-bordered" id="resultTable" data-responsive="table">
     <thead>
	 <tr>
	 <th>ID</th>
	 <th>Category Name</th>
	 <th>Content (Liters)</th>	 
	 <th>Manage</th>
	 </tr>
	 </thead>
	 <tbody>
	 <?php
	 $q = mysql_query("select * from tbcategory");
	 while($row=mysql_fetch_object($q))
	 {
	 ?>
	 <tr>
	 <td hidde><?= $row->id ?></td>
	  <td><?= $row->category_name ?></td>
	  <td><?= $row->cat_content ?></td>
	  <td><a href="edit_category.php?id=<?= $row->id ?>">Edit</a>|<a href="category.php?idd=<?= $row->id ?>">Remove</a>
	 </tr>
	 <?php
	 }
	 
	 ?>
	 </tbody>
</table>


<?php include_once('footer.php');?>