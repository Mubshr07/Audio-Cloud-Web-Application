-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 27, 2019 at 02:18 AM
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
-- Database: `classpractice`
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
  `title` varchar(200) NOT NULL,
  `description` varchar(255) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `audiobank`
--

INSERT INTO `audiobank` (`id`, `userID`, `userName`, `title`, `description`, `remarks`, `filename`, `filepath`, `filetype`, `uploadingDate`, `category`, `publicPrivate`, `audioDuration`, `relevance`, `listenCount`, `liked`, `disliked`, `Shared`, `approved`) VALUES
(12, 1, 'mubi', 'Her simmt Chha gi hai', 'Har Simmt Description', 'Her Simmt Chha gi audio remarks', '1565511241_Her Simt Chha Gay Hain.mp3', 'F:wamp64wwwAudioCloudaudioBank1565511241_Her Simt Chha Gay Hain.mp3', 'wav', '2019-08-11 08:14:01', 'naat', 0, '0', '0', 0, 0, 0, 0, 0),
(11, 1, 'mubi', 'Qari Sahb', 'This is Description', 'Heloo THis is remarks', '1565511195_Qari Saleem Seedat - Allah ko Pukaray Gein.mp3', 'F:wamp64wwwAudioCloudaudioBank1565511195_Qari Saleem Seedat - Allah ko Pukaray Gein.mp3', 'mp3', '2019-08-11 08:13:15', 'Quran', 0, '0', '0', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `audiocategories`
--

DROP TABLE IF EXISTS `audiocategories`;
CREATE TABLE IF NOT EXISTS `audiocategories` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `addedBy` varchar(200) DEFAULT NULL,
  `datetime` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

DROP TABLE IF EXISTS `playlist`;
CREATE TABLE IF NOT EXISTS `playlist` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `userID` int(100) NOT NULL,
  `playlistName` varchar(200) NOT NULL DEFAULT 'playlist',
  `creationDate` timestamp NOT NULL,
  `audio` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `firstName`, `lastName`, `email`, `password`, `email_Confirm`, `user_Approval`, `type`, `date_of_join`, `last_login`) VALUES
(1, 'mubi', 'Mubashir', 'Iqbal', 'mubshr7@gmail.com', '$2y$10$HDLjQUjS9XZ/nBHUKcegwuWNAjUpvsEMyBEN9aCG2N1vwPYS6J7Ci', 1, 1, 'admin', '2019-07-12 21:12:20', '2019-08-07 03:22:39'),
(8, 'mubiii', 'Mubashir', 'Iqbal', 'mubshrii7@gmail.com', '$2y$10$qwyGnkFmt90axFN1377C3OpmVJHoPqW7p7pIoNvLz101FiM9SubGq', 0, 0, 'Subscriber', '2019-08-03 14:54:22', '2019-08-03 09:54:30'),
(7, 'mubii', 'Mubashir', 'Iqbal', 'mubshri7@gmail.com', '$2y$10$Fvih/HFoOj9aVEN4H.2Q1Od3RyU4bUrDDAEZc4quew.HPfdo6oueS', 0, 0, 'Subscriber', '2019-08-03 14:51:07', '2019-08-03 09:54:00'),
(9, 'mubiiii', 'Mubashir', 'Iqbal', 'mubshriiii7@gmail.com', '$2y$10$qRAZsjjSfPzJ99O2BB1KFeKNAPR7TU7qiBZT7F4TYSCuYF73z7yhi', 0, 0, 'Subscriber', '2019-08-03 15:18:46', NULL),
(10, 'mubiiiii', 'Mubashir456', 'Iqbal', 'mubshriiiii7@gmail.com', '$2y$10$lA0A/mmXT6qUEhxB72KS3O92fZLYZROlqeN/..Zfniix2hGoMpkNS', 0, 0, 'Subscriber', '2019-08-03 15:19:31', '2019-08-03 12:29:40'),
(11, 'mubi5', 'Mubashir', 'Iqbal', 'mubshr57@gmail.com', '$2y$10$gMYkabgoXWaEJuo2hxbPFu.iYf55itsPR3btmAWx1Du6kvnppfXde', 0, 0, 'Subscriber', '2019-08-03 15:32:13', '2019-08-03 16:54:22');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
