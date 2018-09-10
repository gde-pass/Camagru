<?php
sleep(3);

$to = $_GET['email'];
$subject = 'Hi!';
$message = "Hi,\n\nPlease confirm your mail by following this link: LINK";


mail($to, $subject, $message);

# Redirection to login page
echo "
    <script language='JavaScript' type='text/javascript'>
        window.location.replace('../form/form_login.php');
    </script>";
?>
