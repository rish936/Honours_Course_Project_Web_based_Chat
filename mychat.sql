-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2020 at 08:41 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mychat`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_pass` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_profile` varchar(255) NOT NULL,
  `user_country` text NOT NULL,
  `user_gender` text NOT NULL,
  `forgotten_answer` varchar(100) NOT NULL,
  `log_in` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_pass`, `user_email`, `user_profile`, `user_country`, `user_gender`, `forgotten_answer`, `log_in`) VALUES
(1, 'Lonewolf', '123456789', 'aquilla0710@gmail.com', 'images/jerry.png.22', 'United Kingdom', 'Male', 'CA', 'Online'),
(2, 'lone', '1234568969', 'lone@gmail.com', 'images/profile2.png', 'India', 'Male', '', 'Offline'),
(3, 'loni', '987654321023', 'loni@gmail.com', 'images/profile2.png', 'India', 'Male', '', ''),
(4, 'marvel2001', 'marvel2001', 'marvel2001@gmail.com', 'images/profile2.png', 'United Kingdom', 'Female', '', 'Online'),
(5, 'superman', 'superman', 'superman@gmail.com', 'images/profile2.png', 'New Zealand', 'Female', '', ''),
(6, 'CA', 'lonewolf', 'ca@gmail.com', 'images/profile1.png', 'Others', 'Female', '', 'Offline');

-- --------------------------------------------------------

--
-- Table structure for table `users_chat`
--

CREATE TABLE `users_chat` (
  `msg_id` int(11) NOT NULL,
  `sender_username` varchar(100) NOT NULL,
  `receiver_username` varchar(100) NOT NULL,
  `msg_content` varchar(255) NOT NULL,
  `msg_status` text NOT NULL,
  `msg_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_chat`
--

INSERT INTO `users_chat` (`msg_id`, `sender_username`, `receiver_username`, `msg_content`, `msg_status`, `msg_date`) VALUES
(1, 'Lonewolf', 'Lonewolf', 'Hello', 'unread', '2020-10-21 12:38:16'),
(10, 'Lonewolf', 'Lonewolf', 'Hello', 'unread', '2020-10-21 12:56:54'),
(11, 'Lonewolf', 'lone', 'Hello', 'unread', '2020-11-04 14:44:45'),
(12, 'Lonewolf', 'lone', 'Hello', 'unread', '2020-11-04 14:45:23'),
(13, 'Lonewolf', 'loni', 'heelo', 'unread', '2020-11-04 14:57:01'),
(14, 'lone', 'Lonewolf', 'hello', 'unread', '2020-11-04 14:58:48'),
(15, 'lone', 'Lonewolf', 'hello', 'unread', '2020-11-04 14:58:52'),
(16, 'lone', 'Lonewolf', 'hello', 'unread', '2020-11-04 14:59:39'),
(17, 'Lonewolf', 'lone', 'How are you???', 'unread', '2020-11-04 15:49:55'),
(18, 'lone', 'Lonewolf', 'Im gud', 'unread', '2020-11-04 15:50:49'),
(19, 'Lonewolf', 'lone', 'Imguf', 'unread', '2020-11-04 16:02:09'),
(20, 'Lonewolf', 'lone', 'Hello', 'unread', '2020-11-04 16:08:58'),
(21, 'Lonewolf', 'lone', 'Hello', 'unread', '2020-11-05 07:56:55'),
(22, 'lone', 'Lonewolf', 'Hello', 'unread', '2020-12-08 12:51:48'),
(23, 'lone', 'Lonewolf', 'Hello', 'unread', '2020-12-08 12:51:55'),
(24, 'Lonewolf', 'lone', 'Hello', 'unread', '2020-12-10 13:51:59'),
(25, 'Lonewolf', 'lone', 'Hello', 'unread', '2020-12-10 13:52:05'),
(26, 'CA', 'marvel2001', 'Hello', 'unread', '2020-12-29 05:42:06'),
(27, 'CA', 'marvel2001', 'How are u???', 'unread', '2020-12-29 05:42:29'),
(28, 'CA', 'marvel2001', 'Hello', 'unread', '2020-12-29 05:42:40'),
(29, 'Lonewolf', 'marvel2001', 'hello', 'unread', '2020-12-29 18:25:44'),
(30, 'Lonewolf', 'CA', 'Hello', 'unread', '2020-12-29 19:29:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_chat`
--
ALTER TABLE `users_chat`
  ADD PRIMARY KEY (`msg_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users_chat`
--
ALTER TABLE `users_chat`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
