<?php
session_start();
require '../models/koneksi.php';

if (!isset($_SESSION['user_id'])) { header("Location: ../views/login.php"); exit; }

$id = (int)$_GET['id']; 
$query = mysqli_query($conn, "SELECT * FROM laporan WHERE id = $id");
$data = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {
    $lokasi = $_POST['lokasi'];
    $waktu = $_POST['waktu'];
    $jumlah = (int)$_POST['jumlah'];
    $deskripsi = $_POST['deskripsi'];


    if($jumlah <= 2) $status = 'Ringan';
    elseif($jumlah <= 5) $status = 'Sedang';
    else $status = 'Berat';

    $foto_lama = $data['foto_bukti'];
    $foto_baru = $_FILES['foto']['name'];

    if ($foto_baru != "") {
        
        $ext = pathinfo($foto_baru, PATHINFO_EXTENSION);
        $newName = time() . "_" . $foto_baru;
        move_uploaded_file($_FILES['foto']['tmp_name'], "../uploads/" . $newName);
        
        unlink("uploads/" . $foto_lama);
        $foto_final = $newName;
    } else {
        $foto_final = $foto_lama;
    }

    $sql = "UPDATE laporan SET 
            lokasi_fasilitas='$lokasi', 
            waktu_laporan='$waktu', 
            jumlah_fasilitas_rusak='$jumlah', 
            status_kerusakan='$status', 
            deskripsi='$deskripsi', 
            foto_bukti='$foto_final' 
            WHERE id=$id";
    
    if(mysqli_query($conn, $sql)) {
        header("Location: ../views/daftar_laporan.php");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Laporan</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <?php include '../views/navbar.php'; ?>
    <div class="container">
        <h2>Edit Data Laporan</h2>
        <form method="POST" enctype="multipart/form-data">
            <label>Lokasi Fasilitas:</label>
            <input type="text" name="lokasi" value="<?= $data['lokasi_fasilitas'] ?>" required>
            
            <label>Waktu:</label>
            <input type="datetime-local" name="waktu" value="<?= date('Y-m-d\TH:i', strtotime($data['waktu_laporan'])) ?>" required>
            
            <label>Jumlah Fasilitas Rusak:</label>
            <input type="number" name="jumlah" value="<?= $data['jumlah_fasilitas_rusak'] ?>" required>
            
            <label>Deskripsi:</label>
            <textarea name="deskripsi"><?= $data['deskripsi'] ?></textarea>
            
            <label>Foto Bukti (Kosongkan jika tidak diganti):</label><br>
            <img src="../uploads/<?= $data['foto_bukti'] ?>" width="100">
            <input type="file" name="foto">
            
            <button type="submit" name="update" class="btn btn-primary">Update Data</button>
            <a href="../views/daftar_laporan.php" class="btn btn-danger">Batal</a>
        </form>
    </div>
</body>
</html>