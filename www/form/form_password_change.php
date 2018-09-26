<?php
include '../header.php';
?>

<div class="main-content">

    <form class="form-forgotten-password" method="post" action="/script/script_change_password.php">

        <div class="form-forgotten-password-with-email">

            <div class="form-white-background">

                <div class="form-title-row">
                    <h1>Choose a new password</h1>
                </div>

                <div class="form-row">
                    <label>
                        <span>Password</span>
                        <input type="password" name="password" required minlength="6" maxlength="20" pattern="((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20})">
                    </label>
                </div>

                <div class="form-row">
                    <button type="submit">OK</button>
                </div>

            </div>

        </div>

    </form>

</div>

<?php
include '../footer.php';
?>
