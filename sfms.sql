-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 22, 2024 at 12:42 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sfms`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `profile_pic` varchar(200) NOT NULL,
  `first_name` varchar(80) NOT NULL,
  `last_name` varchar(80) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `school_id` varchar(100) NOT NULL,
  `year_level` varchar(100) NOT NULL,
  `bill_balance` int(20) NOT NULL,
  `user_type` varchar(30) NOT NULL,
  `date_registered` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `profile_pic`, `first_name`, `last_name`, `email`, `password`, `school_id`, `year_level`, `bill_balance`, `user_type`, `date_registered`) VALUES
(1, 'profile1.jpg', 'admin', 'ko', 'admin@gmail.com', 'admin', '69-6969', '', 0, 'admin', '2024-10-16 22:16:02'),
(2, 'profile1.jpg', 'Jangelyn', 'Perdez', 'jangelyn@gmail.com', '1234', '22-10287', '3rd', 900, 'student', '2024-10-16 23:39:29'),
(3, 'profile2.jpeg', 'aa', 'bb', 'aa@gmail.com', '1234', '123-123', '1st', 1000, 'student', '2024-10-21 01:38:52'),
(4, 'profile1.jpg', 'jhonny', 'sins', 'a@gmail.com', '1', '123-123', '1st', 590, 'student', '2024-10-21 01:38:52'),
(5, 'profile3.jpg', 'test', 'test', 'test@gmail.com', '1', '20-2023', '2nd', 1000, 'student', '2024-10-22 01:45:27');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `first_name` varchar(80) NOT NULL,
  `last_name` varchar(80) NOT NULL,
  `bill_balance` int(20) NOT NULL,
  `payment_amount` int(20) NOT NULL,
  `remaining_balance` int(20) NOT NULL,
  `payment_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `student_id`, `first_name`, `last_name`, `bill_balance`, `payment_amount`, `remaining_balance`, `payment_date`) VALUES
(2, '123-123', 'aa', 'bb', 600, 10, 590, '2024-10-22 16:40:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
