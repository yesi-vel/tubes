<?php

require 'models/koneksi.php'; 
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?page=login");
    exit;
}

if (isset($_POST['submit'])) {
    $uid = $_SESSION['user_id'];
    $lokasi = mysqli_real_escape_string($conn, $_POST['lokasi']);
    $waktu = mysqli_real_escape_string($conn, $_POST['waktu']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']); 
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);

    switch ($kategori) {
        case 'Limbah Industri': case 'Limbah Medis': $status = 'Segera Ditangani'; break;
        case 'Sampah Rumah Tangga': $status = 'Perlu Penanganan'; break;
        default: $status = 'Dalam Monitoring'; break;
    }
    
    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    $ext = pathinfo($foto, PATHINFO_EXTENSION);
    
    if(in_array(strtolower($ext), ['jpg', 'jpeg', 'png'])) {
        $newName = time() . "_" . $foto;
        if(move_uploaded_file($tmp, "uploads/" . $newName)){
            $sql = "INSERT INTO laporan (user_id, lokasi_sungai, waktu_laporan, kategori_pencemaran, status_pencemaran, deskripsi, foto_bukti)
                    VALUES ('$uid', '$lokasi', '$waktu', '$kategori', '$status', '$deskripsi', '$newName')";
            if(mysqli_query($conn, $sql)){
                header("Location: index.php?page=laporan");
                exit;
            }
        }
    }
}

// Panggil view setelah semua logika di atas selesai
require 'views/tambah_laporan_view.php';