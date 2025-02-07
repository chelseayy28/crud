<?php
// callback.php
session_start();
require_once 'config.php';
require_once 'koneksi.php';

$client = getClient();

if (isset($_GET['code'])) { // Cek apakah ada code dari Google
    // Menukar kode otorisasi dengan token akses
    try {
        //Tukar code dengan access token
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token);

        // Mengambil informasi pengguna
        $google_oauth = new Google_Service_Oauth2($client);

        // Pakai token untuk ambil data user
        $google_account_info = $google_oauth->userinfo->get();
        
        $email = mysqli_real_escape_string($conn, $google_account_info->email);
        $name = mysqli_real_escape_string($conn, $google_account_info->name);
        
        // Generate username dari name Google 
        $nameParts = explode(' ', $name);
        $username = strtolower($nameParts[0]); // Ambil nama depan dan ubah ke lowercase

        // Check if user exists by email
        $sql = mysqli_query($conn, "SELECT * FROM login WHERE email='$email'");
        
        if (mysqli_num_rows($sql) > 0) {
            // User exists
            $user = mysqli_fetch_assoc($sql);
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $email;
            header('Location: success.php');
        } else {
            // Create new user
            $random_password = bin2hex(random_bytes(8)); // Generate random password
            
            $sql = "INSERT INTO login (username, email, password) 
                    VALUES ('$username', '$email', '$random_password')";
            
            if (mysqli_query($conn, $sql)) {
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                header('Location: success.php');
            } else {
                die("Error creating user: " . mysqli_error($conn));
            }
        }
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}