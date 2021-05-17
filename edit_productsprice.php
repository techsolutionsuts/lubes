<?php include_once('headerad.php');
include_once('callfunction.php');


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
$unit_price=$_POST['uprice'];
$imge_type=$_FILES['image']['type'];
$catid = $_POST['cat_id'];
$oldpic = $_POST['oldpic'];
$aridate = $_POST['aridate'];
$product_code = $_POST['product_code'];
$drivernum = $_POST['drivernum'];
$suplierid = $_POST['suplierid'];
$content = $_POST['content'];
$Description = $_POST['Description'];
$duedate = $_POST['duedate'];
$personrec = $_POST['personrec'];
$dname = $_POST['dname'];
$car = $_POST['car'];
$invoice_num = $_POST['invoice_num'];
$pcost = $_POST['pcost'];
$personel =$_POST['personel'];


$store=rand(0,989898989).$_FILES['image']['name'];

if(empty($_FILES['image']['tmp_name']))
{
mysql_query("update tbproduct set price = '$price' where id = '$id'") or die(mysql_error()); 

//mysql_query("insert into retail_price (system_date,effective_date,product,personel,price) values(now(),'$aridate','$product_name','$personel','$price')") or die(mysql_error());

header('Location: product.php');
$_SESSION['prodname'] = $product_name;					
}
else
{
   if($imge_type=='image/jpeg' || $imge_type=='image/png'|| $imge_type=='image/gif'|| $imge_type=='image/jpg')
{
   unlink('product/'.$oldpic);
   move_uploaded_file($_FILES['image']['tmp_name'],'product/'.$store);
   mysql_query("update tbproduct set price = '$price' where id = '$id'") or die(mysql_error()); 

   header('Location: product.php');
}
else
  {
    echo("Invalid file or no image was selected");
  }
}
}
?>
	 <link rel="stylesheet" type="text/css" href="css/style2.css" media="screen" rel="stylesheet"/>
    
   <form action="" method="post" enctype="multipart/form-data">
      <center><h4><i class="icon-plus-sign icon-large"></i> Update Price</h4></center>

   <center>
  <div id="ac" style="background-color: #F0F8FF; width: 850px;">
  <div class="contentheader" style="float: left; background:  #b1cbbb;"><ul class="breadcrumb" >
			<li class="icon-table"> <a href="edit_products.php?id=<?= $row->id ?>">Update Product</a></li> 
			<li class="icon-table"> <a href="edit_productspric.php?id=<?= $row->id ?>">Change Price</a></li> 
			<li class="icon-table"> <a href="edit_productsup.php?id=<?= $row->id ?>">Change Unit Price</a></li> 
			<li class="icon-table"> <a href="edit_productsredu.php?id=<?= $row->id ?>&pname=<?=$row->product_name ?>">Transfer / Reduce</a></li> 
			</ul></div><br>
<ul class="breadcrumb" style="float: left; width: 845; background:   #7FFFD4 ;">
			<li style="float: left; "><a href="product.php">Products</a></li> 
			<li class="active" style="float: left;">Change Price</li>
			</ul>
<table style="color: blue">
<tr><td>
   <center style=" color: red;">You are about to change price of <?=$row->product_name ?></center><br><br>
   
  <span style="width:px; color: black;">Effective From: </span><input type="date"  style="width:265px; height:30px;" required name="aridate" >
  <span style="color: black;">Price</span><input type="text"  placeholder="Price" name="price" value="<?= $row->price ?>" required style="width:265px; height:30px;">
	  

  <span style="width:px; color: black;"></span><input type="date" hidden style="width:265px; height:30px;"  name="duedate" ></td></tr>
  <tr><td>
  <span style="color: black;"></span><input type="text" placeholder="Receiver Name" hidden style="width:265px; height:30px;" required name="personrec" >

  <span style="width:px; color: black;"></span><input type="text" hidden placeholder="Driver Name" style="width:265px; height:30px;"  name="dname" ></td></tr>
  <tr><td>
  <span style="width:px; color: black;"></span><input type="text" hidden placeholder="Car Number" style="width:265px; height:30px;"  name="car">
  <span style="color: black;"></span><input type="text" maxlength="10" hidden placeholder="Driver Phone Number" style="width:265px; height:30px;" name="drivernum" >
  </td></tr>
  <tr><td>
  <span style="width:px; color: black;"></span><input type="text" hidden style="width:265px; height:30px;" name="invoice_num" placeholder="D/Note No">

	  <span style="color: black;"></span><input type="text" hidden value="<?= $row->product_name ?>" readonly name="product_name" placeholder="Product Name" required style="width:265px; height:30px;">
  </td></tr>
  <tr><td>
  <span style="color: black;"></span>
	  <select style="width:265px; height:30px; margin-left:-5px;" hidden name="suplierid" >
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
      
     <span style="color: black;"></span><input type="number" hidden min="1" id="txtqty" onkeyup="sum();" name="quantity" oninput="qty();" placeholder="Quantity" required style="width:265px; height:30px;">
	  
<?php 
	  $id = $_GET['id'];
	  $row = mysql_fetch_object(mysql_query("select * from tbproduct where id = '$id'")) or die(mysql_error()); ?>
	  
    <span style="color: black;"></span><input type="text" hidden placeholder="Product Code" name="product_code" value="<?= $row->prod_code ?>" required style="width:265px; height:30px;"></td></tr>
	  <tr><td>
	  <?php 
	  $id = $_GET['id'];
	  $row = mysql_fetch_object(mysql_query("select * from tbproduct where id = '$id'"))  ?>
	  
	  <span style="color: black;"></span><input type="text" hidden readonly name="uprice" id="txtup" onkeyup="sum();" value="<?=$row->unit_price ?>" placeholder="Unit Price " required style="width:265px; height:30px;">

    </td></tr>
     <tr><td>
     <span style="color: black;"></span><input type="number" hidden readonly placeholder="Product Cost" name="pcost" required id="txt3" onkeyup="sum();" style="width:265px; height:30px;">
     <span style="color: black;"></span><input type="text" hidden placeholder="Price"  readonly id="txtqtyleft" required style="width:265px; height:30px;">
	  
     <span style="color: black;"></span>
     <input hidden value="<?= $row->cat_id ?>" name="catid" style="width:265px; height:30px; margin-left:-5px;">
	  </td></tr><p></p>
	  <?php 
	  $row = mysql_fetch_object(mysql_query("select * from tbproduct where id = '$id'")); ?>
	  
	  <tr><td>
	   <span style="color: black;"></span>
	   <input hidden value="<?= $row->content ?>" name="content" style="width:265px; height:30px; margin-left:-5px;">
       <span style="color: black;"></span><input type="text" hidden placeholder="Product Description" name="Description" value="<?= $row->Description ?>" required style="width:265px; height:30px;"></td></tr><br><br>
	   <tr><td>
	   <?php 
	  $row = mysql_fetch_object(mysql_query("select * from tbproduct where id = '$id'")); ?>
	  

	  <img width ="110" height="140" src ="product/<?= $row->image ?>">
	  <input type="hidden" name="oldpic" value="<?= $row->image ?>">
	   </td></tr>
	   <tr><td>
	   <span style="color: black;"></span><input type="hidden" name="image" style="width:265px; height:50px;"><br><br>
	   <span style="color: black;"></span>
     <input hidden value="<?= $row->System_Date ?>" name="" style="width:265px; height:30px; margin-left:-5px;">
     <span style="color: black;"></span><input type="hidden" name="personel" value="<?=$_SESSION['username'] ?>" style="width:265px; height:30px;">
     
     
       <div style="float:right; margin-right:250px; margin-top: -5px; margin-bottom: 40; width:265px; height:40px;">
       <span style="color: black;"></span><input type="hidden" name="sysdate" value="<?php echo datetime(); ?>" style="width:265px; height:30px;">
	     <button class="btn btn-success btn-block btn-large" name="add" style="width:267px; height:50px;"><i class="icon icon-save icon-large"></i> Update</button>
      </div></td></tr>

</table></div><br>
</center>

</form>

<?php include_once('footer.php');?>
