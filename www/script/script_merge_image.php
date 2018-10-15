<?php

  session_start();

  if (!$_SESSION['logged']) {
    return header("Location: /index.php");
  }

  $exp = explode('\n', $_POST['rea']);
  echo $_POST['$req'];

  $filtre = array("empty.png", "star.png", "circular.png", "smoke.png", "flower.png");

?>
