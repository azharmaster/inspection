-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 23, 2023 at 05:59 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `insp`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `descr` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`, `descr`) VALUES
(1, 'P1', ''),
(2, 'P2', ''),
(3, 'P3', ''),
(4, 'P4', ''),
(5, 'P5', '');

-- --------------------------------------------------------

--
-- Table structure for table `dept`
--

CREATE TABLE `dept` (
  `id` int(11) NOT NULL,
  `dept` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dept`
--

INSERT INTO `dept` (`id`, `dept`) VALUES
(1, 'Finance Dept'),
(2, 'Group commercial Dept'),
(3, 'Operation Dept'),
(4, 'Fleet Dept'),
(5, 'Audit & Compliance Dept'),
(6, 'HSE Dept'),
(7, 'DPA Dept'),
(8, 'Admin & HR Dept'),
(9, 'Marine Personnel Dept'),
(10, 'Training Dept'),
(11, 'IT Dept'),
(12, 'Group Procurement Dept'),
(13, 'Group Business Development Dept'),
(14, 'Technical\nDept');

-- --------------------------------------------------------

--
-- Table structure for table `insp`
--

CREATE TABLE `insp` (
  `id` int(11) NOT NULL,
  `vessel_id` int(11) DEFAULT NULL,
  `insp_id` int(11) DEFAULT NULL,
  `insp_by` varchar(255) DEFAULT NULL,
  `name_master` varchar(255) DEFAULT NULL,
  `insp_date` varchar(255) DEFAULT NULL,
  `name_supertendent` varchar(255) DEFAULT NULL,
  `cdate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `insp`
--

INSERT INTO `insp` (`id`, `vessel_id`, `insp_id`, `insp_by`, `name_master`, `insp_date`, `name_supertendent`, `cdate`) VALUES
(1, 2, 1, 'Ramli Mijan - Assistance Marine Supervisor', 'Capt Ferry Fernando Syafnir', '2023-03-18', 'Ahmad Suffian Ali/ Mohd Yazid A. Rashid', '2023-03-16 20:48:51'),
(2, 4, 1, 'Master', 'Master', '2023-03-17', 'Master', '2023-03-17 20:48:51');

-- --------------------------------------------------------

--
-- Table structure for table `inspection`
--

CREATE TABLE `inspection` (
  `id` int(11) NOT NULL,
  `insp_name` varchar(255) DEFAULT NULL,
  `descr` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inspection`
--

INSERT INTO `inspection` (`id`, `insp_name`, `descr`) VALUES
(1, 'OVID', ''),
(3, 'test', '');

-- --------------------------------------------------------

--
-- Table structure for table `observe`
--

CREATE TABLE `observe` (
  `id` int(11) NOT NULL,
  `insp_id` int(11) DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `observation` varchar(255) DEFAULT NULL,
  `target_date` varchar(255) DEFAULT NULL,
  `corrective` longtext DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '0/open 1/close',
  `pdf` longtext DEFAULT NULL,
  `cordate` varchar(255) DEFAULT NULL,
  `cdate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `observe`
--

INSERT INTO `observe` (`id`, `insp_id`, `cat_id`, `dept_id`, `observation`, `target_date`, `corrective`, `status`, `pdf`, `cordate`, `cdate`) VALUES
(2, 1, 3, 14, 'Starboard Main Engine cooling water expansion tank; outlet\r\npipe leaks ( seals failure)', '2023-03-17', 'Fabricated new outlet pipe line and\r\nseal for stbd main engine cooling\r\nwater expansion tank.', 1, 'Q15_-_IFCP_JM_Perkasa_2_V&V_13-Oct-2022.doc.pdf', '2023-03-21 16:05:32', '2023-03-17 11:16:41'),
(3, 1, 2, 14, 'GS pump; outlet piping leaks', '2023-03-17', 'Fabricated new pipe line and replaced the gasket of GS Pump outlet pipe', 1, 'MarSIS User Manual Department for Corrective Action) v2.0 (1).pdf', '2023-03-21 16:06:14', '2023-03-17 11:17:14'),
(6, 2, 2, 14, 'Starboard Main Engine cooling water expansion tank; outlet\r\npipe leaks ( seals failure) ', '2023-03-22', NULL, 0, NULL, NULL, '2023-03-21 17:48:30'),
(7, 2, 2, 11, 'asda asda a asd a', '2023-03-21', 'done repair\r\n', 1, 'MarSIS User Manual - Marine Operations Focal (Department who register observation) v2.0.pdf', '2023-03-21 17:58:08', '2023-03-21 17:57:19');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `staf_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `notel` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `acl` int(11) NOT NULL COMMENT '1/admin 2/dept',
  `cdate` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `staf_id`, `name`, `notel`, `email`, `password`, `signature`, `pic`, `dept_id`, `acl`, `cdate`) VALUES
(1, 'admin', 'admin', '0112121212', 'admin@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL, 'WhatsApp Image 2023-03-16 at 9.19.45 AM.jpeg', NULL, 1, '2023-03-15 13:52:16'),
(2, 'asd123', 'Amirah Fato', '0112121212', 'amirah@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, 14, 2, '2023-03-15 13:52:16'),
(3, 'TEST1', 'GGWP', '01129692544', 'ggwp@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, 11, 2, '2023-03-21 17:54:47');

-- --------------------------------------------------------

--
-- Table structure for table `vessel`
--

CREATE TABLE `vessel` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `descr` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vessel`
--

INSERT INTO `vessel` (`id`, `name`, `descr`) VALUES
(2, 'MV JM Hadhari', ''),
(3, 'MV JM Tenang', ''),
(4, 'MV JM Seri Besut', ''),
(5, 'MV JM Intan', NULL),
(6, 'MV JM Gagah 2', NULL),
(7, 'MV JM Perkasa 2', NULL),
(8, 'MV JM Permai', NULL),
(9, 'MV JM Bayu', NULL),
(10, 'MV JM Sepoi', NULL),
(11, 'MV JM Purnama', NULL),
(12, 'MV JM Samudera', NULL),
(13, 'MV JM Setia', NULL),
(14, 'MV JM Ehsan', NULL),
(15, 'MV JM Salam', NULL),
(16, 'MV JM Abadi', NULL),
(17, 'MV JM Cekal', NULL),
(18, 'MV JM Tabah', NULL),
(19, 'MV JM Cemerlang', NULL),
(20, 'MV JM Gemilang', NULL),
(21, 'MV JM Indah', NULL),
(22, 'MV JM Murni', NULL),
(23, 'MV JM Sutera 1', NULL),
(24, 'MV JM Sutera 2', NULL),
(25, 'MV JM Sutera 3', NULL),
(26, 'MV JM Sutera 4', NULL),
(27, 'MV JM Sutera 5', NULL),
(28, 'MV JM Sutera 6', NULL),
(29, 'MV JM Sutera 7', NULL),
(30, 'MV JM Sutera 8', NULL),
(31, 'MV JM Sutera 9', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dept`
--
ALTER TABLE `dept`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `insp`
--
ALTER TABLE `insp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inspection`
--
ALTER TABLE `inspection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `observe`
--
ALTER TABLE `observe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vessel`
--
ALTER TABLE `vessel`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `dept`
--
ALTER TABLE `dept`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `insp`
--
ALTER TABLE `insp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inspection`
--
ALTER TABLE `inspection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `observe`
--
ALTER TABLE `observe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vessel`
--
ALTER TABLE `vessel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
