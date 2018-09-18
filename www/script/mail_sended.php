<?php

# Sleep during the display of the message

 sleep(3);

# Setting up mail.txt in /tmp

$mail = 'From: Camagru <camagru@horsefucker.org>
To: '.$_GET["firstname"].' '.$_GET["lastname"].' <'.$_GET["email"].'>
Subject: Email confirmation

CONFIRM YOUR EMAIL PLZ BRO';

# Send the mail and deleting the mail.txt

shell_exec('echo "'.$mail.'" > /tmp/mail.txt');
shell_exec('sh mail.sh "'.$_GET["email"].'" > /tmp/log.txt 2>&1');
shell_exec('rm -rf /tmp/mail.txt');

# Redirection to login page
echo "
    <script language='JavaScript' type='text/javascript'>
        window.location.replace('../form/form_login.php');
    </script>";
?>
