<?php

class Camera {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function detectionLogs() {
        $query = "SELECT log_id, raw_image, annotated_image, datetime FROM camera_logs WHERE datetime IN ( SELECT MIN(datetime) FROM camera_logs GROUP BY FLOOR(UNIX_TIMESTAMP(datetime) / (6 * 3600)) ) ORDER BY datetime;";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
