-- E-Learning Management System (LMS)
-- Sanitized demo database for portfolio/recruiter review
-- No real personal data, production credentials, or session payloads are included.
-- Demo login password for seeded accounts: password
-- Compatible with MySQL/MariaDB.

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------
-- Table structure for table `admin`
-- --------------------------------------------------------
CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `mobile`, `created_at`, `updated_at`) VALUES
(1, 'Demo Admin', 'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi.', '+000000000001', NOW(), NOW());

-- --------------------------------------------------------
-- Table structure for table `batches`
-- --------------------------------------------------------
CREATE TABLE `batches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `cache`
-- --------------------------------------------------------
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `cache_locks`
-- --------------------------------------------------------
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `courses`
-- --------------------------------------------------------
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

INSERT INTO `courses` (`id`, `name`, `syllabus`, `duration`, `created_at`, `updated_at`, `video_link`, `pdf_file`) VALUES
(1, 'Laravel Fundamentals', 'MVC, routing, Eloquent, authentication and database workflows', '8 weeks', NOW(), NOW(), NULL, NULL);

-- --------------------------------------------------------
-- Table structure for table `enrollment`
-- --------------------------------------------------------
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
-- Table structure for table `failed_jobs`
-- --------------------------------------------------------
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
-- Table structure for table `homeworks`
-- --------------------------------------------------------
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

INSERT INTO `homeworks` (`id`, `title`, `course_id`, `description`, `deadline`, `created_at`, `updated_at`, `type`, `marks`) VALUES
(1, 'Laravel Basics Homework', 1, 'Answer the Laravel fundamentals questions.', '2026-12-01T18:00', NOW(), NOW(), 'homework', 10),
(2, 'Database Design Homework', 1, 'Review relational database concepts.', '2026-12-08T18:00', NOW(), NOW(), 'homework', 10);

-- --------------------------------------------------------
-- Table structure for table `jobs`
-- --------------------------------------------------------
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
-- Table structure for table `job_batches`
-- --------------------------------------------------------
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
-- Table structure for table `migrations`
-- --------------------------------------------------------
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `password_reset_tokens`
-- --------------------------------------------------------
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `payments`
-- --------------------------------------------------------
CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `enrollment_id` bigint(20) UNSIGNED NOT NULL,
  `paid_date` date NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `question`
-- --------------------------------------------------------
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

INSERT INTO `question` (`id`, `homework_id`, `text`, `type`, `options`, `correct_answers`, `marks`, `created_at`, `updated_at`) VALUES
(1, 1, 'Laravel is primarily a framework for which language?', 'radio', '["PHP","Dart","Python"]', '["PHP"]', 5, NOW(), NOW()),
(2, 2, 'Which database concept links related records between tables?', 'radio', '["Foreign key","CSS selector","Widget"]', '["Foreign key"]', 5, NOW(), NOW());

-- --------------------------------------------------------
-- Table structure for table `result`
-- --------------------------------------------------------
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

-- --------------------------------------------------------
-- Table structure for table `sessions`
-- --------------------------------------------------------
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Intentionally no demo session records.

-- --------------------------------------------------------
-- Table structure for table `studentanswer`
-- --------------------------------------------------------
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

-- --------------------------------------------------------
-- Table structure for table `students`
-- --------------------------------------------------------
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

INSERT INTO `students` (`id`, `name`, `email`, `password`, `mobile`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Demo Student One', 'student1@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi.', '+000000000101', 'Demo City', NOW(), NOW()),
(2, 'Demo Student Two', 'student2@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi.', '+000000000102', 'Demo City', NOW(), NOW());

-- --------------------------------------------------------
-- Table structure for table `teacher`
-- --------------------------------------------------------
CREATE TABLE `teacher` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `teacher` (`id`, `name`, `email`, `password`, `mobile`, `created_at`, `updated_at`) VALUES
(1, 'Demo Teacher', 'teacher@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi.', '+000000000201', NOW(), NOW());

-- --------------------------------------------------------
-- Table structure for table `test`
-- --------------------------------------------------------
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

INSERT INTO `test` (`id`, `title`, `course_id`, `description`, `deadline`, `created_at`, `updated_at`, `type`, `marks`) VALUES
(1, 'Monthly Test 1', 1, 'Laravel fundamentals assessment.', '2026-12-15T18:00', NOW(), NOW(), 'test', 20),
(2, 'Monthly Test 2', 1, 'Database and Eloquent assessment.', '2026-12-22T18:00', NOW(), NOW(), 'test', 20),
(3, 'Final Test', 1, 'Final course assessment.', '2026-12-30T18:00', NOW(), NOW(), 'final', 50);

-- --------------------------------------------------------
-- Table structure for table `testanswer`
-- --------------------------------------------------------
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

-- --------------------------------------------------------
-- Table structure for table `testques`
-- --------------------------------------------------------
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

INSERT INTO `testques` (`id`, `test_id`, `text`, `type`, `options`, `correct_answers`, `marks`, `created_at`, `updated_at`) VALUES
(1, 1, 'Which command starts the Laravel development server?', 'radio', '["php artisan serve","npm install","git status"]', '["php artisan serve"]', 10, NOW(), NOW()),
(2, 1, 'Which ORM is included with Laravel?', 'radio', '["Eloquent","Hibernate","Entity Framework"]', '["Eloquent"]', 10, NOW(), NOW()),
(3, 2, 'Which database is used by this demo project?', 'radio', '["MySQL","MongoDB","Redis only"]', '["MySQL"]', 10, NOW(), NOW()),
(4, 2, 'What does MVC stand for?', 'radio', '["Model View Controller","Mobile Visual Code","Main Variable Class"]', '["Model View Controller"]', 10, NOW(), NOW()),
(5, 3, 'Laravel applications are primarily written in which language?', 'radio', '["PHP","Dart","Java"]', '["PHP"]', 25, NOW(), NOW()),
(6, 3, 'Which feature maps database tables to PHP models?', 'radio', '["Eloquent ORM","CSS Grid","Vite HMR"]', '["Eloquent ORM"]', 25, NOW(), NOW());

-- --------------------------------------------------------
-- Table structure for table `users`
-- --------------------------------------------------------
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

-- --------------------------------------------------------
-- Seed safe demo relationships/data
-- --------------------------------------------------------
INSERT INTO `batches` (`id`, `name`, `course_id`, `start_date`, `created_at`, `updated_at`) VALUES
(1, 'Laravel Demo Batch', 1, '2026-09-01', NOW(), NOW());

INSERT INTO `enrollment` (`id`, `enroll_no`, `batch_id`, `student_id`, `join_date`, `fee`, `created_at`, `updated_at`) VALUES
(1, 'DEMO-ENR-001', 1, 1, '2026-09-01', 100.00, NOW(), NOW()),
(2, 'DEMO-ENR-002', 1, 2, '2026-09-01', 100.00, NOW(), NOW());

INSERT INTO `payments` (`id`, `enrollment_id`, `paid_date`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, '2026-09-01', 100.00, NOW(), NOW()),
(2, 2, '2026-09-01', 100.00, NOW(), NOW());

INSERT INTO `studentanswer` (`id`, `homework_id`, `student_id`, `question_id`, `answer`, `is_correct`, `created_at`, `updated_at`, `total_marks`, `type`) VALUES
(1, 1, 1, 1, 'PHP', 1, NOW(), NOW(), 5, 'homework'),
(2, 2, 1, 2, 'Foreign key', 1, NOW(), NOW(), 5, 'homework');

INSERT INTO `testanswer` (`id`, `test_id`, `student_id`, `testques_id`, `answer`, `is_correct`, `created_at`, `updated_at`, `total_marks`, `type`) VALUES
(1, 1, 1, 1, 'php artisan serve', 1, NOW(), NOW(), 10, 'test'),
(2, 1, 1, 2, 'Eloquent', 1, NOW(), NOW(), 10, 'test'),
(3, 1, 2, 1, 'php artisan serve', 1, NOW(), NOW(), 10, 'test'),
(4, 1, 2, 2, 'Hibernate', 0, NOW(), NOW(), 0, 'test');

INSERT INTO `result` (`id`, `student_id`, `course_id`, `MonthlyTestone`, `MonthlyTestwo`, `final`, `homeworkone`, `homeworktwo`, `total_marks`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 20, 20, 50, 5, 5, 100, NOW(), NOW()),
(2, 2, 1, 10, 20, 45, 5, 5, 85, NOW(), NOW());

-- --------------------------------------------------------
-- Indexes
-- --------------------------------------------------------
ALTER TABLE `admin` ADD PRIMARY KEY (`id`);
ALTER TABLE `batches` ADD PRIMARY KEY (`id`), ADD KEY `batches_course_id_foreign` (`course_id`);
ALTER TABLE `cache` ADD PRIMARY KEY (`key`);
ALTER TABLE `cache_locks` ADD PRIMARY KEY (`key`);
ALTER TABLE `courses` ADD PRIMARY KEY (`id`);
ALTER TABLE `enrollment` ADD PRIMARY KEY (`id`), ADD KEY `enrollment_batch_id_foreign` (`batch_id`), ADD KEY `enrollment_student_id_foreign` (`student_id`);
ALTER TABLE `failed_jobs` ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);
ALTER TABLE `homeworks` ADD PRIMARY KEY (`id`);
ALTER TABLE `jobs` ADD PRIMARY KEY (`id`), ADD KEY `jobs_queue_index` (`queue`);
ALTER TABLE `job_batches` ADD PRIMARY KEY (`id`);
ALTER TABLE `migrations` ADD PRIMARY KEY (`id`);
ALTER TABLE `password_reset_tokens` ADD PRIMARY KEY (`email`);
ALTER TABLE `payments` ADD PRIMARY KEY (`id`);
ALTER TABLE `question` ADD PRIMARY KEY (`id`);
ALTER TABLE `result` ADD PRIMARY KEY (`id`);
ALTER TABLE `sessions` ADD PRIMARY KEY (`id`), ADD KEY `sessions_user_id_index` (`user_id`), ADD KEY `sessions_last_activity_index` (`last_activity`);
ALTER TABLE `studentanswer` ADD PRIMARY KEY (`id`);
ALTER TABLE `students` ADD PRIMARY KEY (`id`);
ALTER TABLE `teacher` ADD PRIMARY KEY (`id`);
ALTER TABLE `test` ADD PRIMARY KEY (`id`);
ALTER TABLE `testanswer` ADD PRIMARY KEY (`id`);
ALTER TABLE `testques` ADD PRIMARY KEY (`id`);
ALTER TABLE `users` ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`);

-- --------------------------------------------------------
-- AUTO_INCREMENT
-- --------------------------------------------------------
ALTER TABLE `admin` MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `batches` MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `courses` MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `enrollment` MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
ALTER TABLE `failed_jobs` MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `homeworks` MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
ALTER TABLE `jobs` MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `migrations` MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
ALTER TABLE `payments` MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
ALTER TABLE `question` MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
ALTER TABLE `result` MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
ALTER TABLE `studentanswer` MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
ALTER TABLE `students` MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
ALTER TABLE `teacher` MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `test` MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
ALTER TABLE `testanswer` MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
ALTER TABLE `testques` MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
ALTER TABLE `users` MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------
-- Foreign key constraints retained from the original dump
-- --------------------------------------------------------
ALTER TABLE `batches`
  ADD CONSTRAINT `batches_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

ALTER TABLE `enrollment`
  ADD CONSTRAINT `enrollment_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enrollment_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
