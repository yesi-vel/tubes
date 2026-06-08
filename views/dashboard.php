<?php
session_start();
require '../models/koneksi.php';

if (!isset($_SESSION['user_id'])) { 
    header("Location: login.php"); 
    exit; 
}

$uid = $_SESSION['user_id'];


$total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM laporan WHERE user_id = $uid"))['c'];
$Ringan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM laporan WHERE user_id = $uid AND status_kerusakan = 'Ringan'"))['c'];
$Sedang = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM laporan WHERE user_id = $uid AND status_kerusakan = 'Sedang'"))['c'];
$Berat = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM laporan WHERE user_id = $uid AND status_kerusakan = 'Berat'"))['c'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - SmartCampus Facility</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="content-wrapper">
        <div class="card-container">
            <h2 style="margin-top: 0; color: #b7bbceff;">Halo, <?= $_SESSION['nama'] ?>!</h2>
            <p style="color: #efe7e7ff;">Ringkasan data Pelaporan Kerusakan Fasilitas Kampus.</p>
            
            <div class="card-grid">
                <div class="card">
                    <h3>Total Data</h3>
                    <p><?= $total ?></p>
                </div>

                <div class="card" style="border-top-color: #2ecc71;">
                    <h3>Ringan</h3>
                    <p style="color: #27ae60;"><?= $Ringan ?></p>
                </div>

                <div class="card" style="border-top-color: #f1c40f;">
                    <h3>Sedang</h3>
                    <p style="color: #f39c12;"><?= $Sedang ?></p>
                </div>

                <div class="card" style="border-top-color: #e74c3c;">
                    <h3>Berat</h3>
                    <p style="color: #c0392b;"><?= $Berat ?></p>
                </div>
            </div>

            <div class="btn-center">
                <a href="daftar_laporan.php" class="btn-primary" style="text-decoration: none; display: inline-block;">Lihat Detail Laporan</a>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>