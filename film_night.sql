-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 23, 2017 at 09:55 PM
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
`event_id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `location_id` int(11) NOT NULL,
  `event_time` datetime NOT NULL,
  `event_length` time NOT NULL,
  `film_id` int(11) NOT NULL,
  `ticket_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `event_host`
--

CREATE TABLE IF NOT EXISTS `event_host` (
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `film`
--

CREATE TABLE IF NOT EXISTS `film` (
`film_id` int(11) NOT NULL,
  `length` int(11) NOT NULL,
  `imdb_rating` float NOT NULL,
  `description` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `film_category`
--

CREATE TABLE IF NOT EXISTS `film_category` (
  `film_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
`location_id` int(11) NOT NULL,
  `location_name` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE IF NOT EXISTS `ticket` (
`ticket_id` int(11) NOT NULL,
  `purchase` date NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
-- --------------------------------------------------------

--
-- Table structure for table `event_type`
--

CREATE TABLE IF NOT EXISTS `event_type` (
  `event_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
`type_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


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
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
 ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`user_id`);
 --
-- Indexes for table `type`
--
ALTER TABLE `type`
 ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT for dumped tables

---- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `film`
--
ALTER TABLE `film`
MODIFY `film_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



INSERT INTO user (username, password, email, first_name, last_name)
VALUES ('denis', 'd45', 'denis@gmail.com', 'Denis', 'Suarez');
INSERT INTO user (username, password, email, first_name, last_name)
VALUES ('joe', 'j35', 'joe@gmail.com', 'Joe', 'Keane');
INSERT INTO user (username, password, email, first_name, last_name)
VALUES ('barb', 'barbara33', 'barb@gmail.com', 'Barbara', 'Smith');
INSERT INTO user (username, password, email, first_name, last_name)
VALUES ('suzz', 'asdfasd', 'suzy@gmail.com', 'Suzanne', 'Stark');

INSERT INTO category (category)
VALUES ('Animation');
INSERT INTO category (category)
VALUES ('Drama');
INSERT INTO category (category)
VALUES ('Documentary');
INSERT INTO category (category)
VALUES ('Horror');
INSERT INTO category (category)
VALUES ('Action');
INSERT INTO category (category)
VALUES ('Adventure');

INSERT INTO film_category
VALUES('1','5');
INSERT INTO film_category
VALUES('2','1');
INSERT INTO film_category
VALUES('3','4');
INSERT INTO film_category
VALUES('4','3');

INSERT INTO film (film_id, length, imdb_rating, description, title)
VALUES (NULL, '121', '6.4', 'War between Germany and France.', 'The Great War 2');
INSERT INTO film (film_id, length, imdb_rating, description, title)
VALUES (NULL, '68', '7.5', 'Toys break out to explore the outside world.', 'Toys 2');
INSERT INTO film (film_id, length, imdb_rating, description, title)
VALUES (NULL, '89', '7.9', 'Zombies attack Texas.', 'Horror in Texas 3');
INSERT INTO film (film_id, length, imdb_rating, description, title)
VALUES (NULL, '147', '9.4', 'A quick tour around the ancient Greece.', 'Ancient Greece');

INSERT INTO event(event_name, location_id, event_time, event_length, film_id, ticket_number)
VALUES('Nachos and Horror Night', '4', '2017-11-01 17:30:00','04:00:00', '1', '2');
INSERT INTO event(event_name, location_id, event_time, event_length, film_id, ticket_number)
VALUES('Fun times with a nice animated film!', '3', '2017-11-01 03:30:00','02:30:00', '2', '2');
INSERT INTO event(event_name, location_id, event_time, event_length, film_id, ticket_number)
VALUES('Scary things and popcorn!', '2', '2017-10-21 14:45:00','01:45:00', '3', '2');
INSERT INTO event(event_name, location_id, event_time, event_length, film_id, ticket_number)
VALUES('Greek night!', '1', '2017-11-01 17:30:00','02:30:00','4', '2');

INSERT INTO event_host
VALUES('1','4');
INSERT INTO event_host
VALUES('2','3');
INSERT INTO event_host
VALUES('3','2');
INSERT INTO event_host
VALUES('4','1');

#so far location capaity is restricted to 2
INSERT INTO location(location_name, capacity)
VALUES('Grand Hall', '2');
INSERT INTO location(location_name, capacity)
VALUES('Medical Sciences Student Screening Room', '2');
INSERT INTO location(location_name, capacity)
VALUES('UCL Screening Room', '2');
INSERT INTO location(location_name, capacity)
VALUES('Birckbeck Open Space','‘2');

INSERT INTO feedback(user_id, event_id, rating, notes)
VALUES('1', '1', '5', 'The food was amazing!');
INSERT INTO feedback(user_id, event_id, rating, notes)
VALUES('3', '2', '5', 'I hated the location and the host was rude!');

INSERT INTO ticket(purchase, price)
VALUES('2017-10-22 00:00:00', '5');
INSERT INTO ticket(purchase, price)
VALUES('2017-10-23 20:30:00', '5');
INSERT INTO ticket(purchase, price)
VALUES('2017-10-22 10:34:50', '8');
INSERT INTO ticket(purchase, price)
VALUES('2017-10-21 19:08:09', '8');
INSERT INTO ticket(purchase, price)
VALUES('2017-10-20 16:48:60', '3');
INSERT INTO ticket(purchase, price)
VALUES('2017-10-20 12:17:40', '3');
INSERT INTO ticket(purchase, price)
VALUES('2017-10-19 17:00:50', '4');
INSERT INTO ticket(purchase, price)
VALUES('2017-10-22 11:50:40', '4');



INSERT INTO reservation
VALUES ('1', '2', '1');
INSERT INTO reservation
VALUES ('4', '2', '2');
INSERT INTO reservation
VALUES ('2', '3', '3');
INSERT INTO reservation
VALUES ('4', '3', '4');
INSERT INTO reservation
VALUES ('3', '4', '5');
INSERT INTO reservation
VALUES ('1', '4', '6');
INSERT INTO reservation
VALUES ('4', '1', '7');
INSERT INTO reservation
VALUES ('2', '1', '8');

INSERT INTO type(name)
VALUES('Student');
INSERT INTO type(name)
VALUES('Alumni');
INSERT INTO type(name)
VALUES('Under 18');
INSERT INTO type(name)
VALUES('Over 18');

INSERT INTO event_type(event_id, type_id)
VALUES('1','1');
INSERT INTO event_type(event_id, type_id)
VALUES('2','2');
INSERT INTO event_type(event_id, type_id)
VALUES('3','4');
INSERT INTO event_type(event_id, type_id)
VALUES('4','3');


