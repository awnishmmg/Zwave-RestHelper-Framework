-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2021 at 05:46 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.3.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aaracgzs_ezy`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_apidoc_headers`
--

CREATE TABLE `tbl_apidoc_headers` (
  `header_id` int(11) NOT NULL,
  `base` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_apidoc_headers`
--

INSERT INTO `tbl_apidoc_headers` (`header_id`, `base`, `title`, `description`, `created_by`, `created_at`, `status`) VALUES
(1, 'role', 'How to Get All Roles ', NULL, NULL, '2020-12-02 10:33:44', 1),
(2, 'mega_category', 'How to get Main Category', NULL, NULL, '2020-12-02 16:35:51', 1),
(3, 'category', 'How to get All get Category', NULL, NULL, '2020-12-03 05:38:33', 1),
(4, 'subcategory', 'How to get Sub category', NULL, NULL, '2020-12-03 08:37:22', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_apidoc_headers`
--
ALTER TABLE `tbl_apidoc_headers`
  ADD PRIMARY KEY (`header_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_apidoc_headers`
--
ALTER TABLE `tbl_apidoc_headers`
  MODIFY `header_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
