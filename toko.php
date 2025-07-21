<?php
// ===================================================================
// 1. PENGATURAN & KONEKSI DATABASE
// ===================================================================
$db_host = 'localhost';
$db_user = 'root'; // Ganti jika username Anda berbeda
$db_pass = '';     // Ganti jika Anda menggunakan password
$db_name = 'uts_web2'; // <-- WAJIB GANTI SESUAI NAMA DATABASE ANDA

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}


// ===================================================================
// 2. LOGIKA UTAMA (ROUTER)
// Menentukan mode: 'daftar' atau 'detail' berdasarkan URL
// ===================================================================
$mode = 'daftar'; // Mode default
$product = null;
$product_list = null;
$error_message = '';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // --- Mode Detail ---
    $mode = 'detail';
    $product_id = (int)$_GET['id'];

    $stmt = mysqli_prepare($conn, "SELECT id, nama_barang, harga, gambar FROM barang WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $product_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        $error_message = "Produk dengan ID tersebut tidak ditemukan.";
    }
    mysqli_stmt_close($stmt);

} else {
    // --- Mode Daftar ---
    $result = mysqli_query($conn, "SELECT id, nama_barang, harga, gambar FROM barang ORDER BY id DESC");
    if ($result) {
        $product_list = $result;
    } else {
        $error_message = "Gagal mengambil data produk.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>
        <?php
        // Judul halaman dinamis
        if ($mode === 'detail' && $product) {
            echo htmlspecialchars($product['nama_barang']);
        } else {
            echo 'PC Unggulan';
        }
        ?>
    </title>
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-6 md:p-12">
<?php
// ===================================================================
// 3. TAMPILAN HTML
// Menampilkan HTML berdasarkan mode yang aktif
// ===================================================================

// --- Tampilan Mode Daftar ---
if ($mode === 'daftar'):
?>
    <section>
      <h2 class="text-3xl font-bold mb-8 text-center text-gray-800">PC Unggulan</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
        <?php if ($product_list && mysqli_num_rows($product_list) > 0): ?>
          <?php while ($row = mysqli_fetch_assoc($product_list)): ?>
            <a href="?id=<?= $row['id'] ?>" class="block bg-white rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-2xl">
              <img src="<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['nama_barang']) ?>" class="w-full h-48 object-cover" />
              <div class="p-4">
                <h3 class="mt-2 h-12 font-semibold text-gray-800"><?= htmlspecialchars($row['nama_barang']) ?></h3>
                <p class="text-red-600 font-bold text-xl mt-2">Rp <?= number_format($row['harga'], 0, ',', '.') ?></p>
              </div>
            </a>
          <?php endwhile; ?>
        <?php else: ?>
          <p class="col-span-4 text-center text-gray-500 text-lg">Tidak ada data barang untuk ditampilkan.</p>
        <?php endif; ?>
      </div>
    </section>
<?php
// --- Tampilan Mode Detail ---
elseif ($mode === 'detail' && $product):
?>
    <div class="bg-white p-8 rounded-lg shadow-lg">
      <a href="<?= basename(__FILE__) ?>" class="text-blue-500 hover:underline mb-6 inline-block">&larr; Kembali ke Daftar PC</a>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
        <div>
          <img src="<?= htmlspecialchars($product['gambar']) ?>" alt="<?= htmlspecialchars($product['nama_barang']) ?>" class="w-full h-auto object-cover rounded-lg shadow-md">
        </div>
        <div>
          <h1 class="text-4xl font-bold text-gray-800 mb-4"><?= htmlspecialchars($product['nama_barang']) ?></h1>
          <p class="text-5xl font-bold text-red-600 mb-6">Rp <?= number_format($product['harga'], 0, ',', '.') ?></p>
          <p class="text-gray-600 mb-8 leading-relaxed">Ini adalah deskripsi standar. Anda dapat menambahkan kolom 'deskripsi' di tabel database dan menampilkannya di sini untuk informasi yang lebih lengkap.</p>
          <div class="flex items-center gap-4">
            <button class="w-full bg-green-500 text-white font-bold py-3 px-6 rounded-lg hover:bg-green-600 transition duration-300">Tambah ke Keranjang</button>
            <button class="w-full bg-blue-500 text-white font-bold py-3 px-6 rounded-lg hover:bg-blue-600 transition duration-300">Beli Sekarang</button>
          </div>
        </div>
      </div>
    </div>
<?php
// --- Tampilan Error ---
else:
?>
    <div class="bg-white p-8 rounded-lg shadow-lg text-center">
      <h1 class="text-2xl font-bold text-red-600 mb-4">Oops! Terjadi Kesalahan</h1>
      <p class="text-gray-700"><?= htmlspecialchars($error_message) ?></p>
      <a href="<?= basename(__FILE__) ?>" class="mt-6 inline-block bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600">Kembali ke Beranda</a>
    </div>
<?php endif; ?>
</div>

</body>
</html>
<?php
// ===================================================================
// 4. MENUTUP KONEKSI
// ===================================================================
mysqli_close($conn);
?>