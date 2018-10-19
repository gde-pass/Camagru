<?php
include '/var/www/html/config/database.php';

#Connection to DB camagru
$dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PW);
#set the PDO error mode to exception
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
