-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2023 at 05:28 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sportsmanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `a_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`, `name`, `email`, `username`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `f_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `Message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`f_id`, `name`, `email`, `Message`) VALUES
(5, 'krijan maharjan', 'krijan@gmail.com', 'this is a test\r\nthis is a test\r\nthis is a test\r\nthis is a test');

-- --------------------------------------------------------

--
-- Table structure for table `participationdetails`
--

CREATE TABLE `participationdetails` (
  `t_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `player_details` varchar(255) NOT NULL,
  `contact` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `registered_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `participationdetails`
--

INSERT INTO `participationdetails` (`t_id`, `name`, `email`, `player_details`, `contact`, `s_id`, `registered_at`) VALUES
(20, 'krijan mote', 'idosabin78@gmail.com', 'safd\r\nds\r\nfas\r\nfasd\r\nf\r\ndsafa\r\nsdf\r\nasdf\r\nadsfa\r\nsdf\r\nsdf\r\ndsf', 984156897, 0, '0000-00-00'),
(20, 'krijan maharjan', 'krijan@gmail.com', '5615156\r\n6515154\r\n566541156\r\n654115156\r\n165451165', 984156898, 0, '2023-08-14'),
(20, 'test', 'test@gmail.com', '1.\r\n2.\r\n3.\r\n4.\r\n', 984156897, 0, '2023-08-17'),
(20, 'test', 'test@gmail.com', '1.\r\n2.\r\n3.\r\n4.\r\n', 984156897, 0, '2023-08-17'),
(20, 'test', 'test@gmail.com', '1.\r\n2.\r\n3.\r\n4.\r\n', 984156897, 0, '2023-08-17'),
(20, 'Niraj', 'niraj@gmail.com', 'fasdfsdfffffffffffffffffffffffffffffffff\r\nafsdddddddddddddddd\r\ndsfaaaaaaaaaaaaaaaaaaa', 984156898, 0, '2023-08-17'),
(20, 'Niraj', 'niraj@gmail.com', 'fasdfsdfffffffffffffffffffffffffffffffff\r\nafsdddddddddddddddd\r\ndsfaaaaaaaaaaaaaaaaaaa', 984156898, 0, '2023-08-17'),
(24, 'Krijan', 'krijan@gmail.com', 'safdsdf\r\nasdf\r\nasdf\r\nasdf\r\nasdf\r\nsafsdaf', 2147483647, 0, '2023-08-17'),
(24, 'Krijan', 'krijan@gmail.com', 'safdsdf\r\nasdf\r\nasdf\r\nasdf\r\nasdf\r\nsafsdaf', 2147483647, 0, '2023-08-17');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `r_id` int(11) NOT NULL,
  `tournament_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`r_id`, `tournament_name`, `image`) VALUES
(4, 'basketball tournament', 'Er.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `sch_id` int(11) NOT NULL,
  `tournament_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`sch_id`, `tournament_name`, `image`) VALUES
(6, 'basketball tournament', 'cricket.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sports`
--

CREATE TABLE `sports` (
  `s_id` int(11) NOT NULL,
  `s_name` varchar(255) NOT NULL,
  `s_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sports`
--

INSERT INTO `sports` (`s_id`, `s_name`, `s_image`) VALUES
(12, 'basketball', ''),
(14, 'tennis', ''),
(15, 'football', ''),
(17, 'cricket', ''),
(18, 'chess', '');

-- --------------------------------------------------------

--
-- Table structure for table `tournament`
--

CREATE TABLE `tournament` (
  `tournament_id` int(11) NOT NULL,
  `s_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `tournament_details` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `end_date` date NOT NULL,
  `start_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tournament`
--

INSERT INTO `tournament` (`tournament_id`, `s_id`, `name`, `tournament_details`, `image`, `end_date`, `start_date`) VALUES
(20, '14', 'kiran ko sasto tournament', 'kiran ko sasto tournament ', '64ddb317d26eb.jpg', '2023-07-29', '2023-06-27'),
(22, '18', 'chess', 'chess', '64a617f7ab740.jpg', '2023-11-01', '2023-10-31'),
(24, '12', 'basketball', '654546654', '64ddaf7ec9b5b.jpg', '2023-08-25', '2023-08-16');

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `u_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`u_id`, `name`, `email`, `username`, `password`) VALUES
(1, 'krijan maharjan', 'krijan@gmail.com', 'krijan', '123'),
(2, 'krijan maharjan', 'test@gmail.com', 'test', '$2y$10$601Lmm7PUn06j67J4NHgi.HHmcOo99kjPiMgf4Ih2VvmBWP/fwwOG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`sch_id`);

--
-- Indexes for table `sports`
--
ALTER TABLE `sports`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `tournament`
--
ALTER TABLE `tournament`
  ADD PRIMARY KEY (`tournament_id`);

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `sch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sports`
--
ALTER TABLE `sports`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tournament`
--
ALTER TABLE `tournament`
  MODIFY `tournament_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `userdetails`
--
ALTER TABLE `userdetails`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
