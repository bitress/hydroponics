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
    public function getLatestSensorData($sensor_id, $limit = null)
    {
        if ($limit === null) {
            $sql = "SELECT sensor_data.*, sensors.sensor_name 
                    FROM sensor_data
                    INNER JOIN sensors ON sensors.id = sensor_data.sensor_id
                    WHERE sensor_data.sensor_id = :sensor_id
                    ORDER BY sensor_data.reading_time DESC"; 
        } else {
            $sql = "SELECT sensor_data.value, sensors.id, sensors.sensor_name 
                    FROM sensor_data
                    INNER JOIN sensors ON sensors.id = sensor_data.sensor_id
                    WHERE sensor_data.sensor_id = :sensor_id
                    ORDER BY sensor_data.reading_time DESC
                    LIMIT :limit"; 
        }

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':sensor_id', $sensor_id, PDO::PARAM_INT);
        
        if ($limit !== null) {
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT); 
        }

        if ($stmt->execute()) {
            return $limit === null ? $stmt->fetchAll(PDO::FETCH_ASSOC) : $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }

    public function fetchLatestSensorDataJSON($sensor_id, $limit = 1)
    {
        $data = $this->getLatestSensorData($sensor_id, $limit);

        if ($data) {
            echo json_encode($data); 
        } else {
            echo json_encode(['error' => 'No data found for this sensor']); 
        }
    }
    public function fetchSensorDataByDateRange($sensor_id, $range = null)
    {
        $sql = "SELECT sensor_data.value, sensors.id, sensors.sensor_name, sensor_data.reading_time
                FROM sensor_data
                INNER JOIN sensors ON sensors.id = sensor_data.sensor_id
                WHERE sensor_data.sensor_id = :sensor_id ";
    
        $params = ['sensor_id' => $sensor_id];
    
        if ($range) {
            $currentDate = new DateTime();
    
            switch ($range) {
                case '24h':
                    $date = $currentDate->modify('-1 day')->format('Y-m-d H:i:s');
                    $sql .= "AND sensor_data.reading_time >= :date";
                    $params['date'] = $date;
                    break;
    
                case '7d':
                    $date = $currentDate->modify('-7 days')->format('Y-m-d H:i:s');
                    $sql .= "AND sensor_data.reading_time >= :date";
                    $params['date'] = $date;
                    break;
    
                case '30d':
                    $date = $currentDate->modify('-30 days')->format('Y-m-d H:i:s');
                    $sql .= "AND sensor_data.reading_time >= :date";
                    $params['date'] = $date;
                    break;
    
                case 'daily':
                    $date = $currentDate->format('Y-m-d');
                    $sql .= "AND DATE(sensor_data.reading_time) = :date";
                    $params['date'] = $date;
                    break;
    
                default:
                    return null; // Invalid range
            }
        }
    
        $sql .= " ORDER BY sensor_data.reading_time DESC";
    
        $stmt = $this->db->prepare($sql);
    
        // Bind the parameters
        foreach ($params as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
    
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            // Log the error for debugging purposes
            error_log("Error executing query: " . implode(" ", $stmt->errorInfo()));
            return null;
        }
    }
    

        
    }