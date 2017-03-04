-- phpMyAdmin SQL Dump
-- version 4.6.5.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 06, 2017 at 08:28 PM
-- Server version: 10.1.20-MariaDB
-- PHP Version: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ists`
--
use ists;
-- --------------------------------------------------------

--
-- Table structure for table `acquired_resources`
--

CREATE TABLE `acquired_resources` (
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

CREATE TABLE `auditing` (
  `aid` int(16) NOT NULL,
  `cidsrc` int(16) NOT NULL,
  `ciddst` int(16) NOT NULL,
  `action` varchar(255) NOT NULL,
  `data` varchar(255) NOT NULL,
  `time` double NOT NULL,
  `ip` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `relations`
--

CREATE TABLE `relations` (
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

CREATE TABLE `sessions` (
  `cid` int(16) NOT NULL,
  `sessionid` varchar(128) DEFAULT 'invalid',
  `time` double DEFAULT NULL,
  `ip` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`cid`, `sessionid`, `time`, `ip`) VALUES
(1, 'invalid', NULL, NULL),
(2, 'invalid', NULL, NULL),
(3, 'invalid', NULL, NULL),
(4, 'invalid', NULL, NULL),
(5, 'invalid', NULL, NULL),
(6, 'invalid', NULL, NULL),
(7, 'invalid', NULL, NULL),
(8, 'invalid', NULL, NULL),
(9, 'invalid', NULL, NULL),
(10, 'invalid', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `starting_resources`
--

CREATE TABLE `starting_resources` (
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

CREATE TABLE `users` (
  `cid` int(16) NOT NULL,
  `countryname` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL DEFAULT 'password',
  `accountnum` int(10) NOT NULL,
  `balance` double NOT NULL DEFAULT '10000',
  `pin` int(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`cid`, `countryname`, `password`, `accountnum`, `balance`, `pin`) VALUES
(1, 'United States', 'password', 0801256325, 10000, 2913),
(2, 'Canada', 'password', 9531494373, 10000, 6871),
(3, 'United Kingdom', 'password', 7048811450, 10000, 6464),
(4, 'Russia', 'password', 7460413969, 10000, 4468),
(5, 'China', 'password', 8871302371, 10000, 6355),
(6, 'South Korea', 'password', 1837375547, 10000, 0852),
(7, 'Jamaica', 'password', 6585102787, 10000, 7709),
(8, 'Germany', 'password', 8770266532, 10000, 7274),
(9, 'Finland', 'password', 5334292398, 10000, 3239),
(10, 'India', 'password', 5605213540, 10000, 0151),
(111, 'ATM', 'ATM_IS_COOL', 7071337707, '0', '0'),
(1337, 'Red Team', 'horsebatteryists15variable', 7862105372, 10000, 5499);

--
-- Indexes for dumped tables
--

ALTER TABLE `auditing`
  ADD PRIMARY KEY (`aid`),
  MODIFY COLUMN `aid` INT AUTO_INCREMENT;
--
-- Indexes for table `acquired_resources`
--
ALTER TABLE `acquired_resources`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `cid` (`cid`);

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `cid` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
