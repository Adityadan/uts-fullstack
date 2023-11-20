<?php
session_start();

include("koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Ambil data dari formulir
  $judul = $_POST['judul'];
  $paragraf = $_POST['paragraf'];
  $idusers = $_SESSION['idusers'];
  // Lakukan operasi INSERT pada tabel cerita
  $query1 = "INSERT INTO cerita (judul, idusers_pembuat_awal) VALUES ('$judul', '$idusers')";
  // Eksekusi query
  $result = mysqli_query($conn, $query1);
  // Ambil ID yang baru saja di-generate oleh operasi INSERT pada tabel1
  $id_cerita = mysqli_insert_id($conn);

  // Lakukan operasi INSERT pada tabel paragraf
  $query2 = "INSERT INTO paragraf (idusers, idcerita, isi_paragraf, tanggal_buat) VALUES ('" . $_SESSION['idusers'] . "', '" . $id_cerita . "', '" . $paragraf . "', NOW())";
  mysqli_query($conn, $query2);

  // Periksa apakah query dieksekusi dengan sukses
  if ($result) {
    echo "Cerita berhasil ditambahkan.";
  } else {
    echo "Gagal menambahkan cerita: " . mysqli_error($conn);
  }
}
// echo $_SESSION['idusers'];

// Tutup koneksi ke database
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Cerita</title>
</head>

<body>
  <h1>Tambah Cerita</h1>
  <form action="add-cerita.php" method="POST">
    <div>
      <label for="judul">Judul:</label>
      <input type="text" id="judul" name="judul" required>
    </div>
    <div style="margin-top: 2%;">
      <label for="cerita">paragraf:</label>
      <textarea id="paragraf" name="paragraf" rows="4" required></textarea>
    </div>
    <div style="margin-top: 2%;">
      <button type="submit">Tambah Cerita</button>
    </div>
  </form>
</body>

</html>