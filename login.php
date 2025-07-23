<?php
session_start();
include("koneksi.php");

if (isset($_POST['login'])) {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_prepare($koneksi, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['name'] = $row['name'];
                mysqli_stmt_close($stmt);
                header("Location: UTS.php");
                exit();
            }
        }
        mysqli_stmt_close($stmt);
    }
    $error = "Username atau password salah";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - RED DRAGON</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>
<body class="bg-white text-gray-800 pt-[56px]">
    <!-- Header -->
    <header class="bg-black text-white px-4 py-3 flex justify-between items-center fixed top-0 left-0 right-0 z-50">
        <div>
            <a href="UTS.html" class="text-2xl font-bold animate-pulse">RED DRAGON</a>
        </div>
        <nav class="space-x-4 hidden md:block">
            <a href="index.html" class="hover:underline">Beranda</a>
            <a href="tentangkami.html" class="hover:underline">Tentang Kami</a>
            <a href="komponen.html" class="hover:underline">Komponen</a>
            <a href="tes.html" class="hover:underline">AKUN</a>
        </nav>
    </header>

    <!-- Login Form -->
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-md mx-auto bg-gray-800 p-8 rounded-lg shadow-lg text-white">
            <h2 class="text-2xl font-bold mb-6 text-center">Masuk ke Akun Anda</h2>
            
            <?php if (isset($error)): ?>
                <div class="bg-red-500 text-white p-3 rounded mb-4">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form method="post" class="space-y-6">
                <div>
                    <label for="username" class="block text-sm font-medium">Username</label>
                    <input type="text" name="username" id="username" required
                           class="w-full px-4 py-2 bg-gray-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" />
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium">Password</label>
                    <input type="password" name="password" id="password" required
                           class="w-full px-4 py-2 bg-gray-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" />
                </div>
                <button type="submit" name="login" 
                        class="w-full bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 transition-colors">
                    MASUK
                </button>
                <div class="text-center">
                    <p class="text-gray-300">Belum punya akun? 
                        <a href="register.php" class="text-red-400 hover:underline">Daftar di sini</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
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