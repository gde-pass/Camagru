<?php
sleep(5);

$from = '<project.camagru.42@gmail.com>';
$to = '<' . $_GET['email'] . '>';
$subject = 'Hi!';
$body = "Hi,\n\nPlease confirm your mail by following this link: LINK";

$headers = array
(
    'From' => $from,
    'To' => $to,
    'Subject' => $subject
);

$smtp = Mail::factory('smtp', array(
        'host' => 'ssl://smtp.gmail.com',
        'port' => '465',
        'auth' => true,
        'username' => 'project.camagru.42@gmail.com',
        'password' => 'Camagru42'
    ));

#ENVOIE DE MAIL
$mail = $smtp->send($to, $headers, $body);

#AFFICHAGE
if (PEAR::isError($mail))
{
    echo('<p>' . $mail->getMessage() . '</p>');
}
else
{
    echo('<p>Message successfully sent!</p>');
}

# Redirection to login page
echo "
    <script language='JavaScript' type='text/javascript'>
        window.location.replace('../form/form_login.php');
    </script>";
?>
