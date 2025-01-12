<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Camera Logs - Hydroponics</title>

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
                                        <div class="table-responsive mt-2">
                                            <table class="table table-striped " id="detectionLogs">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Image Captured</th>
                                                        <th>Detection Result</th>
                                                        <th>Time</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $camera = new Camera();
                                                    $detectionLogs = $camera->DetectionLogs();

                                                    foreach ($detectionLogs as $log): ?>
                                                        <tr>
                                                            <td>
                                                                <img src="data:image/jpeg;base64,<?= $log['raw_image'] ?>" alt="Original Image" class="img-thumbnail" width="100" height="100" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImageModal('data:image/jpeg;base64,<?= $log['raw_image'] ?>')">
                                                            </td>
                                                            <td>
                                                                <img src="data:image/jpeg;base64,<?= $log['annotated_image'] ?>" alt="Annotated Image" class="img-thumbnail" width="100" height="100" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImageModal('data:image/jpeg;base64,<?= $log['annotated_image'] ?>')">
                                                            </td>
                                                            <td><?= $log['datetime'] ?></td>
                                                            <td></td>
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
    <!-- Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="Full View" class="img-fluid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
const dataTable = new simpleDatatables.DataTable("#detectionLogs", {
	searchable: false,
	fixedHeight: true,
})
    function showImageModal(imageSrc) {
        const modalImage = document.getElementById('modalImage');
        modalImage.src = imageSrc;
    }
    </script>
</body>

</html>