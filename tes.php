<?php
session_start();
include("koneksi.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($koneksi, $sql);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RED DRAGON</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />

</head>
  <header class="bg-black text-white px-4 py-3 flex justify-between items-center fixed top-0 left-0 right-0 z-50">
        <div><a href="UTS.php" class="text-2xl font-bold animate-pulse">RED DRAGON</a></div>
        <nav class="space-x-4 hidden md:block">
            <a href="UTS.php" class="hover:underline">Beranda</a>
            <a href="tentangkami.php" class="hover:underline">Tentang Kami</a>
            <a href="komponen.html" class="hover:underline">Komponen</a>
            <a href="tes.php" class="hover:underline">Akun</a>
           
        </nav>
    </header>

<body class="bg-white text-gray-800 pt-[56px]">
    <!-- Header -->

    <!-- Dashboard Content -->
    <div class="container mx-auto px-4 py-28">
        <div class="max-w-4xl mx-auto bg-gray-800 p-8 rounded-lg shadow-lg text-white">
            <h2 class="text-3xl font-bold mb-6">Selamat Datang, <?php echo htmlspecialchars($user['username']); ?>!</h2>
            
            <!-- User Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-gray-700 p-4 rounded-lg">
                    <h3 class="text-xl font-semibold mb-2">Informasi Akun</h3>
                    <p class="mb-2">Username: <?php echo htmlspecialchars($user['username']); ?></p>
                    <p class="mb-2">Email: <?php echo htmlspecialchars($user['email']); ?></p>
                    <p>Bergabung: <?php echo date('d M Y', strtotime($user['created_at'])); ?></p>
                </div>
                
                <div class="bg-gray-700 p-4 rounded-lg">
                    <h3 class="text-xl font-semibold mb-2">Aksi</h3>
                    <div class="space-y-2">
                        <a href="edit_profile.php" class="block w-full bg-red-600 text-white py-2 px-4 rounded hover:bg-red-700 text-center">Edit Profil</a>
                        <a href="logout.php" class="block w-full bg-gray-600 text-white py-2 px-4 rounded hover:bg-gray-700 text-center">Keluar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
   
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
</footer>
</body>
</html>