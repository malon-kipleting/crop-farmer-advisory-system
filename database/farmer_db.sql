-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 28, 2023 at 02:48 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `farmer_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_details`
--

CREATE TABLE `activity_details` (
  `id` int(11) NOT NULL,
  `activity_id` int(45) NOT NULL,
  `activity_name` int(255) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `advice_details`
--

CREATE TABLE `advice_details` (
  `id` int(11) NOT NULL,
  `advice_id` varchar(255) NOT NULL,
  `advice_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `county_details`
--

CREATE TABLE `county_details` (
  `id` int(11) NOT NULL,
  `county_id` varchar(20) NOT NULL,
  `county_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `county_details`
--

INSERT INTO `county_details` (`id`, `county_id`, `county_name`) VALUES
(1, 'county001', 'Mombasa'),
(2, 'county002', 'Kilifi');

-- --------------------------------------------------------

--
-- Table structure for table `crop_details`
--

CREATE TABLE `crop_details` (
  `id` int(11) NOT NULL,
  `crop_id` varchar(20) NOT NULL,
  `crop_name` varchar(255) NOT NULL,
  `date_added` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `crop_details`
--

INSERT INTO `crop_details` (`id`, `crop_id`, `crop_name`, `date_added`) VALUES
(1, 'crp01', 'Maize', '12-02-2022');

-- --------------------------------------------------------

--
-- Table structure for table `crop_farm_details`
--

CREATE TABLE `crop_farm_details` (
  `id` int(11) NOT NULL,
  `farm_id` varchar(45) NOT NULL,
  `crop_id` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `extension_officer`
--

CREATE TABLE `extension_officer` (
  `officer_id` int(45) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `officer_email` varchar(255) NOT NULL,
  `officer_phone` int(10) NOT NULL,
  `officer_password` varchar(255) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `farmer_details`
--

CREATE TABLE `farmer_details` (
  `id` int(11) NOT NULL,
  `farmer_id` varchar(40) NOT NULL,
  `farmer_fname` varchar(100) NOT NULL,
  `farmer_lname` varchar(100) NOT NULL,
  `farmer_email` varchar(50) NOT NULL,
  `farmer_phone` varchar(50) NOT NULL,
  `Gender` varchar(50) NOT NULL,
  `farmer_password` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `farmer_details`
--

INSERT INTO `farmer_details` (`id`, `farmer_id`, `farmer_fname`, `farmer_lname`, `farmer_email`, `farmer_phone`, `Gender`, `farmer_password`, `date_added`) VALUES
(1, '37505349', 'Benson', 'Makau', 'benson.m@blinx.co.ke', '758413462', 'Male', 'ebcfd5a11d7cf5ba89f838fc766be7a4', '2023-03-04 12:06:21'),
(2, '37756501', 'Malon', 'Kipleting', 'malonkipleting790@gmail.com', '713447936', 'Male', 'f74d8ed4e85c18a2ecccf397d5a60c33', '2023-03-04 12:06:21');

-- --------------------------------------------------------

--
-- Table structure for table `farmer_request_advice_details`
--

CREATE TABLE `farmer_request_advice_details` (
  `id` int(11) NOT NULL,
  `request_id` varchar(100) NOT NULL,
  `farmer_id` int(11) NOT NULL,
  `farm_id` int(11) NOT NULL,
  `crop_id` int(45) NOT NULL,
  `soil_id` int(45) NOT NULL,
  `activity_id` int(45) NOT NULL,
  `short_description` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `farm_details`
--

CREATE TABLE `farm_details` (
  `id` int(11) NOT NULL,
  `farm_id` varchar(255) NOT NULL,
  `farm_name` varchar(255) NOT NULL,
  `farm_location` varchar(255) NOT NULL,
  `farm_size` varchar(100) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `farm_details`
--

INSERT INTO `farm_details` (`id`, `farm_id`, `farm_name`, `farm_location`, `farm_size`, `date_added`) VALUES
(1, 'frm01', 'Maseno-H1', 'county001', '', '2023-03-04 12:08:18');

-- --------------------------------------------------------

--
-- Table structure for table `officer_advice_details`
--

CREATE TABLE `officer_advice_details` (
  `id` int(11) NOT NULL,
  `advice_id` varchar(100) NOT NULL,
  `officer_id` int(45) NOT NULL,
  `farmer_request_id` varchar(100) NOT NULL,
  `advice_description` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `soil_details`
--

CREATE TABLE `soil_details` (
  `id` int(11) NOT NULL,
  `soil_id` int(11) NOT NULL,
  `soil_name` int(11) NOT NULL,
  `soil_property` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_details`
--
ALTER TABLE `activity_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `act_id` (`activity_id`);

--
-- Indexes for table `advice_details`
--
ALTER TABLE `advice_details`
  ADD PRIMARY KEY (`advice_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `county_details`
--
ALTER TABLE `county_details`
  ADD PRIMARY KEY (`county_id`),
  ADD UNIQUE KEY `idd` (`id`);

--
-- Indexes for table `crop_details`
--
ALTER TABLE `crop_details`
  ADD PRIMARY KEY (`crop_id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `crop_farm_details`
--
ALTER TABLE `crop_farm_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `farm_idddd` (`farm_id`),
  ADD KEY `crpiddd` (`crop_id`);

--
-- Indexes for table `extension_officer`
--
ALTER TABLE `extension_officer`
  ADD KEY `id` (`officer_id`);

--
-- Indexes for table `farmer_details`
--
ALTER TABLE `farmer_details`
  ADD PRIMARY KEY (`farmer_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `farmer_request_advice_details`
--
ALTER TABLE `farmer_request_advice_details`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `farm_details`
--
ALTER TABLE `farm_details`
  ADD PRIMARY KEY (`farm_id`),
  ADD KEY `id` (`id`),
  ADD KEY `farm_location` (`farm_location`);

--
-- Indexes for table `officer_advice_details`
--
ALTER TABLE `officer_advice_details`
  ADD PRIMARY KEY (`advice_id`),
  ADD KEY `fname` (`id`),
  ADD KEY `off_id` (`officer_id`),
  ADD KEY `farmer_request_id` (`farmer_request_id`);

--
-- Indexes for table `soil_details`
--
ALTER TABLE `soil_details`
  ADD PRIMARY KEY (`soil_id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_details`
--
ALTER TABLE `activity_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `advice_details`
--
ALTER TABLE `advice_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `county_details`
--
ALTER TABLE `county_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `crop_details`
--
ALTER TABLE `crop_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `crop_farm_details`
--
ALTER TABLE `crop_farm_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `farmer_details`
--
ALTER TABLE `farmer_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `farm_details`
--
ALTER TABLE `farm_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `officer_advice_details`
--
ALTER TABLE `officer_advice_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `soil_details`
--
ALTER TABLE `soil_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `crop_farm_details`
--
ALTER TABLE `crop_farm_details`
  ADD CONSTRAINT `crpidid` FOREIGN KEY (`crop_id`) REFERENCES `crop_details` (`crop_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `frmid` FOREIGN KEY (`farm_id`) REFERENCES `farm_details` (`farm_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `farm_details`
--
ALTER TABLE `farm_details`
  ADD CONSTRAINT `locid` FOREIGN KEY (`farm_location`) REFERENCES `county_details` (`county_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;