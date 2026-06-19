<?php
// controllers/laporan_controller.php
//session_start();
require 'models/koneksi.php'; // Path sekarang relatif terhadap index.php di root

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?page=login");
    exit;
}

$uid = $_SESSION['user_id'];
$query = "SELECT * FROM laporan WHERE user_id = $uid ORDER BY waktu_laporan DESC";
$result = mysqli_query($conn, $query);

// Panggil view setelah data siap
require 'views/daftar_laporan_view.php';