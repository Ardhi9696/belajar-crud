<?php

// Start Sesion 

session_start();

include 'config/app.php';

// Cek Tombol login apakah sudah ditekan

if (isset($_POST['login'])) {

  // Ambil input username
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  // Check Username
  $result = mysqli_query($db, "SELECT * FROM akun WHERE username = '$username' ");



  // Jika ada usernya 
  if (mysqli_num_rows($result) == 1) {
    // Check Passwordnya
    $hasil = mysqli_fetch_assoc($result);

    if (password_verify($password, $hasil['password'])) {
      // Set Sesion nya
      $_SESSION['login']    = true;
      $_SESSION['id_akun']  = $hasil['id_akun'];
      $_SESSION['nama']     = $hasil['nama'];
      $_SESSION['username'] = $hasil['username'];
      $_SESSION['email']    = $hasil['email'];
      $_SESSION['level']    = $hasil['level'];


      // Jika Login Benar maka akan dialihkan kesini
      header("Location: crud-modal.php");
      exit;
    }
  }

  // Jika tidak ada usernya/login salah
  $error = true;
}


?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.88.1">
  <title>Login Panel · Bootstrap v5.1</title>


  <!-- Bootstrap core CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="assets/css/signin.css" rel="stylesheet">
</head>

<body class="text-center">

  <main class="form-signin">
    <form action="" method="POST">
      <img class="mb-4" src="assets/icon/bootstrap-logo.svg" alt="" width="72" height="57">
      <h1 class="h3 mb-3 fw-normal">Admin Login</h1>

      <!-- Warning Error -->
      <?php if (isset($error)) : ?>
        <div class="alert alert-danger text-center">
          <b>Username/Password Salah</b>
        <?php endif; ?>
        <!-- End Warning error -->

        </div>

        <div class="form-floating">
          <input type="text" name="username" class="form-control" id="floatingInput" placeholder="Username" required>
          <label for="floatingInput">Username</label>
        </div>
        <div class="form-floating">
          <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
          <label for="floatingPassword">Password</label>
        </div>

        <div class="checkbox mb-3">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit" name="login">Login</button>
        <p class="mt-5 mb-3 text-muted"> Copyright &copy; Ardhi da Silva <?= date('Y') ?></p>
    </form>
  </main>



</body>

</html>