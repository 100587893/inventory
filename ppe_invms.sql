-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 25, 2020 at 04:47 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppe_invms`
--

-- --------------------------------------------------------

--
-- Table structure for table `login_log`
--

DROP TABLE IF EXISTS `login_log`;
CREATE TABLE IF NOT EXISTS `login_log` (
  `id` int(99) NOT NULL AUTO_INCREMENT,
  `username` varchar(99) NOT NULL,
  `time` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `pc_name` varchar(99) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_log`
--

INSERT INTO `login_log` (`id`, `username`, `time`, `pc_name`) VALUES
(1, 'a.ansari', '2020-11-05 16:16:14.415976', 'inventory'),
(2, 'kumar', '2020-11-09 19:44:01.080827', 'inventory'),
(3, 'hameed', '2020-11-12 22:46:27.803230', 'HamsPC'),
(4, 'hameed', '2020-11-16 03:51:54.665395', 'HamsPC'),
(5, 'hameed', '2020-11-16 16:49:24.911334', 'inventory'),
(6, 'hameed', '2020-11-17 23:44:32.679087', 'inventory'),
(7, 'hameed', '2020-11-18 16:05:18.136640', 'inventory'),
(8, 'hameed', '2020-11-20 01:24:22.758202', 'inventory'),
(9, 'hameed', '2020-11-24 20:30:32.507330', 'inventory');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(99) NOT NULL AUTO_INCREMENT,
  `name` varchar(99) NOT NULL,
  `supplier` varchar(99) DEFAULT NULL,
  `min_stock` int(99) DEFAULT NULL,
  `manufacturer` varchar(99) DEFAULT NULL,
  `description` varchar(99) DEFAULT NULL,
  `serial_number` varchar(99) DEFAULT NULL,
  `image` varchar(99) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `supplier`, `min_stock`, `manufacturer`, `description`, `serial_number`, `image`) VALUES
(1, 'Nitrile Glove (M)', 'Nes pluto', 20, 'Maxill', 'Powder Free Nitrile Blue (M)', '060705514226', '1.jpg'),
(2, 'Nitrile Glove (S)', 'Nes pluto', 20, 'Maxill', 'Powder Free Nitrile Blue (S)', '060705514219', '2.jpg'),
(3, 'Nitrile Glove (L)', 'Nes pluto', 20, 'Maxill', 'Powder Free Nitrile Blue (L)', '060705514233', '3.jpg'),
(4, 'Nitrile Glove (XL)', 'Nes pluto', 10, 'Maxill', 'Powder Free Nitrile Blue (XL)', '060705514240', '4.jpg'),
(5, '4L Hand Sanitizer', 'Eco chem', 8, 'Eco ChemLabs', '4L Hand Sanitizer', '8.00E+11', '5.jpg'),
(6, '1L Hand sanitizer', 'Eco chem', 24, 'Eco ChemLabs', '1L Hand Sanitizer', '6.55E+11', '6.jpg'),
(7, 'Vinyl Glove (M)', '', 5, 'Hray', 'Vinyl Blue (M)', '6.26E+11', '7.jpg'),
(8, 'Nitrile Glove (S)', '', 5, 'Tuff', 'Nitrile Blue (S) 100/box', '6.26E+11', '8.jpg'),
(9, 'Hand Sanitizer Spray', '', 24, 'Zytec', 'Hand Sanitizer Spray 500 ml', '60480013464', '9.jpg'),
(10, 'Gowns Blue', '', 300, 'Med Pro Defense', 'Blue Gowns', '57565183969', '10.jpg'),
(11, 'Gowns', '', 0, 'Chinese', 'Yellow (L)', '', '11.jpg'),
(12, 'Gowns', '', 0, 'Chinese', 'Yellow (XL)', '', '12.jpg'),
(13, 'Masks Lvl 1', '', 10, 'HXL', 'Lvl 1 Masks', '6.97E+12', '13.jpg'),
(14, 'Masks Lvl 2', '', 10, 'Maxem', 'Blue Earloop Lvl 2 Masks', '7.18E+11', '14.jpg'),
(15, 'Masks Lvl 3', '', 10, 'Maxem', 'Blue Earloop Lvl 3 Masks', '55092135', '15.jpg'),
(16, 'Masks Lvl 3', '', 10, 'DentXCanada', 'Blue Earloop Mask Lvl 3 Masks', '6.28E+11', '16.jpg'),
(17, 'Gloves (M)', '', 5, 'The Aura', 'Nitrile Glove 300/box (M)', 'DDS-403', '17.jpg'),
(18, 'Gloves (L)', '', 5, 'Ventyv', 'Nitrile (L)', '1.08E+13', '18.jpg'),
(19, 'Masks Lvl 3', '', 15, 'Medicos', 'Lvl 3 Masks 50/box', 'SM3EL', '19.jpg'),
(20, 'Masks Lvl 3', '', 15, 'Maxill Pluss', 'Lvl 3 Masks', '1.00E+24', '20.jpg'),
(21, 'N95 Masks', '', 15, 'Halyard', 'N95 Masks', '', '21.jpg'),
(22, 'Shoe Cover', '', 8, 'Maxill', 'Shoe Cover 100/box', '53072', '22.jpg'),
(23, 'Hair Net', '', 8, '', '', '53065', '23.jpg'),
(24, 'Face Shield', '', 500, 'Chinese', 'Face Shield 12/pack', '', '24.jpg'),
(25, 'Glove M', 'Maxill', 2, 'Maxill', 'Glove Nitrile M Green', '0110060705511628', '25.jpg'),
(26, 'Masks Lvl 3', 'Maxill', 10, 'Maxill', 'Mask Lvl 3 Blue', '53016', '26.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `scar_created`
--

DROP TABLE IF EXISTS `scar_created`;
CREATE TABLE IF NOT EXISTS `scar_created` (
  `id` int(99) NOT NULL AUTO_INCREMENT,
  `product_id` int(99) NOT NULL,
  `username` varchar(99) NOT NULL,
  `time` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scar_created`
--

INSERT INTO `scar_created` (`id`, `product_id`, `username`, `time`) VALUES
(1, 25, 'Kumar Kumarakuruparan', '2020-11-09 19:58:53.312795'),
(2, 26, 'Kumar Kumarakuruparan', '2020-11-09 20:01:24.939218');

-- --------------------------------------------------------

--
-- Table structure for table `scar_inv`
--

DROP TABLE IF EXISTS `scar_inv`;
CREATE TABLE IF NOT EXISTS `scar_inv` (
  `id` int(99) NOT NULL AUTO_INCREMENT,
  `product_id` int(99) NOT NULL,
  `quantity` int(99) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scar_inv`
--

INSERT INTO `scar_inv` (`id`, `product_id`, `quantity`) VALUES
(1, 1, 43),
(2, 2, 55),
(3, 3, 32),
(4, 4, 5),
(5, 5, 2),
(6, 6, 132),
(7, 7, 60),
(8, 8, 88),
(9, 9, 232),
(10, 10, 2350),
(11, 11, 840),
(12, 12, 2240),
(13, 13, 190),
(14, 14, 390),
(15, 15, 500),
(16, 16, 308),
(17, 17, 20),
(18, 18, 30),
(19, 19, 40),
(20, 20, 114),
(21, 21, 18),
(22, 22, 18),
(23, 23, 10),
(24, 24, 740),
(25, 25, 60),
(26, 26, 240);

-- --------------------------------------------------------

--
-- Table structure for table `scar_rcv`
--

DROP TABLE IF EXISTS `scar_rcv`;
CREATE TABLE IF NOT EXISTS `scar_rcv` (
  `id` int(99) NOT NULL AUTO_INCREMENT,
  `product_id` int(99) NOT NULL,
  `quantity` int(99) NOT NULL,
  `delivered_by` varchar(99) NOT NULL,
  `received_by` varchar(99) NOT NULL,
  `time` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scar_rcv`
--

INSERT INTO `scar_rcv` (`id`, `product_id`, `quantity`, `delivered_by`, `received_by`, `time`) VALUES
(1, 22, 10, 'Courier', 'Kumar Kumarakuruparan', '2020-11-09 19:56:26.120604'),
(2, 23, 10, 'Courier', 'Kumar Kumarakuruparan', '2020-11-09 20:15:34.193140'),
(3, 22, 100, 'Courier', 'Kumar Kumarakuruparan', '2020-11-09 20:19:21.817789'),
(4, 25, 50, 'Courier', 'Kumar Kumarakuruparan', '2020-11-09 20:21:49.305267'),
(5, 2, 50, 'Courier', 'Kumar Kumarakuruparan', '2020-11-09 20:25:27.874366'),
(6, 2, 50, 'UPS', 'Mohammed Hameeduddin', '2020-11-18 16:09:00.277780'),
(7, 1, 10, 'Courier', 'Mohammed Hameeduddin', '2020-11-20 01:31:19.033156');

-- --------------------------------------------------------

--
-- Table structure for table `scar_rmv`
--

DROP TABLE IF EXISTS `scar_rmv`;
CREATE TABLE IF NOT EXISTS `scar_rmv` (
  `id` int(99) NOT NULL AUTO_INCREMENT,
  `product_id` int(99) DEFAULT NULL,
  `quantity` int(99) DEFAULT NULL,
  `assigned_to` varchar(99) DEFAULT NULL,
  `removed_by` varchar(99) DEFAULT NULL,
  `time` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scar_rmv`
--

INSERT INTO `scar_rmv` (`id`, `product_id`, `quantity`, `assigned_to`, `removed_by`, `time`) VALUES
(1, 2, 50, 'DH Scarborough', 'Mohammed Hameeduddin', '2020-11-18 16:09:49.245519'),
(2, 4, 2, 'Scarborough', 'Mohammed Hameeduddin', '2020-11-18 16:13:40.010590');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(99) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(99) NOT NULL,
  `username` varchar(99) NOT NULL,
  `password` varchar(99) NOT NULL,
  `campus` varchar(99) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullname`, `username`, `password`, `campus`) VALUES
(1, 'Mohammed Hameeduddin', 'hameed', 'deemah13G', 'admin'),
(2, 'Abdurrahman Ansari', 'a.ansari', 'Oxford@12', 'admin'),
(3, 'Kumar Kumarakuruparan', 'kumar', 'oxford', 'scarborough');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
