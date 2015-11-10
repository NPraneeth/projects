-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 22, 2015 at 08:20 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ondrive`
--
CREATE DATABASE `ondrive` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ondrive`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adminu` varchar(50) NOT NULL,
  `adminp` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `adminu`, `adminp`) VALUES
(1, 'chandu', 'chandu'),
(2, 'harsha', 'harsha');

-- --------------------------------------------------------

--
-- Table structure for table `atten`
--

CREATE TABLE IF NOT EXISTS `atten` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `year` int(10) NOT NULL,
  `sem` int(50) NOT NULL,
  `branch` varchar(30) NOT NULL,
  `section` varchar(20) NOT NULL,
  `period` int(20) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `atten` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `atten`
--

INSERT INTO `atten` (`id`, `name`, `year`, `sem`, `branch`, `section`, `period`, `subject`, `date`, `atten`) VALUES
(4, 'hello', 3, 2, 'CSE', 'A', 2, 'AJWT', '2015-02-01', '31,34,35'),
(5, 'CHANDU', 3, 2, 'CSE', 'A', 5, 'UNIX', '2015-02-03', '42,41,17,16,20'),
(6, 'CHANDU', 2, 1, 'EEE', 'A', 4, 'mpmc', '2015-02-06', '31,35,36'),
(7, 'chandu', 3, 2, 'CSE', 'A', 2, 'ACN', '2015-02-05', '25,26,27'),
(8, 'harsha', 2, 2, 'CSE', 'B', 2, 'AJWT', '2015-03-02', '20,24,25,27'),
(9, 'harsha', 2, 2, 'CSE', 'A', 2, 'UNIX', '2015-03-02', '35,54,60');

-- --------------------------------------------------------

--
-- Table structure for table `comm`
--

CREATE TABLE IF NOT EXISTS `comm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roll` varchar(30) NOT NULL,
  `mykey` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roll` (`roll`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `comm`
--

INSERT INTO `comm` (`id`, `roll`, `mykey`) VALUES
(1, '11A51A0508', 'abcde'),
(2, '11A51A0501', 'abbba');

-- --------------------------------------------------------

--
-- Table structure for table `comp`
--

CREATE TABLE IF NOT EXISTS `comp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roll` varchar(50) NOT NULL,
  `comp` varchar(1000) NOT NULL,
  `datee` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `comp`
--

INSERT INTO `comp` (`id`, `roll`, `comp`, `datee`) VALUES
(1, '11A51A0508', 'Your ward attendence is not good ,,,nd classwork is not regular ...', '2015-03-23'),
(2, '11A51A0508', 'Your Ward sholud maintain Academic percentage', '2015-03-23'),
(3, '11A51A0508', 'No Regularity to the classes', '2015-03-17'),
(4, '11A51A0508', 'Percentage is not good', '2015-03-18'),
(5, '11A51A0508', 'Your ward attendence is not good ,,,nd classwork is not regular ...Your ward attendence is not good ,,,nd classwork is not regular ...Your ward attendence is not good ,,,nd classwork is not regular ...', '2015-03-19');

-- --------------------------------------------------------

--
-- Table structure for table `creq`
--

CREATE TABLE IF NOT EXISTS `creq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `c_date` date NOT NULL,
  `student` int(11) NOT NULL,
  `absant` varchar(150) NOT NULL,
  `remark` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `creq`
--

INSERT INTO `creq` (`id`, `name`, `branch`, `c_date`, `student`, `absant`, `remark`) VALUES
(2, 'mani', 'cse', '2013-09-21', 20, '12,14,16,18', 'very good'),
(5, 'chandu', 'cse', '2014-11-25', 30, '12,13,25,27', 'everything is good.. they had to improve their attendance percentage ... and maks percentage'),
(6, 'chandu', 'cse', '2014-11-26', 30, '12,14,115,16', 'very good'),
(7, 'chandu', 'cse', '2014-11-27', 20, '4,7,8,9', 'very good'),
(8, 'chandu', '3rd cse-B(21-40)', '2014-11-20', 20, '4,6,7,9', 'good'),
(9, 'chandu', '3rd cse-A (21-40)', '2014-11-10', 20, '12,13,15,', 'good'),
(10, 'chandu', '3rd cse-A (1-20)', '2014-11-15', 20, '12,13,4,5,17', 'fine'),
(11, 'chandu', '3rd cse-A (1-20)', '2014-11-15', 20, '15,16,17', 'very good'),
(12, 'hai', '3rd cse-A (41-60)', '2014-11-20', 20, '1,2', 'good'),
(13, 'hai', '3rd cse-A (1-20)', '2014-11-18', 20, '5,6', 'very good'),
(14, 'mani', '3rd cse-A (21-40)', '2014-11-09', 20, '1,2,3,', 'good'),
(15, 'chandu', '3rd cse-A (21-40)', '2015-02-01', 20, '12,14,20', 'Attendance percentage is much better than previous'),
(16, 'hello', '3rd cse-A (1-20)', '2015-02-01', 20, '12,16,17,20', 'Every thing is good'),
(17, 'chandu', '3rd cse-A (1-20)', '2015-03-04', 20, '3', 'dvfvd'),
(18, 'chandu', '3rd cse-A (21-40)', '2015-03-03', 10, '4,3,2', 'not bad'),
(19, 'harsha', '3rd cse-A (21-40)', '2015-03-02', 20, '1,6,8,24', 'No bad ,,they have to attend classes regularly'),
(20, 'harsha', '3rd cse-A (41-60)', '2015-03-05', 20, '5,7', 'Academic percentage is bad ,and attendance shud be maintained');

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE IF NOT EXISTS `details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(50) NOT NULL,
  `name` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `dist` varchar(30) NOT NULL,
  `gend` varchar(10) NOT NULL,
  `addr` varchar(50) NOT NULL,
  `desig` varchar(30) NOT NULL,
  `qualify` varchar(30) NOT NULL,
  `pursue` varchar(30) NOT NULL,
  `pob` varchar(30) NOT NULL,
  `nation` varchar(30) NOT NULL,
  `religion` varchar(30) NOT NULL,
  `caste` varchar(30) NOT NULL,
  `exp` int(30) NOT NULL,
  `exp2` int(30) NOT NULL,
  `doj` date NOT NULL,
  `present` varchar(30) NOT NULL,
  `scale` int(30) NOT NULL,
  `propic` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`id`, `uname`, `name`, `dob`, `dist`, `gend`, `addr`, `desig`, `qualify`, `pursue`, `pob`, `nation`, `religion`, `caste`, `exp`, `exp2`, `doj`, `present`, `scale`, `propic`) VALUES
(10, 'chandu', 'chandu', '1995-06-16', 'srikakulam', 'male', 'tekkali', 'B.tech', 'B.tech', 'B.tech', 'tekkali', 'indian', 'hindhu', 'oc', 3, 3, '2012-09-25', '2015-01-24', 50000, 'pros/albert_einstein_funny_wallpaper.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `drive`
--

CREATE TABLE IF NOT EXISTS `drive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `a_name` varchar(50) NOT NULL,
  `dept` varchar(40) NOT NULL,
  `title` varchar(50) NOT NULL,
  `j_name` varchar(50) NOT NULL,
  `i_no` int(11) NOT NULL,
  `issn` int(11) NOT NULL,
  `i_pact` varchar(50) NOT NULL,
  `ci` varchar(50) NOT NULL,
  `doi` date NOT NULL,
  `other` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `drive`
--

INSERT INTO `drive` (`id`, `name`, `a_name`, `dept`, `title`, `j_name`, `i_no`, `issn`, `i_pact`, `ci`, `doi`, `other`) VALUES
(1, 'mani', 'chadrasekhar', 'computer science', 'on drive', 'on drive', 3251, 7646, 'content to show', 'good', '2014-09-12', 'some description about journal'),
(2, 'chandu', 'chandu', '2014-11-12', 'chandu the great', 'great publishers', 748848, 5555, 'vjj', '2014-11-15', '0000-00-00', 'hello'),
(3, 'chandu', 'chandu', '2014-11-15', 'my way', 'my own', 4555, 5555, 'ffff', '2014-11-08', '0000-00-00', 'haiiiiiiiiiiiiiiii'),
(4, 'chandu', 'chandu_ivaturi', 'cse', 'My first Journal', 'Mcgrawhill', 34567, 788899, 'very usefull', '2014-11-14', '2014-11-13', 'this is my 1st journal very usefull for the studen'),
(5, 'chandu', 'chandu_ivaturi', 'cse', 'computers', 'tata ', 2234556, 7586, 'students', '2014-11-14', '2014-11-14', 'it is my 4th journal publishing worldwide official released today ...!!!');

-- --------------------------------------------------------

--
-- Table structure for table `f_list`
--

CREATE TABLE IF NOT EXISTS `f_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(30) NOT NULL,
  `pass` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `f_list`
--

INSERT INTO `f_list` (`id`, `uname`, `pass`) VALUES
(1, 'mani', 'mani'),
(2, 'chandu', 'chandu'),
(3, 'nagabhushan', 'nag'),
(4, 'hello', 'hello'),
(5, 'hai', 'hai'),
(6, 'dudu', 'dudu'),
(7, 'yupp', 'yupp'),
(8, 'harsha', 'harsha');
