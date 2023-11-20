<?php
include("koneksi.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cerita = $_POST['id_cerita'];
    $isi_paragraf = $_POST['isi_paragraf'];

    // Gunakan pernyataan bersiap-siap untuk memasukkan data dengan aman
    $query_tambah_paragraf = "INSERT INTO paragraf (idusers, idcerita, isi_paragraf, tanggal_buat) VALUES (?, ?, ?, NOW())";
    
    // Persiapkan pernyataan
    $stmt = mysqli_prepare($conn, $query_tambah_paragraf);
    
    // Ikatan parameter
    mysqli_stmt_bind_param($stmt, "iss", $_SESSION['idusers'], $id_cerita, $isi_paragraf);
    
    // Jalankan pernyataan
    $result_tambah_paragraf = mysqli_stmt_execute($stmt);

    // Periksa apakah eksekusi berhasil
    if ($result_tambah_paragraf) {
        // Redirect kembali ke halaman lihat-cerita
        header("Location: lihat-cerita.php?id=$id_cerita");
        exit();
    } else {
        echo "Gagal menambahkan paragraf: " . mysqli_stmt_error($stmt);
    }

    // Tutup pernyataan
    mysqli_stmt_close($stmt);
}

// Tutup koneksi database
mysqli_close($conn);
?>
