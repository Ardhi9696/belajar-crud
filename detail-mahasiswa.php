<?php

session_start();

// Membatasi login

if (!isset($_SESSION['login'])) {

    echo "<script>alert('Harap Login Terlebih Dahulu !!');
    document.location.href = 'login.php';
    </script>";
    exit;

}
$title = 'Detail Mahasiswa';

include 'layout/header.php';



// Periksa apakah parameter id_mahasiswa ada dan bukan NULL
if (isset($_GET['id_mahasiswa'])) {
    $id_mahasiswa = (int)$_GET['id_mahasiswa'];

    // Menampilkan Data
    $mahasiswa = select("SELECT * FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa")[0];

    if ($mahasiswa) {
?>

        <!-- Body -->
        <div class="container mt-5">
            <h1>Data <?= $mahasiswa['nama']; ?></h1>
            <hr>
            <table class="table table-striped mt-3 table-bordered">
                <!-- Kolom Table -->
                <tr>
                    <td>Nama</td>
                    <td>: <?= $mahasiswa['nama']; ?></td>
                </tr>
                <tr>
                    <td>Program Studi</td>
                    <td>: <?= $mahasiswa['prodi']; ?></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>: <?= $mahasiswa['jk']; ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>: <?= $mahasiswa['email']; ?></td>
                </tr>
                <tr>
                    <td>Telepon</td>
                    <td>: <?= $mahasiswa['telepon']; ?></td>
                </tr>
                <tr>
                    <td>Foto</td>
                    <td><a href="assets/img/<?= $mahasiswa['foto']; ?>">
                            <img src="assets/img/<?= $mahasiswa['foto']; ?>" alt="photo" width="500">
                        </a></td>
                </tr>

            </table>
            <a href="mahasiswa.php" class="btn btn-primary" style="float: right;">Kembali</a>
        </div>
        <!-- End Body -->

<?php
    } else {
        echo "Data mahasiswa tidak ditemukan.";
    }
} else {
    echo "ID mahasiswa tidak diberikan.";
}

include 'layout/footer.php';
?>