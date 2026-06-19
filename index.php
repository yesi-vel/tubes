<?php
define('BASE_URL', '/PW/CitaClean 2/');
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();


$page = $_GET['page'] ?? 'login';


function checkAuth() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php?page=login");
        exit;
        
    }
}

switch ($page) {
    case 'login':
        require 'controllers/login_controller.php'; 
        break;
    case 'register':
        require 'controllers/register_controller.php'; 
        break;
    case 'dashboard':
        checkAuth();
        require 'controllers/dashboard_controller.php'; 
        break;
    case 'laporan':
        checkAuth();
        require 'controllers/daftar_laporan_controller.php'; 
        break;
    case 'tambah':
        checkAuth();
        require 'controllers/tambah_laporan_controller.php';
        break;
    case 'edit':
        checkAuth();
        require 'controllers/edit_laporan_controller.php';
        break;
    case 'hapus':
        checkAuth();
        require 'controllers/hapus_laporan_controller.php';
        break;
    case 'logout':
        require 'controllers/logout.php';
        break;
    default:
        echo "404 - Halaman tidak ditemukan";
        break;
}
?>