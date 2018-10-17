<?php
  session_start();
  include '../config/database.php';

  #Connection to DB camagru
  $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PW);
  #set the PDO error mode to exception
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


  if (!$_SESSION[logged]) {
    return http_response_code(401);
  }

  //Envoyer en post le dossier a liker stocker en id

  if ($_POST['nickname'] && $_POST['img']) {
    $sqlselect = $dbh->prepare("SELECT * FROM `like` WHERE `nicker`= ?");
    $sqlselect->execute($_SESSION['nickname']);
    if ($sql) {
      return http_response_code(401);
    }
    $sql = $dbh->prepare("INSERT INTO `like` (`nickname`, `nicker`, `cube`) VALUES (?, ?, ?)");
    $sql->execute([$_POST['nickname'], $_SESSION['nickname'], $_POST['img']]);
  }
?>
