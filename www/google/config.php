<?php
    session_start();
    require_once "GoogleAPI/vendor/autoload.php";
    $gClient = new Google_Client();
    $gClient->setClientId("931116345026-gcp0310rii2g64gmv1pusc0lbiltb998.apps.googleusercontent.com");
    $gClient->setClientSecret("ugcrAp7jbBwZ8ko4-oaqrkCl");
    $gClient->setApplicationName("Camagru");
    $gClient->setRedirectUri("http://localhost:2000/google/callback.php");
    $gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");
?>
