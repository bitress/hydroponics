<?php
class Devices {
    private Database $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getDevices() {
        $query = "SELECT * FROM devices";
        $result = $this->db->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // Create Device
    public function createDevice($deviceName) {
        $query = "INSERT INTO devices (device_name) VALUES (:device_name)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':device_name', $deviceName);
        return $stmt->execute();
    }

    // Update Device
    public function updateDevice($deviceId, $deviceName) {
        $query = "UPDATE devices SET device_name = :device_name WHERE device_id = :device_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':device_name', $deviceName);
        $stmt->bindParam(':device_id', $deviceId);
        return $stmt->execute();
    }

    // Delete Device
    public function deleteDevice($deviceId) {
        $query = "DELETE FROM devices WHERE device_id = :device_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':device_id', $deviceId);
        return $stmt->execute();
    }

    // DeviceByID - Fetch a single device by its ID
    public function getDeviceById($deviceId) {
        $query = "SELECT * FROM devices WHERE device_id = :device_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':device_id', $deviceId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
