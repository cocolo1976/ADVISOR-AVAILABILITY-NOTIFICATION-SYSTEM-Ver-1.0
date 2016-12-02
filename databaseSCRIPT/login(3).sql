-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2016 at 10:29 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login`
--

-- --------------------------------------------------------

--
-- Table structure for table `apointments`
--

CREATE TABLE `apointments` (
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `panther_id` int(7) NOT NULL,
  `Advisor` varchar(100) NOT NULL,
  `arrival_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `appointment_time` varchar(10) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apointments`
--

INSERT INTO `apointments` (`FirstName`, `LastName`, `panther_id`, `Advisor`, `arrival_time`, `appointment_time`, `id`) VALUES
('drg', 'erte', 0, 'eter', '2016-11-30 07:16:36', 'etert', 23),
('ryry', 'rtyrty', 0, 'marSanch004', '2016-11-30 09:18:02', 'rtytry', 24),
('tyutyutyu', 'tyuytu', 0, 'ANY', '2016-11-30 09:23:40', 'tyutyu', 25);

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `id` varchar(15) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(10) NOT NULL,
  `logged` tinyint(1) NOT NULL,
  `Status` varchar(20) NOT NULL,
  `student_sent` int(1) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_details`
--

INSERT INTO `login_details` (`id`, `FirstName`, `LastName`, `password`, `level`, `logged`, `Status`, `student_sent`, `student_name`, `lastupdate`) VALUES
('admin1', 'admin1', 'admin1', '$2y$10$bMMnzE8kWVqddavlnn41beZKikh1loXWYN35V2U3pUXQp/3YGX0oa', 1, 1, '', 0, '', '2016-11-30 07:35:44'),
('admin2', 'admin2', 'admin2', '$2y$10$t45ve7OkX6QYw5FfON8xLufc/cSt/yx9mWhLcovnBGg0tOgiGXKCa', 1, 0, '', 0, '', '2016-11-29 01:33:17'),
('advisor1', 'Advisor', 'One', '$2y$10$5KRV2WxrXKFl/EzC5fj4WOZOKDuaEXwRmoA0soXf/3UNM2NLhsJai', 0, 0, 'RFA', 0, '5 5', '2016-11-30 07:35:34'),
('Carmen S.', 'Carmen ', 'Schenck', '$2y$10$sf4f1N3qwQzzOj448IRX1uMY1Hvk6B9qXKYl8uG/ZY4RQ2GTMMHVW', 0, 0, '', 0, '', '2016-11-21 19:36:40'),
('display', 'display', 'queues', '$2y$10$EIgTLgkURORnnlaCK8FQtOxBZTo0Fp/pZRpqyb3Fu5SlQnCE7T7de', 3, 0, '', 0, '', '2016-11-30 07:37:56'),
('FD1', 'Front', 'Desk', '$2y$10$oszNS0Er9zZVtCejxpUy8OZqGxgn26viNO2lXgYW3qKQcON7fungO', 2, 1, '', 0, '', '2016-11-30 08:13:55'),
('hectom8', 'Hector', 'Borges', '$2y$10$Rgv8WO2UBQjRkQie52F96O94.dN44IX3SeL7Dhora1QC1UUUj7RYa', 0, 0, 'Busy', 0, 'Roger Smith', '2016-11-30 06:53:42'),
('marSanch004', 'Mario', 'Sanchez', '$2y$10$IYJ3IzcqRC241EfJtGIbROO3cPaYHEPS4BJxf8f5.tdn7c33MaMla', 0, 1, 'Busy', 0, 'lol lol', '2016-11-30 05:33:30'),
('StudentSignIn', 'student', 'sign in', '$2y$10$TzEoTYrEopab6XhJmf9ImOEiVkbh2k3y8Qq0zpehtlSdvpygMzFie', 4, 0, '', 0, '', '2016-11-30 07:51:51'),
('SysAdm', 'System', 'Administrator', '$2y$10$.UAX0Kej.7bjNnbtvwfCB.ySUjwMj0y3Fc5vZTzXCf370iRNfk6dm', 1, 0, '', 0, '', '2016-11-21 19:40:10');

-- --------------------------------------------------------

--
-- Table structure for table `msgs`
--

CREATE TABLE `msgs` (
  `id` int(11) NOT NULL,
  `msg` varchar(256) DEFAULT NULL,
  `ts_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `msgs`
--

INSERT INTO `msgs` (`id`, `msg`, `ts_update`) VALUES
(1, 'RFA', '2016-11-30 07:18:45');

-- --------------------------------------------------------

--
-- Table structure for table `walk_in`
--

CREATE TABLE `walk_in` (
  `FirstName` varchar(11) NOT NULL,
  `LastName` varchar(11) NOT NULL,
  `Advisor` varchar(11) NOT NULL,
  `ts_updte` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `walk_in`
--

INSERT INTO `walk_in` (`FirstName`, `LastName`, `Advisor`, `ts_updte`, `id`, `pid`) VALUES
('lol', 'lol', 'lol', '2016-11-30 03:12:56', 134578, 0),
('tyu', 'tyty', 'rtytry', '2016-11-30 03:32:53', 134579, 0),
('rtyry', 'rrtyrty', 'ryrty', '2016-11-30 03:33:01', 134580, 0),
('lol', 'loll', 'marSanch004', '2016-11-30 04:25:10', 134581, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apointments`
--
ALTER TABLE `apointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msgs`
--
ALTER TABLE `msgs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `walk_in`
--
ALTER TABLE `walk_in`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apointments`
--
ALTER TABLE `apointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `msgs`
--
ALTER TABLE `msgs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `walk_in`
--
ALTER TABLE `walk_in`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134582;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
