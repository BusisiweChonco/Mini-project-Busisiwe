-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2017 at 06:22 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fms`
--

-- --------------------------------------------------------

--
-- Table structure for table `competitions`
--

CREATE TABLE `competitions` (
  `comp_id` int(11) NOT NULL,
  `comp_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `competitions`
--

INSERT INTO `competitions` (`comp_id`, `comp_name`) VALUES
(11, 'Akhumzi Comp 3'),
(12, 'A'),
(13, 'B'),
(14, 'C');

-- --------------------------------------------------------

--
-- Table structure for table `fixtures`
--

CREATE TABLE `fixtures` (
  `fixture_id` int(11) NOT NULL,
  `fixture_date` date NOT NULL,
  `fixture_time` time NOT NULL,
  `home_teamID` int(11) NOT NULL,
  `away_teamID` int(11) NOT NULL,
  `comp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fixtures`
--

INSERT INTO `fixtures` (`fixture_id`, `fixture_date`, `fixture_time`, `home_teamID`, `away_teamID`, `comp_id`) VALUES
(1, '2017-10-15', '02:07:10', 8, 9, 12),
(2, '0000-00-00', '00:00:00', 8, 8, 11),
(3, '0000-00-00', '00:00:00', 12, 9, 12),
(4, '0000-00-00', '00:00:00', 16, 13, 14),
(5, '2017-12-07', '12:57:00', 13, 21, 13),
(6, '2017-12-07', '12:57:00', 13, 21, 13),
(11, '0000-00-00', '00:00:00', 20, 21, 11),
(12, '0000-00-00', '00:00:00', 20, 21, 11),
(13, '0000-00-00', '00:00:00', 20, 21, 11),
(14, '2017-10-04', '12:00:00', 8, 9, 11),
(15, '0000-00-00', '00:00:00', 8, 13, 13),
(16, '0000-00-00', '00:00:00', 8, 13, 13);

-- --------------------------------------------------------

--
-- Table structure for table `playerfixture`
--

CREATE TABLE `playerfixture` (
  `fixture_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `goals_scored` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `playerposition`
--

CREATE TABLE `playerposition` (
  `position_id` int(11) NOT NULL,
  `position_descr` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `playerposition`
--

INSERT INTO `playerposition` (`position_id`, `position_descr`) VALUES
(1, 'SW'),
(2, 'LWB'),
(3, 'WF'),
(4, 'LB'),
(5, 'CB'),
(6, 'CF'),
(7, 'FB'),
(8, 'RW'),
(9, 'LW'),
(10, 'RWB'),
(11, 'CM'),
(12, 'GK'),
(13, 'DM'),
(14, 'AM');

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `player_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `player_name` varchar(255) NOT NULL,
  `player_sqd_num` int(11) NOT NULL,
  `position_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`player_id`, `team_id`, `player_name`, `player_sqd_num`, `position_id`) VALUES
(3, 8, 'ghgfhgh', 11, 1),
(4, 8, 'ghgfhgh', 11, 1),
(5, 8, 'ghgfhgh', 11, 1),
(6, 8, 'ghgfhgh', 11, 1),
(7, 8, 'ghgfhgh', 11, 1),
(8, 8, 'ghgfhgh', 11, 1),
(9, 13, 'njghjghkjghchj,h', 111, 3),
(10, 13, 'njghjghkjghchj,h', 111, 3),
(11, 13, 'njghjghkjghchj,h', 111, 3),
(12, 8, 'fgfgdgdfdfggfcfcfc', 111, 13),
(13, 8, 'fgfgdgdfdfggfcfcfc', 111, 13),
(14, 8, 'tdrdrdrddrrd', 1111, 14),
(15, 8, 'tdrdrdrddrrd', 1111, 14),
(16, 8, 'rderdrdrfd', 111, 3),
(17, 8, 'vbhcgfcgcgcg', 0, 6),
(18, 8, 'jjjj', 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `team_id` int(11) NOT NULL,
  `team_name` varchar(255) NOT NULL,
  `team_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`team_id`, `team_name`, `team_email`) VALUES
(8, 'B', 'BB@gmail.com'),
(9, 'C', 'CC@gmail.com'),
(12, 'D', 'DD@gmail.com'),
(13, 'E', 'EE@gmail.com'),
(15, 'F', 'FF@gmail.com'),
(16, 'G', 'GG@gmail.com'),
(20, 'GG', 'GG@gmail.com'),
(21, 'H', 'HG@gmail.com'),
(22, 'H', 'HG@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `competitions`
--
ALTER TABLE `competitions`
  ADD PRIMARY KEY (`comp_id`);

--
-- Indexes for table `fixtures`
--
ALTER TABLE `fixtures`
  ADD PRIMARY KEY (`fixture_id`),
  ADD KEY `comp_id` (`comp_id`),
  ADD KEY `away_teamID` (`away_teamID`),
  ADD KEY `home_teamID` (`home_teamID`);

--
-- Indexes for table `playerfixture`
--
ALTER TABLE `playerfixture`
  ADD KEY `fixture_id` (`fixture_id`),
  ADD KEY `player_id` (`player_id`);

--
-- Indexes for table `playerposition`
--
ALTER TABLE `playerposition`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`player_id`),
  ADD KEY `team_id` (`team_id`),
  ADD KEY `position_id` (`position_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`team_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `competitions`
--
ALTER TABLE `competitions`
  MODIFY `comp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `fixtures`
--
ALTER TABLE `fixtures`
  MODIFY `fixture_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `player_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `fixtures`
--
ALTER TABLE `fixtures`
  ADD CONSTRAINT `fixtures_ibfk_1` FOREIGN KEY (`comp_id`) REFERENCES `competitions` (`comp_id`),
  ADD CONSTRAINT `fixtures_ibfk_2` FOREIGN KEY (`away_teamID`) REFERENCES `teams` (`team_id`),
  ADD CONSTRAINT `fixtures_ibfk_3` FOREIGN KEY (`home_teamID`) REFERENCES `teams` (`team_id`);

--
-- Constraints for table `playerfixture`
--
ALTER TABLE `playerfixture`
  ADD CONSTRAINT `playerfixture_ibfk_1` FOREIGN KEY (`fixture_id`) REFERENCES `fixtures` (`fixture_id`),
  ADD CONSTRAINT `playerfixture_ibfk_2` FOREIGN KEY (`player_id`) REFERENCES `players` (`player_id`);

--
-- Constraints for table `players`
--
ALTER TABLE `players`
  ADD CONSTRAINT `players_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `teams` (`team_id`),
  ADD CONSTRAINT `players_ibfk_2` FOREIGN KEY (`position_id`) REFERENCES `playerposition` (`position_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
