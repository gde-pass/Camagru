<?php
session_start();
include '../config/database.php';

print_r($_FILES);

if (isset($_FILES['avatar']) && !empty($_FILES['avatar']['name']))
{
    #convert into local variable
    $avatar = $_FILES['avatar']['name'];
    echo $avatar;
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
