<?php

class Sensors {

    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function fetchLightSensorData()
    {
        $sql = "SELECT * FROM sensor_data 
                INNER JOIN sensors ON sensors.id = sensor_data.sensor_id 
                WHERE sensor_data.sensor_id = 6";
        $stmt = $this->db->prepare($sql);
        
        if ($stmt->execute()) {
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($data) {
                echo json_encode($data);
            } else {
                echo json_encode([]);
            }
        } else {
            echo json_encode(['error' => 'Failed to fetch data']);
        }
    }
    
    public function fetchLatestSensorData($sensor_id)
    {
        $sql = "SELECT sensor_data.value, sensors.id, sensors.sensor_name 
                FROM sensor_data
                INNER JOIN sensors ON sensors.id = sensor_data.sensor_id
                WHERE sensor_data.sensor_id = :sensor_id
                ORDER BY sensor_data.reading_time DESC
                LIMIT 1"; 
    
        $stmt = $this->db->prepare($sql);
    
        $stmt->bindParam(':sensor_id', $sensor_id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            $data = $stmt->fetch(PDO::FETCH_ASSOC); 
            
            if ($data) {
                echo json_encode($data); 
            } else {
                echo json_encode(['error' => 'No data found for this sensor']); 
            }
        } else {
            echo json_encode(['error' => 'Failed to fetch latest data']); 
        }
    }
    
}