-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2026 at 07:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` enum('draft','published','archived') NOT NULL DEFAULT 'draft',
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `type`, `content`, `image`, `created_at`, `updated_at`) VALUES
(14, 'Birthday ni Kapitan', 'Events', 'Lahat ay imbitado', 'community_images/qF45z6QMUpT9c9ZLn2jU1eHMtS68Zq7IMQQtXkVG.png', '2026-10-30 04:57:22', '2026-10-30 04:57:22'),
(15, 'May Ayuda', 'Announcement', 'Pumila kayo sa barangay', NULL, '2026-10-30 04:57:46', '2026-10-30 04:57:46'),
(16, 'amsss', 'Announcement', 'sjududud', NULL, '2026-10-30 05:51:59', '2026-10-30 05:51:59'),
(17, 'dihcjbdjwsnx', 'Events', 'jcsakanb', NULL, '2026-10-30 05:52:13', '2026-10-30 05:52:13'),
(18, 'Bumili na tayo ng balde', 'Announcement', 'Baldeng Utak', 'community_images/hmirwp5esRfJP8NomGu5Jgrd716sfSd6R0hOP9gi.png', '2026-10-30 16:48:04', '2026-10-30 20:09:31'),
(19, 'xzcsx', 'Announcement', 'zxcxs', 'community_images/oVmyT1MkLBBsQPJ3ndXroKoEscPfRocauoSSzQ7D.png', '2026-10-30 20:17:10', '2026-10-30 20:17:10');

-- --------------------------------------------------------

--
-- Table structure for table `announcement_category`
--

CREATE TABLE `announcement_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `document_request`
--

CREATE TABLE `document_request` (
  `id` int(10) UNSIGNED NOT NULL,
  `reference_number` varchar(255) NOT NULL,
  `resident_id` int(10) UNSIGNED NOT NULL,
  `document_type` int(10) UNSIGNED NOT NULL,
  `assigned_to` int(10) UNSIGNED DEFAULT NULL,
  `decided_by` int(10) UNSIGNED DEFAULT NULL,
  `status` enum('pending','approved','rejected','released') NOT NULL DEFAULT 'pending',
  `purpose` text NOT NULL,
  `description_remarks` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `released_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `requested_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `decided_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `document_requests`
--

CREATE TABLE `document_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `resident_name` varchar(255) DEFAULT NULL,
  `document_type` varchar(255) NOT NULL,
  `purpose` text DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'In Progress',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `document_requests`
--

INSERT INTO `document_requests` (`id`, `user_id`, `resident_name`, `document_type`, `purpose`, `status`, `created_at`, `updated_at`) VALUES
(16, 5, 'Juan Dela Cruz', 'Certificate of Indigency', 'Para sa anak ko', 'In Progress', '2026-10-29 18:47:02', '2026-10-29 18:48:34'),
(21, 4, 'Maria Juana', 'Certificate of Indigency', 'asds', 'In Progress', '2026-10-30 05:53:00', '2026-10-30 05:53:00'),
(22, 4, 'Maria Juana', 'Other Barangay Document', 'Sedula', 'Received', '2026-10-30 05:53:09', '2026-10-30 05:59:02'),
(23, 4, 'Maria Juana', 'Certificate of Good Moral Character', 'Para sa anak ko', 'In Progress', '2026-10-30 05:53:20', '2026-10-30 20:02:07');

-- --------------------------------------------------------

--
-- Table structure for table `document_requirements`
--

CREATE TABLE `document_requirements` (
  `id` int(10) UNSIGNED NOT NULL,
  `document_type` int(10) UNSIGNED NOT NULL,
  `requirement_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `is_required` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documment_type`
--

CREATE TABLE `documment_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_verification_tokens`
--

CREATE TABLE `email_verification_tokens` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `token_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `expired_at` timestamp NULL DEFAULT NULL,
  `used_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `starts_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `ends_at` timestamp NULL DEFAULT NULL,
  `status` enum('scheduled','cancelled','completed') NOT NULL DEFAULT 'scheduled',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `identity_documents`
--

CREATE TABLE `identity_documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `document_type` varchar(255) NOT NULL,
  `files` varchar(255) NOT NULL,
  `reviewed_by` int(10) UNSIGNED NOT NULL,
  `reviewed_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incident_attachments`
--

CREATE TABLE `incident_attachments` (
  `id` int(10) UNSIGNED NOT NULL,
  `incident_id` int(10) UNSIGNED NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `original_filename` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incident_categories`
--

CREATE TABLE `incident_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incident_reports`
--

CREATE TABLE `incident_reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reference_no` varchar(255) DEFAULT NULL,
  `incident_type` varchar(255) DEFAULT NULL,
  `zone` varchar(255) DEFAULT NULL,
  `incident_date` datetime DEFAULT NULL,
  `reference_number` int(10) UNSIGNED NOT NULL,
  `reported_by` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `priority` enum('low','medium','high','critical') NOT NULL DEFAULT 'medium',
  `status` varchar(50) DEFAULT 'New',
  `assigned_to` int(10) UNSIGNED DEFAULT NULL,
  `reported_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `resolve_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `incident_reports`
--

INSERT INTO `incident_reports` (`id`, `user_id`, `reference_no`, `incident_type`, `zone`, `incident_date`, `reference_number`, `reported_by`, `category_id`, `description`, `photo`, `location`, `priority`, `status`, `assigned_to`, `reported_at`, `resolve_at`, `created_at`, `updated_at`) VALUES
(15, 4, NULL, 'Flood', 'Zone 2', NULL, 1793368784, 4, 1, 'Sa bahay namin', 'incidents/68EGmKQmyozmopCm5iXEKTNLDooDN3AwnzPvYj9H.png', 'Zone 2', 'medium', 'Resolved', NULL, '2026-10-30 13:59:44', NULL, '2026-10-30 05:59:44', '2026-10-30 19:14:01'),
(16, 4, NULL, 'Fire', 'Zone 2', NULL, 1793368792, 4, 1, 'dfvfdesdc', NULL, 'Zone 2', 'medium', 'New', NULL, '2026-10-30 13:59:52', NULL, '2026-10-30 05:59:52', '2026-10-30 05:59:52'),
(17, 4, NULL, 'Earthquake', 'Zone 1', NULL, 1793368802, 4, 1, 'sxdcvcdc', NULL, 'Zone 1', 'medium', 'Verified', NULL, '2026-10-30 14:00:02', NULL, '2026-10-30 06:00:02', '2026-10-30 19:13:58'),
(18, 4, NULL, 'Theft', 'Zone 4', NULL, 1793368820, 4, 1, 'xdsccxccs', NULL, 'Zone 4', 'medium', 'New', NULL, '2026-10-30 14:00:20', NULL, '2026-10-30 06:00:20', '2026-10-30 06:00:20'),
(19, 5, NULL, 'Flood', 'Zone 2', NULL, 1793407719, 5, 1, 'Bahala na', 'incidents/wKlm2tLgJxQzcXlxdPrPkXOoYXUBkhhmwbxdnhpX.png', 'Zone 2', 'medium', 'Verified', NULL, '2026-10-31 00:48:39', NULL, '2026-10-30 16:48:39', '2026-10-30 19:14:04');

-- --------------------------------------------------------

--
-- Table structure for table `incident_status_history`
--

CREATE TABLE `incident_status_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `incident_id` int(10) UNSIGNED NOT NULL,
  `changed_by` int(10) UNSIGNED NOT NULL,
  `old_status` varchar(255) NOT NULL,
  `new_status` varchar(255) NOT NULL,
  `remarks` text NOT NULL,
  `changed_at` timestamp NOT NULL DEFAULT current_timestamp()
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
(1, '0001_01_01_000000_create_roles_table', 1),
(2, '0001_01_01_000000_create_users_table', 1),
(3, '0001_01_01_000001_create_cache_table', 1),
(4, '0001_01_01_000002_create_jobs_table', 1),
(5, '2026_10_22_120000_create_announcement_category_table', 1),
(6, '2026_10_22_121000_create_announcement_table', 1),
(7, '2026_10_22_122000_create_events_table', 1),
(8, '2026_10_22_123000_add_user_foreign_key_to_sessions_table', 1),
(9, '2026_10_22_124000_create_system_settings_table', 1),
(10, '2026_10_22_125000_create_documment_type_table', 1),
(11, '2026_10_22_125500_create_document_requirements_table', 1),
(12, '2026_10_22_126000_create_document_request_table', 1),
(13, '2026_10_24_000000_create_request_status_history_table', 1),
(14, '2026_10_24_000100_create_request_attachments_table', 1),
(15, '2026_10_24_000200_create_resident_profile_table', 1),
(16, '2026_10_24_000300_create_identity_documents_table', 1),
(17, '2026_10_24_000400_create_email_verification_tokens_table', 1),
(18, '2026_10_24_000500_create_incident_categories_table', 1),
(19, '2026_10_24_000600_create_incident_reports_table', 1),
(20, '2026_10_24_000700_create_incident_status_history_table', 1),
(21, '2026_10_24_000800_create_incident_attachments_table', 1),
(22, '2026_10_25_121338_create_settings_table', 1),
(23, '2026_10_26_091553_create_resident_document_requests_table', 1),
(24, '2026_10_27_015308_add_username_to_users_table', 1),
(25, '2026_10_27_021805_create_posts_table', 1),
(26, '2026_10_27_121352_add_user_id_to_resident_document_requests_table', 2),
(27, '2026_10_27_130023_add_resident_columns_to_incident_reports_table', 3),
(28, '2026_10_27_134555_create_resident_pure_incident_reports_table', 4),
(29, '2026_10_27_144937_create_announcements_table', 5),
(30, '2026_10_28_001123_create_resident_pure_reports_table', 6);

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
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request_attachments`
--

CREATE TABLE `request_attachments` (
  `id` int(10) UNSIGNED NOT NULL,
  `request_id` int(10) UNSIGNED NOT NULL,
  `requirement_id` int(10) UNSIGNED NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `original_filename` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request_status_history`
--

CREATE TABLE `request_status_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `request_id` int(10) UNSIGNED NOT NULL,
  `changed_by` int(10) UNSIGNED NOT NULL,
  `old_status` varchar(255) NOT NULL,
  `new_status` varchar(255) NOT NULL,
  `remarks` text NOT NULL,
  `changed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resident_document_requests`
--

CREATE TABLE `resident_document_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reference_no` varchar(255) NOT NULL,
  `document_type` varchar(255) NOT NULL,
  `purpose` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'In Progress',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resident_profile`
--

CREATE TABLE `resident_profile` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `birth_date` date NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `resident_address` text NOT NULL,
  `residency_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resident_pure_incident_reports`
--

CREATE TABLE `resident_pure_incident_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `reference_no` varchar(255) NOT NULL,
  `incident_type` varchar(255) NOT NULL,
  `zone` varchar(255) NOT NULL,
  `incident_date` datetime NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'New',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `resident_pure_incident_reports`
--

INSERT INTO `resident_pure_incident_reports` (`id`, `user_id`, `reference_no`, `incident_type`, `zone`, `incident_date`, `description`, `photo`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 'IDT-001', 'Fire', 'Zone 2', '2026-10-27 21:48:00', 'Malapit sa bahay ni kapitan', NULL, 'New', '2026-10-27 05:48:56', '2026-10-27 06:11:42'),
(2, 4, 'IDT-002', 'Typhoon', 'Zone 1', '2026-10-27 21:57:00', 'Babaha sa lugar ninyo', NULL, 'New', '2026-10-27 05:57:45', '2026-10-27 06:08:36'),
(3, 4, 'IDT-003', 'Earthquake', 'Zone 4', '2026-10-27 22:12:00', 'Gumuho ang Pader', 'incident_photos/w4qLZ8ntqAemRQ6gyvYV1GbmGoeiE1grUOpZLEWk.png', 'New', '2026-10-27 06:12:15', '2026-10-27 16:01:37');

-- --------------------------------------------------------

--
-- Table structure for table `resident_pure_reports`
--

CREATE TABLE `resident_pure_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `report_id` varchar(255) DEFAULT NULL,
  `reporter_name` varchar(255) DEFAULT NULL,
  `zone` varchar(255) NOT NULL DEFAULT 'Zone 1',
  `incident_type` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'New',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, '');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('vmddMcmodQoROfs07st681JGoD1eIfhVf75pVnsh', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.144.0 Chrome/150.0.7871.250 Electron/43.8.3 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWHczYW1JRTUwc1BCQVFzaThHWFZoRXg2dmRUeWd3U0xnSWo5MnpZRiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1793428763);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'barangay_name', 'Barangay Sibul', '2026-10-30 21:25:29', '2026-10-30 21:39:30'),
(2, 'municipality_province', 'San Miguel, Bulacan', '2026-10-30 21:25:29', '2026-10-30 21:25:29'),
(3, 'barangay_address', 'Provincial Road, Zone 1 Propr, Sibul, San Miguel, Bulacan', '2026-10-30 21:25:29', '2026-10-30 21:25:29'),
(4, 'hotline_contact', '0912-345-6789', '2026-10-30 21:25:29', '2026-10-30 21:25:29'),
(5, 'official_email', 'sibul.gov@gmail.com', '2026-10-30 21:25:29', '2026-10-30 21:25:29'),
(6, 'clearance_fee', 'Php 20.00', '2026-10-30 21:39:37', '2026-10-30 21:39:45'),
(7, 'indigency_fee', 'FREE (PHP 0)', '2026-10-30 21:39:37', '2026-10-30 21:39:37'),
(8, 'permit_fee', 'Php 100.00', '2026-10-30 21:39:37', '2026-10-30 21:39:37'),
(9, 'about_page_data', '{\"profile_title\":\"Barangay Sibul, San Miguel, Bulacan\",\"profile_desc\":\"Barangay Sibul is a historic and progressive agricultural community in San Miguel, Bulacan. Renowned for its natural springs, eco-tourism potential, and vibrant citizenry, eBarangay serves as its official modern digital platform.\",\"vision\":\"A globally engaged higher education, institution of agriculture and allied disciplines\",\"mission\":\"Provide excellent instructions, conduct relevant research and foster community engagement that produce highly competent graduates necessary for the development of the country\",\"officials\":[{\"name\":\"Kap Udeng TV\",\"title\":\"Barangay Chairman\",\"photo\":\"officials\\/gTBy4DZVp9Zv7FmSxFQic7Gu6bpcRcR2T1wVVZ8x.png\"},{\"name\":\"Mara Ganda\",\"title\":\"Barangay Secretary\",\"photo\":\"\"},{\"name\":\"Jennie Lyn\",\"title\":\"Barangay Treasurer\",\"photo\":\"\"},{\"name\":\"Pablo Cafe\",\"title\":\"Tanod\",\"photo\":\"\"}]}', '2026-10-30 21:55:10', '2026-10-30 22:02:40');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `setting_key` varchar(255) NOT NULL,
  `setting_value` text NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT 'Resident',
  `password` varchar(255) NOT NULL,
  `user_account` varchar(255) NOT NULL,
  `account_status` enum('pending','active','inactive','suspended') NOT NULL DEFAULT 'pending',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `role_id`, `name`, `email`, `role`, `password`, `user_account`, `account_status`, `email_verified_at`, `created_at`, `updated_at`) VALUES
(1, 'admin', 1, 'System Admin', 'admin@sibul.com', 'Admin', '$2y$12$KQBW7HNyD60O4BhP3u375ezZyx/tPeayIM3jhGw4we0HE7m5p.HHy', 'admin', 'pending', NULL, '2026-10-26 22:41:40', '2026-10-30 21:41:17'),
(4, 'mariajuana', 1, 'Maria Juana', 'mamamopink@email.com', 'Resident', '$2y$12$A3V65gV9u7aHyF9/jLS2suQ/yLIeaOEliIv2z.I9u0OsXTpcDkyri', 'mamamopink@email.com', 'pending', NULL, '2026-10-26 22:50:03', '2026-10-26 22:50:03'),
(5, 'juandl', 1, 'Juan Dela Cruz', 'papakoblue@email.com', 'Resident', '$2y$12$v0wMcrAIssRLqAqBLG0G5uJlhHy16JnBSQJD.lVKIOdWyTnjjOSGe', 'papakoblue@email.com', 'pending', NULL, '2026-10-26 22:51:36', '2026-10-26 22:51:36'),
(16, 'josejose', NULL, 'Joseph San Jose', 'josephsanjose@email.com', 'Resident', '$2y$12$PwCcrMwnsuBXinKW/glFOODeLCW./E4jE8fDqrpPt/C2iVb8Na/te', 'josephsanjose@email.com', 'pending', NULL, '2026-10-30 22:35:13', '2026-10-30 22:35:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `announcement_category_id_foreign` (`category_id`),
  ADD KEY `announcement_created_by_foreign` (`created_by`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcement_category`
--
ALTER TABLE `announcement_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `announcement_category_name_unique` (`name`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `document_request`
--
ALTER TABLE `document_request`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `document_request_reference_number_unique` (`reference_number`),
  ADD KEY `document_request_resident_id_foreign` (`resident_id`),
  ADD KEY `document_request_document_type_foreign` (`document_type`),
  ADD KEY `document_request_assigned_to_foreign` (`assigned_to`),
  ADD KEY `document_request_decided_by_foreign` (`decided_by`);

--
-- Indexes for table `document_requests`
--
ALTER TABLE `document_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document_requirements`
--
ALTER TABLE `document_requirements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `document_requirements_document_type_foreign` (`document_type`);

--
-- Indexes for table `documment_type`
--
ALTER TABLE `documment_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `documment_type_name_unique` (`name`);

--
-- Indexes for table `email_verification_tokens`
--
ALTER TABLE `email_verification_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email_verification_tokens_user_id_foreign` (`user_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_created_by_foreign` (`created_by`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `identity_documents`
--
ALTER TABLE `identity_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `identity_documents_user_id_foreign` (`user_id`),
  ADD KEY `identity_documents_reviewed_by_foreign` (`reviewed_by`);

--
-- Indexes for table `incident_attachments`
--
ALTER TABLE `incident_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incident_attachments_incident_id_foreign` (`incident_id`);

--
-- Indexes for table `incident_categories`
--
ALTER TABLE `incident_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `incident_categories_name_unique` (`name`);

--
-- Indexes for table `incident_reports`
--
ALTER TABLE `incident_reports`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `incident_reports_reference_number_unique` (`reference_number`),
  ADD KEY `incident_reports_reported_by_foreign` (`reported_by`),
  ADD KEY `incident_reports_category_id_foreign` (`category_id`),
  ADD KEY `incident_reports_assigned_to_foreign` (`assigned_to`);

--
-- Indexes for table `incident_status_history`
--
ALTER TABLE `incident_status_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incident_status_history_incident_id_foreign` (`incident_id`),
  ADD KEY `incident_status_history_changed_by_foreign` (`changed_by`);

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
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_attachments`
--
ALTER TABLE `request_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_attachments_request_id_uploaded_at_index` (`request_id`,`uploaded_at`),
  ADD KEY `request_attachments_requirement_id_index` (`requirement_id`);

--
-- Indexes for table `request_status_history`
--
ALTER TABLE `request_status_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_status_history_changed_by_foreign` (`changed_by`),
  ADD KEY `request_status_history_request_id_changed_at_index` (`request_id`,`changed_at`);

--
-- Indexes for table `resident_document_requests`
--
ALTER TABLE `resident_document_requests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `resident_document_requests_reference_no_unique` (`reference_no`);

--
-- Indexes for table `resident_profile`
--
ALTER TABLE `resident_profile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `resident_profile_user_id_unique` (`user_id`);

--
-- Indexes for table `resident_pure_incident_reports`
--
ALTER TABLE `resident_pure_incident_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resident_pure_reports`
--
ALTER TABLE `resident_pure_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_role_unique` (`role`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `system_settings_setting_key_unique` (`setting_key`),
  ADD KEY `system_settings_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `announcement_category`
--
ALTER TABLE `announcement_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `document_request`
--
ALTER TABLE `document_request`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `document_requests`
--
ALTER TABLE `document_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `document_requirements`
--
ALTER TABLE `document_requirements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `documment_type`
--
ALTER TABLE `documment_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_verification_tokens`
--
ALTER TABLE `email_verification_tokens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `identity_documents`
--
ALTER TABLE `identity_documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incident_attachments`
--
ALTER TABLE `incident_attachments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incident_categories`
--
ALTER TABLE `incident_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incident_reports`
--
ALTER TABLE `incident_reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `incident_status_history`
--
ALTER TABLE `incident_status_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request_attachments`
--
ALTER TABLE `request_attachments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request_status_history`
--
ALTER TABLE `request_status_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resident_document_requests`
--
ALTER TABLE `resident_document_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `resident_profile`
--
ALTER TABLE `resident_profile`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resident_pure_incident_reports`
--
ALTER TABLE `resident_pure_incident_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `resident_pure_reports`
--
ALTER TABLE `resident_pure_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcement`
--
ALTER TABLE `announcement`
  ADD CONSTRAINT `announcement_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `announcement_category` (`id`),
  ADD CONSTRAINT `announcement_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `document_request`
--
ALTER TABLE `document_request`
  ADD CONSTRAINT `document_request_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `document_request_decided_by_foreign` FOREIGN KEY (`decided_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `document_request_document_type_foreign` FOREIGN KEY (`document_type`) REFERENCES `documment_type` (`id`),
  ADD CONSTRAINT `document_request_resident_id_foreign` FOREIGN KEY (`resident_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `document_requirements`
--
ALTER TABLE `document_requirements`
  ADD CONSTRAINT `document_requirements_document_type_foreign` FOREIGN KEY (`document_type`) REFERENCES `documment_type` (`id`);

--
-- Constraints for table `email_verification_tokens`
--
ALTER TABLE `email_verification_tokens`
  ADD CONSTRAINT `email_verification_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `identity_documents`
--
ALTER TABLE `identity_documents`
  ADD CONSTRAINT `identity_documents_reviewed_by_foreign` FOREIGN KEY (`reviewed_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `identity_documents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `incident_attachments`
--
ALTER TABLE `incident_attachments`
  ADD CONSTRAINT `incident_attachments_incident_id_foreign` FOREIGN KEY (`incident_id`) REFERENCES `incident_reports` (`id`);

--
-- Constraints for table `incident_reports`
--
ALTER TABLE `incident_reports`
  ADD CONSTRAINT `incident_reports_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `incident_reports_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `incident_categories` (`id`),
  ADD CONSTRAINT `incident_reports_reported_by_foreign` FOREIGN KEY (`reported_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `incident_status_history`
--
ALTER TABLE `incident_status_history`
  ADD CONSTRAINT `incident_status_history_changed_by_foreign` FOREIGN KEY (`changed_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `incident_status_history_incident_id_foreign` FOREIGN KEY (`incident_id`) REFERENCES `incident_reports` (`id`);

--
-- Constraints for table `request_attachments`
--
ALTER TABLE `request_attachments`
  ADD CONSTRAINT `request_attachments_request_id_foreign` FOREIGN KEY (`request_id`) REFERENCES `document_request` (`id`),
  ADD CONSTRAINT `request_attachments_requirement_id_foreign` FOREIGN KEY (`requirement_id`) REFERENCES `document_requirements` (`id`);

--
-- Constraints for table `request_status_history`
--
ALTER TABLE `request_status_history`
  ADD CONSTRAINT `request_status_history_changed_by_foreign` FOREIGN KEY (`changed_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `request_status_history_request_id_foreign` FOREIGN KEY (`request_id`) REFERENCES `document_request` (`id`);

--
-- Constraints for table `resident_profile`
--
ALTER TABLE `resident_profile`
  ADD CONSTRAINT `resident_profile_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD CONSTRAINT `system_settings_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
