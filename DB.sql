-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 19, 2019 at 12:27 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apikeys`
--

INSERT INTO `apikeys` (`id`, `user_id`, `apikey`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(43, 61, 'w8s4k8g48gg00o8k0k0c0gs8cowwc0sccocso4ks', 1, 1, 0, '192.168.1.23', '2019-03-19 12:07:48');

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
  `ord_userId` int(11) DEFAULT NULL,
  `ord_statusId` int(11) DEFAULT NULL,
  `ord_shippingAddressId` int(11) DEFAULT NULL,
  `ord_shippingMethodId` int(11) DEFAULT NULL,
  `ord_itemTotal` decimal(10,2) DEFAULT NULL,
  `ord_shippingTotal` decimal(10,2) DEFAULT NULL,
  `ord_grandTotal` decimal(10,2) DEFAULT NULL,
  `ord_createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ord_createdBy` int(11) DEFAULT NULL,
  `ord_updatedAt` timestamp NULL DEFAULT NULL,
  `ord_updatedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`ord_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ord_id`, `ord_orderId`, `ord_userId`, `ord_statusId`, `ord_shippingAddressId`, `ord_shippingMethodId`, `ord_itemTotal`, `ord_shippingTotal`, `ord_grandTotal`, `ord_createdBy`, `ord_updatedAt`, `ord_updatedBy`) VALUES
(1, 'OC-19-000001', 1, 4, 1, 4, '90.00', '10.00', '70.00', NULL, NULL, NULL),
(33, NULL, 1, 1, 2, 4, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 'OC-19-000034', 1, 3, 2, 4, '1000.00', NULL, NULL, NULL, NULL, NULL),
(35, NULL, 1, 1, 2, 4, NULL, NULL, NULL, NULL, NULL, NULL),
(36, NULL, 1, 1, 2, 4, NULL, NULL, NULL, NULL, NULL, NULL),
(37, NULL, 1, 1, 2, 4, NULL, NULL, NULL, NULL, NULL, NULL),
(38, NULL, 1, 1, 2, 4, NULL, NULL, NULL, NULL, NULL, NULL),
(39, NULL, 1, 1, 2, 4, NULL, NULL, NULL, NULL, NULL, NULL),
(40, NULL, 1, 1, 2, 4, NULL, NULL, NULL, NULL, NULL, NULL),
(41, NULL, 1, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, NULL, 1, 1, 2, 3, '788.00', '30000.00', '30788.00', NULL, NULL, NULL),
(44, 'OC-19-000044', 3, 3, 2, 3, '390.00', NULL, NULL, NULL, NULL, NULL),
(45, NULL, 2, 1, 2, 5, NULL, NULL, NULL, NULL, NULL, NULL),
(46, NULL, 2, 1, 2, 5, NULL, NULL, NULL, NULL, NULL, NULL),
(47, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(48, NULL, 1, 1, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL),
(49, NULL, 1, 1, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL),
(50, NULL, 1, 1, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL),
(51, NULL, 1, 1, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL),
(52, NULL, 1, 1, 4, 5, NULL, NULL, NULL, NULL, NULL, NULL),
(53, NULL, 1, 1, 4, 5, NULL, NULL, NULL, NULL, NULL, NULL),
(54, NULL, 1, 1, 4, 5, NULL, NULL, NULL, NULL, NULL, NULL),
(55, NULL, 1, 1, 4, 4, NULL, NULL, NULL, NULL, NULL, NULL),
(56, NULL, 1, 1, 4, 4, NULL, NULL, NULL, NULL, NULL, NULL),
(57, NULL, 1, 1, 4, 5, NULL, NULL, NULL, NULL, NULL, NULL),
(58, 'OC-19-000058', 1, 5, 4, 5, '1000.00', '45000.00', '46000.00', NULL, NULL, NULL),
(59, 'OC-19-000059', 5, 5, 5, 5, '8998.00', '45000.00', '53998.00', NULL, NULL, NULL),
(60, 'OC-19-000060', 1, 4, 4, 4, '124027.00', '20000.00', '144027.00', NULL, NULL, NULL);

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
  PRIMARY KEY (`ode_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`ode_id`, `ode_orderId`, `ode_vehicleId`, `ode_productId`, `ode_productConditionId`, `ode_quantity`, `ode_statusId`, `ode_comment`, `ode_currentMileage`, `ode_price`, `ode_discount`, `ode_total`, `ode_createdDate`, `ode_createdBy`, `ode_updatedDate`, `ode_updatedBy`) VALUES
(1, 1, 4, 1, 5, NULL, NULL, '', '4000', '55.00', NULL, '35.00', NULL, NULL, NULL, NULL),
(2, 1, 3, 1, 5, NULL, NULL, '', '4000', '35.00', NULL, '35.00', NULL, NULL, NULL, NULL),
(3, 33, 4, 1, 5, NULL, NULL, '', '300', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 33, 3, 1, 5, NULL, NULL, '', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 34, 4, 1, 5, NULL, NULL, '', '300', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 34, 3, 1, 5, NULL, NULL, '', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 35, 4, 1, 5, NULL, NULL, '', '300', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 35, 3, 1, 5, NULL, NULL, '', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 36, 4, 1, 5, NULL, NULL, '', '300', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 36, 3, 1, 5, NULL, NULL, '', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 38, 4, 1, 5, NULL, NULL, '', '300', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 38, 3, 1, 5, NULL, NULL, '', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 39, 4, 1, 5, 1, NULL, '', '300', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 39, 3, 1, 5, 1, NULL, '', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 40, 4, 1, 5, 1, NULL, '', '300', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 40, 3, 1, 5, 1, NULL, '', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 41, 4, 1, 5, 1, NULL, '', '300', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 41, 3, 1, 5, 1, NULL, '', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 41, 4, 1, 5, NULL, NULL, '', '300', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 41, 3, 1, 5, NULL, NULL, '', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 43, 4, 1, 5, NULL, NULL, '', '300', '788.00', NULL, NULL, NULL, NULL, NULL, NULL),
(22, 43, 3, 1, 5, NULL, NULL, '', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 44, 4, 1, 5, NULL, NULL, '', '300', '290.00', NULL, NULL, NULL, NULL, NULL, NULL),
(24, 44, 3, 1, 5, NULL, NULL, '', '0', '100.00', NULL, NULL, NULL, NULL, NULL, NULL),
(25, 45, 4, 1, 5, 1, NULL, '', '300', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 45, 3, 1, 5, 5, NULL, '', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 46, 4, 1, 5, 1, NULL, '', '300', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 46, 3, 1, 5, 5, NULL, '', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 56, 5, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 56, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 56, 5, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 57, 5, 4, 0, NULL, NULL, 'I need it immediately.', '250000', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 57, 5, 2, 5, NULL, NULL, 'I want new parts not a old one. ', '485558', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 57, 5, 5, 0, NULL, NULL, 'I want know the price of this pack. And need it urgently.', '899788', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 58, 5, 4, 0, NULL, NULL, 'I need it immediately.', '250000', '1000.00', NULL, NULL, NULL, NULL, NULL, NULL),
(36, 58, 5, 2, 5, NULL, NULL, 'I want new parts not a old one. ', '485558', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 58, 5, 5, 0, NULL, NULL, 'I want know the price of this pack. And need it urgently.', '899788', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 59, 7, 4, 0, NULL, NULL, 'Send fast', '32233', '8998.00', NULL, NULL, NULL, NULL, NULL, NULL),
(39, 60, 5, 4, 0, NULL, NULL, 'I need it immediately.', '250000', '34343.00', NULL, NULL, NULL, NULL, NULL, NULL),
(40, 60, 5, 2, 5, NULL, NULL, 'I want new parts not a old one. ', '485558', '54321.00', NULL, NULL, NULL, NULL, NULL, NULL),
(41, 60, 5, 5, 0, NULL, NULL, 'I want know the price of this pack. And need it urgently.', '899788', '35363.00', NULL, NULL, NULL, NULL, NULL, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_payments`
--

INSERT INTO `order_payments` (`orp_id`, `orp_orderId`, `orp_methodId`, `orp_bankId`, `orp_status`, `orp_createdBy`, `orp_updatedBy`) VALUES
(1, 1, '2', 1, 'PAID', NULL, NULL),
(2, 1, '2', 1, 'PAID', NULL, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_shippings`
--

INSERT INTO `order_shippings` (`osh_id`, `osh_orderId`, `osh_methodId`, `osh_courierId`, `osh_courierTrackId`, `osh_amount`, `osh_createdAt`, `osh_createdBy`) VALUES
(1, 1, 1, NULL, NULL, '10.00', NULL, NULL);

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
  `prd_name` varchar(45) DEFAULT NULL,
  `prd_description` varchar(200) DEFAULT NULL,
  `prd_categoryId` int(11) DEFAULT NULL,
  `prd_typeId` int(11) DEFAULT NULL,
  `prd_currentStock` int(11) DEFAULT NULL,
  `prd_image` varchar(200) DEFAULT NULL,
  `prd_price` decimal(10,2) DEFAULT '0.00',
  `prd_createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `prd_createdBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`prd_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prd_id`, `prd_name`, `prd_description`, `prd_categoryId`, `prd_typeId`, `prd_currentStock`, `prd_image`, `prd_price`, `prd_createdBy`) VALUES
(1, 'Alternator', NULL, 1, 1, NULL, NULL, '0.00', NULL),
(2, 'Brake Shoe', NULL, 2, 1, NULL, NULL, '0.00', NULL),
(3, 'Engine belt', NULL, 1, 1, NULL, NULL, '0.00', NULL),
(4, 'Regular Service Kit', NULL, NULL, 2, NULL, NULL, '0.00', NULL),
(5, 'Tuneup Service Kit', NULL, NULL, 2, NULL, NULL, '0.00', NULL),
(6, 'Oil Change', NULL, NULL, 3, NULL, NULL, '0.00', NULL),
(7, 'Oil Filter', NULL, NULL, 3, NULL, NULL, '0.00', NULL),
(8, 'Air Filter', NULL, NULL, 3, NULL, NULL, '0.00', NULL),
(9, 'Shipping Pack Kit', NULL, NULL, 3, NULL, NULL, '0.00', NULL),
(10, 'Plugs', NULL, NULL, 3, NULL, NULL, '0.00', NULL),
(11, 'Car Engine Treatment', NULL, NULL, 3, NULL, NULL, '0.00', NULL),
(12, 'Test Data', 'Service', 0, 2, NULL, NULL, NULL, NULL),
(13, 'test', 'test description', 3, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
CREATE TABLE IF NOT EXISTS `product_categories` (
  `pca_id` int(11) NOT NULL AUTO_INCREMENT,
  `pca_name` varchar(45) DEFAULT NULL,
  `pca_description` varchar(200) DEFAULT NULL,
  `pca_createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `pca_createdBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`pca_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`pca_id`, `pca_name`, `pca_description`, `pca_createdBy`) VALUES
(1, 'Engine Parts', '', NULL),
(2, 'Brakes', NULL, NULL),
(3, 'Suspension', NULL, NULL),
(4, 'Steering', NULL, NULL),
(5, 'Transmission', NULL, NULL),
(6, 'Fluid', 'Oils', NULL),
(7, 'engine oil', 'oils', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_sub_products`
--

INSERT INTO `product_sub_products` (`psp_id`, `psp_productId`, `psp_subProductId`) VALUES
(1, 4, 6),
(2, 4, 7),
(3, 4, 8),
(4, 4, 9),
(5, 5, 6),
(6, 5, 7),
(7, 5, 8),
(8, 5, 9),
(9, 5, 10),
(10, 5, 11),
(11, 12, 7),
(12, 12, 8),
(13, 12, 9),
(14, 12, 10);

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
-- Table structure for table `register`
--

DROP TABLE IF EXISTS `register`;
CREATE TABLE IF NOT EXISTS `register` (
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
  `otp_created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`user_id`, `first_name`, `last_name`, `email`, `password`, `otp`, `phone`, `country`, `ref_code`, `created_at`, `otp_is_expired`, `otp_created_at`) VALUES
(61, 'abc', 'def', 'siva@sqindia.net', 'string', '7474', '999999999', 'India', 'string', '2019-03-19 12:07:00', 1, '2019-03-19 12:07:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipping_addresses`
--

INSERT INTO `shipping_addresses` (`sha_id`, `sha_userId`, `sha_firstName`, `sha_lastName`, `sha_addressLine1`, `sha_addressLine2`, `sha_city`, `sha_state`, `sha_country`, `sha_postCode`, `sha_phone`, `sha_email`, `sha_createdAt`) VALUES
(1, 3, 'muffed', 'kasim', 'address line', 'address line', 'Thrissur', 'Kerala', 'India', '686563', '9995413420', 'muffed@gmail.com', NULL),
(2, 3, 'muffed', 'kasim', 'address line', 'address line', 'Thrissur', 'Kerala', 'India', '686563', '9995413420', 'muffed@gmail.com', NULL),
(3, 3, 'muffed', 'kasim', 'address line', 'address line', 'Thrissur', 'Kerala', 'India', '686563', '9995413420', 'muffed@gmail.com', NULL),
(4, 1, 'Ebin---E', 'Chandy', 'trivandrum', 'Kazhakuttam', 'Thrissur', 'Kerala', 'India', '680671', '8788787', 'mufeed@dfsd.com', NULL),
(5, 5, 'Gopinath', 'Parthasarathy ', 'Abuja main road', '', 'Abuja', 'Abuja', 'Nygeria', '', '3121315551', 'pgnath02@gmail.com', NULL),
(6, 1, 'Ebin', 'Chandy', 'trivandrum', 'Kazhakuttam', 'Thrissur', 'Kerala', 'India', '680671', '8788787', 'mufeed@dfsd.com', '2019-03-18 14:06:14'),
(9, 1, 'Ebin', 'Chandy', 'trivandrum', 'Kazhakuttam', 'Thrissur', 'Kerala', 'India', '680671', '8788787', 'mufeed@dfsd.com', '2019-03-19 11:15:15');

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
  `crt_mileage` varchar(45) DEFAULT NULL,
  `crt_comment` varchar(200) DEFAULT NULL,
  `crt_images` text,
  `crt_createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`crt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopping_cart`
--

INSERT INTO `shopping_cart` (`crt_id`, `crt_userId`, `crt_productId`, `crt_vehicleId`, `crt_quantity`, `crt_productConditionId`, `crt_mileage`, `crt_comment`, `crt_images`) VALUES
(50, 1, 4, 5, 1, NULL, '250000', 'I need it immediately.', NULL),
(51, 1, 2, 5, 1, 5, '485558', 'I want new parts not a old one. ', NULL),
(52, 1, 5, 5, 1, NULL, '899788', 'I want know the price of this pack. And need it urgently.', NULL),
(53, 5, 4, 7, 1, NULL, '32233', 'Send fast', NULL),
(54, 5, 4, 7, 1, NULL, '333228', 'Send urgently', NULL),
(55, 5, 4, 7, 1, NULL, '333228', 'Send urgently', NULL),
(56, 5, 4, 7, 1, NULL, '333228', 'Send urgently', NULL),
(57, 5, 4, 7, 1, NULL, '333228', 'Send urgently', NULL),
(58, 5, 4, 1, 1, NULL, '500', 'Test comment', 'image1,image2');

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
  `vhl_image` varchar(45) DEFAULT NULL,
  `vhl_createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `vhl_updatedAt` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`vhl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`vhl_id`, `vhl_vin`, `vhl_userId`, `vhl_vehicleTypeId`, `vhl_year`, `vhl_make`, `vhl_model`, `vhl_trim`, `vhl_businessTypeId`, `vhl_companyId`, `vhl_driverId`, `vhl_mileageRange`, `vhl_actualMileage`, `vhl_image`, `vhl_updatedAt`) VALUES
(5, 'XGHXXHXH467557GXH', 1, 0, '2019', 'Audi', 'A3 e-tron', 'Select Car Trim', 1, 0, 0, '', '875775', 'string', NULL),
(6, 'CHCHCHXH64476464U', 1, 1, '2019', 'Acura', 'MDX', 'Advance and Entertainment Packages 4dr SUV (3', 2, 1, 0, '578555', '866858', 'string', NULL),
(7, '1GKJWJEJEHSHAUUYG', 5, 0, '2014', 'Ford', 'Escape', 'S 4dr SUV (2.5L 4cyl 6A)', 1, 0, 0, '', '32555', 'string', NULL),
(8, 'XHXHXXHDDH', 1, 0, '2019', 'Audi', 'A3 e-tron', 'Select Car Trim', 1, 0, 0, '', '878798', 'string', NULL),
(9, '123231', 1, 1, '2019', 'nissan', 'kicks', 'string', 1, 1, 1, '1233', '130', 'string', NULL),
(10, '123231', 1, 1, '2019', 'Nissan', 'Kicks', '123213', 1, 1, 1, '1233', '130', '232131', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_companies`
--

INSERT INTO `vehicle_companies` (`vcm_id`, `vcm_userId`, `vcm_companyName`, `vcm_email`, `vcm_phone`, `vcm_address1`, `vcm_address2`, `vcm_city`, `vcm_createdAt`, `vcm_createdBy`) VALUES
(1, 1, 'SQ-India', 'test@gmail.com', '1232321321', 'jhdgfjhgsd', 'ewrrewe', 'trivandrum', NULL, NULL),
(2, 1, 'BRTech', 'test@gmail.com', '1232321321', 'jhdgfjhgsd', 'ewrrewe', 'trivandrum', '2019-03-19 06:03:56', NULL),
(3, 1, 'BroadtechSolutions', 'bradmin@gmail.com', '1232321321', 'jhdgfjhgsd', 'ewrrewe', 'trivandrum', NULL, NULL),
(4, 1, 'Broadtech123', 'bradmin@gmail.com', '1232321321', 'jhdgfjhgsd', 'ewrrewe', 'trivandrum', NULL, NULL),
(5, 1, 'Broadtech123', 'bradmin@gmail.com', '1232321321', 'jhdgfjhgsd', 'ewrrewe', 'trivandrum', NULL, NULL),
(6, 1, 'Broadtech123', 'bradmin@gmail.com', '1232321321', 'jhdgfjhgsd', 'ewrrewe', 'trivandrum', NULL, NULL),
(7, 1, 'Broadtech123', 'bradmin@gmail.com', '1232321321', 'jhdgfjhgsd', 'ewrrewe', 'trivandrum', '2019-03-19 05:34:10', NULL),
(8, 1, 'Broadtech123', 'bradmin@gmail.com', '1232321321', 'jhdgfjhgsd', 'ewrrewe', 'trivandrum', '2019-03-19 05:44:13', NULL),
(9, 1, 'Broadtech123', 'bradmin@gmail.com', '1232321321', 'jhdgfjhgsd', 'ewrrewe', 'trivandrum', '2019-03-19 05:53:51', NULL),
(10, 1, 'Broadtech123', 'bradmin@gmail.com', '1232321321', 'jhdgfjhgsd', 'ewrrewe', 'trivandrum', '2019-03-19 05:55:03', NULL),
(11, 1, 'Broadtech123', 'bradmin@gmail.com', '1232321321', 'jhdgfjhgsd', 'ewrrewe', 'trivandrum', '2019-03-19 05:55:38', NULL),
(12, 1, 'Broadtech123', 'bradmin@gmail.com', '1232321321', 'jhdgfjhgsd', 'ewrrewe', 'trivandrum', '2019-03-19 05:56:34', NULL),
(13, 1, 'Broadtech123', 'bradmin@gmail.com', '1232321321', 'jhdgfjhgsd', 'ewrrewe', 'trivandrum', '2019-03-19 05:58:07', NULL),
(14, 1, 'Broadtech123', 'bradmin@gmail.com', '1232321321', 'jhdgfjhgsd', 'ewrrewe', 'trivandrum', '2019-03-19 07:30:29', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

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
(7, 1, 'Vishnu', 'thomas', '1232321321', 'test@gmail.com', 'trivandrum', 'kerala', NULL, 2019);

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
