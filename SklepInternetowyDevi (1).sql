-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Lip 10, 2024 at 11:06 AM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `SklepInternetowyDevi`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Admin`
--

CREATE TABLE `Admin` (
  `id` int(11) NOT NULL,
  `login` varchar(40) NOT NULL,
  `haslo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `informacje`
--

CREATE TABLE `informacje` (
  `id_info` int(11) NOT NULL,
  `informacja_opis` text NOT NULL,
  `nazwa_firmy` varchar(50) NOT NULL,
  `miasto` varchar(50) NOT NULL,
  `kod_pocztowy` varchar(50) NOT NULL,
  `ulica` varchar(50) NOT NULL,
  `numer_telefonu` varchar(20) NOT NULL,
  `kod_nip` varchar(50) NOT NULL,
  `dni_otwarcia` varchar(50) NOT NULL,
  `godziny_otwarcia` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Klienci`
--

CREATE TABLE `Klienci` (
  `id_klienta` int(11) NOT NULL,
  `imie` varchar(40) NOT NULL,
  `nazwisko` varchar(40) NOT NULL,
  `telefon` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `miasto` varchar(50) NOT NULL,
  `ulica` varchar(100) NOT NULL,
  `kod_pocztowy` varchar(20) NOT NULL,
  `dodatkowe_informacje` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Laptopy`
--

CREATE TABLE `Laptopy` (
  `id_produktu` int(11) NOT NULL,
  `producent` varchar(50) NOT NULL,
  `nazwa` varchar(50) NOT NULL,
  `procesor` varchar(50) NOT NULL,
  `procesor_sz` varchar(50) NOT NULL,
  `ram` varchar(50) NOT NULL,
  `grafika` varchar(50) NOT NULL,
  `dysk` varchar(50) NOT NULL,
  `klawiatura` varchar(50) NOT NULL,
  `przekatna` float NOT NULL,
  `rozdzielczosc` varchar(50) NOT NULL,
  `matryca` varchar(50) NOT NULL,
  `system` varchar(50) NOT NULL,
  `porty` varchar(50) NOT NULL,
  `komunikacja` varchar(50) NOT NULL,
  `multimedia` varchar(50) NOT NULL,
  `stan` varchar(50) NOT NULL,
  `czas_pracy` varchar(50) NOT NULL,
  `zasilacz` varchar(50) NOT NULL,
  `opis` varchar(50) NOT NULL,
  `cena` float NOT NULL,
  `ilosc` varchar(50) NOT NULL,
  `miniatura` varchar(50) NOT NULL,
  `miniatura_nazwa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Zamówienia`
--

CREATE TABLE `Zamówienia` (
  `id_zamowienia` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `id_klienta` int(11) NOT NULL,
  `data_zamowienia` date NOT NULL,
  `cena_calkowita` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Zdjęcia`
--

CREATE TABLE `Zdjęcia` (
  `id_zdjecia` int(11) NOT NULL,
  `id_produktu` int(11) NOT NULL,
  `sciezka` varchar(100) NOT NULL,
  `nazwa` varchar(50) NOT NULL,
  `typ` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `informacje`
--
ALTER TABLE `informacje`
  ADD PRIMARY KEY (`id_info`);

--
-- Indeksy dla tabeli `Klienci`
--
ALTER TABLE `Klienci`
  ADD PRIMARY KEY (`id_klienta`);

--
-- Indeksy dla tabeli `Laptopy`
--
ALTER TABLE `Laptopy`
  ADD PRIMARY KEY (`id_produktu`);

--
-- Indeksy dla tabeli `Zamówienia`
--
ALTER TABLE `Zamówienia`
  ADD PRIMARY KEY (`id_zamowienia`);

--
-- Indeksy dla tabeli `Zdjęcia`
--
ALTER TABLE `Zdjęcia`
  ADD PRIMARY KEY (`id_zdjecia`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
