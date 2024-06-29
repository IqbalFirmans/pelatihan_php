
<?php 
require_once __DIR__ . "/navbar.php";

// * -> all
$query = mysqli_query($koneksi, "SELECT * FROM postingan");

if(isset($_GET['cari'])) {
    $cari = $_GET['cari'];

    $cari = mysqli_real_escape_string($koneksi, $_GET['cari']);
    $query = mysqli_query($koneksi, "SELECT * FROM postingan WHERE judul LIKE '%$cari%' ");
}
?>

<div class="container">
    <h1 class="mt-5">Halaman List Postingan</h1>

    <div class="row mt-4">
        <div class="col-lg-8">
            <form class="d-flex gap-2" action="" method="GET">
                <input class="form-control" type="text" name="cari" placeholder="Masukkan judul...">
                <button class="btn btn-success d-flex">Cari <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24"><path fill="currentColor" d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5A6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5S14 7.01 14 9.5S11.99 14 9.5 14z"/></svg></button>
            </form>
        </div>
    </div>                                                             

    <div class="row mt-4">
        <div class="col-md3">
            <a href="tambah.php" class="btn btn-primary">Tambah Data</a>
        </div>
    </div>

    <div class="row mt-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Konten</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $id = 1; 
                    while ($row = mysqli_fetch_array($query)) {
                ?>
                
                <tr>
                    <td><?= $id ?></td>
                    <td><?= $row['judul'] ?></td>
                    <td><?= $row['konten'] ?></td>
                    <td>
                        <img width="50%" height="120px" src="images/<?= $row['foto'] ?>">
                    </td>
                    <td>
                        <a href="edit.php?id=<?= $row['id'] ?>" >
                        <button type="button" class="btn btn-success">Edit<svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24"><path fill="currentColor" d="m14.06 9.02l.92.92L5.92 19H5v-.92l9.06-9.06M17.66 3c-.25 0-.51.1-.7.29l-1.83 1.83l3.75 3.75l1.83-1.83a.996.996 0 0 0 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29zm-3.6 3.19L3 17.25V21h3.75L17.81 9.94l-3.75-3.75z"/></svg></button></a>

                        <a href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Apakah Anda ingin menghapus data ini?')" >
                        <button type="button" class="btn btn-danger">Delete<svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24"><path fill="currentColor" d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM8 9h8v10H8V9zm7.5-5l-1-1h-5l-1 1H5v2h14V4z"/></svg></button></a>
                    </td>
                </tr>

                <?php
                     $id++; 
                    }
                ?>

            </tbody>
        </table>
    </div>
    
</div>

<?php 
require_once __DIR__ . "/footer.php"
?>    