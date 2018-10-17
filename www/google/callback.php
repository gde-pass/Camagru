<?php

        require_once "config.php";

        if (isset($_SESSION['access_token']))
        $gClient->setAccessToken($_SESSION['access_token']);
        elseif (isset($_GET['code']))
        {
            $token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
            $_SESSION['acces_token'] = $token;
        }
        else
        {
            header('Location: ../form/form_login.php');
            exit();
        }
        $oAuth = new Google_Service_Oauth2($gClient);
        $userData = $oAuth->userinfo_v2_me->get();

        $_SESSION['logged'] = TRUE;
        $_SESSION['email'] = $userData['email'];
        $_SESSION['firstname'] = "Google";
        $_SESSION['lastname'] = "User";
        $_SESSION['nickname'] = $userData['name'];
        $_SESSION['avatar'] = base64_encode(file_get_contents($userData['picture']));
        $_SESSION['twitter'] = "TRUE";

        header('Location: ../index.php');
?>
