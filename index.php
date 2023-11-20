<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>Halaman Login</h1>
  </header>
  <main>
    <form action="index.php" method="post">
      <input type="text" id="username" name="username" placeholder="Username">
      <input type="password" id="password" name="password" placeholder="Password">
      <input type="submit">
    </form>
  </main>
  <a href="registrasi.php">Buat Akun Baru</a>
  <footer>
    &copy; 2023
  </footer>
</body>
</html>


<?php
include("koneksi.php");
session_start();
// Cek apakah pengguna sudah login, jika ya, redirect ke home.php
if (isset($_SESSION['username'])) {
    header("Location: home.php");
    exit();
}
// Periksa apakah form dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Deklarasi variabel
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Cek apakah pengguna memiliki akun
  $query = "SELECT * FROM users WHERE nama='$username' AND password='$password'";
  $result = mysqli_query($conn, $query);
  // Periksa apakah data user ditemukan
  $user = mysqli_fetch_assoc($result);
  if ($user) {
      $idusers = $user['idusers'];
  } else {
      echo "User tidak ditemukan.";
  }
  // Jika pengguna memiliki akun, tampilkan halaman utama
  if (mysqli_num_rows($result) > 0) {

    $_SESSION['username'] = $username;
    $_SESSION['idusers']=$idusers;
     // Login berhasil, set session dan redirect ke home.php
     header("Location: home.php");
     exit();
  } else {
    // Tampilkan pesan kesalahan
    echo "Username atau kata sandi salah.";
  }
}
?>

