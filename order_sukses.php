<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Berhasil - Red Dragon</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100">

    <header class="bg-black text-white px-4 py-3 flex justify-between items-center shadow-md">
        <div>
            <a href="UTS.php" class="text-2xl font-bold animate-pulse">RED DRAGON</a>
        </div>
        <nav class="space-x-4">
            <a href="UTS.php" class="hover:underline">Beranda</a>
        </nav>
    </header>

    <main class="container mx-auto px-4 py-16 text-center">
        <div class="bg-white p-10 rounded-lg shadow-xl max-w-lg mx-auto">
            
            <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto">
                <svg class="w-16 h-16 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <h1 class="text-3xl font-bold text-gray-900 mt-6">Pesanan Berhasil!</h1>
            <p class="text-gray-600 mt-3">
                Terima kasih telah berbelanja di Red Dragon. Kami akan segera memproses pesanan Anda.
            </p>
            <p class="text-gray-600 mt-1">
                Detail konfirmasi akan dikirimkan ke email Anda.
            </p>
            
            <a href="uts.php" class="mt-8 inline-block rounded-md border border-transparent bg-red-600 py-3 px-8 text-base font-medium text-white hover:bg-red-700">
                Kembali ke Beranda
            </a>
        </div>
    </main>

    <footer class="bg-black text-white text-center py-4 mt-12">
        &copy; <?= date("Y") ?> Red Dragon. Semua Hak Dilindungi.
    </footer>

</body>
</html>