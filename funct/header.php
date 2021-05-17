<?php

include('funct/functions.php');
session_start();

if($_SESSION['username'] == '')
{
header('Location: login.php');
}
else
{
include_once('db/db.php');
}
?>
<html>
<head>
     
     <title>Systems</title>
	 <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	 <link rel="stylesheet" type="text/css" href="css/style.css">
	 <link rel="stylesheet" type="text/css" href="css/style2.css" media="screen" rel="stylesheet"/>
	 <link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
	 <script type = "text/javascript" src="js/jquery.js"></script>
	 <link href="css/facebox.css" media="screen" rel="stylesheet" type="text/css" />
     <script src="css/facebox.js" type="text/javascript"></script>
	 <script src="js/jquery-1.7.2.min.js"></script>
     <link href="css/bootstrap-responsive.css" rel="stylesheet">

	 
</head>
<body style="background:lightblue;">
<div class="row" style="background:lightblue;">
      <div class="container" style="background-color:white; box-shadow: 2px 2px 1px 1px">
	  <div class="col-md-11" style="background-color: aqua;">
	  <center><h2 style="line-height: 60px;">Stocks Control</h2></center>
	  </div>
      <div class="col-md-1">
      <h4><?=$_SESSION['username']?></h4> 
	  <a href="logout.php">Logout</a>
	  </div>
      <div class="col-md-2" style="background-color:pink;">
<a style="line-height:30px;" href="activities.php">Activities</a><br>
<a style="line-height:30px;" href="sales.php?id=cash&invoice=<?php echo $finalcode ?>">Cash Sales</a><br>
<a style="line-height:30px;" href="credit_sales.php?id=credit&invoice=<?php echo $credit ?>">Credit Sales</a><br>
<a style="line-height:30px;" href="payments.php">Payments</a><br>
<a style="line-height:30px;" href="salesreport.php">Reports</a><br>
<a style="line-height:30px;" href="searchwith.php"> Search Reports</a> 

</div>
<div class="col-md-9" >
