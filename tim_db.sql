-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 16, 2012 at 12:05 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tim_chat`
--

INSERT INTO `tim_chat` (`id`, `from`, `to`, `message`, `time_added`, `new_flag`) VALUES
(1, 'Weiping', 'Harold', 'wee?', '2012-10-17 15:48:13', 0),
(2, 'Harold', 'Weiping', 'yes?', '2012-10-17 15:48:31', 0),
(3, 'Harold', 'Weiping', 'the quick brown fox jumps over the lazy dog!', '2012-10-17 15:48:45', 0),
(4, 'Jingting', 'Cathy', 'hey cathy', '2012-10-18 12:19:53', 1),
(5, 'Harold', 'Weiping', 'wee', '2012-10-22 12:11:59', 0),
(6, 'Weiping', 'Harold', 'wee', '2012-10-22 12:12:23', 0);

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
(4, 'Harold', 'Harold Jayson Caminero', 'pPOpLA7NdbOpyYMvP2tE', 0, '2012-10-22 12:23:00'),
(5, 'Weiping', 'Weiping Liew', 'DXLo8jAO61j78gv3KrUi', 1, '2012-10-22 16:29:03'),
(6, 'Bridgette', 'Bridgette See', 'oEK0MdfVDeueDjRgtRCu', 0, '2012-10-16 02:12:35'),
(7, 'Cathy', 'Cathy Foong', 'ooLYVtvXVSjZZx2EUoSp', 0, '2012-10-16 09:09:01'),
(8, 'Fei', 'Yip Siew Fei', 'RqeHFzVzFAhrNFXHiFCT', 0, '2012-10-16 02:12:35'),
(9, 'Jingting', 'Jingting Chen', 'qIvWVWrOK8avyKsM27CZ', 0, '2012-10-18 14:46:42'),
(10, 'Maziah', 'Siti Maziah', '1yj0ODvnQcqdF8eKcmPx', 0, '2012-10-16 02:12:35'),
(11, 'Shiwei', 'Shiwei Ng', '8blU5xIypwlNLZRLo5Kq', 0, '2012-10-16 02:12:35'),
(12, 'Ryan', 'Ryan Ong', 'y43IY6TJWW9bGkmBCjWR', 0, '2012-10-16 02:12:35');

-- --------------------------------------------------------

--
-- Table structure for table `tim_group_chat`
--

CREATE TABLE IF NOT EXISTS `tim_group_chat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `title` varchar(200) NOT NULL,
  `message` varchar(500) NOT NULL,
  `time` datetime NOT NULL,
  `last_updated` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tim_group_chat`
--

INSERT INTO `tim_group_chat` (`id`, `username`, `title`, `message`, `time`, `last_updated`, `status`) VALUES
(3, 'Weiping', 'Lunch Suggestions!', 'Hi Guys, feel free to suggest cool places for lunch.', '2012-10-17 06:46:43', '2012-10-17 06:46:43', 1),
(4, 'Harold', 'TIM Feedback', 'Hi Guys,\nI need your feedback. \n\nThank you very much!.', '2012-10-17 07:25:59', '2012-10-18 02:58:05', 1),
(5, 'Jingting', 'Contact Guys!', 'please see attachment!', '2012-10-18 03:20:35', '2012-10-18 12:40:44', 1),
(6, 'Weiping', 'this is the new topic', 'hey guys!', '2012-10-18 03:28:37', '2012-10-18 03:28:37', 1),
(7, 'Weiping', 'Tuber Instant Messaging Feedback', 'hey Guys,', '2012-10-18 12:52:30', '2012-10-18 12:52:30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tim_group_chat_members`
--

CREATE TABLE IF NOT EXISTS `tim_group_chat_members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gc_id` int(10) unsigned NOT NULL,
  `username` varchar(100) NOT NULL,
  `last_read` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `tim_group_chat_members`
--

INSERT INTO `tim_group_chat_members` (`id`, `gc_id`, `username`, `last_read`) VALUES
(16, 4, 'Cathy', ''),
(15, 4, 'Bridgette', ''),
(14, 4, 'Weiping', '3'),
(13, 4, 'Harold', ''),
(12, 3, 'Shiwei', ''),
(11, 3, 'Ryan', ''),
(10, 3, 'Weiping', ''),
(17, 4, 'Fei', ''),
(18, 4, 'Jingting', '3'),
(19, 4, 'Maziah', ''),
(20, 4, 'Shiwei', ''),
(21, 4, 'Ryan', ''),
(22, 5, 'Harold', ''),
(23, 5, 'Weiping', '9'),
(24, 5, 'Bridgette', ''),
(25, 5, 'Cathy', ''),
(26, 5, 'Fei', ''),
(27, 5, 'Jingting', '6'),
(28, 5, 'Maziah', ''),
(29, 5, 'Shiwei', ''),
(30, 5, 'Ryan', ''),
(40, 7, 'Harold', ''),
(31, 6, 'Harold', ''),
(32, 6, 'Weiping', 'first'),
(33, 6, 'Bridgette', ''),
(34, 6, 'Cathy', ''),
(35, 6, 'Fei', ''),
(36, 6, 'Jingting', 'first'),
(37, 6, 'Maziah', ''),
(38, 6, 'Shiwei', ''),
(39, 6, 'Ryan', ''),
(41, 7, 'Weiping', ''),
(42, 7, 'Bridgette', ''),
(43, 7, 'Cathy', ''),
(44, 7, 'Fei', ''),
(45, 7, 'Jingting', ''),
(46, 7, 'Maziah', ''),
(47, 7, 'Shiwei', ''),
(48, 7, 'Ryan', '');

-- --------------------------------------------------------

--
-- Table structure for table `tim_group_chat_messages`
--

CREATE TABLE IF NOT EXISTS `tim_group_chat_messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gc_id` int(10) unsigned NOT NULL,
  `username` varchar(100) NOT NULL,
  `message` varchar(500) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tim_group_chat_messages`
--

INSERT INTO `tim_group_chat_messages` (`id`, `gc_id`, `username`, `message`, `time`) VALUES
(1, 3, 'Ryan', 'Wee?', '2012-10-17 14:54:11'),
(2, 4, 'Weiping', 'I dont like your chat system, it''s so useless. Wasting company''s money!', '2012-10-18 02:53:15'),
(3, 4, 'Weiping', 'yes I don''t like it!', '2012-10-18 02:58:05'),
(4, 5, 'Weiping', 'where is the attachment?', '2012-10-18 03:32:32'),
(5, 5, 'Jingting', 'its in your email. thanks.', '2012-10-18 04:19:20'),
(6, 5, 'Weiping', 'ok thanks', '2012-10-18 04:19:42'),
(7, 5, 'Weiping', 'weee', '2012-10-18 12:34:55'),
(8, 5, 'Weiping', 'visit this link:', '2012-10-18 12:40:42'),
(9, 5, 'Weiping', 'http://www.mediacollege.com/internet/javascript/page/reload.html', '2012-10-18 12:40:44');
