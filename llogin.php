<?php
include_once('db/db.php');
$error ='';
if(isset($_POST['submit']))
{
$username = $_POST['username'];
$password = md5($_POST['password']);

$get_data = mysql_query("select * from tblogin where username = '$username' and password ='$password'");
if($row =mysql_num_rows($get_data))
{
session_start();
$_SESSION['username'] = $username;
$_SESSION['accesstype'] = $row['accesstype'];

if($_SESSION['accesstype']=="admin") {
header('Location: admin.php');
}
}else{
$error.="Please username or password do not match";
}
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" type="text/css" href="css/mystyle_login.css">
<link href="css/slidecss.css" rel="stylesheet" type="text/css">
<script src="js/slidejs.js"></script>

<style>
#content {
height: auto;
}
#main{
height: auto;}
</style>
</head>
<body>
<div id="content">
<div id="header">
<h1><img src="images/slide/slide1.png">Lubricans Inventory System</h1>
</div>
<div id="main">

  <section class="container">
  
     <div class="login">
     	 <img src="images/slide/slide17.png">

     <font style="color:rgb(0,0,255);; font:bold 17px 'Aleo';"> <h1>Login here</h1></font>
      <div style="color: red">
      <font style="color:rgb(255, 95, 66);; font:bold 17px 'Aleo';"><?php echo $error?></font>     

      </div></center><br>
      <form method="post" action="">
		 <p><input type="text" name="username" value="" autofocus placeholder="Username"></p>
        <p><input type="password" name="password" value="" placeholder="Password"></p>
		<br>
        <p class="submit"><input type="submit" name="submit" value="Login"></p>
      </form>
    </div>
    </section>
</div>
<div id="footer" align="Center"> @ <?php echo date("d-M-Y");?> Sunyani Shell</div>
</div>
</body>
</html>