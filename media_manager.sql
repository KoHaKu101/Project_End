-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2023 at 10:43 AM
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
-- Database: `media_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` varchar(10) NOT NULL,
  `type_book_id` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `edition` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `original_page` varchar(10) NOT NULL,
  `isbn` varchar(13) NOT NULL,
  `level` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `type_book_id`, `name`, `author`, `publisher`, `edition`, `year`, `original_page`, `isbn`, `level`, `created_at`, `updated_at`) VALUES
('bk_0000001', 'tb_0000002', 'แมวเป้า', 'นายพิชิตชัย', 'ธรรมดา', '1', '2565', '40', '1561651651651', NULL, '2023-12-04 23:53:04', '2023-12-05 00:34:40'),
('bk_0000002', 'tb_0000001', 'lisa', 'lisa', 'XO', '1', '2560', '100', '1561565646546', '10', '2023-12-04 23:55:04', '2023-12-05 00:36:18'),
('bk_0000003', 'tb_0000005', 'น้องเสือ', 'ชายไร้นาม', 'มองเบลอ', '2', '2565', '10', '1516515616515', '14', '2023-12-05 04:20:28', '2023-12-05 04:20:28'),
('bk_0000004', 'tb_0000001', 'วิทยาการ', 'นายนักวาด', 'วาดรูปดี', '1', '2560', '100', '1234567891000', NULL, '2023-12-13 10:22:56', '2023-12-13 10:23:21'),
('bk_0000005', 'tb_0000001', 'วิทยาการคอม', 'าิผปทสิาทผ', 'ผปิผวสปทิาส', '10', '2545', '102', '1234567891009', '10', '2023-12-13 21:50:00', '2023-12-20 11:43:52'),
('bk_0000006', 'tb_0000002', 'วิทยาการคอม2', 'นายพิชิตชัย', 'ทิวลี', '10', '2545', '102', '1234567891005', '10', '2023-12-20 11:12:21', '2023-12-20 11:18:01'),
('bk_0000007', 'tb_0000001', 'คอมพิวเตอร์', 'พิชิตชัย', 'สมัคร', '10', '2545', '103', '1561651654984', NULL, '2023-12-20 11:47:10', '2023-12-20 11:47:37'),
('bk_0000008', 'tb_0000001', 'หนังสือสอนวาดรูป', 'ชายไร้นาม', 'วาดรูปดี', '1', '2563', '105', '1234567891236', NULL, '2023-12-20 12:00:55', '2023-12-20 12:00:55');

-- --------------------------------------------------------

--
-- Table structure for table `copy_books`
--

CREATE TABLE `copy_books` (
  `copy_id` varchar(10) NOT NULL,
  `book_id` varchar(10) NOT NULL,
  `amount` smallint(5) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `copy_books`
--

INSERT INTO `copy_books` (`copy_id`, `book_id`, `amount`, `created_at`, `updated_at`) VALUES
('cb_0000001', 'bk_0000001', 6, NULL, '2023-12-19 06:55:10'),
('cb_0000002', 'bk_0000002', 0, '2023-12-04 23:55:05', '2023-12-13 10:27:12'),
('cb_0000003', 'bk_0000003', 0, '2023-12-05 04:20:28', '2023-12-13 21:51:37'),
('cb_0000004', 'bk_0000004', 3, '2023-12-13 10:22:56', '2023-12-13 10:23:04'),
('cb_0000005', 'bk_0000005', 1, '2023-12-13 21:50:00', '2023-12-13 21:51:22'),
('cb_0000006', 'bk_0000006', 1, '2023-12-20 11:12:21', '2023-12-20 11:53:49'),
('cb_0000007', 'bk_0000007', 8, '2023-12-20 11:47:10', '2023-12-20 11:53:32'),
('cb_0000008', 'bk_0000008', 0, '2023-12-20 12:00:55', '2023-12-20 12:00:55');

-- --------------------------------------------------------

--
-- Table structure for table `copy_book_outs`
--

CREATE TABLE `copy_book_outs` (
  `copyout_id` varchar(10) NOT NULL,
  `copy_id` varchar(10) NOT NULL,
  `emp_id` varchar(10) NOT NULL,
  `amount` smallint(5) UNSIGNED DEFAULT NULL,
  `status` smallint(5) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `copy_book_outs`
--

INSERT INTO `copy_book_outs` (`copyout_id`, `copy_id`, `emp_id`, `amount`, `status`, `created_at`, `updated_at`) VALUES
('cbo_000001', 'cb_0000002', 'pd_0000001', 1, 2, '2023-12-13 07:18:03', '2023-12-13 07:18:07'),
('cbo_000002', 'cb_0000002', 'pd_0000001', 1, 1, '2023-12-13 07:18:26', '2023-12-13 07:18:26');

-- --------------------------------------------------------

--
-- Table structure for table `emps`
--

CREATE TABLE `emps` (
  `emp_id` varchar(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `gender` char(1) NOT NULL,
  `birthday` date NOT NULL,
  `age` int(11) NOT NULL,
  `id_card` varchar(13) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `address` text NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `emps`
--

INSERT INTO `emps` (`emp_id`, `username`, `password`, `f_name`, `l_name`, `gender`, `birthday`, `age`, `id_card`, `tel`, `status`, `address`, `remember_token`, `created_at`, `updated_at`) VALUES
('pd_0000001', 'admin', '$2y$10$f0gXgiQ//r6uTiYDxdFz8ekJg0DpeN7Mzt6n38qjqIpSWKMd9538W', 'admin', 'admin', 'M', '2023-12-05', 23, '4', '0', 1, '151643', NULL, '2023-12-04 20:49:34', '2023-12-04 20:49:34'),
('pd_0000002', 'sellsnak', '$2y$10$jDLnvUaPjqdBnrSJNaGgNuqKFrsSKRlVeU.mKzBijIupHpouYytMy', 'นางสาวกัลยรัตน์', 'ไตรลิน', 'M', '2000-12-02', 21, '1561651235646', '0883004952', 2, 'ถนนราชการดำเนิน', NULL, '2023-12-04 20:50:46', '2023-12-04 20:50:46'),
('pd_0000003', 'pond', '$2y$10$yQAdLNS7q449GrER1e24uurAxQmORjV9Gau9.u0hdkAFLqNWCgjv2', 'นายปอนคุง', 'ทีโอที', 'M', '5555-12-01', 14, '1566516516651', '0884444959', 2, 'asgasga', NULL, '2023-12-07 19:07:38', '2023-12-07 19:07:38');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `media_id` varchar(10) NOT NULL,
  `book_id` varchar(10) NOT NULL,
  `type_media_id` varchar(10) NOT NULL,
  `number` varchar(255) NOT NULL,
  `amount_end` varchar(10) DEFAULT NULL,
  `braille_page` varchar(10) DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL,
  `check_date` date DEFAULT NULL,
  `translator` varchar(255) DEFAULT NULL,
  `sound_sys` varchar(50) DEFAULT NULL,
  `source` varchar(50) DEFAULT NULL,
  `file_location` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`media_id`, `book_id`, `type_media_id`, `number`, `amount_end`, `braille_page`, `status`, `check_date`, `translator`, `sound_sys`, `source`, `file_location`, `created_at`, `updated_at`) VALUES
('md_0000001', 'bk_0000001', 'tm_0000002', '1', NULL, NULL, 1, NULL, 'นายพิชิตชัย ธรรมชัย', 'MP4', 'โรงเรียนบ้าน', NULL, '2023-12-05 03:26:18', '2023-12-12 06:51:44'),
('md_0000002', 'bk_0000002', 'tm_0000001', '1', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2023-12-13 07:07:19', '2023-12-13 07:07:19'),
('md_0000003', 'bk_0000003', 'tm_0000001', '1', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2023-12-13 08:54:08', '2023-12-13 08:54:08'),
('md_0000004', 'bk_0000002', 'tm_0000002', '1', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2023-12-13 19:29:53', '2023-12-13 19:29:53'),
('md_0000005', 'bk_0000004', 'tm_0000002', '1', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2023-12-13 19:32:14', '2023-12-13 19:32:14'),
('md_0000006', 'bk_0000004', 'tm_0000001', '1', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2023-12-13 19:36:23', '2023-12-13 19:36:23'),
('md_0000007', 'bk_0000005', 'tm_0000002', '1', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2023-12-15 02:11:51', '2023-12-15 02:11:51');

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
(102, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(103, '2023_11_13_111927_create_emps_table', 1),
(104, '2023_11_14_085539_create_type_books_table', 1),
(105, '2023_11_14_122435_create_type_media_table', 1),
(106, '2023_11_15_035858_create_books_table', 1),
(107, '2023_11_15_070959_create_copy_books_table', 1),
(108, '2023_11_21_065839_create_media_table', 1),
(109, '2023_11_22_075901_create_copy_book_outs_table', 1),
(110, '2023_11_26_134906_create_receive_books_table', 1),
(111, '2023_12_05_024026_create_receive_book_descs_table', 1),
(112, '2023_12_05_035707_add_receive_books_table', 2),
(115, '2023_12_05_062304_create_request_users_table', 3),
(116, '2023_12_05_074802_create_request_media_table', 3),
(117, '2023_12_12_061452_create_order_media_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `order_media`
--

CREATE TABLE `order_media` (
  `order_id` varchar(10) NOT NULL,
  `emp_id` varchar(10) NOT NULL,
  `request_id` varchar(10) NOT NULL,
  `order_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_media`
--

INSERT INTO `order_media` (`order_id`, `emp_id`, `request_id`, `order_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
('or_0000001', 'pd_0000002', 'req_000002', '2023-12-12', NULL, 2, '2023-12-12 00:45:36', '2023-12-13 08:54:08'),
('or_0000002', 'pd_0000002', 'req_000004', '2023-12-12', NULL, 2, '2023-12-12 01:23:38', '2023-12-13 03:09:55'),
('or_0000003', 'pd_0000002', 'req_000005', '2023-12-13', NULL, 2, '2023-12-13 07:03:30', '2023-12-13 07:07:19'),
('or_0000004', 'pd_0000002', 'req_000006', '2023-12-13', NULL, 2, '2023-12-13 08:39:16', '2023-12-13 08:54:08'),
('or_0000005', 'pd_0000002', 'req_000007', '2023-12-13', NULL, 2, '2023-12-13 09:16:09', '2023-12-13 09:16:09'),
('or_0000006', 'pd_0000002', 'req_000008', '2023-12-13', NULL, 2, '2023-12-13 11:14:26', '2023-12-13 19:32:14'),
('or_0000007', 'pd_0000002', 'req_000010', '2023-12-13', NULL, 2, '2023-12-13 11:14:40', '2023-12-13 19:36:23'),
('or_0000008', 'pd_0000002', 'req_000011', '2023-12-14', NULL, 2, '2023-12-13 19:36:07', '2023-12-13 19:36:23'),
('or_0000009', 'pd_0000002', 'req_000009', '2023-12-14', NULL, 2, '2023-12-13 21:54:08', '2023-12-13 21:54:46'),
('or_0000010', 'pd_0000002', 'req_000012', '2023-12-15', NULL, 2, '2023-12-15 02:11:30', '2023-12-15 02:11:51'),
('or_0000011', 'pd_0000002', 'req_000013', '2023-12-20', NULL, 1, '2023-12-20 13:43:51', '2023-12-20 13:43:51');

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
-- Table structure for table `receive_books`
--

CREATE TABLE `receive_books` (
  `recv_id` varchar(10) NOT NULL,
  `emp_id` varchar(10) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `add_date` date NOT NULL,
  `add_type` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `receive_books`
--

INSERT INTO `receive_books` (`recv_id`, `emp_id`, `book_name`, `add_date`, `add_type`, `created_at`, `updated_at`) VALUES
('recv_00001', 'pd_0000002', 'แมวเป้า', '2023-12-05', 2, '2023-12-04 21:10:56', '2023-12-04 21:10:56'),
('recv_00002', 'pd_0000002', 'วิทยาการ', '2023-12-13', 2, '2023-12-13 07:24:55', '2023-12-13 07:24:55'),
('recv_00003', 'pd_0000002', 'น้องเสือ', '2023-12-13', 2, '2023-12-13 07:30:36', '2023-12-13 07:30:36'),
('recv_00006', 'pd_0000002', 'ร้านขายยา', '2023-12-20', 2, '2023-12-20 11:57:28', '2023-12-20 11:57:28'),
('recv_00007', 'pd_0000002', 'หนังสือสอนวาดรูป', '2023-12-20', 2, '2023-12-20 12:01:16', '2023-12-20 12:01:16');

-- --------------------------------------------------------

--
-- Table structure for table `receive_book_descs`
--

CREATE TABLE `receive_book_descs` (
  `recd_id` varchar(10) NOT NULL,
  `recv_id` varchar(10) NOT NULL,
  `book_id` varchar(10) DEFAULT NULL,
  `desc` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `receive_book_descs`
--

INSERT INTO `receive_book_descs` (`recd_id`, `recv_id`, `book_id`, `desc`, `created_at`, `updated_at`) VALUES
('recv_00002', 'recv_00001', 'bk_0000001', 'จากร้านน้องเฟริส', '2023-12-04 21:10:56', '2023-12-04 23:53:04'),
('recv_00003', 'recv_00002', 'bk_0000004', 'ฟหเฟ', '2023-12-13 07:24:55', '2023-12-13 10:22:56'),
('recv_00004', 'recv_00003', 'bk_0000003', 'asfasf', '2023-12-13 07:30:36', '2023-12-13 07:30:36'),
('recv_00007', 'recv_00006', NULL, 'ซื้อมาจากร้าน .... จำนวน 30 เล่ม', '2023-12-20 11:57:28', '2023-12-20 11:57:28'),
('recv_00008', 'recv_00007', 'bk_0000008', 'ฟหดทาฟหสดท', '2023-12-20 12:01:16', '2023-12-20 12:01:16');

-- --------------------------------------------------------

--
-- Table structure for table `request_media`
--

CREATE TABLE `request_media` (
  `request_id` varchar(10) NOT NULL,
  `emp_id` varchar(10) NOT NULL,
  `type_media_id` varchar(10) NOT NULL,
  `requesters_id` varchar(10) NOT NULL,
  `book_id` varchar(10) NOT NULL,
  `request_date` date NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `request_media`
--

INSERT INTO `request_media` (`request_id`, `emp_id`, `type_media_id`, `requesters_id`, `book_id`, `request_date`, `status`, `created_at`, `updated_at`) VALUES
('req_000001', 'pd_0000002', 'tm_0000002', 'user_00002', 'bk_0000001', '2023-12-05', 2, '2023-12-05 04:13:46', '2023-12-05 04:13:46'),
('req_000002', 'pd_0000003', 'tm_0000001', 'user_00002', 'bk_0000003', '2023-12-08', 3, '2023-12-07 19:05:52', '2023-12-12 00:45:36'),
('req_000004', 'pd_0000002', 'tm_0000001', 'user_00002', 'bk_0000001', '2023-12-12', 3, '2023-12-12 01:14:23', '2023-12-12 01:23:38'),
('req_000005', 'pd_0000002', 'tm_0000001', 'user_00002', 'bk_0000002', '2023-12-12', 3, '2023-12-12 01:19:43', '2023-12-13 07:03:30'),
('req_000006', 'pd_0000002', 'tm_0000001', 'user_00003', 'bk_0000003', '2023-12-13', 3, '2023-12-13 08:38:37', '2023-12-13 08:39:16'),
('req_000007', 'pd_0000002', 'tm_0000002', 'user_00008', 'bk_0000002', '2023-12-13', 3, '2023-12-13 09:15:14', '2023-12-13 09:16:09'),
('req_000008', 'pd_0000002', 'tm_0000002', 'user_00002', 'bk_0000004', '2023-12-13', 3, '2023-12-13 10:56:18', '2023-12-13 11:14:26'),
('req_000009', 'pd_0000002', 'tm_0000002', 'user_00010', 'bk_0000004', '2023-12-13', 3, '2023-12-13 10:57:00', '2023-12-13 21:54:08'),
('req_000010', 'pd_0000002', 'tm_0000001', 'user_00002', 'bk_0000004', '2023-12-13', 3, '2023-12-13 11:01:47', '2023-12-13 11:14:40'),
('req_000011', 'pd_0000002', 'tm_0000001', 'user_00002', 'bk_0000004', '2023-12-14', 3, '2023-12-13 19:35:42', '2023-12-13 19:36:07'),
('req_000012', 'pd_0000002', 'tm_0000002', 'user_00012', 'bk_0000005', '2023-12-15', 3, '2023-12-15 02:11:17', '2023-12-15 02:11:30'),
('req_000013', 'pd_0000002', 'tm_0000002', 'user_00012', 'bk_0000008', '2023-12-20', 3, '2023-12-20 12:25:20', '2023-12-20 13:43:51'),
('req_000014', 'pd_0000002', 'tm_0000001', 'user_00014', 'bk_0000008', '2023-12-20', 1, '2023-12-20 12:35:58', '2023-12-20 12:35:58'),
('req_000015', 'pd_0000002', 'tm_0000002', 'user_00014', 'bk_0000003', '2023-12-20', 1, '2023-12-20 12:36:41', '2023-12-20 12:37:47'),
('req_000016', 'pd_0000002', 'tm_0000001', 'user_00014', 'bk_0000008', '2023-12-20', 1, '2023-12-20 13:13:15', '2023-12-20 13:13:15');

-- --------------------------------------------------------

--
-- Table structure for table `request_users`
--

CREATE TABLE `request_users` (
  `requesters_id` varchar(10) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `gender` char(1) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `id_card` varchar(13) DEFAULT NULL,
  `tel` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `request_users`
--

INSERT INTO `request_users` (`requesters_id`, `f_name`, `l_name`, `gender`, `birthday`, `age`, `id_card`, `tel`, `created_at`, `updated_at`) VALUES
('user_00002', 'พิชิตชัย', 'ธรรมชัย', NULL, NULL, NULL, NULL, '088304953', '2023-12-05 04:13:46', '2023-12-06 06:27:06'),
('user_00003', 'ปอน', 'เทพซ่า', NULL, NULL, NULL, NULL, '088304953', '2023-12-05 04:15:02', '2023-12-06 06:43:00'),
('user_00008', 'ชนาธิป', 'เกตโล2', NULL, NULL, NULL, NULL, '0951324443', '2023-12-13 09:15:14', '2023-12-13 09:15:14'),
('user_00010', 'พิชิตชัย', 'ธรรมชัย3', 'M', NULL, NULL, '1561651235641', '088304956', '2023-12-13 10:57:00', '2023-12-20 13:39:57'),
('user_00012', 'นิยา', 'ธรรมชัย', NULL, NULL, NULL, NULL, '0883004952', '2023-12-13 11:13:52', '2023-12-13 11:13:52'),
('user_00014', 'อุดมs', 'ธรรมชัย', 'F', '2455-12-02', 14, '1561651235646', '0883004952', '2023-12-20 12:35:58', '2023-12-20 13:43:10');

-- --------------------------------------------------------

--
-- Table structure for table `type_books`
--

CREATE TABLE `type_books` (
  `type_book_id` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_books`
--

INSERT INTO `type_books` (`type_book_id`, `name`, `created_at`, `updated_at`) VALUES
('tb_0000001', 'นิยาย', '2023-12-04 23:35:58', '2023-12-04 23:35:58'),
('tb_0000002', 'หนังสือการ์ตูน', '2023-12-04 23:36:12', '2023-12-04 23:36:12'),
('tb_0000005', 'คณิตศาสตร์', '2023-12-04 23:40:10', '2023-12-04 23:40:10'),
('tb_0000006', 'พิชิตชัย ธรรมชัย', '2023-12-20 07:27:15', '2023-12-20 09:45:04');

-- --------------------------------------------------------

--
-- Table structure for table `type_media`
--

CREATE TABLE `type_media` (
  `type_media_id` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_media`
--

INSERT INTO `type_media` (`type_media_id`, `name`, `desc`, `created_at`, `updated_at`) VALUES
('tm_0000001', 'อักษรเบล', 'หนังสืออักษรเบล', '2023-12-05 02:02:52', '2023-12-05 02:02:52'),
('tm_0000002', 'สื่อเสียง', 'สื่อที่ให้เสียงต่อผู้พิการทางสายตา', '2023-12-05 02:03:02', '2023-12-20 10:24:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD UNIQUE KEY `books_isbn_unique` (`isbn`),
  ADD KEY `books_type_book_id_foreign` (`type_book_id`);

--
-- Indexes for table `copy_books`
--
ALTER TABLE `copy_books`
  ADD PRIMARY KEY (`copy_id`),
  ADD KEY `copy_books_book_id_foreign` (`book_id`);

--
-- Indexes for table `copy_book_outs`
--
ALTER TABLE `copy_book_outs`
  ADD PRIMARY KEY (`copyout_id`),
  ADD KEY `copy_book_outs_copy_id_foreign` (`copy_id`),
  ADD KEY `copy_book_outs_emp_id_foreign` (`emp_id`);

--
-- Indexes for table `emps`
--
ALTER TABLE `emps`
  ADD PRIMARY KEY (`emp_id`),
  ADD UNIQUE KEY `emps_username_unique` (`username`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`media_id`),
  ADD KEY `media_book_id_foreign` (`book_id`),
  ADD KEY `media_type_media_id_foreign` (`type_media_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_media`
--
ALTER TABLE `order_media`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `order_media_emp_id_foreign` (`emp_id`),
  ADD KEY `order_media_request_id_foreign` (`request_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `receive_books`
--
ALTER TABLE `receive_books`
  ADD PRIMARY KEY (`recv_id`),
  ADD KEY `receive_books_emp_id_foreign` (`emp_id`);

--
-- Indexes for table `receive_book_descs`
--
ALTER TABLE `receive_book_descs`
  ADD PRIMARY KEY (`recd_id`),
  ADD KEY `receive_book_descs_recv_id_foreign` (`recv_id`),
  ADD KEY `receive_book_descs_book_id_foreign` (`book_id`);

--
-- Indexes for table `request_media`
--
ALTER TABLE `request_media`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `request_media_emp_id_foreign` (`emp_id`),
  ADD KEY `request_media_type_media_id_foreign` (`type_media_id`),
  ADD KEY `request_media_requesters_id_foreign` (`requesters_id`),
  ADD KEY `request_media_book_id_foreign` (`book_id`);

--
-- Indexes for table `request_users`
--
ALTER TABLE `request_users`
  ADD PRIMARY KEY (`requesters_id`);

--
-- Indexes for table `type_books`
--
ALTER TABLE `type_books`
  ADD PRIMARY KEY (`type_book_id`),
  ADD UNIQUE KEY `type_books_name_unique` (`name`);

--
-- Indexes for table `type_media`
--
ALTER TABLE `type_media`
  ADD PRIMARY KEY (`type_media_id`),
  ADD UNIQUE KEY `type_media_name_unique` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_type_book_id_foreign` FOREIGN KEY (`type_book_id`) REFERENCES `type_books` (`type_book_id`);

--
-- Constraints for table `copy_books`
--
ALTER TABLE `copy_books`
  ADD CONSTRAINT `copy_books_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);

--
-- Constraints for table `copy_book_outs`
--
ALTER TABLE `copy_book_outs`
  ADD CONSTRAINT `copy_book_outs_copy_id_foreign` FOREIGN KEY (`copy_id`) REFERENCES `copy_books` (`copy_id`),
  ADD CONSTRAINT `copy_book_outs_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `emps` (`emp_id`);

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`),
  ADD CONSTRAINT `media_type_media_id_foreign` FOREIGN KEY (`type_media_id`) REFERENCES `type_media` (`type_media_id`);

--
-- Constraints for table `order_media`
--
ALTER TABLE `order_media`
  ADD CONSTRAINT `order_media_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `emps` (`emp_id`),
  ADD CONSTRAINT `order_media_request_id_foreign` FOREIGN KEY (`request_id`) REFERENCES `request_media` (`request_id`);

--
-- Constraints for table `receive_books`
--
ALTER TABLE `receive_books`
  ADD CONSTRAINT `receive_books_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `emps` (`emp_id`);

--
-- Constraints for table `receive_book_descs`
--
ALTER TABLE `receive_book_descs`
  ADD CONSTRAINT `receive_book_descs_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`),
  ADD CONSTRAINT `receive_book_descs_recv_id_foreign` FOREIGN KEY (`recv_id`) REFERENCES `receive_books` (`recv_id`);

--
-- Constraints for table `request_media`
--
ALTER TABLE `request_media`
  ADD CONSTRAINT `request_media_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`),
  ADD CONSTRAINT `request_media_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `emps` (`emp_id`),
  ADD CONSTRAINT `request_media_requesters_id_foreign` FOREIGN KEY (`requesters_id`) REFERENCES `request_users` (`requesters_id`),
  ADD CONSTRAINT `request_media_type_media_id_foreign` FOREIGN KEY (`type_media_id`) REFERENCES `type_media` (`type_media_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
