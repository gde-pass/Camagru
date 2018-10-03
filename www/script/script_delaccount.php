<?php
session_start();
include '../config/database.php';

if (isset($_SESSION) AND !empty($_SESSION))
{
    $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PW);
    #set the PDO error mode to exception
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $dbh->prepare("DELETE FROM `users` WHERE `users`.`email` = ? AND `users`.`nickname` = ?");
    $sql->execute([$_SESSION['email'], $_SESSION['nickname']]);
    # redirection
    header("location:logout.php");
}


?>
