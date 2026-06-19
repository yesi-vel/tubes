<?php
// controllers/register_controller.php
require 'models/koneksi.php';

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['nama']); 
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    if (strlen($password) < 6) {
        $error = "Password minimal 6 karakter!";
    } else {
        $hashed_pw = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_pw')";
        if (mysqli_query($conn, $query)) {
            header("Location: index.php?page=login");
            exit;
        }
    }
}
require 'views/register_view.php';