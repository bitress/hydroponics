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
                                                    <th>Actions</th>
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
                                                        <td><?= $mapping['threshold'] ?></td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <!-- Configure Button (Edit) -->
                                                                <button type="button" class="btn btn-primary configure-mapping" data-id="<?= $mapping['mapping_id'] ?>"
                                                                    data-sensor="<?= $mapping['sensor_id'] ?>"
                                                                    data-device="<?= $mapping['device_id'] ?>"
                                                                    data-threshold="<?= $mapping['threshold'] ?>"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Configure Mapping">
                                                                    <i class="fa fa-cogs"></i>
                                                                </button>
                                                                
                                                                <!-- Delete Button -->
                                                                <button type="button" class="btn btn-danger delete-mapping" data-id="<?= $mapping['mapping_id'] ?>"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Mapping">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </div>
                                                            </td>
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
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveMapping">Save Mapping</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="mappingModal" tabindex="-1" aria-labelledby="mappingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mappingModalLabel">Configure Sensor to Device Mapping</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="mappingForm">
                    <div class="mb-3">
                        <label for="sensorId" class="form-label">Sensor ID</label>
                        <select class="form-select" id="sensorId" name="sensorId" required>
                            <option value="">Select Sensor</option>
                            <?php
                                $sensors = $MappingClass->getSensors();
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


        $(document).ready(function(){

            $('#saveMapping').click(function(){
                var sensorId = $('#sensorId').val();
                var deviceId = $('#deviceId').val();
                var threshold = $('#threshold').val();

                $.ajax({
                    url: 'ajax.php',
                    method: 'POST',
                    data: {
                        action: 'addMapping',
                        sensorId: sensorId,
                        deviceId: deviceId,
                        threshold: threshold
                    },
                    success: function(response){
                        if(response == 'success'){
                            alert('Mapping added successfully');
                            location.reload();
                        } else {
                            alert('Failed to add mapping');
                        }
                    }
                });
            });
        })

        $(document).ready(function() {
        // Configure (Edit) button click handler
        $('.configure-mapping').click(function() {
            var mappingId = $(this).data('id');
            var sensorId = $(this).data('sensor');
            var deviceId = $(this).data('device');
            var threshold = $(this).data('threshold');

            // Set modal fields with current data
            $('#sensorId').val(sensorId);
            $('#deviceId').val(deviceId);
            $('#threshold').val(threshold);

            // Update form action to edit mapping
            $('#saveMapping').off('click').on('click', function() {
                $.ajax({
                    url: 'ajax.php',
                    method: 'POST',
                    data: {
                        action: 'updateMapping',
                        mappingId: mappingId,
                        sensorId: $('#sensorId').val(),
                        deviceId: $('#deviceId').val(),
                        threshold: $('#threshold').val()
                    },
                    success: function(response) {
                        if (response === 'success') {
                            alert('Mapping updated successfully');
                            location.reload();
                        } else {
                            alert('Failed to update mapping');
                        }
                    }
                });
            });

            // Show the modal
            $('#mappingModal').modal('show');
        });

        // Delete button click handler
        $('.delete-mapping').click(function() {
            var mappingId = $(this).data('id');

            if (confirm('Are you sure you want to delete this mapping?')) {
                $.ajax({
                    url: 'ajax.php',
                    method: 'POST',
                    data: {
                        action: 'deleteMapping',
                        mappingId: mappingId
                    },
                    success: function(response) {
                        if (response === 'success') {
                            alert('Mapping deleted successfully');
                            location.reload();
                        } else {
                            alert('Failed to delete mapping');
                        }
                    }
                });
            }
        });
    });


    </script>
</body>

</html>