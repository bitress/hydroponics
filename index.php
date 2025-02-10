<?php

  include_once 'init.php';
  $sensor = new Sensors();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - Hydroponics</title>

    <?php include_once 'templates/head-styles.php'; ?>

    <script>
    let ph_data = <?= $sensor->fetchLatestSensorDataJSON(1); ?>;
    let humidity_data = <?= $sensor->fetchLatestSensorDataJSON(11); ?>;
    let tank1_temp_data = <?= $sensor->fetchLatestSensorDataJSON(3); ?>;
    let tank2_temp_data = <?= $sensor->fetchLatestSensorDataJSON(4); ?>;
    let water_level_data = <?= $sensor->fetchLatestSensorDataJSON(5); ?>;
    let light_data = <?= $sensor->fetchLatestSensorDataJSON(6); ?>;
    let environment_temperature_value = <?= $sensor->fetchLatestSensorDataJSON(8); ?>;
    </script>
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
                <h3>AquaMetrics</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-12">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card shadow-sm border-light">
                                    <div class="card-body py-4 px-4">
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="stats-icon bg-purple p-3 rounded-circle text-white d-flex justify-content-center align-items-center me-3">
                                                <i class="fa-regular fa-droplet"></i>
                                            </div>
                                            <div>
                                                <h6 class="text-muted font-weight-bold mb-1">pH Level</h6>
                                                <h5 class="font-weight-extrabold mb-0"><span
                                                        id="ph_level_value">7.0</span></h5>
                                                <div class="mt-2">
                                                    <span class="badge bg-danger text-white">Too Acidic</span>
                                                </div>
                                                <div class="mt-2">
                                                    <small class="text-muted">Predicted pH Level in 3 days:
                                                        <strong>Acidic</strong></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card shadow-sm border-light">
                                    <div class="card-body py-4 px-4">
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="stats-icon bg-purple p-3 rounded-circle text-white d-flex justify-content-center align-items-center me-3">
                                                <i class="fa-solid fa-temperature-three-quarters"></i>
                                            </div>
                                            <div>
                                                <h6 class="text-muted font-weight-bold mb-1">Relative Humidity</h6>
                                                <h5 class="font-weight-extrabold mb-0"><span
                                                        id="humidity_value">50%</span></h5>
                                                <div class="mt-2">
                                                    <span class="badge bg-warning text-dark">Status: Low Humidity</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card shadow-sm border-light">
                                    <div class="card-body py-4 px-4">
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="stats-icon bg-primary p-3 rounded-circle text-white d-flex justify-content-center align-items-center me-3">
                                                <i class="fa-solid fa-sun-bright"></i>
                                            </div>
                                            <div>
                                                <h6 class="text-muted font-weight-bold mb-1">Light Intensity Level</h6>
                                                <h5 class="font-weight-extrabold mb-0"><span
                                                        id="light_intensity_value">0</span> lx</h5>
                                                <div class="mt-2">
                                                    <span class="badge bg-warning text-dark">Status: Low</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card shadow-sm border-light">
                                    <div class="card-body py-4 px-4">
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="stats-icon bg-success p-3 rounded-circle text-white d-flex justify-content-center align-items-center me-3">
                                                <i class="fa-solid fa-temperature-list"></i>
                                            </div>
                                            <div>
                                                <h6 class="text-muted font-weight-bold mb-1">Ambient Temperature</h6>
                                                <h5 class="font-weight-extrabold mb-0">
                                                    <span id="environment_temperature_value">22</span> °C
                                                </h5>
                                                <div class="mt-2">
                                                    <span class="badge bg-info text-dark">Status: Moderate</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card shadow-sm border-light">
                                    <div class="card-body py-4 px-4">
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="stats-icon bg-success p-3 rounded-circle text-white d-flex justify-content-center align-items-center me-3">
                                                <i class="fa-thin fa-temperature-high"></i>
                                            </div>
                                            <div>
                                                <h6 class="text-muted font-weight-bold mb-1">Tank Temperature</h6>
                                                <h5 class="font-weight-extrabold mb-0">
                                                    <span id="tank1_temp_value">22</span> °C
                                                </h5>
                                                <div class="mt-2">
                                                    <span class="badge bg-info text-dark">Status: Moderate</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card shadow-sm border-light">
                                    <div class="card-body py-4 px-4">
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="stats-icon bg-info p-3 rounded-circle text-white d-flex justify-content-center align-items-center me-3">
                                                <i class="fa-solid fa-water-arrow-up"></i>
                                            </div>
                                            <div>
                                                <h6 class="text-muted font-weight-bold mb-1">Water Level</h6>
                                                <h5 class="font-weight-extrabold mb-0">
                                                    <span id="water_level_value">80</span> %
                                                </h5>
                                                <div class="mt-2">
                                                    <span class="badge bg-info text-dark">Status: Normal</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>


                    </div>


                    <div class="col-12">
                        <div class="container">
                            <div class="card mt-2">
                                <div class="card-body">
                                    <div class="card-title">pH Level
                                        <div class="flex float-end">
                                            <div class="input-group">
                                                <select class="form-select" id="dateRangeSelect">
                                                    <option value="24h">Last 24 Hours</option>
                                                    <option value="daily">Today</option>
                                                    <option value="7d">Last 7 Days</option>
                                                    <option value="30d">Last 30 Days</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <div id="sensor_data_chart"></div>
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

    <?php include_once 'templates/body-scripts.php'; ?>
    <script src="assets/js/plotly.js"></script>

    <script>
    document.getElementById('ph_level_value').innerText = ph_data[0]?.value || 'N/A';
    document.getElementById('humidity_value').innerText = humidity_data[0]?.value || 'N/A';
    document.getElementById('tank1_temp_value').innerText = tank1_temp_data[0]?.value || 'N/A';
    document.getElementById('tank2_temp_value').innerText = tank2_temp_data[0]?.value || 'N/A';
    document.getElementById('water_level_value').innerText = water_level_data[0]?.value || 'N/A';
    document.getElementById('light_intensity_value').innerText = light_data[0]?.value || 'N/A';
    document.getElementById('environment_temperature_value').innerText = environment_temperature_value[0]?.value ||
        'N/A';
    </script>
</body>

</html>