<?php
// callback.php
session_start();
require_once 'config.php';
require_once 'koneksi.php';

$client = getClient();

if (isset($_GET['code'])) { // Cek apakah ada code dari Google
    try {
        // Tukar code dengan access token
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

        // Debugging: Tampilkan token yang diterima
        if (isset($token['error'])) {
            die('Error fetching token: ' . $token['error']);
        }

        // Set token ke client
        $client->setAccessToken($token);

        // Periksa apakah token valid
        if ($client->isAccessTokenExpired()) {
            die('Error: Token sudah kedaluwarsa');
        }

        // Mengambil informasi pengguna
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();

        // Debugging: Tampilkan informasi pengguna
        // var_dump($google_account_info);

        $email = mysqli_real_escape_string($koneksi, $google_account_info->email);
        $name = mysqli_real_escape_string($koneksi, $google_account_info->name);
        
        // Generate username dari name Google
        $nameParts = explode(' ', $name);
        $username = strtolower($nameParts[0]); // Ambil nama depan dan ubah ke lowercase

        // Cek apakah pengguna sudah ada di database
        $sql = mysqli_query($koneksi, "SELECT * FROM inventaris WHERE email='$email'");
        
        if (mysqli_num_rows($sql) > 0) {
            // Pengguna sudah ada
            $user = mysqli_fetch_assoc($sql);
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $email;
            header('Location: pengguna.php');
        } else {
            // Buat pengguna baru
            $random_password = bin2hex(random_bytes(8)); // Generate password acak
            
            $sql = "INSERT INTO login (username, email, password) 
                    VALUES ('$username', '$email', '$random_password')";
            
            if (mysqli_query($conn, $sql)) {
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                header('Location: pengguna.php');
            } else {
                die("Error creating user: " . mysqli_error($koneksi));
            }
        }
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}
?>
