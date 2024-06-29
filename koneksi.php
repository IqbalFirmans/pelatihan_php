<?php 

$server = "localhost"; //Ganti dengan host database anda
$username = "root";    //Ganti dengan usernam serve anda
$password = "";        //Ganti dengan password server anda
$database = "pelatihan_php"; //Ganti dengan nama database anda

$koneksi = mysqli_connect($server, $username, $password, $database);

if ($koneksi) {
    //echo "Koneksi Berhasil";
}