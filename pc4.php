<!DOCTYPE html>
<html lang="id">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Detail Produk</title>
  <meta charset="UTF-8" />

  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Red Dragon Sport</title>
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
        <a href="UTS.html" class="hover:underline">Beranda</a>
        <a href="tentangkami.html" class="hover:underline">tentang kami</a>
        <a href="komponen.html" class="hover:underline">komponen</a>
        <a href="tes.html" class="hover:underline">AKUN</a>
</nav>
</header>
  <style>
     body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background: #ff0000; /* Warna sedikit lebih gelap */
  }

  .container {
    display: flex;
    flex-wrap: wrap;
    max-width: 1000px;
    margin: 100px auto;
    background: #ffffff;
    padding: 70px;
    box-shadow: 0 4px 60px rgba(21, 0, 255, 0.1);
    border-radius: 10px;
  }

    .product-image {
      flex: 1;
      padding: 20px;
    }

    .product-image img {
      max-width: 100%;
      border-radius: 10px;
    }

    .product-details {
      flex: 1;
      padding: 20px;
    }

    .product-title {
      font-size: 28px;
      margin-bottom: 10px;
    }

    .product-price {
      font-size: 24px;
      color: #e91e63;
      margin-bottom: 20px;
    }

    .product-description {
      font-size: 16px;
      line-height: 1.5;
      margin-bottom: 20px;
    }

    .product-options label {
      display: block;
      margin: 10px 0 5px;
      font-weight: bold;
    }

    .product-options select {
      width: 100%;
      padding: 8px;
      border-radius: 5px;
      border: 1px solid #ccc;
      margin-bottom: 20px;
    }

    .buy-button {
      background-color: #4CAF50;
      color: white;
      padding: 15px 30px;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .buy-button:hover {
      background-color: #388e3c;
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
      }
    }
  </style>
</head>
<body>

  <div class="container max-w-[800px] p-6 bg-white shadow-lg rounded-lg border border-gray-200">
    <div class="product-image">
      <img class="rounded-lg shadow-md" src="https://m.media-amazon.com/images/I/71Jy64rSkfS.jpg" alt="PC Gaming Set">
    </div>
    <div class="product-details">
      <h1 class="product-title text-3xl font-bold text-gray-800 mb-4">PC MSI</h1>
      <p class="product-price text-2xl font-semibold text-red-500 mb-4">Rp 2O.000.000</p>
      <p class="product-description text-gray-700 leading-relaxed mb-6">
        Paket PC Gaming lengkap dengan spesifikasi tinggi:
        <ul class="list-disc list-inside mt-2">
          <li>Intel Core i7 12700K</li>
          <li>RTX 3070 8GB</li>
          <li>16GB RAM DDR4</li>
          <li>1TB SSD NVMe</li>
        </ul>
      </p>

      <div class="product-options mt-5">
        <h2 class="text-xl font-semibold text-red-600 mb-2">Processor</h2>
        <p class="text-gray-800 mb-4">Intel Core i7 12700K</p>
          
        <h2 class="text-xl font-semibold text-red-600 mb-2 mt-5">Graphics Card</h2>
        <p class="text-gray-800">RTX 3070 8GB</p>
      </div>
      <div class="mt-6">
        <button class="buy-button w-full py-3 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600 transition-colors shadow-md animate-pulse ">
          Beli Sekarang
        </button>
      </div>
    </div>
  </div>
  <div class="w-full p-8 bg-gray-50 shadow-lg backdrop-blur-sm mt-20 mx-8">
    <h2 class="text-3xl font-bold mb-6 text-gray-800 text-center">Ulasan Produk</h2>
    <div class="flex justify-center mb-8">
      <div class="flex space-x-3 animate-pulse" id="star-rating">
        <span class="text-3xl cursor-pointer hover:text-yellow-400 transition-colors">★</span>
        <span class="text-3xl cursor-pointer hover:text-yellow-400 transition-colors">★</span>
        <span class="text-3xl cursor-pointer hover:text-yellow-400 transition-colors">★</span>
        <span class="text-3xl cursor-pointer hover:text-yellow-400 transition-colors">★</span>
        <span class="text-3xl cursor-pointer hover:text-yellow-400 transition-colors">★</span>
      </div>
    </div>
    <form class="space-y-8 max-w-2xl mx-auto" action="simpan.php" method="POST">
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Anda</label>
        <input type="text" name="nama" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-blue-500 focus:outline-none transition-colors" required>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Ulasan Anda</label>
        <textarea name="ulasan" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-blue-500 focus:outline-none transition-colors" rows="4" required></textarea>
      </div>
      <input type="hidden" name="rating" id="rating" value="5">
      <button type="submit" class="w-full bg-black text-white py-3 rounded-lg hover:bg-gray-800 transition-colors font-medium animate-bounce">
        Kirim Ulasan
      </button>
    </form>
    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
      <div class="max-w-2xl mx-auto mt-6 p-4 bg-green-100 text-green-800 rounded-lg">
          Ulasan Anda berhasil disimpan! Terima kasih atas ulasan Anda.
      </div>
    <?php endif; ?>

    <?php
    // Koneksi ke database
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "uts_web2";
    $conn = new mysqli($host, $user, $pass, $db);

    // Cek koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Ambil ulasan dari database
    $ulasan = [];
    $result = $conn->query("SELECT nama, ulasan, rating, created_at FROM reviews ORDER BY created_at DESC LIMIT 10");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $ulasan[] = $row;
        }
    }
    ?>
    <div class="review-list flex space-x-6 overflow-x-auto pb-4 mt-8">
        <?php if (!empty($ulasan)): ?>
            <?php foreach ($ulasan as $u): ?>
                <div class="bg-white rounded-lg shadow-md p-4 min-w-[250px] max-w-xs">
                    <div class="flex items-center mb-2">
                        <span class="font-bold text-gray-800 mr-2"><?= htmlspecialchars($u['nama']) ?></span>
                        <span>
                            <?php for ($i = 0; $i < $u['rating']; $i++): ?>
                                <span class="text-yellow-400">★</span>
                            <?php endfor; ?>
                            <?php for ($i = $u['rating']; $i < 5; $i++): ?>
                                <span class="text-gray-300">★</span>
                            <?php endfor; ?>
                        </span>
                    </div>
                    <div class="text-gray-700 mb-1"><?= nl2br(htmlspecialchars($u['ulasan'])) ?></div>
                    <div class="text-xs text-gray-400"><?= date('d M Y H:i', strtotime($u['created_at'])) ?></div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-gray-500">Belum ada ulasan.</p>
        <?php endif; ?>
    </div>
  </div>


  <script>
    // Star rating selection
    let selectedRating = 5; // Default rating
    const stars = document.querySelectorAll('#star-rating > span');
    stars.forEach((star, idx) => {
      star.addEventListener('mouseenter', () => {
        stars.forEach((s, i) => {
          s.classList.toggle('text-yellow-400', i <= idx);
        });
      });
      star.addEventListener('mouseleave', () => {
        stars.forEach((s, i) => {
          s.classList.toggle('text-yellow-400', i < selectedRating);
        });
      });
      star.addEventListener('click', () => {
        selectedRating = idx + 1;
        document.getElementById('rating').value = selectedRating;
        stars.forEach((s, i) => {
          s.classList.toggle('text-yellow-400', i < selectedRating);
        });
      });
    });
  </script>
</body>
</html>