<?php
/**
 * This is of course naive demo but it will fool 1/3 of users (without spam filter)
 */

$to      = 'IW Coin Admin <some.admin@example.com>';
$subject = 'ATTENTION! Possible password leak - please change your password!';
$message = 'Hello naive user, click here and provide your complete credentials to us ;-)';
$headers = 'From: IW Coin Support <webmaster@example.com>';
mail($to, $subject, $message, $headers);
