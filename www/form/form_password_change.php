<?php
include '../header.php';
include '../config/database.php';

if (isset($_GET['email']) AND !empty($_GET['email']) && isset($_GET['token']) AND !empty($_GET['token']))
{
    #Set get into local variable
    $token = $_GET['token'];
    $email = $_GET['email'];

    #Connection to DB camagru
    $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PW);
    #set the PDO error mode to exception
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    #Check if the token is correct
    $sql = $dbh->prepare("SELECT * FROM `users` WHERE `users`.`email` = ? AND `users`.`reset_token` = ?");
    $sql->execute([$email, $token]);
    $token_availability = $sql->fetch(PDO::FETCH_ASSOC);
    #Check if the token is outdating

    $datetime1 = new DateTime('2009-10-11');
    $datetime2 = new DateTime('2009-10-13');
    $interval = $datetime1->diff($datetime2);
    echo $interval->format('%R%h');


    if ($token_availability['reset_token'] == $token)
    {

    }


}
else
{
    $show_form = FALSE;
    echo '<div class="error">Invalid approach, please use the link that has been send to your email.</div>';
}
#show the form if every check are done
if ($show_form === TRUE)
{
    echo "
    <div class='main-content'>

        <form class='form-forgotten-password' method='post' action='/script/script_change_password.php'>

            <div class='form-forgotten-password-with-email'>

                <div class='form-white-background'>

                    <div class='form-title-row'>
                        <h1>Choose a new password</h1>
                    </div>

                    <div class='form-row'>
                        <label>
                            <span>Password</span>
                            <input type='password' name='password' required minlength='6' maxlength='20' pattern='((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20})'>
                        </label>
                    </div>

                    <div class='form-row'>
                        <button type='submit'>OK</button>
                    </div>

                </div>

            </div>

        </form>

    </div>";
}
include '../footer.php';
?>
