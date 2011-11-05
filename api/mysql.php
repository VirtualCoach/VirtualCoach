<?php

error_reporting(E_ALL ^ E_NOTICE);

$db_host = 'localhost';
$db_user = 'devtest';
$db_pass = 'devtest';
$db_name = 'virtual_coach';

@$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

if (mysqli_connect_errno()) {
	die('<h1>Could not connect to the database</h1><h2>Please try again after a few moments.</h2>');
}

$mysqli->set_charset("utf8");

?>