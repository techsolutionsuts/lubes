<?php include_once('header.php');
     if(isset($_POST['add']))
	 {
	 $customername = $_POST['cust_name'];
	 $customeraddress = $_POST['cust_location'];
	 $customerphone = $_POST['cust_phone'];
	 $custcode = $_GET['customerID'];
	 $user = $_SESSION['username'];
	 mysql_query("insert into customer (cust_code,FullName,Location,PhoneNumber,System_Date,user) values('$custcode','$customername','$customeraddress','$customerphone', now(),'$user')") or die(mysql_error());

	 header("Location: customer.php");
	 }
	 ?>
	 <form action="" method="post">
	 <br>
<div class="contentheader" style="float: left;">
			<i class="icon-table"></i> Add Customer
			</div><br>
<ul class="breadcrumb" style="float: left; width: 845;">
			<li style="float: left;"><a href="customer.php">Customer</a></li> 
			<li class="active" style="float: left;">Add Customer</li>
			</ul><br>
         <table class="table">
		    <tr>
		     <td>
		     <input type="hidden" name="customerID" value="<?php echo $_GET['customerID']; ?>" />

		     <label>Customer Name</label>
		     <input type="text" name="cust_name" required class="form-control">
		     </td>
		    <td>
		     <label>Customer Location</label>
		     <input type="text" name="cust_location" required class="form-control">
		     </td>
		     </tr>
		     <tr>
		     <td>
		     <label>Customer Phone</label>
		     <input type="text" name="cust_phone" required class="form-control">
		     </td>
		     <td>
		     <label></label><br><br><br>
		     <input type="submit" name="add" value="Add" class="btn btn-primay"></td></tr>
		 </table>
      </form>
<?php include_once('footer.php');?>