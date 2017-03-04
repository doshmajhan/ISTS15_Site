-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 04, 2017 at 05:32 AM
-- Server version: 5.7.17-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ists`
--

-- --------------------------------------------------------

--
-- Table structure for table `acquired_resources`
--

CREATE TABLE IF NOT EXISTS `acquired_resources` (
  `cid` int(11) NOT NULL,
  `has_water` varchar(30) NOT NULL DEFAULT '0',
  `has_electricity` varchar(30) NOT NULL DEFAULT '0',
  `has_gas` varchar(30) NOT NULL DEFAULT '0',
  `has_food` varchar(30) NOT NULL DEFAULT '0',
  `has_luxury` varchar(30) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acquired_resources`
--

INSERT INTO `acquired_resources` (`cid`, `has_water`, `has_electricity`, `has_gas`, `has_food`, `has_luxury`) VALUES
(1, '0', '0', '0', '0', '0'),
(2, '0', '0', '0', '0', '0'),
(3, '0', '0', '0', '0', '0'),
(4, '0', '0', '0', '0', '0'),
(5, '0', '0', '0', '0', '0'),
(6, '0', '0', '0', '0', '0'),
(7, '0', '0', '0', '0', '0'),
(8, '0', '0', '0', '0', '0'),
(9, '0', '0', '0', '0', '0'),
(10, '0', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `auditing`
--

CREATE TABLE IF NOT EXISTS `auditing` (
  `aid` int(11) NOT NULL,
  `cidsrc` int(16) NOT NULL,
  `ciddst` int(16) NOT NULL,
  `action` varchar(255) NOT NULL,
  `data` varchar(255) NOT NULL,
  `time` double NOT NULL,
  `ip` varchar(16) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auditing`
--

INSERT INTO `auditing` (`aid`, `cidsrc`, `ciddst`, `action`, `data`, `time`, `ip`) VALUES
(1, 4, 0, 'Logged in', 'none', 1488530162.25, '184.73.151.60'),
(2, 4, 0, 'Logged in', 'none', 1488530163.6, '184.73.151.60'),
(3, 5, 0, 'Logged in', 'none', 1488530186.85, '184.73.151.60'),
(4, 1, 0, 'Logged in', 'none', 1488530214.66, '184.73.151.60'),
(5, 1, 0, 'Logged in', 'none', 1488605420.63, '184.73.151.60'),
(6, 1, 0, 'Logged in', 'none', 1488605481.93, '129.21.94.9');

-- --------------------------------------------------------

--
-- Table structure for table `relations`
--

CREATE TABLE IF NOT EXISTS `relations` (
  `cid` int(16) NOT NULL,
  `atwar1` int(1) NOT NULL DEFAULT '0',
  `atwar2` int(1) NOT NULL DEFAULT '0',
  `atwar3` int(1) NOT NULL DEFAULT '0',
  `atwar4` int(1) NOT NULL DEFAULT '0',
  `atwar5` int(1) NOT NULL DEFAULT '0',
  `atwar6` int(1) NOT NULL DEFAULT '0',
  `atwar7` int(1) NOT NULL DEFAULT '0',
  `atwar8` int(1) NOT NULL DEFAULT '0',
  `atwar9` int(1) NOT NULL DEFAULT '0',
  `atwar10` int(1) NOT NULL DEFAULT '0',
  `atpeace1` int(1) NOT NULL DEFAULT '0',
  `atpeace2` int(1) NOT NULL DEFAULT '0',
  `atpeace3` int(1) NOT NULL DEFAULT '0',
  `atpeace4` int(1) NOT NULL DEFAULT '0',
  `atpeace5` int(1) NOT NULL DEFAULT '0',
  `atpeace6` int(1) NOT NULL DEFAULT '0',
  `atpeace7` int(1) NOT NULL DEFAULT '0',
  `atpeace8` int(1) NOT NULL DEFAULT '0',
  `atpeace9` int(1) NOT NULL DEFAULT '0',
  `atpeace10` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `relations`
--

INSERT INTO `relations` (`cid`, `atwar1`, `atwar2`, `atwar3`, `atwar4`, `atwar5`, `atwar6`, `atwar7`, `atwar8`, `atwar9`, `atwar10`, `atpeace1`, `atpeace2`, `atpeace3`, `atpeace4`, `atpeace5`, `atpeace6`, `atpeace7`, `atpeace8`, `atpeace9`, `atpeace10`) VALUES
(1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(9, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `cid` int(16) NOT NULL,
  `sessionid` varchar(128) DEFAULT 'invalid',
  `time` double DEFAULT NULL,
  `ip` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`cid`, `sessionid`, `time`, `ip`) VALUES
(1, 'BNL0JESSNRRA0WSO3W2ZRVWUE1SNSRAZ', 1488605481.93, '129.21.94.9'),
(2, 'invalid', NULL, NULL),
(3, 'invalid', NULL, NULL),
(4, 'NFYSQWNBL3ZRMPF9D5JZBUL1MWG9S891', 1488530163.59, '184.73.151.60'),
(5, 'KQ1PALLH1JEQ0Y4HMGIDO1X4S1AHXQ3R', 1488530186.85, '184.73.151.60'),
(6, 'invalid', NULL, NULL),
(7, 'invalid', NULL, NULL),
(8, 'invalid', NULL, NULL),
(9, 'invalid', NULL, NULL),
(10, 'invalid', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `starting_resources`
--

CREATE TABLE IF NOT EXISTS `starting_resources` (
  `cid` int(11) NOT NULL,
  `has_water` varchar(30) NOT NULL DEFAULT '0',
  `has_electricity` varchar(30) NOT NULL DEFAULT '0',
  `has_gas` varchar(30) NOT NULL DEFAULT '0',
  `has_food` varchar(30) NOT NULL DEFAULT '0',
  `has_luxury` varchar(30) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `starting_resources`
--

INSERT INTO `starting_resources` (`cid`, `has_water`, `has_electricity`, `has_gas`, `has_food`, `has_luxury`) VALUES
(1, '0', '0', '0', '0', '0'),
(2, '0', '0', '0', '0', '0'),
(3, '0', '0', '0', '0', '0'),
(4, '0', '0', '0', '0', '0'),
(5, '0', '0', '0', '0', '0'),
(6, '0', '0', '0', '0', '0'),
(7, '0', '0', '0', '0', '0'),
(8, '0', '0', '0', '0', '0'),
(9, '0', '0', '0', '0', '0'),
(10, '0', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `cid` int(16) NOT NULL,
  `countryname` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL DEFAULT 'password',
  `accountnum` int(10) NOT NULL,
  `balance` double NOT NULL DEFAULT '10000',
  `pin` int(4) NOT NULL DEFAULT '0',
  `lasttransfer` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1338 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`cid`, `countryname`, `password`, `accountnum`, `balance`, `pin`, `lasttransfer`) VALUES
(1, 'United States', 'password', 9121217, 10000, 1987, NULL),
(2, 'Canada', 'password', 2891231, 10000, 2782, NULL),
(3, 'United Kingdom', 'password', 3912381, 10000, 3905, NULL),
(4, 'Russia', 'password', 4102398, 10000, 7412, NULL),
(5, 'China', 'password', 5981239, 10000, 5823, NULL),
(6, 'South Africa', 'password', 7112821, 10000, 7789, NULL),
(7, 'Brazil', 'password', 8889631, 10000, 8562, NULL),
(8, 'Finland', 'password', 7843241, 10000, 6437, NULL),
(9, 'India', 'password', 1002376, 10000, 1062, NULL),
(10, 'Germany', 'password', 8934211, 10000, 8512, NULL),
(111, 'ATM', 'ATM_IS_COOL', 1337, 0, 0, NULL),
(1337, 'Red Team', 'horsebatteryists15variable', 4117117, 10000, 5499, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acquired_resources`
--
ALTER TABLE `acquired_resources`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `cid` (`cid`);

--
-- Indexes for table `auditing`
--
ALTER TABLE `auditing`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `relations`
--
ALTER TABLE `relations`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `Country Name` (`cid`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `cid` (`cid`);

--
-- Indexes for table `starting_resources`
--
ALTER TABLE `starting_resources`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `cid` (`cid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `cid` (`cid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auditing`
--
ALTER TABLE `auditing`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `cid` int(16) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1338;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
