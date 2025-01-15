<?php
include_once 'init.php';
$DeviceClass = new Devices();
if (isset($_POST['add_device'])) {
    $deviceName = $_POST['device_name'];
    $DeviceClass->createDevice($deviceName);
    header("Location: devices.php"); // redirect after adding
}

if (isset($_POST['update_device'])) {
    $deviceId = $_POST['device_id'];
    $deviceName = $_POST['device_name'];
    $DeviceClass->updateDevice($deviceId, $deviceName);
    header("Location: devices.php"); // redirect after updating
}

if (isset($_POST['delete_device'])) {
    $deviceId = $_POST['device_id'];
    $DeviceClass->deleteDevice($deviceId);
    header("Location: devices.php"); // redirect after deletion
}


?>
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
                                <div class="card">
                                    <div class="card-body">
                                       
                                        <div class="table-responsive mt-2">
                                        <table class="table">
                                            <thead>
                                                <th>Device ID</th>
                                                <th>Device Name</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $DeviceClass = new Devices();
                                                    $row = $DeviceClass->getDevices();
                                                    foreach($row as $res):
                                                ?>
                                                <tr>
                                                    <td><?= $res['device_id'] ?></td>
                                                    <td><?= $res['device_name'] ?></td>
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


<!-- Add Device Form -->
<div class="modal fade" id="addDeviceModal" tabindex="-1" aria-labelledby="addDeviceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="devices.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDeviceModalLabel">Add a Device</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="device_name" class="form-control" placeholder="Enter Device Name" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="add_device" class="btn btn-primary">Add Device</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Update Device Modal -->
<div class="modal fade" id="updateDeviceModal" tabindex="-1" aria-labelledby="updateDeviceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="devices.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateDeviceModalLabel">Update Device</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="device_id" id="updateDeviceId">
                    <input type="text" name="device_name" id="updateDeviceName" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="update_device" class="btn btn-primary">Update Device</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="deleteDeviceModal" tabindex="-1" aria-labelledby="deleteDeviceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="devices.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteDeviceModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this device?
                    <input type="hidden" name="device_id" id="deleteDeviceId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="delete_device" class="btn btn-danger">Delete</button>
                </div>
            </form>
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

        document.querySelectorAll('.configure-cycle').forEach(button => {
    button.addEventListener('click', function() {
        var deviceId = this.getAttribute('data-id');
        fetch(`getDeviceDetails.php?device_id=${deviceId}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('updateDeviceId').value = data.device_id;
                document.getElementById('updateDeviceName').value = data.device_name;
                new bootstrap.Modal(document.getElementById('updateDeviceModal')).show();
            });
    });
});

document.querySelectorAll('.delete-cycle').forEach(button => {
        button.addEventListener('click', function() {
            var deviceId = this.getAttribute('data-id');
            document.getElementById('deleteDeviceId').value = deviceId;
        });
    });




    </script>
</body>

</html>