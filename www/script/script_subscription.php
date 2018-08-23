<?php

// print_r($_POST);

function server_pattern_check($firstname, $lastname, $nickname, $password,)
{
    if (!preg_match("/^[À-ÿa-zA-Z'-]+$/",$firstname))
     {
         die ("invalid first name");
     }

    if (!preg_match("/^[À-ÿa-zA-Z'-]+$/",$lastname))
     {
         die ("invalid last name");
     }

    if (!preg_match("/^[0-9a-zA-Z'-]+$/",$nickname))
    {
        die ("invalid nickname");
    }

    if (!preg_match("/((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20})/",$password))
    {
        die ("invalid password");
    }
}

?>
