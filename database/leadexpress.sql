-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2023 at 02:38 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `leadexpress`
--

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `dataID` int(11) NOT NULL,
  `fullName` varchar(256) NOT NULL,
  `email` varchar(320) NOT NULL,
  `phoneNumber` varchar(15) NOT NULL,
  `landline` varchar(15) NOT NULL,
  `streetNumber` varchar(52) NOT NULL,
  `streetName` varchar(512) NOT NULL,
  `suburb` varchar(512) NOT NULL,
  `postCode` varchar(5) NOT NULL,
  `businessName` varchar(512) NOT NULL,
  `abn` varchar(11) NOT NULL,
  `numberOfSolar` varchar(10) NOT NULL,
  `installationDateTime` datetime NOT NULL,
  `uploadedDateTime` timestamp NULL DEFAULT current_timestamp(),
  `staffName` varchar(512) NOT NULL,
  `note` text NOT NULL,
  `verifierComment` text DEFAULT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `status_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status_name`) VALUES
(1, 'Pending'),
(2, 'Confirmed'),
(3, 'Installed'),
(4, 'Rescheduled'),
(5, 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `userIdentity` int(11) NOT NULL,
  `userPermissionNumber` int(11) NOT NULL,
  `agentName` varchar(256) NOT NULL,
  `username` varchar(1024) NOT NULL,
  `password` varchar(1024) NOT NULL,
  `lastLogin` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`userIdentity`, `userPermissionNumber`, `agentName`, `username`, `password`, `lastLogin`) VALUES
(1, 1, 'Haitomns Groups', 'haitomnsgroups', '$2y$10$sQcmeDVkRWGua9SOkTB8F.bWw2OvBUXb9ugrE9pbF9JJC3FAS3guq', '2023-11-06 13:38:18');

-- --------------------------------------------------------

--
-- Table structure for table `userpermission`
--

CREATE TABLE `userpermission` (
  `permissionId` int(11) NOT NULL,
  `permissionName` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userpermission`
--

INSERT INTO `userpermission` (`permissionId`, `permissionName`) VALUES
(1, 'Central Supervisor'),
(2, 'Agent');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`dataID`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD PRIMARY KEY (`userIdentity`),
  ADD KEY `permissionConnection` (`userPermissionNumber`);

--
-- Indexes for table `userpermission`
--
ALTER TABLE `userpermission`
  ADD PRIMARY KEY (`permissionId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `dataID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `userdetails`
--
ALTER TABLE `userdetails`
  MODIFY `userIdentity` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `userpermission`
--
ALTER TABLE `userpermission`
  MODIFY `permissionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD CONSTRAINT `permissionConnection` FOREIGN KEY (`userPermissionNumber`) REFERENCES `userpermission` (`permissionId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
