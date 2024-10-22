-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2024 at 06:41 PM
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
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `parent_id` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `name`, `email`, `comment`, `parent_id`, `created_at`) VALUES
(1, 'Mohi', 'mohi@gmail.com', 'Hi , This is best LAwyers Website Ever', 0, '2024-07-30 12:19:49');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `sub` varchar(100) DEFAULT NULL,
  `msg` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `sub`, `msg`) VALUES
(1, 'Mohi', 'mohi@gmail.com', 'Mariage Devorce', 'I wanna information about Mariage divorce category');

-- --------------------------------------------------------

--
-- Table structure for table `ecomm_cart`
--

CREATE TABLE `ecomm_cart` (
  `cart_id` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ecomm_categories`
--

CREATE TABLE `ecomm_categories` (
  `cid` int(11) NOT NULL,
  `cname` varchar(255) DEFAULT NULL,
  `cimg` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ecomm_categories`
--

INSERT INTO `ecomm_categories` (`cid`, `cname`, `cimg`) VALUES
(1, 'Defense Attorneys', 'istockphoto-1025240764-612x612.jpg'),
(2, 'Divorce Lawyers', 'istockphoto-1303997113-612x612 (1).jpg'),
(3, 'Accident Lawyers', 'istockphoto-1168013916-612x612.jpg'),
(4, 'Property Lawyers', '3.jpg'),
(5, 'Tax Planning Lawyers', '4.jpg'),
(6, 'Medical Regulation Lawyers', 'IJW10-1024x684-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ecomm_lawyers`
--

CREATE TABLE `ecomm_lawyers` (
  `pid` int(11) NOT NULL,
  `pname` varchar(255) DEFAULT NULL,
  `pprice` int(11) DEFAULT NULL,
  `pimg` varchar(255) DEFAULT NULL,
  `pdes` varchar(255) DEFAULT NULL,
  `pcategory` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ecomm_lawyers`
--

INSERT INTO `ecomm_lawyers` (`pid`, `pname`, `pprice`, `pimg`, `pdes`, `pcategory`) VALUES
(1, 'Emma Bennett', 5000, '1.webp', 'Defending clients accused of criminal offenses to ensure a fair trial and uphold justice.', 1),
(2, 'Olivia Williams', 6000, '6.jpg', 'Providing legal representation and safeguarding the rights of individuals facing criminal charges.', 1),
(3, 'Hannah Martinez', 10000, '360_F_157631844_SCM8uFhZf1zmaMsUToQ4nfs0ylKTKStd.jpg', 'Expert legal defense for those charged with crimes, focusing on achieving the best possible outcome.', 1),
(4, 'Victoria Clark', 9000, 'law-student-has-the-skills-needed-to-become-a-successful-lawyer.webp', 'Offering skilled defense for clients in criminal cases, ensuring rigorous and fair legal representation.', 1),
(5, 'Lily Garcia', 20000, 'v2-65dga-32qf9.webp', 'Protecting the legal rights of the accused with dedicated and strategic criminal defense services.\r\n', 1),
(6, 'Ella Jackson', 70000, '3.jpg', 'Advocating for defendants in criminal trials to ensure justice and uphold their constitutional rights.', 1),
(7, 'Sarah ', 20000, '6.jpg', 'Governs the process of legally ending a marriage and resolving related issues.', 2),
(8, 'Amelia Taylor', 30000, '360_F_157631844_SCM8uFhZf1zmaMsUToQ4nfs0ylKTKStd.jpg', 'Handles the legal termination of marriage and matters like property division and spousal support.', 2),
(9, 'Zoe Martinez', 10000, '3.jpg', 'Focuses on the dissolution of marriage, covering aspects like child custody and alimony.', 2),
(10, 'Lily White', 70000, 'v2-65dga-32qf9.webp', 'Addresses the legal aspects of ending a marriage, including financial settlements.', 2),
(11, 'Victoria Martinez', 30000, '2.jpg', 'Governs the breakup of marriages legally, including child custody and financial support.', 2),
(12, 'Julia Walker', 10000, '9.jpg', 'Focuses on legally ending a marriage and settling disputes over assets and custody.', 2),
(13, 'Brooke Nelson', 70000, '9.jpg', 'Specialize in representing clients injured in accidents to secure compensation for damages and losses.', 3),
(14, 'Maria Baker', 30000, '10 (1).jpg', 'Handle cases involving personal injuries from accidents, striving to maximize client compensation.', 3),
(15, 'Victoria Martinez', 20000, '1.webp', 'Assist clients in obtaining justice and compensation after being injured in accidents caused by others negligence.', 3),
(16, 'Julia Walker', 40000, '3.jpg', 'Represent individuals injured in various types of accidents, fighting for their rights and fair compensation.', 3),
(17, 'Ella Harris', 90000, '2.jpg', 'Provide expert legal representation for individuals injured in accidents, aiming to achieve the best possible outcome.', 3),
(18, 'Jennifer Lewis', 60000, '360_F_157631844_SCM8uFhZf1zmaMsUToQ4nfs0ylKTKStd.jpg', 'Guide accident victims through the legal process to obtain compensation for medical expenses and lost wages.', 3),
(19, 'Daniel Harris', 20000, '2.webp', ' Specialize in the legal aspects of buying, selling, and managing real estate transactions.', 4),
(20, 'Aria Lewis', 15000, '1.webp', 'Ensure that all aspects of real estate deals are legally sound and compliant with regulations.', 4),
(21, 'Donald Hall', 17000, 'a-male-lawyer-stands-confidently-in-the-courtroom-a-portrait-capturing-his-professionalism-and-dedication-to-the-law-generative-ai-photo.jpg', 'Offer essential guidance on contracts, titles, and property rights to protect clients’ interests.', 4),
(22, 'Hannah', 19000, '8.jpg', 'Experienced in navigating complex property laws, these lawyers assist with both residential and commercial real estate issues.', 4),
(23, 'Zoe', 11000, 'looking-camera-young-attractive-asian-female-lawyer-working-office-with-contract-law-books-when-sitt.jpg', 'Real estate transactions, property lawyers ensure smooth and legally compliant property transfers.', 4),
(24, 'Victoria Martinez', 70000, 'v2-65dga-32qf9.webp', ' Experts in resolving legal issues related to property ownership and management.', 4),
(25, 'Ali', 50000, '12.jpg', 'Help individuals and businesses minimize their tax liabilities through strategic planning and legal advice.', 5),
(26, 'Lily Harris', 18000, '2.jpg', 'Adept at designing strategies to minimize taxes and address complex tax-related issues efficiently.', 5),
(27, 'Ella Anderson', 20000, '6.jpg', 'Specialize in crafting tax plans that enhance financial outcomes while ensuring adherence to tax laws.', 5),
(28, 'Christopher Lee', 70000, '360_F_636884026_Myd8mWq6y2Lu2IOXC47DHjlTnyBC25fu.jpg', 'Help clients plan and execute tax strategies to align with financial goals.', 5),
(29, 'Victoria Martinez', 90000, 'looking-camera-young-attractive-asian-female-lawyer-working-office-with-contract-law-books-when-sitt.jpg', 'Provide crucial advice and representation for all legal aspects of property and real estate.', 5),
(30, 'Muzna', 16000, '9.jpg', 'Provide crucial legal support for all real estate matters.', 5),
(31, 'Dr. Emily Carter', 70000, '2.jpg', 'Offer strategic advice on navigating regulatory frameworks to maintain compliance in the medical field.', 6),
(32, 'Sarah Mitchell', 90000, '10 (1).jpg', 'Provide essential guidance on regulatory issues affecting healthcare operations and patient care.', 6),
(33, 'Olivia Harper', 40000, '360_F_157631844_SCM8uFhZf1zmaMsUToQ4nfs0ylKTKStd.jpg', 'Specialize in defending healthcare providers against regulatory actions and helping them maintain compliance', 6),
(34, 'Jessica Moore', 90000, 'portrait-young-black-female-lawyer-smiling-happy-her-workplace-office-african-lawyer-technologist-pr.jpg', 'Provide expert counsel on compliance with medical regulations and represent clients in regulatory matters.', 6),
(35, 'Sophia ', 50000, 'law-student-has-the-skills-needed-to-become-a-successful-lawyer.webp', 'Offer legal support to ensure that healthcare practices meet regulatory requirements and avoid legal pitfalls.', 6),
(36, 'Aria Young', 90000, 'looking-camera-young-attractive-asian-female-lawyer-working-office-with-contract-law-books-when-sitt.jpg', 'Specialize in defending healthcare providers against regulatory actions and helping them maintain compliance.', 6),
(37, 'Victoria Martinez', 20000, '2.jpg', 'BEst Lawyer Ever', 4);

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
  `oemail` varchar(150) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ecomm_orders`
--

INSERT INTO `ecomm_orders` (`oid`, `uid`, `oname`, `ophone`, `oaddress`, `oemail`, `total`) VALUES
(1, 1, 'Fabiha Allauddin', '03367974957', '90/06/Sector 5-M karachi', 'mohiu2906@gmail.com', 5000.00);

-- --------------------------------------------------------

--
-- Table structure for table `ecomm_order_items`
--

CREATE TABLE `ecomm_order_items` (
  `item_id` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `oid` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ecomm_order_items`
--

INSERT INTO `ecomm_order_items` (`item_id`, `pid`, `oid`, `price`, `subtotal`) VALUES
(1, 1, 1, 5000.00, 5000.00);

-- --------------------------------------------------------

--
-- Table structure for table `ecomm_users`
--

CREATE TABLE `ecomm_users` (
  `uid` int(11) NOT NULL,
  `username` varchar(150) DEFAULT NULL,
  `firstname` varchar(150) DEFAULT NULL,
  `lastname` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `pass` varchar(150) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ecomm_users`
--

INSERT INTO `ecomm_users` (`uid`, `username`, `firstname`, `lastname`, `email`, `pass`, `img`) VALUES
(1, 'Mohi', 'Mohi', 'Uddin', 'mohi@gmail.com', '123', 'Dashboard/uploads/webuserpic/1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `pass`, `image`) VALUES
(1, 'Mohi', 'mohi@gmail.com', '123', 'uploads/profilepics/1.jpg'),
(2, 'Mohiu', 'mohiu@gmail.com', '123', 'uploads/profilepics/4.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ecomm_cart`
--
ALTER TABLE `ecomm_cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD UNIQUE KEY `uid` (`uid`,`pid`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `ecomm_categories`
--
ALTER TABLE `ecomm_categories`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `cname` (`cname`);

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
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ecomm_cart`
--
ALTER TABLE `ecomm_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ecomm_categories`
--
ALTER TABLE `ecomm_categories`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ecomm_lawyers`
--
ALTER TABLE `ecomm_lawyers`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `ecomm_orders`
--
ALTER TABLE `ecomm_orders`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ecomm_order_items`
--
ALTER TABLE `ecomm_order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ecomm_users`
--
ALTER TABLE `ecomm_users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
