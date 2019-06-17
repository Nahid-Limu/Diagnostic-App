-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2019 at 04:21 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `diagnosticapp`
--

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
(1, '2018_11_19_175841_create_tests_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` int(10) UNSIGNED NOT NULL,
  `test_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `test_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `test_price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `test_name`, `test_code`, `test_price`, `created_at`, `updated_at`) VALUES
(1, 'nahid', '', 0, '2018-12-11 12:35:22', '2018-12-11 12:35:22'),
(2, 'limu', '', 0, '2018-12-11 12:35:35', '2018-12-11 12:35:35'),
(3, 'nishat', '', 0, '2018-12-11 12:35:51', '2018-12-11 12:35:51'),
(4, 'sany', '', 0, '2018-12-11 12:36:40', '2018-12-11 12:36:40'),
(5, 'tuhin', '', 0, '2018-12-11 12:36:48', '2018-12-11 12:36:48'),
(6, 'jarin', '', 0, '2018-12-11 12:36:56', '2018-12-11 12:36:56'),
(7, 'teach hunter', '', 0, '2018-12-11 12:37:27', '2018-12-11 12:37:27'),
(8, 'jillur', '', 900, '2018-12-11 12:38:01', '2018-12-11 12:38:01'),
(9, 'alu', '', 0, '2018-12-11 12:41:45', '2018-12-11 12:41:45'),
(10, 'lubna', '', 0, '2018-12-12 10:55:57', '2018-12-12 10:55:57'),
(11, 'ridi', '', 0, '2018-12-17 21:30:32', '2018-12-17 21:30:32'),
(12, 'amir', '', 0, '2018-12-19 07:25:06', '2018-12-19 07:25:06'),
(13, 'something', '', 0, '2018-12-19 07:35:01', '2018-12-19 07:35:01'),
(14, 'xxx', '101', 200, '2018-12-20 08:42:19', '2018-12-20 08:42:19'),
(17, 'blood group ', 'b112', 80, NULL, NULL),
(18, 'ecg', 'e101', 500, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'nishat', 'nishat@gmail.com', NULL, '$2y$10$hmlraSHrtahyO5yZMsC0pu/7V3RUDtGvzZExDp10Fpf0I/TK3udgG', 'UMyBphzTd1gqJekzLFeKctDCkEuXwSegST2irJdLn8tdgsatUGf8STbwXZiw', '2018-11-18 03:04:20', '2018-11-18 03:04:20'),
(2, 'aaasas', 'msnbcjdbadk', NULL, '', NULL, NULL, NULL),
(3, 'babababba', 'avsdcbjans', NULL, '', NULL, NULL, NULL),
(4, 'aaasas', 'msnbcjdbadk', NULL, '', NULL, NULL, NULL),
(5, 'babababba', 'avsdcbjans', NULL, '', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
