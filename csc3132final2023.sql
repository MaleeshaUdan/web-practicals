-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2023 at 04:40 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `csc3132final2023`
--

-- --------------------------------------------------------

--
-- Table structure for table `fuel_log`
--

CREATE TABLE `fuel_log` (
  `log_id` int(11) NOT NULL,
  `vehicle_no` varchar(10) NOT NULL,
  `fuel_used` int(11) NOT NULL,
  `used_date` date NOT NULL,
  `next_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fuel_log`
--

INSERT INTO `fuel_log` (`log_id`, `vehicle_no`, `fuel_used`, `used_date`, `next_date`) VALUES
(2, 'CAD7823', 10, '2023-02-08', '2023-02-15'),
(4, 'BGS6096', 4, '2023-02-28', '2023-03-02'),
(14, 'BCD4563', 4, '2023-03-01', '2023-03-08'),
(21, 'CAD7823', 2, '2023-02-01', '2023-02-08'),
(22, 'CAD7823', 4, '2023-03-01', '2023-03-08');

-- --------------------------------------------------------

--
-- Table structure for table `logintb`
--

CREATE TABLE `logintb` (
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logintb`
--

INSERT INTO `logintb` (`username`, `password`) VALUES
('RFG456', 'abc@123'),
('RFG781', 'asd@456');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_info`
--

CREATE TABLE `vehicle_info` (
  `vehicle_no` varchar(10) NOT NULL,
  `vehicle_type` varchar(50) NOT NULL,
  `Owner` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicle_info`
--

INSERT INTO `vehicle_info` (`vehicle_no`, `vehicle_type`, `Owner`) VALUES
('ASX4793', 'three-wheeler', 'Maran'),
('ASX7812', 'three-wheeler', 'Chathura'),
('BCD4563', 'two-wheeler', 'Ravi'),
('BCV5621', 'two-wheeler', 'Bandara'),
('BGS6096', 'two-wheeler', 'Gopi'),
('CAD7823', 'two-wheeler', 'Anne'),
('KS1430', 'four-wheeler', 'Ramzi');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_types`
--

CREATE TABLE `vehicle_types` (
  `Type` varchar(50) NOT NULL,
  `Fuel_limit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicle_types`
--

INSERT INTO `vehicle_types` (`Type`, `Fuel_limit`) VALUES
('four-wheeler', 20),
('three-wheeler', 10),
('two-wheeler', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fuel_log`
--
ALTER TABLE `fuel_log`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `vno_fk` (`vehicle_no`);

--
-- Indexes for table `logintb`
--
ALTER TABLE `logintb`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `vehicle_info`
--
ALTER TABLE `vehicle_info`
  ADD PRIMARY KEY (`vehicle_no`),
  ADD KEY `vtype_fk` (`vehicle_type`);

--
-- Indexes for table `vehicle_types`
--
ALTER TABLE `vehicle_types`
  ADD PRIMARY KEY (`Type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fuel_log`
--
ALTER TABLE `fuel_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fuel_log`
--
ALTER TABLE `fuel_log`
  ADD CONSTRAINT `vno_fk` FOREIGN KEY (`vehicle_no`) REFERENCES `vehicle_info` (`vehicle_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vehicle_info`
--
ALTER TABLE `vehicle_info`
  ADD CONSTRAINT `vtype_fk` FOREIGN KEY (`vehicle_type`) REFERENCES `vehicle_types` (`Type`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
