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
			<li class="active" style="float: left;">Finished Products</li>
			</ul>
      <center>
<br><br><br>
<a href="product.php">Products</a> | <a href="add_products.php">Add New</a> | <a href="allproductsrec.php">Product Receive</a> | <a href="ppd.php">PPD</a> | <a href="allproductsinsys.php">All Products</a> | <a href="currentstock.php">Current Products</a> | <a href="finihed.php">Finished Products</a> | <a href="trans.php">Transfers</a>
  <br><br><br><br>
      <?php 
      $opps='';
      $notfinh='';
			include('db/connect.php');
				$result = $db->prepare("SELECT * FROM tbproduct where Qty_Left = 0 ORDER BY id DESC");
				$result->execute();
				$rowcount123 = $result->rowcount();
				if($rowcount123==0){
					$opps ='Opps! No lube is TOTALLY FINISHED !!!!!!!!';
				}
				else{
					$notfinh = $rowcount123." are / is completelly Finished ";
				}

			?>
               
               <center><font color="green" style="font:bold 22px 'Aleo';"><?php echo $opps;?> </font></center>
               <center><font color="green" style="font:bold 22px 'Aleo';"><?php echo $notfinh;?> </font></center>

               <center><fon><br><br>

			    <input type="text" style="padding:15px; height:20px; " name="filter" value="" id="filter" placeholder="Search by name..." autocomplete="off" />
             <br><br>
             <div class="pull-right" style="margin-right:100px;">
    <a onclick="Clickheretoprint('content')" style="font-size:20px; position:absolute; margin-top: -110px; left: 800px"><button class="btn btn-success btn-large"><i class="icon-print"></i> Print</button></a>
    </div>
    <div class="content" id="content">
               <center><font color="green" style="font:bold 15px 'Aleo';"><?php echo $notfinh;?>  </font></center>

           <table border class="table table-bordered" id="resultTable" data-responsive="table">
      <thead>
	  <tr>
	  <th hidden>ProductID</th>
	  <th hidden>ProductCode</th>	  
	  <th>Last Date</th>
	  <th>Product</th>
	  <th>Source</th>
	  <th>Last Receipt</th>
	  <th>Qty Left</th>
	  <th>Price</th>
	  <th hidden>Descpt</th>
	  <th>Manage</th>
	  </tr>
	  </thead>
	  <tbody style = "background-color: #808080;">
	  <?php
	  $q =mysql_query("select * from tbproduct where Qty_Left='0'");
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
	  <td hidden><?=$row->id ?></td>
	  <td hidden><?=$row->prod_code ?></td>
	  <td><?php  $mysqldate=$row->date;
    $phpdate = strtotime( $mysqldate );
    $phpdate = date("d/m/Y",$phpdate);
    echo $phpdate; ?></td>	  
    <td><?=$row->product_name ?></td>
    <td><?=$row->suplierid ?></td>
	  <td><?=$row->quantity ?></td>
	  <td><?=$row->Qty_Left ?></td>
	  <td><?=$row->price ?></td>
	  <td hidden><?=$row->Description ?></td>
	  <td><a href="edit_products.php?id=<?= $row->id ?>">Edit</a>|<a href="prodhistory.php?id=<?= $row->id ?>&pname=<?=$row->product_name ?>">History</a>
	  </tr>
	  <?php
	  }
	  ?>
	  </tbody>
	  </table>
</div>
<?php include_once('footer.php');?>