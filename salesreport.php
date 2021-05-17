<?php include_once('headerad.php');
$fromdate='';
$todate='';
$sal='';
$no='';
if(isset($_GET['save'])){

if(isset($_GET['from_sales_date']) && isset($_GET['to_sales_date']) && $_GET['from_sales_date']!='' && $_GET['to_sales_date']!='' )
{


      $selected_date=$_GET['from_sales_date'];
        $selected_date=strtotime( $selected_date );
      $mysqldate = date( 'Y-m-d', $selected_date );
      $disfdate = date( 'd-m-Y', $selected_date );

$fromdate=$mysqldate;
      $selected_date=$_GET['to_sales_date'];
        $selected_date=strtotime( $selected_date );
      $mysqldate = date( 'Y-m-d', $selected_date );
      $distdate = date( 'd-m-Y', $selected_date );

$todate=$mysqldate;
$sal =("Product Analysis from ".$disfdate. " To ".$distdate);

}
else{

$no = ('Sorry No sales were made in the peroid specified:');
}
}
?>
<form action="" method="post" enctype="multipart/form-data">

<center><h4><i class="icon-plus-sign icon-large"></i> Sales Report With a specific Time Interval</h4></center>

   <center>
  <div id="ac" style="background-color:    #FFE4C4  ; width: 850px;">
  <div class="contentheader" style="float: left; background:  #b1cbbb;">
			<i class="icon-table"></i>
			</div><br>
<ul class="breadcrumb" style="float: left; width: 845; background:   #7FFFD4 ;">
			<li style="float: left; "><a href="salessum.php">Sales Summary</a></li>
      <li style="float: left; "><a href="salesreport.php">Product By Product</a></li>
      <li style="float: left; "><a href="salespersons.php">Sales by Person</a></li>
      <li style="float: left; "><a href="customerreport.php">Customer</a></li>  
			<li class="active" style="float: left;">Product Grouping</li>
			</ul>
      <br>
</form>
<form action="" method="get" style="background-color:   rgb(200,200,200); width: 840;">
    <br>
   <table class = "table">
    <div class="row">
    <div class="row">
    
<br><br>
<center><strong>From : <input type="date" style="width: 223px; height: 20px; padding:14px;" name="from_sales_date" required ></strong> To:<strong> <input type="date" style="width: 223px; padding:14px; height:20px; " name="to_sales_date" required ></strong>
       <Button type="submit" name="save" class="btn btn-info" style="width: 120px; height:35px; left:510px; position:relative; margin-top: -35px; margin-right:340px"><i class="icon-plus-sign icon-large"></i> Search</button>
</center>
       </div>
        <br><br>
        </table>
        </form>


  <div class="pull-right" style="margin-right:100px;">
    <a onclick="Clickheretoprint('content')" style="font-size:20px; position:absolute; margin-top: -10px; left: 800px"><button class="btn btn-success btn-large"><i class="icon-print"></i> Print</button></a>
    </div>
    <div class="content" id="content">
<center><div style="font:bold 25px 'Aleo';">Sunyani Shell Service Station</div>
  Sunyani Shell, Opp. Jubilee Park<br>
  0244413208<br>
  Customer Statement
      <img width="50" height="50" style="float: right; left: 590px; margin-top: -30px; position: absolute;" src="images/slide/slide1.png"></center>
      <br>
<?php echo $sal; ?>
<?php echo $no; ?>

<div style="font-weight:bold; text-align:center;font-size:14px;margin-bottom: 15px;">
</div>

<table border="1" class="table table-bordered" id="resultTable" data-responsive="table">


           <thead>
              <tr>
                <th>ProductName</th>
                <th>Quantity (pics)</th>
                <th>Liters</th>
                <th>Discount (GHC)</th>
                <th>Profit (GHC)</th>
                <th>Amount (GHC)</th>
              </tr>
           </thead>
          <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                </tr>
              <?php  include('db/dbb.php');
        $result = $db->query("SELECT ProductName, sum(Quantity) as qty, sum(Liters) as li, sum(Discount) as disct, sum(profit) as prf, sum(Amount) as am FROM salesdetails where date BETWEEN '$fromdate' AND '$todate' group BY ProductName ");
while ($line = $db->fetchNextObject($result)) {
?>
      
        <tr>
                <td><?php echo $line->ProductName; ?></td>
                <td><?php echo formatMoney($line->qty, true); ?></td>
                <td><?php echo formatMoney($line->li, true); ?></td>
                <td><?php echo formatMoney($line->disct, true); ?></td>
                <td><?php echo formatMoney($line->prf, true); ?></td>
                <td><?php echo formatMoney($line->am, true); ?></td>
        </tr>
          <?php
}
          ?>


<tr>

  <th colspan="2"><strong style="font-size: 12px; color: #222222;">Total:</strong></th>
                  
<td colspan="1"><strong style="font-size: 12px; color: #222222;">
        <?php 
        $result = $db->query("SELECT sum(Liters) as dis FROM salesdetails where date BETWEEN '$fromdate' AND '$todate' ");
while ($line = $db->fetchNextObject($result)) {
$dis = $line->dis;
echo formatMoney($dis,true);

}
               ?>
</strong>
               </td>                  

        <td colspan="1"><strong style="font-size: 12px; color: #222222;">
        <?php 
        $result = $db->query("SELECT sum(Discount) as li FROM salesdetails where date BETWEEN '$fromdate' AND '$todate' ");
while ($line = $db->fetchNextObject($result)) {
$li = $line->li;
echo formatMoney($li,true);

}
               ?>
</strong>
               </td>
        <td colspan="1"><strong style="font-size: 12px; color: #222222;">
<?php 
        $result = $db->query("SELECT sum(profit) as pr FROM salesdetails where date BETWEEN '$fromdate' AND '$todate' ");
while ($line = $db->fetchNextObject($result)) {
$pro =$line->pr ;
echo formatMoney($pro, true);
}
               ?>
</strong></td>
<td colspan="1"><strong style="font-size: 12px; color: #222222;">
<?php 
         $result = $db->query("SELECT sum(Amount) as sm FROM salesdetails where date BETWEEN '$fromdate' AND '$todate' ");
while ($line = $db->fetchNextObject($result)) {
$sum =$line->sm ;
echo formatMoney($sum, true);

}
               ?>
</strong></td>
</tr>

          </table>
</div>
</form>

<?php include('footer.php'); ?>