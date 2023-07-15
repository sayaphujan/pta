-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2023 at 05:32 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pta`
--

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `bank_id` int(10) UNSIGNED NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_num` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_own` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`bank_id`, `bank_name`, `bank_num`, `bank_own`, `created_at`, `updated_at`) VALUES
(1, 'BCA', '0989878998787', 'Pdam Kabupaten Kendal', '2022-10-26 06:05:03', '2022-10-26 06:05:03'),
(2, 'Mandiri', '076543212123', 'Pdam Kabupaten Kendal', '2022-10-26 06:06:28', '2022-10-26 06:06:28'),
(3, 'Syariah', '09999977656', 'Pdam Kabupaten Kendal', '2022-10-26 06:07:35', '2022-10-26 06:07:35');

-- --------------------------------------------------------

--
-- Table structure for table `locs`
--

CREATE TABLE `locs` (
  `loc_id` int(10) UNSIGNED NOT NULL,
  `loc_address1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loc_address2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loc_lng` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loc_lat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loc_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locs`
--

INSERT INTO `locs` (`loc_id`, `loc_address1`, `loc_address2`, `loc_lng`, `loc_lat`, `loc_img`, `created_at`, `updated_at`) VALUES
(1, 'desa Purin', 'depan alfamrt purin rumah warna biru', '0', '0', NULL, '2023-01-11 00:42:50', '2023-01-11 00:42:50'),
(2, 'desa Purin', 'depan alfamrt purin rumah warna biru', '0', '0', NULL, '2023-01-11 00:44:20', '2023-01-11 00:44:20'),
(3, 'purin', 'oke', '110.19972584716253', '-6.92244685802534', NULL, '2023-01-11 00:45:24', '2023-01-11 00:45:24'),
(4, 'Jetis', 'oke', '0', '0', NULL, '2023-01-11 00:46:21', '2023-01-11 00:46:21'),
(5, 'desa jetis', 'warna hijau rumahnya', '110.19099525681905', '-6.922770370648384', NULL, '2023-01-11 00:48:54', '2023-01-11 00:48:54'),
(6, 'jetis', 'ioke', '110.19977680913381', '-6.922312393865728', NULL, '2023-01-11 04:48:39', '2023-01-11 04:48:39'),
(7, 'pke', 'oke', '110.20070887676648', '-6.922122013851476', NULL, '2023-01-11 06:31:49', '2023-01-11 06:31:49'),
(8, 'semarang', 'grg', '0', '0', NULL, '2023-01-11 07:36:30', '2023-01-11 07:36:30'),
(9, 'purin', 'dwdw', '0', '0', NULL, '2023-01-11 07:40:14', '2023-01-11 07:40:14'),
(10, 'purin', 'dwdw', '0', '0', NULL, '2023-01-11 07:40:14', '2023-01-11 07:40:14'),
(11, 'purin', 'oke', '110.19957564345769', '-6.922215206875039', NULL, '2023-01-11 07:42:33', '2023-01-11 07:42:33'),
(12, 'Cepiring', 'oke', '110.19287414423398', '-6.92141973726058', NULL, '2023-01-11 11:03:05', '2023-01-11 11:03:05'),
(13, 'Cepiring', 'oke', '110.17117909661702', '-6.925816437473411', NULL, '2023-01-11 14:03:35', '2023-01-11 14:03:35'),
(14, 'Desa Jetis', 'Didepan Toko warna hijau', '110.18443993798665', '-6.923899334772349', NULL, '2023-01-11 18:26:33', '2023-01-11 18:26:33'),
(15, 'Weleri', 'depan rumah makan mewah no 23', '110.06200648418836', '-6.971334682338003', NULL, '2023-01-17 13:47:27', '2023-01-17 13:47:27'),
(16, 'jetis', 'kke', '110.19893459550313', '-6.922067429357689', NULL, '2023-01-19 07:56:47', '2023-01-19 07:56:47'),
(17, 'Purin', 'ghj', '0', '0', NULL, '2023-01-19 08:48:23', '2023-01-19 08:48:23'),
(18, 'fadada', 'adass', '0', '0', NULL, '2023-03-27 06:16:53', '2023-03-27 06:16:53'),
(19, 'pemanikan, no26', 'sdasd', '0', '0', NULL, '2023-04-05 00:51:23', '2023-04-05 00:51:23'),
(20, 'kkjljj', 'addas', '0', '0', NULL, '2023-04-05 00:59:28', '2023-04-05 00:59:28'),
(21, 'ini alamat 1', 'ini alamat 2', '0', '0', NULL, '2023-04-05 21:57:24', '2023-04-05 21:57:24'),
(22, 'dfdsf', 'dfsfsdf', '0', '0', NULL, '2023-04-05 22:04:40', '2023-04-05 22:04:40'),
(23, 'dadds', 'ads', '0', '0', NULL, '2023-04-06 01:42:37', '2023-04-06 01:42:37'),
(24, 'dad', 'dasd', '0', '0', NULL, '2023-04-06 04:00:22', '2023-04-06 04:00:22'),
(32, 'pemanikan', 'dadasddasd', '110.19983913749456', '-6.925396406659554', NULL, '2023-04-06 16:01:32', '2023-04-06 16:01:32'),
(33, 'pemanikan', 'dadasddasd', '110.19983913749456', '-6.925396406659554', NULL, '2023-04-06 16:02:06', '2023-04-06 16:02:06'),
(34, 'pemanikan', 'dadasddasd', '110.19983913749456', '-6.925396406659554', NULL, '2023-04-06 16:02:58', '2023-04-06 16:02:58'),
(35, 'pemanikan', 'dadasddasd', '110.19983913749456', '-6.925396406659554', NULL, '2023-04-06 16:03:11', '2023-04-06 16:03:11'),
(36, 'pemanikan', 'dadasddasd', '110.19983913749456', '-6.925396406659554', NULL, '2023-04-06 16:03:42', '2023-04-06 16:03:42'),
(37, 'ad', 'adas', '0', '0', NULL, '2023-04-06 09:17:04', '2023-04-06 09:17:04'),
(38, 'adasd', 'asdas', '0', '0', NULL, '2023-04-06 09:28:38', '2023-04-06 09:28:38'),
(39, 'asdad', 'adasad', '110.19782278686762', '-6.927622700941659', NULL, '2023-04-06 16:33:27', '2023-04-06 16:33:27'),
(40, 'asdad', 'adasad', '110.19782278686762', '-6.927622700941659', NULL, '2023-04-06 16:34:41', '2023-04-06 16:34:41'),
(41, 'Pemanikan no2', 'dsada', '110.20098578184843', '-6.9180557850146425', NULL, '2023-04-06 18:25:51', '2023-04-06 18:25:51'),
(42, 'sdads', 'asdsada', '110.1995025202632', '-6.915876375575996', NULL, '2023-04-06 18:31:08', '2023-04-06 18:31:08'),
(43, 'ADASDD', 'ADASDS', '110.20224910229445', '-6.92607671058699', NULL, '2023-04-06 19:14:57', '2023-04-06 19:14:57'),
(44, 'JHKJJ', 'KJKJ', '110.19828848540784', '-6.921742918151363', NULL, '2023-04-06 19:24:11', '2023-04-06 19:24:11'),
(45, 'adadasd', 'addsd', '110.19942842423916', '-6.926709086156205', NULL, '2023-04-06 19:32:12', '2023-04-06 19:32:12'),
(46, 'sdad', 'add', '110.19973520189522', '-6.925954894985208', NULL, '2023-04-06 19:33:32', '2023-04-06 19:33:32'),
(47, 'asdasd', 'daad', '110.19936438649893', '-6.9270262721092495', NULL, '2023-04-06 19:34:27', '2023-04-06 19:34:27'),
(48, 'sadadd', 'dadasd', '110.19887689501046', '-6.927146423290737', NULL, '2023-04-06 19:35:06', '2023-04-06 19:35:06'),
(49, 'kjjjk', 'kkjk', '110.19958801567554', '-6.921268631561729', NULL, '2023-04-06 19:43:11', '2023-04-06 19:43:11'),
(50, 'adad', 'ddasda', '110.19814129918812', '-6.927476589260624', NULL, '2023-04-06 19:46:01', '2023-04-06 19:46:01'),
(51, 'dadsd', 'fsdfd', '110.19902843981981', '-6.921640738554439', NULL, '2023-04-06 19:47:07', '2023-04-06 19:47:07'),
(52, 'sssdsada', 'dadd', '110.20188096910717', '-6.925370778752696', NULL, '2023-04-06 20:30:57', '2023-04-06 20:30:57'),
(53, 'ljj', 'kkj', '110.20052041858435', '-6.922254814300656', NULL, '2023-04-06 20:46:18', '2023-04-06 20:46:18'),
(54, 'kkj', 'nnm', '110.19996855407953', '-6.921877049640781', NULL, '2023-04-06 20:47:32', '2023-04-06 20:47:32'),
(55, 'dsadsad', 'dadasd', '110.19814129918812', '-6.924384602526132', NULL, '2023-04-06 20:51:18', '2023-04-06 20:51:18'),
(56, 'know,n', 'llk', '110.20020123571159', '-6.921621767095897', NULL, '2023-04-06 20:57:27', '2023-04-06 20:57:27'),
(57, 'kj', 'ml', '110.2020650357008', '-6.926417860670444', NULL, '2023-04-06 21:02:58', '2023-04-06 21:02:58'),
(58, 'lkl', 'lklk', '110.20043425261974', '-6.926880825901229', NULL, '2023-04-06 21:07:13', '2023-04-06 21:07:13'),
(59, ';like;like;', 'lkl', '110.1995025202632', '-6.9279029423535325', NULL, '2023-04-06 21:09:28', '2023-04-06 21:09:28'),
(60, 'llk', ';;l', '110.20075310021639', '-6.928219461847654', NULL, '2023-04-06 21:17:12', '2023-04-06 21:17:12'),
(61, 'llk', 'm', '110.1995025202632', '-6.922059774610939', NULL, '2023-04-06 21:21:28', '2023-04-06 21:21:28'),
(62, 'lkl', 'llklk', '110.20407602190971', '-6.926125636516557', NULL, '2023-04-06 21:32:49', '2023-04-06 21:32:49'),
(63, 'jkj', 'lklkll', '110.20173378288747', '-6.927063216104598', NULL, '2023-04-06 21:40:02', '2023-04-06 21:40:02'),
(64, 'iui', 'llkl', '110.20248178392647', '-6.925334167454778', NULL, '2023-04-06 21:40:54', '2023-04-06 21:40:54'),
(65, 'dad', 'dsad', '110.20267825573683', '-6.922680173617423', NULL, '2023-04-07 03:26:32', '2023-04-07 03:26:32'),
(66, 'klkll', ';;like;', '110.19903648644686', '-6.921524912795668', NULL, '2023-04-07 03:29:49', '2023-04-07 03:29:49'),
(67, 'kjj', 'llk', '110.19566494971514', '-6.924080395201199', NULL, '2023-04-07 03:30:42', '2023-04-07 03:30:42'),
(68, 'ddfds', 'dasd', '110.20080205053092', '-6.9252243335439525', NULL, '2023-04-07 03:33:27', '2023-04-07 03:33:27'),
(69, 'dasd', 'das', '110.19860733300447', '-6.915097537143401', NULL, '2023-04-07 03:36:11', '2023-04-07 03:36:11'),
(70, 'asda', 'adas', '110.20085133612156', '-6.926625213234744', NULL, '2023-04-07 04:01:35', '2023-04-07 04:01:35'),
(71, 'adas', 'ddfsfsdf', '110.20603738725184', '-6.928596222945378', NULL, '2023-04-07 04:15:46', '2023-04-07 04:15:46'),
(72, 'cdada', 'adad', '110.19832570105791', '-6.918894861623668', NULL, '2023-04-07 04:16:36', '2023-04-07 04:16:36'),
(73, 'asdsada', 'dad', '110.202911272645', '-6.925029295081726', NULL, '2023-04-07 09:25:21', '2023-04-07 09:25:21'),
(74, 'ddad', 'ddsf', '110.1979086175561', '-6.923520573331331', NULL, '2023-04-07 10:49:53', '2023-04-07 10:49:53'),
(75, 'aada', 'adadasd', '110.19842360168695', '-6.9155841448958135', NULL, '2023-04-07 14:42:52', '2023-04-07 14:42:52'),
(76, 'asdad', 'dasd', '110.19977241754532', '-6.9215362291066835', NULL, '2023-04-07 15:03:46', '2023-04-07 15:03:46'),
(77, 'dasd', 'ada', '110.20407568663357', '-6.923313885065239', NULL, '2023-04-07 15:32:32', '2023-04-07 15:32:32'),
(78, 'adsda', 'sdsa', '0', '0', NULL, '2023-04-08 00:20:00', '2023-04-08 00:20:00'),
(79, 'xSa', 'das', '0', '0', NULL, '2023-04-08 00:21:03', '2023-04-08 00:21:03'),
(80, 'dekta pasar', 'camping rumah putih', '110.19980795681477', '-6.916571338016304', NULL, '2023-04-11 10:05:31', '2023-04-11 10:05:31'),
(81, 'dasd,', 'adasd', '110.20369581878185', '-6.925638041141434', NULL, '2023-04-11 10:28:16', '2023-04-11 10:28:16'),
(82, 'jetisoke', 'oke', '110.19630063325167', '-6.9212543197484635', NULL, '2023-05-27 13:06:11', '2023-05-27 13:06:11'),
(83, 'jl.irian no 5 Sapuro - kebulen', 'depan SD sapuro 05', '109.67267744243145', '-6.898097570960706', NULL, '2023-06-26 14:17:09', '2023-06-26 14:17:09'),
(84, 'jalan irian no 53 sapuro', 'depan SD sapuro', '109.66487322002648', '-6.882974993189695', NULL, '2023-06-27 02:47:27', '2023-06-27 02:47:27'),
(85, 'kebulen', 'depan kantor kelurahan', '109.66240458190441', '-6.888005143682147', NULL, '2023-07-09 09:41:28', '2023-07-09 09:41:28'),
(86, 'kebulen', 'kwkwk', '109.66348350048065', '-6.883599437745758', NULL, '2023-07-09 09:59:04', '2023-07-09 09:59:04'),
(87, 'kebulen', 'depan sd', '109.66330345720053', '-6.894221859326172', NULL, '2023-07-09 10:03:38', '2023-07-09 10:03:38'),
(88, 'kebulen', 'depan sd', '109.67113450169563', '-6.894628604169576', NULL, '2023-07-09 10:06:34', '2023-07-09 10:06:34'),
(89, 'medono', 'depan smp 13', '109.66349456459284', '-6.889795574133764', NULL, '2023-07-11 13:39:06', '2023-07-11 13:39:06'),
(90, 'medono', 'depan smp 13', '109.6660989895463', '-6.8922427178148205', NULL, '2023-07-11 13:53:08', '2023-07-11 13:53:08'),
(91, 'medono', 'depan smp 13', '109.66946683824064', '-6.893330148255516', NULL, '2023-07-11 13:56:33', '2023-07-11 13:56:33'),
(92, 'medono', 'depan smp 13', '109.66708034276964', '-6.893833088151167', NULL, '2023-07-11 14:03:24', '2023-07-11 14:03:24'),
(93, 'kraton', 'dekat stadiun', '109.66703105717896', '-6.886448705249228', NULL, '2023-07-12 01:31:23', '2023-07-12 01:31:23'),
(94, 'kraton', 'depan stadiun', '109.66608289629221', '-6.8814484957363335', NULL, '2023-07-12 02:25:23', '2023-07-12 02:25:23');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_04_30_133042_create_users_table', 1),
(3, '2021_04_30_133042_create_locs_table', 2),
(4, '2021_04_30_133042_create_prices_table', 2),
(6, '2021_04_30_133042_create_trans_table', 3),
(7, '2021_04_30_133042_create_banks_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `price_id` int(10) UNSIGNED NOT NULL,
  `price_volume` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_net` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`price_id`, `price_volume`, `price_net`, `created_at`, `updated_at`) VALUES
(1, '5000', '200000', '2022-10-29 23:12:35', '2022-10-29 23:12:35'),
(2, '8000', '350000', '2022-10-29 23:12:47', '2022-10-29 23:12:47');

-- --------------------------------------------------------

--
-- Table structure for table `trans`
--

CREATE TABLE `trans` (
  `trans_id` int(10) UNSIGNED NOT NULL,
  `trans_category` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trans_destination` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trans_phone` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trans_note` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_net` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_volume` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_deliv` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_sum` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trans_delivery` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `trans_sent` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loc_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trans`
--

INSERT INTO `trans` (`trans_id`, `trans_category`, `trans_destination`, `trans_phone`, `trans_note`, `price_net`, `price_volume`, `price_deliv`, `price_sum`, `payment`, `payment_status`, `payment_photo`, `trans_delivery`, `trans_sent`, `user_id`, `driver_id`, `price_id`, `loc_id`, `order_id`, `created_at`, `updated_at`) VALUES
(90, 'Niaga', 'Dalam Kota', '087315151313', 'oke', '200000', '5000', '0', '200000', '1', '1', 'download2.jpeg', '1', '1', '68', '42', '1', '90', '211456d5-d', '2023-07-11 13:53:08', '2023-07-11 13:55:29'),
(91, 'Niaga', 'Dalam Kota', '087315151313', 'oke', '200000', '5000', '0', '200000', 'Tunai', '1', NULL, '0', '0', '68', '42', '1', '91', '11e174b7-2', '2023-07-11 13:56:33', '2023-07-11 13:57:29'),
(92, 'Niaga', 'Dalam Kota', '087315151313', 'mantap', '200000', '5000', '0', '200000', 'Tunai', '1', NULL, '0', '0', '76', '42', '1', '92', '6e37808a-e', '2023-07-11 14:03:24', '2023-07-11 14:03:52'),
(93, 'Niaga', 'Dalam Kota', '0856315153153', 'oke', '200000', '5000', '0', '200000', 'Tunai', '0', NULL, '0', '0', '77', '0', '1', '93', '4c6383f7-6', '2023-07-12 01:31:23', '2023-07-12 01:31:23'),
(94, 'Pribadi Rumah Tangga', 'Dalam Kota', '08521561661', 'mohon cepat kirim', '200000', '5000', '0', '200000', '1', '1', 'download3.jpeg', '0', '0', '78', '42', '1', '94', '8afc0341-f', '2023-07-12 02:25:23', '2023-07-12 02:30:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `fullname` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plain_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'default.png',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `name`, `email`, `email_verified_at`, `password`, `plain_password`, `phone_number`, `address`, `level`, `photo`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'a@mail.com', NULL, '$2y$10$eBCD1/YNrQtLTIcnfzE6gOCIWG4OjEehC2xipXR9tmbAxP.yHAZ.S', 'admin', '098765', 'Kendal', '1', '202301111812admin.png', 'QghWsMEKmHQrPcWKrZ27Iq6yFZwXN7yJwry2MCiLb0mchtwcntPLo161gy9q', '2022-10-22 15:58:43', '2023-01-11 11:12:47'),
(10, 'Owner', 'owner', 'owner@mail.com', NULL, '$2y$10$dgopLmc.jezBOMoMEYZLIeanTO4UEpoH5xuaoxcouWmvntdyQn3b.', 'owner', '9898978987987', 'Kendal', '2', 'default.png', NULL, '2022-10-23 06:51:40', '2022-10-26 05:02:08'),
(11, 'User', 'user', 'user@mail.com', NULL, '$2y$10$lj5.zoCLbXNEhosBslePBuWdIU1D32sYMJaMI6NvV2gQBqqIqzDQa', 'user', '123456', 'Kendal', '3', '202301020314Koala.jpg', NULL, '2022-10-23 06:53:55', '2023-01-01 20:14:28'),
(23, 'Driver1', 'DRV001', 'driver@mail.com', NULL, '$2y$10$nTvic7ztbErKoas6CzqnmuQg9Ju.pcwBO1wYEB7lL1LT6EZqTQSBS', 'driver', '08888888888', 'Kendal', '4', '202301111437tokyo-revengers-manjuro-sano-7972.jpg', 'wP2SJNQnB6mcP5UySuJomryCZkFTgzLXYPJBHbefvB0HXSvZdilGs6WBJLYP', '2022-10-25 03:03:10', '2023-01-11 07:37:55'),
(24, 'Driver2', 'DRV002', 'driver@test.com', NULL, '$2y$10$7L0bZrTPe0YjHDGqWmFOsuQkAh3GgWvWqBLNCwg9p9D15kiHKDqHG', 'driver', '0812123456', 'Kendal', '4', '', NULL, '2022-10-25 03:03:52', '2022-10-25 05:46:51'),
(42, 'Rohman Mulyadi', 'DRV003', 'Mulyadi@gmail.com', NULL, '$2y$10$FtqASV.Q5HZZc.S71eJ9iOi7MZt6wqhzRkwLYWsTTB0NMax3GsLd2', '123', '086465661616', 'weleri', '4', '202301111827index.jpg', 'AI6NnZZyi3EQYieYP95VZ7FbakZwQMGBe3agR29HuKqeeqNd6Cf3REMkJdK9', '2023-01-11 01:03:51', '2023-01-11 11:27:46'),
(46, 'joe naufal', 'joe', NULL, NULL, '$2y$10$kBefsmbJvKXEYyV3ZimdLOW7ubGuFHm/J0M10P9WYjU5H4B4VMeum', '123', NULL, NULL, '3', NULL, NULL, '2023-01-11 18:23:20', '2023-01-11 18:23:20'),
(47, 'suwarno', 'suwarno', NULL, NULL, '$2y$10$fsokWOEwF7BJRDXeCVXCBuwqlvUG8WWt5V7YyHvNsD9Yz6Vwn8bKi', '123', NULL, NULL, '3', NULL, NULL, '2023-01-17 13:45:52', '2023-01-17 13:45:52'),
(48, 'ddadad', 'coba', NULL, NULL, '$2y$10$QHGZbWZRJ0LD8fwDlVanX.p4Cg7eRmuAh95vmN3sHTquqBxkk1E/6', '12345678', NULL, NULL, '3', NULL, NULL, '2023-03-27 06:15:48', '2023-03-27 06:15:48'),
(49, 'kevin toding', 'gilto', NULL, NULL, '$2y$10$PH/hGYH.YxgUDigg0XYIF.V8HnWFrhE6qaPfmGsAjdKsKGIcBuH2m', '12345678', NULL, NULL, '3', NULL, NULL, '2023-04-05 00:50:46', '2023-04-05 00:50:46'),
(53, 'vanesia2', 'testusername', 'dasds@gmail.com', NULL, '$2y$10$oU5vH.drd6ZB/76Mk3bh/uQemxBIpTnOc76T8LVHQWhM82cD.2gRW', '123456789', '09999', 'dadsad', '3', NULL, NULL, NULL, '2023-04-09 19:27:25'),
(54, 'bayu', 'bayu', 'bayu@gmail.com', NULL, '$2y$10$cacV95pPyp6i7N4a3UY0kOEyx/WDJ7d/3qhrTfvIUbPsj2ld6SG8W', '', NULL, NULL, '3', NULL, NULL, NULL, NULL),
(56, 'alvina Rizqi', 'alvina3', 'alvina@gmail.com', NULL, '$2y$10$WaOQEabk85An4DEXJ.7/TeerVONulNTeriWjcsK37kIUB1ow/oXmi', '12345678', '78787', '', '1', NULL, NULL, NULL, '2023-04-10 05:22:47'),
(57, 'chels chika', 'chika', 'chika@gmail.com', NULL, '$2y$10$TUTj7PMM77igw.XJTf9BxupSN/u7L5l8UWaeL7ECcdz6NKEBd6otG', '12345678', '0899999', 'jl. pahlawann', '3', 'images.jpeg', NULL, NULL, '2023-04-07 14:33:19'),
(67, 'tasya', 'tasya', 'tasya@gmail.com', NULL, '$2y$10$HqxrKdtMOqWzpB5xnjrTFO5OotWcxErQdIhVkKJC/f6ONA73k6MPO', '12345', NULL, NULL, '3', 'default.png', NULL, '2023-05-27 07:30:40', '2023-05-27 07:30:40'),
(68, 'aji', 'aji', 'aji@gmail.com', NULL, '$2y$10$5PE4bUWrxX8s4FV/xYF.aOq.7IDAAs/XQ63AdLQ7oG7sPZzelON32', '123', NULL, NULL, '3', 'default.png', NULL, '2023-05-27 08:05:26', '2023-05-27 08:05:26'),
(69, 'Katon pratomo', 'Katon ', 'katon@gmail.com', NULL, '$2y$10$T5.320x1nJlwKOqXC2nntOmr//c/iLD5sA3FbzdLsBV/obW8gSD8C', '123', NULL, NULL, '3', 'default.png', NULL, '2023-06-25 11:37:28', '2023-06-25 11:37:28'),
(70, 'aku', 'aku', 'aku@gmail.com', NULL, '$2y$10$VA11wqXmPsc4MS2egBkCTO6snmzHvw9fK7h4vnsW3gnnRM/mHsJne', '123', NULL, NULL, '3', 'default.png', NULL, '2023-06-26 09:07:55', '2023-06-26 09:07:55'),
(73, 'subagio', 'subagio', 'subagio@gmail.com', NULL, '$2y$10$LR1L5/OQOoSkzmmY.Sdg9ukPmnDqoK6JZWL6aoAZ7Pi39DTvUsID2', 'bagio123', NULL, NULL, '3', 'default.png', NULL, '2023-06-26 09:14:01', '2023-06-26 09:14:01'),
(74, 'testpta', 'testipta', 'testipta@gmail.com', NULL, '$2y$10$DFZ6qwyjvGCEbJWgo71sNOu.9HsZt/5W19N8gNdcN78mCN9.PdZLS', '123', NULL, NULL, '3', 'default.png', NULL, '2023-06-26 21:37:23', '2023-06-26 21:37:23'),
(75, 'iqbal', 'iqbal', 'iqbal@gmail.com', NULL, '$2y$10$EYG3m1V3DCDM7tPItBxm9up.WQmfBAmyvTivh.8fimi2ViTw08mnW', '123', NULL, NULL, '3', 'default.png', NULL, '2023-07-09 04:38:20', '2023-07-09 04:38:20'),
(76, 'halo', 'halo', 'halo@gmail.com', NULL, '$2y$10$auplwTQ3aWV9btJIbBb.nOtnEBZ1BrcaOLLNLSVbLkoSKhWOq7JAy', '123', NULL, NULL, '3', 'default.png', NULL, '2023-07-11 08:33:08', '2023-07-11 08:33:08'),
(77, 'cobaah', 'cobaah', 'coba@gmail.com', NULL, '$2y$10$ZdeNRn7WZXOE0sIxsIQIee7PQiwnWmbWh0KUSfsTUVUZ76lWyLHbi', '123', NULL, NULL, '3', 'default.png', NULL, '2023-07-11 20:30:20', '2023-07-11 20:30:20'),
(78, 'ayu', 'ayu', 'ayu@gmail.com', NULL, '$2y$10$z5uGRnpDZK71.yMGkfAlfu123g6n7Sr55KJYRwyKYWwFT0k2bVw4y', '123', NULL, NULL, '3', 'default.png', NULL, '2023-07-11 21:11:44', '2023-07-11 21:11:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `locs`
--
ALTER TABLE `locs`
  ADD PRIMARY KEY (`loc_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`price_id`);

--
-- Indexes for table `trans`
--
ALTER TABLE `trans`
  ADD PRIMARY KEY (`trans_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_name_unique` (`name`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `bank_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `locs`
--
ALTER TABLE `locs`
  MODIFY `loc_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `price_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `trans`
--
ALTER TABLE `trans`
  MODIFY `trans_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
