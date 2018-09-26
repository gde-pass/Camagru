<?php
include '../header.php';

if (isset($_GET['email']))
{
    echo '<div class="error" style="margin-bottom: 55px;">That email adress does not exist.</div>';
}
?>

<div class="main-content">

    <form class="form-forgotten-password" method="post" action="/script/script_forgotten_password.php">

        <div class="form-forgotten-password-with-email">

            <div class="form-white-background">

                <div class="form-title-row">
                    <h1>Reset your password</h1>
                </div>

                <div class="form-row">
                    <label>
                        <span>Email</span>
                        <input type="email" name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" minlength="3" maxlength="254">
                    </label>
                </div>

                <div class="form-row">
                    <button type="submit">Reset</button>
                </div>

            </div>

        </div>

    </form>

</div>

<?php
include '../footer.php';
?>
