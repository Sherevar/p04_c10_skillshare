-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 15, 2026 at 08:45 AM
-- Server version: 5.7.24
-- PHP Version: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_c10`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_answers`
--

CREATE TABLE `tb_answers` (
  `answer_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer1` text NOT NULL,
  `answer2` text NOT NULL,
  `answer3` text NOT NULL,
  `answer4` text NOT NULL,
  `answer_true` varchar(7) NOT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_answers`
--

INSERT INTO `tb_answers` (`answer_id`, `question_id`, `answer1`, `answer2`, `answer3`, `answer4`, `answer_true`, `status`) VALUES
(1, 1, '1', '1', '1', '1', 'answer1', NULL),
(2, 2, 'string', 'boolean', 'integer', 'text', 'answer1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_friends`
--

CREATE TABLE `tb_friends` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `friend_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_friends`
--

INSERT INTO `tb_friends` (`id`, `user_id`, `friend_id`, `friend_creation`) VALUES
(10, 2, 1, '2026-06-11 07:59:48'),
(11, 2, 7, '2026-06-11 07:59:56'),
(12, 2, 7, '2026-06-11 07:59:59'),
(13, 2, 7, '2026-06-11 08:00:03'),
(14, 2, 7, '2026-06-11 08:00:05'),
(15, 2, 7, '2026-06-11 08:04:45');

-- --------------------------------------------------------

--
-- Table structure for table `tb_levels`
--

CREATE TABLE `tb_levels` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `badge_level` enum('nothing','bronze','silver','gold','platinum') NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `creation_date` date NOT NULL,
  `topscore` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_questions`
--

CREATE TABLE `tb_questions` (
  `id` int(11) NOT NULL,
  `skills_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `points_to_earn` int(11) NOT NULL DEFAULT '10',
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_questions`
--

INSERT INTO `tb_questions` (`id`, `skills_id`, `question`, `points_to_earn`, `status`) VALUES
(1, 1, '1', 10, NULL),
(2, 4, 'Hoe heet een stuk text in programeertaal', 10, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_skills`
--

CREATE TABLE `tb_skills` (
  `id` int(11) NOT NULL,
  `skill` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_skills`
--

INSERT INTO `tb_skills` (`id`, `skill`, `description`, `status`, `creation_date`) VALUES
(1, 'juyhtgr', 'jhngbf', 0, '2026-05-27 11:02:43'),
(2, 'test1', 'test2', 0, '2026-05-27 11:02:50'),
(3, 'test2', 'test2', 0, '2026-06-11 09:30:11'),
(4, 'Java', 'test', 0, '2026-05-28 11:34:58'),
(6, 'C++', 'apsodfhjnm', 0, '2026-05-28 13:07:17'),
(7, 'Rubik\'s cubing', '\\trh', 0, '2026-05-28 13:14:01'),
(8, 'tableskill', 'asdf', 0, '2026-06-11 11:49:29');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `signup_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_date` date DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id`, `username`, `user_password`, `email`, `signup_date`, `end_date`, `active`) VALUES
(1, 'azur', '$2y$10$tOOwpWRrslKPQSyHkqLdrONAQwbZfvXp6E9spQWhQDDZrlY4kprQe', 'azur@vista.nl', '2026-06-09 10:51:46', NULL, 1),
(2, 'test1', '$2y$10$3FIYlGHZBLTjqq7SI1k/z.QB1gqiXyf9GyHXoLqSTI0jt.DDokOfW', 'test@test.nl', '2026-06-09 10:56:16', NULL, 1),
(3, 'danny', '$2y$10$fincX18ctj7syYog5kqb.O7RSq1y/Pe2p/2jBoZW6fXRy2qTRAoAe', 'admin@admin.nl', '2026-06-11 09:29:48', NULL, 1),
(5, 'thierry', '$2y$10$0KYNO9QvAALQEZzv3gJd3.VHH90feBrY7w5b7a8cif5/9tqhkSKKW', 'admin@addie.nl', '2026-06-11 09:29:55', NULL, 1),
(7, 'test', '$2y$10$ZRf/mpChtaMIZQjT2fcVp.NUdkY4sSXiCUQBq7nvPzBLYqu/p.Siy', 'test@asdf.nl', '2026-06-09 11:26:29', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user_skills`
--

CREATE TABLE `tb_user_skills` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL,
  `points_earned` int(11) DEFAULT NULL,
  `medal_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_user_skills`
--

INSERT INTO `tb_user_skills` (`id`, `user_id`, `skill_id`, `points_earned`, `medal_id`) VALUES
(1, 1, 6, 90, 3),
(2, 1, 1, 70, 2),
(3, 7, 8, 70, 2),
(4, 3, 3, 60, 2),
(5, 5, 6, 70, 2),
(6, 5, 1, 90, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_answers`
--
ALTER TABLE `tb_answers`
  ADD PRIMARY KEY (`answer_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `tb_friends`
--
ALTER TABLE `tb_friends`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `friend_id` (`friend_id`);

--
-- Indexes for table `tb_levels`
--
ALTER TABLE `tb_levels`
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tb_questions`
--
ALTER TABLE `tb_questions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `skills_id` (`skills_id`);

--
-- Indexes for table `tb_skills`
--
ALTER TABLE `tb_skills`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tb_user_skills`
--
ALTER TABLE `tb_user_skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `skill_id` (`skill_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_answers`
--
ALTER TABLE `tb_answers`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_friends`
--
ALTER TABLE `tb_friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_questions`
--
ALTER TABLE `tb_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_skills`
--
ALTER TABLE `tb_skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_user_skills`
--
ALTER TABLE `tb_user_skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_answers`
--
ALTER TABLE `tb_answers`
  ADD CONSTRAINT `tb_answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `tb_questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_friends`
--
ALTER TABLE `tb_friends`
  ADD CONSTRAINT `tb_friends_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tb_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_friends_ibfk_2` FOREIGN KEY (`friend_id`) REFERENCES `tb_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tb_questions`
--
ALTER TABLE `tb_questions`
  ADD CONSTRAINT `tb_questions_ibfk_1` FOREIGN KEY (`skills_id`) REFERENCES `tb_skills` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_user_skills`
--
ALTER TABLE `tb_user_skills`
  ADD CONSTRAINT `tb_user_skills_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tb_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_user_skills_ibfk_2` FOREIGN KEY (`skill_id`) REFERENCES `tb_skills` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
