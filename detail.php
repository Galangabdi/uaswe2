<?php
session_start();
include("koneksi.php");

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID Produk tidak valid.");
}

$id = $_GET['id'];
$stmt = mysqli_prepare($conn, "SELECT * FROM barang WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$product = mysqli_fetch_assoc($result);

if (!$product) {
    die("Produk tidak ditemukan.");
}
$total_items_in_cart = array_sum($_SESSION['cart'] ?? []);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= htmlspecialchars($product['nama_barang']) ?> - Red Dragon</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <a href="detail.php?id=1">Lihat Produk Speaker XYZ</a>
<a href="detail.php?id=2">Lihat Produk Headphone ABC</a>
</head>
<body class="bg-gray-100 text-gray-800 pt-[56px]">
    <header class="bg-black text-white px-4 py-3 flex justify-between items-center fixed top-0 left-0 right-0 z-50">
        <div><a href="index.php" class="text-2xl font-bold animate-pulse">RED DRAGON</a></div>
        <nav class="space-x-4 hidden md:block">
            <a href="index.php" class="hover:underline">Beranda</a>
            <a href="#" class="hover:underline">Tentang Kami</a>
            <a href="keranjang.php" class="relative hover:underline inline-flex items-center group">
                <span class="inline-flex items-center px-3 py-1 rounded-full bg-red-600">Keranjang</span>
                <span class="absolute -top-2 -right-2 bg-yellow-400 text-black text-xs font-bold px-2 py-0.5 rounded-full"><?= $total_items_in_cart ?></span>
            </a>
        </nav>
    </header>

    <main class="container mx-auto p-8 mt-8">
        <div class="bg-white p-8 rounded-lg shadow-lg grid grid-cols-1 md:grid-cols-2 gap-12">
            <div>
                <img src="<?= htmlspecialchars($product['gambar']) ?>" alt="<?= htmlspecialchars($product['nama_barang']) ?>" class="w-full rounded-lg">
            </div>
            <div>
                <h1 class="text-4xl font-bold mb-4"><?= htmlspecialchars($product['nama_barang']) ?></h1>
                <p class="text-red-600 font-bold text-3xl mb-6">Rp <?= number_format($product['harga'], 0, ',', '.') ?></p>
                <p class="text-gray-600 mb-8 leading-relaxed"><?= nl2br(htmlspecialchars($product['deskripsi'])) ?></p>
                <button onclick="addToCart(<?= $product['id'] ?>)" class="w-full bg-black text-white py-3 rounded text-lg font-bold hover:bg-gray-800 transition">
                    + Tambah ke Keranjang
                </button>
            </div>
        </div>
    </main>

    <script>
        async function addToCart(productId) {
            try {
                const response = await fetch('api.php?action=add_to_cart', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id: productId })
                });
                const result = await response.json();
                if (result.success) {
                    alert('Produk berhasil ditambahkan ke keranjang!');
                    location.reload();
                } else {
                    alert('Gagal menambahkan: ' + result.error);
                }
            } catch (error) {
                console.error('Error:', error);
            }
        }
    </script>
   <?php
// Koneksi ke database
include("koneksi.php");


// 1. Dapatkan ID produk dari URL, pastikan itu adalah angka
$productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Jika tidak ada ID produk yang valid, hentikan skrip
if ($productId == 0) {
    die("Produk tidak ditemukan.");
}

// 2. Ambil data PRODUK SPESIFIK dari tabel `barang`
$stmt_produk = $conn->prepare("SELECT nama_barang, harga, gambar, deskripsi FROM barang WHERE id = ?");
$stmt_produk->bind_param("i", $productId);
$stmt_produk->execute();
$result_produk = $stmt_produk->get_result();
$produk = $result_produk->fetch_assoc();

// Jika produk tidak ditemukan di database, hentikan skrip
if (!$produk) {
    die("Produk tidak ditemukan.");
}

// 3. Ambil data ULASAN SPESIFIK untuk produk ini dari tabel `reviews`
$stmt_ulasan = $conn->prepare("SELECT nama, ulasan, rating, created_at FROM reviews WHERE product_id = ? ORDER BY created_at DESC");
$stmt_ulasan->bind_param("i", $productId);
$stmt_ulasan->execute();
$result_ulasan = $stmt_ulasan->get_result();
$ulasan = [];
while ($row = $result_ulasan->fetch_assoc()) {
    $ulasan[] = $row;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Produk: <?= htmlspecialchars($produk['nama_barang']) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

        <div class="w-full p-8 bg-gray-50 shadow-lg backdrop-blur-sm mx-auto">
            <h2 class="text-3xl font-bold mb-6 text-gray-800 text-center">Ulasan Produk</h2>
            
            <div class="flex justify-center mb-8">
                <div class="flex space-x-3" id="star-rating">
                    <span class="text-3xl cursor-pointer hover:text-yellow-400 transition-colors">★</span>
                    <span class="text-3xl cursor-pointer hover:text-yellow-400 transition-colors">★</span>
                    <span class="text-3xl cursor-pointer hover:text-yellow-400 transition-colors">★</span>
                    <span class="text-3xl cursor-pointer hover:text-yellow-400 transition-colors">★</span>
                    <span class="text-3xl cursor-pointer hover:text-yellow-400 transition-colors">★</span>
                </div>
            </div>

            <form class="space-y-8 max-w-2xl mx-auto" action="simpan.php" method="POST" id="review-form">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Anda</label>
                    <input type="text" name="nama" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-blue-500 focus:outline-none transition-colors" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Ulasan Anda</label>
                    <textarea name="ulasan" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-blue-500 focus:outline-none transition-colors" rows="4" required></textarea>
                </div>
                
                <input type="hidden" name="product_id" value="<?= $productId ?>">
                <input type="hidden" name="rating" id="rating" value="0">
                
                <button type="submit" class="w-full bg-black text-white py-3 rounded-lg hover:bg-gray-800 transition-colors font-medium">
                    Kirim Ulasan
                </button>
            </form>

            <div class="review-list flex flex-col items-center space-y-6 mt-12">
                <?php if (!empty($ulasan)): ?>
                    <?php foreach ($ulasan as $u): ?>
                    <div class="bg-black text-white rounded-xl shadow-lg p-5 w-full max-w-2xl border border-gray-700 relative hover:scale-105 transition-transform duration-200">
                        <div class="flex items-center mb-3">
                            <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-black font-bold mr-3 shadow-md border-2 border-black">
                                <?= strtoupper(substr(htmlspecialchars($u['nama']), 0, 1)) ?>
                            </div>
                            <div>
                                <span class="font-semibold text-white"><?= htmlspecialchars($u['nama']) ?></span>
                                <div>
                                    <?php for ($i = 0; $i < $u['rating']; $i++): ?><span class="text-yellow-400 text-lg">★</span><?php endfor; ?>
                                    <?php for ($i = $u['rating']; $i < 5; $i++): ?><span class="text-gray-500 text-lg">★</span><?php endfor; ?>
                                </div>
                            </div>
                        </div>
                        <div class="italic text-gray-200 mb-2 px-1 border-l-4 border-white bg-black/50 rounded-r">
                            "<?= nl2br(htmlspecialchars($u['ulasan'])) ?>"
                        </div>
                        <div class="text-xs text-gray-400 absolute bottom-3 right-5">
                            <?= date('d M Y H:i', strtotime($u['created_at'])) ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-gray-500 text-center w-full">Jadilah yang pertama memberikan ulasan untuk produk ini.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        // Star rating selection
        let selectedRating = 0;
        const stars = document.querySelectorAll('#star-rating > span');
        const ratingInput = document.getElementById('rating');

        stars.forEach((star, idx) => {
            star.addEventListener('click', () => {
                selectedRating = idx + 1;
                ratingInput.value = selectedRating;
                updateStars();
            });
            star.addEventListener('mouseenter', () => {
                stars.forEach((s, i) => s.classList.toggle('text-yellow-400', i <= idx));
            });
            star.addEventListener('mouseleave', () => {
                updateStars();
            });
        });

        function updateStars() {
            stars.forEach((s, i) => {
                s.classList.toggle('text-yellow-400', i < selectedRating);
            });
        }
    </script>
</body>
</html>
</body>
</html>