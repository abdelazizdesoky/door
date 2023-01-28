-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2023 at 02:23 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `door_sys`
--

-- --------------------------------------------------------

--
-- Table structure for table `door`
--

CREATE TABLE `door` (
  `id` int(11) NOT NULL,
  `door` varchar(255) NOT NULL,
  `place` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `door`
--

INSERT INTO `door` (`id`, `door`, `place`) VALUES
(1, 'الباب الرئيسى', 'المؤسسة'),
(16, 'الباب الخزنة', 'المؤسسة'),
(17, 'الباب المخزن', 'المؤسسة');

-- --------------------------------------------------------

--
-- Table structure for table `door_status`
--

CREATE TABLE `door_status` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `door_status`
--

INSERT INTO `door_status` (`id`) VALUES
(0);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `card` varchar(11) NOT NULL,
  `user` int(11) NOT NULL,
  `door` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date_status` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `card`, `user`, `door`, `status`, `date_status`) VALUES
(6, '3', 8, 1, 0, '2023-01-23 23:25:06'),
(7, '1', 7, 16, 0, '2023-01-23 23:25:06'),
(8, '1', 6, 17, 1, '2023-01-24 23:11:46'),
(9, '3', 8, 1, 0, '2023-01-24 23:11:46'),
(10, '3', 7, 17, 1, '2023-01-24 23:12:32'),
(11, '3', 7, 1, 1, '2023-01-24 23:12:32'),
(12, 'e1fef71c', 7, 1, 1, '2023-01-26 22:57:36'),
(13, 'e1fef71c', 7, 1, 1, '2023-01-26 22:57:54'),
(14, 'e1fef71c', 7, 1, 1, '2023-01-26 22:58:45'),
(15, '315515', 8, 1, 1, '2023-01-27 17:17:55'),
(16, '5115112', 6, 1, 0, '2023-01-27 17:17:55'),
(17, '62', 8, 1, 1, '2023-01-27 17:18:47'),
(18, '5115151512', 7, 1, 0, '2023-01-27 17:18:47'),
(19, '000000', 8, 1, 1, '2023-01-27 17:20:21'),
(20, '', 0, 1, 1, '2023-01-28 09:29:58'),
(21, '', 0, 1, 1, '2023-01-28 09:30:27'),
(22, '', 0, 1, 0, '2023-01-28 09:31:24'),
(23, '', 0, 1, 0, '2023-01-28 09:32:26'),
(24, '', 0, 1, 0, '2023-01-28 12:21:22'),
(25, '', 0, 1, 0, '2023-01-28 12:21:41'),
(26, '', 0, 1, 0, '2023-01-28 12:22:57'),
(27, '', 0, 1, 0, '2023-01-28 12:23:29'),
(28, '', 0, 1, 0, '2023-01-28 12:25:09'),
(29, '', 0, 1, 0, '2023-01-28 12:38:20'),
(30, '', 0, 1, 0, '2023-01-28 15:11:18'),
(31, 'e1fef71c', 7, 1, 1, '2023-01-28 15:12:31');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `auth` int(11) NOT NULL,
  `card` varchar(255) NOT NULL,
  `prim` int(11) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `date_reg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user`, `fname`, `position`, `pass`, `auth`, `card`, `prim`, `avatar`, `date_reg`) VALUES
(0, 'user', 'غير معروف ', 'غير معروف', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0, '00000000', 0, '444397_1 (5).jpg', '2023-01-27 13:52:56'),
(6, 'admin', 'administrator', 'administrator', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, '0', 1, '881317_1 (2).png', '2023-01-21 00:03:44'),
(7, 'ahmed', 'احمد زيزو ', 'امن ', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, 'e1fef71c', 1, '939673_1 (9).jpg', '2023-01-21 01:48:22'),
(8, 'elsayed', 'السيد ماهر ', 'امن ', 'f1b56e7b54e6ec19e787fdc283b3899092827fbf', 1, '123456', 0, '597600_1 (3).jpg', '2023-01-21 13:54:24'),
(15, 'mohamed', 'محمد عبدالعليم ', 'مدير معرض', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, '12345678', 1, '79258_1 (6).jpg', '2023-01-27 11:40:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `door`
--
ALTER TABLE `door`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `door`
--
ALTER TABLE `door`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
