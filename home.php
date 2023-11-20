<?php

// Memulai atau melanjutkan sesi
session_start();
// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika tidak, redirect ke halaman login
    header("Location: index.php");
    exit();
}
// Fungsi logout
/* if (isset($_GET['logout'])) {
    // Hapus semua data sesi
    session_unset();

    // Hancurkan sesi
    session_destroy();

    // Redirect ke halaman login atau halaman lain yang sesuai
    header("Location: index.php");
    exit();
} */

include("koneksi.php");

// Konfigurasi Pagination
$jumlah_data_per_halaman = 10; // Ubah sesuai kebutuhan
$halaman_aktif = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
$offset = ($halaman_aktif - 1) * $jumlah_data_per_halaman;

// Proses pencarian & query pencarian
$keyword = isset($_POST['judul']) ? $_POST['judul'] : '';
$where_clause = $keyword ? "WHERE cerita.judul LIKE '%$keyword%'" : '';

// Buat query untuk mengambil data cerita dengan pagination dan pencarian
$query = "SELECT cerita.idcerita, cerita.judul, users.nama as pembuat 
          FROM cerita 
          LEFT JOIN users ON cerita.idusers_pembuat_awal = users.idusers
          $where_clause
          LIMIT $offset, $jumlah_data_per_halaman";
// Eksekusi query
$result = mysqli_query($conn, $query);

// Periksa apakah query dieksekusi dengan sukses
if (!$result) {
    die("Query gagal dieksekusi: " . mysqli_error($conn));
}

// Inisialisasi variabel untuk menampung hasil HTML
$tableRows = '';

// Periksa apakah ada baris data yang dikembalikan
if (mysqli_num_rows($result) > 0) {
    // Looping untuk menampilkan daftar cerita
    while ($row = mysqli_fetch_assoc($result)) {
        // Tambahkan baris HTML untuk setiap cerita
        $tableRows .= "<tr>";
        $tableRows .= "<td>" . $row['judul'] . "</td>";
        $tableRows .= "<td>" . $row['pembuat'] . "</td>";
        $tableRows .= "<td><a href='lihat-cerita.php?id=" . $row['idcerita'] . "'>Lihat</a></td>";
        $tableRows .= "</tr>";
    }
} else {
    $tableRows = "<tr><td colspan='3'>Tidak ada data cerita yang ditemukan.</td></tr>";
}

// Hitung jumlah halaman
$query_count = "SELECT COUNT(*) as total FROM cerita $where_clause";
$result_count = mysqli_query($conn, $query_count);
$row_count = mysqli_fetch_assoc($result_count);
$total_data = $row_count['total'];
$jumlah_halaman = ceil($total_data / $jumlah_data_per_halaman);

// Tutup koneksi ke database
mysqli_close($conn);
?>

<!-- Style untuk tabel -->
<style>
  table {
    border-collapse: collapse;
    width: 100%;
  }
  th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
  }
</style>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Home</title>
</head>
<body>
  <h1>Halaman Home</h1>

  <div class="cari">
    <form action="home.php" method="post">
      <input type="text" name="judul" placeholder="Cari Judul">
      <button type="submit">Cari</button>
    </form>
  </div>

  <a href="add-cerita.php">Buat Cerita Baru</a>

  <table>
    <thead>
      <tr>
        <th>Judul</th>
        <th>Pembuat</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php echo $tableRows; ?>
    </tbody>
  </table>
  <div class="pagination">
    <?php for ($i = 1; $i <= $jumlah_halaman; $i++) : ?>
      <a href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>
  </div>
  <p><a href="logout.php">Logout</a></p>

</body>
</html>
