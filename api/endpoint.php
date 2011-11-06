<?php

/*
Documentation:

call enpoint.php with the following GET params

m = single | multiple
p = first column name (used for single)
q = second column name
n = number of points to aggregate

*/

require_once("api.php");

$uids = filter_var($_GET['uid'], FILTER_SANITIZE_NUMBER_INT);

$api = new API($uids);

$m = filter_var($_GET['m'], FILTER_SANITIZE_STRING);
$col1 = filter_var($_GET['p'], FILTER_SANITIZE_STRING);
$col2 = filter_var($_GET['q'], FILTER_SANITIZE_STRING);
$points = filter_var($_GET['n'], FILTER_SANITIZE_NUMBER_INT);

switch ($m) {
	case "single":
		echo $api->getSingleMetric($col1, $points);
		break;
	case "multiple":
		echo $api->getMetricOverMetric($col1, $col2, $points);
		break;
	case "getmmp":
		echo $api->getPowerCol("mmp", $points);
		break;
	case "x_mmp":
		echo $api->getPowerCol($col1, $points);
		break;
}

?>