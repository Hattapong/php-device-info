-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2022 at 04:37 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `device_info`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_device`
--

CREATE TABLE `customer_device` (
  `customer_id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_device`
--

INSERT INTO `customer_device` (`customer_id`, `device_id`) VALUES
(1, 1),
(1, 3),
(2, 6),
(2, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_device`
--
ALTER TABLE `customer_device`
  ADD PRIMARY KEY (`customer_id`,`device_id`),
  ADD KEY `device_id` (`device_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_device`
--
ALTER TABLE `customer_device`
  ADD CONSTRAINT `customer_device_ibfk_1` FOREIGN KEY (`device_id`) REFERENCES `device` (`id`),
  ADD CONSTRAINT `customer_device_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
