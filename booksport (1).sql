-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2024 at 11:44 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `booksport`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bk_std_id` varchar(2) DEFAULT NULL COMMENT 'รหัสสนาม',
  `bk_username` varchar(255) DEFAULT NULL COMMENT 'ชื่อผู้จอง',
  `bk_date` date DEFAULT NULL COMMENT 'วันที่จอง',
  `bk_str_time` time NOT NULL COMMENT 'เวลาจอง',
  `bk_end_time` time NOT NULL COMMENT 'เวลาออก',
  `bk_sumtime` int(11) NOT NULL COMMENT 'เวลาเช่า (นาที)',
  `bk_total_price` double DEFAULT NULL COMMENT 'ราคาเช่า',
  `bk_slip` varchar(255) DEFAULT NULL COMMENT 'สลิป',
  `bk_node` text DEFAULT NULL COMMENT 'หมายเหตุ',
  `bk_status` varchar(255) NOT NULL DEFAULT '1' COMMENT 'สถานะ (0.ไม่อนุมัติ 1.รอชำระ 2.รอตรวจสอบ 3.อนุมัติ) ',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `bk_std_id`, `bk_username`, `bk_date`, `bk_str_time`, `bk_end_time`, `bk_sumtime`, `bk_total_price`, `bk_slip`, `bk_node`, `bk_status`, `created_at`, `updated_at`) VALUES
(1, '3', 'user1', '2024-03-19', '17:07:00', '18:07:00', 60, 99, NULL, NULL, '1', '2024-03-19 10:07:46', '2024-03-19 10:07:46'),
(2, '1', 'user1', '2024-03-19', '18:07:00', '20:07:00', 120, 1000, NULL, NULL, '1', '2024-03-19 10:07:59', '2024-03-19 10:07:59'),
(3, '1', 'user2', '2024-03-19', '22:08:00', '23:08:00', 60, 500, NULL, NULL, '1', '2024-03-19 10:09:17', '2024-03-19 10:09:17'),
(4, '2', 'user2', '2024-03-19', '18:09:00', '20:09:00', 120, 1024, NULL, NULL, '1', '2024-03-19 10:09:30', '2024-03-19 10:09:30');

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
(14, '2024_01_12_104109_create_rules_table', 1),
(15, '2014_10_12_000000_create_users_table', 2),
(16, '2014_10_12_100000_create_password_reset_tokens_table', 2),
(17, '2019_08_19_000000_create_failed_jobs_table', 2),
(18, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(19, '2024_01_12_032817_create_stadiums_table', 2),
(20, '2024_01_12_094225_create_bookings_table', 2);

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
-- Table structure for table `rules`
--

CREATE TABLE `rules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rule_detail` text DEFAULT NULL COMMENT 'กฎกติกา',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stadiums`
--

CREATE TABLE `stadiums` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `std_supperuser` varchar(255) DEFAULT NULL COMMENT 'เจ้าของสนาม',
  `std_name` varchar(255) DEFAULT NULL COMMENT 'ชื่อสนาม',
  `std_price` double DEFAULT NULL COMMENT 'ราคาสนาม',
  `std_details` text DEFAULT NULL COMMENT 'รายละเอียดสนาม',
  `std_facilities` text DEFAULT NULL COMMENT 'สิ่งอำนวยสะดวกสนาม',
  `std_img_path` text DEFAULT NULL COMMENT 'รูปภาพ',
  `std_status` varchar(255) NOT NULL DEFAULT '1' COMMENT 'สถานะสนาม',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stadiums`
--

INSERT INTO `stadiums` (`id`, `std_supperuser`, `std_name`, `std_price`, `std_details`, `std_facilities`, `std_img_path`, `std_status`, `created_at`, `updated_at`) VALUES
(1, '2', 'สนามฟุตบอล', 500, '<p>test1</p>', '<p>test2</p>', 'uploads/stadiums/สนามฟุตบอล-2024-03-19-img-1.jpg,uploads/stadiums/สนามฟุตบอล-2024-03-19-img-2.jpg,uploads/stadiums/สนามฟุตบอล-2024-03-19-img-3.jpg,uploads/stadiums/สนามฟุตบอล-2024-03-19-img-4.jpg,uploads/stadiums/สนามฟุตบอล-2024-03-19-img-5.jpg', '1', '2024-03-19 08:24:51', '2024-03-19 08:24:51'),
(2, '2', 'สนามเทนนิส', 512, '<p>trsdts</p>', '<p>sgfg</p>', 'uploads/stadiums/สนามเทนนิส-2024-03-19-img-1.jpg,uploads/stadiums/สนามเทนนิส-2024-03-19-img-2.jpg,uploads/stadiums/สนามเทนนิส-2024-03-19-img-3.jpg,uploads/stadiums/สนามเทนนิส-2024-03-19-img-4.jpg,uploads/stadiums/สนามเทนนิส-2024-03-19-img-5.jpeg,uploads/stadiums/สนามเทนนิส-2024-03-19-img-6.jpg', '1', '2024-03-19 09:26:08', '2024-03-19 09:26:08'),
(3, '3', 'สนามปิงปอง', 99, '<p>test3</p>', '<p>test3</p>', 'uploads/stadiums/สนามปิงปอง-2024-03-19-img-1.jpg,uploads/stadiums/สนามปิงปอง-2024-03-19-img-2.jpg,uploads/stadiums/สนามปิงปอง-2024-03-19-img-3.jpg,uploads/stadiums/สนามปิงปอง-2024-03-19-img-4.jpg,uploads/stadiums/สนามปิงปอง-2024-03-19-img-5.jpg', '1', '2024-03-19 09:52:57', '2024-03-19 09:52:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) DEFAULT NULL COMMENT 'ชื่อผู้ใช้งาน',
  `email` varchar(255) NOT NULL COMMENT 'อีเมล',
  `password` varchar(255) DEFAULT NULL COMMENT 'รหัสผ่าน',
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT 'สถานะ',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$12$CtcifXzC8QGbYTy/0EpsguzzyCgiOY0qG/tPNjh5aQJ/1Bs8U9vva', '9', 'CCTcwxCHTxkPlfkex5DAJLVb0D1DTW6qpAEmYB4x8HdEFSARLegAP0OBkZp5', '2024-03-19 02:36:38', '2024-03-19 02:36:38'),
(2, 'gm1', 'gm1@gmail.com', '$2y$12$lLuJVntvF.SS0Y7kYLgtZOgO2a0mGe/ggNKEIUET/ZCoFtq2hKDYS', '7', 'Ssd1jUhhYexRzsE9S0spqGCqbMFxTZX4Zy8fJ9khMGgPeCZyBCZUqEp64eu2', '2024-03-19 08:57:41', '2024-03-19 09:46:15'),
(3, 'gm2', 'gm2@gmail.com', '$2y$12$Jc/k5gy2jV2fdCevdW.ztO5yJ9jMDu3/WbYE9JeUOUJCNTmQAMxGS', '7', 'tNHEvoP4xuoYLQuDxm227M6L6RYBCtfA1QJWaW26DbqluQ2N5CEXVLiMwHW2', '2024-03-19 09:45:51', '2024-03-19 09:45:51'),
(4, 'user1', 'user1@gmail.com', '$2y$12$4jjxWUQ9rRlkcbVXeOHvVe/iJutHbHtjrj4pU4ELaJ31kzB6ZS3US', '1', 'W5UVEuuvdsE5dfG0RAQdeX7ma04uheJ7W4MJWHshES80ofdgWP1JK9O6bXdv', '2024-03-19 10:07:15', '2024-03-19 10:07:15'),
(5, 'user2', 'user2@gmail.com', '$2y$12$RskQB7DotvYafztwb.II8uWN7HSIfWFaGEv.XY3/AaTWfREY.lO7G', '1', 'ErJhcvVBICNt3rMYw1l6PwPCwLtqIYCwOypBUsbNI5WJRTTVpWTOXU6ilOj5', '2024-03-19 10:08:33', '2024-03-19 10:08:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rules`
--
ALTER TABLE `rules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stadiums`
--
ALTER TABLE `stadiums`
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
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rules`
--
ALTER TABLE `rules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stadiums`
--
ALTER TABLE `stadiums`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
