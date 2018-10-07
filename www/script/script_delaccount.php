<?php
session_start();
include '../config/database.php';

function rrmdir($dir) {
   if (is_dir($dir)) {
     $objects = scandir($dir);
     foreach ($objects as $object) {
       if ($object != "." && $object != "..") {
         if (is_dir($dir."/".$object))
           rrmdir($dir."/".$object);
         else
           unlink($dir."/".$object);
       }
     }
     rmdir($dir);
   }
 }

if (isset($_SESSION) AND !empty($_SESSION))
{
    $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PW);
    #set the PDO error mode to exception
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $dbh->prepare("DELETE FROM `users` WHERE `users`.`email` = ? AND `users`.`nickname` = ?");
    $sql->execute([$_SESSION['email'], $_SESSION['nickname']]);

    #delete pictures of the users
    rrmdir("../data/" . $_SESSION['nickname']);
    # redirection
    header("location:logout.php");
}


?>
