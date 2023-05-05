-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2023 at 10:37 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_project_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `car_name` varchar(200) NOT NULL,
  `car_model` varchar(100) NOT NULL,
  `car_manufacturer` varchar(100) NOT NULL,
  `license_plate_number` varchar(100) NOT NULL,
  `vin_number` varchar(100) NOT NULL,
  `insurance_company_name` varchar(200) NOT NULL,
  `other_details` text NOT NULL,
  `car_image` varchar(200) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `car_name`, `car_model`, `car_manufacturer`, `license_plate_number`, `vin_number`, `insurance_company_name`, `other_details`, `car_image`, `date_created`) VALUES
(14, '2163146', '3213651351', '321365135', '3213513', '2135135', '10314531', '', 'S__23928857-car-image-1682248112.jpg', '2023-04-08');

-- --------------------------------------------------------

--
-- Table structure for table `insure`
--

CREATE TABLE `insure` (
  `id` int(11) NOT NULL,
  `ins_com_name` varchar(200) NOT NULL,
  `ins_com_address` varchar(100) NOT NULL,
  `ins_com_phone` varchar(100) NOT NULL,
  `ins_com_number` varchar(100) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `insure`
--

INSERT INTO `insure` (`id`, `ins_com_name`, `ins_com_address`, `ins_com_phone`, `ins_com_number`, `date_created`) VALUES
(7, 'AAAAAA', 'BBBBBB', 'C', '123456789', '2023-04-23');

-- --------------------------------------------------------

--
-- Table structure for table `part1`
--

CREATE TABLE `part1` (
  `id` int(11) NOT NULL,
  `Part_car_name` varchar(200) NOT NULL,
  `Part_car_model` varchar(100) NOT NULL,
  `Part_car_manufacturer` varchar(100) NOT NULL,
  `Part_license_plate_number` varchar(100) NOT NULL,
  `Part_number` varchar(100) NOT NULL,
  `Part_store_name` varchar(200) NOT NULL,
  `other_details` text NOT NULL,
  `Part_car_image` varchar(200) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `part1`
--

INSERT INTO `part1` (`id`, `Part_car_name`, `Part_car_model`, `Part_car_manufacturer`, `Part_license_plate_number`, `Part_number`, `Part_store_name`, `other_details`, `Part_car_image`, `date_created`) VALUES
(7, 'sf;gkp[ok', 'f\'sd;lkg[pk', '\'d[s;fhlk[p]k', 'd\';flkb[espk', '\'[s;fkb[swp;k', '\'vs;fkb[;kf', '', 'S__23928857-car-image-1682248455.jpg', '2023-04-23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `status`, `created_at`) VALUES
(2, 'burburbur', 'burburbur', 'burburbur@gmail.com', '25f9e794323b453885f5181f1b624d0b', 1, '1585449290'),
(7, 'Tarathep', 'R.', 'teelovesssru@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '2023-02-21 07:03:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `insure`
--
ALTER TABLE `insure`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `part1`
--
ALTER TABLE `part1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `insure`
--
ALTER TABLE `insure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `part1`
--
ALTER TABLE `part1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
