<?php
include '../header.php';

if (isset($_GET['email']) AND !empty($_GET['email']))
{
    echo '<div class="info" style="margin-bottom: 55px;">A confirmation email has been sent to you.</div>';
}
?>

<div class="main-content">

    <form class="form-login" method="post" action="#">

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

            <a href="#" class="form-google-button">Google</a>
            <a href="#" class="form-facebook-button">Facebook</a>
            <a href="#" class="form-twitter-button">Twitter</a>

        </div>

    </form>

</div>

<?php
include '../footer.php';
?>
