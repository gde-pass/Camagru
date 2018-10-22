<?php
session_start();

function rrmdir($dir) {
   if (is_dir($dir)) {
     $objects = scandir($dir);
     foreach ($objects as $object) {
       if ($object != "." && $object != "..") {
         if (is_dir($dir."/".$object))
           rrmdir($dir."/".$object);
         else
           unlink($dir."/".$object);
       }
     }
     rmdir($dir);
   }
 }

if ($_SESSION['logged'] == FALSE) {
    header('Location: ../form/form_login.php?logged=no');
    exit(0);
}
elseif (isset($_GET['id']))
{
    rrmdir($_GET['id']);
    header('Location: ../user/mygallery.php');
    echo "<PRE>";
    print_r($_GET);
}
else
{
    header('Location: ../user/mygallery.php?msg=unknow_error');
}
 ?>
