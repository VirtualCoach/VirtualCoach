<?php

require_once("util.php");
require_once("User.php");
require_once("../api/CSV_Handler.php");
$csvh = new CSV_Handler();
$user = new User();

$age = filter_var($_POST['age'], FILTER_SANITIZE_NUMBER_INT);
$weight = filter_var($_POST['weight'], FILTER_SANITIZE_NUMBER_FLOAT);
$height = filter_var($_POST['height'], FILTER_SANITIZE_NUMBER_FLOAT);
$years = filter_var($_POST['years'], FILTER_SANITIZE_NUMBER_INT);
$filename = filter_var($_POST['myfile'], FILTER_SANITIZE_STRING);

if ($user->add_user_info($age, $weight, $height, $years)) {
	$res = $csvh->parse_file($filename, $_SESSION['uid']);
	if ($res) {
		$user->unset_error();
		header("Location: ../dashboard");
	} else {
		$user->set_error("parse");
		header("Location: ../information");
	}
} else {
	header("Location: ../information");
}

?>