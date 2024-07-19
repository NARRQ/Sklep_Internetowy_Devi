-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 24 Lis 2021, 22:38
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `kielark_projekt`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `articles`
--

CREATE TABLE `articles` (
  `id_art` int(10) NOT NULL,
  `title` varchar(40) NOT NULL,
  `content` longtext NOT NULL,
  `id_author` int(11) NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `articles`
--

INSERT INTO `articles` (`id_art`, `title`, `content`, `id_author`, `create_date`) VALUES
(6, '456', '456', 0, '0000-00-00'),
(7, 'r', 'r', 0, '0000-00-00'),
(8, 'ert', 'ert\r\nlorim', 3, '0000-00-00'),
(9, 'lorem', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse faucibus purus mauris, in blandit enim iaculis quis. Nunc vitae sem lobortis, tincidunt augue sed, faucibus ante. Sed congue lectus quis ex feugiat, eu eleifend arcu auctor. Fusce lacus nisi, molestie id sagittis id, tempor sit amet ipsum. Suspendisse consectetur tristique sem, quis fringilla justo. Cras iaculis eleifend lacus, ac aliquam quam posuere et. Suspendisse a lectus libero. Proin auctor tellus vel vulputate lacinia. In odio libero, finibus non molestie nec, varius vitae erat. Pellentesque fermentum fermentum felis vel sollicitudin. Sed laoreet, elit eget fermentum scelerisque, purus turpis bibendum leo, id sollicitudin nunc sapien quis magna. Vivamus pretium dolor ligula, sit amet imperdiet urna tempor sed.', 4, '0000-00-00'),
(11, 'dom', 'dom', 2, '0000-00-00'),
(13, 'jaskldj', 'hhdfakasd1244qwe', 7, '0000-00-00'),
(14, 'asd', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse faucibus purus mauris, in blandit enim iaculis quis. Nunc vitae sem lobortis, tincidunt augue sed, faucibus ante. Sed congue lectus quis ex feugiat, eu eleifend arcu auctor. Fusce lacus nisi, molestie id sagittis id, tempor sit amet ipsum. Suspendisse consectetur tristique sem, quis fringilla justo. Cras iaculis eleifend lacus, ac aliquam quam posuere et. Suspendisse a lectus libero. Proin auctor tellus vel vulputate lacinia. In odio libero, finibus non molestie nec, varius vitae erat. Pellentesque fermentum fermentum felis vel sollicitudin. Sed laoreet, elit eget fermentum scelerisque, purus turpis bibendum leo, id sollicitudin nunc sapien quis magna. Vivamus pretium dolor ligula, sit amet imperdiet urna tempor sed.', 7, '0000-00-00'),
(15, 'aklasdj', 'lorem', 6, '0000-00-00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `authors`
--

CREATE TABLE `authors` (
  `Id_author` int(11) NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Login` varchar(40) NOT NULL,
  `author_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `authors`
--

INSERT INTO `authors` (`Id_author`, `Name`, `Login`, `author_password`) VALUES
(5, 'admin', 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918'),
(6, 'a', 'a', 'ca978112ca1bbdcafac231b39a23dc4da786eff8147c4e72b9807785afee48bb'),
(7, 'b', 'b', '3e23e8160039594a33894f6564e1b1348bbd7a0088d42c4acb73eeaed59c009d'),
(8, '', '', 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855'),
(9, 's', 's', '043a718774c572bd8a25adbeb1bfcd5c0256ae11cecf9f9c3f925d0e52beaf89');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id_art`);

--
-- Indeksy dla tabeli `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`Id_author`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `articles`
--
ALTER TABLE `articles`
  MODIFY `id_art` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT dla tabeli `authors`
--
ALTER TABLE `authors`
  MODIFY `Id_author` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
