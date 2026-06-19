<?php
//session_start();
require 'models/koneksi.php';

if (!isset($_SESSION['user_id'])) { header("Location:index.php?page=login"); exit; }

$id = (int)$_GET['id']; 
// Ambil data untuk ditampilkan di form
$query = mysqli_query($conn, "SELECT * FROM laporan WHERE id = $id");
$data = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {
    $lokasi = mysqli_real_escape_string($conn, $_POST['lokasi']);
    $waktu = mysqli_real_escape_string($conn, $_POST['waktu']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);

    // Logika Status
    switch ($kategori) {
        case 'Limbah Industri': case 'Limbah Medis': $status = 'Segera Ditangani'; break;
        case 'Sampah Rumah Tangga': $status = 'Perlu Penanganan'; break;
        default: $status = 'Dalam Monitoring'; break;
    }

    $foto_lama = $data['foto_bukti'];
    $foto_baru = $_FILES['foto']['name'];

    if ($foto_baru != "") {
        $newName = time() . "_" . $foto_baru;
        move_uploaded_file($_FILES['foto']['tmp_name'], "uploads/" . $newName);
        if (file_exists("uploads/" . $foto_lama)) unlink("uploads/" . $foto_lama);
        $foto_final = $newName;
    } else {
        $foto_final = $foto_lama;
    }

    $sql = "UPDATE laporan SET lokasi_sungai='$lokasi', waktu_laporan='$waktu', kategori_pencemaran='$kategori', status_pencemaran='$status', deskripsi='$deskripsi', foto_bukti='$foto_final' WHERE id=$id";
    
    if(mysqli_query($conn, $sql)) {
        header("Location:index.php?page=laporan"); // Redirect ke index.php routing
        exit;
    }
}

// Setelah logika selesai, panggil view
require 'views/edit_laporan_view.php';