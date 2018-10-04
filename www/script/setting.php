<?php
session_start();
include '../config/database.php';

$maxsize = 100000;
$valid_extensions = array('jpg', 'jpeg', 'gif', 'png');

if (isset($_FILES['avatar']) && !empty($_FILES['avatar']['name'])) {
  if ($_FILES['avatar']['size'] <= $maxsize) {
    $extension_upload = strtolower(substr(strrchr($_FILES['avatar']['name'], "."), 1));
    if (in_array($extension_upload, $valid_extensions)) {
        #convert into local variable
        $tmp = file_get_contents($_FILES['avatar']['tmp_name']);
        $avatar = base64_encode($tmp);
        $email = $_SESSION['email'];
        $nickname = $_SESSION['nickname'];
        $_SESSION['avatar'] = $avatar;
        #Connection to DB camagru
        $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PW);
        #set the PDO error mode to exception
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = $dbh->prepare("UPDATE `users` SET `avatar` = ? WHERE `users`.`email` = ? AND `users`.`nickname` = ?");
        $sql->execute([$avatar, $email, $nickname]);
        header('Location: /user/setting.php?msg=uploaded');
        exit();
      }
      else {
          header('Location: /user/setting.php?msg=invalid_extension');
          exit();
      }
    }
    else {
        header('Location: /user/setting.php?msg=to_heavy');
        exit();
    }
}
else
{
    header('Location: /user/setting.php?msg=empty');
    exit();
}


?>
