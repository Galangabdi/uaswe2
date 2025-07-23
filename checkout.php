<?php
// WAJIB ADA DI BARIS PALING ATAS UNTUK MENGGUNAKAN KERANJANG
session_start();

// ===================================================================
// 1. PENGATURAN & KONEKSI DATABASE
// ===================================================================
include("koneksi.php"); // Pastikan nama database ini benar

if (!$koneksi) {
    // Tampilkan pesan error jika koneksi gagal
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Jika keranjang kosong, redirect ke halaman utama
if (empty($_SESSION['cart'])) {
    header('Location: UTS.php');
    exit;
}


// ===================================================================
// 2. LOGIKA PENGAMBILAN DATA KERANJANG YANG AMAN
// ===================================================================
$cart_items = [];
$subtotal = 0;
$product_ids_array = array_keys($_SESSION['cart']);

// Buat placeholder (?) sebanyak jumlah ID produk
$placeholders = implode(',', array_fill(0, count($product_ids_array), '?'));
// Buat tipe data untuk binding ('i' untuk setiap integer ID)
$types = str_repeat('i', count($product_ids_array));

// Siapkan query yang aman menggunakan Prepared Statement
$sql = "SELECT id, nama_barang, harga, gambar FROM barang WHERE id IN ($placeholders)";
$stmt = mysqli_prepare($koneksi, $sql);

// Bind semua ID produk ke placeholder di query
mysqli_stmt_bind_param($stmt, $types, ...$product_ids_array);

// Eksekusi dan ambil hasilnya
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Olah hasil query untuk ditampilkan
$products_in_db = [];
while ($row = mysqli_fetch_assoc($result)) {
    $products_in_db[$row['id']] = $row;
}

foreach ($_SESSION['cart'] as $id => $quantity) {
    if (isset($products_in_db[$id])) {
        $product = $products_in_db[$id];
        $cart_items[] = [
            'id' => $id,
            'nama_barang' => $product['nama_barang'],
            'harga' => $product['harga'],
            'gambar' => $product['gambar'],
            'quantity' => $quantity
        ];
        $subtotal += $product['harga'] * $quantity;
    }
}
mysqli_stmt_close($stmt);

// Kalkulasi Total Harga
$shipping = 25000;
$tax = $subtotal * 0.11; // PPN 11%
$total = $subtotal + $shipping + $tax;

$page_title = 'Checkout';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?> - Red Dragon</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .payment-method-details { display: none; }
        input[type="radio"]:checked + label + .payment-method-details { display: block; }
    </style>
</head>
<body class="bg-gray-50">

    <div class="container mx-auto px-4 py-8 lg:py-12">
        <div class="text-center mb-10">
            <a href="UTS.php" class="text-3xl font-bold text-gray-900 animate-pulse">RED DRAGON</a>
            <h1 class="text-4xl font-bold tracking-tight text-gray-900 mt-2">Checkout</h1>
        </div>

        <div class="lg:grid lg:grid-cols-12 lg:gap-12">
            <main class="lg:col-span-7">
               <form action="proses_order.php" method="POST">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h2 class="text-lg font-medium text-gray-900">Detail Pengiriman</h2>
                        <div class="mt-4 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                            <div class="sm:col-span-2">
                                <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                                <input type="email" name="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500" required>
                            </div>
                            <div class="sm:col-span-2">
                                <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" id="nama_lengkap" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            </div>
                            <div class="sm:col-span-2">
                                <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                                <textarea name="alamat" id="alamat" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required></textarea>
                            </div>
                            
                        </div>

                        <div class="mt-8 border-t border-gray-200 pt-8">
                            <h2 class="text-lg font-medium text-gray-900">Metode Pembayaran</h2>
                            <fieldset class="mt-4">
                                <div class="space-y-4">
                                    <div>
                                        <input id="va" name="payment_method" type="radio" class="hidden" value="va" checked>
                                        <label for="va" class="relative flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                                            <span class="font-medium text-gray-900">Virtual Account</span>
                                        </label>
                                        <div class="payment-method-details mt-4 pl-4 border-l-2 border-red-500">
                                            <p class="text-sm text-gray-600">Mendukung BCA, Mandiri, BNI, & lainnya.</p>
                                        </div>
                                    </div>
                                    <div>
                                        <input id="ewallet" name="payment_method" type="radio" class="hidden" value="ewallet">
                                        <label for="ewallet" class="relative flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                                            <span class="font-medium text-gray-900">E-Wallet / QRIS</span>
                                        </label>
                                        <div class="payment-method-details mt-4 pl-4 border-l-2 border-red-500">
                                            <p class="text-sm text-gray-600">Bayar dengan GoPay, OVO, DANA, dll.</p>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="mt-8">
                        <button type="submit" class="w-full rounded-md border border-transparent bg-red-600 py-3 px-4 text-base font-medium text-white shadow-sm hover:bg-red-700">Buat Pesanan</button>
                    </div>
                </form>
            </main>

            <aside class="lg:col-span-5 mt-10 lg:mt-0">
                <div class="bg-white p-6 rounded-lg shadow-md sticky top-8">
                    <h2 class="text-lg font-medium text-gray-900">Ringkasan Pesanan</h2>
                    <ul role="list" class="divide-y divide-gray-200 mt-6">
                        <?php foreach ($cart_items as $item): ?>
                        <li class="flex py-6">
                            <img src="<?= htmlspecialchars($item['gambar']) ?>" alt="<?= htmlspecialchars($item['nama_barang']) ?>" class="h-24 w-24 rounded-md object-cover">
                            <div class="ml-4 flex flex-1 flex-col">
                                <div class="flex justify-between text-base font-medium text-gray-900">
                                    <h3><?= htmlspecialchars($item['nama_barang']) ?></h3>
                                    <p class="ml-4"><?= 'Rp ' . number_format($item['harga'] * $item['quantity']) ?></p>
                                </div>
                                <p class="mt-1 text-sm text-gray-500">Jumlah: <?= $item['quantity'] ?></p>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <dl class="space-y-4 border-t border-gray-200 pt-6">
                        <div class="flex items-center justify-between"><dt class="text-sm text-gray-600">Subtotal</dt><dd class="text-sm font-medium text-gray-900"><?= 'Rp ' . number_format($subtotal) ?></dd></div>
                        <div class="flex items-center justify-between"><dt class="text-sm text-gray-600">Ongkos Kirim</dt><dd class="text-sm font-medium text-gray-900"><?= 'Rp ' . number_format($shipping) ?></dd></div>
                        <div class="flex items-center justify-between"><dt class="text-sm text-gray-600">Pajak (11%)</dt><dd class="text-sm font-medium text-gray-900"><?= 'Rp ' . number_format($tax) ?></dd></div>
                        <div class="flex items-center justify-between border-t border-gray-200 pt-4"><dt class="text-base font-bold text-gray-900">Total Pesanan</dt><dd class="text-base font-bold text-gray-900"><?= 'Rp ' . number_format($total) ?></dd></div>
                    </dl>
                </div>
            </aside>
        </div>
    </div>
</body>
</html>