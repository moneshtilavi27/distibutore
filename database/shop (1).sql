-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2021 at 07:39 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` bigint(30) UNSIGNED NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_mob` varchar(50) NOT NULL,
  `customer_address` varchar(500) NOT NULL,
  `customer_gst` varchar(50) NOT NULL,
  `customer_fssid` varchar(30) NOT NULL,
  `customer_category` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_mob`, `customer_address`, `customer_gst`, `customer_fssid`, `customer_category`) VALUES
(1, 'Dr Mayury Kadadi', '--', 'Opp. Basaveshwar Circle, Gokak', '--', '--', ''),
(2, 'Dr Suresh ', '7878878776', 'ganpat galli', '291HGUJ4854926', '01', ''),
(3, 'Dr chitti', '741852968552', 'khanapur', '-', '-', '');

-- --------------------------------------------------------

--
-- Table structure for table `gst`
--

CREATE TABLE `gst` (
  `billno` bigint(50) NOT NULL,
  `gross_total` double NOT NULL,
  `5%` double NOT NULL,
  `12%` double NOT NULL,
  `18` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gst`
--

INSERT INTO `gst` (`billno`, `gross_total`, `5%`, `12%`, `18`) VALUES
(4, 196, 0, 23.52, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hole_temp_item`
--

CREATE TABLE `hole_temp_item` (
  `item_id` bigint(15) UNSIGNED NOT NULL,
  `custid` bigint(30) UNSIGNED NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `item_hsn` int(100) NOT NULL,
  `item_gst` bigint(50) NOT NULL,
  `item_unit` varchar(100) NOT NULL,
  `item_quant` double NOT NULL,
  `free_item` double NOT NULL,
  `mrp` double NOT NULL,
  `item_value` double NOT NULL,
  `item_rate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` bigint(50) UNSIGNED NOT NULL,
  `in_id` bigint(30) UNSIGNED NOT NULL,
  `customer_id` bigint(50) UNSIGNED NOT NULL,
  `gst` bigint(50) UNSIGNED NOT NULL,
  `item_id` bigint(15) UNSIGNED NOT NULL,
  `qty` double NOT NULL,
  `free` double NOT NULL,
  `rate` double NOT NULL,
  `mrp` double NOT NULL,
  `value` double NOT NULL,
  `type` varchar(50) NOT NULL,
  `invoice_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `in_id`, `customer_id`, `gst`, `item_id`, `qty`, `free`, `rate`, `mrp`, `value`, `type`, `invoice_date`) VALUES
(1, 1, 2, 0, 1, 8, 1, 76, 80, 608, 'cash', '2021-03-13'),
(2, 1, 2, 12, 7, 5, 2, 129, 129, 645, 'cash', '2021-03-13'),
(3, 2, 2, 12, 9, 4, 0, 49, 49, 196, 'cash', '2021-03-13'),
(4, 4, 2, 12, 9, 4, 1, 49, 49, 196, 'cash', '2021-03-28'),
(5, 5, 1, 12, 9, 4, 0, 49, 49, 196, 'cash', '2021-03-28'),
(6, 6, 1, 12, 9, 2, 0, 49, 49, 98, 'cash', '2021-03-28'),
(7, 8, 1, 12, 9, 1, 0, 49, 49, 49, 'cash', '2021-03-28'),
(8, 9, 3, 0, 1, 5, 0, 76, 80, 380, 'cash', '2021-03-31'),
(9, 9, 3, 12, 9, 4, 1, 49, 49, 196, 'cash', '2021-03-31');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_no`
--

CREATE TABLE `invoice_no` (
  `in_id` bigint(30) UNSIGNED NOT NULL,
  `number` bigint(20) UNSIGNED NOT NULL,
  `discount` double NOT NULL,
  `gross_total` double NOT NULL,
  `5%` double NOT NULL,
  `12%` double NOT NULL,
  `18%` double NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_no`
--

INSERT INTO `invoice_no` (`in_id`, `number`, `discount`, `gross_total`, `5%`, `12%`, `18%`, `status`) VALUES
(1, 1, 0, 1253, 0, 77.4, 0, 0),
(2, 2, 0, 196, 0, 23.52, 0, 0),
(3, 3, 0, 0, 0, 0, 0, 0),
(4, 4, 0, 0, 0, 0, 0, 1),
(5, 5, 0, 196, 0, 23.52, 0, 0),
(6, 6, 0, 98, 0, 11.76, 0, 0),
(7, 7, 0, 98, 0, 11.76, 0, 0),
(8, 8, 10, 49, 0, 5.88, 0, 0),
(9, 9, 0, 576, 0, 23.52, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` bigint(15) UNSIGNED NOT NULL,
  `item_cmp` varchar(200) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_hsn` bigint(4) UNSIGNED ZEROFILL NOT NULL,
  `item_gst` varchar(30) NOT NULL,
  `item_pc` varchar(30) NOT NULL,
  `mrp` double UNSIGNED NOT NULL,
  `sale` double NOT NULL,
  `pur` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item_cmp`, `item_name`, `item_hsn`, `item_gst`, `item_pc`, `mrp`, `sale`, `pur`) VALUES
(1, 'Bella', 'Bella Ultra Liner Green', 1234, '0', '8 Pc', 80, 76, 60),
(2, 'Bella', 'Bella Ultra Night  Liner', 1234, '0', '0', 85, 85, 0),
(3, 'Bella', 'Bella Ultra Night  Liner XXL', 1234, '0', '0', 87, 87, 0),
(4, 'Bella', 'Bella Ultra Night Pink Liner', 1234, '0', '0', 85, 85, 0),
(5, 'Bella', 'Bella Ultra Maxi Blue', 1234, '0', '0', 79, 79, 0),
(6, 'Bella', 'Super Ultra Night A14', 1234, '0', '0', 165, 165, 0),
(7, 'Bella', 'Bella Cotton Pad', 56012190, '12', '80 Pc', 129, 129, 100),
(8, 'Bella', 'Bella Cotton Pad 2+1', 1234, '12', '0', 238, 238, 0),
(9, 'Bella', 'Bella Cotton Wool 50gm', 56012190, '12', ' 50 Gm', 49, 49, 35),
(10, 'Bella', 'Bella Cotton Wool', 56012190, '12', ' 100 Gm', 95, 95, 0),
(11, 'Bella', 'Bella Cotton Buds 100pc (50% Off)', 56012190, '12', '100 pc', 49, 49, 0),
(12, 'Bella', 'Bella Cotton Buds', 56012190, '12', '100 Jar', 59, 59, 0),
(13, 'Bella', 'Bella Cotton Buds ', 56012190, '12', '200 Jar', 99, 99, 0),
(14, 'Bella', 'Bella Cotton Color Ball', 56012190, '12', '100 Pc', 129, 129, 0),
(15, 'Bella', 'Bella Happy Daiper ex small', 1234, '12', '0', 89, 89, 0),
(16, 'Bella', 'Bella Happy Daiper Ex small 24pc', 1234, '12', '0', 279, 279, 0),
(17, 'Bella', 'Bella Baby Daiper Large', 96190040, '12', '5+1', 115, 115, 0),
(18, 'Bella', 'Bella Happy Daiper Medium 5+1', 1234, '12', '0', 95, 95, 0),
(19, 'Bella', 'Bella Baby Daiper XL ', 96190040, '12', '5+1', 125, 125, 0),
(20, 'Bella', 'Bella Happy Daiper XL 24pc', 1234, '12', '0', 649, 649, 0),
(21, 'Bella', 'Bella Happy Daiper XL 22pc', 1234, '12', '0', 649, 649, 0),
(22, 'Bella', 'Bella Maxi Drai Wings 7pc', 1234, '12', '0', 49, 49, 0),
(23, 'Bella', 'Bella Maxi Soft Wing 7pc', 1234, '12', '0', 44, 44, 0),
(24, 'Bella', 'Bella Maxi Soft Wing Classic  25OFF', 96190010, '0', '15', 88, 88, 0),
(25, 'Bella', 'Bella Maxi  Combi Drai Wings', 96190010, '0', '2+1', 198, 198, 0),
(26, 'Bella', 'Bella Maxi  Combi Soft Wings 2+1 (16pc- Case)', 1234, '12', '0', 198, 198, 0),
(27, 'Bella', 'Bella Maxi Drai Wing', 96190010, '0', '15', 99, 99, 0),
(28, 'Bella', 'Bella Regular Drai Wings', 96190010, '0', '8 Pc', 36, 36, 0),
(29, 'Bella', 'Bella Regular Soft Wings', 96190010, '0', '8', 33, 0, 0),
(30, 'Bella', 'Bella Happy Pocket Tisue ', 48182000, '18', '9 X 10', 150, 0, 0),
(31, 'Bella', 'Bella Penty Soft Liener 20pc', 1234, '12', '0', 65, 65, 0),
(32, 'Bella', 'Bella Penty Soft  Liener 12pc', 1234, '12', '0', 55, 55, 0),
(33, 'Bella', 'Bella Penty Soft  Liener 20pc (20 Rs Off)', 1234, '12', '0', 70, 70, 0),
(34, 'Bella', 'Bella Panty Soft 60pc', 1234, '12', '0', 150, 150, 0),
(35, 'Bella', 'Bella Panty Herbs Verbina', 96190010, '0', '60 Pc', 179, 179, 0),
(36, 'Bella', 'Bella Panty Herbs Tilia', 1234, '12', '0', 168, 168, 0),
(37, 'Bella', 'Bella Panty Intima  Pluse 24pc', 1234, '12', '0', 124, 124, 0),
(38, 'Bella', 'Bella Panty Intima  Pluse 48pc', 1234, '12', '0', 214, 214, 0),
(39, 'Bella', 'Bella Panty Intima Normal 60pc', 1234, '12', '0', 209, 209, 0),
(40, 'Bella', 'Bella Panty Mini Green', 96190010, '0', '36', 85, 85, 0),
(41, 'Bella', 'Seni Active Normal  XL', 1234, '12', '0', 700, 700, 0),
(42, 'Bella', 'Seni Active Normal Panty Large 2pc ', 1234, '12', '0', 120, 120, 0),
(43, 'Bella', 'Seni Active Normal Panty Med 2pc', 1234, '12', '0', 120, 120, 0),
(44, 'Bella', 'Seni Active Normal Medium', 96190040, '12', '10', 550, 550, 0),
(45, 'Bella', 'Seni Active Normal Large', 96190040, '12', '10', 600, 0, 0),
(46, 'Bella', 'Seni Lady Super', 96190010, '0', '15', 300, 0, 0),
(47, 'Bella', 'Seni Lady Extra  Super', 96190010, '0', '15', 250, 0, 0),
(48, 'Bella', 'Bella Lilly Pad 6pc', 1234, '12', '0', 21, 21, 0),
(49, 'Bella', 'Seni Air Classic XL', 96190040, '12', '10', 700, 700, 0),
(50, 'Bella', 'Seni Air Classic Medium', 96190040, '12', '10', 550, 550, 0),
(51, 'Bella', 'Seni Air Classic Large ', 96190040, '12', '10', 600, 600, 0),
(52, 'Bella', 'Seni Air Classic Large', 96190040, '12', '2', 160, 160, 0),
(53, 'Bella', 'Seni Air Classic H E Large', 96190040, '12', '5', 320, 320, 0),
(54, 'Bella', 'Seni Adult Daiper 2pc Large', 1234, '12', '0', 160, 160, 0),
(55, 'Bella', 'Seni Adult Daiper 2pc Med', 1234, '12', '0', 140, 140, 0),
(56, 'Bella', 'Seni Adult Daiper 1pc', 1234, '12', '0', 75, 75, 0),
(57, 'Bella', 'Seni Soft H E Underpad 90 x 60 cm ', 96190040, '12', '10', 700, 0, 0),
(58, 'Bella', 'Seni Soft Underpad  Comfort. 90 x 60 cm ', 96190040, '12', '10', 550, 550, 0),
(59, 'Bella', 'Baby Vet Wipes Silk & Cotton 64pc', 1234, '12', '0', 169, 169, 0),
(60, 'Bella', 'Baby Vet Wipes Vit E 64pc', 1234, '12', '0', 189, 189, 0),
(61, 'Bella', 'Seni Care Vet Wipes A10', 1234, '12', '0', 85, 85, 0),
(62, 'Bella', 'Bella Intimate Vet wipes', 33074900, '12', '20', 109, 109, 0),
(63, 'Bella', 'Bella Refreshing Vet Wipes', 0012, '18', '49', 49, 49, 0),
(64, 'Bella', 'Bella Intima Wash 300ml', 1234, '12', '0', 259, 259, 0),
(65, 'Bella', 'Bella Intima Wash 300ml', 1234, '12', '0', 229, 229, 0),
(66, 'Bella', 'Bella Tempo Easy Twist 8pc', 1234, '12', '0', 89, 89, 0),
(67, 'Bella', 'Bella Karo Toilet Roll White 4pc', 1234, '12', '0', 140, 140, 130),
(68, 'Bella', 'Bella Baby Happy Vet Wipes', 33074900, '12', '10', 39, 0, 0),
(71, 'Bella', 'Seni Air Classic Med', 96190040, '12', '2', 140, 140, 0),
(72, 'Bella', 'Bella Baby Pants Junior', 96190040, '12', '22', 649, 649, 0),
(73, 'Bella', 'Bella Happy Pants Maxi', 96190040, '12', '24', 649, 649, 0),
(74, 'Bella', 'Bella Baby Happy Vet Wipes Cotton & Silk', 33074900, '12', '64', 189, 189, 0),
(75, 'Bella', 'Bella Baby Happy Vet Wipes Vit E', 33074900, '12', '64', 189, 189, 0),
(76, 'Bella', 'Bella No 1 Karo Toilet Paper', 48181000, '18', '4', 140, 140, 0),
(77, 'Bella', 'Bella Panty Soft 20 Off', 96190010, '0', '20', 70, 70, 0);

-- --------------------------------------------------------

--
-- Table structure for table `local_cust`
--

CREATE TABLE `local_cust` (
  `Local_cust_id` bigint(30) UNSIGNED NOT NULL,
  `local_cust__name` varchar(100) NOT NULL,
  `loacal_cust_address` varchar(120) NOT NULL,
  `loacal_cust_mob` bigint(100) NOT NULL,
  `loacal_cust_gst` int(100) NOT NULL,
  `loacal_cust_fssid` int(100) NOT NULL,
  `loacal_cust_email` varchar(120) NOT NULL,
  `loacal_cust_date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`, `type`) VALUES
('admin', 'pass', 'admin'),
('admin', 'pass', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchase_id` bigint(30) UNSIGNED NOT NULL,
  `purchase_no_id` bigint(50) NOT NULL,
  `vender_id` bigint(30) UNSIGNED NOT NULL,
  `item_id` bigint(15) UNSIGNED NOT NULL,
  `item_pc` varchar(50) NOT NULL,
  `gst_per` bigint(50) UNSIGNED NOT NULL,
  `purchase_qty` double NOT NULL,
  `purchase_mrp` double NOT NULL,
  `Purchase_rate` double NOT NULL,
  `purchase_type` varchar(30) NOT NULL,
  `purchase_date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchase_id`, `purchase_no_id`, `vender_id`, `item_id`, `item_pc`, `gst_per`, `purchase_qty`, `purchase_mrp`, `Purchase_rate`, `purchase_type`, `purchase_date`) VALUES
(1, 1, 3, 7, '80 Pc', 12, 10, 100, 1000, 'cash', '13-03-2021'),
(2, 1, 3, 1, '8 Pc', 0, 12, 70, 840, 'cash', '13-03-2021'),
(3, 1, 3, 9, ' 50 Gm', 12, 15, 40, 600, 'cash', '13-03-2021'),
(4, 2, 3, 67, '0', 12, 20, 130, 2600, 'cash', '28-03-2021'),
(5, 2, 3, 9, ' 50 Gm', 12, 10, 35, 350, 'cash', '28-03-2021'),
(6, 3, 2, 9, ' 50 Gm', 12, 15, 35, 525, 'cash', '28-03-2021'),
(7, 4, 4, 1, '8 Pc', 0, 10, 60, 600, 'cash', '31-03-2021'),
(8, 5, 4, 1, '8 Pc', 0, 10, 60, 600, 'cash', '31-03-2021'),
(9, 4, 4, 9, ' 50 Gm', 12, 10, 35, 350, 'cash', '31-03-2021'),
(10, 5, 4, 9, ' 50 Gm', 12, 10, 35, 350, 'cash', '31-03-2021');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_num`
--

CREATE TABLE `purchase_num` (
  `purchase_no_id` bigint(50) NOT NULL,
  `number` bigint(30) NOT NULL,
  `date` varchar(50) NOT NULL,
  `gross_total` double NOT NULL,
  `5%` double NOT NULL,
  `12%` double NOT NULL,
  `18%` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_num`
--

INSERT INTO `purchase_num` (`purchase_no_id`, `number`, `date`, `gross_total`, `5%`, `12%`, `18%`) VALUES
(1, 1, '13-03-2021', 0, 0, 0, 0),
(2, 0, '28-03-2021', 2950, 0, 354, 0),
(3, 0, '28-03-2021', 525, 0, 63, 0),
(4, 0, '31-03-2021', 950, 0, 42, 0),
(5, 0, '31-03-2021', 950, 0, 42, 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_return`
--

CREATE TABLE `purchase_return` (
  `return_id` bigint(30) UNSIGNED NOT NULL,
  `return_num` bigint(30) UNSIGNED NOT NULL,
  `vender_id` bigint(30) UNSIGNED NOT NULL,
  `item_id` bigint(15) UNSIGNED NOT NULL,
  `gst_per` bigint(50) UNSIGNED NOT NULL,
  `purchase_qty` double NOT NULL,
  `purchase_mrp` double NOT NULL,
  `Purchase_rate` double NOT NULL,
  `purchase_type` varchar(30) NOT NULL,
  `purchase_date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_return`
--

INSERT INTO `purchase_return` (`return_id`, `return_num`, `vender_id`, `item_id`, `gst_per`, `purchase_qty`, `purchase_mrp`, `Purchase_rate`, `purchase_type`, `purchase_date`) VALUES
(1, 1, 3, 7, 12, 2, 100, 200, 'cash', '2021-03-13');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_return_number`
--

CREATE TABLE `purchase_return_number` (
  `return_num` bigint(30) UNSIGNED NOT NULL,
  `number` bigint(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_return_number`
--

INSERT INTO `purchase_return_number` (`return_num`, `number`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchse_gst`
--

CREATE TABLE `purchse_gst` (
  `gst_id` bigint(50) UNSIGNED NOT NULL,
  `gross_total` double NOT NULL,
  `5%` double NOT NULL,
  `12%` double NOT NULL,
  `18%` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchse_gst`
--

INSERT INTO `purchse_gst` (`gst_id`, `gross_total`, `5%`, `12%`, `18%`) VALUES
(1, 2440, 0, 192, 0),
(2, 1253, 0, 77.4, 0),
(3, 196, 0, 23.52, 0);

-- --------------------------------------------------------

--
-- Table structure for table `purc_temp_item`
--

CREATE TABLE `purc_temp_item` (
  `item_id` bigint(15) UNSIGNED NOT NULL,
  `custid` bigint(30) UNSIGNED NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `item_hsn` int(100) NOT NULL,
  `item_gst` bigint(50) NOT NULL,
  `item_pc` varchar(50) NOT NULL,
  `item_quant` double NOT NULL,
  `item_value` double NOT NULL,
  `item_rate` double NOT NULL,
  `item_mrp` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stock_id` bigint(15) UNSIGNED NOT NULL,
  `gst_id` bigint(30) UNSIGNED NOT NULL,
  `item_id` bigint(15) UNSIGNED NOT NULL,
  `unit` varchar(100) NOT NULL,
  `stock_quantity` double UNSIGNED NOT NULL,
  `mrp` bigint(30) UNSIGNED NOT NULL,
  `value` bigint(30) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stock_id`, `gst_id`, `item_id`, `unit`, `stock_quantity`, `mrp`, `value`) VALUES
(1, 1, 7, '', 1, 0, 1000),
(2, 1, 1, '', 3, 0, 840),
(3, 1, 9, '', 30, 0, 600),
(4, 0, 67, '', 20, 0, 2600);

-- --------------------------------------------------------

--
-- Table structure for table `tmpcustomer`
--

CREATE TABLE `tmpcustomer` (
  `customer_id` bigint(30) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_address` varchar(100) NOT NULL,
  `customer_mob` bigint(10) NOT NULL,
  `customer_email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmpitem`
--

CREATE TABLE `tmpitem` (
  `item_id` bigint(15) UNSIGNED NOT NULL,
  `customer_id` bigint(30) NOT NULL,
  `Local_cust_id` bigint(30) UNSIGNED NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `item_hsn` int(100) NOT NULL,
  `item_gst` bigint(50) NOT NULL,
  `item_unit` varchar(100) NOT NULL,
  `item_quant` double NOT NULL,
  `item_value` double NOT NULL,
  `item_rate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `updateitem`
--

CREATE TABLE `updateitem` (
  `item_id` bigint(15) UNSIGNED NOT NULL,
  `custid` bigint(30) UNSIGNED NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `item_hsn` int(100) NOT NULL,
  `item_gst` bigint(50) NOT NULL,
  `item_unit` varchar(100) NOT NULL,
  `item_quant` double NOT NULL,
  `free_item` double NOT NULL,
  `mrp` double NOT NULL,
  `item_value` double NOT NULL,
  `item_rate` double NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vender_id` bigint(30) UNSIGNED NOT NULL,
  `vender_name` varchar(50) NOT NULL,
  `vender_address` varchar(100) NOT NULL,
  `vender_mob` bigint(20) NOT NULL,
  `vender_gst` varchar(50) NOT NULL,
  `vender_fssid` varchar(30) NOT NULL,
  `mail_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vender_id`, `vender_name`, `vender_address`, `vender_mob`, `vender_gst`, `vender_fssid`, `mail_id`) VALUES
(0, 'MATRUCHAYA AGENCY', 'PATIL GALLI. ANAGOL, BELAGAVI', 9448989461, '29ALFPK4278A1Z5', '[object HTMLInputElement]', '-'),
(2, 'Monesh Tilavi', 'D A Colony', 4556465462, '-', '', '-'),
(3, 'Kiran Zangaruche', 'Sonoli', 8861223456, '291GHHFH', '', '0'),
(4, 'Akshay Joshilkar', 'khanapur', 8881334567, '29BNVKF656MJFKKF', '', 'A@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `hole_temp_item`
--
ALTER TABLE `hole_temp_item`
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `invoice_ibfk_1` (`customer_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `in_id` (`in_id`);

--
-- Indexes for table `invoice_no`
--
ALTER TABLE `invoice_no`
  ADD PRIMARY KEY (`in_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `local_cust`
--
ALTER TABLE `local_cust`
  ADD PRIMARY KEY (`Local_cust_id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `iten_id` (`item_id`),
  ADD KEY `vender_id` (`vender_id`),
  ADD KEY `purchase_no_id` (`purchase_no_id`);

--
-- Indexes for table `purchase_num`
--
ALTER TABLE `purchase_num`
  ADD PRIMARY KEY (`purchase_no_id`);

--
-- Indexes for table `purchase_return`
--
ALTER TABLE `purchase_return`
  ADD PRIMARY KEY (`return_id`),
  ADD KEY `iten_id` (`item_id`),
  ADD KEY `vender_id` (`vender_id`),
  ADD KEY `return_num` (`return_num`);

--
-- Indexes for table `purchase_return_number`
--
ALTER TABLE `purchase_return_number`
  ADD PRIMARY KEY (`return_num`);

--
-- Indexes for table `purchse_gst`
--
ALTER TABLE `purchse_gst`
  ADD PRIMARY KEY (`gst_id`);

--
-- Indexes for table `purc_temp_item`
--
ALTER TABLE `purc_temp_item`
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `gst_id` (`gst_id`);

--
-- Indexes for table `tmpcustomer`
--
ALTER TABLE `tmpcustomer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `tmpitem`
--
ALTER TABLE `tmpitem`
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `updateitem`
--
ALTER TABLE `updateitem`
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vender_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` bigint(30) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` bigint(50) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `invoice_no`
--
ALTER TABLE `invoice_no`
  MODIFY `in_id` bigint(30) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` bigint(15) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `local_cust`
--
ALTER TABLE `local_cust`
  MODIFY `Local_cust_id` bigint(30) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` bigint(30) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `purchase_num`
--
ALTER TABLE `purchase_num`
  MODIFY `purchase_no_id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `purchase_return`
--
ALTER TABLE `purchase_return`
  MODIFY `return_id` bigint(30) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchase_return_number`
--
ALTER TABLE `purchase_return_number`
  MODIFY `return_num` bigint(30) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchse_gst`
--
ALTER TABLE `purchse_gst`
  MODIFY `gst_id` bigint(50) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` bigint(15) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tmpcustomer`
--
ALTER TABLE `tmpcustomer`
  MODIFY `customer_id` bigint(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vender_id` bigint(30) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
