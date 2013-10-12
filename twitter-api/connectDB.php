<?php 

$host = "localhost"; //database location
$user = "root"; //database username
$pass = "maldini"; //database password
$db_name = "top-ranking"; //database name

$link = mysql_connect($host, $user, $pass);
mysql_select_db($db_name);

?>
