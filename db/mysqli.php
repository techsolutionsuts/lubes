<?php
$db_host		=  getenv('HOST');
$db_user		= getenv('USER');
$db_pass		= getenv('PASS');
$db_database	= getenv('DB'); 

$db_conx = mysqli_connect($db_host, $db_user, $db_pass, $db_database);
// Evaluate the connection
if (mysqli_connect_errno()) {
    echo mysqli_connect_error();
    exit();
} else {
}
?>