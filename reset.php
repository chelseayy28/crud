<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['token'])) {
    $token = $_GET['token'];
    
    
    // Cek apakah token valid dan belum expired
    $query = "SELECT * FROM inventaris WHERE reset_token = ? AND reset_token_expiry > NOW()";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 0) {
        die("Token tidak valid atau sudah expired.");
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    if ($password !== $confirm_password) {
        die("Password tidak cocok.");
    }

    
    // Update password 
    $query = "UPDATE login SET password = ?, reset_token = NULL, reset_token_expiry = NULL WHERE reset_token = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $password, $token);
    
    if ($stmt->execute()) {
        echo "Password berhasil direset. Silakan <a href='login.php'>login</a> dengan password baru Anda.";
    } else {
        echo "Gagal mereset password.";
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #1a73e8;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .header p {
            color: #666;
            font-size: 14px;
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #1a73e8;
        }

        .password-requirements {
            margin-top: 5px;
            font-size: 12px;
            color: #666;
        }

        .password-requirements ul {
            list-style: none;
            margin-top: 5px;
            padding-left: 5px;
        }

        .password-requirements li {
            margin-bottom: 3px;
            display: flex;
            align-items: center;
        }

        .password-requirements li::before {
            content: "•";
            color: #666;
            margin-right: 5px;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color:rgb(85, 173, 255);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background-color:rgb(0, 119, 255);
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color:rgb(212, 227, 0);
            text-decoration: none;
            font-size: 14px;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Reset Password</h1>
            <form method="post">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
    </form>
            <p>Silakan masukkan password baru Anda</p>
        </div>
        <form>
            <div class="form-group">
                <label for="password">Password Baru</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="Masukkan password baru"
                    required>
            </div>
            <div class="form-group">
                <label for="confirm-password">Konfirmasi Password Baru</label>
                <input 
                    type="password" 
                    id="confirm-password" 
                    name="confirm-password" 
                    placeholder="Masukkan ulang password baru"
                    required>
            </div>
            <button type="submit" class="submit-btn">Reset Password</button>
        </form>
    </div>
</body>
</html>