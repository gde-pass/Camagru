<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Camagru</title>
    <link href="/style/header.css" rel="stylesheet" type="text/css">
    <link href="/style/gallery.css" rel="stylesheet" type="text/css">
    <link href="/style/form.css" rel="stylesheet" type="text/css">
    <link href="/style/footer.css" rel="stylesheet" type="text/css">
    <link href="/style/msgbox.css" rel="stylesheet" type="text/css">
    <link href="/style/forgotten_password.css" rel="stylesheet" type="text/css">
    <link href="/style/profile_header.css" rel="stylesheet" type="text/css">
    <link href="/style/general.css" rel="stylesheet" type="text/css">
    <link href="/style/camagru.css" rel="stylesheet" type="text/css">

</head>

<body>
    <header class="header-login-signup">

    	<div class="header-limiter">

    		<h1><a href="/index.php">Cam<span>agru</span></a></h1>

    		<nav>
    			<a href="/index.php">Home</a>
    			<a href="/user/mygallery.php" class="selected">My Gallery</a>
          <?php if ($_SESSION['logged'] == 1) {
          echo("<a href='/user/camagru.php'>Camera</a>");
          } ?>
    		</nav>

        <?php
        if ($_SESSION['logged'] == FALSE)
        {
            echo"
            <ul>
    			<li><a href='/form/form_login.php'>Login</a></li>
    			<li><a href='/form/form_subscription.php'>Sign up</a></li>
    		</ul>";
        }
        else
        {
            echo"
            <div class='header-user-menu'>
                <img src='data:image/png;base64,".$_SESSION['avatar']."' alt='User Image'/>

                <ul>
                    <li><a href='/form/form_settings.php'>Settings</a></li>

                    <li><a href='/script/logout.php' class='highlight'>Logout</a></li>
                </ul>
            </div>";
        }
        ?>

    	</div>

    </header>
