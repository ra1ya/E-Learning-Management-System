-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2025 at 08:50 AM
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
-- Database: `dblearnn`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `mobile`, `created_at`, `updated_at`) VALUES
(1, 'rayan', 'rayan1.1421@gmail.com', '$2y$12$dyGnFF90jE.Bj8k6IiPP0uua.qI1CitLuU/t/ENkebTZZ6K9LVFwC', '+967779122352', '2025-01-26 15:29:18', '2025-01-26 15:29:18');

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `syllabus` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `video_link` varchar(255) DEFAULT NULL,
  `pdf_file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `syllabus`, `duration`, `created_at`, `updated_at`, `video_link`, `pdf_file`) VALUES
(3, 'php', 'first', 'three minute', '2025-01-27 05:38:53', '2025-01-27 05:43:17', 'https://www.youtube.com/watch?v=LvGQ1Eriw_M&list=PLe_UJpVeP8qBr0IotQa16V0TCLsf3db71&index=5', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `enroll_no` varchar(255) NOT NULL,
  `batch_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `join_date` date NOT NULL,
  `fee` double NOT NULL,
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
-- Table structure for table `homeworks`
--

CREATE TABLE `homeworks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) NOT NULL,
  `deadline` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `marks` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homeworks`
--

INSERT INTO `homeworks` (`id`, `title`, `course_id`, `description`, `deadline`, `created_at`, `updated_at`, `type`, `marks`) VALUES
(7, 'homework1', 3, 'solve all the question', '2025-01-30T22:51', '2025-01-27 16:52:42', '2025-01-27 16:52:42', NULL, NULL),
(8, 'homework2', 3, 'solve all the question', '2025-01-30T22:53', '2025-01-27 16:54:37', '2025-01-27 16:54:37', NULL, NULL);

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
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_12_04_042355_create_students_table', 1),
(5, '2024_12_04_082511_create_admin_table', 1),
(6, '2024_12_19_185150_create_courses_table', 1),
(7, '2024_12_19_185316_create_batches_table', 1),
(8, '2024_12_19_185527_create_enrollment_table', 1),
(9, '2024_12_19_185730_create_payments_table', 1),
(10, '2025_01_04_140529_create_submissionhome_table', 1),
(11, '2025_01_05_203331_create_subjects_table', 1),
(12, '2025_01_05_204336_create_teacher_table', 1),
(13, '2025_01_07_142459_add_video_and_pdf_to_courses_table', 1),
(14, '2025_01_07_182836_create_sessions_table', 1),
(15, '2025_01_11_191826_create_studentanswer_table', 1),
(16, '2025_01_15_140948_create_question_table', 1),
(17, '2025_01_16_180003_create_homeworks_table', 1),
(18, '2025_01_17_201451_create_test_table', 1),
(19, '2025_01_17_203153_create_testques_table', 1),
(20, '2025_01_17_214538_create_testanswer_table', 1),
(21, '2025_01_19_070255_create_results_table', 1),
(22, '2025_01_19_134225_create_activities_table', 1),
(23, '2025_01_20_083339_drop_activities', 2),
(24, '2025_01_20_084327_create_activities_table', 3),
(25, '2025_01_20_084920_drop_results', 3),
(26, '2025_01_20_085128_create_results_table', 4),
(27, '2025_01_20_113131_drop_results', 5),
(28, '2025_01_20_113352_drop_activities', 6),
(29, '2025_01_20_113556_create_activities_table', 7),
(30, '2025_01_20_113754_create_results_table', 7),
(31, '2025_01_20_213852_add_type_and_marks_to_tests_and_homeworks_tables', 8),
(32, '2025_01_21_055943_create_courses_students_table', 9),
(33, '2025_01_21_134652_create_student_course_table', 10),
(34, '2025_01_21_185238_drop_results', 11),
(35, '2025_01_21_185644_create_results_table', 12),
(36, '2025_01_21_214045_add_column_to_studentanswer', 13),
(37, '2025_01_22_185227_add_column_to_studentanswer', 14),
(38, '2025_01_22_205146_add_columns_to_testanswer', 15),
(39, '2025_01_26_095213_create_result_table', 16);

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `enrollment_id` bigint(20) UNSIGNED NOT NULL,
  `paid_date` date NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `homework_id` bigint(20) UNSIGNED NOT NULL,
  `text` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`options`)),
  `correct_answers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`correct_answers`)),
  `marks` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `homework_id`, `text`, `type`, `options`, `correct_answers`, `marks`, `created_at`, `updated_at`) VALUES
(8, 7, 'what is the flutter?', 'radio', '[\"framwark\",\"website\",\"website\"]', '[\"framwark\"]', 5, '2025-01-27 16:52:42', '2025-01-27 16:52:42'),
(9, 8, 'what is the laravel?', 'radio', '[\"php\",\"dart\",\"python\"]', '[\"php\"]', 5, '2025-01-27 16:54:37', '2025-01-27 16:54:37');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `MonthlyTestone` bigint(20) UNSIGNED DEFAULT NULL,
  `MonthlyTestwo` bigint(20) UNSIGNED DEFAULT NULL,
  `final` bigint(20) UNSIGNED DEFAULT NULL,
  `homeworkone` bigint(20) UNSIGNED DEFAULT NULL,
  `homeworktwo` bigint(20) UNSIGNED DEFAULT NULL,
  `total_marks` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`id`, `student_id`, `course_id`, `MonthlyTestone`, `MonthlyTestwo`, `final`, `homeworkone`, `homeworktwo`, `total_marks`, `created_at`, `updated_at`) VALUES
(3, 1, 3, 20, 20, 50, 5, 5, 100, '2025-01-27 18:17:07', '2025-01-27 18:17:07'),
(5, 2, 3, 10, 20, 50, 5, 5, 90, '2025-01-27 18:21:02', '2025-01-27 18:21:02');

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
('dGIBrJfZaxSMpDbJL1XeVS3n5rlopPsKf6NXDCth', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNHp0ODZoWjdtUXR1YzVuSXJRenk0NzRtc2NHSHZZakpWcHJOeHBRaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1738049758),
('nk8bDJFlypYHSKu2K1lwI1Fhx2UFAyYu2BfLPVA1', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoid2YyM3Y5R3dZdEVMU1I4eXU5QWJrd0dMU0h5SjBJdUkxaXlVbXhuNSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9sb2dpbiI7fXM6NTI6ImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1738006714),
('skXk1gyUsKWVYtFB0gzB8EvweMq6cZ6VcOiK4umP', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOHlnNVdCRkVlMGV3YlBNMldZUlJMaDJDbE9kNjNpSTJLM0xBcHBkbCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fX0=', 1738013580),
('VSKNressupbvWQbibbIdTJ6RYBSlfd8j53bT4Z5v', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNmZmeGxudldESGh2djdlaEZENlhueHlZTFRoZDBMUkhweVgwQ2psSCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zdHVkZW50cy9sb2dpbiI7fXM6NTU6ImxvZ2luX3N0dWRlbnRzXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1738011693);

-- --------------------------------------------------------

--
-- Table structure for table `studentanswer`
--

CREATE TABLE `studentanswer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `homework_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `answer` text NOT NULL,
  `is_correct` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `total_marks` double DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `studentanswer`
--

INSERT INTO `studentanswer` (`id`, `homework_id`, `student_id`, `question_id`, `answer`, `is_correct`, `created_at`, `updated_at`, `total_marks`, `type`) VALUES
(7, 7, 1, 8, 'framwark', 1, '2025-01-27 17:12:50', '2025-01-27 17:52:27', 5, NULL),
(8, 8, 1, 9, 'php', 1, '2025-01-27 17:13:24', '2025-01-27 17:52:27', 5, NULL),
(9, 7, 2, 8, 'framwark', 1, '2025-01-27 18:02:15', '2025-01-27 18:13:26', 5, NULL),
(10, 8, 2, 9, 'php', 1, '2025-01-27 18:02:31', '2025-01-27 18:13:26', 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `password`, `mobile`, `address`, `created_at`, `updated_at`) VALUES
(1, 'rayan', 'rayan.1421@gmail.com', '$2y$12$sJUjJiZI5.K/Swesjs3bFOd69ZPJ6pXAZKLLCt3I2MOJpiil.8e8W', '1234567891', 'jedda', '2025-01-19 10:54:13', '2025-01-19 10:54:13'),
(2, 'ali', 'ali.1421@gmail.com', '$2y$12$xz94sJZMjTzj3bl6o2Zvxub42mKF.nnrHw/QsGNUiKp28vw9MOT7q', '+966507040885', 'jedda', '2025-01-26 12:14:09', '2025-01-26 12:14:09');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `name`, `email`, `password`, `mobile`, `created_at`, `updated_at`) VALUES
(1, 'rayan', 'rayan.1421@gmail.com', '$2y$12$m8geTBRyFfUh1S/J/j38l.f79HHptpwT3Dv3c7W.YRYkHgpi4FBrq', '123654987', '2025-01-19 10:53:31', '2025-01-19 10:53:31');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) NOT NULL,
  `deadline` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `marks` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `title`, `course_id`, `description`, `deadline`, `created_at`, `updated_at`, `type`, `marks`) VALUES
(8, 'test1', 3, 'solve all the question', '2025-01-30T22:55', '2025-01-27 16:58:12', '2025-01-27 16:58:12', NULL, NULL),
(9, 'test2', 3, 'solve all the question', '2025-01-31T22:58', '2025-01-27 17:02:22', '2025-01-27 17:02:22', NULL, NULL),
(10, 'final', 3, 'solve all the question', '2025-01-28T23:02', '2025-01-27 17:07:50', '2025-01-27 17:07:50', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `testanswer`
--

CREATE TABLE `testanswer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `test_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `testques_id` bigint(20) UNSIGNED NOT NULL,
  `answer` text NOT NULL,
  `is_correct` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `total_marks` float DEFAULT 0,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testanswer`
--

INSERT INTO `testanswer` (`id`, `test_id`, `student_id`, `testques_id`, `answer`, `is_correct`, `created_at`, `updated_at`, `total_marks`, `type`) VALUES
(15, 8, 1, 18, 'php', 1, '2025-01-27 17:47:13', '2025-01-27 17:52:14', 20, NULL),
(16, 8, 1, 19, 'dart', 1, '2025-01-27 17:47:13', '2025-01-27 17:47:13', 20, NULL),
(17, 9, 1, 20, 'framwark', 1, '2025-01-27 17:49:16', '2025-01-27 17:52:14', 20, NULL),
(18, 9, 1, 21, 'framwark', 1, '2025-01-27 17:49:16', '2025-01-27 17:49:16', 20, NULL),
(19, 10, 1, 22, 'dart', 1, '2025-01-27 17:49:45', '2025-01-27 17:52:14', 50, NULL),
(20, 10, 1, 23, 'php', 1, '2025-01-27 17:49:45', '2025-01-27 17:49:45', 50, NULL),
(22, 8, 2, 18, 'dart', 0, '2025-01-27 18:02:51', '2025-01-27 18:13:30', 10, NULL),
(23, 8, 2, 19, 'dart', 1, '2025-01-27 18:02:51', '2025-01-27 18:02:51', 10, NULL),
(24, 9, 2, 20, 'framwark', 1, '2025-01-27 18:05:00', '2025-01-27 18:13:30', 20, NULL),
(25, 9, 2, 21, 'framwark', 1, '2025-01-27 18:05:00', '2025-01-27 18:05:00', 20, NULL),
(26, 10, 2, 22, 'dart', 1, '2025-01-27 18:05:28', '2025-01-27 18:13:30', 50, NULL),
(27, 10, 2, 23, 'php', 1, '2025-01-27 18:05:28', '2025-01-27 18:05:28', 50, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `testques`
--

CREATE TABLE `testques` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `test_id` bigint(20) UNSIGNED NOT NULL,
  `text` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`options`)),
  `correct_answers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`correct_answers`)),
  `marks` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testques`
--

INSERT INTO `testques` (`id`, `test_id`, `text`, `type`, `options`, `correct_answers`, `marks`, `created_at`, `updated_at`) VALUES
(18, 8, 'what is the laravel?', 'radio', '[\"php\",\"dart\",\"python\"]', '[\"php\"]', 10, '2025-01-27 16:58:13', '2025-01-27 16:58:13'),
(19, 8, 'what is the flutter?', 'radio', '[\"dart\",\"php\",\"python\"]', '[\"dart\"]', 10, '2025-01-27 16:58:13', '2025-01-27 16:58:13'),
(20, 9, 'what is the laravel?', 'radio', '[\"dart\",\"framwark\",\"python\"]', '[\"framwark\"]', 10, '2025-01-27 17:02:22', '2025-01-27 17:02:22'),
(21, 9, 'what is the flutter?', 'radio', '[\"php\",\"framwark\",\"languege\"]', '[\"framwark\"]', 10, '2025-01-27 17:02:22', '2025-01-27 17:02:22'),
(22, 10, 'what is the flutter?', 'radio', '[\"dart\",\"php\",\"python\"]', '[\"dart\"]', 25, '2025-01-27 17:07:50', '2025-01-27 17:07:50'),
(23, 10, 'what is the laravel?', 'text', '[\"php\",\"dart\",\"python\"]', '[\"php\"]', 25, '2025-01-27 17:07:50', '2025-01-27 17:07:50'),
(24, 11, 'mnj', 'radio', '[\"dart\",\"php\",\"dart\"]', '[\"php\"]', 1, '2025-01-27 17:52:11', '2025-01-27 17:52:11');

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
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `batches_course_id_foreign` (`course_id`);

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
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enrollment_batch_id_foreign` (`batch_id`),
  ADD KEY `enrollment_student_id_foreign` (`student_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `homeworks`
--
ALTER TABLE `homeworks`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `studentanswer`
--
ALTER TABLE `studentanswer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testanswer`
--
ALTER TABLE `testanswer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testques`
--
ALTER TABLE `testques`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homeworks`
--
ALTER TABLE `homeworks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `studentanswer`
--
ALTER TABLE `studentanswer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `testanswer`
--
ALTER TABLE `testanswer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `testques`
--
ALTER TABLE `testques`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `batches`
--
ALTER TABLE `batches`
  ADD CONSTRAINT `batches_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `enrollment_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enrollment_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
