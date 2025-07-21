<?php
// config.php
$db_host = 'localhost';
$db_user = 'root'; // Pastikan ini tidak kosong
$db_pass = '';     // Boleh kosong jika tidak ada password
$db_name = 'uts_web2'; // Pastikan ini tidak kosong

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>