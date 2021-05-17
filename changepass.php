<?php include_once('headerad.php');
$erro='';
$good='';
if(isset($_POST['add']))
{

$user = $_POST['user'];
$oldp = md5($_POST['oldpass']);
$newpas = md5($_POST['conpass']);

$row = mysql_fetch_object(mysql_query("select * from tblogin where username = '$user'")) or die(mysql_error());
$pas  =$row->password;

if($oldp == $pas){
  mysql_query("update tblogin set password = '$newpas'
                                  where username = '$user' ") or die(mysql_error());

  $good = 'Password successfully Changed';
  header("Location: logout.php");
}
else{
  $erro = 'Your old password is wrong try again';

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
  return true;
}
</script>
   <form action="changepass.php" name="frm" method="post" enctype="multipart/form-data">
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
      <li style="float: left; color: red "><a style="float: left; color: white; font-size: 20px;" href="changepass.php?user=<?=$_SESSION['username']?>&good">Password</a></li> 
      <li class="active" style="float: left; color: white; font-size: 20px;">Password Change</li>
      </ul>
<caption><center><h3>Change your password</h3></center></caption><br>
               <font style="color:rgb(255, 95, 66);; font:bold 18px 'Aleo';"><?php echo $good; ?></font>

<table style="color: blue">
<br><br>
<tr><td>

<?php
$usr = $_SESSION['username'];
$listrow = mysql_fetch_object(mysql_query("select * from tblogin where username = '$usr'")) or die(mysql_error());

$row = mysql_fetch_object(mysql_query("select * from staff where un = '$usr'")) or die(mysql_error());
$stafid=$row->StaffID;
?>
               <font style="color:rgb(255, 95, 66);; font:bold 18px 'Aleo';"><?php echo $erro;?></font> 
  <div style="float:right; margin-right:-320px; margin-top: -135px; width:265px; height:40px;">
  <img width ="110" height="140" src ="staffimage/<?= $row->image ?>">
</div></td></tr><br><br>
<tr><td>
  <span style="width:150px; color: black;">New Password: </span><input type="password" style="width:265px; height:30px;" required name="newpass">

  </td></tr>
  <tr><td>
  <span style="width: 150px; color: black;">Confirm Password: </span><input type="password"  style="width:265px; height:30px;"  name="conpass"  ></td></tr>
  <td><tr>
  <span style="color: black;  width: 150px;">Old Password: </span><input required="" type="password" autofocus  style="width:265px;  position: absolute; margin-left: 92px; height:30px;" required name="oldpass">
  <input type="text" hidden name="user" value="<?php echo $_SESSION['username'];?>">

  
  <td><tr>
       <button class="btn btn-info" name="add" onclick="return val();" style="width:200px; height:50px; margin-bottom: -250px; margin-right: 250px;"><i class="icon icon-save icon-large"></i> Add</button>
  </td></tr>
  </table>

  </div><br><br><br><br>
</center>

</form>

<?php include_once('footer.php');?>
