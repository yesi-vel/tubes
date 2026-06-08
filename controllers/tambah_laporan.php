<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require '../models/koneksi.php';


if (isset($_POST['submit'])) {
    $uid = $_SESSION['user_id'];
    
    $lokasi = mysqli_real_escape_string($conn, $_POST['lokasi']);
    $waktu = mysqli_real_escape_string($conn, $_POST['waktu']);
    $jumlah = (int)$_POST['jumlah'];
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);

    
    if($jumlah <= 2) $status = 'Ringan';
    elseif($jumlah <= 5) $status = 'Sedang';
    else $status = 'Berat';

    
    $foto = $_FILES['foto']['name'];
    
    $tmp = $_FILES['foto']['tmp_name'];
    $ext = pathinfo($foto, PATHINFO_EXTENSION);
    $allowed = ['jpg', 'jpeg', 'png'];
    
    $size = $_FILES['foto']['size'];
    if($size > 2000000) { 
        die("Ukuran file terlalu besar!");
    }

    if(in_array(strtolower($ext), $allowed)) {

    $newName = time() . "_" . $foto;

    if(move_uploaded_file($tmp, "../uploads/" . $newName)){

        
        $sql = "INSERT INTO laporan 
(user_id, lokasi_fasilitas, waktu_laporan, jumlah_fasilitas_rusak, status_kerusakan, deskripsi, foto_bukti)

VALUES
('$uid', '$lokasi', '$waktu', '$jumlah', '$status', '$deskripsi', '$newName')";

if(mysqli_query($conn, $sql)){

    header("Location: ../views/daftar_laporan.php");
    exit;

} else {

    echo mysqli_error($conn);
}
    } else {

       echo "UPLOAD GAGAL.<br>";
        echo "Error Code: " . $_FILES['foto']['error'] . "<br>";
        echo "Path tujuan: " . realpath("../uploads/") . "<br>";
        echo "File asal: " . $tmp;
        die();
    }

}
        
    }

?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data</title>
   <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <?php include '../views/navbar.php'; ?>
    <div class="container">
        <h2>Tambah Laporan Baru</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="lokasi" placeholder="Lokasi Fasilitas" required>
            <input type="datetime-local" name="waktu" required>
            <input type="number" name="jumlah" placeholder="Jumlah Laporan" required>
            <textarea name="deskripsi" placeholder="Deskripsi Kondisi"></textarea>
            <label class="form-label">Bukti Foto (JPG/PNG):</label>
            <input type="file" name="foto" required>
            <div class="form-action">
    <button type="submit" name="submit" class="btn btn-primary">
        Simpan Data
    </button>
</div>
        </form>
    </div>
</body>
</html>