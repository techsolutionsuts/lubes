<?php

include_once('db/connect.php');

$message = '';

if(isset($_POST['submit'])){

  $a=$_POST['username'];
  $b=md5($_POST['passcom']);
  $c=$_POST['aty'];
  $d=$_POST['staff']; 
  $e = "1";

  $result = $db->prepare("SELECT * FROM tblogin");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
    $user = $row['username'];
    $sta = $row['staffid'];
    }

  if(($user == $_POST['username']) && ($sta == $_POST['staff'])){
      $message = 'User is there already';
    }
  
elseif(($_POST['aty']  == "0") && ($_POST['staff']  == "0") && ($_POST['passcom'] == $_POST['pass'])){

  $message = 'Sorry you should select access type, user or password do not match';
  //header("location: register.php");
}
else{
  // Add the new user in the database
  $sql = "INSERT INTO tblogin (username,password,accesstype,staffid,status) VALUES (:a,:b,:c,:d,:e)";
  $stmt = $db->prepare($sql);
    $stmt->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e)) or die ('MySQL connect failed. ' . mysql_error());
  $message = 'Successfully added new user <a href="login.php">Login</a>';
  
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

     <font style="color:rgb(0,0,255);; font:bold 17px 'Aleo';"> <h1>Add System User</h1></font>
      <div style="color: red">
      <font style="color:rgb(255, 95, 66);; font:bold 17px 'Aleo';"><?php echo $message?></font>     

      </div></center><br>
      <form method="post" action="">
		 <p><Select style="width:320px; height:35px;" name="aty">
        <option  value="0">Select Access Type</option>
        <option value="admin">Admin Access</option>
        <option value="supervisor">Supervisory Access</option>
      <option value="sales">Sales Access</option>
        </select></p><br>
        <p><Select style="width:320px; height:35px;" name="staff">
        <option value="0">Select a User....</option>
  <?php
  include('db/connect.php');
  $result = $db->prepare("SELECT * FROM staff");
    $result->bindParam(':userid', $res);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
  ?>
    <option value="<?php echo $row['StaffID'];?>"><?php echo $row['FirstName']; ?> <?php echo $row['LastName']; ?> | <?php echo $row['Current_position']; ?></option>
  <?php
        }
      ?>
</select></p>
		<br>
    <p><input style="width:290px; height:35px;" type="text" name="username" value="" autofocus placeholder="Username"></p><br>
        <p><input style="width:290px; height:35px;" type="password" name="pass" value="" autofocus placeholder="Passcode"></p><br>
            <p><input style="width:290px; height:35px;" type="password" name="passcom" value="" autofocus placeholder="Comfirm Passcode"></p><br>

        <p class="submit"><input type="submit" name="submit" value="Register"></p>
      </form>
    </div>
    </section>
</div>
<div id="footer" align="Center"> @ <?php echo date("d-M-Y");?> Sunyani Shell</div>
</div>
</body>
</html>