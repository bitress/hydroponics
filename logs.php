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

    <link
      rel="shortcut icon"
      href="https://cdn.jsdelivr.net/gh/zuramai/mazer@docs/demo/assets/compiled/svg/favicon.svg"
      type="image/x-icon"
    />

    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/gh/zuramai/mazer@docs/demo/assets/compiled/css/app.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/gh/zuramai/mazer@docs/demo/assets/compiled/css/app-dark.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/gh/zuramai/mazer@docs/demo/assets/compiled/css/iconly.css"
    />
    <link rel="stylesheet" href="https://atugatran.github.io/FontAwesome6Pro/css/all.min.css" >

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
                <div class="card">
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

    <!-- End content -->
    <script src="https://cdn.jsdelivr.net/gh/zuramai/mazer@docs/demo/assets/static/js/components/dark.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/zuramai/mazer@docs/demo/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="https://cdn.jsdelivr.net/gh/zuramai/mazer@docs/demo/assets/compiled/js/app.js"></script>

    <!-- Need: Apexcharts -->
    <script src="https://cdn.jsdelivr.net/gh/zuramai/mazer@docs/demo/assets/extensions/apexcharts/apexcharts.min.js"></script>
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
