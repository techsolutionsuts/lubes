<?php
include_once('headerad.php');
//session_start();
include('db/connect.php');
$print="";
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
$user =$_SESSION['username'];
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

}

$discrp = 'Sold on credit';
// incace no item is selected
if ($proid=='0') {
  $selectprod = "You must select a Product"; 
}
else{
//incase you try to sell more than you have
if($qtysold>$stock){
  $print=("Sorry ".$proname. " has only "  .$stock. " remained in the system currently");
}
else{
//deduct what is been sold from the system
$sql = "UPDATE tbproduct 
        SET Qty_Left=Qty_Left-?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($qtysold,$proid));

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

$sql = "INSERT INTO salesdetails (invoice,ProductCode,ProductName,Quantity,Amount,Content,Description,Liters,Price,Discount,profit,date,Productid) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,:k,:l,:m)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$invoi,':b'=>$code,':c'=>$proname,':d'=>$qtysold,':e'=>$withdiscot,':f'=>$content,':g'=>$discrpt, ':h'=>$liters,':i'=>$pprice,':j'=>$discount,':k'=>$profit,':l'=>$date,':m'=>$proid));

$result = $db->prepare("SELECT * FROM salesdetails WHERE invoice= :userid");
        $result->bindParam(':userid', $invoi);
        $result->execute();
        for($i=1; $row = $result->fetch(); $i++){
        $sid = $row['salesDid'];
        }

                                              $sidd = 'Cr-'.$sid; 
        mysql_query("update salesdetails set   invoice = '$sidd'
                                              where salesDid = '$sid'") or die(mysql_error());

$result = $db->prepare("SELECT * FROM salesdetails WHERE invoice= :userid");
        $result->bindParam(':userid', $invoi);
        $result->execute();
        for($i=1; $row = $result->fetch(); $i++){
        $sid = $row['salesDid'];
        }

mysql_query("insert into tb_stock_dynamics(productid,productcode,date,closing_stock,qty_sold,price,value,invoices,user,system_date,description,sid) values('$proid','$code','$date','$closing','$qtysold','$pprice','$withdiscot','$sidd','$user',now(),'$discrp','$sid')") or die(mysql_error());     

header("location: credit_sales2.php?id=$w&invoice=$sidd");

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
         <input type="text" name="discount" value="" placeholder="Discount GHC" autocomplete="off" style="float:right; margin-right:260px; margin-top: 20px; left: 10px; width:135px; height:35px;">
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
                <th>ProductName</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Content</th>
                <th>Discount</th>
                <th>Amount</th>
                <th>Liters</th>
                <th hidden>Profit</th>
                <th>Cancel</th>
              </tr>
           </thead>
           <tbody class = "details">
           <?php
        $id=$_GET['invoice'];
        include('db/connect.php');
        $result = $db->prepare("SELECT * FROM salesdetails WHERE invoice= :userid");
        $result->bindParam(':userid', $id);
        $result->execute();
        for($i=1; $row = $result->fetch(); $i++){
      ?>
                <tr>
                <td hidden><?php echo $row['ProductCode']; ?></td>
                <td><?php echo $row['ProductName']; ?></td>
                <td><?php echo $row['Description']; ?></td>
                <td><?php echo $row['Quantity']; ?></td>
                <td><?php $ppp=$row['Price'];
                echo formatMoney($ppp, true); ?></td>
                <td><?php echo $row['Content']; ?></td>
                <td><?php $dis=$row['Discount']; echo formatMoney($dis, true); ?></td>
                <td><?php $amot=$row['Amount']; echo formatMoney($amot,true); ?></td>
                <th><?php echo $row['Liters']; ?></th>
                <td hidden><?php $pro=$row['profit']; echo formatMoney($pro,true); ?></td>           
                <td width="90"><a href="deletec.php?id=<?php echo $row['salesDid']; ?>&invoice=<?php echo $_GET['invoice']; ?>&dle=<?php echo $_GET['id']; ?>&qty=<?php echo $row['Quantity']; ?>&code=<?php echo $row['Productid'];?>"><button class="btn btn-mini btn-warning"><i class="icon icon-remove"></i> Remove </button></a></td>
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
                  <th> Total Discount</th>
                  <td> Total Amount </td>
                  <td> Total Liters </td>
                  <th hidden> Total Profit</th>
                  <th>  </th>

                </tr>
                <tr>
                  <th colspan="4"><strong style="font-size: 12px; color: #222222;">Total:</strong></th>
                  <td colspan="1"><strong style="font-size: 12px; color: #222222;"></strong></td>
        <td colspan="1"><strong style="font-size: 12px; color: #222222;">
        <?php
        
        
        $sdsd=$_GET['invoice'];
        $result = $db->prepare("SELECT sum(Discount) FROM salesdetails WHERE invoice= :invoi");
        $result->bindParam(':invoi', $sdsd);
        $result->execute();
        for($i=0; $rows = $result->fetch(); $i++){
        $dis=$rows['sum(Discount)'];
        echo formatMoney($dis, true);
        }
        ?>
        </strong></td>          
        <td colspan="1"><strong style="font-size: 12px; color: #222222;">
        <?php
        
        
        $sdsd=$_GET['invoice'];
        $result = $db->prepare("SELECT sum(amount) FROM salesdetails WHERE invoice= :invoi");
        $result->bindParam(':invoi', $sdsd);
        $result->execute();
        for($i=0; $rows = $result->fetch(); $i++){
        $am=$rows['sum(amount)'];
        echo formatMoney($am, true);
        }
        ?>
        </strong></td>
        <td colspan="1"><strong style="font-size: 12px; color: #222222;">
        <?php
        $resultas = $db->prepare("SELECT sum(liters) FROM salesdetails WHERE invoice= :proid");
        $resultas->bindParam(':proid', $sdsd);
        $resultas->execute();
        for($i=0; $rowas = $resultas->fetch(); $i++){
        $fgfg=$rowas['sum(liters)'];
        echo formatMoney($fgfg, true);
        }
        ?>

        </strong></td>
        <td hidden colspan="1"><strong style="font-size: 12px; color: #222222;">
        <?php
        $result = $db->prepare("SELECT sum(profit) FROM salesdetails WHERE invoice= :proid");
        $result->bindParam(':proid', $sdsd);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $li=$row['sum(profit)'];
        echo formatMoney($li, true);
        }
        ?>

        </strong></td>
           <th></th>
      </tr>
        
   
           </tbody>
           </table>
        
          <a rel="facebox" href="credit_checkout.php?invoice=<?php echo $_GET['invoice']?>&total=<?php echo$am ?>&disct=<?php echo $dis ?>&totalprof=<?php echo $li ?>&cashier=<?php echo $_SESSION['username']?>&liters=<?php echo $fgfg ?><Button type="submit" class="btn btn-info" style="width: 400px; height:55px; margin-left:200px;  margin-top:-5px;"/><i class="icon-plus-sign icon-large"></i> SUBMIT</button></a>
           <br><br>
           </div>
     </div>
<?php include('footer.php'); ?>