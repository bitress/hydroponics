<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Schedule - Hydroponics</title>

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
                <h3>Schedule</h3>
            </div>
            <div class="page-content">
                <section class="row">

                    <div class="container">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-end mb-3">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#addScheduleModal">
                                                Add a Schedule
                                            </button>
                                        </div>

                                        <div class="table-responsive mt-2">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Target Name</th>
                                                        <th>Target Type</th>
                                                        <th>Start</th>
                                                        <th>End</th>
                                                        <th>Recurrence</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $schedule = new Schedule();
                                                        $schedules = $schedule->readSchedules();
                                                        
                                                        foreach ($schedules as $row) {
                                                            $targetName = $schedule->getTargetName($row['target_id'], $row['target_type']);
                                                            $scheduleTimes = $schedule->getScheduleTimes($row['schedule_id']);
                                                            ?>
                                                    <tr>
                                                        <td><?php echo $targetName; ?></td>
                                                        <td><?php echo ucfirst($row['target_type']); ?></td>
                                                        <td><?php echo $row['created_at']; ?></td>
                                                        <!-- Use created_at as a placeholder for Start -->
                                                        <td><?php echo $row['created_at']; ?></td>
                                                        <!-- Use created_at as a placeholder for End -->
                                                        <td><?php echo ucfirst($row['recurrence']); ?></td>
                                                        <td><?php echo $row['is_active'] ? 'Active' : 'Inactive'; ?>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-danger btn-sm"
                                                                onclick="deleteSchedule(<?php echo $row['schedule_id']; ?>)">Delete</button>
                                                          
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
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


    <!-- Add Schedule Modal -->
    <div class="modal fade" id="addScheduleModal" tabindex="-1" aria-labelledby="addScheduleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addScheduleModalLabel">Add Schedule</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="scheduleForm">
                        <input type="hidden" name="action" value="createSchedule">
                        <!-- Target Type -->
                        <div class="mb-3">
                            <label for="targetType" class="form-label">Target Type</label>
                            <select class="form-select" id="targetType" name="targetType" required>
                                <option value="" selected disabled>Choose target type</option>
                                <option value="device">Devices</option>
                                <option value="sensor">Sensors</option>
                            </select>
                        </div>

                        <!-- Target ID -->
                        <div class="mb-3">
                            <label for="targetId" class="form-label">Target ID</label>
                            <select class="form-select" id="targetId" name="targetId" required>
                                <option value="" selected disabled>Select target type first</option>
                            </select>
                        </div>

                        <!-- Start Time -->
                        <div class="mb-3">
                            <label for="startTime" class="form-label">Start Time</label>
                            <input type="datetime-local" class="form-control" id="startTime" name="startTime" required>
                        </div>

                        <!-- End Time -->
                        <div class="mb-3">
                            <label for="endTime" class="form-label">End Time</label>
                            <input type="datetime-local" class="form-control" id="endTime" name="endTime" required>
                        </div>

                        <!-- Recurrence Pattern -->
                        <div class="mb-3">
                            <label for="recurrence" class="form-label">Recurrence</label>
                            <select class="form-select" id="recurrence" name="recurrence" required>
                                <option value="none" selected>No Recurrence</option>
                                <option value="daily">Daily</option>
                                <option value="weekly">Weekly</option>
                                <option value="monthly">Monthly</option>
                            </select>
                        </div>


                        <!-- Is Active -->
                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="isActive" name="isActive" checked>
                            <label class="form-check-label" for="isActive">Activate Schedule</label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100">Save Schedule</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <?php include_once 'templates/body-scripts.php'; ?>
    <script>
    const targetTypeSelect = document.getElementById('targetType');
    const targetIdSelect = document.getElementById('targetId');

    targetTypeSelect.addEventListener('change', () => {
        const selectedType = targetTypeSelect.value;
        targetIdSelect.innerHTML =
            '<option value="" selected disabled>Loading...</option>';

        fetch(`fetch_targets.php?type=${selectedType}`)
            .then(response => response.json())
            .then(data => {
                targetIdSelect.innerHTML = '';
                if (data.length > 0) {
                    data.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.id;
                        option.textContent = item.name;
                        targetIdSelect.appendChild(option);
                    });
                } else {
                    const noOptions = document.createElement('option');
                    noOptions.value = '';
                    noOptions.textContent = 'No options available';
                    targetIdSelect.appendChild(noOptions);
                }
            })
            .catch(error => {
                console.error('Error fetching targets:', error);
            });
    });

 

    $(document).ready(function() {
        $('#scheduleForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: 'ajax.php',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert('Schedule created successfully!');
                        $('#scheduleForm')[0].reset();
                    } else {
                        alert('Error: ' + response.error);
                    }
                },
                error: function(xhr, status, error) {
                    alert('AJAX error: ' + error);
                }
            });
        });
    });
    </script>
</body>

</html>