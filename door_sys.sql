-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2023 at 10:46 PM
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
  `door` int(11) NOT NULL,
  `place` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user` text NOT NULL,
  `name` varchar(11) NOT NULL,
  `position` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `auth` int(11) NOT NULL,
  `prim` int(11) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `date_reg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user`, `name`, `position`, `pass`, `auth`, `prim`, `avatar`, `date_reg`) VALUES
(4, 'users', 'users', 'user', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, 0, '819680_69f26265-7f21-45a4-ba4f-7452fac8771e.jpg', '2023-01-19 20:58:18'),
(6, 'admin', 'administrat', 'administrator', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, 1, '946402_2613725-images (2).jpg', '2023-01-21 00:03:44'),
(7, 'zahaln', 'mohamed zah', 'manager ', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0, 0, '77536_b54117f5-453a-4df7-8739-a35b4eb2547a.jpg', '2023-01-21 01:48:22'),
(8, 'sayed', 'sayed not m', 'security', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, 1, '719664_28fb316d-578e-4bb7-a11c-0c12360be26c.jpg', '2023-01-21 13:54:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
