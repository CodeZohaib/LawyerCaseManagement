-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 15, 2023 at 05:58 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `case_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `cases`
--

CREATE TABLE `cases` (
  `id` int NOT NULL,
  `client_id` int NOT NULL,
  `user_id` int NOT NULL,
  `case_type_name` varchar(255) NOT NULL,
  `court_type_name` varchar(255) NOT NULL,
  `behalf` varchar(100) NOT NULL,
  `case_no` varchar(100) NOT NULL,
  `pet_name` varchar(50) NOT NULL,
  `section` varchar(200) NOT NULL,
  `judge_name` varchar(200) NOT NULL,
  `case_status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'open',
  `case_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cases`
--

INSERT INTO `cases` (`id`, `client_id`, `user_id`, `case_type_name`, `court_type_name`, `behalf`, `case_no`, `pet_name`, `section`, `judge_name`, `case_status`, `case_date`) VALUES
(43, 35, 4, 'civil', 'lahore high court', 'petetionar', '234', 'Rizwan', '302', 'Shahzaib Ali', 'open', '2023-06-06 09:58:01'),
(44, 37, 4, 'civil', 'lahore high court', 'petetionar', '7650', 'Hamza', '205', 'Shahzaib', 'clientInactive', '2023-06-06 09:59:11'),
(45, 38, 7, 'criminal ', 'nowshera court', 'petetionar', '940', 'Ali', '502', 'Rizwan', 'open', '2023-06-06 17:40:34'),
(46, 35, 4, 'family', 'sindh high court', 'respondent', '8900', 'Shahzaib', '211', 'Faizan Shah', 'open', '2023-06-06 17:57:12');

-- --------------------------------------------------------

--
-- Table structure for table `cases_type`
--

CREATE TABLE `cases_type` (
  `case_type_id` int NOT NULL,
  `case_type_userId` int NOT NULL,
  `case_type` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cases_type`
--

INSERT INTO `cases_type` (`case_type_id`, `case_type_userId`, `case_type`) VALUES
(6, 4, 'civil'),
(7, 4, 'family'),
(8, 5, 'criminal '),
(10, 5, 'family'),
(12, 4, 'criminal '),
(13, 7, 'criminal ');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `father` varchar(100) NOT NULL,
  `cnic` varchar(100) NOT NULL,
  `number` varchar(200) NOT NULL,
  `address` varchar(60) NOT NULL,
  `client_status` varchar(100) DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `user_id`, `fullname`, `father`, `cnic`, `number`, `address`, `client_status`) VALUES
(35, 4, 'afaq ali', 'rizwan khan', '17201-1234567-9', '03139943234', 'dheri katti khel hakeem abad nowshera', 'active'),
(36, 5, 'zohaib khan', 'noorzali', '17201-6070622-8', '03139943227', 'dheri katti khel', 'active'),
(37, 4, 'faizan khan', 'irfan khan', '17201-9876543-9', '03009876543', 'nowshera', 'inactive'),
(38, 7, 'shahzaib ali', 'noor zali', '17201-9876545-6', '03138796543', 'nowshera', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `court_type`
--

CREATE TABLE `court_type` (
  `court_type_id` int NOT NULL,
  `court_type_userId` int NOT NULL,
  `court_type` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `court_type`
--

INSERT INTO `court_type` (`court_type_id`, `court_type_userId`, `court_type`) VALUES
(6, 4, 'lahore high court'),
(9, 6, 'nowshera'),
(14, 5, 'lahore high court'),
(15, 4, 'supreme court '),
(16, 4, 'sindh high court'),
(18, 7, 'nowshera court');

-- --------------------------------------------------------

--
-- Table structure for table `hearing`
--

CREATE TABLE `hearing` (
  `h_id` int NOT NULL,
  `user_id` int NOT NULL,
  `client_id` int NOT NULL,
  `case_id` int NOT NULL,
  `previous_hearing` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `next_hearing` varchar(255) NOT NULL,
  `judge_remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `hearing`
--

INSERT INTO `hearing` (`h_id`, `user_id`, `client_id`, `case_id`, `previous_hearing`, `next_hearing`, `judge_remarks`) VALUES
(1, 4, 35, 43, NULL, '2023-06-06', ''),
(2, 4, 37, 44, NULL, '2023-06-05', 'hello sir'),
(6, 4, 37, 44, '2023-06-05', '2023-06-07', NULL),
(7, 7, 38, 45, NULL, '2023-06-06', 'k'),
(8, 7, 38, 45, '2023-06-06', '2023-06-07', NULL),
(9, 4, 35, 46, NULL, '2023-06-08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int NOT NULL,
  `u_fullName` varchar(255) NOT NULL,
  `u_email` varchar(100) NOT NULL,
  `u_password` varchar(255) NOT NULL,
  `u_phoneNumber` varchar(255) NOT NULL,
  `u_profileImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_fullName`, `u_email`, `u_password`, `u_phoneNumber`, `u_profileImage`) VALUES
(4, 'zohaib khan', 'kzohaib935@gmail.com', 'Khan@1234', '0313994327', '4724_zohaib.jpg'),
(5, 'rizwan khan', 'rizwan@gmail.com', 'Khan@1234', '03138765432', '2709_1155063.jpg'),
(6, 'ubaid khan', 'ubaid@gmail.com', 'Khan@1234', '03138765678', '6880_1156522.jpg'),
(7, 'faizan khan', 'faizan@gmail.com', 'Khan@1234', '03009876543', '2165_23.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cases`
--
ALTER TABLE `cases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cases_type`
--
ALTER TABLE `cases_type`
  ADD PRIMARY KEY (`case_type_id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `court_type`
--
ALTER TABLE `court_type`
  ADD PRIMARY KEY (`court_type_id`);

--
-- Indexes for table `hearing`
--
ALTER TABLE `hearing`
  ADD PRIMARY KEY (`h_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cases`
--
ALTER TABLE `cases`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `cases_type`
--
ALTER TABLE `cases_type`
  MODIFY `case_type_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `court_type`
--
ALTER TABLE `court_type`
  MODIFY `court_type_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `hearing`
--
ALTER TABLE `hearing`
  MODIFY `h_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
