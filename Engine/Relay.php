<?php
// Relay.php

require_once 'Database.php';

class Relay {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function addRelay($name, $mode, $gpio) {
        if (!is_numeric($gpio) || $gpio < 0 || $gpio > 40) {
            return ['status' => 'error', 'message' => 'Invalid GPIO pin number'];
        }
        $sql = "INSERT INTO relays (relay_name, control_mode, gpio) VALUES (:rn, :cm, :gpio)";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":rn", $name);
            $stmt->bindParam(":cm", $mode);
            $stmt->bindParam(":gpio", $gpio, PDO::PARAM_INT); 
            $stmt->execute();
            return ['status' => 'success', 'message' => 'Relay added successfully'];
    
        } catch (PDOException $e) {
            error_log($e->getMessage());

            return ['status' => 'error', 'message' => 'Failed to add relay: ' . $e->getMessage()];
        }
    }

    public function modifyControlMode()
    {
        $relayId = $_POST['id'];
        $controlMode = $_POST['control_mode'];

        if (in_array($controlMode, ['automatic', 'manual'])) {
            try {
                $sql = "UPDATE relays SET control_mode = :control_mode WHERE id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':control_mode', $controlMode);
                $stmt->bindParam(':id', $relayId, PDO::PARAM_INT);
                $stmt->execute();

                echo json_encode(['status' => 'success']);
            } catch (PDOException $e) {
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid control mode']);
        }

    }
    
    /**
     * Update the status of a relay.
     *
     * @param int $relay_id
     * @param int $status
     * @return bool
     */
    public function updateStatus($relay_id, $status) {
        $sql = "UPDATE relays SET relay_status = :status, control_mode = 'manual', updated_at = NOW()  WHERE id = :id";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':status', $status, PDO::PARAM_INT);
            $stmt->bindParam(':id', $relay_id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            // Log error or handle accordingly
            error_log("Failed to update relay status: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Get relay information by ID.
     *
     * @param int $relay_id
     * @return array|null
     */
    public function getRelayById($relay_id) {
        $sql = "SELECT * FROM relays INNER JOIN devices ON devices.device_id = relays.id WHERE id = :id";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $relay_id, PDO::PARAM_INT);
            $stmt->execute();
            $relay = $stmt->fetch();
            return $relay ? $relay : null;
        } catch (PDOException $e) {
            // Log error or handle accordingly
            error_log("Failed to fetch relay: " . $e->getMessage());
            return null;
        }
    }

    public function fetchAll()
    {
        $sql = "SELECT * FROM relays INNER JOIN devices ON devices.device_id = relays.id";
        try {
            $stmt = $this->db->query($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            
        }
    }

}
