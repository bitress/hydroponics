<?php
include_once 'init.php';
$sensor = new Sensors();

header('Content-Type: application/json');
echo json_encode($sensor->getLatestSensorData($_GET['sensor_id']));
?>
