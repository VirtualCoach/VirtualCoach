<?php

session_start();
date_default_timezone_set('America/Los_Angeles');

require_once("User.php");
$user = new User();

$e = filter_var($_SESSION['e'], FILTER_SANITIZE_STRING);

?>