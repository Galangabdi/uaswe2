<?php
// Koneksi ke database
include('koneksi.php');

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Pastikan request adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Ambil semua data dari form
    $productId = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $ulasan = isset($_POST['ulasan']) ? $_POST['ulasan'] : '';
    $rating = isset($_POST['rating']) ? (int)$_POST['rating'] : 0;

    // Validasi sederhana
    if ($productId > 0 && !empty($nama) && !empty($ulasan) && $rating > 0) {
        
        // Gunakan prepared statement untuk keamanan
        $stmt = $koneksi->prepare("INSERT INTO reviews (product_id, nama, ulasan, rating) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("issi", $productId, $nama, $ulasan, $rating);

        if ($stmt->execute()) {
            // Jika berhasil, arahkan kembali ke halaman produk yang tadi diulas
            header("Location: detail_produk.php?id=" . $productId . "&status=sukses");
            exit();
        } else {
            echo "Error: Gagal menyimpan ulasan.";
        }
        
        $stmt->close();

    } else {
        echo "Error: Data tidak lengkap. Pastikan semua kolom terisi dan rating telah dipilih.";
    }

} else {
    // Jika bukan POST, alihkan ke halaman utama atau tampilkan error
    header("Location: index.php");
    exit();
}

$koneksi->close();
?>