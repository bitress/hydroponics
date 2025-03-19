<?php

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cycles - Hydroponics</title>

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
                <h3>Hydroponics Cycles</h3>
            </div>
            <div class="page-content">
                <section class="row">

                    <div class="container">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modifyInterval">Modify Intervals</button>

                                        <div class="table-responsive mt-2">
                                            <table class="table table-striped ">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Sensor Name</th>
                                                        <th>Interval</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $cyclesModel = new Cycles();
                                                        $groupedSensors = $cyclesModel->getGroupedCycles();

                                                        if (!empty($groupedSensors)):
                                                            foreach ($groupedSensors as $sensorId => $sensorData):
                                                    ?>
                                                    <tr class="sensor-row">
                                                        <td><?= htmlspecialchars($sensorData['sensor_name']) ?></td>
                                                        <td>30 minutes</td>
                                        
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Group Actions">
                                                                <!-- <button type="button" class="btn btn-primary configure-cycle" data-sensor-id="<?= htmlspecialchars($sensorId) ?>"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="Configure All Cycles for This Sensor">
                                                                    <i class="fa fa-cogs"></i>
                                                                </button> -->
                                                                <button type="button" class="btn btn-danger delete-cycle" data-sensor-id="<?= htmlspecialchars($sensorId) ?>"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="Delete All Cycles for This Sensor">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                            endforeach;
                                                        else:
                                                    ?>
                                                    <tr>
                                                        <td colspan="3" class="text-center">No cycles found.</td>
                                                    </tr>
                                                    <?php endif; ?>
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
<div class="modal fade" id="modifyInterval" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modify Interval</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="">
            <label for="interval">Interval</label>
            <input type="text" class="form-control" name="interval" id="interval" placeholder="Enter Interval">

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


    <div class="modal fade" id="editCycleModal" tabindex="-1" aria-labelledby="editCycleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editCycleModalLabel">Configure Data Collection Cycles</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <form id="configureCycle">
                                <div class="row m-0">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="sensor_cycle">Select Sensor</label>
                                            <select name="edit_sensor_cycle" id="edit_sensor_cycle" class="form-control">
                                                <?php
                                                    $sensor_class = new Sensors();
                                                    $sensors = $sensor_class->getSensors();
                                                    foreach($sensors as $row):
                                                ?>
                                                <option value="<?= $row['id'] ?>"><?= $row['sensor_name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- Cycle 1 -->
                                        <div class="mb-4">
                                            <h6>Cycle 1</h6>
                                            <div class="mb-3">
                                                <label for="edit_cycle_1_interval" class="form-label">Interval
                                                    (seconds)</label>
                                                <input type="number" class="form-control" id="edit_cycle_1_interval"
                                                    name="edit_cycle_1_interval" min="1" required
                                                    placeholder="Enter interval in seconds">
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit_cycle_1_duration" class="form-label">Duration
                                                    (minutes)</label>
                                                <input type="number" class="form-control" id="edit_cycle_1_duration"
                                                    name="edit_cycle_1_duration" min="1" required
                                                    placeholder="Enter duration in minutes">
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit_cycle_1_pause" class="form-label">Pause
                                                    (seconds)</label>
                                                <input type="number" class="form-control" id="edit_cycle_1_pause"
                                                    name="edit_cycle_1_pause" min="1" required
                                                    placeholder="Enter pause in seconds">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-4">


                                        <!-- Cycle 2 -->
                                        <div class="mb-4">
                                            <h6>Cycle 2</h6>
                                            <div class="mb-3">
                                                <label for="edit_cycle_2_interval" class="form-label">Interval
                                                    (seconds)</label>
                                                <input type="number" class="form-control" id="edit_cycle_2_interval"
                                                    name="edit_cycle_2_interval" min="1" required
                                                    placeholder="Enter interval in seconds">
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit_cycle_2_duration" class="form-label">Duration
                                                    (minutes)</label>
                                                <input type="number" class="form-control" id="edit_cycle_2_duration"
                                                    name="edit_cycle_2_duration" min="1" required
                                                    placeholder="Enter duration in minutes">
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit_cycle_2_pause" class="form-label">Pause
                                                    (seconds)</label>
                                                <input type="number" class="form-control" id="edit_cycle_2_pause"
                                                    name="edit_cycle_2_pause" min="1" required
                                                    placeholder="Enter pause in seconds">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <h6>Cycle 3</h6>
                                            <div class="mb-3">
                                                <label for="edit_cycle_3_interval" class="form-label">Interval
                                                    (seconds)</label>
                                                <input type="number" class="form-control" id="edit_cycle_3_interval"
                                                    name="edit_cycle_3_interval" min="1" required
                                                    placeholder="Enter interval in seconds">
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_cycle_3_duration" class="form-label">Duration
                                                    (minutes)</label>
                                                <input type="number" class="form-control" id="edit_cycle_3_duration"
                                                    name="edit_cycle_3_duration" min="1" required
                                                    placeholder="Enter duration in minutes">
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_cycle_3_pause" class="form-label">Pause
                                                    (seconds)</label>
                                                <input type="number" class="form-control" id="edit_cycle_3_pause"
                                                    name="edit_cycle_3_pause" min="1" required
                                                    placeholder="Enter pause in seconds">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="">
                                        <button type="button" id="configureCycleButton" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php include_once 'templates/body-scripts.php'; ?>
    <script>

    $(document).ready(function() {
        $(document).on('click', '.toggle-cycle-btn', function() {
        var button = $(this);
        var row = button.closest('tr');
        var cycleId = row.data('cycle-id');
        var action = button.data('action'); 
        button.prop('disabled', true);

        $.ajax({
            url: 'ajax.php', 
            method: 'POST',
            data: { 
                action: action === 'start' ? 'startCycle' : 'stopCycle',
                cycle_id: cycleId 
            },
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    if(action === 'start') {
                        button.removeClass('btn-success').addClass('btn-danger')
                            .text('Stop').data('action', 'stop');
                    } else {
                        button.removeClass('btn-danger').addClass('btn-success')
                            .text('Start').data('action', 'start');
                    }

                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message || 'Operation completed successfully.',
                        timer: 2000, 
                        showConfirmButton: false,
                        toast: true,
                        position: 'top-end',
                        timerProgressBar: true
                    }).then(() => {
                        setTimeout(function() {
                            location.reload();
                        }, 500); 
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message || 'Operation failed.',
                        timer: 2000, 
                        showConfirmButton: false,
                        toast: true,
                        position: 'top-end',
                        timerProgressBar: true
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while processing your request.',
                    timer: 2000, // 2 seconds
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end',
                    timerProgressBar: true
                });
            },
            complete: function() {
                button.prop('disabled', false);
            }
        });
    });

    });

    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });

    $('#configureCycleButton').on('click', function(){
        const formData = {
            action: 'configureCycle',
            sensor_id: $('#edit_sensor_cycle').find(":selected").val(),
            cycle1_interval: $('#edit_cycle_1_interval').val(),
            cycle1_duration: $('#edit_cycle_1_duration').val(),
            cycle1_pause: $('#edit_cycle_1_pause').val(),

            cycle2_interval: $('#edit_cycle_2_interval').val(),
            cycle2_duration: $('#edit_cycle_2_duration').val(),
            cycle2_pause: $('#edit_cycle_2_pause').val(),

            cycle3_interval: $('#edit_cycle_3_interval').val(),
            cycle3_duration: $('#edit_cycle_3_duration').val(),
            cycle3_pause: $('#edit_cycle_3_pause').val(),

        };

       
        $('#configureCycleButton').prop('disabled', true).text('Submitting...');

        $.ajax({
            url: 'ajax.php', 
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response){
                if(response.success){
                    alert('Cycles configured successfully!');
                    $('#editCycleModal').modal('hide');
                } else {
                    alert('Error: ' + (response.message || 'An unexpected error occurred.'));
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.error('AJAX Error:', textStatus, errorThrown);
                alert('An error occurred while processing your request. Please try again.');
            },
            complete: function(){
                $('#configureCycleButton').prop('disabled', false).text('Submit');
            }
        });
    });

        $('#sensorForm').on('submit', function(e) {
            e.preventDefault(); 
            var formData = $(this).serialize();

            var submitButton = $(this).find('button[type="submit"]');
            submitButton.prop('disabled', true).text('Submitting...');

            $.ajax({
                url: 'ajax.php', 
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            timer: 2000, // 2 seconds
                            showConfirmButton: false,
                            willClose: () => {
                                location.reload();
                            }
                        });
                        $('#sensorForm')[0].reset(); 
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                            timer: 2000, // 2 seconds
                            showConfirmButton: false
                        });
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX Error:', textStatus, errorThrown);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An unexpected error occurred.',
                        timer: 2000, // 2 seconds
                        showConfirmButton: false
                    });
                },
                complete: function() {
                    // Re-enable the submit button
                    submitButton.prop('disabled', false).text('Submit');
                }
            });
        });

    });


    $(document).on('click', '.configure-cycle', function(){
        const sensorId = $(this).data('sensor-id');

        $.ajax({
            url: 'ajax.php', 
            type: 'POST',
            data: {
                action: 'getCycle',
                sensor_id: sensorId
            },
            dataType: 'json', 
            beforeSend: function(){
                $('#configureCycleButton').prop('disabled', true).text('Loading...');
            },
            success: function(response){
                if(response.success){
                    const data = response.data;

                    $('#edit_sensor_cycle').val(data.sensor_id);

                    data.cycles.forEach((cycle, index) => {
                        const cycleNumber = index + 1;

                        $(`#edit_cycle_${cycleNumber}_interval`).val(cycle.interval_seconds);

                        $(`#edit_cycle_${cycleNumber}_duration`).val(cycle.duration_minutes);
                        $(`#edit_cycle_${cycleNumber}_pause`).val(cycle.pause);
                    });

                    for(let i = data.cycles.length + 1; i <= 3; i++){
                        $(`#edit_cycle_${i}_interval`).val('');
                        $(`#edit_cycle_${i}_duration`).val('');
                        $(`#edit_cycle_${i}_pause`).val('');
                    }

                    const editCycleModal = new bootstrap.Modal('#editCycleModal');
                    editCycleModal.show();
                } else {
                    alert('No cycles found for the selected sensor.');
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.error('AJAX Error:', textStatus, errorThrown);
                alert('An error occurred while fetching cycle data. Please try again.');
            },
            complete: function(){
                // Re-enable the submit button and reset its text
                $('#configureCycleButton').prop('disabled', false).text('Submit');
            }
        });
    });


    $(document).on('click', '.delete-cycle', function() {
            const cycleId = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "This action will permanently delete the cycle.",
            icon: 'warning',
            showCancelButton: true,  
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, keep it',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'ajax.php',
                    type: 'POST',
                    data: { 
                        action: 'deleteCycle',
                        cycle_id: cycleId 
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Deleted!',
                                'The cycle has been deleted.',
                                'success'
                            );
                            setTimeout(function () { 
                                location.reload()
                                }, 2000)
                        } else {
                            Swal.fire(
                                'Error!',
                                'Something went wrong. Please try again.',
                                'error'
                            );
                        }
                    },
                    error: function() {
                        Swal.fire(
                            'Error!',
                            'There was an issue with the request.',
                            'error'
                        );
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire(
                    'Cancelled',
                    'Your cycle is safe :)',
                    'info'
                );
            }
        });
    });


    </script>
</body>

</html>