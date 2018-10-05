<?php
  include '../config/database.php';

  function server_pattern_check($name)
  {
      if (!preg_match("/^[À-ÿa-zA-Z' -]+$/",$name)) {
           header('Location: /user/setting.php?msg=invalid_name');
           exit();
      }
  }

  session_start();

  if (!empty($_POST['firstname']) && isset($_POST['firstname']) && server_pattern_check($_POST['firstname'])) {
    echo('first');
    $nickname = $_SESSION['nickname'];
    $firstname = $_POST['firstname'];
    #Connection to DB camagru
    $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PW);
    #set the PDO error mode to exception
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $dbh->prepare("UPDATE `users` SET `firstname` = ? WHERE `users`.`nickname` = ?");
    $sql->execute([$firstname, $nickname]);
    $_SESSION['firstname'] = $_POST['firstname'];
    header('Location: /user/setting.php?msg=uploaded');
    exit();
  }

  if (!empty($_POST['lastname']) && isset($_POST['lastname']) && server_pattern_check($_POST['lastname'])) {
    echo("last");
    $lastname = $_POST['lastname'];
    $nickname = $_SESSION['nickname'];
    #Connection to DB camagru
    $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PW);
    #set the PDO error mode to exception
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $dbh->prepare("UPDATE `users` SET `lastname` = ? WHERE `users`.`nickname` = ?");
    $sql->execute([$lastname, $nickname]);
    $_SESSION['lastname'] = $_POST['lastname'];
    header('Location: /user/setting.php?msg=uploaded');
    exit();
  }
  header('Location: /user/setting.php?msg=empty');
  exit();

?>
