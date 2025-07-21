<?php
session_start();
require_once 'config.php';

// Pastikan hanya bisa diakses via metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Ambil data dari form checkout
    $email = $_POST['email'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $alamat = $_POST['alamat'];
    // ... ambil data lainnya jika perlu ...

    // 2. Ambil data dari keranjang session
    $cart = $_SESSION['cart'] ?? [];
    if (empty($cart)) {
        // Jika keranjang tiba-tiba kosong, kembalikan ke awal
        header('Location: UTS.php');
        exit;
    }

    //
    // --- DI DUNIA NYATA, DI SINILAH ANDA MENYIMPAN DATA PESANAN KE DATABASE ---
    // Contoh query (tidak dijalankan, hanya untuk ilustrasi):
    //
    // a. Simpan data pesanan utama ke tabel 'orders'
    // $sql_order = "INSERT INTO orders (customer_name, customer_email, total_price, status) VALUES (?, ?, ?, 'pending')";
    //
    // b. Ambil ID pesanan yang baru dibuat
    // $order_id = mysqli_insert_id($conn);
    //
    // c. Simpan setiap item di keranjang ke tabel 'order_items'
    // foreach ($cart as $product_id => $quantity) {
    //   $sql_items = "INSERT INTO order_items (order_id, product_id, quantity) VALUES (?, ?, ?)";
    // }
    // --- AKHIR DARI SIMULASI PENYIMPANAN DATABASE ---
    //

    // 3. Kosongkan keranjang setelah pesanan "berhasil"
    $_SESSION['cart'] = [];

    // 4. Arahkan pengguna ke halaman sukses
    header('Location: order_sukses.php');
    exit;

} else {
    // Jika file diakses langsung, kembalikan ke halaman utama
    header('Location: UTS.php');
    exit;
}
?>