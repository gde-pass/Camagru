<?php
include '../header.php';
include '../config/database.php';

if(isset($_GET['nickname']) && !empty($_GET['nickname']) AND isset($_GET['key']) && !empty($_GET['key']))
{
    $nickname = $_GET['nickname'];
    $key = $_GET['key'];
}
else
{
    echo "Wrong URL";
}

#Connection to DB camagru
$dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PW);
#set the PDO error mode to exception
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
#prepare the sql query to find the user
$sql = "SELECT *
        FROM `users`
        WHERE `key` = '$key'
        AND `nickname` = '$nickname'";


foreach ($dbh->query($sql) as $row)
{
    $bddkey = $row['key'];
    $bddnickname = $row['nickname'];
    $bddconfirm = $row['confirm'];
}

if ($nickname === $bddnickname AND $key === $bddkey)
{
    if ($bddconfirm == 1)
    {
        echo '<div class="statusmsg">You already have activated your account.</div>';
    }
    elseif ($bddconfirm == 0)
    {
        #prepare the sql query to change the confirm field
        $sql = "UPDATE `users`
                SET `confirm` = '1'
                WHERE `users`.`nickname` = '$nickname'
                AND `users`.`key` = '$key'";
        #execute the query
        $dbh->exec($sql);
        echo "Email confirmed";
    }
}
else
{
    echo "No match in the bdd";
}
include '../footer.php';
?>
