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

  //Envoyer en post le dossier a liker stocker en id

  if ($_POST['nickname'] && $_POST['img'] && $_POST['image'] != 'data') {
    $sqlselect = $dbh->prepare("SELECT * FROM `like` WHERE `nicker`= ? AND `cube` = ?");
    $sqlselect->execute([$_SESSION['nickname'], $_POST['img']]);
    $like_available = $sqlselect->fetch(PDO::FETCH_ASSOC);
    $sqlemail = $dbh->prepare("SELECT `email` FROM `users` WHERE `nickname`= ?");
    $sqlemail->execute([$_POST['nickname']]);
    $all = $sqlemail->fetchAll();
    $to = $all[0]['email'];
    $headers = array(
        'From' => 'project.camagru.42@gmail.com',
        'Reply-To' => 'project.camagru.42@student.42.fr',
        'X-Mailer' => 'PHP/' . phpversion()
    );
    if ($like_available != FALSE) {
      $sqldelete = $dbh->prepare("DELETE FROM `like` WHERE `cube` = ? AND `nicker` = ?");
      $sqldelete->execute([$_POST['img'], $_SESSION['nickname']]);
      $subject = "CAMAGRU - New Disike";
      $content = "User '" . $_SESSION['nickname'] . "' dislike your cube " . $_POST['img'];
      mail($to, $subject, $content, $headers);
    }
    else {
      $sql = $dbh->prepare("INSERT INTO `like` (`nickname`, `nicker`, `cube`) VALUES (?, ?, ?)");
      $sql->execute([$_POST['nickname'], $_SESSION['nickname'], $_POST['img']]);
      $subject = "CAMAGRU - New Like";
      $content = "User '" . $_SESSION['nickname'] . "' like your cube " . $_POST['img'];
      mail($to, $subject, $content, $headers);
    }
  }
  else {
    return http_response_code(400);
  }
?>
