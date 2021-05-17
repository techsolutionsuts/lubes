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
$uprice=$_POST['uprice'];
$aridate = $_POST['aridate'];
mysql_query("update tbproduct set   unit_price         = '$uprice',
									date          = '$aridate' where id = '$id'");

$product_name =$_POST['productname'];
$personel  = $_POST['personel'];

$ids = $_GET['id'];
mysql_query("insert into unit_price (prodid,system_date,effective_date,product,personel,price) values('$id',now(),'$aridate','$product_name','$personel','$uprice')") or die(mysql_error());

header("Location: edit_productsup.php?id=$ids");					
}
?>   <script src="js/application.js" type="text/javascript" charset="utf-8"></script>

	 <link rel="stylesheet" type="text/css" href="css/style2.css" media="screen" rel="stylesheet"/>
    <form action="" name="frm" method="post" enctype="multipart/form-data">
      <center><h4><i class="icon-plus-sign icon-large"></i> Chage Product Unit Price</h4></center>

   <center>
  <div id="ac" style="background-color: #F0F8FF; width: 850px;">
  <div class="contentheader" style="float: left; background:  #b1cbbb;"><ul class="breadcrumb" >
			<li class="icon-table"> <a href="edit_products.php?id=<?= $row->id ?>">Update Product</a></li> 
			<li class="icon-table"> <a href="edit_productspric.php?id=<?= $row->id ?>">Change Price</a></li> 
			<li class="icon-table"> <a href="edit_productsup.php?id=<?= $row->id ?>">Change Unit Price</a></li> 
      <li class="icon-table"> <a href="edit_productsredu.php?id=<?= $row->id ?>">Convertion</a></li>
      <li class="icon-table"> <a href=" subtracted_qty.php?id=<?= $row->id ?>">Transfer/Reduce Qty </a></li>		    <li class="icon-table"> <a href="prodhistory.php?id=<?= $row->id ?>&pname=<?=$row->product_name ?>">Product History</a></li> 

			</ul></div><br>
<ul class="breadcrumb" style="float: left; width: 845; background:   #7FFFD4 ;">
			<li style="float: left; "><a href="product.php">Products</a></li> 
			<li class="active" style="float: left;">Change Unit Price</li>
			</ul>
<table style="color: blue">
<tr><td>
<center style=" color: red;">You are about to change unit price of <?=$row->product_name ?></center><br><br>
  <span style="width:px; color: black;">Effective From: </span><input type="date" value="<?php echo date('Y-m-d')?>"  style="width:265px; height:30px;" required name="aridate" >
  <span style="color: black;">Unit Price:</span><input type="text"  name="uprice" value="<?=$row->unit_price ?>" placeholder="Unit Price " required style="width:265px; height:30px;">

  </td></tr>
	  <tr><td>
	  </td></tr>
  	   <tr><td>
	   <?php 
	  $row = mysql_fetch_object(mysql_query("select * from tbproduct where id = '$id'")); ?>

	  <span style="color: black;"></span><input type="text" hidden placeholder="Price" name="productname" value="<?= $row->product_name ?>" required style="width:265px; height:30px;">

	  <img width ="110" height="140" src ="product/<?= $row->image ?>">
       <div style="float:right; margin-right:250px; margin-top: 70px; margin-bottom: 40; width:265px; height:40px;">
       <span style="color: black;"></span><input type="hidden" name="sysdate" style="width:265px; height:30px;">

       <span style="color: black;"></span><input type="hidden" name="personel" value="<?=$_SESSION['username'] ?>" style="width:265px; height:30px;">
     
	     <button class="btn btn-success btn-block btn-large" name="add" onclick="return val();" style="width:267px; height:50px;"><i class="icon icon-save icon-large"></i> Update</button>
      </div></td></tr>

</table></div><br>
</center>
<div class="pull-right" style="margin-right:100px;">
    <a onclick="Clickheretoprint('content')" style="font-size:20px; position:absolute; margin-top: -10px; left: 800px"><button class="btn btn-success btn-large"><i class="icon-print"></i> Print</button></a>
    <br><br>
    </div>
    <input type="text" style="padding:15px; height:20px; " name="filter" value="" id="filter" placeholder="Search by date..." autocomplete="off" />
             <br><br>
<div class="content" id="content">

<caption><center>Unit Price changes from time to time </center></caption>
<center>
<table border="" class="table table-bordered" id="resultTable" data-responsive="table">
<thead>
              <tr>
   <th>Effective Date</th>
   <th>Unit Price</th>
   <th>User</th>
   <th>System Time</th>
   </tr>
   </thead>
<?php 

               $id = $_GET['id'];

              include('db/dbb.php');
        $result = $db->query("SELECT * FROM unit_price where prodid  = '$id'  order by effective_date ");
while ($row = $db->fetchNextObject($result)) {
?>
      
        <tr>
        <td><?php  $mysqldate=$row->effective_date;
    $phpdate = strtotime( $mysqldate );
    $phpdate = date("d/m/Y",$phpdate);
    echo $phpdate; ?></td>
                <td><?php echo formatMoney($row->price,true); ?></td>
                <td><?php echo $row->personel; ?></td>
<td><?php  $mysqldate=$row->system_date;
    $phpdate = strtotime( $mysqldate );
    $phpdate = date("d/m/Y h:i:s",$phpdate);
    echo $phpdate; ?></td>

                        </tr>
          <?php
}
          ?>

</table>
</center>
</div>
</form>

<?php include_once('footer.php');?>
