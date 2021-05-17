<?php include_once('headerad.php');
if(isset($_GET['idd']))
{
$part= 'product/';
$image = mysql_fetch_object(mysql_query("select * from tbproduct where id = '{$_GET['idd']}'"));
$img = $image->image;
if(unlink($part.$img))
{
mysql_query("delete from tbproduct where id = '{$_GET['idd']}'");
header('location: product.php');
}

}

?>
<br>
<script src="js/application.js" type="text/javascript" charset="utf-8"></script>

<div class="contentheader" style="float: left;">
			<i class="icon-table"></i> Products
			</div><br>
<ul class="breadcrumb" style="float: left; width: 845;">
			<li style="float: left;"><a href="product.php">Products</a></li> 
			<li class="active" style="float: left;">Transfers</li>
			</ul>
      <center>
<br><br><br>
<a href="product.php">Products</a> | <a href="add_products.php">Add New</a> | <a href="allproductsrec.php">Product Receive</a> | <a href="ppd.php">PPD</a> | <a href="allproductsinsys.php">All Products</a> | <a href="currentstock.php">Current Products</a> | <a href="finihed.php">Finished Products</a> | <a href="trans.php">Transfers</a>
  <br><br><br><br>

  <form action="transcat.php" method="get" style="background-color:   rgb(200,200,200); width: 900; height: 100px;">
    <br>
   <table class = "table">
    <div class="row">
    <div class="row">
          <font color="black" style="font:bold 15px 'Aleo';"><p>Please select date range and category</p></font>
<strong>From: <input type="date" style="width: 170px; height: 20px; padding:14px;" name="from_sales_date" required ></strong> <strong> To:<input type="date" style="width: 170px; padding:14px; height:20px; " name="to_sales_date" required ></strong>
<select name="towhom" class="chzn-select" style="width: 120px; height:30px;" required>
  <option value="Send to Dormaa">Send to Dormaa </option>
  <option value="Dormaa Shell">From Dormaa </option>
  <option value="Complete Leakage">Complete Leakage</option>
	  <option value="Reconciliation">Reconciliation</option>
   </select>
       <Button type="submit" name="save" class="btn btn-info" style="width: 120px; height:35px; left:490px; position:relative; margin-top: -35px; margin-right:320px"><i class="icon-plus-sign icon-large"></i> Search</button>
</center>
       </div>
        <br><br>
        </table>
        </form><br>
      
               
               <!--<center><font color="green" style="font:bold 22px 'Aleo';"><?php echo $opps;?> </font></center>
               <center><font color="green" style="font:bold 22px 'Aleo';"><?php echo $notfinh;?> </font></center>-->

               <center><fon><br>

			    <input type="text" style="padding:15px; height:20px; " name="filter" value="" id="filter" placeholder="Search by name..." autocomplete="off" />
             <br><br>
             <div class="pull-right" style="margin-right:100px;">
    <a onclick="Clickheretoprint('content')" style="font-size:20px; position:absolute; margin-top: -70px; left: 800px"><button class="btn btn-success btn-large"><i class="icon-print"></i> Print</button></a>
    </div>
    <div class="content" id="content">
      <font color="red" style="font:bold 15px 'Aleo';"><p>These are products which were sent to Dormaa, reconciliation or was totaly drained out</p></font>

           <table border class="table table-bordered" id="resultTable" data-responsive="table">
      <thead>
	  <tr>	  
	  <th>Date</th>
	  <th>Product</th>
	  <th>Reason</th>
	  <th>Description</th>
	  <th>Quantity</th>
	  <th>Manage</th>
	  </tr>
	  </thead>
	  <tbody style = "background-color: #808080;">
	  <?php
	  $q =mysql_query("select * from subtracted_products");
	  while($row =mysql_fetch_object($q))
	  {
	  	
	  ?>
	  <tr>
	  <td><?php  $mysqldate=$row->date;
    $phpdate = strtotime( $mysqldate );
    $phpdate = date("d/m/Y",$phpdate);
    echo $phpdate; ?></td>	  
    <td><?=$row->productname ?></td>
    <td><?=$row->why ?></td>
	  <td><?=$row->reason ?></td>
	  <td><?=$row->qtytakenout ?></td>
	  <td><a href="edit_products.php?id=<?= $row->id ?>">Edit</a>|<a href="prodhistory.php?id=<?= $row->id ?>&pname=<?=$row->product_name ?>">History</a>
	  </tr>
	  <?php
	  }
	  ?>
	  </tbody>
	  </table>
</div>
<?php include_once('footer.php');?>