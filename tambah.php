<?php
include("koneksi.php");
if(isset($_POST["submit"])) {
    $id_pelanggan = $_POST["id_pelanggan"];
    $nama_barang = $_POST["nama_barang"];
    $merk_barang = $_POST["merk_barang"];
    $jumlah_barang = $_POST["jumlah_barang"];
        $query = "INSERT INTO pelanggan VALUES ('','$nama_barang', '$merk_barang','$jumlah_barang')";
        mysqli_query($koneksi, $query);
        header ("location:admin/pengguna.php");
}


?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Belajar form</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body>
    <center><h1 class="judul">Form</h1></center>
    <div class="container-fluid">
        <form action="tambah.php" method="post">
            <label for="nama_barang">Nama Barang</label>
            <div class="user-box">
                <input type="text" name="nama_barang" id="nama_barang" required value="">
            </div>
            <label for="merk_barang">Merk Barang</label>
            <div class="user-box">
                <input type="text" name="merk_barang" id="merk_barang" required value="">
            </div>
            <br>
            <label for="jumlah_barang">Jumlah Barang</label>
            <div class="user-box">    
                <input type="number" name="jumlah_barang" id="jumlah_barang" required value="">   
            </div>

            <center><input type="submit" name="submit" class="tombol_login"></center>
        </form>
    </div>        
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>