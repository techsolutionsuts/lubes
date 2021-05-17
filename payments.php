<?php include("headerad.php");
$select='';
if(isset($_POST['save']))
{
$custcode = $_POST['custcode'];
$pytype = $_POST['ptype'];

if($custcode=='0' or $pytype=='0') {
$select = 'Please select the Customer and Payment Method';
}
elseif($pytype=='Cash') {
  header("location: paycash.php?custcode=$custcode");
}
else {
	header("location: paychq.php?custcode=$custcode");
exit();

}
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
			</ul>
      <br>
</form>

<form action="" method="post" style="background-color:   rgb(200,200,200); width: 840;">
    <br>
   <table class = "table">
    <div class="row">
    <div class="row">
    
<br><br>
<strong>Please select the Customer and Payment Method</strong><br><br>
<center><strong><select name="custcode" class="chzn-select" style="width: 268px; height:30px;" required>
   <option value="0">Select Customer....</option>
  <?php
  include('db/connect.php');
  $result = $db->prepare("SELECT * FROM customer");
    $result->bindParam(':userid', $res);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
  ?>
    <option value="<?php echo $row['cust_code'];?>"><?php echo $row['FullName']; ?> | <?php echo $row['Location']; ?></option>
  <?php
        }
      ?>
</select></strong><br><br>
<center><strong><select name="ptype" class="chzn-select" style="width: 268px; height:30px;" required>
   <option value="0">Payment Method....</option>
   <option value="Cash">Cash</option>
   <option value="Cheque">Cheque</option>
   </select>
<br><br>
<font style="color:rgb(255, 95, 66);; font:bold 18px 'Aleo';"><?php echo $select;?></font> 

   <button name="save" class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i> Save</button><br>

</center>
       </div>
        </table>
        </form>


<?php include('footer.php'); ?>