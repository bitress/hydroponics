<?php

class SensorDeviceMapping
{
    private $db; // Database connection

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Add a new mapping between sensor and device.
     * @param int $sensorId
     * @param int $deviceId
     * @param float $threshold
     * @param string $thresholdType
     * @param string $actionType
     * @param int $status
     * @param int $priority
     * @return bool
     */
    public function addMapping($sensorId, $deviceId, $threshold, $status = 1, $priority = 1)
    {
        $query = "INSERT INTO sensor_device_mapping 
                  (`sensor_id`, `device_id`, `threshold`, `status`, `priority`, created_at, updated_at)
                  VALUES (?, ?, ?, ?, ?, NOW(), NOW())";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$sensorId, $deviceId, $threshold, $status, $priority]);
    }

    /**
     * Update an existing mapping.
     * @param int $mappingId
     * @param array $data
     * @return bool
     */
    public function updateMapping($mappingId, $data)
    {
        $setClause = [];
        $params = [];

        foreach ($data as $column => $value) {
            $setClause[] = "$column = ?";
            $params[] = $value;
        }
        $params[] = $mappingId;

        $query = "UPDATE sensor_device_mapping 
                  SET " . implode(", ", $setClause) . ", updated_at = NOW()
                  WHERE mapping_id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute($params);
    }

    /**
     * Get a single mapping by ID.
     * @param int $mappingId
     * @return array|null
     */
    public function getMappingById($mappingId)
    {
        $query = "SELECT * FROM sensor_device_mapping WHERE mapping_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$mappingId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Get all mappings, optionally filtering by sensor or device.
     * @param int|null $sensorId
     * @param int|null $deviceId
     * @return array
     */
    public function getAllMappings($sensorId = null, $deviceId = null)
    {
        $conditions = [];
        $params = [];

        if ($sensorId !== null) {
            $conditions[] = "sensor_id = ?";
            $params[] = $sensorId;
        }

        if ($deviceId !== null) {
            $conditions[] = "device_id = ?";
            $params[] = $deviceId;
        }

        $query = "SELECT * FROM sensor_device_mapping JOIN devices ON devices.device_id = sensor_device_mapping.device_id JOIN sensors ON sensors.id = sensor_device_mapping.sensor_id ";
        if (count($conditions) > 0) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }

        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Delete a mapping by ID.
     * @param int $mappingId
     * @return bool
     */
    public function deleteMapping($mappingId)
    {
        $query = "DELETE FROM sensor_device_mapping WHERE mapping_id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$mappingId]);
    }

    /**
     * Check if a mapping exists for a given sensor and device.
     * @param int $sensorId
     * @param int $deviceId
     * @return bool
     */
    public function mappingExists($sensorId, $deviceId)
    {
        $query = "SELECT COUNT(*) FROM sensor_device_mapping WHERE sensor_id = ? AND device_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$sensorId, $deviceId]);
        return $stmt->fetchColumn() > 0;
    }

    /**
     * Get active mappings for a specific sensor or device.
     * @param int|null $sensorId
     * @param int|null $deviceId
     * @return array
     */
    public function getActiveMappings($sensorId = null, $deviceId = null)
    {
        $conditions = ["status = 1"];
        $params = [];

        if ($sensorId !== null) {
            $conditions[] = "sensor_id = ?";
            $params[] = $sensorId;
        }

        if ($deviceId !== null) {
            $conditions[] = "device_id = ?";
            $params[] = $deviceId;
        }

        $query = "SELECT * FROM sensor_device_mapping WHERE " . implode(" AND ", $conditions);
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get all devices.
     * @return array
     */
    public function getAllDevices()
    {
        $query = "SELECT * FROM devices";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get sensors.
     * @return array
     */
    public function getSensors()
    {
        $query = "
            SELECT * FROM sensors WHERE sensors.id NOT IN ( SELECT sensor_id FROM sensor_device_mapping );
        ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * Get sensors.
     * @return array
     */
    public function getAllSensors()
    {
        $query = "
            SELECT * FROM sensors
        ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
