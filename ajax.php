<?php
include_once 'init.php';


if (isset($_POST['action'])){
    $action = $_POST['action'];
    switch($action){
        case 'addRelay':
            $relay = new Relay();
            $relay->addRelay($_POST['relay_name'], $_POST['relay_mode'], $_POST['relay_gpio']);
            break;
        case 'editControlMode':
            $relay = new Relay();
            $relay->modifyControlMode();
            break;
        case 'toggleRelay':
            header('Content-Type: application/json');
            $response = ['success' => false, 'message' => ''];

            try {
                if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                    throw new Exception('Invalid request method.');
                }
                $relay_id = isset($_POST['relay_id']) ? intval($_POST['relay_id']) : 0;
                $status = isset($_POST['status']) ? intval($_POST['status']) : 0;
                if ($relay_id <= 0) {
                    throw new Exception('Invalid relay ID.');
                }
                $relay = new Relay();
                if ($relay->updateStatus($relay_id, $status)) {
                    $response['success'] = true;
                    $response['message'] = 'Relay status updated successfully.';
                } else {
                    throw new Exception('Failed to update relay status.');
                }
            } catch (Exception $e) {
                $response['message'] = $e->getMessage();
            }
            echo json_encode($response);
            break;

        case 'createCycles':
            header("Content-Type: application/json; charset=UTF-8");

            $sensor_cycle = isset($_POST['sensor_cycle']) ? intval($_POST['sensor_cycle']) : null;

            $cycles = [];
            for ($i = 1; $i <= 3; $i++) {
                $interval_key = "cycle_{$i}_interval";
                $duration_key = "cycle_{$i}_duration";

                if (isset($_POST[$interval_key]) && isset($_POST[$duration_key])) {
                    $interval = intval($_POST[$interval_key]);
                    $duration = intval($_POST[$duration_key]);

                    if ($interval < 1 || $duration < 1) {
                        http_response_code(400); 
                        echo json_encode(['status' => 'error', 'message' => "Invalid data for Cycle {$i}"]);
                        exit;
                    }

                    $cycles[] = [
                        'number'    => $i,
                        'interval'  => $interval,
                        'duration'  => $duration
                    ];
                } else {
                    http_response_code(400); // Bad Request
                    echo json_encode(['status' => 'error', 'message' => "Missing data for Cycle {$i}"]);
                    exit;
                }
            }

            $cycle_obj = new Cycles();
            $inserted= $cycle_obj->create($sensor_cycle, $cycles);
            if ($inserted) {
                echo json_encode(['status' => 'success', 'message' => 'Data inserted successfully']);
            }



            break;
        default:
            break;
    }
}
