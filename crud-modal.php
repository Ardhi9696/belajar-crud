<?php

session_start();

// Membatasi login

if (!isset($_SESSION['login'])) {

    echo "<script>alert('Harap Login Terlebih Dahulu !!');
    document.location.href = 'login.php';
    </script>";
    exit;
}

$title = 'Daftar Akun';

include 'layout/header.php';


// Tampil Seluruh data
$data_akun = select("SELECT * FROM akun");

// Tampil data berdasarkan user login

$id_akun        = $_SESSION['id_akun'];
$data_bylogin   = select("SELECT * FROM akun WHERE id_akun = $id_akun");

// Jika tombol tambah ditekan jalankan script berikut
if (isset($_POST['tambah'])) {
    if (create_akun($_POST) > 0) {
        echo "<script>
        alert('Data Akun berhasil ditambahkan');
        document.location.href='crud-modal.php';</script>";
    } else {
        echo "<script>
        alert('Data Akun gagal ditambahkan');
        document.location.href='crud-modal.php';</script>";
    }
}

// Jika tombol ubah ditekan jalankan script berikut
if (isset($_POST['ubah'])) {
    if (update_akun($_POST) > 0) {
        echo "<script>
        alert('Data Akun berhasil diubah');
        document.location.href='crud-modal.php';</script>";
    } else {
        echo "<script>
        alert('Data Akun gagal diubah');
        document.location.href='crud-modal.php';</script>";
    }
}


?>


<!-- Judul -->
<div class="container mt-5">
    <h1>Data Akun</h1>
    <hr>

    <!-- Hilangkan tombol tambah akun jika bukan Admin -->
    <?php if ($_SESSION['level'] == 1) : ?>
        <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah</button>
    <?php endif; ?>

    <table class="table table-striped mt-3 table-bordered" id="table">
        <!-- Kolom Table -->
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>E-mail</th>
                <th>Password</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <!-- End Kolom Table -->

        <!-- Isi Table -->
        <tbody>
            <?php $no = 1; ?>
            <!-- Tampil seluruh -->
            <?php if ($_SESSION['level'] == 1) :  ?>
                <?php foreach ($data_akun as $akun) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $akun['nama']; ?></td>
                        <td><?= $akun['username']; ?></td>
                        <td><?= $akun['email']; ?></td>
                        <td>--- Encrypted ---</td>
                        <td class="text-center" width="25%">
                            <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $akun['id_akun']; ?>">Ubah</button>

                            <button type="button" class="btn btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $akun['id_akun']; ?>">hapus</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <!--Tampil data berdasarkan user login  -->
                <?php foreach ($data_bylogin as $akun) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $akun['nama']; ?></td>
                        <td><?= $akun['username']; ?></td>
                        <td><?= $akun['email']; ?></td>
                        <td>--- Encrypted ---</td>
                        <td class="text-center" width="25%">
                            <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $akun['id_akun']; ?>">Ubah</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
        <!-- End Isi Table -->
    </table>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required minlength="6">
                    </div>
                    <div class="mb-3">
                        <label for="level">Level</label>
                        <select name="level" id="level" class="form-control" required>
                            <option value="">-----Pilih Level-----</option>
                            <option value="1">Admin</option>
                            <option value="2">Operator Barang</option>
                            <option value="3">Operator Mahasiswa</option>
                        </select>

                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ubah -->
<?php foreach ($data_akun as $akun) : ?>
    <div class="modal fade" id="modalUbah<?= $akun['id_akun']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="staticBackdropLabel">Ubah Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <input type="hidden" name="id_akun" value="<?= $akun['id_akun']; ?>">
                        <div class="mb-3">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" value="<?= $akun['nama']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" value="<?= $akun['username']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?= $akun['email']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="password">Password <small>(Masukan password baru/lama)</small> </label>
                            <input type="password" name="password" id="password" class="form-control" required minlength="6">
                        </div>

                        <!-- Hidden fungsi ubah operator kecuali admin -->
                        <?php if ($_SESSION['level'] == 1) : ?>
                            <div class="mb-3">
                                <label for="level">Level</label>
                                <select name="level" id="level" class="form-control" required>
                                    <?php $level = $akun['level']; ?>
                                    <option value="1" <?= $level == '1' ? 'selected' : null ?>>Admin</option>
                                    <option value="2" <?= $level == '2' ? 'selected' : null ?>>Operator Barang</option>
                                    <option value="3" <?= $level == '3' ? 'selected' : null ?>>Operator Mahasiswa </option>
                                </select>
                            </div>
                        <?php else : ?>
                            <input type="hidden" name="level" value="<?= $akun['level']; ?>">
                        <?php endif; ?>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" name="ubah" class="btn btn-success">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Hapus -->

<?php foreach ($data_akun as $akun) : ?>
    <div class="modal fade" id="modalHapus<?= $akun['id_akun']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="staticBackdropLabel">Hapus Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <p>Apakah yakin akan menghapus data akun : <?= $akun['nama']; ?> ? </p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Batal</button>
                    <a href="hapus-akun.php?id_akun=<?= $akun['id_akun']; ?>" class="btn btn-danger">Hapus</a>

                </div>
            </div>
        </div>

    <?php endforeach; ?>

    <?php

    include 'layout/footer.php';

    ?>