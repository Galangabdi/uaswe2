<!-- filepath: /c:/uts_web2/simpan.php -->
<?php
session_start();
include("koneksi.php");

if(isset($_POST['register'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $check = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username' OR email = '$email'");
    if(mysqli_num_rows($check) > 0) {
        $_SESSION['error'] = "Username atau email sudah terdaftar";
        header("Location: register.html");
    } else {
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        if(mysqli_query($koneksi, $sql)) {
            $_SESSION['success'] = "Registrasi berhasil! Silakan login.";
            header("Location: login.php");
        } else {
            $_SESSION['error'] = "Terjadi kesalahan saat mendaftar";
            header("Location: register.html");
        }
    }
    exit();
}
?>