-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 25, 2019 at 01:00 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `safemedpharmacy`
--

-- --------------------------------------------------------

--
-- Table structure for table `dim_category`
--

DROP TABLE IF EXISTS `dim_category`;
CREATE TABLE IF NOT EXISTS `dim_category` (
  `category_id` int(30) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `date_added` varchar(100) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dim_category`
--

INSERT INTO `dim_category` (`category_id`, `category_name`, `added_by`, `date_added`) VALUES
(1, 'Medicine', 'Super Admin', 'April 2, 2019'),
(2, 'Non-medicine', 'Super Admin', 'April 4, 2019');

-- --------------------------------------------------------

--
-- Table structure for table `dim_inventory`
--

DROP TABLE IF EXISTS `dim_inventory`;
CREATE TABLE IF NOT EXISTS `dim_inventory` (
  `item_id` int(30) NOT NULL AUTO_INCREMENT,
  `ref_num` int(11) DEFAULT NULL,
  `brand_name` varchar(200) NOT NULL,
  `generic_name` varchar(200) NOT NULL,
  `uom` varchar(100) NOT NULL,
  `supplier` varchar(100) NOT NULL,
  `defective_qty` int(30) NOT NULL,
  `order_qty` int(30) NOT NULL,
  `unit_price` double(10,2) NOT NULL,
  `selling_price` double(10,2) NOT NULL,
  `total_price` double(10,2) NOT NULL,
  `category` varchar(100) NOT NULL,
  `expiration_date` date NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `date_added` date NOT NULL,
  `status` varchar(100) NOT NULL,
  `sku` int(30) NOT NULL,
  `stock_count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dim_inventory`
--

INSERT INTO `dim_inventory` (`item_id`, `ref_num`, `brand_name`, `generic_name`, `uom`, `supplier`, `defective_qty`, `order_qty`, `unit_price`, `selling_price`, `total_price`, `category`, `expiration_date`, `added_by`, `date_added`, `status`, `sku`, `stock_count`) VALUES
(108, 1108, 'RANITIDINE ', 'RANIPHIL', '300mg TAB', 'Life & Health Dist.', 0, 99, 10.25, 31.00, 1014.75, 'MEDICINE', '2019-11-01', 'Super Admin', '2019-04-21', 'Received', 82, 18),
(115, 1115, 'TAMSULOSIN ', 'SULTAM', '200mcg TAB', 'Life & Health Dist.', 0, 674, 0.95, 5.00, 640.30, 'MEDICINE', '2020-04-01', 'Super Admin', '2019-04-24', 'Filed', 89, 0),
(116, 1116, 'Generic', 'ALLOPURINOL ', '100mg TAB', 'Excelsis (Ritemed)', 0, 5, 5.50, 8.25, 27.50, 'MEDICINE', '2019-11-19', 'Super Admin', '2019-04-24', 'Filed', 99, 0),
(117, 1117, 'RANITIDINE ', 'RANIPHIL', '300mg TAB', 'Life & Health Dist.', 0, 99, 10.25, 31.00, 1014.75, 'MEDICINE', '2019-11-01', 'Super Admin', '2019-04-24', 'Received', 82, 99);

-- --------------------------------------------------------

--
-- Table structure for table `dim_loghistory`
--

DROP TABLE IF EXISTS `dim_loghistory`;
CREATE TABLE IF NOT EXISTS `dim_loghistory` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `login_type` varchar(100) NOT NULL,
  `date_login` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dim_loghistory`
--

INSERT INTO `dim_loghistory` (`id`, `username`, `name`, `login_type`, `date_login`) VALUES
(1, 'admin', 'Super Admin', 'Super Admin', 'March 27, 2019 12:51:am  '),
(2, 'admin', 'Super Admin', 'Super Admin', 'March 27, 2019 11:27:am  '),
(3, 'jen123', 'Admin 1', 'Admin', 'March 27, 2019 11:29:am  '),
(4, 'lyka123', 'Pharmacist Assistant', 'Pharmacist Assistant', 'March 27, 2019 11:29:am  '),
(5, 'admin', 'Super Admin', 'Super Admin', 'March 27, 2019 1:47:pm  '),
(6, 'admin', 'Super Admin', 'Super Admin', 'March 27, 2019 5:51:pm  '),
(7, 'lyka123', 'Pharmacist Assistant', 'Pharmacist Assistant', 'March 27, 2019 6:11:pm  '),
(8, 'admin', 'Super Admin', 'Super Admin', 'March 27, 2019 6:30:pm  '),
(9, 'admin', 'Super Admin', 'Super Admin', 'March 31, 2019 9:22:pm  '),
(10, 'admin', 'Super Admin', 'Super Admin', 'March 31, 2019 9:57:pm  '),
(11, 'admin', 'Super Admin', 'Super Admin', 'March 31, 2019 11:36:pm  '),
(12, 'admin', 'Super Admin', 'Super Admin', 'April 1, 2019 12:32:am  '),
(13, 'admin', 'Super Admin', 'Super Admin', 'April 1, 2019 3:25:am  '),
(14, 'admin', 'Super Admin', 'Super Admin', 'April 1, 2019 11:59:pm  '),
(15, 'admin', 'Super Admin', 'Super Admin', 'April 2, 2019 1:42:am  '),
(16, 'admin', 'Super Admin', 'Super Admin', 'April 2, 2019 2:49:am  '),
(17, 'admin', 'Super Admin', 'Super Admin', 'April 2, 2019 12:08:pm  '),
(18, 'admin', 'Super Admin', 'Super Admin', 'April 2, 2019 1:00:pm  '),
(19, 'admin', 'Super Admin', 'Super Admin', 'April 2, 2019 10:13:pm  '),
(20, 'admin', 'Super Admin', 'Super Admin', 'April 4, 2019 1:13:am  '),
(21, 'admin', 'Super Admin', 'Super Admin', 'April 4, 2019 1:17:am  '),
(22, 'admin', 'Super Admin', 'Super Admin', 'April 8, 2019 1:06:am  '),
(23, 'admin', 'Super Admin', 'Super Admin', 'April 8, 2019 11:27:pm  '),
(24, 'admin', 'Super Admin', 'Super Admin', 'April 9, 2019 10:42:am  '),
(25, 'admin', 'Super Admin', 'Super Admin', 'April 9, 2019 10:29:pm  '),
(26, 'admin', 'Super Admin', 'Super Admin', 'April 9, 2019 11:14:pm  '),
(27, 'admin', 'Super Admin', 'Super Admin', 'April 10, 2019 12:00:am  '),
(28, 'admin', 'Super Admin', 'Super Admin', 'April 10, 2019 2:08:pm  '),
(29, 'admin', 'Super Admin', 'Super Admin', 'April 10, 2019 3:23:pm  '),
(30, 'admin', 'Super Admin', 'Super Admin', 'April 10, 2019 7:18:pm  '),
(31, 'admin', 'Super Admin', 'Super Admin', 'April 11, 2019 11:00:pm  '),
(32, 'admin', 'Super Admin', 'Super Admin', 'April 12, 2019 9:25:pm  '),
(33, 'admin', 'Super Admin', 'Super Admin', 'April 13, 2019 7:16:pm  '),
(34, 'admin', 'Super Admin', 'Super Admin', 'April 13, 2019 11:25:pm  '),
(35, 'admin', 'Super Admin', 'Super Admin', 'April 14, 2019 6:26:pm  '),
(36, 'admin', 'Super Admin', 'Super Admin', 'April 14, 2019 10:27:pm  '),
(37, 'admin', 'Super Admin', 'Super Admin', 'April 15, 2019 9:21:am  '),
(38, 'admin', 'Super Admin', 'Super Admin', 'April 15, 2019 9:30:am  '),
(39, 'admin', 'Super Admin', 'Super Admin', 'April 15, 2019 10:34:am  '),
(40, 'admin', 'Super Admin', 'Super Admin', 'April 16, 2019 12:41:pm  '),
(41, 'admin', 'Super Admin', 'Super Admin', 'April 16, 2019 8:25:pm  '),
(42, 'admin', 'Super Admin', 'Super Admin', 'April 17, 2019 10:15:am  '),
(43, 'admin', 'Super Admin', 'Super Admin', 'April 17, 2019 11:21:pm  '),
(44, 'admin', 'Super Admin', 'Super Admin', 'April 18, 2019 9:16:am  '),
(45, 'admin', 'Super Admin', 'Super Admin', 'April 18, 2019 11:47:am  '),
(46, 'admin', 'Super Admin', 'Super Admin', 'April 18, 2019 1:53:pm  '),
(47, 'admin', 'Super Admin', 'Super Admin', 'April 18, 2019 3:54:pm  '),
(48, 'admin', 'Super Admin', 'Super Admin', 'April 18, 2019 4:37:pm  '),
(49, 'admin', 'Super Admin', 'Super Admin', 'April 18, 2019 8:27:pm  '),
(50, 'admin', 'Super Admin', 'Super Admin', 'April 18, 2019 11:14:pm  '),
(51, 'admin', 'Super Admin', 'Super Admin', 'April 19, 2019 9:49:am  '),
(52, 'admin', 'Super Admin', 'Super Admin', 'April 19, 2019 10:19:am  '),
(53, 'admin', 'Super Admin', 'Super Admin', 'April 19, 2019 12:40:pm  '),
(54, 'admin', 'Super Admin', 'Super Admin', 'April 19, 2019 4:32:pm  '),
(55, 'admin', 'Super Admin', 'Super Admin', 'April 19, 2019 9:51:pm  '),
(56, 'admin', 'Super Admin', 'Super Admin', 'April 20, 2019 12:07:pm  '),
(57, 'admin', 'Super Admin', 'Super Admin', 'April 21, 2019 11:36:am  '),
(58, 'admin', 'Super Admin', 'Super Admin', 'April 21, 2019 8:49:pm  '),
(59, 'admin', 'Super Admin', 'Super Admin', 'April 22, 2019 11:02:am  '),
(60, 'admin', 'Super Admin', 'Super Admin', 'April 22, 2019 3:19:pm  '),
(61, 'admin', 'Super Admin', 'Super Admin', 'April 22, 2019 10:11:pm  '),
(62, 'admin', 'Super Admin', 'Super Admin', 'April 22, 2019 10:11:pm  '),
(63, 'james123', 'Pharmacist', 'Pharmacist', 'April 22, 2019 10:12:pm  '),
(64, 'admin', 'Super Admin', 'Super Admin', 'April 23, 2019 12:08:am  '),
(65, 'lyka123', 'Pharmacist Assistant', 'Pharmacist Assistant', 'April 23, 2019 12:10:am  '),
(66, 'jen123', 'Admin 1', 'Admin', 'April 23, 2019 12:10:am  '),
(67, 'jen123', 'Admin 1', 'Admin', 'April 23, 2019 12:37:am  '),
(68, 'admin', 'Super Admin', 'Super Admin', 'April 23, 2019 12:55:am  '),
(69, 'admin', 'Super Admin', 'Super Admin', 'April 23, 2019 2:41:pm  '),
(70, 'admin', 'Super Admin', 'Super Admin', 'April 23, 2019 6:49:pm  '),
(71, 'admin', 'Super Admin', 'Super Admin', 'April 25, 2019 6:51:am  ');

-- --------------------------------------------------------

--
-- Table structure for table `dim_login`
--

DROP TABLE IF EXISTS `dim_login`;
CREATE TABLE IF NOT EXISTS `dim_login` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `login_type` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dim_login`
--

INSERT INTO `dim_login` (`id`, `username`, `password`, `name`, `login_type`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Super Admin', 'Super Admin', 'Active'),
(3, 'james123', '9ba36afc4e560bf811caefc0c7fddddf', 'Pharmacist', 'Pharmacist', 'Active'),
(4, 'lyka123', 'f0b513d763494ddabc53b36ec0078d42', 'Pharmacist Assistant', 'Pharmacist Assistant', 'Active'),
(5, 'jen123', '4db63cb2f0bde8c4a2582b0e66fe4c7a', 'Admin 1', 'Admin', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `dim_orders`
--

DROP TABLE IF EXISTS `dim_orders`;
CREATE TABLE IF NOT EXISTS `dim_orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `brand_name` varchar(200) NOT NULL,
  `generic_name` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double(10,2) NOT NULL,
  `vat` double(10,2) NOT NULL,
  `vat_exempt` double(10,2) NOT NULL,
  `discount` double(10,2) DEFAULT '0.00',
  `date_added` date NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dim_orders`
--

INSERT INTO `dim_orders` (`order_id`, `item_id`, `brand_name`, `generic_name`, `quantity`, `price`, `vat`, `vat_exempt`, `discount`, `date_added`) VALUES
(3, 100, 'FORALIVIT  ', 'FESO4+FOLIC+VIT B COMPLEX', 1, 5.00, 0.54, 4.46, 0.00, '2019-04-21'),
(4, 100, 'FORALIVIT  ', 'FESO4+FOLIC+VIT B COMPLEX', 1, 5.00, 0.54, 4.46, 0.00, '2019-04-21'),
(5, 108, 'RANITIDINE ', 'RANIPHIL', 1, 31.00, 3.32, 27.68, 0.00, '2019-04-25'),
(6, 108, 'RANITIDINE ', 'RANIPHIL', 1, 31.00, 3.32, 27.68, 0.00, '2019-04-25'),
(7, 108, 'RANITIDINE ', 'RANIPHIL', 1, 31.00, 3.32, 27.68, 0.00, '2019-04-25'),
(8, 108, 'RANITIDINE ', 'RANIPHIL', 50, 1550.00, 166.07, 1383.93, 0.00, '2019-04-25'),
(9, 108, 'RANITIDINE ', 'RANIPHIL', 5, 155.00, 16.61, 138.39, 0.00, '2019-04-25'),
(10, 108, 'RANITIDINE ', 'RANIPHIL', 5, 155.00, 16.61, 138.39, 0.00, '2019-04-25'),
(11, 108, 'RANITIDINE ', 'RANIPHIL', 5, 155.00, 16.61, 138.39, 0.00, '2019-04-25'),
(12, 108, 'RANITIDINE ', 'RANIPHIL', 5, 155.00, 16.61, 138.39, 0.00, '2019-04-25'),
(13, 108, 'RANITIDINE ', 'RANIPHIL', 9, 279.00, 29.89, 249.11, 0.00, '2019-04-25'),
(14, 108, 'RANITIDINE ', 'RANIPHIL', 1, 31.00, 3.32, 27.68, 0.00, '2019-04-25'),
(15, 108, 'RANITIDINE ', 'RANIPHIL', 1, 31.00, 3.32, 27.68, 0.00, '2019-04-25');

-- --------------------------------------------------------

--
-- Table structure for table `dim_supplier`
--

DROP TABLE IF EXISTS `dim_supplier`;
CREATE TABLE IF NOT EXISTS `dim_supplier` (
  `supplier_id` int(30) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(200) NOT NULL,
  `company` varchar(200) NOT NULL,
  `location` varchar(200) NOT NULL,
  `contact_details` varchar(100) NOT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dim_supplier`
--

INSERT INTO `dim_supplier` (`supplier_id`, `supplier_name`, `company`, `location`, `contact_details`) VALUES
(1, 'Ms. Hazel Germar', 'MeedPharma', 'Sampaloc, Manila', '09359387456'),
(2, 'Jennilyn Garcia', 'Unilab', 'Sampaloc, Manila', '09358785674'),
(3, 'Lyka Cruz', 'Excelsis (RiteMed)', 'Sampaloc, Manila', '09357673456');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
