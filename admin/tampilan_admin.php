<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/sidebar.css">
    <title>Beranda</title>
    <style>
        img {
            margin-left: 20px;
        }
    </style>
</head>
<body>
    <?php
    session_start();

    // cek apakah yang mengakses halaman ini sudah login
    if($_SESSION['level']==""){
    header("location:login.php?pesan=gagal");
    }

    ?>

    <!--navbar-->
    <nav class="navbar">
      
        </div>
    </nav>

    <!--sidebar-->
    <nav class="sidebar">
        <ul>
            <li>
                <a href="tampilan_admin.php">
                    <i class="fas fa-align-justify"></i>
                    <span class="nav-item">INVENTARIS</span>
                </a>
            </li>
            <li>
                <a href="pengguna.php" class="icon">
                    <i class="fas fa-user"></i>
                    <span class="nav-item">Data Barang</span>
                </a>
            </li>
            <li>
                <a href="#" class="icon">
                    <i class="fas fa-book-open"></i>
                    <span class="nav-item">Data Pengeluaran</span>
                </a>
            </li>
            <li>
                <a href="../logout.php" class="logout">
                    <i class="fas fa-sign-out"></i>
                    <span class="nav-item">Log Out</span>
                </a>
            </li>
        </ul>
    </nav>
</body>
</html>