<?php
/* Database config */
$db_host		=  getenv('HOST');
$db_user		= getenv('USER');
$db_pass		= getenv('PASS');
$db_database	= getenv('DB'); 
//192.99.113.224 IP Address
/* End config */

$db = new PDO('mysql:host='.$db_host.';dbname='.$db_database, $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>