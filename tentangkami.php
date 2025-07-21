<?php
include("koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Ambil dan filter input
  $nama   = mysqli_real_escape_string($koneksi, $_POST["nama"]);
  $email  = mysqli_real_escape_string($koneksi, $_POST["email"]);
  $notelp = mysqli_real_escape_string($koneksi, $_POST["notelp"]);
  $pesan  = mysqli_real_escape_string($koneksi, $_POST["komentar"]);

  // Menggunakan prepared statement untuk keamanan
  $stmt = mysqli_prepare($koneksi, "INSERT INTO buku_tamu(nama, email, notelp, komentar) VALUES (?, ?, ?, ?)");
  mysqli_stmt_bind_param($stmt, "ssss", $nama, $email, $notelp, $pesan);
  $result = mysqli_stmt_execute($stmt);

  if (!$result) {
    die("Error: " . mysqli_error($koneksi));
  }

  // Redirect setelah submit
  header('Location: tentangkami.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tentang Kami - Red Dragon Sport</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>
<body class="bg-white text-gray-800 pt-[56px]">
  <!-- Header -->
  <header class="bg-black text-white px-4 py-3 flex justify-between items-center fixed top-0 left-0 right-0 z-50">
        <div><a href="UTS.php" class="text-2xl font-bold animate-pulse">RED DRAGON</a></div>
        <nav class="space-x-4 hidden md:block">
            <a href="UTS.php" class="hover:underline">Beranda</a>
            <a href="tentangkami.php" class="hover:underline">Tentang Kami</a>
            <a href="komponen.html" class="hover:underline">Komponen</a>
            <a href="tes.php" class="hover:underline">Akun</a>
            
        </nav>
    </header>

  <!-- Hero Section -->
  <div class="relative h-[400px] overflow-hidden">
  <img src="https://images.unsplash.com/photo-1587202372775-1d5c2e6e7b4b?ixlib=rb-4.0.3" 
     alt="PC Store Hero" 
     class="w-full h-full object-cover">
  <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <h1 class="text-white text-5xl font-bold">Tentang Kami</h1>
  </div>
  </div>

  <!-- Company Story -->
  <section class="py-16 px-4 bg-gray-900 text-gray-300">
  <div class="max-w-4xl mx-auto">
    <h2 class="text-3xl font-bold mb-8 text-center text-red-500">TOKO KAMI</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <div class="space-y-4">
      <p class="leading-relaxed">
      Red Dragon PC Store didirikan kemarin malam dengan tujuan menyediakan solusi 
      terbaik untuk kebutuhan komputer dan gaming di Indonesia. Kami memulai dengan 
      satu toko kecil di Jakarta.
      </p>
      <p class="leading-relaxed">
      Kini, kami telah berkembang menjadi salah satu penyedia PC dan aksesoris gaming 
      terkemuka dengan jaringan luas di seluruh Indonesia.
      </p>
    </div>
    <div class="rounded-lg overflow-hidden shadow-lg">
      <img src="https://logowik.com/content/uploads/images/red-dragon1621.logowik.com.webp" 
       alt="PC Store Image" 
       class="w-full h-full object-cover">
    </div>
    </div>
  </div>
  </section>

  <!-- Contact Section -->
  <section id="contact" class="py-12 bg-gray-900 text-gray-200">
  <div class="max-w-4xl mx-auto px-4">
    <div class="mb-8 text-center">
    <h2 class="text-2xl md:text-3xl font-bold text-red-500">Hubungi Kami</h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
    <div>
      <form action="tentangkami.php" method="post" class="space-y-4">
      <div>
        <input name="nama" type="text" placeholder="Nama Lengkap"
        class="w-full px-4 py-2 rounded bg-gray-800 text-gray-100 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-red-500" required />
      </div>
      <div>
        <input name="email" type="email" placeholder="Email"
        class="w-full px-4 py-2 rounded bg-gray-800 text-gray-100 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-red-500" required />
      </div>
      <div>
        <input name="notelp" type="number" placeholder="Nomor Telepon"
        class="w-full px-4 py-2 rounded bg-gray-800 text-gray-100 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-red-500" required />
      </div>
      <div>
        <textarea name="komentar" rows="4" placeholder="Pesan"
        class="w-full px-4 py-2 rounded bg-gray-800 text-gray-100 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-red-500 resize-none" required></textarea>
      </div>
      <div>
        <button type="submit"
        class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2 rounded transition duration-200">KIRIM</button>
      </div>
      </form>
    </div>
    <div class="flex justify-center">
      <img src="https://i.pinimg.com/736x/1b/50/e5/1b50e5e2697d33a01f0a66ca54fb4157.jpg"
      alt="Hubungi Kami" class="rounded-lg shadow-lg w-full max-w-xs object-cover" />
    </div>
    </div>
  </div>
  </section>

  <!-- Buku Tamu Table -->
  <section class="py-8 bg-gradient-to-r from-gray-100 to-gray-200">
    <div class="max-w-3xl mx-auto px-4">
      <h2 class="text-2xl font-extrabold mb-6 text-center text-red-600 tracking-wide">Buku Tamu Terbaru</h2>
      <?php
      include("koneksi.php");
      $sql = "SELECT * FROM buku_tamu ORDER BY id DESC LIMIT 3";
      $result = mysqli_query($koneksi, $sql);

      if ($result && mysqli_num_rows($result) > 0) {
        echo "<div class='grid gap-6 md:grid-cols-3'>";
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<div class='bg-white rounded-xl shadow-lg p-6 flex flex-col items-center border-t-4 border-red-500'>";
          echo "<div class='w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mb-4'>
                  <span class='text-2xl font-bold text-red-600'>".strtoupper(substr(htmlspecialchars($row['nama']),0,1))."</span>
                </div>";
          echo "<h3 class='font-semibold text-lg text-gray-800 mb-1'>".htmlspecialchars($row['nama'])."</h3>";
          echo "<p class='text-sm text-gray-500 mb-2'>".htmlspecialchars($row['email'])." | ".htmlspecialchars($row['notelp'])."</p>";
          echo "<blockquote class='italic text-gray-700 text-center mt-2'>“".htmlspecialchars($row['komentar'])."”</blockquote>";
          echo "</div>";
        }
        echo "</div>";
      } else {
        echo "<p class='text-center text-gray-500'>Belum ada komentar di buku tamu.</p>";
      }
      ?>
    </div>
  </section>

  <!-- Footer -->
  <<footer class="bg-gray-800 text-white py-6">
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
</footer>
</body>
</html>
