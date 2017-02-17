-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2017 at 02:54 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `body` text CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `subtitle` varchar(200) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `slug` varchar(50) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `img` varchar(100) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `body`, `subtitle`, `slug`, `img`, `user_id`, `created`, `updated`) VALUES
(1, 'This Is The First Page', '<h4 style="text-align: center;">This is the first page</h4>\r\n<p>This is the first page This is the first page This is the first page This is the first page This is the first page This is the first page This is the first page This is the first page This is the first page This is the first page This is the first page This is the first page This is the first page This is the first page This is the first page This is the first page This is the first page This is the first page This is the first page</p>\r\n<p>This is the first page This is the first page This is the first page This is the first page This is the first page This is the first page This is the first page</p>\r\n<p>This is the first page This is the first page This is the first page This is the first page This is the first page This is the first page This is the first page This is the first page This is the first page This is the first page This is the first page This is the first page This is the first page This is the first page This is the first page This is the first page This is the first page This is the first page This is the first page</p>\r\n<p>This is the first page This is the first page This is the first page This is the first page This is the first page This is the first page This is the first page</p>', 'This is the first page This is the first page This is the first page This is the first page This is the first page This is the first page This is the first page This is the first page', 'this is the first page', '../app/img/58a6c2b28082e9.47067187.jpg', 1, '2017-02-17 08:30:26', '2017-02-17'),
(2, 'Just Testing a Second Page', '<p>Just testing a second page Just testing a second pageJust testing a second pageJust testing a second pageJust testing a second pageJust testing a second pageJust testing a second pageJust testing a second pageJust testing a second pageJust testing a second pageJust testing a second page</p>', 'Just testing a second pageJust testing a second pageJust testing a second pageJust testing a second pageJust testing a second pageJust testing a second pageJust testing a second page', 'just testing a second page', '../app/img/58a70bf9b62e48.44373889.jpg', 3, '2017-02-17 13:43:05', '2017-02-17'),
(3, 'Just Testing a Third Page', '<p>Just testing a third page Just testing a third pageJust testing a third pageJust testing a third pageJust testing a third pageJust testing a third pageJust testing a third pageJust testing a third pageJust testing a third pageJust testing a third pageJust testing a third pageJust testing a third pageJust testing a third pageJust testing a third pageJust testing a third pageJust testing a third page</p>', 'Just testing a third pageJust testing a third pageJust testing a third pageJust testing a third pageJust testing a third pageJust testing a third pageJust testing a third page', 'just testing a third page', '../app/img/58a70d3fd659b0.84899744.jpeg', 3, '2017-02-17 14:48:31', '2017-02-17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `last_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `username` varchar(50) NOT NULL,
  `img` varchar(200) DEFAULT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `joined` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `username`, `img`, `password`, `salt`, `joined`) VALUES
(1, 'Stefan', 'Babic', 'Stefan', '', '41b893daf76ecb05eec867967afbf398adb72a530ad42a15f3603e3e5b1fac7a', 'ˆ©ò(c—Ù/ê·„WúF—QÞ°3žLCn¨<E<¸', '2017-01-06 00:00:00'),
(2, 'Kafka', 'Babic', 'Kaffy123', '', '351dfa9a5068c323151f95b12deb4460c154f2b12e50df67e6c5f3c500102d84', '”iÉÒ„U`:Æ€Ü–Ù¡!åQ~ß —ñX—{}=Ò.¡%', '2017-02-09 00:00:00'),
(3, 'Kaffy', 'Kafka', 'Admin123', '../../app/img/58a70b7983b966.15870842.jpg', 'e7e230519bc7a4bc08aa3433bfabb100bd63644316d6263566bfef69905f66a7', 'DÑààr/ßFôùG%*ÆÏª’\ZNðÑ_êrÛÎU\\?‹£', '2017-02-17 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
