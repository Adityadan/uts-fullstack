<?php

// Deklarasi variabel
$host = "localhost";
$user = "root";
$password = "";
$database = "uts_fullstack";

// Buat koneksi ke database
$conn = mysqli_connect($host, $user, $password, $database);

// Periksa koneksi
if (!$conn) {
  die("Koneksi ke database gagal: " . mysqli_connect_error());
}
