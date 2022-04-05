-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2022 at 09:12 AM
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
(61, 'Dhanshree2', 'P', 'dp@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 1, '2022-03-26 11:03:29', '2022-04-04 07:04:03'),
(65, 'Nishith', 'Parmar', 'nishithparmar03@gmail.com', 'f4aee210c0ae3683d4d93d8fceb7eb8f', 1, '2022-04-01 11:01:26', '2022-04-01 07:31:03'),
(67, 'Dhanshree1', 'P', 'dp@gmail.com', '', 1, '2022-04-01 01:04:21', NULL),
(69, 'Tusahr', 'Solanki', 'ts@gmail.com', 'ed2b1f468c5f915f3f1cf75d7068baae', 1, '2022-04-02 03:04:30', NULL),
(74, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 'f4aee210c0ae3683d4d93d8fceb7eb8f', 1, '2022-04-04 07:04:58', NULL),
(75, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 'f4aee210c0ae3683d4d93d8fceb7eb8f', 1, '2022-04-04 07:04:04', NULL),
(76, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 'f4aee210c0ae3683d4d93d8fceb7eb8f', 1, '2022-04-04 07:04:13', NULL);

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

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartId`, `customerId`, `subTotal`, `shippingMethod`, `shippingCharge`, `paymentMethod`, `taxAmount`, `discount`, `status`, `createdAt`, `updatedAt`) VALUES
(132, 166, 0, 0, 0, 0, 0, 0, 1, '0000-00-00 00:00:00', NULL),
(133, 201, 0, 0, 0, 0, 0, 0, 1, '0000-00-00 00:00:00', NULL),
(134, 199, 2006000, 3, 50, 2, 64900, 550, 1, '0000-00-00 00:00:00', NULL),
(136, 188, 0, 0, 0, 0, 0, 0, 1, '0000-00-00 00:00:00', NULL),
(137, 191, 0, 0, 0, 0, 0, 0, 1, '0000-00-00 00:00:00', NULL);

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

--
-- Dumping data for table `cart_address`
--

INSERT INTO `cart_address` (`addressId`, `cartId`, `firstName`, `lastName`, `city`, `state`, `country`, `postalCode`, `billing`, `shipping`, `address`) VALUES
(219, 132, 'Nishith', 'parmar', 'RAJKOT', 'GUJARAT', 'India', 360002, 1, 2, '1ST FLOOR,NR. RADHAKRISHNNIVS'),
(220, 132, 'Nishith', 'parmar', 'RAJKOT', 'GUJARAT', 'India', 360002, 2, 1, '1ST FLOOR,NR. RADHAKRISHNNIVS'),
(221, 133, 'Nishith', 'parmar', 'RAJKOT', 'GUJARAT', 'India', 360002, 1, 2, '1ST FLOOR,NR. RADHAKRISHNNIVS'),
(222, 133, 'Nishith', 'parmar', 'RAJKOT', 'GUJARAT', 'India', 360002, 2, 1, '1ST FLOOR,NR. RADHAKRISHNNIVS'),
(223, 134, 'Nishith', 'parmar', 'RAJKOT', 'GUJARAT', 'India', 360002, 1, 2, '1ST FLOOR,NR. RADHAKRISHNNIVS'),
(224, 134, 'Nishith', 'parmar', 'RAJKOT', 'GUJARAT', 'India', 360002, 2, 1, '1ST FLOOR,NR. RADHAKRISHNNIVS'),
(227, 136, 'Nishith', 'parmar', '', '', '', 0, 1, 2, ''),
(228, 136, 'Nishith', 'parmar', '', '', '', 0, 2, 1, ''),
(229, 137, 'Nishith', 'parmar', '', '', '', 0, 1, 2, ''),
(230, 137, 'Nishith', 'parmar', '', '', '', 0, 2, 1, '');

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

--
-- Dumping data for table `cart_item`
--

INSERT INTO `cart_item` (`itemId`, `cartId`, `productId`, `itemTotal`, `discount`, `quantity`, `tax`, `taxAmount`) VALUES
(128, 134, 26, 649000, 550, 11, 10, 64900);

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
(100, 'double bed', 39, 39, 39, 1, '2022-03-09 01:03:08', '2022-03-09 03:03:58', NULL, '100'),
(115, 'home theater', NULL, NULL, NULL, 1, '2022-04-03 11:04:56', NULL, NULL, '115'),
(116, 'Phone', NULL, NULL, NULL, 1, '2022-04-03 11:04:02', '2022-04-04 10:04:19', NULL, '116');

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
(39, 100, '_DSC045620220331104126.jpg', 1),
(42, 115, 'SPARK8T-blue20220403115409.png', 0),
(43, 116, 'SPARK8T-blue20220404105230.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category_product`
--

CREATE TABLE `category_product` (
  `entityId` int(24) NOT NULL,
  `productId` int(24) NOT NULL,
  `categoryId` bigint(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_product`
--

INSERT INTO `category_product` (`entityId`, `productId`, `categoryId`) VALUES
(37, 26, 100),
(46, 26, 115);

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
(2, 'Google1', 'google.com', 'www.google.com', 1, '2022-02-28 08:02:30'),
(3, 'Google', 'google.com', 'www.google.comfacebook', 1, '2022-02-28 08:02:48'),
(4, 'Google', 'google.com', 'www.google.com', 1, '2022-03-09 01:03:33'),
(5, 'Google', 'google.com', 'www.google.com', 1, '2022-03-12 03:03:33'),
(6, 'Facebook', 'google.com', 'www.google.comfacebook', 1, '2022-04-01 07:04:25');

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
(166, 19, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-15 06:03:02', '2022-04-04 06:55:29'),
(167, 19, 'Priyanshi', 'lunavat', 'p@gmail.com', 5455465898, 1, '2022-03-23 07:03:29', NULL),
(168, 19, 'Priyanshi', 'lunavat', 'p@gmail.com', 54545454545, 1, '2022-03-24 12:03:46', NULL),
(188, 19, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-26 11:03:16', NULL),
(189, 19, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-26 11:03:58', NULL),
(190, 19, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-29 11:03:33', NULL),
(191, 19, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-29 11:03:04', NULL),
(192, 19, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-29 11:03:43', NULL),
(195, 19, 'ASasas', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-29 12:03:44', NULL),
(196, 19, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-31 01:03:23', NULL),
(197, 19, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-31 01:03:24', NULL),
(198, 19, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-31 01:03:24', NULL),
(199, 19, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-31 01:03:22', NULL),
(200, 19, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-31 01:03:22', NULL),
(201, 19, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-31 01:03:22', NULL),
(202, 19, '', '', '', NULL, 1, '2022-03-31 01:03:58', NULL),
(203, 19, '', '', '', NULL, 1, '2022-03-31 01:03:26', NULL),
(204, 19, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-31 01:03:23', NULL),
(205, 26, '', '', '', NULL, 1, '2022-03-31 01:03:12', NULL),
(206, 26, '', '', '', NULL, 1, '2022-03-31 01:03:36', NULL),
(207, 19, '', '', '', NULL, 1, '2022-03-31 01:03:01', NULL),
(208, 19, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-31 01:03:19', NULL),
(209, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-31 01:03:28', NULL),
(210, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-31 01:03:12', NULL),
(211, NULL, '', '', '', NULL, 1, '2022-03-31 01:03:52', NULL),
(212, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-31 01:03:52', NULL),
(213, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-31 01:03:11', NULL),
(214, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-31 01:03:12', NULL),
(215, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-31 01:03:12', NULL),
(216, NULL, '', '', '', NULL, 1, '2022-03-31 01:03:02', NULL),
(217, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-31 01:03:34', NULL),
(218, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-31 01:03:42', NULL),
(219, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-31 01:03:43', NULL),
(220, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-31 01:03:43', NULL),
(221, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-31 01:03:46', NULL),
(222, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-31 01:03:25', NULL),
(223, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-31 01:03:01', NULL),
(224, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-31 01:03:19', NULL),
(225, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-31 01:03:29', NULL),
(226, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-31 01:03:30', NULL),
(227, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-31 01:03:30', NULL),
(228, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-31 01:03:44', NULL),
(229, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-31 01:03:35', NULL),
(230, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-31 01:03:04', NULL),
(231, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-31 01:03:52', NULL),
(239, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-31 09:03:10', NULL),
(240, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-31 12:03:45', NULL),
(241, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-31 12:03:16', NULL),
(242, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-31 01:03:48', NULL),
(243, NULL, 'Nikkki', 'kapadiya', 'nl@gmail.com', 2920192019, 1, '2022-04-01 10:04:14', NULL),
(244, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-04-02 01:04:29', NULL),
(245, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-04-02 02:04:25', NULL),
(246, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-04-04 10:04:52', NULL),
(247, NULL, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-04-04 10:04:18', NULL);

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
(56, 166, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 1, 2),
(57, 166, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 2, 1),
(59, 167, 'mgroad', 456265, 'dahod', 'gujarat', 'india', 1, 2),
(60, 167, 'mgroad', 456265, 'dahod', 'gujarat', 'india', 2, 1),
(62, 168, '', 0, '', '', '', 1, 2),
(63, 168, 'mgroad', 454545, 'dahod', 'gujarat', 'Los vagos', 2, 1),
(77, 188, '', 0, '', '', '', 1, 2),
(78, 188, '', 0, '', '', '', 2, 1),
(79, 189, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 1, 2),
(80, 189, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 2, 1),
(81, 190, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 1, 2),
(82, 190, '', 0, '', '', '', 2, 1),
(83, 191, '', 0, '', '', '', 1, 2),
(84, 191, '', 0, '', '', '', 2, 1),
(85, 192, '', 0, '', '', '', 1, 2),
(86, 192, '', 0, '', '', '', 2, 1),
(88, 195, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 1, 2),
(89, 195, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 2, 1),
(90, 196, '', 0, '', '', '', 1, 2),
(91, 196, '', 0, '', '', '', 2, 1),
(92, 197, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 1, 2),
(93, 197, '', 0, '', '', '', 2, 1),
(94, 198, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 1, 2),
(95, 198, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 2, 1),
(96, 199, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 1, 2),
(97, 199, '', 0, '', '', '', 2, 1),
(98, 200, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 1, 2),
(99, 200, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 2, 1),
(100, 201, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 1, 2),
(101, 201, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 2, 1),
(102, 202, '', 0, '', '', '', 1, 2),
(103, 202, '', 0, '', '', '', 2, 1),
(104, 203, '', 0, '', '', '', 1, 2),
(105, 203, '', 0, '', '', '', 2, 1),
(106, 204, '', 0, '', '', '', 1, 2),
(107, 204, '', 0, '', '', '', 2, 1),
(108, 205, '', 0, '', '', '', 1, 2),
(109, 205, '', 0, '', '', '', 2, 1),
(110, 206, '', 0, '', '', '', 1, 2),
(111, 206, '', 0, '', '', '', 2, 1),
(112, 207, '', 0, '', '', '', 1, 2),
(113, 207, '', 0, '', '', '', 2, 1),
(114, 208, '', 0, '', '', '', 1, 2),
(115, 208, '', 0, '', '', '', 2, 1),
(116, 209, '', 0, '', '', '', 1, 2),
(117, 209, '', 0, '', '', '', 2, 1),
(118, 210, '', 0, '', '', '', 1, 2),
(119, 210, '', 0, '', '', '', 2, 1),
(120, 211, '', 0, '', '', '', 1, 2),
(121, 211, '', 0, '', '', '', 2, 1),
(122, 212, '', 0, '', '', '', 1, 2),
(123, 212, '', 0, '', '', '', 2, 1),
(124, 213, '', 0, '', '', '', 1, 2),
(125, 213, '', 0, '', '', '', 2, 1),
(126, 214, '', 0, '', '', '', 1, 2),
(127, 214, '', 0, '', '', '', 2, 1),
(128, 215, '', 0, '', '', '', 1, 2),
(129, 215, '', 0, '', '', '', 2, 1),
(130, 216, '', 0, '', '', '', 1, 2),
(131, 216, '', 0, '', '', '', 2, 1),
(132, 217, '', 0, '', '', '', 1, 2),
(133, 217, '', 0, '', '', '', 2, 1),
(134, 218, '', 0, '', '', '', 1, 2),
(135, 218, '', 0, '', '', '', 2, 1),
(136, 219, '', 0, '', '', '', 1, 2),
(137, 219, '', 0, '', '', '', 2, 1),
(138, 220, '', 0, '', '', '', 1, 2),
(139, 220, '', 0, '', '', '', 2, 1),
(140, 221, '', 0, '', '', '', 1, 2),
(141, 221, '', 0, '', '', '', 2, 1),
(142, 222, '', 0, '', '', '', 1, 2),
(143, 222, '', 0, '', '', '', 2, 1),
(144, 223, '', 0, '', '', '', 1, 2),
(145, 223, '', 0, '', '', '', 2, 1),
(146, 224, '', 0, '', '', '', 1, 2),
(147, 224, '', 0, '', '', '', 2, 1),
(148, 225, '', 0, '', '', '', 1, 2),
(149, 225, '', 0, '', '', '', 2, 1),
(150, 226, '', 0, '', '', '', 1, 2),
(151, 226, '', 0, '', '', '', 2, 1),
(152, 227, '', 0, '', '', '', 1, 2),
(153, 227, '', 0, '', '', '', 2, 1),
(154, 228, '', 0, '', '', '', 1, 2),
(155, 228, '', 0, '', '', '', 2, 1),
(156, 229, '', 0, '', '', '', 1, 2),
(157, 229, '', 0, '', '', '', 2, 1),
(158, 230, '', 0, '', '', '', 1, 2),
(159, 230, '', 0, '', '', '', 2, 1),
(160, 231, '', 0, '', '', '', 1, 2),
(161, 231, '', 0, '', '', '', 2, 1),
(177, 239, '', 0, '', '', '', 1, 2),
(178, 239, '', 0, '', '', '', 2, 1),
(179, 240, '', 0, '', '', '', 1, 2),
(180, 240, '', 0, '', '', '', 2, 1),
(181, 241, '', 0, '', '', '', 1, 2),
(182, 241, '', 0, '', '', '', 2, 1),
(183, 242, '', 0, '', '', '', 1, 2),
(184, 242, '', 0, '', '', '', 2, 1),
(185, 243, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India', 1, 2),
(186, 243, '', 0, '', '', '', 2, 1),
(187, 244, '', 0, '', '', '', 1, 2),
(188, 244, '', 0, '', '', '', 2, 1),
(189, 245, '', 0, '', '', '', 1, 2),
(190, 245, '', 0, '', '', '', 2, 1),
(191, 246, '', 0, '', '', '', 1, 2),
(192, 246, '', 0, '', '', '', 2, 1),
(193, 247, '', 0, '', '', '', 1, 2),
(194, 247, '', 0, '', '', '', 2, 1);

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
(29, 38, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, '1ST FLOOR,NR. RADHAKRISHNNIVS', 'RAJKOT', 'GUJARAT', 'India', 360002, 1, 2, '2022-04-04 00:59:43'),
(30, 38, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, '1ST FLOOR,NR. RADHAKRISHNNIVS', 'RAJKOT', 'GUJARAT', 'India', 360002, 2, 1, '2022-04-04 00:59:43'),
(31, 39, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, '1ST FLOOR,NR. RADHAKRISHNNIVS', 'RAJKOT', 'GUJARAT', 'India', 360002, 1, 2, '2022-04-04 01:01:31'),
(32, 39, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, '1ST FLOOR,NR. RADHAKRISHNNIVS', 'RAJKOT', 'GUJARAT', 'India', 360002, 2, 1, '2022-04-04 01:01:31'),
(33, 40, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, '', '', '', '', 0, 1, 2, '2022-04-04 12:38:26'),
(34, 40, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, '', '', '', '', 0, 2, 1, '2022-04-04 12:38:26'),
(39, 43, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, '1ST FLOOR,NR. RADHAKRISHNNIVS', 'RAJKOT', 'GUJARAT', 'India', 360002, 1, 2, '2022-04-04 23:07:19'),
(40, 43, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, '1ST FLOOR,NR. RADHAKRISHNNIVS', 'RAJKOT', 'GUJARAT', 'India', 360002, 2, 1, '2022-04-04 23:07:19'),
(41, 44, 'Priyanshi', 'lunavat', 'p@gmail.com', 5455465898, 'mgroad', 'dahod', 'gujarat', 'india', 456265, 1, 2, '2022-04-05 12:32:37'),
(42, 44, 'Priyanshi', 'lunavat', 'p@gmail.com', 5455465898, 'mgroad', 'dahod', 'gujarat', 'india', 456265, 2, 1, '2022-04-05 12:32:37');

-- --------------------------------------------------------

--
-- Table structure for table `order_comment`
--

CREATE TABLE `order_comment` (
  `commentId` int(24) NOT NULL,
  `orderId` int(24) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `note` varchar(255) NOT NULL,
  `customerNotified` tinyint(1) NOT NULL DEFAULT 2,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_comment`
--

INSERT INTO `order_comment` (`commentId`, `orderId`, `status`, `note`, `customerNotified`, `createdAt`) VALUES
(2, 40, 1, 'w2w2w2w', 1, '0000-00-00 00:00:00'),
(3, 43, 4, 'jalsa kar baka', 1, '0000-00-00 00:00:00');

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
(22, 38, 26, 'Laptop', NULL, 649000, 50, 10, 64900, 11, '2022-04-04 00:59:43'),
(23, 39, 26, 'Laptop', NULL, 6549000, 50, 10, 654900, 111, '2022-04-04 01:01:31'),
(24, 39, 26, 'Laptop', NULL, 6549000, 50, 10, 654900, 111, '2022-04-04 01:01:31'),
(25, 39, 26, 'Laptop', NULL, 6549000, 50, 10, 654900, 111, '2022-04-04 01:01:31'),
(26, 39, 26, 'Laptop', NULL, 6549000, 50, 10, 654900, 111, '2022-04-04 01:01:31'),
(27, 39, 26, 'Laptop', NULL, 6549000, 50, 10, 654900, 111, '2022-04-04 01:01:31'),
(28, 40, 26, 'Laptop', NULL, 649000, 50, 10, 64900, 11, '2022-04-04 12:38:26'),
(31, 43, 26, 'Laptop', NULL, 7198000, 50, 10, 719800, 122, '2022-04-04 23:07:19'),
(32, 43, 27, 'mobile', NULL, 5082000, 50, 10, 508200, 121, '2022-04-04 23:07:19'),
(33, 44, 26, 'Laptop', NULL, 649000, 50, 10, 64900, 11, '2022-04-05 12:32:36');

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
(38, 200, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 0, 1, 100, 0, 0, 1, 1, 1, '2022-04-04 00:59:43'),
(39, 190, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 0, 2, 70, 0, 0, 1, 1, 1, '2022-04-04 01:01:31'),
(40, 188, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 0, 3, 50, 0, 0, 2, 1, 1, '2022-04-04 12:38:26'),
(43, 189, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 13495950, 1, 100, 1228000, 12150, 1, 1, 4, '2022-04-04 23:07:19'),
(44, 167, 'Priyanshi', 'lunavat', 'p@gmail.com', 5455465898, 713420, 2, 70, 64900, 550, 2, 1, 1, '2022-04-05 12:32:36');

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
(47, 'Page47', 'page47', 'page47', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
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
(214, 'demo', 'demo.com', 'demo.com/demo', 1, '2022-03-30 12:51:12', '0000-00-00 00:00:00'),
(215, 'demo', 'demo.com', 'demo.com/demo', 1, '2022-03-30 12:51:19', '0000-00-00 00:00:00'),
(216, 'demo', 'demo.com', 'wwew', 1, '2022-04-02 03:46:42', '2022-04-02 03:47:02'),
(217, 'demo', 'demo.com', 'qwubcub', 1, '2022-04-02 03:47:24', '0000-00-00 00:00:00'),
(218, 'demo', 'demo.com', 'demo.com/demo', 1, '2022-04-04 10:56:46', '0000-00-00 00:00:00');

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
(26, NULL, 'Laptop', 46, 46, 46, 59000, 10, 50, 45000, 18500, 533, 1, '2022-03-08 10:03:07', '2022-03-24 12:03:27'),
(27, NULL, 'mobile', 42, 42, 42, 42000, 10, 50, 40000, 35000, 567, 1, '2022-03-09 09:03:56', '2022-03-24 12:03:47'),
(29, 'sas', 'Oven', NULL, NULL, NULL, 25000, 10, 105, 22500, 21000, 545, 1, '2022-04-03 07:57:01', NULL);

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
(42, 27, 'SPARK8T-blue20220324124121.png', 1),
(43, 27, 'convo20220403031448.png', 2),
(46, 26, 'SPARK8T-blue20220403075257.png', 1);

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
(19, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(20, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(21, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(22, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(23, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(24, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(25, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(26, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(28, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(29, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(30, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
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
(413, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', '2022-03-29 11:44:51'),
(414, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(415, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(416, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(417, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(418, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(419, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919410000000, 12.00, 1, '0000-00-00 00:00:00', NULL),
(420, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 12.00, 1, '2022-03-29 11:43:32', NULL),
(421, 'Priyanshi', 'Lunawat', 'pr@gmail.com', 4545454545, -1.00, 1, '2022-04-02 11:19:45', '2022-04-02 11:20:00'),
(422, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', NULL, 12.00, 1, '2022-04-04 10:57:25', NULL);

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
(13, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-04 10:06:01', NULL),
(14, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-09 01:49:14', '2022-03-09 01:49:26'),
(15, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-09 01:50:48', NULL),
(16, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-09 01:51:08', NULL),
(17, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-03-15 06:23:40', '2022-03-15 06:26:42'),
(18, 'Nishith1', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-04-02 04:04:07', '2022-04-02 04:50:23'),
(19, 'Nishith', 'parmar', 'nishithparmar03@gmail.com', 919409718566, 1, '2022-04-04 11:04:58', NULL);

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
(15, 13, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India'),
(16, 14, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India'),
(17, 15, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India'),
(18, 16, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India'),
(20, 17, ' ', 0, ' ', ' ', ' '),
(21, 18, '1ST FLOOR,NR. RADHAKRISHNNIVS', 360002, 'RAJKOT', 'GUJARAT', 'India'),
(22, 19, '', 0, '', '', '');

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
  ADD PRIMARY KEY (`entityId`),
  ADD KEY `product_id` (`productId`),
  ADD KEY `category_id` (`categoryId`);

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
-- Indexes for table `order_comment`
--
ALTER TABLE `order_comment`
  ADD PRIMARY KEY (`commentId`),
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
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `cart_address`
--
ALTER TABLE `cart_address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` bigint(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `category_media`
--
ALTER TABLE `category_media`
  MODIFY `mediaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `category_product`
--
ALTER TABLE `category_product`
  MODIFY `entityId` int(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `configId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT for table `customer_price`
--
ALTER TABLE `customer_price`
  MODIFY `entityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `order_address`
--
ALTER TABLE `order_address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `order_comment`
--
ALTER TABLE `order_comment`
  MODIFY `commentId` int(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `order_record`
--
ALTER TABLE `order_record`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `pageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `methodId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `product_media`
--
ALTER TABLE `product_media`
  MODIFY `mediaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `salesman`
--
ALTER TABLE `salesman`
  MODIFY `salesmanId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=423;

--
-- AUTO_INCREMENT for table `shipping_method`
--
ALTER TABLE `shipping_method`
  MODIFY `methodId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `vendor_address`
--
ALTER TABLE `vendor_address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
  ADD CONSTRAINT `category_id` FOREIGN KEY (`categoryId`) REFERENCES `category` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_id` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `order_comment`
--
ALTER TABLE `order_comment`
  ADD CONSTRAINT `order_comment_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `order_record` (`orderId`) ON DELETE CASCADE ON UPDATE CASCADE;

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
