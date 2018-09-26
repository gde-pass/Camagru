<?php
include '../header.php';
?>

<div class="main-content">

    <form class="form-forgotten-password" method="post" action="#">

        <div class="form-forgotten-password-with-email">

            <div class="form-white-background">

                <div class="form-title-row">
                    <h1>Reset your password</h1>
                </div>

                <div class="form-row">
                    <label>
                        <span>Email</span>
                        <input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
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
