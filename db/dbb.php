<?php

include("db/db.class.php");

// Open the base (construct the object):
$db_host		=  getenv('HOST');
$db_user		= getenv('USER');
$db_pass		= getenv('PASS');
$db_database	= getenv('DB'); 
$db = new DB($db_database, $db_host, $db_user, $db_pass);
/*


$base="arstock";
$server="arstock.db.5298872.hostedresource.com";
$user="arstock";
$pass="Reset123";
$db = new DB($base, $server, $user, $pass);
*/
?>