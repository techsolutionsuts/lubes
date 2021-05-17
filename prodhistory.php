<?php include_once('headerad.php');
$pname='';
$sms ='';
if(isset($_GET['idd']))
{
$idd = $_GET['idd'];
mysql_query("delete from tb_stock_dynamics where id ='$idd'") or die(mysql_error());
$sms.="Deleted Sucessfuly";
}

?>
<script src="js/application.js" type="text/javascript" charset="utf-8"></script>

<form action="" method="post" enctype="multipart/form-data">
      <center><h4><i class="icon-plus-sign icon-large"></i> Product History</h4></center>

   <center>
  <div id="ac" style="background-color: #F0F8FF; width: 850px;">
  <div class="contentheader" style="float: left; background:  #b1cbbb;"><ul class="breadcrumb" >
      <li class="icon-table"> <a href="edit_products.php?id=<?= $row->id ?>">Update Product</a></li> 
      <li class="icon-table"> <a href="edit_productspric.php?id=<?= $row->id ?>">Change Price</a></li> 
      <li class="icon-table"> <a href="edit_productsup.php?id=<?= $row->id ?>">Change Unit Price</a></li> 
<li class="icon-table"> <a href="edit_productsredu.php?id=<?= $row->id ?>">Convertion</a></li>
      <li class="icon-table"> <a href=" subtracted_qty.php?id=<?= $row->id ?>">Transfer/Reduce Qty </a></li>      <li class="icon-table"> <a href="prodhistory.php?id=<?= $row->id ?>&pname=<?=$row->product_name ?>">Product History</a></li> 
      </ul></div><br>
<ul class="breadcrumb" style="float: left; width: 845; background:   #7FFFD4 ;">
      <li style="float: left; "><a href="product.php">Products</a></li> 
      <li class="active" style="float: left;">Product History</li>
      </ul>
      <br>
</form>
  <div class="pull-right" style="margin-right:100px;">
    <a onclick="Clickheretoprint('content')" style="font-size:20px; position:absolute; margin-top: -10px; left: 800px"><button class="btn btn-success btn-large"><i class="icon-print"></i> Print</button></a>
    <br><br>
    </div>
    <input type="text" style="padding:15px; height:20px; " name="filter" value="" id="filter" placeholder="Search with date DD/MM/YYYY..." autocomplete="off" />
<div class="content" id="content">
<div style="font-weight:bold; text-align:center;font-size:14px;margin-bottom: 15px;">
           
</div>
  <div class="pull-left" style="margin-left:10px; background-color: white;">
    <?php 
   
    $pname = $_GET['pname'];
    ?>
    <center><?php echo $pname;?> Product History</center>
     </div>
<table border="" class="table table-bordered" id="resultTable" data-responsive="table">


           <thead>
              <tr>
   <th>Date</th>
   <th>Open</th>
   <th>Rept</th>
   <th>Total</th>
   <th>Closing</th>
   <th>Sales</th>
   <th>Price</th>
   <th>Value</th>
   <th>Invoice</th>
   <th>Descrpt</th>
   <th>Person</th>
   <th>User</th>
   <th hidden >Delete</th>


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
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                
                </tr>
              <?php 

               $id = $_GET['id'];

              include('db/dbb.php');
        $result = $db->query("SELECT * FROM tb_stock_dynamics where productid  = '$id'  order by date ");
while ($row = $db->fetchNextObject($result)) {
?>
      
        <tr>
        <td><?php  $mysqldate=$row->date;
    $phpdate = strtotime( $mysqldate );
    $phpdate = date("d/m/Y",$phpdate);
    echo $phpdate; ?></td>
               <td><?php echo $row->open_stock; ?></td>
                <td><?php echo $row->receipt_reduce_stock; ?></td>
                <td><?php echo $row->total_stock; ?></td>
                <td><?php echo $row->closing_stock; ?></td>
                <td><?php echo $row->qty_sold; ?></td>
                <td><?php echo formatMoney($row->price, true); ?></td>
                <td><?php echo formatMoney($row->value, true); ?></td>
                <td><?php echo $row->invoices; ?></td>
                <td><?php echo $row->description; ?></td>
                <td><?php echo $row->receive; ?></td>
                <td><?php echo $row->user; ?></td>
                <td hidden><a href="prodhistory.php?idd=<?= $row->ID ?>&id=<?= $row->productid ?>&pname=<?= $row->productcode?>"> Remove</a></td>
               <!-- <td><a href="prodhistory.php?idd=<?= $row->id ?>">Remove</a></td> -->



                        </tr>
          <?php
}
          ?>

          </table>
          </div>

</form>

<?php include('footer.php'); ?>