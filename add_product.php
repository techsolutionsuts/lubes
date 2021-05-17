<?php include_once('header.php');
if(isset($_POST['add']))
{
$product_name=$_POST['product_name'];
$quantity=$_POST['quantity'];
//$qtyl = $_POST['qty_left'];
$price=$_POST['price'];
//$unit_price=$_POST['unit_price'];
$imge_type=$_FILES['image']['type'];
$catid = $_POST['cat_id'];
$aridate = $_POST['aridate'];
$productcode = $_POST['product_code'];
$suplierid = $_POST['suplierid'];
$content = $_POST['content'];
$drivernum = $_POST['drivernum'];
$Description = $_POST['Description'];
$store=rand(0,989898989).$_FILES['image']['name'];
if($imge_type=='image/jpeg' || $imge_type=='image/png'|| $imge_type=='image/gif'|| $imge_type=='image/jpg')
{
move_uploaded_file($_FILES['image']['tmp_name'],'product/'.$store);

mysql_query("insert into tbproduct(prod_code,cat_id,suplierid,product_name,quantity,Qty_Left,content,price,unit_price,Description,date,Driver_num,image) 
                            values('$productcode','$catid','$suplierid','$product_name','$quantity','$quantity','$content','$price','','$Description','$aridate','$drivernum','$store')") or die(mysql_error());

header('Location: product.php');					
}
else
{
echo("Invalid file or no image was selected");
}
}
?>
   <form action="" method="post" enctype="multipart/form-data">

   <br>
<div class="contentheader" style="float: left; background:  #b1cbbb;">
			<i class="icon-table"></i> Add Product
			</div><br>
<ul class="breadcrumb" style="float: left; width: 845;">
			<li style="float: left; "><a href="product.php">Products</a></li> 
			<li class="active" style="float: left;">Add Product</li>
			</ul><br>
<br>
      <table class="table" style="background:  #92a8d1; ">
      <tr>
	  <td>
	  <label>Date Arrived</label>
	  <input type="date" style="width: 300px;" name="aridate" required class="form-control">
	  </td>
	  <td>
	  <label>Product Code</label>
	  <input type="text" name="product_code" required class="form-control">
	  </td>
	  </tr>
      <tr>
	  <td>
	  <label>Driver Number</label>
	  <input type="text" name="drivernum" required class="form-control">
	  </td>
	  <td>
	  <label>Supplier</label>
	  <select class="form-control" name="suplierid" >
	  <?php
	  $c = mysql_query("select * from supliers");
	  while($row = mysql_fetch_object($c))
	  {
	  ?>
	  <option value ="<?= $row->suplierid ?>"><?= $row->suplier_name ?></option>
	  <?php

	  }
	  
	  ?>
	  </select>
	  </td>
	  </td>
	  </tr>

	  <tr>
	  <td>
	  <label>Product Name</label>
	  <input type="text" name="product_name" required class="form-control">
	  </td>
	  <td>
	  <label>Quantity</label>
	  <input type="text" name="quantity" required class="form-control" >
	  </td>
	  </tr>
	  <tr>
	  <td>
	  <label>Price</label>
	  <input type="text" name="price" required class="form-control">
	  </td>
	  <td>
	  <label>Image</label>
	  <input type="file" name="image" class="form-control">
	  </td>
	  </tr>
	  <tr>
	  <td><label>Product Category</label>
	  <select class="form-control" name="cat_id" >
	  <?php
	  $c = mysql_query("select * from tbcategory");
	  while($row = mysql_fetch_object($c))
	  {
	  ?>
	  <option value ="<?= $row->id ?>"><?= $row->category_name ?></option>
	  <?php

	  }
	  
	  ?>
	  </select>
	  </td>  
	  <td>
	  <label>Content</label>
	  <input type="text" name="content" required class="form-control">
	  </td>
	  </tr>
	  <tr>
	  <td>
	  <label>Description</label>
	  <input type="text" name="Description" required class="form-control">
	  </td>
	  
	  </tr>
	  <tr>
	  
	  </tr>
	  <tr>
	  <td><input type="submit" name="add" value="Add" class="btn btn-primay"></td></tr>
	  </table>
     </form>
<?php include_once('footer.php');?>
