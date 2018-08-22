<?php

// print_r($_POST);

function check_flname($firstname, $lastname)
{
    if(!preg_match("/^[À-ÿa-zA-Z'-]+$/",$firstname))
     {
         die ("invalid first name");
     }
    if(!preg_match("/^[À-ÿa-zA-Z'-]+$/",$firstname))
     {
         die ("invalid last name");
     }
}

function check_nickname($nickname)
{

}

check_flname($_POST["firstname"], $_POST["lastname"]);
check_nickname($_POST["nickname"]);
?>
