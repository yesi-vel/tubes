<?php
session_start();
require '../models/koneksi.php';


if (!isset($_SESSION['user_id'])) { 
    header("Location: login.php"); 
    exit; 
}

$uid = $_SESSION['user_id'];


$query = "SELECT * FROM laporan WHERE user_id = $uid ORDER BY waktu_laporan DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Laporan- SmartCampus Facility</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container">
        <h2>Daftar Laporan</h2>
        <p>Kelola data Laporan.</p>
        
        <div class="action-top">
            <a href="../controllers/tambah_laporan.php" class="btn btn-primary">+ Tambah Data Laporan</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Lokasi Fasilitas</th>
                    <th>Waktu Laporan</th>
                    <th>Jumlah Fasilitas Rusak</th>
                    <th>Status Kerusakan</th>
                    <th>Deskripsi Kondisi</th>
                    <th>Bukti Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['lokasi_fasilitas']) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($row['waktu_laporan'])) ?></td>
                        <td><?= $row['jumlah_fasilitas_rusak'] ?></td>
                        <td>
                            <span class="status-label <?= strtolower($row['status_kerusakan']) ?>">
                                <?= $row['status_kerusakan'] ?>
                            </span>
                        </td>
                        <td><?= htmlspecialchars($row['deskripsi']) ?></td>
                        
                       
                        <td>
                            <?php if ($row['foto_bukti']): ?>
                                <a href="../uploads/<?= $row['foto_bukti'] ?>" target="_blank">
                                    <img src="../uploads/<?= $row['foto_bukti'] ?>" class="img-thumbnail" alt="Bukti Foto">
                                </a>
                            <?php else: ?>
                                <span style="color: #999; font-style: italic;">Tidak ada foto</span>
                            <?php endif; ?>
                        </td>

                      
                        <td>
                            <div style="display: flex; gap: 5px; justify-content: center;">
                                <a href="../controllers/edit_laporan.php?id=<?= $row['id'] ?>" class="btn btn-edit">Edit</a>
                                <a href="../controllers/hapus_laporan.php?id=<?= $row['id'] ?>" class="btn btn-hapus" 
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus data laporan di <?= $row['lokasi_fasilitas'] ?>?')">Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">Belum ada data laporan. Silakan tambah data baru.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>