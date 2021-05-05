-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2021 at 11:52 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crudapplication`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `courseid` int(255) NOT NULL,
  `timecreated` date NOT NULL DEFAULT current_timestamp(),
  `creator` varchar(255) NOT NULL,
  `coursename` varchar(255) NOT NULL,
  `coursesection` varchar(255) NOT NULL,
  `coursedesc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`courseid`, `timecreated`, `creator`, `coursename`, `coursesection`, `coursedesc`) VALUES
(14, '2021-05-03', 'cheche', 'Writing copy', 'UI/UX', 'UX writing is the practice of crafting copy which is directly used in user interfaces to guide users within a product and help them interact with it. The major aim of UX writing is to settle communication between users and a digital product.'),
(16, '2021-05-03', 'vicky', 'Frontend Dev Basic', 'Frontend', 'Although I’m focusing on backend development, working with frontend developers is unavoidable especially when I’m designing the API for frontend developers to use. Therefore, we must acquire some frontend fundamentals, at least.'),
(18, '2021-05-03', 'akin2d_dele', 'Mobile with Flutter', 'Mobile', 'Flutter is an open-source UI software development kit created by Google. It is used to develop applications for Android, iOS, Linux, Mac, Windows, Google Fuchsia, and the web from a single codebase.'),
(19, '2021-05-03', 'josh2ben', 'Build a Crud Application', 'Backend', 'In computer programming, create, read, update, and delete (CRUD) is a software architectural style regarding the four basic operations of persistent storage. '),
(20, '2021-05-04', 'vicky', 'Update on CourseRep', 'UI/UX', 'This is just a test to see if this is going as planned. I am quite happy about the result Sha, there is still a glitch in the entry CSS for tablet mode, but I don\'t think I will be fixing that, maybe another time sha'),
(21, '2021-05-04', 'cheche2', 'Zuri Training sofar', 'Backend', 'This has been a very good personal experience, creating web apps from scratch and making sure everything is working, I definitely spent a lot of time on error handling and do so properly, I wonder what score I would get.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`) VALUES
(36, 'Kalu Godswill', 'cheche', 'kalugreymatter@gmail.com', '$2y$10$aLoBApPjuECkhhGqNDF2xeiqrcWOgDcPm5WjtnQQTWV9yuMaBbiwW'),
(45, 'Victoria', 'vicky', 'vicky@gmail.com', '$2y$10$JwXEFKyfb0oKN4f6Mm4Su.scV4pqe2hkfI1b98dvo57Iylmfdlp52'),
(54, 'Joshua Benjamin', 'josh2ben', 'josh2ben@gmail.com', '$2y$10$Ak7IWERfAre57H1c6LQt2OusELlNum6rWWVMHkx3GLfcLXkc5tJV.'),
(55, 'Dele Akintude', 'akin2d_dele', 'akin2d_dele@gmail.com', '$2y$10$ulf/fDwBO/EYgs26ml4A/umQPR159BwR5YU3jRwn3ShXO.NSado/a'),
(56, 'Cheche Kalu', 'cheche2', 'kalugreymatter@hotmail.com', '$2y$10$ZrhXmU9ZVx7L6pAwcFCSA.qO3PKqtooGVW/JI2Incejng48Vi11n.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`courseid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `courseid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
