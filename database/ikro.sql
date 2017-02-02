-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 02, 2017 at 08:24 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ikro`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nic` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fixed` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `address`, `nic`, `mobile`, `fixed`) VALUES
(1, 'shan', '141/2,willo gardens, wepathaira road, Hakmana', '943321205v', '712418805', '413415456'),
(2, 'ashan', 'sdsd', '943321205v', '715656565', '413415456'),
(3, 'shan', '141/2,willo gardens, wepathaira road, Hakmana', '943321205v', '712418805', '413415456'),
(4, 'ashan', 'sdsd', '943321205v', '715656565', '413415456'),
(5, 'shan', '141/2,willo gardens, wepathaira road, Hakmana', '943321205v', '712418805', '413415456'),
(6, 'ashan', 'sdsd', '943321205v', '715656565', '413415456'),
(7, 'shan', '141/2,willo gardens, wepathaira road, Hakmana', '943321205v', '712418805', '413415456'),
(8, 'ashan', 'sdsd', '943321205v', '715656565', '413415456'),
(9, 'ashan', 'sdsd', '943321205v', '715656565', '413415456'),
(10, 'shan', '141/2,willo gardens, wepathaira road, Hakmana', '943321205v', '712418805', '413415456'),
(11, 'ashan', 'sdsd', '943321205v', '715656565', '413415456');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(11) NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `dateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `type_id`, `description`, `amount`, `dateTime`) VALUES
(1, 1, 'sdsdsd', 223223, '2017-01-31 05:04:16'),
(2, 1, 'sdsd', 124558, '2017-01-31 18:07:17'),
(3, 1, 'bill', 2323, '2017-01-31 19:45:48'),
(4, 1, 'sdsdsd', 223223, '2017-01-31 05:04:16'),
(5, 1, 'sdsd', 124558, '2017-01-31 18:07:17'),
(6, 1, 'bill', 2323, '2017-01-31 19:45:48'),
(7, 1, 'sdsdsd', 223223, '2017-01-31 05:04:16'),
(8, 1, 'sdsd', 124558, '2017-01-31 18:07:17'),
(9, 1, 'bill', 2323, '2017-01-31 19:45:48'),
(10, 1, 'sdsdsd', 223223, '2017-01-31 05:04:16'),
(11, 1, 'sdsd', 124558, '2017-01-31 18:07:17'),
(12, 1, 'bill', 2323, '2017-01-31 19:45:48');

-- --------------------------------------------------------

--
-- Table structure for table `expense_type`
--

CREATE TABLE `expense_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `metacode` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `expense_type`
--

INSERT INTO `expense_type` (`id`, `name`, `metacode`) VALUES
(1, 'Electricity Bills', 'TYPE_ELECTRICITY');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `invoiceNumber` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateTime` datetime NOT NULL,
  `customerName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customerAddress` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customerNic` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customerPhone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `itemCode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `availableStock` int(11) NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `manufacturer` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `itemCode`, `name`, `description`, `availableStock`, `type_id`, `manufacturer`) VALUES
(1, 'sdsd', 'sdsd', 'dsdsd', 23, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `item_type`
--

CREATE TABLE `item_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `metacode` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateTime` datetime NOT NULL,
  `loggedId` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `action_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `description`, `dateTime`, `loggedId`, `action_id`, `type_id`) VALUES
(1, 'customer added', '2017-02-01 18:54:57', '1', 1, 1),
(2, 'customer added', '2017-02-01 18:55:13', '1', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `log_action`
--

CREATE TABLE `log_action` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `metacode` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `log_action`
--

INSERT INTO `log_action` (`id`, `name`, `metacode`) VALUES
(1, 'Add', 'ACTION_ADD');

-- --------------------------------------------------------

--
-- Table structure for table `log_type`
--

CREATE TABLE `log_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `metacode` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `log_type`
--

INSERT INTO `log_type` (`id`, `name`, `metacode`) VALUES
(1, 'Customer', 'TYPE_CUSTOMER');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `metacode` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `metacode`) VALUES
(1, 'admin', 'ROLE_ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `id` int(11) NOT NULL,
  `dateTime` datetime NOT NULL,
  `soldPrice` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `invoice_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `dateTime` datetime NOT NULL,
  `quantity` int(11) NOT NULL,
  `cost` double NOT NULL,
  `sellingPrice` double NOT NULL,
  `item_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isactive` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `isactive`, `role_id`) VALUES
(1, 'shan', '$2a$12$cma0T6p3YXXh6CmJYXO1z.T07nVnpdFmyrGerXLTGV1kZ4.2GoK.6', 'mkspramuditha@gmail.com', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2D3A8DA6C54C8C93` (`type_id`);

--
-- Indexes for table `expense_type`
--
ALTER TABLE `expense_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1F1B251E7D59FD6E` (`itemCode`),
  ADD KEY `IDX_1F1B251EC54C8C93` (`type_id`);

--
-- Indexes for table `item_type`
--
ALTER TABLE `item_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8F3F68C59D32F035` (`action_id`),
  ADD KEY `IDX_8F3F68C5C54C8C93` (`type_id`);

--
-- Indexes for table `log_action`
--
ALTER TABLE `log_action`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_type`
--
ALTER TABLE `log_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E54BC005126F525E` (`item_id`),
  ADD KEY `IDX_E54BC0052989F1FD` (`invoice_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4B365660126F525E` (`item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1483A5E9F85E0677` (`username`),
  ADD KEY `IDX_1483A5E9D60322AC` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `expense_type`
--
ALTER TABLE `expense_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `item_type`
--
ALTER TABLE `item_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `log_action`
--
ALTER TABLE `log_action`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `log_type`
--
ALTER TABLE `log_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `expense`
--
ALTER TABLE `expense`
  ADD CONSTRAINT `FK_2D3A8DA6C54C8C93` FOREIGN KEY (`type_id`) REFERENCES `expense_type` (`id`);

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `FK_1F1B251EC54C8C93` FOREIGN KEY (`type_id`) REFERENCES `item_type` (`id`);

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `FK_8F3F68C59D32F035` FOREIGN KEY (`action_id`) REFERENCES `log_action` (`id`),
  ADD CONSTRAINT `FK_8F3F68C5C54C8C93` FOREIGN KEY (`type_id`) REFERENCES `log_type` (`id`);

--
-- Constraints for table `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `FK_E54BC005126F525E` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`),
  ADD CONSTRAINT `FK_E54BC0052989F1FD` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `FK_4B365660126F525E` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_1483A5E9D60322AC` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
