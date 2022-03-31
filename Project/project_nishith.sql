-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2022 at 08:45 AM
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
(58, 'Dhruv', 'Prajapati', 'dp@gmail.com', 'ed2b1f468c5f915f3f1cf75d7068baae', 1, '2022-03-11 01:03:19', NULL),
(59, 'Jayveer', 'Jadeja', 'rj@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 1, '2022-03-25 11:03:08', '2022-03-26 05:03:24'),
(60, 'Nishith', 'Parmar', 'nishithparmar03@gmail.com', 'f4aee210c0ae3683d4d93d8fceb7eb8f', 1, '2022-03-26 23:02:44', '2022-03-26 18:32:16'),
(61, 'Dhanshree', 'Patel', 'dp@gmail.com', '95687afb5d9a2a9fa39038f991640b0c', 1, '2022-03-26 11:03:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `subTotal` float NOT NULL,
  `shippingMethod` int(11) NOT NULL,
  `shippingCharge` float NOT NULL,
  `paymentMethod` int(11) NOT NULL,
  `taxAmount` float NOT NULL,
  `discount` float NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 2,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cart_address`
--

CREATE TABLE `cart_address` (
  `addressId` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `postalCode` int(7) NOT NULL,
  `billing` tinyint(4) NOT NULL DEFAULT 2,
  `shipping` tinyint(4) NOT NULL DEFAULT 2,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `itemId` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `itemTotal` float NOT NULL,
  `discount` float NOT NULL DEFAULT 0,
  `quantity` int(11) NOT NULL,
  `tax` float NOT NULL,
  `taxAmount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(100, 'double bed', NULL, NULL, NULL, 1, '2022-03-09 01:03:08', '2022-03-09 03:03:58', NULL, '100'),
(107, 'Harsh', NULL, NULL, NULL, 1, '2022-03-09 05:03:48', NULL, NULL, '107'),
(108, 'Phone', NULL, NULL, NULL, 1, '2022-03-10 01:03:28', NULL, NULL, '108'),
(109, 'Phone', NULL, NULL, NULL, 1, '2022-03-10 01:03:18', NULL, NULL, '109');

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
(4, 'Google', 'google.com', 'www.google.com', 1, '2022-03-09 01:03:33'),
(5, 'Google', 'google.com', 'www.google.com', 1, '2022-03-12 03:03:33');

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
(122, 6, 'Nishith', 'kk', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-02-26 03:02:29', '2022-03-26 11:57:32'),
(151, 6, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-02-26 07:02:19', '2022-03-26 11:03:48'),
(152, 6, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-02 02:03:08', '2022-03-15 05:41:45'),
(155, 6, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-04 01:03:00', NULL),
(156, 6, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-04 01:03:03', '2022-03-04 01:19:30'),
(157, 6, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-08 11:03:15', '2022-03-15 05:42:28'),
(158, 6, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-09 01:03:24', NULL),
(159, 6, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-09 01:03:39', NULL),
(160, 6, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-09 01:03:53', '2022-03-14 09:43:12'),
(161, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-14 09:03:56', '2022-03-14 09:43:00'),
(162, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-14 09:03:26', NULL),
(163, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-14 09:03:04', '2022-03-14 09:42:43'),
(164, NULL, 'aaa', 'aaa', 'a@a.com', 1234, 1, '2022-03-15 11:03:07', '2022-03-15 11:51:00'),
(165, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-15 01:03:15', '2022-03-15 01:16:29'),
(166, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-15 06:03:02', '2022-03-15 06:20:10'),
(167, NULL, 'Priyanshi', 'lunavat', 'p@gmail.com', 5455465898, 1, '2022-03-23 07:03:29', NULL),
(168, NULL, 'Priyanshi', 'lunavat', 'p@gmail.com', 54545454545, 1, '2022-03-24 12:03:46', NULL),
(169, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-26 12:03:48', NULL),
(170, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-26 12:03:23', '2022-03-26 12:50:18'),
(171, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-26 12:03:58', NULL),
(172, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-26 01:03:58', NULL),
(173, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-26 01:03:03', NULL),
(174, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-26 01:03:48', NULL),
(175, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-26 01:03:27', NULL),
(176, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-26 01:03:15', NULL),
(177, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-26 01:03:19', NULL),
(178, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-26 10:03:04', NULL),
(179, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-26 10:03:31', NULL),
(180, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-26 10:03:31', NULL),
(181, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-26 10:03:42', NULL),
(182, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-26 10:03:41', NULL),
(183, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-26 10:03:56', NULL),
(184, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-26 10:03:55', NULL),
(185, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-26 11:03:25', NULL),
(186, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-26 11:03:55', NULL),
(187, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-26 11:03:44', NULL),
(188, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-26 11:03:16', NULL),
(189, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-26 11:03:58', NULL);

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
(29, 122, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 2, 1),
(32, 151, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 1, 1),
(33, 152, 'qknsdlnclasISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 1, 2),
(36, 155, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 1, 1),
(37, 156, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 1, 2),
(38, 157, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 1, 2),
(39, 158, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 1, 1),
(40, 159, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 1, 1),
(41, 160, '', 0, '', '', '', 2, 2),
(42, 162, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 1, 2),
(43, 162, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 2, 1),
(44, 163, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 1, 2),
(45, 163, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 2, 1),
(46, 161, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 1, 2),
(47, 161, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 2, 1),
(48, 160, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 1, 2),
(49, 160, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 2, 1),
(50, 164, 'b', 360002, 'RAJKOT', 'GUJARAT', 'India', 1, 2),
(51, 164, 'b', 360002, 'RAJKOT', 'GUJARAT', 'India', 2, 1),
(52, 165, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 1, 2),
(53, 165, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 2, 1),
(54, 152, 'qknsdlnclasISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 2, 1),
(55, 157, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 2, 1),
(56, 166, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 1, 2),
(57, 166, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 2, 1),
(59, 167, 'mgroad', 456265, 'dahod', 'gujarat', 'india', 1, 2),
(60, 167, 'mgroad', 456265, 'dahod', 'gujarat', 'india', 2, 1),
(62, 168, '', 0, '', '', '', 1, 2),
(63, 168, 'mgroad', 454545, 'dahod', 'gujarat', 'Los vagos', 2, 1),
(73, 183, '', 0, '', '', '', 1, 2),
(74, 184, '', 0, '', '', '', 1, 2),
(75, 184, '', 0, '', '', '', 2, 1),
(76, 122, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 1, 2),
(77, 188, '', 0, '', '', '', 1, 2),
(78, 188, '', 0, '', '', '', 2, 1),
(79, 189, '', 0, '', '', '', 1, 2),
(80, 189, '', 0, '', '', '', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_price`
--

CREATE TABLE `customer_price` (
  `entityId` int(11) NOT NULL,
  `customerId` int(11) DEFAULT NULL,
  `productId` int(11) NOT NULL,
  `price` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_address`
--

CREATE TABLE `order_address` (
  `addressId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` bigint(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `postalCode` bigint(6) NOT NULL,
  `billing` tinyint(1) NOT NULL DEFAULT 2,
  `shipping` tinyint(4) NOT NULL DEFAULT 2,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_address`
--

INSERT INTO `order_address` (`addressId`, `orderId`, `firstName`, `lastName`, `email`, `mobile`, `address`, `city`, `state`, `country`, `postalCode`, `billing`, `shipping`, `createdAt`) VALUES
(15, 25, 'aaa', 'aaa', 'a@a.com', 1234, 'b', 'RAJKOT', 'GUJARAT', 'India', 360002, 1, 2, '2022-03-23 16:09:29'),
(16, 25, 'aaa', 'aaa', 'a@a.com', 1234, 'b', 'RAJKOT', 'GUJARAT', 'India', 360002, 2, 1, '2022-03-23 16:09:29'),
(17, 26, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, '1ST FLOOR,NR. RADHAKRISHNNIVS', 'RAJKOT', 'GUJARAT', 'India', 360002, 1, 1, '2022-03-23 17:16:43'),
(18, 26, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, '1ST FLOOR,NR. RADHAKRISHNNIVS', 'RAJKOT', 'GUJARAT', 'India', 360002, 1, 1, '2022-03-23 17:16:43'),
(19, 27, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, '1ST FLOOR,NR. RADHAKRISHNNIVS', 'RAJKOT', 'GUJARAT', 'India', 360002, 1, 2, '2022-03-24 11:50:44'),
(20, 27, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, '1ST FLOOR,NR. RADHAKRISHNNIVS', 'RAJKOT', 'GUJARAT', 'India', 360002, 2, 1, '2022-03-24 11:50:44'),
(25, 36, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 'qknsdlnclasISHNNIVS', 'RAJKOT', 'GUJARAT', 'India', 360002, 1, 2, '2022-03-25 12:17:07'),
(26, 36, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 'qknsdlnclasISHNNIVS', 'RAJKOT', 'GUJARAT', 'India', 360002, 2, 1, '2022-03-25 12:17:07');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `itemId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `price` float NOT NULL,
  `discount` float DEFAULT NULL,
  `tax` float NOT NULL,
  `taxAmount` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`itemId`, `orderId`, `productId`, `name`, `sku`, `price`, `discount`, `tax`, `taxAmount`, `quantity`, `createdAt`) VALUES
(13, 25, 26, 'Laptop i7', NULL, 525000, NULL, 10, 52500, 21, '2022-03-23 16:09:29'),
(14, 25, 27, 'Laptop i15', NULL, 10500000, NULL, 10, 1050000, 21, '2022-03-23 16:09:29'),
(15, 26, 26, 'Laptop i7', NULL, 50000, 100, 10, 5000, 2, '2022-03-23 17:16:43'),
(16, 26, 27, 'Laptop i15', NULL, 100000, 100, 10, 10000, 2, '2022-03-23 17:16:43'),
(17, 27, 27, 'Laptop i15', NULL, 1150000, 1150, 10, 115000, 23, '2022-03-24 11:50:44');

-- --------------------------------------------------------

--
-- Table structure for table `order_record`
--

CREATE TABLE `order_record` (
  `orderId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `grandTotal` int(11) NOT NULL,
  `shippingId` int(11) NOT NULL,
  `shippingCharge` int(11) NOT NULL,
  `taxAmount` float NOT NULL,
  `discount` float NOT NULL,
  `paymentId` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_record`
--

INSERT INTO `order_record` (`orderId`, `customerId`, `firstName`, `lastName`, `email`, `mobile`, `grandTotal`, `shippingId`, `shippingCharge`, `taxAmount`, `discount`, `paymentId`, `state`, `status`, `createdAt`) VALUES
(25, 164, 'aaa', 'aaa', 'a@a.com', 1234, 12127600, 1, 100, 1102500, 0, 1, 1, 1, '2022-03-23 16:09:29'),
(26, 155, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 164850, 3, 50, 15000, 200, 4, 1, 1, '2022-03-23 17:16:43'),
(27, 159, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1265850, 3, 50, 115000, -800, 2, 1, 1, '2022-03-24 11:50:44'),
(36, 152, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1361900, 3, 50, 123900, 1050, 3, 1, 1, '2022-03-25 12:17:07');

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
(27, 'Page27', 'page27', 'page27', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'Page28', 'page28', 'page28', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'Page29', 'page29', 'page29', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'Page30', 'page30', 'page30', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'Page31', 'page31', 'page31', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'Page32', 'page32', 'page32', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'Page33', 'page33', 'page33', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'Page34', 'page34', 'page34', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'Page35', 'page35', 'page35', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'Page36', 'page36', 'page36', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'Page37', 'page37', 'page37', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'Page38', 'page38', 'page38', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'Page39', 'page39', 'page39', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'Page40', 'page40', 'page40', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'Page41', 'page41', 'page41', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'Page42', 'page42', 'page42', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'Page43', 'page43', 'page43', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'Page44', 'page44', 'page44', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'Page45', 'page45', 'page45', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'Page46', 'page46', 'page46', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'Page47', 'page47', 'page47', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'Page48', 'page48', 'page48', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'Page49', 'page49', 'page49', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 'Page50', 'page50', 'page50', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'Page51', 'page51', 'page51', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 'Page52', 'page52', 'page52', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 'Page53', 'page53', 'page53', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 'Page54', 'page54', 'page54', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 'Page55', 'page55', 'page55', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 'Page56', 'page56', 'page56', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 'Page57', 'page57', 'page57', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 'Page58', 'page58', 'page58', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 'Page59', 'page59', 'page59', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 'Page60', 'page60', 'page60', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 'Page61', 'page61', 'page61', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 'Page62', 'page62', 'page62', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 'Page63', 'page63', 'page63', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 'Page64', 'page64', 'page64', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 'Page65', 'page65', 'page65', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 'Page66', 'page66', 'page66', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 'Page67', 'page67', 'page67', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 'Page68', 'page68', 'page68', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 'Page69', 'page69', 'page69', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 'Page70', 'page70', 'page70', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 'Page71', 'page71', 'page71', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 'Page72', 'page72', 'page72', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 'Page73', 'page73', 'page73', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 'Page74', 'page74', 'page74', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 'Page75', 'page75', 'page75', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 'Page76', 'page76', 'page76', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 'Page77', 'page77', 'page77', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 'Page78', 'page78', 'page78', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 'Page79', 'page79', 'page79', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 'Page80', 'page80', 'page80', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 'Page81', 'page81', 'page81', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 'Page82', 'page82', 'page82', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, 'Page83', 'page83', 'page83', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, 'Page84', 'page84', 'page84', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(85, 'Page85', 'page85', 'page85', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(86, 'Page86', 'page86', 'page86', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(87, 'Page87', 'page87', 'page87', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(88, 'Page88', 'page88', 'page88', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(89, 'Page89', 'page89', 'page89', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(90, 'Page90', 'page90', 'page90', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(91, 'Page91', 'page91', 'page91', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(92, 'Page92', 'page92', 'page92', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(93, 'Page93', 'page93', 'page93', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(94, 'Page94', 'page94', 'page94', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(95, 'Page95', 'page95', 'page95', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96, 'Page96', 'page96', 'page96', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(97, 'Page97', 'page97', 'page97', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(98, 'Page98', 'page98', 'page98', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(99, 'Page99', 'page99', 'page99', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(176, 'Page176', 'page176', 'page176', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(177, 'Page177', 'page177', 'page177', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(178, 'Page178', 'page178', 'page178', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(179, 'Page179', 'page179', 'page179', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(180, 'Page180', 'page180', 'page180', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(181, 'Page181', 'page181', 'page181', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(182, 'Page182', 'page182', 'page182', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(183, 'Page183', 'page183', 'page183', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(184, 'Page184', 'page184', 'page184', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(185, 'Page185', 'page185', 'page185', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(186, 'Page186', 'page186', 'page186', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(187, 'Page187', 'page187', 'page187', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(188, 'Page188', 'page188', 'page188', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(189, 'Page189', 'page189', 'page189', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(190, 'Page190', 'page190', 'page190', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(191, 'Page191', 'page191', 'page191', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(192, 'Page192', 'page192', 'page192', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(193, 'Page193', 'page193', 'page193', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(194, 'Page194', 'page194', 'page194', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `methodId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`methodId`, `name`) VALUES
(1, 'Card Payment (Credit/Debit Card)'),
(2, 'UPI'),
(3, 'QR'),
(4, 'Case On Delivery');

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
  `tax` float NOT NULL,
  `discount` float NOT NULL,
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

INSERT INTO `product` (`productId`, `sku`, `name`, `base`, `thumb`, `small`, `price`, `tax`, `discount`, `msp`, `costPrice`, `quantity`, `status`, `createdAt`, `updatedAt`) VALUES
(26, NULL, 'Laptop', 41, 41, 41, 59000, 10, 50, 45000, 18500, 533, 1, '2022-03-08 10:03:07', '2022-03-24 12:03:27'),
(27, NULL, 'mobile', 42, 42, 42, 42000, 10, 50, 40000, 35000, 567, 1, '2022-03-09 09:03:56', '2022-03-24 12:03:47');

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
(41, 26, 'istockphoto-1294325987-170667a20220324124023.jpg', 1),
(42, 27, 'SPARK8T-blue20220324124121.png', 1);

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
(6, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 12.00, 1, '2022-03-09 01:48:44', NULL),
(7, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 12.00, 1, '2022-03-12 09:37:53', NULL),
(8, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(9, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(10, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(11, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(12, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(13, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(14, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(15, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(16, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(17, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(18, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(19, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(20, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(21, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(22, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(23, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(24, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(25, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(26, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(27, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(28, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(29, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(30, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(31, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(32, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(33, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(34, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(35, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(36, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(37, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(38, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(39, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(40, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(41, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(42, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(43, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(44, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(45, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(46, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(47, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(48, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(49, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(50, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(51, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(52, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(53, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(54, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(55, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(56, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(57, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(58, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(59, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(60, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(61, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(62, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(63, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(64, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(65, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(66, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(67, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(68, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(69, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(70, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(71, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(72, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(73, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(74, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(75, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(76, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(77, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(78, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(79, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(80, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(81, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(82, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(83, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(84, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(85, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(86, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(87, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(88, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(89, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(90, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(91, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(92, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(93, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(94, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(95, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(96, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(97, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(98, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(99, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(100, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(101, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(102, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(103, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(104, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(105, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(106, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(107, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(108, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(109, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(110, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(111, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(112, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(113, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(114, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(115, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(116, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(117, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(118, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(119, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(120, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(121, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(122, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(123, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(124, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(125, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(126, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(127, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(128, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(129, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(130, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(131, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(132, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(133, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(134, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(135, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(136, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(137, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(138, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(139, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(140, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(141, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(142, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(143, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(144, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(145, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(146, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(147, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(148, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(149, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(150, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(151, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(152, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(153, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(154, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(155, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(156, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(157, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(158, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(159, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(160, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(161, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(162, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(163, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(164, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(165, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(166, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(167, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(168, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(169, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(170, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(171, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(172, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(173, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(174, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(175, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(176, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(177, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(178, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(179, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(180, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(181, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(182, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(183, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(184, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(185, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(186, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(187, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(188, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(189, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(190, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(191, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(192, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(193, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(194, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(195, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(196, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(197, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(198, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(199, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(200, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(201, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(202, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(203, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(204, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(205, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(206, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(207, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(208, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(209, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(210, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(211, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(212, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(213, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(214, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(215, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(216, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(217, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(218, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(219, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(220, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(221, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(222, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(223, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(224, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(225, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(226, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(227, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(228, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(229, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(230, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(231, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(232, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(233, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(234, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(235, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(236, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(237, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(238, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(239, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(240, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(241, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(242, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(243, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(244, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(245, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(246, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(247, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(248, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(249, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(250, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(251, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(252, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(253, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(254, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(255, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(256, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(257, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(258, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(259, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(260, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(261, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(262, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(263, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(264, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(265, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(266, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(267, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(268, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(269, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(270, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(271, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(272, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(273, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(274, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(275, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(276, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(277, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(278, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(279, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(280, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(281, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(282, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(283, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(284, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(285, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(286, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(287, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(288, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(289, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(290, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(291, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(292, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(293, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(294, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(295, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(296, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(297, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(298, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(299, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(300, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(301, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(302, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(303, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(304, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(305, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(306, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(307, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(308, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(309, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(310, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(311, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(312, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(313, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(314, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(315, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(316, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(317, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(318, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(319, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(320, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(321, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(322, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(323, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(324, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(325, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(326, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(327, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(328, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(329, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(330, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(331, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(332, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(333, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(334, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(335, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(336, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(337, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(338, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(339, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(340, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(341, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(342, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(343, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(344, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(345, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(346, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(347, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(348, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(349, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(350, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(351, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(352, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(353, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(354, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(355, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(356, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(357, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(358, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(359, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(360, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(361, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(362, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(363, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(364, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(365, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(366, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(367, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(368, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(369, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(370, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(371, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(372, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(373, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(374, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(375, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(376, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(377, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(378, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(379, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(380, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(381, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(382, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(383, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(384, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(385, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(386, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(387, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(388, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(389, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(390, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(391, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(392, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(393, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(394, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(395, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(396, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(397, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(398, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(399, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(400, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(401, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(402, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(403, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(404, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(405, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(406, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(407, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(408, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(409, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(410, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(411, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(412, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(413, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(414, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(415, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(416, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(417, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(418, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(419, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_method`
--

CREATE TABLE `shipping_method` (
  `methodId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `charge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping_method`
--

INSERT INTO `shipping_method` (`methodId`, `name`, `charge`) VALUES
(1, 'Same Day Delivery', 100),
(2, 'Express Delivery', 70),
(3, 'Normal Delivery', 50);

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
(16, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-09 01:51:08', NULL),
(17, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-15 06:23:40', '2022-03-15 06:26:42');

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
(18, 16, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India'),
(20, 17, ' ', 0, ' ', ' ', ' ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartId`),
  ADD KEY `customerId_from_customer` (`customerId`);

--
-- Indexes for table `cart_address`
--
ALTER TABLE `cart_address`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `cartId_from_cart` (`cartId`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`itemId`),
  ADD KEY `productId_from_product` (`productId`),
  ADD KEY `cartId` (`cartId`);

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
-- Indexes for table `order_address`
--
ALTER TABLE `order_address`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `orderId` (`orderId`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`itemId`),
  ADD KEY `productId` (`productId`),
  ADD KEY `orderId` (`orderId`);

--
-- Indexes for table `order_record`
--
ALTER TABLE `order_record`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `customerId` (`customerId`),
  ADD KEY `shippingId` (`shippingId`),
  ADD KEY `paymentId` (`paymentId`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`pageId`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`methodId`);

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
-- Indexes for table `shipping_method`
--
ALTER TABLE `shipping_method`
  ADD PRIMARY KEY (`methodId`);

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
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `cart_address`
--
ALTER TABLE `cart_address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` bigint(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `category_media`
--
ALTER TABLE `category_media`
  MODIFY `mediaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `category_product`
--
ALTER TABLE `category_product`
  MODIFY `entity_id` int(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `configId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `customer_price`
--
ALTER TABLE `customer_price`
  MODIFY `entityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `order_address`
--
ALTER TABLE `order_address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `order_record`
--
ALTER TABLE `order_record`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `pageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `methodId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `product_media`
--
ALTER TABLE `product_media`
  MODIFY `mediaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `salesman`
--
ALTER TABLE `salesman`
  MODIFY `salesmanId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=420;

--
-- AUTO_INCREMENT for table `shipping_method`
--
ALTER TABLE `shipping_method`
  MODIFY `methodId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `vendor_address`
--
ALTER TABLE `vendor_address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `customerId_from_customer` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart_address`
--
ALTER TABLE `cart_address`
  ADD CONSTRAINT `cartId_from_cart` FOREIGN KEY (`cartId`) REFERENCES `cart` (`cartId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `cart_item_ibfk_1` FOREIGN KEY (`cartId`) REFERENCES `cart` (`cartId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productId_from_product` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `salesmanId` FOREIGN KEY (`salesmanId`) REFERENCES `salesman` (`salesmanId`) ON DELETE SET NULL ON UPDATE CASCADE;

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
-- Constraints for table `order_address`
--
ALTER TABLE `order_address`
  ADD CONSTRAINT `order_address_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `order_record` (`orderId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`orderId`) REFERENCES `order_record` (`orderId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_record`
--
ALTER TABLE `order_record`
  ADD CONSTRAINT `order_record_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_record_ibfk_2` FOREIGN KEY (`shippingId`) REFERENCES `shipping_method` (`methodId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_record_ibfk_3` FOREIGN KEY (`paymentId`) REFERENCES `payment_method` (`methodId`) ON DELETE CASCADE ON UPDATE CASCADE;

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
