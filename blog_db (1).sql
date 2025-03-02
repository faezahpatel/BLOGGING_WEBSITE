-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2024 at 03:34 AM
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
-- Database: `blog_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `content`, `image`, `author_id`, `created_at`, `category`) VALUES
(25, 'php', 'testhello@gmail.com', 'uploads/Screenshot 2024-11-27 223544.png', 71, '2024-11-27 17:26:50', 'education'),
(26, 'java', 'Java is a programming language and a platform. Java is a high level, robust, object-oriented and secure programming language.\r\n\r\nJava was developed by Sun Microsystems (which is now the subsidiary of Oracle) in the year 1995. James Gosling is known as the father of Java. Before Java, its name was Oak. Since Oak was already a registered company, so James Gosling and his team changed the name from Oak to Java.', 'uploads/Desktop - 1 (3).jpg', 59, '2024-11-27 17:38:18', 'education'),
(27, 'hello', 'hjdshfg', NULL, 59, '2024-11-27 17:38:56', 'technology'),
(28, 'html', 'HTML stands for HyperText Markup Language. It is the standard language used to create and structure content on the web. It tells the web browser how to display text, links, images, and other forms of multimedia on a webpage. HTML sets up the basic structure of a website, and then CSS and JavaScript add style and interactivity to make it look and function better.', 'uploads/Screenshot 2024-08-22 222747.png', 59, '2024-11-27 17:40:26', 'technology'),
(29, 'Health', 'A healthy diet comprises a combination of different foods. These include:\r\n\r\nStaples like cereals (wheat, barley, rye, maize or rice) or starchy tubers or roots (potato, yam, taro or cassava).\r\nLegumes (lentils and beans).\r\nFruit and vegetables.\r\nFoods from animal sources (meat, fish, eggs and milk).', 'uploads/Black White and Orange Modern Illustrative Inspirational Quotes Dekstop Wallpaper.png', 73, '2024-11-27 18:05:44', 'health'),
(30, 'TECH', 'he blog publishes content on businesses related to tech, analysis of emerging trends in tech, technology news, and listings of new tech products in the market. It is one of the first publications to report broadly on tech startups and funding rounds.\r\n\r\nTechCrunch offers knowledge about new gizmos and business-related apps. It is like a reservoir of information on Internet companies & startups around the world.', NULL, 73, '2024-11-27 18:08:09', 'technology');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_image` varchar(255) DEFAULT 'default-profile.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `profile_image`) VALUES
(59, 'a', 'apple@gmail.com', '$2y$10$ZK7j5uGHTRHNfiTnEI1pY.KzXVQJkFa8ZuTmeaPB.bVca3TYwVx.G', 'user', '2024-11-26 05:41:54', 'default-profile.jpg'),
(60, '22', 'new@gmail.com', '$2y$10$oJir5x6yobUMY8ZUXLvxa.NJ9nyDhNNdtnhQiNMejiS9X99GdShYm', 'user', '2024-11-26 06:23:47', 'default-profile.jpg'),
(63, 'patel', 'patel@gmail.com', '$2y$10$SHstBYKfOAWttSFnCXy1NOBD9zw4CiQkypNdsaqKAXFEAxWn8tYpm', 'user', '2024-11-26 13:48:10', 'default-profile.jpg'),
(68, 'hgfy', 'abcd@gmail.com', '$2y$10$gHLfCvJGmSdGO1JmeiPqbu1aJERMxicsbzs0MQ.378YEiH8jRIBkm', 'user', '2024-11-27 12:04:35', 'default-profile.jpg'),
(71, 'faezah', 'testhello@gmail.com', '$2y$10$kQUMCoEXE/l88gOBGJ7Vj.U8ZquEWMv70WWzyye3RIYcSj0MtyxWa', 'user', '2024-11-27 17:25:25', 'default-profile.jpg'),
(72, 'test', 'test@gmail.com', '$2y$10$QeesKCTUd9bbvBYgElWMH.n/hqUhmf0s/3ozwdHA3z.1FVB/3tP0W', 'user', '2024-11-27 17:57:31', 'default-profile.jpg'),
(73, 'test2', 'test2@gmail.com', '$2y$10$m3n/.aR0fvc2WSvahenS1.pkqMTvzxXcA4KMVNwNuqQ6Y3UlXwBju', 'user', '2024-11-27 18:03:24', 'default-profile.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
