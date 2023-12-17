-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2023 at 08:59 AM
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
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_list`
--

INSERT INTO `item_list` (`id`, `name`, `description`, `supplier_id`, `cost`, `status`, `date_created`, `date_updated`) VALUES
(1, 'Item 101', 'Sample Only', 1, 150, 1, '2021-11-02 10:01:55', '2021-11-02 10:01:55'),
(2, 'Item 102', 'Sample only', 2, 200, 1, '2021-11-02 10:02:12', '2021-11-02 10:02:12'),
(3, 'Item 103', 'Sample', 1, 185, 1, '2021-11-02 10:02:27', '2021-11-02 10:02:27'),
(4, 'Item 104', 'Sample only', 2, 205, 1, '2021-11-02 10:02:47', '2021-11-02 10:02:47'),
(7, 'UNIFORM', 'UNIFORM FOR THE UNIFORM', 4, 100, 1, '2023-12-13 07:10:07', '2023-12-13 07:27:19');

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
(12, 3, 232, 185, '21', 42920),
(12, 1, 23, 150, '76', 3450),
(13, 1, 12, 150, '218', 1800);

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
(8, 'PO-0006', 1, 0, 2, 0, 18, 0, 'TEST', 2, '2023-12-12 22:05:37', '2023-12-13 13:04:23'),
(12, 'PO-0001', 1, 46370, 0, 0, 0, 0, 'I WANT THEM BEFORE THIS ....', 2, '2023-12-13 10:53:57', '2023-12-13 11:05:53'),
(13, 'PO-0002', 1, 1800, 0, 0, 0, 0, '', 0, '2023-12-13 15:17:53', '2023-12-13 15:17:53');

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
(7, 12, 1, 46370, 0, 0, 0, 0, '34,35', 'I WANT THEM BEFORE THIS ....', '2023-12-13 11:05:53', '2023-12-13 11:05:53'),
(8, 8, 1, 0, 2, 0, 18, 0, NULL, 'TEST', '2023-12-13 13:04:22', '2023-12-13 13:04:22'),
(9, 8, 1, 0, 2, 0, 18, 0, NULL, 'TEST', '2023-12-13 13:04:26', '2023-12-13 13:04:26'),
(10, 8, 1, 0, 2, 0, 18, 0, NULL, 'TEST', '2023-12-13 13:04:27', '2023-12-13 13:04:27'),
(11, 8, 1, 0, 2, 0, 18, 0, NULL, 'TEST', '2023-12-13 13:04:28', '2023-12-13 13:04:28'),
(12, 8, 1, 0, 2, 0, 18, 0, NULL, 'TEST', '2023-12-13 13:04:28', '2023-12-13 13:04:28');

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
(7, 'R-0002', 4, 0, 'SENIOR ONE', '', '2023-12-13 07:28:19', '2023-12-13 07:28:19'),
(9, 'R-0001', 1, 0, '', '', '2023-12-13 13:05:43', '2023-12-13 13:05:43'),
(10, 'R-0003', 1, 0, '', '', '2023-12-13 13:05:45', '2023-12-13 13:05:45'),
(11, 'R-0004', 1, 0, '', '', '2023-12-13 13:05:45', '2023-12-13 13:05:45'),
(12, 'R-0005', 1, 0, '', '', '2023-12-13 13:05:46', '2023-12-13 13:05:46'),
(13, 'R-0006', 1, 8400, '76', '37', '2023-12-13 13:05:51', '2023-12-13 13:05:52'),
(14, 'R-0007', 4, 7700, '', '38', '2023-12-13 15:24:43', '2023-12-13 15:24:43');

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
(6, 'SALE-0001', 'Baptiste', 1000, '', '33', '2023-12-13 07:15:25', '2023-12-13 07:15:49'),
(7, 'SALE-0002', 'Guest', 21600, '', '36', '2023-12-13 11:51:14', '2023-12-13 11:51:15');

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
(33, 7, 10, '21', 100, 1000, 2, '2023-12-13 07:15:49'),
(34, 3, 232, '21', 185, 42920, 1, '2023-12-13 11:05:53'),
(35, 1, 23, '76', 150, 3450, 1, '2023-12-13 11:05:53'),
(36, 7, 216, '34', 100, 21600, 2, '2023-12-13 11:51:15'),
(37, 1, 56, '78', 150, 8400, 2, '2023-12-13 13:05:51'),
(38, 7, 77, '21', 100, 7700, 2, '2023-12-13 15:24:43');

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
(1, 'Supplier 101', 'Sample Supplier Address 101', 'Supplier Staff 101', '09123456789', 1, '2021-11-02 09:36:19', '2021-11-02 09:36:19'),
(2, 'Supplier 102', 'Sample Address 102', 'Supplier Staff 102', '0987654332', 1, '2021-11-02 09:36:54', '2021-11-02 09:36:54'),
(4, 'KIMIRONKO CLOTH LDT', 'KK 56', '0791746049', 'mubaptiste@gmail.com', 1, '2023-12-13 07:11:31', '2023-12-13 07:11:31');

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
(1, 'name', 'SIHS-STOCK MANAGER'),
(6, 'short_name', 'SIHS STOCK'),
(11, 'logo', 'uploads/logo-1702443984.png'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover-1702443275.png'),
(15, 'content', 'Array');

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
(1, 'Father ', NULL, 'Emmy', 'Baptiste', '0192023a7bbd73250516f069df18b500', 'uploads/avatar-1.png?v=1635556826', NULL, 2, '2021-01-20 14:02:37', '2023-11-29 09:16:11'),
(10, 'Emile', NULL, 'Emmy', 'emile', '3c536bdc7d1ba54a93a3d8ea42f667ae', 'uploads/avatar-10.png?v=1702409003', NULL, 1, '2021-11-03 14:21:28', '2023-12-13 06:42:26'),
(11, 'Claire', NULL, 'Blake', 'BATIZO', '756161fee0b9c65aa3e936e91a1d08fc', 'uploads/avatar-11.png?v=1702439678', NULL, 2, '2021-11-03 14:22:46', '2023-12-13 05:58:14'),
(12, 'KALEB', NULL, 'RAOUL', 'kaleb', 'c4daef4e2549e5c9e64edd3db14665b8', 'uploads/avatar-12.png?v=1702444149', NULL, 2, '2023-12-13 07:09:09', '2023-12-13 07:09:09');

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
-- AUTO_INCREMENT for table `back_order_list`
--
ALTER TABLE `back_order_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `item_list`
--
ALTER TABLE `item_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `purchase_order_list`
--
ALTER TABLE `purchase_order_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `receiving_list`
--
ALTER TABLE `receiving_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `return_list`
--
ALTER TABLE `return_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sales_list`
--
ALTER TABLE `sales_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stock_list`
--
ALTER TABLE `stock_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `supplier_list`
--
ALTER TABLE `supplier_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
