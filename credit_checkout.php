<?php include("header.php"); 
$cashles="";
$selectperson="";
$com = '';
include('db/connect.php');
if(isset($_POST['save']))
{
$inv = $_POST['invoice'];
$cashier = $_POST['cashier'];
$date = $_POST['date'];
$duedate = $_POST['duedate'];
$ptype = $_POST['ptype'];
$profit = $_POST['profit'];
$amount = $_POST['amount'];
$liters = $_POST['liters'];
$dis = $_POST['dis'];
$sperson = $_POST['salesperson'];
$Custcode = $_POST['custcode'];
$customerRep=$_POST['crep'];
$sysdate=$_POST['sysdate'];
$despt = 'Lubricants purchased';
$au = $_POST['au'];
$pur = $_POST['pur'];

$result = $db->prepare("SELECT * FROM customer WHERE cust_code= :userid");
$result->bindParam(':userid', $Custcode);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$customer =$row['FullName'];
$bal = $row['Balance'];
$updatbal = $bal+$amount;

$discrpt = ("Sold on credit to ".$customer.".");
}



if($Custcode=='0'){
    $selectperson = "Please select a customer"; 
}

elseif($sperson=='0'){
    $selectperson = "Please select a Sales person"; 
}
else
{
$sql = "INSERT INTO sales (invoice,TotalCash,Profit,Discount,Liters,cashier,salesperson,Customer,Ptype,salesDate,sysdate,cust_code,CustomerRep,DueDate) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,:k,:l,:m,:n)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$inv,':b'=>$amount,':c'=>$profit,':d'=>$dis,':e'=>$liters,':f'=>$cashier,':g'=>$sperson,':h'=>$customer,':i'=>$ptype, ':j'=>$date, ':k'=>$sysdate,':l'=>$Custcode,':m'=>$customerRep,':n'=>$duedate));

mysql_query("update customer set Balance  = '$updatbal'
                                 where cust_code = '$Custcode'");

mysql_query("INSERT INTO tbpayments(invoice,cust_code,Customer,CustomerRep,Description,AmountD,Balance,DueDate,date,SystemDate,User) values('$inv','$Custcode','$customer','$customerRep','$despt','$amount','$updatbal','$duedate','$date', now(),'$cashier')") or die(mysql_error());

mysql_query("update salesdetails set customerrep  = '$customerRep',
                                     cust_code = '$Custcode',
                                     Authoriser = '$au',
                                     purpose = '$pur'
                                 where invoice = '$inv'");

mysql_query("update tb_stock_dynamics set description  = '$discrpt'
                                 where invoices = '$inv'");


header("location: credit_preview.php?invoice=$inv");
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
    header("location: credit_sales.php?id=cash&invoice=$finalcode");
     $add="Please make Transaction";
         }
?>
<input type="hidden" readonly name="date" value="<?php echo $bringd;?>"  style="width: 268px; height:30px;"   />
            <label style="margin-left:56px;">Due Date:</label>
<input type="date" name="duedate" style="width: 268px; margin-left:56px; height:30px;" required /><br><br>

<select name="custcode" class="chzn-select" style="width: 268px; height:30px; margin-left:56px;" required>
   <option value="0">Select Customer....</option>
  <?php
  include('db/connect.php');
  $result = $db->prepare("SELECT * FROM customer");
    $result->bindParam(':userid', $res);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
  ?>
    <option value="<?php echo $row['cust_code'];?>"><?php echo $row['FullName']; ?></option>
  <?php
        }
      ?>
</select><br><br>
<input type="text" name="crep" autocomplete="off" placeholder="Enter Customer Rep" style="width: 268px; margin-left:56px; height:30px;" required /><br><br>
<input type="text" name="au" autocomplete="off" placeholder="Enter Authorised Person" style="width: 268px; margin-left:56px; height:30px;" required /><br><br>
<input type="text" name="pur" autocomplete="off" placeholder="Enter Purpose for product" style="width: 268px; margin-left:56px; height:30px;" /><br><br>

<input type="hidden" name="invoice" value="<?php echo $_GET['invoice']; ?>" />
<input type="hidden" name="ptype" value="Credit" />
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
  $result = $db->prepare("SELECT * FROM staff");
    $result->bindParam(':userid', $res);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
  ?>
    <option value="<?php echo $row['FirstName'];?>"><?php echo $row['FirstName']; ?></option>
  <?php
        }
      ?>
</select><br><br>
<input type="text" name="amount" readonly style="width: 268px; height:30px;" value="<?php echo $_GET['total']; ?>" />
<br><br>

     
      <button name="save" class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i> Save</button><br>
</center>
</div>
</form>
<font style="color:rgb(255, 95, 66);; font:bold 18px 'Aleo';"><?php echo $cashles;?></font> <br>
<font style="color:rgb(255, 95, 66);; font:bold 18px 'Aleo';"><?php echo $selectperson;?></font> 

<?php include("footer.php");?>