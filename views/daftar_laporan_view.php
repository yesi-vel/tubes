<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Laporan - CitaClean</title>
    <link rel="stylesheet" href="assets/style.css"> </head>
<body>
    <?php include 'views/navbar.php'; ?>

    <div class="container">
        <h2>Daftar Laporan Pencemaran</h2>
        <div class="action-top">
            <a href="index.php?page=tambah" class="btn btn-primary">+ Tambah Laporan Baru</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Lokasi Sungai</th>
                    <th>Waktu</th>
                    <th>Kategori</th>
                    <th>Bukti</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['lokasi_sungai']) ?></td> 
                        <td><?= date('d/m/Y H:i', strtotime($row['waktu_laporan'])) ?></td>
                        <td><?= htmlspecialchars($row['kategori_pencemaran']) ?></td>
                        <td>
        <img src="uploads/<?= $row['foto_bukti'] ?>" style="width: 100px; height: auto;">
    </td>
                        <td><?= htmlspecialchars($row['status_pencemaran']) ?></td>
                        <td>
                            <div style="display: flex; gap: 5px; justify-content: center;">
                                <a href="index.php?page=edit&id=<?= $row['id'] ?>" class="btn btn-edit">Edit</a>
                                <a href="index.php?page=hapus&id=<?= $row['id'] ?>" class="btn btn-hapus" 
                                onclick="return confirm('Hapus laporan di <?= htmlspecialchars($row['lokasi_sungai']) ?>?')">Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="5">Belum ada data.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php include 'views/footer.php'; ?>
</body>
</html>