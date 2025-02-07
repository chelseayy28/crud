<?php
session_start();
require_once 'config.php';

$client = getClient();
$authUrl = $client->createAuthUrl(); 
header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
exit(); // Pastikan untuk menghentikan eksekusi skrip setelah melakukan redirect
?>