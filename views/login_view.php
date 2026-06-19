<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CitaClean</title>
    <link rel="stylesheet" href="assets/style.css"> </head>
<body>
    <div class="login-card">
        <h2>CitaClean</h2>
        <p>Silakan masuk untuk mengakses dashboard</p>

        <?php if(isset($error)): ?>
            <p class="error-message"><?= $error ?></p>
        <?php endif; ?>

        <form method="POST" action="index.php?page=login">
            <div class="form-group">
                <input type="email" name="email" placeholder="Alamat Email" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" name="login" class="btn-login">Masuk</button>
        </form>

        <div class="login-footer">
            Belum punya akun? <a href="index.php?page=register">Daftar Sekarang</a>
        </div>
    </div>
</body>
</html>