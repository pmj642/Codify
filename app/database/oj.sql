-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2018 at 12:50 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

-- SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
-- SET AUTOCOMMIT = 0;
START TRANSACTION;
-- SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: oj
--

-- --------------------------------------------------------

--
-- Table structure for table questions
--

CREATE TABLE questions (
  id bigint(20) UNSIGNED NOT NULL,
  name varchar(50) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  description text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  inputFormat text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  outputFormat text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  constraints text CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  exampleIn text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  exampleOut text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
);

--
-- Dumping data for table questions
--

INSERT INTO questions (id, name, description, inputFormat, outputFormat, constraints, exampleIn, exampleOut) VALUES
(1, 'Sum of Digits', 'You\'re given an integer N. Write a program to calculate the sum of all the digits of N.', 'The first line contains an integer T, total number of testcases. Then follow T lines, each line contains an integer N.', 'Calculate the sum of digits of N.', '1 ≤ T ≤ 1000\r\n1 ≤ N ≤ 1000000', '3 \r\n12345\r\n31203\r\n2123', '15\r\n9\r\n8'),
(2, 'Small Factorial', 'Write a program to find the factorial value of any number entered by the user.', 'The first line contains an integer T, total number of testcases. Then follow T lines, each line contains an integer N. ', 'Display the factorial of the given number N.', '1 ≤ T ≤ 1000\r\n0 ≤ N ≤ 20\r\n', '3 \r\n3 \r\n4\r\n5', '6\r\n24\r\n120'),
(6, 'Squares', 'Given a number, output its square i.e. N*N.', 'First line provides the number of testcases T. The next T lines contain a single integer N.', 'Output the square of N.\r\n', '1 <= T <= 100\r\n1 <= N <= 100\r\n', '4\r\n1\r\n2\r\n3\r\n4\r\n', '1\r\n4\r\n9\r\n16'),
(7, 'Sum of two numbers', 'Given a & b. Print their sum.', 'Each line contains two integers a & b.', 'Print a+b.', '1 =< a <= b <= 100', '2 3', '5'),
(9, 'Square Root', 'Given a number N find the square root of N.', 'A single line containing N.', 'The square root of N.', '1 <= N <= 1000', '100', '10');

-- --------------------------------------------------------

--
-- Table structure for table ranks
--

CREATE TABLE ranks (
  user_id bigint(20) UNSIGNED NOT NULL,
  question_count int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table ranks
--

INSERT INTO ranks (user_id, question_count) VALUES
(7, 1);

-- --------------------------------------------------------

--
-- Table structure for table solved
--

CREATE TABLE solved (
  user_id bigint(20) UNSIGNED NOT NULL,
  que_id bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table solved
--

INSERT INTO solved (user_id, que_id) VALUES
(7, 1);

-- --------------------------------------------------------

--
-- Table structure for table submissions
--

CREATE TABLE submissions (
  time datetime NOT NULL,
  user_id bigint(20) UNSIGNED NOT NULL,
  que_id bigint(20) UNSIGNED NOT NULL,
  runtime double NOT NULL,
  status text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table submissions
--

INSERT INTO submissions (time, user_id, que_id, runtime, status) VALUES
('2018-11-21 13:14:18', 7, 1, 0, 'Accepted'),
('2018-11-21 17:39:56', 7, 1, 0, 'Accepted'),
('2018-11-22 04:54:55', 7, 1, 0, 'Accepted'),
('2018-11-22 05:08:40', 7, 1, 0, 'Wrong Answer'),
('2018-11-22 05:13:26', 7, 1, 0, 'Accepted'),
('2018-11-22 05:14:06', 7, 1, 0, 'Wrong Answer'),
('2018-11-22 05:15:16', 7, 1, 0, 'Compilation Error'),
('2018-11-22 15:15:27', 7, 1, 0, 'Compilation Error'),
('2018-11-22 15:16:59', 7, 1, 0, 'Compilation Error'),
('2018-11-22 15:32:17', 7, 1, 0, 'Compilation Error'),
('2018-11-22 15:33:20', 7, 1, 0, 'Compilation Error'),
('2018-11-22 15:34:00', 7, 1, 0, 'Compilation Error'),
('2018-11-22 15:35:32', 7, 1, 0, 'Compilation Error'),
('2018-11-22 15:36:14', 7, 1, 0, 'Compilation Error'),
('2018-11-23 07:47:36', 7, 1, 0, 'Compilation Error'),
('2018-11-23 07:56:26', 7, 1, 0, 'Compilation Error'),
('2018-11-23 08:06:29', 7, 1, 0, 'Compilation Error'),
('2018-11-23 08:07:55', 7, 1, 0, 'Compilation Error'),
('2018-11-23 08:11:20', 7, 1, 0, 'Compilation Error'),
('2018-11-23 08:13:43', 7, 1, 0, 'Compilation Error'),
('2018-11-23 08:14:12', 7, 1, 0, 'Compilation Error'),
('2018-11-23 08:16:18', 7, 1, 0, 'Compilation Error'),
('2018-11-23 08:17:09', 7, 1, 0, 'Compilation Error'),
('2018-11-23 08:18:13', 7, 1, 0, 'Compilation Error'),
('2018-11-23 08:19:59', 7, 1, 0, 'Compilation Error'),
('2018-11-23 08:25:59', 7, 1, 0, 'Compilation Error'),
('2018-11-23 08:28:39', 7, 1, 0, 'Compilation Error'),
('2018-11-23 08:29:19', 7, 1, 0, 'Compilation Error'),
('2018-11-23 08:40:11', 7, 1, 0, 'Compilation Error'),
('2018-11-23 08:44:45', 7, 1, 0, 'Compilation Error'),
('2018-11-23 08:47:02', 7, 1, 0, 'Compilation Error'),
('2018-11-23 08:51:17', 7, 1, 0, 'Compilation Error'),
('2018-11-23 09:01:58', 7, 1, 0, 'Compilation Error'),
('2018-11-23 09:09:54', 7, 1, 0, 'Compilation Error'),
('2018-11-23 09:10:41', 7, 1, 0, 'Accepted'),
('2018-11-23 11:54:10', 7, 1, 0, 'Accepted'),
('2018-11-23 11:55:12', 7, 1, 0, 'Accepted'),
('2018-11-23 11:56:58', 7, 1, 0, 'Accepted'),
('2018-11-23 12:19:06', 7, 1, 0, 'Accepted'),
('2018-11-23 12:19:13', 7, 1, 0, 'Accepted'),
('2018-11-23 12:19:39', 7, 1, 0, 'Accepted'),
('2018-11-23 12:20:38', 7, 1, 0, 'Accepted'),
('2018-11-23 12:38:13', 7, 1, 0, 'Accepted'),
('2018-11-23 13:05:28', 7, 1, 0, 'Accepted'),
('2018-11-23 13:09:14', 7, 1, 0, 'Accepted'),
('2018-11-23 13:36:27', 7, 1, 0, 'Accepted'),
('2018-11-23 13:37:23', 7, 1, 0, 'Wrong Answer'),
('2018-11-23 13:37:33', 7, 1, 0, 'Accepted'),
('2018-11-24 06:29:45', 7, 1, 0, 'Accepted'),
('2018-11-24 06:30:38', 7, 1, 0, 'Accepted'),
('2018-11-28 15:04:45', 7, 1, 0, 'Accepted'),
('2018-11-28 15:06:17', 7, 1, 0, 'Accepted'),
('2018-12-10 10:45:56', 7, 1, 0, 'Accepted'),
('2018-12-10 11:06:53', 7, 1, 0, 'Accepted'),
('2018-12-10 11:38:46', 7, 1, 0, 'Accepted'),
('2018-12-10 11:52:02', 7, 1, 0, 'Accepted'),
('2018-12-10 11:52:42', 7, 1, 0, 'Accepted'),
('2018-12-10 12:00:51', 7, 1, 0, 'Accepted'),
('2018-12-11 06:19:54', 7, 1, 0.004, 'Accepted'),
('2018-12-11 06:23:56', 7, 1, 0, 'Accepted'),
('2018-12-11 06:25:30', 7, 1, 0, 'Accepted'),
('2018-12-11 06:34:10', 7, 1, 0, 'Accepted'),
('2018-12-11 06:34:40', 7, 1, 0, 'Accepted'),
('2018-12-11 13:55:49', 7, 1, 0.004, 'Accepted'),
('2018-12-11 13:57:02', 7, 1, 0, 'Accepted');

-- --------------------------------------------------------

--
-- Table structure for table testcases
--

CREATE TABLE testcases (
  que_id bigint(20) UNSIGNED NOT NULL,
  input text NOT NULL,
  output text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table testcases
--

INSERT INTO testcases (que_id, input, output) VALUES
(1, '3 \r\n12345\r\n31203\r\n2123', '15\r\n9\r\n8'),
(2, '3 \r\n3 \r\n4\r\n5', '6\r\n24\r\n120'),
(6, '10\r\n1\r\n2\r\n3\r\n4\r\n5\r\n6\r\n7\r\n8\r\n9\r\n10', '1\r\n4\r\n9\r\n16\r\n25\r\n36\r\n49\r\n64\r\n81\r\n100\r\n'),
(7, '15 19', '34'),
(9, '225                            ', '15                            ');

-- --------------------------------------------------------

--
-- Table structure for table userdetails
--

CREATE TABLE userdetails (
  id bigint(20) UNSIGNED NOT NULL,
  name text NOT NULL,
  age int(11) NOT NULL,
  gender text NOT NULL,
  country text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table userdetails
--

INSERT INTO userdetails (id, name, age, gender, country) VALUES
(5, 'pmj642_coder', 21, 'male', 'india'),
(6, 'Naruto', 24, 'male', 'india'),
(7, 'Pranshu Jethmalani', 21, 'male', 'india'),
(8, 'Naruto', 21, 'male', 'india'),
(9, '<?php <b>Hello</b> ?>', 22, 'female', 'china'),
(10, 'Jethalal', 22, 'male', 'india'),
(11, 'Mahendra', 22, 'male', 'india');

-- --------------------------------------------------------

--
-- Table structure for table userlogin
--

CREATE TABLE userlogin (
  id bigint(20) UNSIGNED NOT NULL,
  user text NOT NULL,
  pass text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table userlogin
--

INSERT INTO userlogin (id, user, pass) VALUES
(5, 'pmj642@gmail.com', '$2y$10$LljjXmdL0tUQ7D63ASznDeRbmYPIznpYTgU7qGFsyzrI70/2EBCXK'),
(6, 'pmj62@gmail.com', '$2y$10$iXw3L96Jpwqj/lEAAgM74eZdZ1ILynl6Tf5LYDLhEryWf3CohYda.'),
(7, 'pmj2@gmail.com', '$2y$10$i/MdBSAWGSDOCh5RA2e21OL1TZbjgt03l1AkWh6wxMCQTg9SH1LFS'),
(8, 'pmj@gmail.com', '$2y$10$OQ2MVFmJhdJiS4MQQeeapO308t2ObywuIXBkLBCccPJoaiVS.xVR.'),
(9, 'pmj123@gmail.com', 'jetha'),
(10, 'pmj13@gmail.com', '$2y$10$lkzz9RrEJtoYDkIzibx6WuYPJ3858ut.YnGHJzjXFfMJoq9zZTG2W');

--
-- Indexes for dumped tables
--

--
-- Indexes for table questions
--
ALTER TABLE questions
  ADD PRIMARY KEY (id);

--
-- Indexes for table ranks
--
ALTER TABLE ranks
  ADD PRIMARY KEY (user_id);

--
-- Indexes for table solved
--
ALTER TABLE solved
  ADD PRIMARY KEY (user_id,que_id),
  ADD KEY que_id (que_id);

--
-- Indexes for table submissions
--
ALTER TABLE submissions
  ADD PRIMARY KEY (time,user_id),
  ADD KEY que_id (que_id),
  ADD KEY user_id (user_id);

--
-- Indexes for table testcases
--
ALTER TABLE testcases
  ADD UNIQUE KEY que_id (que_id);

--
-- Indexes for table userdetails
--
ALTER TABLE userdetails
  ADD PRIMARY KEY (id),
  ADD UNIQUE KEY id (id);

--
-- Indexes for table userlogin
--
ALTER TABLE userlogin
  ADD PRIMARY KEY (id),
  ADD UNIQUE KEY id (id);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table questions
--
ALTER TABLE questions
  MODIFY id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table userdetails
--
ALTER TABLE userdetails
  MODIFY id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table userlogin
--
ALTER TABLE userlogin
  MODIFY id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table ranks
--
ALTER TABLE ranks
  ADD CONSTRAINT ranks_ibfk_1 FOREIGN KEY (user_id) REFERENCES userdetails (id);

--
-- Constraints for table solved
--
ALTER TABLE solved
  ADD CONSTRAINT solved_ibfk_1 FOREIGN KEY (que_id) REFERENCES questions (id),
  ADD CONSTRAINT solved_ibfk_2 FOREIGN KEY (user_id) REFERENCES userdetails (id);

--
-- Constraints for table submissions
--
ALTER TABLE submissions
  ADD CONSTRAINT submissions_ibfk_1 FOREIGN KEY (que_id) REFERENCES questions (id),
  ADD CONSTRAINT submissions_ibfk_2 FOREIGN KEY (user_id) REFERENCES userdetails (id);

--
-- Constraints for table testcases
--
ALTER TABLE testcases
  ADD CONSTRAINT testcases_ibfk_1 FOREIGN KEY (que_id) REFERENCES questions (id);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
