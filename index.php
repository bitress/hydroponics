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
      let ph_temp_data = <?= $sensor->fetchLatestSensorDataJSON(2); ?>;
      let tank1_temp_data = <?= $sensor->fetchLatestSensorDataJSON(3); ?>;
      let tank2_temp_data = <?= $sensor->fetchLatestSensorDataJSON(4); ?>;
      let water_level_data = <?= $sensor->fetchLatestSensorDataJSON(5); ?>;
      let light_data = <?= $sensor->fetchLatestSensorDataJSON(6); ?>;

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
          <h3>Hydroponics</h3>
        </div>
        <div class="page-content">
          <section class="row">
          <div class="col-12 col-lg-12">
          <div class="row">
            <div class="col-6 col-lg-3 col-md-6">
              <div class="card">
                <div class="card-body px-4 py-4-5">
                  <div class="row">
                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                      <div class="stats-icon purple mb-2">
                        <i class="fa-regular fa-droplet"></i>
                      </div>
                    </div>
                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                      <h6 class="text-muted font-semibold">PH Level</h6>
                      <h6 class="font-extrabold mb-0"><span id="ph_level_value"></span></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-6 col-lg-3 col-md-6">
              <div class="card">
                <div class="card-body px-4 py-4-5">
                  <div class="row">
                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                      <div class="stats-icon purple mb-2">
                        <i class="fa-solid fa-temperature-three-quarters"></i>
                      </div>
                    </div>
                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                      <h6 class="text-muted font-semibold">PH Level Temperature</h6>
                      <h6 class="font-extrabold mb-0"><span id="ph_temp_value"></span></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-6 col-lg-3 col-md-6">
              <div class="card">
                <div class="card-body px-4 py-4-5">
                  <div class="row">
                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                      <div class="stats-icon blue mb-2">
                        <i class="fa-solid fa-sun-bright"></i>
                      </div>
                    </div>
                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                      <h6 class="text-muted font-semibold">Light Intensity Level</h6>
                      <h6 class="font-extrabold mb-0"><span id="light_intensity_value">0</span> lx</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-6 col-lg-3 col-md-6">
              <div class="card">
                <div class="card-body px-4 py-4-5">
                  <div class="row">
                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                      <div class="stats-icon green mb-2">
                        <i class="fa-solid fa-temperature-list"></i>
                      </div>
                    </div>
                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                      <h6 class="text-muted font-semibold">Environment Temperature</h6>
                      <h6 class="font-extrabold mb-0"><span id="temperature_value"></span></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-6 col-lg-3 col-md-6">
              <div class="card">
                <div class="card-body px-4 py-4-5">
                  <div class="row">
                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                      <div class="stats-icon green mb-2">
                        <i class="fa-thin fa-temperature-high"></i>
                      </div>
                    </div>
                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                      <h6 class="text-muted font-semibold">Tank 1 Temperature</h6>
                      <h6 class="font-extrabold mb-0"><span id="tank1_temp_value"></span></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-6 col-lg-3 col-md-6">
              <div class="card">
                <div class="card-body px-4 py-4-5">
                  <div class="row">
                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                      <div class="stats-icon blue mb-2">
                        <i class="fa-duotone fa-solid fa-temperature-list"></i>
                      </div>
                    </div>
                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                      <h6 class="text-muted font-semibold">Tank 2 Temperature</h6>
                      <h6 class="font-extrabold mb-0"><span id="tank2_temp_value"></span></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-6 col-lg-3 col-md-6">
              <div class="card">
                <div class="card-body px-4 py-4-5">
                  <div class="row">
                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                      <div class="stats-icon green mb-2">
                        <i class="fa-solid fa-water-arrow-up"></i>
                      </div>
                    </div>
                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                      <h6 class="text-muted font-semibold">Water Level</h6>
                      <h6 class="font-extrabold mb-0"><span id="water_level_value"></span></h6>
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
                <span class="text-danger"
                  ><i class="bi bi-heart-fill icon-mid"></i
                ></span>
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
      document.getElementById('ph_temp_value').innerText = ph_temp_data[0]?.value || 'N/A';
      document.getElementById('tank1_temp_value').innerText = tank1_temp_data[0]?.value || 'N/A';
      document.getElementById('tank2_temp_value').innerText = tank2_temp_data[0]?.value || 'N/A';
      document.getElementById('water_level_value').innerText = water_level_data[0]?.value || 'N/A';
      document.getElementById('light_intensity_value').innerText = light_data[0]?.value || 'N/A';
     </script>
  </body>
</html>
