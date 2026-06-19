<?php

//session_start();
require 'models/koneksi.php'; // Path sekarang relatif dari index.php di root

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?page=login");
    exit;
}

$uid = $_SESSION['user_id'];

// Query data
$total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM laporan WHERE user_id = $uid"))['c'];
$segera = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM laporan WHERE user_id = $uid AND status_pencemaran = 'Segera Ditangani'"))['c'];
$perlu = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM laporan WHERE user_id = $uid AND status_pencemaran = 'Perlu Penanganan'"))['c'];
$monitoring = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM laporan WHERE user_id = $uid AND status_pencemaran = 'Dalam Monitoring'"))['c'];

// Panggil view
require 'views/dashboard_view.php';