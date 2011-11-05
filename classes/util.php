<?php

session_start();
date_default_timezone_set('America/Los_Angeles');

require_once("User.php");

$user = new User();

function set_error($e) {
	$_SESSION['e'] = $e;
}

function unset_error() {
	unset($_SESSION['e']);
}

$e = filter_var($_SESSION['e'], FILTER_SANITIZE_STRING);

?>