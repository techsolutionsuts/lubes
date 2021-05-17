<?php include_once('headerad.php');
if(isset($_GET['idd']))
{
$part= 'staffimage/';
$image = mysql_fetch_object(mysql_query("select * from staff where StaffID = '{$_GET['idd']}'"));
$img = $image->image;
if(unlink($part.$img))
{
mysql_query("delete from staff where StaffID = '{$_GET['idd']}'");
header('location: staffinfo.php');
}

}



?>

	 <link rel="stylesheet" type="text/css" href="css/style2.css" media="screen" rel="stylesheet"/>
    <script src="js/application.js" type="text/javascript" charset="utf-8"></script>
    <script language="javascript">
function Clickheretoprint()
{ 
  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
      disp_setting+="scrollbars=yes,width=700, height=400, left=100, top=25"; 
  var content_vlue = document.getElementById("content").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('</head><body onLoad="self.print()" style="width: 700px; font-size:11px; font-family:arial; font-weight:normal;">');          
   docprint.document.write(content_vlue); 
   docprint.document.close(); 
   docprint.focus(); 
}
</script>


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
      <li style="float: left; color: red "><a style="float: left; color: white; font-size: 20px;" href="userinfo.php?user=<?=$_SESSION['username']?>">Current User</a></li> 
      <li class="active" style="float: left; color: white; font-size: 20px;">All Users</li>
      </ul>
<caption><center><h3>Current Users</h3></center></caption><br>
      <center>
      <div style ="color: red ">
      <?php 
			include('db/connect.php');
				$result = $db->prepare("SELECT * FROM tblogin ORDER BY id DESC");
				$result->execute();
				$rowcount = $result->rowcount();
			?>
			Total Number of Users: <font color="green" style="font:bold 22px 'Aleo';"><?php echo $rowcount;?></font>
			</div></center>
<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th >Date </th>
			<th >Full Name</th>
			<th >Phone Number </th>
			<th >User Name</th>
			<th >User Type </th>
			<th >Status</th>
		    <th>Manage</th>

		</tr>
	</thead>
	<tbody>
		
			<?php

				include('db/connect.php');
				$result = $db->prepare("SELECT * FROM staff, tblogin where staff.StaffID = tblogin.staffid GROUP BY staff.StaffID DESC");
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
                  $fname =$row['FirstName'];
                  $lname =$row['LastName'];

			?>
			<tr class="record">
			<td><?php echo $row['date']; ?></td>
			<td><?php echo $fname;?> <?php echo $lname;?></td>
			<td><?php echo $row['PhoneNumber']; ?></td>
			<td><?php echo $row['username']; ?></td>
			<td><?php echo $row['accesstype']; ?></td>
			<td ><?php echo $row['status']; ?></td>
	        <td><a href="update_user.php?StaffID=<?php echo$row['StaffID']; ?>">Details</a>|<a style="color:rgb(255, 95, 66);" href="active.php?idd=<?php echo$row['StaffID']; ?>">Blocked/Unblocked</a>|<a style="" href="changeuserpass.php?idd=<?php echo$row['StaffID']; ?>">ChangePassword</a>
			</tr>
			<?php
				}
			?>
		
				
			
			<tr>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<tr>
				
			
		
		
		
		
	</tbody>
</table>
</div>
<?php include_once('footer.php');?>
