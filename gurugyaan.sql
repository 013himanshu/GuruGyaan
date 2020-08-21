-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2018 at 08:52 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gurugyaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `a_id` int(50) unsigned NOT NULL,
  `q_id` int(50) unsigned DEFAULT NULL,
  `answer_by` varchar(10) DEFAULT NULL,
  `answer` varchar(1000) DEFAULT NULL,
  `add_date` varchar(10) DEFAULT NULL,
  `add_time` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `a_likes`
--

CREATE TABLE IF NOT EXISTS `a_likes` (
  `ans_id` int(50) unsigned DEFAULT NULL,
  `stu_mbl` varchar(10) DEFAULT NULL,
  `likes` int(50) DEFAULT NULL,
  `dislikes` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `c_id` int(50) unsigned NOT NULL,
  `value` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`c_id`, `value`) VALUES
(1, 'Technology'),
(2, 'Fashion'),
(3, 'Literature');

-- --------------------------------------------------------

--
-- Table structure for table `expert`
--

CREATE TABLE IF NOT EXISTS `expert` (
  `fname` varchar(30) DEFAULT NULL,
  `lname` varchar(30) DEFAULT NULL,
  `mbl` varchar(10) NOT NULL DEFAULT '',
  `email` varchar(100) DEFAULT NULL,
  `psw` varchar(200) DEFAULT NULL,
  `add_date` varchar(10) DEFAULT NULL,
  `add_time` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expert`
--

INSERT INTO `expert` (`fname`, `lname`, `mbl`, `email`, `psw`, `add_date`, `add_time`) VALUES
('Rohan', 'Mehra', '8888888888', 'rohan@gmail.com', 'rohan', '2017-02-05', '01:16:51am'),
('Arun', 'Khanna', '9999999999', 'arun@gmail.com', 'hello', '2017-02-04', '03:20:39pm');

-- --------------------------------------------------------

--
-- Table structure for table `ques`
--

CREATE TABLE IF NOT EXISTS `ques` (
  `q_id` int(50) unsigned NOT NULL,
  `ask_by` varchar(10) DEFAULT NULL,
  `ques` varchar(500) DEFAULT NULL,
  `category` int(50) unsigned DEFAULT NULL,
  `add_date` varchar(10) DEFAULT NULL,
  `add_time` varchar(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ques`
--

INSERT INTO `ques` (`q_id`, `ask_by`, `ques`, `category`, `add_date`, `add_time`) VALUES
(2, '9983751677', 'What is the difference between android and ios?', 1, '2017-02-05', '01:11:50am'),
(3, '9983751677', 'Firebase or MySQL?', 1, '2017-02-05', '01:12:14am'),
(4, '9983751677', 'Which laptop to buy in 2017?', 1, '2017-02-05', '01:34:05am'),
(5, '9983751677', 'What is nano technology?', 1, '2017-02-05', '01:35:40am'),
(6, '9983751677', 'How to make?', 1, '2017-02-05', '01:35:54am');

-- --------------------------------------------------------

--
-- Table structure for table `q_likes`
--

CREATE TABLE IF NOT EXISTS `q_likes` (
  `ques_id` int(50) unsigned DEFAULT NULL,
  `exp_mbl` varchar(10) DEFAULT NULL,
  `likes` int(50) unsigned DEFAULT NULL,
  `dislikes` int(50) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `q_likes`
--

INSERT INTO `q_likes` (`ques_id`, `exp_mbl`, `likes`, `dislikes`) VALUES
(2, '9999999999', 1, 0),
(2, '8888888888', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `fname` varchar(30) DEFAULT NULL,
  `lname` varchar(30) DEFAULT NULL,
  `mbl` varchar(10) NOT NULL DEFAULT '',
  `email` varchar(100) DEFAULT NULL,
  `psw` varchar(200) DEFAULT NULL,
  `add_date` varchar(10) DEFAULT NULL,
  `add_time` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`fname`, `lname`, `mbl`, `email`, `psw`, `add_date`, `add_time`) VALUES
('Himanshu', 'Kumawat', '9983751677', '013himanshu@gmail.com', '013himanshu', '2017-02-04', '03:10:37pm'),
('Arun', 'Khanna', '9999999999', 'arun@gmail.com', 'arunkhanna', '2017-02-04', '03:19:56pm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`a_id`), ADD KEY `answer_by` (`answer_by`), ADD KEY `q_id` (`q_id`);

--
-- Indexes for table `a_likes`
--
ALTER TABLE `a_likes`
  ADD KEY `ans_id` (`ans_id`), ADD KEY `stu_mbl` (`stu_mbl`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `expert`
--
ALTER TABLE `expert`
  ADD PRIMARY KEY (`mbl`);

--
-- Indexes for table `ques`
--
ALTER TABLE `ques`
  ADD PRIMARY KEY (`q_id`), ADD KEY `ask_by` (`ask_by`), ADD KEY `category` (`category`);

--
-- Indexes for table `q_likes`
--
ALTER TABLE `q_likes`
  ADD KEY `ques_id` (`ques_id`), ADD KEY `exp_mbl` (`exp_mbl`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`mbl`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `a_id` int(50) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `c_id` int(50) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ques`
--
ALTER TABLE `ques`
  MODIFY `q_id` int(50) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`answer_by`) REFERENCES `expert` (`mbl`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`q_id`) REFERENCES `ques` (`q_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `a_likes`
--
ALTER TABLE `a_likes`
ADD CONSTRAINT `a_likes_ibfk_1` FOREIGN KEY (`ans_id`) REFERENCES `answers` (`a_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `a_likes_ibfk_2` FOREIGN KEY (`stu_mbl`) REFERENCES `student` (`mbl`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ques`
--
ALTER TABLE `ques`
ADD CONSTRAINT `ques_ibfk_1` FOREIGN KEY (`ask_by`) REFERENCES `student` (`mbl`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `ques_ibfk_2` FOREIGN KEY (`category`) REFERENCES `category` (`c_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `q_likes`
--
ALTER TABLE `q_likes`
ADD CONSTRAINT `q_likes_ibfk_1` FOREIGN KEY (`ques_id`) REFERENCES `ques` (`q_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `q_likes_ibfk_2` FOREIGN KEY (`exp_mbl`) REFERENCES `expert` (`mbl`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
