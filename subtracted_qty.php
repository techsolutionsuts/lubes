<?php include_once('headerad.php');
include_once('callfunction.php');
  include_once('db/connect.php');
  $select='';

if(isset($_GET['id']))
{

$id = $_GET['id'];
$row = mysql_fetch_object(mysql_query("select * from tbproduct where id = '$id'")) or die(mysql_error());
}

if(isset($_POST['add']))
{
$id = $_GET['id'];
$aridate = $_POST['aridate'];
$qtyleft=$_POST['qtyleft'];

$product_name =$_POST['productname'];
$personel  = $_POST['personel'];
$reason = $_POST['reason'];
$currentqty = $_POST['curqty'];
$qtyreduce = $_POST['qtyreduce'];
$send = $_POST['send'];

if ($send ==! '0') {
 
mysql_query("insert into subtracted_products (date, sysdate, productname, qtybefore, qtytakenout, qtyleft, why, reason, user, prodID) values('$aridate',now(),'$product_name','$currentqty','$qtyreduce','$qtyleft','$send','$reason','$personel','$id')") or die(mysql_error());

$result = $db->prepare("SELECT * FROM tbproduct WHERE id = :userid");
$result->bindParam(':userid', $id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$procode=$row['prod_code'];
$Qtylft=$row['Qty_Left'];
$ppname=$row['id'];
$price =$row['price'];
$qtyre = $qtyreduce*-1;

$more = "$send because $reason";

mysql_query("insert into tb_stock_dynamics(productid,productcode,date,receipt_reduce_stock,total_stock,closing_stock,price,user,system_date,description) values('$id','$procode','$aridate','$qtyre','$qtyleft','$qtyleft','$price','$personel',now(),'$more')") or die(mysql_error());     
}
mysql_query("update tbproduct set   Qty_Left = '$qtyleft' where id = '$id'") or die(mysql_error());


header('Location: product.php'); 
}
else{
$select = "Sorry you must select Why you are doing this.";
}         
}
?>
	 <link rel="stylesheet" type="text/css" href="css/style2.css" media="screen" rel="stylesheet"/>
    <script>
    function qty(){
            var txtFirstNumberValue = document.getElementById('txtqtyred').value;
            var txtqtyleftNumberValue = document.getElementById('domaths').value;
            var qtyleft = parseFloat(txtqtyleftNumberValue) - parseFloat(txtFirstNumberValue);
            if (!isNaN(qtyleft)) {
                document.getElementById('txtqty_left').value = qtyleft;
				
            }
        }

</script>

   <form action="" method="post" name="frm" enctype="multipart/form-data">

<script>

  if(frm.send.value == "0")
{
alert("Sorry you must select Why you are doing this.");
  frm.send.focus();
  return false;
}
</script>

      <center><h4><i class="icon-plus-sign icon-large"></i> Reduced Product Quantity</h4></center>

   <center>
  <div id="ac" style="background-color: #F0F8FF; width: 850px;">
  <div class="contentheader" style="float: left; background:  #b1cbbb;"><ul class="breadcrumb" >
			<li class="icon-table"> <a href="edit_products.php?id=<?= $row->id ?>">Update Product</a></li> 
			<li class="icon-table"> <a href="edit_productspric.php?id=<?= $row->id ?>">Change Price</a></li> 
			<li class="icon-table"> <a href="edit_productsup.php?id=<?= $row->id ?>">Change Unit Price</a></li> 
<li class="icon-table"> <a href="edit_productsredu.php?id=<?= $row->id ?>">Convertion</a></li>
      <li class="icon-table"> <a href=" subtracted_qty.php?id=<?= $row->id ?>">Transfer/Reduce Qty </a></li>
      <li class="icon-table"> <a href="prodhistory.php?id=<?= $row->id ?>&pname=<?=$row->product_name ?>">Product History</a></li> 
      			</ul></div><br>
<ul class="breadcrumb" style="float: left; width: 845; background:   #7FFFD4 ;">
			<li style="float: left; "><a href="product.php">Products</a></li> 
			<li class="active" style="float: left;">Reduced Product Quantity</li>
			</ul>
<table style="color: blue">
<tr><td>
<center style=" color: red;">You are about to reduced the quantity of <?=$row->product_name ?> <p></p> either it is leaking or it is been taken to Dormaa or whatever reason</center><br><br>

<span style="width:px; color: black;">Date: </span><input type="date"  style="width:265px; height:30px;" required name="aridate" >
  <span style="color: black;">Quantity to reduce:</span><input type="text"  placeholder="Reduce Qty by" name="qtyreduce" value="" id="txtqtyred" oninput="qty();" required style="width:265px; height:30px;">

  <span style="color: black;"></span><input type="text" hidden readonly name="curqty" id="domaths" value="<?=$row->Qty_Left ?>" oninput="qty();" required style="width:265px; height:30px;"><br><br>

<font style="color:blue; font:bold 18px 'Aleo';"><?php echo $select;?></font> <br>
  <span style="width:px; color: black;">Why:</span>
  <select style="width:265px; height: 30px;" name="send">
  <option value="0">Send to </option>
  <option value="Send to Dormaa">Send to Dormaa </option>
  <option value="Complete Leakage">Complete Leakage</option>
	  <option value="Reconciliation">Reconciliation</option>
</select>
</td>
</tr>
<tr><td>

<span style="color: black;">Current Quantity:</span><input type="text" hidde readonly name="qtyleft" id="txtqty_left" value="<?=$row->Qty_Left ?>" placeholder="Unit Price " required style="width:265px; height:30px;">
<span style="color: black;"></span><textarea type="text" hidde  name="reason"  placeholder="Description or comment" required style="width:265px; height:90px;"></textarea> 

  </td></tr>
  <tr><td></td></tr>
  <tr><td>
  </td></tr>
  <tr><td>
	  <span style="color: black;"></span><input type="text" hidden value="<?= $row->product_name ?>" readonly name="productname" placeholder="Product Name " required style="width:265px; height:30px;">
  </td></tr>
  <tr><td>
<?php 
	  $id = $_GET['id'];
	  $row = mysql_fetch_object(mysql_query("select * from tbproduct where id = '$id'")) or die(mysql_error()); ?></td></tr>
	  <tr><td>
	  
    </td></tr>
     <tr><td>
	  </td></tr>
	  <p></p></td></tr><br><br>
	   <tr><td>
	   <?php 
	  $row = mysql_fetch_object(mysql_query("select * from tbproduct where id = '$id'")); ?>
	  

	  <img width ="110" height="140" src ="product/<?= $row->image ?>">
	   </td></tr>
	   <tr><td
     <span style="color: black;"></span><input type="hidden" name="personel" value="<?=$_SESSION['username'] ?>" style="width:265px; height:30px;">
     
       <div style="float:right; margin-right:250px; margin-top: -5px; margin-bottom: 40; width:265px; height:40px;">
       
	     <button class="btn btn-success btn-block btn-large" name="add" style="width:267px; height:50px;"><i class="icon icon-save icon-large"></i> Update</button>
      </div></td></tr>

</table></div><br>
</center>

</form>

<?php include_once('footer.php');?>
