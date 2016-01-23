-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 23, 2016 at 06:24 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `userlr`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
`id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `permissions` text
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`) VALUES
(1, 'standard user', '{"user": 1}'),
(2, 'administrator', '{"admin": 1}'),
(3, 'moderator', '{"moderator": 1}'),
(4, 'timetabler', '{"timetabler": 1}');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `name` varchar(50) NOT NULL,
  `joined` datetime NOT NULL,
  `user_group` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `name`, `joined`, `user_group`) VALUES
(1, 'aguvasu', '8f2b7f191ee28279cc21d12f22426c57f81f65b46c42b6eabd7961cf140c03ce', 'fäÛâÕ\n‹¼¯X·Ø“''''šVš4<àâE¶''‡¨', 'Kevin Aguvasu Mulugu', '2016-01-10 19:34:10', 2),
(2, 'warren', '5fcbd8fb093f53090ac6c68ab7798c2c5f99e703c7f9d4c3747b146f21db1413', '\\$×÷''¼Gá@ižÈÁí~ÀHZ/ÐÛq0_SJB', 'warren Peter', '2016-01-10 19:36:07', 1),
(3, 'celestine', '2cf40a2072219f7ba8a6c3839e66bf119617dc2b922619d4e41a9e021aca3370', 'Š±OkÁßÎ­ÂHÃÃÜ!-™ºÉy\rìK<Ä¡ Í9#', 'Celestine Ng''onyere', '2016-01-10 19:36:41', 1),
(4, 'vinny', 'dae84065cb1289a0f246f84738f015e575afd7021998818d3fcf3d14810ee28c', 'r¢•Õ¸^q­¢H\ZŒŽs$orÞªxkaí†…‹', 'gidoi vinn', '2016-01-12 17:43:51', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_sessions`
--

CREATE TABLE IF NOT EXISTS `users_sessions` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hash` varchar(64) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_sessions`
--

INSERT INTO `users_sessions` (`id`, `user_id`, `hash`) VALUES
(19, 12, 'eb98866c9a9cdf712f435422b27a0b0ac6c697f326027a22a900ae0b9100c06a'),
(20, 13, '7c2f3734099ffa448e26f96ce3f6e77c581e4065e7fdac8bde670a551639692c'),
(22, 1, '31df02c6b9a351a8b688b21afa1031996b9caa75e56833113c7a13781f39bd56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_sessions`
--
ALTER TABLE `users_sessions`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users_sessions`
--
ALTER TABLE `users_sessions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
