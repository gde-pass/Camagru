<?php
include 'database.php';

	try
    {
		#Connection to DB camagru
		$dbh = new PDO("mysql:host=$DB_HOST", $DB_USER, $DB_PW);
		#set the PDO error mode to exception
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		#Create DB
		$sql = "CREATE DATABASE IF NOT EXISTS $DB_NAME";
		$dbh->exec($sql);
		echo "\e[36mDatabase Camagru is ready\e[0m\n";
		#Create User Table
		$sql = "CREATE TABLE `$DB_NAME`.`users` ( `id` INT NOT NULL AUTO_INCREMENT , PRIMARY KEY (`id`))";
		$dbh->exec($sql);
    }
	catch(PDOException $e)
    {
		echo $sql . "\n" . $e->getMessage();
	}
	$dbh = NULL;
?>
