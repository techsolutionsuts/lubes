<?php include_once('headerad.php');
include_once('callfunction.php');
include('db/connect.php');

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
$catid = $_POST['catid'];
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
$qtyleft = $_POST['Qty_Left'];




mysql_query("update tbproduct set   product_name  = '$product_name',
                                    quantity      = '$quantity',
									price         = '$price',
									unit_price    = '$unit_price',
									cat_id        = '$catid',
									date          = '$aridate',
									prod_code     = '$product_code',
									Driver_num    = '$drivernum',
									DueDate       = '$duedate',
									invoicevalue  = '$pcost',
									suplierid     = '$suplierid',
									content       = '$content',
									Qty_Left      = '$qtyleft',
									receiver      = '$personrec',
									Driver_name   = '$dname',
									car_num       = '$car',
									invoice_num   = '$invoice_num',
									System_Date   =  now(),
									Personel      = '$personel',
									Description   = '$Description' where id = '$id'") or die(mysql_error());


mysql_query("insert into tb_stock_dynamics(productid,productcode,date,receipt_reduce_stock,closing_stock,total_stock,price,invoice,user,system_date,description,receive) values('$id','$product_code','$aridate','$quantity','$qtyleft','$qtyleft','$price','$invoice_num','$personel',now(),'$suplierid','$personrec')") or die(mysql_error());		 

mysql_query("insert into tballproduct(prod_code,cat_id,suplierid,product_name,quantity,Qty_Left,content,price,unit_price,Description,date,Driver_num,image,DueDate,invoicevalue,receiver,Driver_name,car_num,invoice_num,System_Date,Personel) 
                            values('$productcode','$catid','$suplierid','$product_name','$quantity','$qtyleft','$content','$price','$unit_price','$Description','$aridate','$drivernum','','$duedate','$pcost','$personrec','$dname','$car','$invoice_num',now(),'$personel')") or die(mysql_error());




header('Location: product.php');					
}
?>
	 <link rel="stylesheet" type="text/css" href="css/style2.css" media="screen" rel="stylesheet"/>
    <script>
    function qty(){
            var txtFirstNumberValue = document.getElementById('txtqty').value;
            var txtqtyleftNumberValue = document.getElementById('txtqtyleft').value;
            var qtyleft = parseFloat(txtFirstNumberValue) + parseFloat(txtqtyleftNumberValue);
            if (!isNaN(qtyleft)) {
                document.getElementById('txtqtylef').value = qtyleft;				
            }
        }

function sum() {
            var txtFirstNumberValue = document.getElementById('txtqty').value;
            var txtSecondNumberValue = document.getElementById('txtup').value;
            var result = parseFloat(txtFirstNumberValue) * parseFloat(txtSecondNumberValue);
            if (!isNaN(result)) {
                document.getElementById('txt3').value = result;

				
            }
			 var txtFirstNumberValue = document.getElementById('txt11').value;
            var result = parseInt(txtFirstNumberValue);
            if (!isNaN(result)) {
                document.getElementById('txt22').value = result;				
            }
			
			 var txtFirstNumberValue = document.getElementById('txt11').value;
            var txtSecondNumberValue = document.getElementById('txt33').value;
            var result = parseInt(txtFirstNumberValue) + parseInt(txtSecondNumberValue);
            if (!isNaN(result)) {
                document.getElementById('txt55').value = result;
				
            }
			
			 var txtFirstNumberValue = document.getElementById('txt4').value;
			 var result = parseInt(txtFirstNumberValue);
            if (!isNaN(result)) {
                document.getElementById('txt5').value = result;
				}
			
        }
</script>
   <form action="" method="post" enctype="multipart/form-data">
      <center><h4><i class="icon-plus-sign icon-large"></i> Update Product</h4></center>

   <center>
  <div id="ac" style="background-color: #F0F8FF; width: 850px;">
  <div class="contentheader" style="float: left; background:  #b1cbbb;"><ul class="breadcrumb" >
			<li class="icon-table"> <a href="edit_products.php?id=<?= $row->id ?>">Update Product</a></li> 
			<li class="icon-table"> <a href="edit_productspric.php?id=<?= $row->id ?>">Change Price</a></li> 
			<li class="icon-table"> <a href="edit_productsup.php?id=<?= $row->id ?>">Change Unit Price</a></li> 
			<li class="icon-table"> <a href="edit_productsredu.php?id=<?= $row->id ?>">Transfer / Reduce</a></li> 
			</ul></div><br>
<ul class="breadcrumb" style="float: left; width: 845; background:   #7FFFD4 ;">
			<li style="float: left; "><a href="product.php">Products</a></li> 
			<li class="active" style="float: left;">Update Product</li>
			</ul>
<table style="color: blue">
<tr><td>
  <span style="width:px; color: black;">Date Arrived: </span><input type="date" style="width:265px; height:30px;" required name="aridate" >

  <span style="width:px; color: black;">Due Date: </span><input type="date" style="width:265px; height:30px;"  name="duedate" ></td></tr>
  <tr><td>
  <span style="color: black;">Receiver: </span><input type="text" placeholder="Receiver Name" style="width:265px; height:30px;" required name="personrec" >

  <span style="width:px; color: black;">Driver Name: </span><input type="text" placeholder="Driver Name" style="width:265px; height:30px;"  name="dname" ></td></tr>
  <tr><td>
  <span style="width:px; color: black;">Car Number: </span><input type="text" placeholder="Car Number" style="width:265px; height:30px;"  name="car">
  <span style="color: black;">Phone:</span><input type="text" maxlength="10" placeholder="Driver Phone Number" style="width:265px; height:30px;" name="drivernum" >
  </td></tr>
  <tr><td>
  <span style="width:px; color: black;">Invoice No.: </span><input type="text" style="width:265px; height:30px;" name="invoice_num" placeholder="D/Note No">

	  <span style="color: black;">Product Name:</span><input type="text" value="<?= $row->product_name ?>" readonly name="product_name" placeholder="Product Name " required style="width:265px; height:30px;">
  </td></tr>
  <tr><td>
  <span style="color: black;">Supplier:</span>
	  <select style="width:265px; height:30px; margin-left:-5px;" name="suplierid" >
	  <?php
	  $c = mysql_query("select * from supliers");
	  while($row = mysql_fetch_object($c))
	  {
	  ?>
	  <option value ="<?= $row->suplier_name ?>"><?= $row->suplier_name ?></option>
	  <?php

	  }
	  
	  ?>
	  </select>
      
     <span style="color: black;">Quantity:</span><input type="number" min="1" id="txtqty" onkeyup="sum();" name="quantity" oninput="qty();" placeholder="Quantity" required style="width:265px; height:30px;">
	  
<?php 
	  $id = $_GET['id'];
	  $row = mysql_fetch_object(mysql_query("select * from tbproduct where id = '$id'")) or die(mysql_error()); ?>
	  
    <span style="color: black;"></span><input type="text" hidden placeholder="Product Code" name="product_code" value="<?= $row->prod_code ?>" required style="width:265px; height:30px;"></td></tr>
	  <tr><td>
	  <?php 
	  $id = $_GET['id'];
	  $row = mysql_fetch_object(mysql_query("select * from tbproduct where id = '$id'"))  ?>
	  
	  <span style="color: black;">Unit Price:</span><input type="text" readonly name="uprice" id="txtup" onkeyup="sum();" value="<?=$row->unit_price ?>" placeholder="Unit Price " required style="width:265px; height:30px;">

    <span style="color: black;">Price</span><input type="text" readonly placeholder="Price" name="price" value="<?= $row->price ?>" required style="width:265px; height:30px;">
	  </td></tr>
     <tr><td>
     <span style="color: black;">Product Cost:</span><input type="number" readonly placeholder="Product Cost" name="pcost" required id="txt3" onkeyup="sum();" style="width:265px; height:30px;">
     <span style="color: black;">Quantity Left:</span><input type="text" placeholder="Price" name="Qty_Left" readonly id="txtqtylef" value="<?= $row->Qty_Left ?>" required style="width:265px; height:30px;">
	  
	  <span style="color: black;"></span><input type="hidden" placeholder="Price" name="Qty_Lef" readonly id="txtqtyleft" oninput="qty();" value="<?= $row->Qty_Left ?>" required style="width:265px; height:30px;">

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
       <div style="float:right; margin-right:250px; margin-top: -5px; margin-bottom: 40; width:265px; height:40px;">
       <span style="color: black;"></span><input type="hidden" name="sysdate" value="<?php echo datetime(); ?>" style="width:265px; height:30px;">
       <span style="color: black;"></span><input type="hidden" name="personel" value="<?=$_SESSION['username'] ?>" style="width:265px; height:30px;">
     
	     <button class="btn btn-success btn-block btn-large" name="add" style="width:267px; height:50px;"><i class="icon icon-save icon-large"></i> Update</button>
      </div></td></tr>

</table></div><br>
</center>

</form>

<?php include_once('footer.php');?>
