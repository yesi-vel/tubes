<?php
header('Content-Type: application/json');
// Pastikan path ke koneksi.php benar relatif dari lokasi file ini
require 'models/koneksi.php'; 

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
    $query = mysqli_query($conn, "SELECT id, user_id, lokasi_sungai, waktu_laporan, kategori_pencemaran, status_pencemaran, deskripsi, foto_bukti FROM laporan ORDER BY waktu_laporan DESC");
    $data = mysqli_fetch_all($query, MYSQLI_ASSOC);
    echo json_encode($data);
}
elseif ($method == 'DELETE') {
    // Pastikan ID diambil dari URL query string
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    if ($id > 0) {
        $res = mysqli_query($conn, "SELECT foto_bukti FROM laporan WHERE id = $id");
        $row = mysqli_fetch_assoc($res);
        
        if ($row && !empty($row['foto_bukti'])) {
            // Pastikan path ke folder uploads benar
            $pathFile = "uploads/" . $row['foto_bukti'];
            if (file_exists($pathFile)) {
                unlink($pathFile);
            }
        }

        $sql = "DELETE FROM laporan WHERE id = $id";
        $success = mysqli_query($conn, $sql);

        echo json_encode(['success' => (bool)$success, 'message' => $success ? 'Data berhasil dihapus' : 'Gagal menghapus data']);
    } else {
        echo json_encode(['success' => false, 'message' => 'ID tidak valid']);
    }
}
?>