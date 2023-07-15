-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2023 at 04:55 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

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
  `photo` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `name`, `email`, `email_verified_at`, `password`, `plain_password`, `phone_number`, `address`, `level`, `photo`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'a@mail.com', NULL, '$2y$10$eBCD1/YNrQtLTIcnfzE6gOCIWG4OjEehC2xipXR9tmbAxP.yHAZ.S', 'admin', '098765', 'Kendal', '1', '202301020319rabbit.png', NULL, '2022-10-22 15:58:43', '2023-01-01 20:19:59'),
(10, 'Owner', 'owner', 'owner@mail.com', NULL, '$2y$10$dgopLmc.jezBOMoMEYZLIeanTO4UEpoH5xuaoxcouWmvntdyQn3b.', 'owner', '9898978987987', 'Kendal', '2', '', NULL, '2022-10-23 06:51:40', '2022-10-26 05:02:08'),
(11, 'User', 'user', 'user@mail.com', NULL, '$2y$10$lj5.zoCLbXNEhosBslePBuWdIU1D32sYMJaMI6NvV2gQBqqIqzDQa', 'user', '123456', 'Kendal', '3', '202301020314Koala.jpg', NULL, '2022-10-23 06:53:55', '2023-01-01 20:14:28'),
(23, 'Driver1', 'DRV001', 'driver@mail.com', NULL, '$2y$10$nTvic7ztbErKoas6CzqnmuQg9Ju.pcwBO1wYEB7lL1LT6EZqTQSBS', 'driver', '08888888888', 'Kendal', '4', '202301031233LGGM.jpg', NULL, '2022-10-25 03:03:10', '2023-01-03 05:34:11'),
(24, 'Driver2', 'DRV002', 'driver@test.com', NULL, '$2y$10$7L0bZrTPe0YjHDGqWmFOsuQkAh3GgWvWqBLNCwg9p9D15kiHKDqHG', 'driver', '0812123456', 'Kendal', '4', '', NULL, '2022-10-25 03:03:52', '2022-10-25 05:46:51'),
(31, 'joko widowo', 'jokowi', 'zerochitato@gmail.com', NULL, '$2y$10$bUHXTU1y2ZPVNdJNmlOFBuBqiRJtG/6LuATyqvkUNXehuJMcpwReC', '12345', '08992334569', 'kendal', '3', '', NULL, '2022-12-19 19:36:32', '2022-12-19 19:36:32'),
(39, 'adminbaru', 'adminbaru', NULL, NULL, '$2y$10$bACbBkIOVqmL7BPVqPF4b.VTsVqgkIDHFyvnfRFKNIE5imlCaJXRG', '123', NULL, NULL, '3', NULL, NULL, '2023-01-09 03:09:59', '2023-01-09 03:09:59'),
(40, 'test', 'test', '', NULL, '$2y$10$LTPRFsBYmaD/cpyywvLfaeIJUM2vO1zaFA.AkfFkkUavi3kEJAxXG', 'test', '', '', '3', '', NULL, '2023-01-03 05:41:05', '2023-01-03 05:41:05');

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
  MODIFY `bank_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `locs`
--
ALTER TABLE `locs`
  MODIFY `loc_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `price_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trans`
--
ALTER TABLE `trans`
  MODIFY `trans_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
