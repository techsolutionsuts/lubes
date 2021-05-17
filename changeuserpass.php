<?php include_once('headerad.php');
$suc = '';
if(isset($_POST['add']))
{
$sysusr = $_POST['usr'];  
$user = $_POST['user'];
$id = $_POST['id'];
$newpas = md5($_POST['conpass']);
if($sysusr == $user){
  mysql_query("update tblogin set password = '$newpas'
                                  where staffid = '$id' ") or die(mysql_error());

  header("Location: logout.php");
}
else{
 mysql_query("update tblogin set password = '$newpas'
                                  where staffid = '$id' ") or die(mysql_error());

  header("Location: userinfo.php");    
}  
}
?>
<script type="text/javascript">
function val(){
  if((frm.newpass.value).length < 8)
{
  alert("Password should be minimum 8 characters.");
  frm.newpass.focus();
  return false;
}
if(frm.newpass.value != frm.conpass.value)
{
  alert("Password confirmation does not match.");
  frm.conpass.focus(); 
  return false;
}
if(frm.newpass.value == frm.conpass.value)
{
  alert("User password successfully changed.");
  return ;
}
  return true;
}
</script>
   <form action="changeuserpass.php" name="frm" method="post" enctype="multipart/form-data">
      <center><h4><i class="icon-plus-sign icon-large"></i> Accounts and User Management</h4></center>

   <center>
  <div id="ac" style="background-color: ; float: left; width: 1045px;">
  <div class="contentheader" style="float: left; width: 1045px; position: ; background:  #b1cbbb;"><ul class="breadcrumb" >
			<li class="icon-table"> <a style="color: black; font-size: 20px" href="adminhome.php?user=<?=$_SESSION['username']?>">admin Page</a></li> 
			<li class="icon-table"> <a style="color: black; font-size: 20px" href="userinfo.php?user=<?=$_SESSION['username']?>">Users</a></li> 
			<li class="icon-table"> <a style="color: black; font-size: 20px" href="add_user.php?user=<?=$_SESSION['username']?>">Add User</a></li> 
           <!-- <li class="icon-table"> <a hidden href="edit_productsredu.php?id=<?= $row->id ?>">Convertion</a></li> -->
            

			</ul></div></div></center><br>
<div id="ac" style="background-color:  white  ; width: 1045px;">
  <br>
<ul class="breadcrumb" style="float: left; width: 1045; background:   gray;">
      <li style="float: left; color: red "><a style="float: left; color: white; font-size: 20px;" href="changeuserpass.php?idd=<?=$_GET['idd'];?>&good">Password</a></li> 
      <li class="active" style="float: left; color: white; font-size: 20px;">Password Change</li>
      </ul>
<caption><center><h3>Change user password</h3></center></caption><br>
               <!--<font style="color:rgb(255, 95, 66);; font:bold 18px 'Aleo';"><?php echo $suc; ?></font>-->
<center>
<table style="color: blue">
<br><br>
<tr><td>

<?php
$id = $_GET['idd'];
$listrow = mysql_fetch_object(mysql_query("select * from tblogin where staffid = '$id'")) or die(mysql_error());

$row = mysql_fetch_object(mysql_query("select * from staff where StaffID = '$id'")) or die(mysql_error());
$stafid=$row->StaffID;
$usr = $listrow->username;
?>
  <div style="float:right; margin-right:-320px; margin-top: -135px; width:265px; height:40px;">
  <img width ="110" height="140" src ="staffimage/<?= $row->image ?>">
</div></td></tr><br><br>
<tr><td>
  <span style="width:130px; color: black;">New Password: </span><input type="password" autofocus style="width:265px; height:30px;" required name="newpass">

  </td></tr>
  <tr><td>
  <span hidde style="color: black;  width: 130px;">Confirm Password </span><input type="password" required=""  style="width:265px; height:30px;" idden="" required name="conpass">
  <input type="text" hidden name="id" value="<?php echo $_GET['idd'];?>">
    <input type="text" hidden name="user" value="<?php echo $_SESSION['username'];?>">
    <input type="text" hidden name="usr" value="<?php echo $usr;?>">

  </td></tr>
  <td><tr>
       <button class="btn btn-info" name="add" onclick="return val();" style="width:200px; height:50px; margin-bottom:-185px; margin-top: 105px "><i class="icon icon-save icon-large"></i> Change</button></td></tr>
  </table><br><br><br><br><br></center>
</div>

</form>

<?php include_once('footer.php');?>
