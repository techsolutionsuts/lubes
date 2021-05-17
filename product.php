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
			<li class="active" style="float: left;">Products</li>
			</ul>
<br><br><br>
<a href="product.php">Products</a> | <a href="add_products.php">Add New</a> | <a href="allproductsrec.php">Product Receive</a> | <a href="ppd.php">PPD</a> | <a href="allproductsinsys.php">All Products</a> | <a href="currentstock.php">Current Products</a> | <a href="finihed.php">Finished Products</a> | <a href="trans.php">Transfers</a>
      <center>
      <div style ="color: red ">
      <?php 
			include('db/connect.php');
				$result = $db->prepare("SELECT * FROM tbproduct ORDER BY id DESC");
				$result->execute();
				$rowcount = $result->rowcount();
			?>
			Total Number of Products: <font color="green" style="font:bold 22px 'Aleo';"><?php echo $rowcount;?></font>
			</div>
			<?php 
			include('db/connect.php');
				$result = $db->prepare("SELECT * FROM tbproduct where Qty_Left < 10 ORDER BY id DESC");
				$result->execute();
				$rowcount123 = $result->rowcount();

			?>
			<div style="color: red">
			<font style="color:rgb(255, 95, 66);; font:bold 22px 'Aleo';">[<?php echo $rowcount123;?>]</font> Products are below QTY of 10 
			</div></center><br>

			    <input type="text" style="padding:15px; height:20px; " name="filter" value="" id="filter" placeholder="Search by name..." autocomplete="off" />
             <br><br>
           <table class="table table-bordered" id="resultTable" data-responsive="table">
      <thead>
	  <tr>
	  <th>ProductID</th>
	  <th>ProductCode</th>	  
	  <th>Product Name</th>
	  <th>Quantity</th>
	  <th>Qty Left</th>
	  <th>Price</th>
	  <th>Descpt</th>
	  <th>Date</th>
	  <th>Image</th>
	  <th>Manage</th>
	  </tr>
	  </thead>
	  <tbody style = "background-color: #808080;">
	  <?php
	  $q =mysql_query("select * from tbproduct");
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
	  <td><?=$row->id ?></td>
	  <td><?=$row->prod_code ?></td>
	  <td><?=$row->product_name ?></td>
	  <td><?=$row->quantity ?></td>
	  <td><?=$row->Qty_Left ?></td>
	  <td><?=$row->price ?></td>
	  <td><?=$row->Description ?></td>
      <td><?=$row->date ?></td>
      <td><img width="30" height="30" src="product/<?=$row->image ?>"/></td>
	  <td><a href="edit_products.php?id=<?= $row->id ?>">Edit</a>|<a href="prodhistory.php?id=<?= $row->id ?>&pname=<?=$row->product_name ?>">History</a><a hidden href="product.php?idd=<?= $row->id ?>">Remove</a>

	  </tr>
	  <?php
	  }
	  ?>
	  </tbody>
	  </table>

<?php include_once('footer.php');?>