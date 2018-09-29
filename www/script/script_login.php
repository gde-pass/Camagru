<?php
include '../config/database.php';
session_start();

function server_pattern_check($password, $email)
{
    if (!preg_match("/((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20})/",$password))
    {
        die ("invalid password");
        return FALSE;
    }

    if (!preg_match("/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/",$email))
    {
        die ("invalid email");
        return FALSE;
    }
    return TRUE;
}

if (isset($_POST["email"], $_POST["password"]) AND !empty($_POST["email"]) AND !empty($_POST["password"]) AND server_pattern_check($_POST["password"], $_POST["email"]) === TRUE)
{
    #convert everthing into local varibles
    $email = $_POST["email"];
    $password = $_POST["password"];
    #Hash the password
    $password = hash('whirlpool', $password);
    #Connection to DB camagru
    $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PW);
    #set the PDO error mode to exception
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $dbh->prepare("SELECT * FROM `users` WHERE `users`.`email` = ? AND `users`.`password` = ?");
    $sql->execute([$email, $password]);
    $user_validity = $sql->fetch(PDO::FETCH_ASSOC);
    if ($user_validity !== FALSE)
    {
        #if this code has been executed that mean the user type the good combination of PW and Email
        if ($user_validity['confirm'] == 1)
        {
            #setup users informtions in session variables
            $_SESSION['logged'] = TRUE;
            $_SESSION['firstname'] = $user_validity['firstname'];
            $_SESSION['lastname'] = $user_validity['lastname'];
            $_SESSION['nickname'] = $user_validity['nickname'];
            $_SESSION['email'] = $user_validity['email'];
            #redirection to the index page
            echo "
                <script language='JavaScript' type='text/javascript'>
                    window.location.replace('../index.php');
                </script>";
        }
        else
        {
            # If this following code has been executed that mean the user didn't confirm his account
            # Redirection to login page
             echo "
                 <script language='JavaScript' type='text/javascript'>
                     window.location.replace('../form/form_login.php?confirm=no');
                 </script>";
        }
    }
    else
    {
        # Redirection to login page
         echo "
             <script language='JavaScript' type='text/javascript'>
                 window.location.replace('../form/form_login.php?log=no');
             </script>";
    }
}


?>
