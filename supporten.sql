-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Vært: localhost:3306
-- Genereringstid: 23. 03 2018 kl. 10:44:25
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
  `c_image` varchar(100) DEFAULT NULL,
  `token` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Data dump for tabellen `cases`
--

INSERT INTO `cases` (`c_id`, `c_title`, `c_content`, `c_owner`, `c_image`, `token`) VALUES
(9, 'kage', 'jeg vil ha kage', 2, NULL, '95b207776f409c88f80cdd383f284e39'),
(10, 'le', 'lelel', 3, NULL, '9b3064ff76e573c89d547e13314674df'),
(11, 'fml', 'fml', 3, NULL, 'c5fe47ee2626db7bcc2fde33dfaca07e'),
(12, 'me', 'me', 3, NULL, '45da750127111487122dd75dd50ccee8'),
(13, 'me', 'me', 3, NULL, '0a71548bd9b63ccbd1df65540d0995ae'),
(14, 'me2', 'me2', 3, NULL, 'cceb6d16c5b25213d27318e0afda80cb'),
(15, 'd', 'æøå', 3, NULL, '4710f5faed8f88ddea2b32dbb59618dd'),
(16, 'me', 'meæøå', 3, NULL, '1408cad86104c56f524a154e48bca251'),
(17, 'm', '&lt;', 3, NULL, 'bff7cff667297b96c610d47b7a9b0952');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `comments`
--

CREATE TABLE `comments` (
  `com_id` int(11) NOT NULL,
  `com_c_id` int(11) NOT NULL,
  `com_u_id` int(11) NOT NULL,
  `com_content` text NOT NULL,
  `token` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Data dump for tabellen `comments`
--

INSERT INTO `comments` (`com_id`, `com_c_id`, `com_u_id`, `com_content`, `token`) VALUES
(9, 9, 2, 'det vil jeg også', '19d6e5ed33e6699082b1d86d64fc671a'),
(10, 9, 3, 'ememe', '26b4b131416a43fbbb26a597e4d4f59d'),
(11, 9, 3, 'me', '26bc469ef11af35a9128b463457a5b58'),
(12, 11, 3, 'me2', '8fbd5ec34ebc18702bcb0710d75a5703');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `solved`
--

CREATE TABLE `solved` (
  `s_id` int(11) NOT NULL,
  `s_solved` tinyint(1) NOT NULL DEFAULT '0',
  `s_c_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Data dump for tabellen `solved`
--

INSERT INTO `solved` (`s_id`, `s_solved`, `s_c_id`) VALUES
(11, 1, 11),
(12, 1, 17),
(17, 1, 9);

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
(2, 'silvermaster13@gmail.com', '$2y$10$F3N6HOWWJE13q7vwGK6k0u9XDsKA69YbuSEt3zbbhnlgIWXDpHIKK', 'Oliver', 'Nybo', '86e3e2b523db4d49c609e636f065c0db', 1, 99999, 'sp.jpg', '#ff0000'),
(3, 'silvertest13@gmail.com', '$2y$10$ue2JM3KY2rol3VrXf/n8rOo6XQm44MZPwrxQlSB009viSY2ikDQTa', 'a', 'a', 'e23ae7a246e9335a2b5cc888fc07d276', 1, 20, 'sp.jpg', '#000');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `votes`
--

CREATE TABLE `votes` (
  `v_id` int(11) NOT NULL,
  `token` varchar(40) NOT NULL,
  `v_u_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Data dump for tabellen `votes`
--

INSERT INTO `votes` (`v_id`, `token`, `v_u_id`) VALUES
(2, '95b207776f409c88f80cdd383f284e39', 2),
(19, '95b207776f409c88f80cdd383f284e39', 3),
(21, 'c5fe47ee2626db7bcc2fde33dfaca07e', 3),
(22, '4710f5faed8f88ddea2b32dbb59618dd', 3);

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
-- Indeks for tabel `solved`
--
ALTER TABLE `solved`
  ADD PRIMARY KEY (`s_id`);

--
-- Indeks for tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- Indeks for tabel `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`v_id`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `cases`
--
ALTER TABLE `cases`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- Tilføj AUTO_INCREMENT i tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Tilføj AUTO_INCREMENT i tabel `solved`
--
ALTER TABLE `solved`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- Tilføj AUTO_INCREMENT i tabel `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Tilføj AUTO_INCREMENT i tabel `votes`
--
ALTER TABLE `votes`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
