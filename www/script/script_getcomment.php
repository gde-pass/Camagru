<?php

require('../connection.php');

if ($_GET['cube'] && $_GET['user']) {
  $route = "../data/" . $_GET['user'] . "/" . $_GET['cube'];
  if (!isdir($route))
    return http_response_code(400);
  $sqlcomments = $dbh->prepare("SELECT * FROM `comment` WHERE `cube` = ?");
  $sqlcomment->execute([$_GET['cube']]);
  foreach ($sqlcomment->fetchAll() as $key => $value) {
    echo("<div id='message'></div>")
  }
}
?>
