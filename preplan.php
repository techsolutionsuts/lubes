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
			<li class="active" style="float: left;">Current Products</li>
			</ul>
<br><br><br>
<a href="product.php">Products</a> | <a href="add_products.php">Add New</a> | <a href="allproductsrec.php">Product Receive</a> | <a href="ppd.php">PPD</a> | <a href="allproductsinsys.php">All Products</a> | <a href="currentstock.php">Current Products</a> | <a href="finihed.php">Finished Products</a> | <a href="preplan.php">Pre Plan</a>
      <br><br>

             <div class="pull-right" style="margin-right:100px;">
    <a onclick="Clickheretoprint('content')" style="font-size:20px; position:absolute; margin-top: -110px; left: 800px"><button class="btn btn-success btn-large"><i class="icon-print"></i> Print</button></a>
    </div>
    <div class="content" id="content">
<center><div style="font:bold 20px 'Aleo';">Sunyani Shell Service Station</div>
	Pre-plan Form<br>
		

	</center>
Month/Year:  <input type="text" style="width: 250px;" Placeholder="Enter Date"  value="" class="form-control"><br>
	
           <table border="1" class="table table-bordered" id="resultTable" data-responsive="table">
      <thead>
	  <tr>
	  <th>Product</th>
	  <th>Monthly Target (minimum)</th>
	  <th>Current Stock (pics)</th>
	  <th>Stock Value</th>
	  <th>Current requirement (Packs)</th>
	  <th>Outstanding from previous mth</th>
	  </tr>
	  </thead>
	  <tbody style = "background-color: #808080;">
	  <?php
	  $q =mysql_query("select * from tbproduct where not214 != 214");
	  while($row =mysql_fetch_object($q))
	  {
	  	$availableqty=$row->Qty_Left;
				if ($availableqty < 10) {
	  	echo '<tr class="alert alert-warning record" style="color: #fff; background:rgb(255, 95, 66);">';
				}
				else {
				echo '<tr class="record">';
				}
	  ?>
	  <tr>  
    <td><?=$row->product_name ?></td>
    <td></td>
	  <td><?=$row->Qty_Left ?></td>
	  <td></td>      
	  <td> <input type="text" id="amt" oninput="qty();" style="width: 200px;" name="amount" Placeholder="Enter quantity"required value="" class="form-control"></td>
      <td></td>
	  <?php
	  }
	  ?>
		  </tr>
	  
	  </tbody>
	  </table>

<?php include_once('footer.php');?>