<?php

require_once("util.php");
require_once("User.php");
$user = new User();

$email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
$cpassword = filter_var($_POST['cpassword'], FILTER_SANITIZE_STRING);

if ($password != $cpassword) {
	set_error("passwords");
	header("Location: ../signup");
	die();
}

$user->create_user($username, $password, $email);

?>