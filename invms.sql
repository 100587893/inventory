-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 04, 2021 at 03:16 PM
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
-- Database: `invms`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_history`
--

DROP TABLE IF EXISTS `add_history`;
CREATE TABLE IF NOT EXISTS `add_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `campus` varchar(99) NOT NULL,
  `adder` varchar(99) NOT NULL,
  `product_id` varchar(99) NOT NULL,
  `quantity` int(11) NOT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add_history`
--

INSERT INTO `add_history` (`id`, `campus`, `adder`, `product_id`, `quantity`, `time`) VALUES
(1, 'Barrie', 'a', '060705514226', 3, '2021-02-03 16:46:32'),
(2, 'Barrie', 'a', '53072', 45, '2021-02-03 16:47:05');

-- --------------------------------------------------------

--
-- Table structure for table `barrie_inv`
--

DROP TABLE IF EXISTS `barrie_inv`;
CREATE TABLE IF NOT EXISTS `barrie_inv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(99) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barrie_inv`
--

INSERT INTO `barrie_inv` (`id`, `product_id`, `quantity`) VALUES
(1, '1', 52),
(2, '2', 168),
(3, '3', 13),
(4, '8', 7),
(5, '5', 90),
(6, '6', 113),
(7, '27', 3),
(8, '11', 16),
(9, '28', 2),
(10, '17', 5),
(11, '060705514226', 10),
(12, '53072', 30);

-- --------------------------------------------------------

--
-- Table structure for table `burlington_inv`
--

DROP TABLE IF EXISTS `burlington_inv`;
CREATE TABLE IF NOT EXISTS `burlington_inv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(99) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `campuses`
--

DROP TABLE IF EXISTS `campuses`;
CREATE TABLE IF NOT EXISTS `campuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `campus` varchar(99) NOT NULL,
  `address` varchar(99) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `campuses`
--

INSERT INTO `campuses` (`id`, `campus`, `address`) VALUES
(1, 'Barrie', '320 Bayfield St (Bayfield Mall) Barrie, ON L4M 3C1'),
(2, 'Burlington', '760 Brant St Burlington, ON L7R 4B7'),
(3, 'Mississauga', '1300 Central Pkwy W #400 Mississauga, ON L5C 4G8'),
(4, 'Peterborough', '360 George St N #16 Peterborough, ON K9H 7E7'),
(5, 'Scarborough', '670 Progress Ave Scarborough, ON M1H 3A4'),
(6, 'Toronto', '869 Yonge Street Toronto, ON M4W 2H2');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `r_id` int(11) NOT NULL,
  `product_id` varchar(99) NOT NULL,
  `quantity` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `kit` varchar(99) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=128 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_request`
--

DROP TABLE IF EXISTS `item_request`;
CREATE TABLE IF NOT EXISTS `item_request` (
  `id` int(99) NOT NULL AUTO_INCREMENT,
  `requester` varchar(255) NOT NULL,
  `campus` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `name` varchar(99) NOT NULL,
  `supplier` varchar(99) DEFAULT NULL,
  `min_stock` int(99) DEFAULT NULL,
  `manufacturer` varchar(99) DEFAULT NULL,
  `description` varchar(99) DEFAULT NULL,
  `product_id` varchar(99) DEFAULT NULL,
  `unit` varchar(99) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_request`
--

INSERT INTO `item_request` (`id`, `requester`, `campus`, `category`, `name`, `supplier`, `min_stock`, `manufacturer`, `description`, `product_id`, `unit`) VALUES
(1, 'a', 'Barrie', 'Office Supplies', 'Swingline Optima 40 Desk Stapler', 'Staples', 1, 'Swingline', 'Swingline Optima 40 Desk Stapler', '7471187840', '');

-- --------------------------------------------------------

--
-- Table structure for table `kit`
--

DROP TABLE IF EXISTS `kit`;
CREATE TABLE IF NOT EXISTS `kit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kit` varchar(99) NOT NULL,
  `product_id` varchar(99) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kit`
--

INSERT INTO `kit` (`id`, `kit`, `product_id`, `quantity`) VALUES
(1, 'DH Kit', 'wqe332hgh23kg4hj423', 3),
(2, 'DH Kit', 'g876fg87d6g8f7g6', 5),
(3, 'DH Kit', 'sgst3e4tt334t43523', 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=271 DEFAULT CHARSET=latin1;

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
(9, 'hameed', '2020-11-24 20:30:32.507330', 'inventory'),
(10, 'hameed', '2020-11-26 00:05:12.220586', 'services'),
(11, 'hameed', '2020-11-30 19:03:17.537830', 'services'),
(12, 'hameed', '2020-11-30 19:51:56.636556', 'services'),
(13, 'hameed', '2020-12-01 16:15:21.467454', 'services'),
(14, 'hameed', '2020-12-02 15:28:02.470346', 'services'),
(15, 'hameed', '2020-12-02 16:40:25.980211', 'services'),
(16, 'hameed', '2020-12-02 17:37:31.951554', 'services'),
(17, 'hameed', '2020-12-03 13:56:44.132498', 'services'),
(18, 'hameed', '2020-12-03 14:01:25.552006', 'services'),
(19, 'hameed', '2020-12-03 16:08:19.903310', 'services'),
(20, 'hameed', '2020-12-03 16:41:40.029429', 'services'),
(21, 'hameed', '2020-12-03 18:46:56.924717', 'services'),
(22, 'hameed', '2020-12-03 19:49:18.716632', 'services'),
(23, 'hameed', '2020-12-08 23:00:55.082682', 'services'),
(24, 'hameed', '2020-12-09 16:39:49.314052', 'services'),
(25, 'hameed', '2020-12-09 21:20:17.569622', 'services'),
(26, 'hameed', '2020-12-16 15:02:15.187431', 'services'),
(27, 'a', '2020-12-16 19:26:38.600027', 'services'),
(28, 'a', '2020-12-16 19:27:29.840263', 'services'),
(29, 'b', '2020-12-16 21:15:14.398375', 'services'),
(30, 'b', '2020-12-16 21:15:49.315457', 'services'),
(31, 'b', '2020-12-16 21:16:35.971087', 'services'),
(32, 'b', '2020-12-17 14:27:11.700089', 'services'),
(33, 'b', '2020-12-17 14:28:13.942828', 'services'),
(34, 'b', '2020-12-17 15:24:24.455306', 'localdev'),
(35, 'c', '2020-12-17 16:01:54.941523', 'localdev'),
(36, 'c', '2020-12-17 16:05:07.065789', 'localdev'),
(37, 'c', '2020-12-17 16:06:01.480870', 'localdev'),
(38, 'c', '2020-12-17 16:07:36.945278', 'localdev'),
(39, 'b', '2020-12-17 17:01:22.128487', 'localdev'),
(40, 'c', '2020-12-17 17:11:40.512994', 'localdev'),
(41, 'a', '2020-12-17 19:28:28.803425', 'localdev'),
(42, 'c', '2020-12-17 19:41:00.446032', 'localdev'),
(43, 'b', '2020-12-17 19:41:14.204942', 'localdev'),
(44, 'c', '2020-12-17 19:42:49.270165', 'localdev'),
(45, 'a', '2020-12-17 19:45:19.562904', 'localdev'),
(46, 'a', '2020-12-17 21:06:23.731449', 'localdev'),
(47, 'b', '2020-12-17 21:09:55.568134', 'localdev'),
(48, 'c', '2020-12-17 21:11:29.180597', 'localdev'),
(49, 'a', '2020-12-17 21:12:05.911691', 'localdev'),
(50, 'a', '2020-12-18 19:45:13.635856', 'localdev'),
(51, 'a', '2020-12-18 19:45:31.550796', 'localdev'),
(52, 'a', '2020-12-21 14:24:23.310261', 'localdev'),
(53, 'b', '2020-12-21 19:13:42.840378', 'localdev'),
(54, 'c', '2020-12-22 19:41:31.771123', 'localdev'),
(55, 'c', '2020-12-23 15:32:14.953774', 'localdev'),
(56, 'a', '2020-12-28 15:12:33.559980', 'localdev'),
(57, 'b', '2020-12-28 15:16:00.116220', 'localdev'),
(58, 'c', '2020-12-28 15:17:17.439858', 'localdev'),
(59, 'a', '2020-12-28 15:21:07.992783', 'localdev'),
(60, 'c', '2020-12-28 15:25:03.748447', 'localdev'),
(61, 'a', '2020-12-28 15:26:45.885299', 'localdev'),
(62, 'b', '2020-12-28 15:27:10.545659', 'localdev'),
(63, 'c', '2020-12-28 15:27:30.854007', 'localdev'),
(64, 'a', '2020-12-28 16:12:45.443433', 'localdev'),
(65, 'a', '2020-12-28 17:38:00.209341', 'localdev'),
(66, 'b', '2020-12-28 18:56:23.835547', 'localdev'),
(67, 'c', '2020-12-28 18:56:38.122868', 'localdev'),
(68, 'a', '2020-12-28 18:56:55.954455', 'localdev'),
(69, 'b', '2020-12-28 19:33:10.961212', 'localdev'),
(70, 'c', '2020-12-28 19:33:21.057337', 'localdev'),
(71, 'a', '2020-12-28 19:33:33.474216', 'localdev'),
(72, 'c', '2020-12-28 19:59:05.257157', 'localdev'),
(73, 'd', '2020-12-30 15:42:22.319415', 'localdev'),
(74, 'd', '2020-12-30 16:05:17.197421', 'localdev'),
(75, 'd', '2020-12-31 15:26:39.960192', 'localdev'),
(76, 'b', '2020-12-31 18:56:13.946936', 'localdev'),
(77, 'c', '2020-12-31 19:08:36.766207', 'localdev'),
(78, 'd', '2020-12-31 19:08:53.565996', 'localdev'),
(79, 'a', '2020-12-31 19:15:15.075110', 'localdev'),
(80, 'b', '2020-12-31 20:11:36.395134', 'localdev'),
(81, 'c', '2020-12-31 20:12:16.819293', 'localdev'),
(82, 'd', '2020-12-31 20:13:25.628304', 'localdev'),
(83, 'a', '2021-01-04 14:30:32.156036', 'localdev'),
(84, 'b', '2021-01-04 14:39:10.943422', 'localdev'),
(85, 'c', '2021-01-04 14:46:03.324873', 'localdev'),
(86, 'd', '2021-01-04 14:47:48.814864', 'localdev'),
(87, 'a', '2021-01-04 14:48:55.103997', 'localdev'),
(88, 'b', '2021-01-04 14:49:21.664227', 'localdev'),
(89, 'a', '2021-01-04 16:26:32.732679', 'localdev'),
(90, 'a', '2021-01-04 18:47:46.049802', 'localdev'),
(91, 'b', '2021-01-05 15:41:00.309183', 'localdev'),
(92, 'a', '2021-01-06 14:30:12.315718', 'localdev'),
(93, 'b', '2021-01-06 14:31:22.841693', 'localdev'),
(94, 'c', '2021-01-06 14:32:24.355526', 'localdev'),
(95, 'd', '2021-01-06 14:35:40.054891', 'localdev'),
(96, 'a', '2021-01-06 14:36:02.148370', 'localdev'),
(97, 'a', '2021-01-06 14:37:14.997880', 'localdev'),
(98, 'b', '2021-01-06 14:38:31.173783', 'localdev'),
(99, 'd', '2021-01-06 15:53:48.788263', 'localdev'),
(100, 'c', '2021-01-06 15:54:05.022341', 'localdev'),
(101, 'd', '2021-01-06 15:54:26.897183', 'localdev'),
(102, 'a', '2021-01-06 15:54:47.332401', 'localdev'),
(103, 'a', '2021-01-06 16:46:44.591532', 'localdev'),
(104, 'b', '2021-01-06 16:48:51.377242', 'localdev'),
(105, 'c', '2021-01-06 16:49:58.021173', 'localdev'),
(106, 'd', '2021-01-06 16:52:35.363306', 'localdev'),
(107, 'a', '2021-01-06 16:54:12.566685', 'localdev'),
(108, 'c', '2021-01-06 16:57:00.662416', 'localdev'),
(109, 'b', '2021-01-07 14:31:47.086226', 'localdev'),
(110, 'c', '2021-01-07 20:57:50.588809', 'localdev'),
(111, 'a', '2021-01-11 14:35:11.680152', 'localdev'),
(112, 'b', '2021-01-11 14:35:24.074768', 'localdev'),
(113, 'c', '2021-01-11 15:52:57.712934', 'localdev'),
(114, 'b', '2021-01-11 15:54:16.449300', 'localdev'),
(115, 'b', '2021-01-11 15:56:24.800702', 'localdev'),
(116, 'c', '2021-01-11 16:05:31.691307', 'localdev'),
(117, 'a', '2021-01-12 22:06:41.419775', 'localdev'),
(118, 'b', '2021-01-12 22:08:04.750067', 'localdev'),
(119, 'c', '2021-01-12 22:08:41.201455', 'localdev'),
(120, 'b', '2021-01-13 14:11:46.190172', 'localdev'),
(121, 'a', '2021-01-13 14:25:23.144549', 'localdev'),
(122, 'a', '2021-01-13 21:10:58.267165', 'localdev'),
(123, 'a', '2021-01-13 21:24:29.790371', 'localdev'),
(124, 'a', '2021-01-13 21:25:42.402128', 'localdev'),
(125, 'a', '2021-01-14 14:08:05.331642', 'localdev'),
(126, 'c', '2021-01-14 14:13:54.614633', 'localdev'),
(127, 'd', '2021-01-14 14:14:58.908812', 'localdev'),
(128, 'a', '2021-01-14 16:14:27.432213', 'localdev'),
(129, 'a', '2021-01-14 16:16:35.111121', 'localdev'),
(130, 'b', '2021-01-14 16:16:42.777797', 'localdev'),
(131, 'c', '2021-01-14 16:17:48.390257', 'localdev'),
(132, 'a', '2021-01-14 16:23:16.349691', 'localdev'),
(133, 'c', '2021-01-14 16:23:59.095037', 'localdev'),
(134, 'b', '2021-01-14 16:24:06.397358', 'localdev'),
(135, 'c', '2021-01-14 16:24:29.972319', 'localdev'),
(136, 'd', '2021-01-14 16:25:20.965653', 'localdev'),
(137, 'a', '2021-01-14 16:26:23.291175', 'localdev'),
(138, 'a', '2021-01-14 16:32:40.041459', 'localdev'),
(139, 'c', '2021-01-14 16:33:12.640334', 'localdev'),
(140, 'c', '2021-01-14 17:07:49.230468', 'localdev'),
(141, 'a', '2021-01-14 20:02:20.577466', 'localdev'),
(142, 'b', '2021-01-14 20:02:27.975567', 'localdev'),
(143, 'c', '2021-01-14 20:03:28.189150', 'localdev'),
(144, 'a', '2021-01-14 20:11:34.833034', 'localdev'),
(145, 'c', '2021-01-14 20:27:08.278114', 'localdev'),
(146, 'c', '2021-01-18 19:04:33.161781', 'localdev'),
(147, 'c', '2021-01-19 19:32:59.678477', 'localdev'),
(148, 'c', '2021-01-20 18:37:36.040088', 'localdev'),
(149, 'c', '2021-01-20 21:18:10.619366', 'localdev'),
(150, 'c', '2021-01-21 15:58:06.362007', 'localdev'),
(151, 'c', '2021-01-21 16:59:01.803834', 'localdev'),
(152, 'b', '2021-01-21 17:13:20.477497', 'localdev'),
(153, 'a', '2021-01-21 19:00:09.677731', 'localdev'),
(154, 'd', '2021-01-21 19:01:24.071556', 'localdev'),
(155, 'a', '2021-01-21 19:06:45.939244', 'localdev'),
(156, 'b', '2021-01-21 19:34:47.836572', 'localdev'),
(157, 'a', '2021-01-21 19:49:33.438478', 'localdev'),
(158, 'b', '2021-01-21 19:54:43.707266', 'localdev'),
(159, 'a', '2021-01-21 19:56:54.270081', 'localdev'),
(160, 'b', '2021-01-21 19:57:15.130941', 'localdev'),
(161, 'a', '2021-01-21 19:57:58.820290', 'localdev'),
(162, 'b', '2021-01-22 15:20:09.824008', 'localdev'),
(163, 'c', '2021-01-22 15:25:37.475970', 'localdev'),
(164, 'a', '2021-01-22 15:51:25.151752', 'localdev'),
(165, 'c', '2021-01-22 15:51:54.511831', 'localdev'),
(166, 'a', '2021-01-22 15:54:47.810723', 'localdev'),
(167, 'c', '2021-01-22 15:55:11.474625', 'localdev'),
(168, 'a', '2021-01-22 15:57:38.632416', 'localdev'),
(169, 'c', '2021-01-22 15:58:02.284528', 'localdev'),
(170, 'd', '2021-01-22 16:08:12.556083', 'localdev'),
(171, 'a', '2021-01-22 16:11:03.606885', 'localdev'),
(172, 'b', '2021-01-22 16:11:28.639973', 'localdev'),
(173, 'c', '2021-01-22 16:11:40.567223', 'localdev'),
(174, 'd', '2021-01-22 16:11:51.350541', 'localdev'),
(175, 'a', '2021-01-22 16:12:06.535545', 'localdev'),
(176, 'b', '2021-01-22 16:12:56.607921', 'localdev'),
(177, 'a', '2021-01-22 16:19:45.405597', 'localdev'),
(178, 'c', '2021-01-22 16:21:59.527140', 'localdev'),
(179, 'b', '2021-01-22 16:57:18.698553', 'localdev'),
(180, 'c', '2021-01-22 16:58:02.426329', 'localdev'),
(181, 'a', '2021-01-28 16:58:02.560861', 'localdev'),
(182, 'a', '2021-01-28 17:04:07.327098', 'localdev'),
(183, 'b', '2021-01-28 17:10:35.670472', 'localdev'),
(184, 'c', '2021-01-28 17:11:07.380845', 'localdev'),
(185, 'a', '2021-01-28 17:15:21.838909', 'localdev'),
(186, 'c', '2021-01-28 17:15:58.886808', 'localdev'),
(187, 'd', '2021-01-28 17:16:32.134784', 'localdev'),
(188, 'a', '2021-01-28 17:25:51.811407', 'localdev'),
(189, 'c', '2021-01-28 17:26:23.515592', 'localdev'),
(190, 'c', '2021-01-28 17:29:38.336828', 'localdev'),
(191, 'a', '2021-01-28 19:37:52.546050', 'localdev'),
(192, 'b', '2021-01-28 19:38:24.850921', 'localdev'),
(193, 'c', '2021-01-28 19:38:27.737563', 'localdev'),
(194, 'c', '2021-01-28 19:40:32.675646', 'localdev'),
(195, 'a', '2021-01-28 19:40:44.427064', 'localdev'),
(196, 'b', '2021-01-28 19:41:08.605019', 'localdev'),
(197, 'c', '2021-01-28 19:46:46.371680', 'localdev'),
(198, 'b', '2021-01-28 19:47:45.224237', 'localdev'),
(199, 'c', '2021-01-28 19:48:13.142153', 'localdev'),
(200, 'a', '2021-01-28 19:54:47.040890', 'localdev'),
(201, 'c', '2021-01-28 20:07:17.981451', 'localdev'),
(202, 'b', '2021-01-28 20:30:14.227495', 'localdev'),
(203, 'c', '2021-01-29 16:58:04.216005', 'localdev'),
(204, 'a', '2021-02-01 16:44:14.906489', 'localdev'),
(205, 'c', '2021-02-01 17:24:46.340245', 'localdev'),
(206, 'b', '2021-02-01 20:24:17.487003', 'localdev'),
(207, 'c', '2021-02-01 20:24:23.448103', 'localdev'),
(208, 'b', '2021-02-01 20:46:26.182790', 'localdev'),
(209, 'c', '2021-02-01 20:51:13.620487', 'localdev'),
(210, 'b', '2021-02-02 14:57:39.029669', 'localdev'),
(211, 'a', '2021-02-02 21:58:19.273032', 'localdev'),
(212, 'a', '2021-02-03 02:24:03.888923', 'localdev'),
(213, 'c', '2021-02-03 15:14:16.435122', 'localdev'),
(214, 'a', '2021-02-03 15:43:57.064301', 'localdev'),
(215, 'b', '2021-02-03 16:08:08.505968', 'localdev'),
(216, 'c', '2021-02-03 16:13:15.020818', 'localdev'),
(217, 'd', '2021-02-03 16:22:42.870816', 'localdev'),
(218, 'a', '2021-02-03 16:24:31.724860', 'localdev'),
(219, 'b', '2021-02-03 16:33:38.684052', 'localdev'),
(220, 'c', '2021-02-03 16:35:14.805851', 'localdev'),
(221, 'a', '2021-02-03 16:38:14.768233', 'localdev'),
(222, 'c', '2021-02-03 17:00:29.223091', 'localdev'),
(223, 'a.ansari@oxfordedu.ca', '2021-02-03 19:19:05.871385', 'localdev'),
(224, 'a', '2021-02-10 02:25:40.090788', 'localdev'),
(225, 'b', '2021-02-10 02:27:32.569244', 'localdev'),
(226, 'c', '2021-02-10 02:28:26.578600', 'localdev'),
(227, 'd', '2021-02-10 02:30:12.556346', 'localdev'),
(228, 'a', '2021-02-10 02:30:48.924324', 'localdev'),
(229, 'a', '2021-02-10 14:04:32.493808', 'localdev'),
(230, 'a', '2021-02-10 17:23:11.619093', 'localdev'),
(231, 'a', '2021-02-11 15:36:53.320440', 'localdev'),
(232, 'b', '2021-02-11 18:39:00.655868', 'localdev'),
(233, 'c', '2021-02-11 18:58:24.828990', 'localdev'),
(234, 'a', '2021-02-11 19:57:30.497528', 'localdev'),
(235, 'c', '2021-02-11 20:03:04.089102', 'localdev'),
(236, 'a.ansari@oxfordedu.ca', '2021-02-11 21:49:58.533358', 'localdev'),
(237, 'd', '2021-02-11 21:59:10.626426', 'localdev'),
(238, 'c', '2021-02-11 22:00:40.357006', 'localdev'),
(239, 'd', '2021-02-11 22:00:55.651775', 'localdev'),
(240, 'c', '2021-02-14 01:15:41.403338', 'localdev'),
(241, 'c', '2021-02-16 03:08:25.718662', 'localdev'),
(242, 'a', '2021-02-23 19:33:43.799314', 'localdev'),
(243, 'a', '2021-03-08 14:14:34.109537', 'localdev'),
(244, 'c', '2021-03-08 14:14:46.296648', 'localdev'),
(245, 'a', '2021-03-11 18:50:56.719981', 'localdev'),
(246, 'b', '2021-03-12 16:37:31.871708', 'localdev'),
(247, 'c', '2021-03-12 16:49:49.793967', 'localdev'),
(248, 'a', '2021-03-15 18:13:53.424451', 'localdev'),
(249, 'b', '2021-03-16 14:29:00.312917', 'localdev'),
(250, 'b', '2021-03-22 13:30:26.737682', 'localdev'),
(251, 'c', '2021-03-22 13:44:42.135563', 'localdev'),
(252, 'c', '2021-03-22 16:32:45.814928', 'localdev'),
(253, 'a', '2021-03-22 16:58:54.867989', 'localdev'),
(254, 'b', '2021-03-22 18:08:27.521775', 'localdev'),
(255, 'c', '2021-03-22 18:09:02.713379', 'localdev'),
(256, 'a', '2021-03-22 18:22:19.427026', 'localdev'),
(257, 'c', '2021-03-22 18:24:13.620372', 'localdev'),
(258, 'a.ansari@oxfordedu.ca', '2021-03-22 19:44:57.557415', 'localdev'),
(259, 'd', '2021-03-22 19:54:06.819905', 'localdev'),
(260, 'a', '2021-03-23 15:27:46.075484', 'localdev'),
(261, 'a', '2021-03-23 15:58:43.325039', 'localdev'),
(262, 'c', '2021-03-23 19:47:14.445959', 'localdev'),
(263, 'c', '2021-03-23 19:52:12.397307', 'localdev'),
(264, 'c', '2021-03-23 19:53:55.189993', 'localdev'),
(265, 'a', '2021-03-24 18:52:58.872571', 'localdev'),
(266, 'a', '2021-03-25 16:17:22.240632', 'localdev'),
(267, 'b', '2021-03-25 16:26:46.076899', 'localdev'),
(268, 'c', '2021-03-25 16:27:02.103102', 'localdev'),
(269, 'b', '2021-03-25 16:27:10.653129', 'localdev'),
(270, 'c', '2021-03-25 16:27:21.391379', 'localdev');

-- --------------------------------------------------------

--
-- Table structure for table `mississauga_inv`
--

DROP TABLE IF EXISTS `mississauga_inv`;
CREATE TABLE IF NOT EXISTS `mississauga_inv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(99) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `peterborough_inv`
--

DROP TABLE IF EXISTS `peterborough_inv`;
CREATE TABLE IF NOT EXISTS `peterborough_inv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(99) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(99) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) DEFAULT NULL,
  `name` varchar(99) NOT NULL,
  `supplier` varchar(99) DEFAULT NULL,
  `min_stock` int(99) DEFAULT NULL,
  `manufacturer` varchar(99) DEFAULT NULL,
  `description` varchar(99) DEFAULT NULL,
  `product_id` varchar(99) DEFAULT NULL,
  `price` float(10,0) DEFAULT NULL,
  `image` varchar(99) DEFAULT NULL,
  `unit` varchar(99) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category`, `name`, `supplier`, `min_stock`, `manufacturer`, `description`, `product_id`, `price`, `image`, `unit`) VALUES
(1, 'Gloves', 'Nitrile Glove (M)', 'Nes pluto', 20, 'Maxill', 'Powder Free Nitrile Blue (M)', '060705514226', 0, '1.jpg', 'Item'),
(2, 'Gloves', 'Nitrile Glove (S)', 'Nes pluto', 15, 'Maxill', 'Powder Free Nitrile Blue (S)', '060705514219', 15, '2.jpg', ''),
(3, 'Gloves', 'Nitrile Glove (L)', 'Nes pluto', 15, 'Maxill', 'Powder Free Nitrile Blue (L)', '060705514233', 0, '3.jpg', ''),
(4, 'Gloves', 'Nitrile Glove (XL)', 'Nes pluto', 15, 'Maxill', 'Powder Free Nitrile Blue (XL)', '060705514240', 0, '4.jpg', ''),
(5, 'Hand Sanitizer', '4L Hand Sanitizer', 'Eco chem', 15, 'Eco ChemLabs', '4L Hand Sanitizer', '8.00E+11', 0, '5.jpg', ''),
(6, 'Hand Sanitizer', '1L Hand sanitizer', 'Eco chem', 15, 'Eco ChemLabs', '1L Hand Sanitizer', '6.55E+11', 0, '6.jpg', ''),
(7, 'Gloves', 'Vinyl Glove (M)', '', 15, 'Hray', 'Vinyl Blue (M)', '6.26E+11', 0, '7.jpg', ''),
(8, 'Gloves', 'Nitrile Glove (S)', '', 15, 'Tuff', 'Nitrile Blue (S) 100/box', '6.26E+11', 13, '8.jpg', ''),
(9, 'Hand Sanitizer', 'Hand Sanitizer Spray', '', 15, 'Zytec', 'Hand Sanitizer Spray 500 ml', '60480013464', 0, '9.jpg', ''),
(10, 'Gowns', 'Gowns Blue', '', 15, 'Med Pro Defense', 'Blue Gowns', '57565183969', 0, '10.jpg', ''),
(11, 'Gowns', 'Gowns', 'Maxill', 15, 'Chinese', 'Yellow (L)', '', 0, '11.jpg', ''),
(12, 'Gowns', 'Gowns', 'Maxill', 15, 'Chinese', 'Yellow (XL)', '', 0, '12.jpg', ''),
(13, 'Masks', 'Masks Lvl 1', '', 15, 'HXL', 'Lvl 1 Masks', '6.97E+12', 0, '13.jpg', ''),
(14, 'Masks', 'Masks Lvl 2', '', 15, 'Maxem', 'Blue Earloop Lvl 2 Masks', '7.18E+11', 0, '14.jpg', ''),
(15, 'Masks', 'Masks Lvl 3', 'Maxill', 15, 'Maxem', 'Blue Earloop Lvl 3 Masks', '55092135', 0, '15.jpg', 'Box'),
(16, 'Masks', 'Masks Lvl 3', 'Maxill', 15, 'DentXCanada', 'Blue Earloop Mask Lvl 3 Masks', '6.28E+11', 0, '16.jpg', ''),
(17, 'Gloves', 'Gloves (M)', '', 15, 'The Aura', 'Nitrile Glove 300/box (M)', 'DDS-403', 0, '17.jpg', ''),
(18, 'Gloves', 'Gloves (L)', '', 15, 'Ventyv', 'Nitrile (L)', '1.08E+13', 0, '18.jpg', ''),
(19, 'Masks', 'Masks Lvl 3', 'Maxill', 15, 'Medicos', 'Lvl 3 Masks 50/box', 'SM3EL', 0, '19.jpg', ''),
(20, 'Masks', 'Masks Lvl 3', 'Maxill', 15, 'Maxill Pluss', 'Lvl 3 Masks', '1.00E+24', 0, '20.jpg', ''),
(21, 'Masks', 'N95 Masks', '', 15, 'Halyard', 'N95 Masks', '', 0, '21.jpg', ''),
(22, 'Other', 'Shoe Cover', '', 15, 'Maxill', 'Shoe Cover 100/box', '53072', 0, '22.jpg', 'Box'),
(23, 'Other', 'Hair Net', '', 15, '', '', '53065', 0, '23.jpg', ''),
(24, 'Other', 'Face Shield', '', 15, 'Chinese', 'Face Shield 12/pack', '', 0, '24.jpg', ''),
(25, 'Gloves', 'Glove M', 'Maxill', 15, 'Maxill', 'Glove Nitrile M Green', '0110060705511628', 0, '25.jpg', ''),
(26, 'Masks', 'Masks Lvl 3', 'Maxill', 15, 'Maxill', 'Mask Lvl 3 Blue', '53016', 0, '26.jpg', ''),
(29, 'Gowns', 'Nes Pluto Small Gowns', 'Maxill', 3, 'Nes Pluto', 'Small Blue Gowns', '123456', NULL, NULL, ''),
(30, 'Gowns', 'Nes Pluto Medium Gowns', 'Maxill', 3, 'Nes Pluto', 'Medium Blue Gowns', '123457', NULL, NULL, ''),
(31, 'DH Kit', 'kit item 1', 'kit supplier', 1, 'kit', 'kit', 'wqe332hgh23kg4hj423', 25, NULL, ''),
(32, 'DH Kit', 'kit item 2', 'kit supplier', 1, 'kit', 'kit', 'g876fg87d6g8f7g6', 14, NULL, ''),
(33, 'DH Kit', 'kit item 3', 'kit supplier', 1, 'kit', 'kit', 'sgst3e4tt334t43523', 50, NULL, ''),
(34, NULL, 'DH Kit', 'kit supplier', 1, 'kit', 'kit', 'DH Kit', 700, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

DROP TABLE IF EXISTS `purchase_orders`;
CREATE TABLE IF NOT EXISTS `purchase_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` varchar(99) NOT NULL,
  `status` varchar(99) NOT NULL,
  `supplier` varchar(99) NOT NULL,
  `campus` varchar(99) NOT NULL,
  `requester` varchar(99) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`id`, `location`, `status`, `supplier`, `campus`, `requester`) VALUES
(1, 'PO_1.pdf', 'approved', 'Maxill', 'Barrie', 'a'),
(2, 'PO_2.pdf', 'approved', 'Maxill', 'Barrie', 'a'),
(3, 'PO_3.pdf', 'approved', 'Maxill', 'Barrie', 'a'),
(4, 'PO_4.pdf', 'approved', 'Maxill', 'Barrie', 'a'),
(5, 'PO_5.pdf', 'approved', 'Maxill', 'Barrie', 'a'),
(6, 'PO_6.pdf', 'approved', 'Maxill', 'Barrie', 'a'),
(7, 'PO_7.pdf', 'approved', 'Maxill', 'Barrie', 'a'),
(8, 'PO_8.pdf', 'approved', 'Maxill', 'Barrie', 'a'),
(9, 'PO_9.pdf', 'approved', 'Maxill', 'Barrie', 'a'),
(10, 'PO_10.pdf', 'ordered', 'Maxill', 'Barrie', 'a'),
(11, 'PO_11.pdf', 'ordered', 'Nes pluto', 'Barrie', 'b'),
(12, 'PO_12.pdf', 'ordered', 'Maxill', 'Barrie', 'a'),
(13, 'PO_13.pdf', 'ordered', 'Nes pluto', 'Barrie', 'a'),
(14, 'PO_14.pdf', 'ordered', 'Maxill', 'Barrie', 'a'),
(15, 'PO_15.pdf', 'ordered', 'kit supplier', 'Barrie', 'a'),
(16, '../../po/PO_16.pdf', 'ordered', 'Nes pluto', 'Barrie', 'b'),
(17, '../../po/PO_17.pdf', 'approved', 'kit supplier', 'Barrie', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
CREATE TABLE IF NOT EXISTS `requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `r_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `campus` varchar(255) NOT NULL,
  `product_id` varchar(99) NOT NULL,
  `supplier` varchar(99) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` double NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comments` text,
  `po_number` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=96 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `r_id`, `username`, `campus`, `product_id`, `supplier`, `quantity`, `unit_price`, `status`, `time`, `update_time`, `comments`, `po_number`) VALUES
(2, 1, 'hameed', 'Barrie', '2', '', 30, 0, 'recieved', '2020-12-17 17:05:02', '2021-01-04 14:30:49', '', NULL),
(10, 1, 'hameed', 'Barrie', '3', '', 4, 0, 'recieved', '2020-12-17 19:41:34', '2021-01-04 14:30:49', '', NULL),
(15, 2, 'hameed', 'admin', '12', '', 45, 0, 'recieved', '2020-12-16 16:17:52', '2020-12-28 16:14:47', NULL, NULL),
(14, 2, 'hameed', 'admin', '1', '', 15, 0, 'recieved', '2020-12-17 21:10:36', '2020-12-28 16:14:47', NULL, NULL),
(16, 3, 'a', 'Barrie', '1', '', 15, 0, 'recieved', '2020-12-17 21:10:36', '2020-12-18 19:25:26', NULL, NULL),
(17, 3, 'a', 'Barrie', '3', '', 4, 0, 'recieved', '2020-12-17 19:41:34', '2020-12-18 19:25:26', NULL, NULL),
(19, 4, 'b', 'Barrie', '12', '', 10, 0, 'recieved', '2020-12-17 17:05:02', '2020-12-18 19:25:26', NULL, NULL),
(20, 4, 'b', 'Barrie', '7', '', 5, 0, 'recieved', '2020-12-17 17:05:02', '2020-12-18 19:25:26', NULL, NULL),
(21, 5, 'a', 'Barrie', '27', '', 4, 0, 'cancelled', '2020-12-17 19:41:39', '2020-12-18 19:25:26', NULL, NULL),
(22, 5, 'a', 'Barrie', '1', '', 15, 0, 'cancelled', '2020-12-17 21:10:36', '2020-12-18 19:25:26', NULL, NULL),
(24, 6, 'b', 'Barrie', '13', '', 7, 0, 'recieved', '2020-12-17 19:46:43', '2020-12-18 19:25:26', NULL, NULL),
(25, 6, 'b', 'Barrie', '5', '', 4, 0, 'recieved', '2020-12-17 19:46:43', '2020-12-18 19:25:26', NULL, NULL),
(26, 6, 'b', 'Barrie', '27', '', 1, 0, 'recieved', '2020-12-17 19:46:43', '2020-12-18 19:25:26', NULL, NULL),
(27, 6, 'b', 'Barrie', '1', '', 15, 0, 'recieved', '2020-12-17 21:10:36', '2020-12-18 19:25:26', NULL, NULL),
(30, 7, 'a', 'Barrie', '4', '', 20, 0, 'recieved', '2020-12-17 21:12:15', '2020-12-18 19:25:26', NULL, NULL),
(31, 7, 'a', 'Barrie', '2', '', 450, 0, 'recieved', '2020-12-17 21:12:15', '2020-12-18 19:25:26', '', NULL),
(32, 8, 'a', 'Barrie', '6', '', 3, 0, 'denied', '2020-12-21 19:12:51', '2020-12-22 19:48:34', NULL, NULL),
(33, 8, 'a', 'Barrie', '3', '', 4, 0, 'cancelled', '2020-12-21 19:12:51', '2020-12-22 17:19:03', NULL, NULL),
(34, 9, 'b', 'Barrie', '27', '', 5, 0, 'recieved', '2020-12-22 17:31:53', '2020-12-28 15:23:21', NULL, NULL),
(35, 9, 'b', 'Barrie', '4', '', 3, 0, 'cancelled', '2020-12-22 17:31:53', '2020-12-28 15:16:52', NULL, NULL),
(36, 10, 'a', 'Barrie', '1', '', 14, 0, 'denied', '2020-12-28 15:15:23', '2020-12-28 15:19:41', NULL, NULL),
(37, 10, 'a', 'Barrie', '2', '', 45, 0, 'denied', '2020-12-28 15:15:23', '2020-12-28 15:19:41', NULL, NULL),
(38, 11, 'a', 'Barrie', '1', '', 5, 0, 'recieved', '2020-12-28 15:27:00', '2020-12-28 16:14:47', NULL, NULL),
(39, 12, 'a', 'Barrie', '2', '', 4, 0, 'recieved', '2020-12-28 18:56:09', '2020-12-28 18:57:01', NULL, NULL),
(40, 12, 'a', 'Barrie', '1', '', 3, 0, 'recieved', '2020-12-28 18:56:09', '2020-12-28 18:57:02', NULL, NULL),
(41, 12, 'a', 'Barrie', '2', '', 3, 0, 'recieved', '2020-12-28 18:56:09', '2020-12-28 18:57:01', NULL, NULL),
(42, 13, 'a', 'Barrie', '1', '', 4, 0, 'recieved', '2020-12-28 19:33:01', '2020-12-28 19:33:37', NULL, NULL),
(43, 13, 'a', 'Barrie', '2', '', 25, 0, 'recieved', '2020-12-28 19:33:01', '2020-12-28 19:33:37', NULL, NULL),
(44, 14, 'b', 'Barrie', '3', '', 5, 0, 'recieved', '2020-12-31 19:08:25', '2020-12-31 19:17:09', NULL, NULL),
(45, 14, 'b', 'Barrie', '1', '', 25, 0, 'recieved', '2020-12-31 19:08:25', '2020-12-31 19:17:27', NULL, NULL),
(46, 15, 'a', 'Barrie', '16', '', 5, 0, 'cancelled', '2021-01-04 14:38:59', '2021-01-04 14:39:43', NULL, NULL),
(47, 15, 'a', 'Barrie', '8', '', 3, 0, 'recieved', '2021-01-04 14:38:59', '2021-01-04 14:49:12', NULL, NULL),
(48, 15, 'a', 'Barrie', '5', '', 5, 0, 'recieved', '2021-01-04 14:38:59', '2021-01-04 14:51:20', NULL, NULL),
(49, 16, 'a', 'Barrie', '2', '', 5, 0, 'cancelled', '2021-01-04 16:26:39', '2021-01-06 14:31:54', NULL, NULL),
(50, 17, 'a', 'Barrie', '2', '', 3, 0, 'recieved', '2021-01-04 16:28:15', '2021-01-06 14:36:07', NULL, NULL),
(51, 18, 'a', 'Barrie', '1', '', 45, 0, 'denied', '2021-01-04 16:33:49', '2021-01-06 14:33:32', NULL, NULL),
(52, 19, 'a', 'Barrie', '27', '', 5, 0, 'cancelled', '2021-01-04 16:34:34', '2021-01-06 14:32:15', NULL, NULL),
(53, 20, 'a', 'Barrie', '6', '', 3, 0, 'recieved', '2021-01-04 16:42:46', '2021-01-06 15:54:50', NULL, NULL),
(54, 21, 'a', 'Barrie', '2', '', 3, 0, 'denied', '2021-01-04 16:45:33', '2021-01-06 15:54:15', NULL, NULL),
(55, 22, 'a', 'Barrie', '2', '', 3, 0, 'recieved', '2021-01-04 17:30:47', '2021-01-06 15:54:57', NULL, NULL),
(56, 23, 'a', 'Barrie', '1', '', 5, 0, 'cancelled', '2021-01-04 17:32:38', '2021-01-06 14:40:21', NULL, NULL),
(57, 24, 'a', 'Barrie', '1', '', 3, 0, 'recieved', '2021-01-04 17:35:39', '2021-01-06 16:55:40', NULL, NULL),
(58, 25, 'a', 'Barrie', '3', '', 1, 0, 'recieved', '2021-01-04 17:37:47', '2021-01-14 16:26:40', NULL, NULL),
(59, 26, 'a', 'Barrie', '9', '', 4, 0, 'denied', '2021-01-06 14:31:04', '2021-01-14 16:18:57', NULL, NULL),
(60, 26, 'a', 'Barrie', '4', '', 3, 0, 'denied', '2021-01-06 14:31:04', '2021-01-14 16:19:00', NULL, NULL),
(61, 26, 'a', 'Barrie', '2', 'Nes Pluto', 10, 14.99, 'recieved', '2021-01-06 14:31:04', '2021-01-21 19:32:41', NULL, NULL),
(62, 26, 'a', 'Barrie', '8', ' ', 4, 12.99, 'recieved', '2021-01-06 14:31:04', '2021-01-22 16:11:15', NULL, NULL),
(63, 26, 'a', 'Barrie', '15', '', 5, 0, 'denied', '2021-01-06 14:31:04', '2021-01-06 16:52:19', NULL, NULL),
(64, 26, 'a', 'Barrie', '27', '', 3, 0, 'recieved', '2021-01-06 14:31:04', '2021-01-14 16:26:46', NULL, NULL),
(65, 27, 'b', 'Barrie', '2', '', 3, 0, 'recieved', '2021-01-06 14:31:38', '2021-01-06 14:37:50', NULL, NULL),
(66, 28, 'a', 'Barrie', '6', '', 10, 0, 'recieved', '2021-01-06 16:48:08', '2021-01-06 16:55:52', NULL, NULL),
(67, 28, 'a', 'Barrie', '3', '', 5, 0, 'recieved', '2021-01-06 16:48:08', '2021-01-06 16:55:48', NULL, NULL),
(68, 29, 'a', 'Barrie', '3', '', 2, 0, 'recieved', '2021-01-12 22:07:12', '2021-01-14 16:26:50', NULL, NULL),
(69, 29, 'a', 'Barrie', '6', '', 20, 0, 'recieved', '2021-01-12 22:07:12', '2021-01-14 16:26:52', NULL, NULL),
(70, 29, 'a', 'Barrie', '2', 'Nes Pluto', 11, 14.99, 'recieved', '2021-01-12 22:07:12', '2021-01-22 16:12:17', NULL, NULL),
(71, 30, 'a', 'Barrie', '11', '', 10, 0, 'recieved', '2021-01-14 16:16:04', '2021-01-14 16:27:01', NULL, NULL),
(72, 30, 'a', 'Barrie', '5', '', 20, 0, 'cancelled', '2021-01-14 16:16:04', '2021-01-14 16:17:25', NULL, NULL),
(73, 31, 'a', 'Barrie', '28', 'Cisco', 2, 0, 'recieved', '2021-01-21 20:18:31', '2021-01-22 16:12:59', NULL, NULL),
(74, 31, 'a', 'Barrie', '9', '', 5, 0, 'cancelled', '2021-01-21 20:18:31', '2021-01-22 15:20:33', NULL, NULL),
(78, 34, 'a', 'Barrie', '17', '', 5, 0, 'recieved', '2021-01-22 16:11:10', '2021-01-22 16:15:19', NULL, NULL),
(75, 32, 'b', 'Barrie', '23', '', 5, 0, 'denied', '2021-01-22 15:24:35', '2021-01-22 15:30:24', NULL, NULL),
(76, 32, 'b', 'Barrie', '19', '', 3, 0, 'recieved', '2021-01-22 15:24:35', '2021-01-22 16:12:59', NULL, NULL),
(77, 33, 'b', 'Barrie', '11', '', 3, 0, 'recieved', '2021-01-22 15:25:22', '2021-01-22 16:15:22', NULL, NULL),
(79, 35, 'b', 'Barrie', '5', 'Eco chem', 1, 0, 'shipped', '2021-01-22 16:57:53', '2021-01-22 16:58:08', NULL, NULL),
(80, 35, 'b', 'Barrie', '12', 'Maxill', 3, 0, 'shipped', '2021-01-22 16:57:53', '2021-01-22 17:04:12', NULL, NULL),
(81, 35, 'b', 'Barrie', '15', 'Maxill', 5, 0, 'shipped', '2021-01-22 16:57:53', '2021-01-22 17:04:12', NULL, NULL),
(82, 36, 'a', 'Barrie', '6', 'Eco chem', 30, 0, 'recieved', '2021-01-28 17:10:26', '2021-02-10 02:31:13', NULL, NULL),
(83, 36, 'a', 'Barrie', '1', 'Nes pluto', 20, 0, 'recieved', '2021-01-28 17:10:26', '2021-02-10 02:31:16', NULL, NULL),
(84, 37, 'a', 'Barrie', '6', 'Eco chem', 50, 0, 'recieved', '2021-01-28 19:41:03', '2021-02-10 02:31:07', NULL, NULL),
(85, 37, 'a', 'Barrie', '2', 'Nes pluto', 20, 15, 'recieved', '2021-01-28 19:41:03', '2021-02-10 02:31:10', NULL, NULL),
(86, 38, 'b', 'Barrie', '2', 'Nes pluto', 3, 15, 'ordered', '2021-02-01 20:51:04', '2021-03-23 20:27:45', NULL, 16),
(87, 39, 'a', 'Barrie', '060705514226', 'Nes pluto', 5, 0, 'ordered', '2021-02-03 16:07:32', '2021-03-23 20:20:45', NULL, 12),
(88, 39, 'a', 'Barrie', '55092135', 'Maxill', 20, 0, 'cancelled', '2021-02-03 16:07:32', '2021-02-03 16:12:49', NULL, NULL),
(89, 39, 'a', 'Barrie', '53072', '', 5, 0, 'recieved', '2021-02-03 16:07:32', '2021-02-03 16:28:53', NULL, NULL),
(90, 40, 'a', 'Barrie', '60480013464', '', 5, 0, 'denied', '2021-02-10 02:26:52', '2021-02-10 02:29:07', NULL, NULL),
(91, 40, 'a', 'Barrie', '060705514226', 'Nes pluto', 10, 0, 'ordered', '2021-02-10 02:26:52', '2021-02-11 22:00:45', NULL, 13),
(92, 1, 'a', 'Barrie', '55092135', 'Maxill', 4, 0, 'ordered', '2021-02-11 16:29:49', '2021-03-23 19:47:41', NULL, 14),
(93, 42, 'a', 'Barrie', 'sgst3e4tt334t43523', 'kit supplier', 3, 700, 'cancelled', '2021-03-11 19:59:37', '2021-03-12 16:37:39', NULL, NULL),
(94, 43, 'a', 'Barrie', 'DH Kit', 'kit supplier', 2, 700, 'ordered', '2021-03-12 16:32:14', '2021-03-12 16:53:10', NULL, 15),
(95, 45, 'a', 'Barrie', 'DH Kit', 'kit supplier', 2, 700, 'approved', '2021-03-25 16:19:25', '2021-03-25 16:30:13', NULL, 17);

-- --------------------------------------------------------

--
-- Table structure for table `scarborough_inv`
--

DROP TABLE IF EXISTS `scarborough_inv`;
CREATE TABLE IF NOT EXISTS `scarborough_inv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(99) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
(6, 6, 131),
(7, 7, 60),
(8, 8, 88),
(9, 9, 282),
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scar_rmv`
--

INSERT INTO `scar_rmv` (`id`, `product_id`, `quantity`, `assigned_to`, `removed_by`, `time`) VALUES
(1, 2, 50, 'DH Scarborough', 'Mohammed Hameeduddin', '2020-11-18 16:09:49.245519'),
(2, 4, 2, 'Scarborough', 'Mohammed Hameeduddin', '2020-11-18 16:13:40.010590'),
(3, 6, 1, 'Amealia', 'Mohammed Hameeduddin', '2020-12-09 16:58:25.492353');

-- --------------------------------------------------------

--
-- Table structure for table `sub_history`
--

DROP TABLE IF EXISTS `sub_history`;
CREATE TABLE IF NOT EXISTS `sub_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `campus` varchar(99) NOT NULL,
  `remover` varchar(99) NOT NULL,
  `given_to` varchar(99) NOT NULL,
  `product_id` varchar(99) NOT NULL,
  `quantity` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_history`
--

INSERT INTO `sub_history` (`id`, `campus`, `remover`, `given_to`, `product_id`, `quantity`, `time`) VALUES
(1, 'Barrie', 'a', 'Hameed', '060705514226', 3, '2021-02-03 16:47:00'),
(2, 'Barrie', 'a', 'Hameed', '53072', 25, '2021-02-03 16:47:12');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(99) NOT NULL,
  `address` varchar(99) NOT NULL,
  `email` varchar(99) NOT NULL,
  `phone_number` varchar(99) NOT NULL,
  `fax_number` varchar(99) NOT NULL,
  `contact` varchar(99) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `address`, `email`, `phone_number`, `fax_number`, `contact`) VALUES
(1, 'Maxill', '80 Elm Street St. Thomas, ON N5R 6C8', 'hameed@oxfordedu.ca', '1-800-268-8633', '1-800-268-8633', 'Customer Support'),
(2, 'Nes Pluto', '670 Progress Avenue, Scarborough, Ontario', 'a.ansari@oxfordedu.ca', '416 439 8668', '416 439 8668', 'Customer Support'),
(3, 'kit supplier', '670 Progress Avenue', 'a.ansari@oxfordedu.ca', '416 439 8668', '416 439 8668', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `toronto_inv`
--

DROP TABLE IF EXISTS `toronto_inv`;
CREATE TABLE IF NOT EXISTS `toronto_inv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(99) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `email` varchar(255) NOT NULL,
  `campus` varchar(99) NOT NULL,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullname`, `username`, `password`, `email`, `campus`, `role`) VALUES
(2, 'Abdurrahman Ansari', 'a.ansari@oxfordedu.ca', 'Oxford@12', 'a.ansari@oxfordedu.ca', 'admin', 'admin'),
(4, 'a', 'a', 'a', 'abdurrahman.ansari@hotmail.com', 'Barrie', 'local'),
(5, 'b', 'b', 'b', 'hameed@oxfordedu.ca', 'Barrie', 'campus'),
(6, 'c', 'c', 'c', 'hameed@oxfordedu.ca', 'purchasing', 'purchasing'),
(7, 'd', 'd', 'd', 'hameed@oxfordedu.ca', 'warehouse', 'warehouse'),
(8, 'Hameed', 'hameed@oxfordedu.ca', 'Futica670', 'hameed@oxfordedu.ca', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_inv`
--

DROP TABLE IF EXISTS `warehouse_inv`;
CREATE TABLE IF NOT EXISTS `warehouse_inv` (
  `id` int(99) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(99) NOT NULL,
  `pm_quantity` int(99) NOT NULL,
  `quantity` int(99) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warehouse_inv`
--

INSERT INTO `warehouse_inv` (`id`, `product_id`, `pm_quantity`, `quantity`) VALUES
(1, '060705514226', 37, 97),
(2, '060705514219', -395, 1240),
(3, '060705514233', 32, 32),
(4, '060705514240', -15, 5),
(5, '5', -2, 2),
(6, '6', 132, 132),
(7, '7', 40, 60),
(8, '8', 88, 88),
(9, '9', 232, 232),
(10, '10', 2350, 2350),
(11, '11', 840, 840),
(12, '12', 2155, 2240),
(13, '13', 183, 190),
(14, '14', 390, 390),
(15, '15', 500, 500),
(16, '16', 308, 308),
(17, '17', 20, 20),
(18, '18', 30, 30),
(19, '19', 40, 40),
(20, '20', 114, 114),
(21, '21', 18, 18),
(22, '22', 18, 18),
(23, '23', 10, 10),
(24, '24', 740, 740),
(25, '25', 60, 60),
(26, '26', 240, 240);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_rcv`
--

DROP TABLE IF EXISTS `warehouse_rcv`;
CREATE TABLE IF NOT EXISTS `warehouse_rcv` (
  `id` int(99) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(99) NOT NULL,
  `quantity` int(99) NOT NULL,
  `delivered_by` varchar(99) NOT NULL,
  `received_by` varchar(99) NOT NULL,
  `time` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warehouse_rcv`
--

INSERT INTO `warehouse_rcv` (`id`, `product_id`, `quantity`, `delivered_by`, `received_by`, `time`) VALUES
(1, '22', 10, 'Courier', 'Kumar Kumarakuruparan', '2020-11-09 19:56:26.120604'),
(2, '23', 10, 'Courier', 'Kumar Kumarakuruparan', '2020-11-09 20:15:34.193140'),
(3, '22', 100, 'Courier', 'Kumar Kumarakuruparan', '2020-11-09 20:19:21.817789'),
(4, '25', 50, 'Courier', 'Kumar Kumarakuruparan', '2020-11-09 20:21:49.305267'),
(5, '2', 50, 'Courier', 'Kumar Kumarakuruparan', '2020-11-09 20:25:27.874366'),
(6, '2', 50, 'UPS', 'Mohammed Hameeduddin', '2020-11-18 16:09:00.277780'),
(7, '1', 10, 'Courier', 'Mohammed Hameeduddin', '2020-11-20 01:31:19.033156'),
(8, '9', 50, '', 'Mohammed Hameeduddin', '2020-12-09 16:54:35.779378'),
(9, '1', 45, 'UPS', 'd', '2020-12-31 17:08:07.251898'),
(10, '1', 3, 'Hameed', 'd', '2021-01-22 16:08:21.470006'),
(11, '1', 3, 'UPS', 'd', '2021-01-22 16:08:26.446128');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_send`
--

DROP TABLE IF EXISTS `warehouse_send`;
CREATE TABLE IF NOT EXISTS `warehouse_send` (
  `id` int(99) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(99) NOT NULL,
  `quantity` int(99) NOT NULL,
  `shipped_by` varchar(99) NOT NULL,
  `shipped_to` varchar(99) NOT NULL,
  `sent_with` varchar(255) NOT NULL,
  `time` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warehouse_send`
--

INSERT INTO `warehouse_send` (`id`, `product_id`, `quantity`, `shipped_by`, `shipped_to`, `sent_with`, `time`) VALUES
(1, '22', 10, 'Courier', 'Kumar Kumarakuruparan', '', '2020-11-09 19:56:26.120604'),
(2, '23', 10, 'Courier', 'Kumar Kumarakuruparan', '', '2020-11-09 20:15:34.193140'),
(3, '22', 100, 'Courier', 'Kumar Kumarakuruparan', '', '2020-11-09 20:19:21.817789'),
(4, '25', 50, 'Courier', 'Kumar Kumarakuruparan', '', '2020-11-09 20:21:49.305267'),
(5, '2', 50, 'Courier', 'Kumar Kumarakuruparan', '', '2020-11-09 20:25:27.874366'),
(6, '2', 50, 'UPS', 'Mohammed Hameeduddin', '', '2020-11-18 16:09:00.277780'),
(7, '1', 10, 'Courier', 'Mohammed Hameeduddin', '', '2020-11-20 01:31:19.033156'),
(8, '9', 50, '', 'Mohammed Hameeduddin', '', '2020-12-09 16:54:35.779378'),
(9, '3', 4, 'd', 'Barrie', 'Hameed', '2020-12-31 20:38:36.319254'),
(10, '8', 3, 'd', 'Barrie', 'Abdurrahman', '2021-01-04 14:48:32.367742'),
(11, '2', 3, 'd', 'Barrie', 'Hameed', '2021-01-06 14:35:51.678708'),
(12, '6', 3, 'd', 'Barrie', 'Hameed', '2021-01-06 15:54:32.817181'),
(13, '1', 3, 'd', 'Barrie', 'Kumar', '2021-01-06 16:53:13.085850'),
(14, '27', 3, 'd', 'Barrie', 'Kumar', '2021-01-06 16:53:24.713152'),
(15, '27', 3, 'd', 'Barrie', 'Kumar', '2021-01-06 16:53:28.845537'),
(16, '3', 5, 'd', 'Barrie', 'Kumar', '2021-01-06 16:53:39.081385'),
(17, '3', 1, 'd', 'Barrie', 'Kumar', '2021-01-14 16:25:52.865228'),
(18, '6', 20, 'd', 'Barrie', 'Hameed', '2021-01-14 16:25:59.897095'),
(19, '3', 2, 'd', 'Barrie', 'Hameed', '2021-01-14 16:26:07.735179'),
(20, '28', 2, 'd', 'Barrie', 'Abdurrahman', '2021-01-22 16:08:33.953670'),
(21, '17', 5, 'd', 'Barrie', 'Hameed', '2021-01-22 16:11:57.289826'),
(22, '060705514226', 5, 'd', 'Barrie', 'Hameed', '2021-02-03 16:24:21.174699'),
(23, '1', 20, 'd', 'Barrie', 'Hameed', '2021-02-10 02:30:41.629211');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
