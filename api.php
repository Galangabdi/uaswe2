<?php
// api.php

session_start();
include('koneksi.php');

// Inisialisasi Keranjang
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = []; // format: [product_id => quantity]
}

$action = $_GET['action'] ?? '';
$data = json_decode(file_get_contents('php://input'), true);

switch ($action) {
    case 'get_cart':
        $cart_items = [];
        if (!empty($_SESSION['cart'])) {
            $product_ids = implode(',', array_keys($_SESSION['cart']));
            $sql = "SELECT id, nama_barang as name, harga as price, gambar as image FROM barang WHERE id IN ($product_ids)";
            $result = mysqli_query($koneksi, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $row['quantity'] = $_SESSION['cart'][$row['id']];
                $cart_items[] = $row;
            }
        }
        echo json_encode(['success' => true, 'data' => $cart_items]);
        break;

    case 'add_to_cart':
        $id = $data['id'] ?? 0;
        if ($id > 0) {
            $_SESSION['cart'][$id] = isset($_SESSION['cart'][$id]) ? $_SESSION['cart'][$id] + 1 : 1;
            echo json_encode(['success' => true, 'message' => 'Produk berhasil ditambahkan!']);
        } else {
            echo json_encode(['success' => false, 'error' => 'ID Produk tidak valid.']);
        }
        break;

    case 'update_cart':
        $id = $data['id'] ?? 0;
        $quantity = $data['quantity'] ?? 0;
        if ($id > 0 && $quantity > 0) {
            $_SESSION['cart'][$id] = $quantity;
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Data tidak valid.']);
        }
        break;

    case 'remove_from_cart':
        $id = $data['id'] ?? 0;
        if ($id > 0) {
            unset($_SESSION['cart'][$id]);
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'ID Produk tidak valid.']);
        }
        break;

    case 'clear_cart':
        $_SESSION['cart'] = [];
        echo json_encode(['success' => true]);
        break;

    default:
        echo json_encode(['success' => false, 'error' => 'Aksi tidak valid.']);
}

mysqli_close($koneksi);
?>