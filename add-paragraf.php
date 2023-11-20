<?php
include("koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cerita = $_POST['id_cerita'];
    $isi_paragraf = $_POST['isi_paragraf'];

    // Lakukan operasi INSERT pada tabel paragraf
    $query_tambah_paragraf = "INSERT INTO paragraf (idusers, idcerita, isi_paragraf, tanggal_buat) VALUES ('" . $_SESSION['idusers'] . "', '$id_cerita', '$isi_paragraf', NOW())";
    $result_tambah_paragraf = mysqli_query($conn, $query_tambah_paragraf);

    // Periksa apakah operasi INSERT berhasil
    if ($result_tambah_paragraf) {
        // Redirect kembali ke halaman lihat-cerita
        header("Location: lihat-cerita.php?id=$id_cerita");
        exit();
    } else {
        echo "Gagal menambahkan paragraf: " . mysqli_error($conn);
    }
}

// Tutup koneksi ke database
mysqli_close($conn);
?>
