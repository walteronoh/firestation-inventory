-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2021 at 06:14 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `safety`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$mnUjenwZdKySpUAAHpYlOeD9mLhhMxhY7MAU7NWSm./rJ2/aALX2O');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `business_id` varchar(7) NOT NULL,
  `business_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `nature` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `subcounty` varchar(255) NOT NULL,
  `ward` varchar(255) NOT NULL,
  `created_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `business_id`, `business_name`, `address`, `nature`, `category`, `subcounty`, `ward`, `created_at`) VALUES
(3, 'gfjml97', 'Joyland', '100 Navakholo', 'hardware', 'A', 'Navakholo', 'Ingotse-matiha', '2021-04-25 15:10:14.000000'),
(5, 'qw5jhxu', 'Mumbo', '1-Matungu', 'Retailer', 'A', 'Matungu', 'Khalaba', '2021-04-25 15:14:43.000000'),
(7, 'vcy3us6', 'mooons', '2-ikolomani', 'wholesale', 'B', 'Ikolomani', 'Idakho central', '2021-04-25 18:59:12.000000'),
(8, 'mxrv1jw', 'sanwood', '6-lurambi', 'wholesale', 'B', 'Lurambi', 'Butsotso east', '2021-04-25 19:00:53.000000'),
(9, 'fqt4zri', 'Oklas', '4 lugari', 'retailer', 'C', 'Lugari', 'Chevagwa', '2021-04-25 21:06:07.000000'),
(10, 'wx4l0k2', 'Noooks', '9 lugari', 'super', 'B', 'Lugari', 'Mautuma', '2021-04-25 21:08:02.000000'),
(12, 'g71xas5', 'Bunyala brits', '8-Bunyala', 'home based', 'A', 'Navakholo', 'Bunyala west', '2021-04-25 21:13:41.000000');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `created_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item_name`, `created_at`) VALUES
(2, '9 ltrs Water', '2021-04-26 19:37:41.000000'),
(3, '9ltrs Air Foam', '2021-04-25 20:14:59.000000'),
(4, '5ltrs Air Foam', '2021-04-25 20:15:14.000000'),
(5, '5kgs Carbon Dioxide', '2021-04-25 20:15:51.000000'),
(6, '2Kgs Carbon Dioxide', '2021-04-25 20:18:37.000000'),
(7, '20Kgs Carbon Dioxide', '2021-04-25 21:28:40.000000'),
(8, '20Kgs Carbon Dioxide', '2021-04-25 21:29:59.000000'),
(9, '2Kgs Carbon Dioxide', '2021-04-25 21:31:45.000000');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `service` int(11) NOT NULL,
  `repair` int(11) NOT NULL,
  `refill` int(11) NOT NULL,
  `supply` int(11) NOT NULL,
  `business_name` varchar(255) NOT NULL,
  `created_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `item_name`, `service`, `repair`, `refill`, `supply`, `business_name`, `created_at`) VALUES
(10, '5kgs Carbon Dioxide', 4, 4, 35, 5, 'Bunyala brits', '2021-04-27 19:23:20.000000'),
(11, '9 ltrs Water', 656, 0, 0, 4563, 'Bunyala brits', '2021-04-27 19:31:16.000000'),
(12, '5kgs Carbon Dioxide', 45, 525, 0, 0, 'Bunyala brits', '2021-04-27 19:32:29.000000'),
(13, '20Kgs Carbon Dioxide', 5246, 62624, 626, 254, 'Bunyala brits', '2021-04-27 19:34:35.000000'),
(14, '2Kgs Carbon Dioxide', 4523, 44, 0, 0, 'Bunyala brits', '2021-04-27 19:39:14.000000'),
(15, '5ltrs Air Foam', 453, 35, 0, 0, 'Bunyala brits', '2021-04-27 19:54:00.000000'),
(16, '2Kgs Carbon Dioxide', 435, 634, 0, 0, 'Bunyala brits', '2021-04-27 19:56:01.000000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
