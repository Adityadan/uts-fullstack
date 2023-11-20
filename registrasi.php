<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Registrasi</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>Halaman Registrasi</h1>
  </header>
  <main>
    <form action="registrasi.php" method="post">
      <input type="text" id="username" name="username" placeholder="Username">
      <input type="password" id="password" name="password" placeholder="Password">
      <input type="password" id="confirm_password" name="confirm_password" placeholder="Konfirmasi Password">
      <input type="submit" value="Registrasi">
    </form>
  </main>
  <footer>
    &copy; 2023
  </footer>
</body>
</html>


<?php
include("koneksi.php");
// Deklarasi variabel
$options = ['cost' => 12]; // Cost adalah faktor yang menentukan seberapa lama proses hashing akan memakan waktu
$salt = password_hash(uniqid(mt_rand(), true), PASSWORD_DEFAULT, $options);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $hashed_password = password_hash($password . $salt, PASSWORD_DEFAULT, $options);
  $confirm_password = $_POST['confirm_password'];
  /* var_dump($username);
  var_dump($password);
  var_dump($confirm_password); */
  // Cek apakah kata sandi sama
  if ($password != $confirm_password) {
    // Kata sandi tidak sama
    echo "Kata sandi tidak sama.";
    exit;
  }
  
  // Tambahkan pengguna ke database
  $query = "INSERT INTO users (nama, password,salt) VALUES ('$username', '$password','$hashed_password')";
  echo $query;
  mysqli_query($conn, $query);
}

// Arahkan pengguna ke halaman utama
header("Location: index.php");

?>
