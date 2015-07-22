-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2015 at 08:47 AM
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
-- Table structure for table `ssr_t_language`
--

CREATE TABLE IF NOT EXISTS `ssr_t_language` (
  `language_id` varchar(4) NOT NULL,
  `language_name` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ssr_t_language`
--

INSERT INTO `ssr_t_language` (`language_id`, `language_name`) VALUES
('ENG', 'English'),
('HIN', 'Hindi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ssr_t_language`
--
ALTER TABLE `ssr_t_language`
 ADD PRIMARY KEY (`language_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
