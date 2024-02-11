<?php

session_start();

// Membatasi login

if (!isset($_SESSION['login'])) {

    echo "<script>alert('Harap Login Terlebih Dahulu !!');
    document.location.href = 'login.php';
    </script>";
    exit;

}

$title = 'Tambah Barang';

include 'layout/header.php';

// Chech tombol tambah apakah ditekan

if (isset($_POST['tambah'])) {

    if (create_barang($_POST) > 0) {
        echo "<script>
        alert('Data barang berhasil ditambahkan');
        document.location.href='index.php';</script>";
    } else {
        echo "<script>
        alert('Data barang gagal ditambahkan');
        document.location.href='tambah-barang.php';</script>";
    }
}


?>

<div class="container mt-5">
    <h1>Tambah Barang</h1>
    <hr>
    <form action="" method="post">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Barang..." required>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">jumlah Barang</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah Barang..." required>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">harga Barang</label>
            <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga Barang..." required>
        </div>

        <button type="submit" name="tambah" class="btn btn-primary" style="float: right;">Tambah</button>






    </form>

</div>

<?php

include 'layout/footer.php'


?>