<?php include_once('header.php');
if(isset($_GET['id']))
{

$id = $_GET['id'];
$row = mysql_fetch_object(mysql_query("select * from tbproduct where id = '$id'")) or die(mysql_error());
}

if(isset($_POST['add']))
{
$id = $_GET['id'];
$product_name=$_POST['product_name'];
$quantity=$_POST['quantity'];
$price=$_POST['price'];
$unit_price=$_POST['unit_price'];
$imge_type=$_FILES['image']['type'];
$catid = $_POST['cat_id'];
$oldpic = $_POST['oldpic'];
$aridate = $_POST['aridate'];
$product_code = $_POST['product_code'];
$drivernum = $_POST['drivernum'];
$suplierid = $_POST['suplierid'];
$content = $_POST['content'];
$Description = $_POST['Description'];

$store=rand(0,989898989).$_FILES['image']['name'];

if(empty($_FILES['image']['tmp_name']))
{
mysql_query("update tbproduct set   product_name  ='$product_name',
                                    quantity      = '$quantity',
									price         = '$price',
									unit_price    = '$unit_price',
									cat_id        = '$catid',
									date          = '$aridate',
									prod_code     = '$product_code',
									Driver_num    = '$drivernum',
									suplierid     = '$suplierid',
									content       = '$content',
									Description   = '$Description' where id = '$id'"); 
header('Location: product.php');					
}
else
{
   if($imge_type=='image/jpeg' || $imge_type=='image/png'|| $imge_type=='image/gif'|| $imge_type=='image/jpg')
{
   unlink('product/'.$oldpic);
   move_uploaded_file($_FILES['image']['tmp_name'],'product/'.$store);
   mysql_query("update tbproduct set   product_name  ='$product_name',
                                    quantity      = '$quantity',
									price         = '$price',
									unit_price    = '$unit_price',
									cat_id        = '$catid',
									date          = '$aridate',
									prod_code     = '$product_code',
									Driver_num    = '$drivernum',
									suplierid     = '$suplierid',
									content       = '$content',
									Description   = '$Description',
									image         = '$store'where id = '$id'"); 

   header('Location: product.php');
}
else
  {
    echo("Invalid file or no image was selected");
  }
}
}
?>
   <form action="" method="post" enctype="multipart/form-data">
      <br>
<div class="contentheader" style="float: left;">
			<i class="icon-table"></i> Update Product
			</div><br>
<ul class="breadcrumb" style="float: left; width: 845;">
			<li style="float: left;"><a href="product.php">Products</a></li> 
			<li class="active" style="float: left;">Update Product</li>
			</ul><br>
<br>
      <table class="table" style="background:  #92a8d1; ">
	  <input type="hidden" name="id" value="<?= $row->id ?>">
	  <tr>
	  <td>
	  <label>Date Arrived</label>
	  <input type="date" style="width: 300px;" name="aridate" required value="<?= $row->date ?>" class="form-control">
	  </td>
	  <td>
	  <label>Product Code</label>
	  <input type="text" name="product_code" value="<?= $row->prod_code ?>" class="form-control">
	  </td>
	  </tr>
	  <tr>
	  <td>
	  <label>Driver Number</label>
	  <input type="text" name="drivernum" required value="<?= $row->Driver_num ?>" class="form-control">
	  </td>
	  <td>
	  <label>Supplier</label>
	  <select class="form-control" name="suplierid" >
	  <?php
	  $suplierid = $row->suplierid;
	  
	  $c = mysql_query("select * from supliers");
	  while($row = mysql_fetch_object($c))
	  {
	  if($suplierid==$r0w->suplierid)
	  {
	  
	  ?>
	  <option selected="Selected" value ="<?= $row->suplierid ?>"><?= $row->suplier_name ?></option>
	  <?php
      }
	  else
	  {
	  ?>
	  <option value ="<?= $row->suplierid ?>"><?= $row->suplier_name ?></option>
	  <?php
	  }
	  }
	  
	  ?>
	  </select>
	  </td>
	  </tr>
	  <?php 
	  $id = $_GET['id'];
	  $row = mysql_fetch_object(mysql_query("select * from tbproduct where id = '$id'")); ?>
	  <tr>
	  <td>
	  <label>Product Name</label>
	  <input type="text" name="product_name" required value="<?= $row->product_name ?>" class="form-control">
	  </td>
	  <td>
	  <label>Quantity</label>
	  <input type="text" name="quantity" value="<?= $row->quantity ?>" class="form-control">
	  </td>
	  </tr>
	  <tr>
	  <td>
	  <label>Price</label>
	  <input type="text" name="price" value="<?= $row->price ?>" class="form-control">
	  </td>
	  <td><label>Product Category</label>
	  <select class="form-control" name="cat_id" >
	  <?php
	  $catid = $row->cat_id;
	  
	  $c = mysql_query("select * from tbcategory");
	  while($row = mysql_fetch_object($c))
	  {
	  if($catid==$r0w->id)
	  {
	  
	  ?>
	  <option selected="Selected" value ="<?= $row->id ?>"><?= $row->category_name ?></option>
	  <?php
      }
	  else
	  {
	  ?>
	  <option value ="<?= $row->id ?>"><?= $row->category_name ?></option>
	  <?php
      
	  
	  }
	  }
	  
	  ?>
	  </select>
	  </td> 
	  </tr> 
	  <?php 
	  $row = mysql_fetch_object(mysql_query("select * from tbproduct where id = '$id'")); ?>
	  
	  <tr>
	  <td>
	  <label>Content</label>
	  <input type="text" name="content" value="<?= $row->content ?>" class="form-control">
	  </td>
	  <td>
	  <label>Description</label>
	  <input type="text" name="Description" value="<?= $row->Description ?>" class="form-control">
	  </td>
	  </tr>
	  <tr>
      <td>
	  <label>Image</label>
	  <input type="file" name="image" class="form-control">
	  <img width ="140" height="140" src ="product/<?= $row->image ?>">
	  <input type="hidden" name="oldpic" value="<?= $row->image ?>">
	  </td>
      </tr>
	  <tr>
	  <td><input type="submit" name="add" value="Update" class="btn btn-primay"></td></tr>
	  </table>
     </form>
<?php include_once('footer.php');?>
