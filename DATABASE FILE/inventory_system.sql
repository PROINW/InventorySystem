-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2024 at 08:10 PM
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
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `tax_id` varchar(20) DEFAULT NULL,
  `branch_no` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `address`, `postal_code`, `tax_id`, `branch_no`, `created_at`) VALUES
(1, 'A', '71/1', '11140', '12345', 'ประเทศไทย', '2024-08-21 10:57:57'),
(2, '', '', '', '', '', '2024-08-21 11:00:49'),
(3, '', '', '', '', '', '2024-08-21 11:05:59'),
(4, 'A', '', '', '', '', '2024-08-21 11:24:31'),
(5, '', '', '', '', '', '2024-08-21 11:24:38'),
(6, '', '', '', '', '', '2024-08-21 11:26:01'),
(7, '', '', '', '', '', '2024-08-21 11:30:52'),
(8, 'กฟหกหฟกหฟก', 'หฟกหฟกหฟ', 'ฟหกหฟกหฟก', 'ฟหกหฟกห', 'ฟกหฟกฟก', '2024-08-21 11:31:13'),
(9, 'หกหดก', 'หกดกหด', 'หกดกหด', 'หกหกดกหด', 'หกกหกหด', '2024-08-22 11:22:20'),
(10, 'A', '71/1', '11140', '112233', 'ประเทศไทย', '2024-08-22 11:42:16'),
(11, 'A', '71/1', '11140', '112233', 'ประเทศไทย', '2024-08-22 11:42:55'),
(12, 'A', '71/1', '11140', '112233', 'ประเทศไทย', '2024-08-22 11:44:45'),
(13, 'A', '71/1', '11140', '112233', 'ประเทศไทย', '2024-08-22 11:46:38');

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
(204, 'AA', '', '', '', '', '2024-10-08 16:14:29');

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
(5, 'สกรูหัวเตเปอร์ผ่าสแตนเลส', '111111', 1.00, 2.00, 10, 21, '2024-10-08 18:23:35', NULL);

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
(220, 201, '2024-09-30', 'ทวีทรัพย์ เมฆเกลื่อน', 80.00, 0.00, 0.00, 85.60, '', '', '2024-09-30 05:08:14'),
(221, 202, '2024-09-30', 'ทวีทรัพย์ เมฆเกลื่อน', 85.00, 0.00, 0.00, 90.95, '', '', '2024-09-30 06:22:49'),
(223, 204, '2024-10-08', 'ทวีทรัพย์ เมฆเกลื่อน', 50.00, 1.00, 0.00, 52.97, 'AAA', 'ZZZ', '2024-10-08 16:14:29');

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
(154, 196, 1, 1.00, 50.00, 50.00, '2024-09-02 14:04:43'),
(155, 197, 1, 1.00, 50.00, 50.00, '2024-09-02 14:05:13'),
(156, 198, 1, 1.00, 50.00, 50.00, '2024-09-02 14:10:17'),
(157, 199, 1, 1.00, 50.00, 50.00, '2024-09-02 14:14:50'),
(158, 200, 1, 1.00, 50.00, 50.00, '2024-09-02 14:15:46'),
(159, 201, 1, 1.00, 0.00, 0.00, '2024-09-02 14:22:06'),
(160, 202, 1, 1.00, 0.00, 0.00, '2024-09-02 14:25:21'),
(161, 203, 1, 1.00, 0.00, 0.00, '2024-09-02 14:25:34'),
(162, 204, 1, 1.00, 50.00, 50.00, '2024-09-03 03:03:58'),
(163, 204, 2, 1.00, 20.00, 20.00, '2024-09-03 03:03:58'),
(164, 205, 1, 1.00, 50.00, 50.00, '2024-09-03 03:06:05'),
(165, 206, 1, 1.00, 50.00, 6.00, '2024-09-03 03:21:37'),
(166, 207, 1, 1.00, 50.00, 7.00, '2024-09-03 03:22:49'),
(167, 208, 1, 1.00, 50.00, 50.00, '2024-09-03 03:31:50'),
(168, 208, 3, 1.00, 10.00, 10.00, '2024-09-03 03:31:50'),
(169, 209, 1, 50.00, 50.00, 2500.00, '2024-09-04 11:26:07'),
(170, 209, 2, 50.00, 20.00, 1000.00, '2024-09-04 11:26:07'),
(171, 210, 1, 1.00, 50.00, 50.00, '2024-09-04 12:03:16'),
(172, 210, 2, 1.00, 20.00, 20.00, '2024-09-04 12:03:16'),
(173, 210, 3, 1.00, 10.00, 10.00, '2024-09-04 12:03:16'),
(174, 211, 1, 1.00, 50.00, 50.00, '2024-09-04 12:07:05'),
(175, 211, 2, 1.00, 20.00, 20.00, '2024-09-04 12:07:05'),
(176, 211, 3, 1.00, 10.00, 10.00, '2024-09-04 12:07:05'),
(177, 212, 1, 50.00, 50.00, 2500.00, '2024-09-04 12:15:11'),
(178, 212, 2, 50.00, 20.00, 1000.00, '2024-09-04 12:15:11'),
(179, 212, 3, 50.00, 10.00, 500.00, '2024-09-04 12:15:11'),
(180, 213, 1, 1.00, 50.00, 50.00, '2024-09-04 12:19:46'),
(181, 213, 2, 1.00, 20.00, 20.00, '2024-09-04 12:19:46'),
(182, 213, 3, 1.00, 10.00, 10.00, '2024-09-04 12:19:46'),
(183, 214, 1, 1.00, 50.00, 50.00, '2024-09-09 02:17:44'),
(184, 214, 2, 1.00, 20.00, 20.00, '2024-09-09 02:17:44'),
(185, 214, 3, 1.00, 10.00, 10.00, '2024-09-09 02:17:44'),
(186, 216, 3, 1.00, 10.00, 10.00, '2024-09-09 02:28:24'),
(187, 217, 1, 1.00, 50.00, 50.00, '2024-09-09 02:30:37'),
(188, 217, 2, 1.00, 20.00, 20.00, '2024-09-09 02:30:37'),
(189, 217, 3, 1.00, 10.00, 10.00, '2024-09-09 02:30:37'),
(190, 218, 1, 50.00, 50.00, 2500.00, '2024-09-09 07:11:55'),
(191, 218, 3, 1.00, 10.00, 10.00, '2024-09-09 07:11:55'),
(192, 218, 1, 1.00, 50.00, 50.00, '2024-09-09 07:11:55'),
(193, 219, 1, 1.00, 50.00, 50.00, '2024-09-30 04:04:21'),
(194, 219, 2, 1.00, 20.00, 20.00, '2024-09-30 04:04:21'),
(195, 219, 3, 1.00, 10.00, 10.00, '2024-09-30 04:04:21'),
(196, 220, 1, 1.00, 50.00, 50.00, '2024-09-30 05:08:14'),
(197, 220, 3, 1.00, 10.00, 10.00, '2024-09-30 05:08:14'),
(198, 220, 2, 1.00, 20.00, 20.00, '2024-09-30 05:08:14'),
(199, 221, 1, 1.00, 50.00, 50.00, '2024-09-30 06:22:49'),
(200, 221, 2, 1.00, 20.00, 20.00, '2024-09-30 06:22:49'),
(201, 221, 3, 1.00, 10.00, 10.00, '2024-09-30 06:22:49'),
(202, 223, 1, 1.00, 50.00, 50.00, '2024-10-08 16:14:29');

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
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `customer_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `product_id`, `delivery_company_id`, `qty`, `price`, `date`, `status`, `customer_id`) VALUES
(120, 1, 1, 50, 50.00, '2024-09-30', 'Pending', 201),
(121, 2, 1, 50, 20.00, '2024-09-30', 'Pending', 201),
(122, 3, 1, 50, 10.00, '2024-09-30', 'Pending', 201),
(123, 4, 1, 50, 5.00, '2024-09-30', 'Completed', 201),
(124, 1, 2, 1, 50.00, '2024-10-06', 'Pending', 201),
(125, 2, 3, 1, 20.00, '2024-10-06', 'Pending', 201),
(126, 3, 2, 1, 10.00, '2024-10-06', 'Pending', 201),
(127, 4, 3, 1, 5.00, '2024-10-06', 'Completed', 201),
(128, 1, 8, 50, 50.00, '2024-10-08', 'Completed', 201);

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
(1, 'ADMIN', 'Admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 'x2g784x1.png', 1, '2024-10-08 17:49:07'),
(7, 'Thaweesap', 'Fookry', '356a192b7913b04c54574d18c28d46e6395428ab', 3, 'no_image.jpg', 1, '2024-10-08 17:32:15'),
(8, 'fluke', 'AA', '356a192b7913b04c54574d18c28d46e6395428ab', 2, 'no_image.jpg', 1, '2024-10-08 17:20:07');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(150) NOT NULL,
  `group_level` int(11) NOT NULL,
  `group_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `group_name`, `group_level`, `group_status`) VALUES
(1, 'Admin', 1, 1),
(5, 'Special', 2, 1),
(6, 'User', 3, 1);

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
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

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
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;

--
-- AUTO_INCREMENT for table `quote_items`
--
ALTER TABLE `quote_items`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `quotes`
--
ALTER TABLE `quotes`
  ADD CONSTRAINT `quotes_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `quote_items`
--
ALTER TABLE `quote_items`
  ADD CONSTRAINT `quote_items_ibfk_1` FOREIGN KEY (`quote_id`) REFERENCES `quotes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quote_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `SK` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_user` FOREIGN KEY (`user_level`) REFERENCES `user_groups` (`group_level`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
