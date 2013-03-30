-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 29, 2013 at 03:16 PM
-- Server version: 5.5.28
-- PHP Version: 5.3.10-1ubuntu3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sv`
--

-- --------------------------------------------------------

--
-- Table structure for table `acl_pages`
--

CREATE TABLE IF NOT EXISTS `acl_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `acl_pages`
--

INSERT INTO `acl_pages` (`id`, `name`) VALUES
(1, 'users'),
(2, 'users_acls'),
(3, 'masters'),
(4, 'masters_session'),
(5, 'schooldata'),
(6, 'staffdata'),
(7, 'staff_movement'),
(8, 'hosteldata'),
(9, 'storedata'),
(10, 'reports'),
(11, 'users_acls_edit'),
(12, 'school_scholars'),
(13, 'school_studentClassMapping'),
(14, 'staff_add'),
(15, 'staff_attendance'),
(16, 'hostel_studentstore'),
(17, 'hostel_hostelallotement'),
(18, 'hostel_studentgardian'),
(19, 'hostel_studentmovement'),
(20, 'hostel_studentmovementreport'),
(21, 'hostel_studentdisease'),
(22, 'masters_class'),
(23, 'masters_subject'),
(24, 'masters_exam'),
(25, 'masters_hostel'),
(26, 'masters_category'),
(27, 'masters_item'),
(28, 'masters_party'),
(29, 'masters_feeshead'),
(30, 'masters_disease'),
(31, 'masters_scholars'),
(32, 'student_report'),
(33, 'hostel_attendence'),
(34, 'hostel_attendence_roomvise'),
(35, 'hostel_attendence_classvise'),
(36, 'hostel_attendence_hostelvise'),
(37, 'store_iteminward'),
(38, 'store_itemoutward'),
(39, 'store_stock'),
(40, 'store_reports'),
(41, 'store_reports_storealltlist'),
(42, 'store_reports_recipt'),
(43, 'store_studentstore'),
(44, 'staff'),
(45, 'staff_acls');

-- --------------------------------------------------------

--
-- Table structure for table `acl_users`
--

CREATE TABLE IF NOT EXISTS `acl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acl_user_id` int(11) DEFAULT NULL,
  `page_id` int(60) DEFAULT NULL,
  `allowed` tinyint(4) DEFAULT '0',
  `permissions` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=79 ;

--
-- Dumping data for table `acl_users`
--

INSERT INTO `acl_users` (`id`, `acl_user_id`, `page_id`, `allowed`, `permissions`) VALUES
(1, 1, 1, 1, '30'),
(2, 1, 2, 1, '30'),
(3, 1, 3, 1, '30'),
(4, 1, 4, 1, '30'),
(5, 1, 5, 1, '30'),
(6, 1, 6, 1, '30'),
(7, 1, 7, 1, '30'),
(8, 2, 3, 0, NULL),
(9, 2, 5, 0, '30'),
(10, 2, 6, 1, '2'),
(11, 2, 1, 0, NULL),
(12, 1, 11, 1, '30'),
(13, 2, 12, 0, '0'),
(14, 2, 13, 0, NULL),
(15, 2, 7, 1, '2'),
(16, 2, 14, 0, '30'),
(17, 2, 15, 1, '0'),
(18, 2, 8, 1, '2'),
(19, 2, 9, 0, '30'),
(20, 2, 10, 1, '30'),
(21, 1, 8, 1, '30'),
(22, 1, 16, 1, '30'),
(23, 1, 17, 1, '30'),
(24, 2, 16, 0, NULL),
(25, 2, 17, 0, NULL),
(26, 1, 22, 1, '30'),
(27, 1, 23, 1, '30'),
(28, 1, 24, 1, '30'),
(29, 1, 25, 1, '30'),
(30, 1, 26, 1, '30'),
(31, 1, 27, 1, '30'),
(32, 1, 28, 1, '30'),
(33, 1, 29, 1, '30'),
(34, 1, 30, 1, '30'),
(35, 1, 31, 1, '30'),
(36, 1, 19, 1, '30'),
(37, 1, 20, 1, '30'),
(38, 1, 10, 1, '30'),
(39, 1, 32, 1, '30'),
(40, 1, 33, 1, '30'),
(41, 1, 34, 1, '30'),
(42, 1, 35, 1, '30'),
(43, 1, 36, 1, '30'),
(44, 2, 18, 0, NULL),
(45, 2, 19, 1, '2'),
(46, 2, 20, 1, '2'),
(47, 2, 21, 1, '30'),
(48, 2, 32, 0, '30'),
(49, 2, 33, 1, '30'),
(50, 1, 12, 1, '30'),
(51, 1, 13, 1, '30'),
(52, 1, 9, 1, '30'),
(53, 1, 37, 1, '30'),
(54, 1, 40, 1, '30'),
(55, 1, 41, 1, '30'),
(56, 1, 42, 1, '30'),
(57, 2, 34, 1, '30'),
(58, 2, 35, 1, '30'),
(59, 2, 36, 1, '30'),
(60, 2, 40, 0, NULL),
(61, 1, 18, 1, '30'),
(62, 1, 14, 1, '30'),
(63, 1, 15, 1, '30'),
(64, 1, 38, 1, '30'),
(65, 1, 39, 1, '30'),
(66, 1, 21, 1, '30'),
(67, 1, 43, 1, '30'),
(68, 3, 3, 0, NULL),
(69, 3, 5, 1, '30'),
(70, 3, 6, 0, NULL),
(71, 3, 8, 0, NULL),
(72, 3, 9, 0, NULL),
(73, 3, 10, 0, NULL),
(74, 3, 1, 0, NULL),
(75, 3, 13, 0, NULL),
(76, 3, 12, 0, NULL),
(77, 1, 44, 1, '30'),
(78, 1, 45, 1, '30');

-- --------------------------------------------------------

--
-- Table structure for table `agent_commision`
--

CREATE TABLE IF NOT EXISTS `agent_commision` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agent_id` int(11) NOT NULL,
  `amount_deposite_id` int(11) NOT NULL,
  `commission` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rate_change`
--

CREATE TABLE IF NOT EXISTS `rate_change` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plot_id` int(11) NOT NULL,
  `previouse_sqAreaCost` float NOT NULL,
  `change_SqAreaCost` float NOT NULL,
  `date` datetime NOT NULL,
  `staff_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `rate_change`
--

INSERT INTO `rate_change` (`id`, `plot_id`, `previouse_sqAreaCost`, `change_SqAreaCost`, `date`, `staff_id`) VALUES
(1, 3, 3, 300, '2013-03-26 15:07:04', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL,
  `is_system_admin` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `xagent`
--

CREATE TABLE IF NOT EXISTS `xagent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `mo_number` varchar(255) NOT NULL,
  `address` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `xamount_deposited`
--

CREATE TABLE IF NOT EXISTS `xamount_deposited` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_id` int(11) NOT NULL,
  `Amount` int(11) NOT NULL,
  `paid_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `xcustomer`
--

CREATE TABLE IF NOT EXISTS `xcustomer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `xcustomer`
--

INSERT INTO `xcustomer` (`id`, `name`, `Address`, `City`) VALUES
(1, 'root', 'Ahmdabaad', 'Ahmdabaad'),
(5, 'Ram lal', '46/428, gayatri marg', 'udaipur'),
(6, 'Kishan lal', '48, dhabai ji ka bada', 'bhilwada'),
(7, 'Shon', '56 dhabai ji ka bada', 'banswada'),
(8, 'captan', '42 abc', 'jaipur'),
(9, 'Gowrav vishwakarma', '45425', 'jo52d'),
(10, 'Preeti', '22', 'sfsfs');

-- --------------------------------------------------------

--
-- Table structure for table `xdistributors`
--

CREATE TABLE IF NOT EXISTS `xdistributors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `sponsor_id` int(11) NOT NULL,
  `introducer_id` int(11) NOT NULL,
  `legA_id` int(11) NOT NULL,
  `legB_id` int(11) NOT NULL,
  `legC_id` int(11) NOT NULL,
  `legD_id` int(11) NOT NULL,
  `A_Commission` int(11) NOT NULL,
  `B_Commission` int(11) NOT NULL,
  `C_Commission` int(11) NOT NULL,
  `D_Commission` int(11) NOT NULL,
  `Path` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `xdistributors`
--

INSERT INTO `xdistributors` (`id`, `customer_id`, `sponsor_id`, `introducer_id`, `legA_id`, `legB_id`, `legC_id`, `legD_id`, `A_Commission`, `B_Commission`, `C_Commission`, `D_Commission`, `Path`) VALUES
(1, 1, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, '0'),
(2, 5, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, '0A');

-- --------------------------------------------------------

--
-- Table structure for table `xemis`
--

CREATE TABLE IF NOT EXISTS `xemis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_id` int(11) NOT NULL,
  `due_date` datetime NOT NULL,
  `paid_date` datetime NOT NULL,
  `EMIAmount` float NOT NULL,
  `AmountPaid` float NOT NULL,
  `is_master_emi` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `xemis`
--

INSERT INTO `xemis` (`id`, `sales_id`, `due_date`, `paid_date`, `EMIAmount`, `AmountPaid`, `is_master_emi`) VALUES
(1, 1, '2013-05-29 00:00:00', '0000-00-00 00:00:00', 6000, 0, 0),
(2, 1, '2013-06-29 00:00:00', '0000-00-00 00:00:00', 6000, 0, 0),
(3, 1, '2013-07-29 00:00:00', '0000-00-00 00:00:00', 6000, 0, 0),
(4, 1, '2013-08-29 00:00:00', '0000-00-00 00:00:00', 6000, 0, 0),
(5, 1, '2013-09-29 00:00:00', '0000-00-00 00:00:00', 6000, 0, 0),
(6, 1, '2013-10-29 00:00:00', '0000-00-00 00:00:00', 6000, 0, 0),
(7, 1, '2013-11-29 00:00:00', '0000-00-00 00:00:00', 6000, 0, 0),
(8, 1, '2013-12-29 00:00:00', '0000-00-00 00:00:00', 6000, 0, 0),
(9, 1, '2014-01-29 00:00:00', '0000-00-00 00:00:00', 6000, 0, 0),
(10, 1, '2014-03-01 00:00:00', '0000-00-00 00:00:00', 6000, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `xplannings`
--

CREATE TABLE IF NOT EXISTS `xplannings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `Phase` varchar(100) NOT NULL,
  `is_private` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `xplannings`
--

INSERT INTO `xplannings` (`id`, `name`, `Phase`, `is_private`) VALUES
(1, 'Planning 1', 'Phase A', 0);

-- --------------------------------------------------------

--
-- Table structure for table `xplots`
--

CREATE TABLE IF NOT EXISTS `xplots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `planning_id` int(11) NOT NULL,
  `width` float NOT NULL,
  `height` float NOT NULL,
  `Area` float NOT NULL,
  `status` varchar(20) NOT NULL,
  `block_number` varchar(255) NOT NULL,
  `SqAreaCost` float NOT NULL,
  `is_corner` tinyint(4) NOT NULL,
  `Unit` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `salespolicy_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `xplots`
--

INSERT INTO `xplots` (`id`, `name`, `planning_id`, `width`, `height`, `Area`, `status`, `block_number`, `SqAreaCost`, `is_corner`, `Unit`, `date`, `salespolicy_id`) VALUES
(1, 'plot1', 1, 25, 30, 750, 'EMISold', 'A', 300, 0, 'sqft', '2013-03-26 00:00:00', 1),
(2, '2', 1, 25, 30, 750, 'Available', 'B', 300, 0, 'sqft', '2013-03-26 00:00:00', 1),
(3, 'plot 3', 1, 25, 30, 750, 'Available', 'C', 300, 0, 'sqft', '2013-03-26 00:00:00', 1),
(4, 'p 4', 1, 25, 30, 750, 'Available', 'A', 300, 0, 'sqft', '2013-03-26 00:00:00', 1),
(5, '5', 1, 25, 30, 750, 'Available', 'a', 300, 0, 'sqft', '2013-03-26 00:00:00', 1),
(6, '6', 1, 25, 30, 750, 'Available', 'c', 300, 0, 'sqft', '2013-03-26 00:00:00', 1),
(7, '6', 1, 25, 30, 750, 'Available', 'B', 300, 0, 'sqft', '2013-03-26 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `xsales`
--

CREATE TABLE IF NOT EXISTS `xsales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plot_id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `RatePerSqUnit` int(11) NOT NULL,
  `salespolicy_name` varchar(255) NOT NULL,
  `down_payment` int(11) NOT NULL,
  `total_cost` int(11) NOT NULL,
  `emi_pattern` text NOT NULL,
  `emi_mode` varchar(10) NOT NULL,
  `master_emi` int(11) NOT NULL,
  `master_emi_mode` varchar(255) NOT NULL,
  `direct_commission_to_agent` varchar(255) NOT NULL,
  `emi_commission_to_agent` varchar(255) NOT NULL,
  `down_payment_submitted` int(11) NOT NULL DEFAULT '0',
  `no_of_master_emi` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `xsales`
--

INSERT INTO `xsales` (`id`, `plot_id`, `agent_id`, `customer_id`, `RatePerSqUnit`, `salespolicy_name`, `down_payment`, `total_cost`, `emi_pattern`, `emi_mode`, `master_emi`, `master_emi_mode`, `direct_commission_to_agent`, `emi_commission_to_agent`, `down_payment_submitted`, `no_of_master_emi`) VALUES
(1, 1, 0, 5, 300, 'Sales Policy 1', 50000, 110000, '6000x10;', 'Monthly', 18000, 'Yearly', '1000', '20', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `xsales_policies`
--

CREATE TABLE IF NOT EXISTS `xsales_policies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `down_payment` int(11) NOT NULL,
  `emi_pattern` text NOT NULL,
  `master_emi` int(11) NOT NULL,
  `no_of_master_emi` int(11) NOT NULL,
  `emi_mode` varchar(10) NOT NULL,
  `master_emi_mode` varchar(10) NOT NULL,
  `direct_commission_to_agent` varchar(255) NOT NULL,
  `emi_commission_to_agent` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `xsales_policies`
--

INSERT INTO `xsales_policies` (`id`, `name`, `down_payment`, `emi_pattern`, `master_emi`, `no_of_master_emi`, `emi_mode`, `master_emi_mode`, `direct_commission_to_agent`, `emi_commission_to_agent`) VALUES
(1, 'Sales Policy 1', 2, '6000x73;', 18000, 0, 'Monthly', 'Yearly', '1000', '20');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
