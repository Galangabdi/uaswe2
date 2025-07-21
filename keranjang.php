<?php

session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Red Dragon</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .toast {
            padding: 12px 20px;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            opacity: 0;
            transform: translateX(100%);
            transition: all 0.4s ease;
        }
        .toast.show {
            opacity: 1;
            transform: translateX(0);
        }
        .toast.success { background-color: #28a745; }
        .toast.error { background-color: #dc3545; }
    </style>
</head>
<body class="bg-gray-100">

    <div id="toast-container" class="toast-container"></div>

    <header class="bg-black text-white px-4 py-3 flex justify-between items-center shadow-md">
        <div>
            <a href="uts.php" class="text-2xl font-bold animate-pulse">RED DRAGON</a>
        </div>
        <nav class="space-x-4">
            <a href="uts.php" class="hover:underline">Beranda</a>
            <a href="keranjang.php" class="relative inline-flex items-center group">
                <span class="inline-flex items-center px-3 py-1 rounded-full bg-red-600">Keranjang</span>
                <span id="cart-count-badge" class="absolute -top-2 -right-2 bg-yellow-400 text-black text-xs font-bold px-2 py-0.5 rounded-full"><?= array_sum($_SESSION['cart'] ?? []) ?></span>
            </a>
        </nav>
    </header>

    <main class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex items-baseline justify-between border-b border-gray-200 pb-6">
            <h1 class="text-4xl font-bold tracking-tight text-gray-900">Keranjang Belanja</h1>
        </div>

        <div id="cart-content" class="mt-8 lg:grid lg:grid-cols-12 lg:items-start lg:gap-x-12 xl:gap-x-16">
            <div id="loading-spinner" class="lg:col-span-12 flex justify-center items-center py-16">
                 <div class="w-12 h-12 border-4 border-t-red-600 border-gray-200 rounded-full animate-spin"></div>
            </div>
            </div>
    </main>
    
    <footer class="bg-black text-white text-center py-4 mt-12">
        &copy; <?= date("Y") ?> Red Dragon. Semua Hak Dilindungi.
    </footer>

<script>
    document.addEventListener('DOMContentLoaded', loadCart);

    function formatRupiah(amount) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(amount);
    }

    // Fungsi untuk menampilkan notifikasi toast
    function showToast(message, type = 'success') {
        const container = document.getElementById('toast-container');
        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        toast.textContent = message;
        container.appendChild(toast);

        setTimeout(() => {
            toast.classList.add('show');
        }, 10);

        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => toast.remove(), 500);
        }, 3000);
    }

    async function apiCall(action, data = null) {
        const options = {
            method: data ? 'POST' : 'GET',
            headers: {'Content-Type': 'application/json'},
            body: data ? JSON.stringify(data) : null
        };
        const response = await fetch(`api.php?action=${action}`, options);
        return await response.json();
    }

    async function loadCart() {
        const cartContent = document.getElementById('cart-content');
        const loadingSpinner = document.getElementById('loading-spinner');
        loadingSpinner.style.display = 'flex'; // Tampilkan spinner

        try {
            const response = await apiCall('get_cart');
            if (response.success) {
                renderCart(response.data);
                updateCartCountBadge(response.data);
            } else {
                showToast('Gagal memuat keranjang.', 'error');
            }
        } catch (error) {
            showToast('Terjadi kesalahan koneksi.', 'error');
            console.error(error);
        } finally {
            loadingSpinner.style.display = 'none'; // Sembunyikan spinner
        }
    }
    
    function updateCartCountBadge(cartData) {
        const totalItems = cartData.reduce((sum, item) => sum + item.quantity, 0);
        document.getElementById('cart-count-badge').textContent = totalItems;
    }

    function renderCart(cartData) {
        const cartContent = document.getElementById('cart-content');
        if (cartData.length === 0) {
            cartContent.innerHTML = `
                <div class="lg:col-span-12 text-center py-16 px-4 bg-white rounded-lg shadow-md">
                    <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m13-9l2 9m-5-9V6a2 2 0 10-4 0v3" /></svg>
                    <h2 class="mt-4 text-2xl font-bold text-gray-900">Keranjang Anda Kosong</h2>
                    <p class="mt-2 text-base text-gray-500">Ayo temukan PC impian Anda di halaman utama!</p>
                    <a href="uts.php" class="mt-6 inline-block rounded-md border border-transparent bg-red-600 py-3 px-8 text-base font-medium text-white hover:bg-red-700">Lanjut Belanja</a>
                </div>
            `;
            return;
        }

        const itemsHtml = cartData.map(item => `
            <div class="flex items-start justify-between py-6 border-b border-gray-200">
                <div class="flex items-center">
                    <img src="${item.gambar}" alt="${item.name}" class="flex-shrink-0 w-24 h-24 object-cover bg-gray-200 rounded-md sm:w-32 sm:h-32">
                    <div class="ml-4 sm:ml-6">
                        <h3 class="text-lg font-medium text-gray-900">${item.name}</h3>
                        <p class="mt-1 text-lg font-bold text-gray-900">${formatRupiah(item.price)}</p>
                    </div>
                </div>
                <div class="ml-4 flex flex-col items-end">
                    <div class="flex items-center border border-gray-300 rounded-md">
                        <button onclick="updateQuantity(${item.id}, ${item.quantity - 1})" class="px-3 py-1 text-gray-600 hover:bg-gray-100 rounded-l-md" ${item.quantity <= 1 ? 'disabled' : ''}>-</button>
                        <span class="px-4 py-1 text-gray-900 font-medium">${item.quantity}</span>
                        <button onclick="updateQuantity(${item.id}, ${item.quantity + 1})" class="px-3 py-1 text-gray-600 hover:bg-gray-100 rounded-r-md">+</button>
                    </div>
                    <p class="mt-2 text-base font-bold text-gray-900">${formatRupiah(item.price * item.quantity)}</p>
                    <button onclick="removeItem(${item.id})" class="mt-4 text-sm font-medium text-red-600 hover:text-red-500">Hapus</button>
                </div>
            </div>
        `).join('');
        
        const subtotal = cartData.reduce((sum, item) => sum + item.price * item.quantity, 0);
        const tax = subtotal * 0.11; // PPN 11%
        const shipping = 25000;
        const total = subtotal + tax + shipping;

        cartContent.innerHTML = `
            <section class="lg:col-span-8">
                <div class="bg-white rounded-lg shadow-md">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200 flex justify-between items-center">
                        <h2 class="text-lg font-medium text-gray-900">${cartData.length} Produk</h2>
                        <button onclick="clearCart()" class="text-sm font-medium text-red-600 hover:text-red-500">Hapus Semua</button>
                    </div>
                    <div class="divide-y divide-gray-200 px-4 sm:px-6">${itemsHtml}</div>
                </div>
            </section>
            
            <section class="lg:col-span-4 mt-8 lg:mt-0">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-28">
                    <h2 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-4">Ringkasan Belanja</h2>
                    <div class="mt-4 space-y-4">
                        <div class="flex items-center justify-between"><dt class="text-sm text-gray-600">Subtotal</dt><dd class="text-sm font-medium text-gray-900">${formatRupiah(subtotal)}</dd></div>
                        <div class="flex items-center justify-between"><dt class="text-sm text-gray-600">Ongkos Kirim</dt><dd class="text-sm font-medium text-gray-900">${formatRupiah(shipping)}</dd></div>
                        <div class="flex items-center justify-between"><dt class="text-sm text-gray-600">Pajak (11%)</dt><dd class="text-sm font-medium text-gray-900">${formatRupiah(tax)}</dd></div>
                        <div class="flex items-center justify-between border-t border-gray-200 pt-4"><dt class="text-base font-bold text-gray-900">Total</dt><dd class="text-base font-bold text-gray-900">${formatRupiah(total)}</dd></div>
                    </div>
                    <div class="mt-6">
    <a href="checkout.php" class="block w-full rounded-md border border-transparent bg-red-600 py-3 px-4 text-center text-base font-medium text-white shadow-sm hover:bg-red-700">Lanjutkan ke Pembayaran</a>
</div>
                </div>
            </section>
        `;
    }

    async function updateQuantity(id, quantity) {
        if (quantity < 1) {
            removeItem(id);
            return;
        }
        await apiCall('update_cart', { id, quantity });
        showToast('Jumlah produk diperbarui');
        loadCart();
    }

    async function removeItem(id) {
        await apiCall('remove_from_cart', { id });
        showToast('Produk dihapus', 'error');
        loadCart();
    }
    
    async function clearCart() {
        if (confirm('Anda yakin ingin mengosongkan keranjang?')) {
            await apiCall('clear_cart');
            showToast('Keranjang dikosongkan', 'error');
            loadCart();
        }
    }
    
    function checkout() {
        alert('Fitur checkout belum diimplementasikan. Keranjang akan disimulasikan sebagai telah dibayar dan dikosongkan.');
        clearCart();
    }
</script>

</body>
</html>