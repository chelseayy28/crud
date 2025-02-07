<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/branda.css">
    <title>Beranda</title>
    <style>
        .logoaja {
            margin-left: 50px;
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
       
    </nav>

    <!--sidebar-->
    <nav class="sidebar">
        <ul>
            <li>
                <a href="tampil_pengguna.php">
                    <i class="fas fa-align-justify"></i>
                    <span class="nav-item">Inventaris</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-search"></i>
                    <span class="nav-item">search</span>
                </a>
            </li>
            <li>
                <a href="form.php">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="nav-item">troli</span>
                </a>
            </li>
            <li>
                <a href="logout.php" class="logout">
                    <i class="fas fa-sign-out"></i>
                    <span class="nav-item">Log Out</span>
                </a>
            </li>
        </ul>
    </nav>
    <div class="container">
        <h1>Happy Shopping!!</h1>
        <div class="product-list">
            <div class="product-list-2">
                
            </div>
        </div>
    </div>
</body>
</html>