-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2023 at 06:01 AM
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
('bk_0000001', 'tb_0000006', 'คิดจะพักคิดถึงคิดแค็ท', 'ชายไร้นาม', 'มองเบลอ', '1', 'พ.ศ.2563', '101', '1234567891236', NULL, '2023-11-14 23:35:04', '2023-11-15 00:04:40');

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
('cb_0000001', 'bk_0000001', 7, '2023-11-18 21:50:19', '2023-11-18 22:36:10');

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
('pd_0000001', 'admin', '$2y$10$EVUokBi3HVEngGFv9Ftn0eDhijEZv.L1841/nsHF26fm/lPqIVEJ6', 'นายพิชิตชัย', 'ธรรมชัย', 'M', '2545-12-02', 21, '1459900901031', '0883004952', 1, 'ถนนราชการดำเนิน', NULL, '2023-11-14 23:08:21', '2023-11-14 23:08:21'),
('pd_0000002', 'sellsnackthai', '$2y$10$78oueWGaX2PuAT13tuEiou6610HfcdLRyrr4Byn5z9RlMRQ1M3FD6', 'นางสาวกัลยรัตน์', 'ไตรลิน', 'F', '2001-09-10', 22, '5161561651656', '0968491387', 2, '143/3', NULL, '2023-11-14 23:12:25', '2023-11-14 23:13:04');

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
(72, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(73, '2023_11_13_111927_create_emps_table', 1),
(74, '2023_11_14_085539_create_type_books_table', 1),
(75, '2023_11_14_122435_create_type_media_table', 1),
(77, '2023_11_15_035858_create_books_table', 2),
(78, '2023_11_15_070959_create_copy_books_table', 3);

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
('tb_0000001', 'นิยาย', '2023-11-14 23:16:37', '2023-11-14 23:16:37'),
('tb_0000002', 'คณิตศาสตร์', '2023-11-14 23:17:09', '2023-11-14 23:17:09'),
('tb_0000003', 'ประวัติศาสตร์', '2023-11-14 23:17:17', '2023-11-14 23:17:17'),
('tb_0000004', 'สังคม', '2023-11-14 23:17:22', '2023-11-14 23:17:22'),
('tb_0000005', 'การ์ตูน', '2023-11-14 23:17:31', '2023-11-14 23:17:31'),
('tb_0000006', 'มังงะ', '2023-11-14 23:26:01', '2023-11-14 23:26:01');

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
('tm_0000001', 'อักษรเบล', 'ฟหกฟหกฟก', '2023-11-14 23:16:00', '2023-11-14 23:16:00'),
('tm_0000002', 'หนังสือเสียง', 'ฟหกฟหกฟหก', '2023-11-14 23:16:08', '2023-11-14 23:16:08');

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
-- Indexes for table `emps`
--
ALTER TABLE `emps`
  ADD PRIMARY KEY (`emp_id`),
  ADD UNIQUE KEY `emps_username_unique` (`username`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
