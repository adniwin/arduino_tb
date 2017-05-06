-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 06, 2017 at 12:04 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sensor`
--

-- --------------------------------------------------------

--
-- Table structure for table `arduino`
--

CREATE TABLE `arduino` (
  `id` int(20) NOT NULL,
  `suhu` int(20) NOT NULL,
  `kelembapan` int(20) NOT NULL,
  `cahaya` int(20) NOT NULL,
  `waktu` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arduino`
--

INSERT INTO `arduino` (`id`, `suhu`, `kelembapan`, `cahaya`, `waktu`) VALUES
(1, 0, 0, 100, '2017-04-28 13:02:22'),
(2, 26, 55, 98, '2017-04-28 13:03:03'),
(3, 26, 55, 99, '2017-04-28 13:03:43'),
(4, 26, 55, 99, '2017-04-28 13:04:23'),
(5, 26, 56, 99, '2017-04-28 13:05:04'),
(6, 26, 55, 99, '2017-04-28 13:05:44'),
(7, 26, 55, 99, '2017-04-28 13:06:25'),
(8, 10, 100, 2000, '2017-05-06 10:46:18'),
(9, 1, 100, 2, '2017-05-06 10:46:44'),
(10, 100, 1000, 500, '2017-05-06 10:47:13'),
(11, 200, 100, 25, '2017-05-06 10:48:22'),
(12, 29, 180, 10, '2017-05-06 10:48:29'),
(13, 290, 1800, 100, '2017-05-06 10:48:37'),
(14, 80, 2900, 1000, '2017-05-06 10:49:21'),
(15, 80, 2900, 1000, '2017-05-06 10:49:33'),
(16, 80, 2900, 1000, '2017-05-06 10:49:33'),
(17, 50, 300, 500, '2017-05-06 10:49:57'),
(18, 50, 300, 500, '2017-05-06 10:49:57'),
(19, 50, 300, 500, '2017-05-06 10:49:58'),
(20, 50, 300, 500, '2017-05-06 10:49:58'),
(21, 50, 300, 500, '2017-05-06 10:49:58'),
(22, 50, 300, 500, '2017-05-06 10:49:58'),
(23, 50, 300, 500, '2017-05-06 10:49:58'),
(24, 50, 300, 500, '2017-05-06 10:49:58'),
(25, 50, 300, 500, '2017-05-06 10:49:59'),
(26, 50, 300, 500, '2017-05-06 10:49:59'),
(27, 5000, 300, 5000, '2017-05-06 10:50:17'),
(28, 50, 300, 50, '2017-05-06 10:50:29'),
(29, 100, 600, 1500, '2017-05-06 10:50:52');

-- --------------------------------------------------------

--
-- Table structure for table `prediction_history`
--

CREATE TABLE `prediction_history` (
  `id` int(11) NOT NULL,
  `temperature` int(11) NOT NULL,
  `humidity` int(11) NOT NULL,
  `light` int(11) NOT NULL,
  `prediction` varchar(100) NOT NULL,
  `time` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prediction_history`
--

INSERT INTO `prediction_history` (`id`, `temperature`, `humidity`, `light`, `prediction`, `time`) VALUES
(13, 231, 570, 617, 'Rainy', 'Saturday, 2017-05-06 12:03:07');

-- --------------------------------------------------------

--
-- Table structure for table `setting_website`
--

CREATE TABLE `setting_website` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `contact` varchar(20) NOT NULL,
  `email` text NOT NULL,
  `address` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `logo` text NOT NULL,
  `moto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting_website`
--

INSERT INTO `setting_website` (`id`, `name`, `description`, `contact`, `email`, `address`, `city`, `logo`, `moto`) VALUES
(1, 'Marskproperti.com', 'Marksproperti merupakan website dengan spesialis properti di Batu-Malang dengan menerapkan Marketing Strategy yang tepat sasaran bagi kebijakan pemasaran properti anda. Kami menerapkan Internet Marketing dan Social Media Marketing yang terintegrasi agar properti yang anda iklankan dapat menemukan customer potensial sesuai dengan target market anda.', '08962399782', 'admin@marksproperti.com', 'Batu', 'Batu Kota', 'MCQaF7mTYE.png', 'Melayani dengan senang hati');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `role` enum('A') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `name`, `role`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', 'administrator', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arduino`
--
ALTER TABLE `arduino`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prediction_history`
--
ALTER TABLE `prediction_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting_website`
--
ALTER TABLE `setting_website`
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
-- AUTO_INCREMENT for table `arduino`
--
ALTER TABLE `arduino`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `prediction_history`
--
ALTER TABLE `prediction_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `setting_website`
--
ALTER TABLE `setting_website`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
