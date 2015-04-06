-- phpMyAdmin SQL Dump
-- version 4.2.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 06, 2015 at 05:35 PM
-- Server version: 5.5.41-0ubuntu0.14.10.1
-- PHP Version: 5.5.12-2ubuntu4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sf`
--

-- --------------------------------------------------------

--
-- Table structure for table `sf_accounts`
--

CREATE TABLE IF NOT EXISTS `sf_accounts` (
`id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `passhash` varchar(256) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '3',
  `display` varchar(32) NOT NULL DEFAULT 'Bob'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sf_categories`
--

CREATE TABLE IF NOT EXISTS `sf_categories` (
  `name` varchar(128) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
`id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `sf_categories`
--

INSERT INTO `sf_categories` (`name`, `parent`, `id`) VALUES
('Home', -1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sf_posts`
--

CREATE TABLE IF NOT EXISTS `sf_posts` (
`id` int(11) NOT NULL,
  `author` varchar(32) NOT NULL,
  `topic` int(11) NOT NULL,
  `post` text NOT NULL,
  `creation_date` varchar(32) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sf_topics`
--

CREATE TABLE IF NOT EXISTS `sf_topics` (
`id` int(11) NOT NULL,
  `author` varchar(32) NOT NULL,
  `title` varchar(128) NOT NULL,
  `category` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sf_accounts`
--
ALTER TABLE `sf_accounts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sf_categories`
--
ALTER TABLE `sf_categories`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sf_posts`
--
ALTER TABLE `sf_posts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sf_topics`
--
ALTER TABLE `sf_topics`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sf_accounts`
--
ALTER TABLE `sf_accounts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `sf_categories`
--
ALTER TABLE `sf_categories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `sf_posts`
--
ALTER TABLE `sf_posts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `sf_topics`
--
ALTER TABLE `sf_topics`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
