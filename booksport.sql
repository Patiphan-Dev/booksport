-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2024 at 06:02 PM
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
  `bk_slip` varchar(255) DEFAULT NULL COMMENT 'สลิป',
  `bk_node` text DEFAULT NULL COMMENT 'หมายเหตุ',
  `bk_status` varchar(255) NOT NULL DEFAULT '1' COMMENT 'สถานะ (0.ไม่อนุมัติ 1.รอชำระ 2.รอตรวจสอบ 3.อนุมัติ) ',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `bk_std_id`, `bk_username`, `bk_date`, `bk_str_time`, `bk_end_time`, `bk_slip`, `bk_node`, `bk_status`, `created_at`, `updated_at`) VALUES
(1, '1', 'user1', '2024-01-25', '23:00:00', '00:00:00', 'uploads/slips/2024-01-25-231154-slipe-user1.jpg', NULL, '2', '2024-01-25 16:11:33', '2024-01-25 16:11:54'),
(2, '1', 'user1', '2024-01-26', '23:00:00', '00:00:00', 'uploads/slips/2024-01-26-000014-slipe-user1.jpg', 'สลิปโอนเงินปลอม', '0', '2024-01-25 16:11:41', '2024-01-25 17:00:14'),
(3, '3', 'user2', '2024-01-27', '08:00:00', '12:00:00', NULL, NULL, '1', '2024-01-25 16:12:39', '2024-01-25 16:12:39'),
(4, '1', 'user2', '2024-01-28', '13:00:00', '19:00:00', 'uploads/slips/2024-01-25-232148-slipe-admin.jpg', NULL, '3', '2024-01-25 16:13:06', '2024-01-25 16:21:48');

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
(7, '2024_01_12_103622_create_payments_table', 1),
(16, '2014_10_12_000000_create_users_table', 2),
(17, '2014_10_12_100000_create_password_reset_tokens_table', 2),
(18, '2019_08_19_000000_create_failed_jobs_table', 2),
(19, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(20, '2024_01_12_032817_create_stadiums_table', 2),
(21, '2024_01_12_094225_create_bookings_table', 2),
(22, '2024_01_12_104109_create_rules_table', 2);

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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

INSERT INTO `stadiums` (`id`, `std_name`, `std_price`, `std_details`, `std_facilities`, `std_img_path`, `std_status`, `created_at`, `updated_at`) VALUES
(1, 'สนามฟุตบอล', 999, '<p style=\"border: 0px solid rgb(229, 231, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-size: 1.5rem; line-height: 2rem; font-weight: 600; color: rgb(0, 0, 0); font-family: __Montserrat_8ba001, __Montserrat_Fallback_8ba001, __Prompt_fe72c9, __Prompt_Fallback_fe72c9;\">ระเบียบการใช้งานสนาม</p><p style=\"border: 0px solid rgb(229, 231, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-size: 1.5rem; line-height: 2rem; font-weight: 600; color: rgb(0, 0, 0); font-family: __Montserrat_8ba001, __Montserrat_Fallback_8ba001, __Prompt_fe72c9, __Prompt_Fallback_fe72c9;\"><span style=\"font-size: medium; text-align: center; background-color: var(--bs-modal-bg); font-weight: var(--bs-body-font-weight);\">เพื่อความเป็นระเบียบเรียบร้อยในสนาม ขอความร่วมมือจากผู้มาใช้บริการปฏิบัติตามกฎต่างๆ ดังต่อไปนี้</span></p><ol><li style=\"border: 0px solid rgb(229, 231, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-size: 1.5rem; line-height: 2rem; color: rgb(0, 0, 0); font-family: __Montserrat_8ba001, __Montserrat_Fallback_8ba001, __Prompt_fe72c9, __Prompt_Fallback_fe72c9;\"><span style=\"font-size: medium; text-align: center; background-color: var(--bs-modal-bg);\">ขอความร่วมมือในการรักษาความสะอาดในพื้นที่ POLO Football Park</span></li><li style=\"border: 0px solid rgb(229, 231, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-size: 1.5rem; line-height: 2rem; color: rgb(0, 0, 0); font-family: __Montserrat_8ba001, __Montserrat_Fallback_8ba001, __Prompt_fe72c9, __Prompt_Fallback_fe72c9;\"><span style=\"font-size: medium; text-align: center; background-color: var(--bs-modal-bg);\">ห้ามใส่รองเท้าฟุตบอลที่เป็นโลหะ ปุ่มเหล็ก รองเท้าส้นสูง ลงในสนามเด็ดขาด</span></li><li style=\"border: 0px solid rgb(229, 231, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-size: 1.5rem; line-height: 2rem; color: rgb(0, 0, 0); font-family: __Montserrat_8ba001, __Montserrat_Fallback_8ba001, __Prompt_fe72c9, __Prompt_Fallback_fe72c9;\"><span style=\"font-size: medium; text-align: center; background-color: var(--bs-modal-bg);\">โปรดแต่งกายให้เหมาะสมขณะลงเล่น โดยห้ามถอดเสื้อลงไปเล่นในสนามฟุตบอล</span></li><li style=\"border: 0px solid rgb(229, 231, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-size: 1.5rem; line-height: 2rem; color: rgb(0, 0, 0); font-family: __Montserrat_8ba001, __Montserrat_Fallback_8ba001, __Prompt_fe72c9, __Prompt_Fallback_fe72c9;\"><span style=\"font-size: medium; text-align: center; background-color: var(--bs-modal-bg);\">ห้ามมิให้ผู้มาใช้บริการสูบบุหรี่บริเวณสนามโดยเด็ดขาด สามารถสูบบุหรี่ในที่ที่ได้จัดไว้ให้เท่านั้น</span></li><li style=\"border: 0px solid rgb(229, 231, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-size: 1.5rem; line-height: 2rem; color: rgb(0, 0, 0); font-family: __Montserrat_8ba001, __Montserrat_Fallback_8ba001, __Prompt_fe72c9, __Prompt_Fallback_fe72c9;\"><span style=\"font-size: medium; text-align: center; background-color: var(--bs-modal-bg);\">ห้ามมีการทะเลาะวิวาทในพื้นที่ POLO Football Park</span></li><li style=\"border: 0px solid rgb(229, 231, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-size: 1.5rem; line-height: 2rem; color: rgb(0, 0, 0); font-family: __Montserrat_8ba001, __Montserrat_Fallback_8ba001, __Prompt_fe72c9, __Prompt_Fallback_fe72c9;\"><span style=\"font-size: medium; text-align: center; background-color: var(--bs-modal-bg);\">ในกรณีที่เกิดการทะเลาะวิวาท ขั้นรุนแรง ทางสนามขอสงวนสิทธิ์ในการยกเลิกการเล่นนัดนั้นในทันที</span></li><li style=\"border: 0px solid rgb(229, 231, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-size: 1.5rem; line-height: 2rem; color: rgb(0, 0, 0); font-family: __Montserrat_8ba001, __Montserrat_Fallback_8ba001, __Prompt_fe72c9, __Prompt_Fallback_fe72c9;\"><span style=\"font-size: medium; text-align: center; background-color: var(--bs-modal-bg);\">ห้ามพกอาวุธเข้ามาในพื้นที่ POLO Football Park</span></li><li style=\"border: 0px solid rgb(229, 231, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-size: 1.5rem; line-height: 2rem; color: rgb(0, 0, 0); font-family: __Montserrat_8ba001, __Montserrat_Fallback_8ba001, __Prompt_fe72c9, __Prompt_Fallback_fe72c9;\"><span style=\"font-size: medium; text-align: center; background-color: var(--bs-modal-bg);\">ขอความกรุณา งดนำสิ่งเสพติดทุกชนิดเข้ามาในพื้นที่ Polo Football Park</span></li><li style=\"border: 0px solid rgb(229, 231, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-size: 1.5rem; line-height: 2rem; color: rgb(0, 0, 0); font-family: __Montserrat_8ba001, __Montserrat_Fallback_8ba001, __Prompt_fe72c9, __Prompt_Fallback_fe72c9;\"><span style=\"font-size: medium; text-align: center; background-color: var(--bs-modal-bg);\">ห้ามนำสัตว์เลี้ยงเข้ามาในบริเวณสนาม</span></li><li style=\"border: 0px solid rgb(229, 231, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-size: 1.5rem; line-height: 2rem; color: rgb(0, 0, 0); font-family: __Montserrat_8ba001, __Montserrat_Fallback_8ba001, __Prompt_fe72c9, __Prompt_Fallback_fe72c9;\"><span style=\"font-size: medium; text-align: center; background-color: var(--bs-modal-bg);\">ห้ามมิให้มีการเล่นการพนันกันในสนาม</span></li><li style=\"border: 0px solid rgb(229, 231, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-size: 1.5rem; line-height: 2rem; color: rgb(0, 0, 0); font-family: __Montserrat_8ba001, __Montserrat_Fallback_8ba001, __Prompt_fe72c9, __Prompt_Fallback_fe72c9;\"><span style=\"font-size: medium; text-align: center; background-color: var(--bs-modal-bg);\">ขอความกรุณา ผู้มาใช้บริการทุกท่านโปรดดูแลทรัพย์สินส่วนตัว สนาม Polo Football Park จะไม่รับผิดชอบใดๆในกรณีที่เกิดความเสียหาย หรือสูญหายในทรัพย์สินทุกกรณี<br></span></li></ol>', '<ol><li><span style=\"color: rgb(0, 0, 0); font-family: __Montserrat_8ba001, __Montserrat_Fallback_8ba001, __Prompt_fe72c9, __Prompt_Fallback_fe72c9; font-size: 14px; text-align: center;\">ให้เช่าสนามสำหรับการเล่นฟุตบอลแบบทั่วไป</span></li><li><span style=\"color: rgb(0, 0, 0); font-family: __Montserrat_8ba001, __Montserrat_Fallback_8ba001, __Prompt_fe72c9, __Prompt_Fallback_fe72c9; font-size: 14px; text-align: center;\">ให้เช่าเหมาสนามเพื่อจัดการแข่งขันหรือเพื่อฝึกซ้อม</span></li><li><span style=\"color: rgb(0, 0, 0); font-family: __Montserrat_8ba001, __Montserrat_Fallback_8ba001, __Prompt_fe72c9, __Prompt_Fallback_fe72c9; font-size: 14px; text-align: center;\">ให้เช่าพื้นที่ถ่ายทำโฆษณา</span></li><li><span style=\"color: rgb(0, 0, 0); font-family: __Montserrat_8ba001, __Montserrat_Fallback_8ba001, __Prompt_fe72c9, __Prompt_Fallback_fe72c9; font-size: 14px; text-align: center;\">ให้เช่าเหมาสนามและพื้นที่เพื่อการจัดงาน Event and Activity</span></li><li><span style=\"color: rgb(0, 0, 0); font-family: __Montserrat_8ba001, __Montserrat_Fallback_8ba001, __Prompt_fe72c9, __Prompt_Fallback_fe72c9; font-size: 14px; text-align: center;\">จัดหากรรมการสนามหรือ ทีมคู่เล่น (โปรดแจ้งล่วงหน้า)</span></li><li><span style=\"color: rgb(0, 0, 0); font-family: __Montserrat_8ba001, __Montserrat_Fallback_8ba001, __Prompt_fe72c9, __Prompt_Fallback_fe72c9; font-size: 14px; text-align: center;\">มีลูกฟุตบอลให้บริการ</span></li><li><span style=\"color: rgb(0, 0, 0); font-family: __Montserrat_8ba001, __Montserrat_Fallback_8ba001, __Prompt_fe72c9, __Prompt_Fallback_fe72c9; font-size: 14px; text-align: center;\">มีรองเท้าฟุตบอลและถุงมือให้เช่า</span></li><li><span style=\"color: rgb(0, 0, 0); font-family: __Montserrat_8ba001, __Montserrat_Fallback_8ba001, __Prompt_fe72c9, __Prompt_Fallback_fe72c9; font-size: 14px; text-align: center;\">มีผ้าเช็ดตัวให้เช่า</span></li><li><span style=\"color: rgb(0, 0, 0); font-family: __Montserrat_8ba001, __Montserrat_Fallback_8ba001, __Prompt_fe72c9, __Prompt_Fallback_fe72c9; font-size: 14px; text-align: center;\">มีเสื้อแบ่งทีมให้บริการ</span></li><li><span style=\"color: rgb(0, 0, 0); font-family: __Montserrat_8ba001, __Montserrat_Fallback_8ba001, __Prompt_fe72c9, __Prompt_Fallback_fe72c9; font-size: 14px; text-align: center;\">มีล๊อคเกอร์สำหรับเก็บของให้บริการ</span></li><li><span style=\"color: rgb(0, 0, 0); font-family: __Montserrat_8ba001, __Montserrat_Fallback_8ba001, __Prompt_fe72c9, __Prompt_Fallback_fe72c9; font-size: 14px; text-align: center;\">ห้องอาบน้ำมีเครื่องปรับอากาศ บริการสบู่และยาสระผม</span></li><li><span style=\"color: rgb(0, 0, 0); font-family: __Montserrat_8ba001, __Montserrat_Fallback_8ba001, __Prompt_fe72c9, __Prompt_Fallback_fe72c9; font-size: 14px; text-align: center;\">บริการอาหารและเครื่องดื่ม</span></li><li><span style=\"color: rgb(0, 0, 0); font-family: __Montserrat_8ba001, __Montserrat_Fallback_8ba001, __Prompt_fe72c9, __Prompt_Fallback_fe72c9; font-size: 14px; text-align: center; background-color: var(--bs-modal-bg); font-weight: var(--bs-body-font-weight);\">Free Wi-Fi ในพื้นที่ต้อนรับ</span></li></ol>', 'uploads/stadiums/สนามฟุตบอล-2024-01-25-img-1.jpg,uploads/stadiums/สนามฟุตบอล-2024-01-25-img-2.jpg,uploads/stadiums/สนามฟุตบอล-2024-01-25-img-3.jpg,uploads/stadiums/สนามฟุตบอล-2024-01-25-img-4.jpg,uploads/stadiums/สนามฟุตบอล-2024-01-25-img-5.jpg', '1', '2024-01-25 12:52:07', '2024-01-25 12:53:25'),
(2, 'สนามแบดมินตัน', 100, '<div class=\"retxt-name txt-medium color-red\" style=\"box-sizing: inherit; margin: 0px; padding: 0px; outline: none; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-variant-alternates: inherit; font-variant-position: inherit; font-stretch: inherit; line-height: 24px; font-family: sukhumvitset-medium; font-optical-sizing: inherit; font-kerning: inherit; font-feature-settings: inherit; font-variation-settings: inherit; vertical-align: baseline; color: rgb(215, 0, 0);\">⁣⁣⁣⁣โปรเหมาๆ</div><div id=\"clearboth\" class=\"he20px\" style=\"box-sizing: inherit; margin: 0px; padding: 0px; outline: none; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-variant-alternates: inherit; font-variant-position: inherit; font-stretch: inherit; line-height: inherit; font-family: sukhumvitset-text, Tahoma, Arial, Geneva, sans-serif; font-optical-sizing: inherit; font-kerning: inherit; font-feature-settings: inherit; font-variation-settings: inherit; vertical-align: baseline; min-height: 20px; max-height: 20px; clear: both; position: relative; color: rgb(88, 88, 88);\"></div><div class=\"retxt-name txt-medium color-green\" style=\"box-sizing: inherit; margin: 0px; padding: 0px; outline: none; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-variant-alternates: inherit; font-variant-position: inherit; font-stretch: inherit; line-height: 24px; font-family: sukhumvitset-medium; font-optical-sizing: inherit; font-kerning: inherit; font-feature-settings: inherit; font-variation-settings: inherit; vertical-align: baseline; color: rgb(0, 155, 0);\">- 15 ชั่วโมง 1,800 บาท (ชม.ละ 120 บาท)<br style=\"box-sizing: inherit; margin: 0px; padding: 0px; outline: none;\">- 30 ชั่วโมง 3,300 บาท (ชม.ละ 110 บาท)<br style=\"box-sizing: inherit; margin: 0px; padding: 0px; outline: none;\">- 45 ชั่วโมง 4,500 บาท (ชม.ละ 100 บาท)</div><div id=\"clearboth\" class=\"he10px\" style=\"box-sizing: inherit; margin: 0px; padding: 0px; outline: none; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-variant-alternates: inherit; font-variant-position: inherit; font-stretch: inherit; line-height: inherit; font-family: sukhumvitset-text, Tahoma, Arial, Geneva, sans-serif; font-optical-sizing: inherit; font-kerning: inherit; font-feature-settings: inherit; font-variation-settings: inherit; vertical-align: baseline; min-height: 10px; max-height: 10px; clear: both; position: relative; color: rgb(88, 88, 88);\"></div><div class=\"retxt-name txt-medium color-red\" style=\"box-sizing: inherit; margin: 0px; padding: 0px; outline: none; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-variant-alternates: inherit; font-variant-position: inherit; font-stretch: inherit; line-height: 24px; font-family: sukhumvitset-medium; font-optical-sizing: inherit; font-kerning: inherit; font-feature-settings: inherit; font-variation-settings: inherit; vertical-align: baseline; color: rgb(215, 0, 0);\">อัตราค่าบริการปกติ ชั่วโมงละ 140 บาท<br style=\"box-sizing: inherit; margin: 0px; padding: 0px; outline: none;\">วันเสาร์-อาทิตย์ พิเศษ ชั่วโมงละ 100 บาท</div>', '<ol><li>ให้เช่าสนามสำหรับการเล่นฟุตบอลแบบทั่วไป</li><li>ให้เช่าเหมาสนามเพื่อจัดการแข่งขันหรือเพื่อฝึกซ้อม</li><li>ให้เช่าพื้นที่ถ่ายทำโฆษณา</li><li>ให้เช่าเหมาสนามและพื้นที่เพื่อการจัดงาน Event and Activity</li><li>จัดหากรรมการสนามหรือ ทีมคู่เล่น (โปรดแจ้งล่วงหน้า)</li><li>มีลูกฟุตบอลให้บริการ</li><li>มีรองเท้าฟุตบอลและถุงมือให้เช่า</li><li>มีผ้าเช็ดตัวให้เช่า</li><li>มีเสื้อแบ่งทีมให้บริการ</li><li>มีล๊อคเกอร์สำหรับเก็บของให้บริการ</li><li>ห้องอาบน้ำมีเครื่องปรับอากาศ บริการสบู่และยาสระผม</li><li>บริการอาหารและเครื่องดื่ม</li><li>Free Wi-Fi ในพื้นที่ต้อนรับ</li><li><br></li></ol>', 'uploads/stadiums/สนามแบดมินตัน-2024-01-25-img-1.jpg,uploads/stadiums/สนามแบดมินตัน-2024-01-25-img-2.jpg,uploads/stadiums/สนามแบดมินตัน-2024-01-25-img-3.jpg,uploads/stadiums/สนามแบดมินตัน-2024-01-25-img-4.jpg,uploads/stadiums/สนามแบดมินตัน-2024-01-25-img-5.jpeg,uploads/stadiums/สนามแบดมินตัน-2024-01-25-img-6.jpg', '1', '2024-01-25 13:14:54', '2024-01-25 13:14:54'),
(3, 'สนามปิงปอง', 150, '<ul style=\"color: rgb(0, 0, 0); font-family: Pridi, Tahoma; margin-bottom: 0px !important;\"><li>ขนาด 2,740 x 1,525 มม. สูง 760 มม.</li><li>โครงเหล็กแข็งแรง ออกแบบจากโรงงานดับเบิ้ลฟิชปิง<br></li><li>พื้นผิวโต๊ะแข็งแรง ผิวเคลือบจากเยอรมัน แข็งแรงทนทาน</li><li>พับเก็บได้ ไม่เปลืองพื้นที่จัดเก็บ</li></ul>', '<p><span style=\"color: rgb(0, 0, 0); font-size: 14px; font-family: Arial, Helvetica, sans-serif; line-height: 19px;\"><font color=\"#ff0000\">เรามีบริการประกอบไม้ปิงปองและยางปิงปองให้ฟรี</font></span><span style=\"font-size: 14px; color: rgb(120, 120, 120); font-family: Arial, Helvetica, sans-serif; line-height: 19px;\">&nbsp;นอกจากนี้ร้านของเรายังมี</span><span style=\"color: rgb(0, 0, 0); font-size: 14px; font-family: Arial, Helvetica, sans-serif; line-height: 19px;\"><font color=\"#ff0000\">บริการสอนปิงปอง</font></span><span style=\"font-size: 14px; color: rgb(120, 120, 120); font-family: Arial, Helvetica, sans-serif; line-height: 19px;\">&nbsp;มีตั้งแต่คอร์สสำหรับ</span><span style=\"color: rgb(0, 0, 0); font-size: 14px; font-family: Arial, Helvetica, sans-serif; line-height: 19px;\"><font color=\"#ff0000\">ผู้เริ่มต้นจนกระทั่งถึงระดับแข่งขัน</font></span><span style=\"font-size: 14px; color: rgb(120, 120, 120); font-family: Arial, Helvetica, sans-serif; line-height: 19px;\">&nbsp;มีทั้งเป็นรายคอร์สและรายครั้ง อีกทั้งยังมีบริการน็อกที่คิดเป็นรายชั่วโมง&nbsp;</span><br></p>', 'uploads/stadiums/สนามปิงปอง-2024-01-25-img-1.jpg,uploads/stadiums/สนามปิงปอง-2024-01-25-img-2.jpg,uploads/stadiums/สนามปิงปอง-2024-01-25-img-3.jpg,uploads/stadiums/สนามปิงปอง-2024-01-25-img-4.jpg,uploads/stadiums/สนามปิงปอง-2024-01-25-img-5.jpg,uploads/stadiums/สนามปิงปอง-2024-01-25-img-6.jpg', '1', '2024-01-25 15:14:22', '2024-01-25 15:14:22');

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
(1, 'admin', 'admin@gmail.com', '$2y$12$DLaPM/Xab/WKAB1CYVv32uPtzzCn.f2m0Zc7ukqjpXSh5kPjRwd1O', '9', 'ymMfzaYCuGUSVDPg2SNdHEbBXRAEmLKcQEpGhhoFuPTLMdpTAao7bKpHZDcL', '2024-01-25 04:52:08', '2024-01-25 04:52:08'),
(2, 'user1', 'user1@gmail.com', '$2y$12$WITjr059y1NoEsy.0JYLR.hh/IXikEHkwr3quPlXQbLPfXr32gGEa', '1', '4p5u0z4x8PTu4NmR8P4n3UulKp2C6xa7cb1xbdVUxKCoLXEEw3TQrwEzZeuS', '2024-01-25 05:28:29', '2024-01-25 05:28:29'),
(3, 'user2', 'user2@gmail.com', '$2y$12$bIwtb/rXstuo63DwTs.2LuLHVZw.WalTRthlpkuCN23lTInKzXm02', '1', 'jlJnm6v9FXUINivthuyBJmzYjjxM6tGzFU8gHEAmmJ1UxHOrznBn3Qn6zIXC', '2024-01-25 05:28:55', '2024-01-25 05:28:55');

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
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
