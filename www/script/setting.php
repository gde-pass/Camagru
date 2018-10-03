<?php
session_start();
include '../config/database.php';

if (isset($_POST['avatar']) AND !empty($_POST['avatar']))
{
    #convert into local variable
    $avatar = $_POST['avatar'];
    $email = $_SESSION['email'];
    $nickname = $_SESSION['nickname'];
    #Connection to DB camagru
    $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PW);
    #set the PDO error mode to exception
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $dbh->prepare("UPDATE `users` SET `avatar` = ? WHERE `users`.`email` = ? AND `users`.`nickname` = ?");
    $sql->execute([$avatar, $email, $nickname]);
    $_SESSION['avatar'] = $avatar;
    http_response_code(200);
}
else
{
    http_response_code(500);
}


?>
