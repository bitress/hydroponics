<?php
  include_once 'init.php';
  $sensor = new Sensors();


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
    <title>Logs - Hydroponics</title>
    <?php include_once 'templates/head-styles.php'; ?>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/gh/zuramai/mazer@docs/demo/assets/static/js/initTheme.js"></script>

    <div id="app">
        <?php include_once __DIR__ . '/templates/navbar.php'; ?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>Parameter Logs</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="container">

                        <!-- pH Sensor Logs (Sensor ID=1) -->
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="card-title d-flex justify-content-between align-items-center">
                                    <span>pH Sensor Logs</span>
                                    <button class="btn btn-primary btn-sm" onclick="generatePDF(1)">Download Sensor
                                        PDF</button>
                                </div>

                                <div class="table-responsive">
                                    <table class="table" id="ph_sensor_logs">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Sensor Value</th>
                                                <th scope="col">Reading Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                          $data = $sensor->getLatestSensorData(1);
                          foreach ($data as $res):
                        ?>
                                            <tr>
                                                <th scope="row"><?= $res['id'] ?></th>
                                                <td><?= $res['value'] ?></td>
                                                <td><?= $res['reading_time'] ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <!-- Tank 1 Temperature Logs (Sensor ID=3) -->
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="card-title d-flex justify-content-between align-items-center">Tank Temperature Logs
                                <button class="btn btn-primary btn-sm" onclick="generatePDF(3)">Download Sensor
                                PDF</button>
                                </div>
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
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <!-- Ultrasonic Logs (Sensor ID=5) -->
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="card-title d-flex justify-content-between align-items-center">Ultrasonic Logs
                                <button class="btn btn-primary btn-sm" onclick="generatePDF(5)">Download Sensor
                                PDF</button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table" id="ultrasonic_sensor_logs">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Sensor Value</th>
                                                <th scope="col">Reading Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                          $data = $sensor->getLatestSensorData(5);
                          foreach ($data as $res):
                        ?>
                                            <tr>
                                                <th scope="row"><?= $res['id'] ?></th>
                                                <td><?= $res['value'] ?></td>
                                                <td><?= $res['reading_time'] ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Light Intensity Logs (Sensor ID=6) -->
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="card-title d-flex justify-content-between align-items-center">Light Intensity Logs
                                <button class="btn btn-primary btn-sm" onclick="generatePDF(6)">Download Sensor
                                PDF</button>
                                </div>
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
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Environment Temperature Logs (Sensor ID=6) -->
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="card-title d-flex justify-content-between align-items-center">Environment Temperature Logs
                                <button class="btn btn-primary btn-sm" onclick="generatePDF(4)">Download Sensor
                                PDF</button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table" id="env_temp_logs">
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
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Environment Temperature Logs (Sensor ID=6) -->
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="card-title d-flex justify-content-between align-items-center">Humidity Logs
                                <button class="btn btn-primary btn-sm" onclick="generatePDF(11)">Download Sensor
                                PDF</button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table" id="humid_logs">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Sensor Value</th>
                                                <th scope="col">Reading Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                          $data = $sensor->getLatestSensorData(11);
                          foreach ($data as $res):
                        ?>
                                            <tr>
                                                <th scope="row"><?= $res['id'] ?></th>
                                                <td><?= $res['value'] ?></td>
                                                <td><?= $res['reading_time'] ?></td>
                                            </tr>
                                            <?php endforeach; ?>
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
                            <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                            by <a href="https://saugi.me">Saugi</a>
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    </div>



    <?php include_once 'templates/body-scripts.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.29/jspdf.plugin.autotable.min.js"></script>


    <script>
    // Initialize Simple Datatables for each table
    const dataTablePH = new simpleDatatables.DataTable("#ph_sensor_logs", {
        searchable: true,
        fixedHeight: true,
    });

    const dataTableTank1 = new simpleDatatables.DataTable("#temp_tank1_logs", {
        searchable: true,
        fixedHeight: true,
    });

    const dataTableUltrasonic = new simpleDatatables.DataTable("#ultrasonic_sensor_logs", {
        searchable: true,
        fixedHeight: true,
    });
    const dataTableLight = new simpleDatatables.DataTable("#light_intensity_logs", {
        searchable: true,
        fixedHeight: true,
    });
    const env_temp_logs = new simpleDatatables.DataTable("#env_temp_logs", {
        searchable: true,
        fixedHeight: true,
    });

    const humid_logs = new simpleDatatables.DataTable("#humid_logs", {
        searchable: true,
        fixedHeight: true,
    });


    async function generatePDF(sensorID) {
        const {
            jsPDF
        } = window.jspdf;
        const pdf = new jsPDF();

        // Fetch the data
        const res = await fetch(`get_sensor_logs.php?sensor_id=${sensorID}`);
        const data = await res.json();

        // Convert data to table rows
        const rows = data.map((item, index) => [
            index + 1,
            item.value,
            item.reading_time
        ]);

        // Create the table
        pdf.text("Sensor Report", 14, 15);
        pdf.autoTable({
            head: [
                ['#', 'Value', 'Timestamp']
            ],
            body: rows,
            startY: 20
        });

        // Save the PDF
        pdf.save(`sensor-${sensorID}.pdf`);
    }
    </script>
</body>

</html>