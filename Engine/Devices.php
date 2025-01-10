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
}
