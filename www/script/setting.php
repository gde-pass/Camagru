<?php
session_start();
include '../config/database.php';

if (isset($_POST['avatar']) AND !empty($_POST['avatar']))
{
    #convert into local variable
    $avatar = $_POST['avatar'];
    #Connection to DB camagru
    $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PW);
    #set the PDO error mode to exception
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $dbh->prepare("UPDATE `users` SET `avatar` = ?");
    $sql->execute([$avatar]);
    http_response_code(200);
    return ($avatar);
}
else
{
    http_response_code(500);
}


?>
