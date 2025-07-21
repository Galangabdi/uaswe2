<?php
session_start();
include("koneksi.php");

// CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    // CSRF check
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $error = "CSRF token tidak valid.";
    } else {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        // Validasi sederhana
        if ($username === "" || $email === "" || $password === "") {
            $error = "Semua field wajib diisi.";
        } else {
            // Cek duplikasi username/email
            $stmt = $koneksi->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
            $stmt->bind_param("ss", $username, $email);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $error = "Username atau email sudah terdaftar";
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $koneksi->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $username, $email, $hash);
                if ($stmt->execute()) {
                    header("Location: login.php");
                    exit();
                } else {
                    $error = "Gagal mendaftar. Silakan coba lagi.";
                }
            }
            $stmt->close();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daftar - RED DRAGON</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>
<body class="bg-white text-gray-800 pt-[56px]">
    <!-- Header -->
    <header class="bg-black text-white px-4 py-3 flex justify-between items-center fixed top-0 left-0 right-0 z-50">
        <div>
            <a href="UTS.html" class="text-2xl font-bold animate-pulse">RED DRAGON</a>
        </div>
        <nav class="space-x-4 hidden md:block">
            <a href="UTS.html" class="hover:underline">Beranda</a>
            <a href="tentangkami.html" class="hover:underline">Tentang Kami</a>
            <a href="komponen.html" class="hover:underline">Komponen</a>
            <a href="tes.html" class="hover:underline">AKUN</a>
        </nav>
    </header>

    <!-- Register Form -->
    <main class="container mx-auto px-4 py-16">
        <section class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-6 text-center">Daftar Akun Baru</h2>
            <?php if ($error): ?>
                <div class="mb-4 text-red-600 text-center"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <form action="register.php" method="POST" class="space-y-6">
                <!-- CSRF Token -->
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>" />

                <div>
                    <label for="username" class="block text-gray-700 mb-2">Username</label>
                    <input type="text" name="username" id="username" 
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-red-500" 
                           required aria-label="Username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" />
                </div>
                <div>
                    <label for="email" class="block text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" id="email" 
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-red-500" 
                           required aria-label="Email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" />
                </div>
                <div>
                    <label for="password" class="block text-gray-700 mb-2">Password</label>
                    <input type="password" name="password" id="password" 
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-red-500" 
                           required aria-label="Password" />
                </div>
                <div>
                    <button type="submit" name="register" 
                            class="w-full bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 transition-colors">
                        DAFTAR
                    </button>
                </div>
                <div class="text-center">
                    <p class="text-gray-600">Sudah punya akun? 
                        <a href="login.php" class="text-red-600 hover:underline">Masuk di sini</a>
                    </p>    
                </div>
            </form>
        </section>
    </main>

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