-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2022 at 02:53 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aplikasi_penjualan`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Sweeter Rajut', 'active', '2022-10-25 21:01:52', '2022-10-26 01:00:04'),
(3, 'Jaket Hoodie', 'active', '2022-10-25 21:47:39', '2022-10-26 01:15:23'),
(6, 'loram', 'active', '2022-10-25 23:29:49', '2022-10-25 23:29:49'),
(7, 'Pakaian', 'active', '2022-10-26 01:50:25', '2022-10-26 01:50:25');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_10_25_084725_create_categories_table', 1),
(6, '2022_10_27_022618_create_products_table', 2),
(7, '2022_10_28_064425_create_transactions_table', 3);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` bigint(20) NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `sku`, `image`, `status`, `created_at`, `updated_at`) VALUES
(2, 3, 'Extraordinary', 'Jaket Extraordinary', 250000, '202839392', 'products/6HAyxXweygvC0e8bHeek6CbUYbSJRLc4ZaYF6PL1.png', 'active', '2022-10-26 21:51:32', '2022-10-27 20:10:47'),
(4, 2, 'Sweeter Polos', 'Sweeter Polos Rajut', 175000, '67266839', 'products/RPOALqmK0WebxZXUdBiF1WFSOVZyypBrPc2w8gFs.jpg', 'active', '2022-10-26 21:54:11', '2022-10-26 21:54:11'),
(5, 2, 'Sweeter Long Neck', 'Sweeter Long Neck', 175000, '213123123', 'products/MZUunbOjLYeMwwH3vcjoT5tZ7R9esg2egLnNwe37.png', 'active', '2022-10-27 00:29:01', '2022-10-27 00:29:01'),
(6, 2, 'Pakaian Sweeter', 'Pakaian Sweeter', 100000, '2312312313', 'products/voUDSb4Gh3WHsYam9XoBvknVSbsVoHL3yIZqwwTb.jpg', 'active', '2022-10-27 00:29:44', '2022-10-27 00:29:44');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `trx_date` date NOT NULL,
  `price` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `product_id`, `trx_date`, `price`, `created_at`, `updated_at`) VALUES
(1, 2, '2022-01-12', 10000, '2022-10-28 00:59:39', '2022-10-28 00:59:39'),
(2, 2, '2022-01-13', 20000, '2022-10-28 00:59:39', '2022-10-28 00:59:39'),
(3, 4, '2022-03-14', 30000, '2022-10-28 00:59:39', '2022-10-28 00:59:39'),
(4, 5, '2022-03-15', 100000, '2022-10-28 00:59:39', '2022-10-28 00:59:39'),
(5, 6, '2022-05-16', 30000, '2022-10-28 00:59:39', '2022-10-28 00:59:39'),
(6, 5, '2022-05-17', 20000, '2022-10-28 00:59:39', '2022-10-28 00:59:39'),
(7, 5, '2022-05-18', 10000, '2022-10-28 00:59:39', '2022-10-28 00:59:39'),
(8, 6, '2022-07-19', 30000, '2022-10-28 00:59:39', '2022-10-28 00:59:39'),
(9, 4, '2022-07-20', 20000, '2022-10-28 00:59:39', '2022-10-28 00:59:39'),
(10, 6, '2022-08-21', 20000, '2022-10-28 00:59:39', '2022-10-28 00:59:39'),
(11, 4, '2022-08-22', 20000, '2022-10-28 00:59:39', '2022-10-28 00:59:39'),
(12, 6, '2022-08-23', 20000, '2022-10-28 00:59:39', '2022-10-28 00:59:39'),
(13, 2, '2022-08-24', 30000, '2022-10-28 00:59:39', '2022-10-28 00:59:39'),
(14, 5, '2022-09-25', 30000, '2022-10-28 00:59:39', '2022-10-28 00:59:39'),
(15, 4, '2022-09-26', 30000, '2022-10-28 00:59:39', '2022-10-28 00:59:39'),
(16, 5, '2022-09-27', 30000, '2022-10-28 00:59:39', '2022-10-28 00:59:39'),
(17, 4, '2022-09-28', 10000, '2022-10-28 00:59:39', '2022-10-28 00:59:39'),
(18, 4, '2022-09-29', 10000, '2022-10-28 00:59:39', '2022-10-28 00:59:39'),
(19, 2, '2022-01-12', 10000, '2022-10-28 03:22:09', '2022-10-28 03:22:09'),
(20, 2, '2022-01-13', 20000, '2022-10-28 03:22:09', '2022-10-28 03:22:09'),
(21, 4, '2022-03-14', 30000, '2022-10-28 03:22:09', '2022-10-28 03:22:09'),
(22, 5, '2022-03-15', 100000, '2022-10-28 03:22:09', '2022-10-28 03:22:09'),
(23, 6, '2022-05-16', 30000, '2022-10-28 03:22:09', '2022-10-28 03:22:09'),
(24, 5, '2022-05-17', 20000, '2022-10-28 03:22:09', '2022-10-28 03:22:09'),
(25, 5, '2022-05-18', 10000, '2022-10-28 03:22:09', '2022-10-28 03:22:09'),
(26, 6, '2022-07-19', 30000, '2022-10-28 03:22:09', '2022-10-28 03:22:09'),
(27, 4, '2022-07-20', 20000, '2022-10-28 03:22:09', '2022-10-28 03:22:09'),
(28, 6, '2022-08-21', 20000, '2022-10-28 03:22:09', '2022-10-28 03:22:09'),
(29, 4, '2022-08-22', 20000, '2022-10-28 03:22:09', '2022-10-28 03:22:09'),
(30, 6, '2022-08-23', 20000, '2022-10-28 03:22:09', '2022-10-28 03:22:09'),
(31, 2, '2022-08-24', 30000, '2022-10-28 03:22:09', '2022-10-28 03:22:09'),
(32, 5, '2022-09-25', 30000, '2022-10-28 03:22:09', '2022-10-28 03:22:09'),
(33, 4, '2022-09-26', 30000, '2022-10-28 03:22:09', '2022-10-28 03:22:09'),
(34, 5, '2022-09-27', 30000, '2022-10-28 03:22:09', '2022-10-28 03:22:09'),
(35, 4, '2022-09-28', 10000, '2022-10-28 03:22:09', '2022-10-28 03:22:09'),
(36, 4, '2022-09-29', 10000, '2022-10-28 03:22:09', '2022-10-28 03:22:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_product_id_foreign` (`product_id`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
