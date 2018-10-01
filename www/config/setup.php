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
		echo "\e[36mDatabase Camagru is created\e[0m\n";
		#Create User Table
		$sql = "CREATE TABLE IF NOT EXISTS `camagru`.`users`
		( `id` SMALLINT(6) UNSIGNED NOT NULL AUTO_INCREMENT ,
		`nickname` VARCHAR(30) NOT NULL ,
		`password` CHAR(128) NOT NULL ,
		`email` VARCHAR(254) NOT NULL ,
		`firstname` VARCHAR(255) NOT NULL ,
		`lastname` VARCHAR(255) NOT NULL ,
		`confirm` BOOLEAN NOT NULL DEFAULT FALSE ,
		`key` VARCHAR(32) NOT NULL ,
		`reset_token` VARCHAR(32) NULL ,
		`date_token` DATETIME NULL ,
		`avatar` TEXT NOT NULL ,
		PRIMARY KEY (`id`),
		UNIQUE `UEMAIL` (`email`),
		UNIQUE `UNICKNAME` (`nickname`))
		ENGINE = InnoDB COMMENT = 'Informations about camagru users'";
		$dbh->exec($sql);
		echo "\e[36mUsers table is created\e[0m\n";
    }
	catch(PDOException $e)
    {
		echo $sql . "\n" . $e->getMessage();
	}
	$dbh = NULL;
?>
