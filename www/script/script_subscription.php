<?php
include '../config/database.php';
include '../header.php';

# Check patterns server side
function server_pattern_check($firstname, $lastname, $nickname, $password, $email)
{
    if (!preg_match("/^[À-ÿa-zA-Z' -]+$/",$firstname))
     {
         die ("invalid first name");
         return FALSE;
     }

    if (!preg_match("/^[À-ÿa-zA-Z' -]+$/",$lastname))
     {
         die ("invalid last name");
         return FALSE;
     }

    if (!preg_match("/^[0-9a-zA-Z'-]+$/",$nickname))
    {
        die ("invalid nickname");
        return FALSE;
    }

    if (!preg_match("/((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20})/",$password))
    {
        die ("invalid password");
        return FALSE;
    }

    if (!preg_match("/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/",$email))
    {
        die ("invalid email");
        return FALSE;
    }
    return TRUE;
}

if (isset($_POST["firstname"], $_POST["lastname"], $_POST["nickname"], $_POST["email"], $_POST["password"], $_POST["termsandconditions"]))
{
    #convert everthing into local varibles
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $nickname = $_POST["nickname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    # generating random key
    $key = md5(microtime(TRUE)*100000);

    if (server_pattern_check($firstname, $lastname, $nickname, $password, $email) === TRUE)
    {
            #Connection to DB camagru
            $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PW);
            #set the PDO error mode to exception
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            #Check if the nickname is already taken or not
            $sql = $dbh->prepare("SELECT * FROM `users` WHERE `users`.`nickname` = ?");
            $sql->execute([$nickname]);
            $nickname_availability = $sql->fetch(PDO::FETCH_ASSOC);
            if ($nickname_availability !== FALSE)
            {
                # Redirection to sub page
                 echo "
                     <script language='JavaScript' type='text/javascript'>
                         window.location.replace('../form/form_subscription.php?nickname=no');
                     </script>";
            }

            #Check if the email is already taken or not
            $sql = $dbh->prepare("SELECT * FROM `users` WHERE `users`.`email` = ?");
            #run the sql request
            $sql->execute([$email]);
            $email_availability = $sql->fetch(PDO::FETCH_ASSOC);
            if ($email_availability !== FALSE)
            {
                # Redirection to sub page
                 echo "
                     <script language='JavaScript' type='text/javascript'>
                         window.location.replace('../form/form_subscription.php?email=no');
                     </script>";
            }
            #Hash the password
            $password = hash('whirlpool', $password);
            #set the sql request for insert the new user
            $sql = $dbh->prepare("INSERT INTO `users` (`id`, `nickname`, `password`, `email`, `firstname`, `lastname`, `key`)
                    VALUES (NULL, ?, ?, ?, ?, ?, ?)");
            #run the sql request
            $sql->execute([$nickname, $password, $email, $firstname, $lastname, $key]);
            # Setting up mail
            $to      = $email;
            $subject = 'Email Confirmation';
            $message =
            'To confirm your registration please click or copy and paste the following link into your web browser
            http://192.168.99.100/script/mail_confirmation.php?nickname='.urlencode($nickname).'&key='.urlencode($key).'

            This is an automatically generated email, please do not reply to it.
            If you have any queries regarding your order please email gde-pass@student.42.fr';
            $headers = array(
                'From' => 'project.camagru.42@gmail.com',
                'Reply-To' => 'gde-pass@student.42.fr',
                'X-Mailer' => 'PHP/' . phpversion()
            );
            #send the mail
            mail($to, $subject, $message, $headers);
            # Redirection to login page
            echo "
             <script language='JavaScript' type='text/javascript'>
                 window.location.replace('../form/form_login.php?email=sent');
             </script>";
    }
}
include '../footer.php';
?>
