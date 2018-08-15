<?php
include('./config/database.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Camagru</title>
    </head>
    <body>
        <form action="./subscription.php" target="_self" method="post">
            <fieldset>
                <legend>Subscription:</legend>
                First name:<br>
                <input type="text" name="firstname" autofocus><br>
                Last name:<br>
                <input type="text" name="lastname"><br>
                Login:<br>
                <input type="text" name="login"><br>
                Email:<br>
                <input type="email" name="email"><br>
                Password:<br>
                <input type="password" name="password"><br><br>
                <input type="submit" value="Submit">
            </fieldset>
        </form>
