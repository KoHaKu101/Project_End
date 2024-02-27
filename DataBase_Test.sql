-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2024 at 06:51 PM
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
  `img_book` varchar(255) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `abstract` text DEFAULT NULL,
  `synopsis` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `type_book_id`, `name`, `author`, `publisher`, `edition`, `year`, `original_page`, `isbn`, `level`, `img_book`, `language`, `abstract`, `synopsis`, `created_at`, `updated_at`) VALUES
('bk_0000001', 'tb_0000018', 'ปรัชญา 101 (PHILOSOPHY 101)', 'Paul Kleinman (พอล ไคลน์แมน)', 'แอร์โรว์ มัลติมีเดีย', '1', '2566', '336', '9786164343337', NULL, '1791987009270262.jpg', NULL, 'การค้นพบนักคิดที่ยิ่งใหญ่ที่สุดในโลกและแนวคิดที่ก้าวล้ำของพวกเขา!บ่อยครั้งที่ตำราเรียนเปลี่ยนทฤษฎี หลักการ และตัวเลขของปรัชญาที่น่าจดจำให้กลายเป็นวาทกรรมที่น่าเบื่อหน่ายซึ่งแม้แต่เพลโตก็ยังปฏิเสธ ปรัชญา 101 ตัดทอนรายละเอียดที่น่าเบื่อและวิธีการทางปรัชญาที่เหนื่อยล้าออกไป และให้บทเรียนเกี่ยวกับปรัชญาที่ทำให้คุณมีส่วนร่วมในขณะที่คุณสำรวจประวัติศาสตร์ที่น่าสนใจของความคิดและการสืบสวนของมนุษย์ตั้งแต่อริสโตเติลและไฮเดกเกอร์ไปจนถึงเจตจำนงเสรีและอภิปรัชญาPhilosophy 101 เต็มไปด้วยเกร็ดเล็กเกร็ดน้อยทางปรัชญาที่สนุกสนาน ภาพประกอบ และปริศนาทางความคิดที่คุณไม่สามารถหาได้จากที่อื่น', 'การค้นพบนักคิดที่ยิ่งใหญ่ที่สุดในโลกและแนวคิดที่ก้าวล้ำของพวกเขา!บ่อยครั้งที่ตำราเรียนเปลี่ยนทฤษฎี หลักการ และตัวเลขของปรัชญาที่น่าจดจำให้กลายเป็นวาทกรรมที่น่าเบื่อหน่ายซึ่งแม้แต่เพลโตก็ยังปฏิเสธ ปรัชญา 101 ตัดทอนรายละเอียดที่น่าเบื่อและวิธีการทางปรัชญาที่เหนื่อยล้าออกไป และให้บทเรียนเกี่ยวกับปรัชญาที่ทำให้คุณมีส่วนร่วมในขณะที่คุณสำรวจประวัติศาสตร์ที่น่าสนใจของความคิดและการสืบสวนของมนุษย์ตั้งแต่อริสโตเติลและไฮเดกเกอร์ไปจนถึงเจตจำนงเสรีและอภิปรัชญาPhilosophy 101 เต็มไปด้วยเกร็ดเล็กเกร็ดน้อยทางปรัชญาที่สนุกสนาน ภาพประกอบ และปริศนาทางความคิดที่คุณไม่สามารถหาได้จากที่อื่น', '2024-02-26 17:00:00', '2024-02-26 17:00:00'),
('bk_0000002', 'tb_0000013', 'เงามังกร', 'บัณรส', 'ศูนย์หนังสือจุฬา/chula', '1', '2560', '237', '9786164403390', NULL, '1791987300507859.jpg', 'ไทย', 'เกิดมีข่าวการขุดพบทองคำโบราณที่อำเภอเขาชัยสน-พัทลุงขึ้นมา มันเป็นอะไรที่น่าสนใจมาก ผมตามอ่านอย่างจดจ่อ ขณะที่อ่านไปสมองก็พยายามวิเคราะห์ตั้งสมมุติฐานเพื่อตอบให้ได้ว่าทองพวกนี้มาจากไหน เพียงสองวันจากนั้น เค้าโครงทั้งหลายของนวนิยายเรื่องใหม่ก็ปรากฏขึ้นในหัว ทองคำพัทลุง เชื่อมโยงกับ ประวัติศาสตร์คาบสมุทร ประวัติศาสตร์เอเชียตะวันออกเฉียงใต้ เรื่องราวของเจิ้งเหอ และ มะละกา ทยอยผุดขึ้นมาเอง สำหรับผม ประวัติศาสตร์คาบสมุทรทะเลใต้ในยุคเจิ้งเหอเป็นช่วงเวลาที่น่าสนใจใคร่รู้ที่สุดช่วงหนึ่ง เพราะมันเป็นช่วงเปลี่ยนผ่าน -รอยต่อของยุคสมัยใหญ่ของโลก ต้นศตวรรษที่ 15', 'เกิดมีข่าวการขุดพบทองคำโบราณที่อำเภอเขาชัยสน-พัทลุงขึ้นมา มันเป็นอะไรที่น่าสนใจมาก ผมตามอ่านอย่างจดจ่อ ขณะที่อ่านไปสมองก็พยายามวิเคราะห์ตั้งสมมุติฐานเพื่อตอบให้ได้ว่าทองพวกนี้มาจากไหน เพียงสองวันจากนั้น เค้าโครงทั้งหลายของนวนิยายเรื่องใหม่ก็ปรากฏขึ้นในหัว ทองคำพัทลุง เชื่อมโยงกับ ประวัติศาสตร์คาบสมุทร ประวัติศาสตร์เอเชียตะวันออกเฉียงใต้ เรื่องราวของเจิ้งเหอ และ มะละกา ทยอยผุดขึ้นมาเอง สำหรับผม ประวัติศาสตร์คาบสมุทรทะเลใต้ในยุคเจิ้งเหอเป็นช่วงเวลาที่น่าสนใจใคร่รู้ที่สุดช่วงหนึ่ง เพราะมันเป็นช่วงเปลี่ยนผ่าน -รอยต่อของยุคสมัยใหญ่ของโลก ต้นศตวรรษที่ 15', '2024-02-26 17:00:00', '2024-02-26 17:00:00'),
('bk_0000003', 'tb_0000016', 'ฝึกเขียนก่อนเรียนจีนกับเหล่าซือ', 'ทนงศักดิ์ เกียรติยศนุสรณ์', 'ศูนย์หนังสือจุฬา/chula', '1', '2560', '103', '9786167058955', NULL, '1791991816452745.jpg', 'ไทย', 'หนังสือเล่มนี้เรียบเรียงขึ้นมาเพื่อให้ผู้เริ่มศึกษาภาษาจีนมีพื้นฐานที่ดีในการเขียนอักษรจีน ซึ่งจะช่วยให้จดจำอักษรจีนได้แม่นยำยิ่งขึ้น เพราะการเขียนอักษรจีนสามารถฝึกได้ด้วยตนเองหรือฝึกพร้อมๆ กับบุตรหลาน ซึ่งจะช่วยให้คุณลดความกดดันขณะเรียนภาษาจีน และจะทำให้สามารถจดจำคำศัพท์ขณะเรียนได้เร็วขึ้น', 'หนังสือเล่มนี้เรียบเรียงขึ้นมาเพื่อให้ผู้เริ่มศึกษาภาษาจีนมีพื้นฐานที่ดีในการเขียนอักษรจีน ซึ่งจะช่วยให้จดจำอักษรจีนได้แม่นยำยิ่งขึ้น เพราะการเขียนอักษรจีนสามารถฝึกได้ด้วยตนเองหรือฝึกพร้อมๆ กับบุตรหลาน ซึ่งจะช่วยให้คุณลดความกดดันขณะเรียนภาษาจีน และจะทำให้สามารถจดจำคำศัพท์ขณะเรียนได้เร็วขึ้น', '2024-02-26 17:00:00', '2024-02-26 17:00:00'),
('bk_0000004', 'tb_0000016', 'คู่มือสอบภาษาเยอรมัน FIT IN DEUTSCH 1', 'วรรณา แสงอร่ามเรือง', 'ศูนย์หนังสือจุฬา/chula', '1', '2564', '140', '9789740340430', NULL, '1792009610623634.jpg', NULL, 'คู่มือสอบภาษาเยอรมัน FIT IN DEUTSCH 1 เล่มนี้จัดทำขึ้นเพื่อเด็กนักเรียนที่เรียนเยอรมันและต้องการไปสอบประกาศนียบัตร A1 ของสถาบันเกอเธ่ (GOETHE-ZERTIFIKAT A1) สามารถเข้าใจภาษาเยอรมันในข้อสอบได้อย่างถ่องแท้และรู้จักลักษณะของข้อสอบเป็นอย่างดี จะได้เตรียมตนเองให้พร้อมสอบ', 'คู่มือสอบภาษาเยอรมัน FIT IN DEUTSCH 1 เล่มนี้จัดทำขึ้นเพื่อเด็กนักเรียนที่เรียนเยอรมันและต้องการไปสอบประกาศนียบัตร A1 ของสถาบันเกอเธ่ (GOETHE-ZERTIFIKAT A1) สามารถเข้าใจภาษาเยอรมันในข้อสอบได้อย่างถ่องแท้และรู้จักลักษณะของข้อสอบเป็นอย่างดี จะได้เตรียมตนเองให้พร้อมสอบ', '2024-02-26 17:00:00', '2024-02-26 17:00:00');

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
('cb_0000001', 'bk_0000001', 2, '2024-02-26 17:00:00', '2024-02-26 17:00:00'),
('cb_0000002', 'bk_0000002', 1, '2024-02-26 17:00:00', '2024-02-26 17:00:00'),
('cb_0000003', 'bk_0000003', 0, '2024-02-26 17:00:00', '2024-02-26 17:00:00'),
('cb_0000004', 'bk_0000004', 0, '2024-02-26 17:00:00', '2024-02-26 17:00:00');

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
('cbo_000001', 'cb_0000002', 'pd_0000002', 1, 2, '2024-02-26 17:00:00', '2024-02-26 17:00:00'),
('cbo_000002', 'cb_0000001', 'pd_0000002', 1, 2, '2024-02-26 17:00:00', '2024-02-26 17:00:00'),
('cbo_000003', 'cb_0000002', 'pd_0000002', 1, 2, '2024-02-26 17:00:00', '2024-02-26 17:00:00'),
('cbo_000004', 'cb_0000001', 'pd_0000002', 3, 2, '2024-02-26 17:00:00', '2024-02-26 17:00:00'),
('cbo_000005', 'cb_0000001', 'pd_0000002', 1, 1, '2024-02-26 17:00:00', '2024-02-26 17:00:00');

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
('pd_0000001', 'admin', '$2y$10$XoQ0.7YvpQMxrRgk2iLVl.Jho9Ii0lm7DJppd/xYC3xKpN7SywqS2', 'admin', 'admin', 'M', '2024-02-26', 23, '13', '6', 1, '151643', NULL, '2024-02-25 17:00:00', '2024-02-25 17:00:00'),
('pd_0000002', 'tiw101', '$2y$10$.5.OcB5Lxt4B5dXRTPenc./KRTM3GSdr75lgcwEaAiT4jY03DhAoi', 'นายพิชิตชัย', 'ธรรมชัย', 'M', '2545-02-14', 21, '1459900901031', '0883004952', 1, 'ถนนราชการดำเนิน', NULL, '2024-02-25 17:00:00', '2024-02-25 17:00:00'),
('pd_0000003', 'tiw102', '$2y$10$oV4nm0KacqnQxVmlI8dUyuLDZcOO7O1hAPRoXP7MEbrWt4hCluOsK', 'ขวัญทิพย์', 'พงศ์พัฒนา', 'F', '2545-02-05', 21, '1459900901032', '0883004953', 1, 'ถนนราชการดำเนิน', NULL, '2024-02-25 17:00:00', '2024-02-25 17:00:00'),
('pd_0000009', 'tiw103', '$2y$10$rMYcJl8/d/0TjHjU32zuUepB6Av0p30m8B36wcKe/nFyNO8LLOX8C', 'สุวิชาดา', 'แสงดารา', 'M', '2545-10-06', 21, '1459900901030', '0883004959', 1, 'ถนนราชการดำเนิน', NULL, '2024-02-25 17:00:00', '2024-02-25 17:00:00'),
('pd_0000020', 'tiw105', '$2y$10$zZeQi3y1PqgQW8FiUxQdPO6V3V7yfZ2tK3paMopKln5RYai71CiEW', 'ญาดา', 'สิงห์ขาว', 'F', '1998-05-05', 30, '1459900901010', '0883004959', 1, 'ถนนราชการดำเนิน', NULL, '2024-02-25 17:00:00', '2024-02-25 17:00:00'),
('pd_0000021', 'tiw066', '$2y$10$BUcPyhR/nZffUFTtmce3EuoiPITomRettxh/3.3GPrXaH.fBlDgLW', 'แพรวานะ', 'สุขเกษม', 'F', '1986-12-02', 31, '1459900901036', '0883004950', 1, 'ถนนราชการดำเนิน', NULL, '2024-02-25 17:00:00', '2024-02-25 17:00:00'),
('pd_0000022', 'tiw201', '$2y$10$rnudw4RXIOiAjZzW07MU9.26OyDmbiPrqfv.aIuMrbTK6WGOjrlsy', 'นายพิชิตชัย', 'ธรรมชัย', 'F', '2545-02-14', 20, '1561651235646', '0883004952', 1, 'ถนนราชการดำเนิน', NULL, '2024-02-26 17:00:00', '2024-02-26 17:00:00');

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
  `time_hour` varchar(10) DEFAULT NULL,
  `time_minute` varchar(10) DEFAULT NULL,
  `source` varchar(50) DEFAULT NULL,
  `file_desc` text DEFAULT NULL,
  `file_type_select` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`media_id`, `book_id`, `type_media_id`, `number`, `amount_end`, `braille_page`, `status`, `check_date`, `translator`, `sound_sys`, `time_hour`, `time_minute`, `source`, `file_desc`, `file_type_select`, `created_at`, `updated_at`) VALUES
('md_0000001', 'bk_0000001', 'tm_0000001', 'BTC-1', '1', '140', 2, '2024-02-27', 'นายพิชิตชัย ธรรมชัย', NULL, NULL, NULL, NULL, NULL, 'text', '2024-02-26 17:00:00', '2024-02-26 17:00:00'),
('md_0000002', 'bk_0000001', 'tm_0000002', 'BSC-1', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'textarea', '2024-01-26 17:00:00', '2024-02-26 17:00:00'),
('md_0000003', 'bk_0000001', 'tm_0000003', 'Daisy-1', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'textarea', '2024-02-26 17:00:00', '2024-02-26 17:00:00'),
('md_0000004', 'bk_0000002', 'tm_0000001', 'BTC-2', NULL, NULL, 2, '2024-02-27', NULL, NULL, NULL, NULL, NULL, NULL, 'textarea', '2024-02-26 17:00:00', '2024-02-26 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `media_out`
--

CREATE TABLE `media_out` (
  `md_out_id` varchar(10) NOT NULL,
  `request_id` varchar(10) NOT NULL,
  `emp_id` varchar(10) NOT NULL,
  `md_out_date` date NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL,
  `desc` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media_out`
--

INSERT INTO `media_out` (`md_out_id`, `request_id`, `emp_id`, `md_out_date`, `status`, `desc`, `created_at`, `updated_at`) VALUES
('mo_0000001', 'req_000001', 'pd_0000002', '2024-02-27', 2, 'เกิดข้อผิดพลาด', '2024-02-26 17:00:00', '2024-02-26 17:00:00'),
('mo_0000002', 'req_000001', 'pd_0000002', '2024-02-27', 2, 'ยกเลิก', '2024-02-26 17:00:00', '2024-02-26 17:00:00'),
('mo_0000003', 'req_000001', 'pd_0000020', '2024-02-27', 1, NULL, '2024-02-26 17:00:00', '2024-02-26 17:00:00');

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
(144, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(145, '2023_11_13_111927_create_emps_table', 1),
(146, '2023_11_14_085539_create_type_books_table', 1),
(147, '2023_11_14_122435_create_type_media_table', 1),
(148, '2023_11_15_035858_create_books_table', 1),
(149, '2023_11_15_070959_create_copy_books_table', 1),
(150, '2023_11_21_065839_create_media_table', 1),
(151, '2023_11_22_075901_create_copy_book_outs_table', 1),
(152, '2023_11_26_134906_create_receive_books_table', 1),
(153, '2023_12_05_024026_create_receive_book_descs_table', 1),
(154, '2023_12_05_035707_add_receive_books_table', 1),
(155, '2023_12_05_062304_create_request_users_table', 1),
(156, '2023_12_05_074802_create_request_media_table', 1),
(157, '2023_12_12_061452_create_order_media_table', 1),
(158, '2024_01_11_071910_add_name_number_media', 1),
(159, '2024_01_16_025641_add_field_table_book', 1),
(160, '2024_01_28_085942_remove_number_media_type_books_table', 1),
(161, '2024_01_28_090840_add_head_number_meaid_type_media_table', 1),
(162, '2024_01_28_132307_add_file_desc_media', 1),
(163, '2024_01_28_135359_add_file_type_select_media', 1),
(164, '2024_02_03_092612_add_time_on_table_media', 1),
(165, '2024_02_04_082227_add_field_table_request_media', 1),
(166, '2024_02_04_100417_create_media_outs_table', 1),
(167, '2024_02_06_065916_add_cancel_desc_on_table_requset_medai', 1),
(169, '2024_02_27_035946_remove_file_location', 2);

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
('or_0000001', 'pd_0000001', 'req_000004', '2024-02-27', NULL, 2, '2024-02-26 17:00:00', '2024-02-26 17:00:00'),
('or_0000002', 'pd_0000020', 'req_000003', '2024-02-27', '2024-02-27', 3, '2024-02-26 17:00:00', '2024-02-26 17:00:00'),
('or_0000003', 'pd_0000002', 'req_000006', '2024-02-27', NULL, 1, '2024-02-26 17:00:00', '2024-02-26 17:00:00');

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
('recv_00001', 'pd_0000020', 'ปรัชญา 101 (PHILOSOPHY 101)', '2024-02-27', 1, '2024-02-26 17:00:00', '2024-02-26 17:00:00');

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
('recv_00002', 'recv_00001', 'bk_0000001', 'sds', '2024-02-26 17:00:00', '2024-02-26 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `request_media`
--

CREATE TABLE `request_media` (
  `request_id` varchar(10) NOT NULL,
  `emp_id` varchar(10) DEFAULT NULL,
  `type_media_id` varchar(10) NOT NULL,
  `requesters_id` varchar(10) NOT NULL,
  `book_id` varchar(10) NOT NULL,
  `request_date` date NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL,
  `media_out_date` date DEFAULT NULL,
  `desc` text DEFAULT NULL,
  `cancel_desc` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `request_media`
--

INSERT INTO `request_media` (`request_id`, `emp_id`, `type_media_id`, `requesters_id`, `book_id`, `request_date`, `status`, `media_out_date`, `desc`, `cancel_desc`, `created_at`, `updated_at`) VALUES
('req_000001', 'pd_0000020', 'tm_0000001', 'user_00001', 'bk_0000001', '2024-02-27', 4, '2024-02-27', 'asfasf', NULL, '2024-02-26 17:00:00', '2024-02-26 17:00:00'),
('req_000003', NULL, 'tm_0000001', 'user_00001', 'bk_0000002', '2024-02-27', 2, NULL, 'safasf', NULL, '2024-02-26 17:00:00', '2024-02-26 17:00:00'),
('req_000004', NULL, 'tm_0000002', 'user_00001', 'bk_0000001', '2024-02-27', 3, NULL, 'ส่งมา line', NULL, '2024-02-26 17:00:00', '2024-02-26 17:00:00'),
('req_000005', NULL, 'tm_0000001', 'user_00002', 'bk_0000001', '2024-02-27', 5, NULL, 'เบอร์ 0883004952', 'ไม่สามารถติดต่อได้', '2024-02-26 17:00:00', '2024-02-26 17:00:00'),
('req_000006', NULL, 'tm_0000001', 'user_00002', 'bk_0000004', '2024-02-27', 3, NULL, 'ฟหดฟหด', NULL, '2024-02-26 17:00:00', '2024-02-26 17:00:00'),
('req_000007', NULL, 'tm_0000001', 'user_00003', 'bk_0000004', '2024-02-28', 5, NULL, 'ฟหด', 'เทสยกเลิก', '2024-02-27 17:00:00', '2024-02-27 17:00:00');

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
('user_00001', 'นายพิชิตชัย', 'ธรรมชัย', NULL, NULL, NULL, NULL, '0883004952', '2024-02-26 17:00:00', '2024-02-26 17:00:00'),
('user_00002', 'นายกขคง', 'คนดี', NULL, NULL, NULL, NULL, '0883004952', '2024-02-26 17:00:00', '2024-02-26 17:00:00'),
('user_00003', 'นางสาวกัลยรัตน์', 'ดีดีดี', NULL, NULL, NULL, NULL, '0895487223', '2024-02-27 17:00:00', '2024-02-27 17:00:00');

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
('tb_0000001', 'สังคมศาสตร์', '2024-02-26 17:00:00', '2024-02-26 17:00:00'),
('tb_0000002', 'ศิลปะและนันทนาการ', '2024-02-26 17:00:00', '2024-02-26 17:00:00'),
('tb_0000010', 'วิทยาศาสตร์', '2024-02-26 17:00:00', '2024-02-26 17:00:00'),
('tb_0000011', 'วรรณคดี', '2024-02-26 17:00:00', '2024-02-26 17:00:00'),
('tb_0000012', 'ประวัติศาสตร์', '2024-02-26 17:00:00', '2024-02-26 17:00:00'),
('tb_0000013', 'หนังสือนวนิยาย', '2024-02-26 17:00:00', '2024-02-26 17:00:00'),
('tb_0000014', 'เทคโนโลยี', '2024-02-26 17:00:00', '2024-02-26 17:00:00'),
('tb_0000015', 'ชีวประวัติ', '2024-02-26 17:00:00', '2024-02-26 17:00:00'),
('tb_0000016', 'ภาษาศาสตร์', '2024-02-26 17:00:00', '2024-02-26 17:00:00'),
('tb_0000017', 'เบ็ตเตล็ดหรือความรู้ทั่วไป', '2024-02-26 17:00:00', '2024-02-26 17:00:00'),
('tb_0000018', 'ปรัชญา', '2024-02-26 17:00:00', '2024-02-26 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `type_media`
--

CREATE TABLE `type_media` (
  `type_media_id` varchar(10) NOT NULL,
  `head_number_media` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_media`
--

INSERT INTO `type_media` (`type_media_id`, `head_number_media`, `name`, `desc`, `created_at`, `updated_at`) VALUES
('tm_0000001', 'BTC', 'หนังสือเรียนอักษรเบรลล์', 'หนังสือเรียนอักษรเบรลล์', '2024-02-26 17:00:00', '2024-02-26 17:00:00'),
('tm_0000002', 'BSC', 'หนังสืออ่านเสริมอักษรเบรลล์', 'หนังสืออ่านเสริมอักษรเบรลล์', '2024-02-26 17:00:00', '2024-02-26 17:00:00'),
('tm_0000003', 'Daisy', 'หนังสือเสียง', 'หนังสือเสียง', '2024-02-26 17:00:00', '2024-02-26 17:00:00');

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
-- Indexes for table `media_out`
--
ALTER TABLE `media_out`
  ADD PRIMARY KEY (`md_out_id`),
  ADD KEY `media_out_request_id_foreign` (`request_id`),
  ADD KEY `media_out_emp_id_foreign` (`emp_id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

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
-- Constraints for table `media_out`
--
ALTER TABLE `media_out`
  ADD CONSTRAINT `media_out_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `emps` (`emp_id`),
  ADD CONSTRAINT `media_out_request_id_foreign` FOREIGN KEY (`request_id`) REFERENCES `request_media` (`request_id`);

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
