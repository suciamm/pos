-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2019 at 08:58 AM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id_account` int(2) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `level` enum('admin','user') NOT NULL DEFAULT 'user',
  `status` enum('T','F') NOT NULL DEFAULT 'T'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id_account`, `username`, `password`, `level`, `status`) VALUES
(1, 'internetworking46@gmail.com', '0b1e50e1fd71c96bac94144cc59cff40', 'admin', 'T');

-- --------------------------------------------------------

--
-- Table structure for table `d_promo`
--

CREATE TABLE `d_promo` (
  `detail_promo_id` int(10) NOT NULL,
  `promo_code` varchar(10) NOT NULL,
  `promo_id` int(5) NOT NULL,
  `promo_type` enum('all','custom') NOT NULL DEFAULT 'all',
  `promo_payment` enum('all','custom') NOT NULL DEFAULT 'all',
  `id_product` int(10) DEFAULT NULL,
  `id_payment` int(10) DEFAULT NULL,
  `discount` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_promo`
--

INSERT INTO `d_promo` (`detail_promo_id`, `promo_code`, `promo_id`, `promo_type`, `promo_payment`, `id_product`, `id_payment`, `discount`) VALUES
(104, '111402', 30, 'all', 'all', NULL, NULL, '10');

-- --------------------------------------------------------

--
-- Table structure for table `d_sales`
--

CREATE TABLE `d_sales` (
  `id` int(20) NOT NULL,
  `product_code` varchar(20) NOT NULL,
  `qty` varchar(10) NOT NULL,
  `sales_code` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_sales`
--

INSERT INTO `d_sales` (`id`, `product_code`, `qty`, `sales_code`) VALUES
(332, 'Wes1', '2', '1901220939-79'),
(329, 'Nus5', '1', '1901210624-78'),
(328, 'Nus7', '2', '1901210624-78'),
(327, 'Wes1', '1', '1901210624-78'),
(326, 'Wes1', '1', '1901210608-77'),
(325, 'Wes1', '1', '1901210600-76'),
(324, 'Ori1', '1', '1901210600-76'),
(323, 'Ju1', '1', '1901210314-75'),
(322, 'Ori1', '1', '1901210155-74'),
(310, 'Nus7', '1', '1901140248-68'),
(311, 'Ju1', '1', '1901170525-69'),
(312, 'Ori1', '1', '1901170525-69'),
(313, 'Ju2', '2', '1901180102-70'),
(314, 'Ori1', '2', '1901180102-70'),
(315, 'Ori1', '232', '1901180120-71'),
(316, 'Ju1', '21', '1901180120-71'),
(317, 'Nus2', '37', '1901180120-71'),
(318, 'Ori1', '2', '1901180933-72'),
(319, 'Ju2', '2', '1901180933-72'),
(320, 'Nusab1', '2', '1901211012-73'),
(321, 'Ju1', '2', '1901211012-73'),
(309, 'Nus5', '2', '1901140248-68'),
(308, 'Nus6', '1', '1901140248-68'),
(307, 'Nus2', '1', '1901140248-68'),
(306, 'Co1', '1', '1901140248-68'),
(305, 'JU3', '1', '1901140248-68'),
(304, 'Ju2', '1', '1901140248-68'),
(303, 'Ju1', '1', '1901140248-68'),
(301, 'Nusab1', '2', '1901090539-67'),
(302, 'Ju1', '2', '1901090539-67'),
(298, 'Ju1', '3', '1901090537-1'),
(299, 'Ju2', '3', '1901090537-1'),
(300, 'Nusab1', '2', '1901090537-1'),
(333, 'Ori1', '1', '1901220939-79'),
(334, 'Ju2', '1', '1901220202-80'),
(335, 'Ori1', '1', '1901220202-80'),
(336, 'Nusab1', '1', '1901220312-81'),
(337, 'Nus2', '1', '1901220312-81'),
(338, 'Ori1', '1', '1901220617-82'),
(339, 'Wes1', '1', '1901220617-82'),
(340, 'Ju1', '1', '1901220617-82'),
(341, 'Ori1', '2', '1901220620-83'),
(360, 'Ju2', '1', '1901300740-87'),
(343, 'Ori1', '1', '1901230945-85'),
(344, 'Wes1', '1', '1901230945-85'),
(345, 'Ori1', '1', '1901230949-86'),
(346, 'Wes1', '1', '1901230949-86'),
(347, 'Nusab1', '1', '1901230949-86'),
(359, 'Ori1', '2', '1901230944-84'),
(358, 'Wes1', '1', '1901230944-84'),
(357, 'Nus2', '1', '1901230944-84'),
(361, 'Nus7', '2', '1901300740-87'),
(362, 'Nus7', '3', '1901300741-88'),
(363, 'Wes1', '4', '1901300741-88');

-- --------------------------------------------------------

--
-- Table structure for table `m_menu`
--

CREATE TABLE `m_menu` (
  `id_menu` int(3) NOT NULL,
  `menu` varchar(30) NOT NULL,
  `icon` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_menu`
--

INSERT INTO `m_menu` (`id_menu`, `menu`, `icon`) VALUES
(43, 'Beverage', 'beverage.png'),
(42, 'Food', 'food.png');

-- --------------------------------------------------------

--
-- Table structure for table `m_payment_type`
--

CREATE TABLE `m_payment_type` (
  `id_payment` int(3) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_payment_type`
--

INSERT INTO `m_payment_type` (`id_payment`, `name`) VALUES
(52, 'OVO'),
(53, 'GO-PAY'),
(54, 'Credit'),
(55, 'Debit'),
(56, 'Cash');

-- --------------------------------------------------------

--
-- Table structure for table `m_product`
--

CREATE TABLE `m_product` (
  `id` int(10) NOT NULL,
  `product_code` varchar(20) NOT NULL,
  `product` varchar(100) NOT NULL,
  `qty` int(10) NOT NULL,
  `price` int(15) NOT NULL,
  `status` enum('ready','not') NOT NULL DEFAULT 'not',
  `image` varchar(100) NOT NULL,
  `id_submenu` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_product`
--

INSERT INTO `m_product` (`id`, `product_code`, `product`, `qty`, `price`, `status`, `image`, `id_submenu`) VALUES
(10, 'nus4', 'Tempe Goreng', 50, 3000, 'ready', 'product_nus4.jpg', 16),
(9, 'Nus3', 'Tahu', 50, 3000, 'ready', 'product_nus3.jpg', 16),
(7, 'Nusab1', 'Ayam Bakar', 10, 13000, 'ready', 'product_nusab1.jpg', 16),
(8, 'Nus2', 'Ayam Goreng', 10, 12000, 'ready', 'product_nus2.jpg', 16),
(11, 'Nus5', 'Nasi Putih', 50, 5000, 'ready', 'product_nus5.jpg', 16),
(12, 'Nus6', 'Mie Goreng', 50, 10000, 'ready', 'product_nus6.jpg', 16),
(13, 'Nus7', 'Omlet', 50, 7000, 'ready', 'product_nus7.jpg', 16),
(14, 'Wes1', 'Steak ', 15, 35000, 'ready', 'product_wes1.jpg', 65),
(15, 'Ori1', 'Sushi', 10, 45000, 'ready', 'product_ori1.jpg', 64),
(16, 'Ju1', 'Jus Mangga', 100, 10000, 'ready', 'product_ju1.png', 12),
(17, 'Ju2', 'Jus Jeruk', 100, 10000, 'ready', 'product_ju2.png', 12),
(18, 'JU3', 'Jus Alpukat', 100, 13000, 'ready', 'product_ju3.jpg', 12),
(19, 'Co1', 'Coffe Late', 16, 14000, 'ready', 'product_co1.jpg', 13),
(20, '34234', 'Teh Ayam', 34334, 35000, 'ready', 'product_34234.jpg', 13);

-- --------------------------------------------------------

--
-- Table structure for table `m_promo`
--

CREATE TABLE `m_promo` (
  `promo_id` int(4) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_promo`
--

INSERT INTO `m_promo` (`promo_id`, `start`, `end`) VALUES
(30, '2019-01-23 01:00:51', '2019-01-24 23:00:56');

-- --------------------------------------------------------

--
-- Table structure for table `m_submenu`
--

CREATE TABLE `m_submenu` (
  `id_submenu` int(3) NOT NULL,
  `submenu` varchar(50) NOT NULL,
  `id_menu` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_submenu`
--

INSERT INTO `m_submenu` (`id_submenu`, `submenu`, `id_menu`) VALUES
(12, 'Juice', 43),
(13, 'Cofee', 43),
(15, 'Soda', 43),
(16, 'Nusantara', 42),
(64, 'Oriental', 42),
(65, 'Western', 42),
(66, 'submenu2', 123);

-- --------------------------------------------------------

--
-- Table structure for table `m_table`
--

CREATE TABLE `m_table` (
  `table_id` int(3) NOT NULL,
  `table_code` varchar(15) NOT NULL,
  `table_number` varchar(10) NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_table`
--

INSERT INTO `m_table` (`table_id`, `table_code`, `table_number`, `status`) VALUES
(83, 'TAB-8', '8', 'N'),
(82, 'TAB-7', '7', 'N'),
(80, 'TAB-5', '5', 'N'),
(50, 'TAB-3', '3', 'N'),
(81, 'TAB-6', '6', 'N'),
(79, 'TAB-4', '4', 'N'),
(84, 'TAB-9', '9', 'N'),
(85, 'TAB-10', '10', 'Y'),
(115, 'TAB-1', '1', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(1) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `app_name` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `name`, `phone`, `email`, `address`, `app_name`) VALUES
(3, 'PT Awan Teknologi Inovasi', ' +62212998092', 'ati@cloudtech.id', 'Jalan Radein Intan, Gang Patriot, RT 03/02, Kel. Wayurang, Kec. Kalianda', 'ATI');

-- --------------------------------------------------------

--
-- Table structure for table `t_payment`
--

CREATE TABLE `t_payment` (
  `id` int(10) NOT NULL,
  `sales_code` varchar(15) NOT NULL,
  `id_payment` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_payment`
--

INSERT INTO `t_payment` (`id`, `sales_code`, `id_payment`) VALUES
(49, '1901230944-84', 54),
(48, '1901300741-88', 56),
(47, '1901230945-85', 55),
(46, '1901230949-86', 55),
(45, '1901220620-83', 55),
(44, '1901220617-82', 55),
(43, '1901180933-72', 52),
(42, '1901211012-73', 53),
(41, '1901210600-76', 55),
(40, '1901210608-77', 52),
(39, '1901210624-78', 55),
(38, '1901210155-74', 54),
(37, '1901210314-75', 55);

-- --------------------------------------------------------

--
-- Table structure for table `t_sales`
--

CREATE TABLE `t_sales` (
  `id` int(10) NOT NULL,
  `sales_code` varchar(15) NOT NULL,
  `date` datetime NOT NULL,
  `total` float NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'N',
  `operator` varchar(50) NOT NULL,
  `table_id` int(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_sales`
--

INSERT INTO `t_sales` (`id`, `sales_code`, `date`, `total`, `status`, `operator`, `table_id`) VALUES
(73, '1901211012-73', '2019-01-21 10:12:42', 46000, 'Y', 'internetworking46@gmail.com', 85),
(71, '1901180120-71', '2019-01-18 01:20:52', 11094000, 'Y', 'internetworking46@gmail.com', NULL),
(72, '1901180933-72', '2019-01-18 09:33:35', 110000, 'Y', 'internetworking46@gmail.com', 115),
(70, '1901180102-70', '2019-01-18 01:02:59', 110000, 'Y', 'internetworking46@gmail.com', NULL),
(69, '1901170525-69', '2019-01-17 17:25:50', 55000, 'Y', 'internetworking46@gmail.com', NULL),
(68, '1901140248-68', '2019-01-14 02:48:15', 86000, 'Y', 'internetworking46@gmail.com', NULL),
(67, '1901090539-67', '2019-01-09 17:39:06', 46000, 'Y', 'internetworking46@gmail.com', 50),
(66, '1901090537-1', '2019-01-09 17:37:02', 86000, 'Y', 'internetworking46@gmail.com', NULL),
(74, '1901210155-74', '2019-01-21 13:55:34', 45000, 'Y', 'internetworking46@gmail.com', NULL),
(75, '1901210314-75', '2019-01-21 15:14:33', 10000, 'Y', 'internetworking46@gmail.com', NULL),
(76, '1901210600-76', '2019-01-21 18:00:02', 80000, 'Y', 'internetworking46@gmail.com', 50),
(77, '1901210608-77', '2019-01-21 18:08:37', 35000, 'Y', 'internetworking46@gmail.com', NULL),
(78, '1901210624-78', '2019-01-21 18:24:45', 54000, 'Y', 'internetworking46@gmail.com', NULL),
(79, '1901220939-79', '2019-01-22 09:39:28', 115000, 'N', 'internetworking46@gmail.com', 115),
(80, '1901220202-80', '2019-01-22 14:02:40', 55000, 'N', 'internetworking46@gmail.com', NULL),
(81, '1901220312-81', '2019-01-22 15:12:32', 25000, 'N', 'internetworking46@gmail.com', NULL),
(82, '1901220617-82', '2019-01-22 18:17:14', 90000, 'Y', 'internetworking46@gmail.com', 85),
(83, '1901220620-83', '2019-01-22 18:20:22', 90000, 'Y', 'internetworking46@gmail.com', NULL),
(84, '1901230944-84', '2019-01-23 09:44:43', 137000, 'Y', 'internetworking46@gmail.com', NULL),
(85, '1901230945-85', '2019-01-23 09:45:25', 80000, 'Y', 'internetworking46@gmail.com', NULL),
(86, '1901230949-86', '2019-01-23 09:49:07', 93000, 'Y', 'internetworking46@gmail.com', NULL),
(87, '1901300740-87', '2019-01-30 19:40:42', 24000, 'N', 'internetworking46@gmail.com', 85),
(88, '1901300741-88', '2019-01-30 19:41:01', 161000, 'Y', 'internetworking46@gmail.com', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id_account`);

--
-- Indexes for table `d_promo`
--
ALTER TABLE `d_promo`
  ADD PRIMARY KEY (`detail_promo_id`);

--
-- Indexes for table `d_sales`
--
ALTER TABLE `d_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_menu`
--
ALTER TABLE `m_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `m_payment_type`
--
ALTER TABLE `m_payment_type`
  ADD PRIMARY KEY (`id_payment`);

--
-- Indexes for table `m_product`
--
ALTER TABLE `m_product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`product_code`);

--
-- Indexes for table `m_promo`
--
ALTER TABLE `m_promo`
  ADD PRIMARY KEY (`promo_id`);

--
-- Indexes for table `m_submenu`
--
ALTER TABLE `m_submenu`
  ADD PRIMARY KEY (`id_submenu`);

--
-- Indexes for table `m_table`
--
ALTER TABLE `m_table`
  ADD PRIMARY KEY (`table_id`),
  ADD UNIQUE KEY `table_code` (`table_code`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_payment`
--
ALTER TABLE `t_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_sales`
--
ALTER TABLE `t_sales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sales_code` (`sales_code`),
  ADD KEY `sales_code_2` (`sales_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id_account` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `d_promo`
--
ALTER TABLE `d_promo`
  MODIFY `detail_promo_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
--
-- AUTO_INCREMENT for table `d_sales`
--
ALTER TABLE `d_sales`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=364;
--
-- AUTO_INCREMENT for table `m_menu`
--
ALTER TABLE `m_menu`
  MODIFY `id_menu` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;
--
-- AUTO_INCREMENT for table `m_payment_type`
--
ALTER TABLE `m_payment_type`
  MODIFY `id_payment` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `m_product`
--
ALTER TABLE `m_product`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `m_promo`
--
ALTER TABLE `m_promo`
  MODIFY `promo_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `m_submenu`
--
ALTER TABLE `m_submenu`
  MODIFY `id_submenu` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `m_table`
--
ALTER TABLE `m_table`
  MODIFY `table_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;
--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `t_payment`
--
ALTER TABLE `t_payment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `t_sales`
--
ALTER TABLE `t_sales`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
