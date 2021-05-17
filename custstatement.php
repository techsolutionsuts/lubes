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

      <li class="active" style="float: left;">Customer Statement</li>
      </ul>
      <br>


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
  <div class="pull-left" style="margin-left:10px; background-color: white;">
<?php
  $cust_code=$_GET['cust_code'];
  $loc=$_GET['loc'];
  $phn=$_GET['phn'];
  $FullName=$_GET['FullName'];
  $bal = $_GET['bal'];

  ?>  
      <span style="width:180px; margin-left:-5px;">Company Name: <?php echo $FullName; ?> </span>
    
      <span style="width:200px;">Location: <?php echo $loc ?></span> 
    
      <span style="width:200px;">Phone Number: <?php echo $phn; ?></span>
    
      <span style="width:200px; margin-left:-5px;">Current Balance: <?php echo $bal; ?></span>
    </div>
<table border="" class="table table-bordered" id="resultTable" data-responsive="table">


           <thead>
              <tr>
   <th>Date</th>
   <th>Payment Number</th>
   <th>Sales ID</th>
   <th>Customer Rep</th>
   <th>Description</th>
   <th>Payment Mode</th>
   <th>Sales Amount</th>
   <th>Amount Paid</th>
   <th>Balance</th>
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
              <?php  
            $cust_code=$_GET['cust_code'];

              include('db/dbb.php');
        $result = $db->query("SELECT * FROM tbpayments where cust_code = '$cust_code'  order by Pid ");
while ($line = $db->fetchNextObject($result)) {
?>
      
        <tr>
        <td><?php  $mysqldate=$line->date;
    $phpdate = strtotime( $mysqldate );
    $phpdate = date("d/m/Y",$phpdate);
    echo $phpdate; ?></td>
                <td><a href="switch.php?Pno=<?= $line->Pno ?>"><?php echo $line->Pno; ?></a></td>
                <td><a href="Details.php?invoice=<?= $line->invoice ?>&custcode=$cust_code"><?php echo $line->invoice; ?></a></td>
                <td><?php echo $line->CustomerRep; ?></td>
                <td><?php echo $line->Description; ?></td>
                <td><?php echo $line->PaymentMode; ?></td>
                <td><?php echo formatMoney($line->AmountD, true); ?></td>
                <td><?php echo formatMoney($line->AmountC, true); ?></td>
                <td><?php echo formatMoney($line->Balance, true); ?></td>
                        </tr>
          <?php
}
          ?>

          </table>
          </div>

</form>

<?php include('footer.php'); ?>