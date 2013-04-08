-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 08, 2013 at 04:49 AM
-- Server version: 5.0.96-community
-- PHP Version: 5.3.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `somiland_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `acl_pages`
--

CREATE TABLE IF NOT EXISTS `acl_pages` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(60) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `acl_users`
--

CREATE TABLE IF NOT EXISTS `acl_users` (
  `id` int(11) NOT NULL auto_increment,
  `acl_user_id` int(11) default NULL,
  `page_id` int(60) default NULL,
  `allowed` tinyint(4) default '0',
  `permissions` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rate_change`
--

CREATE TABLE IF NOT EXISTS `rate_change` (
  `id` int(11) NOT NULL auto_increment,
  `plot_id` int(11) NOT NULL,
  `previouse_sqAreaCost` float NOT NULL,
  `change_SqAreaCost` float NOT NULL,
  `date` datetime NOT NULL,
  `staff_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `rate_change`
--

INSERT INTO `rate_change` (`id`, `plot_id`, `previouse_sqAreaCost`, `change_SqAreaCost`, `date`, `staff_id`) VALUES
(1, 1, 2500, 3600, '2013-04-08 11:05:20', 0),
(2, 1, 3600, 3650, '2013-04-08 11:06:33', 0),
(3, 2, 2500, 3650, '2013-04-08 11:06:52', 0),
(4, 3, 2500, 3650, '2013-04-08 11:07:02', 0),
(5, 4, 2500, 3650, '2013-04-08 11:07:11', 0),
(6, 5, 2500, 3650, '2013-04-08 11:07:20', 0),
(7, 6, 2500, 3650, '2013-04-08 11:07:29', 0),
(8, 7, 2500, 3650, '2013-04-08 11:07:42', 0),
(9, 8, 2500, 3650, '2013-04-08 11:07:51', 0),
(10, 9, 2500, 3650, '2013-04-08 11:08:03', 0),
(11, 10, 2500, 3650, '2013-04-08 11:08:13', 0),
(12, 11, 2500, 3650, '2013-04-08 11:08:26', 0),
(13, 12, 2500, 3650, '2013-04-08 11:08:35', 0),
(14, 13, 2500, 3650, '2013-04-08 11:08:43', 0),
(15, 14, 2500, 3650, '2013-04-08 11:08:55', 0),
(16, 15, 2500, 3650, '2013-04-08 11:09:06', 0),
(17, 16, 2500, 3650, '2013-04-08 11:09:16', 0),
(18, 17, 2500, 3650, '2013-04-08 11:09:25', 0),
(19, 18, 2500, 3650, '2013-04-08 11:09:34', 0),
(20, 19, 2500, 3650, '2013-04-08 11:09:44', 0),
(21, 20, 2500, 3650, '2013-04-08 11:09:56', 0),
(22, 21, 2500, 3650, '2013-04-08 11:10:06', 0),
(23, 22, 2500, 3650, '2013-04-08 11:10:15', 0),
(24, 23, 2500, 3650, '2013-04-08 11:10:24', 0),
(25, 24, 2500, 3650, '2013-04-08 11:10:32', 0),
(26, 25, 2500, 3650, '2013-04-08 11:10:41', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL,
  `is_system_admin` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `created_on`, `is_system_admin`) VALUES
(1, 'root123', 'root123', 'root', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `xagent`
--

CREATE TABLE IF NOT EXISTS `xagent` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `mo_number` varchar(255) NOT NULL,
  `address` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `xagent_commission`
--

CREATE TABLE IF NOT EXISTS `xagent_commission` (
  `id` int(11) NOT NULL auto_increment,
  `agent_id` int(11) NOT NULL,
  `amount_deposite_id` int(11) NOT NULL,
  `commission` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `xamount_deposited`
--

CREATE TABLE IF NOT EXISTS `xamount_deposited` (
  `id` int(11) NOT NULL auto_increment,
  `sales_id` int(11) NOT NULL,
  `Amount` int(11) NOT NULL,
  `paid_date` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `xamount_deposited`
--

INSERT INTO `xamount_deposited` (`id`, `sales_id`, `Amount`, `paid_date`) VALUES
(1, 1, 5100, '2013-04-08 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `xcheque_details`
--

CREATE TABLE IF NOT EXISTS `xcheque_details` (
  `id` int(11) NOT NULL auto_increment,
  `For_Master_Emi` tinyint(4) NOT NULL default '0',
  `sales_id` int(11) NOT NULL,
  `Cheque_No` varchar(255) NOT NULL,
  `Amount` int(11) NOT NULL,
  `Cleared_On` datetime default NULL,
  `Bounced_On` datetime default NULL,
  `Bank` varchar(255) NOT NULL,
  `Cheque_Date` datetime NOT NULL,
  `Created_at` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `xcustomer`
--

CREATE TABLE IF NOT EXISTS `xcustomer` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Occupation` varchar(255) NOT NULL,
  `Company_Name` varchar(255) NOT NULL,
  `Company_Address` varchar(255) NOT NULL,
  `PAN_No` varchar(255) NOT NULL,
  `Contact_No` varchar(255) NOT NULL,
  `Email_Id` varchar(255) NOT NULL,
  `CoApplicant_Name` varchar(255) NOT NULL,
  `CoApplicant_Occupation` varchar(255) NOT NULL,
  `CoApplicant_Address` text NOT NULL,
  `CoApplicant_CompanyName` varchar(255) NOT NULL,
  `CoApplicant_Designation` varchar(255) NOT NULL,
  `CoApplicantCompanyAddress` text NOT NULL,
  `CoApplicant_PAN_No` varchar(255) NOT NULL,
  `CoApplicant_Contact_No` varchar(255) NOT NULL,
  `CoApplicant_Email_Id` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `xcustomer`
--

INSERT INTO `xcustomer` (`id`, `name`, `username`, `password`, `Address`, `Occupation`, `Company_Name`, `Company_Address`, `PAN_No`, `Contact_No`, `Email_Id`, `CoApplicant_Name`, `CoApplicant_Occupation`, `CoApplicant_Address`, `CoApplicant_CompanyName`, `CoApplicant_Designation`, `CoApplicantCompanyAddress`, `CoApplicant_PAN_No`, `CoApplicant_Contact_No`, `CoApplicant_Email_Id`) VALUES
(1, 'TechnicalRoot', 'troot', 'troot', 'troot', 'troot', 'troot', 'troot', 'troot', 'troot', 'troot@troot.com', 'troot', 'troot', 'troot', 'troot', 'troot', 'troot', 'troot', 'troot', 'troot'),
(2, 'Root', 'root', 'root', 'root', 'root', 'root', 'root', 'root', 'root', 'root', 'root', 'root', 'root', 'root', 'root', 'root', 'root', 'root', 'root'),
(8, 'Colors Procon Pvt. Ltd.', 'colors1', '1234', 'xyz', 'business', 'colors', 'as above', '', '', '', '', '', '', '', '', '', '', '', ''),
(9, 'Colors Procon Pvt Ltd.', 'colors2', '1234', 'Shivalik 9, Opp. Purneshwar flats, Near Passport Office, Gulbai Tekra, Ahmedabad, Gujarat', 'Business', 'Colors Procon Pvt Ltd.', 'Shivalik 9, Opp. Purneshwar flats, Near Passport Office, Gulbai Tekra, Ahmedabad, Gujarat', '', '', '', '', '', '', '', '', '', '', '', ''),
(10, 'Somi Land Developers Pvt. Ltd.', 'somi1', '1234', 'Shivalik 9, Opp. Purneshwar Flates, Nr. Passport Office, Gulbai Tekra, Ahmedabad, Gujarat', 'Business', 'Somi Land Developers Pvt. Ltd.', 'Shivalik 9, Opp. Purneshwar Flates, Nr. Passport Office, Gulbai Tekra, Ahmedabad, Gujarat', '', '', '', '', '', '', '', '', '', '', '', ''),
(11, 'Somi Land Developers Pvt. Ltd.', 'somi2', '1234', 'Shivalik 9, Opp. Purneshwar Flates, Near Passport Office, Gulbai Tekra, Ahmedabad, Gujarat', 'Business', 'Somi Land Developers Pvt. Ltd.', 'Shivalik 9, Opp. Purneshwar Flates, Near Passport Office, Gulbai Tekra, Ahmedabad, Gujarat', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `xdistributors`
--

CREATE TABLE IF NOT EXISTS `xdistributors` (
  `id` int(11) NOT NULL auto_increment,
  `customer_id` int(11) NOT NULL,
  `sponsor_id` int(11) NOT NULL,
  `introducer_id` int(11) NOT NULL,
  `legA_id` int(11) NOT NULL,
  `legB_id` int(11) NOT NULL,
  `legC_id` int(11) NOT NULL,
  `legD_id` int(11) NOT NULL,
  `Introduction_Income` int(11) NOT NULL default '0',
  `Level_1_Commission` int(11) NOT NULL,
  `Level_2_Commission` int(11) NOT NULL,
  `Level_3_Commission` int(11) NOT NULL,
  `Level_4_Commission` int(11) NOT NULL,
  `Level_5_Commission` int(11) NOT NULL,
  `Level_6_Commission` int(11) NOT NULL,
  `Level_1_Count` int(11) NOT NULL default '0',
  `Level_2_Count` int(11) NOT NULL default '0',
  `Level_3_Count` int(11) NOT NULL default '0',
  `Level_4_Count` int(11) NOT NULL default '0',
  `Level_5_Count` int(11) NOT NULL default '0',
  `Level_6_Count` int(11) NOT NULL default '0',
  `Path` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `xdistributors`
--

INSERT INTO `xdistributors` (`id`, `customer_id`, `sponsor_id`, `introducer_id`, `legA_id`, `legB_id`, `legC_id`, `legD_id`, `Introduction_Income`, `Level_1_Commission`, `Level_2_Commission`, `Level_3_Commission`, `Level_4_Commission`, `Level_5_Commission`, `Level_6_Commission`, `Level_1_Count`, `Level_2_Count`, `Level_3_Count`, `Level_4_Count`, `Level_5_Count`, `Level_6_Count`, `Path`) VALUES
(1, 1, 0, 0, 2, 0, 0, 0, 0, 0, 90, 0, 0, 0, 0, 1, 4, 0, 0, 0, 0, '0'),
(2, 2, 1, 1, 8, 9, 10, 11, 1000, 100, 0, 0, 0, 0, 0, 4, 0, 0, 0, 0, 0, '0A'),
(8, 8, 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0AA'),
(9, 9, 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0AB'),
(10, 10, 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0AC'),
(11, 11, 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0AD');

-- --------------------------------------------------------

--
-- Table structure for table `xemis`
--

CREATE TABLE IF NOT EXISTS `xemis` (
  `id` int(11) NOT NULL auto_increment,
  `sales_id` int(11) NOT NULL,
  `due_date` datetime NOT NULL,
  `paid_date` datetime NOT NULL,
  `EMIAmount` float NOT NULL,
  `AmountPaid` float NOT NULL,
  `is_master_emi` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=317 ;

--
-- Dumping data for table `xemis`
--

INSERT INTO `xemis` (`id`, `sales_id`, `due_date`, `paid_date`, `EMIAmount`, `AmountPaid`, `is_master_emi`) VALUES
(1, 1, '2013-06-08 00:00:00', '2013-04-08 00:00:00', 5100, 5100, 0),
(2, 1, '2013-07-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(3, 1, '2013-08-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(4, 1, '2013-09-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(5, 1, '2013-10-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(6, 1, '2013-11-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(7, 1, '2013-12-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(8, 1, '2014-01-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(9, 1, '2014-02-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(10, 1, '2014-03-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(11, 1, '2014-04-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(12, 1, '2014-05-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(13, 1, '2014-05-08 00:00:00', '0000-00-00 00:00:00', 18888, 0, 1),
(14, 1, '2014-06-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(15, 1, '2014-07-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(16, 1, '2014-08-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(17, 1, '2014-09-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(18, 1, '2014-10-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(19, 1, '2014-11-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(20, 1, '2014-12-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(21, 1, '2015-01-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(22, 1, '2015-02-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(23, 1, '2015-03-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(24, 1, '2015-04-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(25, 1, '2015-05-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(26, 1, '2015-05-08 00:00:00', '0000-00-00 00:00:00', 18888, 0, 1),
(27, 1, '2015-06-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(28, 1, '2015-07-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(29, 1, '2015-08-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(30, 1, '2015-09-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(31, 1, '2015-10-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(32, 1, '2015-11-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(33, 1, '2015-12-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(34, 1, '2016-01-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(35, 1, '2016-02-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(36, 1, '2016-03-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(37, 1, '2016-04-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(38, 1, '2016-05-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(39, 1, '2016-05-08 00:00:00', '0000-00-00 00:00:00', 18888, 0, 1),
(40, 1, '2016-06-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(41, 1, '2016-07-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(42, 1, '2016-08-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(43, 1, '2016-09-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(44, 1, '2016-10-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(45, 1, '2016-11-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(46, 1, '2016-12-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(47, 1, '2017-01-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(48, 1, '2017-02-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(49, 1, '2017-03-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(50, 1, '2017-04-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(51, 1, '2017-05-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(52, 1, '2017-05-08 00:00:00', '0000-00-00 00:00:00', 18888, 0, 1),
(53, 1, '2017-06-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(54, 1, '2017-07-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(55, 1, '2017-08-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(56, 1, '2017-09-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(57, 1, '2017-10-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(58, 1, '2017-11-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(59, 1, '2017-12-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(60, 1, '2018-01-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(61, 1, '2018-02-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(62, 1, '2018-03-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(63, 1, '2018-04-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(64, 1, '2018-05-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(65, 1, '2018-05-08 00:00:00', '0000-00-00 00:00:00', 18888, 0, 1),
(66, 1, '2018-06-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(67, 1, '2018-07-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(68, 1, '2018-08-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(69, 1, '2018-09-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(70, 1, '2018-10-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(71, 1, '2018-11-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(72, 1, '2018-12-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(73, 1, '2019-01-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(74, 1, '2019-02-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(75, 1, '2019-03-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(76, 1, '2019-04-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(77, 1, '2019-05-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(78, 1, '2019-05-08 00:00:00', '0000-00-00 00:00:00', 18888, 0, 1),
(79, 1, '2019-06-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(80, 2, '2013-06-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(81, 2, '2013-07-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(82, 2, '2013-08-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(83, 2, '2013-09-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(84, 2, '2013-10-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(85, 2, '2013-11-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(86, 2, '2013-12-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(87, 2, '2014-01-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(88, 2, '2014-02-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(89, 2, '2014-03-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(90, 2, '2014-04-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(91, 2, '2014-05-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(92, 2, '2014-05-08 00:00:00', '0000-00-00 00:00:00', 18888, 0, 1),
(93, 2, '2014-06-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(94, 2, '2014-07-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(95, 2, '2014-08-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(96, 2, '2014-09-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(97, 2, '2014-10-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(98, 2, '2014-11-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(99, 2, '2014-12-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(100, 2, '2015-01-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(101, 2, '2015-02-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(102, 2, '2015-03-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(103, 2, '2015-04-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(104, 2, '2015-05-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(105, 2, '2015-05-08 00:00:00', '0000-00-00 00:00:00', 18888, 0, 1),
(106, 2, '2015-06-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(107, 2, '2015-07-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(108, 2, '2015-08-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(109, 2, '2015-09-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(110, 2, '2015-10-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(111, 2, '2015-11-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(112, 2, '2015-12-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(113, 2, '2016-01-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(114, 2, '2016-02-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(115, 2, '2016-03-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(116, 2, '2016-04-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(117, 2, '2016-05-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(118, 2, '2016-05-08 00:00:00', '0000-00-00 00:00:00', 18888, 0, 1),
(119, 2, '2016-06-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(120, 2, '2016-07-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(121, 2, '2016-08-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(122, 2, '2016-09-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(123, 2, '2016-10-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(124, 2, '2016-11-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(125, 2, '2016-12-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(126, 2, '2017-01-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(127, 2, '2017-02-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(128, 2, '2017-03-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(129, 2, '2017-04-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(130, 2, '2017-05-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(131, 2, '2017-05-08 00:00:00', '0000-00-00 00:00:00', 18888, 0, 1),
(132, 2, '2017-06-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(133, 2, '2017-07-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(134, 2, '2017-08-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(135, 2, '2017-09-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(136, 2, '2017-10-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(137, 2, '2017-11-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(138, 2, '2017-12-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(139, 2, '2018-01-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(140, 2, '2018-02-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(141, 2, '2018-03-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(142, 2, '2018-04-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(143, 2, '2018-05-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(144, 2, '2018-05-08 00:00:00', '0000-00-00 00:00:00', 18888, 0, 1),
(145, 2, '2018-06-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(146, 2, '2018-07-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(147, 2, '2018-08-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(148, 2, '2018-09-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(149, 2, '2018-10-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(150, 2, '2018-11-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(151, 2, '2018-12-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(152, 2, '2019-01-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(153, 2, '2019-02-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(154, 2, '2019-03-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(155, 2, '2019-04-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(156, 2, '2019-05-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(157, 2, '2019-05-08 00:00:00', '0000-00-00 00:00:00', 18888, 0, 1),
(158, 2, '2019-06-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(159, 3, '2013-06-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(160, 3, '2013-07-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(161, 3, '2013-08-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(162, 3, '2013-09-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(163, 3, '2013-10-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(164, 3, '2013-11-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(165, 3, '2013-12-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(166, 3, '2014-01-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(167, 3, '2014-02-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(168, 3, '2014-03-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(169, 3, '2014-04-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(170, 3, '2014-05-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(171, 3, '2014-05-08 00:00:00', '0000-00-00 00:00:00', 18888, 0, 1),
(172, 3, '2014-06-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(173, 3, '2014-07-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(174, 3, '2014-08-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(175, 3, '2014-09-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(176, 3, '2014-10-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(177, 3, '2014-11-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(178, 3, '2014-12-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(179, 3, '2015-01-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(180, 3, '2015-02-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(181, 3, '2015-03-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(182, 3, '2015-04-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(183, 3, '2015-05-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(184, 3, '2015-05-08 00:00:00', '0000-00-00 00:00:00', 18888, 0, 1),
(185, 3, '2015-06-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(186, 3, '2015-07-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(187, 3, '2015-08-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(188, 3, '2015-09-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(189, 3, '2015-10-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(190, 3, '2015-11-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(191, 3, '2015-12-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(192, 3, '2016-01-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(193, 3, '2016-02-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(194, 3, '2016-03-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(195, 3, '2016-04-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(196, 3, '2016-05-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(197, 3, '2016-05-08 00:00:00', '0000-00-00 00:00:00', 18888, 0, 1),
(198, 3, '2016-06-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(199, 3, '2016-07-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(200, 3, '2016-08-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(201, 3, '2016-09-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(202, 3, '2016-10-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(203, 3, '2016-11-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(204, 3, '2016-12-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(205, 3, '2017-01-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(206, 3, '2017-02-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(207, 3, '2017-03-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(208, 3, '2017-04-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(209, 3, '2017-05-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(210, 3, '2017-05-08 00:00:00', '0000-00-00 00:00:00', 18888, 0, 1),
(211, 3, '2017-06-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(212, 3, '2017-07-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(213, 3, '2017-08-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(214, 3, '2017-09-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(215, 3, '2017-10-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(216, 3, '2017-11-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(217, 3, '2017-12-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(218, 3, '2018-01-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(219, 3, '2018-02-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(220, 3, '2018-03-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(221, 3, '2018-04-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(222, 3, '2018-05-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(223, 3, '2018-05-08 00:00:00', '0000-00-00 00:00:00', 18888, 0, 1),
(224, 3, '2018-06-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(225, 3, '2018-07-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(226, 3, '2018-08-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(227, 3, '2018-09-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(228, 3, '2018-10-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(229, 3, '2018-11-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(230, 3, '2018-12-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(231, 3, '2019-01-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(232, 3, '2019-02-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(233, 3, '2019-03-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(234, 3, '2019-04-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(235, 3, '2019-05-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(236, 3, '2019-05-08 00:00:00', '0000-00-00 00:00:00', 18888, 0, 1),
(237, 3, '2019-06-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(238, 4, '2013-06-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(239, 4, '2013-07-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(240, 4, '2013-08-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(241, 4, '2013-09-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(242, 4, '2013-10-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(243, 4, '2013-11-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(244, 4, '2013-12-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(245, 4, '2014-01-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(246, 4, '2014-02-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(247, 4, '2014-03-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(248, 4, '2014-04-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(249, 4, '2014-05-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(250, 4, '2014-05-08 00:00:00', '0000-00-00 00:00:00', 18888, 0, 1),
(251, 4, '2014-06-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(252, 4, '2014-07-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(253, 4, '2014-08-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(254, 4, '2014-09-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(255, 4, '2014-10-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(256, 4, '2014-11-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(257, 4, '2014-12-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(258, 4, '2015-01-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(259, 4, '2015-02-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(260, 4, '2015-03-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(261, 4, '2015-04-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(262, 4, '2015-05-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(263, 4, '2015-05-08 00:00:00', '0000-00-00 00:00:00', 18888, 0, 1),
(264, 4, '2015-06-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(265, 4, '2015-07-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(266, 4, '2015-08-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(267, 4, '2015-09-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(268, 4, '2015-10-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(269, 4, '2015-11-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(270, 4, '2015-12-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(271, 4, '2016-01-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(272, 4, '2016-02-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(273, 4, '2016-03-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(274, 4, '2016-04-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(275, 4, '2016-05-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(276, 4, '2016-05-08 00:00:00', '0000-00-00 00:00:00', 18888, 0, 1),
(277, 4, '2016-06-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(278, 4, '2016-07-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(279, 4, '2016-08-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(280, 4, '2016-09-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(281, 4, '2016-10-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(282, 4, '2016-11-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(283, 4, '2016-12-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(284, 4, '2017-01-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(285, 4, '2017-02-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(286, 4, '2017-03-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(287, 4, '2017-04-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(288, 4, '2017-05-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(289, 4, '2017-05-08 00:00:00', '0000-00-00 00:00:00', 18888, 0, 1),
(290, 4, '2017-06-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(291, 4, '2017-07-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(292, 4, '2017-08-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(293, 4, '2017-09-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(294, 4, '2017-10-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(295, 4, '2017-11-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(296, 4, '2017-12-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(297, 4, '2018-01-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(298, 4, '2018-02-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(299, 4, '2018-03-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(300, 4, '2018-04-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(301, 4, '2018-05-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(302, 4, '2018-05-08 00:00:00', '0000-00-00 00:00:00', 18888, 0, 1),
(303, 4, '2018-06-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(304, 4, '2018-07-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(305, 4, '2018-08-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(306, 4, '2018-09-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(307, 4, '2018-10-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(308, 4, '2018-11-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(309, 4, '2018-12-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(310, 4, '2019-01-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(311, 4, '2019-02-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(312, 4, '2019-03-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(313, 4, '2019-04-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(314, 4, '2019-05-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0),
(315, 4, '2019-05-08 00:00:00', '0000-00-00 00:00:00', 18888, 0, 1),
(316, 4, '2019-06-08 00:00:00', '0000-00-00 00:00:00', 5100, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `xplannings`
--

CREATE TABLE IF NOT EXISTS `xplannings` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(150) NOT NULL,
  `Phase` varchar(100) NOT NULL,
  `is_private` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `xplannings`
--

INSERT INTO `xplannings` (`id`, `name`, `Phase`, `is_private`) VALUES
(1, 'Kanewal City', '-', 0);

-- --------------------------------------------------------

--
-- Table structure for table `xplots`
--

CREATE TABLE IF NOT EXISTS `xplots` (
  `id` int(11) NOT NULL auto_increment,
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
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `xplots`
--

INSERT INTO `xplots` (`id`, `name`, `planning_id`, `width`, `height`, `Area`, `status`, `block_number`, `SqAreaCost`, `is_corner`, `Unit`, `date`, `salespolicy_id`) VALUES
(1, 'Plot 1', 1, 20, 26.5, 151, 'EMISold', 'C', 3650, 0, 'SqYard', '2013-04-08 00:00:00', 2),
(2, 'Plot 2', 1, 20, 26.5, 151, 'EMISold', 'C', 3650, 0, 'SqYard', '2013-04-08 00:00:00', 2),
(3, 'Plot 3', 1, 20, 26.5, 151, 'EMISold', 'C', 3650, 0, 'SqYard', '2013-04-08 00:00:00', 2),
(4, 'Plot 4', 1, 20, 26.5, 151, 'EMISold', 'C', 3650, 0, 'SqYard', '2013-04-08 00:00:00', 2),
(5, 'Plot 5', 1, 20, 26.5, 151, 'Available', 'C', 3650, 0, 'SqYard', '2013-04-08 00:00:00', 2),
(6, 'Plot 6', 1, 20, 26.5, 151, 'Available', 'C', 3650, 0, 'SqYard', '2013-04-08 00:00:00', 2),
(7, 'Plot 7', 1, 20, 26.5, 151, 'Available', 'C', 3650, 0, 'SqYard', '2013-04-08 00:00:00', 2),
(8, 'Plot 8', 1, 20, 26.5, 151, 'Available', 'C', 3650, 0, 'SqYard', '2013-04-08 00:00:00', 2),
(9, 'Plot 9', 1, 20, 26.5, 151, 'Available', 'C', 3650, 0, 'SqYard', '2013-04-08 00:00:00', 2),
(10, 'Plot 10', 1, 20, 26.5, 151, 'Available', 'C', 3650, 0, 'SqYard', '2013-04-08 00:00:00', 2),
(11, 'Plot 11', 1, 20, 26.5, 151, 'Available', 'C', 3650, 0, 'SqYard', '2013-04-08 00:00:00', 2),
(12, 'Plot 12', 1, 20, 26.5, 151, 'Available', 'C', 3650, 0, 'SqYard', '2013-04-08 00:00:00', 2),
(13, 'Plot 13', 1, 20, 26.5, 151, 'Available', 'C', 3650, 0, 'SqYard', '2013-04-08 00:00:00', 2),
(14, 'Plot 14', 1, 20, 26.5, 151, 'Available', 'C', 3650, 0, 'SqYard', '2013-04-08 00:00:00', 2),
(15, 'Plot 15', 1, 20, 26.5, 151, 'Available', 'C', 3650, 0, 'SqYard', '2013-04-08 00:00:00', 2),
(16, 'Plot 16', 1, 20, 26.5, 151, 'Available', 'C', 3650, 0, 'SqYard', '2013-04-08 00:00:00', 2),
(17, 'Plot 17', 1, 20, 26.5, 151, 'Available', 'C', 3650, 0, 'SqYard', '2013-04-08 00:00:00', 2),
(18, 'Plot 18', 1, 20, 26.5, 151, 'Available', 'C', 3650, 0, 'SqYard', '2013-04-08 00:00:00', 2),
(19, 'Plot 19', 1, 20, 26.5, 151, 'Available', 'C', 3650, 0, 'SqYard', '2013-04-08 00:00:00', 2),
(20, 'Plot 20', 1, 20, 26.5, 151, 'Available', 'C', 3650, 0, 'SqYard', '2013-04-08 00:00:00', 2),
(21, 'Plot 21', 1, 20, 26.5, 151, 'Available', 'C', 3650, 0, 'SqYard', '2013-04-08 00:00:00', 2),
(22, 'Plot 22', 1, 20, 26.5, 151, 'Available', 'C', 3650, 0, 'SqYard', '2013-04-08 00:00:00', 2),
(23, 'Plot 23', 1, 20, 26.5, 151, 'Available', 'C', 3650, 0, 'SqYard', '2013-04-08 00:00:00', 2),
(24, 'Plot 24', 1, 20, 26.5, 151, 'Available', 'C', 3650, 0, 'SqYard', '2013-04-08 00:00:00', 2),
(25, 'Plot 25', 1, 20, 26.5, 151, 'Available', 'C', 3650, 0, 'SqYard', '2013-04-08 00:00:00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `xsales`
--

CREATE TABLE IF NOT EXISTS `xsales` (
  `id` int(11) NOT NULL auto_increment,
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
  `down_payment_submitted` int(11) NOT NULL default '0',
  `sales_date` datetime NOT NULL,
  `no_of_master_emi` int(11) NOT NULL,
  `is_current` tinyint(4) NOT NULL default '1',
  `Name_Of_Nominee` varchar(255) NOT NULL,
  `Relation_With_Applicant` varchar(255) NOT NULL,
  `Nominee_PAN_NO` varchar(255) NOT NULL,
  `Nominee_Age` int(11) NOT NULL,
  `Nominee_Address` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `xsales`
--

INSERT INTO `xsales` (`id`, `plot_id`, `agent_id`, `customer_id`, `RatePerSqUnit`, `salespolicy_name`, `down_payment`, `total_cost`, `emi_pattern`, `emi_mode`, `master_emi`, `master_emi_mode`, `direct_commission_to_agent`, `emi_commission_to_agent`, `down_payment_submitted`, `sales_date`, `no_of_master_emi`, `is_current`, `Name_Of_Nominee`, `Relation_With_Applicant`, `Nominee_PAN_NO`, `Nominee_Age`, `Nominee_Address`) VALUES
(1, 1, 0, 8, 3650, '73EMI Plan Policy', 0, 485628, '5100x73', 'Monthly', 18888, 'Yearly', '1000', '0', 0, '2013-04-08 00:00:00', 6, 1, '', '', '', 0, ''),
(2, 2, 0, 9, 3650, '73EMI Plan Policy', 0, 485628, '5100x73', 'Monthly', 18888, 'Yearly', '1000', '0', 0, '2013-04-08 00:00:00', 6, 1, '', '', '', 0, ''),
(3, 3, 0, 10, 3650, '73EMI Plan Policy', 0, 485628, '5100x73', 'Monthly', 18888, 'Yearly', '1000', '0', 0, '2013-04-08 00:00:00', 6, 1, '', '', '', 0, ''),
(4, 4, 0, 11, 3650, '73EMI Plan Policy', 0, 485628, '5100x73', 'Monthly', 18888, 'Yearly', '1000', '0', 0, '2013-04-08 00:00:00', 6, 1, '', '', '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `xsales_policies`
--

CREATE TABLE IF NOT EXISTS `xsales_policies` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `down_payment` int(11) NOT NULL,
  `emi_pattern` text NOT NULL,
  `master_emi` int(11) NOT NULL,
  `no_of_master_emi` int(11) NOT NULL,
  `emi_mode` varchar(10) NOT NULL,
  `master_emi_mode` varchar(10) NOT NULL,
  `direct_commission_to_agent` varchar(255) NOT NULL,
  `emi_commission_to_agent` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `xsales_policies`
--

INSERT INTO `xsales_policies` (`id`, `name`, `down_payment`, `emi_pattern`, `master_emi`, `no_of_master_emi`, `emi_mode`, `master_emi_mode`, `direct_commission_to_agent`, `emi_commission_to_agent`) VALUES
(2, '73EMI Plan Policy', 0, '5999x73', 18888, 6, 'Monthly', 'Yearly', '1000', '0');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;