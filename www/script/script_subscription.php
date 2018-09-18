<?php
include '../config/database.php';

# Check patterns server side

function server_pattern_check($firstname, $lastname, $nickname, $password, $email)
{
    if (!preg_match("/^[À-ÿa-zA-Z' -]+$/",$firstname))
     {
         die ("invalid first name");
         return FALSE;
     }

    if (!preg_match("/^[À-ÿa-zA-Z' -]+$/",$lastname))
     {
         die ("invalid last name");
         return FALSE;
     }

    if (!preg_match("/^[0-9a-zA-Z'-]+$/",$nickname))
    {
        die ("invalid nickname");
        return FALSE;
    }

    if (!preg_match("/((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20})/",$password))
    {
        die ("invalid password");
        return FALSE;
    }
    return TRUE;

    if (!preg_match("/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/",$email))
    {
        die ("invalid email");
        return FALSE;
    }
    return TRUE;

}

if (isset($_POST["firstname"], $_POST["lastname"], $_POST["nickname"], $_POST["email"], $_POST["password"], $_POST["termsandconditions"]))
{
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $nickname = $_POST["nickname"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (server_pattern_check($firstname, $lastname, $nickname, $password, $email) === TRUE);
    {
        try
        {
            #Hash the password
            $password = hash('whirlpool', $password);
            #Connection to DB camagru
            $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PW);
            #set the PDO error mode to exception
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            #set the sql request for insert the new user
            $sql = "INSERT INTO `users` (`id`, `nickname`, `password`, `email`, `firstname`, `lastname`)
                    VALUES (NULL, '$nickname', '$password', '$email', '$firstname', '$lastname')";
            #run the sql request
            $dbh->exec($sql);

             echo "A confirmation email was sent to " . $email . "\n" .
             "You will be automaticly redirected in 3 seconds ...";

            #refresh page
            echo
            '<script language="JavaScript" type="text/javascript">
                window.location.replace("mail_sended.php?email="+"'.$email.'&firstname="+"'.$firstname.'&lastname="+"'.$lastname.'");
            </script>';
        }
        catch(PDOException $e)
        {
            echo $sql . "\n" . $e->getMessage();
        }
    }
}
?>
