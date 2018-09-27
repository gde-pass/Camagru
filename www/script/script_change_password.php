<?php
session_start();
include '../config/database.php';

function server_pattern_check($password)
{
    if (!preg_match("/((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20})/",$password))
    {
        die ("invalid password");
        return FALSE;
    }
    return TRUE;
}

if (isset($_POST['password']) AND !empty($_POST['password']) AND server_pattern_check($_POST['password']) === TRUE)
{
    #convert into local variable
    $password = $_POST['password'];
    $email = $_SESSION['email'];
    $token = $_SESSION['token'];
    #detroy the session
    session_destroy();
    #Hash the password
    $password = hash('whirlpool', $password);
    #Connection to DB camagru
    $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PW);
    #set the PDO error mode to exception
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $dbh->prepare("UPDATE `users` SET `password` = ?, `reset_token` = NULL, `date_token` = NULL WHERE `users`.`email` = ? AND `users`.`reset_token` = ?");
    $sql->execute([$password, $email, $token]);
}

?>
