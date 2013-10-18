-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 16, 2012 at 06:54 AM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tim`
--

-- --------------------------------------------------------

--
-- Table structure for table `tim_chat`
--

CREATE TABLE IF NOT EXISTS `tim_chat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` varchar(50) NOT NULL,
  `to` varchar(50) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `time_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `new_flag` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=92 ;

--
-- Dumping data for table `tim_chat`
--


-- --------------------------------------------------------

--
-- Table structure for table `tim_chat_status`
--

CREATE TABLE IF NOT EXISTS `tim_chat_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `message` varchar(500) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `tim_chat_status`
--

INSERT INTO `tim_chat_status` (`id`, `username`, `message`, `time`) VALUES
(1, 'Bridgette', 'I am available.', '2012-10-16 04:42:58'),
(2, 'Cathy', 'I am available.', '2012-10-16 04:42:58'),
(3, 'Harold', 'I am available.', '2012-10-16 04:42:58'),
(4, 'Jingting', 'I am available.', '2012-10-16 04:42:58'),
(5, 'Ryan', 'I am available.', '2012-10-16 04:42:58'),
(6, 'Shiwei', 'I am available.', '2012-10-16 04:42:58'),
(7, 'Maziah', 'I am available.', '2012-10-16 04:42:58'),
(8, 'Weiping', 'I am available.', '2012-10-16 04:42:58'),
(9, 'Fei', 'I am available.', '2012-10-16 04:42:58'),
(10, 'Harold', 'I am available.', '2012-10-16 05:07:18');

-- --------------------------------------------------------

--
-- Table structure for table `tim_chat_users`
--

CREATE TABLE IF NOT EXISTS `tim_chat_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `key` varchar(20) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `last_activity` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tim_chat_users`
--

INSERT INTO `tim_chat_users` (`id`, `username`, `name`, `key`, `status`, `last_activity`) VALUES
(4, 'Harold', 'Harold Jayson Caminero', 'pPOpLA7NdbOpyYMvP2tE', 1, '2012-10-16 06:54:40'),
(5, 'Weiping', 'Weiping', 'DXLo8jAO61j78gv3KrUi', 1, '2012-10-16 06:54:40'),
(6, 'Bridgette', 'Bridgette See', 'oEK0MdfVDeueDjRgtRCu', 0, '2012-10-16 02:12:35'),
(7, 'Cathy', 'Cathy Foong', 'ooLYVtvXVSjZZx2EUoSp', 1, '2012-10-16 06:54:40'),
(8, 'Fei', 'Yip Siew Fei', 'RqeHFzVzFAhrNFXHiFCT', 0, '2012-10-16 02:12:35'),
(9, 'Jingting', 'Jingting Chen', 'qIvWVWrOK8avyKsM27CZ', 0, '2012-10-16 02:12:35'),
(10, 'Maziah', 'Siti Maziah', '1yj0ODvnQcqdF8eKcmPx', 0, '2012-10-16 02:12:35'),
(11, 'Shiwei', 'Shiwei Ng', '8blU5xIypwlNLZRLo5Kq', 0, '2012-10-16 02:12:35'),
(12, 'Ryan', 'Ryan Ong', 'y43IY6TJWW9bGkmBCjWR', 0, '2012-10-16 02:12:35');
