<?php
  session_start();

  include '../config/database.php';

  function server_pattern_check($password)
  {
      if (!preg_match("/((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20})/",$password))
      {
        header('Location: /user/setting.php?msg=invalid_password');
        exit();
      }
      return TRUE;
  }

  if ($_SESSION['logged'] == true && isset($_POST['password']) AND !empty($_POST['password']) && server_pattern_check($_POST['password']) === TRUE)
  {
      #convert into local variable
      $password = $_POST['password'];
      $email = $_SESSION['email'];
      #Hash the password
      $password = hash('whirlpool', $password);
      #Connection to DB camagru
      $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PW);
      #set the PDO error mode to exception
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = $dbh->prepare("UPDATE `users` SET `password` = ? WHERE `users`.`email` = ?");
      $sql->execute([$password, $email]);
      # redirection
      header('Location: /user/setting.php');
      exit();
  }
?>
