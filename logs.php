<?php

  include_once 'init.php';
  $sensor = new Sensors();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Logs - Hydroponics</title>

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
                <div class="card mb-2">
                    <div class="card-body">
                    <div class="card-title">Light Intensity Logs</div>
                        <div class="table-responsive">
                            <table class="table" id="light_intensity_logs">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Sensor Value</th>
                                    <th scope="col">Reading Time</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php
                                  $data = $sensor->getLatestSensorData(6);
                                  foreach ($data as $res):
                                ?>
                                  <tr>
                                    <th scope="row"><?= $res['id'] ?></th>
                                    <td><?= $res['value'] ?></td>
                                    <td><?= $res['reading_time'] ?></td>
                                  </tr>
                                <?php
                                  endforeach;
                                ?>
                                </tbody>
                              </table>
                        </div>
                    </div>
                <div class="card mb-2">
                    <div class="card-body">
                    <div class="card-title">Tank 1 Temperature Logs</div>
                        <div class="table-responsive">
                            <table class="table" id="temp_tank1_logs">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Sensor Value</th>
                                    <th scope="col">Reading Time</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php
                                  $data = $sensor->getLatestSensorData(3);
                                  foreach ($data as $res):
                                ?>
                                  <tr>
                                    <th scope="row"><?= $res['id'] ?></th>
                                    <td><?= $res['value'] ?></td>
                                    <td><?= $res['reading_time'] ?></td>
                                  </tr>
                                <?php
                                  endforeach;
                                ?>
                                </tbody>
                              </table>
                        </div>
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="card-body">
                    <div class="card-title">Tank 2 Temperature Logs</div>
                        <div class="table-responsive">
                            <table class="table" id="temp_tank2_logs">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Sensor Value</th>
                                    <th scope="col">Reading Time</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php
                                  $data = $sensor->getLatestSensorData(4);
                                  foreach ($data as $res):
                                ?>
                                  <tr>
                                    <th scope="row"><?= $res['id'] ?></th>
                                    <td><?= $res['value'] ?></td>
                                    <td><?= $res['reading_time'] ?></td>
                                  </tr>
                                <?php
                                  endforeach;
                                ?>
                                </tbody>
                              </table>
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

     <script>
      const dataTable = new simpleDatatables.DataTable("#light_intensity_logs", {searchable: true,fixedHeight: true,})
      const dataTable1 = new simpleDatatables.DataTable("#temp_tank1_logs", {searchable: true,fixedHeight: true,})
      const dataTable2 = new simpleDatatables.DataTable("#temp_tank2_logs", {searchable: true,fixedHeight: true,})

     </script>
  </body>
</html>
