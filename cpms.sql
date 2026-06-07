-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2017 at 07:50 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cpms_old`
--

-- --------------------------------------------------------

--
-- Table structure for table `cpms_activity`
--

CREATE TABLE `cpms_activity` (
  `acivity_cd` varchar(6) NOT NULL,
  `activity_name` varchar(40) NOT NULL,
  `activity_typ` char(1) NOT NULL DEFAULT 'M'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cpms_activity`
--

INSERT INTO `cpms_activity` (`acivity_cd`, `activity_name`, `activity_typ`) VALUES
('ACT001', 'SFDI acceptance', 'M'),
('ACT002', 'SFDI acceptance', 'S'),
('ACT003', 'SFDI acceptance review', 'S'),
('ACT004', 'SFDI acceptance rework', 'S'),
('ACT005', 'SMT acceptance', 'M'),
('ACT006', 'SMT acceptance', 'S'),
('ACT007', 'SMT acceptance reveiw', 'S'),
('ACT008', 'SMT acceptance rework', 'S'),
('ACT009', 'PARAM acceptance', 'M'),
('ACT010', 'Design', 'M'),
('ACT011', 'Design', 'S'),
('ACT012', 'Design Review', 'S'),
('ACT013', 'Design Rework', 'S'),
('ACT014', 'CUT', 'M'),
('ACT015', 'Coding', 'S'),
('ACT016', 'Coding Review', 'S'),
('ACT017', 'Coding Rework', 'S'),
('ACT018', 'UT', 'S'),
('ACT019', 'UT Review', 'S'),
('ACT020', 'UT Rework', 'S');

-- --------------------------------------------------------

--
-- Table structure for table `cpms_addnl_budget`
--

CREATE TABLE `cpms_addnl_budget` (
  `addnl_budget_proj` char(8) NOT NULL,
  `addnl_budget_delivery_cd` varchar(20) NOT NULL,
  `addnl_budget_delivery_typ` varchar(20) NOT NULL,
  `addnl_budget_delivery_dt` date NOT NULL,
  `addnl_budget` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cpms_budget`
--

CREATE TABLE `cpms_budget` (
  `budget_project_cd` char(8) NOT NULL,
  `budget_activity_cd` varchar(6) NOT NULL,
  `budget_type` varchar(15) NOT NULL,
  `budget_budget` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cpms_budget`
--

INSERT INTO `cpms_budget` (`budget_project_cd`, `budget_activity_cd`, `budget_type`, `budget_budget`) VALUES
('VH2CHUDP', 'ACT001', 'real', '8.00'),
('VH2CHUDP', 'ACT005', 'real', '3.00'),
('VH2CHUDP', 'ACT009', 'real', '1.00');

-- --------------------------------------------------------

--
-- Table structure for table `cpms_efforts`
--

CREATE TABLE `cpms_efforts` (
  `efforts_task_id` bigint(20) NOT NULL,
  `efforts_task_owner` char(3) NOT NULL,
  `efforts_dt` date NOT NULL,
  `efforts_act_effort` decimal(3,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cpms_project`
--

CREATE TABLE `cpms_project` (
  `project_cd` char(8) NOT NULL,
  `project_release_cd` char(4) NOT NULL,
  `project_delivery_lot` tinyint(4) NOT NULL,
  `project_owner` char(3) NOT NULL,
  `project_reviewer` char(3) DEFAULT NULL,
  `project_onshore_supp` varchar(35) NOT NULL,
  `project_start_dt` date NOT NULL,
  `project_end_dt` date NOT NULL,
  `project_budget_abacus` decimal(7,2) NOT NULL,
  `project_pre_int_in` decimal(7,2) NOT NULL DEFAULT '0.00',
  `project_pre_int_fr` decimal(7,2) NOT NULL DEFAULT '0.00',
  `project_addnl_qual` decimal(7,2) NOT NULL DEFAULT '0.00',
  `project_addnl_uat` decimal(7,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cpms_project`
--

INSERT INTO `cpms_project` (`project_cd`, `project_release_cd`, `project_delivery_lot`, `project_owner`, `project_reviewer`, `project_onshore_supp`, `project_start_dt`, `project_end_dt`, `project_budget_abacus`, `project_pre_int_in`, `project_pre_int_fr`, `project_addnl_qual`, `project_addnl_uat`) VALUES
('VH2CHUDP', 'V172', 1, 'SKT', 'PNL', 'Sylvie', '2017-06-08', '2017-08-04', '120.00', '0.00', '0.00', '10.00', '0.00'),
('VI1LASSN', 'V181', 1, 'PNL', 'SKT', '', '2017-10-25', '2017-12-12', '200.00', '0.00', '0.00', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `cpms_release`
--

CREATE TABLE `cpms_release` (
  `release_cd` char(4) NOT NULL,
  `release_mgr` char(3) NOT NULL,
  `release_start_dt` date DEFAULT NULL,
  `release_end_dt` date DEFAULT NULL,
  `release_budget` decimal(7,2) NOT NULL,
  `release_status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cpms_release`
--

INSERT INTO `cpms_release` (`release_cd`, `release_mgr`, `release_start_dt`, `release_end_dt`, `release_budget`, `release_status`) VALUES
('V172', 'PNL', '2017-06-01', '2017-11-01', '1000.00', 'C'),
('V181', 'SKT', '2017-06-27', NULL, '1200.00', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `cpms_task`
--

CREATE TABLE `cpms_task` (
  `task_id` bigint(20) NOT NULL,
  `task_project_id` char(8) NOT NULL,
  `task_iteration` char(2) NOT NULL,
  `task_activity_cd` varchar(6) NOT NULL,
  `task_name` varchar(6) NOT NULL,
  `task_detail` varchar(25) NOT NULL DEFAULT ' ',
  `task_owner` char(3) NOT NULL,
  `task_pln_start_dt` date DEFAULT NULL,
  `task_pln_end_dt` date DEFAULT NULL,
  `task_act_start_dt` date DEFAULT NULL,
  `task_act_end_dt` date DEFAULT NULL,
  `task_pln_budget` decimal(7,0) NOT NULL DEFAULT '0',
  `task_act_budget` decimal(7,0) NOT NULL DEFAULT '0',
  `task_nit` decimal(7,0) NOT NULL DEFAULT '0',
  `task_ttf` decimal(7,0) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cpms_task`
--

INSERT INTO `cpms_task` (`task_id`, `task_project_id`, `task_iteration`, `task_activity_cd`, `task_name`, `task_detail`, `task_owner`, `task_pln_start_dt`, `task_pln_end_dt`, `task_act_start_dt`, `task_act_end_dt`, `task_pln_budget`, `task_act_budget`, `task_nit`, `task_ttf`) VALUES
(1, 'VH2CHUDP', 'C1', 'ACT001', 'ACT002', ' ', 'SKT', '2017-06-01', '2017-06-08', NULL, NULL, '4', '0', '0', '0'),
(2, 'VH2CHUDP', 'C1', 'ACT001', 'ACT003', ' ', 'PNL', '2017-06-07', '2017-06-09', NULL, NULL, '1', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `cpms_user`
--

CREATE TABLE `cpms_user` (
  `user_trgm` char(3) NOT NULL,
  `user_name` varchar(40) NOT NULL,
  `user_password` varchar(25) DEFAULT NULL,
  `user_access_typ` char(1) NOT NULL DEFAULT 'U',
  `user_role` varchar(25) DEFAULT NULL,
  `user_status` char(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cpms_user`
--

INSERT INTO `cpms_user` (`user_trgm`, `user_name`, `user_password`, `user_access_typ`, `user_role`, `user_status`) VALUES
('PNL', 'Prashant Nainwal', NULL, 'A', 'Lead', 'A'),
('SKT', 'Shashi Kant', NULL, 'A', 'Lead', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cpms_activity`
--
ALTER TABLE `cpms_activity`
  ADD PRIMARY KEY (`acivity_cd`);

--
-- Indexes for table `cpms_addnl_budget`
--
ALTER TABLE `cpms_addnl_budget`
  ADD PRIMARY KEY (`addnl_budget_proj`);

--
-- Indexes for table `cpms_budget`
--
ALTER TABLE `cpms_budget`
  ADD PRIMARY KEY (`budget_project_cd`,`budget_activity_cd`),
  ADD KEY `budget_project_cd` (`budget_project_cd`),
  ADD KEY `budget_activity_cd` (`budget_activity_cd`);

--
-- Indexes for table `cpms_efforts`
--
ALTER TABLE `cpms_efforts`
  ADD PRIMARY KEY (`efforts_task_id`,`efforts_task_owner`,`efforts_dt`),
  ADD KEY `efforts_task_owner` (`efforts_task_owner`);

--
-- Indexes for table `cpms_project`
--
ALTER TABLE `cpms_project`
  ADD PRIMARY KEY (`project_cd`),
  ADD KEY `project_release_cd` (`project_release_cd`),
  ADD KEY `project_owner` (`project_owner`),
  ADD KEY `project_reviewer` (`project_reviewer`);

--
-- Indexes for table `cpms_release`
--
ALTER TABLE `cpms_release`
  ADD PRIMARY KEY (`release_cd`),
  ADD KEY `release_mgr` (`release_mgr`);

--
-- Indexes for table `cpms_task`
--
ALTER TABLE `cpms_task`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `task_project_id` (`task_project_id`),
  ADD KEY `task_activity_cd` (`task_activity_cd`),
  ADD KEY `task_name` (`task_name`),
  ADD KEY `task_owner` (`task_owner`);

--
-- Indexes for table `cpms_user`
--
ALTER TABLE `cpms_user`
  ADD PRIMARY KEY (`user_trgm`,`user_name`),
  ADD UNIQUE KEY `user_trgm` (`user_trgm`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cpms_task`
--
ALTER TABLE `cpms_task`
  MODIFY `task_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cpms_addnl_budget`
--
ALTER TABLE `cpms_addnl_budget`
  ADD CONSTRAINT `cpms_addnl_budget_ibfk_1` FOREIGN KEY (`addnl_budget_proj`) REFERENCES `cpms_project` (`project_cd`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `cpms_budget`
--
ALTER TABLE `cpms_budget`
  ADD CONSTRAINT `cpms_budget_ibfk_1` FOREIGN KEY (`budget_project_cd`) REFERENCES `cpms_project` (`project_cd`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `cpms_budget_ibfk_2` FOREIGN KEY (`budget_activity_cd`) REFERENCES `cpms_activity` (`acivity_cd`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `cpms_efforts`
--
ALTER TABLE `cpms_efforts`
  ADD CONSTRAINT `cpms_efforts_ibfk_1` FOREIGN KEY (`efforts_task_id`) REFERENCES `cpms_task` (`task_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `cpms_efforts_ibfk_2` FOREIGN KEY (`efforts_task_owner`) REFERENCES `cpms_task` (`task_owner`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `cpms_project`
--
ALTER TABLE `cpms_project`
  ADD CONSTRAINT `cpms_project_ibfk_1` FOREIGN KEY (`project_owner`) REFERENCES `cpms_user` (`user_trgm`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `cpms_project_ibfk_2` FOREIGN KEY (`project_reviewer`) REFERENCES `cpms_user` (`user_trgm`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `cpms_project_ibfk_3` FOREIGN KEY (`project_release_cd`) REFERENCES `cpms_release` (`release_cd`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `cpms_release`
--
ALTER TABLE `cpms_release`
  ADD CONSTRAINT `cpms_release_ibfk_1` FOREIGN KEY (`release_mgr`) REFERENCES `cpms_user` (`user_trgm`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `cpms_task`
--
ALTER TABLE `cpms_task`
  ADD CONSTRAINT `cpms_task_ibfk_1` FOREIGN KEY (`task_project_id`) REFERENCES `cpms_project` (`project_cd`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `cpms_task_ibfk_2` FOREIGN KEY (`task_activity_cd`) REFERENCES `cpms_activity` (`acivity_cd`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `cpms_task_ibfk_3` FOREIGN KEY (`task_name`) REFERENCES `cpms_activity` (`acivity_cd`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `cpms_task_ibfk_4` FOREIGN KEY (`task_owner`) REFERENCES `cpms_user` (`user_trgm`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
