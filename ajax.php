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
                    http_response_code(400); 
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
        case 'getCycle':
            header('Content-Type: application/json; charset=utf-8');
            $response = [
                'success' => false,
                'data' => null,
                'message' => ''
            ];
            $sensorId = isset($_POST['sensor_id']) ? intval($_POST['sensor_id']) : 0;
            if ($sensorId > 0) {
                try {
                    $cycle_class = new Cycles();
                    $cyclesData = $cycle_class->getCyclesBySensorId($sensorId);
                    if (!empty($cyclesData)) {
                        $response['success'] = true;
                        $response['data'] = $cyclesData;
                    } else {
                        $response['message'] = 'No cycles found for the specified sensor.';
                    }
                } catch (Exception $e) {
                    $response['message'] = 'An error occurred while fetching cycle data.';
                    error_log('Error in getCycle action: ' . $e->getMessage());
                }
            } else {
                $response['message'] = 'Invalid sensor ID provided.';
            }
            echo json_encode($response);
            break;
        case 'configureCycle':
            $sensorId = isset($_POST['sensor_id']) ? intval($_POST['sensor_id']) : 0;
            $cycle1_interval = isset($_POST['cycle1_interval']) ? intval($_POST['cycle1_interval']) : null;
            $cycle1_duration = isset($_POST['cycle1_duration']) ? intval($_POST['cycle1_duration']) : null;
            $cycle1_pause = isset($_POST['cycle1_pause']) ? intval($_POST['cycle1_pause']) : null;

            $cycle2_interval = isset($_POST['cycle2_interval']) ? intval($_POST['cycle2_interval']) : null;
            $cycle2_duration = isset($_POST['cycle2_duration']) ? intval($_POST['cycle2_duration']) : null;
            $cycle2_pause = isset($_POST['cycle2_pause']) ? intval($_POST['cycle2_pause']) : null;

            $cycle3_interval = isset($_POST['cycle3_interval']) ? intval($_POST['cycle3_interval']) : null;
            $cycle3_duration = isset($_POST['cycle3_duration']) ? intval($_POST['cycle3_duration']) : null;
            $cycle3_pause = isset($_POST['cycle3_pause']) ? intval($_POST['cycle3_pause']) : null;

            if ($sensorId <= 0) {
                $response['message'] = 'Invalid sensor selected.';
                echo json_encode($response);
                exit();
            }

            
            try {
                $cycles_class = new Cycles();
               
                $existingCycles = $cycles_class->checkIfHasCycle($sensorId);

                if (empty($existingCycles)) {
                    $newCycles = [
                        [
                            'cycle_number' => 1,
                            'interval_seconds' => $cycle1_interval,
                            'duration_minutes' => $cycle1_duration,
                            'pause' => $cycle1_pause
                        ],
                        [
                            'cycle_number' => 2,
                            'interval_seconds' => $cycle2_interval,
                            'duration_minutes' => $cycle2_duration,
                            'pause' => $cycle2_pause
                        ],
                        [
                            'cycle_number' => 3,
                            'interval_seconds' => $cycle3_interval,
                            'duration_minutes' => $cycle3_duration,
                            'pause' => $cycle3_pause
                        ]
                    ];

                    $createSuccess = $cycles_class->createCycles($sensorId, $newCycles);

                    if ($createSuccess) {
                        $response['success'] = true;
                        $response['message'] = 'Cycles created successfully.';
                    } else {
                        $response['message'] = 'Failed to create cycles.';
                    }
                } else {
                 
                    $updatedCycles = [
                        [
                            'cycle_id' => isset($existingCycles[0]['cycle_id']) ? $existingCycles[0]['cycle_id'] : null,
                            'cycle_number' => 1,
                            'interval_seconds' => $cycle1_interval,
                            'duration_minutes' => $cycle1_duration,
                            'pause' => $cycle1_pause
                        ],
                        [
                            'cycle_id' => isset($existingCycles[1]['cycle_id']) ? $existingCycles[1]['cycle_id'] : null,
                            'cycle_number' => 2,
                            'interval_seconds' => $cycle2_interval,
                            'duration_minutes' => $cycle2_duration,
                            'pause' => $cycle2_pause

                        ],
                        [
                            'cycle_id' => isset($existingCycles[2]['cycle_id']) ? $existingCycles[2]['cycle_id'] : null,
                            'cycle_number' => 3,
                            'interval_seconds' => $cycle3_interval,
                            'duration_minutes' => $cycle3_duration,
                            'pause' => $cycle3_pause

                        ]
                    ];

                    $updateSuccess = $cycles_class->updateCycles($sensorId, $updatedCycles);

                    if ($updateSuccess) {
                        $response['success'] = true;
                        $response['message'] = 'Cycles updated successfully.';
                    } else {
                        $response['message'] = 'Failed to update cycles.';
                    }
                }
            } catch (Exception $e) {
                $response['message'] = 'An error occurred while configuring cycles.';
                error_log('Error in configureCycle action: ' . $e->getMessage());
            }

            echo json_encode($response);
        break;    
        case 'startCycle':
            case 'stopCycle':
                try {
                    if (!isset($_POST['cycle_id'])) {
                        throw new Exception('Cycle ID is required.');
                    }
    
                    $cycleId = intval($_POST['cycle_id']);
                    if ($cycleId <= 0) {
                        throw new Exception('Invalid Cycle ID.');
                    }
    
                    $isActive = ($action === 'startCycle') ? 1 : 0;
    
                    $stmt = $db->prepare('UPDATE cycles SET is_active = :is_active WHERE cycle_id = :cycle_id');
                    $stmt->execute(['is_active' => $isActive, 'cycle_id' => $cycleId]);
    
                    // Check if any row was updated
                    if ($stmt->rowCount() > 0) {
                        $response['success'] = true;
                        $response['message'] = 'Cycle ' . (($isActive) ? 'started' : 'stopped') . ' successfully.';
                    } else {
                        throw new Exception('No changes made or invalid Cycle ID.');
                    }
                } catch (Exception $e) {
                    $response['message'] = $e->getMessage();
                }
                echo json_encode($response);

                break;
    
    
        default:
            break;
    }
}
