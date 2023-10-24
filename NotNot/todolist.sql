-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2023 at 02:37 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todolist`
--

-- --------------------------------------------------------

--
-- Table structure for table `datauser`
--

CREATE TABLE `datauser` (
  `user_id` int(11) NOT NULL,
  `namadepan` varchar(255) NOT NULL,
  `namabelakang` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `gender` enum('lakilaki','perempuan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `datauser`
--

INSERT INTO `datauser` (`user_id`, `namadepan`, `namabelakang`, `username`, `password`, `tanggal`, `gender`) VALUES
(6, 'Peter', 'Parker', 'spiderman', '$2y$10$U4.L1tFVUusMSZ8Xv0k/JekD9cOjX/qjD7gcLRU8.VuyKgEFv73uO', '2023-10-01', 'lakilaki'),
(7, 'Robert', 'Downey', 'ironman', '$2y$10$hiqsI4CTKrOAWQ9T3Q2JkeyD.NGuB2tugehdzH9RE80t6zOqNidWO', '2023-10-01', 'lakilaki');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `taskid` int(11) NOT NULL,
  `tasklabel` varchar(50) NOT NULL,
  `task_desc` varchar(255) NOT NULL,
  `task_deadline` datetime NOT NULL,
  `taskstatus` enum('open','close') NOT NULL,
  `createdat` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`taskid`, `tasklabel`, `task_desc`, `task_deadline`, `taskstatus`, `createdat`, `user_id`) VALUES
(24, 'Main Games', 'Valorant', '2023-10-28 20:40:00', 'open', '2023-10-24 10:36:21', 0),
(25, 'UTS English', 'Jangan lupa kerjain', '2023-10-23 23:59:00', 'close', '2023-10-24 10:37:12', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `datauser`
--
ALTER TABLE `datauser`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`taskid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `datauser`
--
ALTER TABLE `datauser`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `taskid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `datauser` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
