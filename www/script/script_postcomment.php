<?php
  session_start();

  include '../config/database.php';

  #Connection to DB camagru
  $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PW);
  #set the PDO error mode to exception
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


  if (!$_SESSION['logged']) {
    return http_response_code(401);
  }

  if ($_POST['comment'] && $_POST['img'] && $_POST['nickname']) {
    //search cube recursively
    if (!is_dir("../data/" . $_POST['nickname'] . "/" . $_POST['img']))
      return http_response_code(400);
    //insert values for comment
    $sql = $dbh->prepare("INSERT INTO `comment` (`id`, `cube`, `nickname`, `comment`, `commentater`) VALUES (NULL, ?, ?, ?, ?)");
    $sql->execute([$_POST['img'], $_POST['nickname'], $_POST['comment'], $_SESSION['nickname']]);
  }
  else {
    return http_response_code(400);
  }
?>
