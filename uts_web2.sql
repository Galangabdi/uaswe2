-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2025 at 08:26 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uts_web2`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama_barang`, `harga`, `gambar`, `deskripsi`) VALUES
(1, 'PC Gaming Core i7, RTX 3060', 15500000, 'https://static.wixstatic.com/media/7b4519_25c01111921f4bf1a744f51148c0c341~mv2.jpg/v1/crop/x_0,y_2,w_500,h_497/fill/w_272,h_270,al_c,q_80,usm_0.66_1.00_0.01,enc_avif,quality_auto/Raptor%20Diamond.jpg', 'PC dengan performa tinggi untuk gaming AAA terbaru. Dilengkapi prosesor Intel Core i7 Gen 12 dan VGA NVIDIA GeForce RTX 3060, siap untuk pengalaman gaming yang imersif.'),
(2, 'PC Editing & Rendering Ryzen 7', 18250000, 'https://nguyencongpc.vn/media/product/25488-bts-vip-01-234.jpg', 'Dibangun untuk para kreator konten. Prosesor AMD Ryzen 7 yang kuat dan RAM besar mempercepat proses rendering video dan desain grafis.'),
(3, 'Workstation PC Intel Xeon', 25000000, 'https://breunor.com/cdn/shop/files/PC_Gaming_i7_14700K_RX_7900XTX_24GB_Ram_32Gb_DDR5_6000MHz_SSD_NVMe_2000GB_Dissipatore_a_liquido_240mm_Windows_11.png?v=1741018321\" alt=\"PC Gaming Set', 'Stabilitas dan keandalan tinggi untuk pekerjaan profesional. Didukung oleh Intel Xeon dan memori ECC untuk penggunaan 24/7.'),
(4, 'PC Office & Home Use Core i3', 5750000, 'https://m.media-amazon.com/images/I/71Jy64rSkfS.jpg', 'Solusi hemat daya dan efisien untuk pekerjaan kantor, sekolah, dan penggunaan sehari-hari. Cepat, ringkas, dan andal.');

-- --------------------------------------------------------

--
-- Table structure for table `buku_tamu`
--

CREATE TABLE `buku_tamu` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `notelp` varchar(15) NOT NULL,
  `komentar` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku_tamu`
--

INSERT INTO `buku_tamu` (`id`, `nama`, `email`, `notelp`, `komentar`, `created_at`) VALUES
(1, '', '', '', '', '2025-05-01 15:42:22'),
(2, '', '', '', '', '2025-05-01 15:42:38'),
(3, '', '', '', '', '2025-05-01 15:42:54'),
(4, '', '', '', '', '2025-05-01 15:43:08'),
(5, '', '', '', '', '2025-05-01 15:48:38'),
(6, '', '', '', '', '2025-05-01 15:48:39'),
(7, '', '', '', '', '2025-05-01 15:48:39'),
(8, '', '', '', '', '2025-05-01 15:48:39'),
(9, '', '', '', '', '2025-05-01 15:48:39'),
(10, '', '', '', '', '2025-05-01 15:48:39'),
(11, '', '', '', '', '2025-05-01 15:48:39'),
(12, '', '', '', '', '2025-05-01 15:48:39'),
(13, '', '', '', '', '2025-05-01 15:48:39'),
(14, '', '', '', '', '2025-05-01 15:48:39'),
(15, '', '', '', '', '2025-05-01 15:48:39'),
(16, '', '', '', '', '2025-05-01 15:48:39'),
(17, '', '', '', '', '2025-05-01 15:48:39'),
(18, '', '', '', '', '2025-05-01 15:48:39'),
(19, '', '', '', '', '2025-05-01 15:48:39'),
(20, '', '', '', '', '2025-05-01 15:48:39'),
(21, '', '', '', '', '2025-05-01 15:48:39'),
(22, '', '', '', '', '2025-05-01 15:48:39'),
(23, '', '', '', '', '2025-05-01 15:48:39'),
(24, '', '', '', '', '2025-05-01 15:48:40'),
(25, '', '', '', '', '2025-05-01 15:48:41'),
(26, '', '', '', '', '2025-05-01 15:48:41'),
(27, '', '', '', '', '2025-05-01 15:48:41'),
(28, '', '', '', '', '2025-05-01 15:48:41'),
(29, '', '', '', '', '2025-05-01 15:48:41'),
(30, '', '', '', '', '2025-05-01 15:48:41'),
(31, '', '', '', '', '2025-05-01 15:48:41'),
(32, '', '', '', '', '2025-05-01 15:48:41'),
(33, '', '', '', '', '2025-05-01 15:48:41'),
(34, '', '', '', '', '2025-05-01 15:48:41'),
(35, '', '', '', '', '2025-05-01 15:48:41'),
(36, '', '', '', '', '2025-05-01 15:48:41'),
(37, '', '', '', '', '2025-05-01 15:48:41'),
(38, '', '', '', '', '2025-05-01 15:48:41'),
(39, '', '', '', '', '2025-05-01 15:48:41'),
(40, '', '', '', '', '2025-05-01 15:48:42'),
(41, '', '', '', '', '2025-05-01 15:48:42'),
(42, '', '', '', '', '2025-05-01 15:48:42'),
(43, '', '', '', '', '2025-05-01 15:48:42'),
(44, '', '', '', '', '2025-05-01 15:48:42'),
(45, '', '', '', '', '2025-05-01 15:48:42'),
(46, '', '', '', '', '2025-05-01 15:48:42'),
(47, '', '', '', '', '2025-05-01 15:48:42'),
(48, '', '', '', '', '2025-05-01 15:48:42'),
(49, '', '', '', '', '2025-05-01 15:48:42'),
(50, '', '', '', '', '2025-05-01 15:48:42'),
(51, '', '', '', '', '2025-05-01 15:48:42'),
(52, '', '', '', '', '2025-05-01 15:48:42'),
(53, '', '', '', '', '2025-05-01 15:48:42'),
(54, '', '', '', '', '2025-05-01 15:48:43'),
(55, '', '', '', '', '2025-05-01 15:48:43'),
(56, '', '', '', '', '2025-05-01 15:48:43'),
(57, '', '', '', '', '2025-05-01 15:48:43'),
(58, '', '', '', '', '2025-05-01 15:48:43'),
(59, '', '', '', '', '2025-05-01 15:48:43'),
(60, '', '', '', '', '2025-05-01 15:48:43'),
(61, '', '', '', '', '2025-05-01 15:48:43'),
(62, '', '', '', '', '2025-05-01 15:48:43'),
(63, '', '', '', '', '2025-05-01 15:48:43'),
(64, '', '', '', '', '2025-05-01 15:48:43'),
(65, '', '', '', '', '2025-05-01 15:48:48'),
(66, '', '', '', '', '2025-05-01 15:48:48'),
(67, '', '', '', '', '2025-05-01 15:48:48'),
(68, '', '', '', '', '2025-05-01 15:48:48'),
(69, '', '', '', '', '2025-05-01 15:48:48'),
(70, '', '', '', '', '2025-05-01 15:48:48'),
(71, '', '', '', '', '2025-05-01 15:48:49'),
(72, '', '', '', '', '2025-05-01 15:48:49'),
(73, '', '', '', '', '2025-05-01 15:48:49'),
(74, '', '', '', '', '2025-05-01 15:48:49'),
(75, '', '', '', '', '2025-05-01 15:48:49'),
(76, '', '', '', '', '2025-05-01 15:48:49'),
(77, '', '', '', '', '2025-05-01 15:48:49'),
(78, '', '', '', '', '2025-05-01 15:48:49'),
(79, '', '', '', '', '2025-05-01 15:48:49'),
(80, '', '', '', '', '2025-05-01 15:48:49'),
(81, '', '', '', '', '2025-05-01 15:48:49'),
(82, '', '', '', '', '2025-05-01 15:48:49'),
(83, '', '', '', '', '2025-05-01 15:48:49'),
(84, '', '', '', '', '2025-05-01 15:48:50'),
(85, '', '', '', '', '2025-05-01 15:49:20'),
(86, '', '', '', '', '2025-05-01 15:49:20'),
(87, '', '', '', '', '2025-05-01 15:49:20'),
(88, '', '', '', '', '2025-05-01 15:49:20'),
(89, '', '', '', '', '2025-05-01 15:49:20'),
(90, '', '', '', '', '2025-05-01 15:49:20'),
(91, '', '', '', '', '2025-05-01 15:49:20'),
(92, '', '', '', '', '2025-05-01 15:49:20'),
(93, '', '', '', '', '2025-05-01 15:49:20'),
(94, '', '', '', '', '2025-05-01 15:49:20'),
(95, '', '', '', '', '2025-05-01 15:49:20'),
(96, '', '', '', '', '2025-05-01 15:49:20'),
(97, '', '', '', '', '2025-05-01 15:49:21'),
(98, '', '', '', '', '2025-05-01 15:49:21'),
(99, '', '', '', '', '2025-05-01 15:49:21'),
(100, '', '', '', '', '2025-05-01 15:49:21'),
(101, '', '', '', '', '2025-05-01 15:49:21'),
(102, '', '', '', '', '2025-05-01 15:49:21'),
(103, '', '', '', '', '2025-05-01 15:49:21'),
(104, '', '', '', '', '2025-05-01 15:49:21'),
(105, '', '', '', '', '2025-05-01 15:50:21'),
(106, '', '', '', '', '2025-05-01 15:50:21'),
(107, '', '', '', '', '2025-05-01 15:50:21'),
(108, '', '', '', '', '2025-05-01 15:50:21'),
(109, '', '', '', '', '2025-05-01 15:50:21'),
(110, '', '', '', '', '2025-05-01 15:50:21'),
(111, '', '', '', '', '2025-05-01 15:50:21'),
(112, '', '', '', '', '2025-05-01 15:50:21'),
(113, '', '', '', '', '2025-05-01 15:50:21'),
(114, '', '', '', '', '2025-05-01 15:50:21'),
(115, '', '', '', '', '2025-05-01 15:50:21'),
(116, '', '', '', '', '2025-05-01 15:50:21'),
(117, '', '', '', '', '2025-05-01 15:50:21'),
(118, '', '', '', '', '2025-05-01 15:50:21'),
(119, '', '', '', '', '2025-05-01 15:50:21'),
(120, '', '', '', '', '2025-05-01 15:50:21'),
(121, '', '', '', '', '2025-05-01 15:50:21'),
(122, '', '', '', '', '2025-05-01 15:50:21'),
(123, '', '', '', '', '2025-05-01 15:50:21'),
(124, '', '', '', '', '2025-05-01 15:50:21'),
(125, 'galang', 'galangabdir7@gmail.com', '0133833', 'mantap', '2025-05-01 15:53:53'),
(126, 'adibesar', 'andi@gmail.com', '12345', 'mantap banggg', '2025-05-01 16:29:39'),
(127, 'galang abdir', 'galang@gmail.com', '08976666', 'masuk', '2025-05-02 03:14:17'),
(128, 'orisssssxxx', 'orix@gmail.com', '0986465465', '111mantaapapp', '2025-05-02 03:15:53'),
(129, 'galang', 'coba@mail.com', '000000000', 'NN', '2025-06-04 03:53:05'),
(130, 'ss', 'admin@gmail.com', '5336557', 'mnmn', '2025-07-09 06:20:43');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `ulasan` text NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `nama`, `ulasan`, `rating`, `created_at`) VALUES
(35, 0, 'galang', 'sangat baik', 5, '2025-07-09 05:55:24'),
(36, 0, 'alez ningrat', 'sangat baik', 2, '2025-07-09 06:00:04'),
(37, 0, 'ss', 'ss', 5, '2025-07-09 06:00:59'),
(38, 0, 'maams', 'ss', 5, '2025-07-09 06:04:03'),
(39, 4, 'aa', 'ss', 4, '2025-07-09 06:53:52'),
(40, 4, 'gal', 'aaaaa', 5, '2025-07-09 07:14:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'galang10', 'galangabdir7@gmail.com', '$2y$10$ah.HBkGxXhangMnsUO1P5uEgDekww27ui/K8G5S9bFdfAmGlQuFBq', '2025-05-01 15:02:32'),
(2, 'coba', 'coba@mail.com', '$2y$10$p0HlkMvfRAqxdKW.px4XUOJV6K2GNvebAYOtPST8U7TMj9akVPDIy', '2025-05-01 15:04:25'),
(3, 'galang', 'galang@gmail.com', '$2y$10$znEmaQdSVdKsQwJ.0gzY/ePkPkRRy9Y5sdTvddcJ5QkOgnMp6loSG', '2025-05-01 15:11:44'),
(4, 'galangabe', 'filippoinzaghi75@gmail.com', '$2y$10$Cn/CYL/8fY3f9spr1Q08GewopMmBFsDjJdMeaT1cRSCXCAelv6bxi', '2025-05-01 16:24:36'),
(5, 'kingalex', 'coba5@mail.com', '$2y$10$Br6Gm8TYntcJgXhnYe0taO6U.6UhsOSWX7aKARPuPD/rTDo9/asVK', '2025-05-02 02:16:30'),
(6, 'galn', 'coba3@gmail.com', '$2y$10$L.6VOZ4kruWDoHCltotiBeIszN8E9XwYZiuTgvd.1yUHNWoBefiDi', '2025-05-02 03:13:22'),
(7, 'saaaaasassa', 'pap@gmail.com', '$2y$10$GlCKxlc4dNzA31zQDjRs8OS14VGPI.C/7YrWpRsE0g8zbbOxy2Ydy', '2025-05-20 15:34:13'),
(8, 'gal', 'admin@gmail.com', '$2y$10$hqXvnM2Y.kSXhyWP8KpB3uyJCKJWIzQXxul5OnP1MPqRxyige88gu', '2025-06-29 12:13:44'),
(9, 'galangd', 'galangd@gmail.com', '$2y$10$guCP4rLaIaK3EMpRyx7SYujsyIoHrTmKtvvfpBhEGaxMaxGEluVt2', '2025-06-29 12:50:35'),
(10, 'galangaaaa', 'coba2@mail.com', '$2y$10$sY7cMN0lQfgyf7Vnpd5mf.4ry.UwR/FG1Yi31MdmLcCVOJewzy/ae', '2025-07-08 16:58:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buku_tamu`
--
ALTER TABLE `buku_tamu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `buku_tamu`
--
ALTER TABLE `buku_tamu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
