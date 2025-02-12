<?php
include '../koneksi.php';
$query = "SELECT * FROM pelanggan";
$sql = mysqli_query($koneksi, $query);
$no = 0;

  // Export to Word functionality
  if (isset($_GET['export']) && $_GET['export'] === 'word') {

    // Memberitahu browser bahwa konten adalah file Word
    // Mengatur nama file yang akan didownload dengan format "data_user_[tanggal&waktu].doc"
    header("Content-Type: application/vnd.ms-word");
    header("Content-Disposition: attachment; filename=crud" . date('Ymd_His') . ".doc");

    // Membuat struktur HTML yang akan dikonversi menjadi dokumen Word
    echo "<html>";
    echo "<head>";
    echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
    echo "<title>Data User</title>";
    echo "</head>";
    echo "<body>";

    // Membuat judul dokumen
    // Membuat tabel dengan border
    // Mendefinisikan header kolom tabel
    echo "<h2>Data barang</h2>";
    echo "<table border='1'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>No</th>";
    echo "<th>id_pelanggan</th>";
    echo "<th>nama_barang</th>";
    echo "<th>merk_barang</th>";
    echo "<th>jumlah_barang</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    // Mengambil data dari database
    $no = 1;
    $result = mysqli_query($koneksi, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $no++ . "</td>";
        echo "<td>" . htmlspecialchars($row['id_pelanggan']) . "</td>";
        echo "<td>" . htmlspecialchars($row['nama_barang']) . "</td>";
        echo "<td>" . htmlspecialchars($row['merk_barang']) . "</td>";
        echo "<td>" . htmlspecialchars($row['jumlah_barang']) . "</td>";
        echo "</tr>";
    }

    // Menutup semua tag HTML
    echo "</tbody>";
    echo "</table>";
    echo "</body>";
    echo "</html>";

    exit;
  }
?>
  <!DOCTYPE html>
<html>
<head>
    <title>tampilan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head>
<body>
  <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <div class="container"> 
            <form action="pengguna.php" method="GET">
              <input type="text" name="cari">
              <input type="submit" value="Cari" class="btn btn-primary">
            </form>
        </div>
    </nav>

    <div class="container">
    <h1>Data Barang</h1>

    <table border="1" class="table table-striped table-hover">
        <tr>
            <td>ID</td>
            <td>Nama Barang</td>
            <td>Merk Barang</td>
            <td>Jumlah Barang</td>
            <td>Aksi</td>
        </tr>
        <a href="../export_data.php" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                    <i class="fas fa-download fa-sm text-white-50"></i> Export ke Excel
                </a>
        <a href="?export=word" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                    <i class="fas fa-download fa-sm text-white-50"></i> Export ke word
                </a>
        <?php
        include '../koneksi.php';
        if(isset($_GET['cari'])){
          $cari = $_GET['cari'];
          $query = mysqli_query($koneksi,"SELECT * FROM pelanggan WHERE nama_barang like '%".$cari."%'");                
        }else{
          $query = mysqli_query($koneksi,"SELECT * FROM pelanggan");        
        }
            while ($hasil = mysqli_fetch_array($query)){
                $id_pelanggan = $hasil['id_pelanggan'];
                ?>
 
        <tr>
            <td><?php echo $hasil['id_pelanggan']; ?></td>
            <td><?php echo $hasil['nama_barang']; ?></td>
            <td><?php echo $hasil['merk_barang']; ?></td>
            <td><?php echo $hasil['jumlah_barang']; ?></td>
            <td>
                <a href="../update.php?id_pelanggan=<?php echo $id_pelanggan; ?>" type="button" class="btn btn-success btn-sm">Edit</a>                                                  
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal_<?php echo $id_pelanggan; ?>">
                    Hapus
                </button>

                <!-- Modal -->
                <div class="modal fade" id="deleteModal_<?php echo $id_pelanggan; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Menghapus Data</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus data ini?
                            </div>
                            <div class="modal-footer">                          
                                <a href="../delete.php?id_pelanggan=<?php echo $id_pelanggan; ?>" class="btn btn-danger">Hapus</a>
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tidak</button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <?php } ?>
    </table>
    <a href="../tambah.php" class="btn btn-secondary">Tambah Data</a>
    </div>
</div>

</body>
<script>
    let sidebar = document.querySelector(".sidebar");
    let closeBtn = document.querySelector("#btn");
    let searchBtn = document.querySelector(".bx-search");
    closeBtn.addEventListener("click", ()=> {
        sidebar.classList.toggle("open");
        menuBtnChange(); //calling the function(optional)
    });
    searchBtn.addEventListener("click", ()=>{ // Sidebar open when you click on the search icon
        sidebar.classList.toggle("open");
        menuBtnChange(); //calling the function(optional)
    });
    // following are the code to change sidebar button(optional)
    function menuBtnChange() {
     if(sidebar.classList.contains("open")){
         closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the icons class
     }else {
         closeBtn.classList.replace("bx-menu-alt-right","bx-menu");//replacing the icons class
     }
    }
</script>
</html>
