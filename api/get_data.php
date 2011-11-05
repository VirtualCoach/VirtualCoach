<?php

require_once("mysql.php");

$uid = $_GET["uid"];
$data = array();
echo $uid;

global $mysqli;

$stmt = $mysqli->prepare("SELECT power FROM data WHERE uid = ? LIMIT 40");
$stmt->bind_param("i", $uid);
$stmt->execute();
$stmt->bind_result($p);

while ($stmt->fetch()) { 
	$data[] = $p;
}
$stmt->close();

echo json_encode($data);

?>