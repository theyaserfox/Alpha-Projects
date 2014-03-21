-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 11, 2013 at 07:35 PM
-- Server version: 5.5.31
-- PHP Version: 5.4.6-1ubuntu1.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `timetable`
--
CREATE DATABASE `timetable` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `timetable`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `second_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `hashed_password` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `age` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`Id`, `first_name`, `second_name`, `username`, `hashed_password`, `description`, `age`) VALUES
(1, 'admin', 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 18);

-- --------------------------------------------------------

--
-- Table structure for table `course_class`
--

CREATE TABLE IF NOT EXISTS `course_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  `course_id` int(11) NOT NULL,
  `professor_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `student_group_id` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `lab` tinyint(1) NOT NULL,
  `time` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `course_class`
--

INSERT INTO `course_class` (`id`, `name`, `course_id`, `professor_id`, `room_id`, `student_group_id`, `duration`, `lab`, `time`, `day`) VALUES
(1, 'S10 - Section', 1, 1, 1, 0, 2, 0, 9, 5),
(2, '1O1 - Lecture', 1, 1, 1, 0, 2, 0, 8, 1),
(3, 'S10 - Lecture', 1, 9, 1, 0, 3, 1, 10, 4),
(4, '1O1 - Section', 1, 9, 1, 0, 3, 1, 9, 5),
(5, 'P4S - Lecture', 1, 9, 1, 0, 3, 1, 5, 2),
(6, 'P4S - Section', 1, 9, 2, 0, 3, 1, 3, 4),
(7, 'S3S - Lecture', 2, 2, 1, 0, 2, 0, 9, 3),
(8, 'S3S - Section', 2, 2, 1, 0, 2, 0, 8, 3),
(9, '3DS - Lecture', 2, 3, 1, 0, 2, 1, 10, 2),
(10, '3DS - Section', 2, 3, 1, 0, 2, 1, 8, 3),
(11, 'GD4 - Lecture', 2, 3, 2, 0, 2, 1, 10, 1),
(12, 'GD4 - Section', 2, 3, 2, 0, 2, 1, 3, 5),
(13, 'JG3 - Lecture', 4, 4, 2, 0, 2, 0, 5, 2),
(14, 'JG3 - Section', 4, 4, 2, 0, 2, 0, 11, 2),
(15, 'GS4 - Lecture', 4, 4, 1, 0, 2, 0, 3, 2),
(16, 'GS4 - Lecture', 4, 4, 2, 0, 2, 0, 6, 4),
(17, 'SDH - Lecture', 6, 5, 2, 0, 2, 0, 7, 1),
(18, 'SDH - Section', 6, 5, 2, 0, 2, 0, 7, 2),
(19, 'KJG - Lecture', 5, 7, 1, 0, 2, 0, 6, 5),
(20, 'KJG - Section', 5, 7, 2, 0, 2, 0, 9, 5),
(21, 'JFG - Lecture', 5, 10, 1, 0, 2, 0, 8, 5),
(22, 'JFG - Section', 3, 8, 2, 0, 2, 0, 5, 3),
(23, 'IUY - Lecture', 3, 8, 1, 0, 2, 0, 8, 2),
(24, 'IUY - Section', 3, 12, 1, 0, 2, 0, 6, 3),
(25, 'HFH - Lecture', 3, 12, 1, 0, 2, 0, 2, 1),
(26, 'HFH - Section', 7, 11, 2, 0, 2, 0, 1, 2),
(27, 'OPO - Lecture', 8, 13, 1, 0, 2, 0, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`ID`, `name`, `description`) VALUES
(1, 'Introduction to Programming', 'test'),
(2, 'Introduction to Computer Architecture', 'test'),
(3, 'Business Applications', ''),
(4, 'English', ''),
(5, 'Discrete Mathematic I', ''),
(6, 'Linear Algebra', ''),
(7, 'Introduction to Information Technology I', ''),
(8, 'System Administration and Maintenance I', '');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `day` varchar(20) NOT NULL,
  `content` text NOT NULL,
  `desc` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `author`, `title`, `content`) VALUES
(1, 'dsfhsid', 'sdfhgdsjf', 'sdfdsf'),
(2, 'test_author', 'test_title', 'test_content');

-- --------------------------------------------------------

--
-- Table structure for table `present_table`
--

CREATE TABLE IF NOT EXISTS `present_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `saturday` varchar(70) NOT NULL,
  `monday` varchar(70) NOT NULL,
  `tuesday` varchar(70) NOT NULL,
  `wednesday` varchar(70) NOT NULL,
  `thursday` varchar(70) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `present_table`
--

INSERT INTO `present_table` (`id`, `saturday`, `monday`, `tuesday`, `wednesday`, `thursday`) VALUES
(1, '2', '1', '1', '1', '1'),
(2, '1', '1', '12', '1', '1'),
(3, '1', '1', '1', '1', '1'),
(4, '1', '1', '1', '1', '1'),
(5, '1', '1', '1', '1', '1'),
(6, '1', '1', '1', '1', '1'),
(7, '1', '1', '1', '1', '1'),
(8, '1', '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `professor`
--

CREATE TABLE IF NOT EXISTS `professor` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `second_name` varchar(50) NOT NULL,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `hashed_password` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `age` int(11) NOT NULL,
  `phone_number` int(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `professor`
--

INSERT INTO `professor` (`ID`, `first_name`, `second_name`, `username`, `hashed_password`, `description`, `age`, `phone_number`, `address`) VALUES
(1, 'Victor', 'Valdes', '', '', '', 0, 0, ''),
(2, 'Red', '', '', '', '', 0, 0, ''),
(3, 'Philip', '', '', '', '', 0, 0, ''),
(4, 'Marry', '', '', '', '', 0, 0, ''),
(5, 'Don', '', '', '', '', 0, 0, ''),
(6, 'Mark', '', '', '', '', 0, 0, ''),
(7, 'Peter', '', '', '', '', 0, 0, ''),
(8, 'John', '', '', '', '', 0, 0, ''),
(9, 'Ben', '', '', '', '', 0, 0, ''),
(10, 'Mike', '', '', '', '', 0, 0, ''),
(11, 'Steve', '', '', '', '', 0, 0, ''),
(12, 'Ann', '', '', '', '', 0, 0, ''),
(13, 'Alex', '', '', '', '', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `no_seats` int(11) NOT NULL,
  `isLab` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `no_seats`, `isLab`) VALUES
(1, 'R3', 24, 1),
(2, 'R7', 60, 0);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE IF NOT EXISTS `schedule` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `day` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `student_group`
--

CREATE TABLE IF NOT EXISTS `student_group` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `size` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `name` varchar(70) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `student_group`
--

INSERT INTO `student_group` (`ID`, `size`, `level`, `name`) VALUES
(1, 19, 0, '1O1'),
(2, 19, 0, '1O2'),
(3, 21, 0, '1O3'),
(4, 19, 0, '1S1');

-- --------------------------------------------------------

--
-- Table structure for table `student_groups`
--

CREATE TABLE IF NOT EXISTS `student_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `student_group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `student_groups`
--

INSERT INTO `student_groups` (`id`, `class_id`, `student_group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3),
(4, 2, 4),
(5, 3, 1),
(6, 4, 2),
(7, 5, 3),
(8, 6, 4),
(9, 7, 3),
(10, 7, 4),
(11, 8, 1),
(12, 8, 2),
(13, 9, 1),
(14, 10, 2),
(15, 11, 3),
(16, 12, 4),
(17, 13, 3),
(18, 13, 4),
(19, 14, 3),
(20, 14, 4),
(21, 15, 1),
(22, 15, 2),
(23, 16, 1),
(24, 16, 2),
(25, 16, 3),
(26, 17, 1),
(27, 17, 2),
(28, 17, 3),
(29, 18, 1),
(30, 18, 2),
(31, 19, 3),
(32, 20, 2),
(33, 21, 3),
(34, 22, 1),
(35, 23, 4),
(36, 24, 4),
(37, 25, 4);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Student_Group_ID` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `second_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `hashed_password` varchar(50) NOT NULL,
  `grades` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`ID`, `Student_Group_ID`, `first_name`, `second_name`, `username`, `hashed_password`, `grades`, `age`, `description`) VALUES
(1, 1, 'Yaser', 'Omar ', 'test', '098f6bcd4621d373cade4e832627b4f6', 2, 20, 'hello'),
(2, 3, 'Yaser', 'Omar', 'test', '098f6bcd4621d373cade4e832627b4f6', 3, 20, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `hashed_password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `hashed_password`) VALUES
(1, 'kiro', '875dfa90426236a8d3c57bfa35f685af'),
(2, 'Draspy ', '81dc9bdb52d04dc20036dbd8313ed055');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
