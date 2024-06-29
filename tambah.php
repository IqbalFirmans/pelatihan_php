<?php 
require_once __DIR__ . "/navbar.php";

if(isset($_POST['submit'])) {
    
    $input =['judul' , 'konten'];

    $ext =['jpg', 'png', 'jpeg', 'webp'];

    $cond = true;
    foreach($input as $value) {
        if (empty($_POST[$value])) {
            $cond = false;
            echo '<script>alert(" ' . $value . '  harus diisi")</script>';
            break;
        }
    }

    $judul = htmlentities($_POST['judul']);
    $konten = htmlentities($_POST['konten']);


    if ($cond) { 
        if (!empty($_FILES['foto'])) {
        
            // nama file yang di upload
            // time unik, agar nama tidak sama
            $foto = time() . $_FILES['foto']['name'];
            
            // temporary file dari windows
            // nantinya akan diarahkan ke foder images
            $path = $_FILES['foto']['tmp_name'];
    
            $explode = explode(".", $foto);
    
            if (in_array(strtolower($explode[1]), $ext)) {
                move_uploaded_file($path, "./images/" . $foto);
                
                $query = mysqli_query($koneksi, "INSERT INTO postingan VALUES (null, '$judul', '$konten', '$foto')");
        
                echo '<script>alert("Berhasil Tambah Postingan") </script>';
                echo '<script>window.location.href="postingan.php" </script>';
            } else {
                echo '<script>alert("Ekstensi tidak valid") </script>';
                echo '<script>window.location.href="postingan.php" </script>';
            }
        
        }
    }
}
?>    

<div class="container mt-4">
    <h1>Tambah Data Postingan</h1>
    <form action="" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" class="form-control" name="judul" placeholder="Masukkan Judul">
            </div>
            <div class="mb-3">
                <label class="form-label">Konten</label>
                <textarea class="form-control" rows="3" name="konten" placeholder="Masukkan Konten"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Foto Postingan</label>
                <input class="form-control" type="file"  name="foto" >
            </div>
            <button class="btn btn-primary col-md-2" type="submit" name="submit">
                Tambah Postingan
            </button>
        </div>
    </form>
</div>

<?php 
require_once __DIR__ . "/footer.php" 
?>    
