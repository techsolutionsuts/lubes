<?php include("headerad.php"); 
$cashles="";
$selectperson="";
include('db/connect.php');

if(isset($_POST['save']))
{
$inv = $_POST['invoice'];
$cashier = $_POST['cashier'];
$duedate = $_POST['duedate'];
$amount = $_POST['amount'];
$receiver = $_POST['receiver'];
$supplier = $_POST['supplier'];
$Dname= $_POST['Dname'];
$phone = $_POST['phone'];
$Cnum = $_POST['Cnum'];
$invnum = $_POST['invnum'];
$descp = "Received from $supplier.";
$sysdate=$_POST['sysdate'];

if($receiver=='0' || $supplier == '0' ) {
$cashles="Please you did not select a receiver or supplier";
}
else
{
mysql_query("update tballproduct set   suplierid  = '$supplier',
                                    Driver_num    = '$phone',
                                    DueDate       = '$duedate',
                                    receiver      = '$receiver',
                                    Driver_name   = '$Dname',
                                    Car_num       = '$Cnum',
                                    invoice_num   = '$invnum',
                                    Personel      = '$cashier'
                                    where invoice = '$inv'") or die(mysql_error()); 

mysql_query("update tb_stock_dynamics set user  = '$cashier',
                                    description = '$descp',
                                    receive      = '$receiver',
                                    order_invoice   = '$invnum'
                                    where invoices = '$inv'") or die(mysql_error());


header("location: restock.php?id=cash&invoice=<?php echo $restock; ?>");
exit();
}
}
?>

<body >
<form action="" method="post" style="background-color: #008B8B; left:250px; position: relative; width: 380;">
<div id="ac">
<center><h4><i class="icon icon-money icon-large"></i> Complete Transaction</h4></center><hr>
<?php 
//if no transaction is performed you cannot proceed to the check out
$add="";
$id=$_GET['invoice'];
          $result = $db->prepare("SELECT * FROM tballproduct WHERE invoice= :userid");
          $result->bindParam(':userid', $id);
          $result->execute();
          for($i=0; $row = $result->fetch(); $i++){
          $bringd = $row['date'];
        }
        if($bringd===null){
    header("location: restock.php?id=cash&invoice=$restock");
     $add="Please make Transaction";
         }
?>
<input type="hidden" name="date" value="<?php echo $bringd;?>"  style="width: 268px; height:30px; margin-left:56px;"   />
<input type="date" name="duedate" placeholder="Cutomer (you can ignore)" style="width: 268px; margin-left:56px; height:30px;" />
<br><br>
<input type="hidden" name="invoice" value="<?php echo $_GET['invoice']; ?>" />
<input type="hidden" name="ptype" value="Cash" />
<input type="hidden" name="sysdate" value="<?php echo date("Y-m-d H:i:s")?>">
<input type="hidden" name="cashier" value="<?php echo $_GET['cashier']; ?>" />

<center>
<select name="receiver" class="chzn-select" style="width: 268px; height:30px;" required>
   <option value="0">Received By....</option>
  <?php
  include('db/connect.php');
  $result = $db->prepare("SELECT * FROM staff where status != 'Stopped'");
    $result->bindParam(':userid', $res);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
  ?>
    <option value="<?php echo $row['FirstName'];?>"><?php echo $row['FirstName']; ?></option>
  <?php
        }
      ?>
</select><br><br>
<font style="color:rgb(255, 95, 66);; font:bold 18px 'Aleo';"><?php echo $selectperson;?></font> 
<center>
<select name="supplier" class="chzn-select" style="width: 268px; height:30px;" required>
   <option value="0">Select supplier....</option>
  <?php
  include('db/connect.php');
  $result = $db->prepare("SELECT * FROM supliers where suplier_name != 'Open'");
    $result->bindParam(':userid', $res);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
  ?>
    <option value="<?php echo $row['suplier_name'];?>"><?php echo $row['suplier_address']; ?></option>
  <?php
        }
      ?>
</select><br><br>
<input type="text" name="Dname" placeholder="Driver Name" style="width: 268px;  height:30px;" />
<br><br>
<input type="text" name="phone" placeholder="Phone Number" style="width: 268px;  height:30px;" />
<br><br>
<input type="text" name="Cnum" placeholder="Car Number" style="width: 268px;  height:30px;" />
<br><br>
<input type="text" name="invnum" placeholder="Invoice Number" style="width: 268px;  height:30px;" />
<br><br>
<input type="text" name="amount" readonly style="width: 268px; height:30px;" value="<?php $to = $_GET['total']; echo formatMoney($to, true);?>" />
<br><br>

     
      <button name="save" class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i> Save</button><br>
</center>
</div>
</form>
<font style="color:rgb(255, 95, 66);; font:bold 18px 'Aleo';"><?php echo $cashles;?></font> <br>

<?php include("footer.php");?>