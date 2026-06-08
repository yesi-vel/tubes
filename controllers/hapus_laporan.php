<?php
session_start();
require '../models/koneksi.php';
$id = $_GET['id'];


$data = mysqli_query($conn, "SELECT foto_bukti FROM laporan WHERE id = $id");
$row = mysqli_fetch_assoc($data);
if ($row) {
    unlink("uploads/" . $row['foto_bukti']);
}

mysqli_query($conn, "DELETE FROM laporan WHERE id = $id");
header("Location: ../views/daftar_laporan.php");
?>