<?php
include_once('db/db.php');
$error ='';
if(isset($_POST['login']))
{
$username = $_POST['username'];
$password = md5($_POST['password']);

mysql_query("insert into tblogin (username,password) values ('$username','$password')");
$i = mysql_insert_id();
if($i>0)
{
$error.="User Added sucesseful";
}
else
{
$error.="User was not added";
}
}

?>
<html>
     <head>
	 <title>Add User</title>
	 <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	 <script type = "text/javascript" src="js/jquery.js"></script>
	 
	 </head>
	 <body>
	 <div class="row">
	 </div>
	 <div class="col-md-5">
	 </div>
	 <div class="col-md-6">
	 <form action="" method="post">
	 <h2> Add New User</h2>
	 <h4 style="color:red;"><?php if(isset($error)) {echo $error; }?></h4>
	 <table>
	 <tr>  
<td>User Name: 
<input type="text" name="username" required autofocus class="form-control" /></td>  
  
</tr>  
<tr>  
<td>Password:  
<input type="password" name="password" required class="form-control"/></td>  
</tr>  
<tr> 
<td><input type="submit" name="login" value="Register" class="btn btn-primary" />
</td>  
</tr>  
</table>  
	 </form>
	 </div>
	 <div class="col-md-3">
	 </div>
	 </div>
	 </body>
</html>