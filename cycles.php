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
                <h3>Hydroponics</h3>
            </div>
            <div class="page-content">
                <section class="row">

                    <div class="container">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex flex-end">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#addCycleModal">
                                                Add a Cycle
                                            </button>
                                        </div>
                                        <div class="table-responsive mt-2">
                                            <table class="table">
                                                <thead>
                                                    <th>Cycle ID</th>
                                                    <th>Sensor Name</th>
                                                    <th>Reading Interval (seconds)</th>
                                                    <th>Duration (minutes)</th>
                                                    <th>Actions</th>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Ultrasonic Sensor</td>
                                                        <td>30</td>
                                                        <td>60</td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-primary configure-cycle" data-id="1"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="Configure Cycle">
                                                                    <i class="fa fa-cogs"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-primary delete-cycle" data-id="1"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="Delete Cycle">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
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


    <div class="modal fade" id="addCycleModal" tabindex="-1" aria-labelledby="addCycleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addCycleModalLabel">Add Data Collection Cycles</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <form id="sensorForm">
                                <input type="hidden" name="action" value="createCycles">
                                <div class="row m-0">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="sensor_cycle">Select Sensor</label>
                                            <select name="sensor_cycle" id="sensor_cyle" class="form-control">
                                                <option value="1">Ultrasonic Sensor</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- Cycle 1 -->
                                        <div class="mb-4">
                                            <h6>Cycle 1</h6>
                                            <div class="mb-3">
                                                <label for="cycle_1_interval" class="form-label">Interval
                                                    (seconds)</label>
                                                <input type="number" class="form-control" id="cycle_1_interval"
                                                    name="cycle_1_interval" min="1" required
                                                    placeholder="Enter interval in seconds">
                                            </div>
                                            <div class="mb-3">
                                                <label for="cycle_1_duration" class="form-label">Duration
                                                    (minutes)</label>
                                                <input type="number" class="form-control" id="cycle_1_duration"
                                                    name="cycle_1_duration" min="1" required
                                                    placeholder="Enter duration in minutes">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-4">


                                        <!-- Cycle 2 -->
                                        <div class="mb-4">
                                            <h6>Cycle 2</h6>
                                            <div class="mb-3">
                                                <label for="cycle_2_interval" class="form-label">Interval
                                                    (seconds)</label>
                                                <input type="number" class="form-control" id="cycle_2_interval"
                                                    name="cycle_2_interval" min="1" required
                                                    placeholder="Enter interval in seconds">
                                            </div>
                                            <div class="mb-3">
                                                <label for="cycle_2_duration" class="form-label">Duration
                                                    (minutes)</label>
                                                <input type="number" class="form-control" id="cycle_2_duration"
                                                    name="cycle_2_duration" min="1" required
                                                    placeholder="Enter duration in minutes">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <h6>Cycle 3</h6>
                                            <div class="mb-3">
                                                <label for="cycle_3_interval" class="form-label">Interval
                                                    (seconds)</label>
                                                <input type="number" class="form-control" id="cycle_3_interval"
                                                    name="cycle_3_interval" min="1" required
                                                    placeholder="Enter interval in seconds">
                                            </div>
                                            <div class="form-group">
                                                <label for="cycle_3_duration" class="form-label">Duration
                                                    (minutes)</label>
                                                <input type="number" class="form-control" id="cycle_3_duration"
                                                    name="cycle_3_duration" min="1" required
                                                    placeholder="Enter duration in minutes">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
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
                </div>~
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <form>
                                <div class="row m-0">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="sensor_cycle">Select Sensor</label>
                                            <select name="edit_sensor_cycle" id="edit_sensor_cyle" class="form-control">
                                                <option value="1">Ultrasonic Sensor</option>
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
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="">
                                        <button type="button" id="addCycleButton" class="btn btn-primary">Submit</button>
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
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });

        $('#addCycleButton').on('click', function(){
            alert(1)
        });

        $('#sensorForm').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Serialize the form data
            var formData = $(this).serialize();

            // Disable the submit button to prevent multiple submissions
            var submitButton = $(this).find('button[type="submit"]');
            submitButton.prop('disabled', true).text('Submitting...');

            $.ajax({
                url: 'ajax.php', // The PHP handler script
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
                                // Reload the page after the alert closes
                                location.reload();
                            }
                        });
                        $('#sensorForm')[0].reset(); // Reset the form on success
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
        const cycleId = $(this).data('id');

        const editCycleModal = new bootstrap.Modal('#editCycleModal')
        editCycleModal.show();
        
    })

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