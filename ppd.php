<?php include_once('headerad.php');
$fromdate='';
$todate='';
$sal='';
$no='';
if(isset($_GET['save'])){

if(isset($_GET['from_sales_date']) && $_GET['from_sales_date']!='')
{


      
      $mysqldate = $_GET['from_sales_date'];
      $disfdate = $mysqldate;

$fromdate=$mysqldate;
$sal =("PPD: ".$disfdate);

}
else{

$no = ('Sorry No roducts were received on the specified date:');
}
}
?>
<br>
<script src="js/application.js" type="text/javascript" charset="utf-8"></script>

<div class="contentheader" style="float: left;">
			<i class="icon-table"></i> Products
			</div><br>
<ul class="breadcrumb" style="float: left; width: 940;">
			<li style="float: left;"><a href="product.php">Products</a></li> 
			<li class="active" style="float: left;">Product Receive</li>
			</ul>
<br><br><br>
<a href="product.php">Products</a> | <a href="add_products.php">Add New</a> | <a href="allproductsrec.php">Product Receive</a> |<a href="ppd.php">PPD</a> | <a href="allproductsinsys.php">All Products</a> | <a href="currentstock.php">Current Products</a> | <a href="finihed.php">Finished Products</a> | <a href="trans.php">Transfers</a><br><br>
<form action="" method="get" style="background-color: rgb(200,200,200); width: 980;">
<br><br><br><br>
<center> <!--<strong>Date : <input type="date" style="width: 223px; height: 20px; padding:14px;" name="from_sales_date" required ></strong>-->
	
	<select name="from_sales_date" class="chzn-select" style="width:200px; height: 35; margin-top: -2px; left:60px; position: absolute;" required>
   <option value="0">Select PPD....</option>
  <?php
  include('db/connect.php');
  $result = $db->prepare("SELECT ppd FROM tballproduct  group by ppd");
    $result->bindParam(':userid', $res);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
  ?>
    <option value="<?php echo $row['ppd'];?>"><?php  echo $row['ppd']; ?></option>
  <?php
        }
      ?>
</select>
	
       <Button type="submit" name="save" class="btn btn-info" style="width: 120px; height:35px; left:10px; position:relative; margin-top: -5px; margin-right:340px"><i class="icon-plus-sign icon-large"></i> Search</button>
</center>

      <br>

            <br><br>
             <div class="pull-right" style="margin-right:100px;">
    <a onclick="Clickheretoprint('content')" style="font-size:20px; position:absolute; margin-top: -110px; left: 800px"><button class="btn btn-success btn-large"><i class="icon-print"></i> Print</button></a>
    </div>
    <div class="content" id="content">
    <center><div style="font:bold 20px 'Aleo';">Sunyani Shell Service Station</div>
  Lubricants Inventory System<br>
  Sunyani Shell, Opp. Jubilee Park
    <img width="50" height="50" style="float: right; left: 690px; margin-top: -30px; position: absolute;" src="images/slide/slide1.png">
  </center>
<?php echo $sal; ?><br>

           <table border="1" class="table table-bordered" id="resultTable" data-responsive="table">
      <thead>
	  <tr>
	  <th>Date</th>
    <th>PPD</th>
	  <th>ProductName</th>
	  <th>Invoice</th>	  
	  <th>Source</th>
	  <th>Receiever</th>
	  <th>Driver</th>
	  <th>CarNumber</th>
	  <th>Quantity</th>
	  <th>UnitPrice</th>
	  <th>Price</th>
	  </tr>
	  </thead>
	  <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
          
	  <tbody style = "background-color: #808080;">
	  <?php
	          include('db/connect.php');

	  $result = $db->prepare("SELECT * FROM tballproduct WHERE ppd= :userid");
        $result->bindParam(':userid', $fromdate);
        $result->execute();
        for($i=1; $row = $result->fetch(); $i++){

      ?>
                <tr>
                <td><?php  $mysqldate=$row['date'];
    $phpdate = strtotime( $mysqldate );
    $phpdate = date("d/m/Y",$phpdate);
    echo $phpdate; ?></td>
                <td><?php echo $row['ppd']; ?></td>
                <td><?php echo $row['product_name']; ?></td>
                <td><?php echo $row['invoice_num']; ?></td>
                <td><?php echo $row['suplierid']; ?></td>
                <td><?php echo $row['receiver']; ?></td>
                <td><?php echo $row['Driver_name']; ?></td>
                <td><?php echo $row['Car_num']; ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <td><?php $ppp=$row['unit_price'];
                echo formatMoney($ppp, true); ?></td>
                <td><?php $pro=$row['invoicevalue']; echo formatMoney($pro,true); ?></td>      
	  </tr>
	  <?php
	  }
	  ?>
<tr>
                  <th colspan="9"><strong style="font-size: 12px; color: #222222;">Total:</strong></th>
                  <td colspan="1"><strong style="font-size: 12px; color: #222222;"></strong></td>
        <td colspan="1"><strong style="font-size: 12px; color: #222222;">
        <?php
        
          
	          include('db/connect.php');
        $result = $db->prepare("SELECT sum(invoicevalue) FROM tballproduct WHERE ppd= :invoi");
        $result->bindParam(':invoi', $fromdate);
        $result->execute();
        for($i=0; $rows = $result->fetch(); $i++){
        $dis=$rows['sum(invoicevalue)'];
        echo formatMoney($dis, true);
        }
        ?>
        </strong></td>          
	  </tbody>
	  </table>

<?php include_once('footer.php');?>