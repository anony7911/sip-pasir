-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 03, 2024 at 03:00 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `haerul_si_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwals`
--

CREATE TABLE `jadwals` (
  `id` bigint UNSIGNED NOT NULL,
  `kendaraan_id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `jumlah_truk` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kendaraans`
--

CREATE TABLE `kendaraans` (
  `id` bigint UNSIGNED NOT NULL,
  `nomor_polisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `merk_kendaraan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe_kendaraan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_operasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_supir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon_supir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_supir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kendaraans`
--

INSERT INTO `kendaraans` (`id`, `nomor_polisi`, `merk_kendaraan`, `tipe_kendaraan`, `tahun_operasi`, `nama_supir`, `telepon_supir`, `alamat_supir`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'DT 1234 AB', 'Toyota', 'Truk 1', '2021', 'Ahmad', '08123785712', 'jalan pendidikan', 11, NULL, '2024-01-13 11:18:48'),
(2, 'DT 4120 AB', 'Mitsubishi ', 'Canter FE 71 L', '2023', 'Pandi', '081231782387', 'Jalan Makassar', 12, '2024-01-13 03:20:30', '2024-01-13 03:20:30');

-- --------------------------------------------------------

--
-- Table structure for table `keranjangs`
--

CREATE TABLE `keranjangs` (
  `id` bigint UNSIGNED NOT NULL,
  `produk_id` bigint UNSIGNED NOT NULL,
  `pelanggan_id` bigint UNSIGNED NOT NULL,
  `jumlah` int NOT NULL,
  `harga` int NOT NULL,
  `total` int NOT NULL,
  `alamat_pengantaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_01_09_080711_create_pelanggans_table', 2),
(7, '2024_01_09_080738_create_kendaraans_table', 2),
(8, '2024_01_09_080753_create_stoks_table', 2),
(9, '2024_01_09_080800_create_orders_table', 3),
(10, '2024_01_09_080801_create_jadwals_table', 4),
(11, '2024_01_20_113818_create_produks_table', 5),
(13, '2024_01_23_030815_create_penjualans_table', 6),
(16, '2024_01_29_171439_create_penugasans_table', 7),
(18, '2024_01_31_153324_create_keranjangs_table', 8),
(19, '2024_02_01_155207_add_long_lat_to_keranjangs_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `tujuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `maps` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_truk` int NOT NULL,
  `pelanggan_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggans`
--

CREATE TABLE `pelanggans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perusahaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelanggans`
--

INSERT INTO `pelanggans` (`id`, `nama`, `alamat`, `telepon`, `email`, `jenis_kelamin`, `perusahaan`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Surahman', 'Jalan Dermaga', '08121238712', 'pelanggan@gmail.com', 'Laki-laki', 'PT Abadi', 9, '2024-01-10 01:13:04', '2024-01-10 01:13:04'),
(2, 'Reza', 'JL. Abadi', '0812314412', 'pelanggan1@gmail.com', 'Laki-laki', 'PT Putra Kencana', 10, '2024-01-10 01:14:56', '2024-01-13 00:17:32'),
(3, 'sarden', 'jalan pahlawan', '09128093123', 'pelanggan12@gmail.com', 'L', 'PT Abadi', 13, '2024-01-29 00:43:28', '2024-01-29 00:43:28'),
(4, 'Sanusi', 'Jalan Pedalaman', '0823123123', 'pelanggan13@gmail.com', 'L', 'PT Amanah', 14, '2024-01-29 09:27:45', '2024-01-29 09:27:45'),
(5, 'Sanusi', 'Jalan Pedalaman', '0823123123', 'pelanggan14@gmail.com', 'L', 'PT Amanah', 16, '2024-01-29 09:28:32', '2024-01-29 09:28:32'),
(6, 'Amri Sudiarjo', 'Jalan Makassar', '08123412345', 'pelanggan15@gmail.com', 'L', 'PT Sejahtera ', 17, '2024-01-29 09:39:04', '2024-01-29 09:39:04'),
(7, 'bambang', 'desa baru', '081287451231', 'pelanggan16@gmail.com', 'L', 'tidak ada', 18, '2024-01-30 04:54:10', '2024-01-30 04:54:10');

-- --------------------------------------------------------

--
-- Table structure for table `penjualans`
--

CREATE TABLE `penjualans` (
  `id` bigint UNSIGNED NOT NULL,
  `produk_id` bigint UNSIGNED NOT NULL,
  `pelanggan_id` bigint UNSIGNED NOT NULL,
  `jumlah` int NOT NULL,
  `tanggal_pengantaran` date NOT NULL,
  `alamat_pengantaran` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `long` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jarak` double(8,2) DEFAULT NULL,
  `ongkir` int DEFAULT NULL,
  `total` int DEFAULT NULL,
  `pembayaran` enum('cash','transfer') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cash',
  `status` enum('menunggu','diproses','dikirim','selesai','batal') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penjualans`
--

INSERT INTO `penjualans` (`id`, `produk_id`, `pelanggan_id`, `jumlah`, `tanggal_pengantaran`, `alamat_pengantaran`, `long`, `lat`, `jarak`, `ongkir`, `total`, `pembayaran`, `status`, `created_at`, `updated_at`) VALUES
(3, 2, 5, 31, '2024-02-09', 'Jalan Pedalaman Utara', '121.480757', '-4.632571', 9.39, 75000, 1625000, 'cash', 'selesai', '2024-01-29 09:28:32', '2024-02-01 07:45:00'),
(4, 1, 6, 21, '2024-02-10', 'Jalan Makassar Dekat Rumah Pak Desa', '121.482763', '-4.628208', 9.83, 100000, 1045000, 'cash', 'selesai', '2024-01-29 09:39:04', '2024-02-03 05:10:07'),
(5, 2, 7, 2, '2024-01-30', 'Desa baru samping halaman kantor desa', '121.4379144', '-4.7171309', 5.81, 45000, 145000, 'cash', 'selesai', '2024-01-30 04:54:10', '2024-01-30 04:55:11'),
(9, 1, 1, 19, '2024-03-01', 'Jalan Desa Baru Dekat Rumah Kosong', '121.61189690', '-4.06733140', 71.24, 200000, 1055000, 'cash', 'selesai', '2024-02-01 07:59:14', '2024-02-03 05:10:16'),
(10, 2, 1, 13, '2024-03-01', 'Jalan Baru dekat kantor desa', '121.61189690', '-4.06733140', 71.24, 210000, 860000, 'cash', 'selesai', '2024-02-01 07:59:14', '2024-02-03 05:10:17'),
(11, 1, 1, 4, '2024-02-17', 'Jalan Pedalaman Dekat Tugu', '122.6178560', '-5.46570240', 160.36, NULL, 180000, 'cash', 'selesai', '2024-02-03 04:44:24', '2024-02-03 05:06:41'),
(12, 2, 1, 12, '2024-02-05', 'Jalan Pramuka No 19', '122.6178560', '-5.46570240', 160.36, 200000, 800000, 'cash', 'selesai', '2024-02-03 04:54:22', '2024-02-03 05:10:08'),
(13, 1, 1, 100, '2024-02-03', 'Jalan Delima', '122.6178560', '-5.46570240', 160.36, NULL, 4500000, 'cash', 'batal', '2024-02-03 05:10:52', '2024-02-03 05:11:06'),
(14, 2, 1, 12, '2024-02-04', 'Jalan Palelangan', '122.6178560', '-5.46570240', 160.36, 120000, 720000, 'cash', 'diproses', '2024-02-03 05:12:02', '2024-02-03 05:12:19'),
(15, 1, 1, 100, '2024-02-13', 'Jalan Delima', '122.6178560', '-5.46570240', 160.36, NULL, 4500000, 'cash', 'menunggu', '2024-02-03 05:14:07', '2024-02-03 05:14:07');

-- --------------------------------------------------------

--
-- Table structure for table `penugasans`
--

CREATE TABLE `penugasans` (
  `id` bigint UNSIGNED NOT NULL,
  `penjualan_id` bigint UNSIGNED NOT NULL,
  `kendaraan_id` bigint UNSIGNED NOT NULL,
  `jumlah_truk` int NOT NULL DEFAULT '0',
  `status` enum('belum','selesai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penugasans`
--

INSERT INTO `penugasans` (`id`, `penjualan_id`, `kendaraan_id`, `jumlah_truk`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 16, 'selesai', '2024-02-01 06:07:22', '2024-02-01 07:45:00'),
(2, 3, 2, 15, 'selesai', '2024-02-01 06:07:22', '2024-02-01 07:45:00'),
(3, 4, 1, 11, 'selesai', '2024-02-01 06:07:22', '2024-02-03 05:10:07'),
(4, 4, 2, 10, 'selesai', '2024-02-01 06:07:22', '2024-02-03 05:10:07'),
(5, 5, 2, 1, 'selesai', '2024-02-01 06:07:22', '2024-02-01 07:44:46'),
(6, 5, 1, 1, 'selesai', '2024-02-01 06:07:22', '2024-02-01 07:44:46'),
(11, 9, 1, 0, 'selesai', '2024-02-01 07:59:14', '2024-02-03 05:10:16'),
(12, 9, 2, 0, 'selesai', '2024-02-01 07:59:14', '2024-02-03 05:10:16'),
(13, 10, 1, 0, 'selesai', '2024-02-01 07:59:14', '2024-02-03 05:10:17'),
(14, 10, 2, 0, 'selesai', '2024-02-01 07:59:14', '2024-02-03 05:10:17'),
(15, 11, 1, 0, 'selesai', '2024-02-03 04:44:24', '2024-02-03 05:06:41'),
(16, 11, 2, 0, 'selesai', '2024-02-03 04:44:24', '2024-02-03 05:06:41'),
(17, 12, 1, 6, 'selesai', '2024-02-03 04:54:22', '2024-02-03 05:10:08'),
(18, 12, 2, 6, 'selesai', '2024-02-03 04:54:22', '2024-02-03 05:10:08'),
(19, 13, 1, 0, 'belum', '2024-02-03 05:10:52', '2024-02-03 05:10:52'),
(20, 13, 2, 0, 'belum', '2024-02-03 05:10:52', '2024-02-03 05:10:52'),
(21, 14, 1, 6, 'belum', '2024-02-03 05:12:02', '2024-02-03 05:12:19'),
(22, 14, 2, 6, 'belum', '2024-02-03 05:12:02', '2024-02-03 05:12:19'),
(23, 15, 1, 0, 'belum', '2024-02-03 05:14:07', '2024-02-03 05:14:07'),
(24, 15, 2, 0, 'belum', '2024-02-03 05:14:07', '2024-02-03 05:14:07');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produks`
--

CREATE TABLE `produks` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int NOT NULL,
  `gambar` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produks`
--

INSERT INTO `produks` (`id`, `nama_produk`, `slug`, `deskripsi`, `harga`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'Pasir Halus', 'pasir-halus', 'Pasir halus adalah', 45000, 'fe7750f0fb3f57cd987c59965b499cee', '2024-01-22 18:39:46', '2024-01-22 19:05:44'),
(2, 'Pasir Kasar', 'pasir-kasar', 'Pasir kasar', 50000, 'c756bd0dad608f76474c6dfc77a5450c', '2024-01-22 18:43:24', '2024-01-22 18:43:24');

-- --------------------------------------------------------

--
-- Table structure for table `stoks`
--

CREATE TABLE `stoks` (
  `id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah_masuk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_keluar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_stok` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$12$SusnO5utxE0cKdT9zsLhU.rTo8rB/Ews0IUmkJEZGkKmSyw3aPtuy', 'admin', NULL, '2024-01-03 05:41:41', '2024-02-03 04:37:12'),
(6, 'admin2', 'admin2@gmail.com', NULL, '$2y$12$NgTPu3B5XGphUKxJhM12B.7K5Vr3hUQG1s19Uin74gWCwUZHkzwzO', 'admin', NULL, '2024-01-08 00:38:11', '2024-01-08 02:45:01'),
(7, 'admin', 'admin3@gmail.com', NULL, '$2y$12$jvkSDkBeIf0BzXJJ97vGMenrP9v9Lw7dRQ12rwk4UhIxT.m3mP50y', 'admin', NULL, '2024-01-08 00:38:39', '2024-01-08 00:38:39'),
(8, 'admin', 'admin4@gmail.com', NULL, '$2y$12$SBV15/Upsw2oCIpRT5B4sOfBptxmEQfdxMoTgRjCr6BgYEDHOejtG', 'admin', NULL, '2024-01-08 00:50:02', '2024-01-08 00:50:02'),
(9, 'Surahman', 'pelanggan@gmail.com', NULL, '$2y$12$VsfRDQk5WonbwRodtBICxucjXjUEGza7WiatPJMcdohbLE55cHFke', 'pelanggan', NULL, '2024-01-10 01:13:04', '2024-01-10 01:13:04'),
(10, 'Reza', 'pelanggan1@gmail.com', NULL, '$2y$12$reXLkY2k.aagAC87ND.Tf.MHdY1SAkC04bO6VX6kLeszPaDpfAu3y', 'pelanggan', NULL, '2024-01-10 01:14:56', '2024-01-10 01:14:56'),
(11, 'ahmad', 'supir@gmail.com', '2024-01-13 11:16:44', '$2y$10$AnFn9eBbvohSMQq0JwIdseazxezLudoDt/3PkU8IvdJFjwo.i1LVG', 'supir', NULL, '2024-01-23 03:11:56', '2024-12-31 03:12:00'),
(12, 'Pandi', 'supir1@gmail.com', NULL, '$2y$12$Glj4gtax/fdgNommeb1kZ.H9uf7x16vyK.1uPBlR3g3Ks5DFnmoZC', 'supir', NULL, '2024-01-13 03:20:30', '2024-01-13 03:20:30'),
(13, 'sarden', 'pelanggan12@gmail.com', NULL, '$2y$12$57lEYkP1ncIYF0T7AxCveOuyNKl46jk4T73rktATT6g8IKJYSdIcG', 'pelanggan', NULL, '2024-01-29 00:43:28', '2024-01-29 00:43:28'),
(14, 'Sanusi', 'pelanggan13@gmail.com', NULL, '$2y$12$U9jso/ndNqD7afExCDyUGOnPZxYf9Gybzr7TRmr14HpffZtDjajr6', 'pelanggan', NULL, '2024-01-29 09:27:45', '2024-01-29 09:27:45'),
(16, 'Sanusi', 'pelanggan14@gmail.com', NULL, '$2y$12$Tbw6VPrryLm21m4ZulLIgOMJ2pTBu.OSCG7ztoaflX3284w1onb12', 'pelanggan', NULL, '2024-01-29 09:28:32', '2024-01-29 09:28:32'),
(17, 'Amri Sudiarjo', 'pelanggan15@gmail.com', NULL, '$2y$12$Wqx8lt0flxPM70K4L1/Zt.vtJNZBHj8T7YguWvFoPwswjfxKFTB.i', 'pelanggan', NULL, '2024-01-29 09:39:04', '2024-01-29 09:39:04'),
(18, 'bambang', 'pelanggan16@gmail.com', NULL, '$2y$12$iMYTxs1FT9RD9ctk.F1pfOeECSzsVM5a821GUp42MM7B0Xr3DnS52', 'pelanggan', NULL, '2024-01-30 04:54:10', '2024-01-30 04:54:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jadwals`
--
ALTER TABLE `jadwals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwals_kendaraan_id_foreign` (`kendaraan_id`),
  ADD KEY `jadwals_order_id_foreign` (`order_id`);

--
-- Indexes for table `kendaraans`
--
ALTER TABLE `kendaraans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kendaraans_user_id_foreign` (`user_id`);

--
-- Indexes for table `keranjangs`
--
ALTER TABLE `keranjangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_pelanggan_id_foreign` (`pelanggan_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pelanggans`
--
ALTER TABLE `pelanggans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggans_user_id_foreign` (`user_id`);

--
-- Indexes for table `penjualans`
--
ALTER TABLE `penjualans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penugasans`
--
ALTER TABLE `penugasans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `produks`
--
ALTER TABLE `produks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stoks`
--
ALTER TABLE `stoks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwals`
--
ALTER TABLE `jadwals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kendaraans`
--
ALTER TABLE `kendaraans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `keranjangs`
--
ALTER TABLE `keranjangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelanggans`
--
ALTER TABLE `pelanggans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `penjualans`
--
ALTER TABLE `penjualans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `penugasans`
--
ALTER TABLE `penugasans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produks`
--
ALTER TABLE `produks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stoks`
--
ALTER TABLE `stoks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jadwals`
--
ALTER TABLE `jadwals`
  ADD CONSTRAINT `jadwals_kendaraan_id_foreign` FOREIGN KEY (`kendaraan_id`) REFERENCES `kendaraans` (`id`),
  ADD CONSTRAINT `jadwals_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `kendaraans`
--
ALTER TABLE `kendaraans`
  ADD CONSTRAINT `kendaraans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_pelanggan_id_foreign` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggans` (`id`);

--
-- Constraints for table `pelanggans`
--
ALTER TABLE `pelanggans`
  ADD CONSTRAINT `pelanggans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
