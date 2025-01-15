<?php
require_once 'Devices.php';
$DeviceClass = new Devices();

if (isset($_GET['device_id'])) {
    $deviceId = $_GET['device_id'];
    $device = $DeviceClass->getDeviceById($deviceId);
    echo json_encode($device);
}
?>
