
<?php
/*include 'koneksi.php';
$_POST['submit'] == "edit"; {
    $id_pelanggan = $_POST['id_pelanggan'];
    $nama_barang = $_POST['nama_barang'];
    $merk_barang = $_POST['merk_barang'];
    $jumlah_barang = $_POST['jumlah_barang'];

    $query = mysqli_query($koneksi,"SELECT * FROM pelanggan WHERE id_pelanggan='$id'");
    $sql = mysqli_query($koneksi, $query);
    $hasil = mysqli_fetch_assoc($query);

    $query = mysqli_query($koneksi,"UPDATE pelanggan SET nama_barang='$nama_barang', merk_barang='$merk_barang', jumlah_barang='$jumlah_barang' WHERE id_pelanggan='$id_pelanggan'");
    $sql = mysqli_query($koneksi, $query);
    header("location:pengguna.php");
} 
?>
*/

include 'koneksi.php';
    $query = mysqli_query($koneksi, "UPDATE pelanggan set 
    id_pelanggan= '$_POST[id_pelanggan]',
    nama_barang= '$_POST[nama_barang]',
    merk_barang = '$_POST[merk_barang]',
    jumlah_barang = '$_POST[jumlah_barang]'
    where id_pelanggan = '$_POST[id_pelanggan]'") or die(mysqli_error($koneksi));
    header("location:admin/pengguna.php");
?>