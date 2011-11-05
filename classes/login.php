<?php

require("User.php");
$user = new User();

$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

$user->log_in($username, $password);

?>