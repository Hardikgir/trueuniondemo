-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 01, 2025 at 10:03 AM
-- Server version: 11.8.3-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u337050398_trueunion`
--

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
-- Table structure for table `memberships`
--

CREATE TABLE `memberships` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `visits_allowed` int(11) NOT NULL,
  `features` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `memberships`
--

INSERT INTO `memberships` (`id`, `name`, `price`, `visits_allowed`, `features`, `created_at`, `updated_at`) VALUES
(1, 'Bronze', 250, 10, NULL, '2025-08-29 06:05:01', '2025-08-29 06:05:01'),
(2, 'Silver', 500, 25, NULL, '2025-08-29 06:05:01', '2025-08-29 06:05:01'),
(3, 'Gold', 750, 55, NULL, '2025-08-29 06:05:01', '2025-08-29 06:05:01'),
(4, 'Platinum', 999, 99, 'Get Featured on Home Page\r\nPriority Support', '2025-09-02 23:48:29', '2025-09-02 23:48:36');

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
-- Table structure for table `profile_visits`
--

CREATE TABLE `profile_visits` (
  `id` int(11) NOT NULL,
  `visitor_id` bigint(20) UNSIGNED NOT NULL,
  `visited_id` bigint(20) UNSIGNED NOT NULL,
  `visited_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profile_visits`
--

INSERT INTO `profile_visits` (`id`, `visitor_id`, `visited_id`, `visited_at`) VALUES
(1, 22, 2, '2025-08-29 01:28:44'),
(2, 22, 4, '2025-08-29 01:28:47'),
(3, 22, 2, '2025-08-29 01:29:10'),
(4, 22, 8, '2025-08-29 01:32:38'),
(5, 22, 1, '2025-09-01 02:19:22'),
(6, 22, 5, '2025-09-10 00:10:15'),
(7, 22, 11, '2025-09-10 00:14:57'),
(8, 22, 19, '2025-09-10 00:16:27'),
(9, 22, 17, '2025-09-10 00:16:29');

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
('c3l5sAjUvXXa104K22JUOZqwNQtXD2Hc8Jp1nM1S', NULL, '2a02:4780:11:c0de::e', 'Go-http-client/2.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoibHRlSlV3SWV5dlVjcWZaRThtZXRIRVdJWUhEMER2aFJmWUVTTVpSRyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1759307887),
('uBJX0m5f4OM9fiVPt3uNFZMwCYqYsd7x3KTExhbM', NULL, '2402:a00:152:e580:61d1:2e48:b5d3:639', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiT3lpYndNMnpHVnpiWXA4cDNGQ1BhblNvb21tQzBWWUJOczV6UXJNbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDY6Imh0dHBzOi8vdHJ1ZXVuaW9uLmRldmVsb3BtZW50ZGVtby5jby5pbi9zaWdudXAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjY6ImxvY2FsZSI7czoyOiJlbiI7fQ==', 1759312822);

-- --------------------------------------------------------

--
-- Table structure for table `site_visits`
--

CREATE TABLE `site_visits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `visit_date` date NOT NULL,
  `visits_count` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) NOT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `height` varchar(255) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `birth_time` time DEFAULT NULL,
  `birth_place` varchar(255) DEFAULT NULL,
  `raashi` varchar(255) DEFAULT NULL,
  `caste` varchar(255) DEFAULT NULL,
  `nakshtra` varchar(255) DEFAULT NULL,
  `naadi` varchar(255) DEFAULT NULL,
  `marital_status` varchar(255) DEFAULT NULL,
  `mother_tongue` varchar(255) DEFAULT NULL,
  `physically_handicap` varchar(255) DEFAULT 'no',
  `diet` varchar(255) DEFAULT NULL,
  `languages_known` text DEFAULT NULL,
  `highest_education` varchar(255) DEFAULT NULL,
  `education_details` varchar(255) DEFAULT NULL,
  `employed_in` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `annual_income` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `profile_image` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `google_id`, `full_name`, `gender`, `height`, `weight`, `dob`, `birth_time`, `birth_place`, `raashi`, `caste`, `nakshtra`, `naadi`, `marital_status`, `mother_tongue`, `physically_handicap`, `diet`, `languages_known`, `highest_education`, `education_details`, `employed_in`, `occupation`, `annual_income`, `country`, `state`, `city`, `mobile_number`, `email`, `email_verified_at`, `password`, `role`, `profile_image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Priya Sharma', 'female', '5ft 4in ( 162cm )', 58, '1998-05-15', NULL, NULL, NULL, NULL, NULL, NULL, 'UnMarried', 'Hindi', 'no', 'veg', NULL, 'Masters/Post-Graduation', 'M.Sc. Computer Science', 'Private', 'Software Engineer', '5,00,001 - 10,00,000', 'India', 'Maharashtra', 'Mumbai', '9876543210', 'priya.sharma@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', NULL, NULL, NULL, NULL),
(2, NULL, 'Rahul Kumar', 'male', '5ft 11in ( 180cm )', 75, '1995-02-20', NULL, NULL, NULL, NULL, NULL, NULL, 'UnMarried', 'Hindi', 'no', 'non-veg', NULL, 'Masters/Post-Graduation', 'MD in Cardiology', 'Private', 'Doctor', '10,00,001 and above', 'India', 'Delhi', 'New Delhi', '9876543211', 'rahul.kumar@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', NULL, NULL, NULL, NULL),
(3, NULL, 'Aisha Khan', 'female', '5ft 6in ( 167cm )', 62, '2000-08-10', NULL, NULL, NULL, NULL, NULL, NULL, 'UnMarried', 'Urdu', 'no', 'non-veg', NULL, 'Graduate/Bachelors', 'B.Design in Graphics', 'Private', 'Graphic Designer', '3,00,001 - 5,00,000', 'India', 'Karnataka', 'Bangalore', '9876543212', 'aisha.khan@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', NULL, NULL, NULL, NULL),
(4, NULL, 'John Pereira', 'male', '6ft 0in ( 182cm )', 80, '1996-11-30', NULL, NULL, NULL, NULL, NULL, NULL, 'UnMarried', 'Konkani', 'no', 'non-veg', NULL, 'Masters/Post-Graduation', 'M.Arch', 'Business', 'Architect', '7,50,001 - 10,00,000', 'India', 'Goa', 'Panaji', '9876543213', 'john.pereira@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', NULL, NULL, NULL, NULL),
(5, NULL, 'Anjali Gupta', 'female', '5ft 5in ( 165cm )', 59, '1997-07-25', NULL, NULL, NULL, NULL, NULL, NULL, 'UnMarried', 'Hindi', 'no', 'veg', NULL, 'Masters/Post-Graduation', 'M.Ed', 'Government', 'Teacher', '5,00,001 - 10,00,000', 'India', 'Maharashtra', 'Pune', '9876543214', 'anjali.gupta@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', NULL, NULL, NULL, NULL),
(6, NULL, 'Vikram Rathod', 'male', '5ft 10in ( 177cm )', 78, '1993-01-12', NULL, NULL, NULL, NULL, NULL, NULL, 'UnMarried', 'Tamil', 'no', 'non-veg', NULL, 'Masters/Post-Graduation', 'MBA in Marketing', 'Private', 'Marketing Manager', '10,00,001 and above', 'India', 'Tamil Nadu', 'Chennai', '9876543215', 'vikram.rathod@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', NULL, NULL, NULL, NULL),
(7, NULL, 'Sneha Reddy', 'female', '5ft 7in ( 170cm )', 64, '1999-03-05', NULL, NULL, NULL, NULL, NULL, NULL, 'UnMarried', 'Telugu', 'no', 'veg', NULL, 'Graduate/Bachelors', 'B.Tech CSE', 'Private', 'IT / Telecom Professional', '5,00,001 - 10,00,000', 'India', 'Telangana', 'Hyderabad', '9876543216', 'sneha.reddy@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', NULL, NULL, NULL, NULL),
(8, NULL, 'Amit Patel', 'male', '5ft 9in ( 175cm )', 72, '1996-09-18', NULL, NULL, NULL, NULL, NULL, NULL, 'UnMarried', 'Gujarati', 'no', 'veg', NULL, 'Masters/Post-Graduation', 'MBA in Finance', 'Private', 'Banker', '7,50,001 - 10,00,000', 'India', 'Gujarat', 'Ahmedabad', '9876543217', 'amit.patel@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', NULL, NULL, NULL, NULL),
(9, NULL, 'Meera Nair', 'female', '5ft 3in ( 160cm )', 55, '2001-04-22', NULL, NULL, NULL, NULL, NULL, NULL, 'UnMarried', 'Malayalam', 'no', 'veg', NULL, 'Graduate/Bachelors', 'BA in Journalism', 'Private', 'Journalist', '3,00,001 - 5,00,000', 'India', 'Kerala', 'Kochi', '9876543218', 'meera.nair@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', NULL, NULL, NULL, NULL),
(10, NULL, 'Sandeep Singh', 'male', '6ft 1in ( 185cm )', 82, '1994-06-08', NULL, NULL, NULL, NULL, NULL, NULL, 'UnMarried', 'Punjabi', 'no', 'non-veg', NULL, 'Graduate/Bachelors', 'B.E. Mechanical', 'Defence', 'Defence Employee', '7,50,001 - 10,00,000', 'India', 'Punjab', 'Chandigarh', '9876543219', 'sandeep.singh@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', NULL, NULL, NULL, NULL),
(11, NULL, 'Kavita Joshi', 'female', '5ft 2in ( 157cm )', 56, '1998-12-01', NULL, NULL, NULL, NULL, NULL, NULL, 'UnMarried', 'Marathi', 'no', 'veg', NULL, 'CharteredAccountant', 'Chartered Accountant', 'Business', 'Accountant', '5,00,001 - 10,00,000', 'India', 'Maharashtra', 'Nagpur', '9876543220', 'kavita.joshi@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', NULL, NULL, NULL, NULL),
(12, NULL, 'Rajesh Verma', 'male', '5ft 8in ( 172cm )', 70, '1995-10-14', NULL, NULL, NULL, NULL, NULL, NULL, 'UnMarried', 'Hindi', 'no', 'veg', NULL, 'Graduate/Bachelors', 'B.Com', 'Business', 'Business Person', '10,00,001 and above', 'India', 'Rajasthan', 'Jaipur', '9876543221', 'rajesh.verma@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', NULL, NULL, NULL, NULL),
(13, NULL, 'Sunita Das', 'female', '5ft 5in ( 165cm )', 60, '1997-03-28', NULL, NULL, NULL, NULL, NULL, NULL, 'UnMarried', 'Bengali', 'no', 'non-veg', NULL, 'PhD', 'PhD in Literature', 'Government', 'Professor', '7,50,001 - 10,00,000', 'India', 'West Bengal', 'Kolkata', '9876543222', 'sunita.das@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', NULL, NULL, NULL, NULL),
(14, NULL, 'Arjun Menon', 'male', '5ft 10in ( 177cm )', 76, '1994-08-02', NULL, NULL, NULL, NULL, NULL, NULL, 'UnMarried', 'Malayalam', 'no', 'non-veg', NULL, 'Graduate/Bachelors', 'B.Sc. Physics', 'Private', 'Scientist', '10,00,001 and above', 'India', 'Karnataka', 'Bangalore', '9876543223', 'arjun.menon@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', NULL, NULL, NULL, NULL),
(15, NULL, 'Pooja Desai', 'female', '5ft 6in ( 167cm )', 61, '1999-05-19', NULL, NULL, NULL, NULL, NULL, NULL, 'UnMarried', 'Gujarati', 'no', 'veg', NULL, 'Graduate/Bachelors', 'B.A. Psychology', 'Private', 'Human Resources Professional', '5,00,001 - 10,00,000', 'India', 'Gujarat', 'Surat', '9876543224', 'pooja.desai@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', NULL, NULL, NULL, NULL),
(16, NULL, 'Deepak Iyer', 'male', '5ft 9in ( 175cm )', 74, '1993-11-07', NULL, NULL, NULL, NULL, NULL, NULL, 'UnMarried', 'Tamil', 'no', 'veg', NULL, 'Masters/Post-Graduation', 'M.Tech in IT', 'Private', 'Software Consultant', '10,00,001 and above', 'India', 'Tamil Nadu', 'Coimbatore', '9876543225', 'deepak.iyer@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', NULL, NULL, NULL, NULL),
(17, NULL, 'Neha Agarwal', 'female', '5ft 4in ( 162cm )', 57, '2000-02-11', NULL, NULL, NULL, NULL, NULL, NULL, 'UnMarried', 'Marwadi', 'no', 'veg', NULL, 'Graduate/Bachelors', 'BBA', 'Not Employed', 'Student', 'No Income', 'India', 'Rajasthan', 'Udaipur', '9876543226', 'neha.agarwal@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', NULL, NULL, NULL, NULL),
(18, NULL, 'Aditya Singh', 'male', '6ft 2in ( 187cm )', 85, '1992-09-03', NULL, NULL, NULL, NULL, NULL, NULL, 'UnMarried', 'Hindi', 'no', 'non-veg', NULL, 'Graduate/Bachelors', 'LLB', 'Private', 'Lawyer', '10,00,001 and above', 'India', 'Uttar Pradesh', 'Lucknow', '9876543227', 'aditya.singh@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', NULL, NULL, NULL, NULL),
(19, NULL, 'Riya Sen', 'female', '5ft 8in ( 172cm )', 63, '1996-07-16', NULL, NULL, NULL, NULL, NULL, NULL, 'UnMarried', 'Bengali', 'no', 'non-veg', NULL, 'Graduate/Bachelors', 'NIFT Diploma', 'Business', 'Fashion Designer', '7,50,001 - 10,00,000', 'India', 'West Bengal', 'Kolkata', '9876543228', 'riya.sen@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', NULL, NULL, NULL, NULL),
(20, NULL, 'Manoj Tiwari', 'male', '5ft 7in ( 170cm )', 68, '1997-10-09', NULL, NULL, NULL, NULL, NULL, NULL, 'UnMarried', 'Hindi', 'no', 'veg', NULL, 'Diploma', 'Diploma in Civil Eng.', 'Private', 'Contractor', '5,00,001 - 10,00,000', 'India', 'Bihar', 'Patna', '9876543229', 'manoj.tiwari@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', NULL, NULL, NULL, NULL),
(21, NULL, 'Dev Admin', 'male', '5ft 10in ( 177cm )', NULL, '1990-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 'UnMarried', NULL, 'no', NULL, NULL, 'Graduate/Bachelors', 'B.Tech in Computer Science', NULL, NULL, NULL, 'India', 'Gujarat', 'Vadodara', '9999999999', 'dev@trueunion.com', NULL, '$2y$12$PierdNLsuyQnoX3TZkH6h.XTr1/CrliI4fotR6sUD72hHixkpRNEy', 'admin', NULL, NULL, NULL, '2025-08-28 04:30:56'),
(22, '103349274765079655674', 'Nil Patel', 'male', '6ft 1in ( 185cm )', 70, '2004-03-12', NULL, NULL, NULL, NULL, NULL, NULL, 'UnMarried', 'Hindi', 'no', 'veg', NULL, 'Graduate/Bachelors', 'ABC', 'Private', NULL, NULL, 'India', 'Gujarat', 'Vadodara', '06355343580', 'nilpatel.tlsu@gmail.com', NULL, '$2y$12$0PT/xGHZOPSONPVCeSR.ouyM7QyDG5.vQfurbJqs7BUSTfnzBWpS6', 'admin', NULL, NULL, '2025-08-28 05:08:47', '2025-09-19 13:05:54'),
(23, '106249618478078123608', 'Nil Patel', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'nilpatel7530@gmail.com', NULL, '$2y$12$Wm1wspFoR5MGpKDeOignvOjk.JulT1Ager2HC8Uzt/YMayDE5.d9a', 'admin', NULL, NULL, '2025-09-01 06:00:17', '2025-09-02 04:53:39');

-- --------------------------------------------------------

--
-- Table structure for table `user_activities`
--

CREATE TABLE `user_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `activity` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_memberships`
--

CREATE TABLE `user_memberships` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `membership_id` int(11) NOT NULL,
  `visits_used` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `purchased_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_memberships`
--

INSERT INTO `user_memberships` (`id`, `user_id`, `membership_id`, `visits_used`, `is_active`, `purchased_at`, `created_at`, `updated_at`) VALUES
(1, 22, 3, 5, 0, '2025-08-29 06:58:30', '2025-08-29 06:58:30', '2025-09-10 05:25:42'),
(2, 1, 4, 0, 0, '2025-09-03 05:27:50', '2025-09-02 23:57:50', '2025-09-03 06:01:02'),
(3, 1, 2, 0, 1, '2025-09-03 06:01:02', '2025-09-03 00:31:02', '2025-09-03 00:31:02'),
(4, 22, 1, 0, 0, '2025-09-10 05:25:42', '2025-09-09 23:55:42', '2025-09-10 05:25:47'),
(5, 22, 4, 0, 0, '2025-09-10 05:25:47', '2025-09-09 23:55:47', '2025-09-10 05:25:56'),
(6, 22, 3, 0, 0, '2025-09-10 05:25:56', '2025-09-09 23:55:56', '2025-09-10 05:26:03'),
(7, 22, 4, 4, 0, '2025-09-10 05:26:03', '2025-09-09 23:56:03', '2025-09-19 13:05:57'),
(8, 22, 3, 0, 0, '2025-09-19 13:05:57', '2025-09-19 13:05:57', '2025-09-19 13:06:04'),
(9, 22, 4, 0, 0, '2025-09-19 13:06:04', '2025-09-19 13:06:04', '2025-09-19 13:06:06'),
(10, 22, 2, 0, 0, '2025-09-19 13:06:06', '2025-09-19 13:06:06', '2025-09-19 13:06:14'),
(11, 22, 1, 0, 1, '2025-09-19 13:06:14', '2025-09-19 13:06:14', '2025-09-19 13:06:14');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `memberships`
--
ALTER TABLE `memberships`
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
-- Indexes for table `profile_visits`
--
ALTER TABLE `profile_visits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visitor_id` (`visitor_id`),
  ADD KEY `visited_id` (`visited_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `site_visits`
--
ALTER TABLE `site_visits`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `site_visits_visit_date_unique` (`visit_date`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `google_id` (`google_id`),
  ADD UNIQUE KEY `mobile_number` (`mobile_number`);

--
-- Indexes for table `user_activities`
--
ALTER TABLE `user_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_activities_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_memberships`
--
ALTER TABLE `user_memberships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `membership_id` (`membership_id`);

--
-- AUTO_INCREMENT for dumped tables
--

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
-- AUTO_INCREMENT for table `memberships`
--
ALTER TABLE `memberships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `profile_visits`
--
ALTER TABLE `profile_visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `site_visits`
--
ALTER TABLE `site_visits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_activities`
--
ALTER TABLE `user_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_memberships`
--
ALTER TABLE `user_memberships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `profile_visits`
--
ALTER TABLE `profile_visits`
  ADD CONSTRAINT `profile_visits_ibfk_1` FOREIGN KEY (`visitor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `profile_visits_ibfk_2` FOREIGN KEY (`visited_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_activities`
--
ALTER TABLE `user_activities`
  ADD CONSTRAINT `user_activities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_memberships`
--
ALTER TABLE `user_memberships`
  ADD CONSTRAINT `user_memberships_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_memberships_ibfk_2` FOREIGN KEY (`membership_id`) REFERENCES `memberships` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
