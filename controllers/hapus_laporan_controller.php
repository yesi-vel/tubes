<?php
// controllers/hapus_laporan_controller.php
session_start();
require 'models/koneksi.php'; // Sesuaikan path jika dipanggil dari index.php di root

// Pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?page=login");
    exit;
}

// Pastikan ID tersedia di URL
if (!isset($_GET['id'])) {
    header("Location: index.php?page=laporan");
    exit;
}

$id = (int)$_GET['id'];

// 1. Ambil nama file foto sebelum dihapus dari database
$query = mysqli_query($conn, "SELECT foto_bukti FROM laporan WHERE id = $id");
$row = mysqli_fetch_assoc($query);

if ($row) {
   
    $filePath = "uploads/" . $row['foto_bukti'];
    if (file_exists($filePath)) {
        unlink($filePath);
    }
}

// 3. Hapus record dari database
mysqli_query($conn, "DELETE FROM laporan WHERE id = $id");

// 4. Redirect kembali ke halaman laporan melalui index.php
header("Location: index.php?page=laporan");
exit;
?>