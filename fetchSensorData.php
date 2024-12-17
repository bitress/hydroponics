<?php

include_once 'init.php';
$sensor_id = isset($_GET['sensor_id']) ? $_GET['sensor_id'] : 1;
$range = isset($_GET['range']) ? $_GET['range'] : null;

$sensor = new Sensors();

$data = $sensor->fetchSensorDataByDateRange($sensor_id, $range);

header('Content-Type: application/json');
echo json_encode($data);