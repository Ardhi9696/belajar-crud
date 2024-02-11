<?php

session_start();
// Membatasi login

if (!isset($_SESSION['login'])) {

    echo "<script>alert('Harap Login Terlebih Dahulu !!');
    document.location.href = 'login.php';
    </script>";
    exit;

}

$title = 'Ubah Barang';

include 'layout/header.php';


// Mengambil Id BArang dari URL
$id_barang = (int)$_GET['id_barang'];

$barang = select("SELECT * FROM barang WHERE id_barang = $id_barang")[0];

// Chech tombol tambah apakah ditekan

if (isset($_POST['ubah'])) {

    if (update_barang($_POST) > 0) {
        echo "<script>
        alert('Data barang berhasil diubah');
        document.location.href='index.php';</script>";
    } else {
        echo "<script>
        alert('Data barang gagal diubah');
        document.location.href='form-tambah.php';</script>";
    }
}


?>

<div class="container mt-5">
    <h1>Ubah Barang</h1>
    <hr>
    <form action="" method="post">
        <input type="hidden" name="id_barang" value="<?= $barang['id_barang']; ?>">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Barang..." required value="<?= $barang['nama']; ?>">
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">jumlah Barang</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah Barang..." required value="<?= $barang['jumlah']; ?>">
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">harga Barang</label>
            <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga Barang..." required value="<?= $barang['harga']; ?>">
        </div>

        <button type="submit" name="ubah" class="btn btn-primary" style="float: right;">Ubah</button>






    </form>

</div>

<?php

include 'layout/footer.php'


?>