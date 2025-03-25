-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2025 at 12:58 PM
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
-- Database: `expert_tutor`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `job_post_id` int(11) DEFAULT NULL,
  `sender_id` int(10) UNSIGNED DEFAULT NULL,
  `receiver_id` int(10) UNSIGNED DEFAULT NULL,
  `message` longtext NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `active` tinyint(1) DEFAULT 1,
  `deleted` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`id`, `job_post_id`, `sender_id`, `receiver_id`, `message`, `is_read`, `active`, `deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(131, 1, 7, 2, 'U2FsdGVkX1/TwQai4L5nyJEB1mnrC6cP4C8NhWTO9Ir20+EkycnjVR+hWLQ40GnGKITn85BaLDc1gQ2q9yaPVvdSRoep2ZWbznzdAV3NsGM=', 0, 1, 0, '2025-03-13 03:40:34', '2025-03-13 07:40:34', NULL, NULL),
(132, NULL, 7, 2, 'U2FsdGVkX18WF194mXj8cVo1qOsaS0Tv0s7k6nd3xZ4doj1fHLwu8BorDo9bmdXc', 0, 1, 0, '2025-03-13 03:40:51', '2025-03-13 07:40:51', NULL, NULL),
(133, NULL, 7, 2, 'U2FsdGVkX19oiI35rlXeknetLyEA7+TG7KgP4bh//uA=', 0, 1, 0, '2025-03-13 04:11:39', '2025-03-13 08:11:39', NULL, NULL),
(134, 2, 7, 2, 'U2FsdGVkX199w4ybhHnK0o1aGs4Pcw+afTvCsOdf4GPJ2vWvjm0jK/53L0xZFb081kRGZEN7vpx6cUy4quvKTg==', 0, 1, 0, '2025-03-13 07:01:45', '2025-03-13 11:01:45', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coins`
--

CREATE TABLE `coins` (
  `id` int(11) NOT NULL,
  `coin_count` int(11) NOT NULL,
  `coin_price` decimal(10,2) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coins`
--

INSERT INTO `coins` (`id`, `coin_count`, `coin_price`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 50, 230.00, 0, NULL, '2025-03-12 05:20:27', '2025-03-12 05:20:27'),
(2, 100, 430.00, NULL, NULL, '2025-03-12 08:03:00', '2025-03-12 08:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `job_applications`
--

CREATE TABLE `job_applications` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `applicant_id` int(11) NOT NULL,
  `application_status` varchar(50) DEFAULT 'Pending',
  `applied_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_applications`
--

INSERT INTO `job_applications` (`id`, `job_id`, `applicant_id`, `application_status`, `applied_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(14, 1, 7, 'Pending', '2025-03-13 06:47:04', '2025-03-13 06:47:04', NULL, NULL),
(15, 2, 7, 'Pending', '2025-03-13 11:01:43', '2025-03-13 11:01:43', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_messages`
--

CREATE TABLE `post_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `job_post_id` int(10) UNSIGNED DEFAULT NULL,
  `sender_id` int(10) UNSIGNED DEFAULT NULL,
  `message` longtext NOT NULL,
  `posted` tinyint(1) NOT NULL DEFAULT 0,
  `active` tinyint(1) DEFAULT 1,
  `deleted` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `nick_name` varchar(100) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT 'male',
  `phone_number` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `avatar_url` text DEFAULT NULL,
  `timezone` varchar(100) DEFAULT NULL,
  `languages` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`languages`)),
  `active` tinyint(1) DEFAULT 1,
  `deleted` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `first_name`, `middle_name`, `last_name`, `full_name`, `nick_name`, `gender`, `phone_number`, `address`, `city`, `country`, `birthdate`, `avatar_url`, `timezone`, `languages`, `active`, `deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(6, 2, NULL, NULL, NULL, 'Shoaib Shokat', 'Shoaib', 'male', '03000000000', NULL, NULL, 'Pakistan', NULL, NULL, 'Asia/Karachi', '\"Urdu\"', 1, 0, '2025-03-05 08:05:35', '2025-03-05 08:05:35', NULL, NULL),
(7, 7, NULL, NULL, NULL, 'Muhammad Shoaib', 'Shoaib', 'male', '03028050378', NULL, NULL, 'Pakistan', NULL, NULL, 'Asia/Karachi', '\"Urdu\"', 1, 0, '2025-03-07 09:41:59', '2025-03-07 09:41:59', NULL, NULL),
(8, 11, NULL, NULL, NULL, 'yahya imran', 'yahayii', 'male', '03101996639', NULL, NULL, 'AF', NULL, NULL, 'Africa/Bissau', '\"urdu\"', 1, 0, '2025-03-19 07:19:01', '2025-03-19 07:53:23', NULL, NULL),
(9, 12, NULL, NULL, NULL, 'naveed', 'naveddii', 'male', '04343', NULL, NULL, 'BE', NULL, NULL, 'Africa/Conakry', '\"urdu\"', 1, 0, '2025-03-21 09:40:57', '2025-03-21 09:40:57', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `id` int(11) NOT NULL,
  `referrer_id` int(11) NOT NULL,
  `referred_user_id` int(11) NOT NULL,
  `referral_code` varchar(100) NOT NULL,
  `referral_status` varchar(50) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `referrals`
--

INSERT INTO `referrals` (`id`, `referrer_id`, `referred_user_id`, `referral_code`, `referral_status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 7, 10, 'ShoaibShokat7202503140634305360', 'Verified', '2025-03-14 06:01:20', '2025-03-14 06:33:08', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `review_to` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `user_type` enum('student','teacher') NOT NULL,
  `star_rating` tinyint(1) NOT NULL,
  `review_text` text NOT NULL,
  `active` tinyint(1) DEFAULT 1,
  `deleted` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `deleted` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `description`, `active`, `deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'superadmin', 'Super Administrator', 1, 0, '2025-03-04 10:57:12', '2025-03-04 10:57:12', NULL, NULL),
(2, 'admin', 'Administrator', 1, 0, '2025-03-04 10:57:12', '2025-03-04 10:57:12', NULL, NULL),
(3, 'tutor', 'Tutor', 1, 0, '2025-03-04 10:57:12', '2025-03-04 10:57:12', NULL, NULL),
(4, 'student', 'Student', 1, 0, '2025-03-04 10:57:12', '2025-03-04 10:57:12', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_job_posts`
--

CREATE TABLE `student_job_posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `posted_by` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `level` varchar(100) DEFAULT NULL,
  `want` text DEFAULT NULL,
  `meeting_option` varchar(50) DEFAULT NULL,
  `post_code` varchar(20) DEFAULT NULL,
  `budget` int(10) UNSIGNED DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `need_some` text DEFAULT NULL,
  `tutor_from` varchar(100) DEFAULT NULL,
  `post_status` enum('active','complete','end') DEFAULT 'active',
  `active` tinyint(1) DEFAULT 1,
  `deleted` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_job_posts`
--

INSERT INTO `student_job_posts` (`id`, `posted_by`, `title`, `details`, `location`, `phone_number`, `subject`, `level`, `want`, `meeting_option`, `post_code`, `budget`, `gender`, `need_some`, `tutor_from`, `post_status`, `active`, `deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 2, 'I need an Artificial Intelligence tutor', 'I need an artificial intelligence tutor to teach machine learning and AI subjects', '', '038888', 'Ai Machine Learning', 'Basic', '', 'online', '2222', 5000, 'male', '', 'Pakistan', 'active', 1, 0, '2025-03-05 06:31:37', '2025-03-21 04:23:52', NULL, NULL),
(2, 2, 'Math Tutor Needed', 'I need a mathematics tutor for my 10th class.', 'Islamabad', '03000000000', 'Math 10th', 'Basic', '', 'online', '2222', 3000, 'male', '', 'Per Month', 'active', 1, 0, '2025-03-05 06:53:29', '2025-03-05 06:53:29', NULL, NULL),
(3, 11, 'Project', 'asdfasdfa', 'asdfad', '03101996639', 'jjkkk', '', 'asdfadvveeve', 'online', '29000', 20000, 'male', 'edvdfdf', 'hhj', 'active', 1, 0, '2025-03-19 09:06:51', '2025-03-19 09:06:51', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_education`
--

CREATE TABLE `teacher_education` (
  `id` int(10) UNSIGNED NOT NULL,
  `teacher_id` int(10) UNSIGNED DEFAULT NULL,
  `institute_name` varchar(255) NOT NULL,
  `degree_type` varchar(100) NOT NULL,
  `degree_name` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `association` varchar(255) DEFAULT NULL,
  `specialization` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `deleted` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_education`
--

INSERT INTO `teacher_education` (`id`, `teacher_id`, `institute_name`, `degree_type`, `degree_name`, `start_date`, `end_date`, `association`, `specialization`, `active`, `deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(2, 7, 'Higher Secondary School', 'ICS', 'ICS', '2025-03-11', '2025-03-13', 'something', 'expert', 1, 0, '2025-03-11 05:38:02', '2025-03-11 05:38:02', NULL, NULL),
(3, 12, 'dfsdf', 'asda', 'sdf', '2025-03-20', '2025-03-21', 'sdf', 'sdfsd', 1, 0, '2025-03-21 10:20:01', '2025-03-21 10:20:01', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_job_descriptions`
--

CREATE TABLE `teacher_job_descriptions` (
  `id` int(10) UNSIGNED NOT NULL,
  `teacher_id` int(10) UNSIGNED DEFAULT NULL,
  `description` longtext NOT NULL,
  `active` tinyint(1) DEFAULT 1,
  `deleted` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_job_descriptions`
--

INSERT INTO `teacher_job_descriptions` (`id`, `teacher_id`, `description`, `active`, `deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 7, 'Job description is here.', 1, 0, '2025-03-11 06:27:18', '2025-03-11 06:27:18', NULL, NULL),
(2, 12, 'hghghj', 1, 0, '2025-03-21 10:30:49', '2025-03-21 10:30:49', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_professional_experience`
--

CREATE TABLE `teacher_professional_experience` (
  `id` int(10) UNSIGNED NOT NULL,
  `teacher_id` int(10) UNSIGNED DEFAULT NULL,
  `organization` varchar(255) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `association` varchar(255) DEFAULT NULL,
  `job_role` text DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `deleted` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_professional_experience`
--

INSERT INTO `teacher_professional_experience` (`id`, `teacher_id`, `organization`, `designation`, `start_date`, `end_date`, `association`, `job_role`, `active`, `deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 7, 'Org-1', 'Designation', '2025-03-11', '2025-03-13', 'ASS', 'This is role.', 1, 0, '2025-03-11 05:57:41', '2025-03-11 05:57:41', NULL, NULL),
(2, 12, 'sfer', 'werw', '2025-03-12', '2025-03-21', 'sdfsd', 'sfdfsd', 1, 0, '2025-03-21 10:24:39', '2025-03-21 10:24:39', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_subjects`
--

CREATE TABLE `teacher_subjects` (
  `id` int(10) UNSIGNED NOT NULL,
  `teacher_id` int(10) UNSIGNED DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `from_level` varchar(100) NOT NULL,
  `to_level` varchar(100) NOT NULL,
  `active` tinyint(1) DEFAULT 1,
  `deleted` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_subjects`
--

INSERT INTO `teacher_subjects` (`id`, `teacher_id`, `subject`, `from_level`, `to_level`, `active`, `deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 7, 'Urdu', 'Biggener', 'Advance', 1, 0, '2025-03-11 04:49:58', '2025-03-11 04:49:58', NULL, NULL),
(2, 7, 'English', 'Biggener', 'Advance', 1, 0, '2025-03-11 04:49:59', '2025-03-11 04:49:59', NULL, NULL),
(3, 12, 'art', 'beginner', 'beginner', 1, 0, '2025-03-21 10:00:45', '2025-03-21 10:00:45', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_teaching_details`
--

CREATE TABLE `teacher_teaching_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `teacher_id` int(10) UNSIGNED DEFAULT NULL,
  `charge_type` varchar(100) NOT NULL,
  `minimum_fee` int(10) UNSIGNED NOT NULL,
  `maximum_fee` int(10) UNSIGNED DEFAULT NULL,
  `fee_details` text DEFAULT NULL,
  `total_experience` int(10) UNSIGNED DEFAULT 0,
  `teaching_experience` int(10) UNSIGNED DEFAULT 0,
  `online_teaching_experience` int(10) UNSIGNED DEFAULT 0,
  `travel_to_student` tinyint(1) DEFAULT 0,
  `available_for_online` tinyint(1) DEFAULT 0,
  `digital_pen` tinyint(1) DEFAULT 0,
  `help_work_assignments` tinyint(1) DEFAULT 0,
  `working_at_school` tinyint(1) DEFAULT 0,
  `opportunity_interested` varchar(255) DEFAULT NULL,
  `communication_language` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `deleted` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_teaching_details`
--

INSERT INTO `teacher_teaching_details` (`id`, `teacher_id`, `charge_type`, `minimum_fee`, `maximum_fee`, `fee_details`, `total_experience`, `teaching_experience`, `online_teaching_experience`, `travel_to_student`, `available_for_online`, `digital_pen`, `help_work_assignments`, `working_at_school`, `opportunity_interested`, `communication_language`, `active`, `deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 7, 'Hourly', 1500, 3000, 'jo bhi ho', 5, 3, 0, 1, 1, 0, 1, 0, 'Online Classes', 'Urdu', 1, 0, '2025-03-11 06:12:15', '2025-03-11 06:12:15', NULL, NULL),
(2, 12, 'Hourly', 232, 3333, 'qeqew', 2, 3, 3, 1, 1, 0, 0, 1, 'Mentorship', 'Sindhi', 1, 0, '2025-03-21 10:28:48', '2025-03-21 10:28:48', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `role` varchar(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password_hash` char(60) NOT NULL,
  `user_status` enum('active','inactive','banned','deleted') DEFAULT 'active',
  `verification` tinyint(1) DEFAULT 0,
  `authKey` varchar(255) DEFAULT NULL,
  `accessToken` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `deleted` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `username`, `email`, `password_hash`, `user_status`, `verification`, `authKey`, `accessToken`, `active`, `deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'superadmin', 'admin', 'admin@gmail.com', '$2y$13$.c3uAxbuLDfXfUvVHJiG/e4/FuTz3NLL.jbJoRXLBXXon0TpLpaqK', 'active', 1, 'FGsKZ87IhQ-aT0aUNgsFTttA2d0NHT_B', 'O8W6DWQ58tBXYaIgpkgDmSGp1Y6tTHHB', 1, 0, '2025-03-04 10:57:13', '2025-03-04 10:57:13', NULL, NULL),
(2, 'student', 'Shoaib', 'shoaibshokat6@gmail.com', '$2y$13$7HoA/X5DtXuDp36MSL6QUOgUvGNq8Ari/mNZXpqDGZSRB7UlETEJS', '', 1, NULL, NULL, 1, 0, '2025-03-04 10:57:47', '2025-03-04 10:58:14', NULL, NULL),
(7, 'tutor', 'Shoaib Shokat', 'shoaibshokat100@gmail.com', '$2y$13$r1A73YP.bHi4jAR1sfkJyev9de32HWlMRJJwTHI0fs/SrsGbYo1MO', '', 1, NULL, NULL, 1, 0, '2025-03-07 09:30:30', '2025-03-07 09:38:41', NULL, NULL),
(10, 'student', 'Hamid', 'hamidawan768@gmail.com', '$2y$13$rGTTDyCzZQ4IkCu2rvi.vOMZatErygAEnQ.9mujWyNvilUpgOxf1G', '', 1, NULL, NULL, 1, 0, '2025-03-14 06:01:12', '2025-03-14 06:33:08', NULL, NULL),
(11, 'student', 'yahyaimran8899', 'y07281607@gmail.com', '$2y$13$gmx3PwRwX/8v55JaK.gGsu9t4DK8VGDA.g0vx4HniEnmsxwyg2Bp2', '', 1, NULL, NULL, 1, 0, '2025-03-19 05:04:10', '2025-03-19 05:05:21', NULL, NULL),
(12, 'tutor', 'tutor_admin', 'jeteh58064@isorax.com', '$2y$13$lSxVbam6drAeFEcwL5YQoOAw34UBAjE0t7BnNh0tPaIWPipBEIj8W', '', 1, NULL, NULL, 1, 0, '2025-03-21 09:12:38', '2025-03-21 09:13:11', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_leave_log`
--

CREATE TABLE `user_leave_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `start_at` datetime DEFAULT NULL,
  `left_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_referral_codes`
--

CREATE TABLE `user_referral_codes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `referral_code` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_referral_codes`
--

INSERT INTO `user_referral_codes` (`id`, `user_id`, `referral_code`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 7, 'ShoaibShokat7202503140634305360', '2025-03-14 05:34:31', '2025-03-14 05:34:31', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_verifications`
--

CREATE TABLE `user_verifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `phone_verification_code` varchar(10) DEFAULT NULL,
  `phone_verified` tinyint(1) DEFAULT 0,
  `phone_verification_attempts` int(10) UNSIGNED DEFAULT 0,
  `phone_verification_expires` timestamp NULL DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `email_verification_code` varchar(64) DEFAULT NULL,
  `email_verification_link` text DEFAULT NULL,
  `email_verified` tinyint(1) DEFAULT 0,
  `email_verification_attempts` int(10) UNSIGNED DEFAULT 0,
  `email_verification_expires` timestamp NULL DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `deleted` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_verifications`
--

INSERT INTO `user_verifications` (`id`, `user_id`, `phone_number`, `phone_verification_code`, `phone_verified`, `phone_verification_attempts`, `phone_verification_expires`, `email`, `email_verification_code`, `email_verification_link`, `email_verified`, `email_verification_attempts`, `email_verification_expires`, `active`, `deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 2, '03000000000', '579007', 1, 0, NULL, 'shoaibshokat6@gmail.com', NULL, 'http://localhost/jantrah/expert-tutor/verify?token=KheMg1w-Pe1QWthp35-7qNhP9UJcubfb', 1, 1, '2025-03-05 06:57:47', 1, 0, '2025-03-04 10:57:47', '2025-03-05 09:11:31', NULL, NULL),
(2, 3, NULL, NULL, 0, 0, NULL, 'hamidawan768@gmail.com', NULL, 'http://192.168.18.79/jantrah/expert-tutor/verify?token=KZV-bVXoq4bZYF4Nm1IlyiZlMdOpSsxM', 1, 1, '2025-03-07 03:19:24', 1, 0, '2025-03-06 07:19:24', '2025-03-06 07:20:23', NULL, NULL),
(3, 4, NULL, NULL, 0, 0, NULL, 'shoaibshokat100@gmail.com', NULL, 'http://localhost/jantrah/expert-tutor/verify?token=u5F8KK7rco8UhQ2KtAYsrYJY_lhXotZB', 0, 0, '2025-03-08 05:13:12', 1, 0, '2025-03-07 09:13:12', '2025-03-07 09:13:12', NULL, NULL),
(4, 5, NULL, NULL, 0, 0, NULL, 'shoaibshokat100@gmail.com', NULL, 'http://localhost/jantrah/expert-tutor/verify?token=vDqDK8WicEl0wnCpRX0FMSQEGv7eVlVW', 0, 0, '2025-03-08 05:22:13', 1, 0, '2025-03-07 09:22:13', '2025-03-07 09:22:13', NULL, NULL),
(5, 6, NULL, NULL, 0, 0, NULL, 'shoaibshokat100@gmail.com', NULL, 'http://localhost/jantrah/expert-tutor/verify?token=wsj0szWHeZUUlm3XpJ9UDZ2Pdd4NECNx', 0, 0, '2025-03-08 05:27:47', 1, 0, '2025-03-07 09:27:47', '2025-03-07 09:27:47', NULL, NULL),
(6, 7, '03028050378', '474698', 0, 0, NULL, 'shoaibshokat100@gmail.com', NULL, 'http://localhost/jantrah/expert-tutor/verify?token=Y0KTy9RFM64WydU09XHW8xUCnXGoogmA', 1, 1, '2025-03-08 05:30:30', 1, 0, '2025-03-07 09:30:30', '2025-03-07 09:41:59', NULL, NULL),
(7, 8, NULL, NULL, 0, 0, NULL, 'hamidawan768@gmail.com', NULL, 'http://192.168.18.79/jantrah/expert-tutor/verify?token=lgVaUTSHVpKKE594CoZkMdk_sS7hqSLa', 1, 1, '2025-03-15 01:55:48', 1, 0, '2025-03-14 05:55:49', '2025-03-14 05:56:34', NULL, NULL),
(8, 9, NULL, NULL, 0, 0, NULL, 'hamidawan768@gmail.com', NULL, 'http://192.168.18.79/jantrah/expert-tutor/verify?token=-DlymJgUmatcdtpLnR3qvd6I42SRCdKV', 1, 1, '2025-03-15 01:58:52', 1, 0, '2025-03-14 05:58:52', '2025-03-14 05:59:23', NULL, NULL),
(9, 10, NULL, NULL, 0, 0, NULL, 'hamidawan768@gmail.com', NULL, 'http://192.168.18.79/jantrah/expert-tutor/verify?token=kWHF0mYIv-TsBjsksVhnzv--kvrbEbHT', 1, 1, '2025-03-15 02:01:12', 1, 0, '2025-03-14 06:01:12', '2025-03-14 06:33:08', NULL, NULL),
(10, 11, '03101996639', '51471', 0, 0, NULL, 'y07281607@gmail.com', NULL, 'http://localhost/expert_tutor/verify?token=PwfP0VZeTXV74i-4_l_21vzopuLNvu0K', 1, 1, '2025-03-20 01:04:10', 1, 0, '2025-03-19 05:04:10', '2025-03-19 07:19:01', NULL, NULL),
(11, 12, '04343', '425348', 0, 0, NULL, 'jeteh58064@isorax.com', NULL, 'http://localhost/expert_tutor/verify?token=xIvWO9hGyIDfiOIpZ9GWesYCTQxGY2th', 1, 3, '2025-03-22 05:12:38', 1, 0, '2025-03-21 09:12:38', '2025-03-21 09:40:57', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `balance` decimal(10,2) DEFAULT 0.00,
  `currency` varchar(10) DEFAULT 'USD',
  `active` tinyint(1) DEFAULT 1,
  `deleted` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `user_id`, `balance`, `currency`, `active`, `deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(2, 7, 120.00, 'Coins', 1, 0, '2025-03-13 08:24:45', '2025-03-14 06:33:08', NULL, NULL),
(3, 12, 0.00, 'Coins', 1, 0, '2025-03-21 10:30:49', '2025-03-21 10:30:49', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wallet_transactions`
--

CREATE TABLE `wallet_transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `wallet_id` int(10) UNSIGNED DEFAULT NULL,
  `transaction_type` enum('credit','debit') NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','completed','failed') DEFAULT 'pending',
  `active` tinyint(1) DEFAULT 1,
  `deleted` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wallet_transactions`
--

INSERT INTO `wallet_transactions` (`id`, `wallet_id`, `transaction_type`, `amount`, `description`, `transaction_date`, `status`, `active`, `deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 1, 'debit', 30.00, 'Paid for a message during job apply', '2025-03-12 10:41:14', '', 1, 0, '2025-03-12 10:41:14', '2025-03-12 10:41:14', NULL, NULL),
(2, 1, 'credit', 100.00, '100 Coins purchased.', '2025-03-13 06:04:50', '', 1, 0, '2025-03-13 06:04:50', '2025-03-13 06:04:50', NULL, NULL),
(3, 1, 'debit', 30.00, 'Paid for a message during job apply', '2025-03-13 06:05:01', '', 1, 0, '2025-03-13 06:05:01', '2025-03-13 06:05:01', NULL, NULL),
(4, 1, 'debit', 30.00, 'Paid for a message during job apply', '2025-03-13 06:07:03', '', 1, 0, '2025-03-13 06:07:03', '2025-03-13 06:07:03', NULL, NULL),
(5, 1, 'debit', 30.00, 'Paid for a message during job apply', '2025-03-13 06:09:11', '', 1, 0, '2025-03-13 06:09:11', '2025-03-13 06:09:11', NULL, NULL),
(6, 1, 'debit', 30.00, 'Paid for a message during job apply', '2025-03-13 06:09:38', '', 1, 0, '2025-03-13 06:09:38', '2025-03-13 06:09:38', NULL, NULL),
(7, 1, 'debit', 30.00, 'Paid for a message during job apply', '2025-03-13 06:16:48', '', 1, 0, '2025-03-13 06:16:48', '2025-03-13 06:16:48', NULL, NULL),
(8, 1, 'debit', 30.00, 'Paid for a message during job apply', '2025-03-13 06:19:39', '', 1, 0, '2025-03-13 06:19:39', '2025-03-13 06:19:39', NULL, NULL),
(9, 1, 'debit', 30.00, 'Paid for a message during job apply', '2025-03-13 06:22:47', '', 1, 0, '2025-03-13 06:22:47', '2025-03-13 06:22:47', NULL, NULL),
(10, 1, 'debit', 30.00, 'Paid for a message during job apply', '2025-03-13 06:24:56', '', 1, 0, '2025-03-13 06:24:56', '2025-03-13 06:24:56', NULL, NULL),
(11, 1, 'debit', 30.00, 'Paid for a message during job apply', '2025-03-13 06:33:24', '', 1, 0, '2025-03-13 06:33:24', '2025-03-13 06:33:24', NULL, NULL),
(12, 1, 'debit', 30.00, 'Paid for a message during job apply', '2025-03-13 06:40:11', '', 1, 0, '2025-03-13 06:40:11', '2025-03-13 06:40:11', NULL, NULL),
(13, 1, 'debit', 30.00, 'Paid for a message during job apply', '2025-03-13 06:47:03', '', 1, 0, '2025-03-13 06:47:03', '2025-03-13 06:47:03', NULL, NULL),
(14, 2, 'credit', 100.00, '100 Coins deposit on account signup.', '2025-03-13 08:24:45', '', 1, 0, '2025-03-13 08:24:45', '2025-03-13 08:24:45', NULL, NULL),
(15, 2, 'credit', 100.00, '100 Coins purchased.', '2025-03-13 11:01:19', '', 1, 0, '2025-03-13 11:01:19', '2025-03-13 11:01:19', NULL, NULL),
(16, 2, 'debit', 30.00, 'Paid for a message during job apply', '2025-03-13 11:01:43', '', 1, 0, '2025-03-13 11:01:43', '2025-03-13 11:01:43', NULL, NULL),
(17, 2, 'credit', 50.00, 'Recieved on referral approch.', '2025-03-14 06:33:08', '', 1, 0, '2025-03-14 06:33:08', '2025-03-14 06:33:08', NULL, NULL),
(18, 3, 'credit', 100.00, '100 Coins deposit on account signup.', '2025-03-21 10:30:49', '', 1, 0, '2025-03-21 10:30:49', '2025-03-21 10:30:49', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coins`
--
ALTER TABLE `coins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_messages`
--
ALTER TABLE `post_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `first_name` (`first_name`),
  ADD KEY `last_name` (`last_name`);

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `student_job_posts`
--
ALTER TABLE `student_job_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_education`
--
ALTER TABLE `teacher_education`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_job_descriptions`
--
ALTER TABLE `teacher_job_descriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_professional_experience`
--
ALTER TABLE `teacher_professional_experience`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_subjects`
--
ALTER TABLE `teacher_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_teaching_details`
--
ALTER TABLE `teacher_teaching_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `username_2` (`username`),
  ADD KEY `email_2` (`email`),
  ADD KEY `user_status` (`user_status`);

--
-- Indexes for table `user_leave_log`
--
ALTER TABLE `user_leave_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_referral_codes`
--
ALTER TABLE `user_referral_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `referral_code` (`referral_code`);

--
-- Indexes for table `user_verifications`
--
ALTER TABLE `user_verifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phone_number` (`phone_number`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_type` (`transaction_type`),
  ADD KEY `status` (`status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `coins`
--
ALTER TABLE `coins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `post_messages`
--
ALTER TABLE `post_messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student_job_posts`
--
ALTER TABLE `student_job_posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teacher_education`
--
ALTER TABLE `teacher_education`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teacher_job_descriptions`
--
ALTER TABLE `teacher_job_descriptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teacher_professional_experience`
--
ALTER TABLE `teacher_professional_experience`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teacher_subjects`
--
ALTER TABLE `teacher_subjects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teacher_teaching_details`
--
ALTER TABLE `teacher_teaching_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_leave_log`
--
ALTER TABLE `user_leave_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_referral_codes`
--
ALTER TABLE `user_referral_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_verifications`
--
ALTER TABLE `user_verifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
