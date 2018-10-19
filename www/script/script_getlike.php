<?php
session_start();

require '../connection.php';

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
