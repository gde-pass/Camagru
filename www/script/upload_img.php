<?php
session_start();

function picture_check(array $array)
{
    $nbimg = 0;
    $maxsize = 2097152;
    $valid_extensions = array('jpg', 'jpeg', 'gif', 'png');
    foreach($array['img']['name'] as $file)
    {
        #check if the user sent a empty file and count the number of file
        if(empty($file) || !isset($file))
        {
            $msg = "empty";
            echo "
            <script language='JavaScript' type='text/javascript'>
            window.location.replace('../user/mygallery.php?msg=".urlencode($msg)."');
            </script>";
            exit();
        }
        #check if the extension is valid
        $extension_upload = strtolower(substr(strrchr($file, "."), 1));
        if (!in_array($extension_upload, $valid_extensions))
        {
            $msg = "invalid_extension";
            echo "
            <script language='JavaScript' type='text/javascript'>
            window.location.replace('../user/mygallery.php?msg=".urlencode($msg)."');
            </script>";
            exit();
        }
        $nbimg++;
        #check if there is more than 3 pictures sent
        if ($nbimg > 3)
        {
            $msg = "to_mutch";
            echo "
            <script language='JavaScript' type='text/javascript'>
            window.location.replace('../user/mygallery.php?msg=".urlencode($msg)."');
            </script>";
            exit();
        }
    }
    #check the size of each images
    foreach ($array['img']['size'] as $file)
    {
        if ($file == $maxsize)
        {
            $msg = "to_heavy";
            echo "
            <script language='JavaScript' type='text/javascript'>
            window.location.replace('../user/mygallery.php?msg=".urlencode($msg)."');
            </script>";
            exit();
        }
    }
    return ($nbimg);
}

function create_cube_dir(int $nbimg)
{
    $name = "[$nbimg]" . md5(microtime(TRUE)*100000);
    $path = "../data/" . $_SESSION['nickname'] . "/" . $name;
    if (is_dir($path) == FALSE)
    {
        mkdir($path, 0777, true);
    }

    return ($path);
}

function move_files(string $dir_path)
{
    foreach ($_FILES["img"]["error"] as $key => $error)
    {
        if ($error == UPLOAD_ERR_OK)
        {
            $tmp_name = $_FILES["img"]["tmp_name"][$key];
            $extension_upload = strtolower(substr(strrchr($_FILES["img"]["name"][$key], "."), 1));
            $name = uniqid() . "." . $extension_upload;
            $move = move_uploaded_file($_FILES['img']['tmp_name'], $path);
        }
    }
}

$nbimg = picture_check($_FILES);
if ($nbimg >= 1 AND $nbimg <= 3)
{
    $dir_path = create_cube_dir($nbimg);
    move_files($dir_path);
}

// if (isset($_FILES['img']) AND !empty($_FILES['img']['name']))
// {
//     $maxsize = 2097152;
//     $valid_extensions = array('jpg', 'jpeg', 'gif', 'png');
//     $name = md5(microtime(TRUE)*100000);
//     if ($_FILES['img']['size'] <= $maxsize)
//     {
//         $extension_upload = strtolower(substr(strrchr($_FILES['img']['name'], "."), 1));
//         if (in_array($extension_upload, $valid_extensions))
//         {
//             $path = "../data/" . $_SESSION['nickname'] . "/" . $name . "." . $extension_upload;
//             $dir_path = "../data/" . $_SESSION['nickname'];
//             if (is_dir($dir_path) == FALSE)
//             {
//                 mkdir($dir_path, 0777, true);
//             }
//             $dir_contenu = scandir($dir_path);
//             $move = move_uploaded_file($_FILES['img']['tmp_name'], $path);
//             if ($move)
//             {
//                 $msg = "uploaded";
//                 echo "
//                     <script language='JavaScript' type='text/javascript'>
//                         window.location.replace('../user/mygallery.php?msg=".urlencode($msg)."');
//                     </script>";
//             }
//             else
//             {
//                 $msg = "unknow_error";
//                 echo "
//                     <script language='JavaScript' type='text/javascript'>
//                         window.location.replace('../user/mygallery.php?msg=".urlencode($msg)."');
//                     </script>";
//             }
//         }
//         else
//         {
//             $msg = "invalid_extension";
//             echo "
//                 <script language='JavaScript' type='text/javascript'>
//                     window.location.replace('../user/mygallery.php?msg=".urlencode($msg)."');
//                 </script>";
//         }
//     }
//     else
//     {
//         $msg = "to_heavy";
//         echo "
//             <script language='JavaScript' type='text/javascript'>
//                 window.location.replace('../user/mygallery.php?msg=".urlencode($msg)."');
//             </script>";
//     }
// }
// else
// {
//     $msg = "empty";
//     echo "
//         <script language='JavaScript' type='text/javascript'>
//             window.location.replace('../user/mygallery.php?msg=".urlencode($msg)."');
//         </script>";
// }

?>
