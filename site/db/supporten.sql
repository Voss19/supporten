-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Vært: localhost:3306
-- Genereringstid: 21. 03 2018 kl. 15:03:25
-- Serverversion: 5.6.35
-- PHP-version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `supporten`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `cases`
--

CREATE TABLE `cases` (
  `c_id` int(11) NOT NULL,
  `c_title` varchar(50) NOT NULL,
  `c_content` text NOT NULL,
  `c_owner` int(11) NOT NULL,
  `c_image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Data dump for tabellen `cases`
--

INSERT INTO `cases` (`c_id`, `c_title`, `c_content`, `c_owner`, `c_image`) VALUES
(1, 'Galleri', 'me', 2, NULL),
(2, 'a', 'lel', 2, NULL),
(3, 'me', 'me', 2, NULL),
(4, 'Lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In lacinia dui at consectetur gravida. Quisque scelerisque scelerisque lobortis. Curabitur tempus arcu vitae molestie auctor. Quisque et nisl porttitor, venenatis quam vehicula, commodo purus. Vestibulum at consequat turpis. Nulla gravida mattis cursus. Praesent venenatis velit mauris, et condimentum nibh vehicula quis. Donec in porttitor augue, id elementum magna. Ut condimentum enim ut iaculis finibus. Donec at magna et nisl convallis tempus ac vitae felis.\r\n\r\nMorbi eget lorem vitae mauris volutpat posuere eu in neque. Duis nec arcu ut nisi convallis mattis. Curabitur ac pellentesque enim. Ut pulvinar dictum quam, ut mattis est ultricies quis. Aenean tempus porttitor ornare. Sed bibendum, elit tempus auctor convallis, nisl nunc imperdiet nunc, a porttitor turpis odio sed orci. Vestibulum in ante sed risus gravida fermentum. Fusce tincidunt augue ac dolor molestie vestibulum. Fusce pulvinar, arcu id sagittis luctus, orci tellus feugiat urna, a dictum magna dolor sit amet sem. In nulla nunc, auctor ac porta id, placerat sed urna.\r\n\r\nFusce vel quam in est varius ullamcorper eget vel ligula. Sed sollicitudin felis elit, vitae pellentesque metus porttitor ac. Maecenas mattis est malesuada, feugiat dui eu, ultricies nulla. Etiam efficitur leo et tincidunt bibendum. Sed dapibus blandit mauris varius finibus. Proin eros diam, viverra sed finibus vel, dignissim at arcu. Sed dignissim justo volutpat est tincidunt vestibulum. Nullam aliquam nec leo eu venenatis.', 2, NULL),
(5, 'lala', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In lacinia dui at consectetur gravida. Quisque scelerisque scelerisque lobortis. Curabitur tempus arcu vitae molestie auctor. Quisque et nisl porttitor, venenatis quam vehicula, commodo purus. Vestibulum at consequat turpis. Nulla gravida mattis cursus. Praesent venenatis velit mauris, et condimentum nibh vehicula quis. Donec in porttitor augue, id elementum magna. Ut condimentum enim ut iaculis finibus. Donec at magna et nisl convallis tempus ac vitae felis. Morbi eget lorem vitae mauris volutpat posuere eu in neque. Duis nec arcu ut nisi convallis mattis. Curabitur ac pellentesque enim. Ut pulvinar dictum quam, ut mattis est ultricies quis. Aenean tempus porttitor ornare. Sed bibendum, elit tempus auctor convallis, nisl nunc imperdiet nunc, a porttitor turpis odio sed orci. Vestibulum in ante sed risus gravida fermentum. Fusce tincidunt augue ac dolor molestie vestibulum. Fusce pulvinar, arcu id sagittis luctus, orci tellus feugiat urna, a dictum magna dolor sit amet sem. In nulla nunc, auctor ac porta id, placerat sed urna. Fusce vel quam in est varius ullamcorper eget vel ligula. Sed sollicitudin felis elit, vitae pellentesque metus porttitor ac. Maecenas mattis est malesuada, feugiat dui eu, ultricies nulla. Etiam efficitur leo et tincidunt bibendum. Sed dapibus blandit mauris varius finibus. Proin eros diam, viverra sed finibus vel, dignissim at arcu. Sed dignissim justo volutpat est tincidunt vestibulum. Nullam aliquam nec leo eu venenatis.', 2, NULL),
(6, 'le', 'le', 2, NULL),
(7, 'me', 'me', 2, NULL),
(8, 'me', 'meeee', 2, '6bd8511d965be6266685856d08ed8d32.jpg');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `comments`
--

CREATE TABLE `comments` (
  `com_id` int(11) NOT NULL,
  `com_c_id` int(11) NOT NULL,
  `com_u_id` int(11) NOT NULL,
  `com_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Data dump for tabellen `comments`
--

INSERT INTO `comments` (`com_id`, `com_c_id`, `com_u_id`, `com_content`) VALUES
(1, 4, 2, 'lellelel'),
(2, 4, 2, 'lellelelelelele'),
(3, 4, 2, 'i dunno'),
(4, 4, 2, 'lelel'),
(5, 4, 2, 'hsh sdsd \' \" # / /* */ '),
(6, 7, 2, 'flfllf'),
(7, 4, 3, 'mememe');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `u_email` varchar(200) NOT NULL,
  `u_password` varchar(255) NOT NULL,
  `u_first_name` varchar(50) NOT NULL,
  `u_last_name` varchar(50) NOT NULL,
  `token` varchar(255) NOT NULL,
  `u_active` tinyint(1) NOT NULL DEFAULT '0',
  `points` int(11) NOT NULL DEFAULT '10',
  `u_pic` varchar(200) NOT NULL DEFAULT 'sp.jpg',
  `u_color` varchar(7) NOT NULL DEFAULT '#000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Data dump for tabellen `users`
--

INSERT INTO `users` (`u_id`, `u_email`, `u_password`, `u_first_name`, `u_last_name`, `token`, `u_active`, `points`, `u_pic`, `u_color`) VALUES
(2, 'silvermaster13@gmail.com', '$2y$10$F3N6HOWWJE13q7vwGK6k0u9XDsKA69YbuSEt3zbbhnlgIWXDpHIKK', 'Oliver', 'Nybo', '86e3e2b523db4d49c609e636f065c0db', 1, 10, 'sp.jpg', '#ff0000'),
(3, 'silvertest13@gmail.com', '$2y$10$ue2JM3KY2rol3VrXf/n8rOo6XQm44MZPwrxQlSB009viSY2ikDQTa', 'a', 'a', 'e23ae7a246e9335a2b5cc888fc07d276', 1, 10, 'sp.jpg', '#000');

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `cases`
--
ALTER TABLE `cases`
  ADD PRIMARY KEY (`c_id`);

--
-- Indeks for tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`com_id`);

--
-- Indeks for tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `cases`
--
ALTER TABLE `cases`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Tilføj AUTO_INCREMENT i tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Tilføj AUTO_INCREMENT i tabel `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
