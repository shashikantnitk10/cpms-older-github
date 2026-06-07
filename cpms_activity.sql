-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2017 at 05:04 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cpms`
--

-- --------------------------------------------------------

--
-- Table structure for table `cpms_activity`
--

CREATE TABLE `cpms_activity` (
  `activity_cd` varchar(6) NOT NULL,
  `activity_name` varchar(40) NOT NULL,
  `activity_main_cd` varchar(6) DEFAULT NULL,
  `activity_loc` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cpms_activity`
--

INSERT INTO `cpms_activity` (`activity_cd`, `activity_name`, `activity_main_cd`, `activity_loc`) VALUES
('I105', 'SFD acceptance', NULL, 'In'),
('I1051', 'SFD acceptance', 'I105', 'In'),
('I1052', 'SFD acceptance review', 'I105', 'In'),
('I1053', 'SFD acceptance rework', 'I105', 'In'),
('I106', 'SMT acceptance', NULL, 'In');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cpms_activity`
--
ALTER TABLE `cpms_activity`
  ADD PRIMARY KEY (`activity_cd`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
