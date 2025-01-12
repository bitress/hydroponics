<?php

class Camera {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function detectionLogs() {
        $query = "SELECT * FROM camera_logs";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
