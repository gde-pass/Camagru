<?php

  session_start();

  if (!$_SESSION['logged']) {
    header("Location: /user/camagru.php");
    exit();
  }

  $filtre = array("empty.png", "star.png", "circular.png", "smoke.png", "flower.png");
  
?>
