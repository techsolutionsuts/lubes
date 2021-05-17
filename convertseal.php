<?php include("headerad.php");
  include_once('db/connect.php');
$select='';
$send = '';
if(isset($_POST['save']))
{
  $date = $_POST['date'];
  $reason = $_POST['reason'];
  $person = $_POST['personel'];
$custcode = $_POST['producttake'];
$qty = $_POST['productqty'];
$add = $_POST['productadd'];
$liters = $_POST['productadqty'];

$reduec = $qty*-1;


if($custcode=='0' or $add=='0'){
$select = 'Please select Seal Lube and Drum oil to continue';
}
else{
  $result = $db->prepare("SELECT * FROM tbproduct WHERE id = :userid");
    $result->bindParam(':userid', $custcode);
    $result->execute();
    for($i=0; $roww = $result->fetch(); $i++){
     $code = $roww['prod_code'];
     $pname = $roww['product_name'];
     $left =$roww['Qty_Left'];

    }
$total = $reduec+$left;
$by = $left-$qty;

$result = $db->prepare("SELECT * FROM tbproduct WHERE id = :userid");
    $result->bindParam(':userid', $add);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
     $code1 = $row['prod_code'];
     //$pid1 = $row['id'];
     $left1 =$row['Qty_Left'];
     $pname1 = $row['product_name'];
    }
   $adto = $left1+$liters;
   $seal_liters = $liters * 4;
$dept = $qty.' '.$reason.' so it was added to '.$pname1;
$dept1 = $seal_liters.' liters was added from '.$qty.' gallon (s) of '.$pname .' to '.$pnamel;

//update upon which you are taken from
mysql_query("update tbproduct set Qty_Left = '$by' where id = '$custcode'") or die(mysql_error());
//update the product of which you are adding to
mysql_query("update tbproduct set Qty_Left = '$adto' where id = '$add'") or die(mysql_error());

//insert into product history taking
mysql_query("insert into tb_stock_dynamics(productid,productcode,date,receipt_reduce_stock,total_stock,closing_stock,user,system_date,description) values('$custcode','$code','$date','$reduec','$total','$total','$person',now(),'$dept')") or die(mysql_error()); 
//insert into product history adding
mysql_query("insert into tb_stock_dynamics(productid,productcode,date,receipt_reduce_stock,total_stock,closing_stock,user,system_date,description) values('$add','$code1','$date','$liters','$adto','$adto','$person',now(),'$dept1')") or die(mysql_error()); 

$send = 'Complete Leakage';

mysql_query("insert into subtracted_products (date, sysdate, productname, qtybefore, qtytakenout, qtyleft, why, reason, user, prodID) values('$date',now(),'$pname','$left','$qty','$by','$send','$dept','$person','$custcode')") or die(mysql_error());

  header("location: product.php");
exit();

}
}

?> 
<form action="" method="" enctype="multipart/form-data">

<center><h4><i class="icon-plus-sign icon-large"></i> Convert Seal Lubes to Drum Oil</h4></center>

   <center>
  <div id="ac" style="background-color:    #FFE4C4  ; width: 850px;">
  <div class="contentheader" style="float: left; background:  #b1cbbb;">
			<i class="icon-table"></i>
			</div><br>
<ul class="breadcrumb" style="float: left; width: 845; background:   #7FFFD4 ;">
			<li style="float: left; "><a href="product.php">Products</a></li>
			</ul>
      <br>
</form>

<form action="" method="post" style="background-color:   rgb(200,200,200); width: 840;">
    <br>
   <table class = "table">
    <div class="row">
    <div class="row">
    
<br><br>
<strong style="color: red">Please you are here because you want to add some <p>seal oil to a drum oil for sale if not then kindly go back and do it again</strong><br><br>
<strong>Please select Seal Lube and Drum oil to continue</strong><br><br>
    <input type="date" name="date" required style="width:268px; height: 35; margin-top: -20px; left:340px; position: absolute;" value="" /><br><br>


<center><strong><select name="producttake" class="chzn-select" style="width: 268px; left:340px  margin-top: 20px; left:340px; position: absolute;" required>
   <option value="0">Select Seal oil....</option>
  <?php
  include('db/connect.php');
  $result = $db->prepare("SELECT * FROM tbproduct where content < 209 ");
    $result->bindParam(':userid', $res);
    $result->execute();
    for($i=0; $roww = $result->fetch(); $i++){
  ?>
    <option value="<?php echo $roww['id'];?>"><?php echo $roww['product_name']; ?> | Qty Left:<?php echo $roww['Qty_Left']; ?></option>
  <?php
        }
      ?>
</select></strong>
       <input type="number" name="productqty" min="1" placeholder="Qty" autocomplete="off" style="width: 68px; height:30px; padding-top:6px; padding-bottom: 4px; margin-top: -1px; margin-bottom: 10px; margin-right: 4px; margin-left: -40px; font-size:15px; left:230px; position:relative;" required>
       <br><br><br>
<center><strong><select name="productadd" class="chzn-select" style="width: 268px; height:30px;  margin-top: -20px; left:340px; position: absolute;" required>
   <option value="0">Add to....</option><?php
  include('db/connect.php');
  $result = $db->prepare("SELECT * FROM tbproduct where cat_id = '3'");
    $result->bindParam(':userid', $res);
    $result->execute();
    for($i=0; $roww = $result->fetch(); $i++){
  ?>
    <option value="<?php echo $roww['id'];?>"><?php echo $roww['product_name']; ?> | Qty Left:<?php echo $roww['Qty_Left']; ?></option>
  <?php
        }
      ?>
   </select>
          <input type="text" name="productadqty" min="1" placeholder="liters" autocomplete="off" style="width: 68px; height:30px; padding-top:6px; padding-bottom: 4px; margin-top: -20px; margin-right: 4px; margin-left: -40px; font-size:15px; left:230px; position:relative;" required><br>

          <textarea type="text" hidde  name="reason"  placeholder="Reasons why ? " require style="width: 268px; height:100px; padding-top:6px; padding-bottom: 4px; margin-top: 20px; margin-right: 4px; margin-left: -40px; font-size:15px; left:55px; position:relative;"></textarea>


<br><br>
 <span style="color: black;"></span><input type="text" hidden name="personel" value="<?=$_SESSION['username'] ?>" >
<font style="color:rgb(255, 95, 66);; font:bold 18px 'Aleo';"><?php echo $select;?></font> 

   <button name="save" class="btn btn-success btn-block btn-large" style="width:267px; left: 55px; margin-left: 65px;"><i class="icon icon-save icon-large"></i> Save</button><br>

</center>
       </div>
        </table>
        </form>


<?php include('footer.php'); ?>