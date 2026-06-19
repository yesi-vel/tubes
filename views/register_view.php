<!DOCTYPE html>
<html>
<head>
    <title>Register - CitaClean</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container" style="max-width: 400px; margin-top: 100px;">
        <h2>Daftar Akun</h2>
        <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        
        <form method="POST" action="index.php?page=register">
            <input type="text" name="nama" placeholder="Nama Lengkap" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password (min 6 karakter)" required>
            <button type="submit" name="register" class="btn btn-primary" style="width: 100%;">Daftar</button>
        </form>
        
        <p class="login-link">
            Sudah punya akun? <a href="index.php?page=login">Login di sini</a>
        </p>
    </div>
</body>
</html>