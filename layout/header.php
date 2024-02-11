<?php

include 'config/app.php';


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
</head>

<body>

    <!--  Navigasi Bar -->
    <div>
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark ">
            <div class="container">
                <a class="navbar-brand" href="#">Belajar CRUD</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <?php if ($_SESSION['level'] == 1 or $_SESSION['level'] == 2) : ?>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="index.php">Barang</a>
                            </li>
                        <?php endif; ?>

                        <?php if ($_SESSION['level'] == 1 or $_SESSION['level'] == 3) : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="mahasiswa.php">Mahasiswa</a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link" href="crud-modal.php">Daftar Akun</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php" onclick="return confirm('Yakin ingin LogOut ?')">Keluar</a>
                        </li>

                    </ul>
                </div>
                <div>
                    <a class="navbar-brand" href="#">Hi! <?= $_SESSION['nama'] ?> </a>
                </div>
            </div>
        </nav>
    </div>
    <!-- End Nav Bar -->