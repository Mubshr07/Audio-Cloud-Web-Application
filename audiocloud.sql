-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 02, 2019 at 05:39 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `audiocloud`
--

-- --------------------------------------------------------

--
-- Table structure for table `audiobank`
--

DROP TABLE IF EXISTS `audiobank`;
CREATE TABLE IF NOT EXISTS `audiobank` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `userID` int(100) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `remarks` text,
  `filename` varchar(255) NOT NULL,
  `filepath` varchar(255) DEFAULT NULL,
  `filetype` varchar(100) NOT NULL,
  `uploadingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category` varchar(100) NOT NULL,
  `publicPrivate` int(10) NOT NULL DEFAULT '0',
  `audioDuration` varchar(50) NOT NULL DEFAULT '0',
  `relevance` varchar(100) NOT NULL DEFAULT '0',
  `listenCount` int(100) NOT NULL DEFAULT '0',
  `liked` int(100) NOT NULL DEFAULT '0',
  `disliked` int(100) NOT NULL DEFAULT '0',
  `Shared` int(100) NOT NULL DEFAULT '0',
  `approved` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `audiocategories`
--

DROP TABLE IF EXISTS `audiocategories`;
CREATE TABLE IF NOT EXISTS `audiocategories` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `addedBy` varchar(200) DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `audiocategories`
--

INSERT INTO `audiocategories` (`id`, `name`, `addedBy`, `datetime`) VALUES
(1, 'Quran ', NULL, '2019-09-14 11:37:22'),
(2, 'Recitations', NULL, '2019-09-14 11:37:22'),
(3, 'Naats', NULL, '2019-09-14 11:37:48'),
(4, 'Audio Lectures', NULL, '2019-09-14 11:37:48'),
(5, 'Audio Notes', NULL, '2019-09-14 11:38:04'),
(6, 'Sound Effects', NULL, '2019-09-14 11:38:04'),
(7, 'Royality free music ', NULL, '2019-09-14 11:38:19'),
(14, 'Test Category', NULL, '2019-09-28 16:38:46');

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

DROP TABLE IF EXISTS `playlist`;
CREATE TABLE IF NOT EXISTS `playlist` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `userID` int(100) NOT NULL,
  `playlistName` varchar(200) NOT NULL DEFAULT 'playlist',
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `audio` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`id`, `userID`, `playlistName`, `creationDate`, `audio`) VALUES
(11, 1, 'playlist', '2019-10-01 17:16:19', 'asdfewr'),
(9, 1, 'playlist', '2019-10-01 17:12:02', 'asdf'),
(13, 12, 'First', '2019-10-02 02:49:11', '32'),
(12, 1, 'asd', '2019-10-01 17:18:57', '0'),
(8, 1, 'playlist', '2019-09-28 09:54:02', ' 31  30'),
(10, 1, 'playlist', '2019-10-01 17:15:33', 'asdf');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_Confirm` int(20) NOT NULL DEFAULT '0',
  `user_Approval` int(20) NOT NULL DEFAULT '0',
  `type` varchar(100) NOT NULL DEFAULT 'Subscriber',
  `date_of_join` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` varchar(100) DEFAULT NULL,
  `hash` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `firstName`, `lastName`, `email`, `password`, `email_Confirm`, `user_Approval`, `type`, `date_of_join`, `last_login`, `hash`) VALUES
(1, 'mubi', 'Mubashir', 'Iqbal', 'mubshr7@gmail.com', '$2y$10$HDLjQUjS9XZ/nBHUKcegwuWNAjUpvsEMyBEN9aCG2N1vwPYS6J7Ci', 1, 1, 'admin', '2019-07-12 21:12:20', '2019-09-26 15:12:59', NULL),
(12, 'Arslan', 'Arslan', 'Maqbool', 'arsalmaqbool723@gamil.com', '$2y$10$slay1RKa69ovnhhcOi57LeF1fKmniXvo.T94R3bAgpDRg3xUFq8a2', 0, 1, 'Subscriber', '2019-09-18 21:24:09', '2019-10-02 02:49:01', NULL),
(22, 'mubiwre', 'sdfasdf', 'werwer', 'mubshr07@gmail.com', '$2y$10$f/CH4K.7uVaiCokw3Cmm6OBhyhB5U0ZFQ0A9R/ozXlk1XAZn0KLIO', 0, 0, 'Subscriber', '2019-09-26 20:10:28', '2019-09-26 15:12:36', 'e7b24b112a44fdd9ee93bdf998c6ca0e');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
