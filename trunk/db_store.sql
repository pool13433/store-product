-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2015 at 04:34 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `adjust`
--

CREATE TABLE IF NOT EXISTS `adjust` (
  `adj_id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_id` int(11) NOT NULL COMMENT 'รหัสสินค้า',
  `adj_product_lastamount` int(11) NOT NULL COMMENT 'จำนวนเดิมก่อนการปรับสมดุล',
  `adj_adjust_no` int(11) NOT NULL COMMENT 'จำนวนที่ต้องการเปลี่ยนแปลง',
  `adj_remark` text NOT NULL,
  `adj_type` enum('add','remove') NOT NULL COMMENT 'เพิ่ม หรือ ลบออก',
  `adj_createdate` date NOT NULL,
  `adj_createby` int(11) NOT NULL,
  `adj_updatedate` date NOT NULL,
  `adj_updateby` int(11) NOT NULL,
  PRIMARY KEY (`adj_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `adjust`
--

INSERT INTO `adjust` (`adj_id`, `pro_id`, `adj_product_lastamount`, `adj_adjust_no`, `adj_remark`, `adj_type`, `adj_createdate`, `adj_createby`, `adj_updatedate`, `adj_updateby`) VALUES
(1, 8, 11, 100, 'ปรับเพราะ แตก', 'add', '2015-01-09', 1, '2015-01-09', 1),
(2, 14, 133, 10000, '10000', 'add', '2015-01-09', 1, '2015-01-09', 1),
(4, 12, 55555555, 5555, '5555', 'remove', '2015-01-09', 1, '2015-01-09', 1),
(5, 13, 1, 5555, '5555', 'add', '2015-01-09', 1, '2015-01-09', 1),
(6, 6, 39, 111111, '111111  111111', 'remove', '2015-01-09', 1, '2015-01-09', 1),
(7, 2, 143, 100, '100 100', 'add', '2015-01-09', 1, '2015-01-09', 1),
(8, 14, 10000, 111, '1111', 'add', '2015-01-10', 1, '2015-01-10', 1),
(9, 14, 10111, 1000, '100', 'add', '2015-01-10', 1, '2015-01-10', 1),
(10, 14, 11111, 3333, '3333', 'add', '2015-01-10', 1, '2015-01-10', 1),
(11, 14, 14444, 11, '111', 'add', '2015-01-10', 1, '2015-01-10', 1),
(12, 14, 14455, 222, '222', 'remove', '2015-01-10', 1, '2015-01-10', 1),
(13, 6, -111072, 120000, '120000', 'add', '2015-01-10', 1, '2015-01-10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bill_in`
--

CREATE TABLE IF NOT EXISTS `bill_in` (
  `billin_id` int(11) NOT NULL AUTO_INCREMENT,
  `billin_invoicescode` varchar(15) NOT NULL COMMENT 'เลขที่ใบแจ้งหนี้',
  `billin_taxcode` varchar(20) NOT NULL COMMENT 'เลขที่ใบกำกับภาษี',
  `billin_indate` date NOT NULL COMMENT 'วันที่รับเข้า',
  `sup_id` int(11) NOT NULL COMMENT 'รหัสร้าน',
  `billin_doccode` varchar(15) NOT NULL,
  `billin_docdate` date NOT NULL COMMENT 'เลขที่เอกสาร',
  `pay_id` int(11) NOT NULL COMMENT 'รหัสระยะเวลาจ่ายเงิน',
  `billin_finishdate` date NOT NULL COMMENT 'วันครบกำหนด',
  `billin_paycode` varchar(15) NOT NULL COMMENT 'เลขที่ใบสั่งขาย',
  `sales_name` varchar(255) NOT NULL COMMENT 'รหัสพนักงาน vender',
  `billin_localtioncode` int(11) NOT NULL COMMENT 'รหัสสถานที่จำหน่วย',
  `billin_weight` int(11) NOT NULL,
  `billin_pricebeforevat` int(11) NOT NULL COMMENT 'จำนวนเงินก่อน + ภาษี',
  `billin_vat` int(11) NOT NULL COMMENT '%',
  `billin_priceaftervat` int(11) NOT NULL COMMENT 'จำนวนเงินหลัง + ภาษี',
  `billin_sender` varchar(50) NOT NULL,
  `billin_receiver` varchar(50) NOT NULL COMMENT 'ชื่อเจ้าหน้าที่รับของ',
  `billin_autherized` varchar(50) NOT NULL COMMENT 'ชื่อผู้รับมอบอำนาจ',
  `billin_createdate` date NOT NULL,
  `billin_createby` int(11) NOT NULL,
  `billin_updatedate` date NOT NULL,
  `billin_updateby` int(11) NOT NULL,
  `billin_status` int(1) NOT NULL DEFAULT '1' COMMENT '''1'' => ''รออนุมัติการรับของเข้าคลังสินค้า [ผ่านการตรวจรับจากพนักงานประจาโกดังแล้ว]'',                  ''2'' => ''รออนุมัติการรับของเข้าคลังสินค้า [ผ่านการสอบจากพนักงานประจาหน้าร้านแล้ว]'',                  ''3'' => ''อนุมัติการรับของเข้าคลังสินค้า ผ่าน (ถ้าเลือกแล้วจะไม่สามารถ ปรับแกไข้ ใบบิลได้อีก)'',         ''4'' => ''อนุมัติการรับของเข้าคลังสินค้า ไม่ผ่าน (ถ้าเลือกแล้วจะไม่สามารถ ปรับแกไข้ ใบบิลได้อีก)''',
  PRIMARY KEY (`billin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `bill_in`
--

INSERT INTO `bill_in` (`billin_id`, `billin_invoicescode`, `billin_taxcode`, `billin_indate`, `sup_id`, `billin_doccode`, `billin_docdate`, `pay_id`, `billin_finishdate`, `billin_paycode`, `sales_name`, `billin_localtioncode`, `billin_weight`, `billin_pricebeforevat`, `billin_vat`, `billin_priceaftervat`, `billin_sender`, `billin_receiver`, `billin_autherized`, `billin_createdate`, `billin_createby`, `billin_updatedate`, `billin_updateby`, `billin_status`) VALUES
(2, '0000000002', '55555555', '2014-12-02', 1, '1', '2014-12-12', 1, '2014-12-03', '1', '2', 3, 0, 0, 0, 0, '0', '0', '', '2014-12-15', 0, '0000-00-00', 0, 0),
(15, '0000000007', '9090909090', '1900-11-06', 1, '5555555', '1900-11-13', 5, '1900-11-06', '5555555', '5555555', 5555555, 100, 247, 11, 274, '1111', '111', '11', '2014-12-20', 0, '2015-01-09', 1, 1),
(16, '0000000008', 'TEST', '2014-12-03', 1, 'TEST TEST', '2014-12-02', 1, '2014-12-11', '111', '111', 1111, 0, 269733, 111, 569136, '0', '0', '', '2014-12-20', 0, '2014-12-22', 8, 1),
(17, '0000000009', '22222', '2014-12-30', 18, '22222', '2015-01-06', 1, '2015-01-06', '22', '22', 2222, 11, 12321, 12, 13799, '2222', '2222', '222222', '2015-01-10', 1, '2015-02-07', 1, 1),
(18, '0000000010', '22222', '2014-12-30', 15, '22222', '2015-01-06', 1, '2015-01-06', '22', '22', 2222, 11, 121, 12, 13799, '2222', '2222', '222222', '2015-01-10', 1, '2015-02-07', 1, 1),
(19, '09000001', '09000001', '2015-02-07', 13, '09000001', '2015-02-07', 1, '2015-02-07', '09000001', '09000001', 9000001, 1, 7550, 1111, 4044, '2222', '2222', '2222', '2015-02-07', 1, '2015-02-07', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bill_in_product`
--

CREATE TABLE IF NOT EXISTS `bill_in_product` (
  `billinpro_id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_code` varchar(15) NOT NULL,
  `billinpro_noinbill` int(11) NOT NULL COMMENT 'จำนวนตามใบ',
  `billinpro_nocount` int(11) NOT NULL COMMENT 'จำนวนนับจริง',
  `billinpro_remark` text NOT NULL COMMENT 'สาเหตุ นับไม่ตรงกับใขขบิล',
  `billinpro_unitprice` int(11) NOT NULL COMMENT 'ราคาหน่วยละ',
  `billinpro_discount` int(11) NOT NULL,
  `billinpro_totalprice` int(11) NOT NULL,
  `billin_id` int(11) NOT NULL,
  `billinpro_createdate` date NOT NULL,
  PRIMARY KEY (`billinpro_id`),
  KEY `billin_id` (`billin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=110 ;

--
-- Dumping data for table `bill_in_product`
--

INSERT INTO `bill_in_product` (`billinpro_id`, `pro_code`, `billinpro_noinbill`, `billinpro_nocount`, `billinpro_remark`, `billinpro_unitprice`, `billinpro_discount`, `billinpro_totalprice`, `billin_id`, `billinpro_createdate`) VALUES
(24, '0000000004', 1, 1, '1', 1, 0, 1, 0, '2014-12-16'),
(25, '0000000002', 1, 1, '1', 1, 0, 1, 0, '2014-12-16'),
(26, '0000000003', 1, 1, '1', 1, 0, 1, 0, '2014-12-16'),
(75, '0000000002', 4, 7, '7', 7, 7, 49, 15, '2014-12-17'),
(76, '0000000003', 5, 7, '7', 7, 7, 49, 15, '2014-12-17'),
(77, '0000000004', 1, 1, '1', 1, 1, 1, 15, '2014-12-17'),
(78, '0000000004', 1, 1, '1', 1, 1, 1, 15, '2014-12-17'),
(79, '0000000004', 2, 7, '7', 7, 7, 49, 15, '2014-12-17'),
(80, '0000000005', 6, 7, '7', 7, 7, 49, 15, '2014-12-17'),
(81, '0000000006', 3, 7, '7', 7, 7, 49, 15, '2014-12-17'),
(99, '0000000006', 11, 11, '111', 111, 111, 12321, 16, '2014-12-17'),
(100, '0000000006', 222, 222, '222', 222, 222, 49284, 16, '2014-12-17'),
(101, '0000000006', 333, 333, '333', 33, 33, 10989, 16, '2014-12-17'),
(102, '0000000006', 323, 20, '444', 444, 444, 197136, 16, '2014-12-17'),
(103, '0000000004', 1, 1, '', 1, 1, 1, 16, '2014-12-17'),
(104, '0000000004', 1, 1, '', 1, 1, 1, 16, '2014-12-17'),
(105, '0000000003', 1, 1, '1111111', 1, 1, 1, 16, '2014-12-17'),
(106, '0000000002', 11, 111, '', 14, 7, 12321, 17, '2015-01-10'),
(107, '0000000003', 111, 11, '', 14, 106, 121, 18, '2015-01-10'),
(108, '0000000004', 111, 11, '', 0, 3, 121, 19, '2015-02-07'),
(109, '0000000004', 32, 323, '', 0, 3, 7429, 19, '2015-02-07');

-- --------------------------------------------------------

--
-- Table structure for table `bill_out`
--

CREATE TABLE IF NOT EXISTS `bill_out` (
  `billout_id` int(11) NOT NULL AUTO_INCREMENT,
  `billout_code` varchar(15) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `billout_outdate` date NOT NULL,
  `salse_name` varchar(150) NOT NULL,
  `pay_id` int(11) NOT NULL COMMENT 'เงื่อนไขการชำระเงิน',
  `billout_receiver` varchar(50) NOT NULL,
  `billout_sender` varchar(50) NOT NULL,
  `billout_createdate` date NOT NULL,
  `billout_createby` int(11) NOT NULL,
  `billout_updatedate` date NOT NULL,
  `billout_updateby` int(11) NOT NULL,
  `billout_total` int(11) NOT NULL,
  `billout_status` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`billout_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `bill_out`
--

INSERT INTO `bill_out` (`billout_id`, `billout_code`, `customer_id`, `billout_outdate`, `salse_name`, `pay_id`, `billout_receiver`, `billout_sender`, `billout_createdate`, `billout_createby`, `billout_updatedate`, `billout_updateby`, `billout_total`, `billout_status`) VALUES
(4, '111', 6, '2014-10-06', '11', 1, 'พูลสวัสดิ์', 'พูลสวัสดิ์', '2014-12-20', 0, '0000-00-00', 0, 12999, 0),
(6, '1', 9, '2014-12-01', '1111', 4, 'boto', 'boto', '2014-12-20', 0, '2014-12-22', 8, 111, 1),
(7, '1', 9, '2014-12-01', '1111', 4, 'boto', 'boto', '2014-12-20', 0, '2014-12-22', 8, 16, 1),
(8, '1111111', 7, '2014-12-02', '1111', 6, '22', '222', '2014-12-20', 0, '2015-01-10', 1, 42736, 1),
(9, '1111111', 7, '2014-12-02', '1111', 1, '22', '222', '2014-12-20', 0, '0000-00-00', 0, 559, 0),
(10, '1111111', 7, '2014-12-02', '1111', 1, '22', '222', '2014-12-20', 0, '0000-00-00', 0, 33550, 0),
(11, '9999999999', 9, '2015-01-05', '11', 1, '1', '1', '2015-01-10', 1, '2015-01-10', 1, 9989001, 1),
(12, '9999999999', 9, '2015-01-05', '11', 6, '1', '1', '2015-01-10', 1, '2015-01-10', 1, 109990, 1),
(13, '11444444', 12, '2015-01-05', '4444', 3, '444', '4444', '2015-01-10', 1, '2015-01-10', 1, 19749136, 1),
(14, '5555555', 12, '2014-12-28', '55', 6, '1111', '1111', '2015-01-10', 1, '2015-01-10', 1, 12321, 0),
(15, '5555555', 12, '2014-12-28', '55', 6, '1111', '1111', '2015-01-10', 1, '2015-01-10', 1, 3025, 0),
(16, '5555555', 12, '2014-12-28', '55', 6, '1111', '1111', '2015-01-10', 1, '2015-01-10', 1, 444, 0),
(17, '1111111', 9, '2015-01-05', '222', 6, '111', '2222', '2015-01-10', 1, '2015-01-10', 1, 44, 1),
(18, '565656', 7, '2014-12-07', '5656', 6, '1111', '111', '2015-01-10', 1, '2015-01-10', 1, 44, 1),
(19, 'TTTT0000', 15, '2015-02-07', 'TTTT0000', 7, 'pool', 'pool', '2015-02-07', 1, '2015-02-07', 1, 242, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bill_out_product`
--

CREATE TABLE IF NOT EXISTS `bill_out_product` (
  `billoutpro_id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_code` varchar(20) NOT NULL,
  `billoutpro_nocount` int(11) NOT NULL,
  `billoutpro_unitprice` int(11) NOT NULL,
  `billoutpro_discount` int(11) NOT NULL,
  `billoutpro_totalprice` int(11) NOT NULL,
  `billout_id` int(11) NOT NULL,
  `billoutpro_createdate` date NOT NULL,
  PRIMARY KEY (`billoutpro_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `bill_out_product`
--

INSERT INTO `bill_out_product` (`billoutpro_id`, `pro_code`, `billoutpro_nocount`, `billoutpro_unitprice`, `billoutpro_discount`, `billoutpro_totalprice`, `billout_id`, `billoutpro_createdate`) VALUES
(7, '0000000004', 1, 2, 1, 2, 7, '2014-12-22'),
(9, '0000000004', 1, 2, 1, 2, 7, '2014-12-22'),
(10, '0000000006', 3, 4, 5, 12, 7, '2014-12-22'),
(11, '0000000004', 33, 33, 33, 1089, 10, '2014-12-20'),
(12, '0000000004', 33, 33, 33, 1089, 10, '2014-12-20'),
(13, '0000000003', 44, 44, 44, 1936, 10, '2014-12-20'),
(14, '0000000003', 44, 44, 44, 1936, 10, '2014-12-20'),
(15, '0000000003', 55, 555, 55, 30525, 10, '2014-12-20'),
(16, '0000000003', 55, 555, 55, 30525, 10, '2014-12-20'),
(17, '0000000004', 1, 1, 1, 1, 8, '2015-01-10'),
(18, '0000000006', 555, 77, 88, 42735, 8, '2015-01-10'),
(19, '0000000002', 9999, 999, 9, 9989001, 11, '2015-01-10'),
(20, '0000000002', 9999, 999, 9, 9989001, 11, '2015-01-10'),
(21, '0000000006', 1, 1, 1, 1, 12, '2015-01-10'),
(22, '0000000006', 33, 3333, 333, 109989, 12, '2015-01-10'),
(23, '0000000003', 4444, 4444, 444, 19749136, 13, '2015-01-10'),
(24, '0000000003', 4444, 4444, 444, 19749136, 13, '2015-01-10'),
(25, '0000000013', 222, 2, 22, 444, 16, '2015-01-10'),
(26, '0000000013', 222, 2, 22, 444, 16, '2015-01-10'),
(27, '0000000014', 22, 2, 2, 44, 17, '2015-01-10'),
(28, '0000000014', 22, 2, 2, 44, 17, '2015-01-10'),
(29, '0000000007', 22, 2, 2, 44, 18, '2015-01-10'),
(30, '0000000007', 22, 2, 2, 44, 18, '2015-01-10'),
(31, '0000000004', 11, 11, 11, 121, 19, '2015-02-07'),
(32, '0000000004', 11, 11, 11, 121, 19, '2015-02-07');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(50) NOT NULL,
  `cat_desc` text NOT NULL,
  `cat_createdate` date NOT NULL,
  `cat_createby` int(11) NOT NULL,
  `cat_updatedate` date NOT NULL,
  `cat_updateby` int(11) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `cat_desc`, `cat_createdate`, `cat_createby`, `cat_updatedate`, `cat_updateby`) VALUES
(1, 'แอลกอฮอร์', 'แอลกอฮอร์', '2014-12-11', 0, '2015-02-07', 1),
(2, 'ไม่มีแอลกอฮอร์', 'ไม่มีแอลกอฮอร์', '2014-12-11', 0, '2014-12-22', 8),
(3, 'สแน๊ก', 'สแน๊ก ขนมคบเคี้ยว', '2014-12-11', 0, '2014-12-22', 8),
(4, 'อิ่นๆ', 'อิ่นๆ', '2014-12-11', 0, '2014-12-22', 8);

-- --------------------------------------------------------

--
-- Table structure for table `pay_condition`
--

CREATE TABLE IF NOT EXISTS `pay_condition` (
  `pay_id` int(11) NOT NULL AUTO_INCREMENT,
  `pay_name` varchar(50) NOT NULL,
  `pay_time` int(11) NOT NULL COMMENT 'จำนวนวัน',
  `pay_createdate` date NOT NULL,
  `pay_createby` int(11) NOT NULL,
  `pay_updatedate` date NOT NULL,
  `pay_updateby` int(11) NOT NULL,
  PRIMARY KEY (`pay_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `pay_condition`
--

INSERT INTO `pay_condition` (`pay_id`, `pay_name`, `pay_time`, `pay_createdate`, `pay_createby`, `pay_updatedate`, `pay_updateby`) VALUES
(1, 'ชำระภายใน 20 วัน', 20, '2014-12-12', 0, '2015-02-01', 1),
(2, 'ชำระภายใน 15 วัน', 15, '2014-12-12', 0, '2014-12-22', 8),
(3, 'ชำระภายใน 30 วัน', 30, '2014-12-12', 0, '2014-12-22', 8),
(5, 'ชำระภายใน 45 วัน', 45, '2014-12-12', 0, '2014-12-22', 8),
(6, 'ชำระภายใน 60 วัน', 60, '2014-12-22', 8, '2014-12-22', 8),
(7, 'ชำระภายใน 90 วัน', 90, '2015-01-12', 1, '2015-01-12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `per_id` int(11) NOT NULL AUTO_INCREMENT,
  `pre_id` int(2) NOT NULL COMMENT 'คำนำหน้าชื่อ',
  `per_code` varchar(15) NOT NULL,
  `per_fname` varchar(100) NOT NULL,
  `per_lname` varchar(100) NOT NULL,
  `per_username` varchar(50) NOT NULL,
  `per_password` varchar(50) NOT NULL,
  `per_address` text NOT NULL,
  `per_mobile` varchar(15) NOT NULL,
  `per_email` varchar(50) NOT NULL,
  `per_createdate` date NOT NULL,
  `per_createby` int(11) NOT NULL,
  `per_updatedate` date NOT NULL,
  `per_updateby` int(11) NOT NULL,
  `per_status` int(1) NOT NULL DEFAULT '1' COMMENT ' ''1'' => ''พนักงานประจำหน้าร้าน'',''2'' => ''พนักงานประจำโกดัง'',''3'' => ''เจ้าของร้าน'',',
  PRIMARY KEY (`per_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`per_id`, `pre_id`, `per_code`, `per_fname`, `per_lname`, `per_username`, `per_password`, `per_address`, `per_mobile`, `per_email`, `per_createdate`, `per_createby`, `per_updatedate`, `per_updateby`, `per_status`) VALUES
(1, 0, '0000000001', 'admin', 'admin', 'admin', '1234', 'admin', '080', '@hotmail.com', '2014-12-10', 0, '0000-00-00', 0, 1),
(5, 1, '0000000002', 'พูลสวัสดิ์', 'อภิญ', 'pool', '1234', 'ระยอง', '0878356866', 'poon_mp@hotmail.com', '2014-12-21', 0, '2014-12-25', 1, 2),
(7, 1, '0000000003', 'TESTTEST', 'TESTTEST', 'TESTTESTTESTTEST', 'TESTTESTTESTTEST', 'TESTTEST', '111111111111', 'TESTTEST@gmail.com', '2014-12-21', 0, '2014-12-22', 8, 1),
(8, 0, '0000000004', 'UUUUUU', 'UUUUUU', 'UUUUUU', 'UUUUUU', 'UUUUUU', '1111111111', 'UUUUUU@gmail.com', '2014-12-11', 0, '0000-00-00', 0, 1),
(11, 2, 'EMP00001', 'eee', 'eee', 'eee', 'eeeeee', 'eee', '22222222222', 'eee@gmail.com', '2014-12-11', 0, '2015-01-12', 1, 1),
(14, 1, '0000000005', '0000000013', '0000000013', '0000000013', '0000000013', '0000000013', '0000000013', '0000000013@gmail.com', '2014-12-11', 0, '2014-12-25', 1, 1),
(16, 1, 'EMP00012', 'IIIIII', 'IIIIII', 'IIIIII', 'IIIIII', 'IIIIII', '3333333333', '3333333@hotmail.com', '2015-01-12', 1, '2015-01-12', 1, 2),
(17, 1, 'EMP00017', 'GGGGGG', 'GGGGGG', 'GGGGGG', 'GGGGGG', 'GGGGGG', '222222222222', '22@gmain.com', '2015-01-12', 1, '2015-01-12', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `prefix`
--

CREATE TABLE IF NOT EXISTS `prefix` (
  `pre_id` int(11) NOT NULL AUTO_INCREMENT,
  `pre_name` varchar(30) NOT NULL,
  `pre_createdate` date NOT NULL,
  `pre_createby` int(11) NOT NULL,
  `pre_updatedate` date NOT NULL,
  `pre_updateby` int(11) NOT NULL,
  PRIMARY KEY (`pre_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `prefix`
--

INSERT INTO `prefix` (`pre_id`, `pre_name`, `pre_createdate`, `pre_createby`, `pre_updatedate`, `pre_updateby`) VALUES
(1, 'MR', '2014-12-21', 0, '2015-02-07', 1),
(2, 'Miss', '2014-12-22', 8, '2014-12-22', 8),
(3, 'นางสาว', '2015-01-12', 1, '2015-01-12', 1),
(4, 'ด.ช.', '2015-02-07', 1, '2015-02-07', 1),
(5, 'ด.ญ.', '2015-02-07', 1, '2015-02-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `pro_id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_code` varchar(20) NOT NULL,
  `pro_name` varchar(50) NOT NULL,
  `pro_desc` text NOT NULL,
  `pro_amount` int(11) NOT NULL COMMENT 'จำนวน',
  `type_id` int(11) NOT NULL COMMENT 'รูปแบบ กล่อง ลัง ,...',
  `cat_id` int(2) NOT NULL,
  `pro_unitprice_buy` int(11) NOT NULL COMMENT 'ราคาต่อหน่วย',
  `pro_unitprice_sell` int(11) NOT NULL COMMENT 'ราคาขาย',
  `pro_discount` int(11) NOT NULL COMMENT 'ส่วนลดต่อหน่วย',
  `pro_createdate` date NOT NULL,
  `pro_createby` int(11) NOT NULL,
  `pro_updatedate` date NOT NULL,
  `pro_updateby` int(11) NOT NULL,
  PRIMARY KEY (`pro_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pro_id`, `pro_code`, `pro_name`, `pro_desc`, `pro_amount`, `type_id`, `cat_id`, `pro_unitprice_buy`, `pro_unitprice_sell`, `pro_discount`, `pro_createdate`, `pro_createby`, `pro_updatedate`, `pro_updateby`) VALUES
(1, '0000000002', 'เสื้อ', 'เสื้อ', 140, 2, 2, 14, 14, 7, '2014-12-17', 0, '2015-02-03', 1),
(2, '0000000003', 'กางเกง', 'กางเกง', 243, 1, 2, 14, 14, 106, '2014-12-17', 0, '2015-01-14', 1),
(3, '0000000004', 'เหล้าขาว', 'เหล้าขาว', 155, 1, 1, 0, 0, 3, '2014-12-17', 0, '0000-00-00', 0),
(4, '0000000005', 'โค๊ก', 'โค๊ก', 145, 6, 2, 14, 14, 7, '2014-12-17', 0, '2015-01-14', 1),
(5, '0000000006', 'สุรา', 'สุรา', 821, 1, 1, 0, 0, 5, '2014-12-17', 0, '0000-00-00', 0),
(6, '0000000007', 'ยาดอง', 'ยาดอง', 8928, 1, 2, 7, 0, 1, '2014-12-17', 0, '2015-01-10', 1),
(7, '0000000008', 'เลย์', 'เลย์', 10011, 1, 3, 1, 0, 1, '2014-12-15', 0, '2015-01-14', 1),
(8, '0000000009', 'กางเกงใน', 'กางเกงใน', 11, 1, 4, 900, 920, 0, '2014-12-12', 0, '2015-01-14', 1),
(9, '0000000010', 'แสน๊กแจ๊ค', 'แสน๊กแจ๊ค', 101, 1, 3, 11, 0, 0, '2014-12-15', 0, '0000-00-00', 0),
(10, '0000000011', 'รองเท้า', 'รองเท้า', 99, 1, 4, 9, 0, 9, '2014-12-12', 0, '2015-01-09', 1),
(11, '0000000012', 'รีเจ้นซี่', 'รีเจ้นซี่', 1047, 1, 2, 100, 0, 100, '2014-12-17', 0, '0000-00-00', 0),
(12, '0000000013', '55555555', '55555555', 55550000, 1, 2, 55555555, 0, 55555555, '2014-12-13', 0, '2015-01-09', 1),
(13, '0000000014', 'ทดสอบ', 'ทดสอบ', 5556, 1, 2, 1, 0, 1, '2014-12-16', 0, '2015-01-09', 1),
(14, '0000000014', '133', '133', 14233, 1, 2, 133, 0, 133, '2014-12-16', 0, '2015-01-10', 1),
(15, '0000000015', '133', '133', 133, 1, 2, 133, 0, 133, '2014-12-16', 0, '2015-01-09', 1),
(16, '0000000016', 'เสื้อ กล้าม', 'เสื้อ กล้าม', 1, 1, 2, 1, 0, 1, '2014-12-16', 0, '0000-00-00', 0),
(17, '0000000017', 'CocaCola', 'CocaCola', 11111, 6, 2, 1111, 0, 111, '2014-12-22', 8, '2014-12-22', 8),
(18, 'ITEM00018', 'สินค้า ราคายย่อมเยา', 'สินค้า ราคายย่อมเยา', 12323, 1, 3, 199, 100, 100, '2015-01-14', 1, '2015-01-14', 1),
(19, 'ITEM00019', 'ฮานามิ', 'ฮานามิ', 111, 7, 3, 100, 120, 0, '2015-01-14', 1, '2015-01-14', 1),
(20, 'ITEM00020', 'เสื้อ กล้าม', 'เสื้อ กล้าม', 100, 10, 4, 1000, 100, 0, '2015-02-07', 1, '2015-02-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `store_contact`
--

CREATE TABLE IF NOT EXISTS `store_contact` (
  `sto_id` int(11) NOT NULL AUTO_INCREMENT,
  `sto_code` varchar(15) NOT NULL,
  `sto_name` varchar(50) NOT NULL,
  `sto_desc` varchar(255) NOT NULL,
  `pre_id` int(11) NOT NULL,
  `sto_onwer` varchar(50) NOT NULL,
  `sto_pid` varchar(13) NOT NULL,
  `sto_address` text NOT NULL,
  `sto_telephone` varchar(15) NOT NULL,
  `sto_createdate` date NOT NULL,
  `sto_createby` int(11) NOT NULL,
  `sto_updatedate` date NOT NULL,
  `sto_updateby` int(11) NOT NULL,
  PRIMARY KEY (`sto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `store_contact`
--

INSERT INTO `store_contact` (`sto_id`, `sto_code`, `sto_name`, `sto_desc`, `pre_id`, `sto_onwer`, `sto_pid`, `sto_address`, `sto_telephone`, `sto_createdate`, `sto_createby`, `sto_updatedate`, `sto_updateby`) VALUES
(13, 'CUS00007', 'name', 'desc', 1, 'onwer', 'pid', 'address', 'tel', '2015-01-12', 1, '2015-01-12', 1),
(14, 'CUS00009', 'POOLSAWAT', 'POOLSAWAT', 1, 'POOLSAWAT', 'POOLSAWAT', 'POOLSAWAT', 'POOLSAWAT', '2015-01-12', 1, '2015-01-12', 1),
(15, 'CUS00015', 'ร้าน boto', 'ร้าน boto อยู่อรัญ', 1, 'โบ๊ท', '1234567891011', 'อรัญ', '0800000000', '2015-02-07', 1, '2015-02-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_contact`
--

CREATE TABLE IF NOT EXISTS `supplier_contact` (
  `sup_id` int(11) NOT NULL AUTO_INCREMENT,
  `sup_code` varchar(15) NOT NULL,
  `sup_name` varchar(100) NOT NULL,
  `sup_desc` text NOT NULL,
  `sup_orderday` varchar(50) NOT NULL,
  `sup_deliveryday` varchar(50) NOT NULL,
  `sup_address` text NOT NULL,
  `sup_telephone` varchar(15) NOT NULL,
  `sup_fax` varchar(50) NOT NULL,
  `sup_createdate` date NOT NULL,
  `sup_createby` int(11) NOT NULL,
  `sup_updatedate` date NOT NULL,
  `sup_updateby` int(11) NOT NULL,
  PRIMARY KEY (`sup_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `supplier_contact`
--

INSERT INTO `supplier_contact` (`sup_id`, `sup_code`, `sup_name`, `sup_desc`, `sup_orderday`, `sup_deliveryday`, `sup_address`, `sup_telephone`, `sup_fax`, `sup_createdate`, `sup_createby`, `sup_updatedate`, `sup_updateby`) VALUES
(13, 'SUP00001', 'ทดสอบ orderday', 'ทดสอบ orderday', '1,2,3,4,5,6,7', '1,2,3,4,5,6,7', 'ทดสอบ orderday', 'ทดสอบ orderday', 'ทดสอบ orderday', '2015-01-11', 1, '2015-01-12', 1),
(15, 'SUP00002', 'ชำระภายใน 15 วัน', 'ชำระภายใน 15 วัน', '2,3,5,6,7', '2,4,5,6,7', 'ชำระภายใน 15 วัน', 'ชำระภายใน', 'ชำระภายใน', '2015-01-11', 1, '2015-01-12', 1),
(16, 'SUP00003', 'CocaCola', 'CocaCola', '1,3,5,6', '2,3,5,6', 'ชำระภายใน 15 วัน', 'ชำระภายใน', 'ชำระภายใน', '2015-01-11', 1, '2015-01-12', 1),
(18, 'SUP00005', '222', 'data-validation-engine="validate[required]"\r\n                           data-errormessage-value-missing="กรุณาเลือก วัน" />', '1,2,3,4,5,6,7', '1,2,3,4,5,6,7', '222', '222', '222', '2015-01-11', 1, '2015-01-12', 1),
(21, 'SUP00008', '.val(e.val);', '.val(e.val);', '2,3,4,6', '2,4,5', '.val(e.val);', '.val(e.val);', '.val(e.val);', '2015-01-11', 1, '2015-01-12', 1),
(22, 'SUP00009', 'Apin Store', 'Apin Store', '1,4', '2,3,5', 'ระยอง', '0800000000', '-', '2015-02-07', 1, '2015-02-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(50) NOT NULL,
  `type_desc` text NOT NULL,
  `type_createdate` date NOT NULL,
  `type_createby` int(11) NOT NULL,
  `type_updatedate` date NOT NULL,
  `type_updateby` int(11) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`type_id`, `type_name`, `type_desc`, `type_createdate`, `type_createby`, `type_updatedate`, `type_updateby`) VALUES
(1, 'กล่อง', 'กล่อง', '2014-12-11', 8, '2014-12-22', 8),
(2, 'ลัง', 'ลัง', '2014-12-11', 8, '2014-12-22', 8),
(3, 'แพ็ค', 'แพ็ค', '2014-12-11', 8, '2014-12-22', 8),
(4, 'แผ่น', 'แผ่น', '2014-12-13', 8, '2014-12-22', 8),
(6, 'ขวด', 'ขวด', '2014-12-11', 8, '2014-12-22', 8),
(7, 'ซอง', 'ซอง', '2014-12-11', 8, '2014-12-22', 8),
(8, 'คัน', 'คัน', '0000-00-00', 8, '2014-12-22', 8),
(9, 'เล่ม', 'เล่ม', '0000-00-00', 8, '2014-12-22', 8),
(10, 'ตัว', 'ตัว เสื้อ กางเกง กางเกงใน', '2015-02-07', 1, '2015-02-07', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
