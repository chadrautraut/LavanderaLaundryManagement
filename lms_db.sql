-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2024 at 08:58 AM
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
-- Database: `lms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `fullname`, `address`, `contact`, `created_at`) VALUES
(1, 'SELWYN AYAAY', 'pagbilao', '09504060320', '2024-11-15 22:38:44');

-- --------------------------------------------------------

--
-- Table structure for table `expenditures`
--

CREATE TABLE `expenditures` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenditures`
--

INSERT INTO `expenditures` (`id`, `user_id`, `item_id`, `transaction_id`, `qty`, `created_at`) VALUES
(1, 1, 1, 1, 1, '2024-11-15 22:39:02'),
(2, 1, 1, 2, 1, '2024-11-15 22:56:06'),
(3, 1, 1, 3, 1, '2024-11-15 23:27:24'),
(4, 1, 1, 4, 1, '2024-11-18 00:12:32'),
(5, 1, 1, 5, 1, '2024-11-25 17:20:11'),
(6, 1, 1, 6, 1, '2024-11-27 11:18:02'),
(7, 1, 1, 7, 1, '2024-11-27 11:28:05'),
(8, 1, 1, 8, 1, '2024-11-27 11:29:00'),
(9, 1, 3, 9, 1, '2024-12-05 15:35:23');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `unit`, `stock`, `created_at`) VALUES
(1, 'Zonrox color safe', 'ml', 0, '2024-11-15 22:38:28'),
(2, 'Tide liquid', 'ml', 1, '2024-11-30 10:01:02'),
(3, 'ariel', 'ml', 0, '2024-11-30 10:01:18');

-- --------------------------------------------------------

--
-- Table structure for table `laundry`
--

CREATE TABLE `laundry` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `kilo` double DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `date0` datetime DEFAULT NULL,
  `date1` datetime DEFAULT NULL,
  `date2` datetime DEFAULT NULL,
  `date3` datetime DEFAULT NULL,
  `date4` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laundry`
--

INSERT INTO `laundry` (`id`, `transaction_id`, `kilo`, `type`, `status`, `date0`, `date1`, `date2`, `date3`, `date4`, `created_at`) VALUES
(1, 1, 1, 1, '4', '2024-11-15 22:52:33', '2024-11-15 22:52:40', '2024-11-15 22:52:47', '2024-11-15 22:52:53', NULL, '2024-11-15 22:39:10'),
(2, 2, 1, 1, '4', '2024-11-15 22:56:30', '2024-11-15 22:56:40', '2024-11-15 22:56:43', '2024-11-15 22:56:48', NULL, '2024-11-15 22:56:12'),
(3, 3, 1, 1, '4', '2024-11-18 00:10:27', '2024-11-18 00:10:40', '2024-11-18 00:10:50', '2024-11-18 00:11:02', NULL, '2024-11-15 23:27:10'),
(4, 4, 1, 1, '4', '2024-11-18 00:13:15', '2024-11-18 00:13:24', '2024-11-18 00:13:34', '2024-11-18 00:13:48', NULL, '2024-11-18 00:12:39'),
(5, 5, 1, 1, '4', '2024-11-25 17:20:52', '2024-11-27 11:06:15', '2024-11-27 11:06:20', '2024-11-27 11:08:02', NULL, '2024-11-25 17:20:23'),
(6, 6, 1, 1, '4', '2024-11-27 11:18:37', '2024-11-27 11:24:43', '2024-11-27 15:07:02', '2024-11-27 15:07:06', NULL, '2024-11-27 11:18:15'),
(7, 7, 1, 1, '4', '2024-11-27 15:07:09', '2024-11-27 15:07:13', '2024-11-27 15:07:22', '2024-11-30 10:05:55', NULL, '2024-11-27 11:28:12'),
(8, 8, 1, 1, '3', '2024-12-05 15:32:27', '2024-12-05 15:32:35', '2024-12-05 15:32:59', NULL, NULL, '2024-11-27 11:29:10'),
(9, 9, 1, 1, '4', '2024-12-05 15:36:12', '2024-12-05 15:41:18', '2024-12-05 15:41:28', '2024-12-05 15:41:39', NULL, '2024-12-05 15:35:32');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `logs` text DEFAULT NULL,
  `type` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `logs`, `type`, `created_at`) VALUES
(1, 1, 'admin| Logged in', 'Login', '2024-11-15 22:37:36'),
(2, 1, '120 perkilo| New Price was added', 'Adding Price', '2024-11-15 22:38:03'),
(3, 1, 'Zonrox color safe| New Item was added', 'Adding Item', '2024-11-15 22:38:28'),
(4, 1, 'SELWYN AYAAY| New Customer was added', 'Adding Customer', '2024-11-15 22:38:44'),
(5, 1, 'New Transaction was added', 'Adding Transaction', '2024-11-15 22:38:56'),
(6, 1, 'Adding Expenditures', 'Added item to transaction', '2024-11-15 22:39:02'),
(7, 1, '1| was added', 'Adding Laundry', '2024-11-15 22:39:10'),
(8, 1, '1 added a new pending transaction', 'New Pending Transaction', '2024-11-15 22:39:18'),
(9, 1, '1| Transaction was updated to Pending by admin.', 'Update Transaction', '2024-11-15 22:52:33'),
(10, 1, '1| Transaction was updated to Washing by admin.', 'Update Transaction', '2024-11-15 22:52:40'),
(11, 1, '1| Transaction was updated to Folding by admin.', 'Update Transaction', '2024-11-15 22:52:47'),
(12, 1, '1| Transaction was updated to Ready for Pickup by admin.', 'Update Transaction', '2024-11-15 22:52:53'),
(13, 1, 'New Transaction was added', 'Adding Transaction', '2024-11-15 22:55:59'),
(14, 1, 'Adding Expenditures', 'Added item to transaction', '2024-11-15 22:56:06'),
(15, 1, '1| was added', 'Adding Laundry', '2024-11-15 22:56:12'),
(16, 1, '1 added a new pending transaction', 'New Pending Transaction', '2024-11-15 22:56:18'),
(17, 1, '2| Transaction was updated to Pending by admin.', 'Update Transaction', '2024-11-15 22:56:30'),
(18, 1, '2| Transaction was updated to Washing by admin.', 'Update Transaction', '2024-11-15 22:56:40'),
(19, 1, '2| Transaction was updated to Folding by admin.', 'Update Transaction', '2024-11-15 22:56:43'),
(20, 1, '2| Transaction was updated to Ready for Pickup by admin.', 'Update Transaction', '2024-11-15 22:56:48'),
(21, 1, 'New Transaction was added', 'Adding Transaction', '2024-11-15 23:26:59'),
(22, 1, '1| was added', 'Adding Laundry', '2024-11-15 23:27:10'),
(23, 1, 'Adding Expenditures', 'Added item to transaction', '2024-11-15 23:27:24'),
(24, 1, '1 added a new pending transaction', 'New Pending Transaction', '2024-11-15 23:27:30'),
(25, 1, 'admin| Logged in', 'Login', '2024-11-18 00:08:56'),
(26, 1, '3| Transaction was updated to Pending by admin.', 'Update Transaction', '2024-11-18 00:10:27'),
(27, 1, '3| Transaction was updated to Washing by admin.', 'Update Transaction', '2024-11-18 00:10:40'),
(28, 1, '3| Transaction was updated to Folding by admin.', 'Update Transaction', '2024-11-18 00:10:50'),
(29, 1, '3| Transaction was updated to Ready for Pickup by admin.', 'Update Transaction', '2024-11-18 00:11:02'),
(30, 1, 'New Transaction was added', 'Adding Transaction', '2024-11-18 00:12:28'),
(31, 1, 'Adding Expenditures', 'Added item to transaction', '2024-11-18 00:12:32'),
(32, 1, '1| was added', 'Adding Laundry', '2024-11-18 00:12:39'),
(33, 1, '1 added a new pending transaction', 'New Pending Transaction', '2024-11-18 00:12:55'),
(34, 1, '4| Transaction was updated to Pending by admin.', 'Update Transaction', '2024-11-18 00:13:15'),
(35, 1, '4| Transaction was updated to Washing by admin.', 'Update Transaction', '2024-11-18 00:13:24'),
(36, 1, '4| Transaction was updated to Folding by admin.', 'Update Transaction', '2024-11-18 00:13:34'),
(37, 1, '4| Transaction was updated to Ready for Pickup by admin.', 'Update Transaction', '2024-11-18 00:13:48'),
(38, 1, 'admin| Logged in', 'Login', '2024-11-25 14:04:01'),
(39, 1, 'New Transaction was added', 'Adding Transaction', '2024-11-25 17:19:59'),
(40, 1, 'Adding Expenditures', 'Added item to transaction', '2024-11-25 17:20:11'),
(41, 1, '1| was added', 'Adding Laundry', '2024-11-25 17:20:23'),
(42, 1, '1 added a new pending transaction', 'New Pending Transaction', '2024-11-25 17:20:28'),
(43, 1, '5| Transaction was updated to Pending by admin.', 'Update Transaction', '2024-11-25 17:20:52'),
(44, 1, '5| Transaction was updated to Washing by admin.', 'Update Transaction', '2024-11-27 11:06:15'),
(45, 1, '5| Transaction was updated to Folding by admin.', 'Update Transaction', '2024-11-27 11:06:20'),
(46, 1, '5| Transaction was updated to Ready for Pickup by admin.', 'Update Transaction', '2024-11-27 11:08:02'),
(47, 1, 'New Transaction was added', 'Adding Transaction', '2024-11-27 11:16:30'),
(48, 1, '8kg| New Price was added', 'Adding Price', '2024-11-27 11:17:18'),
(49, 1, '1 Stock was added', 'Stock In', '2024-11-27 11:17:45'),
(50, 1, 'Adding Expenditures', 'Added item to transaction', '2024-11-27 11:18:02'),
(51, 1, '1| was added', 'Adding Laundry', '2024-11-27 11:18:15'),
(52, 1, '1 added a new pending transaction', 'New Pending Transaction', '2024-11-27 11:18:22'),
(53, 1, '6| Transaction was updated to Pending by admin.', 'Update Transaction', '2024-11-27 11:18:37'),
(54, 1, '6| Transaction was updated to Washing by admin.', 'Update Transaction', '2024-11-27 11:24:43'),
(55, 1, 'New Transaction was added', 'Adding Transaction', '2024-11-27 11:27:41'),
(56, 1, '1 Stock was added', 'Stock In', '2024-11-27 11:27:53'),
(57, 1, 'Adding Expenditures', 'Added item to transaction', '2024-11-27 11:28:05'),
(58, 1, '1| was added', 'Adding Laundry', '2024-11-27 11:28:12'),
(59, 1, '1 added a new pending transaction', 'New Pending Transaction', '2024-11-27 11:28:18'),
(60, 1, 'New Transaction was added', 'Adding Transaction', '2024-11-27 11:28:34'),
(61, 1, '1 Stock was added', 'Stock In', '2024-11-27 11:28:52'),
(62, 1, 'Adding Expenditures', 'Added item to transaction', '2024-11-27 11:29:00'),
(63, 1, '1| was added', 'Adding Laundry', '2024-11-27 11:29:10'),
(64, 1, '1 added a new pending transaction', 'New Pending Transaction', '2024-11-27 15:00:52'),
(65, 1, '6| Transaction was updated to Folding by admin.', 'Update Transaction', '2024-11-27 15:07:02'),
(66, 1, '6| Transaction was updated to Ready for Pickup by admin.', 'Update Transaction', '2024-11-27 15:07:06'),
(67, 1, '7| Transaction was updated to Pending by admin.', 'Update Transaction', '2024-11-27 15:07:09'),
(68, 1, '7| Transaction was updated to Washing by admin.', 'Update Transaction', '2024-11-27 15:07:13'),
(69, 1, '7| Transaction was updated to Folding by admin.', 'Update Transaction', '2024-11-27 15:07:22'),
(70, 1, 'admin| Logged in', 'Login', '2024-11-30 09:59:50'),
(71, 1, 'Tide liquid| New Item was added', 'Adding Item', '2024-11-30 10:01:02'),
(72, 1, 'ariel| New Item was added', 'Adding Item', '2024-11-30 10:01:18'),
(73, 1, '7| Transaction was updated to Ready for Pickup by admin.', 'Update Transaction', '2024-11-30 10:05:55'),
(74, 1, 'New Transaction was added', 'Adding Transaction', '2024-11-30 10:42:54'),
(75, 1, 'admin| Logged in', 'Login', '2024-12-01 21:51:46'),
(76, 1, 'IVER| New Staff was added', 'Adding Staff', '2024-12-01 21:52:20'),
(77, 1, 'adminUser has logged out', 'Logout', '2024-12-01 21:52:23'),
(78, 2, 'IVER| Logged in', 'Login', '2024-12-01 21:52:29'),
(79, 2, 'IVERUser has logged out', 'Logout', '2024-12-01 21:57:42'),
(80, 1, 'admin| Logged in', 'Login', '2024-12-01 21:57:48'),
(81, 1, 'adminUser has logged out', 'Logout', '2024-12-01 21:59:44'),
(82, 2, 'IVER| Logged in', 'Login', '2024-12-01 21:59:49'),
(83, 2, 'IVERUser has logged out', 'Logout', '2024-12-01 22:07:05'),
(84, 1, 'admin| Logged in', 'Login', '2024-12-01 22:07:12'),
(85, 1, 'adminUser has logged out', 'Logout', '2024-12-04 14:39:38'),
(86, 2, 'IVER| Logged in', 'Login', '2024-12-04 14:39:47'),
(87, 2, 'New Transaction was added', 'Adding Transaction', '2024-12-04 15:24:46'),
(88, 2, 'IVERUser has logged out', 'Logout', '2024-12-04 15:53:24'),
(89, 1, 'admin| Logged in', 'Login', '2024-12-04 15:53:29'),
(90, 1, 'adminUser has logged out', 'Logout', '2024-12-05 03:36:05'),
(91, 2, 'IVER| Logged in', 'Login', '2024-12-05 03:36:09'),
(92, 2, 'IVERUser has logged out', 'Logout', '2024-12-05 14:43:12'),
(93, 1, 'admin| Logged in', 'Login', '2024-12-05 14:43:18'),
(94, 1, '8| Transaction was updated to Pending by admin.', 'Update Transaction', '2024-12-05 15:32:27'),
(95, 1, '8| Transaction was updated to Washing by admin.', 'Update Transaction', '2024-12-05 15:32:35'),
(96, 1, '8| Transaction was updated to Folding by admin.', 'Update Transaction', '2024-12-05 15:32:59'),
(97, 1, 'Adding Expenditures', 'Added item to transaction', '2024-12-05 15:35:23'),
(98, 1, '1| was added', 'Adding Laundry', '2024-12-05 15:35:32'),
(99, 1, '1 added a new pending transaction', 'New Pending Transaction', '2024-12-05 15:35:37'),
(100, 1, '9| Transaction was updated to Pending by admin.', 'Update Transaction', '2024-12-05 15:36:12'),
(101, 1, '9| Transaction was updated to Washing by admin.', 'Update Transaction', '2024-12-05 15:41:18'),
(102, 1, '9| Transaction was updated to Folding by admin.', 'Update Transaction', '2024-12-05 15:41:28'),
(103, 1, '9| Transaction was updated to Ready for Pickup by admin.', 'Update Transaction', '2024-12-05 15:41:39');

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `name`, `unit`, `price`, `created_at`) VALUES
(1, '120 perkilo', 'Kg', 100.00, '2024-11-15 22:38:03'),
(2, '8kg', 'Kg', 120.00, '2024-11-27 11:17:18');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `customer_id`, `total`, `amount`, `status`, `created_at`) VALUES
(1, 1, 1, 100.00, 100.00, 'completed', '2024-11-15 22:38:56'),
(2, 1, 1, 100.00, 100.00, 'completed', '2024-11-15 22:55:59'),
(3, 1, 1, 100.00, 100.00, 'completed', '2024-11-15 23:26:59'),
(4, 1, 1, 100.00, 100.00, 'completed', '2024-11-18 00:12:28'),
(5, 1, 1, 100.00, 100.00, 'completed', '2024-11-25 17:19:59'),
(6, 1, 1, 100.00, 100.00, 'completed', '2024-11-27 11:16:30'),
(7, 1, 1, 100.00, 100.00, 'completed', '2024-11-27 11:27:41'),
(8, 1, 1, 100.00, 100.00, 'completed', '2024-11-27 11:28:34'),
(9, 1, 1, 100.00, 100.00, 'completed', '2024-11-30 10:42:54'),
(10, 2, 1, NULL, NULL, 'pending', '2024-12-04 15:24:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `level`, `created_at`) VALUES
(1, 'admin', '$2y$10$WgL2d2fzi6IiGiTfXvdBluTLlMroU8zBtIcRut7SzOB6j9i/LbA4K', '0', '2024-11-15 22:37:27'),
(2, 'IVER', '$2y$10$uH5kXD0GHJiL3fohiapO7.6zZpBUXzPe8Sjcvr/vdEirE/8lyUbPW', '1', '2024-12-01 21:52:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenditures`
--
ALTER TABLE `expenditures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `transaction_id` (`transaction_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laundry`
--
ALTER TABLE `laundry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expenditures`
--
ALTER TABLE `expenditures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `laundry`
--
ALTER TABLE `laundry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `expenditures`
--
ALTER TABLE `expenditures`
  ADD CONSTRAINT `expenditures_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `expenditures_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `expenditures_ibfk_3` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `laundry`
--
ALTER TABLE `laundry`
  ADD CONSTRAINT `laundry_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `laundry_ibfk_2` FOREIGN KEY (`type`) REFERENCES `prices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
