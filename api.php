<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

include_once 'init.php';

$stmt = $db->prepare("SELECT cycles.interval_seconds FROM cycles GROUP BY cycles.interval_seconds LIMIT 1");
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row) {
    echo json_encode(array("interval" => $row['interval_seconds']));
} else {
    echo json_encode(array("interval" => 30*60));
}
