-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2024 at 04:46 PM
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
-- Database: `dss`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` int(11) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `slug`, `title`, `author`, `body`) VALUES
(1, 'keqing', 'Keqing', 'Rafii Anindito', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. In ea repudiandae consequatur earum eveniet, modi nihil omnis praesentium ipsa fuga libero tempore porro odio voluptatum doloremque, officiis laborum. Quibusdam, necessitatibus.'),
(2, 'neuvillette', 'Neuvillette', 'Erika Kathrina', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. In ea repudiandae consequatur earum eveniet, modi nihil omnis praesentium ipsa fuga libero tempore porro odio voluptatum doloremque, officiis laborum. Quibusdam, necessitatibus.');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

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
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('5W3dtfbf9olZSe6ZASS1oj170xplGYxWQPwwuE8Z', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicUgzU0swUkcyU2tsSFV5RHQzbGlFNzdJVHQxbWw5eFd0TlpYYVZySSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1720797805),
('BiZSQNLnNnLLSUo2OhbWxSWeD5OAjg49LGq13pZT', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTXNLTFFpbkxhQzlOVmRJOEtEYlp2emNVcUJ6Q2RXblBpNWhnQzYyZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9oaXN0b3J5Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1720797811),
('RlLSju5PUMke8O1HwouvDurdbsyT3zNDyDr2Y65o', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU0h6OXVyckJJRmJrMkhoZjhHOVIwQTVNaXZxaFV3VnU1b2VKU0dFOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9oaXN0b3J5Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1720863516);

-- --------------------------------------------------------

--
-- Table structure for table `tb_alternative`
--

CREATE TABLE `tb_alternative` (
  `alternative_id` int(11) NOT NULL,
  `alternative_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_alternative`
--

INSERT INTO `tb_alternative` (`alternative_id`, `alternative_name`) VALUES
(1, 'Adit'),
(2, 'Budi'),
(3, 'Caca'),
(4, 'Dito'),
(5, 'Erika'),
(6, 'Fanum Tax'),
(7, 'Gyatt'),
(8, 'Hu Tao');

-- --------------------------------------------------------

--
-- Table structure for table `tb_alternative_criteria`
--

CREATE TABLE `tb_alternative_criteria` (
  `alternative_id` int(11) NOT NULL,
  `criteria_id` int(11) NOT NULL,
  `alternative_criteria_value` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_alternative_criteria`
--

INSERT INTO `tb_alternative_criteria` (`alternative_id`, `criteria_id`, `alternative_criteria_value`) VALUES
(1, 1, 3.00),
(1, 2, 3.00),
(1, 3, 5.00),
(1, 4, 3.00),
(1, 5, 2.00),
(1, 6, 4.00),
(1, 7, 4.00),
(2, 1, 4.00),
(2, 2, 4.00),
(2, 3, 3.00),
(2, 4, 2.00),
(2, 5, 3.00),
(2, 6, 3.00),
(2, 7, 2.00),
(3, 1, 3.00),
(3, 2, 3.00),
(3, 3, 4.00),
(3, 4, 4.00),
(3, 5, 3.00),
(3, 6, 4.00),
(3, 7, 3.00),
(4, 1, 5.00),
(4, 2, 2.00),
(4, 3, 4.00),
(4, 4, 5.00),
(4, 5, 4.00),
(4, 6, 2.00),
(4, 7, 4.00),
(5, 1, 3.00),
(5, 2, 5.00),
(5, 3, 4.00),
(5, 4, 4.00),
(5, 5, 2.00),
(5, 6, 2.00),
(5, 7, 5.00),
(6, 1, 4.00),
(6, 2, 4.00),
(6, 3, 3.00),
(6, 4, 2.00),
(6, 5, 3.00),
(6, 6, 5.00),
(6, 7, 2.00),
(7, 1, 5.00),
(7, 2, 5.00),
(7, 3, 4.00),
(7, 4, 3.00),
(7, 5, 3.00),
(7, 6, 3.00),
(7, 7, 3.00),
(8, 1, 4.00),
(8, 2, 3.00),
(8, 3, 2.00),
(8, 4, 2.00),
(8, 5, 3.00),
(8, 6, 3.00),
(8, 7, 5.00);

-- --------------------------------------------------------

--
-- Table structure for table `tb_alternative_proportion`
--

CREATE TABLE `tb_alternative_proportion` (
  `history_id` int(11) NOT NULL,
  `alternative_id` int(11) NOT NULL,
  `final_score` decimal(10,2) DEFAULT NULL,
  `final_rank` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_alternative_proportion`
--

INSERT INTO `tb_alternative_proportion` (`history_id`, `alternative_id`, `final_score`, `final_rank`) VALUES
(1, 1, NULL, NULL),
(1, 2, NULL, NULL),
(1, 3, NULL, NULL),
(1, 4, NULL, NULL),
(1, 5, NULL, NULL),
(1, 6, NULL, NULL),
(1, 7, NULL, NULL),
(1, 8, NULL, NULL),
(2, 1, NULL, NULL),
(2, 2, NULL, NULL),
(2, 3, NULL, NULL),
(2, 4, NULL, NULL),
(2, 5, NULL, NULL),
(2, 6, NULL, NULL),
(2, 7, NULL, NULL),
(2, 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_criteria`
--

CREATE TABLE `tb_criteria` (
  `criteria_id` int(11) NOT NULL,
  `criteria_name` varchar(100) DEFAULT NULL,
  `criteria_status` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_criteria`
--

INSERT INTO `tb_criteria` (`criteria_id`, `criteria_name`, `criteria_status`) VALUES
(1, 'Kesehatan', 'b'),
(2, 'Kecerdasan', 'b'),
(3, 'Kedisiplinan', 'b'),
(4, 'Kekuatan', 'b'),
(5, 'Usia', 'c'),
(6, 'Gaji', 'c'),
(7, 'Jarak Rumah', 'c');

-- --------------------------------------------------------

--
-- Table structure for table `tb_criteria_proportion`
--

CREATE TABLE `tb_criteria_proportion` (
  `history_id` int(11) NOT NULL,
  `criteria_id` int(11) NOT NULL,
  `criteria_value` decimal(10,2) DEFAULT NULL,
  `criteria_priority` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_criteria_proportion`
--

INSERT INTO `tb_criteria_proportion` (`history_id`, `criteria_id`, `criteria_value`, `criteria_priority`) VALUES
(1, 1, 4.00, NULL),
(1, 2, 4.00, NULL),
(1, 3, 4.00, NULL),
(1, 4, 4.00, NULL),
(1, 5, 3.00, NULL),
(1, 6, 3.00, NULL),
(1, 7, 3.00, NULL),
(2, 1, 5.00, 'p'),
(2, 2, 4.00, 'p'),
(2, 3, 3.00, 'p'),
(2, 4, 2.00, 's'),
(2, 5, 10.00, 'p'),
(2, 6, 2.00, 's'),
(2, 7, 10.00, 's');

-- --------------------------------------------------------

--
-- Table structure for table `tb_history`
--

CREATE TABLE `tb_history` (
  `history_id` int(11) NOT NULL,
  `method_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `case_name` varchar(100) DEFAULT NULL,
  `primary_weight` decimal(10,2) DEFAULT NULL,
  `secondary_weight` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_history`
--

INSERT INTO `tb_history` (`history_id`, `method_id`, `user_id`, `case_name`, `primary_weight`, `secondary_weight`) VALUES
(1, 1, 1, 'Pemilihan Ketua RT', NULL, NULL),
(2, 3, 1, 'Pemilihan Kapten', 0.80, 0.20);

-- --------------------------------------------------------

--
-- Table structure for table `tb_method`
--

CREATE TABLE `tb_method` (
  `method_id` int(11) NOT NULL,
  `method_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_method`
--

INSERT INTO `tb_method` (`method_id`, `method_name`) VALUES
(2, 'AHP'),
(4, 'COPRAS'),
(3, 'PM'),
(5, 'WASPAS'),
(1, 'WP');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `username`, `password`) VALUES
(1, 'A', 'A'),
(2, 'ADMIN_2', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tb_alternative`
--
ALTER TABLE `tb_alternative`
  ADD PRIMARY KEY (`alternative_id`);

--
-- Indexes for table `tb_alternative_criteria`
--
ALTER TABLE `tb_alternative_criteria`
  ADD PRIMARY KEY (`alternative_id`,`criteria_id`),
  ADD KEY `fk_tb_alternative_criteria_criteria_id_tb_criteria` (`criteria_id`);

--
-- Indexes for table `tb_alternative_proportion`
--
ALTER TABLE `tb_alternative_proportion`
  ADD PRIMARY KEY (`history_id`,`alternative_id`),
  ADD KEY `fk_tb_alternative_proportion_alternative_id_tb_alternative` (`alternative_id`);

--
-- Indexes for table `tb_criteria`
--
ALTER TABLE `tb_criteria`
  ADD PRIMARY KEY (`criteria_id`);

--
-- Indexes for table `tb_criteria_proportion`
--
ALTER TABLE `tb_criteria_proportion`
  ADD PRIMARY KEY (`history_id`,`criteria_id`),
  ADD KEY `fk_tb_criteria_proportion_criteria_id_tb_criteria` (`criteria_id`);

--
-- Indexes for table `tb_history`
--
ALTER TABLE `tb_history`
  ADD PRIMARY KEY (`history_id`),
  ADD KEY `fk_tb_history_method_id_tb_method` (`method_id`),
  ADD KEY `fk_tb_history_user_id_tb_user` (`user_id`);

--
-- Indexes for table `tb_method`
--
ALTER TABLE `tb_method`
  ADD PRIMARY KEY (`method_id`),
  ADD UNIQUE KEY `method_name` (`method_name`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

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
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_alternative`
--
ALTER TABLE `tb_alternative`
  MODIFY `alternative_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_criteria`
--
ALTER TABLE `tb_criteria`
  MODIFY `criteria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_history`
--
ALTER TABLE `tb_history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_method`
--
ALTER TABLE `tb_method`
  MODIFY `method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_alternative_criteria`
--
ALTER TABLE `tb_alternative_criteria`
  ADD CONSTRAINT `fk_tb_alternative_criteria_alternative_id_tb_alternative` FOREIGN KEY (`alternative_id`) REFERENCES `tb_alternative` (`alternative_id`),
  ADD CONSTRAINT `fk_tb_alternative_criteria_criteria_id_tb_criteria` FOREIGN KEY (`criteria_id`) REFERENCES `tb_criteria` (`criteria_id`);

--
-- Constraints for table `tb_alternative_proportion`
--
ALTER TABLE `tb_alternative_proportion`
  ADD CONSTRAINT `fk_tb_alternative_proportion_alternative_id_tb_alternative` FOREIGN KEY (`alternative_id`) REFERENCES `tb_alternative` (`alternative_id`),
  ADD CONSTRAINT `fk_tb_alternative_proportion_history_id_tb_history` FOREIGN KEY (`history_id`) REFERENCES `tb_history` (`history_id`);

--
-- Constraints for table `tb_criteria_proportion`
--
ALTER TABLE `tb_criteria_proportion`
  ADD CONSTRAINT `fk_tb_criteria_proportion_criteria_id_tb_criteria` FOREIGN KEY (`criteria_id`) REFERENCES `tb_criteria` (`criteria_id`),
  ADD CONSTRAINT `fk_tb_criteria_proportion_history_id_tb_history` FOREIGN KEY (`history_id`) REFERENCES `tb_history` (`history_id`);

--
-- Constraints for table `tb_history`
--
ALTER TABLE `tb_history`
  ADD CONSTRAINT `fk_tb_history_method_id_tb_method` FOREIGN KEY (`method_id`) REFERENCES `tb_method` (`method_id`),
  ADD CONSTRAINT `fk_tb_history_user_id_tb_user` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
