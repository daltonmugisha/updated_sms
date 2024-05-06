-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2024 at 01:13 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sms_db`
--

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
(1, 'MATERIELS NETTOYAGE', 'MATERIELS NETTOYAGE', '2024-01-04 21:11:26', '1'),
(2, 'MATERIELS SCOLAIRE + BUREAU', 'School materials', '2024-01-17 13:07:14', '1'),
(17, 'SPORTS', 'All items regarding to the sport', '2024-01-17 13:05:03', '1'),
(19, 'HEALTH', 'Saint Ignatius health materials', '2024-03-01 23:21:01', '1'),
(20, 'CHEMISTRY ', '', '2024-03-06 00:19:25', '1'),
(21, 'INK', '', '2024-03-15 22:12:19', '1'),
(22, 'UNIFORMS ', '', '2024-04-03 21:47:06', '1');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `url`, `start`, `end`) VALUES
(5, 'batizo', 'SDMLSD', 'SDSD', '2024-05-14', '2024-05-17'),
(6, 'HOW TO BE COOL OKAY', 'YES ', 'ONE', '2024-05-02', '2024-05-03'),
(8, 'tomorrow and other days i will try to be cool', 'yes we will try', 'okay', '2024-06-06', '2024-06-07');

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
(2, 'Math Teacher'),
(3, 'Kitchen');

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
(33, '10', 'You have made a purchase order', '2024-03-01 07:26:59'),
(34, '10', 'The school stock has received new items', '2024-03-01 07:27:07'),
(35, '10', 'You have added a new supplier', '2024-03-05 08:16:24'),
(36, '10', 'You have made a purchase order', '2024-03-05 08:23:43'),
(37, '10', 'The school stock has received new items', '2024-03-05 08:26:22'),
(38, '10', 'The new item has been sold. Nolonger in stock', '2024-03-05 08:31:51'),
(39, '10', 'You have added a new supplier', '2024-03-14 06:41:27'),
(40, '10', 'You have added a new supplier', '2024-03-14 06:51:49'),
(41, '10', 'You have made a purchase order', '2024-03-15 04:33:48'),
(42, '10', 'You have made a purchase order', '2024-03-15 04:54:01'),
(43, '10', 'You have made a purchase order', '2024-03-15 04:54:29'),
(44, '10', 'You have added a new supplier', '2024-03-15 06:44:28'),
(45, '10', 'You have made a purchase order', '2024-03-15 07:20:47'),
(46, '10', 'You have added a new supplier', '2024-04-03 06:45:35'),
(47, '10', 'You have added a new supplier', '2024-04-03 06:55:17'),
(48, '10', 'You have added a new supplier', '2024-04-03 07:04:02'),
(49, '10', 'You have added a new supplier', '2024-04-03 07:06:26'),
(50, '10', 'The school stock has received new items', '2024-04-03 07:56:59'),
(51, '10', 'You have made a purchase order', '2024-04-03 07:59:55'),
(52, '10', 'The school stock has received new items', '2024-04-03 08:00:43'),
(53, '10', 'The new item has been sold. Nolonger in stock', '2024-04-03 08:02:26'),
(54, '10', 'You have added a new supplier', '2024-05-04 06:51:33'),
(55, '10', 'You have made a purchase order', '2024-05-04 06:53:03'),
(56, '10', 'You have made a purchase order', '2024-05-04 06:53:05'),
(57, '10', 'You have made a purchase order', '2024-05-04 06:53:06'),
(58, '10', 'You have made a purchase order', '2024-05-04 07:26:53'),
(59, '10', 'The school stock has received new items', '2024-05-04 07:27:01'),
(60, '10', 'You have made a purchase order', '2024-05-04 07:28:41'),
(61, '10', 'The school stock has received new items', '2024-05-04 07:28:52'),
(62, '10', 'New items are returned back to the customer', '2024-05-07 00:37:20');

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
(16, 'Isukari ', '', 8, 90000, 1, '2024-01-04 14:26:54', '2024-03-15 06:31:32', 1),
(18, 'Isabune yo kumesa (GIFURA)', '', 8, 12000, 1, '2024-01-04 14:26:55', '2024-03-15 06:31:32', 1),
(19, 'Isabune yo gukaraba (Santé)', '', 1, 18500, 1, '2024-01-04 14:26:55', '2024-03-15 06:31:32', 1),
(20, 'Savon liquide ', '', 8, 15000, 1, '2024-01-04 14:26:55', '2024-03-15 06:31:32', 1),
(21, 'VIM VIM', '', 8, 20000, 1, '2024-01-04 14:26:55', '2024-03-15 06:31:32', 1),
(22, 'Shinex yo koza ibirahure ', '', 8, 11754, 1, '2024-01-04 14:26:55', '2024-03-15 06:31:32', 1),
(23, 'Ikiringiti cya rufuku ', '', 1, 6000, 1, '2024-01-04 14:26:55', '2024-03-15 06:31:32', 1),
(24, 'Poubelles ntoya ya plastique yo mu biro ', '', 1, 3000, 1, '2024-01-04 14:26:55', '2024-03-15 06:31:32', 1),
(25, 'Poubelle 20Litres  ipfundikirwa ya alminium ', '', 1, 63000, 1, '2024-01-04 14:26:55', '2024-03-15 06:31:32', 1),
(26, 'Ikiroso gifite umuhini n\'amenyo magufi   KIAKA  ', '', 1, 3000, 1, '2024-01-04 14:26:55', '2024-03-15 06:31:32', 1),
(27, 'Imyeyo KIAKA  ', '', 8, 3000, 1, '2024-01-04 14:26:55', '2024-03-15 06:31:32', 1),
(28, 'Ramassettes ', '', 8, 9000, 1, '2024-01-04 14:26:56', '2024-03-15 06:31:32', 1),
(29, 'Raclette KIAKA', '', 8, 3000, 1, '2024-01-04 14:26:56', '2024-03-15 06:31:32', 1),
(30, 'Uburoso bwo koza W.C biracaraho  ', '', 1, 2500, 1, '2024-01-04 14:26:56', '2024-03-15 06:31:32', 1),
(31, 'Papiers hygièniques (SUPA)', '', 1, 10500, 1, '2024-01-04 14:26:56', '2024-03-15 06:31:32', 1),
(32, 'Udusume turinganiye two guhanaguza ', '', 1, 3500, 1, '2024-01-04 14:26:56', '2024-03-15 06:31:32', 1),
(33, 'Pleidge ', '', 8, 6000, 1, '2024-01-04 14:26:56', '2024-03-15 06:31:32', 1),
(34, 'Ace toilet clean ', '', 8, 2000, 1, '2024-01-04 14:26:56', '2024-03-15 06:31:32', 1),
(35, 'Parfum pour les toilettes ', '', 8, 2500, 1, '2024-01-04 14:26:56', '2024-03-15 06:31:32', 1),
(36, 'Imbuma zo gushyira muri urinoir ', '', 1, 3000, 1, '2024-01-04 14:26:56', '2024-03-15 06:31:32', 1),
(37, 'COTEX (Allways or SUPA)', '', 1, 35000, 1, '2024-01-04 14:26:56', '2024-03-15 06:31:32', 1),
(38, 'Bottes SANDAK', '', 1, 9000, 1, '2024-01-04 14:26:56', '2024-03-15 06:31:32', 1),
(39, 'Eau minérale INYANGE (Carton de 24 bouteilles) ', '', 8, 4200, 1, '2024-01-04 14:26:56', '2024-03-15 06:31:32', 1),
(40, 'Serviettes (SUPA)', '', 1, 6000, 1, '2024-01-04 14:26:56', '2024-03-15 06:31:32', 1),
(41, 'Rwanda Tea ', '', 8, 2000, 1, '2024-01-04 14:26:56', '2024-03-15 06:31:32', 1),
(42, 'Tea bag ', '', 8, 2800, 1, '2024-01-04 14:26:57', '2024-03-15 06:31:32', 1),
(43, 'Ikawa \'\'Gorilla\'\'', '', 8, 9500, 1, '2024-01-04 14:26:57', '2024-03-15 06:31:32', 1),
(44, 'Ikibiriti ', '', 8, 3000, 1, '2024-01-04 14:26:57', '2024-03-15 06:31:32', 1),
(45, 'Lait en poudre (Star)', '', 1, 198000, 1, '2024-01-04 14:26:57', '2024-03-15 06:31:32', 1),
(46, 'Ingorofani (Chilington)', '', 1, 60000, 1, '2024-01-04 14:26:57', '2024-03-15 06:31:32', 1),
(47, 'Ipompo yo gutera umuti wica udukoko', '', 1, 35000, 1, '2024-01-04 14:26:57', '2024-03-15 06:31:32', 1),
(48, 'Umuti wica udukoko ', '', 1, 10000, 1, '2024-01-04 14:26:57', '2024-03-15 06:31:32', 1),
(50, 'Papiers duplicata (Marque REPORT)', '', 2, 27000, 1, '2024-01-17 07:03:49', '2024-01-17 07:03:49', 2),
(51, 'PVC pour faire les cartes d\'élèvrs EPSON', '', 2, 35000, 1, '2024-01-17 07:03:49', '2024-01-17 07:03:49', 2),
(52, 'Papier bristol ( Bleu) A4', '', 2, 5000, 1, '2024-01-17 07:03:49', '2024-01-17 07:03:49', 2),
(53, 'Encre à huile pour cachet automatique (Blue) ', '', 2, 4000, 1, '2024-01-17 07:03:49', '2024-01-17 07:03:49', 2),
(54, 'Encre à huile pour cachet automatique (Rouge) ', '', 2, 4000, 1, '2024-01-17 07:03:49', '2024-01-17 07:03:49', 2),
(55, 'Craie blanche (MUNGYO)', '', 10, 49000, 1, '2024-01-17 07:03:50', '2024-03-15 06:45:09', 2),
(56, 'Craie de couleur (MUNGYO)', '', 10, 53000, 1, '2024-01-17 07:03:50', '2024-03-15 06:45:46', 2),
(57, 'Cahiers de 200 pages ', '', 10, 68000, 1, '2024-01-17 07:03:50', '2024-03-15 06:46:36', 2),
(58, 'Cahiers de coupe de 96 pages ', '', 2, 65000, 1, '2024-01-17 07:03:50', '2024-01-17 07:03:50', 2),
(59, 'Enveloppes A4', '', 2, 4000, 1, '2024-01-17 07:03:50', '2024-01-17 07:03:50', 2),
(60, 'Petites enveloppes blanches ', '', 2, 1500, 1, '2024-01-17 07:03:50', '2024-01-17 07:03:50', 2),
(61, 'Post it ', '', 2, 4500, 1, '2024-01-17 07:03:50', '2024-01-17 07:03:50', 2),
(62, 'Encre correcteur (BLANCO)', '', 10, 1200, 1, '2024-01-17 07:03:50', '2024-03-15 06:47:41', 2),
(63, 'Agraffeuse PF (Dolphin)', '', 10, 4500, 1, '2024-01-17 07:03:50', '2024-03-15 06:48:54', 2),
(64, 'Isumaku zifata kuri white board ', '', 2, 4800, 1, '2024-01-17 07:03:50', '2024-01-17 07:03:50', 2),
(65, 'Perforateur ', '', 2, 5000, 1, '2024-01-17 07:03:50', '2024-01-17 07:03:50', 2),
(66, 'Bloc notes petit format', '', 2, 400, 1, '2024-01-17 07:03:50', '2024-01-17 07:03:50', 2),
(67, 'Permanent marker', '', 10, 2500, 1, '2024-01-17 07:03:50', '2024-03-15 06:52:01', 2),
(68, 'Marqueurs pour white board', '', 2, 1000, 1, '2024-01-17 07:03:50', '2024-01-17 07:03:50', 2),
(69, 'Souligneur ', '', 2, 2000, 1, '2024-01-17 07:03:50', '2024-01-17 07:03:50', 2),
(70, 'Bics bleus ', '', 10, 7400, 1, '2024-01-17 07:03:50', '2024-03-15 06:56:09', 2),
(71, 'Bics rouges ', '', 10, 7400, 1, '2024-01-17 07:03:50', '2024-03-15 06:56:32', 2),
(72, 'Farde à suspendre de 25pcès ', '', 2, 9500, 1, '2024-01-17 07:03:50', '2024-01-17 07:03:50', 2),
(73, 'Boîte d\'archive ', '', 2, 2500, 1, '2024-01-17 07:03:50', '2024-01-17 07:03:50', 2),
(74, 'Skotches durs (Pelicaline) pour la reliure des livres ', '', 2, 2000, 1, '2024-01-17 07:03:50', '2024-01-17 07:03:50', 2),
(75, 'Papiers chemises (50pcs rose + 50 pcs vert) ', '', 2, 9000, 1, '2024-01-17 07:03:50', '2024-01-17 07:03:50', 2),
(76, 'Ibifuniko  by\'amakayi ', '', 2, 400, 1, '2024-01-17 07:03:51', '2024-01-17 07:03:51', 2),
(77, 'Agenda moyenne (sans année) ', '', 2, 3500, 1, '2024-01-17 07:03:51', '2024-01-17 07:03:51', 2),
(78, 'Ciseaux de bureau ', '', 2, 1000, 1, '2024-01-17 07:03:51', '2024-01-17 07:03:51', 2),
(79, 'Colle Fantastic', '', 2, 12000, 1, '2024-01-17 07:03:51', '2024-01-17 07:03:51', 2),
(80, 'Colle UHU liquide ', '', 2, 9500, 1, '2024-01-17 07:03:51', '2024-01-17 07:03:51', 2),
(81, 'Paper collant PF', '', 10, 300, 1, '2024-01-17 07:03:51', '2024-03-15 07:00:17', 2),
(84, 'Jezz z abakinnyi bo mu kibuga hagati', '', 4, 289000, 1, '2024-01-17 07:10:34', '2024-01-17 07:10:34', 17),
(86, 'Copper II oxide ', '', 7, 21000, 1, '2024-03-05 08:21:31', '2024-03-05 08:21:31', 20),
(87, 'Essuit-tout', '', 8, 72000, 1, '2024-03-15 04:45:54', '2024-03-15 06:31:32', 1),
(88, 'Isabune yifu yo mudushashi	', '', 8, 7500, 1, '2024-03-15 04:53:14', '2024-03-15 06:31:32', 1),
(89, 'Papier duplicata (A ONE)', '', 10, 26900, 1, '2024-03-15 06:50:01', '2024-03-15 06:50:01', 2),
(90, 'Classeurs GF', '', 10, 1700, 1, '2024-03-15 06:51:01', '2024-03-15 06:51:01', 2),
(91, 'Frottoir pour white board', '', 10, 1000, 1, '2024-03-15 06:52:55', '2024-03-15 06:52:55', 1),
(92, 'Crayons Dolphin', '', 10, 1000, 1, '2024-03-15 06:55:43', '2024-03-15 06:55:43', 2),
(93, 'Bics noirs', '', 10, 7400, 1, '2024-03-15 06:57:23', '2024-03-15 06:57:23', 2),
(94, 'Skotches durs (Pelicaline) pour la reliure des livre', '', 10, 2300, 1, '2024-03-15 06:58:45', '2024-03-15 06:58:45', 2),
(95, 'Papier chemises (50pcs jaune + 50 vert)', '', 10, 8500, 1, '2024-03-15 07:01:20', '2024-03-15 07:01:20', 2),
(96, 'Porte Cle', '', 10, 5000, 1, '2024-03-15 07:02:13', '2024-03-15 07:02:13', 2),
(97, 'Cartouche 205A', '', 9, 30000, 1, '2024-03-15 07:13:52', '2024-03-15 07:13:52', 21),
(98, 'Cartouche cxv 33', '', 9, 22000, 1, '2024-03-15 07:15:00', '2024-03-15 07:15:00', 21),
(99, 'Cartouche 05A', '', 9, 23000, 1, '2024-03-15 07:15:46', '2024-03-15 07:15:46', 21),
(100, 'Cartouche 078A', '', 9, 15000, 1, '2024-03-15 07:16:31', '2024-03-15 07:16:31', 21),
(102, 'Chemises', '', 11, 6500, 1, '2024-04-03 06:46:57', '2024-04-03 06:50:14', 22),
(103, 'Pantalons', '', 11, 6500, 1, '2024-04-03 06:52:20', '2024-04-03 06:52:20', 22),
(104, 'Tricots', '', 12, 9500, 1, '2024-04-03 06:56:12', '2024-04-03 06:56:12', 22),
(105, 'Sport uniforn ', '', 13, 15500, 1, '2024-04-03 07:05:01', '2024-04-03 07:05:01', 22),
(106, 'Volleyball', '', 14, 65000, 1, '2024-04-03 07:07:30', '2024-04-03 07:07:30', 17),
(107, 'Basketball', '', 14, 65000, 1, '2024-04-03 07:51:55', '2024-04-03 07:51:55', 17),
(108, 'Football', '', 14, 65000, 1, '2024-04-03 07:52:36', '2024-04-03 07:52:36', 17),
(109, 'Handball', '', 14, 50000, 1, '2024-04-03 07:53:15', '2024-04-03 07:53:15', 17),
(110, 'Pump', '', 14, 15000, 1, '2024-04-03 07:53:38', '2024-04-03 07:53:38', 0);

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
(32, 97, 4, 30000, 'pcs', 120000),
(32, 98, 5, 22000, 'pcs', 110000),
(32, 99, 15, 23000, 'pcs', 345000),
(32, 100, 10, 15000, 'pcs', 150000),
(33, 106, 3, 65000, 'pcs', 195000),
(33, 110, 1, 15000, '', 15000),
(37, 86, 50, 21000, 'crt', 1050000),
(38, 21, 100, 20000, 'crt', 2000000),
(38, 16, 60, 90000, 'dzn', 5400000);

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
(32, 'PO-0001', 9, 725000, 0, 0, 0, 0, '', 2, '2024-03-15 07:20:47', '2024-04-03 07:56:59'),
(33, 'PO-0002', 14, 210000, 0, 0, 0, 0, '', 2, '2024-04-03 07:59:55', '2024-04-03 08:00:43'),
(37, 'PO-0003', 7, 1050000, 0, 0, 0, 0, '', 2, '2024-05-04 07:26:53', '2024-05-04 07:27:01'),
(38, 'PO-0004', 8, 7400000, 0, 0, 0, 0, '', 2, '2024-05-04 07:28:41', '2024-05-04 07:28:53');

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
(29, 32, 1, 725000, 0, 0, 0, 0, '69,70,71,72', '', '2024-04-03 07:56:59', '2024-04-03 07:56:59'),
(30, 33, 1, 210000, 0, 0, 0, 0, '76,77', '', '2024-04-03 08:00:43', '2024-05-04 07:26:26'),
(31, 37, 1, 1050000, 0, 0, 0, 0, '78', '', '2024-05-04 07:27:01', '2024-05-04 07:27:01'),
(32, 38, 1, 7400000, 0, 0, 0, 0, '79,80', '', '2024-05-04 07:28:52', '2024-05-04 07:28:53');

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
(16, 'R-0001', 8, 1980000, '', '81', '2024-05-07 00:37:20', '2024-05-07 00:37:21');

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
(13, 'SALE-0001', 'Guest', 65000, '', '75', '2024-04-03 08:02:26', '2024-04-03 08:02:26');

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
(69, 97, 4, 'pcs', 30000, 120000, 1, '2024-04-03 07:56:59'),
(70, 98, 5, 'pcs', 22000, 110000, 1, '2024-04-03 07:56:59'),
(71, 99, 15, 'pcs', 23000, 345000, 1, '2024-04-03 07:56:59'),
(72, 100, 10, 'pcs', 15000, 150000, 1, '2024-04-03 07:56:59'),
(75, 106, 1, 'pcs', 65000, 65000, 2, '2024-04-03 08:02:26'),
(76, 106, 3, 'pcs', 65000, 195000, 1, '2024-05-04 07:26:25'),
(77, 110, 1, '', 15000, 15000, 1, '2024-05-04 07:26:25'),
(78, 86, 50, 'crt', 21000, 1050000, 1, '2024-05-04 07:27:01'),
(79, 21, 100, 'crt', 20000, 2000000, 1, '2024-05-04 07:28:53'),
(80, 16, 60, 'dzn', 90000, 5400000, 1, '2024-05-04 07:28:53'),
(81, 16, 22, 'dzn', 90000, 1980000, 2, '2024-05-07 00:37:20');

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
(1, 'KIMIRONKO MARKET SUPPLIAR', 'Sample Supplier Address 101', 'Supplier Staff 101', '09123456789', 1, '2021-11-02 09:36:19', '2024-01-22 22:21:48'),
(2, 'AUBENE PHARMACY ', 'B.P 263-KIGALI /KACYIRU ', 'MUNEZA ADELINE ', '0788496547', 1, '2021-11-02 09:36:54', '2024-03-15 08:12:13'),
(4, 'KIMIRONKO CLOTH LDT', 'KK 56', '0791746049', 'mubaptiste@gmail.com', 1, '2023-12-13 07:11:31', '2023-12-13 07:11:31'),
(7, 'MASTEP GENERAL SUPPLY', 'www.mastepsupply.com, mastepsupply@gmail.com', 'Kaggwa Godefrey ', '+250 783939899', 1, '2024-03-05 08:16:24', '2024-03-05 08:18:33'),
(8, 'ARC SHOP Ltd', 'KIMIRONKO SECTOR ', 'Jeanne ', '0788502736 /0788352650', 1, '2024-03-14 06:41:27', '2024-03-14 06:41:27'),
(9, 'MERINO COMPANY Ltd', 'NYARUGENGE ', 'Josée  ', '0783362101', 1, '2024-03-14 06:51:49', '2024-03-14 06:51:49'),
(10, 'GOOD NEWS ENTERPRISES Ltd', 'PO BOX: 3073 Kigali', '', '0788541774', 1, '2024-03-15 06:44:28', '2024-03-15 06:44:28'),
(11, 'CENTRE MIZERO ', 'KAMEMBE', 'Bibiane ', '0783139928', 1, '2024-04-03 06:45:35', '2024-04-03 06:45:35'),
(12, 'ATELIER DE COUTURE MULTICULTURE', 'KIGALI-NYARUGENGE', 'Innocent ', '0788540445', 1, '2024-04-03 06:55:17', '2024-04-03 06:55:17'),
(13, 'VARNA LTD ', 'KIGALI - RWANDA', 'Vaishali', '07881691/078178325', 1, '2024-04-03 07:04:02', '2024-04-03 07:04:02'),
(14, 'SANGWA SPORT', 'KIGALI - NYARUGENGE', 'Sangwa', '0788.......', 1, '2024-04-03 07:06:26', '2024-04-03 07:06:26'),
(15, '', '', '', '', 1, '2024-05-04 06:51:33', '2024-05-04 06:51:33');

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
(1, 'name', 'SIHS STOCK MANAGEMENT'),
(6, 'short_name', 'SIHS STOCK '),
(11, 'logo', 'uploads/logo-1709304554.png'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover-1715035397.png'),
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
(66, 'dzn'),
(70, 'pqt'),
(71, 'sac'),
(72, 'kg');

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
(10, 'LOGISTICS', NULL, 'OFFICER', 'logistic', '07811dc6c422334ce36a09ff5cd6fe71', 'uploads/avatar-10.png?v=1709304835', NULL, 1, '2021-11-03 14:21:28', '2024-03-01 06:57:20'),
(13, 'ERIC', NULL, 'SENTORE', 'FHT', '0e7504b5c86b21ae5074560d9cf1c46e', 'uploads/avatar-13.png?v=1715034855', NULL, 2, '2024-05-07 00:34:14', '2024-05-07 00:34:27');

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
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `item_list`
--
ALTER TABLE `item_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `purchase_order_list`
--
ALTER TABLE `purchase_order_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `receiving_list`
--
ALTER TABLE `receiving_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `return_list`
--
ALTER TABLE `return_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sales_list`
--
ALTER TABLE `sales_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `stock_list`
--
ALTER TABLE `stock_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `supplier_list`
--
ALTER TABLE `supplier_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
