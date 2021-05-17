<?php include_once('headerad.php');
$fromdate='';
$todate='';
$sal='';
$no='';
$pname='';
if(isset($_GET['id']))
{

$id = $_GET['id'];
$row = mysql_fetch_object(mysql_query("select * from tbproduct where id = '$id'")) or die(mysql_error());
}

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
<script src="js/application.js" type="text/javascript" charset="utf-8"></script>

<form action="" method="post" enctype="multipart/form-data">
      <center><h4><i class="icon-plus-sign icon-large"></i> Product History</h4></center>

   <center>
  <div id="ac" style="background-color: #F0F8FF; width: 850px;">
  <div class="contentheader" style="float: left; background:  #b1cbbb;"><ul class="breadcrumb" >
      <li class="icon-table"> <a href="edit_products.php?id=<?= $row->id ?>">Update Product</a></li> 
      <li class="icon-table"> <a href="edit_productspric.php?id=<?= $row->id ?>">Change Price</a></li> 
      <li class="icon-table"> <a href="edit_productsup.php?id=<?= $row->id ?>">Change Unit Price</a></li> 
      <li class="icon-table"> <a href="edit_productsredu.php?id=<?= $row->id ?>">Transfer / Reduce</a></li> 
      <li class="icon-table"> <a href="prodhistory2.php?id=<?= $row->id ?>&pname=<?=$row->product_name ?>">Product History</a></li> 
      </ul></div><br>
<ul class="breadcrumb" style="float: left; width: 845; background:   #7FFFD4 ;">
      <li style="float: left; "><a href="product.php">Products</a></li> 
      <li class="active" style="float: left;">Product History</li>
      </ul>
      <br>
</form>

<?php echo $sal; ?>
<?php echo $no; ?>
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
              <?php
              include_once('db/db.php');
               $id = $_GET['id'];
$page_rows = 5;
$count = mysql_query("select count('Productid') from tb_stock_dynamics where Productid = '$id'");
$pages = ceil(mysql_result($count, 0) / $page_rows);
// another way to usse an if statement without bring calibrasis
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page-1) * $page_rows;
$query = mysql_query("select * from tb_stock_dynamics where Productid = '$id' LIMIT $start, $page_rows");

echo "<table width=\"90%\" border=1 align=center class=table table-bordered id=resultTable data-responsive=table>";

echo "<tr><td width=\"40%\" align=center bgcolor=\"FFFF00\">Date</td>
<td width=\"40%\" align=center bgcolor=\"FFFF00\">Open</td>
<td width=\"40%\" align=center bgcolor=\"FFFF00\">Rept</td>
<td width=\"40%\" align=center bgcolor=\"FFFF00\">Total</td>
<td width=\"40%\" align=center bgcolor=\"FFFF00\">Closing</td>
<td width=\"40%\" align=center bgcolor=\"FFFF00\">Sales</td>
<td width=\"40%\" align=center bgcolor=\"FFFF00\">Price</td>
<td width=\"40%\" align=center bgcolor=\"FFFF00\">Value</td>
<td width=\"40%\" align=center bgcolor=\"FFFF00\">Invoice</td>
<td width=\"40%\" align=center bgcolor=\"FFFF00\">Descrption   </td>
<td width=\"40%\" align=center bgcolor=\"FFFF00\">Person</td>
<td width=\"40%\" align=center bgcolor=\"FFFF00\">User</td>
</tr>";
while ($query_row = mysql_fetch_assoc($query)) {

    $mysqldate=$query_row['date'];
    $phpdate = strtotime( $mysqldate );
    $phpdate = date("d/m/Y",$phpdate);
    $op = $query_row['open_stock']; 
    $rept =  $query_row['receipt_reduce_stock']; 
    $ts = $query_row['total_stock'];
    $cs = $query_row['closing_stock']; 
    $qs = $query_row['qty_sold'];
    $pri = formatMoney($query_row['price'], true); 
    $vl =  formatMoney($query_row['value'], true); 
    $in = $query_row['invoice']; 
    $des = $query_row['description']; 
    $re = $query_row['receive']; 
    $ur = $query_row['user'];                         

echo " <tr>
<td align=center>$phpdate</td>
<td>$op</td>
<td>$rept</td>
<td>$ts</td>
<td>$cs</td>
<td>$qs</td>
<td>$pri</td>
<td>$vl</td>
<td>$in</td>
<td>$des</td>
<td>$re</td>
<td>$ur</td>
</tr>";

}
          echo "</table>";

$prev = $page-1;
$next = $page+1;
echo "<center>";
if(!($page<=1)){
echo "<a href='prodhistory2.php?id=<?= $row->id ?>&pname=<?=$row->product_name ?>&page=$prev'>Previous</a> ";
}
if ($pages>=1) {
  for ($x=1; $x <=$pages ; $x++) { 
    //echo '<a href="?page='.$x.'">'.$x.' </a>';
    echo ($x==$page) ? '<b><a href="?page='.$x.'">'.$x.'</a></b> ':'<a href="?page='.$x.'">'.$x.'</a> ';
  }
}
if(!($page>=$pages)){

echo "<a href='prodhistory2.php?id=<?= $row->id ?>&pname=<?=$row->product_name ?>&page=$next'>Next</a> ";
}
echo "</center";

?>
<br><br>
          </div>
          </div>
          <br><br>

</form>

<?php include('footer.php'); ?>