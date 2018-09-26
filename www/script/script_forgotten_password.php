<?php
include '../config/database.php';

function server_pattern_check($email)
{
    if (!preg_match("/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/",$email))
    {
        die ("invalid email");
        return FALSE;
    }
    return TRUE;
}

if (isset($_POST['email']) AND !empty($_POST['email']) AND server_pattern_check($_POST['email']) === TRUE)
{
    #Convert into local variable
    $email = $_POST['email'];
    #get the user ip
    $ip = isset($_SERVER['HTTP_CLIENT_IP'])?$_SERVER['HTTP_CLIENT_IP']:isset($_SERVER['HTTP_X_FORWARDED_FOR'])?$_SERVER['HTTP_X_FORWARDED_FOR']:$_SERVER['REMOTE_ADDR'];
    #Connection to DB camagru
    $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PW);
    #set the PDO error mode to exception
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    #Check if the email exist or not
    $sql = $dbh->prepare("SELECT * FROM `users` WHERE `users`.`email` = ?");
    $sql->execute([$email]);
    $email_availability = $sql->fetch(PDO::FETCH_ASSOC);
    if ($email_availability === FALSE)
    {
        # Redirection to form FP page
         echo "
             <script language='JavaScript' type='text/javascript'>
                 window.location.replace('../form/form_forgotten_password.php?email=no');
             </script>";
    }
    #Generate the reset_token
    $reset_token = md5(microtime(TRUE)*100000);
    $datetime = date("Y-m-d H:i:s");
    #set the sql request for insert the new token and date of generating
    $sql = $dbh->prepare("UPDATE `users` SET `reset_token` = ?, `date_token` = ? WHERE `users`.`email` = ?");
    #run the sql request
    $sql->execute([$reset_token, $datetime, $email]);
    # Setting up mail
    $to      = $email;
    $subject = 'Reset Password';
    $message = "A request to reset your password for your account has been made from the following IP adress: $ip\r\nTo reset your password please click on this link or copy and paste this URL into your browser (link expires in 24 hours):\r\nhttp://192.168.99.100/script/password_confirmation.php?token=".urlencode($reset_token)."&email=".urlencode($email)."\r\n\nThis is an automatically generated email, please do not reply to it.\r\nIf you have any queries regarding your order please email gde-pass@student.42.fr";
    $headers = array(
        'From' => 'project.camagru.42@gmail.com',
        'Reply-To' => 'gde-pass@student.42.fr',
        'X-Mailer' => 'PHP/' . phpversion()
    );
    #send the mail
    mail($to, $subject, $message, $headers);
    echo "
     <script language='JavaScript' type='text/javascript'>
         window.location.replace('../form/form_forgotten_password.php?email=sent');
     </script>";
}
?>
