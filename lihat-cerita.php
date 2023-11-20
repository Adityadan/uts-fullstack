<?php
include("koneksi.php");

// Periksa apakah ID cerita diberikan melalui parameter URL
if (isset($_GET['id'])) {
    $id_cerita = $_GET['id'];

    // Ambil data cerita dari database
    $query_cerita = "SELECT * FROM cerita WHERE idcerita = $id_cerita";
    $result_cerita = mysqli_query($conn, $query_cerita);

    // Periksa apakah cerita ditemukan
    if ($result_cerita && mysqli_num_rows($result_cerita) > 0) {
        $cerita = mysqli_fetch_assoc($result_cerita);
        $judul_cerita = $cerita['judul'];

        // Ambil paragraf cerita dari database
        $query_paragraf = "SELECT * FROM paragraf WHERE idcerita = $id_cerita";
        $result_paragraf = mysqli_query($conn, $query_paragraf);

        // Tampilkan judul cerita
        echo '<div style="text-align: -webkit-center;">';
        echo '<div style="width: 500px;">';
        echo "<h1>$judul_cerita</h1>";
        // Tampilkan isi cerita (paragraf)
        while ($paragraf = mysqli_fetch_assoc($result_paragraf)) {
            echo "<p style='text-align: start;'>{$paragraf['isi_paragraf']}</p>";
        }
        echo "</div>";

        // Form untuk menambahkan paragraf baru
        echo "
        <div style='width: 500px;'>
            <form action='add-paragraf.php' method='post'>
                <input type='hidden' name='id_cerita' value='$id_cerita'>
                <div>
                    <textarea name='isi_paragraf' rows='4' placeholder='Tambahkan paragraf baru'></textarea>
                </div>
                <button type='submit'>Simpan</button>
            </form>
        </div>";
        echo '</div>';
    } else {
        echo "Cerita tidak ditemukan.";
    }
} else {
    echo "ID cerita tidak valid.";
}

// Tutup koneksi ke database
mysqli_close($conn);
