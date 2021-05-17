<?php include("headerad.php");

include('db/connect.php');

if(isset($_POST['save'])){
$Custcode = $_GET['custcode'];
  $pn = $_POST['pno'];
  $date = $_POST['date'];
  $amount = $_POST['amount'];
  $payee = $_POST['payee'];
  $Ptype = "Cash";
  $despt = 'Cash payment for Lubricant bought';
  $Sydate= date('Y-m-d h:i:s');


$result = $db->prepare("SELECT * FROM customer WHERE cust_code= :userid");
$result->bindParam(':userid', $Custcode);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$customer =$row['FullName'];
$bal = $row['Balance'];
$updatbal = $bal-$amount;

}
$user = $_SESSION['username'];

mysql_query("update customer set Balance  = '$updatbal'
                                 where cust_code = '$Custcode'");

mysql_query("INSERT INTO tbpayments(Pno,cust_code,Customer,CustomerRep,Description,PaymentMode,AmountC,Balance,date,SystemDate,User) values('$pn','$Custcode','$customer','$payee','$despt','$Ptype','$amount','$updatbal','$date',now(),'$user')") or die(mysql_error());
header("location: paycashreceipt.php?pno=$pn");
exit();

}

?> 
<form action="" method="" enctype="multipart/form-data">

<center><h4><i class="icon-plus-sign icon-large"></i> Customer Payments</h4></center>

   <center>
  <div id="ac" style="background-color:    #FFE4C4  ; width: 850px;">
  <div class="contentheader" style="float: left; background:  #b1cbbb;">
			<i class="icon-table"></i>
			</div><br>
<ul class="breadcrumb" style="float: left; width: 845; background:   #7FFFD4 ;">
			<li style="float: left; "><a href="payments.php">Payments</a></li>
			<li class="active" style="float: left;">Cash Payment</li>
			</ul>
      <br>
</form>

<form action="" method="post" style="background-color:   rgb(200,200,200); width: 840;">
    <br>
   <table class = "table">
    <div class="row">
    <div class="row">
<script>
    function qty(){
            var txtFirstNumberValue = document.getElementById('cbal').value;
            var txtqtyleftNumberValue = document.getElementById('amt').value;
            var qtyleft = parseFloat(txtFirstNumberValue) - parseFloat(txtqtyleftNumberValue);
            if (!isNaN(qtyleft)) {
                document.getElementById('bals').value = qtyleft;       
            }
        }
</script>

    
<table class="table" style="background:  #92a8d1; ">
<input type="text" hidden name="pno" value="<?php echo $paymentcash ?>">

<?php
 $custcode=$_GET['custcode'];
 include('db/connect.php');

          $result = $db->prepare("SELECT * FROM customer WHERE cust_code= :userid");
          $result->bindParam(':userid', $custcode);
          $result->execute();
          for($i=0; $row = $result->fetch(); $i++){ ?>

    <tr>
    <td>
    <label>Company:</label><br>
    <?php echo $row['FullName']?>
<input type="text" hidden name="cbal" id="cbal" oninput="qty();" value="<?php echo $row['Balance'] ?>">
    </td>
    <td>
    <label>Location</label><br>
        <?php echo $row['Location'] ?>
    </td>
    </tr>
    <tr>
    <td>
    <label>Contact Number</label><br>
    <?php echo $row['PhoneNumber']?>
    </td>
    <td>
    <label>Current Balance</label><br>
    <?php echo $row['Balance']?>
    </td>
    </tr>
    <tr>
    <td>
    <label>Payment Date</label>
    <input type="date" style="width: 250px;" name="date" required value="" class="form-control">
    </td>
    <td>
    <label>Amount</label>
    <input type="text" id="amt" oninput="qty();" style="width: 250px;" name="amount" Placeholder=" Amount here"required value="" class="form-control">
    </td>
    <tr>
    <td>
    <label>Payee</label>
    <input type="text" style="width: 250px;" name="payee" Placeholder=" Amount here"required value="" class="form-control">
    </td>
    <td><label>Bal:</label>
    <input type="text" style="width: 250px;" id="bals" readonly required value="" class="form-control">
    </td>  
    </tr>
    
    <?php
  }
  ?>
    </table>
   <button name="save" class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i> Pay</button><br>


       </div>
        </table>
        </form>


<?php include('footer.php'); ?>