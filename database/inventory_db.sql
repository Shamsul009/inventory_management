-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2023 at 08:04 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_db`
--
CREATE DATABASE IF NOT EXISTS `inventory_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `inventory_db`;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `company_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `product_name` varchar(20) NOT NULL,
  `warehouse_name` varchar(20) NOT NULL,
  `house_product_quantity` int(10) NOT NULL,
  `store_name` varchar(20) NOT NULL,
  `store_product_quantity` int(10) NOT NULL,
  `create_time` datetime(6) DEFAULT NULL,
  `update_time` datetime(6) DEFAULT NULL,
  `total_product` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`company_id`, `product_id`, `product_name`, `warehouse_name`, `house_product_quantity`, `store_name`, `store_product_quantity`, `create_time`, `update_time`, `total_product`) VALUES
(1, 1, 'Chips', 'BrothersWareHouseOne', 8, 'StoreHouse1', 14, NULL, NULL, 22),
(1, 2, 'Toy', 'BrothersWareHouseOne', 15, 'StoreHouse1', 5, NULL, NULL, 20),
(1, 3, 'Toy', 'BrothersWareHouseOne', 15, 'StoreHouse1', 5, NULL, NULL, 20),
(1, 4, 'Car', 'BrothersWareHouseOne', 7, 'StoreHouse1', 8, NULL, NULL, 15),
(1, 5, 'Car', 'BrothersWareHouseOne', 7, 'StoreHouse1', 8, NULL, NULL, 15);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user_types_id` int(10) NOT NULL,
  `create_at` datetime(6) DEFAULT NULL,
  `update_at` datetime(6) DEFAULT NULL,
  `phone_number` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `company_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_types_id`, `create_at`, `update_at`, `phone_number`, `password`, `company_id`) VALUES
(1, 'Brothers Group', 1, NULL, NULL, '01684251815', 'arifeen12', NULL),
(2, 'Haque Group', 1, NULL, NULL, '01684251814', 'arif', NULL),
(3, 'BrothersWareHouseOne', 3, NULL, NULL, '01684251813', '123', 1),
(4, 'BrotherWareHouseTwo', 3, NULL, NULL, '01684251811', '456', 1),
(5, 'StoreHouse1', 2, NULL, NULL, '01895341919', '12345', 1),
(6, 'StoreHouseTwo', 2, NULL, NULL, '01684251810', '789456', 1),
(7, 'HaqueWareHouseOne', 3, NULL, NULL, '01895341918', '1234', 2),
(8, 'HaqueWareHouseTwo', 3, NULL, NULL, '01684251817', '654', 2),
(9, 'HaqueStoreHouseOne', 2, NULL, NULL, '01895341910', '910', 2),
(10, 'HaqueStoreHouseOne', 2, NULL, NULL, '01684251820', '820', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

DROP TABLE IF EXISTS `user_types`;
CREATE TABLE `user_types` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `create_time` datetime(6) NOT NULL,
  `update_time` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `name`, `create_time`, `update_time`) VALUES
(1, 'Admin', '2023-12-12 20:02:12.000000', '0000-00-00 00:00:00.000000'),
(2, 'StoreManagers', '2023-12-12 20:02:12.000000', '0000-00-00 00:00:00.000000'),
(3, 'WarehouseStaff', '2023-12-12 20:03:06.000000', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_delivery`
--

DROP TABLE IF EXISTS `warehouse_delivery`;
CREATE TABLE `warehouse_delivery` (
  `id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `store_house` varchar(20) NOT NULL,
  `product_quantity` int(10) NOT NULL,
  `warehouse_id` int(10) NOT NULL,
  `company_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `warehouse_delivery`
--

INSERT INTO `warehouse_delivery` (`id`, `product_id`, `store_house`, `product_quantity`, `warehouse_id`, `company_id`) VALUES
(28, 1, 'StoreHouse1', 5, 3, 1),
(29, 1, 'StoreHouse1', 2, 3, 1),
(30, 1, 'StoreHouse1', 5, 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_types_id` (`user_types_id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse_delivery`
--
ALTER TABLE `warehouse_delivery`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `warehouse_delivery`
--
ALTER TABLE `warehouse_delivery`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_types_id`) REFERENCES `user_types` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
