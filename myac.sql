-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2025 at 11:04 AM
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
-- Database: `myac`
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
(5, '2025_09_02_064222_add_is_admin_to_users_table', 2),
(6, '2025_09_03_133414_create_products_table', 3),
(7, '2025_09_16_111214_create_orders_table', 4),
(8, '2025_09_16_111432_create_order_items_table', 4),
(9, '2025_09_16_141047_add_delivery_date_to_orders_table', 5),
(10, '2025_09_17_184720_add_payment_and_status_to_orders_table', 6),
(11, '2025_09_22_165331_create_wishlists_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `delivery_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `email`, `phone`, `address`, `payment_method`, `total`, `status`, `created_at`, `updated_at`, `delivery_date`) VALUES
(1, 7, 'Gagiya Mahesh', 'gagiyamahesh@gmil.com', '1234567892', 'gokulnagar', 'COD', '54999.00', 'confirmed', '2025-09-16 08:55:59', '2025-09-16 08:55:59', '2025-10-02'),
(2, 7, 'Gagiya Mahesh', 'gagiyamahesh@gmil.com', '1234567892', 'gokulnagar', 'UPI', '36387.00', 'confirmed', '2025-09-16 09:06:16', '2025-09-16 09:06:16', '2025-09-22'),
(3, 7, 'Gagiya Mahesh', 'gagiyamahesh@gmil.com', '1234567892', 'gokulnagar', 'Card', '31000.00', 'confirmed', '2025-09-17 11:39:46', '2025-09-17 11:39:46', '2025-10-02'),
(4, 7, 'Gagiya Mahesh', 'gagiyamahesh@gmil.com', '9876543212', 'gokulnagar', 'UPI', '56500.00', 'confirmed', '2025-09-17 12:25:55', '2025-09-17 12:25:55', '2025-09-22'),
(5, 7, 'Gagiya Mahesh', 'gagiyamahesh@gmil.com', '9874563212', 'gokulnagar', 'COD', '54999.00', 'confirmed', '2025-09-17 12:53:49', '2025-09-17 12:53:49', '2025-09-22'),
(6, 7, 'Gagiya Mahesh', 'gagiyamahesh@gmil.com', '9638527412', 'gokulnagat', 'COD', '31000.00', 'confirmed', '2025-09-17 13:27:50', '2025-09-17 13:27:50', '2025-09-22'),
(7, 1, 'Yug Sutariya', 'yugsutariya20@gmail.com', '8200244992', 'surendranagr', 'Card', '36387.00', 'confirmed', '2025-09-17 13:48:26', '2025-09-17 13:48:26', '2025-09-22'),
(8, 1, 'Yug Sutariya', 'yugsutariya20@gmail.com', '8200244992', 'surndranagar', 'COD', '31000.00', 'confirmed', '2025-09-17 13:59:10', '2025-09-17 13:59:10', '2025-09-22'),
(9, 1, 'Yug Sutariya', 'yugsutariya20@gmail.com', '8200244992', 'ratanpar', 'COD', '56500.00', 'confirmed', '2025-09-21 11:14:11', '2025-09-21 11:14:11', '2025-09-26'),
(10, 1, 'Yug Sutariya', 'yugsutariya20@gmail.com', '8200244992', 'surendranagar', 'COD', '36387.00', 'confirmed', '2025-09-22 11:11:52', '2025-09-22 11:11:52', '2025-09-27'),
(11, 8, 'jeswal ashish', 'ashishjeswal@gmail.com', '8140821613', 'Naghedi', 'COD', '56500.00', 'confirmed', '2025-10-01 11:17:34', '2025-10-01 11:17:34', '2025-10-06'),
(12, 8, 'jeswal ashish', 'ashishjeswal@gmail.com', '8140821613', 'Naghedi', 'UPI', '31000.00', 'confirmed', '2025-10-02 13:19:03', '2025-10-02 13:19:03', '2025-10-07');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 1, '54999.00', '2025-09-16 08:55:59', '2025-09-16 08:55:59'),
(2, 2, 1, 1, '36387.00', '2025-09-16 09:06:16', '2025-09-16 09:06:16'),
(3, 3, 2, 1, '31000.00', '2025-09-17 11:39:46', '2025-09-17 11:39:46'),
(4, 4, 3, 1, '56500.00', '2025-09-17 12:25:55', '2025-09-17 12:25:55'),
(5, 5, 4, 1, '54999.00', '2025-09-17 12:53:49', '2025-09-17 12:53:49'),
(6, 6, 2, 1, '31000.00', '2025-09-17 13:27:50', '2025-09-17 13:27:50'),
(7, 7, 1, 1, '36387.00', '2025-09-17 13:48:26', '2025-09-17 13:48:26'),
(8, 8, 2, 1, '31000.00', '2025-09-17 13:59:10', '2025-09-17 13:59:10'),
(9, 9, 3, 1, '56500.00', '2025-09-21 11:14:11', '2025-09-21 11:14:11'),
(10, 10, 1, 1, '36387.00', '2025-09-22 11:11:52', '2025-09-22 11:11:52'),
(11, 11, 3, 1, '56500.00', '2025-10-01 11:17:34', '2025-10-01 11:17:34'),
(12, 12, 2, 1, '31000.00', '2025-10-02 13:19:03', '2025-10-02 13:19:03');

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
  `brand_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_qty` int(11) NOT NULL,
  `product_details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `brand_name`, `product_name`, `product_image`, `product_size`, `product_qty`, `product_details`, `product_price`, `created_at`, `updated_at`) VALUES
(1, 'Haier HSU-19CXAS5N-RANA', 'Split AC (3 Star, Red)', '1756908569.jpg', '1.5 Ton', 50, 'The Haier HSU-19CXAS5N-RANA Split AC, a stylish and efficient cooling solution that will transform your space. With a cooling capacity of 1.5 Ton and a 3-star energy rating, this AC guarantees optimal performance while saving energy. Its sleek red color adds a touch of elegance to any room, making it both a functional and aesthetic addition to your home.', '36387.00', '2025-09-03 08:39:29', '2025-09-03 08:39:29'),
(2, 'VOLTAS', 'INVERTER SPLIT AC', '1756909032.jpg', '1 Ton', 20, 'Copper Condenser\r\nR32 Green Gas\r\nHigh EER Rotry Compressor\r\n3 Star Split Inverter Ac', '31000.00', '2025-09-03 08:47:12', '2025-09-03 08:47:12'),
(3, 'Samsung', 'Inverter Split AC', '1756919077.jpg', '2 Ton', 60, 'The Samsung 2 Ton 5 Star Inverter Split AC (NEO AR24KV5HBWK) a stylish and efficient cooling solution that will transform your space.', '56500.00', '2025-09-03 11:34:37', '2025-09-03 11:34:37'),
(4, 'LLOYD', '5 Star Stellar Wifi Inverter Split AC', '1756919278.jpg', '1.5 Ton', 40, 'LLOYD 1.5 Ton 5 Star Stellar Wifi Inverter Split AC, GLS18V5FWSSL (6 in 1 Convertible, 4 Way Swing, Mood Lighting, Ambi Lighting, 100 percent Copper, 2024 Launch)', '54999.00', '2025-09-03 11:37:59', '2025-09-03 11:37:59'),
(5, 'Daikin', '5 Star Split Air Conditioner', '1759338250.jpg', '2 Ton', 50, 'Capacity\r\n2 Ton\r\nStar Rating\r\n5 Star\r\nModel Name/Number\r\nJTKJ35UV16W\r\nBrand\r\nDaikin\r\nUsage/Application\r\nCooling Purpose\r\nCompressor Type\r\nInverter\r\nOperating Current\r\n4.3 A\r\nColor\r\nWhite\r\nFrequency\r\n50 Hz\r\nWeight\r\n9.5kg\r\nRefrigerant\r\nRC-32\r\nNumber Of Phases\r\nSingle Phase\r\nCoil Material\r\nCopper\r\nSound Level\r\n40dB\r\nVoltage\r\n220 V\r\nIndoor Unit Dimension\r\n22.9 X 80 X 29.8cm\r\nDimension D X W X H (mm)\r\n28.4 X 67.5 X 55cm\r\nAir Flow Rate\r\n420cfm\r\nAnnual Power Consumption\r\n523.54kWh\r\nCooling Capacity\r\n3.52kWh', '52000.00', '2025-10-01 11:34:12', '2025-10-01 11:34:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `email_verified_at`, `username`, `password`, `remember_token`, `created_at`, `updated_at`, `is_admin`) VALUES
(1, 'Yug Sutariya', '8200244992', 'yugsutariya20@gmail.com', NULL, 'mr_yug', '$2y$10$CILe51Oelh7C7yAqO95KWOvs7hcM3Klexv1YOEkuIeYyij4MhEi.O', NULL, '2025-09-02 00:51:17', '2025-09-02 00:51:17', 0),
(6, 'Admin', '9512823483', 'admin@myac.com', NULL, 'Mr_m_jeswal', '$2y$10$08LQqyFPrcPZRG0QfUopLO8vVItWIQ/wswkeTFY4UuflzVOb7s4E2', NULL, '2025-09-02 08:41:02', '2025-09-02 08:56:01', 1),
(7, 'Gagiya Mahesh', '1234567892', 'gagiyamahesh@gmil.com', NULL, 'mr_ravan', '$2y$10$DPy5Y6wvCb1tyaSrF6FBTOYCrslVh9YIO4Wv9fsNshgLiDixFmEqi', NULL, '2025-09-02 11:52:28', '2025-09-02 11:52:28', 0),
(8, 'jeswal ashish', '8140821613', 'ashishjeswal@gmail.com', NULL, 'mr_ashish', '$2y$10$oiWnN5Z05XP5mLvw3xq8EuAXnT5lcBOC0fhuw6NRRHTvpAMjBtV4q', NULL, '2025-10-01 11:03:45', '2025-10-01 11:03:45', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
