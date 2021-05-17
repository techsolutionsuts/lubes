<?php include_once('header.php');
    if(isset($_GET['suplierid']))
	 {
	 $id = $_GET['suplierid'];
	 $rr = mysql_fetch_object(mysql_query("select * from supliers where suplierid = '$id'"));
	 }

    if(isset($_POST['add']))
	 {
	 $id = $_GET['suplierid'];
	 $suppliername = $_POST['supl_name'];
	 $supplieraddress = $_POST['supl_address'];
	 $suppliercontact = $_POST['supl_contact'];

	 mysql_query("update supliers set suplier_name = '$suppliername',
	 	                              suplier_address = '$supplieraddress', 
	 	                              suplier_contact = '$suppliercontact', 
									  System_Date = now()where suplierid = '$id'");
	 header("Location: supplier.php");
	 }
	 
	 ?>
	 <form action="" method="post">
	 <br>
<div class="contentheader" style="float: left;">
			<i class="icon-table"></i> Update Supplier Info
			</div><br>
<ul class="breadcrumb" style="float: left; width: 845;">
			<li style="float: left;"><a href="supplier.php">Supplier</a></li> 
			<li class="active" style="float: left;">Update Supplier</li>
			</ul><br>
         <table class="table">
         
		    <tr>
		    <input type="hidden" name="suplierid" value="<?= $rr->suplierid?>">
		     <td>
		     <label>Supplier Name</label>
		     <input type="text" name="supl_name" value="<?= $rr->suplier_name ?>" required class="form-control">
		     </td>
		    <td>
		     <label>Address</label>
		     <input type="text" name="supl_address" value="<?= $rr->suplier_address?>" required class="form-control">
		     </td>
		     </tr>
		     <tr>
		     <td>
		     <label>Contact</label>
		     <input type="text" name="supl_contact" value="<?= $rr->suplier_contact ?>" required class="form-control">
		     </td>
		     <td>
		     <label></label><br><br><br>
		     <input type="submit" name="add" value="Update" class="btn btn-primay"></td></tr>
		     
		 </table>
      </form>
<?php include_once('footer.php');?>