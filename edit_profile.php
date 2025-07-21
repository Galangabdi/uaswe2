<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include("koneksi.php");

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($koneksi, $sql);
$user = mysqli_fetch_assoc($result);

if(isset($_POST['update'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $new_password = $_POST['new_password'];
    
    if (strpos($username, ' ') !== false) {
        $error = "Username tidak boleh mengandung spasi";
    } else {
        $check_username = mysqli_query($koneksi, "SELECT id FROM users WHERE username = '$username' AND id != $user_id");
        if(mysqli_num_rows($check_username) > 0) {
            $error = "Username sudah digunakan";
        } else {
            $update_sql = "UPDATE users SET username = '$username', email = '$email'";
            if(!empty($new_password)) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $update_sql .= ", password = '$hashed_password'";
            }
            $update_sql .= " WHERE id = $user_id";
            
            if(mysqli_query($koneksi, $update_sql)) {
                $_SESSION['username'] = $username;
                $_SESSION['success_message'] = "Profil berhasil diperbarui!";
                header("Location: tes.php");
                exit();
            } else {
                $error = "Gagal memperbarui profil. Silakan coba lagi.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Red Dragon Sport</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>

<body class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 min-h-screen pt-[56px] text-gray-200">

<!-- Header -->
<header class="bg-black bg-opacity-90 text-white px-4 py-3 flex justify-between items-center fixed top-0 left-0 right-0 z-50 shadow-lg">
    <div>
        <a href="UTS.html" class="text-2xl font-bold animate-pulse tracking-wide">RED DRAGON</a>
    </div>
    <nav class="space-x-4 hidden md:block">
        <a href="UTS.html" class="hover:underline">Beranda</a>
        <a href="tentangkami.php" class="hover:underline">tentang kami</a>
        <a href="komponen.html" class="hover:underline">komponen</a>
        <a href="tes.php" class="hover:underline">AKUN</a>
    </nav>
</header>

<div class="flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-gradient-to-br from-gray-800 via-gray-900 to-black rounded-2xl shadow-2xl p-8 mt-10 border border-gray-700">
        <div class="text-center mb-6">
            <div class="flex justify-center mb-2">
                <span class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-tr from-red-600 to-blue-700 shadow-lg border-4 border-gray-900">
                    <i class="fa fa-user-circle text-white text-4xl"></i>
                </span>
            </div>
            <h4 class="text-2xl font-bold text-white mb-1">Edit Profil</h4>
            <p class="text-gray-400">Perbarui data akun Anda di sini</p>
        </div>
        <?php if(isset($error)): ?>
            <div class="bg-red-900 border border-red-700 text-red-300 px-4 py-3 rounded mb-4 text-sm">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <form method="post" autocomplete="off" class="space-y-5">
            <div>
                <label class="block text-gray-300 font-semibold mb-1">Username (tanpa spasi)</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                        <i class="fa fa-user"></i>
                    </span>
                    <input type="text" name="username"
                        class="pl-10 pr-4 py-2 w-full rounded-lg border border-gray-700 bg-gray-900 text-gray-200 focus:ring-2 focus:ring-red-500 focus:outline-none transition"
                        value="<?php echo htmlspecialchars($user['username']); ?>"
                        required pattern="\S*"
                        title="Username tidak boleh mengandung spasi"
                        oninput="this.value = this.value.replace(/\s/g, '')"
                        placeholder="Masukkan username">
                </div>
            </div>
            <div>
                <label class="block text-gray-300 font-semibold mb-1">Email</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                        <i class="fa fa-envelope"></i>
                    </span>
                    <input type="email" name="email"
                        class="pl-10 pr-4 py-2 w-full rounded-lg border border-gray-700 bg-gray-900 text-gray-200 focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                        value="<?php echo htmlspecialchars($user['email']); ?>" required
                        placeholder="Masukkan email">
                </div>
            </div>
            <div>
                <label class="block text-gray-300 font-semibold mb-1">Password Baru (Kosongkan jika tidak ingin mengubah)</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                        <i class="fa fa-lock"></i>
                    </span>
                    <input type="password" name="new_password"
                        class="pl-10 pr-4 py-2 w-full rounded-lg border border-gray-700 bg-gray-900 text-gray-200 focus:ring-2 focus:ring-purple-500 focus:outline-none transition"
                        placeholder="Password baru">
                </div>
            </div>
            <div class="flex justify-between mt-6">
                <button type="submit" name="update"
                    class="bg-gradient-to-r from-red-600 to-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow hover:scale-105 hover:from-red-700 hover:to-blue-800 transition transform duration-200">
                    <i class="fa fa-save mr-2"></i> Simpan
                </button>
                <a href="tes.php"
                    class="bg-gray-700 text-gray-200 font-semibold py-2 px-6 rounded-lg hover:bg-gray-600 transition">
                    <i class="fa fa-arrow-left mr-2"></i> Kembali
                </a>
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
