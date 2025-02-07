<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
</head>
<body>
    
    <!--login-->
        <div class="login-box">
            <h1><center>Login</center></h1>
                <form action="proses_login.php" method="post">
                    <label for="username">Username</label>
                    <div class="user-box">
                        <input type="text" name="username" id="username" required="">
                    </div>
                    <br>
                    <label for="password">Password</label>
                    <div class="user-box">    
                        <input type="password" name="password" id="password" required="">   
                    </div>
                    <center><input type="submit" class="tombol_login" value="LOGIN"></center>
                    
                    <center><a href="google_login.php" class="btn btn-danger btn-block">
                        <i class="fab fa-google">login email</i>
                    </a></center>
                    <center><p>Don't have an account?<a href="register.php">Register</a></p></center>
                </form>
        </div>
</body>
</html>