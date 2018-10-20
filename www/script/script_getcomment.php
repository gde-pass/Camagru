<?php

require('../connection.php');

if ($_GET['cube']) {
  $sqlcomments = $dbh->prepare("SELECT * FROM `comment` WHERE `cube` = ?");
  $sqlcomment->execute([$_GET['cube']]);
  /*foreach ($sqlcomment->fetchAll() as $key => $value) {
    echo("<div id='message'></div>")
  }*/
}
?>
