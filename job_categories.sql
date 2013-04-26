-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 16, 2012 at 04:31 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fairgo_mcerks`
--

-- --------------------------------------------------------

--
-- Table structure for table `job_categories`
--

CREATE TABLE IF NOT EXISTS `job_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(256) NOT NULL,
  `parent_category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=100 ;

--
-- Dumping data for table `job_categories`
--

INSERT INTO `job_categories` (`id`, `category_name`, `parent_category_id`) VALUES
(5, 'Sign up', 0),
(10, 'Click or Search', 0),
(15, 'Bookmark a page (digg, Delicious, Buzz,...)', 0),
(17, 'Google (+1)', 0),
(20, 'Youtube', 0),
(25, 'Facebook', 0),
(30, 'Twitter', 0),
(35, 'Voting & Rating (photo, video, article)', 0),
(40, 'Yahoo Answers', 0),
(45, 'Forums', 0),
(50, 'Download, Install', 0),
(55, 'Comment on Other Blogs', 0),
(60, 'Write a review online (Service, Product)', 0),
(65, 'Write an Article', 0),
(70, 'Mobile Applications (iPhone & Android)', 0),
(75, 'Blog/Website Owners', 0),
(80, 'Leads', 0),
(90, 'Surveys', 0),
(99, 'Other', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
