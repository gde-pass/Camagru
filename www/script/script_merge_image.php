<?php

  session_start();

  if (!$_SESSION['logged']) {
    return header("Location: /index.php");
  }

  // GLOBALS


  $filtre = array("empty.png", "star.png", "circular.png", "smoke.png", "flower.png");
  $nbFiltre = count($filtre);


  $imgs = explode('\n', $_POST['req']);
  $arr = array();
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
    //echo $xplode[0];
    $dst = str_replace(' ', '+', $xplode[1]);
    $dst = base64_decode($dst);
    $dst = imagecreatefromstring($dst);
    $i = intval($xplode[2]);
    if ($i >= $nbFiltre) {
      echo "bad filtre";
      return http_response_code(400);
    }
    $src = imagecreatefrompng('../img/filtre/' . $filtre[$i]);
    imagecopymerge($dst, $src, 0, 0, 0, 0, 320, 240, 100);
    $final = imagepng($dst);
    $final = base64_encode($final);//imagepng($dst));imgs[$key]
    //print_r($imgs);
    imagedestroy($src);
    imagedestroy($dst);
  }
  echo $final;
  //file_put_contents('../img/tmp/0.png', $imgs[0]);
  //echo($imgs[0]);
?>
