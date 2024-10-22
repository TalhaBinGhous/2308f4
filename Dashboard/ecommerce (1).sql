-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2024 at 10:17 PM
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
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `ecomm_cart`
--

CREATE TABLE `ecomm_cart` (
  `cart_id` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ecomm_categories`
--

CREATE TABLE `ecomm_categories` (
  `cid` int(11) NOT NULL,
  `cname` varchar(255) NOT NULL,
  `cimg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ecomm_categories`
--

INSERT INTO `ecomm_categories` (`cid`, `cname`, `cimg`) VALUES
(1, 'Crime', '3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ecomm_lawyers`
--

CREATE TABLE `ecomm_lawyers` (
  `pid` int(11) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `pprice` decimal(10,2) NOT NULL,
  `pimg` varchar(255) DEFAULT NULL,
  `pdes` varchar(255) DEFAULT NULL,
  `pcategory` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ecomm_orders`
--

CREATE TABLE `ecomm_orders` (
  `oid` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `oname` varchar(150) DEFAULT NULL,
  `ophone` varchar(150) DEFAULT NULL,
  `oaddress` varchar(150) DEFAULT NULL,
  `oemail` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ecomm_order_items`
--

CREATE TABLE `ecomm_order_items` (
  `item_id` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `oid` int(11) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ecomm_users`
--

CREATE TABLE `ecomm_users` (
  `uid` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `firstname` varchar(150) DEFAULT NULL,
  `lastname` varchar(150) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `pass` varchar(150) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ecomm_users`
--

INSERT INTO `ecomm_users` (`uid`, `username`, `firstname`, `lastname`, `email`, `pass`, `img`) VALUES
(1, 'mu_23_4', 'mohi', 'Ali', 'mohi14324@gmail.com', '123', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ecomm_cart`
--
ALTER TABLE `ecomm_cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `pid` (`pid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `ecomm_categories`
--
ALTER TABLE `ecomm_categories`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `ecomm_lawyers`
--
ALTER TABLE `ecomm_lawyers`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `pcategory` (`pcategory`);

--
-- Indexes for table `ecomm_orders`
--
ALTER TABLE `ecomm_orders`
  ADD PRIMARY KEY (`oid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `ecomm_order_items`
--
ALTER TABLE `ecomm_order_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `pid` (`pid`),
  ADD KEY `oid` (`oid`);

--
-- Indexes for table `ecomm_users`
--
ALTER TABLE `ecomm_users`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ecomm_cart`
--
ALTER TABLE `ecomm_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ecomm_categories`
--
ALTER TABLE `ecomm_categories`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ecomm_lawyers`
--
ALTER TABLE `ecomm_lawyers`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ecomm_orders`
--
ALTER TABLE `ecomm_orders`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ecomm_order_items`
--
ALTER TABLE `ecomm_order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ecomm_users`
--
ALTER TABLE `ecomm_users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ecomm_cart`
--
ALTER TABLE `ecomm_cart`
  ADD CONSTRAINT `ecomm_cart_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `ecomm_lawyers` (`pid`),
  ADD CONSTRAINT `ecomm_cart_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `ecomm_users` (`uid`);

--
-- Constraints for table `ecomm_lawyers`
--
ALTER TABLE `ecomm_lawyers`
  ADD CONSTRAINT `ecomm_lawyers_ibfk_1` FOREIGN KEY (`pcategory`) REFERENCES `ecomm_categories` (`cid`);

--
-- Constraints for table `ecomm_orders`
--
ALTER TABLE `ecomm_orders`
  ADD CONSTRAINT `ecomm_orders_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `ecomm_users` (`uid`);

--
-- Constraints for table `ecomm_order_items`
--
ALTER TABLE `ecomm_order_items`
  ADD CONSTRAINT `ecomm_order_items_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `ecomm_lawyers` (`pid`),
  ADD CONSTRAINT `ecomm_order_items_ibfk_2` FOREIGN KEY (`oid`) REFERENCES `ecomm_orders` (`oid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
