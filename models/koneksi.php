<?php


$host = "localhost";
$user = "sistem18_citaclean";
$pass = "~-#Cn5PHG?[PL7dk";
$db   = "sistem18_citaclean";


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = mysqli_connect($host, $user, $pass, $db);
    mysqli_set_charset($conn, "utf8mb4"); 
} catch (mysqli_sql_exception $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>