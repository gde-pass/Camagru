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

function    check_email_availability(string $email)
{
    include '../config/database.php';
    #Connection to DB camagru
    $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PW);
    #set the PDO error mode to exception
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    #prepare the request
    $sql = $dbh->prepare("SELECT * FROM `users` WHERE `users`.`email` = ?");
    #run the sql request
    $sql->execute([$email]);
    $email_availability = $sql->fetch(PDO::FETCH_ASSOC);

    if ($email_availability !== FALSE)
    {
        return (TRUE);
    }
    else
    {
        return (FALSE);
    }
}

function    update_user_email(string $email)
{
    if (preg_match("/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/", $email))
    {
        include '../config/database.php';
        if (check_email_availability($email) == TRUE)
        {
            $msg = "email_not_available";
            header("Location: ../form/form_settings.php?msg=$msg");
        }
        else
        {   # Get the $nickname
            $nickname = $_SESSION['nickname'];
            # Get the key of the user
            # Connection to DB camagru
            $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PW);
            # Set the PDO error mode to exception
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            # Prepare the sql query to find the user
            $sql = $dbh->prepare("UPDATE `users`
                    SET `email` = ?
                    WHERE `users`.`nickname` = ?");
            #run the sql request
            $sql->execute([$email, $nickname]);
            $_SESSION['email'] = $email;
        }

    }
    else
    {
        $msg = "invalid_email";
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

$msg = "changed";
header("Location: ../form/form_settings.php?msg=$msg");

?>
