<?php

session_start();
// Membatasi login

if (!isset($_SESSION['login'])) {

    echo "<script>alert('Harap Login Terlebih Dahulu !!');
    document.location.href = 'login.php';
    </script>";
    exit;

}

$title = 'Ubah Mahasiswa';

include 'layout/header.php';

// Check tombol ubah apakah ditekan

if (isset($_POST['ubah'])) {

    if (update_mahasiswa($_POST) > 0) {
        echo "<script>
        alert('Data mahasiswa berhasil diubah');
        document.location.href='mahasiswa.php';</script>";
    } else {
        echo "<script>
        alert('Data mahasiswa gagal diubah');
        document.location.href='ubah-mahasiswa.php';</script>";
    }
}

// Ambil Id dari URL

$id_mahasiswa = (int)$_GET['id_mahasiswa'];

// Query ambil data mahasiswa

$mahasiswa = select("SELECT * FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa")[0];


?>

<div class="container mt-5">
    <h1>Ubah Data Mahasiswa</h1>
    <hr>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_mahasiswa" value="<?= $mahasiswa['id_mahasiswa']; ?>">
        <input type="hidden" name="fotoLama" value=" <?= $mahasiswa['foto']; ?> ">

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Mahasiswa</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Mahasiswa..." required value="<?= $mahasiswa['nama'] ?>">
        </div>
        <div class="row">
            <div class="mb-3 col-6">
                <label for="prodi" class="form-label">Program Studi</label>
                <select name="prodi" id="prodi" class="form-control" required>
                    <?php $prodi = $mahasiswa['prodi']; ?>
                    <option value="">---Pilih Prodi----</option>
                    <option value="Teknik Informatika" <?= $prodi == 'Teknik Informatika' ? 'selected' : null ?>>Teknik Informatika</option>
                    <option value="Teknik Mesin" <?= $prodi == 'Teknik Mesin' ? 'selected' : null ?>>Teknik Mesin</option>
                    <option value="Teknik Kimia" <?= $prodi == 'Teknik Kimia' ? 'selected' : null ?>>Teknik Kimia</option>
                </select>
            </div>

            <div class="mb-3 col-6">
                <label for="jk" class="form-label">Jenis Kelamin</label>
                <select name="jk" id="jk" class="form-control" required>
                    <?php $jk = $mahasiswa['jk']; ?>
                    <option value="">---Pilih Jenis Kelamin----</option>
                    <option value="Laki-laki" <?= $jk == 'Laki-laki' ? 'selected' : null ?>>Laki-laki</option>
                    <option value="Perempuan" <?= $jk == 'Perempuan' ? 'selected' : null ?>>Perempuan</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="E-mail..." required value="<?= $mahasiswa['email'] ?>">
        </div>
        <div class="mb-3">
            <label for="telepon" class="form-label">Telepon</label>
            <input type="number" class="form-control" id="telepon" name="telepon" placeholder="Telepon..." required value="<?= $mahasiswa['telepon'] ?>">
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" class="form-control" id="foto" name="foto" placeholder="Foto..." onchange="previewImg()">
            <img src="assets/img/<?= $mahasiswa['foto'] ?>" class="img-thumbnail img-preview mt-2" width="500px" alt="photo">
        </div>

        <button type="submit" name="ubah" class="btn btn-primary" style="float: right;">Ubah</button>






    </form>

</div>

<!-- Preview Image -->

<script>
    function previewImg() {
        const foto = document.querySelector('#foto');
        const imgPreview = document.querySelector('.img-preview');

        const fileFoto = new FileReader();
        fileFoto.readAsDataURL(foto.files[0]);

        fileFoto.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>

<?php

include 'layout/footer.php'


?>