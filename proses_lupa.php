<?php
session_start();
include 'koneksi.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    
    if ($email) {
        // Generate token unik
        $token = bin2hex(random_bytes(50));
        
        // Simpan token di database (pastikan Anda memiliki koneksi database yang benar)
        $query = "UPDATE login SET reset_token = ?, reset_token_expiry = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $token, $email);
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'cvabellya@gmail.com';
                $mail->Password   = 'naku llxd wzgt ogny';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                $mail->setFrom('cvabellya@gmail.com', 'crud');
                $mail->addAddress($email);
                $mail->Subject = "Reset Password";
                $mail->Body    = "Klik link berikut untuk mereset password Anda: http://localhost/crud/reset.php?token=$token";

                $mail->send();
                $message = "Email verifikasi telah dikirim. Silakan cek inbox Anda.";
            } catch (Exception $e) {
                $message = "Gagal mengirim email. Error: {$mail->ErrorInfo}";
            }
        } else {
            $message = "Email tidak ditemukan dalam database.";
        }
    } else {
        $message = "Email tidak valid.";}
}

?>
