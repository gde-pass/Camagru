<?php

  session_start();

  if (!$_SESSION['logged']) {
    return header("Location: /index.php");
  }

  // GLOBALS

  $filtre = array("empty.png", "star.png", "circular.png", "smoke.png", "flower.png");
  $nbFiltre = count($filtre);
  $imgs = explode('#', $_POST['req']);
  $arr = array();
  $nb = count($imgs);
  if ($nb > 3) {
    echo "so much imgs";
    return http_response_code(400);
  }
  $folder = "[$nb]" .  md5(microtime(TRUE)*100000);
  $pathfolder = '../data/' . $_SESSION['nickname'] . '/' . $folder;
  if (is_dir($pathfolder) == FALSE)
      mkdir($pathfolder, 0777, true);
  foreach($imgs as $key => $value) {
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
    imagecopymerge($dst, $src, 0, 0, 0, 0, 640, 480, 35);
    $path = $pathfolder . '/' . uniqid() . '.png';
    $final = imagepng($dst, $path);
    imagedestroy($src);
    imagedestroy($dst);
  }
  if ($_POST['comment']) {
    file_put_contents($pathfolder . '/comment', $_POST['comment']);
  }
?>
