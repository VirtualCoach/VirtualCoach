<?php

require_once("api.php");

$api = new API();

$method = filter_var($_GET['method'], FILTER_SANITIZE_STRING);
$p = filter_var($_GET['p'], FILTER_SANITIZE_STRING);
$q = filter_var($_GET['q'], FILTER_SANITIZE_STRING);

switch ($method) {
	case "single":
		echo $api->getSingleMetric($p);
		break;
	case "multiple":
		echo $api->getMetricOverMetric($p, $q);
		break;
}

?>