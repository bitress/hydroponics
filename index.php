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
    let environment_temperature_value = <?= $sensor->fetchLatestSensorDataJSON(4); ?>;
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
                                <div class="card shadow-sm border-light view" data-value="1">
                                    <div class="card-body py-4 px-4">
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="stats-icon bg-purple p-3 rounded-circle text-white d-flex justify-content-center align-items-center me-3">
                                                <i class="fa-regular fa-droplet"></i>
                                            </div>
                                            <div>
                                                <h6 class="text-muted font-weight-bold mb-1">pH Level</h6>
                                                <h5 class="font-weight-extrabold mb-0"><span
                                                        id="ph_level_value">0.0</span></h5>
                                                <div class="mt-2">
                                                    <span class="badge bg-danger text-white"
                                                        id="ph_level_status">Loading...</span>
                                                </div>
                                                <div class="mt-2">
                                                    <small class="text-muted">Predicted pH Level in 3 days:
                                                        <strong><span
                                                                id="predicted_ph_level">Loading...</span></strong></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card shadow-sm border-light view" data-value="11">
                                    <div class="card-body py-4 px-4">
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="stats-icon bg-purple p-3 rounded-circle text-white d-flex justify-content-center align-items-center me-3">
                                                <i class="fa-solid fa-temperature-three-quarters"></i>
                                            </div>
                                            <div>
                                                <h6 class="text-muted font-weight-bold mb-1">Relative Humidity</h6>
                                                <h5 class="font-weight-extrabold mb-0"><span
                                                        id="humidity_value">Loading...</span></h5>
                                                <div class="mt-2">
                                                    <span class="badge bg-warning text-dark"
                                                        id="humidity_status">Loading...</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card shadow-sm border-light view" data-value="6">
                                    <div class="card-body py-4 px-4">
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="stats-icon bg-primary p-3 rounded-circle text-white d-flex justify-content-center align-items-center me-3">
                                                <i class="fa-solid fa-sun-bright"></i>
                                            </div>
                                            <div>
                                                <h6 class="text-muted font-weight-bold mb-1">Light Intensity Level</h6>
                                                <h5 class="font-weight-extrabold mb-0"><span
                                                        id="light_intensity_value">Loading...</span> lx</h5>
                                                <div class="mt-2">
                                                    <span class="badge bg-warning text-dark"
                                                        id="light_status">Loading...</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card shadow-sm border-light view" data-value="4">
                                    <div class="card-body py-4 px-4">
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="stats-icon bg-success p-3 rounded-circle text-white d-flex justify-content-center align-items-center me-3">
                                                <i class="fa-solid fa-temperature-list"></i>
                                            </div>
                                            <div>
                                                <h6 class="text-muted font-weight-bold mb-1">Ambient Temperature</h6>
                                                <h5 class="font-weight-extrabold mb-0">
                                                    <span id="ambient_temperature_value">0</span> °C
                                                </h5>
                                                <div class="mt-2">
                                                    <span class="badge bg-info text-dark"
                                                        id="ambient_temp_status">Loading...</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card shadow-sm border-light view" data-value="3">
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
                                                    <span class="badge bg-info text-dark"
                                                        id="tank_status">Loading...</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card shadow-sm border-light view" data-value="5">
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
                                                    <span class="badge bg-info text-dark"
                                                        id="water_level_status">Loading...</span>
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
                                    <div class="card-title d-flex justify-content-between align-items-center">
                                        <span>Parameters Charts</span>

                                        <div class="d-flex flex-row">
                                            <!-- Date Range Selector -->
                                            <div class="input-group me-2">
                                                <label for="dateRangeSelect" class="form-label visually-hidden">Select
                                                    Date Range</label>
                                                <select class="form-select" id="dateRangeSelect"
                                                    aria-label="Select Date Range">
                                                    <option value="24h">Last 24 Hours</option>
                                                    <option value="daily">Today</option>
                                                    <option value="7d">Last 7 Days</option>
                                                    <option value="30d">Last 30 Days</option>
                                                </select>
                                            </div>

                                            <!-- Back to All Button -->
                                            <div class="input-group">
                                                <button id="backToAllButton" class="btn btn-primary btn-sm"
                                                    title="Back to all data">
                                                    <i class="fa fa-refresh"></i> Reset
                                                </button>
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
    fetch('http://139.99.97.250:5000/predict')
        .then(response => response.json())
        .then(data => {
            document.getElementById("predicted_ph_level").textContent = data.status;
        })
        .catch(error => console.error('Error fetching data:', error));

    // Function to update the status based on value ranges
    function updateStatus(elementId, value, statusRanges) {
        let statusText = "";
        let statusClass = "";

        for (let range of statusRanges) {
            if (value >= range.min && value <= range.max) {
                statusText = range.statusText;
                statusClass = range.statusClass;
                break;
            }
        }

        document.getElementById(elementId).innerText = statusText;
        document.getElementById(elementId).className = `badge ${statusClass}`;
    }

    // PH Level
    const phValue = ph_data[0]?.value || 'N/A';
    document.getElementById('ph_level_value').innerText = phValue;

    if (phValue !== 'N/A') {
        const phStatusRanges = [{
                min: -Infinity,
                max: 5.5,
                statusText: "Too Acidic",
                statusClass: "bg-danger text-white"
            },
            {
                min: 5.5,
                max: 6.0,
                statusText: "Acidic",
                statusClass: "bg-warning text-dark"
            },
            {
                min: 6.0,
                max: 6.5,
                statusText: "Suboptimal",
                statusClass: "bg-warning text-dark"
            },
            {
                min: 6.5,
                max: 7.5,
                statusText: "Optimal",
                statusClass: "bg-success text-white"
            },
            {
                min: 7.5,
                max: 8.0,
                statusText: "Slightly Alkaline",
                statusClass: "bg-info text-white"
            },
            {
                min: 8.0,
                max: Infinity,
                statusText: "Too Alkaline",
                statusClass: "bg-danger text-white"
            }
        ];
        updateStatus('ph_level_status', parseFloat(phValue), phStatusRanges);
    }

    // Humidity Level
    const humidityValue = humidity_data[0]?.value || 'N/A';
    document.getElementById('humidity_value').innerText = humidityValue;

    if (humidityValue !== 'N/A') {
        const humidityStatusRanges = [{
                min: -Infinity,
                max: 30,
                statusText: "Too Dry",
                statusClass: "bg-danger text-white"
            },
            {
                min: 30,
                max: 50,
                statusText: "Low Humidity",
                statusClass: "bg-warning text-dark"
            },
            {
                min: 50,
                max: 70,
                statusText: "Optimal",
                statusClass: "bg-success text-white"
            },
            {
                min: 70,
                max: 85,
                statusText: "High Humidity",
                statusClass: "bg-warning text-dark"
            },
            {
                min: 85,
                max: Infinity,
                statusText: "Too Humid",
                statusClass: "bg-danger text-white"
            }
        ];
        updateStatus('humidity_status', parseFloat(humidityValue), humidityStatusRanges);
    }

    // Ambient Temperature
    const ambientTemperatureValue = environment_temperature_value[0]?.value || 'N/A';
    document.getElementById('ambient_temperature_value').innerText = ambientTemperatureValue;

    if (ambientTemperatureValue !== 'N/A') {
        const ambientTempRanges = [{
                min: -Infinity,
                max: 10,
                statusText: "Too Cold",
                statusClass: "bg-danger text-white"
            },
            {
                min: 10,
                max: 15,
                statusText: "Cold",
                statusClass: "bg-info text-dark"
            },
            {
                min: 15,
                max: 20,
                statusText: "Cool",
                statusClass: "bg-info text-dark"
            },
            {
                min: 20,
                max: 26,
                statusText: "Optimal",
                statusClass: "bg-success text-white"
            },
            {
                min: 26,
                max: 30,
                statusText: "Hot",
                statusClass: "bg-warning text-dark"
            },
            {
                min: 30,
                max: Infinity,
                statusText: "Too Hot",
                statusClass: "bg-danger text-white"
            }
        ];
        updateStatus('ambient_temp_status', parseFloat(ambientTemperatureValue), ambientTempRanges);
    }

    // Tank Temperature
    const tankTemperatureValue = tank1_temp_data[0]?.value || 'N/A';
    document.getElementById('tank1_temp_value').innerText = tankTemperatureValue;

    if (tankTemperatureValue !== 'N/A') {
        const tankTempRanges = [{
                min: -Infinity,
                max: 10,
                statusText: "Too Cold",
                statusClass: "bg-danger text-white"
            },
            {
                min: 10,
                max: 15,
                statusText: "Cold",
                statusClass: "bg-info text-dark"
            },
            {
                min: 15,
                max: 20,
                statusText: "Cool",
                statusClass: "bg-info text-dark"
            },
            {
                min: 20,
                max: 26,
                statusText: "Optimal",
                statusClass: "bg-success text-white"
            },
            {
                min: 26,
                max: 30,
                statusText: "Hot",
                statusClass: "bg-warning text-dark"
            },
            {
                min: 30,
                max: Infinity,
                statusText: "Too Hot",
                statusClass: "bg-danger text-white"
            }
        ];
        updateStatus('tank_status', parseFloat(tankTemperatureValue), tankTempRanges);
    }

    // Water Level
    const waterLevelValue = water_level_data[0]?.value || 'N/A';
    document.getElementById('water_level_value').innerText = waterLevelValue;

    if (waterLevelValue !== 'N/A') {
        const waterLevelRanges = [{
                min: -Infinity,
                max: 50,
                statusText: "Critical",
                statusClass: "bg-danger text-white"
            },
            {
                min: 50,
                max: 70,
                statusText: "Warning",
                statusClass: "bg-warning text-dark"
            },
            {
                min: 70,
                max: 90,
                statusText: "Optimal",
                statusClass: "bg-success text-white"
            },
            {
                min: 90,
                max: 100,
                statusText: "Safe but Risky",
                statusClass: "bg-info text-dark"
            },
            {
                min: 100,
                max: Infinity,
                statusText: "Too High",
                statusClass: "bg-danger text-white"
            }
        ];
        updateStatus('water_level_status', parseFloat(waterLevelValue), waterLevelRanges);
    }

    // Light Intensity
    const lightIntensityValue = light_data[0]?.value || 'N/A';
    document.getElementById('light_intensity_value').innerText = lightIntensityValue;

    if (lightIntensityValue !== 'N/A') {
        const lightIntensityRanges = [{
                min: 0,
                max: 100,
                statusText: "Low",
                statusClass: "bg-warning text-dark"
            },
            {
                min: 101,
                max: 1000,
                statusText: "Moderate",
                statusClass: "bg-info text-dark"
            },
            {
                min: 1001,
                max: Infinity,
                statusText: "High",
                statusClass: "bg-success text-white"
            }
        ];
        updateStatus('light_status', parseFloat(lightIntensityValue), lightIntensityRanges);
    }
    </script>
</body>

</html>