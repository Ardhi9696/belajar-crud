<?php

// Fungsi Menampilkan Databases
function select($query)
{
    // Panggil Koneksi Database
    global $db;

    $result = mysqli_query($db, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// Fungsi menambahkan data barang

function create_barang($post)
{
    global $db;

    $nama   = strip_tags($post['nama']);
    $jumlah = strip_tags($post['jumlah']);
    $harga  = strip_tags($post['harga']);

    // Query tambah data
    $query = "INSERT INTO barang VALUES(null, '$nama', '$jumlah', '$harga', CURRENT_TIMESTAMP())";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi mengubah data barang

function update_barang($post)
{
    global $db;

    $id_barang  = $post['id_barang'];
    $nama       = strip_tags($post['nama']);
    $jumlah     = strip_tags($post['jumlah']);
    $harga      = strip_tags($post['harga']);

    // Query ubah data
    $query  = "UPDATE barang SET 
    nama    = '$nama', 
    jumlah  = '$jumlah', 
    harga   = '$harga' 
    WHERE id_barang = $id_barang ";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// Fungsi hapus data barang

function delete_barang($id_barang)
{
    global $db;
    // Query Hapus data barang

    $query = "DELETE FROM barang WHERE id_barang = $id_barang";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// fungsi tambah mahasiswa

function create_mahasiswa($post)
{
    global $db;
    $nama       = htmlspecialchars($post['nama']);
    $prodi      = htmlspecialchars($post['prodi']);
    $jk         = htmlspecialchars($post['jk']);
    $email      = htmlspecialchars($post['email']);
    $telepon    = htmlspecialchars($post['telepon']);
    $foto       = upload_file();

    // Check Upload foto

    if (!$foto) {

        return false;
    }

    // Query tambah data
    $query = "INSERT INTO mahasiswa VALUES(
        null, 
        '$nama', 
        '$prodi', 
        '$jk', 
        '$email', 
        '$telepon', 
        '$foto')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// Fungsi Update mahasiswa
function update_mahasiswa($post)
{
    global $db;
    $id_mahasiswa = htmlspecialchars($post['id_mahasiswa']);
    $nama         = htmlspecialchars($post['nama']);
    $prodi        = htmlspecialchars($post['prodi']);
    $jk           = htmlspecialchars($post['jk']);
    $email        = htmlspecialchars($post['email']);
    $telepon      = htmlspecialchars($post['telepon']);
    $fotoLama     = htmlspecialchars($post['fotoLama']);

    // Check Upload foto baru/tidak

    if ($_FILES['foto']['error'] == 4) {
        $foto = $fotoLama;
    } else {

        $foto = upload_file();
    }

    // Query Ubah  data
    $query = "UPDATE mahasiswa SET 

    nama        = '$nama', 
    prodi       = '$prodi', 
    jk          = '$jk', 
    email       = '$email', 
    telepon     = '$telepon', 
    foto        = '$foto'

    WHERE id_mahasiswa = $id_mahasiswa ";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// Fungsi upload file

function upload_file()
{
    $namaFile   = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error      = $_FILES['foto']['error'];
    $tmpName    = $_FILES['foto']['tmp_name'];

    // Check File yg diupload

    $extensifileValid = ['jpg', 'jpeg', 'png',];
    $extensifile      = explode('.', $namaFile);
    $extensifile      = strtolower(end($extensifile));


    // check extensi
    if (!in_array($extensifile, $extensifileValid)) {

        // Pesan Gagal

        echo "<script> alert('Format file Invalid');
        document.location.href = 'tambah-mahasiswa.php';
        </script>";
        die();
    }

    // Cek ukuran file file 2MB

    if ($ukuranFile > 2048000) {

        echo "<script> alert('Ukuran MAX 2MB!!!');
        document.location.href = 'tambah-mahasiswa.php';
        </script>";
        die();
    }

    // Generate file baru
    $namaFileBaru  = uniqid();
    $namaFileBaru .= ".";
    $namaFileBaru .= $extensifile;

    // Pindahkan ke local

    move_uploaded_file($tmpName, 'assets/img/' . $namaFileBaru);
    return $namaFileBaru;
}

// fungsi delete data mahasiswa

function delete_mahasiswa($id_mahasiswa)
{
    global $db;

    // ambil Foto sesuai data yg dipilih
    $foto = select("SELECT * FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa")[0];
    unlink("assets/img/". $foto['foto']);


    // Query Hapus data mahasiswa
    $query = "DELETE FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// Fungsi Tambah akun

function create_akun($post) {

    global $db;

    $nama       = htmlspecialchars($post['nama']);
    $username   = htmlspecialchars($post['username']);
    $email      = htmlspecialchars($post['email']);
    $password   = htmlspecialchars($post['password']);
    $level      = htmlspecialchars($post['level']);

    // enkripsi password

    $password = password_hash($password, PASSWORD_DEFAULT);
    

    // Query tambah data
    $query = "INSERT INTO akun VALUES(
        null, 
        '$nama', 
        '$username', 
        '$email', 
        '$password', 
        '$level')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);

}


// Ubah akun
function update_akun($post) {

    global $db;
    
    $id_akun    = htmlspecialchars($post['id_akun']);
    $nama       = htmlspecialchars($post['nama']);
    $username   = htmlspecialchars($post['username']);
    $email      = htmlspecialchars($post['email']);
    $password   = htmlspecialchars($post['password']);
    $level      = htmlspecialchars($post['level']);

    // enkripsi password

    $password = password_hash($password, PASSWORD_DEFAULT);
    

    // Query ubah data
    $query      = "UPDATE akun SET 
    nama        = '$nama', 
    username    = '$username', 
    email       = '$email', 
    password    = '$password', 
    level       = '$level' 
    WHERE id_akun = $id_akun";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);

}

// Fungsi Delete Akun

function delete_akun($id_akun)
{
    global $db;

    // Query Hapus data akun
    $query = "DELETE FROM akun WHERE id_akun = $id_akun";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}
