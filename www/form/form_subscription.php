<?php
include '../header.php';
?>

<div class="main-content">

    <form class="form-register" method="post" action="/script/script_subscription.php">

        <div class="form-register-with-email">

            <div class="form-white-background">

                <div class="form-title-row">
                    <h1>Create an account</h1>
                </div>

                <div class="form-row">
                    <label>
                        <span>First Name</span>
                        <input type="text" name="firstname" required pattern="^[À-ÿa-zA-Z' -]+$" minlength="2" maxlength="255">
                    </label>
                </div>

                <div class="form-row">
                    <label>
                        <span>Last Name</span>
                        <input type="text" name="lastname" required pattern="^[À-ÿa-zA-Z' -]+$" minlength="2" maxlength="255">
                    </label>
                </div>

                <div class="form-row">
                    <label>
                        <span>Nickname</span>
                        <input type="text" name="nickname" required pattern="^[0-9a-zA-Z'-]+$" minlength="2" maxlength="30">
                    </label>
                </div>

                <div class="form-row">
                    <label>
                        <span>Email</span>
                        <input type="email" name="email" required minlength="3" maxlength="254">
                    </label>
                </div>

                <div class="form-row">
                    <label>
                        <span>Password</span>
                        <input type="password" name="password" required minlength="6" maxlength="20" pattern="((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20})">
                    </label>
                </div>

                <div class="form-row">
                    <label class="form-checkbox">
                        <input type="checkbox" name="termsandconditions" unchecked required>
                        <span>I agree to the <a href="/termsandconditions.php">terms and conditions</a></span>
                    </label>
                </div>

                <div class="form-row">
                    <button type="submit">Register</button>
                </div>

            </div>

            <a href="/form/form_login.php" class="form-log-in-with-existing">Already have an account? Login here &rarr;</a>

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