-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 31, 2019 at 05:17 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `autohubb`
--
DROP DATABASE IF EXISTS `autohubb`;
CREATE DATABASE IF NOT EXISTS `autohubb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `autohubb`;

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--
-- Creation: Apr 30, 2019 at 01:10 PM
--

DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE IF NOT EXISTS `admin_user` (
  `admin_id` int(20) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(50) DEFAULT NULL,
  `admin_fname` varchar(50) DEFAULT NULL,
  `admin_lname` varchar(50) DEFAULT NULL,
  `admin_email` varchar(100) DEFAULT NULL,
  `admin_password` varchar(200) DEFAULT NULL,
  `admin_phone` varchar(20) DEFAULT NULL,
  `admin_country` varchar(50) DEFAULT NULL,
  `admin_city` varchar(50) DEFAULT NULL,
  `admin_address` varchar(80) DEFAULT NULL,
  `admin_zipcode` varchar(10) DEFAULT NULL,
  `comments` varchar(100) DEFAULT NULL,
  `delegate` varchar(70) DEFAULT NULL,
  `agent_code` varchar(50) DEFAULT NULL,
  `image` varchar(324) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `first_time` tinyint(1) NOT NULL DEFAULT '1',
  `Active` varchar(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`admin_id`, `user_type`, `admin_fname`, `admin_lname`, `admin_email`, `admin_password`, `admin_phone`, `admin_country`, `admin_city`, `admin_address`, `admin_zipcode`, `comments`, `delegate`, `agent_code`, `image`, `created_at`, `first_time`, `Active`) VALUES
(15, 'super_admin', 'Emeka', 'Daniells', 'admin@autohub.com', 'admin@', '7639964076', 'United States', 'houston', NULL, NULL, '', 'Post Cars,Add Members', '', ' ', '2019-05-06 08:46:28', 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `apikeys`
--
-- Creation: Mar 29, 2019 at 12:58 PM
--

DROP TABLE IF EXISTS `apikeys`;
CREATE TABLE IF NOT EXISTS `apikeys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `apikey` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `is_private_key` tinyint(1) NOT NULL DEFAULT '0',
  `ip_addresses` text,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apikeys`
--

INSERT INTO `apikeys` (`id`, `user_id`, `apikey`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(44, 65, 'w8s4k8g48gg00o8k0k0c0gs8cowwc0sccocso4ks', 1, 1, 0, '192.168.1.10', '2019-03-20 12:27:30'),
(45, 2, 'g4c0o848k840ww00w44gskw8k8w00cwo4gko0g04', 1, 1, 0, '192.168.1.23', '2019-03-20 15:10:03'),
(46, 2, '4sww808gs808k4o8884wgs0o0ggccckow00oo44w', 1, 1, 0, '192.168.1.6', '2019-03-20 16:13:00'),
(48, 2, 'kk0skww80w0k8o4kcskowo880okww80w4kwcwcc4', 1, 1, 0, '192.168.1.6', '2019-03-20 16:24:10'),
(50, 2, 'scg8wsw44wg0wsgo4cwwgcs4wws480s8w8w0088o', 1, 1, 0, '192.168.1.6', '2019-03-27 11:23:17'),
(51, 2, '00c04gggkks8go8480sg84kw4ok88c4gg8wc0gwg', 1, 1, 0, '192.168.1.23', '2019-03-27 15:54:37'),
(52, 2, 'wogks4c0ogsg44k4cogg8884o4w00s4sg4w8cw08', 1, 1, 0, '192.168.1.10', '2019-03-27 16:03:22'),
(53, 2, 'sowoccswo8s8csss0gw08g44gs8g8wocscg4c480', 1, 1, 0, '192.168.1.10', '2019-03-27 17:27:12'),
(54, 2, '0wgss4o448kwk4owks8880080448kocskwgs08w0', 1, 1, 0, '192.168.1.6', '2019-03-27 18:10:34'),
(55, 2, 'scwcg8oggcsko8occ04ccckkc008c848www8cggk', 1, 1, 0, '192.168.1.6', '2019-03-28 11:10:39'),
(56, 2, '4sc0ccwkckcg0sw484w4scw44ogo0o84owocs84s', 1, 1, 0, '192.168.1.6', '2019-03-28 18:08:16'),
(57, 2, 'kow8wso0c4w8kkwgwc88sgggc44kco88ss0gco4w', 1, 1, 0, '192.168.1.6', '2019-03-29 12:41:59'),
(58, 2, 'c08kgw48k0w8wkcgw44wcw4owccoo8owcc4kokk0', 1, 1, 0, '192.168.1.6', '2019-03-29 12:55:58'),
(59, 2, 'gkso40s4oc844scwwk0gg04cgoko0ws088wscg8g', 1, 1, 0, '192.168.1.6', '2019-03-29 14:47:48'),
(60, 2, 'kokok08k80k0w808sw4gwgcccoscw8w8o0cggkw0', 1, 1, 0, '192.168.1.6', '2019-03-29 15:24:47'),
(61, 2, 'cggo8ggkcwoc8okcwgkkkwck4ck8g8sgwc044skg', 1, 1, 0, '192.168.1.6', '2019-03-29 15:27:06'),
(62, 2, 'o4oc0s8s4wg448gscok0skgwsgoss0k8cwow0ogc', 1, 1, 0, '192.168.1.6', '2019-03-29 15:42:34'),
(63, 2, 'sc08800oc8s44wcs0kg4c8oc4s4s0wgkwkccs8cg', 1, 1, 0, '192.168.1.6', '2019-03-29 16:55:24'),
(66, 2, 'ok44c8k4wg8c8w0cckokc8gokckgos8okgwkco8g', 1, 1, 0, '192.168.1.6', '2019-04-01 18:59:13'),
(67, 2, '4s8k0808oc88g40gow8sw84sk004s40k8wcw4gcw', 1, 1, 0, '192.168.1.6', '2019-04-02 17:07:56'),
(70, 2, '4ossosc08ks0c0g004ckwcw8wwskgksw0048888k', 1, 1, 0, '192.168.1.6', '2019-04-10 17:09:46'),
(71, 2, 'o0wwscc8w48ws4kwk80wgkcs0cswkwo088sckk04', 1, 1, 0, '192.168.1.29', '2019-04-10 17:49:32'),
(72, 2, 's4goosg0w840wo0csccw4c48wcwoc8080ko0o0go', 1, 1, 0, '192.168.1.6', '2019-04-12 12:01:19'),
(73, 2, '4gcg4800ows08g4w484cs040ggckgs4wk0okswog', 1, 1, 0, '192.168.1.6', '2019-04-12 15:21:55'),
(74, 2, 'okkco0o8ssoogg8w4csc4so0s8k8cwog0wkkgc0g', 1, 1, 0, '192.168.1.6', '2019-04-12 15:30:22'),
(75, 2, 'ssoccs008k8wok8gs8k8ko8wcokgkggcgsg088wc', 1, 1, 0, '192.168.1.6', '2019-04-12 15:49:52'),
(76, 2, 'osc4cc4cw4400gssococg44g480o08ws4g8gk4co', 1, 1, 0, '192.168.1.6', '2019-04-12 16:09:17'),
(77, 6, 'k8skggw0sw0o8c08so44osgwsswwwk0gcw08o808', 1, 1, 0, '192.168.1.6', '2019-04-12 17:01:24'),
(78, 10, 'ckggw8k00044sckcc48wc8gkg44kwo848w8csco4', 1, 1, 0, '192.168.1.6', '2019-04-30 12:53:51'),
(79, 10, 'ggoggws8g0kskskw0skswc4k040ss40wkscgkg44', 1, 1, 0, '27.62.48.235', '2019-05-04 10:18:52'),
(80, 10, 'wk00ksockcs080wo4w844oocc8ook8cg0c4wkk40', 1, 1, 0, '182.65.84.151', '2019-05-17 12:41:15'),
(82, 10, '0oo8os80wg0k88c4w8k8k8cog00scko4gggwgc8s', 1, 1, 0, '182.65.209.1', '2019-05-23 15:24:21'),
(83, 10, 'ogk4k8g8wowgc8wcokcwss0oc8wo8og884s8008s', 1, 1, 0, '122.164.250.163', '2019-06-03 17:37:41');

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--
-- Creation: May 03, 2019 at 01:25 PM
-- Last update: May 03, 2019 at 01:25 PM
--

DROP TABLE IF EXISTS `devices`;
CREATE TABLE IF NOT EXISTS `devices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `token` text NOT NULL,
  `soft_delete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `email`, `token`, `soft_delete`) VALUES
(9, 'siva@sqindia.net', 'ez_mpVX0bgQ:APA91bFLTv2nZPhU59XPOA3KVjpPWM7UgcJ3yGxdaB2GGWttKlbB5cWxoiGLKaQ4FeMN63dc1_WfpRh8GmIW2kpDQuRxT25xfHRzl4dxs3TlIVvWowHqxqlUwcJYuZPU6nU5qtkjgjkx', 0),
(10, 'guna@sqindia.net', 'dMKIVk_PK7M:APA91bFZAyl5fIZvgTGYiM77O7FtvogNXqSjQDb6k-ktKw_hgkRj-kmDXse6UwFJ21SRLecjSYO03rk6kiqxm1pjpgnXhblgQmRwfgdxVGeXPWNb9dR5DmcmNRRQsSGnOwhV8tQdKXJZ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--
-- Creation: Apr 30, 2019 at 01:10 PM
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `ord_id` int(11) NOT NULL AUTO_INCREMENT,
  `ord_orderId` varchar(45) DEFAULT NULL,
  `ord_quoteId` varchar(45) DEFAULT NULL,
  `ord_userId` int(11) DEFAULT NULL,
  `ord_statusId` int(11) DEFAULT NULL,
  `ord_quotStatusId` int(11) DEFAULT NULL,
  `ord_shippingAddressId` int(11) DEFAULT NULL,
  `ord_shippingMethodId` int(11) DEFAULT NULL,
  `ord_itemTotal` decimal(10,2) DEFAULT NULL,
  `ord_shippingTotal` decimal(10,2) DEFAULT NULL,
  `ord_grandTotal` decimal(10,2) DEFAULT NULL,
  `ord_createdAt` datetime DEFAULT NULL,
  `ord_createdBy` int(11) DEFAULT NULL,
  `ord_updatedAt` timestamp NULL DEFAULT NULL,
  `ord_updatedBy` int(11) DEFAULT NULL,
  `ord_quotCreatedAt` datetime DEFAULT NULL,
  `ord_quotCreatedBy` int(11) DEFAULT NULL,
  `ord_quotUpdatedAt` datetime DEFAULT NULL,
  `ord_quotUpdatedBy` int(11) DEFAULT NULL,
  `ord_discountAmount` decimal(20,2) DEFAULT NULL,
  `ord_discountPercent` decimal(20,2) DEFAULT NULL,
  `ord_isOrder` tinyint(1) NOT NULL DEFAULT '0',
  `ord_isQuote` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ord_id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ord_id`, `ord_orderId`, `ord_quoteId`, `ord_userId`, `ord_statusId`, `ord_quotStatusId`, `ord_shippingAddressId`, `ord_shippingMethodId`, `ord_itemTotal`, `ord_shippingTotal`, `ord_grandTotal`, `ord_createdAt`, `ord_createdBy`, `ord_updatedAt`, `ord_updatedBy`, `ord_quotCreatedAt`, `ord_quotCreatedBy`, `ord_quotUpdatedAt`, `ord_quotUpdatedBy`, `ord_discountAmount`, `ord_discountPercent`, `ord_isOrder`, `ord_isQuote`) VALUES
(92, NULL, 'QT-19-000092', 6, NULL, 3, 2, 3, '2762.00', '500.00', '3262.00', NULL, NULL, NULL, NULL, '2019-04-12 17:41:55', NULL, NULL, NULL, NULL, NULL, 0, 1),
(94, 'OC-19-000094', NULL, 5, 1, NULL, 2, 3, '890.00', '500.00', '890.00', '2019-04-26 13:21:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0),
(95, 'OC-19-000095', NULL, 5, 1, NULL, 2, 3, '890.00', '500.00', '1390.00', '2019-04-26 13:24:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--
-- Creation: Mar 29, 2019 at 12:58 PM
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `ode_id` int(11) NOT NULL AUTO_INCREMENT,
  `ode_orderId` int(11) DEFAULT NULL,
  `ode_vehicleId` int(11) DEFAULT NULL,
  `ode_productId` int(11) DEFAULT NULL,
  `ode_productConditionId` int(11) DEFAULT NULL,
  `ode_quantity` int(11) DEFAULT NULL,
  `ode_statusId` int(11) DEFAULT NULL,
  `ode_comment` varchar(200) DEFAULT NULL,
  `ode_currentMileage` varchar(45) DEFAULT NULL,
  `ode_price` decimal(10,2) DEFAULT NULL,
  `ode_discount` decimal(10,2) DEFAULT NULL,
  `ode_total` decimal(10,2) DEFAULT NULL,
  `ode_createdDate` datetime DEFAULT NULL,
  `ode_createdBy` int(11) DEFAULT NULL,
  `ode_updatedDate` datetime DEFAULT NULL,
  `ode_updatedBy` varchar(45) DEFAULT NULL,
  `ode_images` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ode_id`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`ode_id`, `ode_orderId`, `ode_vehicleId`, `ode_productId`, `ode_productConditionId`, `ode_quantity`, `ode_statusId`, `ode_comment`, `ode_currentMileage`, `ode_price`, `ode_discount`, `ode_total`, `ode_createdDate`, `ode_createdBy`, `ode_updatedDate`, `ode_updatedBy`, `ode_images`) VALUES
(118, 92, 21, 13, 6, 1, NULL, 'Xggxgxxg', '684558', '1351.00', '0.00', '1351.00', '2019-04-12 17:41:55', NULL, NULL, NULL, NULL),
(119, 92, 21, 17, NULL, 1, NULL, 'Vzvzbbxn', '957659', '1411.00', '0.00', '1411.00', '2019-04-12 17:41:55', NULL, NULL, NULL, NULL),
(120, 94, 20, 1, 5, 2, NULL, 'Test comment', '500', '450.00', '10.00', '890.00', '2019-04-26 13:21:36', NULL, NULL, NULL, 'image1,image2'),
(121, 95, 6, 1, 5, 2, NULL, 'Test comment', '500', '450.00', '10.00', '890.00', '2019-04-26 13:24:27', NULL, NULL, NULL, 'image1,image2');

-- --------------------------------------------------------

--
-- Table structure for table `order_messages`
--
-- Creation: Mar 29, 2019 at 12:58 PM
--

DROP TABLE IF EXISTS `order_messages`;
CREATE TABLE IF NOT EXISTS `order_messages` (
  `orm_id` int(11) NOT NULL AUTO_INCREMENT,
  `orm_orderId` int(11) DEFAULT NULL,
  `orm_messageType` varchar(2) DEFAULT NULL,
  `orm_message` mediumtext,
  `orm_createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`orm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_messages`
--

INSERT INTO `order_messages` (`orm_id`, `orm_orderId`, `orm_messageType`, `orm_message`, `orm_createdAt`) VALUES
(1, 1, 'U', 'Can I make Payment to GTB', '2019-05-03 13:25:30'),
(2, 1, 'A', 'Yess', '2019-05-03 13:25:30'),
(3, 1, 'A', 'Yess', '2019-05-03 13:25:30'),
(4, 1, 'U', 'I will make payment soon', '2019-05-03 13:25:30');

-- --------------------------------------------------------

--
-- Table structure for table `order_payments`
--
-- Creation: Apr 30, 2019 at 01:10 PM
--

DROP TABLE IF EXISTS `order_payments`;
CREATE TABLE IF NOT EXISTS `order_payments` (
  `orp_id` int(11) NOT NULL AUTO_INCREMENT,
  `orp_orderId` int(11) DEFAULT NULL,
  `orp_methodId` varchar(10) DEFAULT NULL,
  `orp_bankId` int(11) DEFAULT NULL,
  `orp_status` varchar(45) DEFAULT NULL,
  `orp_txnId` varchar(45) DEFAULT NULL,
  `orp_createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `orp_createdBy` varchar(45) DEFAULT NULL,
  `orp_updatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `orp_updatedBy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`orp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_shippings`
--
-- Creation: Mar 29, 2019 at 12:58 PM
--

DROP TABLE IF EXISTS `order_shippings`;
CREATE TABLE IF NOT EXISTS `order_shippings` (
  `osh_id` int(11) NOT NULL AUTO_INCREMENT,
  `osh_orderId` int(11) DEFAULT NULL,
  `osh_methodId` int(11) DEFAULT NULL,
  `osh_courierId` varchar(24) DEFAULT NULL,
  `osh_courierTrackId` varchar(24) DEFAULT NULL,
  `osh_amount` decimal(10,2) DEFAULT NULL,
  `osh_createdAt` datetime DEFAULT NULL,
  `osh_createdBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`osh_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--
-- Creation: Mar 29, 2019 at 12:58 PM
--

DROP TABLE IF EXISTS `order_status`;
CREATE TABLE IF NOT EXISTS `order_status` (
  `ost_id` int(11) NOT NULL AUTO_INCREMENT,
  `ost_name` varchar(45) DEFAULT NULL,
  `ost_Description` varchar(200) DEFAULT NULL,
  `ost_order` int(11) DEFAULT NULL,
  `ost_createdDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ost_createdBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`ost_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`ost_id`, `ost_name`, `ost_Description`, `ost_order`, `ost_createdDate`, `ost_createdBy`) VALUES
(1, 'Placed', NULL, 1, '2019-05-03 13:25:30', NULL),
(2, 'Shipped', NULL, 2, '2019-05-03 13:25:30', NULL),
(3, 'Delivered', NULL, 3, '2019-05-03 13:25:30', NULL),
(4, 'Not Paid', NULL, 4, '2019-05-17 07:40:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--
-- Creation: May 03, 2019 at 01:25 PM
-- Last update: May 03, 2019 at 01:25 PM
--

DROP TABLE IF EXISTS `password_reset`;
CREATE TABLE IF NOT EXISTS `password_reset` (
  `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `selector` char(16) DEFAULT NULL,
  `token` char(64) DEFAULT NULL,
  `expires` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment_banks`
--
-- Creation: Mar 29, 2019 at 12:58 PM
--

DROP TABLE IF EXISTS `payment_banks`;
CREATE TABLE IF NOT EXISTS `payment_banks` (
  `bnk_id` int(11) NOT NULL AUTO_INCREMENT,
  `bnk_name` varchar(45) DEFAULT NULL,
  `bnk_accountName` varchar(45) DEFAULT NULL,
  `bnk_accountNumber` varchar(45) DEFAULT NULL,
  `bnk_sortCode` varchar(45) DEFAULT NULL,
  `bnk_branch` varchar(45) DEFAULT NULL,
  `bnk_createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `bnk_createdBy` int(11) DEFAULT NULL,
  `bnk_updatedAt` timestamp NULL DEFAULT NULL,
  `bnk_updatedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`bnk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_banks`
--

INSERT INTO `payment_banks` (`bnk_id`, `bnk_name`, `bnk_accountName`, `bnk_accountNumber`, `bnk_sortCode`, `bnk_branch`, `bnk_createdAt`, `bnk_createdBy`, `bnk_updatedAt`, `bnk_updatedBy`) VALUES
(1, 'HDFC', 'Autolane360 NIG LTD', '953450678', '123213', 'trivandrum', '2019-05-03 13:25:30', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--
-- Creation: Mar 29, 2019 at 12:58 PM
--

DROP TABLE IF EXISTS `payment_methods`;
CREATE TABLE IF NOT EXISTS `payment_methods` (
  `pmt_id` int(11) NOT NULL AUTO_INCREMENT,
  `pmt_name` varchar(45) DEFAULT NULL,
  `pmt_description` varchar(200) DEFAULT NULL,
  `pmt_createdAt` int(11) DEFAULT NULL,
  `pmt_createdBy` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pmt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`pmt_id`, `pmt_name`, `pmt_description`, `pmt_createdAt`, `pmt_createdBy`) VALUES
(1, 'Bank', NULL, NULL, '2019-05-03 13:25:30');

-- --------------------------------------------------------

--
-- Table structure for table `policy`
--
-- Creation: May 22, 2019 at 02:04 PM
--

DROP TABLE IF EXISTS `policy`;
CREATE TABLE IF NOT EXISTS `policy` (
  `policy_id` int(6) NOT NULL AUTO_INCREMENT,
  `policy_key` varchar(45) DEFAULT NULL,
  `policy_value` text,
  PRIMARY KEY (`policy_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `policy`
--

INSERT INTO `policy` (`policy_id`, `policy_key`, `policy_value`) VALUES
(1, 'product info', '    return policy '),
(2, 'shipping info', '    shipping info '),
(3, 'return policy', '    return policy '),
(4, 'Customer Policy', 'Customer Policy');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--
-- Creation: May 22, 2019 at 02:06 PM
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `prd_id` int(11) NOT NULL AUTO_INCREMENT,
  `prd_name` varchar(45) DEFAULT NULL,
  `prd_description` varchar(200) DEFAULT NULL,
  `prd_categoryId` int(11) DEFAULT NULL,
  `prd_typeId` int(11) DEFAULT NULL,
  `prd_currentStock` int(11) DEFAULT NULL,
  `prd_image` varchar(200) DEFAULT NULL,
  `prd_price` decimal(10,2) DEFAULT '0.00',
  `prd_brand` varchar(100) DEFAULT NULL,
  `prd_partNumber` varchar(100) DEFAULT NULL,
  `prd_included` varchar(100) DEFAULT NULL,
  `prd_createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `prd_createdBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`prd_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prd_id`, `prd_name`, `prd_description`, `prd_categoryId`, `prd_typeId`, `prd_currentStock`, `prd_image`, `prd_price`, `prd_brand`, `prd_partNumber`, `prd_included`, `prd_createdAt`, `prd_createdBy`) VALUES
(1, 'Engine Parts', NULL, 1, 1, 0, NULL, '0.00', NULL, NULL, NULL, '2019-05-03 13:25:30', NULL),
(2, 'Engine Replacement', NULL, 1, 1, 0, NULL, '0.00', NULL, NULL, NULL, '2019-05-03 13:25:30', NULL),
(3, 'Brake Parts', NULL, 2, 1, 0, NULL, '0.00', NULL, NULL, NULL, '2019-05-03 13:25:30', NULL),
(4, 'Suspension Parts', NULL, 3, 1, 0, NULL, '0.00', NULL, NULL, NULL, '2019-05-03 13:25:30', NULL),
(5, 'Steering Parts', NULL, 4, 1, 0, NULL, '0.00', NULL, NULL, NULL, '2019-05-03 13:25:30', NULL),
(6, 'Trans Parts', NULL, 5, 1, 0, NULL, '0.00', NULL, NULL, NULL, '2019-05-03 13:25:30', NULL),
(7, 'Trans Replacement', NULL, 5, 1, 0, NULL, '0.00', NULL, NULL, NULL, '2019-05-03 13:25:30', NULL),
(8, 'A/C Parts', NULL, 6, 1, 0, NULL, '0.00', NULL, NULL, NULL, '2019-05-03 13:25:30', NULL),
(9, 'Front', NULL, 7, 1, 0, NULL, '0.00', NULL, NULL, NULL, '2019-05-03 13:25:30', NULL),
(10, 'Back Break Light', NULL, 7, 1, 0, NULL, '0.00', NULL, NULL, NULL, '2019-05-03 13:25:30', NULL),
(11, 'Standard', NULL, 8, 1, 0, NULL, '0.00', NULL, NULL, NULL, '2019-05-03 13:25:30', NULL),
(12, 'Premium', NULL, 8, 1, 0, NULL, '0.00', NULL, NULL, NULL, '2019-05-03 13:25:30', NULL),
(13, 'Doors', NULL, 9, 1, 0, NULL, '0.00', NULL, NULL, NULL, '2019-05-03 13:25:30', NULL),
(14, 'Others', NULL, 9, 1, 0, NULL, '0.00', NULL, NULL, NULL, '2019-05-03 13:25:30', NULL),
(15, 'Engine Sensors', NULL, 10, 1, 0, NULL, '0.00', NULL, NULL, NULL, '2019-05-03 13:25:30', NULL),
(16, 'Interior Parts', NULL, 10, 1, 0, NULL, '0.00', NULL, NULL, NULL, '2019-05-03 13:25:30', NULL),
(17, 'Regular Service Kit', NULL, 0, 2, 0, NULL, '0.00', NULL, NULL, NULL, '2019-05-03 13:25:30', NULL),
(18, 'Tuneup Service Kit', NULL, 0, 2, 0, NULL, '0.00', NULL, NULL, NULL, '2019-05-03 13:25:30', NULL),
(19, 'Oil Change', NULL, 0, 3, 0, NULL, '0.00', NULL, NULL, NULL, '2019-05-03 13:25:30', NULL),
(20, 'Oil Filter', NULL, 0, 3, 0, NULL, '0.00', NULL, NULL, NULL, '2019-05-03 13:25:30', NULL),
(21, 'Air Filter', NULL, 0, 3, 0, NULL, '0.00', NULL, NULL, NULL, '2019-05-03 13:25:30', NULL),
(22, 'Plugs', NULL, 0, 3, 0, NULL, '0.00', NULL, NULL, NULL, '2019-05-03 13:25:30', NULL),
(23, 'Car Engine Treatment', NULL, 0, 3, 0, NULL, '0.00', NULL, NULL, NULL, '2019-05-03 13:25:30', NULL),
(31, 'radio', 'radio', 16, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-03 13:25:30', NULL),
(32, 'pack item', 'pack item desc', NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-03 13:25:30', NULL),
(33, 'pack123', 'pack desc123', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-03 13:25:30', NULL),
(36, 'dfdsfsd', 'fdsf', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-03 13:25:30', NULL),
(37, 'Speedwav Original AirFilter', 'rerewr', 16, 4, 5, 'http://res.cloudinary.com/sqdevelop/image/upload/v1556879555/i3kwcs8cbofaw0gnyydm.jpg', '100.00', NULL, NULL, NULL, '2019-05-03 13:25:30', NULL),
(38, 'Purolator HGDH878', 'rwer', 8, 4, 7, 'http://res.cloudinary.com/sqdevelop/image/upload/v1556879534/gwgnianl4rxf3v10q9mw.jpg', '34.00', NULL, NULL, NULL, '2019-05-03 13:25:30', NULL),
(39, 'Speedwav 28391Zip Original Airfilter', 'fdsfds', 7, 4, 10, 'http://res.cloudinary.com/sqdevelop/image/upload/v1556879712/sqh49noolwdsojs9pslm.jpg', '125.00', NULL, NULL, NULL, '2019-05-03 13:25:30', NULL),
(40, 'demo', 'rrreeee', 8, 4, 5, 'http://res.cloudinary.com/sqdevelop/image/upload/v1556879511/suwsznaxjsmhobjhtrym.jpg', '121.00', NULL, NULL, NULL, '2019-05-03 13:25:30', NULL),
(41, 'Purolator 29ER8956', 'Provides Optimal Engine Power', 25, 4, 8, 'http://res.cloudinary.com/sqdevelop/image/upload/v1556602792/dv57inxsvcmlgexpmx84.jpg', '0.00', NULL, NULL, NULL, '2019-05-03 13:25:30', NULL),
(42, 'Spark Minda HGHB878', 'Low fuel Consumption', 25, 4, 5, 'http://res.cloudinary.com/sqdevelop/image/upload/v1556603178/it0ixaghjeossgc4yv51.jpg', '0.00', NULL, NULL, NULL, '2019-05-03 13:25:30', NULL),
(43, 'Speedwav Original  Air Filter HGH897', 'Provides Optimal Engine Power', 25, 4, 3, 'http://res.cloudinary.com/sqdevelop/image/upload/v1556603235/b0ny6l9rkqhzntwx7rtk.jpg', '0.00', NULL, NULL, NULL, '2019-05-03 13:25:30', NULL),
(44, 'Spark Minda FGHB789', 'fdsf', 24, 4, 12, 'http://res.cloudinary.com/sqdevelop/image/upload/v1556879627/v2argabypag15xhb39rb.jpg', '152.00', NULL, NULL, NULL, '2019-05-03 13:25:30', NULL),
(45, 'clutch pack', 'Provides Optimal Engine Power', 5, 4, 7, 'http://res.cloudinary.com/sqdevelop/image/upload/v1557133256/dqdyfomdmvrp6uqywpp9.jpg', '200.00', NULL, NULL, NULL, '2019-05-06 09:01:01', NULL),
(46, 'fgfdg', 'fdgfdg', 3, 4, 10, '', '100.00', 'brand', 'partnumber', 'included', '2019-05-22 14:12:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--
-- Creation: Mar 29, 2019 at 12:58 PM
--

DROP TABLE IF EXISTS `product_categories`;
CREATE TABLE IF NOT EXISTS `product_categories` (
  `pca_id` int(11) NOT NULL AUTO_INCREMENT,
  `pca_name` varchar(45) DEFAULT NULL,
  `pca_description` varchar(200) DEFAULT NULL,
  `pca_createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `pca_createdBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`pca_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`pca_id`, `pca_name`, `pca_description`, `pca_createdAt`, `pca_createdBy`) VALUES
(1, 'Engine', NULL, '2019-05-03 13:25:30', NULL),
(2, 'Brakes', NULL, '2019-05-03 13:25:30', NULL),
(3, 'Suspension', NULL, '2019-05-03 13:25:30', NULL),
(4, 'Steering', NULL, '2019-05-03 13:25:30', NULL),
(5, 'Transmission', NULL, '2019-05-03 13:25:30', NULL),
(6, 'Cooling/Heating', NULL, '2019-05-03 13:25:30', NULL),
(7, 'Headlights/Light', NULL, '2019-05-03 13:25:30', NULL),
(8, 'Rims', NULL, '2019-05-03 13:25:30', NULL),
(9, 'Body', NULL, '2019-05-03 13:25:30', NULL),
(10, 'Electricals', NULL, '2019-05-03 13:25:30', NULL),
(11, 'Alternator', NULL, '2019-05-03 13:25:30', NULL),
(12, 'CV Driveshaft Axle', NULL, '2019-05-03 13:25:30', NULL),
(13, 'Iginition', NULL, '2019-05-03 13:25:30', NULL),
(14, 'Fuel Pump', NULL, '2019-05-03 13:25:30', NULL),
(15, 'Water Pump', NULL, '2019-05-03 13:25:30', NULL),
(16, 'Radiator', NULL, '2019-05-03 13:25:30', NULL),
(17, 'Wiper Blades', NULL, '2019-05-03 13:25:30', NULL),
(22, 'Light', 'dvbfg', '2019-05-03 13:25:30', NULL),
(24, 'Engine', '75851JKNK ', '2019-05-03 13:25:30', NULL),
(25, 'Air Filter', '75851JKNK ', '2019-05-03 13:25:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_conditions`
--
-- Creation: Mar 29, 2019 at 12:58 PM
--

DROP TABLE IF EXISTS `product_conditions`;
CREATE TABLE IF NOT EXISTS `product_conditions` (
  `pco_id` int(11) NOT NULL AUTO_INCREMENT,
  `pco_name` varchar(45) DEFAULT NULL,
  `pco_description` varchar(200) DEFAULT NULL,
  `pco_createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `pco_createdBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`pco_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_conditions`
--

INSERT INTO `product_conditions` (`pco_id`, `pco_name`, `pco_description`, `pco_createdAt`, `pco_createdBy`) VALUES
(5, 'New Parts', NULL, '2019-05-03 13:25:30', NULL),
(6, 'Used Parts', NULL, '2019-05-03 13:25:30', NULL),
(7, 'OEM-After market', NULL, '2019-05-03 13:25:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_sub_products`
--
-- Creation: Mar 29, 2019 at 12:58 PM
--

DROP TABLE IF EXISTS `product_sub_products`;
CREATE TABLE IF NOT EXISTS `product_sub_products` (
  `psp_id` int(11) NOT NULL AUTO_INCREMENT,
  `psp_productId` int(11) DEFAULT NULL,
  `psp_subProductId` int(11) DEFAULT NULL,
  PRIMARY KEY (`psp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `product_sub_products`
--

INSERT INTO `product_sub_products` (`psp_id`, `psp_productId`, `psp_subProductId`) VALUES
(1, 17, 19),
(2, 17, 20),
(3, 17, 21),
(4, 18, 19),
(5, 18, 20),
(6, 18, 21),
(7, 18, 22),
(8, 18, 23),
(15, 33, 21),
(16, 33, 23);

-- --------------------------------------------------------

--
-- Table structure for table `product_types`
--
-- Creation: Mar 29, 2019 at 12:58 PM
--

DROP TABLE IF EXISTS `product_types`;
CREATE TABLE IF NOT EXISTS `product_types` (
  `pty_id` int(11) NOT NULL AUTO_INCREMENT,
  `pty_name` varchar(45) DEFAULT NULL,
  `pty_description` varchar(200) DEFAULT NULL,
  `pty_createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `pty_createdBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`pty_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`pty_id`, `pty_name`, `pty_description`, `pty_createdAt`, `pty_createdBy`) VALUES
(1, 'Vehicle Parts', NULL, '2019-05-03 13:25:30', NULL),
(2, 'Service Packs', NULL, '2019-05-03 13:25:30', NULL),
(3, 'Package Items', NULL, '2019-05-03 13:25:30', NULL),
(4, 'Shopping Items', NULL, '2019-05-03 13:25:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quote_status`
--
-- Creation: Mar 29, 2019 at 12:58 PM
--

DROP TABLE IF EXISTS `quote_status`;
CREATE TABLE IF NOT EXISTS `quote_status` (
  `qst_id` int(11) NOT NULL AUTO_INCREMENT,
  `qst_name` varchar(45) DEFAULT NULL,
  `qst_Description` varchar(200) DEFAULT NULL,
  `qst_order` int(11) DEFAULT NULL,
  `qst_createdDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `qst_createdBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`qst_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `quote_status`
--

INSERT INTO `quote_status` (`qst_id`, `qst_name`, `qst_Description`, `qst_order`, `qst_createdDate`, `qst_createdBy`) VALUES
(1, 'Placed', NULL, 1, '2019-05-03 13:25:30', NULL),
(2, 'Price Quoted', NULL, 2, '2019-05-03 13:25:30', NULL),
(3, 'Accepted', NULL, 3, '2019-05-03 13:25:30', NULL),
(4, 'Declined', NULL, 4, '2019-05-03 13:25:30', NULL),
(5, 'Paid', NULL, 5, '2019-05-03 13:25:30', NULL),
(6, 'Closed', NULL, 6, '2019-05-03 13:25:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_addresses`
--
-- Creation: Mar 29, 2019 at 12:58 PM
--

DROP TABLE IF EXISTS `shipping_addresses`;
CREATE TABLE IF NOT EXISTS `shipping_addresses` (
  `sha_id` int(11) NOT NULL AUTO_INCREMENT,
  `sha_userId` int(11) DEFAULT NULL,
  `sha_firstName` varchar(45) DEFAULT NULL,
  `sha_lastName` varchar(45) DEFAULT NULL,
  `sha_addressLine1` varchar(200) DEFAULT NULL,
  `sha_addressLine2` varchar(200) DEFAULT NULL,
  `sha_city` varchar(45) DEFAULT NULL,
  `sha_state` varchar(45) DEFAULT NULL,
  `sha_country` varchar(45) DEFAULT NULL,
  `sha_postCode` varchar(45) DEFAULT NULL,
  `sha_phone` varchar(45) DEFAULT NULL,
  `sha_email` varchar(45) DEFAULT NULL,
  `sha_createdAt` datetime DEFAULT NULL,
  PRIMARY KEY (`sha_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_methods`
--
-- Creation: Mar 29, 2019 at 12:58 PM
--

DROP TABLE IF EXISTS `shipping_methods`;
CREATE TABLE IF NOT EXISTS `shipping_methods` (
  `shm_id` int(11) NOT NULL AUTO_INCREMENT,
  `shm_name` varchar(45) DEFAULT NULL,
  `shm_description` varchar(200) DEFAULT NULL,
  `shm_price` decimal(10,2) DEFAULT NULL,
  `shm_createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `shm_createdBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`shm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `shipping_methods`
--

INSERT INTO `shipping_methods` (`shm_id`, `shm_name`, `shm_description`, `shm_price`, `shm_createdAt`, `shm_createdBy`) VALUES
(1, 'Air Cargo', NULL, '30000.00', '2019-05-03 13:25:30', NULL),
(2, 'Ocean', NULL, '20000.00', '2019-05-03 13:25:30', NULL),
(3, 'Air', NULL, '45000.00', '2019-05-03 13:25:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--
-- Creation: Apr 30, 2019 at 01:10 PM
--

DROP TABLE IF EXISTS `shopping_cart`;
CREATE TABLE IF NOT EXISTS `shopping_cart` (
  `crt_id` int(11) NOT NULL AUTO_INCREMENT,
  `crt_userId` int(11) DEFAULT NULL,
  `crt_productId` int(11) DEFAULT NULL,
  `crt_vehicleId` int(11) DEFAULT NULL,
  `crt_quantity` int(11) DEFAULT NULL,
  `crt_productConditionId` int(11) DEFAULT NULL,
  `crt_currentMileage` varchar(45) DEFAULT NULL,
  `crt_comment` varchar(200) DEFAULT NULL,
  `crt_images` mediumtext,
  `crt_cartType` varchar(12) DEFAULT NULL,
  `crt_createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`crt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shopping_cart`
--

INSERT INTO `shopping_cart` (`crt_id`, `crt_userId`, `crt_productId`, `crt_vehicleId`, `crt_quantity`, `crt_productConditionId`, `crt_currentMileage`, `crt_comment`, `crt_images`, `crt_cartType`, `crt_createdAt`) VALUES
(77, 10, 39, NULL, 1, NULL, NULL, NULL, NULL, 'shopping', '2019-05-17 07:12:08'),
(78, 10, 38, NULL, 1, NULL, NULL, NULL, NULL, 'shopping', '2019-05-17 07:12:16'),
(79, 10, 45, NULL, 1, NULL, NULL, NULL, NULL, 'shopping', '2019-05-17 07:12:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
-- Creation: Mar 29, 2019 at 12:58 PM
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `otp` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `ref_code` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `otp_is_expired` tinyint(1) DEFAULT NULL,
  `is_email_verified` tinyint(1) NOT NULL DEFAULT '0',
  `otp_created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `otp`, `phone`, `country`, `ref_code`, `created_at`, `otp_is_expired`, `is_email_verified`, `otp_created_at`) VALUES
(10, 'Guna', 'Sundari', 'guna@sqindia.net', 'guna06@', '9567', '7550168101', 'Nigeria', 'HSJJKS', '2019-04-30 12:52:38', 1, 1, '2019-04-30 12:52:38');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--
-- Creation: Apr 30, 2019 at 01:10 PM
-- Last update: Jul 27, 2019 at 07:40 AM
--

DROP TABLE IF EXISTS `vehicles`;
CREATE TABLE IF NOT EXISTS `vehicles` (
  `vhl_id` int(11) NOT NULL AUTO_INCREMENT,
  `vhl_vin` varchar(45) DEFAULT NULL,
  `vhl_userId` int(11) DEFAULT NULL,
  `vhl_vehicleTypeId` int(11) DEFAULT NULL,
  `vhl_year` varchar(6) DEFAULT NULL,
  `vhl_make` varchar(45) DEFAULT NULL,
  `vhl_model` varchar(45) DEFAULT NULL,
  `vhl_trim` varchar(45) DEFAULT NULL,
  `vhl_businessTypeId` int(11) DEFAULT NULL,
  `vhl_companyId` int(11) DEFAULT NULL,
  `vhl_driverId` int(11) DEFAULT NULL,
  `vhl_mileageRange` varchar(45) DEFAULT NULL,
  `vhl_actualMileage` varchar(45) DEFAULT NULL,
  `vhl_image` varchar(200) DEFAULT NULL,
  `vhl_createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `vhl_updatedAt` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`vhl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`vhl_id`, `vhl_vin`, `vhl_userId`, `vhl_vehicleTypeId`, `vhl_year`, `vhl_make`, `vhl_model`, `vhl_trim`, `vhl_businessTypeId`, `vhl_companyId`, `vhl_driverId`, `vhl_mileageRange`, `vhl_actualMileage`, `vhl_image`, `vhl_createdAt`, `vhl_updatedAt`) VALUES
(20, 'GHDUXB5789GHSBBDM', 6, 1, '2018', 'Acura', 'TLX', 'Advance Package 4dr Sedan (3.5L 6cyl 9A)', 2, 18, 0, '875649', '646949', NULL, '2019-05-03 13:25:30', NULL),
(21, 'HCGDXX6755775HCHC', 6, 0, '2016', 'Acura', 'RDX', '4dr SUV (3.5L 6cyl 6A)', 1, 0, 0, '', '605785', 'https://res.cloudinary.com/sqdevelop/image/upload/v1555069904/wm5nnjbtlrmzjejgaeq9.jpg', '2019-05-03 13:25:30', NULL),
(22, 'TSGCCHYF5E5667RUU', 10, 0, '2019', 'Acura', 'ILX', '4dr Sedan (2.0L 4cyl 5A)', 1, 0, 0, '', '455550', 'https://res.cloudinary.com/sqdevelop/image/upload/v1559563708/avy6xdqxnxmbzix3l1vu.png', '2019-06-03 09:38:29', NULL),
(23, 'CVHCCFH', 10, 0, '2019', 'Acura', 'MDX', 'Advance and Entertainment Packages 4dr SUV (3', 1, 0, 0, '', '888558', 'https://res.cloudinary.com/sqdevelop/image/upload/v1564213200/x9gqmvdcff3x8lkhf2jx.jpg', '2019-07-27 05:10:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_business_type`
--
-- Creation: Mar 29, 2019 at 12:58 PM
--

DROP TABLE IF EXISTS `vehicle_business_type`;
CREATE TABLE IF NOT EXISTS `vehicle_business_type` (
  `vbt_id` int(11) NOT NULL AUTO_INCREMENT,
  `vbt_name` varchar(45) DEFAULT NULL,
  `vbt_description` varchar(45) DEFAULT NULL,
  `vbt_createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `vbt_createdBy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`vbt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehicle_business_type`
--

INSERT INTO `vehicle_business_type` (`vbt_id`, `vbt_name`, `vbt_description`, `vbt_createdAt`, `vbt_createdBy`) VALUES
(1, 'private', NULL, '2019-05-03 13:25:31', NULL),
(2, 'commerical', NULL, '2019-05-03 13:25:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_companies`
--
-- Creation: Mar 29, 2019 at 12:58 PM
-- Last update: Jul 27, 2019 at 07:40 AM
--

DROP TABLE IF EXISTS `vehicle_companies`;
CREATE TABLE IF NOT EXISTS `vehicle_companies` (
  `vcm_id` int(11) NOT NULL AUTO_INCREMENT,
  `vcm_userId` int(11) DEFAULT NULL,
  `vcm_companyName` varchar(45) DEFAULT NULL,
  `vcm_email` varchar(45) DEFAULT NULL,
  `vcm_phone` varchar(45) DEFAULT NULL,
  `vcm_address1` varchar(45) DEFAULT NULL,
  `vcm_address2` varchar(45) DEFAULT NULL,
  `vcm_city` varchar(45) DEFAULT NULL,
  `vcm_createdAt` timestamp NULL DEFAULT NULL,
  `vcm_createdBy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`vcm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehicle_companies`
--

INSERT INTO `vehicle_companies` (`vcm_id`, `vcm_userId`, `vcm_companyName`, `vcm_email`, `vcm_phone`, `vcm_address1`, `vcm_address2`, `vcm_city`, `vcm_createdAt`, `vcm_createdBy`) VALUES
(18, 6, 'Sqindia', 'www.sqindia.net', '7558846399', 'Guduvanchery', 'Chennai', NULL, '2019-04-12 11:44:16', NULL),
(19, 10, 'Gfhfvh', 'cghcjv', '8586', 'Xf', 'Xfgchv', NULL, '2019-07-27 05:10:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_drivers`
--
-- Creation: Mar 29, 2019 at 12:58 PM
--

DROP TABLE IF EXISTS `vehicle_drivers`;
CREATE TABLE IF NOT EXISTS `vehicle_drivers` (
  `vdr_id` int(11) NOT NULL AUTO_INCREMENT,
  `vdr_companyId` int(11) DEFAULT NULL,
  `vdr_firstName` varchar(45) DEFAULT NULL,
  `vdr_lastName` varchar(45) DEFAULT NULL,
  `vdr_phone` varchar(45) DEFAULT NULL,
  `vdr_email` varchar(45) DEFAULT NULL,
  `vdr_city` varchar(45) DEFAULT NULL,
  `vdr_state` varchar(45) DEFAULT NULL,
  `vdr_image` varchar(200) DEFAULT NULL,
  `vdr_createdAt` int(11) DEFAULT NULL,
  `vdr_createdBy` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`vdr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehicle_drivers`
--

INSERT INTO `vehicle_drivers` (`vdr_id`, `vdr_companyId`, `vdr_firstName`, `vdr_lastName`, `vdr_phone`, `vdr_email`, `vdr_city`, `vdr_state`, `vdr_image`, `vdr_createdAt`, `vdr_createdBy`) VALUES
(9, 18, 'Guna', 'Sundari', '7550168101', 'gunapandian06@gmail.com', 'Chennai', 'Tamilnadu', 'https://res.cloudinary.com/sqdevelop/image/upload/v1555069541/hzasmxejxngpepzhqb7h.jpg', 2019, '2019-05-03 13:25:31');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_types`
--
-- Creation: Mar 29, 2019 at 12:58 PM
--

DROP TABLE IF EXISTS `vehicle_types`;
CREATE TABLE IF NOT EXISTS `vehicle_types` (
  `vtyp_id` int(11) NOT NULL AUTO_INCREMENT,
  `vtyp_name` varchar(45) DEFAULT NULL,
  `vtyp_description` varchar(200) DEFAULT NULL,
  `vtyp_createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `vtyp_createdBy` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`vtyp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehicle_types`
--

INSERT INTO `vehicle_types` (`vtyp_id`, `vtyp_name`, `vtyp_description`, `vtyp_createdAt`, `vtyp_createdBy`) VALUES
(1, 'TRUCK', 'Truck', '2019-05-03 13:25:31', NULL),
(2, 'CAR', NULL, '2019-05-03 13:25:31', NULL),
(3, 'VAN', NULL, '2019-05-03 13:25:31', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
