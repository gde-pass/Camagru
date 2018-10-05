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

  if (isset($_POST['firstname']) && server_pattern_check($_POST['firstname'])) {
    $nickname = $_SESSION['nickname'];
    $firstname = $_POST['firstname'];
    #Connection to DB camagru
    $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PW);
    #set the PDO error mode to exception
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $dbh->prepare("UPDATE `users` SET `firstname` = ? WHERE `users`.`email` = ?");
    $sql->execute([$firstname, $nickname]);
    $_SESSION['firstname'] = $_POST['firstname'];
  }

  if (isset($_POST['lastname']) && server_pattern_check($_POST['lastname'])) {
    $lastname = $_POST['lastname'];
    $nickname = $_SESSION['nickname'];
    #Connection to DB camagru
    $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PW);
    #set the PDO error mode to exception
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $dbh->prepare("UPDATE `users` SET `lastname` = ? WHERE `users`.`email` = ?");
    $sql->execute([$lastname, $nickname]);
    $_SESSION['lastname'] = $_POST['lastname'];
  }
  header('Location: /user/setting.php');
  exit();

?>