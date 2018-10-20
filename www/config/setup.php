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

		$sql = "CREATE TABLE IF NOT EXISTS `camagru`.`comment`
		( `id` INT NOT NULL AUTO_INCREMENT ,
		`cube` VARCHAR(35) NOT NULL,
		`nickname` VARCHAR(30) NOT NULL ,
		`comment` TEXT NULL DEFAULT NULL ,
		PRIMARY KEY (`id`))
		ENGINE = InnoDB";
		$dbh->exec($sql);
		echo "\e[36mComment table is created\e[0m\n";

		$sql = "CREATE TABLE IF NOT EXISTS `camagru`.`like`
		( `nickname` VARCHAR(30) NOT NULL ,
		`nicker` VARCHAR(30) NOT NULL ,
		`cube` VARCHAR(35) NOT NULL )
		ENGINE = InnoDB";
		echo "\e[36mLike table is created\e[0m\n";
		$dbh->exec($sql);

		#create default user
		$avatar = base64_encode(file_get_contents("../img/icon/default_pp.png"));
		$passord = hash('whirlpool', 'Root123');
		$key = md5(microtime(TRUE)*100000);

		$sql2 = $dbh->prepare("INSERT INTO `camagru` . `users` (`id`, `nickname`, `password`, `email`, `firstname`, `lastname`, `confirm`, `key`, `avatar`) VALUES (NULL, ?, ?, ?, ?, ?, 1, ?, ?)");
		$sql2->execute(['Root', $passord, 'root@gmail.com', 'Root', 'Root', $key, $avatar]);
		echo "\e[36mDefault user created\e[0m\n";
	  }
	catch(PDOException $e)
    {
		echo "Error : " . $e->getMessage();
	}
	$dbh = NULL;
?>
