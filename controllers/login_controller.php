<?php

//session_start();
require 'models/koneksi.php';

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nama'] = $user['nama'];
        header("Location: index.php?page=dashboard"); // Redirect ke routing
        exit;
    } else {
        $error = "Email atau Password salah!";
    }
}

// Panggil view setelah logika
require 'views/login_view.php';