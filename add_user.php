<?php 

include_once('headerad.php');
include_once('callfunction.php');

$error = '';
$im = '';
$add = '';
if(isset($_POST['add']))
{
$username = $_POST['username'];
$staff=$_POST['staff'];
$cposition = $_POST['cposition'];
$conpass = md5($_POST['conpass']);
$personel =$_SESSION['username'];
$date = date('Y-m-d');
$status = 'Unblocked';

mysql_query("insert into tblogin(username,password,accesstype,staffid,status,date,user) 
                            values('$username','$conpass','$cposition','$staff','$status','$date','$personel')") or die(mysql_error());
	
	mysql_query("update staff set un = '$username'
                                  where StaffID = '$staff' ") or die(mysql_error());

$add = 'User successfully added.';
//header("Location: adminhome.php?user=$personel"); 

}
?>
	 <link rel="stylesheet" type="text/css" href="css/style2.css" media="screen" rel="stylesheet"/>
   
     <script type="text/javascript">
function val(){
if(frm.pass.value == "")
{
  alert("Enter the Password.");
  frm.pass.focus(); 
  return false;
}
if((frm.pass.value).length < 8)
{
  alert("Password should be minimum 8 characters.");
  frm.pass.focus();
  return false;
}

if(frm.conpass.value == "")
{
  alert("Enter the Confirmation Password.");
  return false;
}
if(frm.conpass.value != frm.pass.value)
{
  alert("Password confirmation does not match.");
  return false;
}
if(frm.gender.value == "0")
{
  alert("Please select gender.");
  return false;
}
if(frm.cposition.value == "0")
{
  alert("Please select user type.");
  return false;
}

if(frm.usernamedb.value == frm.username.value )
{
  alert("User already exist.");
    frm.username.focus(); 
  return false;
}
 
return true;
}
</script>
   <form action="add_user.php" name="frm" method="post" enctype="multipart/form-data">
   
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
      <li style="float: left; color: red "><a style="float: left; color: white; font-size: 20px;" href="add_user.php?user=<?=$_SESSION['username']?>">New User</a></li> 
      <li class="active" style="float: left; color: white; font-size: 20px;">New User</li>
      </ul>
<caption><center><h3>Add New System User</h3></center></caption><br>
        <font style="color:rgb(255, 95, 66);; font:bold 18px 'Aleo';"><?php echo $add;?></font> 

<table style="color: blue">
<tr><td>
  <span style="width:px; color: black;">User Name: </span><input type="text" autofocus style="width:265px; height:30px;" required name="username"  placeholder="User Name">
<?php $row = mysql_fetch_object(mysql_query("select * from tblogin")); ?>

  <input type="hidden" autofocus style="width:265px; height:30px;" value="<?= $row->username?>" required name="usernamedb"  placeholder="User Name">
  

        <font style="color:rgb(255, 95, 66);; font:bold 18px 'Aleo';"><?php echo $error;?></font> 

  <span style="width:px; color: black;">Password: </span><input type="password" placeholder="Password" style="width:265px; height:30px;"  name="pass">

  <tr><td>
  <span style="color: black;">Confirm Password:</span><input type="password" name="conpass" placeholder="Confirm Password" required style="width:265px; height:30px;">
  <span style="width:px; color: black;">Select Staff: </span><select name="staff" class="chzn-select" style="width: 268px; height:30px;" required>
   <option value="0">Select Sales Person....</option>
  <?php
  include('db/connect.php');
  $result = $db->prepare("SELECT * FROM staff where status != 'Stopped'");
    $result->bindParam(':userid', $res);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
  ?>
    <option value="<?php echo $row['StaffID'];?>"><?php echo $row['FirstName']; ?></option>
  <?php
        }
      ?>
</select></td></tr>

  <tr><td>
  <span style="color: black;">User Type:</span>
     <select name="cposition" style="width:265px; height:30px; margin-left:-5px;">
       <option value="0">Select User Type</option>
       <option value="Admin">Admin</option>
       <option value="Sales">Sales</option>
     </select>
  </td></tr>

  </td></tr>
  <tr><td>
  

	   <tr><td>
	   
             <font style="color:rgb(255, 95, 66);; font:bold 18px 'Aleo';"><?php echo $im;?></font> 

       <div style="float:right; margin-right:40px; margin-top: -30px; width:265px; height:40px;">
	     <button class="btn btn-info" name="add" onclick="return val();" style="width:267px; height:50px;"><i class="icon icon-save icon-large"></i> Add</button>
      </div></td></tr>

</table>
  
</div><br>
</center>

</form>



<?php include_once('footer.php');?>
