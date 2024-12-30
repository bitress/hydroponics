<?php

class Cycles {

    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Retrieve all sensors with their associated cycles.
     *
     * @return array The sensors with their cycles.
     */
    public function getGroupedCycles(): array
    {
        $sql = "
            SELECT cycles.pause, cycles.is_active, sensors.id AS sensor_id, sensors.sensor_name AS sensor_name,
                cycles.cycle_id AS cycle_id, cycles.cycle_number, 
                cycles.interval_seconds, cycles.duration_minutes
            FROM sensors
            LEFT JOIN cycles ON sensors.id = cycles.sensor_id
            ORDER BY sensors.sensor_name ASC, cycles.cycle_number ASC
        ";

        try {
            $stmt = $this->db->query($sql);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $grouped = [];
            foreach ($results as $row) {
                $sensorId = $row['sensor_id'];
                if (!isset($grouped[$sensorId])) {
                    $grouped[$sensorId] = [
                        'sensor_name' => $row['sensor_name'],
                        'cycles' => []
                    ];
                }

                if ($row['cycle_id'] !== null) {
                    $grouped[$sensorId]['cycles'][] = [
                        'cycle_id' => $row['cycle_id'],
                        'cycle_number' => $row['cycle_number'],
                        'interval_seconds' => $row['interval_seconds'],
                        'duration_minutes' => $row['duration_minutes'],
                        'is_active' => $row['is_active'],
                        'pause' => $row['pause'],
                    ];
                }
            }

            return $grouped;
        } catch (PDOException $e) {
            error_log('Failed to retrieve grouped cycles: ' . $e->getMessage());
            return [];
        }
    }


    /**
     * Retrieves cycles for a specific sensor by its ID.
     *
     * @param int $sensorId The ID of the sensor.
     * @return array An associative array containing the sensor name and its cycles.
     */
    public function getCyclesBySensorId(int $sensorId): array
    {
        $sql = "
            SELECT sensors.id AS sensor_id, sensors.sensor_name AS sensor_name,
                cycles.cycle_id AS cycle_id, cycles.cycle_number, 
                cycles.interval_seconds, cycles.duration_minutes, cycles.pause
            FROM sensors
            LEFT JOIN cycles ON sensors.id = cycles.sensor_id
            WHERE sensors.id = :sensor_id
            ORDER BY cycles.cycle_number ASC
        ";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':sensor_id', $sensorId, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($results)) {
                return [];
            }

            $sensorName = $results[0]['sensor_name'];
            $cycles = [];

            foreach ($results as $row) {
                if ($row['cycle_id'] !== null) {
                    $cycles[] = [
                        'cycle_id' => $row['cycle_id'],
                        'cycle_number' => $row['cycle_number'],
                        'interval_seconds' => $row['interval_seconds'],
                        'duration_minutes' => $row['duration_minutes'],
                        'pause' => $row['pause']
                    ];
                }
            }

            return [
                'sensor_id' => $sensorId,
                'sensor_name' => $sensorName,
                'cycles' => $cycles
            ];
        } catch (PDOException $e) {
            error_log('Failed to retrieve cycles for sensor ID ' . $sensorId . ': ' . $e->getMessage());
            return [];
        }
    }

    public function checkIfHasCycle($sensorId) {
        $sql = "SELECT COUNT(*) as cycle_count FROM cycles WHERE sensor_id = :sensor_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':sensor_id' => $sensorId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Return true if there are cycles, false otherwise
        return $result['cycle_count'] > 0;
    }


      /**
         * Creates new cycles for a sensor.
         *
         * @param int $sensorId The ID of the sensor.
         * @param array $cycles An array of cycles to create.
         * @return bool True on success, False on failure.
         */
        public function createCycles(int $sensorId, array $cycles): bool
        {
            $sql = "
                INSERT INTO cycles (sensor_id, cycle_number, interval_seconds, duration_minutes)
                VALUES (:sensor_id, :cycle_number, :interval_seconds, :duration_minutes)
            ";

            try {
                $this->db->beginTransaction();
                $stmt = $this->db->prepare($sql);

                foreach ($cycles as $cycle) {
                    // Validate cycle data
                    if (
                        !isset($cycle['cycle_number']) ||
                        !isset($cycle['interval_seconds']) ||
                        !isset($cycle['duration_minutes'])
                    ) {
                        throw new Exception('Invalid cycle data.');
                    }

                    $stmt->execute([
                        ':sensor_id' => $sensorId,
                        ':cycle_number' => $cycle['cycle_number'],
                        ':interval_seconds' => $cycle['interval_seconds'],
                        ':duration_minutes' => $cycle['duration_minutes']
                    ]);
                }

                $this->db->commit();
                return true;
            } catch (Exception $e) {
                $this->db->rollBack();
                error_log('Failed to create cycles for sensor ID ' . $sensorId . ': ' . $e->getMessage());
                return false;
            }
        }

        /**
         * Updates existing cycles for a sensor.
         *
         * @param int $sensorId The ID of the sensor.
         * @param array $cycles An array of cycles to update.
         * @return bool True on success, False on failure.
         */
        public function updateCycles(int $sensorId, array $cycles): bool
        {
            $sql = "
                UPDATE cycles 
                SET interval_seconds = :interval_seconds, duration_minutes = :duration_minutes, pause = :pause
                WHERE sensor_id = :sensor_id AND cycle_number = :cycle_number
            ";

            try {
                $this->db->beginTransaction();
                $stmt = $this->db->prepare($sql);

                foreach ($cycles as $cycle) {
                    // Validate cycle data
                    if (
                        !isset($cycle['cycle_number']) ||
                        !isset($cycle['interval_seconds']) ||
                        !isset($cycle['pause']) ||
                        !isset($cycle['duration_minutes'])
                    ) {
                        throw new Exception('Invalid cycle data.');
                    }

                    $stmt->execute([
                        ':interval_seconds' => $cycle['interval_seconds'],
                        ':duration_minutes' => $cycle['duration_minutes'],
                        ':sensor_id' => $sensorId,
                        ':cycle_number' => $cycle['cycle_number'],
                        ':pause' => $cycle['pause']
                    ]);
                }

                $this->db->commit();
                return true;
            } catch (Exception $e) {
                $this->db->rollBack();
                error_log('Failed to update cycles for sensor ID ' . $sensorId . ': ' . $e->getMessage());
                return false;
            }
        }
}