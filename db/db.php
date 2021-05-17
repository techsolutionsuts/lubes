<?php
$db_host		=  getenv('HOST');
$db_user		= getenv('USER');
$db_pass		= getenv('PASS');
$db_database	= getenv('DB'); 

$con = @mysql_connect($db_host, $db_user, $db_pass) or die('cannot connect to server');
if($con)
{
mysql_select_db($db_database,$con) or die('cannot select DB');

}
?>