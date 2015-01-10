-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2015 at 03:57 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `adjust`
--

INSERT INTO `adjust` (`adj_id`, `pro_id`, `adj_product_lastamount`, `adj_adjust_no`, `adj_remark`, `adj_type`, `adj_createdate`, `adj_createby`, `adj_updatedate`, `adj_updateby`) VALUES
(1, 8, 11, 100, 'ปรับเพราะ แตก', 'add', '2015-01-09', 1, '2015-01-09', 1),
(2, 14, 133, 10000, '10000', 'add', '2015-01-09', 1, '2015-01-09', 1),
(4, 12, 55555555, 5555, '5555', 'remove', '2015-01-09', 1, '2015-01-09', 1),
(5, 13, 1, 5555, '5555', 'add', '2015-01-09', 1, '2015-01-09', 1),
(6, 6, 39, 111111, '111111  111111', 'remove', '2015-01-09', 1, '2015-01-09', 1),
(7, 2, 143, 100, '100 100', 'add', '2015-01-09', 1, '2015-01-09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bill_in`
--

CREATE TABLE IF NOT EXISTS `bill_in` (
  `billin_id` int(11) NOT NULL AUTO_INCREMENT,
  `billin_invoicescode` varchar(15) NOT NULL COMMENT 'เลขที่ใบแจ้งหนี้',
  `billin_taxcode` varchar(20) NOT NULL COMMENT 'เลขที่ใบกำกับภาษี',
  `billin_indate` date NOT NULL COMMENT 'วันที่รับเข้า',
  `store_id` int(11) NOT NULL COMMENT 'รหัสร้าน',
  `billin_doccode` varchar(15) NOT NULL,
  `billin_docdate` date NOT NULL COMMENT 'เลขที่เอกสาร',
  `pay_id` int(11) NOT NULL COMMENT 'รหัสระยะเวลาจ่ายเงิน',
  `billin_finishdate` date NOT NULL COMMENT 'วันครบกำหนด',
  `billin_paycode` varchar(15) NOT NULL COMMENT 'เลขที่ใบสั่งขาย',
  `officer_id` int(11) NOT NULL COMMENT 'รหัสพนักงาน',
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
  `billin_status` int(1) NOT NULL DEFAULT '1' COMMENT 'สถานะ  ''0'' => ''ลบ'',''1'' => ''ปกติ รับของเรียบร้อย'',''2'' => ''อนุมัติ ผ่าน'',''3'' => ''อนุมัติ ไม่ผ่าน''',
  PRIMARY KEY (`billin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `bill_in`
--

INSERT INTO `bill_in` (`billin_id`, `billin_invoicescode`, `billin_taxcode`, `billin_indate`, `store_id`, `billin_doccode`, `billin_docdate`, `pay_id`, `billin_finishdate`, `billin_paycode`, `officer_id`, `billin_localtioncode`, `billin_weight`, `billin_pricebeforevat`, `billin_vat`, `billin_priceaftervat`, `billin_sender`, `billin_receiver`, `billin_autherized`, `billin_createdate`, `billin_createby`, `billin_updatedate`, `billin_updateby`, `billin_status`) VALUES
(2, '0000000002', '55555555', '2014-12-02', 1, '1', '2014-12-12', 1, '2014-12-03', '1', 2, 3, 0, 0, 0, 0, '0', '0', '', '2014-12-15', 0, '0000-00-00', 0, 0),
(15, '0000000007', '9090909090', '1900-11-06', 1, '5555555', '1900-11-13', 5, '1900-11-06', '5555555', 5555555, 5555555, 100, 247, 11, 274, '1111', '111', '11', '2014-12-20', 0, '2015-01-09', 1, 1),
(16, '0000000008', 'TEST', '2014-12-03', 1, 'TEST TEST', '2014-12-02', 1, '2014-12-11', '111', 111, 1111, 0, 269733, 111, 569136, '0', '0', '', '2014-12-20', 0, '2014-12-22', 8, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=106 ;

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
(105, '0000000003', 1, 1, '1111111', 1, 1, 1, 16, '2014-12-17');

-- --------------------------------------------------------

--
-- Table structure for table `bill_out`
--

CREATE TABLE IF NOT EXISTS `bill_out` (
  `billout_id` int(11) NOT NULL AUTO_INCREMENT,
  `billout_code` varchar(15) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `billout_outdate` date NOT NULL,
  `officer_id` int(11) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `bill_out`
--

INSERT INTO `bill_out` (`billout_id`, `billout_code`, `customer_id`, `billout_outdate`, `officer_id`, `pay_id`, `billout_receiver`, `billout_sender`, `billout_createdate`, `billout_createby`, `billout_updatedate`, `billout_updateby`, `billout_total`, `billout_status`) VALUES
(4, '111', 6, '2014-10-06', 11, 1, 'พูลสวัสดิ์', 'พูลสวัสดิ์', '2014-12-20', 0, '0000-00-00', 0, 12999, 0),
(6, '1', 9, '2014-12-01', 1111, 4, 'boto', 'boto', '2014-12-20', 0, '2014-12-22', 8, 111, 1),
(7, '1', 9, '2014-12-01', 1111, 4, 'boto', 'boto', '2014-12-20', 0, '2014-12-22', 8, 16, 1),
(8, '1111111', 7, '2014-12-02', 1111, 1, '22', '222', '2014-12-20', 0, '0000-00-00', 0, 42736, 1),
(9, '1111111', 7, '2014-12-02', 1111, 1, '22', '222', '2014-12-20', 0, '0000-00-00', 0, 559, 0),
(10, '1111111', 7, '2014-12-02', 1111, 1, '22', '222', '2014-12-20', 0, '0000-00-00', 0, 33550, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

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
(17, '0000000004', 1, 1, 1, 1, 8, '2014-12-20'),
(18, '0000000006', 555, 77, 88, 42735, 8, '2014-12-20');

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
(1, 'แอลกอฮอร์', 'แอลกอฮอร์', '2014-12-11', 0, '2014-12-22', 8),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `pay_condition`
--

INSERT INTO `pay_condition` (`pay_id`, `pay_name`, `pay_time`, `pay_createdate`, `pay_createby`, `pay_updatedate`, `pay_updateby`) VALUES
(1, 'ชำระภายใน 20 วัน', 20, '2014-12-12', 0, '2014-12-22', 8),
(2, 'ชำระภายใน 15 วัน', 15, '2014-12-12', 0, '2014-12-22', 8),
(3, 'ชำระภายใน 30 วัน', 30, '2014-12-12', 0, '2014-12-22', 8),
(5, 'ชำระภายใน 45 วัน', 45, '2014-12-12', 0, '2014-12-22', 8),
(6, 'ชำระภายใน 60 วัน', 60, '2014-12-22', 8, '2014-12-22', 8);

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
  `per_status` int(1) NOT NULL DEFAULT '1' COMMENT '1 = ทั่วไปรอ อนุมัติ หรือปรับเปลี่ยนสถานะ default , 2 = เจ้าหน้าดูแลระบบ , 3 = เจ้าหน้าที่ officer ,4 = ลูกค้า ร้านค้า customer ,5 =vnder supplier',
  PRIMARY KEY (`per_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`per_id`, `pre_id`, `per_code`, `per_fname`, `per_lname`, `per_username`, `per_password`, `per_address`, `per_mobile`, `per_email`, `per_createdate`, `per_createby`, `per_updatedate`, `per_updateby`, `per_status`) VALUES
(1, 0, '0000000001', 'admin', 'admin', 'admin', '1234', 'admin', '080', '@hotmail.com', '2014-12-10', 0, '0000-00-00', 0, 1),
(5, 1, '0000000002', 'พูลสวัสดิ์', 'อภิญ', 'pool13433', 'pool123', 'ระยอง', '0878356866', 'poon_mp@hotmail.com', '2014-12-21', 0, '2014-12-25', 1, 2),
(7, 1, '0000000003', 'TESTTEST', 'TESTTEST', 'TESTTESTTESTTEST', 'TESTTESTTESTTEST', 'TESTTEST', '111111111111', 'TESTTEST@gmail.com', '2014-12-21', 0, '2014-12-22', 8, 1),
(8, 0, '0000000004', 'UUUUUU', 'UUUUUU', 'UUUUUU', 'UUUUUU', 'UUUUUU', '1111111111', 'UUUUUU@gmail.com', '2014-12-11', 0, '0000-00-00', 0, 1),
(9, 0, '', 'RRRRRR', 'RRRRRR', 'RRRRRR', 'RRRRRR', 'RRRRRR', '12345678900', 'RRRRRR@gmail.com', '2014-12-11', 0, '0000-00-00', 0, 4),
(10, 0, '', 'FFFFFFFFF', 'FFFFFFFFF', 'FFFFFFFFF', 'FFFFFFFFF', 'FFFFFFFFF', '98765432111', 'FFFFFFFFF@gmail.com', '2014-12-11', 0, '0000-00-00', 0, 2),
(11, 0, '', 'eee', 'eee', 'eee', 'eeeeee', 'eee', '22222222222', 'eee@gmail.com', '2014-12-11', 0, '0000-00-00', 0, 4),
(12, 0, '', 'TEST CODE', 'TEST CODE', 'TEST CODE', 'TEST CODE', 'TEST CODE', '11111111111', 'TEST_CODE@gmail.com', '2014-12-11', 0, '0000-00-00', 0, 1),
(13, 0, '', '0000000012', '0000000012', '0000000012', '0000000012', '0000000012', '0000000012', '0000000012@gmail.com', '2014-12-11', 0, '0000-00-00', 0, 1),
(14, 1, '0000000005', '0000000013', '0000000013', '0000000013', '0000000013', '0000000013', '0000000013', '0000000013@gmail.com', '2014-12-11', 0, '2014-12-25', 1, 1),
(15, 0, '', '0000000014', '0000000014', '0000000014', '0000000014', '0000000014', '0000000014', '0000000014@gmail.com', '2014-12-11', 0, '0000-00-00', 0, 4);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `prefix`
--

INSERT INTO `prefix` (`pre_id`, `pre_name`, `pre_createdate`, `pre_createby`, `pre_updatedate`, `pre_updateby`) VALUES
(1, 'MR', '2014-12-21', 0, '2014-12-22', 8),
(2, 'Miss', '2014-12-22', 8, '2014-12-22', 8);

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
  `pro_unitprice` int(11) NOT NULL COMMENT 'ราคาต่อหน่วย',
  `pro_discount` int(11) NOT NULL COMMENT 'ส่วนลดต่อหน่วย',
  `pro_createdate` date NOT NULL,
  `pro_createby` int(11) NOT NULL,
  `pro_updatedate` date NOT NULL,
  `pro_updateby` int(11) NOT NULL,
  PRIMARY KEY (`pro_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pro_id`, `pro_code`, `pro_name`, `pro_desc`, `pro_amount`, `type_id`, `cat_id`, `pro_unitprice`, `pro_discount`, `pro_createdate`, `pro_createby`, `pro_updatedate`, `pro_updateby`) VALUES
(1, '0000000002', 'เสื้อ', 'เสื้อ', 140, 2, 2, 14, 7, '2014-12-17', 0, '0000-00-00', 0),
(2, '0000000003', 'กางเกง', 'กางเกง', 243, 1, 2, 14, 106, '2014-12-17', 0, '2015-01-09', 1),
(3, '0000000004', 'เหล้าขาว', 'เหล้าขาว', 155, 1, 1, 0, 3, '2014-12-17', 0, '0000-00-00', 0),
(4, '0000000005', 'โค๊ก', 'โค๊ก', 145, 6, 2, 14, 7, '2014-12-17', 0, '0000-00-00', 0),
(5, '0000000006', 'สุรา', 'สุรา', 821, 1, 1, 0, 5, '2014-12-17', 0, '0000-00-00', 0),
(6, '0000000007', 'ยาดอง', 'ยาดอง', -111072, 1, 2, 7, 1, '2014-12-17', 0, '2015-01-09', 1),
(7, '0000000008', 'เลย์', 'เลย์', 10011, 1, 3, 1, 1, '2014-12-15', 0, '0000-00-00', 0),
(8, '0000000009', 'กางเกงใน', 'กางเกงใน', 11, 1, 4, 1, 0, '2014-12-12', 0, '0000-00-00', 0),
(9, '0000000010', 'แสน๊กแจ๊ค', 'แสน๊กแจ๊ค', 101, 1, 3, 11, 0, '2014-12-15', 0, '0000-00-00', 0),
(10, '0000000011', 'รองเท้า', 'รองเท้า', 99, 1, 4, 9, 9, '2014-12-12', 0, '2015-01-09', 1),
(11, '0000000012', 'รีเจ้นซี่', 'รีเจ้นซี่', 1047, 1, 2, 100, 100, '2014-12-17', 0, '0000-00-00', 0),
(12, '0000000013', '55555555', '55555555', 55550000, 1, 2, 55555555, 55555555, '2014-12-13', 0, '2015-01-09', 1),
(13, '0000000014', 'ทดสอบ', 'ทดสอบ', 5556, 1, 2, 1, 1, '2014-12-16', 0, '2015-01-09', 1),
(14, '0000000014', '133', '133', 10000, 1, 2, 133, 133, '2014-12-16', 0, '2015-01-09', 1),
(15, '0000000015', '133', '133', 133, 1, 2, 133, 133, '2014-12-16', 0, '2015-01-09', 1),
(16, '0000000016', 'เสื้อ กล้าม', 'เสื้อ กล้าม', 1, 1, 2, 1, 1, '2014-12-16', 0, '0000-00-00', 0),
(17, '0000000017', 'CocaCola', 'CocaCola', 11111, 6, 2, 1111, 111, '2014-12-22', 8, '2014-12-22', 8);

-- --------------------------------------------------------

--
-- Table structure for table `store_contact`
--

CREATE TABLE IF NOT EXISTS `store_contact` (
  `store_id` int(11) NOT NULL AUTO_INCREMENT,
  `store_code` varchar(15) NOT NULL,
  `store_name` varchar(50) NOT NULL,
  `store_desc` varchar(255) NOT NULL,
  `store_onwer` varchar(50) NOT NULL,
  `store_address` text NOT NULL,
  `store_type` varchar(10) NOT NULL COMMENT 'ven,cus',
  `store_createdate` date NOT NULL,
  `store_createby` int(11) NOT NULL,
  `store_updatedate` date NOT NULL,
  `store_updateby` int(11) NOT NULL,
  PRIMARY KEY (`store_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `store_contact`
--

INSERT INTO `store_contact` (`store_id`, `store_code`, `store_name`, `store_desc`, `store_onwer`, `store_address`, `store_type`, `store_createdate`, `store_createby`, `store_updatedate`, `store_updateby`) VALUES
(1, 'ven000000001', 'ร้านขายพาสติก', 'ร้านขายพาสติก ร้านขายพาสติก', 'พูลสวัสดิ์', 'ร้านขายพาสติก', 'ven', '2014-12-11', 0, '2014-12-23', 1),
(2, 'ven000000002', 'ร้าน boto', 'ร้าน boto', 'ร้าน boto', 'ร้าน boto', 'ven', '2014-12-11', 0, '2014-12-23', 1),
(6, 'ven00000003', 'ทำ โมดูล แนบไฟล์เอกสารของโปรเจคทั้งหมด', 'ทำ โมดูล แนบไฟล์เอกสารของโปรเจคทั้งหมด', 'ทำ โมดูล แนบไฟล์เอกสารของโปรเจคทั้งหมด', 'ร้าน botoร้าน botoร้าน botoร้าน botoร้าน boto', 'ven', '2014-12-11', 0, '2014-12-23', 1),
(7, 'cus000000004', 'รีเจ้นซี่', 'รีเจ้นซี่', 'รีเจ้นซี่', 'รีเจ้นซี่รีเจ้นซี่รีเจ้นซี่', 'cus', '2014-12-11', 0, '0000-00-00', 0),
(8, 'ven000000005', 'ลองกอง', 'ลองกอง', 'ลองกอง', 'ลองกอง', 'ven', '2014-12-11', 0, '0000-00-00', 0),
(9, 'cusven000000000', 'ระยอง ฮิ', 'ระยอง ฮิ', 'ระยอง ฮิ', 'ระยอง ฮิ', 'cus', '2014-12-11', 0, '0000-00-00', 0),
(10, 'ven000000007', 'หม้อเบอร์  ๔๐', 'หม้อเบอร์  ๔๐', 'หม้อเบอร์  ๔๐', 'หม้อเบอร์  ๔๐', 'ven', '2014-12-11', 0, '0000-00-00', 0),
(11, 'ven000000008', 'BOTO', 'BOTO', 'รีเจ้นซี่', 'BOTO', 'ven', '2014-12-20', 0, '2014-12-22', 8),
(12, 'cus0000000008', 'BOTO BoTo', 'BOTO BoTo', 'BOTO BoTo', 'BOTO BoTo', 'cus', '2014-12-22', 8, '2014-12-22', 8);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

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
(9, 'เล่ม', 'เล่ม', '0000-00-00', 8, '2014-12-22', 8);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
