<?php
header('Content-Type: application/json');
require 'models/koneksi.php';

$method = $_SERVER['REQUEST_METHOD'];


if ($method == 'GET') {
    $query = mysqli_query($conn, "SELECT * FROM laporan ORDER BY waktu_laporan DESC");
    $data = mysqli_fetch_all($query, MYSQLI_ASSOC);
    echo json_encode($data);
}


elseif ($method == 'DELETE') {
   
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    if ($id > 0) {
       
        $res = mysqli_query($conn, "SELECT foto_bukti FROM laporan WHERE id = $id");
        $row = mysqli_fetch_assoc($res);
        if ($row && file_exists("../uploads/" . $row['foto_bukti'])) {
            unlink("../uploads/" . $row['foto_bukti']);
        }

       
        $sql = "DELETE FROM laporan WHERE id = $id";
        $success = mysqli_query($conn, $sql);

        echo json_encode(['success' => $success]);
    } else {
        echo json_encode(['success' => false, 'message' => 'ID tidak valid']);
    }
}
?>