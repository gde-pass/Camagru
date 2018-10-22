<?php

require('../connection.php');

if ($_GET['cube'] &&  $_GET['user']) {
  $route = "../data/" . $_GET['user'] . "/" . $_GET['cube'];
  if (!is_dir($route))
    return http_response_code(400);
  $sqlcomments = $dbh->prepare("SELECT * FROM `comment` WHERE `cube` = ?");
  $sqlcomments->execute([$_GET['cube']]);
  $msgs = $sqlcomments->fetchAll();
  if (empty($msgs)) {
    return http_response_code(401);
   }
   foreach($msgs as $key=>$value) {
    if ($key % 2 == 1) {
      echo "<div style='background-color: lightgray; border-radius: 5px'>";
    }
    else
      echo "<div style='border-radius: 5px'>";
    echo "<div class='msg_div' style='border-style: inline;'>" .  $value[3] . "</div>";
    echo "<div class='user_div' style='font: 10px arial, sans-serif; font-style: italic;'>@" .  $value[2] . '</div>';
    echo "</div>";
   }
}
?>
