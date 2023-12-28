-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 28, 2023 at 12:51 PM
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
-- Database: `chat`
--
CREATE DATABASE IF NOT EXISTS `chat` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `chat`;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`) VALUES
(1, 8, 11, 'hi'),
(2, 8, 11, 'hello '),
(3, 11, 8, 'hi'),
(4, 11, 8, 'how are you'),
(5, 8, 11, 'i\'m fine '),
(6, 8, 11, 'how are you'),
(7, 8, 11, 'i love you soo muchj'),
(8, 8, 11, 'excuse me '),
(9, 8, 11, 'i love you so much'),
(10, 11, 8, 'i\'m fine'),
(11, 11, 8, 'thanks'),
(12, 11, 8, 'me i love you'),
(13, 11, 8, 'how you doing'),
(14, 8, 11, 'nothing'),
(15, 11, 8, 'why'),
(16, 8, 11, 'because i\'m not very ok'),
(17, 11, 8, 'why'),
(18, 11, 8, 'دلیل دارم برای اینکه بترکونم'),
(19, 11, 8, 'من عاشقتم');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(400) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `img`, `status`) VALUES
(8, 'Nima', 'Malakootikhah', 'nima_8a@yahoo.com', '$2y$10$WPJOMOUYHoU.xbGVnehSW.GmMwSiub2RhM40z9PO9UuQpFT2U/oN.', '/opt/lampp/htdocs/Chat_Page/Main/Assets/php/../images/Nima1703763414.jpg', 'Active'),
(11, 'Fateme', 'Malakootikhah', 'fateme@yahoo.com', '$2y$10$k0TSRpItl4STDE/qO.uuzujRSgNLQTMlC8i12GCiCZbBDPb09HqI6', '/opt/lampp/htdocs/Chat_Page/Main/Assets/php/../images/Fateme1703763764.jpeg', 'Active'),
(12, 'Mohsen', 'Malakootikhah', 'mohsen@yahoo.com', '$2y$10$TYSx3UN3EkTEF5WwrAwyIuYw9XnRGr.wMF1aZ5ddGd/.R4hT51UMi', '/opt/lampp/htdocs/Chat_Page/Main/Assets/php/../images/Mohsen1703763861.jpg', 'Offline');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incoming_msg_id` (`incoming_msg_id`),
  ADD KEY `outgoing_msg_id` (`outgoing_msg_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`incoming_msg_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`outgoing_msg_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `relate1` FOREIGN KEY (`incoming_msg_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
