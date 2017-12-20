-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 15, 2017 at 04:13 PM
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

CREATE USER 'test'@'localhost' IDENTIFIED BY 'test123';
GRANT ALL PRIVILEGES ON film_night. * TO 'test'@'localhost' IDENTIFIED BY 'test123';
-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
`event_id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `location_id` int(11) NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `event_length` time NOT NULL,
  `film_id` int(11) NOT NULL,
  `ticket_number` int(11) NOT NULL,
  `hostuser_id` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_id`, `event_name`, `type`, `location_id`, `event_date`, `event_time`, `event_length`, `film_id`, `ticket_number`, `hostuser_id`, `price`) VALUES
(1, 'Nachos and Horror Night', 'Open', 4, '2017-12-04', '17:30:00', '04:00:00', 1, 2, 2, 10),
(2, 'Fun times with a nice animated film!', 'Student', 3, '2017-11-01', '20:00:00', '02:30:00', 2, 2, 1, 15),
(3, 'Scary things and popcorn!', 'Student', 2, '2017-10-21', '14:45:00', '01:45:00', 3, 2, 3, 20),
(4, 'Greek night!', 'Alumni', 1, '2017-12-14', '18:00:00', '02:30:00', 4, 2, 4, 8),
(6, 'Dream horror 5', 'Student', 1, '2017-12-17', '17:30:00', '02:10:00', 2, 10, 2, 5),
(7, 'Toys night', 'Open', 1, '2017-12-21', '12:30:00', '02:30:00', 2, 5, 4, 7),
(11, 'Year of 2015 official meeting!', 'Alumni', 3, '2017-11-21', '18:30:00', '04:00:00', 7, 30, 7, 10),
(12, 'Cheerios and lord of the rings party!', 'Open', 4, '2017-11-03', '14:30:00', '03:00:00', 6, 25, 6, 20),
(14, 'Annual Management Science student movie night', 'Student', 1, '2017-11-29', '20:00:00', '03:30:00', 5, 60, 5, 15),
(15, 'Horror and nachos!', 'Open', 3, '2018-01-23', '16:30:00', '04:00:00', 3, 1, 4, 5),
(16, 'Greek food and talks!', 'Student', 4, '2018-01-19', '14:45:00', '03:00:00', 4, 40, 7, 10),
(17, 'Weekly film club', 'Open', 2, '2017-12-17', '18:30:00', '02:00:00', 1, 25, 7, 4),
(18, 'Sports night pre movies!', 'Student', 4, '2017-12-21', '17:00:00', '01:30:00', 7, 50, 6, 10);

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
(3, 11, '5', 'I hated the location and the host was rude!'),
(1, 1, '7', 'The sound system was very bad.'),
(7, 3, '3', 'Food was awful'),
(7, 4, '2', 'People were nice'),
(7, 2, '2', 'Fantastic venue'),
(7, 11, '3', 'I had a lot of fun, great event!');

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
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`film_id`, `length`, `imdb_rating`, `description`, `title`, `genre_id`) VALUES
(1, 121, 6.4, 'War between Germany and France.', 'The Great War 2', 3),
(2, 68, 7.5, 'Toys break out to explore the outside world.', 'Toys 2', 2),
(3, 89, 7.9, 'Zombies attack Texas.', 'Horror in Texas 3', 4),
(4, 147, 9.4, 'A quick tour around the ancient Greece.', 'Ancient Greece', 5),
(5, 120, 8, 'Moving story of a prisoner on deathrow!', 'Deathrow', 2),
(6, 320, 8, 'The famous story of the ring and the hobbits', 'Lord of the rings - Dir. cut', 6),
(7, 90, 6, 'The ultimate chase for the holy grail', 'Indiana Jane', 5);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE IF NOT EXISTS `genre` (
`genre_id` int(11) NOT NULL,
  `genre` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`genre_id`, `genre`) VALUES
(1, 'Animation'),
(2, 'Drama'),
(3, 'Documentary'),
(4, 'Horror'),
(5, 'Action'),
(6, 'Adventure');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
`location_id` int(11) NOT NULL,
  `location_name` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `location_name`) VALUES
(1, 'Grand Hall'),
(2, 'Medical Sciences Student Screening Room'),
(3, 'UCL Screening Room'),
(4, 'Birckbeck Open Space');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
`reservation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `purchase_date` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservation_id`, `user_id`, `event_id`, `purchase_date`) VALUES
(4, 4, 11, '2017-11-11'),
(5, 3, 11, '2017-11-09'),
(22, 3, 16, '2017-12-12'),
(35, 5, 16, '2017-12-13'),
(41, 7, 4, '2017-12-13'),
(45, 6, 15, '2017-12-15'),
(46, 5, 18, '2017-12-06'),
(48, 7, 15, '2017-12-15'),
(50, 7, 6, '2017-12-15'),
(51, 7, 7, '2017-12-15');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `first_name`, `last_name`) VALUES
(1, 'davidsmith@gmail.com', '$2y$10$.bnXMr7pdmNthwouANnsFe7edv9L72DEnmVMXtN/C/AIcPOqSTNxi', 'd.smith@gmail.com', 'David', 'Smith'),
(2, 'r.west', '$2y$10$AWrCfxGMUhM8F1YQHwcKWOMFvZihWAEq5Qm2.ZQ9jUkY.zl.ZLzh2', 'rwest@tmobile.com', 'Rhiannon', 'Westbourne'),
(3, 'johnsnow', '$2y$10$vLgHfvaP9LYSZwSiUmWiZOI3BwSnjyhKCw5CzjFSOVGsguIIgEsw2', 'jsnow@gmail.com', 'John', 'Snow'),
(4, 'sgrey', '$2y$10$L2dAcHmHgrXRPUODjZMKduP.pZPE2u4ggHF7Oy2BPYhx/4jIz4cjK', 'sgrey@hotmail.com', 'Susan ', 'Grey'),
(5, 'cyeng', '$2y$10$6MLiXz5hJsQT5qfFfSLLqeW8ZrdP.XDSpJNUFVtWkweomwjNkujIq', 'christinayeng@gmail.com', 'Christina', 'Yeng'),
(6, 'jonas', '$2y$10$sx0xuu/yhIoSKtyCZopX0u7hvo3se6M0TrOKlUGr2W6pr7vJiUoee', 'petersonnj@me.com', 'Jonas', 'Petersonn'),
(7, 'boribet', '$2y$10$ybZrcQD4SsDtNbi0.DgxhO04BjW2JVVNAmQWSYhrkQx61FuPu41z6', 'boribetlen@gmail.com', 'Bori', 'Betlen');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `genre`
--
ALTER TABLE `genre`
 ADD PRIMARY KEY (`genre_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
 ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
 ADD PRIMARY KEY (`reservation_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `film`
--
ALTER TABLE `film`
MODIFY `film_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
