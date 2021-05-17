<?php 
include('db/connect.php');
include_once('headerad.php');
include_once('callfunction.php');
if(isset($_POST['add']))
{
//$sysdat = $_POST['sysdate'];
$product_name=$_POST['product_name'];
$quantity=$_POST['quantity'];
//$qtyl = $_POST['qty_left'];
$price=$_POST['price'];
$unit_price=$_POST['uprice'];
$imge_type=$_FILES['image']['type'];
$catid = $_POST['cat_id'];
$aridate = $_POST['aridate'];
$productcode = $_POST['product_code'];
$suplierid = $_POST['suplier_name'];
$content = $_POST['content'];
$drivernum = $_POST['drivernum'];
$Description = $_POST['Description'];
$duedate = $_POST['duedate'];
$personrec = $_POST['personrec'];
$dname = $_POST['dname'];
$car = $_POST['car'];
$invoice_num = $_POST['invoice_num'];
$pcost = $_POST['pcost'];
$personel =$_POST['personel'];
$store=rand(0,989898989).$_FILES['image']['name'];
if($imge_type=='image/jpeg' || $imge_type=='image/png'|| $imge_type=='image/gif'|| $imge_type=='image/jpg')
{
move_uploaded_file($_FILES['image']['tmp_name'],'product/'.$store);

mysql_query("insert into tbproduct(prod_code,cat_id,suplierid,product_name,quantity,Qty_Left,content,price,unit_price,Description,date,Driver_num,image,DueDate,invoicevalue,receiver,Driver_name,car_num,invoice_num,System_Date,Personel) 
                            values('$productcode','$catid','$suplierid','$product_name','$quantity','$quantity','$content','$price','$unit_price','$Description','$aridate','$drivernum','$store','$duedate','$pcost','$personrec','$dname','$car','$invoice_num',now(),'$personel')") or die(mysql_error());


$result = $db->prepare("SELECT * FROM tbproduct WHERE prod_code = :userid");
$result->bindParam(':userid', $productcode);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$pid=$row['id'];

}

mysql_query("insert into tb_stock_dynamics(productid,productcode,date,receipt_reduce_stock,closing_stock,total_stock,price,invoice,user,system_date,description,receive) values('$pid','$productcode','$aridate','$quantity','$quantity','$quantity','$price','$invoice_num','$personel',now(),'$suplierid','$personrec')") or die(mysql_error());

mysql_query("insert into tballproduct(prod_code,cat_id,suplierid,product_name,quantity,Qty_Left,content,price,unit_price,Description,date,Driver_num,image,DueDate,invoicevalue,receiver,Driver_name,car_num,invoice_num,System_Date,Personel) 
                            values('$productcode','$catid','$suplierid','$product_name','$quantity','$quantity','$content','$price','$unit_price','$Description','$aridate','$drivernum','','$duedate','$pcost','$personrec','$dname','$car','$invoice_num',now(),'$personel')") or die(mysql_error());


header('Location: product.php');					
}
else
{
echo("Invalid file or no image was selected");
}
}
?>
	 <link rel="stylesheet" type="text/css" href="css/style2.css" media="screen" rel="stylesheet"/>
   
     <script>
function sum() {
            var txtFirstNumberValue = document.getElementById('txtqty').value;
            var txtSecondNumberValue = document.getElementById('txtup').value;
            var result = parseFloat(txtFirstNumberValue) * parseFloat(txtSecondNumberValue);
            if (!isNaN(result)) {
                document.getElementById('txt3').value = result;
				
            }
        }
            </script>
   <form action="" method="post" enctype="multipart/form-data">
   
   <center><h4><i class="icon-plus-sign icon-large"></i> Add New Product</h4></center>

   <center>
  <div id="ac" style="background-color:    #FFE4C4  ; width: 850px;">
  <div class="contentheader" style="float: left; background:  #b1cbbb;">
			<i class="icon-table"></i> Add Product
			</div><br>
<ul class="breadcrumb" style="float: left; width: 845; background:   #7FFFD4 ;">
			<li style="float: left; "><a href="product.php">Products</a></li> 
			<li class="active" style="float: left;">Add Product</li>
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
  <span style="color: black;">Driver Number:</span><input type="text" maxlength="10" placeholder="Driver Phone Number" style="width:265px; height:30px;" name="drivernum">
  </td></tr>
  <tr><td>
  <span style="width:px; color: black;">Invoice No.: </span><input type="text" style="width:265px; height:30px;" name="invoice_num" placeholder="D/Note No" >
  <span style="color: black;">Product Code:</span><input type="text" placeholder="Product Code" style="width:265px; height:30px;" name="product_code" required/>
  </td></tr>
  <tr><td>
  <span style="color: black;">Supplier:</span>
	  <select style="width:265px; height:30px; margin-left:-5px;" name="suplier_name" >
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
	  <span style="color: black;">Product Name:</span><input type="text" name="product_name" placeholder="Product Name " required style="width:265px; height:30px;"> </td></tr>
	  <tr><td>
     <span style="color: black;">Quantity:</span><input type="number" min="1" id="txtqty" onkeyup="sum();" name="quantity" placeholder="Quantity" required style="width:265px; height:30px;">
	  <span style="color: black;">Unit Price:</span><input type="text" name="uprice" id="txtup" onkeyup="sum();" placeholder="Unit Price " required style="width:265px; height:30px;"></td></tr>
     <tr><td>
     <span style="color: black;">Price</span><input type="text" name="price" placeholder="Price" required style="width:265px; height:30px;">
     <span style="color: black;">Product Category:</span>
	  <select style="width:265px; height:30px; margin-left:-5px;" name="cat_id" >
	  <?php
	  $c = mysql_query("select * from tbcategory");
	  while($row = mysql_fetch_object($c))
	  {
	  ?>
	  <option value ="<?= $row->id ?>"><?= $row->category_name ?></option>
	  <?php

	  }
	  
	  ?>
	  </select></td></tr><p></p>
	  <tr><td>
	   <span style="color: black;">Content:</span>
	   <select name="content" style="width:265px; height:30px; margin-left:-5px;">
       <option value="0.50">500ml</option>
       <option value="1">1L</option>
       <option value="4">4L</option>
       <option value="5">5L</option>
       <option value="209">209L</option>
       <option value="214">214L</option>

	   </select>
	   <span style="color: black;">Description:</span><input type="text" placeholder="Product Description" name="Description" required style="width:265px; height:30px;"></td></tr><br><br>
	   <tr><td>
	   <span style="color: black;">Product Cost:</span><input type="number" id="txt3" onkeyup="sum();" readonly placeholder="Product Cost" name="pcost" required style="width:265px; height:30px;">
	   </td></tr>
	   <tr><td>
	   <span style="color: black;">Image:</span><input type="file" name="image" style="width:265px; height:50px;">
	   <span style="color: black;"></span><input type="hidden" name="sysdate" value="<?php  datetime(); ?>" style="width:265px; height:30px;">
	   <span style="color: black;"></span><input type="hidden" name="personel" value="<?=$_SESSION['username'] ?>" style="width:265px; height:30px;">
     
     
       <div style="float:right; margin-right:40px; margin-top: -50px; width:265px; height:40px;">
	     <button class="btn btn-success btn-block btn-large" name="add" style="width:267px; height:50px;"><i class="icon icon-save icon-large"></i> Add</button>
      </div></td></tr>

</table>
  
</div><br>
</center>

</form>



<?php include_once('footer.php');?>
