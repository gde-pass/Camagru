<?php

  session_start();

  if (!$_SESSION['logged']) {
    return header("Location: /index.php");
  }

  // GLOBALS


  $filtre = array("empty.png", "star.png", "circular.png", "smoke.png", "flower.png");
  $nbFiltre = count($filtre);
  //$folder =

  $imgs = explode('#', $_POST['req']);
  $arr = array();
  echo count($imgs);
  foreach($imgs as $key => $value) {
    if ($key > 3) {
      echo "so much imgs";
      return http_response_code(400);
    }
    $xplode  = explode(',', $value);
    if (!$xplode || !$xplode[1]) {
      echo "malformed" . $value;
      return http_response_code(400);
    }
    $dst = str_replace(' ', '+', $xplode[1]);
    $dst = base64_decode($dst);
    $dst = imagecreatefromstring($dst);
    $i = intval($xplode[2]);
    if ($i >= $nbFiltre) {
      echo "bad filtre";
      return http_response_code(400);
    }
    $src = imagecreatefrompng('../img/filtre/' . $filtre[$i]);
    imagecopymerge($dst, $src, 0, 0, 0, 0, 6400, 480, 35);
    $path = "../data/" . $_SESSION['nickname'] . '/' . uniqid() . $key . '.png';
    echo $path;
    $final = imagepng($dst, $path);
    imagedestroy($src);
    imagedestroy($dst);
  }
  //file_put_contents('../img/tmp/0.png', $imgs[0]);
  //echo($imgs[0]);
?>
