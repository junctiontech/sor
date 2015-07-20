-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2015 at 09:16 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sor`
--

-- --------------------------------------------------------

--
-- Table structure for table `ssr_t_users`
--

CREATE TABLE IF NOT EXISTS `ssr_t_users` (
`user_id` int(10) NOT NULL,
  `role_id` varchar(20) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `usermailid` varchar(30) DEFAULT NULL,
  `image` varchar(500) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `phone_number` varchar(12) DEFAULT NULL,
  `mobile` varchar(12) DEFAULT NULL,
  `address` text,
  `created_by` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `updated_on` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `ssr_t_users`
--

INSERT INTO `ssr_t_users` (`user_id`, `role_id`, `name`, `usermailid`, `image`, `password`, `phone_number`, `mobile`, `address`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 'Administrator', 'admin ', 'dev_sor@gmail.com', 'd09246081d7ce8259ddb9bfebdb4017eae03370714353836972.jpg', 'initial1$', '04546465656', '8823819994', ' bpl bhopal       ', NULL, NULL, NULL, '2015-06-27 05:50:39'),
(2, 'block', 'user', 'user@gmail.com', 'da405a634b6e23353a86a1acdff0a847b16770ca14353232228.jpg', 'initial1$', '00000', '5664645', ' jhageera bad ', NULL, NULL, NULL, '2015-06-26 12:54:06'),
(3, 'user', NULL, 'super_user@gmail.com', '', 'initial1$', NULL, '', '', NULL, NULL, NULL, '2015-06-11 10:24:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ssr_t_users`
--
ALTER TABLE `ssr_t_users`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ssr_t_users`
--
ALTER TABLE `ssr_t_users`
MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
