-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql309.epizy.com
-- Generation Time: Jun 13, 2022 at 06:57 AM
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
(5, 'Flappy Bird', 1);

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
(39, 75, 11, 1, '2022-04-29 09:58:50'),
(72, 224, 12, 4, '2022-05-03 09:12:10'),
(73, 64, 12, 2, '2022-05-03 09:19:03'),
(97, 6, 6, 3, '2022-05-04 17:59:04'),
(100, 21, 6, 5, '2022-05-04 18:02:58'),
(106, 48, 34, 2, '2022-05-05 09:17:46'),
(111, 181, 34, 4, '2022-05-05 09:33:26'),
(117, 214, 34, 4, '2022-05-05 12:29:41'),
(118, 164, 34, 4, '2022-05-05 12:34:41'),
(121, 45, 34, 2, '2022-05-05 12:52:52'),
(123, 21, 6, 5, '2022-05-05 14:12:05'),
(126, 37, 6, 5, '2022-05-05 14:16:34'),
(146, 23, 42, 5, '2022-05-09 10:40:00'),
(159, 144, 41, 4, '2022-05-12 12:48:53'),
(167, 18, 44, 5, '2022-05-20 05:23:16'),
(172, 104, 45, 4, '2022-05-20 05:32:33'),
(179, 21, 41, 5, '2022-05-21 06:14:21'),
(180, 56, 41, 1, '2022-05-21 06:15:16'),
(183, 10, 41, 3, '2022-05-24 11:41:19'),
(185, 6, 6, 3, '2022-05-24 14:57:20'),
(186, 6, 6, 3, '2022-05-24 14:59:14'),
(187, 77, 50, 1, '2022-05-25 05:13:53'),
(189, 60, 41, 1, '2022-05-27 05:52:28'),
(191, 70, 41, 1, '2022-05-27 05:56:59'),
(192, 56, 41, 2, '2022-05-27 06:00:39'),
(193, 66, 42, 1, '2022-05-31 05:37:45'),
(195, 80, 41, 1, '2022-06-05 05:20:22'),
(196, 16, 41, 3, '2022-06-05 05:21:03'),
(197, 30, 52, 2, '2022-06-05 05:21:59'),
(198, 6, 52, 3, '2022-06-05 05:25:47'),
(200, 38, 52, 2, '2022-06-07 13:28:44'),
(201, 59, 52, 2, '2022-06-09 06:33:36'),
(203, 47, 54, 4, '2022-06-12 14:25:01'),
(204, 20, 54, 5, '2022-06-12 14:27:38'),
(205, 10, 54, 3, '2022-06-12 14:29:03');

-- --------------------------------------------------------

--
-- Table structure for table `Players`
--

CREATE TABLE `Players` (
  `UserId` int(11) NOT NULL,
  `ProfilePic` varchar(50) NOT NULL DEFAULT 'default.png',
  `UserName` varchar(20) NOT NULL,
  `GenderId` int(11) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `LoginTry` int(11) NOT NULL DEFAULT 2,
  `AfterLogin` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Players Data stored or login information';

--
-- Dumping data for table `Players`
--

INSERT INTO `Players` (`UserId`, `ProfilePic`, `UserName`, `GenderId`, `Password`, `LoginTry`, `AfterLogin`) VALUES
(5, 'default.png', 'Kanisth', 0, '9568', 2, '2022-06-13 07:35:14'),
(6, 'default.png', 'Gitanjali', 1, '1234', 2, '2022-06-13 07:35:14'),
(8, 'default.png', 'Saurabh', 0, '12345678', 2, '2022-06-13 07:35:14'),
(10, 'default.png', 'Simran Bhardwaj', 1, '@simran123', 2, '2022-06-13 07:35:14'),
(11, 'default.png', 'Ashish', 0, 'Qwerty@123', 2, '2022-06-13 07:35:14'),
(12, 'default.png', 'BHADRAKAL', 0, 'peas@123.', 2, '2022-06-13 07:35:14'),
(28, 'default.png', 'TestHardik', 0, '1234567809', 2, '2022-06-13 07:35:14'),
(30, 'default.png', 'tushar', 0, 'tushar', 2, '2022-06-13 07:35:14'),
(34, 'default.png', 'Meethi', 1, '12345', 2, '2022-06-13 07:35:14'),
(41, '41.jpg', 'Prashant', 0, 'a', 2, '2022-06-13 07:35:14'),
(42, '42.jpeg', 'Shourya', 0, '123', 2, '2022-06-13 07:35:14'),
(43, 'default.png', 'Parul', 1, '123', 2, '2022-06-13 07:35:14'),
(44, 'default.png', 'Sakshi', 1, '123', 2, '2022-06-13 07:35:14'),
(45, 'default.png', 'Mayuree', 1, '123', 2, '2022-06-13 07:35:14'),
(47, 'default.png', 'Naman', 0, 'lesbianhtu', 2, '2022-06-13 07:35:14'),
(48, 'default.png', 'gulshan', 0, '124421', 2, '2022-06-13 07:35:14'),
(49, 'default.png', 'anshika', 1, '123', 2, '2022-06-13 07:35:14'),
(50, 'default.png', 'shivam', 0, '12345', 2, '2022-06-13 07:35:14'),
(52, 'default.png', 'Arun', 0, 'arun18', 2, '2022-06-13 07:35:14'),
(54, '54.jpg', 'Jyoti', 1, 'Jyoti', 2, '2022-06-13 07:38:47');

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
  MODIFY `ScoreId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT for table `Players`
--
ALTER TABLE `Players`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

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
