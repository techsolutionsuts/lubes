<?php include_once('headerad.php');

$sal = '';
$else = '';
if(isset($_GET['save'])){

if(isset($_GET['fr']) && isset($_GET['to']) && $_GET['fr']!='' && $_GET['to']!='' && $_GET['tw']!='0')
{


      $selected_date=$_GET['fr'];
        $selected_date=strtotime( $selected_date );
      $mysqldate = date( 'Y-m-d', $selected_date );
      $disfdate = date( 'd-m-Y', $selected_date );

$fromdate=$mysqldate;
      $selected_date=$_GET['to'];
        $selected_date=strtotime( $selected_date );
      $mysqldate = date( 'Y-m-d', $selected_date );
      $distdate = date( 'd-m-Y', $selected_date );


$todate=$mysqldate;
$person = $_GET['tw'];
if ($person == "Send to Dormaa") {
	# code...
$sal =("Lubes $person between ".$disfdate. " to ".$distdate);
}
else{
$else =("Lubricants received from $person between ".$disfdate. " to ".$distdate);

}


}
else{

$no = ('Sorry No sales were made in the peroid specified:');
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
    

    <a href="trans.php" style="width: 120px; height:35px; right:180px; position:relative; margin-bottom: -85px; margin-right:320px;" >Back</a>

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
        </form>
      
               <!--<center><font color="green" style="font:bold 22px 'Aleo';"><?php echo $opps;?> </font></center>
               <center><font color="green" style="font:bold 22px 'Aleo';"><?php echo $notfinh;?> </font></center>-->


			    <input type="text" style="padding:15px; height:20px; " name="filter" value="" id="filter" placeholder="Search by name..." autocomplete="off" />
             <br><br>
             <div class="pull-right" style="margin-right:100px;">
    <a onclick="Clickheretoprint('content')" style="font-size:20px; position:absolute; margin-top: -10px; left: 800px"><button class="btn btn-success btn-large"><i class="icon-print"></i> Print</button></a>
    </div>
    <div class="content" id="content">
<center><font color="green" style="font:bold 15px 'Aleo';"><?php echo $sal;?> </font></center>              
<center><font color="green" style="font:bold 15px 'Aleo';"><?php echo $else;?> </font></center>              

           <table border class="table table-bordered" id="resultTable" data-responsive="table">
      <thead>
	  <tr>	  
	  <th>Date</th>
	  <th>Product</th>
    <th>Quantity</th>
	  <th>Received By</th>
	  <th>Source</th>
	  </tr>
	  </thead>
	  <tbody style = "background-color: #808080;">
	  <?php
	  $q =mysql_query("select * from tballproduct where suplierid = '$person' AND date BETWEEN '$fromdate' AND '$todate' order by date");
	  while($row =mysql_fetch_object($q))
	  {
	  	
	  ?>
	  <tr>
	  <td><?php  $mysqldate=$row->date;
    $phpdate = strtotime( $mysqldate );
    $phpdate = date("d/m/Y",$phpdate);
    echo $phpdate; ?></td>	  
    <td><?=$row->Description ?></td>
	  <td><?=$row->quantity ?></td>
    <td><?=$row->receiver ?></td>
	  <td><?=$row->Driver_name ?>
	  </tr>
	  <?php
	  }
	  ?>
	  </tbody>
	  </table>
</div>
<?php include_once('footer.php');?>