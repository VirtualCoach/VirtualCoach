<?php

require_once("../api/CSV_Handler.php");
$csvh = new CSV_Handler();

echo $csvh->validate("ptap25.csv");

?>