<?php
$hostname = "localhost";
$db_username = "XXXXXXX";
$db_password = "XXXXXXX";
$db_database = "XXXXX"

$link = mysql_connect($hostname, $db_username, $db_password) or die("Cannot connect to the database");
mysql_select_db($db_database) or die("Cannot select the database");

?>
