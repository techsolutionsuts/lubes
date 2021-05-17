<?php 

include_once('headerad.php');
include_once('callfunction.php');

$nice = '';
$im = '';
if(isset($_POST['add']))
{
//$username = $_POST['username'];
$fname=$_POST['fname'];
$Lname=$_POST['Lname'];
$id=$_POST['id'];
$phnum=$_POST['phnum'];
$imge_type=$_FILES['image']['type'];
$cposition = $_POST['cposition'];
//$conpass = md5($_POST['conpass']);
//$personel =$_SESSION['username'];
$date = date('Y-m-d');
$user  = $_SESSION['username'];

$row= mysql_fetch_object(mysql_query("select * from staff where StaffID = '$id'"));

$store=rand(0,989898989).$_FILES['image']['name'];
if($imge_type=='image/jpeg' || $imge_type=='image/png'|| $imge_type=='image/gif'|| $imge_type=='image/jpg')
{
move_uploaded_file($_FILES['image']['tmp_name'],'staffimage/'.$store);


mysql_query("update  staff, tblogin set FirstName = '$fname',
                               LastName = '$Lname',
                               PhoneNumber = '$phnum',
                               Current_position = '$cposition',
                                accesstype = '$cposition',
                               lastupdateuser = '$user',
                               image = '$store'
                              where tblogin.Staffid = '$id' and staff.StaffID = '$id'") or die(mysql_error());

header("Location: userinfo.php");   
     }


elseif(empty($imge_type)){
mysql_query("update  staff, tblogin set FirstName = '$fname',
                               LastName = '$Lname',
                               PhoneNumber = '$phnum',
                               Current_position = '$cposition',
                               accesstype = '$cposition',
                               lastupdateuser = '$user'
                              where tblogin.Staffid = '$id' and staff.StaffID = '$id'") or die(mysql_error());

header("Location: userinfo.php");     
   }
        else{
            $im = "Invalid file or no image was selected";         

        }

}

?>
   <link rel="stylesheet" type="text/css" href="css/style2.css" media="screen" rel="stylesheet"/>
   
     <script type="text/javascript">
function val(){
if(frm.cposition.value == "0")
{
  alert("Please select user type.");
  return false;
}

 
return true;
}
</script>
   <form action="update_user.php" name="frm" method="post" enctype="multipart/form-data">
   
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
      <li style="float: left; color: red "><a style="float: left; color: white; font-size: 20px;" href="update_user.php?StaffID=<?=$_GET['StaffID']?>">User Info</a></li> 
      <li class="active" style="float: left; color: white; font-size: 20px;">User Details</li>
      </ul>
<caption><center><h3>User Details</h3></center></caption><br>
        <font  style="color:rgb(255, 95, 66);; font:bold 18px 'Aleo';"><?php echo $nice; ?></font>
        <font  style="color:rgb(255, 95, 66);; font:bold 18px 'Aleo';"><?php echo $im; ?></font>

<table style="color: blue">
<br><br><br><br><br><br><br><br>

<tr><td>

<?php
$row = mysql_fetch_object(mysql_query("select * from staff, tblogin where staff.StaffID = '{$_GET['StaffID']}' and tblogin.staffid = '{$_GET['StaffID']}' ")) or die(mysql_error());
?>                                                        
<div style="float:right; margin-right:-150px; margin-top: -225px; width:265px; height:40px;">
  <img width ="110" height="140" src ="staffimage/<?= $row->image ?>">

</div></td></tr><br>
  <tr><td>
  <span style="width:px; color: black;">User Name: </span><input type="text" value="<?= $row->username?>" autofocus style="width:265px; height:30px;" required name="username" readonly  placeholder="User Name">
 
  <span style="width:px; color: black;">First Name: </span><input type="text" readonly value="<?= $row->FirstName?>" placeholder="First Name" style="width:265px; height:30px;"  name="fname" ></td></tr>

  <tr><td>
  <span style="color: black;">Last Name: </span><input type="text" readonly value="<?= $row->LastName?>" placeholder="Last Name" style="width:265px; height:30px;" required name="Lname" >
  <span style="color: black;">Gender: </span><input type="text" value="<?= $row->gender?>" placeholder="Last Name" style="width:265px; height:30px;" required readonly name=" gender" ></td></tr>
  <input type="text" hidden value="<?php echo $_GET['StaffID'];?>" placeholder="Last Name" style="width:265px; height:30px;" required readonly name="id" ></td>

  </td></tr>
  <tr><td>
  <span style="width:px; color: black;">Phone Number: </span><input type="text" value="<?= $row->PhoneNumber?>" maxlength="10" placeholder="Phone Number" style="width:265px; height:30px;"  name="phnum">
<span style="color: black;">User Type:</span>
     <input type="text" readonly value="<?= $row->accesstype?>" maxlength="10"  placeholder="Phone Number" style="width:265px; height:30px;"  name="phnum">
     <tr><td>
</td></tr>

</table>
  
</div><br>
</center>

</form>



<?php include_once('footer.php');?>
