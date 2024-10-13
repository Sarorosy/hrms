-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2024 at 11:38 AM
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
-- Database: `hrms`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(5) UNSIGNED NOT NULL,
  `employee_id` varchar(20) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `age` int(3) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `education` text DEFAULT NULL,
  `passport_photo` varchar(255) DEFAULT NULL,
  `aadhar` varchar(255) DEFAULT NULL,
  `10th_marksheet` varchar(255) DEFAULT NULL,
  `degree_certificate` varchar(255) DEFAULT NULL,
  `pg_certificate` varchar(255) DEFAULT NULL,
  `cv` varchar(255) DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `spouse_name` varchar(255) DEFAULT NULL,
  `son_count` int(2) DEFAULT NULL,
  `daughter_count` int(2) DEFAULT NULL,
  `personal_email` varchar(255) DEFAULT NULL,
  `marital_status` enum('Single','Married','Divorced','Widowed') DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `address3` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `gratuity` decimal(10,2) DEFAULT 0.00,
  `spl_allowance` decimal(10,2) DEFAULT 0.00,
  `ita` decimal(10,2) DEFAULT 0.00,
  `hra` decimal(10,2) DEFAULT 0.00,
  `ctc` decimal(10,2) DEFAULT 0.00,
  `manager_id` int(11) DEFAULT NULL,
  `manager_name` varchar(100) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `position` varchar(100) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `decrypt_pass` varchar(255) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `role` enum('USER','ADMIN','SUPERADMIN','HR') NOT NULL,
  `department_id` int(5) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `attendance` tinyint(1) DEFAULT 0,
  `profile_pic` varchar(255) DEFAULT 'default-avatar.png',
  `phone_number` varchar(20) DEFAULT NULL,
  `secondary_phone_number` int(15) DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `work_location` varchar(255) DEFAULT NULL,
  `employment_type` enum('Full-time','Part-time','Contract','Intern') DEFAULT NULL,
  `leave_balance` int(3) DEFAULT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `blood_group` enum('O+','O-','A+','B+','B-','A-','AB+','AB-') DEFAULT NULL,
  `preferred_language` enum('Tamil','English','Hindi') DEFAULT NULL,
  `zip_code` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `employee_id`, `name`, `age`, `dob`, `gender`, `education`, `passport_photo`, `aadhar`, `10th_marksheet`, `degree_certificate`, `pg_certificate`, `cv`, `father_name`, `mother_name`, `spouse_name`, `son_count`, `daughter_count`, `personal_email`, `marital_status`, `address1`, `address2`, `address3`, `city`, `state`, `gratuity`, `spl_allowance`, `ita`, `hra`, `ctc`, `manager_id`, `manager_name`, `email`, `position`, `username`, `pass`, `decrypt_pass`, `status`, `role`, `department_id`, `created_at`, `updated_at`, `attendance`, `profile_pic`, `phone_number`, `secondary_phone_number`, `joining_date`, `work_location`, `employment_type`, `leave_balance`, `nationality`, `blood_group`, `preferred_language`, `zip_code`) VALUES
(12534, 'EMP2039', 'Saravanan', 23, '2001-06-20', 'Male', NULL, 'efecca00827d609e00c6b9c64d0652b0.jpeg', NULL, NULL, NULL, NULL, NULL, 'Seenivasan', 'Uma', 'Rosy', 0, 0, 'codersaro@gmail.com', 'Single', '3,main road', 'thimmarajampettai', 'walajabad post', 'kanchipuram', 'Tamil Nadu', 0.00, 0.00, 0.00, 0.00, 50000.00, NULL, 'Vijay', 'admin@gmail.com', 'CEO', 'ADMIN', '$2y$10$gw.AnMDZeSPJqGh0UsOPeOeqCZfXxb3zxvI64mCpmdQfZSkoRpeA6', 'sarorosy1', 'active', 'SUPERADMIN', NULL, '2024-07-13 13:11:09', '2024-10-12 14:55:29', 0, '214c0786daa4dfc10c62a7f99a990172.jpg', '8838976048', NULL, '2024-06-21', 'Perumbakkam', 'Full-time', 63, 'Indian', 'B+', NULL, '631605'),
(12539, NULL, 'Lathika', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 'lathika@gmail.com', NULL, 'EMP81692', '$2y$10$vZimUgspL9XY6HUesOtEMufHbH7JVX/gMwOQbETm0urIEMUfjnNwm', 'lIgZVu2wsw', 'active', 'ADMIN', NULL, '2024-07-22 05:10:57', '2024-07-22 05:10:57', 0, 'default-avatar.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12542, 'EMP8232170', 'testman', 20, '2002-06-20', 'Male', '{\"qualification1\":\"bachelor of science\",\"college1\":\"harvard university\",\"year1\":\"2021\",\"qualification2\":\"\",\"college2\":\"\",\"year2\":\"\"}', 'bdeb3ca699d3112081ae5f59ca55ed3f.png', 'e7b9bb9e55abe418fa56e1835244ec94.png', NULL, '96d95212137f863eac84472756a070ab.png', 'f4b39da45ca2dd60471684caea2c0241.png', '8d5ad9f65027b5bf16f36929ebec44df.png', 'Father', 'Mother', 'Spouse', 0, 0, 'personalemail@gmail.com', 'Single', '3,main road', 'xyz', '', 'kanchipuram', 'Tamil Nadu', 0.00, 0.00, 0.00, 0.00, 28000.00, 12539, NULL, 'testman@gmail.com', '1', 'EMP8232170', '$2y$10$YcfVOMayfB5YNX8tvqFXquNva0BxE30VUfs0FRkxfRnCNQfZmmsR6', 'testman', 'active', 'USER', NULL, '2024-10-13 06:27:39', '2024-10-13 09:33:47', 0, 'default-avatar.png', '09361187937', NULL, '2024-10-15', NULL, 'Full-time', NULL, 'Indian', 'B+', NULL, '631605');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendance`
--

CREATE TABLE `tbl_attendance` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `login_time` time DEFAULT NULL,
  `logout_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_attendance`
--

INSERT INTO `tbl_attendance` (`id`, `user_id`, `date`, `login_time`, `logout_time`) VALUES
(18, 12534, '2024-07-14', '12:16:57', '15:57:09'),
(19, 12534, '2024-07-15', '06:15:42', '06:15:49'),
(20, 12534, '2024-07-15', '08:36:45', '12:12:49'),
(21, 12534, '2024-07-16', '08:59:36', '09:47:27'),
(22, 12534, '2024-07-18', '07:02:14', '12:54:13'),
(23, 12534, '2024-07-19', '05:58:31', '07:23:28'),
(24, 12534, '2024-07-26', '09:12:36', '09:12:52'),
(25, 12534, '2024-07-26', '09:13:02', '09:13:04'),
(35, 12534, '2024-10-12', '21:10:24', '21:22:59'),
(36, 12537, '2024-10-12', '23:00:01', '23:01:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complaints`
--

CREATE TABLE `tbl_complaints` (
  `complaint_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `status` enum('pending','in_progress','resolved','closed') NOT NULL DEFAULT 'pending',
  `priority` enum('low','medium','high','urgent') NOT NULL DEFAULT 'medium',
  `user_type` enum('user','co_employee','hr','manager') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `subject` varchar(255) DEFAULT NULL,
  `happened_at` date DEFAULT NULL,
  `admin_action` text DEFAULT NULL,
  `action_taken_by` int(11) UNSIGNED DEFAULT NULL,
  `action_taken_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_complaints`
--

INSERT INTO `tbl_complaints` (`complaint_id`, `user_id`, `description`, `status`, `priority`, `user_type`, `created_at`, `updated_at`, `subject`, `happened_at`, `admin_action`, `action_taken_by`, `action_taken_at`) VALUES
(1, 12534, 'An employee named xxxx in yyy department bullied me today.', 'resolved', 'medium', 'co_employee', '2024-07-20 16:34:13', '2024-07-21 08:34:15', 'Bullying', '2024-07-20', 'He has been warned and suspended for 5 days!', NULL, '2024-07-21 05:04:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_departments`
--

CREATE TABLE `tbl_departments` (
  `id` int(5) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_events`
--

CREATE TABLE `tbl_events` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time_range` varchar(50) DEFAULT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `event_description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_events`
--

INSERT INTO `tbl_events` (`id`, `name`, `date`, `time_range`, `created_by`, `created_at`, `event_description`) VALUES
(1, 'Rewards Distribution', '2024-08-29', '11:00 - 01:30', 'Saravanan', '2024-07-19 01:40:12', 'Distribution of rewards for all employees.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `id` int(11) NOT NULL,
  `employee_id` int(5) UNSIGNED DEFAULT NULL,
  `manager_id` int(5) UNSIGNED DEFAULT NULL,
  `productivity_rating` tinyint(4) NOT NULL CHECK (`productivity_rating` between 1 and 5),
  `quality_rating` tinyint(4) NOT NULL CHECK (`quality_rating` between 1 and 5),
  `punctuality_rating` tinyint(4) NOT NULL CHECK (`punctuality_rating` between 1 and 5),
  `comments` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_holidays`
--

CREATE TABLE `tbl_holidays` (
  `id` int(11) NOT NULL,
  `holiday_date` date NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_holidays`
--

INSERT INTO `tbl_holidays` (`id`, `holiday_date`, `title`, `created_at`, `updated_at`) VALUES
(1, '2024-07-17', 'Muharram', '2024-07-14 14:24:39', '2024-07-14 14:24:39'),
(2, '2024-08-15', 'Independence Day ', '2024-07-14 14:25:27', '2024-07-14 14:25:27'),
(3, '2024-09-07', 'Ganesh chadhurthi', '2024-07-18 07:25:51', '2024-07-18 07:25:51'),
(4, '2024-10-14', 'Vijaya Dhasami', '2024-10-12 14:17:39', '2024-10-12 14:17:39');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leave_request`
--

CREATE TABLE `tbl_leave_request` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `leave_reason` text NOT NULL,
  `reject_reason` text DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `leave_type_duration` enum('single_day','multi_days') NOT NULL DEFAULT 'single_day',
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `leave_type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_leave_request`
--

INSERT INTO `tbl_leave_request` (`id`, `user_id`, `leave_reason`, `reject_reason`, `status`, `created_at`, `leave_type_duration`, `start_date`, `end_date`, `leave_type`) VALUES
(1, 12534, 'trip to wayanad', 'not available', 'Rejected', '2024-07-17 04:13:59', 'single_day', '0000-00-00', NULL, ''),
(2, 12534, 'yty', NULL, 'Pending', '2024-07-17 06:55:28', 'single_day', '0000-00-00', NULL, ''),
(3, 12534, 'test', NULL, 'Pending', '2024-07-17 06:56:19', 'single_day', '0000-00-00', NULL, ''),
(4, 12534, 'ggfggf', NULL, 'Pending', '2024-07-17 06:58:50', 'multi_days', '0000-00-00', NULL, ''),
(5, 12534, 'dfdfdf', NULL, 'Pending', '2024-07-17 07:13:45', 'single_day', '2024-07-18', '2024-07-18', ''),
(6, 12534, 'test', NULL, 'Approved', '2024-07-17 07:14:10', 'multi_days', '2024-07-18', '2024-07-18', ''),
(7, 12534, 'test', 'We are having important meeting on that day', 'Rejected', '2024-07-17 07:14:48', 'multi_days', '2024-07-18', '2024-07-27', ''),
(8, 12534, 'gdfg', NULL, 'Approved', '2024-07-17 07:17:07', 'single_day', '2024-07-26', '2024-07-26', 'vacation'),
(9, 12534, 'family function', 'Sorry, we are having important on that day.', 'Rejected', '2024-07-18 04:35:02', 'single_day', '2024-07-19', '2024-07-19', 'personal');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_messages`
--

CREATE TABLE `tbl_messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sender_id` varchar(50) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_messages`
--

INSERT INTO `tbl_messages` (`id`, `user_id`, `sender_id`, `message`, `created_at`, `read`) VALUES
(7, 12537, 'Admin', 'Hello Richard, pls complete your profile details', '2024-10-12 13:05:00', 1),
(8, 12542, 'Admin', 'dear testman, Pls fill your profile details', '2024-10-13 03:32:23', 0),
(12, 12534, 'Saravanan', 'hii', '2024-10-13 03:38:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notice`
--

CREATE TABLE `tbl_notice` (
  `id` int(11) NOT NULL,
  `notice` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_notice`
--

INSERT INTO `tbl_notice` (`id`, `notice`, `created_at`) VALUES
(3, '<p>We are pleased to announce that we have optimized the payroll processing system for all <strong>employees</strong>. This improvement aims to streamline <span style=\"text-decoration: underline;\">payroll operations</span>, ensure accuracy, and enhance efficiency across the organizations.</p>\r\n<p>&nbsp;</p>\r\n<p>Key enhancements include:</p>\r\n<p>- Automated calculations to reduce manual errors.</p>\r\n<p>- Improved integration with HR systems for seamless data synchronization.</p>\r\n<p>- Enhanced reporting capabilities to provide insights into payroll metrics.</p>\r\n<p>&nbsp;</p>\r\n<p>These optimizations will contribute to a more efficient payroll process, ensuring timely and accurate payments to all employees.</p>\r\n<p>Thank you for your continued dedication and support.</p>\r\n<p>HR Team</p>\r\n<p>&nbsp;</p>', '2024-07-14 11:10:06'),
(6, '<p><span>Lorem Ipsum</span><span style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff;\">&nbsp;is simply dummy text </span></p>\r\n<p><span style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff;\">printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', '2024-07-18 05:39:44');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notifications`
--

CREATE TABLE `tbl_notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `read` tinyint(1) DEFAULT 0,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_notifications`
--

INSERT INTO `tbl_notifications` (`id`, `user_id`, `message`, `created_at`, `read`, `title`) VALUES
(1, 12534, 'He has been warned and suspended for 5 days!', '2024-07-21 05:04:16', 0, 'Complaint status');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_parking`
--

CREATE TABLE `tbl_parking` (
  `id` int(11) NOT NULL,
  `parking_type` enum('car','bike') DEFAULT NULL,
  `slot_number` varchar(20) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `allocated_to` varchar(255) DEFAULT NULL,
  `status` enum('available','occupied') DEFAULT 'available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_parking_requests`
--

CREATE TABLE `tbl_parking_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `vehicle_type` enum('car','bike') DEFAULT NULL,
  `slot_id` int(11) DEFAULT NULL,
  `vehicle_number` varchar(50) DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_parking_requests`
--

INSERT INTO `tbl_parking_requests` (`id`, `user_id`, `vehicle_type`, `slot_id`, `vehicle_number`, `status`, `created_at`, `updated_at`) VALUES
(6, 12534, 'car', 6, 'tn02 b0904', 'approved', '2024-07-18 10:27:41', '2024-07-19 05:33:08'),
(7, 12534, 'car', 7, 'tn02 b0904', 'approved', '2024-07-19 05:35:29', '2024-07-19 05:35:42'),
(9, 12534, 'car', 8, 'tn02 b0904', 'approved', '2024-07-19 07:30:55', '2024-07-19 07:34:16'),
(10, 12534, 'car', 8, 'tn02 b0903', 'approved', '2024-07-19 07:42:23', '2024-07-19 07:43:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_parking_slots`
--

CREATE TABLE `tbl_parking_slots` (
  `slot_id` int(11) NOT NULL,
  `slot_name` varchar(50) NOT NULL,
  `occupied` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL,
  `vehicle_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_parking_slots`
--

INSERT INTO `tbl_parking_slots` (`slot_id`, `slot_name`, `occupied`, `created_at`, `user_id`, `vehicle_type`) VALUES
(1, 'Slot 1', 0, '2024-07-18 09:20:34', NULL, ''),
(2, 'Slot 2', 0, '2024-07-18 09:20:34', NULL, ''),
(3, 'Slot 3', 0, '2024-07-18 09:20:34', NULL, ''),
(4, 'Slot 4', 0, '2024-07-18 09:20:34', NULL, ''),
(5, 'Slot 5', 1, '2024-07-18 09:20:34', 12534, 'bike'),
(6, 'Slot 6', 1, '2024-07-18 09:20:34', 12534, 'car'),
(7, 'Slot 7', 1, '2024-07-18 09:20:34', 12534, 'car'),
(8, 'Slot 8', 1, '2024-07-18 09:20:34', 12534, 'car'),
(9, 'Slot 9', 0, '2024-07-18 09:20:34', NULL, ''),
(10, 'Slot 10', 0, '2024-07-18 09:20:34', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_positions`
--

CREATE TABLE `tbl_positions` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_positions`
--

INSERT INTO `tbl_positions` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Web developer', 'Design and develop and maintain web applications', 1, '2024-10-13 11:38:14', '2024-10-13 11:38:14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rooms`
--

CREATE TABLE `tbl_rooms` (
  `room_id` int(11) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `seat_count` int(11) NOT NULL,
  `room_img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_rooms`
--

INSERT INTO `tbl_rooms` (`room_id`, `room_name`, `seat_count`, `room_img`) VALUES
(1, 'Room 1', 15, '3f6362e8ff21f7eef549f8cd2940d592.jpg'),
(2, 'Room 2', 25, 'b2bea834a4f4a587c2e0fde32c77b240.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_room_bookings`
--

CREATE TABLE `tbl_room_bookings` (
  `booking_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `room_id` int(11) NOT NULL,
  `booked_user_id` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_room_bookings`
--

INSERT INTO `tbl_room_bookings` (`booking_id`, `title`, `description`, `room_id`, `booked_user_id`, `start_time`, `end_time`) VALUES
(1, 'meeting', 'conference meeting', 1, 12534, '2024-07-21 11:30:00', '2024-07-21 12:00:00'),
(3, 'Team Meeting', 'Team conference meeting ', 2, 12534, '2024-07-22 10:00:00', '2024-07-22 11:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_work_details`
--

CREATE TABLE `tbl_work_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `work_details` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_work_details`
--

INSERT INTO `tbl_work_details` (`id`, `user_id`, `date`, `work_details`, `created_at`) VALUES
(7, 12534, '2024-10-12', 'testing  ds ds ds ds d ds   sd sds d d d sd', '2024-10-12 15:52:59'),
(8, 12537, '2024-10-12', 'worked on attendance features, holidays, messages, daily work details modules', '2024-10-12 17:31:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_complaints`
--
ALTER TABLE `tbl_complaints`
  ADD PRIMARY KEY (`complaint_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `action_taken_by` (`action_taken_by`);

--
-- Indexes for table `tbl_departments`
--
ALTER TABLE `tbl_departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_events`
--
ALTER TABLE `tbl_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `manager_id` (`manager_id`);

--
-- Indexes for table `tbl_holidays`
--
ALTER TABLE `tbl_holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_leave_request`
--
ALTER TABLE `tbl_leave_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_messages`
--
ALTER TABLE `tbl_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_notice`
--
ALTER TABLE `tbl_notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_parking`
--
ALTER TABLE `tbl_parking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_parking_requests`
--
ALTER TABLE `tbl_parking_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_parking_slots`
--
ALTER TABLE `tbl_parking_slots`
  ADD PRIMARY KEY (`slot_id`);

--
-- Indexes for table `tbl_positions`
--
ALTER TABLE `tbl_positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_rooms`
--
ALTER TABLE `tbl_rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `tbl_room_bookings`
--
ALTER TABLE `tbl_room_bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD UNIQUE KEY `unique_booking` (`room_id`,`start_time`,`end_time`);

--
-- Indexes for table `tbl_work_details`
--
ALTER TABLE `tbl_work_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12543;

--
-- AUTO_INCREMENT for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbl_complaints`
--
ALTER TABLE `tbl_complaints`
  MODIFY `complaint_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_departments`
--
ALTER TABLE `tbl_departments`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_events`
--
ALTER TABLE `tbl_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_holidays`
--
ALTER TABLE `tbl_holidays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_leave_request`
--
ALTER TABLE `tbl_leave_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_messages`
--
ALTER TABLE `tbl_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_notice`
--
ALTER TABLE `tbl_notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_parking`
--
ALTER TABLE `tbl_parking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_parking_requests`
--
ALTER TABLE `tbl_parking_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_parking_slots`
--
ALTER TABLE `tbl_parking_slots`
  MODIFY `slot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_positions`
--
ALTER TABLE `tbl_positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_rooms`
--
ALTER TABLE `tbl_rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_room_bookings`
--
ALTER TABLE `tbl_room_bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_work_details`
--
ALTER TABLE `tbl_work_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD CONSTRAINT `tbl_admin_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `tbl_departments` (`id`);

--
-- Constraints for table `tbl_complaints`
--
ALTER TABLE `tbl_complaints`
  ADD CONSTRAINT `tbl_complaints_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_admin` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_complaints_ibfk_2` FOREIGN KEY (`action_taken_by`) REFERENCES `tbl_admin` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD CONSTRAINT `tbl_feedback_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `tbl_admin` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_feedback_ibfk_2` FOREIGN KEY (`manager_id`) REFERENCES `tbl_admin` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_room_bookings`
--
ALTER TABLE `tbl_room_bookings`
  ADD CONSTRAINT `tbl_room_bookings_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `tbl_rooms` (`room_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
