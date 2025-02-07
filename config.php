 <?php
// config.php
require_once 'vendor/autoload.php'; // Mengimpor library Google Client dari composer

function getClient()
{
    $client = new Google_Client();  // ID Client dari Google Console
    $client->setClientId('567821041304-ua67rvgvvfos0mr9r2akk9o2r7a5u0da.apps.googleusercontent.com'); //  Client ID Google Console
    $client->setClientSecret('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'); // Client Secret Kamu
    $client->setRedirectUri('http://localhost/crud/callback.php'); // URL Callback setelah login
    $client->addScope("email"); // Meminta akses ke email pengguna
    $client->addScope("profile"); // Meminta akses ke profil pengguna
    
    return $client;
}
?>