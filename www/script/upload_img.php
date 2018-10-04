<?php
session_start();

if (isset($_FILES['img']) AND !empty($_FILES['img']['name']))
{
    $maxsize = 2097152;
    $valid_extensions = array('jpg', 'jpeg', 'gif', 'png');
    $name = md5(microtime(TRUE)*100000);
    if ($_FILES['img']['size'] <= $maxsize)
    {
        $extension_upload = strtolower(substr(strrchr($_FILES['img']['name'], "."), 1));
        if (in_array($extension_upload, $valid_extensions))
        {
            $path = "../data/" . $_SESSION['nickname'] . "/" . $name . "." . $extension_upload;
            $dir_path = "../data/" . $_SESSION['nickname'];
            if (is_dir($dir_path) == FALSE)
            {
                mkdir($dir_path, 0777, true);
            }
            $dir_contenu = scandir($dir_path);
            $move = move_uploaded_file($_FILES['img']['tmp_name'], $path);
            if ($move)
            {
                $msg = "uploaded";
                echo "
                    <script language='JavaScript' type='text/javascript'>
                        window.location.replace('../user/mygallery.php?msg=".urlencode($msg)."');
                    </script>";
            }
            else
            {
                $msg = "unknow_error";
                echo "
                    <script language='JavaScript' type='text/javascript'>
                        window.location.replace('../user/mygallery.php?msg=".urlencode($msg)."');
                    </script>";
            }
        }
        else
        {
            $msg = "invalid_extension";
            echo "
                <script language='JavaScript' type='text/javascript'>
                    window.location.replace('../user/mygallery.php?msg=".urlencode($msg)."');
                </script>";
        }
    }
    else
    {
        $msg = "to_heavy";
        echo "
            <script language='JavaScript' type='text/javascript'>
                window.location.replace('../user/mygallery.php?msg=".urlencode($msg)."');
            </script>";
    }
}
else
{
    $msg = "empty";
    echo "
        <script language='JavaScript' type='text/javascript'>
            window.location.replace('../user/mygallery.php?msg=".urlencode($msg)."');
        </script>";
}

?>
