<?php
$DB_HOST = "192.168.99.100:3306";
$DB_USER= "root";
$DB_PW = "password";
$DB_NAME = "camagru";

$DB_CONNECTION = mysql_pconnect($DB_HOST, $DB_USER, $DB_PW) or die(mysql_error());
mysql_select_db($DB_NAME, $DB_CONNECTION);
?>
