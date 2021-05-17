<?php include_once('header.php');
if(isset($_GET['CustomerID']))
	 {
	 $id = $_GET['CustomerID'];
	 $r = mysql_fetch_object(mysql_query("select * from customer where CustomerID = '$id'"));
	 }

    if(isset($_POST['add']))
	 {
	 $id = $_GET['CustomerID'];
	 $customername = $_POST['cust_name'];
	 $customeraddress = $_POST['cust_location'];
	 $customerphone = $_POST['cust_phone'];

	 mysql_query("update customer set FullName  = '$customername',
	 	                              Location = '$customeraddress', 
	 	                              PhoneNumber = '$customerphone' where CustomerID = '$id'");
	 header("Location: customer.php");
	 }
	 
	 ?>
	 <form action="" method="post">
	 <br>
<div class="contentheader" style="float: left;">
			<i class="icon-table"></i> Update Customer Info 
			</div><br>
<ul class="breadcrumb" style="float: left; width: 845;">
			<li style="float: left;"><a href="customer.php">Customer</a></li> 
			<li class="active" style="float: left;">Update Customer</li>
			</ul><br>
         <table class="table">
         
		    <tr>
		    <input type="hidden" name="CustomerID" value="<?= $r->CustomerID?>">
		     <td>
		     <label>Customer Name</label>
		     <input type="text" name="cust_name" value="<?= $r->FullName ?>" required class="form-control">
		     </td>
		    <td>
		     <label>Address</label>
		     <input type="text" name="cust_location" value="<?= $r->Location?>" required class="form-control">
		     </td>
		     </tr>
		     <tr>
		     <td>
		     <label>Contact</label>
		     <input type="text" name="cust_phone" value="<?= $r->PhoneNumber ?>" required class="form-control">
		     </td>
		     <td>
		     <label></label><br><br><br>
		     <input type="submit" name="add" value="Add" class="btn btn-primay"></td></tr>
		     
		 </table>
      </form>
<?php include_once('footer.php');?>