-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2018 at 08:39 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oj`
--

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `inputFormat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `outputFormat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `constraints` text CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `exampleIn` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `exampleOut` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Stores the questions';

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `name`, `description`, `inputFormat`, `outputFormat`, `constraints`, `exampleIn`, `exampleOut`) VALUES
(1, 'Sum of Digits', 'You\'re given an integer N. Write a program to calculate the sum of all the digits of N.', 'The first line contains an integer T, total number of testcases. Then follow T lines, each line contains an integer N.', 'Calculate the sum of digits of N.', '1 ≤ T ≤ 1000\r\n1 ≤ N ≤ 1000000', '3 \r\n12345\r\n31203\r\n2123', '15\r\n9\r\n8'),
(2, 'Small Factorial', 'Write a program to find the factorial value of any number entered by the user.', 'The first line contains an integer T, total number of testcases. Then follow T lines, each line contains an integer N. ', 'Display the factorial of the given number N.', '1 ≤ T ≤ 1000\r\n0 ≤ N ≤ 20\r\n', '3 \r\n3 \r\n4\r\n5', '6\r\n24\r\n120');

-- --------------------------------------------------------

--
-- Table structure for table `solved`
--

CREATE TABLE `solved` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `que_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `time` date NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `que_id` bigint(20) UNSIGNED NOT NULL,
  `runtime` double NOT NULL,
  `status` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `testcases`
--

CREATE TABLE `testcases` (
  `que_id` bigint(20) UNSIGNED NOT NULL,
  `input` text NOT NULL,
  `output` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `testcases`
--

INSERT INTO `testcases` (`que_id`, `input`, `output`) VALUES
(1, '3 \r\n12345\r\n31203\r\n2123', '15\r\n9\r\n8'),
(2, '3 \r\n3 \r\n4\r\n5', '6\r\n24\r\n120');

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `age` int(11) NOT NULL,
  `gender` text NOT NULL,
  `country` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`id`, `name`, `age`, `gender`, `country`) VALUES
(5, 'pmj642_coder', 21, 'male', 'india'),
(6, 'Naruto', 24, 'male', 'india'),
(7, 'Pranshu Jethmalani', 21, 'male', 'india'),
(8, 'Naruto', 21, 'male', 'india'),
(9, '<?php <b>Hello</b> ?>', 22, 'female', 'china');

-- --------------------------------------------------------

--
-- Table structure for table `userlogin`
--

CREATE TABLE `userlogin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user` text NOT NULL,
  `pass` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userlogin`
--

INSERT INTO `userlogin` (`id`, `user`, `pass`) VALUES
(5, 'pmj642@gmail.com', '$2y$10$LljjXmdL0tUQ7D63ASznDeRbmYPIznpYTgU7qGFsyzrI70/2EBCXK'),
(6, 'pmj62@gmail.com', '$2y$10$iXw3L96Jpwqj/lEAAgM74eZdZ1ILynl6Tf5LYDLhEryWf3CohYda.'),
(7, 'pmj2@gmail.com', '$2y$10$i/MdBSAWGSDOCh5RA2e21OL1TZbjgt03l1AkWh6wxMCQTg9SH1LFS'),
(8, 'pmj@gmail.com', '$2y$10$OQ2MVFmJhdJiS4MQQeeapO308t2ObywuIXBkLBCccPJoaiVS.xVR.'),
(9, 'pm@gmail.com', '$2y$10$7izBluwf2LH7SEC14lD2uemKEUy64uUgJAwlzz0QROMHTbuB/KFd2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `solved`
--
ALTER TABLE `solved`
  ADD PRIMARY KEY (`user_id`,`que_id`),
  ADD KEY `que_id` (`que_id`);

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`time`,`user_id`),
  ADD KEY `que_id` (`que_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `testcases`
--
ALTER TABLE `testcases`
  ADD UNIQUE KEY `que_id` (`que_id`);

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `userlogin`
--
ALTER TABLE `userlogin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `userdetails`
--
ALTER TABLE `userdetails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `userlogin`
--
ALTER TABLE `userlogin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `solved`
--
ALTER TABLE `solved`
  ADD CONSTRAINT `solved_ibfk_1` FOREIGN KEY (`que_id`) REFERENCES `questions` (`id`),
  ADD CONSTRAINT `solved_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `userdetails` (`id`);

--
-- Constraints for table `submissions`
--
ALTER TABLE `submissions`
  ADD CONSTRAINT `submissions_ibfk_1` FOREIGN KEY (`que_id`) REFERENCES `questions` (`id`),
  ADD CONSTRAINT `submissions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `userdetails` (`id`);

--
-- Constraints for table `testcases`
--
ALTER TABLE `testcases`
  ADD CONSTRAINT `testcases_ibfk_1` FOREIGN KEY (`que_id`) REFERENCES `questions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
