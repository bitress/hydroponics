<?php

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sensors - Hydroponics</title>

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
                <h3>Sensors</h3>
            </div>
            <div class="page-content">
                <section class="row">

                    <div class="container">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex flex-end">
                                          
                                        </div>
                                        <div class="table-responsive mt-2">
                                        <table class="table">
                                            <thead>
                                                <th>Sensor ID</th>
                                                <th>Sensor Name</th>
                                                <th>Sensor Control</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $sensorClass = new Sensors();
                                                    $row = $sensorClass->getSensors();
                                                    foreach($row as $res):
                                                ?>
                                                <tr>
                                                    <td><?= $res['id'] ?></td>
                                                    <td><?= $res['sensor_name'] ?></td>
                                                    <td><?= $res['device_name'] ?></td>
                                                   
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





    <?php include_once 'templates/body-scripts.php'; ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });


    </script>
</body>

</html>