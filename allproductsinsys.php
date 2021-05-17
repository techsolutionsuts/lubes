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
<a href="product.php">Products</a> | <a href="add_products.php">Add New</a> | <a href="allproductsrec.php">Product Receive</a> | <a href="ppd.php">PPD</a> | <a href="allproductsinsys.php">All Products</a> | <a href="currentstock.php">Current Products</a> | <a href="finihed.php">Finished Products</a> | <a href="trans.php">Transfers</a>

      <center>
      <div style ="color: red ">
      <?php 
			include('db/connect.php');
				$result = $db->prepare("SELECT * FROM tbproduct ORDER BY id DESC");
				$result->execute();
				$rowcount = $result->rowcount();
			?>
			Total Number of Products with Stock: <font color="green" style="font:bold 22px 'Aleo';"><?php echo $rowcount;?></font>
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

             <div class="pull-right" style="margin-right:100px;">
    <a onclick="Clickheretoprint('content')" style="font-size:20px; position:absolute; margin-top: -110px; left: 800px"><button class="btn btn-success btn-large"><i class="icon-print"></i> Print</button></a>
    </div>
    <div class="content" id="content">
<center><div style="font:bold 20px 'Aleo';">Sunyani Shell Service Station</div>
	Lubricants Inventory System<br>
	Sunyani Shell, Opp. Jubilee Park
		<img width="50" height="50" style="float: right; left: 590px; margin-top: -30px; position: absolute;" src="images/slide/slide1.png">

	</center>
All Products, Date Time: <?php echo date('d-m-Y h:i:s'); ?><br>
	
           <table border="1" class="table table-bordered" id="resultTable" data-responsive="table">
      <thead>
	  <tr>
	  <th hidden>ProductID</th>
	  <th hidden>ProductCode</th>	  
	  <th>Last Date</th>
	  <th>Product</th>
	  <th>Source</th>
	  <th>Last Receipt</th>
	  <th>Qty Left</th>
	  <th>UnitPrice</th>
	  <th>Price</th>
	  <th hidden>Descpt</th>
	  <th>Manage</th>
	  </tr>
	  </thead>
	  <tbody style = "background-color: #808080;">
	  <?php
	          include('db/connect.php');
				$result = $db->prepare("SELECT * FROM tbproduct ORDER BY id asc");
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
	  	$availableqty=$row['Qty_Left'];
				if ($availableqty < 10) {
	  	echo '<tr class="alert alert-warning record" style="color: #fff; background:rgb(255, 95, 66);">';
				}
				else {
				echo '<tr class="record">';
				}
	  ?>
	  <tr>
	  <td hidden><?php echo $row['id']; ?></td>
	  <td hidden><?php echo $row['pro_code']; ?></td>
	  <td><?php  $mysqldate=$row['date'];
    $phpdate = strtotime( $mysqldate );
    $phpdate = date("d/m/Y",$phpdate);
    echo $phpdate; ?></td>	  
    <td><?php echo $row['product_name']; ?></td>
    <td><?php echo $row['suplierid']; ?></td>
	  <td><?php echo $row['quantity']; ?></td>
	  <td><?php echo $row['Qty_Left']; ?></td>
	  <td><?php $up=$row['unit_price']; echo formatMoney($up,true); ?></td>      
	  <td><?php $pro=$row['price']; echo formatMoney($pro,true); ?></td>      
	  <td hidden><?php echo $row['Description']; ?></td>
	  <td><a href="edit_products.php?id=<?php $row['id'] ?>">Edit</a>|<a href="prodhistory.php?id=<?php $row['id'] ?>&pname=<?php $row['product_name']; ?>">History</a>
	  </tr>
	  <?php
	  }
	  ?>
	  <tr>
                  <th colspan="4"><strong style="font-size: 12px; color: #222222;">Total:</strong></th>
                  <td colspan="1"><strong style="font-size: 12px; color: #222222;"></strong></td>
        <td colspan="1"><strong style="font-size: 12px; color: #222222;">
        <?php

	          include('db/connect.php');
	          $result = $db->prepare("SELECT sum(unit_price*Qty_Left) as cost FROM tbproduct ORDER BY Qty_Left DESC");
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
        $upr=$row['cost'];
        echo formatMoney($upr, true);
        }
        ?>
        </strong></td>
        <td colspan="1"><strong style="font-size: 12px; color: #222222;">
        <?php
        			include('db/connect.php');

	          $result = $db->prepare("SELECT sum(price*Qty_Left) as sell FROM tbproduct ORDER BY Qty_Left DESC");
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
        $pp=$row['sell'];
        echo formatMoney($pp, true);
        }
        ?>
        </strong></td>
        <tr>
                  <th colspan="5"><strong style="font-size: 12px; color: #222222;">Margin:</strong></th>
                  <td colspan="1"><strong style="font-size: 12px; color: #222222;"></strong></td>
        <td colspan="1"><strong style="font-size: 12px; color: #222222;">
        <?php
	          $ttout = $pp - $upr;
	          echo formatMoney($ttout, true);
        ?>
        </strong></td>
  
	  </tbody>
	  </table>

<?php include_once('footer.php');?>