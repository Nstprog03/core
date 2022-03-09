-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2022 at 09:27 AM
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
-- Database: `project_nishith`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `firstName`, `lastName`, `email`, `password`, `status`, `createdAt`, `updatedAt`) VALUES
(37, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 'wefefqewffwefqwdwdqwdqdqwdqdwdqwdw', 1, '2022-02-26 12:02:56', '2022-03-09 10:03:32'),
(38, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 'wd', 1, '2022-03-03 12:03:31', NULL),
(39, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 'dwd', 1, '2022-03-03 01:03:39', NULL),
(40, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 'wdwd', 1, '2022-03-03 02:03:03', NULL),
(41, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 'efef', 1, '2022-03-03 05:03:38', NULL),
(42, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 'r3f3re', 1, '2022-03-03 05:03:10', NULL),
(43, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 'qdqeff', 1, '2022-03-03 07:03:18', NULL),
(44, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 'wqfefe', 1, '2022-03-04 11:03:21', NULL),
(45, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 'wdwd', 1, '2022-03-04 11:03:43', '2022-03-04 12:03:37'),
(47, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 'dwd', 1, '2022-03-04 12:03:44', NULL),
(48, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 'wdwd', 1, '2022-03-04 02:03:02', NULL),
(49, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 'wefef', 1, '2022-03-04 10:03:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` bigint(24) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `base` int(11) DEFAULT NULL,
  `thumb` int(11) DEFAULT NULL,
  `small` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL,
  `parentId` bigint(24) DEFAULT NULL,
  `path` varchar(160) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `name`, `base`, `thumb`, `small`, `status`, `createdAt`, `updatedAt`, `parentId`, `path`) VALUES
(87, 'dwdw', 32, 33, 32, 1, '2022-03-04 12:03:02', '2022-03-09 10:03:38', NULL, '87'),
(88, 'Bed', NULL, NULL, NULL, 1, '2022-03-04 01:03:02', NULL, NULL, '88'),
(89, 'triple bed', NULL, NULL, NULL, 2, '2022-03-04 02:03:16', NULL, NULL, '89'),
(100, 'double bed', NULL, NULL, NULL, 1, '2022-03-09 01:03:08', NULL, 88, '88/100');

-- --------------------------------------------------------

--
-- Table structure for table `category_media`
--

CREATE TABLE `category_media` (
  `mediaId` int(11) NOT NULL,
  `categoryId` bigint(24) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gallery` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_media`
--

INSERT INTO `category_media` (`mediaId`, `categoryId`, `name`, `gallery`) VALUES
(32, 87, 'file-20181102-83635-1jdo9u920220309120541.jpg', 1),
(33, 87, 'Stress-and-broken-heart-120220309120551.jpeg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category_product`
--

CREATE TABLE `category_product` (
  `entity_id` int(24) NOT NULL,
  `product_id` int(24) NOT NULL,
  `category_id` bigint(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `configId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 2,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`configId`, `name`, `code`, `value`, `status`, `createdAt`) VALUES
(1, 'Facebook', 'google.com', 'www.google.comfacebook', 2, '2022-02-26 08:02:25'),
(2, 'Google', 'google.com', 'www.google.com', 1, '2022-02-28 08:02:30'),
(3, 'Google', 'google.com', 'www.google.comfacebook', 1, '2022-02-28 08:02:48'),
(4, 'Google', 'google.com', 'www.google.com', 1, '2022-03-09 01:03:33');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerId` int(11) NOT NULL,
  `salesmanId` int(11) DEFAULT NULL,
  `firstName` varchar(40) NOT NULL,
  `lastName` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` bigint(10) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 2,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerId`, `salesmanId`, `firstName`, `lastName`, `email`, `mobile`, `status`, `createdAt`, `updatedAt`) VALUES
(105, NULL, 'Dhruv', 'Prajapati', 'dhruv@gmail.com', 45127896354, 2, '2022-02-24 02:02:34', '2022-02-24 09:37:41'),
(122, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-02-26 03:02:29', NULL),
(145, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 2, '2022-02-26 04:02:43', NULL),
(150, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-02-26 07:02:35', NULL),
(151, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-02-26 07:02:19', '2022-02-26 07:35:29'),
(152, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-02 02:03:08', '2022-03-02 02:04:21'),
(153, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-02 02:03:36', '2022-03-02 02:04:44'),
(154, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-03 10:03:54', NULL),
(155, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-04 01:03:00', NULL),
(156, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-04 01:03:03', '2022-03-04 01:19:30'),
(157, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-08 11:03:15', '2022-03-08 11:27:26'),
(158, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-09 01:03:24', NULL),
(159, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-09 01:03:39', NULL),
(160, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-09 01:03:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `addressId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `address` text NOT NULL,
  `postalCode` int(7) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `billing` tinyint(1) NOT NULL DEFAULT 2,
  `shipping` tinyint(1) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`addressId`, `customerId`, `address`, `postalCode`, `city`, `state`, `country`, `billing`, `shipping`) VALUES
(24, 105, 'Ahmdabad', 455454, 'Ahmedabad', 'GUJARAT', 'India', 2, 1),
(29, 122, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360, 'kjk', 'GUJA', 'India', 1, 1),
(30, 145, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 1, 1),
(31, 150, '', 0, '', '', '', 2, 2),
(32, 151, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 1, 1),
(33, 152, 'qknsdlnclasISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 1, 2),
(34, 153, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 2, 2),
(35, 154, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 1, 1),
(36, 155, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 1, 1),
(37, 156, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 1, 1),
(38, 157, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 1, 2),
(39, 158, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 1, 1),
(40, 159, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 1, 1),
(41, 160, '', 0, '', '', '', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `customer_price`
--

CREATE TABLE `customer_price` (
  `entityId` int(11) NOT NULL,
  `customerId` int(11) DEFAULT NULL,
  `productId` int(11) NOT NULL,
  `discount` float(5,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `pageId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 2,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`pageId`, `name`, `code`, `content`, `status`, `createdAt`, `updatedAt`) VALUES
(1, 'demo', 'demo.com', 'qwubcub', 1, '2022-02-28 09:01:01', '2022-03-09 10:55:54'),
(2, 'demo', 'demo.com', 'demo.com/demo', 1, '2022-02-28 09:03:07', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int(11) NOT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `base` int(11) DEFAULT NULL,
  `thumb` int(11) DEFAULT NULL,
  `small` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `msp` float NOT NULL,
  `costPrice` float NOT NULL,
  `quantity` int(5) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `sku`, `name`, `base`, `thumb`, `small`, `price`, `msp`, `costPrice`, `quantity`, `status`, `createdAt`, `updatedAt`) VALUES
(24, '', '2 bed', 31, 32, 31, 50, 0, 0, 5, 1, '2022-03-07 09:03:22', '2022-03-08 11:03:45'),
(25, NULL, 'Laptop i7', NULL, NULL, NULL, 25000, 22500, 21000, 25, 1, '2022-03-08 12:03:54', NULL),
(26, NULL, 'Laptop i7', NULL, NULL, NULL, 25000, 0, 0, 600, 1, '2022-03-08 10:03:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_media`
--

CREATE TABLE `product_media` (
  `mediaId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gallery` tinyint(1) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_media`
--

INSERT INTO `product_media` (`mediaId`, `productId`, `name`, `gallery`) VALUES
(31, 24, 'Stress-and-broken-heart-120220309121311.jpeg', 1),
(32, 24, 'file-20181102-83635-1jdo9u920220309121318.jpg', 1),
(33, 24, 'file-20181102-83635-1jdo9u920220309015441.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `salesman`
--

CREATE TABLE `salesman` (
  `salesmanId` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` bigint(10) DEFAULT NULL,
  `discount` float(5,2) DEFAULT 0.00,
  `status` tinyint(1) NOT NULL DEFAULT 2,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salesman`
--

INSERT INTO `salesman` (`salesmanId`, `firstName`, `lastName`, `email`, `mobile`, `discount`, `status`, `createdAt`, `updatedAt`) VALUES
(6, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 12.00, 1, '2022-03-09 01:48:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendorId` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` bigint(10) NOT NULL,
  `status` tinyint(1) DEFAULT 2,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendorId`, `firstName`, `lastName`, `email`, `mobile`, `status`, `createdAt`, `updatedAt`) VALUES
(7, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 2, '2022-03-04 09:43:59', '2022-03-04 10:09:45'),
(9, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-04 09:52:23', NULL),
(11, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-04 10:04:27', NULL),
(12, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-04 10:05:45', NULL),
(13, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-04 10:06:01', NULL),
(14, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-09 01:49:14', '2022-03-09 01:49:26'),
(15, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-09 01:50:48', NULL),
(16, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-09 01:51:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_address`
--

CREATE TABLE `vendor_address` (
  `addressId` int(11) NOT NULL,
  `vendorId` int(11) NOT NULL,
  `address` text NOT NULL,
  `postalCode` int(7) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor_address`
--

INSERT INTO `vendor_address` (`addressId`, `vendorId`, `address`, `postalCode`, `city`, `state`, `country`) VALUES
(10, 7, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India'),
(12, 9, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India'),
(13, 11, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India'),
(14, 12, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India'),
(15, 13, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India'),
(16, 14, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India'),
(17, 15, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India'),
(18, 16, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`),
  ADD KEY `base` (`base`),
  ADD KEY `small` (`small`),
  ADD KEY `thumb` (`thumb`),
  ADD KEY `categoryParent` (`parentId`);

--
-- Indexes for table `category_media`
--
ALTER TABLE `category_media`
  ADD PRIMARY KEY (`mediaId`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Indexes for table `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`entity_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`configId`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`),
  ADD KEY `salesmanId` (`salesmanId`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `address_ibfk_1` (`customerId`);

--
-- Indexes for table `customer_price`
--
ALTER TABLE `customer_price`
  ADD PRIMARY KEY (`entityId`),
  ADD KEY `customerId` (`customerId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`pageId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`),
  ADD KEY `base_product` (`base`),
  ADD KEY `thumb_product` (`thumb`),
  ADD KEY `small_product` (`small`);

--
-- Indexes for table `product_media`
--
ALTER TABLE `product_media`
  ADD PRIMARY KEY (`mediaId`),
  ADD KEY `media` (`productId`);

--
-- Indexes for table `salesman`
--
ALTER TABLE `salesman`
  ADD PRIMARY KEY (`salesmanId`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendorId`);

--
-- Indexes for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `vendorId` (`vendorId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` bigint(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `category_media`
--
ALTER TABLE `category_media`
  MODIFY `mediaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `category_product`
--
ALTER TABLE `category_product`
  MODIFY `entity_id` int(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `configId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `customer_price`
--
ALTER TABLE `customer_price`
  MODIFY `entityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `pageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `product_media`
--
ALTER TABLE `product_media`
  MODIFY `mediaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `salesman`
--
ALTER TABLE `salesman`
  MODIFY `salesmanId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `vendor_address`
--
ALTER TABLE `vendor_address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `base` FOREIGN KEY (`base`) REFERENCES `category_media` (`mediaId`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `categoryParent` FOREIGN KEY (`parentId`) REFERENCES `category` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `small` FOREIGN KEY (`small`) REFERENCES `category_media` (`mediaId`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `thumb` FOREIGN KEY (`thumb`) REFERENCES `category_media` (`mediaId`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `category_media`
--
ALTER TABLE `category_media`
  ADD CONSTRAINT `categoryId` FOREIGN KEY (`CategoryId`) REFERENCES `category` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category_product`
--
ALTER TABLE `category_product`
  ADD CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `salesmanId` FOREIGN KEY (`salesmanId`) REFERENCES `salesman` (`salesmanId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD CONSTRAINT `customer_address_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`) ON DELETE CASCADE;

--
-- Constraints for table `customer_price`
--
ALTER TABLE `customer_price`
  ADD CONSTRAINT `customerId` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productId` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `base_product` FOREIGN KEY (`base`) REFERENCES `product_media` (`mediaId`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `small_product` FOREIGN KEY (`small`) REFERENCES `product_media` (`mediaId`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `thumb_product` FOREIGN KEY (`thumb`) REFERENCES `product_media` (`mediaId`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `product_media`
--
ALTER TABLE `product_media`
  ADD CONSTRAINT `media` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD CONSTRAINT `vendorId` FOREIGN KEY (`vendorId`) REFERENCES `vendor` (`vendorId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
