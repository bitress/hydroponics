<?php

  include_once 'init.php';
  $sensor = new Sensors();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cycles - Hydroponics</title>

    <link rel="shortcut icon" href="https://cdn.jsdelivr.net/gh/zuramai/mazer@docs/demo/assets/compiled/svg/favicon.svg"
        type="image/x-icon" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/zuramai/mazer@docs/demo/assets/compiled/css/app.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/zuramai/mazer@docs/demo/assets/compiled/css/app-dark.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/zuramai/mazer@docs/demo/assets/compiled/css/iconly.css" />
    <link rel="stylesheet" href="https://atugatran.github.io/FontAwesome6Pro/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
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
                                            data-bs-target="#exampleModal">
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
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
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


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Configure Data Collection Cycles</h5>
                            <form action="/submit" method="post">
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

                                <hr>

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

                                <hr>
                                <div class="mb-4">
                                    <h6>Cycle 3</h6>
                                    <div class="mb-3">
                                        <label for="cycle_3_interval" class="form-label">Interval
                                            (seconds)</label>
                                        <input type="number" class="form-control" id="cycle_3_interval"
                                            name="cycle_3_interval" min="1" required
                                            placeholder="Enter interval in seconds">
                                    </div>
                                    <div class="mb-3">
                                        <label for="cycle_3_duration" class="form-label">Duration
                                            (minutes)</label>
                                        <input type="number" class="form-control" id="cycle_3_duration"
                                            name="cycle_3_duration" min="1" required
                                            placeholder="Enter duration in minutes">
                                    </div>
                                </div>

                                <hr>

                                <!-- Submit Button -->
                                <div class="mb-4">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <!-- End content -->
    <script src="https://cdn.jsdelivr.net/gh/zuramai/mazer@docs/demo/assets/static/js/components/dark.js"></script>
    <script
        src="https://cdn.jsdelivr.net/gh/zuramai/mazer@docs/demo/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js">
    </script>

    <script src="https://cdn.jsdelivr.net/gh/zuramai/mazer@docs/demo/assets/compiled/js/app.js"></script>

    <!-- Need: Apexcharts -->
    <script src="https://cdn.jsdelivr.net/gh/zuramai/mazer@docs/demo/assets/extensions/apexcharts/apexcharts.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/gh/zuramai/mazer@docs/demo/assets/static/js/pages/dashboard.js"></script>

    <!-- Custom Scripts -->
    <script src="assets/js/index.js"></script>
    <script src="assets/js/charts.js"></script>
    <script>
    const dataTable = new simpleDatatables.DataTable("#light_intensity_logs", {
        searchable: true,
        fixedHeight: true,
    })
    </script>
</body>

</html>