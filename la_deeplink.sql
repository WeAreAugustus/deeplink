-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 05, 2025 at 02:23 PM
-- Server version: 8.0.31
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `la_deeplink`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_07_28_092232_create_sites_table', 1),
(6, '2025_07_29_092232_create_short_links_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `short_links`
--

DROP TABLE IF EXISTS `short_links`;
CREATE TABLE IF NOT EXISTS `short_links` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` mediumtext COLLATE utf8mb4_unicode_ci,
  `web` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `short_links_code_unique` (`code`),
  KEY `short_links_site_id_foreign` (`site_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `short_links`
--

INSERT INTO `short_links` (`id`, `code`, `details`, `web`, `site_id`, `created_at`, `updated_at`) VALUES
(1, 'ZOl9XI', '{\"item_type\":\"page\",\"item_value\":\"subscribe\"}', 'subscribe', 1, '2025-08-05 10:40:38', '2025-08-05 10:40:38');

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

DROP TABLE IF EXISTS `sites`;
CREATE TABLE IF NOT EXISTS `sites` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `android_link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ios_link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `web_link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sites_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`id`, `name`, `android_link`, `ios_link`, `web_link`, `api_key`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Smashi', 'https://play.google.com/store/apps/details?id=com.augustus.smashi&pli=1', 'https://apps.apple.com/eg/app/smashi/id1497697949?platform=iphone', 'https://smashi.tv/', 'PzoInS3Fy4tyGPpm', 1, '2025-08-05 10:39:57', '2025-08-05 10:39:57'),
(2, 'Lovin', 'https://play.google.com/store/apps/details?id=co.lovin.lovinapp&hl=en&gl=US', 'https://apps.apple.com/in/app/lovin-augustus-media/id1529508280', 'https://lovin.co/', 'gqLNX2FVYgmr0WDe', 1, '2025-08-05 10:39:57', '2025-08-05 10:39:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Davon Lueilwitz', 'jfranecki@example.org', '2025-08-05 10:39:56', '$2y$12$XuynkDIQo5aIqAw69rjLRO7nkL0YbQEc9Xho9v.LMFpKTJEYKjcQa', 'Y1rv8xuuCd', '2025-08-05 10:39:57', '2025-08-05 10:39:57'),
(2, 'Annie Tromp III', 'tromp.celestine@example.org', '2025-08-05 10:39:57', '$2y$12$XuynkDIQo5aIqAw69rjLRO7nkL0YbQEc9Xho9v.LMFpKTJEYKjcQa', 'C4TF0J4QZS', '2025-08-05 10:39:57', '2025-08-05 10:39:57'),
(3, 'Beverly Hill', 'vonrueden.gussie@example.org', '2025-08-05 10:39:57', '$2y$12$XuynkDIQo5aIqAw69rjLRO7nkL0YbQEc9Xho9v.LMFpKTJEYKjcQa', 'tHBAyayKtQ', '2025-08-05 10:39:57', '2025-08-05 10:39:57'),
(4, 'Chanelle Romaguera DVM', 'cortney.veum@example.org', '2025-08-05 10:39:57', '$2y$12$XuynkDIQo5aIqAw69rjLRO7nkL0YbQEc9Xho9v.LMFpKTJEYKjcQa', 'F3FPzbghEs', '2025-08-05 10:39:57', '2025-08-05 10:39:57'),
(5, 'Prof. Erwin Friesen DDS', 'osenger@example.com', '2025-08-05 10:39:57', '$2y$12$XuynkDIQo5aIqAw69rjLRO7nkL0YbQEc9Xho9v.LMFpKTJEYKjcQa', 'Q3zwsZ06G2', '2025-08-05 10:39:57', '2025-08-05 10:39:57'),
(6, 'Susanna Hand', 'elenora.schmitt@example.com', '2025-08-05 10:39:57', '$2y$12$XuynkDIQo5aIqAw69rjLRO7nkL0YbQEc9Xho9v.LMFpKTJEYKjcQa', 'za9TNLFZyo', '2025-08-05 10:39:57', '2025-08-05 10:39:57'),
(7, 'Jasper Haley', 'rau.kamren@example.org', '2025-08-05 10:39:57', '$2y$12$XuynkDIQo5aIqAw69rjLRO7nkL0YbQEc9Xho9v.LMFpKTJEYKjcQa', 'OSB1vCZFYo', '2025-08-05 10:39:57', '2025-08-05 10:39:57'),
(8, 'Rashawn Glover', 'nikko.torphy@example.org', '2025-08-05 10:39:57', '$2y$12$XuynkDIQo5aIqAw69rjLRO7nkL0YbQEc9Xho9v.LMFpKTJEYKjcQa', 'wVoocrHDP8', '2025-08-05 10:39:57', '2025-08-05 10:39:57'),
(9, 'Fleta Leffler', 'hugh.welch@example.org', '2025-08-05 10:39:57', '$2y$12$XuynkDIQo5aIqAw69rjLRO7nkL0YbQEc9Xho9v.LMFpKTJEYKjcQa', 'njeubZwqIk', '2025-08-05 10:39:57', '2025-08-05 10:39:57'),
(10, 'Darien Predovic', 'arely54@example.org', '2025-08-05 10:39:57', '$2y$12$XuynkDIQo5aIqAw69rjLRO7nkL0YbQEc9Xho9v.LMFpKTJEYKjcQa', 'UknNSMPnep', '2025-08-05 10:39:57', '2025-08-05 10:39:57'),
(11, 'Url Admin', 'admin@urls.augustusmedia.com', '2025-08-05 10:39:57', '$2y$12$fNMrOhsYQ/1i//EMZCg7OOhI0lQOyIkJtXFF3hHV4xxf4KHm/PixS', 'hbbVzhqa4i', '2025-08-05 10:39:57', '2025-08-05 10:39:57');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
