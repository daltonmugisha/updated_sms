-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: shareddb-m.hosting.stackcp.net
-- Generation Time: Sep 09, 2024 at 08:51 PM
-- Server version: 10.6.18-MariaDB-log
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stock_db-3130313f7a`
--
CREATE DATABASE IF NOT EXISTS `stock_db-3130313f7a` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `stock_db-3130313f7a`;

-- --------------------------------------------------------

--
-- Table structure for table `allstudents`
--

CREATE TABLE `allstudents` (
  `id` int(11) NOT NULL,
  `studentName` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `back_order_list`
--

CREATE TABLE `back_order_list` (
  `id` int(30) NOT NULL,
  `receiving_id` int(30) NOT NULL,
  `po_id` int(30) NOT NULL,
  `bo_code` varchar(50) NOT NULL,
  `supplier_id` int(30) NOT NULL,
  `amount` float NOT NULL,
  `discount_perc` float NOT NULL DEFAULT 0,
  `discount` float NOT NULL DEFAULT 0,
  `tax_perc` float NOT NULL DEFAULT 0,
  `tax` float NOT NULL DEFAULT 0,
  `remarks` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = pending, 1 = partially received, 2 =received',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bo_items`
--

CREATE TABLE `bo_items` (
  `bo_id` int(30) NOT NULL,
  `item_id` int(30) NOT NULL,
  `quantity` int(30) NOT NULL,
  `price` float NOT NULL DEFAULT 0,
  `unit` varchar(50) NOT NULL,
  `total` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cash`
--

CREATE TABLE `cash` (
  `id` int(11) NOT NULL,
  `person` varchar(250) NOT NULL,
  `money` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `whoowe` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cash`
--

INSERT INTO `cash` (`id`, `person`, `money`, `status`, `whoowe`) VALUES
(14, 'ERIC', '5000', 'They paid me', 'OWEME'),
(15, 'GAEL', '50000', 'I payed some', 'OWETHE'),
(16, 'VLABATIZO', '100000', 'You have not paid', 'OWETHE'),
(17, 'kamali kevin', '120000', 'Waiting for payment', 'OWEME');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `Date` varchar(250) NOT NULL,
  `Status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `Date`, `Status`) VALUES
(24, 'Laptops', 'All laptops for switchiify', '2024-08-08 15:15:01', '1'),
(25, 'DESK-TOP', 'All desktop', '2024-08-08 15:15:29', '1'),
(26, 'keyBoard', 'All keyBoard\r\n', '2024-08-08 15:15:52', '1'),
(27, 'Mouce', 'All mouce', '2024-08-08 15:16:14', '1'),
(28, 'Monitor', 'Monitor for the company', '2024-08-08 15:16:47', '1'),
(29, 'FUNITURE ', 'TABLES, CHAIRS AND OTHERS', '2024-08-08 15:54:15', '1'),
(30, 'INTERNET  AND CABLES', '', '2024-08-08 16:24:07', '1'),
(32, 'beer', 'all kinds of beers', '2024-09-09 18:00:13', '1');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `start`, `end`) VALUES
(9, 'ending everything', 'launch meintoyou, end contract thing  and get last updates from bujuli, get paid the money from ac clinic, re arrange the tools and equipment', '2024-08-08', '2024-08-09'),
(10, 'This day, i failed ', 'I think the team took alot of time to come to a conclusion ', '2024-08-08', '2024-08-09'),
(11, 'okay ', '', '2024-08-09', '2024-08-10'),
(12, 'SCHOOL ITEMS PURCHASE', 'UNO MUNSI NZAKORA PURCHASE ORDER ZABANYESHURI BU MU MWAKA WAMBERE ', '2024-08-31', '2024-09-01'),
(13, 'ICYUMWERU CYAHARIWE IGENZURA RYIBIKORESHO BYIKIGO', '', '2024-08-18', '2024-08-25'),
(14, 'NULL', 'NOPT NULL BUY', '2024-09-06', '2024-09-07');

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `id` int(11) NOT NULL,
  `guestn` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`id`, `guestn`) VALUES
(1, 'Random people'),
(3, 'famiye eric'),
(4, 'tr mathe'),
(5, 'WEMBA');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `owner` varchar(250) NOT NULL,
  `history` varchar(250) NOT NULL,
  `date` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `owner`, `history`, `date`) VALUES
(1, '10', 'You have added a new supplier', '2024-07-25 08:09:10'),
(2, '10', 'You have made a purchase order', '2024-07-25 08:09:38'),
(3, '10', 'The school stock has received new items', '2024-07-25 08:09:52'),
(4, '10', 'The school stock has received new items', '2024-07-25 08:11:53'),
(5, '10', 'You have made a purchase order', '2024-07-26 03:30:12'),
(6, '10', 'The school stock has received new items', '2024-07-26 03:32:24'),
(7, '10', 'The new item has been sold. Nolonger in stock', '2024-07-26 03:34:04'),
(8, '10', 'The new item has been sold. Nolonger in stock', '2024-07-26 03:40:53'),
(9, '10', 'The new item has been sold. Nolonger in stock', '2024-07-26 03:47:12'),
(10, '10', 'The new item has been sold. Nolonger in stock', '2024-07-26 03:49:46'),
(11, '10', 'The new item has been sold. Nolonger in stock', '2024-07-26 03:50:19'),
(12, '10', 'You have made a purchase order', '2024-07-26 04:23:35'),
(13, '10', 'The new item has been sold. Nolonger in stock', '2024-07-26 06:47:16'),
(14, '10', 'The new item has been sold. Nolonger in stock', '2024-07-26 06:48:20'),
(15, '10', 'You have made a purchase order', '2024-07-26 06:49:56'),
(16, '10', 'New items are returned back to the customer', '2024-07-26 06:58:21'),
(17, '10', 'You have made a purchase order', '2024-07-27 06:21:05'),
(18, '10', 'The school stock has received new items', '2024-07-27 06:21:56'),
(19, '10', 'New items are returned back to the customer', '2024-07-27 06:23:19'),
(20, '10', 'You have made a purchase order', '2024-07-27 06:37:06'),
(21, '10', 'You have added a new supplier', '2024-08-08 08:18:27'),
(22, '10', 'You have added a new supplier', '2024-08-08 08:18:34'),
(23, '10', 'You have added a new supplier', '2024-08-08 09:13:36'),
(24, '10', 'You have added a new supplier', '2024-08-08 09:14:40'),
(25, '10', 'You have added a new supplier', '2024-08-08 09:24:42'),
(26, '10', 'You have added a new supplier', '2024-08-08 09:39:31'),
(27, '10', 'You have made a purchase order', '2024-08-08 09:52:35'),
(28, '10', 'The school stock has received new items', '2024-08-08 10:03:16'),
(29, '10', 'You have made a purchase order', '2024-08-08 10:08:47'),
(30, '10', 'The school stock has received new items', '2024-08-08 10:09:21'),
(31, '10', 'You have made a purchase order', '2024-08-08 10:10:54'),
(32, '10', 'The school stock has received new items', '2024-08-08 10:11:10'),
(33, '10', 'You have made a purchase order', '2024-08-08 10:11:26'),
(34, '10', 'The school stock has received new items', '2024-08-08 10:11:53'),
(35, '10', 'You have made a purchase order', '2024-08-08 10:13:34'),
(36, '10', 'The school stock has received new items', '2024-08-08 10:13:49'),
(37, '10', 'You have made a purchase order', '2024-08-08 10:14:01'),
(38, '10', 'The school stock has received new items', '2024-08-08 10:14:16'),
(39, '10', 'You have made a purchase order', '2024-08-30 11:09:15'),
(40, '10', 'The school stock has received new items', '2024-08-30 11:23:35'),
(41, '10', 'New items are returned back to the customer', '2024-08-30 11:26:05'),
(42, '10', 'The new item has been sold. Nolonger in stock', '2024-08-30 11:32:45'),
(43, '10', 'You have added a new supplier', '2024-08-30 11:44:08'),
(44, '10', 'The new item has been sold. Nolonger in stock', '2024-08-30 12:09:30'),
(45, '10', 'New items are returned back to the customer', '2024-09-06 15:39:34'),
(46, '10', 'You have made a purchase order', '2024-09-06 15:42:20'),
(47, '10', 'The school stock has received new items', '2024-09-06 15:43:14'),
(48, '10', 'The school stock has received new items', '2024-09-06 15:43:47'),
(49, '10', 'You have made a purchase order', '2024-09-06 15:44:38'),
(50, '10', 'The school stock has received new items', '2024-09-06 15:45:07'),
(51, '10', 'The school stock has received new items', '2024-09-07 13:14:14'),
(52, '10', 'The new item has been sold. Nolonger in stock', '2024-09-07 20:52:14'),
(53, '15', 'You have added a new supplier', '2024-09-09 10:54:56'),
(54, '15', 'You have made a purchase order', '2024-09-09 11:13:46');

-- --------------------------------------------------------

--
-- Table structure for table `item_list`
--

CREATE TABLE `item_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `supplier_id` int(30) NOT NULL,
  `cost` float NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cat_id` int(199) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_list`
--

INSERT INTO `item_list` (`id`, `name`, `description`, `supplier_id`, `cost`, `status`, `date_created`, `date_updated`, `cat_id`) VALUES
(4, 'lenovo ThinkCenter', 'Lenovo ThinkCentre 2.81 GHz 8GB 237 GB i5 8th Generation', 2, 200000, 1, '2024-08-08 08:30:40', '2024-08-08 08:30:40', 25),
(5, 'hp keyBoard', 'HP KEYBOARD', 3, 18000, 1, '2024-08-08 08:33:32', '2024-08-08 08:33:32', 26),
(6, 'DELL KEYBOARD', 'dell computer', 2, 20000, 1, '2024-08-08 08:37:42', '2024-08-08 08:37:42', 26),
(8, 'DELL MONITOR 1', '', 3, 150000, 1, '2024-08-08 08:47:12', '2024-08-08 09:12:52', 28),
(9, 'LENOVO MINI DESKTOP I5V PRO', 'I5V PRO', 2, 350000, 1, '2024-08-08 08:50:10', '2024-08-08 09:21:08', 25),
(10, 'LENOVO MINI DESKTOP I3', '8TH GEN', 2, 250000, 1, '2024-08-08 08:51:51', '2024-08-08 09:56:34', 25),
(11, 'OFFICE TABLE', '', 2, 300000, 1, '2024-08-08 08:55:20', '2024-08-08 08:55:20', 29),
(12, 'LENOVO MONITOR 2', '', 3, 200000, 1, '2024-08-08 08:57:34', '2024-08-08 09:54:46', 28),
(13, 'DELL MONITOR 2', '', 3, 100000, 1, '2024-08-08 08:58:30', '2024-08-08 08:58:30', 28),
(14, 'DELL 3.19 GHz', '', 3, 350000, 1, '2024-08-08 09:09:31', '2024-08-08 09:09:31', 25),
(15, 'lenovo Celelon', '', 3, 250000, 1, '2024-08-08 09:12:24', '2024-08-08 09:12:24', 25),
(16, 'wall tables', '', 4, 170000, 1, '2024-08-08 09:14:09', '2024-08-08 09:14:09', 29),
(17, 'BLACK TABLE', '', 5, 15000, 1, '2024-08-08 09:15:25', '2024-08-08 09:15:25', 29),
(18, 'DELL MOUCE BIG INC', '', 2, 6000, 1, '2024-08-08 09:18:15', '2024-08-08 09:18:15', 27),
(19, 'MOUCE JESS', '', 3, 6000, 1, '2024-08-08 09:18:57', '2024-08-08 09:18:57', 27),
(20, 'HP FROM BIG INC', '', 2, 18000, 1, '2024-08-08 09:22:26', '2024-08-08 09:22:26', 26),
(21, 'CANAL - BOX 63C', '', 6, 25000, 1, '2024-08-08 09:25:25', '2024-08-08 09:25:25', 30),
(22, 'CANAL - BOX OLD', '', 6, 25000, 1, '2024-08-08 09:25:45', '2024-08-08 10:10:39', 30),
(23, 'BIG ETHERENT', '', 2, 90000, 1, '2024-08-08 09:26:57', '2024-08-08 09:26:57', 30),
(24, 'RED ETHERENT', '', 3, 5000, 1, '2024-08-08 09:27:44', '2024-08-08 09:27:44', 30),
(25, 'SMALL BLUE ETHERNER', '', 3, 5000, 1, '2024-08-08 09:28:29', '2024-08-08 09:28:29', 30),
(26, 'LENOVO SMALL SIZE', '', 2, 70000, 1, '2024-08-08 09:31:23', '2024-08-08 09:31:23', 28),
(27, 'HP SMAL SIZE', '', 2, 70000, 1, '2024-08-08 09:32:38', '2024-08-08 09:32:38', 28),
(28, 'MINI ETHERNET', '', 3, 1500, 1, '2024-08-08 09:34:53', '2024-08-08 09:34:53', 30),
(29, 'LAUNGE', '', 2, 20000, 1, '2024-08-08 09:35:56', '2024-08-08 09:40:35', 30),
(30, 'WHITE BLUE MULT SOCKET', '', 7, 1500, 1, '2024-08-08 09:40:09', '2024-08-08 09:40:09', 30),
(31, 'PLASTIC SHAIR', '', 7, 9000, 1, '2024-08-08 09:41:27', '2024-08-08 09:41:27', 29),
(32, 'WHITE  SCREEN DELL', '', 3, 100000, 1, '2024-08-08 09:43:42', '2024-08-08 09:43:42', 28),
(33, 'TELPHONE TECHO MODE5 ', 'IBINDI BIJYANYE NIYO TELEPHONE', 8, 200000, 1, '2024-08-30 11:47:23', '2024-08-30 11:47:23', 24),
(34, 'ETHERNET CABLE 3.15', '90m', 8, 30000, 1, '2024-09-07 20:46:14', '2024-09-07 20:46:14', 26),
(35, 'amstel', 'local beer', 9, 1500, 1, '2024-09-09 11:03:27', '2024-09-09 11:03:27', 32);

-- --------------------------------------------------------

--
-- Table structure for table `po_items`
--

CREATE TABLE `po_items` (
  `po_id` int(30) NOT NULL,
  `item_id` int(30) NOT NULL,
  `quantity` int(30) NOT NULL,
  `price` float NOT NULL DEFAULT 0,
  `unit` varchar(50) NOT NULL,
  `total` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `po_items`
--

INSERT INTO `po_items` (`po_id`, `item_id`, `quantity`, `price`, `unit`, `total`) VALUES
(45, 9, 1, 350000, 'pcs', 350000),
(45, 4, 1, 200000, 'pcs', 200000),
(45, 11, 1, 300000, 'pcs', 300000),
(45, 29, 1, 20000, 'pcs', 20000),
(45, 18, 3, 6000, 'pcs', 18000),
(45, 27, 1, 70000, '', 70000),
(45, 26, 2, 70000, '', 140000),
(45, 10, 1, 250000, 'pcs', 250000),
(45, 23, 1, 90000, 'pcs', 90000),
(45, 20, 2, 18000, '', 36000),
(45, 6, 1, 20000, '', 20000),
(46, 32, 1, 100000, 'pcs', 100000),
(46, 5, 3, 18000, '', 54000),
(46, 8, 1, 150000, 'pcs', 150000),
(46, 12, 1, 200000, 'pkt', 200000),
(46, 13, 1, 100000, '', 100000),
(46, 14, 1, 350000, 'dzn', 350000),
(46, 15, 1, 250000, 'dzn', 250000),
(46, 19, 2, 6000, '', 12000),
(46, 24, 1, 5000, '', 5000),
(46, 28, 1, 1500, '', 1500),
(46, 25, 1, 5000, '', 5000),
(47, 21, 2, 25000, 'pkt', 50000),
(48, 16, 1, 170000, 'pcs', 170000),
(49, 30, 2, 1500, '', 3000),
(49, 31, 7, 9000, '', 63000),
(50, 17, 1, 15000, '', 15000),
(51, 5, 5, 18000, 'pcs', 90000),
(51, 19, 2, 6000, 'pcs', 12000),
(52, 33, 250, 200000, 'pcs', 50000000),
(53, 33, 480, 200000, 'bte', 96000000),
(54, 35, 12, 1500, 'dozen', 18000);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_list`
--

CREATE TABLE `purchase_order_list` (
  `id` int(30) NOT NULL,
  `po_code` varchar(50) NOT NULL,
  `supplier_id` int(30) NOT NULL,
  `amount` float NOT NULL,
  `discount_perc` float NOT NULL DEFAULT 0,
  `discount` float NOT NULL DEFAULT 0,
  `tax_perc` float NOT NULL DEFAULT 0,
  `tax` float NOT NULL DEFAULT 0,
  `remarks` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = pending, 1 = partially received, 2 =received',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_order_list`
--

INSERT INTO `purchase_order_list` (`id`, `po_code`, `supplier_id`, `amount`, `discount_perc`, `discount`, `tax_perc`, `tax`, `remarks`, `status`, `date_created`, `date_updated`) VALUES
(45, 'PO-0001', 2, 1494000, 0, 0, 0, 0, '', 2, '2024-08-08 09:52:35', '2024-08-08 10:03:16'),
(46, 'PO-0002', 3, 1227500, 0, 0, 0, 0, '', 2, '2024-08-08 10:08:47', '2024-08-08 10:09:21'),
(47, 'PO-0003', 6, 50000, 0, 0, 0, 0, '', 2, '2024-08-08 10:10:54', '2024-08-08 10:11:10'),
(48, 'PO-0004', 4, 170000, 0, 0, 0, 0, '', 2, '2024-08-08 10:11:26', '2024-08-08 10:11:53'),
(49, 'PO-0005', 7, 66000, 0, 0, 0, 0, '', 2, '2024-08-08 10:13:34', '2024-08-08 10:13:49'),
(50, 'PO-0006', 5, 15000, 0, 0, 0, 0, '', 2, '2024-08-08 10:14:01', '2024-08-30 11:23:35'),
(51, 'PO-0007', 3, 102000, 0, 0, 0, 0, 'Twifuza ko bino bikoresho byatugeraho bitarenze iminsi itatu', 2, '2024-08-30 11:09:15', '2024-09-06 15:43:47'),
(52, 'PO-0008', 8, 50000000, 0, 0, 0, 0, 'NICE PRODUCT', 2, '2024-09-06 15:42:20', '2024-09-06 15:43:14'),
(53, 'PO-0009', 8, 96000000, 0, 0, 0, 0, 'ummhh', 2, '2024-09-06 15:44:38', '2024-09-07 13:14:14'),
(54, 'PO-0010', 9, 17100, 5, 900, 0, 0, 'cool', 0, '2024-09-09 11:13:46', '2024-09-09 11:13:46');

-- --------------------------------------------------------

--
-- Table structure for table `receiving_list`
--

CREATE TABLE `receiving_list` (
  `id` int(30) NOT NULL,
  `form_id` int(30) NOT NULL,
  `from_order` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=PO ,2 = BO',
  `amount` float NOT NULL DEFAULT 0,
  `discount_perc` float NOT NULL DEFAULT 0,
  `discount` float NOT NULL DEFAULT 0,
  `tax_perc` float NOT NULL DEFAULT 0,
  `tax` float NOT NULL DEFAULT 0,
  `stock_ids` text DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receiving_list`
--

INSERT INTO `receiving_list` (`id`, `form_id`, `from_order`, `amount`, `discount_perc`, `discount`, `tax_perc`, `tax`, `stock_ids`, `remarks`, `date_created`, `date_updated`) VALUES
(37, 45, 1, 1494000, 0, 0, 0, 0, '91,92,93,94,95,96,97,98,99,100,101', '', '2024-08-08 10:03:16', '2024-08-08 10:03:16'),
(38, 46, 1, 1227500, 0, 0, 0, 0, '102,103,104,105,106,107,108,109,110,111,112', '', '2024-08-08 10:09:21', '2024-08-08 10:09:21'),
(39, 47, 1, 50000, 0, 0, 0, 0, '113', '', '2024-08-08 10:11:10', '2024-08-08 10:11:10'),
(40, 48, 1, 170000, 0, 0, 0, 0, '114', '', '2024-08-08 10:11:53', '2024-08-08 10:11:53'),
(41, 49, 1, 66000, 0, 0, 0, 0, '115,116', '', '2024-08-08 10:13:49', '2024-08-08 10:13:49'),
(43, 50, 1, 15000, 0, 0, 0, 0, '118', '', '2024-08-30 11:23:35', '2024-08-30 11:23:35'),
(44, 52, 1, 50000000, 0, 0, 0, 0, '121', 'NICE PRODUCT', '2024-09-06 15:43:14', '2024-09-06 15:43:14'),
(45, 51, 1, 102000, 0, 0, 0, 0, '122,123', 'Twifuza ko bino bikoresho byatugeraho bitarenze iminsi itatu', '2024-09-06 15:43:47', '2024-09-06 15:43:47'),
(47, 53, 1, 96000000, 0, 0, 0, 0, '125', 'ummhh', '2024-09-07 13:14:14', '2024-09-07 13:14:14');

-- --------------------------------------------------------

--
-- Table structure for table `return_list`
--

CREATE TABLE `return_list` (
  `id` int(30) NOT NULL,
  `return_code` varchar(50) NOT NULL,
  `supplier_id` int(30) NOT NULL,
  `amount` float NOT NULL DEFAULT 0,
  `remarks` text DEFAULT NULL,
  `stock_ids` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `return_list`
--

INSERT INTO `return_list` (`id`, `return_code`, `supplier_id`, `amount`, `remarks`, `stock_ids`, `date_created`, `date_updated`) VALUES
(19, 'R-0001', 8, 0, '', '', '2024-09-06 15:39:34', '2024-09-06 15:39:34');

-- --------------------------------------------------------

--
-- Table structure for table `sales_list`
--

CREATE TABLE `sales_list` (
  `id` int(30) NOT NULL,
  `sales_code` varchar(50) NOT NULL,
  `client` text DEFAULT NULL,
  `amount` float NOT NULL DEFAULT 0,
  `remarks` text DEFAULT NULL,
  `stock_ids` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_list`
--

INSERT INTO `sales_list` (`id`, `sales_code`, `client`, `amount`, `remarks`, `stock_ids`, `date_created`, `date_updated`) VALUES
(23, 'SALE-0001', 'tr mathe', 15000, '', '120', '2024-08-30 12:09:30', '2024-08-30 12:09:30'),
(24, 'SALE-0002', 'Random people', 2400000, '', '126', '2024-09-07 20:52:14', '2024-09-07 20:52:14');

-- --------------------------------------------------------

--
-- Table structure for table `stock_list`
--

CREATE TABLE `stock_list` (
  `id` int(30) NOT NULL,
  `item_id` int(30) NOT NULL,
  `quantity` int(30) NOT NULL,
  `unit` varchar(250) DEFAULT NULL,
  `price` float NOT NULL DEFAULT 0,
  `total` float NOT NULL DEFAULT current_timestamp(),
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=IN , 2=OUT',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_list`
--

INSERT INTO `stock_list` (`id`, `item_id`, `quantity`, `unit`, `price`, `total`, `type`, `date_created`) VALUES
(91, 9, 1, 'pcs', 350000, 350000, 1, '2024-08-08 10:03:16'),
(92, 4, 1, 'pcs', 200000, 200000, 1, '2024-08-08 10:03:16'),
(93, 11, 1, 'pcs', 300000, 300000, 1, '2024-08-08 10:03:16'),
(94, 29, 1, 'pcs', 20000, 20000, 1, '2024-08-08 10:03:16'),
(95, 18, 3, 'pcs', 6000, 18000, 1, '2024-08-08 10:03:16'),
(96, 27, 1, '', 70000, 70000, 1, '2024-08-08 10:03:16'),
(97, 26, 2, '', 70000, 140000, 1, '2024-08-08 10:03:16'),
(98, 10, 1, 'pcs', 250000, 250000, 1, '2024-08-08 10:03:16'),
(99, 23, 1, 'pcs', 90000, 90000, 1, '2024-08-08 10:03:16'),
(100, 20, 2, '', 18000, 36000, 1, '2024-08-08 10:03:16'),
(101, 6, 1, '', 20000, 20000, 1, '2024-08-08 10:03:16'),
(102, 32, 1, 'pcs', 100000, 100000, 1, '2024-08-08 10:09:21'),
(103, 5, 3, '', 18000, 54000, 1, '2024-08-08 10:09:21'),
(104, 8, 1, 'pcs', 150000, 150000, 1, '2024-08-08 10:09:21'),
(105, 12, 1, 'pkt', 200000, 200000, 1, '2024-08-08 10:09:21'),
(106, 13, 1, '', 100000, 100000, 1, '2024-08-08 10:09:21'),
(107, 14, 1, 'dzn', 350000, 350000, 1, '2024-08-08 10:09:21'),
(108, 15, 1, 'dzn', 250000, 250000, 1, '2024-08-08 10:09:21'),
(109, 19, 2, '', 6000, 12000, 1, '2024-08-08 10:09:21'),
(110, 24, 1, '', 5000, 5000, 1, '2024-08-08 10:09:21'),
(111, 28, 1, '', 1500, 1500, 1, '2024-08-08 10:09:21'),
(112, 25, 1, '', 5000, 5000, 1, '2024-08-08 10:09:21'),
(113, 21, 2, 'pkt', 25000, 50000, 1, '2024-08-08 10:11:10'),
(114, 16, 1, 'pcs', 170000, 170000, 1, '2024-08-08 10:11:53'),
(115, 30, 2, '', 1500, 3000, 1, '2024-08-08 10:13:49'),
(116, 31, 7, '', 9000, 63000, 1, '2024-08-08 10:13:49'),
(118, 17, 1, '', 15000, 15000, 1, '2024-08-30 11:23:35'),
(120, 17, 1, 'pkt', 15000, 15000, 2, '2024-08-30 12:09:30'),
(121, 33, 250, 'pcs', 200000, 50000000, 1, '2024-09-06 15:43:14'),
(122, 5, 5, 'pcs', 18000, 90000, 1, '2024-09-06 15:43:47'),
(123, 19, 2, 'pcs', 6000, 12000, 1, '2024-09-06 15:43:47'),
(125, 33, 480, 'bte', 200000, 96000000, 1, '2024-09-07 13:14:14'),
(126, 33, 12, 'pkt', 200000, 2400000, 2, '2024-09-07 20:52:14');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_list`
--

CREATE TABLE `supplier_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `address` text NOT NULL,
  `cperson` text NOT NULL,
  `contact` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier_list`
--

INSERT INTO `supplier_list` (`id`, `name`, `address`, `cperson`, `contact`, `status`, `date_created`, `date_updated`) VALUES
(2, 'BIG INC ', 'REMERA', 'FESTUS', '07...', 1, '2024-08-08 08:18:27', '2024-08-30 11:42:58'),
(3, 'JESSY COMPANY', '', '', '', 1, '2024-08-08 08:18:34', '2024-08-08 08:59:48'),
(4, 'Constructor Edmo', '', '', '', 1, '2024-08-08 09:13:36', '2024-08-08 09:13:36'),
(5, 'MUPENZI TABLE', '', '', '', 1, '2024-08-08 09:14:40', '2024-08-08 09:14:40'),
(6, 'CANAL - BOX', '', '', '', 1, '2024-08-08 09:24:42', '2024-08-08 09:24:42'),
(7, 'IDUKA(EXTERNAL  SUPPLIERS)', '', '', '', 1, '2024-08-08 09:39:31', '2024-08-08 09:39:31'),
(8, 'GAEL BUSINESS', 'KK12', 'GAEL', '07...33', 1, '2024-08-30 11:44:08', '2024-09-06 16:01:18'),
(9, 'DALTON BUSINESS', 'KIMIRONKO', '0794377409', '0791411817', 1, '2024-09-09 10:54:56', '2024-09-09 10:54:56');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Switchiify platforms inc'),
(6, 'short_name', 'SWCFY-STOCK'),
(11, 'logo', 'uploads/logo-1725016396.png'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover-1721893524.png'),
(15, 'content', 'Array');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id` int(11) NOT NULL,
  `unit_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id`, `unit_name`) VALUES
(64, 'crt'),
(67, 'pkt'),
(68, 'pcs'),
(70, 'pqt'),
(71, 'sac'),
(72, 'kg'),
(75, 'dozen'),
(76, 'bte');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(10, 'LOGISTICS', NULL, 'OFFICER', 'logistic', '07811dc6c422334ce36a09ff5cd6fe71', 'uploads/avatar-10.png?v=1725016436', NULL, 1, '2021-11-03 14:21:28', '2024-08-30 12:13:56'),
(13, 'Assistant', NULL, 'Staff', 'assist', 'b74d6556a14dcb1e407d58bf60e09d48', NULL, NULL, 1, '2024-06-21 15:50:51', NULL),
(14, 'ERIC', NULL, 'ERIC', 'ERIC', '7625a0ed0baa098eb34096483898a4fe', 'uploads/avatar-14.png?v=1725015180', NULL, 2, '2024-08-30 11:53:00', '2024-09-07 22:07:12'),
(15, 'test', NULL, 'test', 'testing', '098f6bcd4621d373cade4e832627b4f6', NULL, NULL, 1, '2024-09-07 22:04:14', NULL),
(16, 'mugisha', NULL, 'dalton', 'dalton-250', '25d55ad283aa400af464c76d713c07ad', 'uploads/avatar-16.png?v=1725876370', NULL, 1, '2024-09-09 11:06:10', '2024-09-09 11:06:10');

-- --------------------------------------------------------

--
-- Table structure for table `user_meta`
--

CREATE TABLE `user_meta` (
  `user_id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allstudents`
--
ALTER TABLE `allstudents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `back_order_list`
--
ALTER TABLE `back_order_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `po_id` (`po_id`),
  ADD KEY `receiving_id` (`receiving_id`);

--
-- Indexes for table `bo_items`
--
ALTER TABLE `bo_items`
  ADD KEY `item_id` (`item_id`),
  ADD KEY `bo_id` (`bo_id`);

--
-- Indexes for table `cash`
--
ALTER TABLE `cash`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_list`
--
ALTER TABLE `item_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `po_items`
--
ALTER TABLE `po_items`
  ADD KEY `po_id` (`po_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `purchase_order_list`
--
ALTER TABLE `purchase_order_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `receiving_list`
--
ALTER TABLE `receiving_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `return_list`
--
ALTER TABLE `return_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `sales_list`
--
ALTER TABLE `sales_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_list`
--
ALTER TABLE `stock_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `supplier_list`
--
ALTER TABLE `supplier_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_meta`
--
ALTER TABLE `user_meta`
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allstudents`
--
ALTER TABLE `allstudents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `back_order_list`
--
ALTER TABLE `back_order_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cash`
--
ALTER TABLE `cash`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `item_list`
--
ALTER TABLE `item_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `purchase_order_list`
--
ALTER TABLE `purchase_order_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `receiving_list`
--
ALTER TABLE `receiving_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `return_list`
--
ALTER TABLE `return_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `sales_list`
--
ALTER TABLE `sales_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `stock_list`
--
ALTER TABLE `stock_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `supplier_list`
--
ALTER TABLE `supplier_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `back_order_list`
--
ALTER TABLE `back_order_list`
  ADD CONSTRAINT `back_order_list_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `back_order_list_ibfk_2` FOREIGN KEY (`po_id`) REFERENCES `purchase_order_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `back_order_list_ibfk_3` FOREIGN KEY (`receiving_id`) REFERENCES `receiving_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bo_items`
--
ALTER TABLE `bo_items`
  ADD CONSTRAINT `bo_items_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bo_items_ibfk_2` FOREIGN KEY (`bo_id`) REFERENCES `back_order_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `item_list`
--
ALTER TABLE `item_list`
  ADD CONSTRAINT `item_list_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `po_items`
--
ALTER TABLE `po_items`
  ADD CONSTRAINT `po_items_ibfk_1` FOREIGN KEY (`po_id`) REFERENCES `purchase_order_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `po_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `item_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_order_list`
--
ALTER TABLE `purchase_order_list`
  ADD CONSTRAINT `purchase_order_list_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `return_list`
--
ALTER TABLE `return_list`
  ADD CONSTRAINT `return_list_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_list`
--
ALTER TABLE `stock_list`
  ADD CONSTRAINT `stock_list_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item_list` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
