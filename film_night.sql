-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 01, 2017 at 11:31 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `film_night`
--

CREATE DATABASE film_night;
USE film_night;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
`category_id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category`) VALUES
(1, 'Animation'),
(2, 'Drama'),
(3, 'Documentary'),
(4, 'Horror'),
(5, 'Action'),
(6, 'Adventure');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
`event_id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `type_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `event_time` datetime NOT NULL,
  `event_length` time NOT NULL,
  `film_id` int(11) NOT NULL,
  `ticket_number` int(11) NOT NULL,
  `hostuser_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_id`, `event_name`, `type_id`, `location_id`, `event_time`, `event_length`, `film_id`, `ticket_number`, `hostuser_id`) VALUES
(1, 'Nachos and Horror Night', 3, 4, '2017-11-01 17:30:00', '04:00:00', 1, 2, 2),
(2, 'Fun times with a nice animated film!', 2, 3, '2017-11-01 03:30:00', '02:30:00', 2, 2, 1),
(3, 'Scary things and popcorn!', 1, 2, '2017-10-21 14:45:00', '01:45:00', 3, 2, 3),
(4, 'Greek night!', 1, 1, '2017-11-01 17:30:00', '02:30:00', 4, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `rating` varchar(10) NOT NULL,
  `notes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`user_id`, `event_id`, `rating`, `notes`) VALUES
(1, 1, '5', 'The food was amazing!'),
(3, 2, '5', 'I hated the location and the host was rude!'),
(1, 1, '7', 'The sound system was very bad.');

-- --------------------------------------------------------

--
-- Table structure for table `film`
--

CREATE TABLE IF NOT EXISTS `film` (
`film_id` int(11) NOT NULL,
  `length` int(11) NOT NULL,
  `imdb_rating` float NOT NULL,
  `description` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`film_id`, `length`, `imdb_rating`, `description`, `title`, `category_id`) VALUES
(1, 121, 6.4, 'War between Germany and France.', 'The Great War 2', 3),
(2, 68, 7.5, 'Toys break out to explore the outside world.', 'Toys 2', 2),
(3, 89, 7.9, 'Zombies attack Texas.', 'Horror in Texas 3', 4),
(4, 147, 9.4, 'A quick tour around the ancient Greece.', 'Ancient Greece', 5);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
`location_id` int(11) NOT NULL,
  `location_name` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `location_name`, `capacity`) VALUES
(1, 'Grand Hall', 2),
(2, 'Medical Sciences Student Screening Room', 2),
(3, 'UCL Screening Room', 2),
(4, 'Birckbeck Open Space', 4);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `purchase_date` date NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`user_id`, `event_id`, `purchase_date`, `price`) VALUES
(1, 2, '0000-00-00', 0),
(4, 2, '0000-00-00', 0),
(2, 3, '0000-00-00', 0),
(4, 3, '0000-00-00', 0),
(3, 4, '0000-00-00', 0),
(1, 4, '0000-00-00', 0),
(4, 1, '0000-00-00', 0),
(2, 1, '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
`type_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`type_id`, `name`) VALUES
(1, 'Student'),
(2, 'Non Student'),
(3, 'Open');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`user_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `first_name`, `last_name`) VALUES
(1, 'denis', 'd45', 'denis@gmail.com', 'Denis', 'Suarez'),
(2, 'joe', 'j35', 'joe@gmail.com', 'Joe', 'Keane'),
(3, 'barb', 'barbara33', 'barb@gmail.com', 'Barbara', 'Smith'),
(4, 'suzz', 'asdfasd', 'suzy@gmail.com', 'Suzanne', 'Stark');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
 ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `film`
--
ALTER TABLE `film`
 ADD PRIMARY KEY (`film_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
 ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
 ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `film`
--
ALTER TABLE `film`
MODIFY `film_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
