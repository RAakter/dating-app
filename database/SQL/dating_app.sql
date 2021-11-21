-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2021 at 03:48 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dating_app`
--

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
(5, '2021_11_20_124746_create_mutuals_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `mutuals`
--

CREATE TABLE `mutuals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'type = like/dislike',
  `action_on` bigint(20) UNSIGNED NOT NULL,
  `action_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mutuals`
--

INSERT INTO `mutuals` (`id`, `type`, `action_on`, `action_by`, `created_at`, `updated_at`) VALUES
(13, 'like', 3, 13, '2021-11-20 17:22:32', '2021-11-20 17:22:32'),
(14, 'like', 1, 13, '2021-11-20 17:24:00', '2021-11-20 17:24:00'),
(15, 'like', 13, 1, '2021-11-20 17:24:26', '2021-11-20 17:24:26');

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

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 5, 'MyApp', '8111ce295c6f61a9f02d4944c6d511d6640a0cc83e73f53ea2115146d019bf6b', '[\"*\"]', NULL, '2021-11-21 02:19:46', '2021-11-21 02:19:46'),
(2, 'App\\Models\\User', 13, 'MyApp', '2e02e9786d4106bc1bb268555f8174bfd2c4bf13e6bd0dfa22cea7326c4d0383', '[\"*\"]', NULL, '2021-11-21 02:24:00', '2021-11-21 02:24:00'),
(3, 'App\\Models\\User', 14, 'MyApp', 'c61e95bcd1b2b8c52e2661874b7035e449b3dc34061fb79d5c98d172dd321392', '[\"*\"]', NULL, '2021-11-21 02:30:59', '2021-11-21 02:30:59'),
(4, 'App\\Models\\User', 14, 'MyApp', 'bf8e620119d1ac74aac94bb71a0c15cd84229ff6b626b87f6f0bb8c34ac5a8fb', '[\"*\"]', NULL, '2021-11-21 02:32:52', '2021-11-21 02:32:52');

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
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` tinyint(4) NOT NULL COMMENT '0 = Male, 1 = Female',
  `dob` date DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `image`, `gender`, `dob`, `latitude`, `longitude`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Rezowana Akter', 'rezowana10@gmail.com', NULL, '$2y$10$qV00kXSYXBnY3YXX/ikLw.TOmTd6E54tDa52nyMGxtcUXmRYONmMK', NULL, 1, '2021-11-01', 23.7298, 90.3854, NULL, '2021-11-19 11:13:16', '2021-11-19 11:13:16'),
(3, 'Joe Khan', 'admin@gmail.com', NULL, '$2y$10$nasRcVYoIZunnvKvN2JZE.PrlOKyZtCTigAf4jFhLmw7Dcs6367ba', NULL, 0, '2021-04-01', 23.746466, 90.376015, NULL, '2021-11-19 11:17:52', '2021-11-19 11:17:52'),
(13, 'Dalia', 'bdsdks@gmail.com', NULL, '$2y$10$1y9s8UqvXE/tJPCVmZm9uenxarujdT4otP7chKKziLQJJHLO7rSKy', 'iphone-13-pro-max-design.jpg', 1, '2021-09-01', 23.746456, 90.376025, NULL, '2021-11-20 14:50:52', '2021-11-20 14:50:52'),
(15, 'Mokhles Uddin', 'mokhles@gmail.com', NULL, '$2y$10$AjCBngMVMCgKNX4MZC2R7Oe60skAFU4V5fPtyq.tyty9cyTz4b2qO', 'user5.jpg', 0, '1984-10-14', 37.056519, -94.537453, NULL, '2021-11-21 02:40:21', '2021-11-21 02:40:21'),
(16, 'Polo', 'polo@gmail.com', NULL, '$2y$10$BOPcCwJRWskYx/.jvv6RdukzT5yav3uKN3muhMbYpCzGcbd724wm6', 'student1.jpg', 0, '1990-09-10', 23.718176, 90.386604, NULL, '2021-11-21 02:44:23', '2021-11-21 02:44:23'),
(17, 'Mk', 'mk@gmail.com', NULL, '$2y$10$M8uOyhtKtGTvTSaLhFWlXuVsxFQNmesAg3qqfeSSDANyWqcgU5tNW', 'teacher.jpg', 0, '1984-12-05', 23.746466, 90.376015, NULL, '2021-11-21 02:45:02', '2021-11-21 02:45:02'),
(18, 'Mania', 'mania@gmail.com', NULL, '$2y$10$xupiqPKLzaIdURyGSKxJzOH7qT4YCHm1pzF.udTUsXshF2ou78.6O', 'student.png', 1, '1999-02-14', 37.056519, -94.537453, NULL, '2021-11-21 02:45:53', '2021-11-21 02:45:53');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `mutuals`
--
ALTER TABLE `mutuals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mutuals_action_on_foreign` (`action_on`),
  ADD KEY `mutuals_action_by_foreign` (`action_by`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mutuals`
--
ALTER TABLE `mutuals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mutuals`
--
ALTER TABLE `mutuals`
  ADD CONSTRAINT `mutuals_action_by_foreign` FOREIGN KEY (`action_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `mutuals_action_on_foreign` FOREIGN KEY (`action_on`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
