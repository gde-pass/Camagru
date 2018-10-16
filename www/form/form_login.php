<?php
session_start();

if ($_SESSION['logged'] == TRUE)
{
    echo "
        <script language='JavaScript' type='text/javascript'>
            window.location.replace('../index.php?logged=yes');
        </script>";
    exit(0);
}
require_once "../google/config.php";
$loginURL = $gClient->createAuthUrl();

include '../header.php';

if (isset($_GET['email']) AND !empty($_GET['email']))
{
    echo '<div class="info" style="margin-bottom: 55px;">A confirmation email has been sent to you.</div>';
}
if (isset($_GET['password']) AND !empty($_GET['password']))
{
    echo '<div class="success" style="margin-bottom: 55px;">Your password has been successfully changed. Please login using your new password.</div>';
}
if (isset($_GET['log']) AND !empty($_GET['log']))
{
    echo '<div class="error" style="margin-bottom: 55px;">Wrong email or password. Please try again</div>';
}
if (isset($_GET['confirm']) AND !empty($_GET['confirm']))
{
    echo '<div class="warning" style="margin-bottom: 55px;">You have to confirm your account first, please check the mailbox you used for subscribe</div>';
}
if (isset($_GET['logged']) AND !empty($_GET['logged']))
{
    echo '<div class="warning" style="margin-bottom: 55px;">You have to login first</div>';
}
?>

<div class="main-content">

    <form class="form-login" method="post" action="/script/script_login.php">

        <div class="form-log-in-with-email">

            <div class="form-white-background">

                <div class="form-title-row">
                    <h1>Log in</h1>
                </div>

                <div class="form-row">
                    <label>
                        <span>Email</span>
                        <input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
                    </label>
                </div>

                <div class="form-row">
                    <label>
                        <span>Password</span>
                        <input type="password" name="password" pattern="((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20})">
                    </label>
                </div>

                <div class="form-row">
                    <button type="submit">Log in</button>
                </div>

            </div>

            <p>
                <a href="/form/form_forgotten_password.php" class="form-forgotten-password">Forgotten Password</a>
                &middot;
                <a href="/form/form_subscription.php" class="form-create-an-account">Create an account &rarr;</a>
            </p>

        </div>

        <div class="form-sign-in-with-social">

            <div class="form-row form-title-row">
                <span class="form-title">Sign in with</span>
            </div>

            <a href="<?= $loginURL ?>" class="form-google-button">Google</a>
            <a href="#" class="form-facebook-button">Facebook</a>
            <a href="../twitter/index.php" class="form-twitter-button">Twitter</a>

        </div>

    </form>

</div>

<?php
include '../footer.php';
?>
