<?php

static function server_pattern_check($email, $password)
{
    if (!preg_match("/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/",$email)) # FAIREUN PETTERN EMAIL AJOUTER A SUB FORM ET SIDE
     {
         die ("invalid email");
         return FALSE;
     }

    if (!preg_match("/((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20})/",$password))
    {
        die ("invalid password");
        return FALSE;
    }
    return TRUE;
}

if (isset($_POST["email"], $_POST["password"])
{

if TRUE -> server_pattern_check($email, $password)

# REQUETE SQL POUR VERIFIER SI LE COMPTE EXISTE


}


?>
