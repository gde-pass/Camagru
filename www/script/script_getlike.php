<?php
function getlike($path) {
  require("/var/www/html/connection.php");
  $img = explode('/', $path);
  if (count($img) != 3)
    return 0;
  $img = $img[2];
  $sql = $dbh->prepare("SELECT count(*) FROM `like` WHERE `cube` = ?");
  $sql->execute([$img]);
  return $sql->fetchColumn();
}
?>
