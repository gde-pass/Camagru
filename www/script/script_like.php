<?php
  session_start();

  #Connection to DB camagru
  $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PW);
  #set the PDO error mode to exception
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


  if (!$_SESSION[logged]) {
    return http_response_code(401);
  }

  //Envoyer en post le dossier a liker stocker en id

  if ($_POST['id']) {
    $sqlselect = dbh->prepare("SELECT * FROM `like` WHERE `nickname`= ?");
    $sqlselect->execute([$_POST['nickname']]);
    if ($sql) {
      return http_response_code(401);
    }
    $sql = dbh->prepare("INSERT INTO `like` (`id`, `nickname`, `nicker`, `cube`) VALUES (NULL, ?, ?, ?)");
    //$sql->execute([])
  }
?>
