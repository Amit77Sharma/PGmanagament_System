-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2021 at 01:06 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hostel`
--

-- --------------------------------------------------------

--
-- Table structure for table `ownerprofile_uploading`
--

CREATE TABLE IF NOT EXISTS `ownerprofile_uploading` (
`id` bigint(20) NOT NULL,
  `ownerid` bigint(20) NOT NULL,
  `imagename` varchar(50) NOT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `ownerprofile_uploading`
--

INSERT INTO `ownerprofile_uploading` (`id`, `ownerid`, `imagename`, `status`) VALUES
(3, 1, 'uploads/19-512.png', 0),
(8, 2, 'uploads/20190106_181535.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bed_room_details`
--

CREATE TABLE IF NOT EXISTS `tbl_bed_room_details` (
`id` bigint(20) NOT NULL,
  `room_id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `satus` int(1) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tbl_bed_room_details`
--

INSERT INTO `tbl_bed_room_details` (`id`, `room_id`, `name`, `satus`) VALUES
(1, 1, 'Bed', 0),
(2, 1, 'Pillow & cover', 0),
(3, 1, 'Almirah', 0),
(4, 1, 'Light', 0),
(5, 1, 'fan', 0),
(6, 1, 'mattress', 0),
(7, 2, 'Bed', 0),
(8, 2, 'Light', 0),
(9, 2, 'fan', 0),
(10, 3, 'Bed', 0),
(11, 3, 'Light', 0),
(12, 3, 'fan', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_common_area_detail`
--

CREATE TABLE IF NOT EXISTS `tbl_common_area_detail` (
`id` bigint(20) NOT NULL,
  `room_id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_common_area_detail`
--

INSERT INTO `tbl_common_area_detail` (`id`, `room_id`, `name`, `status`) VALUES
(1, 1, 'Tv', 0),
(2, 1, 'Washing machine', 0),
(3, 1, 'Dinning table', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kitchen_details`
--

CREATE TABLE IF NOT EXISTS `tbl_kitchen_details` (
`id` bigint(20) NOT NULL,
  `room_id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `staus` int(1) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_kitchen_details`
--

INSERT INTO `tbl_kitchen_details` (`id`, `room_id`, `name`, `staus`) VALUES
(1, 1, 'RO water', 0),
(2, 1, 'Gas cylinder', 0),
(3, 1, 'Kitchen set', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_owner_details`
--

CREATE TABLE IF NOT EXISTS `tbl_owner_details` (
`id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `phonenumber` varchar(13) NOT NULL,
  `address` text NOT NULL,
  `adhaar` varchar(15) NOT NULL,
  `pincode` varchar(6) NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `conpass` varchar(50) NOT NULL,
  `date` varchar(30) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_owner_details`
--

INSERT INTO `tbl_owner_details` (`id`, `name`, `email`, `gender`, `phonenumber`, `address`, `adhaar`, `pincode`, `city`, `country`, `password`, `conpass`, `date`, `ip`, `status`) VALUES
(1, 'Puneet Rawat', 'rawatpuneet2018@gmail.com', 'others', '08427249355', 'guru nanak nagri , malout', '123456789009876', '`15210', 'sri muktsar sahib', 'India', 'puneet', 'puneet', '01/06/21', '::1', 1),
(2, 'Ajeet kumar Prasad', 'aj15cs011@gmail.com', 'male', '9534201023', 'Jharkhand', '123456789009876', '829116', 'Bokaro', 'India', 'abcd1234', 'abcd1234', '03/06/21', '::1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_room_details`
--

CREATE TABLE IF NOT EXISTS `tbl_room_details` (
`id` bigint(20) NOT NULL,
  `appartment` varchar(500) NOT NULL,
  `roomno` varchar(4) NOT NULL,
  `type_id` bigint(20) NOT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_room_details`
--

INSERT INTO `tbl_room_details` (`id`, `appartment`, `roomno`, `type_id`, `status`) VALUES
(1, 'Alka Residency', '3', 2, 0),
(2, 'Modi House', '1', 3, 0),
(3, 'Modi House', '1', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_room_image`
--

CREATE TABLE IF NOT EXISTS `tbl_room_image` (
`id` bigint(20) NOT NULL,
  `room_id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `loc` text NOT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_room_image`
--

INSERT INTO `tbl_room_image` (`id`, `room_id`, `name`, `loc`, `status`) VALUES
(1, 2, '20190106_181851.jpg', 'uploads/2', 0),
(2, 1, 'main-qimg-4a73bd34ecca82ff1e2fff2f2ec3dc73.png', 'uploads/1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_room_type`
--

CREATE TABLE IF NOT EXISTS `tbl_room_type` (
`id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_room_type`
--

INSERT INTO `tbl_room_type` (`id`, `name`, `status`) VALUES
(2, 'Single room (common washroom)', 0),
(3, 'Single room (attached washroom)', 0),
(4, '1BHK', 0),
(5, '2BHK', 0),
(6, '3BHK', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ownerprofile_uploading`
--
ALTER TABLE `ownerprofile_uploading`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_bed_room_details`
--
ALTER TABLE `tbl_bed_room_details`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_common_area_detail`
--
ALTER TABLE `tbl_common_area_detail`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_kitchen_details`
--
ALTER TABLE `tbl_kitchen_details`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_owner_details`
--
ALTER TABLE `tbl_owner_details`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_room_details`
--
ALTER TABLE `tbl_room_details`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_room_image`
--
ALTER TABLE `tbl_room_image`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_room_type`
--
ALTER TABLE `tbl_room_type`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ownerprofile_uploading`
--
ALTER TABLE `ownerprofile_uploading`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_bed_room_details`
--
ALTER TABLE `tbl_bed_room_details`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tbl_common_area_detail`
--
ALTER TABLE `tbl_common_area_detail`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_kitchen_details`
--
ALTER TABLE `tbl_kitchen_details`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_owner_details`
--
ALTER TABLE `tbl_owner_details`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_room_details`
--
ALTER TABLE `tbl_room_details`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_room_image`
--
ALTER TABLE `tbl_room_image`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_room_type`
--
ALTER TABLE `tbl_room_type`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
