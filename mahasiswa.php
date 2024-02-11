<?php

session_start();

// Membatasi halaman sebum login

if (!isset($_SESSION['login'])) {

    echo "<script>alert('Harap Login Terlebih Dahulu !!');
    document.location.href = 'login.php';
    </script>";
    exit;
}

// Membatasi halaman sesuai userlogin

if ($_SESSION['level'] != 1 and $_SESSION['level'] != 3) {

    echo "<script>alert('Perhatian !! Anda tidak memiliki akses');
    document.location.href = 'crud-modal.php';
    </script>";
    exit;
}

$title = 'Daftar Mahasiswa';

include 'layout/header.php';



// Menampilkan Data
$data_mahasiswa = select("SELECT * FROM mahasiswa ORDER BY id_mahasiswa DESC");

?>

<!-- Body -->

<div class="container mt-5">
    <h1>Data Mahasiswa</h1>
    <hr>
    <a href="tambah-mahasiswa.php" class="btn btn-primary mb-1">Tambah</a>

    <table class="table table-striped mt-3 table-bordered" id="table">
        <!-- Kolom Table -->
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Prodi</th>
                <th>Jenis Kelamin</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <!-- End Kolom Table -->

        <!-- Isi Table -->
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($data_mahasiswa as $mahasiswa) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $mahasiswa['nama']; ?></td>
                    <td><?= $mahasiswa['prodi']; ?></td>
                    <td><?= $mahasiswa['jk']; ?></td>
                    <td><?= $mahasiswa['telepon']; ?></td>
                    <td class="text-center" width="25%">
                        <a href="detail-mahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa']; ?>" class="btn btn-secondary ">Detail</a>
                        <a href="ubah-mahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa']; ?>" class="btn btn-success">Ubah</a>
                        <a href="hapus-mahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin akan menghapus file ini?'); ">Hapus</a>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
        <!-- End Isi Table -->
    </table>
</div>

<!-- End Body -->

<?php

include 'layout/footer.php'

?>