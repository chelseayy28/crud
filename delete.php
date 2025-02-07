<?php

include 'koneksi.php';
$id = $_GET['id_pelanggan']; {
    $query = "DELETE FROM pelanggan WHERE id_pelanggan = '$id'";
    mysqli_query($koneksi, $query);
    header("Location:admin/pengguna.php");
}
?>