<?php
session_start();
include '../config/database.php';

#Connection to DB camagru
$dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PW);
#set the PDO error mode to exception
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function getlike($path) {
  $img = explode('/', $path);
  if (count($img) != 3)
    return 0;
  $img = $img[3];
  $sql = $dbh->prepare("SELECT * FROM `like` WHERE `cube` = ?");
  $sql->execute([$img]);
  return 0;
}
?>
