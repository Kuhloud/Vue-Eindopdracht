-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Gegenereerd op: 15 jun 2024 om 16:50
-- Serverversie: 11.1.3-MariaDB-1:11.1.3+maria~ubu2204
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `developmentdb`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `boards`
--

CREATE TABLE `boards` (
  `board_id` int(11) NOT NULL,
  `board_name` varchar(255) NOT NULL,
  `board_description` varchar(255) NOT NULL,
  `total_threads` int(11) NOT NULL DEFAULT 0,
  `total_messages` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `boards`
--

INSERT INTO `boards` (`board_id`, `board_name`, `board_description`, `total_threads`, `total_messages`) VALUES
(1, 'Schoolwerk', 'Discussies over schoolwerk en huiswerk.', 0, 0),
(2, 'Off-Topic', 'Memes, muziek, en andere ongerelateerde onderwerpen.', 0, 0),
(3, 'ChatGPT', 'Discussies over hoe je kan slagen met zo min mogelijk moeite.', 0, 0),
(4, 'Web-Design-Haat', 'Dit is letterlijk Jojo\'s Nineteen Eighty-Four.', 0, 0),
(5, 'Test-Berichten', 'Hier kun je test berichten posten.', 34, 5);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `posted_at` datetime NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `posts`
--

INSERT INTO `posts` (`post_id`, `thread_id`, `user_id`, `message`, `posted_at`) VALUES
(1, 2, 1, 'Zesty', '2024-04-07 18:07:45'),
(2, 3, 1, 'as', '2024-04-07 18:12:15'),
(3, 4, 1, 'xcxc', '2024-04-07 21:14:51'),
(4, 2, 2, 'Hesty', '2024-06-15 14:52:14'),
(5, 2, 2, 'Resty', '2024-06-15 15:03:55');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tags`
--

CREATE TABLE `tags` (
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `tags`
--

INSERT INTO `tags` (`tag_id`, `tag_name`) VALUES
(1, 'Esty'),
(2, 'Taggies'),
(3, 'Java'),
(4, 'Tag'),
(5, 'Nederlands'),
(6, 'Test'),
(7, 'Message'),
(8, 'Banaan'),
(9, 'Bericht'),
(10, 'Werkt'),
(11, 'testing'),
(12, 'testinging');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `threads`
--

CREATE TABLE `threads` (
  `thread_id` int(11) NOT NULL,
  `board_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `first_post` text NOT NULL,
  `replies` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT curdate(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `threads`
--

INSERT INTO `threads` (`thread_id`, `board_id`, `title`, `first_post`, `replies`, `created_at`, `user_id`) VALUES
(1, 5, 'TestTitle', 'TestPost', 0, '2024-04-07 18:01:21', 1),
(2, 5, 'Testy', 'Zesty', 3, '2024-04-07 18:07:45', 1),
(3, 5, 'asd', 'as', 1, '2024-04-07 18:12:15', 1),
(4, 5, 'Jsavs', 'xcxc', 1, '2024-04-07 21:14:51', 1),
(5, 5, 'dfsa', 'wer', 0, '2024-06-12 14:24:46', 1),
(6, 5, 'weds', 'wer', 0, '2024-06-12 14:24:47', 1),
(7, 5, 'Het WERKT', 'Lekker', 0, '2024-06-12 14:26:36', 1),
(8, 5, 'Tag Test', 'Testings', 0, '2024-06-14 15:43:46', 1),
(9, 5, 'Tesfg', 'Testor', 0, '2024-06-14 19:56:17', 1),
(10, 5, 'dsde', 'Testr', 0, '2024-06-14 19:58:28', 1),
(11, 5, 'Tfdg', 'Testor23', 0, '2024-06-14 19:58:47', 1),
(12, 5, 'Why', 'idk', 0, '2024-06-14 20:13:56', 1),
(13, 5, 'Tesd', 'erg', 0, '2024-06-14 20:16:11', 1),
(14, 5, 'Tag Test 3', 'Working now?', 0, '2024-06-14 20:34:42', 1),
(15, 5, 'Tesdf', 'gfdew', 0, '2024-06-14 20:36:46', 1),
(16, 5, 'pls Tags', 'Testing again', 0, '2024-06-15 07:38:16', 1),
(17, 5, 'Tag Test 4', 'Testing tags', 0, '2024-06-15 07:43:15', 1),
(18, 5, 'Maybe', 'maybe', 0, '2024-06-15 07:52:13', 1),
(19, 5, 'tags gefixt', 'Ik begrijp nu waarom, denk ik', 0, '2024-06-15 07:56:18', 1),
(20, 5, 'Tehest', 'Tefs', 0, '2024-06-15 08:03:17', 1),
(21, 5, 'Insom test', 'Insomnia', 0, '2024-06-15 09:41:49', 1),
(22, 5, 'Teste', 'Teasft', 0, '2024-06-15 10:24:09', 1),
(23, 5, 'taegts', 'hbfdf', 0, '2024-06-15 10:25:29', 1),
(24, 5, 'hfdffdgfdasss', 'Tedgesd', 0, '2024-06-15 10:28:21', 1),
(25, 5, 'Tfddggg', 'Tewssss', 0, '2024-06-15 10:31:39', 1),
(26, 5, 'trhhh', 'fdsjdfdf', 0, '2024-06-15 10:43:03', 1),
(27, 5, 'trhhh', 'fdsjdfdf', 0, '2024-06-15 10:43:41', 1),
(28, 5, 'Tag Test 5', 'Ik had function op private staan, terwijl het op public moest', 0, '2024-06-15 10:48:14', 1),
(29, 5, 'lhlhlylylh', 'fdggh', 0, '2024-06-15 10:58:04', 1),
(30, 5, 'yyyyyyyyyyyy', 'gghhhhhhhhh', 0, '2024-06-15 11:00:34', 1),
(31, 5, 'ttyhhn', 'gggg', 0, '2024-06-15 11:04:18', 1),
(32, 5, 'Insommmi teste', 'Bruhsomnia', 0, '2024-06-15 11:05:12', 1),
(33, 5, 'ff kijken', 'Het werkt nu, denk ik', 0, '2024-06-15 12:01:57', 2),
(34, 5, 'Nog een test', 'Gee', 0, '2024-06-15 12:07:10', 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `thread_tags`
--

CREATE TABLE `thread_tags` (
  `thread_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `thread_tags`
--

INSERT INTO `thread_tags` (`thread_id`, `tag_id`) VALUES
(2, 1),
(3, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(24, 2),
(4, 3),
(28, 5),
(28, 6),
(34, 6),
(34, 11),
(34, 12);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `joined_at` datetime NOT NULL DEFAULT curdate(),
  `role_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `joined_at`, `role_id`) VALUES
(1, 'TestMan1', 'Test_Man@hotmail.com', '$2y$10$BwsWY8TuQcGkJ0jJ1iOBvubQSY0m9l33WDhs61mJnBcN3itUSXolq', '2024-02-04 17:38:56', 1),
(2, 'Normal User', 'normal@hotmail.com', '$2y$10$/o8adMcCz/bBpxePAXUXl.nef41f/WDVeBB5gP0qDbmxmQvmC3m42', '2024-04-08 12:46:31', 1),
(4, 'test', 'test@gmail.com', '$2y$10$0zKo4plkqe0CeF7txupdIe.PtELH3YFdyIlzfbWJJgymSxNX3scpu', '2024-04-14 07:24:34', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_roles`
--

CREATE TABLE `user_roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `user_roles`
--

INSERT INTO `user_roles` (`role_id`, `role_name`) VALUES
(1, 'Member'),
(2, 'Moderator'),
(3, 'Administrator');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `boards`
--
ALTER TABLE `boards`
  ADD PRIMARY KEY (`board_id`);

--
-- Indexen voor tabel `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `thread_id` (`thread_id`),
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- Indexen voor tabel `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexen voor tabel `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`thread_id`),
  ADD KEY `board_id` (`board_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexen voor tabel `thread_tags`
--
ALTER TABLE `thread_tags`
  ADD PRIMARY KEY (`thread_id`,`tag_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`) USING BTREE,
  ADD KEY `role_id` (`role_id`);

--
-- Indexen voor tabel `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `boards`
--
ALTER TABLE `boards`
  MODIFY `board_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT voor een tabel `threads`
--
ALTER TABLE `threads`
  MODIFY `thread_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`thread_id`) REFERENCES `threads` (`thread_id`),
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Beperkingen voor tabel `threads`
--
ALTER TABLE `threads`
  ADD CONSTRAINT `fk_threads_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `threads_ibfk_1` FOREIGN KEY (`board_id`) REFERENCES `boards` (`board_id`);

--
-- Beperkingen voor tabel `thread_tags`
--
ALTER TABLE `thread_tags`
  ADD CONSTRAINT `thread_tags_ibfk_1` FOREIGN KEY (`thread_id`) REFERENCES `threads` (`thread_id`),
  ADD CONSTRAINT `thread_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`);

--
-- Beperkingen voor tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
