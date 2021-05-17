<?php include_once('headerad.php');
$select='';

if(isset($_GET['user']))
{

$user = $_GET['user'];
$row = mysql_fetch_object(mysql_query("select * from tblogin where username = '$user'")) or die(mysql_error());
$uid=$row->staffid;
$acestype =$row->accesstype;
}


?>
   <form action="" method="post" enctype="multipart/form-data">
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
      <li style="float: left; color: red "><a style="float: left; color: white; font-size: 20px;" href="adminhome.php?user=<?=$_SESSION['username']?>">Admin Page</a></li> 
      <li class="active" style="float: left; color: white; font-size: 20px;">Admin Info</li>
      </ul>
<caption><center><h3>Administrator Infomation</h3></center></caption><br>
<table style="color: blue">
<br><br>
<tr><td>

<?php
$listrow = mysql_fetch_object(mysql_query("select * from staff where StaffID = '$uid'")) or die(mysql_error());
$stafid=$listrow->StaffID;
?>
  <div style="float:right; margin-right:-150px; margin-top: -135px; width:265px; height:40px;">
  <img width ="110" height="140" src ="staffimage/<?= $listrow->image ?>">
</div></td></tr><br><br>
<tr><td>
<a style="color: blue; font-size: 20px" href="changepass.php?user=<?=$_SESSION['username']?>&good">Change Password</a> | <a style="color: blue; font-size: 20px" href="#">Logs</a><br><br>
  <span style="width:px; color: black;">User Name: </span><input type="text" style="width:265px; height:30px;" required name="empdate" readonly value="<?= $row->username ?>" >

  <span style="width:px; color: black;">First Name: </span><input type="text" placeholder="First Name" style="width:265px; height:30px;"  name="fname" readonly value="<?= $listrow->FirstName ?>"></td></tr>
  <tr><td>
  <span style="color: black;">Last Name: </span><input type="text" placeholder="Last Name" style="width:265px; height:30px;" required name="Lname" value="<?= $listrow->LastName ?>" >

  <span style="color: black;">Gender: </span><input type="text" placeholder="Last Name" style="width:265px; height:30px;" required name="Lname" readonly value="<?= $listrow->gender ?>" ></td></tr>
  <tr><td>
  <span style="width:px; color: black;">Phone Number: </span><input type="text" readonly maxlength="10" placeholder="Phone Number" style="width:265px; height:30px;" value="<?= $listrow->PhoneNumber ?>"  name="phnum">
  <span style="width:px; color: black;">Date Added: </span><input type="text" style="width:265px; height:30px;" required name="empdate" readonly value="<?= $row->datetime ?>" >

  </td></tr></table>

  </div><br><br><br>
</center>

</form>

<?php include_once('footer.php');?>
