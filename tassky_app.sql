-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2025 at 09:39 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tassky_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`email`, `name`, `password`) VALUES
('rabab.sahsah@gmail.com', 'rabab alsahsah', '786650cabaedc564398ca66de8a2c48d');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `task_owner` varchar(255) NOT NULL,
  `task_title` varchar(255) NOT NULL,
  `task_details` varchar(255) NOT NULL,
  `task_status` varchar(255) NOT NULL,
  `task_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `task_owner`, `task_title`, `task_details`, `task_status`, `task_img`) VALUES
(3, 'rabab.sahsah@gmail.com', 'Attende Rabab\'s birthday party', 'buy gifts on the way and pick up cake from backery (6 PM | Fresh Elements)', 'in-progress', 'img/1757857908_birthday.jpg'),
(4, 'rabab.sahsah@gmail.com', 'Eat a healthy breakfast', 'Fuel your body for the day ahead', 'completed', 'img/1757913370_breakfast.jpg'),
(5, 'rabab.sahsah@gmail.com', 'Finish writing the project report', 'Complete the remaining sections of the monthly project report and proofread before submitting it by 4 PM', 'not-started', 'img/1757914183_report.jpg'),
(6, 'rabab.sahsah@gmail.com', 'Check Emails', 'Go through your inbox to respond to urgent messages and clear out any unnecessary emails to stay organized', 'not-started', 'img/1757914206_email.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
