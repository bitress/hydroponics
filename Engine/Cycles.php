<?php

class Cycles {

    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function create($sensor_id, $cycles)
    {
        $sql = "INSERT INTO cycles (sensor_id, cycle_number, interval_seconds, duration_minutes) 
                VALUES (:sensor_id, :cycle_number, :interval_seconds, :duration_minutes)";
        $stmt = $this->db->prepare($sql);

        try {
            $this->db->beginTransaction();

            foreach ($cycles as $cycle) {
                $stmt->execute([
                    ':sensor_id'         => $sensor_id,
                    ':cycle_number'     => $cycle['number'],
                    ':interval_seconds' => $cycle['interval'],
                    ':duration_minutes' => $cycle['duration'],
                ]);
            }

            $this->db->commit();
            return true;
        } catch (\PDOException $e) {
            $this->db->rollBack();
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Failed to insert data']);
            exit;
        }

    }

}