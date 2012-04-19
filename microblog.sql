-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 13, 2012 at 04:42 PM
-- Server version: 5.1.61
-- PHP Version: 5.3.6-13ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `microblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `cmt_id` int(11) NOT NULL AUTO_INCREMENT,
  `cmt_usr_id` int(11) DEFAULT NULL,
  `cmt_usr_name` varchar(100) DEFAULT NULL,
  `cmt_usr_mail` varchar(100) DEFAULT NULL,
  `cmt_post_id` int(11) NOT NULL,
  `cmt_content` text NOT NULL,
  `cmt_dt` datetime NOT NULL,
  PRIMARY KEY (`cmt_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`cmt_id`, `cmt_usr_id`, `cmt_usr_name`, `cmt_usr_mail`, `cmt_post_id`, `cmt_content`, `cmt_dt`) VALUES
(1, NULL, 'test', 'test', 4, 'test', '2012-04-11 12:32:36'),
(2, 1, NULL, NULL, 4, 'toto', '2012-04-11 12:44:48');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_title` varchar(200) DEFAULT NULL,
  `post_crea_usr_id` int(11) NOT NULL,
  `post_title_url` varchar(200) NOT NULL,
  `post_content` text NOT NULL,
  `post_dt_crea` datetime NOT NULL,
  `post_dt_modif` datetime NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_title`, `post_crea_usr_id`, `post_title_url`, `post_content`, `post_dt_crea`, `post_dt_modif`) VALUES
(9, 'FormCreator', 1, 'formcreator-9', 'I justed created a small HTML form creator.\r\nIt''s supposed to create a form with hidden inputs from a list of parameters.\r\nIt can be found at http://remy-gardette.fr/formCreator.', '2012-04-12 11:55:31', '2012-04-12 11:55:31'),
(10, 'MicroBlog', 1, 'microblog-10', 'I am currently working on a light blogging solution, to present my projects and work.', '2012-04-12 14:09:55', '2012-04-12 14:09:56');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `pro_id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_name` varchar(100) NOT NULL,
  `pro_desc` text NOT NULL,
  `pro_url` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`pro_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`pro_id`, `pro_name`, `pro_desc`, `pro_url`) VALUES
(9, 'FormCreator', 'A small HTML form creator.', 'http://remy-gardette.fr/formCreator'),
(10, 'MicroBlog', 'A micro blogging solution, with a presentation of my projects', 'http://remy-gardette.fr/microblog');

-- --------------------------------------------------------

--
-- Table structure for table `rights`
--

CREATE TABLE IF NOT EXISTS `rights` (
  `rgt_id` int(11) NOT NULL,
  `rgt_cd` varchar(5) NOT NULL,
  `rgt_name` varchar(20) NOT NULL,
  PRIMARY KEY (`rgt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rights`
--

INSERT INTO `rights` (`rgt_id`, `rgt_cd`, `rgt_name`) VALUES
(1, 'ADMIN', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `usr_id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_name` varchar(50) NOT NULL,
  `usr_password` varchar(50) NOT NULL,
  `usr_mail` varchar(100) NOT NULL,
  `usr_dt_crea` datetime NOT NULL,
  PRIMARY KEY (`usr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usr_id`, `usr_name`, `usr_password`, `usr_mail`, `usr_dt_crea`) VALUES
(1, 'ramy', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'test', '2012-04-10 12:45:56');

-- --------------------------------------------------------

--
-- Table structure for table `user_rights`
--

CREATE TABLE IF NOT EXISTS `user_rights` (
  `rgt_id` int(11) NOT NULL,
  `usr_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_rights`
--

INSERT INTO `user_rights` (`rgt_id`, `usr_id`) VALUES
(1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
