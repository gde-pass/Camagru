<?php
// sleep(5);

$to = $_GET['email'];
$subject = "c pour confirm ton mail\n";
$message = "la yora un lien klikable\n";
$headers = 'From: webmaster@example.com' . "\r\n" .
     'Reply-To: webmaster@example.com' . "\r\n" .
     'X-Mailer: PHP/' . phpversion();

#ENVOIE DE MAIL

mail ($to, $subject, $message, $headers)
#AFFICHAGE





// echo "
//     <script language='JavaScript' type='text/javascript'>
//         window.location.replace('../form/form_login.php');
//     </script>";
?>
