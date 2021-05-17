<?php
include_once('headerad.php');
//session_start();
include('db/connect.php');
$print="";
$phid='';
$selectprod="";
$add="";
if(isset($_POST['save']))
{
$invoi = $_GET['invoice'];
$proid = $_POST['product'];
$qtysold = $_POST['qty'];
$cashsales = $_POST['pt'];
$date = $_POST['aridate'];
$discount = $_POST['discount'];
$result = $db->prepare("SELECT * FROM tbproduct WHERE id= :userid");
$result->bindParam(':userid', $proid);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$pprice=$row['price'];
$code=$row['prod_code'];
$content=$row['content'];
$proname=$row['product_name'];
$untp=$row['unit_price'];
$stock=$row['Qty_Left'];
$discrpt = $row['Description'];
$user = $_POST['personel'];
}
//$discrp = 'Sold on cash';

// incace no item is selected
if ($proid=='0') {
  $selectprod = "You must select a Product"; 
}
else{
//incase you try to sell more than you have
if($qtysold == 0){
  $print=("Sorry quantity cannot be empty");
}
else{
//deduct what is been sold from the system
$sql = "UPDATE tbproduct 
        SET Qty_Left=Qty_Left+?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($qtysold,$proid));
	
	mysql_query("update tbproduct set   quantity         = '$qtysold',
                  date          = '$date' where id = '$proid'");

//get the qty left from the product table
$result = $db->prepare("SELECT * FROM tbproduct WHERE id = :userid");
$result->bindParam(':userid', $proid);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$closing=$row['Qty_Left'];
}

  $amount=$qtysold*$pprice;
  $withdiscot=$amount-$discount;
  $liters=$content*$qtysold;
  $unitpro= $untp*$qtysold;
  $profit=$withdiscot-$unitpro;

$sql = "INSERT INTO tballproduct (prod_code,product_name,quantity,Qty_Left,content,price,unit_price,Description,date,invoicevalue,ppd,invoice) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,:k,:l)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$code,':b'=>$proname,':c'=>$qtysold,':d'=>$closing,':e'=>$content,':f'=>$pprice,':g'=>$untp, ':h'=>$discrpt,':i'=>$date,':j'=>$unitpro,':k'=>$discount,':l'=>$invoi));

$result = $db->prepare("SELECT * FROM tballproduct WHERE invoice= :userid");
        $result->bindParam(':userid', $invoi);
        $result->execute();
        for($i=1; $row = $result->fetch(); $i++){
        $sid = $row['id'];
        }

mysql_query("insert into tb_stock_dynamics(productid,productcode,date,receipt_reduce_stock,total_stock,closing_stock,price,value,invoices,system_date,ppd,sidd) values('$proid','$code','$date','$qtysold','$closing','$closing','$pprice','$unitpro','$invoi',now(),'$discount','$sid')") or die(mysql_error());     


header("location: restock1.php?id=$w&invoice=$invoi");

}
}
}
?>



    <form action="" method="post" style="background-color: gray; width: 840;">
    <br>
   <table class = "table">
           <ul class="breadcrumb" style="float: left; left: 60px; color: green; width: 840;">
      <li><h4 style="position: relative; float: right;">Daily Sales ÷</h4></li></ul>
      <br>
    <div class="row">
    <div class="row">
    <input type="hidden" name="pt" value="<?php echo $_GET['id']; ?>" />
    <input type="hidden" name="invoice" value="<?php echo $_GET['invoice']; ?>" />
    <input type="date" name="aridate" required style="width:300px; height: 35; margin-top: 35px; left:60px; position: absolute;" value="" />
    <script src="vendors/jquery-1.7.2.min.js"></script>
    <script src="vendors/bootstrap.js"></script>
    
    <select name="product" class="chzn-select" style="width:300px; height: 35; margin-top: 76px; left:60px; position: absolute;" required>
   <option value="0">Select a Product....</option>
  <?php
  include('db/connect.php');
  $result = $db->prepare("SELECT * FROM tbproduct");
    $result->bindParam(':userid', $res);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
  ?>
    <option value="<?php echo $row['id'];?>"><?php echo $row['product_name']; ?> | Qty Left:<?php echo $row['Qty_Left']; ?> | Price:<?php echo $row['price']; ?></option>
  <?php
        }
      ?>
</select>
<br><br>
       <input type="text" name="qty" min="1" placeholder="Qty" autocomplete="off" style="width: 68px; height:35px; padding-top:6px; padding-bottom: 4px; margin-top: 20px; margin-right: 4px; margin-left: 50px; font-size:15px; left:350px; position:relative;" required>
       <input type="hidden" name="personel" value="<?=$_SESSION['username'] ?>" style="width:265px; height:30px;">
         <input type="text" name="discount" value="" placeholder="PPD" required  style="float:right; margin-right:260px; margin-top: 20px; left: 10px; width:135px; height:35px;">
       <Button type="submit" name="save" class="btn btn-info" style="width: 123px; height:35px; left:650px; position:relative; margin-top: -35px; margin-right:340px"><i class="icon-plus-sign icon-large"></i> Add</button>
       </div>
        <br><br>
        </table>
          </form>
          <div style="color: red">
      <font style="color:rgb(255, 95, 66);; font:bold 18px 'Aleo';"><?php echo $print;?></font> 
      <font style="color:rgb(255, 95, 66);; font:bold 18px 'Aleo';"><?php echo $selectprod;?></font><font style="color:rgb(255, 95, 66);; font:bold 18px 'Aleo';"><?php echo $add;?></font> 
 
      </div>
          <br><br>
          <div class="">
           <table class="table table-bordered" id="resultTable" data-responsive="table">
           <thead>
              <tr>
                <th>PPD</th>
                <th>ProductName</th>
                <th>Description</th>
                <th>Content</th>
                <th>Quantity</th>
                <th>UPrice</th>
                <th>Amount</th>
                <th hidden>Profit</th>
                <th>Cancel</th>
              </tr>
           </thead>
           <tbody class = "details">
           <?php
        $id=$_GET['invoice'];
        include('db/connect.php');

        $result = $db->prepare("SELECT * FROM tballproduct WHERE invoice= :userid");
        $result->bindParam(':userid', $id);
        $result->execute();
        for($i=1; $row = $result->fetch(); $i++){

      ?>
                <tr>
                <td hidden><?php echo $row['prod_code']; ?></td>
                <td><?php echo $row['ppd']; ?></td>
                <td><?php echo $row['product_name']; ?></td>
                <td><?php echo $row['Description']; ?></td>
                <td><?php echo $row['content']; ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <td><?php $ppp=$row['unit_price'];
                echo formatMoney($ppp, true); ?></td>
                <td><?php $amot=$row['invoicevalue']; echo formatMoney($amot,true); ?></td>
                <td hidden><?php $pro=$row['profit']; echo formatMoney($pro,true); ?></td>           
                <td width="90"><a href="deleterec.php?id=<?php echo $row['salesDid']; ?>&invoice=<?php echo $_GET['invoice']; ?>&dle=<?php echo $_GET['id']; ?>&qty=<?php echo $row['Quantity']; ?>&code=<?php echo $row['Productid'];?>"><button class="btn btn-mini btn-warning"><i class="icon icon-remove"></i> Remove </button></a></td>
                </tr>
                <?php
                  }
                ?>
                <tr>
                  <th>  </th>
                  <th>  </th>
                  <th>  </th>
                  <th>  </th>
                  <th>  </th>
                  <th>  </th>
                  <td> Total Amount </td>
                  <th hidden> Total Profit</th>
                  <th>  </th>

                </tr>
                <tr>
                  <th colspan="5"><strong style="font-size: 12px; color: #222222;">Total:</strong></th>
                  <td colspan="1"><strong style="font-size: 12px; color: #222222;"></strong></td>
                 
        <td colspan="1"><strong style="font-size: 12px; color: #222222;">
        <?php
        
        
        $sdsd=$_GET['invoice'];
        $result = $db->prepare("SELECT sum(invoicevalue) FROM tballproduct WHERE invoice= :invoi");
        $result->bindParam(':invoi', $sdsd);
        $result->execute();
        for($i=0; $rows = $result->fetch(); $i++){
        $am=$rows['sum(invoicevalue)'];
        echo formatMoney($am, true);
        }
        ?>
        </strong></td>
        
           <th></th>
      </tr>
        
   
           </tbody>
           </table>
        
          <a rel="facebox" href="checkoutrec.php?invoice=<?php echo $_GET['invoice']?>&total=<?php echo$am ?>&disct=<?php echo $dis ?>&totalprof=<?php echo $li ?>&cashier=<?php echo $_SESSION['username']?>&liters=<?php echo $fgfg ?>"<Button type="submit" class="btn btn-info" style="width: 400px; height:55px; margin-left:200px;  margin-top:-5px;"/><i class="icon-plus-sign icon-large"></i> SUBMIT</button></a>



           <br><br>
           </div>
     </div>
<?php include('footer.php'); ?>