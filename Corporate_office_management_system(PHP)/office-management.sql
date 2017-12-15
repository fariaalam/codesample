-- phpMyAdmin SQL Dump
-- version 2.11.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 14, 2014 at 09:15 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `office-management`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountant`
--

CREATE TABLE IF NOT EXISTS `accountant` (
  `accountant_id` int(11) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone_number` varchar(200) NOT NULL,
  `appointment_date` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `department` varchar(200) NOT NULL,
  `performance` longtext NOT NULL,
  PRIMARY KEY  (`accountant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `accountant`
--

INSERT INTO `accountant` (`accountant_id`, `name`, `address`, `phone_number`, `appointment_date`, `email`, `password`, `department`, `performance`) VALUES
(1, 'amrita', 'farmgate', '016', '12.01.14', 'ac@yahoo.com', '1234', 'Human Resource', '67');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone_number` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  PRIMARY KEY  (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `address`, `phone_number`, `password`, `email`) VALUES
(1, 'zdcaDvcADS', '', '', '2222', 'admin@yahoo.com');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
  `attendance_id` int(11) NOT NULL auto_increment,
  `user_type` longtext NOT NULL,
  `user_id` longtext NOT NULL,
  `status` longtext NOT NULL,
  `date` longtext NOT NULL,
  PRIMARY KEY  (`attendance_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `user_type`, `user_id`, `status`, `date`) VALUES
(1, 'managing_director', '2', 'p', '2014-07-14'),
(2, 'director', '1', '', '2014-07-14'),
(3, 'director', '4', 'p', '2014-07-14'),
(4, 'human_resource', '1', 'p', '2014-07-14'),
(5, 'accountant', '1', 'p', '2014-07-14'),
(6, 'executive_officer', '2', 'p', '2014-07-14'),
(7, 'executive_officer', '4', 'p', '2014-07-14'),
(8, 'senior_officer', '1', 'p', '2014-07-14'),
(9, 'junior_officer', '1', 'p', '2014-07-14'),
(10, 'junior_officer', '3', 'p', '2014-07-14'),
(11, 'trainee', '1', 'p', '2014-07-14'),
(12, 'trainee', '2', 'p', '2014-07-14'),
(13, 'trainee', '3', 'p', '2014-07-14'),
(14, 'managing_director', '2', 'p', '2014-07-15'),
(15, 'director', '1', '', '2014-07-15'),
(16, 'director', '4', 'p', '2014-07-15'),
(17, 'human_resource', '1', '', '2014-07-15'),
(18, 'accountant', '1', '', '2014-07-15'),
(19, 'executive_officer', '2', '', '2014-07-15'),
(20, 'executive_officer', '4', '', '2014-07-15'),
(21, 'senior_officer', '1', '', '2014-07-15'),
(22, 'junior_officer', '1', '', '2014-07-15'),
(23, 'junior_officer', '3', 'p', '2014-07-15'),
(24, 'trainee', '1', '', '2014-07-15'),
(25, 'trainee', '2', '', '2014-07-15'),
(26, 'trainee', '3', 'p', '2014-07-15');

-- --------------------------------------------------------

--
-- Table structure for table `director`
--

CREATE TABLE IF NOT EXISTS `director` (
  `director_id` int(11) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone_number` varchar(200) NOT NULL,
  `appointment_date` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `department` varchar(200) NOT NULL,
  `performance` longtext NOT NULL,
  PRIMARY KEY  (`director_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `director`
--

INSERT INTO `director` (`director_id`, `name`, `address`, `phone_number`, `appointment_date`, `email`, `password`, `department`, `performance`) VALUES
(1, 'D', 'mhgzcha', '7897', '12.09.78', 'd4@yahoo.com', '1234', 'Technology', ''),
(4, 'd2', 'mogbazar', '4567', '12.01.2002', 'd@yahoo.com', '1234', 'Finance', '');

-- --------------------------------------------------------

--
-- Table structure for table `executive_officer`
--

CREATE TABLE IF NOT EXISTS `executive_officer` (
  `executive_officer_id` int(11) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone_number` varchar(200) NOT NULL,
  `appointment_date` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `department` varchar(200) NOT NULL,
  `performance` longtext NOT NULL,
  PRIMARY KEY  (`executive_officer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `executive_officer`
--

INSERT INTO `executive_officer` (`executive_officer_id`, `name`, `address`, `phone_number`, `appointment_date`, `email`, `password`, `department`, `performance`) VALUES
(2, 'e2', 'savar', '6666888', '12.01.14', 'htgfh@hgvn.jgfj', '1234', 'Planning', ''),
(4, 'e4', 'mogbazar', '65789', '12.12.12', 'e4@yahoo.com', '1234', 'Finance', '');

-- --------------------------------------------------------

--
-- Table structure for table `human_resource`
--

CREATE TABLE IF NOT EXISTS `human_resource` (
  `human_resource_id` int(11) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone_number` varchar(200) NOT NULL,
  `appointment_date` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `department` varchar(200) NOT NULL,
  `performance` longtext NOT NULL,
  PRIMARY KEY  (`human_resource_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `human_resource`
--

INSERT INTO `human_resource` (`human_resource_id`, `name`, `address`, `phone_number`, `appointment_date`, `email`, `password`, `department`, `performance`) VALUES
(1, 'err', 'rtt', '0123', '12.01.2002', 'h@yahoo.com', '1234', 'Technology', '');

-- --------------------------------------------------------

--
-- Table structure for table `junior_officer`
--

CREATE TABLE IF NOT EXISTS `junior_officer` (
  `junior_officer_id` int(11) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone_number` varchar(200) NOT NULL,
  `appointment_date` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `department` varchar(200) NOT NULL,
  `performance` longtext NOT NULL,
  PRIMARY KEY  (`junior_officer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `junior_officer`
--

INSERT INTO `junior_officer` (`junior_officer_id`, `name`, `address`, `phone_number`, `appointment_date`, `email`, `password`, `department`, `performance`) VALUES
(1, 'j1', 'rytu', '01344', '2.2.02', 'j@yahoo.com', '1234', 'Technology', ''),
(3, 'j2', 'farmgate', '01765', '2.8.12', 'j2@yahoo.com', '1234', 'Finance', '');

-- --------------------------------------------------------

--
-- Table structure for table `managing_director`
--

CREATE TABLE IF NOT EXISTS `managing_director` (
  `managing_director_id` int(11) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone_number` varchar(200) NOT NULL,
  `appointment_date` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `department` varchar(200) NOT NULL,
  `performance` longtext NOT NULL,
  PRIMARY KEY  (`managing_director_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `managing_director`
--

INSERT INTO `managing_director` (`managing_director_id`, `name`, `address`, `phone_number`, `appointment_date`, `email`, `password`, `department`, `performance`) VALUES
(2, 'MD', 'ADD', '011', '12.01.2002', 'md@yahoo.com', '1234', 'Technology', '');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE IF NOT EXISTS `notice` (
  `notice_id` int(11) NOT NULL auto_increment,
  `description` longtext NOT NULL,
  `date` longtext NOT NULL,
  `title` longtext NOT NULL,
  PRIMARY KEY  (`notice_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`notice_id`, `description`, `date`, `title`) VALUES
(1, 'tomader 12 ta bajbe', '12.12.12', '12ta'),
(3, 'eid bonus nai', '12.12.12', 'nai');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `project_id` int(11) NOT NULL auto_increment,
  `budget` int(11) NOT NULL,
  `department` longtext NOT NULL,
  `description` longtext NOT NULL,
  PRIMARY KEY  (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `project`
--


-- --------------------------------------------------------

--
-- Table structure for table `senior_officer`
--

CREATE TABLE IF NOT EXISTS `senior_officer` (
  `senior_officer_id` int(11) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone_number` varchar(200) NOT NULL,
  `appointment_date` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `department` varchar(200) NOT NULL,
  `performance` longtext NOT NULL,
  PRIMARY KEY  (`senior_officer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `senior_officer`
--

INSERT INTO `senior_officer` (`senior_officer_id`, `name`, `address`, `phone_number`, `appointment_date`, `email`, `password`, `department`, `performance`) VALUES
(1, 's2', 'hgfutg', '098', '12.09.78', 's@gmail.com', '1234', 'Technology', '');

-- --------------------------------------------------------

--
-- Table structure for table `trainee`
--

CREATE TABLE IF NOT EXISTS `trainee` (
  `trainee_id` int(11) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone_number` varchar(200) NOT NULL,
  `appointment_date` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `department` varchar(200) NOT NULL,
  `performance` longtext NOT NULL,
  PRIMARY KEY  (`trainee_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `trainee`
--

INSERT INTO `trainee` (`trainee_id`, `name`, `address`, `phone_number`, `appointment_date`, `email`, `password`, `department`, `performance`) VALUES
(1, 'T', 'add', '111', '12.01.2002', 't@yahoo.com', '1234', '', ''),
(2, 'q', 'q', 'q', 'q', 'q', 'q', '', ''),
(3, 't2', 'dhaka', '5678', '23.09.12', 't2@yahoo.com', '1234', 'Finance', '');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `transaction_id` int(11) NOT NULL auto_increment,
  `title` longtext NOT NULL,
  `comment` longtext NOT NULL,
  `amount` longtext NOT NULL,
  `type` longtext NOT NULL,
  `date` longtext NOT NULL,
  PRIMARY KEY  (`transaction_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `title`, `comment`, `amount`, `type`, `date`) VALUES
(1, 'a', 'aa', '500000', 'expense', '2014-05-09'),
(2, 's', 's', '100000', 'income', '2014-05-09'),
(3, 's', 'we', '1000000', 'income', '2014-06-27');
