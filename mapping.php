<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Devices - Hydroponics</title>

    <?php include_once 'templates/head-styles.php'; ?>


</head>

<body>
    <script src="https://cdn.jsdelivr.net/gh/zuramai/mazer@docs/demo/assets/static/js/initTheme.js"></script>
    <!-- Start content here -->

    <div id="app">
        <?php include_once __DIR__ . '/templates/navbar.php'; ?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>Devices</h3>
            </div>
            <div class="page-content">
                <section class="row">

                    <div class="container">


                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#mappingModal">
                                    Add New Mapping
                                </button>
                            </div>
             
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>Sensor to Device Mapping</h5>
                                        <div class="table-responsive mt-2">
                                            <table class="table">
                                                <thead>
                                                    <th>Sensor ID</th>
                                                    <th>Device ID</th>
                                                    <th>Threshold</th>
                                                    <th>Activation Time</th>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $MappingClass = new SensorDeviceMapping();
                                                        $mappings = $MappingClass->getAllMappings();
                                                        foreach($mappings as $mapping):
                                                    ?>
                                                    <tr>
                                                        <td><?= $mapping['sensor_name'] ?></td>
                                                        <td><?= $mapping['device_name'] ?></td>
                                                        <td><?= $mapping['value'] ?></td>
                                                        <td><?= $mapping['activation_time'] ?></td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </section>
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2023 &copy; Hydroponics</p>
                    </div>
                    <div class="float-end">
                        <p>
                            Crafted with
                            <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                            by <a href="https://saugi.me">Saugi</a>
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="mappingModal" tabindex="-1" aria-labelledby="mappingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mappingModalLabel">Add New Sensor to Device Mapping</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="mappingForm">
                        <div class="mb-3">
                            <label for="sensorId" class="form-label">Sensor ID</label>
                            <select class="form-select" id="sensorId" name="sensorId" required>
                                <option value="">Select Sensor</option>
                                <?php
                                    $sensors = $MappingClass->getAllSensors();
                                    foreach($sensors as $sensor):
                                ?>
                                <option value="<?= $sensor['id'] ?>"><?= $sensor['sensor_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="deviceId" class="form-label">Device ID</label>
                            <select class="form-select" id="deviceId" name="deviceId" required>
                                <option value="">Select Device</option>
                                <?php
                                    $devices = $MappingClass->getAllDevices();
                                    foreach($devices as $device):
                                ?>
                                <option value="<?= $device['device_id'] ?>"><?= $device['device_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="threshold" class="form-label">Threshold</label>
                            <input type="text" class="form-control" id="threshold" name="threshold" required>
                        </div>
                        <div class="mb-3">
                            <label for="activationTime" class="form-label">Activation Time</label>
                            <input type="text" class="form-control" id="activationTime" name="activationTime" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveMapping">Save Mapping</button>
                </div>
            </div>
        </div>
    </div>


    <?php include_once 'templates/body-scripts.php'; ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });


    </script>
</body>

</html>