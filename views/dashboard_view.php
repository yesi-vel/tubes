<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - CitaClean</title>
    <link rel="stylesheet" href="assets/style.css"> </head>
<body>
    <?php include 'views/navbar.php'; ?>

    <div class="content-wrapper">
        <div class="card-container">
            <h2 style="margin-top: 0; color: #b7bbceff;">Halo, <?= htmlspecialchars($_SESSION['nama'] ?? 'User') ?>!</h2>
            <p style="color: #efe7e7ff;">Ringkasan laporan pencemaran Sungai Citarum.</p>
            
                    <div class="card-grid">
            <div class="card">
                <h3>Total Laporan</h3>
                <p><?= $total ?></p>
            </div>

            <div class="card" style="border-top-color: #e74c3c;"> 
                <h3>Segera Ditangani</h3>
                <p style="color: #c0392b;"><?= $segera ?></p>
            </div>

            <div class="card" style="border-top-color: #f1c40f;"> 
                <h3>Perlu Penanganan</h3>
                <p style="color: #f39c12;"><?= $perlu ?></p>
            </div>

            <div class="card" style="border-top-color: #3498db;"> 
                <h3>Dalam Monitoring</h3>
                <p style="color: #2980b9;"><?= $monitoring ?></p>
            </div>
        </div>

            <div class="btn-center">
                <a href="index.php?page=laporan" class="btn-primary" style="text-decoration: none; display: inline-block;">Lihat Semua Laporan</a>
            </div>
        </div>
    </div>
    <?php include 'views/footer.php'; ?>
</body>
</html>