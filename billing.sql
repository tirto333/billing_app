-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2023 at 09:31 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `billing`
--

-- --------------------------------------------------------

--
-- Table structure for table `asets_cust`
--

CREATE TABLE `asets_cust` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pel` varchar(255) DEFAULT NULL,
  `asset1` varchar(255) DEFAULT NULL,
  `asset2` varchar(255) DEFAULT NULL,
  `asset3` varchar(255) DEFAULT NULL,
  `asset4` varchar(255) DEFAULT NULL,
  `asset5` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_09_17_004956_create_pelanggans_table', 1),
(6, '2023_09_18_122435_create_statuss_table', 1),
(7, '2023_09_18_122941_create_status_custs_table', 1),
(8, '2023_09_19_120423_create_asets_cust_table', 1),
(9, '2023_09_22_133631_create_trx_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggans`
--

CREATE TABLE `pelanggans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pelanggan` varchar(255) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `telp` varchar(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `paket_layanan` varchar(255) NOT NULL,
  `bw` varchar(255) NOT NULL,
  `tgl_regis` date NOT NULL,
  `priode_langganan` varchar(15) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nominal` varchar(15) DEFAULT NULL,
  `total_bayar` varchar(50) DEFAULT NULL,
  `tgl_berlangganan` date DEFAULT NULL,
  `jth_tempo` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelanggans`
--

INSERT INTO `pelanggans` (`id`, `id_pelanggan`, `nama`, `telp`, `email`, `password`, `alamat`, `ip_address`, `paket_layanan`, `bw`, `tgl_regis`, `priode_langganan`, `created_at`, `updated_at`, `nominal`, `total_bayar`, `tgl_berlangganan`, `jth_tempo`) VALUES
(1, 'DCN0001', 'Contoh 1', '2147483647', 'contoh1@example.com', '$2y$10$DLWOSU9.QJvg9OTv8cTjQeUtAVa8fyBs9m7UCLAHhWi7rjjq16KFe', 'Bojong', '123.0.0.3', 'Middle', '10 Mbps', '2023-10-14', '30 Hari', '2023-10-13 05:42:26', '2023-10-13 18:28:41', NULL, '0', '2023-10-14', NULL),
(2, 'DCN0002', 'Contoh 2', '08961304503', 'contoh2@example.com', '$2y$10$9qk6bHJD6Cew8rYvru.HeuzOp8yMb6OsBJLepNWbZfKf904TaiDlW', 'Bojong', '123.0.0.2', 'Middle', '10 Mbps', '2023-10-13', NULL, '2023-10-13 05:45:56', '2023-10-13 05:45:56', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statuss`
--

CREATE TABLE `statuss` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ket_aktifasi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statuss`
--

INSERT INTO `statuss` (`id`, `ket_aktifasi`) VALUES
(1, 'Aktif'),
(2, 'Tidak Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `status_custs`
--

CREATE TABLE `status_custs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pel` int(255) NOT NULL,
  `id_status` varchar(255) NOT NULL,
  `status_isolir` int(11) DEFAULT NULL,
  `stauts_konfirmasi` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status_custs`
--

INSERT INTO `status_custs` (`id`, `id_pel`, `id_status`, `status_isolir`, `stauts_konfirmasi`, `created_at`, `updated_at`) VALUES
(1, 1, '1', 1, 0, '2023-10-13 05:42:26', '2023-10-13 05:42:26'),
(2, 2, '2', 1, 0, '2023-10-13 05:45:56', '2023-10-13 05:45:56');

-- --------------------------------------------------------

--
-- Table structure for table `trx_users`
--

CREATE TABLE `trx_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pel` int(11) NOT NULL,
  `status_bayar` varchar(255) NOT NULL,
  `tgl_regis` date NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `alamat_pelanggan` varchar(255) NOT NULL,
  `telp_pelanggan` varchar(255) NOT NULL,
  `nama_pemasangan` varchar(255) DEFAULT NULL,
  `alamat_pemasangan` varchar(255) DEFAULT NULL,
  `tlp_pemasangan` varchar(255) DEFAULT NULL,
  `jth_tempo` varchar(255) NOT NULL,
  `aset_perangkat1` varchar(255) DEFAULT NULL,
  `aset_perangkat2` varchar(255) DEFAULT NULL,
  `aset_perangkat3` varchar(255) DEFAULT NULL,
  `detail1` varchar(255) DEFAULT NULL,
  `detail2` varchar(255) DEFAULT NULL,
  `detail3` varchar(255) DEFAULT NULL,
  `nominal` varchar(255) NOT NULL,
  `tgl_berlangganan` date DEFAULT NULL,
  `total_bayar` varchar(255) DEFAULT NULL,
  `nama_pembuat` varchar(255) NOT NULL,
  `alamat_pembuat` varchar(255) NOT NULL,
  `bukti_trf` varchar(255) DEFAULT NULL,
  `metode_bayar` varchar(50) DEFAULT NULL,
  `catatan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trx_users`
--

INSERT INTO `trx_users` (`id`, `id_pel`, `status_bayar`, `tgl_regis`, `nama_pelanggan`, `alamat_pelanggan`, `telp_pelanggan`, `nama_pemasangan`, `alamat_pemasangan`, `tlp_pemasangan`, `jth_tempo`, `aset_perangkat1`, `aset_perangkat2`, `aset_perangkat3`, `detail1`, `detail2`, `detail3`, `nominal`, `tgl_berlangganan`, `total_bayar`, `nama_pembuat`, `alamat_pembuat`, `bukti_trf`, `metode_bayar`, `catatan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Belum Dibayar', '2023-10-20', 'Contoh 1', '', '2147483647', NULL, 'Bojong', NULL, '2023-11-14', 'Fasilitas Internet : Middle', 'IP Address : 123.0.0.3', 'Badnwith : 10 Mbps', NULL, NULL, NULL, '500000', '2023-10-14', '500000', '', 'PT Data Cyber Nusantara\r\nJl. Swadaya Blok C No.60\r\nCinangka – Sawangan', NULL, 'Trasnfer', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('superadmin','admin','company','user') NOT NULL DEFAULT 'superadmin',
  `currant_workspace` int(11) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `currant_workspace`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'su@example.com', NULL, '$2y$10$8mk0UVn18iz4OQj6SOVbGO8yFL/halx/dmFoNW1NW5jvV5sGJndnS', 'superadmin', NULL, NULL, NULL, '2023-10-09 15:03:08', '2023-10-09 15:03:08'),
(2, 'contoh pelanggan 1', 'pelanggan1@example.com', NULL, '$2y$10$TN7vn7/Hiz3vKCEU2Bc0ae2PW4TStkNal99RO/er3YPtg2vMgTN1a', 'user', NULL, NULL, NULL, '2023-10-13 05:31:24', '2023-10-13 05:31:24'),
(4, 'Contoh 1', 'contoh1@example.com', NULL, '$2y$10$HwNPUJ03QQkrvFv24hUKeuPbMUBErHG9eUxX6oW67lzHW3W5vFJUG', 'user', NULL, NULL, NULL, '2023-10-13 05:42:26', '2023-10-13 05:42:26'),
(5, 'Contoh 2', 'contoh2@example.com', NULL, '$2y$10$HoINkETwCGQnXskl40Cff.BY99x4MTaSlEVDjYqH75E7gr054cs5K', 'user', NULL, NULL, NULL, '2023-10-13 05:45:57', '2023-10-13 05:45:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asets_cust`
--
ALTER TABLE `asets_cust`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pelanggans`
--
ALTER TABLE `pelanggans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `statuss`
--
ALTER TABLE `statuss`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_custs`
--
ALTER TABLE `status_custs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trx_users`
--
ALTER TABLE `trx_users`
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
-- AUTO_INCREMENT for table `asets_cust`
--
ALTER TABLE `asets_cust`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pelanggans`
--
ALTER TABLE `pelanggans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `statuss`
--
ALTER TABLE `statuss`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status_custs`
--
ALTER TABLE `status_custs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trx_users`
--
ALTER TABLE `trx_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
