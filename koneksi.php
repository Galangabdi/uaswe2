<?php
// filepath: /c:/xampp/htdocs/uts_web2/koneksi.php
$host = "localhost";
$username = "root";
$password = "";
$database = "uts_web2";

$koneksi = mysqli_connect($host, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
 