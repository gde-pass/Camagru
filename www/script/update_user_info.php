<?php
session_start();

function    update_user_fn(string $first_name)
{
    if (preg_match("/^[À-ÿa-zA-Z' -]+$/", $first_name))
    {
        include '../config/database.php';
        #Connection to DB camagru
        $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PW);
        #set the PDO error mode to exception
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        #prepare the request
        $sql = $dbh->prepare("UPDATE `users` SET `firstname` = ? WHERE `users`.`nickname` = ?");
        $sql->execute([$first_name, $_SESSION['nickname']]);
        #set the fn in session
        $_SESSION['firstname'] = $first_name;
    }
    else
    {
        $msg = "invalid_first_name";
        header("Location: ../form/form_settings.php?msg=$msg");
    }
}

function    update_user_ln(string $last_name)
{
    if (preg_match("/^[À-ÿa-zA-Z' -]+$/", $last_name))
    {
        include '../config/database.php';
        #Connection to DB camagru
        $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PW);
        #set the PDO error mode to exception
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        #prepare the request
        $sql = $dbh->prepare("UPDATE `users` SET `lastname` = ? WHERE `users`.`nickname` = ?");
        $sql->execute([$last_name, $_SESSION['nickname']]);
        #set the ln in session
        $_SESSION['lastname'] = $last_name;
    }
    else
    {
        $msg = "invalid_last_name";
        header("Location: ../form/form_settings.php?msg=$msg");
    }
}

function    update_user_password(string $password)
{
    if (preg_match("/((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20})/", $password))
    {
        include '../config/database.php';
        $password = hash('whirlpool', $password);
        #Connection to DB camagru
        $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PW);
        #set the PDO error mode to exception
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        #prepare the request
        $sql = $dbh->prepare("UPDATE `users` SET `password` = ? WHERE `users`.`nickname` = ?");
        $sql->execute([$password, $_SESSION['nickname']]);
    }
    else
    {
        $msg = "invalid_password";
        header("Location: ../form/form_settings.php?msg=$msg");
    }
}

if (!empty($_POST['firstname']))
{
    $firstname = $_POST['firstname'];
    update_user_fn($firstname);
}

if (!empty($_POST['lastname']))
{
    $lastname = $_POST['lastname'];
    update_user_ln($lastname);
}

if (!empty($_POST['new_password']))
{
    $new_password = $_POST["new_password"];
    update_user_password($new_password);
}

if (!empty($_POST['email']))
{
    $email = $_POST['email'];
    update_user_email($email);
}

echo "<PRE>";
print_r($_POST);


?>
