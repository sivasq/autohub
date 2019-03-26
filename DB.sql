-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 26, 2019 at 12:54 PM
-- Server version: 8.0.13
-- PHP Version: 7.2.12

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
CREATE DATABASE IF NOT EXISTS `autohubb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `autohubb`;

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE IF NOT EXISTS `admin_user` (
  `admin_id` int(20) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `admin_fname` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `admin_lname` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `admin_email` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `admin_password` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `admin_phone` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `admin_country` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `admin_city` varchar(50) DEFAULT NULL,
  `admin_address` varchar(80) DEFAULT NULL,
  `admin_zipcode` varchar(10) DEFAULT NULL,
  `comments` varchar(100) DEFAULT NULL,
  `delegate` varchar(70) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `agent_code` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `image` varchar(324) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `first_time` tinyint(1) NOT NULL DEFAULT '1',
  `Active` varchar(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`admin_id`, `user_type`, `admin_fname`, `admin_lname`, `admin_email`, `admin_password`, `admin_phone`, `admin_country`, `admin_city`, `admin_address`, `admin_zipcode`, `comments`, `delegate`, `agent_code`, `image`, `first_time`, `Active`) VALUES
(15, 'super_admin', 'emeka', 'danial', 'hou.admin@autolane360.com', '123456', '7639964076', 'United States', 'houston', NULL, NULL, '', 'Post Cars,Add Members', '', ' ', 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `apikeys`
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
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apikeys`
--

INSERT INTO `apikeys` (`id`, `user_id`, `apikey`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(43, 61, 'w8s4k8g48gg00o8k0k0c0gs8cowwc0sccocso4ks', 1, 1, 0, '192.168.1.23', '2019-03-19 12:07:48'),
(44, 65, 'c8wgokg04ocggk080kk48gc4gwkwkckc8840gkw4', 1, 1, 0, '192.168.1.10', '2019-03-20 12:27:30'),
(45, 2, 'g4c0o848k840ww00w44gskw8k8w00cwo4gko0g04', 1, 1, 0, '192.168.1.23', '2019-03-20 15:10:03'),
(46, 2, '4sww808gs808k4o8884wgs0o0ggccckow00oo44w', 1, 1, 0, '192.168.1.6', '2019-03-20 16:13:00'),
(48, 2, 'kk0skww80w0k8o4kcskowo880okww80w4kwcwcc4', 1, 1, 0, '192.168.1.6', '2019-03-20 16:24:10'),
(49, 2, 'cccoc40gccso80wkcwcwk0cooo4gsw0woc0s8w8s', 1, 1, 0, '192.168.1.6', '2019-03-20 16:26:22');

-- --------------------------------------------------------

--
-- Table structure for table `car_images`
--

DROP TABLE IF EXISTS `car_images`;
CREATE TABLE IF NOT EXISTS `car_images` (
  `car_img_id` int(11) NOT NULL AUTO_INCREMENT,
  `commercial_id` int(11) DEFAULT NULL,
  `img_url` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`car_img_id`),
  KEY `car_images_ibfk_2` (`commercial_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `car_images`
--

INSERT INTO `car_images` (`car_img_id`, `commercial_id`, `img_url`, `created_at`) VALUES
(1, 1, 'https://res.cloudinary.com/www-wowhubb-com/image/upload/v1547273160/i8lxtdydzqoyjvckhaa0.jpg', '2019-01-11 19:05:46'),
(2, 2, 'https://res.cloudinary.com/www-wowhubb-com/image/upload/v1547273569/wrghwoye6cohhiwqcbne.jpg', '2019-01-11 19:12:48'),
(3, 3, 'https://res.cloudinary.com/www-wowhubb-com/image/upload/v1547273678/heac1nyxhwcqfjnrpxub.jpg', '2019-01-11 19:14:35'),
(4, 4, 'https://res.cloudinary.com/www-wowhubb-com/image/upload/v1547273929/jskoslumr8yqga63kcij.jpg', '2019-01-11 19:18:47'),
(5, 5, 'https://res.cloudinary.com/www-wowhubb-com/image/upload/v1547274051/owd0uhaavddtjrbdddu6.png', '2019-01-11 19:20:46'),
(6, 6, 'https://res.cloudinary.com/www-wowhubb-com/image/upload/v1547274945/yxm7v6ok3ut7gx3g2ziv.jpg', '2019-01-11 19:35:36'),
(7, 7, 'https://res.cloudinary.com/www-wowhubb-com/image/upload/v1547275051/einfmwxaewxoopbjq2qq.png', '2019-01-11 19:37:25'),
(8, 8, 'https://res.cloudinary.com/www-wowhubb-com/image/upload/v1547275218/lpv9bv2xelfc52os886k.jpg', '2019-01-11 19:40:17'),
(9, 9, 'https://res.cloudinary.com/www-wowhubb-com/image/upload/v1547275330/y4rkbk0sn0u6vtjg6jsn.jpg', '2019-01-11 19:42:09'),
(10, 10, 'https://res.cloudinary.com/www-wowhubb-com/image/upload/v1547275522/myjr9rh10hpnu4i5lq0f.jpg', '2019-01-11 19:45:19'),
(11, 11, 'https://res.cloudinary.com/www-wowhubb-com/image/upload/v1547276155/fjzpwbugkyhrf9blmoma.jpg', '2019-01-11 19:55:52'),
(12, 12, 'https://res.cloudinary.com/www-wowhubb-com/image/upload/v1547276289/vqaebo60b0s1tnrmuqjn.jpg', '2019-01-11 19:58:06'),
(13, 13, 'https://res.cloudinary.com/www-wowhubb-com/image/upload/v1547276398/nxku8ut3q1rax8mtq0h7.jpg', '2019-01-11 19:59:56'),
(14, 14, 'https://res.cloudinary.com/www-wowhubb-com/image/upload/v1547276501/ikadiuqtnn4enf2u7ni2.jpg', '2019-01-11 20:01:39'),
(15, 15, 'https://res.cloudinary.com/www-wowhubb-com/image/upload/v1547276777/carlfixao4xyk3np1jri.jpg', '2019-01-11 20:06:15'),
(16, 16, 'https://res.cloudinary.com/www-wowhubb-com/image/upload/v1547278116/veje9udoazw1nw0r4jcj.jpg', '2019-01-11 20:28:35'),
(17, 17, 'https://res.cloudinary.com/www-wowhubb-com/image/upload/v1547278288/vlur35y4evk4ki6cxz63.jpg', '2019-01-11 20:31:26'),
(18, 18, 'https://res.cloudinary.com/www-wowhubb-com/image/upload/v1547279255/gz9lzhhm16dl8amx1j0l.jpg', '2019-01-11 20:47:34'),
(19, 19, 'https://res.cloudinary.com/www-wowhubb-com/image/upload/v1547279367/mbid2xeevjnapmibbheh.jpg', '2019-01-11 20:49:25'),
(20, 20, 'https://res.cloudinary.com/www-wowhubb-com/image/upload/v1547279545/njw6itf7fvtg1maciv86.jpg', '2019-01-11 20:52:24'),
(21, 21, 'https://res.cloudinary.com/www-wowhubb-com/image/upload/v1547281855/lo1y2nr1hdza1ewqdblz.jpg', '2019-01-11 21:30:50');

-- --------------------------------------------------------

--
-- Table structure for table `commercial_car`
--

DROP TABLE IF EXISTS `commercial_car`;
CREATE TABLE IF NOT EXISTS `commercial_car` (
  `commercial_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `car_type` varchar(20) DEFAULT NULL,
  `com_name` varchar(100) DEFAULT NULL,
  `com_email` varchar(100) DEFAULT NULL,
  `com_phone` varchar(20) DEFAULT NULL,
  `address1` varchar(100) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `contact_name` varchar(50) DEFAULT NULL,
  `contact_phone` varchar(20) DEFAULT NULL,
  `truck_type` varchar(50) DEFAULT NULL,
  `vin_number` varchar(20) DEFAULT NULL,
  `car_make` varchar(80) DEFAULT NULL,
  `car_model` varchar(50) DEFAULT NULL,
  `car_year` varchar(10) DEFAULT NULL,
  `car_trim` varchar(100) DEFAULT NULL,
  `mileage_range` varchar(10) DEFAULT NULL,
  `actual_mileage` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`commercial_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `commercial_car`
--

INSERT INTO `commercial_car` (`commercial_id`, `user_id`, `car_type`, `com_name`, `com_email`, `com_phone`, `address1`, `address2`, `city`, `contact_name`, `contact_phone`, `truck_type`, `vin_number`, `car_make`, `car_model`, `car_year`, `car_trim`, `mileage_range`, `actual_mileage`, `created_at`) VALUES
(1, 2, 'private', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'Buick', 'LaCrosse', '2014', 'Leather Group 4dr Sedan (2.4L 4cyl gas/electric hybrid 6A)', '850006', 'NULL', '2019-01-11 19:05:46'),
(2, 2, 'Private', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'Cadillac', 'CTS', '2019', 'Luxury 4dr Sedan AWD (2.0L 4cyl Turbo 6A)', '690000', 'NULL', '2019-01-11 19:12:48'),
(3, 2, 'Private', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'BHFHFU673883GDHUX', 'Buick', 'Encore', '2014', 'Convenience 4dr SUV AWD (1.4L 4cyl Turbo 6A)', '996868', 'NULL', '2019-01-11 19:14:35'),
(4, 2, 'commercial', 'Guna', 'sqindia.net', '8542649', 'Chennai', NULL, 'Nigeria', 'Nigeria', 'Guna', 'Car', 'bhxhxhjd674888486', 'Mazda', 'Mazda5', '2016', 'Grand Touring 4dr Minivan (2.5L 4cyl 5A)', '855855', '668656', '2019-01-11 19:18:47'),
(5, 2, 'commercial', 'sqindia', 'sqindia.net', '454551', 'nbfdbfbd', 'djfgdnjg', 'nfdjfnhjdn', 'vcnvcnjv', 'cvcv', 'fgdg', 'xcxc', 'vcvc', 'cvcv', 'cvcvg', 'sdsd', 'zdsd', 'zsdd', '2019-01-11 19:20:46'),
(6, 2, 'commercial', 'Bbjcjc', 'bbxbxjx', '96767668', 'Ghdhjd', 'Hhxhhx', 'Nigeria', 'Nigeria', 'Bbjcjc', 'Car', 'vhxhdj', 'GMC', 'Acadia', '2014', 'Denali 4dr SUV (3.6L 6cyl 6A)', '99897', '86090', '2019-01-11 19:35:36'),
(7, 2, 'commercial', 'sqindia', 'sqindia.net', '454551', 'nbfdbfbd', 'djfgdnjg', 'nfdjfnhjdn', 'vcnvcnjv', 'cvcv', 'fgdg', 'xcxc', 'vcvc', 'cvcv', 'cvcvg', 'sdsd', 'zdsd', 'zsdd', '2019-01-11 19:37:25'),
(8, 2, 'commercial', 'Bhdjkd', 'vbzhjd', '67646', 'Gzghsj', 'Hshjsk', 'Ghana', 'Ghana', 'Bhdjkd', 'Car', 'gdhuri67486477hhd', 'Dodge', 'Challenger', '2016', 'R/T 2dr Coupe (5.7L 8cyl 6M)', '989686', '686866', '2019-01-11 19:40:17'),
(9, 2, 'commercial', 'Bhdjkd', 'vbzhjd', '67646', 'Gzghsj', 'Hshjsk', 'Ghana', 'Ghana', 'Bhdjkd', 'Car', 'gdhuri67486477hhd', 'Dodge', 'Challenger', '2016', 'R/T 2dr Coupe (5.7L 8cyl 6M)', '989686', '686866', '2019-01-11 19:42:09'),
(10, 2, 'commercial', 'Cnvnnv', 'cnvnv', '88999', 'Vnn', NULL, 'Nigeria', 'Nigeria', 'Cnvnnv', 'Car', 'chhccbxxbb', 'Acura', 'ILX', '2017', '4dr Sedan (2.0L 4cyl 5A)', '098898', '899898', '2019-01-11 19:45:19'),
(11, 2, 'commercial', 'Vhk', 'hjk', '9', 'Dhi', 'Ffy', 'Ghana', 'Ghana', 'Vhk', 'Truck', 'fhjkkk', 'Audi', 'A3', '2019', '1.8 TFSI Premium 2dr Convertible (1.8L 4cyl Turbo 6AM)', '8222', '5566', '2019-01-11 19:55:52'),
(12, 2, 'commercial', 'Vhk', 'hjk', '9', 'Dhi', 'Ffy', 'Ghana', 'Ghana', 'Vhk', 'Truck', 'fhjkkk', 'Audi', 'A3', '2019', '1.8 TFSI Premium 2dr Convertible (1.8L 4cyl Turbo 6AM)', '8222', '5566', '2019-01-11 19:58:06'),
(13, 2, 'commercial', 'Vhdjf', 'bcbn', '9895', 'Vhxhx', 'Hxhhd', 'Nigeria', 'Nigeria', 'Vhdjf', 'Car', 'gxhhxjxj', 'Acura', 'ILX', '2019', '4dr Sedan (2.0L 4cyl 5A)', '989989', '689899', '2019-01-11 19:59:56'),
(14, 2, 'commercial', 'Vhdjf', 'bcbn', '9895', 'Vhxhx', 'Hxhhd', 'Nigeria', 'Nigeria', 'Vhdjf', 'Car', 'gxhhxjxj', 'Acura', 'ILX', '2018', '4dr Sedan (2.0L 4cyl 5A)', '989989', '689899', '2019-01-11 20:01:39'),
(15, 2, 'commercial', 'Fjjvmb', 'chcnv', '8989', 'Vnnv n', 'Fhhh', 'Nigeria', 'Nigeria', 'Fjjvmb', 'Car', 'cbnvjggj', 'Acura', 'MDX', '2019', 'Advance and Entertainment Packages 4dr SUV (3.5L 6cyl 6A)', '898987', '685775', '2019-01-11 20:06:15'),
(16, 2, 'commercial', 'Fhj', 'hhj', '566', 'Cfg', 'Ccgh', 'Nigeria', 'Nigeria', 'Fhj', 'Car', 'cvhj', 'Acura', 'ILX', '2019', '4dr Sedan (2.0L 4cyl 5A)', '8969', '4556', '2019-01-11 20:28:35'),
(17, 2, 'commercial', 'Bbfb', 'vbbx', '88668', 'Gxggxb', 'Cgxgx', 'Nigeria', 'Nigeria', 'Bbfb', 'Car', 'ghxnf', 'Acura', 'ILX', '2019', '4dr Sedan (2.0L 4cyl 5A)', '9998', '99898', '2019-01-11 20:31:26'),
(18, 2, 'commercial', 'Xbbcnv', 'bccjcn', '89595', 'Cbcbbfbf', 'Xvdvf xvvx', 'Nigeria', 'Nigeria', 'Xbbcnv', 'Car', 'dghchf', 'Acura', 'ILX', '2018', '4dr Sedan (2.0L 4cyl 5A)', '895655', '865656', '2019-01-11 20:47:34'),
(19, 2, 'commercial', 'Xbbcnv', 'bccjcn', '89595', 'Cbcbbfbf', 'Xvdvf xvvx', 'Nigeria', 'Nigeria', 'Xbbcnv', 'Car', 'dghchf', 'Audi', 'A4', '2017', '2.0T Premium 4dr Sedan (2.0L 4cyl Turbo CVT)', '895655', '865656', '2019-01-11 20:49:25'),
(20, 2, 'commercial', 'Xdbbf', 'xhdfh', '86565', 'Ffhhf', 'Fdhbf', 'Nigeria', 'Nigeria', 'Xdbbf', 'Car', 'fbnfnf dhdd', 'Buick', 'Enclave', '2016', 'Convenience Group 4dr SUV (3.6L 6cyl 6A)', '988995', '545656', '2019-01-11 20:52:24'),
(21, 2, 'commercial', 'Xbxbxb', 'bxbccb', '899898', 'Xbbxxb', 'Xbbxxb', 'Nigeria', 'Nigeria', 'Xbxbxb', 'Car', 'cfhhfhfb', 'Acura', 'MDX', '2019', 'Advance and Entertainment Packages 4dr SUV (3.5L 6cyl 6A)', '898695', '86565', '2019-01-11 21:30:50');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `ord_id` int(11) NOT NULL AUTO_INCREMENT,
  `ord_orderId` varchar(45) DEFAULT NULL,
  `ord_quoteId` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ord_id`, `ord_orderId`, `ord_quoteId`, `ord_userId`, `ord_statusId`, `ord_quotStatusId`, `ord_shippingAddressId`, `ord_shippingMethodId`, `ord_itemTotal`, `ord_shippingTotal`, `ord_grandTotal`, `ord_createdAt`, `ord_createdBy`, `ord_updatedAt`, `ord_updatedBy`, `ord_quotCreatedAt`, `ord_quotCreatedBy`, `ord_quotUpdatedAt`, `ord_quotUpdatedBy`, `ord_discountAmount`, `ord_discountPercent`, `ord_isOrder`, `ord_isQuote`) VALUES
(76, 'OC-19-000076', 'QT-19-000076', 2, 1, 2, NULL, NULL, '500.00', NULL, NULL, '2019-03-26 18:03:50', NULL, NULL, NULL, '2019-03-25 17:50:41', NULL, NULL, NULL, NULL, NULL, 1, 1),
(77, NULL, 'QT-19-000077', 2, NULL, 1, NULL, NULL, '470.00', NULL, '0.00', NULL, NULL, NULL, NULL, '2019-03-25 18:03:27', NULL, NULL, NULL, NULL, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
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
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`ode_id`, `ode_orderId`, `ode_vehicleId`, `ode_productId`, `ode_productConditionId`, `ode_quantity`, `ode_statusId`, `ode_comment`, `ode_currentMileage`, `ode_price`, `ode_discount`, `ode_total`, `ode_createdDate`, `ode_createdBy`, `ode_updatedDate`, `ode_updatedBy`, `ode_images`) VALUES
(74, 76, 5, 2, 5, 1, NULL, 'Test comment', '270', '470.00', '0.00', '470.00', NULL, NULL, NULL, NULL, 'image1,image2'),
(75, 76, 5, 3, 6, 1, NULL, 'Test comment', '240', '280.00', '0.00', '280.00', '2019-03-25 18:03:27', NULL, NULL, NULL, 'image1,image2'),
(76, 76, 5, 17, NULL, 1, NULL, 'Test comment', '280', '220.00', '0.00', '220.00', '2019-03-26 13:12:28', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_messages`
--

DROP TABLE IF EXISTS `order_messages`;
CREATE TABLE IF NOT EXISTS `order_messages` (
  `orm_id` int(11) NOT NULL AUTO_INCREMENT,
  `orm_orderId` int(11) DEFAULT NULL,
  `orm_messageType` varchar(2) DEFAULT NULL,
  `orm_message` text,
  `orm_createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`orm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_messages`
--

INSERT INTO `order_messages` (`orm_id`, `orm_orderId`, `orm_messageType`, `orm_message`) VALUES
(1, 1, 'U', 'Can I make Payment to GTB'),
(2, 1, 'A', 'Yess'),
(3, 1, 'A', 'Yess'),
(4, 1, 'U', 'I will make payment soon');

-- --------------------------------------------------------

--
-- Table structure for table `order_payments`
--

DROP TABLE IF EXISTS `order_payments`;
CREATE TABLE IF NOT EXISTS `order_payments` (
  `orp_id` int(11) NOT NULL AUTO_INCREMENT,
  `orp_orderId` int(11) DEFAULT NULL,
  `orp_methodId` varchar(10) DEFAULT NULL,
  `orp_bankId` int(11) DEFAULT NULL,
  `orp_status` varchar(10) DEFAULT NULL,
  `orp_createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `orp_createdBy` varchar(45) DEFAULT NULL,
  `orp_updatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `orp_updatedBy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`orp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_payments`
--

INSERT INTO `order_payments` (`orp_id`, `orp_orderId`, `orp_methodId`, `orp_bankId`, `orp_status`, `orp_createdBy`, `orp_updatedBy`) VALUES
(1, 1, '2', 1, 'PAID', NULL, NULL),
(2, 1, '2', 1, 'PAID', NULL, NULL),
(3, 76, '2', 1, 'PAID', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_shippings`
--

DROP TABLE IF EXISTS `order_shippings`;
CREATE TABLE IF NOT EXISTS `order_shippings` (
  `osh_id` int(11) NOT NULL AUTO_INCREMENT,
  `osh_orderId` int(11) DEFAULT NULL,
  `osh_methodId` int(11) DEFAULT NULL,
  `osh_courierId` int(11) DEFAULT NULL,
  `osh_courierTrackId` int(11) DEFAULT NULL,
  `osh_amount` decimal(10,2) DEFAULT NULL,
  `osh_createdAt` datetime DEFAULT NULL,
  `osh_createdBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`osh_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`ost_id`, `ost_name`, `ost_Description`, `ost_order`, `ost_createdBy`) VALUES
(1, 'order placed', NULL, 1, NULL),
(2, 'price added', NULL, 2, NULL),
(3, 'payment made', NULL, 3, NULL),
(4, 'shipped', NULL, 4, NULL),
(5, 'delivered', NULL, 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_banks`
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_banks`
--

INSERT INTO `payment_banks` (`bnk_id`, `bnk_name`, `bnk_accountName`, `bnk_accountNumber`, `bnk_sortCode`, `bnk_branch`, `bnk_createdBy`, `bnk_updatedAt`, `bnk_updatedBy`) VALUES
(1, 'HDFC', 'mufeed k k', '123123213213', '123213', 'trivandrum', NULL, NULL, NULL),
(2, 'ICICI', 'mufeed k k', '123123213213', '123213', 'trivandrum', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

DROP TABLE IF EXISTS `payment_methods`;
CREATE TABLE IF NOT EXISTS `payment_methods` (
  `pmt_id` int(11) NOT NULL AUTO_INCREMENT,
  `pmt_name` varchar(45) DEFAULT NULL,
  `pmt_description` varchar(200) DEFAULT NULL,
  `pmt_createdAt` int(11) DEFAULT NULL,
  `pmt_createdBy` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pmt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`pmt_id`, `pmt_name`, `pmt_description`, `pmt_createdAt`) VALUES
(1, 'Bank', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `prd_id` int(11) NOT NULL AUTO_INCREMENT,
  `prd_name` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `prd_description` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `prd_categoryId` int(11) DEFAULT NULL,
  `prd_typeId` int(11) DEFAULT NULL,
  `prd_currentStock` int(11) DEFAULT NULL,
  `prd_image` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `prd_price` decimal(10,2) DEFAULT '0.00',
  `prd_createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `prd_createdBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`prd_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prd_id`, `prd_name`, `prd_description`, `prd_categoryId`, `prd_typeId`, `prd_currentStock`, `prd_image`, `prd_price`, `prd_createdBy`) VALUES
(1, 'Engine Parts', NULL, 1, 1, 0, NULL, '0.00', NULL),
(2, 'Engine Replacement', NULL, 1, 1, 0, NULL, '0.00', NULL),
(3, 'Brake Parts', NULL, 2, 1, 0, NULL, '0.00', NULL),
(4, 'Suspension Parts', NULL, 3, 1, 0, NULL, '0.00', NULL),
(5, 'Steering Parts', NULL, 4, 1, 0, NULL, '0.00', NULL),
(6, 'Trans Parts', NULL, 5, 1, 0, NULL, '0.00', NULL),
(7, 'Trans Replacement', NULL, 5, 1, 0, NULL, '0.00', NULL),
(8, 'A/C Parts', NULL, 6, 1, 0, NULL, '0.00', NULL),
(9, 'Front', NULL, 7, 1, 0, NULL, '0.00', NULL),
(10, 'Back Break Light', NULL, 7, 1, 0, NULL, '0.00', NULL),
(11, 'Standard', NULL, 8, 1, 0, NULL, '0.00', NULL),
(12, 'Premium', NULL, 8, 1, 0, NULL, '0.00', NULL),
(13, 'Doors', NULL, 9, 1, 0, NULL, '0.00', NULL),
(14, 'Others', NULL, 9, 1, 0, NULL, '0.00', NULL),
(15, 'Engine Sensors', NULL, 10, 1, 0, NULL, '0.00', NULL),
(16, 'Interior Parts', NULL, 10, 1, 0, NULL, '0.00', NULL),
(17, 'Regular Service Kit', NULL, 0, 2, 0, NULL, '0.00', NULL),
(18, 'Tuneup Service Kit', NULL, 0, 2, 0, NULL, '0.00', NULL),
(19, 'Oil Change', NULL, 0, 3, 0, NULL, '0.00', NULL),
(20, 'Oil Filter', NULL, 0, 3, 0, NULL, '0.00', NULL),
(21, 'Air Filter', NULL, 0, 3, 0, NULL, '0.00', NULL),
(22, 'Plugs', NULL, 0, 3, 0, NULL, '0.00', NULL),
(23, 'Car Engine Treatment', NULL, 0, 3, 0, NULL, '0.00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
CREATE TABLE IF NOT EXISTS `product_categories` (
  `pca_id` int(11) NOT NULL AUTO_INCREMENT,
  `pca_name` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `pca_description` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `pca_createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `pca_createdBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`pca_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`pca_id`, `pca_name`, `pca_description`, `pca_createdBy`) VALUES
(1, 'Engine', NULL, NULL),
(2, 'Brakes', NULL, NULL),
(3, 'Suspension', NULL, NULL),
(4, 'Steering', NULL, NULL),
(5, 'Transmission', NULL, NULL),
(6, 'Cooling/Heating', NULL, NULL),
(7, 'Headlights/Light', NULL, NULL),
(8, 'Rims', NULL, NULL),
(9, 'Body', NULL, NULL),
(10, 'Electricals', NULL, NULL),
(11, 'Alternator', NULL, NULL),
(12, 'CV Driveshaft Axle', NULL, NULL),
(13, 'Iginition', NULL, NULL),
(14, 'Fuel Pump', NULL, NULL),
(15, 'Water Pump', NULL, NULL),
(16, 'Radiator', NULL, NULL),
(17, 'Wiper Blades', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_conditions`
--

DROP TABLE IF EXISTS `product_conditions`;
CREATE TABLE IF NOT EXISTS `product_conditions` (
  `pco_id` int(11) NOT NULL AUTO_INCREMENT,
  `pco_name` varchar(45) DEFAULT NULL,
  `pco_description` varchar(200) DEFAULT NULL,
  `pco_createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `pco_createdBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`pco_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_conditions`
--

INSERT INTO `product_conditions` (`pco_id`, `pco_name`, `pco_description`, `pco_createdBy`) VALUES
(5, 'New Parts', NULL, NULL),
(6, 'Used Parts', NULL, NULL),
(7, 'OEM-After market', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_sub_products`
--

DROP TABLE IF EXISTS `product_sub_products`;
CREATE TABLE IF NOT EXISTS `product_sub_products` (
  `psp_id` int(11) NOT NULL AUTO_INCREMENT,
  `psp_productId` int(11) DEFAULT NULL,
  `psp_subProductId` int(11) DEFAULT NULL,
  PRIMARY KEY (`psp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

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
(8, 18, 23);

-- --------------------------------------------------------

--
-- Table structure for table `product_types`
--

DROP TABLE IF EXISTS `product_types`;
CREATE TABLE IF NOT EXISTS `product_types` (
  `pty_id` int(11) NOT NULL AUTO_INCREMENT,
  `pty_name` varchar(45) DEFAULT NULL,
  `pty_description` varchar(200) DEFAULT NULL,
  `pty_createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `pty_createdBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`pty_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`pty_id`, `pty_name`, `pty_description`, `pty_createdBy`) VALUES
(1, 'VehicleParts', NULL, NULL),
(2, 'ServicePacks', NULL, NULL),
(3, 'Sub Items', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quote_status`
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `quote_status`
--

INSERT INTO `quote_status` (`qst_id`, `qst_name`, `qst_Description`, `qst_order`, `qst_createdBy`) VALUES
(1, 'draft', NULL, 1, NULL),
(2, 'sent', NULL, 2, NULL),
(3, 'viewed', NULL, 3, NULL),
(4, 'accepted', NULL, 4, NULL),
(5, 'declined', NULL, 5, NULL),
(6, 'cenceled', NULL, 6, NULL),
(7, 'closed', NULL, 7, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_addresses`
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `shipping_addresses`
--

INSERT INTO `shipping_addresses` (`sha_id`, `sha_userId`, `sha_firstName`, `sha_lastName`, `sha_addressLine1`, `sha_addressLine2`, `sha_city`, `sha_state`, `sha_country`, `sha_postCode`, `sha_phone`, `sha_email`, `sha_createdAt`) VALUES
(1, 1, 'Gopinath', 'Parthasarathy ', 'Abuja main road', '', 'Abuja', 'Abuja', 'Nygeria', '123456', '3121315551', 'pgnath02@gmail.com', '2019-03-25 00:00:00'),
(2, 2, 'Ebin', 'Chandy', 'trivandrum', 'Kazhakuttam', 'Thrissur', 'Kerala', 'India', '680671', '8788787', 'muffed@gmail.com', '2019-03-18 14:06:14'),
(3, 2, 'Ebin', 'Chandy', 'trivandrum', 'Kazhakuttam', 'Thrissur', 'Kerala', 'India', '680671', '8788787', 'muffed@gmail.com', '2019-03-19 11:15:15');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_methods`
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipping_methods`
--

INSERT INTO `shipping_methods` (`shm_id`, `shm_name`, `shm_description`, `shm_price`, `shm_createdBy`) VALUES
(3, 'Ship By Air Cargo', NULL, '30000.00', NULL),
(4, 'Ship By Ocean', NULL, '20000.00', NULL),
(5, 'Ship By Air', NULL, '45000.00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

DROP TABLE IF EXISTS `shopping_cart`;
CREATE TABLE IF NOT EXISTS `shopping_cart` (
  `crt_id` int(11) NOT NULL AUTO_INCREMENT,
  `crt_userId` int(11) DEFAULT NULL,
  `crt_productId` int(11) DEFAULT NULL,
  `crt_vehicleId` int(11) DEFAULT NULL,
  `crt_quantity` int(11) DEFAULT NULL,
  `crt_productConditionId` int(11) DEFAULT NULL,
  `crt_currentMileage` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `crt_comment` varchar(200) DEFAULT NULL,
  `crt_images` text,
  `crt_cartType` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `crt_createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`crt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopping_cart`
--

INSERT INTO `shopping_cart` (`crt_id`, `crt_userId`, `crt_productId`, `crt_vehicleId`, `crt_quantity`, `crt_productConditionId`, `crt_currentMileage`, `crt_comment`, `crt_images`, `crt_cartType`) VALUES
(24, 1, 17, 5, 1, NULL, '270', 'Test comment', 'image1,image2', 'quotreq'),
(34, 2, 17, 12, 1, NULL, '866888', 'Xggxcggx', NULL, 'quotreq'),
(36, 1, 17, 5, 1, NULL, '270', 'Test comment', 'image1,image2', 'quotreq');

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `otp`, `phone`, `country`, `ref_code`, `created_at`, `otp_is_expired`, `is_email_verified`, `otp_created_at`) VALUES
(1, 'Siva', 'Raj', 'siva@sqindia.net', 'password', '9212', '999999999', 'India', 'string', '2019-03-20 12:58:19', 0, 0, '2019-03-20 13:11:38'),
(2, 'Guna', 'Sundari', 'guna@sqindia.net', 'guna06@', '4438', '7550168101', 'Ghana', '', '2019-03-20 14:32:57', 1, 1, '2019-03-20 14:57:11');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
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
  `vhl_image` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `vhl_createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `vhl_updatedAt` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`vhl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`vhl_id`, `vhl_vin`, `vhl_userId`, `vhl_vehicleTypeId`, `vhl_year`, `vhl_make`, `vhl_model`, `vhl_trim`, `vhl_businessTypeId`, `vhl_companyId`, `vhl_driverId`, `vhl_mileageRange`, `vhl_actualMileage`, `vhl_image`, `vhl_updatedAt`) VALUES
(5, 'XGHXXHXH467557GXH', 1, 0, '2019', 'Audi', 'A3 e-tron', 'Select Car Trim', 1, 0, 0, '', '875775', 'string', NULL),
(6, 'CHCHCHXH64476464U', 1, 1, '2019', 'Acura', 'MDX', 'Advance and Entertainment Packages 4dr SUV (3', 2, 1, 0, '578555', '866858', 'string', NULL),
(7, '1GKJWJEJEHSHAUUYG', 2, 0, '2014', 'Ford', 'Escape', 'S 4dr SUV (2.5L 4cyl 6A)', 1, 0, 0, '', '32555', 'string', NULL),
(8, 'XHXHXXHDDH', 1, 0, '2019', 'Audi', 'A3 e-tron', 'Select Car Trim', 1, 0, 0, '', '878798', 'string', NULL),
(9, '123231', 1, 1, '2019', 'nissan', 'kicks', 'string', 1, 1, 1, '1233', '130', 'string', NULL),
(10, '123231', 1, 1, '2019', 'Nissan', 'Kicks', '123213', 1, 1, 1, '1233', '130', '232131', NULL),
(11, 'XHHXXHX475886GIHF', 2, 0, '2019', 'Acura', 'NSX', '2dr Coupe AWD (3.5L 6cyl gas/electric hybrid ', 1, 0, 0, '', '857885', 'string', NULL),
(12, 'DGHFHHCGXHXHCGDXC', 2, 1, '2019', 'Buick', 'Enclave', 'Convenience Group 4dr SUV (3.6L 6cyl 6A)', 2, 1, 0, '864588', '898686', 'string', NULL),
(13, 'ZGHXXG475575FHFHC', 2, 0, '2012', 'Acura', 'TL', 'SH-AWD Automatic Tech Package', 1, 0, 0, '', '857548', NULL, NULL),
(14, 'CHHDXGHDXBCHCHCFH', 2, 0, '2019', 'Acura', 'ILX', '4dr Sedan (2.0L 4cyl 5A)', 1, 0, 0, '', '899880', 'https://res.cloudinary.com/sqdevelop/image/upload/v1553322896/natrwuldebmnkxya9pnj.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_business_type`
--

DROP TABLE IF EXISTS `vehicle_business_type`;
CREATE TABLE IF NOT EXISTS `vehicle_business_type` (
  `vbt_id` int(11) NOT NULL AUTO_INCREMENT,
  `vbt_name` varchar(45) DEFAULT NULL,
  `vbt_description` varchar(45) DEFAULT NULL,
  `vbt_createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `vbt_createdBy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`vbt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_business_type`
--

INSERT INTO `vehicle_business_type` (`vbt_id`, `vbt_name`, `vbt_description`, `vbt_createdBy`) VALUES
(1, 'private', NULL, NULL),
(2, 'commerical', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_companies`
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_companies`
--

INSERT INTO `vehicle_companies` (`vcm_id`, `vcm_userId`, `vcm_companyName`, `vcm_email`, `vcm_phone`, `vcm_address1`, `vcm_address2`, `vcm_city`, `vcm_createdAt`, `vcm_createdBy`) VALUES
(1, 2, 'SQ-India', 'test@gmail.com', '1232321321', 'jhdgfjhgsd', 'ewrrewe', 'trivandrum', NULL, NULL),
(2, 1, 'BRTech', 'test@gmail.com', '1232321321', 'jhdgfjhgsd', 'ewrrewe', 'trivandrum', '2019-03-19 06:03:56', NULL),
(3, 1, 'BroadtechSolutions', 'bradmin@gmail.com', '1232321321', 'jhdgfjhgsd', 'ewrrewe', 'trivandrum', '2019-03-19 06:03:56', NULL),
(15, 2, 'Lenovo Ltd.', 'as@gmail.com', '5878878879', 'Chennai', '', NULL, '2019-03-22 09:01:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_drivers`
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_drivers`
--

INSERT INTO `vehicle_drivers` (`vdr_id`, `vdr_companyId`, `vdr_firstName`, `vdr_lastName`, `vdr_phone`, `vdr_email`, `vdr_city`, `vdr_state`, `vdr_image`, `vdr_createdAt`) VALUES
(1, 1, 'ebin', 'chandy', 'string', 'test@gmail.com', 'string', 'string', 'string', NULL),
(2, 1, 'ebin', 'thomas', '1232321321', 'test@gmail.com', 'trivandrum', 'kerala', NULL, NULL),
(3, 1, 'BIN--U-Satish', 'thomas', '1232321321', 'test@gmail.com', 'trivandrum', 'Kerala', NULL, NULL),
(4, 1, 'Vishnu', 'thomas', '1232321321', 'test@gmail.com', 'trivandrum', 'kerala', NULL, NULL),
(5, 1, 'Sathish', 'thomas', '1232321321', 'test@gmail.com', 'trivandrum', 'kerala', NULL, NULL),
(6, 1, 'BIN--U-Satish', 'thomas', '1232321321', 'test@gmail.com', 'trivandrum', 'Keralaa', NULL, 2019),
(7, 1, 'Vishnu', 'thomas', '1232321321', 'test@gmail.com', 'trivandrum', 'kerala', NULL, 2019),
(8, 1, 'Guna', 'Sundari', '7550168101', 'guna@sqindia.net', 'Chennai', 'Tamilnadu', NULL, 2019);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_types`
--

DROP TABLE IF EXISTS `vehicle_types`;
CREATE TABLE IF NOT EXISTS `vehicle_types` (
  `vtyp_id` int(11) NOT NULL AUTO_INCREMENT,
  `vtyp_name` varchar(45) DEFAULT NULL,
  `vtyp_description` varchar(200) DEFAULT NULL,
  `vtyp_createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `vtyp_createdBy` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`vtyp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_types`
--

INSERT INTO `vehicle_types` (`vtyp_id`, `vtyp_name`, `vtyp_description`, `vtyp_createdBy`) VALUES
(1, 'TRUCK', 'Truck', NULL),
(2, 'CAR', NULL, NULL),
(3, 'VAN', NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `car_images`
--
ALTER TABLE `car_images`
  ADD CONSTRAINT `car_images_ibfk_2` FOREIGN KEY (`commercial_id`) REFERENCES `commercial_car` (`commercial_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
