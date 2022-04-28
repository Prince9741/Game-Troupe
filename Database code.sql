-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql309.epizy.com
-- Generation Time: Apr 28, 2022 at 06:58 PM
-- Server version: 10.3.27-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_31586640_gameTroupe`
--

-- --------------------------------------------------------

--
-- Table structure for table `Game`
--

CREATE TABLE `Game` (
  `GameId` int(11) NOT NULL,
  `GameName` varchar(30) NOT NULL,
  `ScoreType` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Game Details';

--
-- Dumping data for table `Game`
--

INSERT INTO `Game` (`GameId`, `GameName`, `ScoreType`) VALUES
(1, 'Ballon Poper', 1),
(2, 'Space Adventure', 1),
(3, 'Diamond Puzzle', 0),
(4, 'Dog Runner', 1),
(5, 'Mario', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Gender`
--

CREATE TABLE `Gender` (
  `GenderId` int(1) NOT NULL,
  `GenderType` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Person Gender details';

--
-- Dumping data for table `Gender`
--

INSERT INTO `Gender` (`GenderId`, `GenderType`) VALUES
(0, 'M'),
(1, 'F'),
(2, 'O');

-- --------------------------------------------------------

--
-- Table structure for table `HighScore`
--

CREATE TABLE `HighScore` (
  `ScoreId` int(11) NOT NULL,
  `Score` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `GameId` int(11) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='All Game High Scored Stored here';

--
-- Dumping data for table `HighScore`
--

INSERT INTO `HighScore` (`ScoreId`, `Score`, `UserId`, `GameId`, `Date`) VALUES
(9, 7, 1, 2, '2022-04-27 05:41:05'),
(10, 17, 1, 1, '2022-04-27 05:41:52'),
(11, 46, 6, 1, '2022-04-27 06:06:50'),
(12, 6, 6, 3, '2022-04-27 06:07:46'),
(13, 62, 1, 1, '2022-04-27 17:17:34'),
(14, 21, 1, 2, '2022-04-27 17:18:06'),
(15, 59, 1, 2, '2022-04-27 17:21:37'),
(16, 28, 1, 3, '2022-04-28 05:00:34'),
(17, 18, 1, 3, '2022-04-28 05:01:11'),
(18, 6, 1, 3, '2022-04-28 05:01:21'),
(19, 4, 10, 1, '2022-04-28 16:55:56'),
(20, 9, 1, 4, '2022-04-28 21:47:33'),
(21, 1, 1, 4, '2022-04-28 21:48:36'),
(22, 7, 1, 4, '2022-04-28 21:49:16'),
(23, 10, 1, 4, '2022-04-28 21:51:57');

-- --------------------------------------------------------

--
-- Table structure for table `Players`
--

CREATE TABLE `Players` (
  `UserId` int(11) NOT NULL,
  `UserName` varchar(20) NOT NULL,
  `GenderId` int(11) NOT NULL,
  `Password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Players Data stored or login information';

--
-- Dumping data for table `Players`
--

INSERT INTO `Players` (`UserId`, `UserName`, `GenderId`, `Password`) VALUES
(1, 'Prashant', 0, 'a'),
(3, 'Sattan', 0, 'a'),
(4, 'Sakshi', 1, '123'),
(5, 'Kanisth', 0, '9568'),
(6, 'Gitanjali', 1, '1234'),
(7, 'Manish Kumar', 0, 'Mk@123'),
(8, 'Saurabh', 1, '12345678'),
(9, 'epiz_31586640', 0, ''),
(10, 'Simran Bhardwaj', 1, '@simran123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Game`
--
ALTER TABLE `Game`
  ADD PRIMARY KEY (`GameId`),
  ADD UNIQUE KEY `GameInformation` (`GameName`);

--
-- Indexes for table `Gender`
--
ALTER TABLE `Gender`
  ADD PRIMARY KEY (`GenderId`);

--
-- Indexes for table `HighScore`
--
ALTER TABLE `HighScore`
  ADD PRIMARY KEY (`ScoreId`),
  ADD KEY `GameId` (`GameId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `Players`
--
ALTER TABLE `Players`
  ADD PRIMARY KEY (`UserId`),
  ADD UNIQUE KEY `UserName` (`UserName`),
  ADD KEY `GenderId` (`GenderId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Game`
--
ALTER TABLE `Game`
  MODIFY `GameId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `HighScore`
--
ALTER TABLE `HighScore`
  MODIFY `ScoreId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `Players`
--
ALTER TABLE `Players`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `HighScore`
--
ALTER TABLE `HighScore`
  ADD CONSTRAINT `GameDetail` FOREIGN KEY (`GameId`) REFERENCES `Game` (`GameId`),
  ADD CONSTRAINT `UserDetail` FOREIGN KEY (`UserId`) REFERENCES `Players` (`UserId`);

--
-- Constraints for table `Players`
--
ALTER TABLE `Players`
  ADD CONSTRAINT `GenderInformation` FOREIGN KEY (`GenderId`) REFERENCES `Gender` (`GenderId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
