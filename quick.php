<?php include_once('headerad.php');
include_once('callfunction.php');
  include_once('db/connect.php');


if(isset($_POST['add']))
{
$id = $_POST['id'];
$result = $db->prepare("SELECT * FROM tbproduct WHERE id = :userid");
$result->bindParam(':userid', $id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$sys=$row['System_Date'];
$per=$row['Personel'];
$date=$row['date'];
$name=$row['product_name'];
$price=$row['price'];
$uprice=$row['unit_price'];

}

mysql_query("insert into retail_price (prodid,system_date,effective_date,product,personel,price) values('$id','$sys','$date','$name','$per','$price')") or die(mysql_error());

mysql_query("insert into unit_price (prodid,system_date,effective_date,product,personel,price) values('$id','$sys','$date','$name','$per','$uprice')") or die(mysql_error());


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
   <form action="" method="post" enctype="multipart/form-data">
      <center><h4><i class="icon-plus-sign icon-large"></i> Reduced Product Quantity</h4></center>

   <center>
  <div id="ac" style="background-color: #F0F8FF; width: 850px;">
  <div class="contentheader" style="float: left; background:  #b1cbbb;"><ul class="breadcrumb" >
			<li class="icon-table"> <a href="edit_products.php?id=<?= $row->id ?>">Update Product</a></li> 
			<li class="icon-table"> <a href="edit_productspric.php?id=<?= $row->id ?>">Change Price</a></li> 
			<li class="icon-table"> <a href="edit_productsup.php?id=<?= $row->id ?>">Change Unit Price</a></li> 
			<li class="icon-table"> <a href="edit_productsredu.php?id=<?= $row->id ?>">Transfer / Reduce</a></li> 
			<li class="icon-table"> <a href="prodhistory.php?id=<?= $row->id ?>&pname=<?=$row->product_name ?>">Product History</a></li> 

      </ul></div><br>
<ul class="breadcrumb" style="float: left; width: 845; background:   #7FFFD4 ;">
			<li style="float: left; "><a href="product.php">Products</a></li> 
			<li class="active" style="float: left;">Reduced Product Quantity</li>
			</ul>
<table style="color: blue">
<tr><td>
<center>
<select style="width:340px;" name="id">
  <option value="0">Convert to </option>
  <?php
  include('db/connect.php');
  $result = $db->prepare("SELECT * FROM tbproduct");
    $result->bindParam(':userid', $res);
    $result->execute();
    for($i=0; $roww = $result->fetch(); $i++){
  ?>
    <option value="<?php echo $roww['id'];?>"><?php echo $roww['product_name']; ?> | Qty Left:<?php echo $roww['Qty_Left']; ?></option>
  <?php
        }
      ?>
</select>
</center>
<br><br><br><br>
	     <button class="btn btn-success btn-block btn-large" name="add" style="width:267px; height:50px;"><i class="icon icon-save icon-large"></i> Update</button>
      </div></td></tr>

</table></div><br>
</center>

</form>

<?php include_once('footer.php');?>
