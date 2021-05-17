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
$sal =("Sales made from ".$disfdate. " To ".$distdate);

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
      <li class="active" style="float: left;">Sales Summary</li>
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

<?php echo $sal; ?>
<?php echo $no; ?>

      <br>
<div style="font-weight:bold; text-align:center;font-size:14px;margin-bottom: 15px;">
</div>

<table border="1" class="table table-bordered" id="resultTable" data-responsive="table">


           <thead>
              <tr>
              <th>Date</th>
                <th>Invoice</th>
                <th>Cashier</th>
                <th>Sales Person</th>
                <th>TotalCash</th>
                <th>Profit</th>
                <th>Discount</th>
                <th>Liters</th>
                <th>Details</th>
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
              </tr>
              <?php  include('db/dbb.php');
        $result = $db->query("SELECT * FROM sales where salesDate BETWEEN '$fromdate' AND '$todate' order by salesDate ");
while ($line = $db->fetchNextObject($result)) {
?>
      
        <tr>
                <td><?php  $mysqldate=$line->salesDate;
    $phpdate = strtotime( $mysqldate );
    $phpdate = date("d/m/Y",$phpdate);
    echo $phpdate; ?></td>
                <td><?php echo $line->invoice; ?></td>
                <td><?php echo $line->cashier; ?></td>
                <td><?php echo $line->salesperson; ?></td>
                <td><?php echo formatMoney($line->TotalCash, true); ?></td>
                <td><?php echo formatMoney($line->Profit, true); ?></td>
                <td><?php echo formatMoney($line->Discount, true); ?></td>
                <td><?php echo formatMoney($line->Liters, true); ?></td>
               <td width="90">
               <a href="Details.php?invoice=<?= $line->invoice ?>"<button class="btn btn-mini btn-warning"><i class="icon icon-remove"></i>Details</button></a></td></tr>
          <?php
}
          ?>

          <tr>
                  <th>  </th>
                  <th>  </th>
                  <th>  </th>
                  <th>  </th>
                  <td> Total Cash </td>
                  <td> Total Profit </td>
                  <th> Total Discount</th>
                  <th> Total Liters</th>

                  <th>  </th>


<tr>

  <th colspan="4"><strong style="font-size: 12px; color: #222222;">Total:</strong></th>
  <td colspan="1"><strong style="font-size: 12px; color: #222222;">
        <?php 
        $result = $db->query("SELECT sum(TotalCash) as Total FROM sales where salesDate BETWEEN '$fromdate' AND '$todate' ");
while ($line = $db->fetchNextObject($result)) {
$To = $line->Total;
echo formatMoney($To,true);

}
               ?>
</strong>
               </td>  
                  
<td colspan="1"><strong style="font-size: 12px; color: #222222;">
        <?php 
        $result = $db->query("SELECT sum(Profit) as dis FROM sales where salesDate BETWEEN '$fromdate' AND '$todate' ");
while ($line = $db->fetchNextObject($result)) {
$dis = $line->dis;
echo formatMoney($dis,true);

}
               ?>
</strong>
               </td>                  

        <td colspan="1"><strong style="font-size: 12px; color: #222222;">
        <?php 
        $result = $db->query("SELECT sum(Discount) as li FROM sales where salesDate BETWEEN '$fromdate' AND '$todate' ");
while ($line = $db->fetchNextObject($result)) {
$li = $line->li;
echo formatMoney($li,true);

}
               ?>
</strong>
               </td>
        <td colspan="1"><strong style="font-size: 12px; color: #222222;">
<?php 
        $result = $db->query("SELECT sum(Liters) as pr FROM sales where salesDate BETWEEN '$fromdate' AND '$todate' ");
while ($line = $db->fetchNextObject($result)) {
$pro =$line->pr ;
echo formatMoney($pro, true);
}
               ?>
</strong></td>

</tr>

          </table>
          </div>

</form>

<?php include('footer.php'); ?>