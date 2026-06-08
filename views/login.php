<?php
session_start();
require '../models/koneksi.php';

if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");

    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nama'] = $user['nama'];

        header("Location: dashboard.php");
        exit;

    } else {

        $error = "Email atau Password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SmartCampus Facility</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

    <div class="login-card">
        <h2>SmartCampus</h2>
        <p>Silakan masuk untuk mengakses dashboard</p>

        <?php if(isset($error)): ?>
    <p class="error-message"><?= $error ?></p>
<?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <input type="email" name="email" placeholder="Alamat Email" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" name="login" class="btn-login">Masuk</button>
        </form>

        <div class="login-footer">
            Belum punya akun? <a href="register.php">Daftar Sekarang</a>
        </div>
    </div>

</body>
</html>