    <?php
    require_once __DIR__ . "/navbar.php";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = mysqli_query($koneksi, "SELECT * FROM postingan WHERE id = '$id' ");
        $row = mysqli_fetch_array($query);

        $foto_lama = $row['foto'];
    }

    if (isset($_POST['submit'])) {

        $input = ['judul', 'konten'];

        $ext = ['jpg', 'png', 'jpeg'];

        $cond = true;

        foreach ($input as $value) {
            if (empty($_POST[$value])) {
                $cond = false;
                echo '<script>alert(" ' . $value . '  harus diisi")</script>';
                break;
            }
        }

        $judul = htmlentities($_POST['judul']);
        $konten = htmlentities($_POST['konten']);

        if ($cond) {
            // kondisi ketika ada foto upload
            if (!empty($_FILES['foto']['name'])) {

                // nama file yang di upload
                // time unik, agar nama tidak sama
                $foto = time() . $_FILES['foto']['name'];

                // temporary file dari windows
                // nantinya akan diarahkan ke foder images
                $path = $_FILES['foto']['tmp_name'];

                $explode = explode(".", $foto);

                if (in_array(strtolower($explode[1]), $ext)) {
                    unlink("images/" . $foto_lama);
                    move_uploaded_file($path, "./images/" . $foto);

                    $query = mysqli_query($koneksi, "UPDATE postingan SET judul = '$judul', konten = '$konten', foto = '$foto' WHERE id = '$id'");

                    echo '<script>alert("Berhasil update Postingan") </script>';
                    echo '<script>window.location.href="postingan.php" </script>';
                } else {
                    echo '<script>alert("Ekstensi tidak valid") </script>';
                    echo '<script>window.location.href="postingan.php" </script>';
                }
            } else {
                $query = mysqli_query($koneksi, "UPDATE postingan SET judul = '$judul', konten = '$konten' WHERE id = '$id'");

                echo '<script>alert("Berhasil Edit Postingan") </script>';
                echo '<script>window.location.href="postingan.php" </script>';
            }
        }
    }
    ?>

    <div class="container mt-4">
        <h1>Edit Data Postingan</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" class="form-control" name="judul" placeholder="Masukkan Judul" value="<?= $row['judul'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Konten</label>
                    <textarea class="form-control" rows="3" name="konten" placeholder="Masukkan Konten"><?= $row['konten'] ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Foto Postingan</label>
                    <input class="form-control" type="file" name="foto">
                </div>
                <div class="mb3">
                    <img width="20%" height="100px" src="images/<?= $row['foto'] ?>">
                </div>
                <button class="btn btn-success col-md-2 mt-3" type="submit" name="submit">
                    Edit Postingan
                </button>
            </div>
        </form>
    </div>

    <?php
    require_once __DIR__ . "/footer.php"
    ?>