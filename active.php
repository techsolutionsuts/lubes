<?php include("headerad.php");
$select='';
$blked='';
if(isset($_POST['save']))
{
$id = $_GET['idd'];
$status = $_POST['status'];

if($status=='Blocked'){

mysql_query("update tblogin set status = 'Blocked'
                            where staffid = '$id'");

$blked = 'User successfully blocked no accessed ';
}
elseif($status=='Unblocked') {
mysql_query("update tblogin set status = 'Unblocked'
                            where staffid = '$id'");
$select = 'User successfully unblocked can now access ';
}
}

?> 
<form action="" method="" enctype="multipart/form-data">

<center><h4><i class="icon-plus-sign icon-large"></i> Accounts and User Management</h4></center>

   <center>
  <div id="ac" style="background-color: ; float: left; width: 1045px;">
  <div class="contentheader" style="float: left; width: 1045px; position: ; background:  #b1cbbb;"><ul class="breadcrumb" >
      <li class="icon-table"> <a style="color: black; font-size: 20px" href="adminhome.php?user=<?=$_SESSION['username']?>">admin Page</a></li> 
      <li class="icon-table"> <a style="color: black; font-size: 20px" href="userinfo.php?user=<?=$_SESSION['username']?>">Users</a></li> 
      <li class="icon-table"> <a style="color: black; font-size: 20px" href="add_user.php?user=<?=$_SESSION['username']?>">Add User</a></li> 
           <!-- <li class="icon-table"> <a hidden href="edit_productsredu.php?id=<?= $row->id ?>">Convertion</a></li> -->
                 

      </ul></div><br>
<div id="ac" style="background-color:  white  ; width: 1045px;">
  <br>
<ul class="breadcrumb" style="float: left; width: 1045; background:   gray;">
      <li style="float: left; color: red "><a style="float: left; color: white; font-size: 20px;" href="active.php?idd=<?=$_GET['idd']?>">Active User</a></li> 
      <li class="active" style="float: left; color: white; font-size: 20px;">Block / Unblock User</li>
      </ul></div>
      <br>
</form>

<form action="" method="post" style="background-color:   rgb(200,200,200); width: 1045px;">
    <br>
   <table class = "table">
    <div class="row">
    <div class="row">
    
<br><br>
<strong>Please Block or Unblock a user</strong><br><br>
        <font  style="color:rgb(255, 95, 66);; font:bold 18px 'Aleo';"><?php echo $blked; ?><a href="userinfo.php?user=<?=$_SESSION['username']?>">Go </a></font>
                <font style="color:rgb(255, 95, 66);; font:bold 18px 'Aleo';"><?php echo $select;?> <a href="userinfo.php?user=<?=$_SESSION['username']?>"><<</a></font> 
 

<center><strong><select name="status" class="chzn-select" style="width: 268px; height:30px;" required>
   <option value="0">Select Block/Unblock</option>
  <option value="Blocked">Block</option>
   <option value="Unblocked">Unblock</option>
</select></strong><br><br>
<center>
<br><br>

   <button name="save" class="btn btn-info" style="width:267px;"><i class="icon icon-save icon-large"></i> Block / Unblock</button><br><br>

</center>
       </div>
        </table>
        </form>


<?php include('footer.php'); ?>