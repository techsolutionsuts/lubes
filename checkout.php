<?php include("header.php"); 
$cashles="";
$selectperson="";
include('db/connect.php');

if(isset($_POST['save']))
{
$inv = $_POST['invoice'];
$cashier = $_POST['cashier'];
$date = $_POST['date'];
$ptype = $_POST['ptype'];
$profit = $_POST['profit'];
$amount = $_POST['amount'];
//$cash = $_POST['cash'];
$liters = $_POST['liters'];
$dis = $_POST['dis'];
$sperson = $_POST['salesperson'];
$customer= $_POST['cname'];
$sysdate=$_POST['sysdate'];

if($sperson=='0') {
$cashles="Please you did not select a sales person";
}
else
{
$sql = "INSERT INTO sales (invoice,TotalCash,Profit,Discount,Liters,cashier,salesperson,Customer,Ptype,salesDate,sysdate) VALUES (:a,:b,:c,:l,:d,:e,:f,:g,:h,:i,:j)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$inv,':b'=>$amount,':c'=>$profit,':l'=>$dis,':d'=>$liters,':e'=>$cashier,':f'=>$sperson,':g'=>$customer,':h'=>$ptype, ':i'=>$date, ':j'=>$sysdate)) or die('Please kindly refresh the page and start the transaction again');
header("location: preview.php?invoice=$inv");
exit();
}
}
?>

<body >
<form action="" method="post" style="background-color: red; left:250px; position: relative; width: 380;">
<div id="ac">
<center><h4><i class="icon icon-money icon-large"></i> Complete Transaction</h4></center><hr>
<?php 
//if no transaction is performed you cannot proceed to the check out
$add="";
$id=$_GET['invoice'];
          $result = $db->prepare("SELECT * FROM salesdetails WHERE invoice= :userid");
          $result->bindParam(':userid', $id);
          $result->execute();
          for($i=0; $row = $result->fetch(); $i++){
          $bringd = $row['date'];
        }
        if($bringd===null){
    header("location: sales.php?id=cash&invoice=$finalcode");
     $add="Please make Transaction";
         }
?>
<input type="hidden" name="date" value="<?php echo $bringd;?>"  style="width: 268px; height:30px; margin-left:56px;"   />

<input type="text" name="cname" placeholder="Cutomer (you can ignore)" style="width: 268px; margin-left:56px; height:30px;" />
<br><br>
<input type="hidden" name="invoice" value="<?php echo $_GET['invoice']; ?>" />
<input type="hidden" name="ptype" value="Cash" />
<input type="hidden" name="sysdate" value="<?php echo date("Y-m-d H:i:s")?>">
<input type="hidden" name="cashier" value="<?php echo $_GET['cashier']; ?>" />
<input type="hidden" name="profit" value="<?php echo $_GET['totalprof']; ?>" />
<input type="hidden" name="liters" value="<?php echo $_GET['liters']; ?>" />
<input type="hidden" name="dis" value="<?php echo $_GET['disct']; ?>" />

<center>
<select name="salesperson" class="chzn-select" style="width: 268px; height:30px;" required>
   <option value="0">Select Sales Person....</option>
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
</select>
<br><br>
<input type="text" name="amount" readonly style="width: 268px; height:30px;" value="<?php echo $_GET['total']; ?>" />
<br><br>

     
      <button name="save" class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i> Save</button><br>
</center>
</div>
</form>
<font style="color:rgb(255, 95, 66);; font:bold 18px 'Aleo';"><?php echo $cashles;?></font> <br>
<font style="color:rgb(255, 95, 66);; font:bold 18px 'Aleo';"><?php echo $selectperson;?></font> 

<?php include("footer.php");?>