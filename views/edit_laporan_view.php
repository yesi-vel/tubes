<!DOCTYPE html>
<html>
<head>
    <title>Edit Laporan - CitaClean</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <?php include 'views/navbar.php'; ?>

    <div class="container">
        <h2>Edit Data Laporan Pencemaran</h2>
        
        <form action="index.php?page=edit&id=<?= $data['id'] ?>" method="POST" enctype="multipart/form-data">
            <label>Lokasi Sungai:</label>
            <input type="text" name="lokasi" value="<?= htmlspecialchars($data['lokasi_sungai']) ?>" required>
            
            <label>Waktu:</label>
            <input type="datetime-local" name="waktu" value="<?= date('Y-m-d\TH:i', strtotime($data['waktu_laporan'])) ?>" required>
            
            <label>Kategori Pencemaran:</label>
            <select name="kategori" required>
                <option value="Limbah Industri" <?= ($data['kategori_pencemaran'] == 'Limbah Industri') ? 'selected' : '' ?>>Limbah Industri</option>
                <option value="Limbah Medis" <?= ($data['kategori_pencemaran'] == 'Limbah Medis') ? 'selected' : '' ?>>Limbah Medis</option>
                <option value="Sampah Rumah Tangga" <?= ($data['kategori_pencemaran'] == 'Sampah Rumah Tangga') ? 'selected' : '' ?>>Sampah Rumah Tangga</option>
                <option value="Lainnya" <?= ($data['kategori_pencemaran'] == 'Lainnya') ? 'selected' : '' ?>>Lain-lain</option>
            </select>
            
            <label>Deskripsi:</label>
            <textarea name="deskripsi"><?= htmlspecialchars($data['deskripsi']) ?></textarea>
            
            <label>Foto Bukti (Kosongkan jika tidak diganti):</label><br>
            <?php if(!empty($data['foto_bukti'])): ?>
                <img src="uploads/<?= $data['foto_bukti'] ?>" width="100"><br>
            <?php endif; ?>
            <input type="file" name="foto">
            
            <div class="form-action" style="margin-top:20px;">
                <button type="submit" name="update" class="btn btn-primary">Update Data</button>
                <a href="index.php?page=laporan" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>

    <?php include 'views/footer.php'; ?>
</body>
</html>