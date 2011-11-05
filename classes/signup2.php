<?php

require_once("util.php");
require_once("User.php");
require_once("../api/CSV_Handler.php");
$csvh = new CSV_Handler();
$user = new User();

/*$email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
$cpassword = filter_var($_POST['cpassword'], FILTER_SANITIZE_STRING);

$user->create_user($username, $password, $email);*/

$csvh->parse_file("Hello", $_SESSION['uid']);

header("Location: ../dashboard");

?>