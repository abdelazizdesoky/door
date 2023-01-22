-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2023 at 05:00 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

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
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `id` int(11) NOT NULL,
  `card_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `door`
--

CREATE TABLE `door` (
  `id` int(11) NOT NULL,
  `door` varchar(11) NOT NULL,
  `place` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `door`
--

INSERT INTO `door` (`id`, `door`, `place`) VALUES
(1, 'main', 'mosasaa'),
(16, 'getway1', 'mosasaa'),
(17, 'getway2', 'mosasaa');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `card` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `door` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date_status` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
  `card` int(11) NOT NULL,
  `prim` int(11) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `date_reg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user`, `name`, `position`, `pass`, `auth`, `card`, `prim`, `avatar`, `date_reg`) VALUES
(4, 'users', 'users', 'user', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0, 0, 0, '190810_8521161-images (2).jpg', '2023-01-19 20:58:18'),
(6, 'admin', 'administrat', 'administrator', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, 0, 1, '190810_8521161-images (2).jpg', '2023-01-21 00:03:44'),
(7, 'zahaln', 'mohamed zah', 'manager ', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, 0, 0, '190810_8521161-images (2).jpg', '2023-01-21 01:48:22'),
(8, 'sayed', 'sayed not m', 'security', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, 0, 1, '464379_15c9c86c-80ab-4e92-95e4-88cf832ce165.jpg', '2023-01-21 13:54:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `door`
--
ALTER TABLE `door`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `const_1` (`card`),
  ADD KEY `const_2` (`door`),
  ADD KEY `const_3` (`user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `card`
--
ALTER TABLE `card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `door`
--
ALTER TABLE `door`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `const_1` FOREIGN KEY (`card`) REFERENCES `card` (`id`),
  ADD CONSTRAINT `const_2` FOREIGN KEY (`door`) REFERENCES `door` (`id`),
  ADD CONSTRAINT `const_3` FOREIGN KEY (`user`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
