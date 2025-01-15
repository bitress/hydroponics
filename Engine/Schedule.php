<?php
class Schedule
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }


    // Function to fetch all schedules from the database
    public function readSchedules() {
        $query = "SELECT * FROM schedules";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Function to fetch schedule times for a specific schedule ID
    public function getScheduleTimes($scheduleId) {
        $query = "SELECT * FROM schedule_times WHERE schedule_id = :schedule_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':schedule_id', $scheduleId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Function to get target name by target ID and type (device or sensor)
    public function getTargetName($targetId, $targetType) {
        $query = "SELECT " . ($targetType === 'device' ? 'device_name' : 'sensor_name') . " FROM " . ($targetType === 'device' ? 'devices' : 'sensors') . " WHERE " . ($targetType === 'device' ? 'device_id' : 'id') . " = :targetId";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':targetId', $targetId);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

}
