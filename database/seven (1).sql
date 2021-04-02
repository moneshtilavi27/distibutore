-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2021 at 07:15 AM
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
-- Database: `seven`
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
  `discount` double NOT NULL,
  `gross_total` double NOT NULL,
  `5%` double NOT NULL,
  `12%` double NOT NULL,
  `18%` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  MODIFY `customer_id` bigint(30) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` bigint(50) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `invoice_no`
--
ALTER TABLE `invoice_no`
  MODIFY `in_id` bigint(30) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `purchase_id` bigint(30) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `purchase_num`
--
ALTER TABLE `purchase_num`
  MODIFY `purchase_no_id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `vender_id` bigint(30) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
