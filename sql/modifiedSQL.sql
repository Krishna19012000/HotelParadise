-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 10, 2019 at 10:30 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `brahmbhk_hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `cancellation`
--

CREATE TABLE `cancellation` (
  `cancellationId` int(11) NOT NULL,
  `reservationId` int(11) DEFAULT NULL,
  `cancelTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`name`, `email`, `message`, `time`) VALUES
('raj', 'raj', 'raj', '2019-07-30 22:13:35'),
('raja', 'asdas', 'asdas', '2019-07-30 22:14:50'),
('krishna', 'asdfds', 'sdf', '2019-07-30 22:15:01'),
('hgd', 'hf', 'khv', '2019-08-07 02:14:40');

-- --------------------------------------------------------

--
-- Table structure for table `customerInfo`
--

CREATE TABLE `customerInfo` (
  `customerId` int(11) NOT NULL,
  `firstName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phoneNo` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postalCode` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `loginId` int(11) NOT NULL,
  `userName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`loginId`, `userName`, `password`) VALUES
(6, 'root', 'root'),
(8, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `subscriptionEmail` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `createdDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`subscriptionEmail`, `createdDate`) VALUES
('rajj3798@gmail.com', '2019-08-10 02:02:12'),
('rajj3fsa', '2019-08-10 02:02:22');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentId` int(11) NOT NULL,
  `reservationId` int(11) DEFAULT NULL,
  `invoice` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `paid` tinyint(1) DEFAULT NULL,
  `paymentTime` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `roomId` int(11) NOT NULL,
  `roomDescription` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `beds` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tv` tinyint(1) DEFAULT NULL,
  `kitchen` tinyint(1) DEFAULT NULL,
  `bar` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`roomId`, `roomDescription`, `type`, `beds`, `price`, `status`, `tv`, `kitchen`, `bar`) VALUES
(2, 'Classic Double Bed room, High Floor, Balcony, Beach View', 'DoubleRoom', 2, 80, 'Available', 1, 0, 0),
(3, '', 'DeluxeRoom', 2, 120, 'Available', 1, 1, 1),
(4, '', 'DoubleRoom', 2, 80, 'Occupied', 1, 0, 0),
(6, 'Raj room', 'SIngle room', 1, 70, 'Available', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `roomReservation`
--

CREATE TABLE `roomReservation` (
  `roomReservationId` int(11) NOT NULL,
  `customerId` int(11) DEFAULT NULL,
  `roomId` int(11) DEFAULT NULL,
  `checkIn` datetime DEFAULT NULL,
  `checkOut` datetime DEFAULT NULL,
  `meal` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reserveTime` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cancellation`
--
ALTER TABLE `cancellation`
  ADD UNIQUE KEY `cancellationId` (`cancellationId`),
  ADD KEY `reservationId` (`reservationId`);

--
-- Indexes for table `customerInfo`
--
ALTER TABLE `customerInfo`
  ADD UNIQUE KEY `customerId` (`customerId`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD UNIQUE KEY `loginId` (`loginId`),
  ADD UNIQUE KEY `userName` (`userName`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD UNIQUE KEY `paymentId` (`paymentId`),
  ADD KEY `reservationId` (`reservationId`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD UNIQUE KEY `roomId` (`roomId`);

--
-- Indexes for table `roomReservation`
--
ALTER TABLE `roomReservation`
  ADD UNIQUE KEY `roomReservationId` (`roomReservationId`),
  ADD KEY `roomId` (`roomId`),
  ADD KEY `customerId` (`customerId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cancellation`
--
ALTER TABLE `cancellation`
  MODIFY `cancellationId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customerInfo`
--
ALTER TABLE `customerInfo`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `loginId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `roomId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roomReservation`
--
ALTER TABLE `roomReservation`
  MODIFY `roomReservationId` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cancellation`
--
ALTER TABLE `cancellation`
  ADD CONSTRAINT `cancellation_ibfk_1` FOREIGN KEY (`reservationId`) REFERENCES `roomReservation` (`roomReservationId`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`reservationId`) REFERENCES `roomReservation` (`roomReservationId`);

--
-- Constraints for table `roomReservation`
--
ALTER TABLE `roomReservation`
  ADD CONSTRAINT `roomreservation_ibfk_1` FOREIGN KEY (`roomId`) REFERENCES `room` (`roomId`),
  ADD CONSTRAINT `roomreservation_ibfk_2` FOREIGN KEY (`customerId`) REFERENCES `customerInfo` (`customerId`);
