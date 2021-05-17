<?php include_once('headerad.php');
     if(isset($_POST['add']))
	 {
	 $suppliername = $_POST['supl_name'];
	 $supplieraddress = $_POST['supl_address'];
	 $suppliercontact = $_POST['supl_contact'];
	 mysql_query("insert into supliers(suplier_name,suplier_address,suplier_contact) values('$suppliername', '$supplieraddress','$suppliercontact'");
	 header("Location: supplier.php");
	 }
	 ?>
	 <form action="" method="post">
	 <br>
<div class="contentheader" style="float: left;">
			<i class="icon-table"></i> Add Supplier
			</div><br>
<ul class="breadcrumb" style="float: left; width: 845;">
			<li style="float: left;"><a href="supplier.php">Supplier</a></li> 
			<li class="active" style="float: left;">Add Supplier</li>
			</ul><br>
         <table class="table">
		    <tr>
		     <td>
		     <label>Supplier Name</label>
		     <input type="text" name="supl_name" required class="form-control">
		     </td>
		    <td>
		     <label>Address</label>
		     <input type="text" name="supl_address" required class="form-control">
		     </td>
		     </tr>
		     <tr>
		     <td>
		     <label>Contact</label>
		     <input type="text" name="supl_contact" required class="form-control">
		     </td>
		     <td>
		     <label></label><br><br><br>
		     <input type="submit" name="add" value="Add" class="btn btn-primay"></td></tr>
		 </table>
      </form>
<?php include_once('footer.php');?>