-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2021 at 06:28 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hostel`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_owner_details`
--

CREATE TABLE `tbl_owner_details` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_owner_details`
--

INSERT INTO `tbl_owner_details` (`id`, `name`, `email`, `gender`, `phonenumber`, `address`, `adhaar`, `pincode`, `city`, `country`, `password`, `conpass`, `date`, `ip`, `status`) VALUES
(3, 'puneet', 'rawatpuneet2018@gmail.com', '', '', '', '', '', '', '', 'puneet', 'puneet', '26/05/21', '::1', 1),
(4, 'yukgujy', 'rawatpuneet2018@gmail.com', '', '', '', '', '', '', '', 'puneet', 'puneet', '26/05/21', '::1', 1),
(5, 'Puneet', 'gdjkglfdf@gmail.com', '', '8888988888', 'lahore', '755555385975893', '142342', 'lahore', 'pakistan', 'puneet', 'puneet', '28/05/21', '::1', 1),
(6, 'Puneet Rawat', 'rawatpuneet2018@gmail.com', 'female', '08427249355', 'guru nanak nagri , malout', '47868987689', '`15210', 'sri muktsar sahib', 'India', 'puneet', 'puneet', '28/05/21', '::1', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_owner_details`
--
ALTER TABLE `tbl_owner_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_owner_details`
--
ALTER TABLE `tbl_owner_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
