-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Lip 23, 2024 at 12:39 PM
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
-- Database: `sklepinternetowydevi`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admin`
--

CREATE TABLE `admin` (
  `id_admina` int(11) NOT NULL,
  `login` varchar(40) NOT NULL,
  `haslo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admina`, `login`, `haslo`) VALUES
(1, 'admin@gmail.com', 'qaz@WSX');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dostawa`
--

CREATE TABLE `dostawa` (
  `id_dostawy` int(2) UNSIGNED NOT NULL,
  `nazwa` varchar(255) NOT NULL,
  `cena_dostawy` decimal(10,2) UNSIGNED NOT NULL,
  `podziekowanie_opis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dostawa`
--

INSERT INTO `dostawa` (`id_dostawy`, `nazwa`, `cena_dostawy`, `podziekowanie_opis`) VALUES
(1, 'Odbiór osobisty z płatnością przy odbiorze\r\n(ul. ks. J. Popiełuszki 20a/53a 35-328 Rzeszów)', 0.00, 'Potwierdzenie zamówienia i jego szczegóły wyślemy Ci na e-mail.\r\n\r\nProsimy o odebranie zamówienia w sklepie w ciągu <b>48h</b>\r\nPo tym czasie zamówienie zostanie <u>automatycznie anulowane</u>.'),
(2, 'Przesyłka kurierska i przelew na nr konta ', 20.00, 'Potwierdzenie zamówienia, jego szczegóły i <u>szczegóły do płatności</u> wyślemy Ci na e-mail.\r\n\r\nProsimy o dokonanie płatności w ciągu <b>48h</b>, w innym przypadku zamówienie zostanie <u>anulowane</u>.\r\n\r\n<u>Po dokonaniu płatności</u> przesyłka zostanie wysłana w ciągu najbliższych <b>5 dni roboczych</b>.'),
(3, 'Przesyłka kurierska za pobraniem', 25.00, 'Potwierdzenie zamówienia i jego szczegóły wyślemy ci na e-mail.\r\n\r\nPrzesyłka zostanie wysłana w ciągu najbliższych <b>5 dni roboczych</b>.');

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
  `godziny_otwarcia` varchar(50) NOT NULL,
  `email` varchar(350) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `informacje`
--

INSERT INTO `informacje` (`id_info`, `informacja_opis`, `nazwa_firmy`, `miasto`, `kod_pocztowy`, `ulica`, `numer_telefonu`, `kod_nip`, `dni_otwarcia`, `godziny_otwarcia`, `email`) VALUES
(1, 'Na tej stronie możesz zobaczyć oferowane przez nas laptopy poleasingowe. \r\n\r\nMasz możliwość zamówić interesujący Cię laptop, aby w przeciągu 48h po złożeniu zamówienia przyjść do naszego sklepu, zapłacić i go odebrać.\r\nMożesz także wybrać przesyłkę kurierską.\r\n\r\n<b>Warunki gwarancji:</b>\r\n\r\nOkres gwarancji: Gwarancja obejmuje okres 2 lat od daty zakupu laptopa.\r\n\r\nZakres gwarancji: Gwarantujemy, że laptop będzie wolny od wad materiałowych i fabrycznych w normalnych warunkach użytkowania.\r\n\r\nSerwis gwarancyjny: W przypadku stwierdzenia wady, klient ma prawo do bezpłatnego naprawy lub wymiany uszkodzonych części przez autoryzowany serwis.\r\n\r\nWyłączenia: Gwarancja nie obejmuje uszkodzeń spowodowanych przez użytkownika, takich jak zalanie, uszkodzenia mechaniczne, uszkodzenia spowodowane nieprawidłowym użytkowaniem lub nieautoryzowaną modyfikacją.\r\n\r\nProcedura gwarancyjna:\r\n\r\nW celu skorzystania z gwarancji, klient powinien przedstawić dowód zakupu.\r\nLaptop musi być zwrócony w oryginalnym opakowaniu lub zapewnionym odpowiednim pakowaniu.\r\nKlient jest odpowiedzialny za koszty transportu w przypadku wysyłki laptopa do serwisu.\r\nOgraniczenia:\r\n\r\nGwarancja nie obejmuje oprogramowania, które nie jest częścią oryginalnej konfiguracji laptopa.\r\nGwarancja nie obejmuje kosztów związanych z utratą danych ani usunięciem danych z laptopa.\r\nInne postanowienia:\r\n\r\nGwarancja jest ważna tylko w kraju zakupu.\r\nGwarancja jest przenoszalna w przypadku sprzedaży laptopa, pod warunkiem zachowania oryginalnego dowodu zakupu.', 'Devi System', 'Rzeszów', '35-328', 'ks. Jerzego Popiełuszki', '669958485', '6861586654', 'pon - pt', '9.00 - 16.00', 'devikontakt@gmail.com');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klienci`
--

CREATE TABLE `klienci` (
  `id_klienta` int(11) NOT NULL,
  `imie` varchar(40) NOT NULL,
  `nazwisko` varchar(40) NOT NULL,
  `telefon` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `miasto` varchar(50) DEFAULT NULL,
  `ulica` varchar(100) DEFAULT NULL,
  `nr_lokalu` varchar(20) DEFAULT NULL,
  `kod_pocztowy` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `klienci`
--

INSERT INTO `klienci` (`id_klienta`, `imie`, `nazwisko`, `telefon`, `email`, `miasto`, `ulica`, `nr_lokalu`, `kod_pocztowy`) VALUES
(1, 'Jan', 'Kowalski', '123456789', 'jankowalski@wp.pl', 'Rzeszów', 'Cicha', '4', '35-326'),
(2, 'Karol', 'Nowak', '987654321', 'nowakkarol@gmail.com', 'Rzeszów', 'Kwiatowa', '2', '35-329'),
(3, 'Michał', 'Kowal', '120099731', 'kowalmich@wp.pl', 'Łańcut', 'Topolowa', '1', '39-327');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `laptopy`
--

CREATE TABLE `laptopy` (
  `id_laptopa` int(11) NOT NULL,
  `producent` varchar(50) NOT NULL,
  `nazwa` varchar(100) NOT NULL,
  `procesor` varchar(100) NOT NULL,
  `procesor_sz` varchar(255) NOT NULL,
  `ram` varchar(50) NOT NULL,
  `grafika` varchar(100) NOT NULL,
  `dysk` varchar(50) NOT NULL,
  `klawiatura` varchar(50) NOT NULL,
  `przekatna` decimal(5,2) NOT NULL,
  `rozdzielczosc` varchar(20) NOT NULL,
  `matryca` varchar(100) NOT NULL,
  `system` varchar(100) NOT NULL,
  `porty` varchar(255) NOT NULL,
  `komunikacja` varchar(255) NOT NULL,
  `multimedia` varchar(255) NOT NULL,
  `stan` varchar(100) NOT NULL,
  `czas_pracy` varchar(100) NOT NULL,
  `zasilacz` varchar(100) NOT NULL,
  `opis` text NOT NULL,
  `cena` decimal(10,2) UNSIGNED NOT NULL,
  `ilosc` int(11) UNSIGNED NOT NULL,
  `miniatura` varchar(255) NOT NULL,
  `miniatura_nazwa` varchar(100) NOT NULL,
  `czy_na_stronie` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laptopy`
--

INSERT INTO `laptopy` (`id_laptopa`, `producent`, `nazwa`, `procesor`, `procesor_sz`, `ram`, `grafika`, `dysk`, `klawiatura`, `przekatna`, `rozdzielczosc`, `matryca`, `system`, `porty`, `komunikacja`, `multimedia`, `stan`, `czas_pracy`, `zasilacz`, `opis`, `cena`, `ilosc`, `miniatura`, `miniatura_nazwa`, `czy_na_stronie`) VALUES
(1, 'HP', 'HP ProBook 450 G6', 'Intel Core i5', '8565U', '8 GB (DDR4, 2400 MHz)', 'Intel UHD Graphics 620', '256 GB', 'qwert', 15.60, '1920 x 1080 (Full HD', 'matowa', 'Microsoft Windows 11 Pro', 'USB 2.0 - 1 szt.\r\nUSB 3.2 Gen. 1 - 2 szt.\r\nUSB Typu-C (z DisplayPort) - 1 szt.\r\nHDMI - 1 szt.\r\nCzytnik kart pamięci SD - 1 szt.\r\nRJ-45 (LAN) - 1 szt.\r\nWyjście słuchawkowe/wejście mikrofonowe - 1 szt.\r\nDC-in (wejście zasilania) - 1 szt.', 'Wi-Fi, Bluetooth, Ethernet', 'Kamera, mikrofon, głośnik', 'Laptop poleasingowy, stan bardzo dobry', '8 godzin', 'Tak', '15-calowy HP ProBook 450 G6 to świetna propozycja dla biznesmenów; przestronny ekran, numeryczna klawiatura, a przede wszystkim zaawansowane funkcje zabezpieczeń, dzięki którym przechowywane na urządzeniu dane pozostaną bezpiecznie. ', 1699.00, 4, 'uploads/g6.png', 'g6.png', 1),
(2, 'HP ', 'HP ProBook 450 G3', 'Intel Core i5', '6200U', '16 GB DDR4', 'Intel HD Graphics 520', '256 GB', 'qwert', 15.60, '1920 x 1080', 'matowa', 'Windows 10 Pro', 'USB 2.0 - 2 szt.\r\nUSB 3.2 Gen. 1 - 2 szt.\r\nHDMI - 1 szt.\r\nCzytnik kart pamięci SD - 1 szt.\r\nVGA (D-sub) - 1 szt.\r\nRJ-45 (LAN) - 1 szt.\r\nWyjście słuchawkowe/wejście mikrofonowe - 1 szt.\r\nDC-in (wejście zasilania) - 1 szt.', 'Wi-Fi, Bluetooth, Ethernet', 'Kamera, głośnik, mikrofon', 'Laptop poleasingowy, stan bardzo dobry', 'Do 8 godzin', 'Tak', 'HP ProBook 450 G3 to laptop, który oferuje solidną wydajność w połączeniu z wyrazistym wyglądem. Z procesorem Intel i5 6. generacji 6200U, 8 GB RAM i szybkim dyskiem o pojemności 500 GB, ten model spełnia oczekiwania użytkowników biznesowych.', 1599.00, 4, 'uploads/hp_g31.png', 'hp_g31.png', 1),
(3, 'Dell', 'Dell Latitude 5490', 'Intel core i5', '7200U', '16 GB DDR4', 'Grafika zintegrowana, Intel HD 620', '256 GB', 'qwert', 14.10, '1920×1080', 'matowa', 'Windows 10 Home', 'USB 3.2 Gen. 1 – 3 szt.\r\nUSB Typu-C – 1 szt.\r\nHDMI – 1 szt.\r\nCzytnik kart pamięci SD – 1 szt.\r\nVGA (D-sub) – 1 szt.\r\nRJ-45 (LAN) – 1 szt.\r\nWyjście słuchawkowe/wejście mikrofonowe – 1 szt.\r\nCzytnik Smart Card – 1 szt.\r\nDC-in (wejście zasilania) – 1 szt.', 'Wi-Fi', 'Czytnik kart pamięci, Głośniki', '100 % sprawny', '8 godzin', 'Tak', 'Lekka i smukła konstrukcja ułatwia transport laptopa.\r\nDługi czas pracy baterii pozwala na pracę przez cały dzień bez konieczności ładowania.\r\nPodświetlana klawiatura umożliwia komfortowe pisanie w ciemnych pomieszczeniach.', 1899.00, 5, 'uploads/dell.png', 'dell.png', 1),
(4, 'MacBook', 'MacBook Air 13 A1932', 'Intel Core i5', '8210Y', '8 GB', 'Intel UHD Graphics 617', '256 GB', 'Butterfly (motylkowa)', 13.30, '2560 x 1600', 'Retina ', 'Oryginalny system operacyjny MacOS', 'USB 3.1 typ C, Thunderbolt, minijack 3,5 mm (audio)', 'Wi-Fi, Bluetooth', 'głośniki, kamera, mikrofon', '100 % sprawny', '8 godzin', 'Tak', 'Najpopular­niejszy Mac  zawróci Ci w głowie. Nowy MacBook Air jest smuklejszy, lżejszy i ma olśniewający wyświetlacz Retina, Touch ID, klawiaturę najnowszej generacji oraz gładzik Force Touch. Jego legendarna konstrukcja w kształcie klina jest wykonana z aluminium pochodzącego w 100 procentach z recyklingu, co czyni go najbardziej ekologicznym ze wszystkich Maców. Krótko mówiąc, MacBook Air to doskonały ultraprzenośny notebook do wszystkiego.', 1699.00, 6, 'uploads/mac1.webp', 'mac1.webp', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `lap_zamowienia`
--

CREATE TABLE `lap_zamowienia` (
  `id_zamowienia` int(11) NOT NULL,
  `id_laptopa` int(11) NOT NULL,
  `ilosc` int(11) UNSIGNED NOT NULL,
  `cena_razem` decimal(10,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lap_zamowienia`
--

INSERT INTO `lap_zamowienia` (`id_zamowienia`, `id_laptopa`, `ilosc`, `cena_razem`) VALUES
(1, 1, 1, 1699.00),
(2, 4, 1, 1699.00),
(3, 3, 1, 1899.00),
(4, 1, 1, 1111.00),
(1, 2, 1, 299.00);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

CREATE TABLE `zamowienia` (
  `id_zamowienia` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `id_klienta` int(11) NOT NULL,
  `data_zamowienia` datetime NOT NULL DEFAULT current_timestamp(),
  `dodatkowe_informacje` text DEFAULT NULL,
  `cena_calkowita` decimal(10,2) UNSIGNED NOT NULL,
  `id_dostawy` int(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zamowienia`
--

INSERT INTO `zamowienia` (`id_zamowienia`, `status`, `id_klienta`, `data_zamowienia`, `dodatkowe_informacje`, `cena_calkowita`, `id_dostawy`) VALUES
(1, 'W trakcie', 1, '2024-07-11 11:22:55', 'Odbiore 21.12.2024', 2000.00, 1),
(2, 'Nowy', 2, '2024-07-12 11:27:54', 'Prosze o kolor czarny', 1699.00, 2),
(3, 'Zakończony', 3, '2024-07-14 11:32:14', '', 1899.00, 3),
(4, 'Nowy', 1, '2024-07-22 18:55:42', NULL, 1111.00, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zdjecia`
--

CREATE TABLE `zdjecia` (
  `id_zdjecia` int(11) NOT NULL,
  `id_laptopa` int(11) NOT NULL,
  `sciezka` varchar(255) NOT NULL,
  `nazwa` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zdjecia`
--

INSERT INTO `zdjecia` (`id_zdjecia`, `id_laptopa`, `sciezka`, `nazwa`) VALUES
(1, 3, 'uploads/dell.png', 'dell.png'),
(2, 4, 'uploads/g66.jpg', 'g66.jpg');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admina`);

--
-- Indeksy dla tabeli `dostawa`
--
ALTER TABLE `dostawa`
  ADD PRIMARY KEY (`id_dostawy`);

--
-- Indeksy dla tabeli `informacje`
--
ALTER TABLE `informacje`
  ADD PRIMARY KEY (`id_info`);

--
-- Indeksy dla tabeli `klienci`
--
ALTER TABLE `klienci`
  ADD PRIMARY KEY (`id_klienta`);

--
-- Indeksy dla tabeli `laptopy`
--
ALTER TABLE `laptopy`
  ADD PRIMARY KEY (`id_laptopa`);

--
-- Indeksy dla tabeli `lap_zamowienia`
--
ALTER TABLE `lap_zamowienia`
  ADD KEY `id_zamowienia` (`id_zamowienia`,`id_laptopa`),
  ADD KEY `id_laptopa` (`id_laptopa`);

--
-- Indeksy dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD PRIMARY KEY (`id_zamowienia`),
  ADD KEY `id_klienta` (`id_klienta`),
  ADD KEY `id_dostawy` (`id_dostawy`);

--
-- Indeksy dla tabeli `zdjecia`
--
ALTER TABLE `zdjecia`
  ADD PRIMARY KEY (`id_zdjecia`),
  ADD KEY `id_produktu` (`id_laptopa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dostawa`
--
ALTER TABLE `dostawa`
  MODIFY `id_dostawy` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `informacje`
--
ALTER TABLE `informacje`
  MODIFY `id_info` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `klienci`
--
ALTER TABLE `klienci`
  MODIFY `id_klienta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `laptopy`
--
ALTER TABLE `laptopy`
  MODIFY `id_laptopa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `zamowienia`
--
ALTER TABLE `zamowienia`
  MODIFY `id_zamowienia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `zdjecia`
--
ALTER TABLE `zdjecia`
  MODIFY `id_zdjecia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dostawa`
--
ALTER TABLE `dostawa`
  ADD CONSTRAINT `dostawa_ibfk_1` FOREIGN KEY (`id_dostawy`) REFERENCES `zamowienia` (`id_dostawy`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `lap_zamowienia`
--
ALTER TABLE `lap_zamowienia`
  ADD CONSTRAINT `lap_zamowienia_ibfk_1` FOREIGN KEY (`id_zamowienia`) REFERENCES `zamowienia` (`id_zamowienia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lap_zamowienia_ibfk_2` FOREIGN KEY (`id_laptopa`) REFERENCES `laptopy` (`id_laptopa`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD CONSTRAINT `zamowienia_ibfk_1` FOREIGN KEY (`id_klienta`) REFERENCES `klienci` (`id_klienta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `zdjecia`
--
ALTER TABLE `zdjecia`
  ADD CONSTRAINT `zdjecia_ibfk_1` FOREIGN KEY (`id_laptopa`) REFERENCES `laptopy` (`id_laptopa`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
