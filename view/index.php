<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clustering K-Means</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./assets/css/style.css" />
    <link rel="stylesheet" href="./assets/css/dataTables.bootstrap4.min.css" />

</head>

<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Clustering K-Means</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0" id="header-menu">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Siswa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Nilai Kelas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Nilai Siswa</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Cluster Data Siswa</a>
                </li>
            </ul>
            <div class="">
                <span class="nav-item user-text"><?= $_SESSION['nama'] ?></span>
                <a class="btn btn-primary btn-sm ml-1" href="?action=logout">Logout</a>
            </div>
        </div>
    </nav>
    <section class="dynamic container">
        Loading...
    </section>

    <div class="modal fade" data-backdrop="static" id="backdrop-loader" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document" style="display: flex;align-items:center;justify-content:center;flex-direction:column;height:100vh;width:100vw;">

            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <h1>Loading...</h1>
        </div>

    </div>



    <script src="./assets/js/jquery-3.5.1.min.js"></script>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/app.js"></script>
    <script src="./assets/js/dataTables.bootstrap4.min.js"></script>
    <script>
        var base_url = '<?= BASE_URL ?>';
    </script>
</body>

</html>