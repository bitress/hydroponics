<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Relays - Hydroponics</title>

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
                <h3>Configure Relays</h3>
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
                                                data-bs-target="#addRelayModal">
                                                Add a Relay
                                            </button>
                                        </div>
                                        <div class="table-responsive mt-2">
                                        <table class="table">
                                            <thead>
                                                <th>Relay ID</th>
                                                <th>Relay Name</th>
                                                <th>Relay Status</th>
                                                <th>Control Mode</th>
                                                <th>GPIO Pin</th>
                                                <th>Actions</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $relayClass = new Relay();
                                                    $row = $relayClass->fetchAll();
                                                    foreach($row as $res):
                                                ?>
                                                <tr>
                                                    <td><?= $res['id'] ?></td>
                                                    <td><?= $res['relay_name'] ?></td>
                                                    <td><?= $res['relay_status'] ?></td>
                                                    <td>
                                                        <select class="form-control control-mode" data-id="<?= $res['id'] ?>">
                                                            <option value="automatic" <?= $res['control_mode'] == 'automatic' ? 'selected' : '' ?>>Automatic</option>
                                                            <option value="manual" <?= $res['control_mode'] == 'manual' ? 'selected' : '' ?>>Manual</option>
                                                        </select>
                                                    </td>
                                                    <td><?= $res['gpio'] ?></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-primary configure-cycle" data-id="<?= $res['id'] ?>"
                                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Configure Relay">
                                                                <i class="fa fa-cogs"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-primary delete-cycle" data-id="<?= $res['id'] ?>"
                                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Relay">
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
    <div class="modal fade" id="addRelayModal" tabindex="-1" aria-labelledby="addRelayModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="addRelayModalLabel">Add Relay</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form id="relayForm">
            <input type="hidden" name="action" value="addRelay">
            <div class="mb-3">
                <label for="relay_name" class="form-label">Relay Name</label>
                <input type="text" name="relay_name" id="relay_name" class="form-control" placeholder="Enter relay name" required>
            </div>
            
            <div class="mb-3">
                <label for="relay_mode" class="form-label">Relay Control Mode</label>
                <select name="relay_mode" id="relay_mode" class="form-control">
                    <option selected disabled>Select relay control mode</option>
                    <option value="manual">Manual</option>
                    <option value="automatic">Automatic</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="relay_gpio" class="form-label">Relay GPIO Pin</label>
                <input type="number" name="relay_gpio" id="relay_gpio" class="form-control" placeholder="Enter GPIO pin number" required min="0" max="40">
            </div>
            
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>

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
            $('#relayForm').submit(function(event) {
                event.preventDefault(); // Prevents the default form submission

                var formData = $(this).serialize(); // Serialize form data

                $.ajax({
                    url: 'ajax.php',  // The server endpoint for form submission
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Form submitted successfully!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setTimeout(function(){
                            location.reload()
                        }, 2000)
                        console.log(response);  
                    },
                    error: function(xhr, status, error) {
                        // Error message using SweetAlert
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'An error occurred. Please try again later.',
                            showConfirmButton: true
                        });
                        setTimeout(function(){
                            location.reload()
                        }, 2000)
                        console.error(error);
                    }
                });
            });

            $('.control-mode').change(function() {
                var relayId = $(this).data('id'); 
                var newControlMode = $(this).val();  

                $.ajax({
                    url: 'ajax.php', 
                    type: 'POST',
                    data: {
                        action: 'editControlMode',
                        id: relayId,
                        control_mode: newControlMode
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Updated!',
                            text: 'Control mode updated successfully.',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setTimeout(function(){
                            location.reload()
                        }, 2000)
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'An error occurred while updating the control mode.',
                            showConfirmButton: true
                        });
                        setTimeout(function(){
                            location.reload()
                        }, 2000)
                        console.error(error);  
                        
                    }
                });
            });
        });





    </script>
</body>

</html>