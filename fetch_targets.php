<?php
include_once 'init.php';
header('Content-Type: application/json');

$type = $_GET['type'] ?? null;

if (!$type || !in_array($type, ['device', 'sensor'])) {
    echo json_encode([]);
    exit;
}

try {

    $table = $type === 'device' ? 'devices' : 'sensors';
    $query = $type === 'device' ? 
        "SELECT device_id AS id, device_name AS name FROM devices WHERE is_active = 1" : 
        "SELECT id, sensor_name AS name FROM sensors WHERE is_active = 1";

    $stmt = $db->prepare($query);
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (Exception $e) {
    echo json_encode([]);
}
