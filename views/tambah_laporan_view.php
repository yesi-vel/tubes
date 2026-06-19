<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tambah Laporan - CitaClean</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <?php include 'views/navbar.php'; ?>
    
    <div class="container">
        <h2>Tambah Laporan Baru</h2>
        <form method="POST" action="index.php?page=tambah" enctype="multipart/form-data">
            <label>Lokasi Sungai:</label>
            <input type="text" name="lokasi" required>
            
            <label>Waktu:</label>
            <input type="datetime-local" name="waktu" required>
            
            <label>Kategori Pencemaran:</label>
            <select name="kategori" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="Limbah Industri">Limbah Industri</option>
                <option value="Limbah Medis">Limbah Medis</option>
                <option value="Sampah Rumah Tangga">Sampah Rumah Tangga</option>
                <option value="Lainnya">Lain-lain</option>
            </select>
            
            <label>Deskripsi:</label>
            <textarea name="deskripsi"></textarea>
            
            <label>Bukti Foto:</label>
            <input type="file" name="foto" required>
            
            <button type="submit" name="submit" class="btn btn-primary">Simpan Data</button>
        </form>
    </div>
</body>
</html>