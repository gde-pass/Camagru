<?php
include('./header.php');
?>
<div class="main-content">

    <!-- You only need this form and the form-register.css -->

    <form class="form-register" method="post" action="#">

        <div class="form-register-with-email">

            <div class="form-white-background">

                <div class="form-title-row">
                    <h1>Create an account</h1>
                </div>

                <div class="form-row">
                    <label>
                        <span>First Name</span>
                        <input type="text" name="firstname">
                    </label>
                </div>

                <div class="form-row">
                    <label>
                        <span>Last Name</span>
                        <input type="text" name="lastname">
                    </label>
                </div>

                <div class="form-row">
                    <label>
                        <span>Email</span>
                        <input type="email" name="email">
                    </label>
                </div>

                <div class="form-row">
                    <label>
                        <span>Password</span>
                        <input type="password" name="password">
                    </label>
                </div>

                <div class="form-row">
                    <label class="form-checkbox">
                        <input type="checkbox" name="checkbox" checked>
                        <span>I agree to the <a href="#">terms and conditions</a></span>
                    </label>
                </div>

                <div class="form-row">
                    <button type="submit">Register</button>
                </div>

            </div>

            <a href="#" class="form-log-in-with-existing">Already have an account? Login here &rarr;</a>

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
include('./footer.php');
?>
