<?php
include '../config/database.php';

$nickname = $_GET['nickname'];
$key = $_GET['key'];

#Connection to DB camagru
$dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PW);
#set the PDO error mode to exception
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
#prepare the sql query
$sql = "SELECT *
        FROM `users`
        WHERE `key` = '$key'
        AND `nickname` = '$nickname'";


foreach ($dbh->query($sql) as $row)
{
    $bddkey = $row['key'];
    $bddnickname = $row['nickname'];
}

echo $bddkey . "<BR>" . $bddnickname;
?>
