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
    echo($_POST['nickname']);
    //search cube recursively
    if (!is_dir("../data/" . $_POST['nickname'] . "/" . $_POST['img']))
      return http_response_code(400);

    //insert values for comment
    $sql = $dbh->prepare("INSERT INTO `comment` (`id`, `cube`, `nickname`, `comment`, `commentater`) VALUES (NULL, ?, ?, ?, ?)");
    $sql->execute([$_POST['img'], $_POST['nickname'], $_POST['comment'], $_SESSION['nickname']]);
    $sqls = $dbh->prepare("SELECT `email` FROM `users` WHERE `nickname`= ?");
    $sqls->execute([$_POST['nickname']]);
    $all = $sqls->fetchAll();
    $to = $all[0]['email'];
    $subject = "CAMAGRU - New Comment Post";
    $content = "A new comment was posted on your cube ". $_POST['img'] ." by user " .$_SESSION['nickname'] . "\nWith content '" . $_POST['comment'] ."'.";
    $headers = array(
        'From' => 'project.camagru.42@gmail.com',
        'Reply-To' => 'project.camagru.42@student.42.fr',
        'X-Mailer' => 'PHP/' . phpversion()
    );
    mail($to, $subject, $content, $headers);
  }
  else {
    return http_response_code(400);
  }
?>
