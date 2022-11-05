-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2022 at 11:43 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bidding`
--

-- --------------------------------------------------------

--
-- Table structure for table `applybids`
--

CREATE TABLE `applybids` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userbids_id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` bigint(20) UNSIGNED NOT NULL,
  `price` bigint(255) NOT NULL,
  `driver_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'nil',
  `driver_license_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'nil',
  `driver_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'nil',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applybids`
--

INSERT INTO `applybids` (`id`, `userbids_id`, `provider_id`, `price`, `driver_phone`, `driver_license_image`, `driver_image`, `status`, `created_at`, `updated_at`) VALUES
(27, 156, 91, 100, 'nil', 'nil', 'nil', 'payment complete', '2022-05-12 02:00:37', '2022-05-12 02:00:37'),
(28, 158, 91, 23000, 'nil', 'nil', 'nil', 'pending', '2022-05-12 02:01:30', '2022-05-12 02:01:30'),
(29, 160, 91, 17000, 'nil', 'nil', 'nil', 'Inprogress', '2022-05-12 02:01:37', '2022-05-12 02:01:37'),
(40, 164, 91, 65, 'nil', 'nil', 'nil', 'pending', NULL, NULL),
(41, 161, 91, 8, 'nil', 'nil', 'nil', 'pending', NULL, NULL),
(42, 159, 91, 123, 'nil', 'nil', 'nil', 'Inprogress', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_category` int(11) DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `parent_category`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Tours And Travels', 0, 'http://127.0.0.1:8000/Icon/1649154879.png', 1, NULL, NULL),
(2, 'Transport', 0, '	\r\nhttp://127.0.0.1:8000/Icon/1647849021.png', 1, NULL, NULL),
(3, 'Package Movers', 0, '	\r\nhttp://127.0.0.1:8000/Icon/1647849087.png', 1, NULL, NULL);

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
-- Table structure for table `flats`
--

CREATE TABLE `flats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `flat_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flats`
--

INSERT INTO `flats` (`id`, `flat_type`, `created_at`, `updated_at`) VALUES
(1, '1 BHK', NULL, NULL),
(4, '2 BHK', NULL, NULL),
(5, '3 BHK', NULL, NULL);

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
(5, '2022_03_02_045325_create_categories_table', 2),
(6, '2022_03_08_095243_create_userbids_table', 3),
(7, '2022_03_11_080529_create_providers_table', 4),
(8, '2022_03_14_055217_create_vehicles_table', 5),
(9, '2022_03_14_060010_create_sizes_table', 6),
(10, '2022_03_17_061803_add_category_id_to_vehicle', 7),
(11, '2022_03_20_153025_create_permission_tables', 8),
(12, '2022_03_23_064753_create_applybids_table', 9),
(13, '2022_03_23_070334_change_column_in_applybids_table', 10),
(14, '2022_03_23_071034_drop_column_in_applybids_table', 11),
(15, '2022_03_23_071853_create_applybids_table', 12),
(16, '2022_03_31_111126_create_flats_table', 13),
(17, '2022_04_01_120501_create_usertransports_table', 14),
(18, '2022_04_05_080023_create_usertours_table', 15),
(19, '2022_04_05_122523_create_userpackages_table', 16),
(20, '2022_04_05_122944_create_userpackages_table', 17),
(21, '2022_04_19_071044_create_vehicletypes_table', 18),
(22, '2022_04_19_105301_create_supports_table', 19),
(23, '2022_05_02_072215_create_wallets_table', 20),
(24, '2022_05_08_074032_create_papers_table', 21);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 28),
(2, 'App\\Models\\User', 30),
(2, 'App\\Models\\User', 58),
(2, 'App\\Models\\User', 63),
(2, 'App\\Models\\User', 64),
(2, 'App\\Models\\User', 65),
(2, 'App\\Models\\User', 81),
(2, 'App\\Models\\User', 83),
(2, 'App\\Models\\User', 85),
(2, 'App\\Models\\User', 90),
(2, 'App\\Models\\User', 92);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `astatus` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` date NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `title`, `message`, `type`, `status`, `astatus`, `created_at`, `updated_at`) VALUES
(5, 90, 'Create Transport Consignment', 'You Are Create a Transport Consignment Successfully', 'Transport Consignment', 0, 1, '2022-05-12', '2022-05-12 01:33:06'),
(6, 90, 'Create Transport Consignment', 'You Are Create a Transport Consignment Successfully', 'Transport Consignment', 0, 1, '2022-05-12', '2022-05-12 01:34:40'),
(7, 91, 'Your bid has been accepted', 'Consignment Order id is WHLSNFRTRA000156', 'Accept Bid', 0, 1, '2022-05-12', '2022-05-31 04:36:40'),
(8, 91, 'Your bid has been accepted', 'Consignment Order id is WHLSNFRTRA000156', 'Accept Bid', 0, 1, '2022-05-12', '2022-05-31 04:36:40'),
(15, 91, 'Payment Successful', 'Anuj complete a payment. Order ID is WHLSNFRTRA000156', 'Consignment Payment Done', 0, 1, '2022-05-12', '2022-05-31 04:36:40'),
(16, 90, 'Payment Successful', 'Anuj,Your payment is complete. Consignment Order ID is WHLSNFRTRA000156', 'Consignment Payment Done', 0, 1, '2022-05-12', '2022-05-12 06:11:13'),
(17, 92, 'Consumer have Registered Successfully', 'Tanvi Singh have registered as a consumer', 'Cregister', 1, 1, '2022-05-27', '2022-05-27 11:16:31'),
(18, 93, 'Provider have Registered Successfully', 'Vishal Chaudhary have registered as a provider', 'Pregister', 1, 1, '2022-05-27', '2022-05-27 11:41:11'),
(19, 91, 'Your bid has been accepted', 'Consignment Order id is WHLSNFRTRA000156', 'Accept Bid', 0, 1, '2022-05-30', '2022-05-31 04:36:40'),
(20, 91, 'Your bid has been accepted', 'Consignment Order id is WHLSNFRTRA000156', 'Accept Bid', 0, 1, '2022-05-30', '2022-05-31 04:36:40'),
(21, 91, 'Your bid has been accepted', 'Consignment Order id is WHLSNFRTRA000156', 'Accept Bid', 0, 1, '2022-05-30', '2022-05-31 04:36:40'),
(22, 91, 'Payment Successful', 'Anuj complete a payment. Order ID is WHLSNFRTRA000156', 'Consignment Payment Done', 0, 1, '2022-05-30', '2022-05-31 04:36:40'),
(23, 90, 'Payment Successful', 'Anuj,Your payment is complete. Consignment Order ID is WHLSNFRTRA000156', 'Consignment Payment Done', 1, 1, '2022-05-30', '2022-05-30 00:45:07'),
(24, 91, 'Payment Successful', 'Anuj complete a payment. Order ID is WHLSNFRTRA000156', 'Consignment Payment Done', 0, 1, '2022-05-30', '2022-05-31 04:36:40'),
(25, 90, 'Payment Successful', 'Anuj,Your payment is complete. Consignment Order ID is WHLSNFRTRA000156', 'Consignment Payment Done', 1, 1, '2022-05-30', '2022-05-30 01:03:33'),
(26, 91, 'Payment Successful', 'Anuj complete a payment. Order ID is WHLSNFRTRA000156', 'Consignment Payment Done', 0, 1, '2022-05-30', '2022-05-31 04:36:40'),
(27, 90, 'Payment Successful', 'Anuj,Your payment is complete. Consignment Order ID is WHLSNFRTRA000156', 'Consignment Payment Done', 1, 1, '2022-05-30', '2022-05-30 03:32:58'),
(28, 90, 'puspa has been applied on your consignment', 'puspa successfully applied on your consignment', 'Apply on your consignment', 1, 1, '2022-05-30', '2022-05-30 06:21:50'),
(29, 90, 'puspa has been applied on your consignment', 'puspa successfully applied on your consignment', 'Apply on your consignment', 1, 1, '2022-05-30', '2022-05-30 06:22:43'),
(30, 91, 'Apply On Bid', 'you have successfully applied on bid', 'Apply Bid', 0, 1, '2022-05-30', '2022-05-31 04:36:40'),
(31, 90, 'puspa has been applied on your consignment', 'puspa successfully applied on your consignment', 'Apply on your consignment', 1, 1, '2022-05-30', '2022-05-30 06:38:24'),
(32, 91, 'Your bid has been accepted', 'Consignment Order id is WHLSNFRPA000160', 'Accept Bid', 0, 1, '2022-05-30', '2022-05-31 04:36:40'),
(33, 90, 'You have accepted the bid', 'Consignment Order id is WHLSNFRPA000160', 'Accept Bid', 1, 1, '2022-05-30', '2022-05-30 08:51:16'),
(40, 90, 'Create Transport Consignment', 'You Are Create a Transport Consignment Successfully', 'Transport Consignment', 1, 1, '2022-05-31', '2022-05-31 03:48:19'),
(41, 91, 'Anuj Create Transport Consignment', 'Anuj has  Created a Transport Consignment', 'Transport Consignment', 0, 1, '2022-05-31', '2022-05-31 04:36:40'),
(42, 93, 'Anuj Create Transport Consignment', 'Anuj has  Created a Transport Consignment', 'Transport Consignment', 1, 1, '2022-05-31', '2022-05-31 03:48:20');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `razor_id` varchar(50) NOT NULL,
  `amount` decimal(30,0) NOT NULL,
  `user_id` int(11) NOT NULL,
  `consignment_id` int(255) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `order_id`, `razor_id`, `amount`, `user_id`, `consignment_id`, `plan_id`, `currency`, `status`, `created_at`, `updated_at`) VALUES
(9, 'order_6294653b2e871', 'order_JbLEbPBHQetPDv', '100', 90, 156, 0, 'INR', 0, '2022-05-30 01:03:32', '2022-05-30 01:03:32'),
(10, 'order_6294883e7b05f', 'order_JbNmQ0lh8dvm19', '100', 90, 156, 0, 'INR', 0, '2022-05-30 03:32:56', '2022-05-30 03:32:56');

-- --------------------------------------------------------

--
-- Table structure for table `papers`
--

CREATE TABLE `papers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `papers`
--

INSERT INTO `papers` (`id`, `user_id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sanskrit', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', NULL, NULL),
(2, 1, 'English', 'Using onkey* events is not reliable, since you can right-click the field and choose Paste, and this will change the field without any keyboard input.', NULL, NULL);

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Edit Bid', 'web', '2022-03-20 12:42:02', '2022-03-21 05:56:35'),
(2, 'delete bid', 'web', '2022-03-21 06:53:32', '2022-03-21 06:53:32'),
(3, 'create', 'web', '2022-03-22 03:03:34', '2022-03-22 03:03:34'),
(4, 'createPermission', 'web', '2022-03-22 03:20:52', '2022-03-22 03:20:52');

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
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(11) NOT NULL,
  `plan_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan_rate` float(8,2) NOT NULL,
  `days` tinyint(4) NOT NULL DEFAULT 1,
  `coins` int(255) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no image',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `plan_name`, `description`, `plan_rate`, `days`, `coins`, `image`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Silver Plan', '<ul>\r\n	<li>\r\n	<pre>\r\n100 requests per day</pre>\r\n	</li>\r\n	<li>200 requests per day</li>\r\n	<li>300 requests per day</li>\r\n</ul>', 2.00, 90, 700, 'http://127.0.0.1:8000/Icon\\16508848018233.png', 1, '2020-11-10 18:07:34', '2022-05-31 13:49:05', NULL),
(3, 'Gold Plan', '<pre>100 requests per day</pre>', 220.00, 45, 500, 'http://83.136.219.147/quizs/public/uploads/plan/1639137150594.png', 1, '2020-11-10 18:09:00', '2022-04-27 09:51:08', NULL),
(5, 'Platinum plan', '<p>Platinum plan1</p>', 400.00, 127, 7000, 'http://83.136.219.147/quizs/public/uploads/plan/1639139627681.png', 1, '2020-11-10 18:10:11', '2022-04-27 09:51:13', NULL),
(11, 'Test Plan', '<pre>100 requests per day</pre>', 1.00, 2, 677, 'http://83.136.219.147/quizs/public/uploads/plan/1639139740244.png', 1, '2021-12-08 12:08:03', '2022-04-27 09:51:19', NULL),
(12, 'welcome', '<p>welcome 500</p>', 10.00, 30, 700, 'http://83.136.219.147/quizs/public/uploads/plan/1639139791636.png', 1, '2021-12-10 12:32:49', '2022-04-27 09:51:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `providers`
--

CREATE TABLE `providers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organisation_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organisation_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gst_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pan_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aadhar_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gst_verified` tinyint(1) NOT NULL DEFAULT 0,
  `pan_verified` tinyint(1) NOT NULL DEFAULT 0,
  `aadhar_verified` tinyint(1) NOT NULL DEFAULT 0,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `providers`
--

INSERT INTO `providers` (`id`, `user_id`, `category_id`, `organisation_name`, `organisation_email`, `mobile`, `gst_image`, `pan_image`, `aadhar_image`, `gst_verified`, `pan_verified`, `aadhar_verified`, `address`, `created_at`, `updated_at`) VALUES
(1, 91, '[2,1]', 'puspa', 'puspa@gmail.com', '8899665544', 'http://127.0.0.1:8000/Provider/Profile\\1652639445.png', '', '', 0, 0, 0, 'nil', '2022-05-12 01:47:10', '2022-05-15 13:00:45'),
(2, 93, '[1,2,3]', 'Vishal Chaudhary', 'vishal@gmail.com', '9803405451', 'http://127.0.0.1:8000/Bidding/public/.1653651518.png', '', '', 0, 0, 0, 'nil', '2022-05-27 06:08:39', '2022-05-27 06:08:39');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', NULL, '2022-03-21 05:57:09'),
(2, 'consumer', 'web', NULL, '2022-03-21 06:48:06'),
(3, 'provider', 'web', NULL, NULL),
(5, 'creator', 'web', '2022-03-21 06:51:10', '2022-03-21 06:51:10');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `admin_email` varchar(255) DEFAULT NULL,
  `terms_and_condition` text DEFAULT NULL,
  `faq` text DEFAULT NULL,
  `privacy_policy` text DEFAULT NULL,
  `fb_link` varchar(255) DEFAULT NULL,
  `twitter_link` varchar(255) DEFAULT NULL,
  `linkedin_link` varchar(255) DEFAULT NULL,
  `insta_link` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `admin_email`, `terms_and_condition`, `faq`, `privacy_policy`, `fb_link`, `twitter_link`, `linkedin_link`, `insta_link`, `created_at`, `updated_at`) VALUES
(1, 'admin@gmail.com1', 'Help protect your website and its users with clear and fair website terms and conditions. These terms and conditions for a website set out key issues such as acceptable use, privacy, cookies, registration and passwords, intellectual property, links to other sites, termination and disclaimers of responsibility. Terms and conditions are used and necessary to protect a website owner from liability of a user relying on the information or the goods provided from the site then suffering a loss.\r\n\r\nMaking your own terms and conditions for your website is hard, not impossible, to do. It can take a few hours to few days for a person with no legal background to make. But worry no more; we are here to help you out.\r\n\r\nAll you need to do is fill up the blank spaces and then you will receive an email with your personalized terms and conditions.\r\n\r\nLooking for a Privacy Policy? Check out Privacy Policy Generator.\r\n\r\nThe accuracy of the generated document on this website is not legally binding. Use at your own risk.', '<h2>What is WheelSniffer?</h2>\r\n\r\n<p>We are the app who provides the best rates to our customers for transportation/packes and movers/tour and travels related serices in indore, ujjain, dewas, bhopal and most of the major cities in india.</p>\r\n\r\n<h2>How can I contact the WheelSniffer</h2>\r\n\r\n<p>You can e-mail us on&nbsp;<strong>wheelsniffer@gmail.com</strong>&nbsp;and place your requirements through WheelSniffer application.</p>\r\n\r\n<h2>Is my goods safe with WheelSniffer?</h2>\r\n\r\n<p>We have overall more than 5000 service providers registred with us who deal with transportation service. And also have more than 10 year of experiece in this transportation areas. So you can easlily trust us and we can provides you a best service in all over india.</p>\r\n\r\n<h2>Why would i pay money through WheelSniffer?</h2>\r\n\r\n<p>Pay money through WheelSniffer is always safe, compared to directly pay to vendors. If somehow you will face any issues with vendors related to their services or any other unwanted issues, then your money always safe with us and we only release money to vendors once you good safely transffered/delivered to mentioned destination.</p>\r\n\r\n<h2>How much fees does App Showcase?</h2>\r\n\r\n<p>We never charged a single ruppee from customer. We always charged service provider who transffred/deliver your goods through our application.</p>', '<h1>Privacy Policy</h1>\r\n\r\n<p>Updated at 2022-04-23</p>\r\n\r\n<p>WheelSniffer (&ldquo;we,&rdquo; &ldquo;our,&rdquo; or &ldquo;us&rdquo;) is committed to protecting your privacy. This Privacy Policy explains how your personal information is collected, used, and disclosed by WheelSniffer.</p>\r\n\r\n<p>This Privacy Policy applies to our website, and its associated subdomains (collectively, our &ldquo;Service&rdquo;) alongside our application, WheelSniffer. By accessing or using our Service, you signify that you have read, understood, and agree to our collection, storage, use, and disclosure of your personal information as described in this Privacy Policy and our Terms of Service. This Privacy Policy was created with&nbsp;<a href=\"https://termify.io/\" target=\"_blank\">Termify</a>.</p>\r\n\r\n<h1>Definitions and key terms</h1>\r\n\r\n<p>To help explain things as clearly as possible in this Privacy Policy, every time any of these terms are referenced, are strictly defined as:</p>\r\n\r\n<ul>\r\n	<li>Cookie: small amount of data generated by a website and saved by your web browser. It is used to identify your browser, provide analytics, remember information about you such as your language preference or login information.</li>\r\n	<li>Company: when this policy mentions &ldquo;Company,&rdquo; &ldquo;we,&rdquo; &ldquo;us,&rdquo; or &ldquo;our,&rdquo; it refers to WheelSniffer, 34, Dravid Nagar, Indore that is responsible for your information under this Privacy Policy.</li>\r\n	<li>Country: where WheelSniffer or the owners/founders of WheelSniffer are based, in this case is India</li>\r\n	<li>Customer: refers to the company, organization or person that signs up to use the WheelSniffer Service to manage the relationships with your consumers or service users.</li>\r\n	<li>Device: any internet connected device such as a phone, tablet, computer or any other device that can be used to visit WheelSniffer and use the services.</li>\r\n	<li>IP address: Every device connected to the Internet is assigned a number known as an Internet protocol (IP) address. These numbers are usually assigned in geographic blocks. An IP address can often be used to identify the location from which a device is connecting to the Internet.</li>\r\n	<li>Personnel: refers to those individuals who are employed by WheelSniffer or are under contract to perform a service on behalf of one of the parties.</li>\r\n	<li>Personal Data: any information that directly, indirectly, or in connection with other information &mdash; including a personal identification number &mdash; allows for the identification or identifiability of a natural person.</li>\r\n	<li>Service: refers to the service provided by WheelSniffer as described in the relative terms (if available) and on this platform.</li>\r\n	<li>Third-party service: refers to advertisers, contest sponsors, promotional and marketing partners, and others who provide our content or whose products or services we think may interest you.</li>\r\n	<li>Website: WheelSniffer&#39;s site, which can be accessed via this URL: www.wheelsniffer.in</li>\r\n	<li>You: a person or entity that is registered with WheelSniffer to use the Services.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1>What Information Do We Collect?</h1>\r\n\r\n<p>We collect information from you when you visit our website/app, register on our site, place an order, subscribe to our newsletter, respond to a survey or fill out a form.</p>\r\n\r\n<ul>\r\n	<li>Name / Username</li>\r\n	<li>Phone Numbers</li>\r\n	<li>Email Addresses</li>\r\n	<li>Mailing Addresses</li>\r\n	<li>Debit/credit card numbers</li>\r\n</ul>\r\n\r\n<p>We also collect information from mobile devices for a better user experience, although these features are completely optional:</p>\r\n\r\n<ul>\r\n	<li>Location (GPS): Location data helps to create an accurate representation of your interests, and this can be used to bring more targeted and relevant ads to potential customers.</li>\r\n	<li>Camera (Pictures): Granting camera permission allows the user to upload any picture straight from the website/app, you can safely deny camera permissions for this website/app.</li>\r\n	<li>Photo Gallery (Pictures): Granting photo gallery access allows the user to upload any picture from their photo gallery, you can safely deny photo gallery access for this website/app.</li>\r\n</ul>\r\n\r\n<h1>How Do We Use The Information We Collect?</h1>\r\n\r\n<p>Any of the information we collect from you may be used in one of the following ways:</p>\r\n\r\n<ul>\r\n	<li>To personalize your experience (your information helps us to better respond to your individual needs)</li>\r\n	<li>To improve our website/app (we continually strive to improve our website/app offerings based on the information and feedback we receive from you)</li>\r\n	<li>To improve customer service (your information helps us to more effectively respond to your customer service requests and support needs)</li>\r\n	<li>To process transactions</li>\r\n	<li>To administer a contest, promotion, survey or other site feature</li>\r\n	<li>To send periodic emails</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1>When does WheelSniffer use end user information from third parties?</h1>\r\n\r\n<p>WheelSniffer will collect End User Data necessary to provide the WheelSniffer services to our customers.</p>\r\n\r\n<p>End users may voluntarily provide us with information they have made available on social media websites. If you provide us with any such information, we may collect publicly available information from the social media websites you have indicated. You can control how much of your information social media websites make public by visiting these websites and changing your privacy settings.</p>', 'test@facebook.com', 'test@twitter.com', NULL, 'test@gmail.com', '2020-12-19 16:15:56', '2021-10-07 17:43:24');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `size`, `vehicle_id`, `created_at`, `updated_at`) VALUES
(1, '10 feet', 2, NULL, NULL),
(2, '15 feet', 1, NULL, NULL),
(3, '12 feet', 3, NULL, NULL),
(7, '30 feet', 4, NULL, NULL),
(8, '25 feet', 5, NULL, NULL),
(9, '50 feet', 1, NULL, NULL),
(12, '34 feet', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `splashscreens`
--

CREATE TABLE `splashscreens` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `splashscreens`
--

INSERT INTO `splashscreens` (`id`, `image`, `text`) VALUES
(1, '1647853614.png', 'summer life'),
(2, '1647853929.png', 'Tour And Travel'),
(3, '1648462666.png', 'Welcome');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('active','expired','future') NOT NULL,
  `start_date` date NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `plan_id`, `user_id`, `status`, `start_date`, `payment_status`, `created_at`, `updated_at`) VALUES
(1, 11, 91, 'active', '2022-05-13', 'active', '2022-05-13 06:44:56', '2022-05-13 06:44:56');

-- --------------------------------------------------------

--
-- Table structure for table `supports`
--

CREATE TABLE `supports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(11) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `reply` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supports`
--

INSERT INTO `supports` (`id`, `user_id`, `name`, `email`, `message`, `reply`, `created_at`, `updated_at`) VALUES
(4, 90, 'anuj', 'suuport@gmail.com', 'this is test by anuj', 'N', NULL, NULL),
(5, 90, 'anuj', 'anujbisht252@gmail.com', 'this is test by anuj', 'Y', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userbids`
--

CREATE TABLE `userbids` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `source_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source_lat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source_long` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination_lat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination_long` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `distance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ETA` int(255) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `userbids`
--

INSERT INTO `userbids` (`id`, `user_id`, `category_id`, `source_address`, `destination_address`, `source_lat`, `source_long`, `destination_lat`, `destination_long`, `distance`, `ETA`, `status`, `created_at`, `updated_at`) VALUES
(156, 90, 2, 'J2FR+84G, Saguna More, Balaji Nagar, New Tarachak, Danapur Nizamat, Patna, Bihar 801503, India', 'Flat no 304 Dhaneshwar Palace, Abhimanu Nagar, Jhakhari Mahadev, Patna, Bihar 801503, India', '65.77', '77.56', '65.77', '88.65', '45', 3000, 'payment complete', '2022-05-12', '2022-05-12 01:33:05'),
(157, 90, 2, '17, Juhi Naher, Dhaka Purwa, Naka Hindola, Kanpur, Uttar Pradesh 226020, India', 'ORYON BUSINESS INDIA PTV LTD g 69, Bhangel, Sector...', '87.111111', '98.2345', '98.2345', '77.2222', '302', 100, 'pending', '2022-05-12', '2022-05-12 01:34:40'),
(158, 90, 1, 'C8M3+7H2, Hemant Vihar Rd, Barra 2, Barra World Bank, Barra, Kanpur, Uttar Pradesh 208027, India', '37, Bhangel, Sector - 19 A, Sector - 106, Noida, Uttar Pradesh, India', '65.7709', '77.56765', '65.77768', '88.6565', '90', 90, 'pending', '2022-05-12', '2022-05-12 01:36:19'),
(159, 90, 1, '01. Abhimanu Nagar, Mustafapur, Danapur, Bihar 801503, India', 'G9PR+6C3, Bhangel, Sector - 106, Noida, Uttar Pradesh, India', '87.66', '98.3234', '87.4567', '98.6789', '76', 200, 'Inprogress', '2022-05-12', '2022-05-12 01:37:37'),
(160, 90, 3, '92HQ+Q2 Dahibhatta, Bihar, India', 'G9PR+6C3, Bhangel, Sector - 106, Noida, Uttar Pradesh, India', '65.77', '77.56', '65.77', '88.65', '87', 6000, 'Inprogress', '2022-05-12', '2022-05-12 01:39:38'),
(161, 90, 3, 'Banaras', 'Hamirpur', '65.77', '77.56', '65.77', '88.65', '87', 6000, 'pending', '2022-05-30', '2022-05-30 10:04:52'),
(164, 90, 2, 'Noida', 'Bijnor', '87.111111', '98.2345', '98.2345', '77.2222', '302', 100, 'pending', '2022-05-31', '2022-05-31 03:48:18');

-- --------------------------------------------------------

--
-- Table structure for table `userpackages`
--

CREATE TABLE `userpackages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userbid_id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_shifting` date NOT NULL,
  `end_date` date NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `flat_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `userpackages`
--

INSERT INTO `userpackages` (`id`, `order_id`, `userbid_id`, `vehicle_id`, `date_of_shifting`, `end_date`, `description`, `images`, `flat_type`, `created_at`, `updated_at`) VALUES
(1, 'WHLSNFRPA000160', 160, '1', '2022-08-23', '2022-08-22', 'We are going to shift from delhi to chandigarh', '[\"http:\\\\127.0.0.1:8000\\Flat\\\\165233937856.png\",\"http:\\\\127.0.0.1:8000\\Flat\\\\16523393796.png\"]', '1', '2022-05-12 01:39:39', '2022-05-12 01:39:39'),
(2, 'WHLSNFRPA000161', 161, '1', '2022-08-23', '2022-12-22', 'We are going to shift from delhi to chandigarh', 'http://127.0.0.1:8000/Flat\\165392489221.png,http://127.0.0.1:8000/Flat\\165392489286.png', '1', '2022-05-30 10:04:52', '2022-05-30 10:04:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` tinyint(10) DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp_expiration_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified_otp` tinyint(1) NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firebase_token` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_verified` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `mobile`, `email`, `otp`, `otp_expiration_time`, `verified_otp`, `status`, `email_verified_at`, `password`, `remember_token`, `firebase_token`, `token`, `user_verified`, `created_at`, `updated_at`) VALUES
(1, 'admin', 1, '9876543211', 'admin@gmail.com', '', '2022-03-10 11:24:40', 0, '1', NULL, '$2y$10$BXVZ8XaV8nBsQz5DzK5/iuWZBdu5lJLBx2FQDYlfu8X.0G2DPrSoq', NULL, '', '', 0, '2022-02-28 08:23:42', '2022-02-28 08:23:42'),
(90, 'Anuj', 2, '8826817930', 'anuj@gmail.com', '149328', '1653890028', 0, '1', NULL, '$2y$10$zzADavKocp8vTI.TolRqqefsO17n56dId8QSsIyA1fe86vua5g/gy', 'eCscnAqnQ3Ce99Dug--MZh:APA91bEc0nb3iggSRKMf816h-shAH0ZUei_mVt1i5-cutG_OHACLEX_J9MpnWFgLn7X8xxJ1Y0CR6pxK3UGy9eFL7BiH9qTCmKsO09n0llTtYd2PdvKlfMPr6xN5ovUtjEA3GPTF6Nr9', 'eCscnAqnQ3Ce99Dug--MZh:APA91bEc0nb3iggSRKMf816h-shAH0ZUei_mVt1i5-cutG_OHACLEX_J9MpnWFgLn7X8xxJ1Y0CR6pxK3UGy9eFL7BiH9qTCmKsO09n0llTtYd2PdvKlfMPr6xN5ovUtjEA3GPTF6Nr9', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE2NTM4OTAwNTMsImV4cCI6MTY1NjQ4MjA1MywibmJmIjoxNjUzODkwMDUzLCJqdGkiOiJoSXRHcEpORkpweTlCRVRMIiwic3ViIjo5MCwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.hto0A_8Ai4UJE3mFJRqr3BceW0BqPZsnpnkUrDwfCQg', 1, '2022-05-12 01:31:06', '2022-05-30 00:24:13'),
(91, 'puspa', 3, '8899665544', 'puspa@gmail.com', '850705', '1653889863', 0, '1', NULL, '$2y$10$.4D2WpNMhZHbEiFmksJAlOc391vhaPBAwHfinVCeF9vX6Q6S1ecEa', 'cMJ0iHVjTzeEsw6lFULBSe:APA91bHr9NRlvAp_sYAqAnzwWyeOgQwLoOsjEoDOByCCdcjjF6Crqso4VVxhzP9nMasqKiefHAHWcqHMV2deiymOop9Y09DZ7E8juDj1qKHvEsKkqQkWvwBQTIhufKw-jLkxcUBz-9pt', 'cMJ0iHVjTzeEsw6lFULBSe:APA91bHr9NRlvAp_sYAqAnzwWyeOgQwLoOsjEoDOByCCdcjjF6Crqso4VVxhzP9nMasqKiefHAHWcqHMV2deiymOop9Y09DZ7E8juDj1qKHvEsKkqQkWvwBQTIhufKw-jLkxcUBz-9pt', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC92MVwvbG9naW4iLCJpYXQiOjE2NTM4OTA1MzIsImV4cCI6MTY1NjQ4MjUzMiwibmJmIjoxNjUzODkwNTMyLCJqdGkiOiIwN3NhWnFwYnVuclBMZmwwIiwic3ViIjo5MSwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.BB_j6Jx_AV6iIEEQtFbn8jRIrhw5hwHO97u2ZoyQ9F0', 1, '2022-05-12 01:47:09', '2022-05-30 00:32:12'),
(92, 'Tanvi Singh', 2, '8826817939', 'tanvisingh56@gmail.com', '804489', NULL, 0, '1', NULL, '$2y$10$oE9pR.y1TPYb1QM4FTUpmeIGuDJ7lBaXNJcEoge1q0cy0HKiQ/Dmu', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC92MVwvY29uc3VtZXJSZWdpc3RlciIsImlhdCI6MTY1MzY0ODUyOSwiZXhwIjoxNjUzNjUyMTI5LCJuYmYiOjE2NTM2NDg1MjksImp0aSI6IjI2eWVjdXlKdkgwZ1RvQjYiLCJzdWIiOjkyLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.xWII9d-TCwdVCcjIw0gTzW5RYv9ENLeUOK8Ex_ec0Gs', 'fduqPlnoTHCAB8L8Bjr8Bc:APA91bGkGiYrxmEZZhDO7n_OARSpf4uf1MWSRTfItYSekx4f2AE42r-jzMzCj-lyNm_MhXJztHpgRfND29u0QUUxpd_Ef14JHxwMfw6LijKbY5umrPQrY1JF9DTaY6ko7avf1WbGK5LJ', NULL, 1, '2022-05-27 05:18:46', '2022-05-27 05:18:46'),
(93, 'Vishal Chaudhary', 3, '9803405451', 'vishal@gmail.com', '979327', NULL, 0, '1', NULL, '$2y$10$j7tRf6qoF65auAKxDkb6gONlxmitSMZGIunHo02tGUvDtVqYSRMli', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC92MVwvcHJvdmlkZXJSZWdpc3RlciIsImlhdCI6MTY1MzY1MTUxOCwiZXhwIjoxNjUzNjU1MTE4LCJuYmYiOjE2NTM2NTE1MTgsImp0aSI6Im0yUDdNSUJSZjg2SkkybEUiLCJzdWIiOjkzLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.zaTYCdU35fs7X5nJT8-ABAH_59GHsXQo1JWZsJDYCq8', 'll', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC92MVwvcHJvdmlkZXJSZWdpc3RlciIsImlhdCI6MTY1MzY1MTUxOCwiZXhwIjoxNjUzNjU1MTE4LCJuYmYiOjE2NTM2NTE1MTgsImp0aSI6Im0yUDdNSUJSZjg2SkkybEUiLCJzdWIiOjkzLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.zaTYCdU35fs7X5nJT8-ABAH_59GHsXQo1JWZsJDYCq8', 1, '2022-05-27 06:08:38', '2022-05-27 06:08:38');

-- --------------------------------------------------------

--
-- Table structure for table `usertours`
--

CREATE TABLE `usertours` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userbid_id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_travel` date NOT NULL,
  `end_date` date NOT NULL,
  `number_of_passenger` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usertours`
--

INSERT INTO `usertours` (`id`, `order_id`, `vehicle_id`, `userbid_id`, `description`, `date_of_travel`, `end_date`, `number_of_passenger`, `created_at`, `updated_at`) VALUES
(1, 'WHLSNFRTO000158', '1', 158, 'End Date Added', '2022-08-23', '2022-09-23', '4', '2022-05-12 01:36:19', '2022-05-12 01:36:19'),
(2, 'WHLSNFRTO000159', '1', 159, 'End Date Added', '2022-08-23', '2022-09-23', '4', '2022-05-12 01:37:37', '2022-05-12 01:37:37');

-- --------------------------------------------------------

--
-- Table structure for table `usertransports`
--

CREATE TABLE `usertransports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userbid_id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_size_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_bodytype` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loading_and_unloading` tinyint(4) NOT NULL,
  `shifting_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usertransports`
--

INSERT INTO `usertransports` (`id`, `order_id`, `userbid_id`, `vehicle_size_id`, `description`, `weight`, `vehicle_bodytype`, `loading_and_unloading`, `shifting_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 'WHLSNFRTRA000156', 156, '1', 'End Date Added', '23', 'half', 1, '2022-06-22', '2022-08-22', '2022-05-12 01:33:05', '2022-05-12 01:33:05'),
(2, 'WHLSNFRTRA000157', 157, '7', 'End Date Added', '23', 'half', 1, '2022-06-22', '2022-08-22', '2022-05-12 01:34:40', '2022-05-12 01:34:40'),
(5, 'WHLSNFRTRA000164', 164, '7', 'End Date Added', '23', 'half', 1, '2022-06-22', '2022-08-22', '2022-05-31 03:48:18', '2022-05-31 03:48:18');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `per_KM` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `vehicle_type_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `name`, `vehicle_icon`, `per_KM`, `created_at`, `updated_at`, `category_id`, `vehicle_type_id`) VALUES
(1, 'Mini Bus', '1647853614.png', '22', NULL, NULL, 1, '2'),
(2, 'Truck5', '1647853832.png', '50', NULL, NULL, 2, '3'),
(3, 'Truck3', '1647853856.png', '55', NULL, NULL, 3, '3'),
(4, 'Bus1', '1647853911.png', '35', NULL, NULL, 1, '2'),
(5, 'Full Decker Bus', '1647853929.png', '22', '2022-03-17 06:56:58', '2022-03-17 06:56:58', 1, '2'),
(6, 'Bus', '1648462666.png', '45', '2022-03-28 10:17:46', '2022-03-28 10:17:46', 1, '2'),
(7, 'Mini', '1648630255.jpg', '40', '2022-03-30 08:50:55', '2022-03-30 08:50:55', 2, '2'),
(8, 'Example1', '1653468378.jpg', '30', '2022-05-25 08:46:18', '2022-05-25 08:46:18', 2, '0');

-- --------------------------------------------------------

--
-- Table structure for table `vehicletypes`
--

CREATE TABLE `vehicletypes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicletypes`
--

INSERT INTO `vehicletypes` (`id`, `type`) VALUES
(1, 'Car'),
(2, 'Bus'),
(3, 'Truck');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `points` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `user_id`, `points`, `created_at`, `updated_at`) VALUES
(1, '91', 95, NULL, NULL),
(2, '93', 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wallet_history`
--

CREATE TABLE `wallet_history` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `point` int(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applybids`
--
ALTER TABLE `applybids`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`userbids_id`),
  ADD KEY `name1` (`provider_id`);

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
-- Indexes for table `flats`
--
ALTER TABLE `flats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `papers`
--
ALTER TABLE `papers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `papers_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`plan_name`);

--
-- Indexes for table `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `providers_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `splashscreens`
--
ALTER TABLE `splashscreens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supports`
--
ALTER TABLE `supports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `userbids`
--
ALTER TABLE `userbids`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userbids_user_id_foreign` (`user_id`),
  ADD KEY `userbids_category_id_foreign` (`category_id`);

--
-- Indexes for table `userpackages`
--
ALTER TABLE `userpackages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userpackages_userbids_id_foreign` (`userbid_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `usertours`
--
ALTER TABLE `usertours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usertours_userbids_id_foreign` (`userbid_id`);

--
-- Indexes for table `usertransports`
--
ALTER TABLE `usertransports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userbids` (`userbid_id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test` (`category_id`);

--
-- Indexes for table `vehicletypes`
--
ALTER TABLE `vehicletypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_history`
--
ALTER TABLE `wallet_history`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applybids`
--
ALTER TABLE `applybids`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flats`
--
ALTER TABLE `flats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `papers`
--
ALTER TABLE `papers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `providers`
--
ALTER TABLE `providers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `splashscreens`
--
ALTER TABLE `splashscreens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `supports`
--
ALTER TABLE `supports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `userbids`
--
ALTER TABLE `userbids`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `userpackages`
--
ALTER TABLE `userpackages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `usertours`
--
ALTER TABLE `usertours`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usertransports`
--
ALTER TABLE `usertransports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vehicletypes`
--
ALTER TABLE `vehicletypes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wallet_history`
--
ALTER TABLE `wallet_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applybids`
--
ALTER TABLE `applybids`
  ADD CONSTRAINT `name1` FOREIGN KEY (`provider_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `papers`
--
ALTER TABLE `papers`
  ADD CONSTRAINT `papers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `providers`
--
ALTER TABLE `providers`
  ADD CONSTRAINT `providers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `supports`
--
ALTER TABLE `supports`
  ADD CONSTRAINT `supports_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `userbids`
--
ALTER TABLE `userbids`
  ADD CONSTRAINT `userbids_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `userbids_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `userpackages`
--
ALTER TABLE `userpackages`
  ADD CONSTRAINT `userpackages_userbids_id_foreign` FOREIGN KEY (`userbid_id`) REFERENCES `userbids` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `test` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
