-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2020 at 09:56 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

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
(1, 'Dr Mayury Kadadi', '--', 'Opp. Basaveshwar Circle, Gokak', '--', '--', '');

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

-- --------------------------------------------------------

--
-- Table structure for table `invoice_no`
--

CREATE TABLE `invoice_no` (
  `in_id` bigint(30) UNSIGNED NOT NULL,
  `number` bigint(20) UNSIGNED NOT NULL,
  `discount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` bigint(15) UNSIGNED NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_hsn` bigint(4) UNSIGNED ZEROFILL NOT NULL,
  `item_gst` varchar(30) NOT NULL,
  `item_pc` varchar(30) NOT NULL,
  `basic_value` double UNSIGNED NOT NULL,
  `whole_sale_value` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item_name`, `item_hsn`, `item_gst`, `item_pc`, `basic_value`, `whole_sale_value`) VALUES
(1, 'Bella Ultra Liner Green', 1234, '0', '8 Pc', 79, 80),
(2, 'Bella Ultra Night  Liner', 1234, '0', '0', 85, 85),
(3, 'Bella Ultra Night  Liner XXL', 1234, '0', '0', 87, 87),
(4, 'Bella Ultra Night Pink Liner', 1234, '0', '0', 85, 85),
(5, 'Bella Ultra Maxi Blue', 1234, '0', '0', 79, 79),
(6, 'Super Ultra Night A14', 1234, '0', '0', 165, 165),
(7, 'Bella Cotton Pad', 56012190, '12', '80 Pc', 129, 129),
(8, 'Bella Cotton Pad 2+1', 1234, '12', '0', 238, 238),
(9, 'Bella Cotton Wool ', 56012190, '12', ' 50 Gm', 49, 49),
(10, 'Bella Cotton Wool', 56012190, '12', ' 100 Gm', 95, 95),
(11, 'Bella Cotton Buds 100pc (50% Off)', 56012190, '12', '100 pc', 49, 49),
(12, 'Bella Cotton Buds', 56012190, '12', '100 Jar', 59, 59),
(13, 'Bella Cotton Buds ', 56012190, '12', '200 Jar', 99, 99),
(14, 'Bella Cotton Color Ball', 56012190, '12', '100 Pc', 129, 129),
(15, 'Bella Happy Daiper ex small', 1234, '12', '0', 89, 89),
(16, 'Bella Happy Daiper Ex small 24pc', 1234, '12', '0', 279, 279),
(17, 'Bella Baby Daiper Large', 96190040, '12', '5+1', 115, 115),
(18, 'Bella Happy Daiper Medium 5+1', 1234, '12', '0', 95, 95),
(19, 'Bella Baby Daiper XL ', 96190040, '12', '5+1', 125, 125),
(20, 'Bella Happy Daiper XL 24pc', 1234, '12', '0', 649, 649),
(21, 'Bella Happy Daiper XL 22pc', 1234, '12', '0', 649, 649),
(22, 'Bella Maxi Drai Wings 7pc', 1234, '12', '0', 49, 49),
(23, 'Bella Maxi Soft Wing 7pc', 1234, '12', '0', 44, 44),
(24, 'Bella Maxi Soft Wing Classic  25OFF', 96190010, '0', '15', 88, 88),
(25, 'Bella Maxi  Combi Drai Wings', 96190010, '0', '2+1', 198, 198),
(26, 'Bella Maxi  Combi Soft Wings 2+1 (16pc- Case)', 1234, '12', '0', 198, 198),
(27, 'Bella Maxi Drai Wing', 96190010, '0', '15', 99, 99),
(28, 'Bella Regular Drai Wings', 96190010, '0', '8 Pc', 36, 36),
(29, 'Bella Regular Soft Wings', 96190010, '0', '8', 33, 0),
(30, 'Bella Happy Pocket Tisue ', 48182000, '18', '9 X 10', 150, 0),
(31, 'Bella Penty Soft Liener 20pc', 1234, '12', '0', 65, 65),
(32, 'Bella Penty Soft  Liener 12pc', 1234, '12', '0', 55, 55),
(33, 'Bella Penty Soft  Liener 20pc (20 Rs Off)', 1234, '12', '0', 70, 70),
(34, 'Bella Panty Soft 60pc', 1234, '12', '0', 150, 150),
(35, 'Bella Panty Herbs Verbina', 96190010, '0', '60 Pc', 179, 179),
(36, 'Bella Panty Herbs Tilia', 1234, '12', '0', 168, 168),
(37, 'Bella Panty Intima  Pluse 24pc', 1234, '12', '0', 124, 124),
(38, 'Bella Panty Intima  Pluse 48pc', 1234, '12', '0', 214, 214),
(39, 'Bella Panty Intima Normal 60pc', 1234, '12', '0', 209, 209),
(40, 'Bella Panty Mini Green', 96190010, '0', '36', 85, 85),
(41, 'Seni Active Normal  XL', 1234, '12', '0', 700, 700),
(42, 'Seni Active Normal Panty Large 2pc ', 1234, '12', '0', 120, 120),
(43, 'Seni Active Normal Panty Med 2pc', 1234, '12', '0', 120, 120),
(44, 'Seni Active Normal Medium', 96190040, '12', '10', 550, 550),
(45, 'Seni Active Normal Large', 96190040, '12', '10', 600, 0),
(46, 'Seni Lady Super', 96190010, '0', '15', 300, 0),
(47, 'Seni Lady Extra  Super', 96190010, '0', '15', 250, 0),
(48, 'Bella Lilly Pad 6pc', 1234, '12', '0', 21, 21),
(49, 'Seni Air Classic XL', 96190040, '12', '10', 700, 700),
(50, 'Seni Air Classic Medium', 96190040, '12', '10', 550, 550),
(51, 'Seni Air Classic Large ', 96190040, '12', '10', 600, 600),
(52, 'Seni Air Classic Large', 96190040, '12', '2', 160, 160),
(53, 'Seni Air Classic H E Large', 96190040, '12', '5', 320, 320),
(54, 'Seni Adult Daiper 2pc Large', 1234, '12', '0', 160, 160),
(55, 'Seni Adult Daiper 2pc Med', 1234, '12', '0', 140, 140),
(56, 'Seni Adult Daiper 1pc', 1234, '12', '0', 75, 75),
(57, 'Seni Soft H E Underpad 90 x 60 cm ', 96190040, '12', '10', 700, 0),
(58, 'Seni Soft Underpad  Comfort. 90 x 60 cm ', 96190040, '12', '10', 550, 550),
(59, 'Baby Vet Wipes Silk & Cotton 64pc', 1234, '12', '0', 169, 169),
(60, 'Baby Vet Wipes Vit E 64pc', 1234, '12', '0', 189, 189),
(61, 'Seni Care Vet Wipes A10', 1234, '12', '0', 85, 85),
(62, 'Bella Intimate Vet wipes', 33074900, '12', '20', 109, 109),
(63, 'Bella Refreshing Vet Wipes', 33074900, '12', '10', 49, 49),
(64, 'Bella Intima Wash 300ml', 1234, '12', '0', 259, 259),
(65, 'Bella Intima Wash 300ml', 1234, '12', '0', 229, 229),
(66, 'Bella Tempo Easy Twist 8pc', 1234, '12', '0', 89, 89),
(67, 'Bella Karo Toilet Roll White 4pc', 1234, '12', '0', 140, 140),
(68, 'Bella Baby Happy Vet Wipes', 33074900, '12', '10', 39, 0),
(71, 'Seni Air Classic Med', 96190040, '12', '2', 140, 140),
(72, 'Bella Baby Pants Junior', 96190040, '12', '22', 649, 649),
(73, 'Bella Happy Pants Maxi', 96190040, '12', '24', 649, 649),
(74, 'Bella Baby Happy Vet Wipes Cotton & Silk', 33074900, '12', '64', 189, 189),
(75, 'Bella Baby Happy Vet Wipes Vit E', 33074900, '12', '64', 189, 189),
(76, 'Bella No 1 Karo Toilet Paper', 48181000, '18', '4', 140, 140),
(77, 'Bella Panty Soft 20 Off', 96190010, '0', '20', 70, 70);

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
  `gst_per` bigint(50) UNSIGNED NOT NULL,
  `purchase_qty` double NOT NULL,
  `purchase_unit` varchar(30) NOT NULL,
  `purchase_mrp` double NOT NULL,
  `Purchase_rate` double NOT NULL,
  `purchase_type` varchar(30) NOT NULL,
  `purchase_date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_num`
--

CREATE TABLE `purchase_num` (
  `purchase_no_id` bigint(50) NOT NULL,
  `number` bigint(30) NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `purchase_return_number`
--

CREATE TABLE `purchase_return_number` (
  `return_num` bigint(30) UNSIGNED NOT NULL,
  `number` bigint(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `item_rate` double NOT NULL
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
(2, 'Monesh Tilavi', 'D A Colony', 4556465462, '-', '', '-');

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
  MODIFY `customer_id` bigint(30) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` bigint(50) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_no`
--
ALTER TABLE `invoice_no`
  MODIFY `in_id` bigint(30) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` bigint(15) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `local_cust`
--
ALTER TABLE `local_cust`
  MODIFY `Local_cust_id` bigint(30) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` bigint(30) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_num`
--
ALTER TABLE `purchase_num`
  MODIFY `purchase_no_id` bigint(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_return`
--
ALTER TABLE `purchase_return`
  MODIFY `return_id` bigint(30) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_return_number`
--
ALTER TABLE `purchase_return_number`
  MODIFY `return_num` bigint(30) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchse_gst`
--
ALTER TABLE `purchse_gst`
  MODIFY `gst_id` bigint(50) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` bigint(15) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tmpcustomer`
--
ALTER TABLE `tmpcustomer`
  MODIFY `customer_id` bigint(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vender_id` bigint(30) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
