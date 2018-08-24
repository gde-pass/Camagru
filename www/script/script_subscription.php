<?php
include 'config/database.php';

function server_pattern_check($firstname, $lastname, $nickname, $password)
{
    if (!preg_match("/^[À-ÿa-zA-Z' -]+$/",$firstname))
     {
         die ("invalid first name");
     }

    if (!preg_match("/^[À-ÿa-zA-Z' -]+$/",$lastname))
     {
         die ("invalid last name");
     }

    if (!preg_match("/^[0-9a-zA-Z'-]+$/",$nickname))
    {
        die ("invalid nickname");
    }

    if (!preg_match("/((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20})/",$password))
    {
        die ("invalid password");
    }
}



if (isset($_POST["firstname"], $_POST["lastname"], $_POST["nickname"], $_POST["password"], $_POST["termsandconditions"]))
{
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $nickname = $_POST["nickname"];
    $password = $_POST["password"];

    server_pattern_check($firstname, $lastname, $nickname, $password);

    try
    {
        #Connection to DB camagru
        $dbh = new PDO("mysql:host=$DB_HOST", $DB_USER, $DB_PW);
        #set the PDO error mode to exception
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        #set the sql request for insert the new user
        $sql = "";
        #run the sql request
        $dbh->exec($sql);
    }
    catch(PDOException $e)
    {
        echo $sql . "\n" . $e->getMessage();
    }

}
?>
