-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2024 at 03:31 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(10, 'น็อตสลักและแป้นเกลียว');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `details` text DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `tax_id` varchar(20) DEFAULT NULL,
  `branch_no` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `details`, `postal_code`, `tax_id`, `branch_no`, `created_at`) VALUES
(201, 'ทวีทรัพย์ เมฆเกลื่อน', '71/1', '11140', '11111', 'ประเทศไทย', '2024-09-30 05:08:14'),
(202, 'ทวีทรัพย์ เมฆเกลื่อน', '', '11140', '12345', 'ประเทศไทย', '2024-09-30 06:22:49'),
(203, 'ทวีทรัพย์ เมฆเกลื่อน', '', '', '', '', '2024-09-30 06:29:33'),
(204, 'AA', '', '', '', '', '2024-10-08 16:14:29'),
(205, 'ทวีทรัพย์ เมฆเกลื่อน', '71/1', '11140', '12345', 'ประเทศไทย', '2024-10-09 11:07:36'),
(206, 'AAA', '71/1', '11140', '11111111111111', 'ประเทศไทย', '2024-10-09 12:54:04'),
(207, 'ทวีทรัพย์ เมฆเกลื่อน', '71/1', '11140', '12345', 'ประเทศไทย', '2024-10-09 13:00:55'),
(208, 'A', '', '11140', '12345', 'ประเทศไทย', '2024-10-09 13:01:47'),
(209, 'ทวีทรัพย์ เมฆเกลื่อน', '', '', '', '', '2024-10-12 15:46:45'),
(210, 'A', '71/1', '11140', '12345', 'ประเทศไทย', '2024-10-12 15:54:01'),
(211, 'ทวีทรัพย์ เมฆเกลื่อน', '71/1', '11140', '12345', 'ประเทศไทย', '2024-10-12 16:31:00'),
(212, 'ทวีทรัพย์ เมฆเกลื่อน', '1111', '11140', '12345', 'ประเทศไทย', '2024-10-14 16:06:40'),
(213, 'A', '111', '11140', '12345', 'ประเทศไทย', '2024-10-14 16:10:30'),
(214, 'ทวีทรัพย์ เมฆเกลื่อน', '71/1', '11140', '12345', 'ประเทศไทย', '2024-10-16 05:13:58'),
(215, 'ทวีทรัพย์ เมฆเกลื่อน', '1/1', '11140', '12345', 'ประเทศไทย', '2024-10-16 16:05:19'),
(216, 'ทวีทรัพย์ เมฆเกลื่อน', '', '11140', '12345', 'ประเทศไทย', '2024-10-17 09:48:35'),
(217, 'dqwdqw', 'dqwdqw', 'dqwdqwd', 'qwdqwd', 'qwdwqdwqd', '2024-10-17 12:55:58');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_company`
--

CREATE TABLE `delivery_company` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `contact_number` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery_company`
--

INSERT INTO `delivery_company` (`id`, `name`, `address`, `contact_number`, `created_at`) VALUES
(2, 'บริษัท B', '71/1', '096xxxxxxx', '2024-08-11 10:53:05'),
(3, 'บริษัท C', '71/1', '097xxxxxxx', '2024-08-11 12:10:00'),
(4, 'บริษัท D', '71/1', '098xxxxxxx', '2024-08-11 12:48:05'),
(5, 'บริษัท E', '71/1', '096777777', '2024-08-14 15:24:13'),
(8, 'บริษัท A', '71/1', '0958833255', '2024-10-07 13:57:28');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `file_name`, `file_type`) VALUES
(9, 'Product_46071_289073603_fullsize.jpg', 'image/jpeg'),
(16, 'สกูรเหลียมมิลดำ.jpg', 'image/jpeg'),
(17, 'สกรูเกลียวปล่อยชุบหัวหกเหลี่ยม.jpg', 'image/jpeg'),
(18, 'สกรูคอเหลี่ยมหัวกลม.jpg', 'image/jpeg'),
(19, 'สกรูเกลียวครึ่งตัว.jpg', 'image/jpeg'),
(20, 'สกรูหัวเหลี่ยมชุบ.jpg', 'image/jpeg'),
(21, 'สกรูหัวเตเปอร์ผ่าสแตนเลส.jpg', 'image/jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `production_orders`
--

CREATE TABLE `production_orders` (
  `id` int(11) NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `quote_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `production_orders`
--

INSERT INTO `production_orders` (`id`, `product_id`, `quantity`, `status`, `created_at`, `updated_at`, `quote_id`) VALUES
(13, 1, 50, 'Pending', '2024-10-09 13:01:03', '2024-10-10 10:14:44', 226),
(14, 2, 50, 'Pending', '2024-10-09 13:01:03', '2024-10-10 10:14:47', 226),
(15, 3, 50, 'Pending', '2024-10-09 13:01:03', '2024-10-10 10:14:50', 226),
(16, 4, 50, 'Pending', '2024-10-09 13:01:04', '2024-10-10 10:14:53', 226),
(17, 1, 500, 'Completed', '2024-10-09 13:02:20', '2024-10-10 10:09:13', 227),
(18, 2, 500, 'Completed', '2024-10-09 13:02:20', '2024-10-10 10:09:16', 227),
(19, 1, 500, 'Completed', '2024-10-09 13:05:07', '2024-10-10 10:09:23', 227),
(20, 2, 500, 'Completed', '2024-10-09 13:05:07', '2024-10-10 10:09:19', 227),
(21, 1, 500, 'Pending', '2024-10-12 15:45:57', '2024-10-12 15:45:57', 227),
(22, 2, 500, 'Pending', '2024-10-12 15:45:57', '2024-10-12 15:45:57', 227),
(23, 1, 500, 'Completed', '2024-10-12 16:31:32', '2024-10-12 16:32:00', 230),
(24, 1, 500, 'Completed', '2024-10-12 16:31:32', '2024-10-12 16:32:02', 230),
(25, 1, 500, 'Completed', '2024-10-12 16:31:32', '2024-10-12 16:32:05', 230),
(26, 1, 500, 'Completed', '2024-10-12 16:31:32', '2024-10-12 16:32:08', 230),
(27, 1, 500, 'Pending', '2024-10-14 12:04:21', '2024-10-14 12:04:21', 230),
(28, 1, 500, 'Pending', '2024-10-14 12:04:21', '2024-10-14 12:04:21', 230),
(29, 1, 500, 'Pending', '2024-10-14 12:04:21', '2024-10-14 12:04:21', 230),
(30, 1, 500, 'Pending', '2024-10-14 12:04:21', '2024-10-14 12:04:21', 230),
(31, 1, 1, 'Completed', '2024-10-16 05:14:52', '2024-10-16 05:15:04', 232),
(32, 2, 1, 'Completed', '2024-10-16 05:14:52', '2024-10-16 05:15:07', 232),
(33, 2, 1, 'Completed', '2024-10-16 05:14:52', '2024-10-16 05:15:11', 232),
(34, 1, 1, 'Completed', '2024-10-16 05:14:52', '2024-10-16 05:15:14', 232),
(35, 1, 1, 'Completed', '2024-10-16 05:14:55', '2024-10-16 05:15:49', 233),
(36, 2, 1, 'Completed', '2024-10-16 05:14:55', '2024-10-16 05:15:51', 233),
(37, 3, 1, 'Completed', '2024-10-16 05:14:55', '2024-10-16 05:15:54', 233),
(38, 5, 1, 'Completed', '2024-10-16 05:14:56', '2024-10-16 05:15:57', 233);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` varchar(50) DEFAULT NULL,
  `buy_price` decimal(25,2) DEFAULT NULL,
  `sale_price` decimal(25,2) NOT NULL,
  `categorie_id` int(11) UNSIGNED NOT NULL,
  `media_id` int(11) DEFAULT 0,
  `date` datetime NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `quantity`, `buy_price`, `sale_price`, `categorie_id`, `media_id`, `date`, `description`) VALUES
(1, 'สกรูหัวเหลี่ยมมิลดำ', '4999795', 10.00, 50.00, 10, 16, '2024-08-22 14:16:31', NULL),
(2, 'สกรูเกลียวปล่อยชุบหัวหกเหลี่ยม', '49949', 5.00, 20.00, 10, 17, '2024-08-26 12:08:10', NULL),
(3, 'สกรูหัวเหลี่ยมชุบ', '499947', 5.00, 10.00, 10, 20, '2024-08-30 11:36:30', NULL),
(4, 'สกรูหัวกลมคอเหลี่ยม', '499946', 1.00, 5.00, 10, 18, '2024-09-15 15:42:30', NULL),
(5, 'สกรูหัวเตเปอร์ผ่าสแตนเลส', '111111', 1.00, 2.00, 10, 21, '2024-10-08 18:23:35', NULL),
(6, 'FFFFF', '', 5.00, 20.00, 10, 0, '2024-10-17 11:56:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `sale_date` date NOT NULL,
  `salesperson` varchar(255) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `discount` decimal(5,2) DEFAULT NULL,
  `tax` decimal(5,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `internal_notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`id`, `customer_id`, `sale_date`, `salesperson`, `subtotal`, `discount`, `tax`, `total`, `notes`, `internal_notes`, `created_at`) VALUES
(232, 213, '2024-10-14', 'ทวีทรัพย์ เมฆเกลื่อน', 140.00, 0.00, 0.00, 149.80, '', '', '2024-10-14 16:10:30'),
(233, 214, '2024-10-16', 'ทวีทรัพย์ เมฆเกลื่อน', 82.00, 0.00, 0.00, 87.74, '', '', '2024-10-16 05:13:58'),
(234, 215, '2024-10-16', 'ทวีทรัพย์ เมฆเกลื่อน', 1640.00, 10.00, 0.00, 1579.32, '', '', '2024-10-16 16:05:19'),
(235, 216, '2024-10-17', 'ทวีทรัพย์ เมฆเกลื่อน', 40.00, 0.00, 0.00, 42.80, '', '', '2024-10-17 09:48:35'),
(236, 217, '2024-10-17', 'qdwqwdqwd', 3499918.00, 50.00, 0.00, 1872456.13, '', '', '2024-10-17 12:55:58');

-- --------------------------------------------------------

--
-- Table structure for table `quote_items`
--

CREATE TABLE `quote_items` (
  `id` int(11) UNSIGNED NOT NULL,
  `quote_id` int(11) NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quote_items`
--

INSERT INTO `quote_items` (`id`, `quote_id`, `product_id`, `quantity`, `price`, `total`, `created_at`) VALUES
(229, 232, 1, 1.00, 50.00, 50.00, '2024-10-14 16:10:30'),
(230, 232, 2, 1.00, 20.00, 20.00, '2024-10-14 16:10:30'),
(231, 232, 2, 1.00, 20.00, 20.00, '2024-10-14 16:10:31'),
(232, 232, 1, 1.00, 50.00, 50.00, '2024-10-14 16:10:31'),
(233, 233, 1, 1.00, 50.00, 50.00, '2024-10-16 05:13:58'),
(234, 233, 2, 1.00, 20.00, 20.00, '2024-10-16 05:13:58'),
(235, 233, 3, 1.00, 10.00, 10.00, '2024-10-16 05:13:58'),
(236, 233, 5, 1.00, 2.00, 2.00, '2024-10-16 05:13:58'),
(237, 234, 1, 20.00, 50.00, 1000.00, '2024-10-16 16:05:19'),
(238, 234, 3, 20.00, 10.00, 200.00, '2024-10-16 16:05:19'),
(239, 234, 2, 20.00, 20.00, 400.00, '2024-10-16 16:05:19'),
(240, 234, 5, 20.00, 2.00, 40.00, '2024-10-16 16:05:20'),
(241, 235, 5, 5.00, 2.00, 10.00, '2024-10-17 09:48:35'),
(242, 235, 5, 5.00, 2.00, 10.00, '2024-10-17 09:48:35'),
(243, 235, 5, 5.00, 2.00, 10.00, '2024-10-17 09:48:35'),
(244, 235, 5, 5.00, 2.00, 10.00, '2024-10-17 09:48:35'),
(245, 236, 1, 59999.00, 50.00, 2999950.00, '2024-10-17 12:55:58'),
(246, 236, 2, 9999.00, 20.00, 199980.00, '2024-10-17 12:55:58'),
(247, 236, 3, 9999.00, 10.00, 99990.00, '2024-10-17 12:55:58'),
(248, 236, 5, 99999.00, 2.00, 199998.00, '2024-10-17 12:55:59');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `delivery_company_id` int(11) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(25,2) NOT NULL,
  `date` date NOT NULL,
  `customer_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `product_id`, `delivery_company_id`, `qty`, `price`, `date`, `customer_id`) VALUES
(120, 1, 1, 50, 50.00, '2024-09-30', 201),
(121, 2, 1, 50, 20.00, '2024-09-30', 201),
(122, 3, 1, 50, 10.00, '2024-09-30', 201),
(123, 4, 1, 50, 5.00, '2024-09-30', 201),
(124, 1, 2, 1, 50.00, '2024-10-06', 201),
(125, 2, 3, 1, 20.00, '2024-10-06', 201),
(126, 3, 2, 1, 10.00, '2024-10-06', 201),
(127, 4, 3, 1, 5.00, '2024-10-06', 201),
(128, 1, 8, 50, 50.00, '2024-10-08', 201);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_level` int(11) NOT NULL,
  `image` varchar(255) DEFAULT 'no_image.jpg',
  `status` int(1) NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `user_level`, `image`, `status`, `last_login`) VALUES
(1, 'ADMIN', 'Admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 'x2g784x1.png', 1, '2024-10-17 14:53:50'),
(10, 'Fluke', 'Fookry', '356a192b7913b04c54574d18c28d46e6395428ab', 2, 'no_image.jpg', 1, '2024-10-17 14:52:59');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(150) NOT NULL,
  `group_level` int(11) NOT NULL,
  `group_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `group_name`, `group_level`, `group_status`) VALUES
(1, 'Admin', 1, 1),
(8, 'User', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_company`
--
ALTER TABLE `delivery_company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `production_orders`
--
ALTER TABLE `production_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `quote_items`
--
ALTER TABLE `quote_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quote_id` (`quote_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_level` (`user_level`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_level` (`group_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;

--
-- AUTO_INCREMENT for table `delivery_company`
--
ALTER TABLE `delivery_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `production_orders`
--
ALTER TABLE `production_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=237;

--
-- AUTO_INCREMENT for table `quote_items`
--
ALTER TABLE `quote_items`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=249;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `production_orders`
--
ALTER TABLE `production_orders`
  ADD CONSTRAINT `production_orders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quotes`
--
ALTER TABLE `quotes`
  ADD CONSTRAINT `quotes_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `SK` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
