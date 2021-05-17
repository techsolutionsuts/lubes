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
      <li class="active" style="float: left;">All Customers</li>
      </ul>
      <br>
</form>

    
<?php echo $sal; ?>
<?php echo $no; ?>

  <div class="pull-right" style="margin-right:100px;">
    <a onclick="Clickheretoprint('content')" style="font-size:20px; position:absolute; margin-top: -10px; left: 800px"><button class="btn btn-success btn-large"><i class="icon-print"></i> Print</button></a>
    </div>
<div class="content" id="content">
<center><div style="font:bold 25px 'Aleo';">Sunyani Shell Service Station</div>
  Sunyani Shell, Opp. Jubilee Park<br>
  0244413208<br>
  Customer Statement
      <img width="50" height="50" style="float: right; left: 590px; margin-top: -30px; position: absolute;" src="images/slide/slide1.png">

  </center>

<div style="font-weight:bold; text-align:center;font-size:14px;margin-bottom: 15px;">
</div>

<table border="1" class="table table-bordered" id="resultTable" data-responsive="table">


           <thead>
              <tr><th>Customer ID</th>
   <th>Customer Name</th>
   <th>Customer Location</th>
   <th>Customer Phone</th>
   <th>Current Bal</th>
   <th>Manage</th>
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
        $result = $db->query("SELECT * FROM customer  order by CustomerID ");
while ($line = $db->fetchNextObject($result)) {
?>
      
        <tr>
                <td><?php echo $line->cust_code; ?></td>
                <td><?php echo $line->FullName; ?></td>
                <td><?php echo $line->Location; ?></td>
                <td><?php echo $line->PhoneNumber; ?></td>
                <td><?php echo formatMoney($line->Balance, true); ?></td><td width="90">
               <a href="custstatement.php?cust_code=<?= $line->cust_code ?>&FullName=<?= $line->FullName ?>&loc=<?= $line->Location ?>&phn=<?= $line->PhoneNumber ?>&bal=<?= $line->Balance ?>"<button class="btn btn-mini btn-warning"><i class="icon icon-remove"></i>Statement</button></a></td
     
               ></tr>
        </tr>
          <?php
}
          ?>


<tr>

  <th colspan="4"><strong style="font-size: 12px; color: #222222;">Total Debt By All Creditors:</strong></th>
                  
<td colspan="1"><strong style="font-size: 12px; color: #222222;">
        <?php 
        $result = $db->query("SELECT sum(Balance) as dis FROM customer");
while ($line = $db->fetchNextObject($result)) {
$dis = $line->dis;
echo formatMoney($dis,true);

}
               ?>
</strong>
               </td> 
          </table>

</form>

<?php include('footer.php'); ?>