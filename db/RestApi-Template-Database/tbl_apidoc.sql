-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2021 at 05:45 PM
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
-- Table structure for table `tbl_apidoc`
--

CREATE TABLE `tbl_apidoc` (
  `apidoc_id` int(11) NOT NULL,
  `header_id` int(11) DEFAULT NULL,
  `http` enum('HTTP/1.1','HTTPS/1.1','FTP/1.1','FTPS/1.1','NONE') DEFAULT NULL,
  `status_code` varchar(255) DEFAULT '200',
  `method` varchar(20) DEFAULT NULL,
  `routes` text DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `keyname` text DEFAULT NULL,
  `response_type` varchar(20) DEFAULT 'json',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_apidoc`
--

INSERT INTO `tbl_apidoc` (`apidoc_id`, `header_id`, `http`, `status_code`, `method`, `routes`, `label`, `keyname`, `response_type`, `description`) VALUES
(1, 1, 'HTTP/1.1', '200', 'GET', 'role', 'All Roles', 'keyname = Na', 'json', 'Get All Records'),
(2, 2, 'HTTP/1.1', '200', 'GET', 'mega_category', 'Main Category', 'keyname=mega_cat_id,name,status,created_at,title,description,image_path,unicode,height,width\r\n', 'json', 'This is Megacategory shown in the web as part of module'),
(3, 3, 'HTTP/1.1', '200', 'GET', 'banner', 'Front Banner ', 'keyname = banner_slider_id,frontend_master_id,banner_title,banner_slogan,banner_resourcen,banner_redirect,status', 'json', 'Get All the Resources files for the links,cdn path that can be added to front End Slider'),
(4, 3, 'HTTP/1.1', '200', 'GET', 'category', 'All Category', 'keyname = cat_id ,mega_cat_id,category,status,created_by,created_at', 'json', 'Please Note in order to get category use the meta_category Api and get the Keyname = mega_cat_id from mega_Category Api and then use this api with endpoint mega_category as a url with any perticular Id specified for the Any Product.'),
(5, 4, 'HTTP/1.1', '200', 'GET', 'subcategory', 'All Subcategory', 'keyname = subcat_id ,cat_id,subcategory,status,created_by,created_at', 'json', 'Get all the Subcategories and fetch single api`s According cat_id.'),
(6, NULL, 'HTTP/1.1', '200', 'POST', 'findshop', 'Find All the Shops According to Lat and Long', 'keyname = shop_latitude	,shop_longitude,distance_km', 'json', 'You have to pass these keyname in post method and Raw json format only keyname are case sensitive.'),
(7, NULL, 'HTTP/1.1', '200', 'GET', 'findproduct_fromshop', 'Get All the Products', 'keyname = cat_id', 'json', NULL),
(8, NULL, 'HTTP/1.1', '200', 'POST', 'login', 'General User login using email and password', 'keyname = email,password', 'json', 'You have to pass these keyname in post method and Raw json format only keyname are case sensitive.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_apidoc`
--
ALTER TABLE `tbl_apidoc`
  ADD PRIMARY KEY (`apidoc_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_apidoc`
--
ALTER TABLE `tbl_apidoc`
  MODIFY `apidoc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
