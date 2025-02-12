<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Update</title>
        <link rel="stylesheet" href="style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body>
    <?php

    include "koneksi.php";
    $id = $_GET['id_pelanggan']; 
    $query = mysqli_query($koneksi,"SELECT * FROM pelanggan WHERE id_pelanggan='$id'");
    while ($hasil = mysqli_fetch_array($query)){
    ?>
    <div class="container-fluid">
        <h1 class="judul">Form</h1>
        <form action="proses_update.php" method="POST">

        <input type="hidden" name="id_pelanggan" value="<?php echo $hasil['id_pelanggan']; ?>">
            <label for="nama_barang">Nama Barang:</label>
            <input type="text" name="nama_barang" value="<?php echo $hasil['nama_barang']; ?>" id="nama_barang" > <br>

            <label for="merk_barang">Merk Barang:</label>
            <input type="text" name="merk_barang" value="<?php echo $hasil['merk_barang']; ?>" id="merk_barang" > <br>

            <label for="jumlah_barang">Jumlah Barang:</label>
            <input type="number" name="jumlah_barang" value="<?php echo $hasil['jumlah_barang']; ?>" id="jumlah_barang" > <br>

            <input type="submit" value="edit">
    </div>
    </form>
    <?php } ?>
        
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>