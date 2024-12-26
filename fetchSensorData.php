<?php
// fetchSensorData.php

include_once 'init.php';

// Check if sensor_id is an array or a single value
$sensor_ids = isset($_GET['sensor_id']) ? $_GET['sensor_id'] : [1]; // Default to [1] if not set

// Ensure sensor_ids is an array
if (!is_array($sensor_ids)) {
    $sensor_ids = [$sensor_ids];
}

$range = isset($_GET['range']) ? $_GET['range'] : null;

$sensor = new Sensors();

// Fetch data for all sensor_ids
$data = $sensor->fetchSensorDataByDateRangeMultiple($sensor_ids, $range);

header('Content-Type: application/json');
echo json_encode($data); 
?>
