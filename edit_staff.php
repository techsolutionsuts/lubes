<?php 

include_once('headerad.php');
include_once('callfunction.php');
if(isset($_GET['StaffID']))
{

$id = $_GET['StaffID'];
$row = mysql_fetch_object(mysql_query("select * from staff where StaffID = '$id'")) or die(mysql_error());
}

if(isset($_POST['add']))
{
$empdate = $_POST['empdate'];
$fname=$_POST['fname'];
$Lname=$_POST['Lname'];
$gender=$_POST['gender'];
$phnum=$_POST['phnum'];
$imge_type=$_FILES['image']['type'];
$cposition = $_POST['cposition'];
$residence = $_POST['residence'];
$salary = $_POST['salary'];
$fulname = $_POST['fulname'];
$ptcontphnum = $_POST['ptcontphnum'];
$relation = $_POST['relation'];
$ptcontresid = $_POST['ptcontresid'];
$personel =$_POST['personel'];
$store=rand(0,989898989).$_FILES['image']['name'];
if($imge_type=='image/jpeg' || $imge_type=='image/png'|| $imge_type=='image/gif'|| $imge_type=='image/jpg')
{
move_uploaded_file($_FILES['image']['tmp_name'],'staffimage/'.$store);

mysql_query("insert into staff(EmploymentDate,FirstName,LastName,gender,PhoneNumber,Resident,ptcontact,phone,relation,Ptcont_resident,Current_position,Current_Salary,System_Date,user,image) 
                            values('$empdate','$fname','$Lname','$gender','$phnum','$residence','$fulname','$ptcontphnum','$relation','$ptcontresid','$cposition','$salary',now(),'$personel','$store')") or die(mysql_error());

header('Location: staffinfo.php');					
}
else
{
echo("Invalid file or no image was selected");
}
}
?>
	 <link rel="stylesheet" type="text/css" href="css/style2.css" media="screen" rel="stylesheet"/>
   
     <script>
function sum() {
            var txtFirstNumberValue = document.getElementById('txtqty').value;
            var txtSecondNumberValue = document.getElementById('txtup').value;
            var result = parseFloat(txtFirstNumberValue) * parseFloat(txtSecondNumberValue);
            if (!isNaN(result)) {
                document.getElementById('txt3').value = result;
				
            }
        }
            </script>
   <form action="" method="post" enctype="multipart/form-data">
   
   <center><h4><i class="icon-plus-sign icon-large"></i> Add New Employee</h4></center>

   <center>
  <div id="ac" style="background-color:    #FFE4C4  ; width: 850px;">
  <div class="contentheader" style="float: left; background:  #b1cbbb;">
			<i class="icon-table"></i> Add Employee
			</div><br>
<ul class="breadcrumb" style="float: left; width: 845; background:   #7FFFD4 ;">
			<li style="float: left; "><a href="staffinfo.php">Employees</a></li> 
			<li class="active" style="float: left;">Add Employee</li>
			</ul>
<caption><center><h3>Employee Basic Infomation</h3></center></caption><br>
<table style="color: blue">
<tr><td>
  <div style="float:right; margin-right:-150px; margin-top: -135px; width:265px; height:40px;">
  <img width ="110" height="140" src ="staffimage/<?= $row->image ?>">
</div></td></tr><br>
<tr><td>

  <span style="width:px; color: black;">Date Employed: </span><input type="text" style="width:265px; height:30px;" required name="empdate" readonly value="<?= $row->EmploymentDate ?>" >

  <span style="width:px; color: black;">First Name: </span><input type="text" placeholder="First Name" style="width:265px; height:30px;"  name="fname" readonly value="<?= $row->FirstName ?>"></td></tr>
  <tr><td>
  <span style="color: black;">Last Name: </span><input type="text" placeholder="Last Name" style="width:265px; height:30px;" required name="Lname" value="<?= $row->LastName ?>" >

  <span style="color: black;">Gender: </span><input type="text" placeholder="Last Name" style="width:265px; height:30px;" required name="Lname" readonly value="<?= $row->gender ?>" ></td></tr>
  <tr><td>
  <span style="width:px; color: black;">Phone Number: </span><input type="text" maxlength="10" placeholder="Phone Number" style="width:265px; height:30px;" value="<?= $row->PhoneNumber ?>"  name="phnum">
  <span style="color: black;">Position: </span><input type="text" placeholder="Last Name" style="width:265px; height:30px;" required name="Lname" readonly value="<?= $row->Current_position ?>" >
  </td></tr>
  <tr><td>
  <span style="width:px; color: black;">Residence: </span><input type="text" placeholder="Place of Living" style="width:265px; height:30px;"  name="residence" value="<?= $row->Resident ?>">
  <span style="color: black;">Basic Salary:</span><input type="text" name="salary" placeholder="Salary" required style="width:265px; height:30px;" value="<?= $row->Current_Salary ?>">
<center><h3>A Person to Contact</h3> </center>
  <br>
  </td></tr>
  <tr><td>
  <span style="color: black;">Full Name:</span><input type="text" placeholder="Full Name" style="width:265px; height:30px;" name="fulname" required value="<?= $row->ptcontact ?>"/>
  <span style="width:px; color: black;">Phone Number: </span><input type="text" maxlength="10" placeholder="Phone Number" style="width:265px; height:30px;"  name="ptcontphnum" value="<?= $row->phone ?>">
  
  </td></tr>
  <tr><td>
	  <span style="color: black;">Relation:</span><input type="text" name="relation" placeholder="Relationship " required style="width:265px; height:30px;" value="<?= $row->relation ?>"> 
     <span style="width:px; color: black;">Residence: </span><input type="text" placeholder="Place of Living" style="width:265px; height:30px;"  name="ptcontresid" value="<?= $row->Ptcont_resident ?>">
  </td></tr>
	  <tr><td>
	  <span style="color: black;"></span><input type="hidden" name="personel" value="<?=$_SESSION['username'] ?>" style="width:265px; height:30px;">
     </td></tr>
     <tr><td>
     </td></tr><p></p>
	  <tr><td>
	 </td></tr><br><br>
	   <tr><td>
	   </td></tr>
	   <tr><td>
     
       <div style="float:right; margin-right:190px; margin-top: 50px; margin-bottom: 15; width:265px; height:40px;">
	     <button class="btn btn-success btn-block btn-large" name="add" style="width:267px; height:50px;"><i class="icon icon-save icon-large"></i> Update</button>
      </div></td></tr>

</table>
  
</div><br>
</center>

</form>



<?php include_once('footer.php');?>
