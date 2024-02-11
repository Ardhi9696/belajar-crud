<?php

session_start();

// Membatasi login

if (!isset($_SESSION['login'])) {

    echo "<script>alert('Harap Login Terlebih Dahulu !!');
    document.location.href = 'login.php';
    </script>";
    exit;

}

// Kosongkan sesion

$_SESSION = [];

session_unset();
session_destroy();
header("Location: login.php");


?>