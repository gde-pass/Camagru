<?php
session_start();
require 'autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;

define('CONSUMER_KEY', 'vPWtdlEsT8enKwGxiD1mA4iYJ');
define('CONSUMER_SECRET', 'khKgR9F0RzA407jXG9lnJUJp8QlTKJXus06rktqUCwj3hxRbks');
define('OAUTH_CALLBACK', 'https://192.168.99.100/twitter/callback.php');

if(!isset($_SESSION['access_token']))
{
    $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
    $request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
    $_SESSION['oauth_token'] = $request_token['oauth_token'];
    $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
    $url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
    header('Location:' . $url);
}
else
{
    $access_token = $_SESSION['access_token'];
    $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
    $user = $connection->get("account/verify_credentials");
    $_SESSION['logged'] = TRUE;
    $_SESSION['nickname'] = $user->name;
    $_SESSION['firstname'] = "Twitter";
    $_SESSION['lastname'] = "Account";
    $_SESSION['avatar'] = base64_encode(file_get_contents($user->profile_image_url_https));
    $_SESSION['twitter'] = "TRUE";
    header('Location: ../index.php');
}
?>
