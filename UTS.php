

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Red Dragon pc</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Red Dragon pc</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    
</head>

<body class="bg-white text-gray-800 pt-[56px]">

        <!-- Header -->

<header class="bg-black text-white px-4 py-3 flex justify-between items-center fixed top-0 left-0 right-0 z-50">

  <div>
    <a href="UTS.html" class="text-2xl font-bold animate-pulse">RED DRAGON</a>
</div>
        <nav class="space-x-4 hidden md:block">
          <a href="UTS.php" class="hover:underline">Beranda</a>
          <a href="tentangkami.php" class="hover:underline">tentang kami</a>
          <a href="komponen.html" class="hover:underline">komponen</a>
          <a href="tes.php" class="hover:underline">AKUN</a>
          <a href="keranjang.php" class="relative hover:underline inline-flex items-center group transition duration-200">
            <span class="inline-flex items-center px-3 py-1 rounded-full bg-red-600 text-white font-semibold shadow-md group-hover:bg-red-700 transition duration-200">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m13-9l2 9m-5-9V6a2 2 0 10-4 0v3" />
              </svg>
              Keranjang
            </span>
            <span class="absolute -top-2 -right-2 bg-yellow-400 text-black text-xs font-bold px-2 py-0.5 rounded-full shadow group-hover:bg-yellow-500 transition duration-200">
              <?php echo isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] : 0; ?>
            </span>
          </a>    </nav>
</header>
<!-- Hero Slider -->
<!-- Hero Slider -->
<div class="swiper-container w-full h-96 mt-16">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <img src="https://enterkomputer.com/web-assets/frontend/pcready/2560x500px-1743136387.jpg" alt="Slide 1" class="w-full h-full object-cover">
      </div>
      <div class="swiper-slide">
        <img src="https://enterkomputer.com/web-assets/frontend/banner/home/Banner-Slider-Home-Casing-CG-Cinema-Athos-1744711639.jpg" alt="Slide 2" class="w-full h-full object-cover">
      </div>
    </div>
    <!-- Pagination -->
    <div class="swiper-pagination"></div>
  </div>
  
  <!-- Swiper Script -->
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <script>
    var swiper = new Swiper('.swiper-container', {
      loop: true,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
    });
  </script>
  
<div class="swiper-slide">
    </div>
    
    <div class="swiper-pagination"></div>
</div>
  
<!-- Produk -->
<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "uts_web2");
$result = mysqli_query($conn, "SELECT * FROM barang ORDER BY id DESC");
$total_items_in_cart = array_sum($_SESSION['cart'] ?? []);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Red Dragon Sport</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>
<body class="bg-white text-gray-800 pt-[56px]">

    <header class="bg-black text-white px-4 py-3 flex justify-between items-center fixed top-0 left-0 right-0 z-50">
        <div><a href="UTS.php" class="text-2xl font-bold animate-pulse">RED DRAGON</a></div>
        <nav class="space-x-4 hidden md:block">
            <a href="UTS.php" class="hover:underline">Beranda</a>
            <a href="tentangkami.php" class="hover:underline">Tentang Kami</a>
            <a href="komponen.html" class="hover:underline">Komponen</a>
            <a href="tes.php" class="hover:underline">Akun</a>
            <a href="keranjang.php" class="relative hover:underline inline-flex items-center group">
                <span class="inline-flex items-center px-3 py-1 rounded-full bg-red-600">Keranjang</span>
                <span class="absolute -top-2 -right-2 bg-yellow-400 text-black text-xs font-bold px-2 py-0.5 rounded-full"><?= $total_items_in_cart ?></span>
            </a>
        </nav>
    </header>

    <main class="container mx-auto px-6 py-10">
      <h2 class="text-3xl font-bold mb-8 text-center text-gray-800">PC Unggulan</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
        <?php if ($result && mysqli_num_rows($result) > 0): ?>
          <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden flex flex-col">
              <a href="detail.php?id=<?= $row['id'] ?>">
                <img src="<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['nama_barang']) ?>" class="w-full h-48 object-cover" />
              </a>
              <div class="p-4 flex flex-col flex-grow">
                <h3 class="font-semibold text-gray-800 flex-grow"><?= htmlspecialchars($row['nama_barang']) ?></h3>
                <p class="text-red-600 font-bold text-xl mt-2">Rp <?= number_format($row['harga'], 0, ',', '.') ?></p>
                <button onclick="addToCart(<?= $row['id'] ?>)" class="mt-4 w-full bg-black text-white py-2 rounded hover:bg-gray-800 transition">
                    + Tambah ke Keranjang
                </button>
              </div>
            </div>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>
    </main>

    <footer class="bg-black text-white text-center py-4 mt-10">
        &copy; <?= date("Y") ?> Red Dragon. Semua Hak Dilindungi.
    </footer>

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
                    location.reload(); // Refresh halaman untuk update jumlah keranjang di header
                } else {
                    alert('Gagal menambahkan: ' + result.error);
                }
            } catch (error) {
                console.error('Error:', error);
            }
        }
    </script>
<!-- Removed broken PHP conditional block and duplicate product section to fix parse errors -->

</body>
</html>
<?php
// ===================================================================
// 4. MENUTUP KONEKSI
// ===================================================================
mysqli_close($conn);
?>
<section class="relative overflow-hidden">
  <div class="swiper-container h-96">
    <div class="swiper-wrapper">
      <div class="swiper-slide relative">
        <img src="https://enterkomputer.com/web-assets/frontend/banner/home/inno3D-1745300949.jpg" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col items-center justify-center px-8 transition-all duration-700 transform hover:scale-105">
          <a href="komponen.html" class="text-white text-4xl font-bold mb-4 animate-bounce text-center">INNO3D® GEFORCE® RTX™ 5060 Ti 16GB TWIN X2</a>
          <p class="text-white text-xl transform transition-all duration-00 hover:translate-x-4 text-center">The INNO3D GeForce RTX 50 Series promises exceptional performance from these next-gen graphics cards powered by NVIDIA’s Blackwell Architecture. </p>
        </div>
      </div>
      <div class="swiper-slide relative">
        <img src="https://enterkomputer.com/web-assets/frontend/banner/home/maxsun-b860-banner-1744711814.jpg" class="w-full h-full object-cover">
         <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col items-center justify-center px-8 transition-all duration-700 transform hover:scale-105">
          <a href="komponen.html" class="text-white text-4xl font-bold mb-4 animate-bounce text-center">Terminator B760M D5 </a>
          <p class="text-white text-xl transform transition-all duration-00 hover:translate-x-4 text-center">Power: Equipped with a robust 10-Phase Core and 50A Dr.Mos for efficient, stable power delivery and enhanced performance..</p>
        </div>
      </div>
    </div>
    <div class="swiper-pagination"></div>
  </div>
  <script>
    new Swiper('.swiper-container', {
      loop: true,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
      
    });
  </script>
</section>
<!-- Promo -->
<div class="mt-16 text-center max-w-3xl mx-auto">
  <h2 class="text-3xl font-bold mb-6">Tentang Red Dragon </h2>
  <p class="text-gray-600 leading-relaxed">
   
    Red Dragon adalah penyedia solusi komputer terkemuka di Indonesia. Kami menawarkan berbagai produk berkualitas tinggi, mulai dari komponen hingga PC full set, untuk memenuhi kebutuhan gaming dan produktivitas Anda. Dengan pengalaman bertahun-tahun di industri ini, kami berkomitmen untuk memberikan layanan terbaik kepada pelanggan kami.
  </p>
</div>
</div>
<section class="bg-white py-16">
  <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
          <!-- Store Info -->
          <div class="p-6 bg-gray-50 rounded-lg shadow-md transform hover:scale-105 transition duration-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-4 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
              <h3 class="text-xl font-bold mb-2">Lokasi </h3>
              <p class="text-gray-600">Tembalang, Semarang, Jawa Tengah</p>
          </div>
          
          <!-- Product Info -->
          <div class="p-6 bg-gray-50 rounded-lg shadow-md transform hover:scale-105 transition duration-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-4 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
              </svg>
              <h3 class="text-xl font-bold mb-2">Produk Dijamin</h3>
              <p class="text-gray-600">ORIGINAL 100%</p>
          </div>
          
          <!-- Customer Info -->
          <div class="p-6 bg-gray-50 rounded-lg shadow-md transform hover:scale-105 transition duration-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-4 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
              </svg>
              <h3 class="text-xl font-bold mb-2">HUBUNG KAMI</h3>
              <p class="text-gray-600">+62 857 4115 8751</p>
          </div>
      </div>
</section>
<section class="relative bg-gradient-to-r from-black via-gray-800 to-black py-16 flex items-center justify-center">
  <div class="max-w-2xl mx-auto text-center px-4">
    <h2 class="text-4xl md:text-5xl font-extrabold mb-4 text-white drop-shadow-lg animate-pulse tracking-wide">
      SOLUSI TANPA RIBET RAKIT PC SENDIRI
    </h2>
    <p class="text-lg md:text-xl text-gray-200 mb-6 font-medium animate-fadeIn">
      Pilihan PC rakitan siap pakai, performa tinggi, dan garansi resmi. Tinggal pakai, tanpa pusing!
    </p>
    <a href="komponen.html" class="inline-block bg-white hover:bg-gray-200 text-black font-bold py-3 px-8 rounded-full shadow-lg transition duration-300 transform hover:scale-105 animate-bounce border border-gray-300">
      Lihat Paket PC
    </a>
  </div>
  <svg class="absolute bottom-0 left-0 w-full" height="40" viewBox="0 0 1440 40" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path fill="#fff" fill-opacity="1" d="M0,0 C480,40 960,0 1440,40 L1440,40 L0,40 Z"></path>
  </svg>
</section>
<footer class="bg-gray-800 text-white py-6">
  <div class="container mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <!-- About Us -->
      <div>
        <h3 class="text-lg font-bold mb-2">Tentang Kami</h3>
        <p class="text-sm">
          RED DRAGON adalah toko terpercaya yang menyediakan berbagai komponen PC dan rakitan PC berkualitas tinggi untuk kebutuhan gaming, kantor, dan lainnya.
        </p>
      </div>
      <!-- Quick Links -->
      <div>
        <h3 class="text-lg font-bold mb-2">Tautan Cepat</h3>
        <ul class="text-sm space-y-2">
          <li><a href="UTS.html" class="hover:underline">Beranda</a></li>
          <li><a href="tentangkami.php" class="hover:underline">Tentang Kami</a></li>
          <li><a href="komponen.html" class="hover:underline">Komponen</a></li>
          <li><a href="tes.php" class="hover:underline">AKUN</a></li>
        </ul>
      </div>
      <!-- Contact -->
      <div>
        <h3 class="text-lg font-bold mb-2">Kontak Kami</h3>
        <p class="text-sm">
          Email: reddragonPC@gmail.com<br />
          Telepon: +62 8574-1158-752<br />
          Alamat: Tembalang Semarang
        </p>
      </div>
    </div>
  </div>
  
  </div>
</footer>
<!-- Footer -->
<footer class="bg-black text-white text-center py-4">
  &copy; 2025 Red Dragon. Semua Hak Dilindungi.
</footer>
</body>
</html>