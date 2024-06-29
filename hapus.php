<?php 
require_once __DIR__ . "/koneksi.php"; 


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $cari = mysqli_query($koneksi, "SELECT * FROM postingan WHERE id = '$id'");
    $array = mysqli_fetch_array($cari);

    $foto_lama = $array['foto'];

    unlink("images/" . $foto_lama);

    $query = mysqli_query($koneksi, "DELETE FROM postingan WHERE id = '$id' ");

    echo '<script>alert("Berhasil Hapus Postingan") </script>';
    echo '<script>window.location.href="postingan.php" </script>';
     
}
?>   