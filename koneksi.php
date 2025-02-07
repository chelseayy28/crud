<?php 
global $koneksi;

$servername = "localhost";
$username   = "root";
$password   = "";
$namadb     = "newcrud";
$koneksi  = mysqli_connect($servername, $username, $password, $namadb);

if (!$koneksi) {
    die("koneksi gagal". mysqli_connect_error());
}

?>