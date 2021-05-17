<?php include_once('header.php');
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

<center><h4><i class="icon-plus-sign icon-large"></i> Current Employees</h4></center>

   <center>
  <div id="ac" style="background-color:    #FFE4C4  ; width: 850px;">
  <div class="contentheader" style="float: left; background:  #b1cbbb;">
			<i class="icon-table"></i> All Employees
			</div><br>
<ul class="breadcrumb" style="float: left; width: 845; background:   #7FFFD4 ;">
			<li style="float: left; "><a href="staffinfo.php">Employees</a></li> 
			<li class="active" style="float: left;">All Employee</li>
			</ul>
			      <a href ="add_staff.php" style="float:left;">Add New</a><br>
			      <div style ="color: red ">
      <?php 
			include('db/connect.php');
				$result = $db->prepare("SELECT * FROM staff ORDER BY staffid DESC");
				$result->execute();
				$rowcount = $result->rowcount();
			?>
			Total Number of Employees: <font color="green" style="font:bold 22px 'Aleo';"><?php echo $rowcount;?></font>
			</div>
			<div style="float:right;">		
<button  style="float:left;" class="btn btn-success btn-mini"><a href="javascript:Clickheretoprint()"> Print</button></a>
</div>
<br>
<br>
<br>

<input type="text" style="padding:15px; background-color: white;" name="filter" value="" id="filter" placeholder="Search by name" autocomplete="off" /><br><br><br><br><br><br>
<div class="content" id="content">
<caption><center><h3>Employees Basic Infomation</h3></center></caption>
<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
		    <th>ID</th>
			<th width="12%">EmplyDate </th>
			<th width="8%"> Full Name</th>
			<th width="9%">Phone Number </th>
			<th width="14%">Residence</th>
			<th width="15%">Current Position </th>
			<th width="8%"><a href="#">Image</a></th>
		    <th>Manage</th>

		</tr>
	</thead>
	<tbody>
		
			<?php
			function formatMone($number, $fractional=false) {
					if ($fractional) {
						$number = sprintf('%.2f', $number);
					}
					while (true) {
						$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
						if ($replaced != $number) {
							$number = $replaced;
						} else {
							break;
						}
					}
					return $number;
				}
				include('db/connect.php');
				$result = $db->prepare("SELECT * FROM staff ORDER BY EmploymentDate DESC");
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
                  $fname =$row['FirstName'];
                  $lname =$row['LastName'];

			?>
			<tr class="record">
			<td><?php echo $row['StaffID']; ?></td>
			<td><?php echo $row['EmploymentDate']; ?></td>
			<td><?php echo $fname;?> <?php echo $lname;?></td>
			<td><?php echo $row['PhoneNumber']; ?></td>
			<td><?php echo $row['Resident']; ?></td>
			<td><?php echo $row['Current_position']; ?></td>
			<td><img width="70" height="100" src="staffimage/<?php echo $row['image'] ?>"/></td>
	        <td><a href="edit_staff.php?StaffID=<?php echo$row['StaffID']; ?>">Details</a>|<a href="staffinfo.php?idd=<?php echo$row['StaffID']; ?>">Remove</a>
			</tr>
			<?php
				}
			?>
		
				
			
			<tr>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<tr>
				
			
		
		
		
		
	</tbody>
</table>
</div>
<?php include_once('footer.php');?>
