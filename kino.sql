-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 28 Sty 2020, 10:39
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `kino`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `film`
--

CREATE TABLE `film` (
  `id_filmu` int(11) NOT NULL,
  `tytul` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `rezyser` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `opis` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `film`
--

INSERT INTO `film` (`id_filmu`, `tytul`, `rezyser`, `opis`) VALUES
(0, 'Matrix', 'Lilly Wachowski / Lana Wachowski ', 'Haker komputerowy Neo dowiaduje się od tajemniczych rebeliantów, że świat, w którym żyje, jest tylko obrazem przesyłanym do jego mózgu przez roboty.'),
(1, 'Toy Story 2', 'Ash Brannon / Lee Unkrich', 'Kontynuacja opowieści sprzed kilku lat, zrealizowanej techniką komputerową. Akcja toczy się w domu chłopca, jego zabawki żyją własnym życiem. Jedna z figurek, kowboj, zostaje uszkodzona. Przez przypadek kowboj trafia na wyprzedaż rzeczy używanych.'),
(2, 'Tytanic', 'James Cameron', 'W słoneczny, kwietniowy dzień w 1912 roku, na angielskim wybrzeżu arystokratyczna rodzina wraz z 17-letnią Rose (Kate Winslet) wchodzi na pokład Titanica, udając się w podróż do Stanów Zjednoczonych. '),
(3, 'Zmierzch', 'Catherine Hardwicke', 'Isabella Swan to szukająca swego miejsca w świecie, zagubiona nastolatka, cicha marzycielka. Kiedy poznaje przystojnego, błyskotliwego i intrygującego Edwarda Cullena, nie zdaje sobie sprawy, że znajomość ta wstrząśnie jej życiem i zmieni je na zawsze.');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `miejsca`
--

CREATE TABLE `miejsca` (
  `id` int(11) NOT NULL,
  `id_sali` int(11) NOT NULL,
  `rzad` int(11) NOT NULL,
  `nr_w_rzedzie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `repertuar`
--

CREATE TABLE `repertuar` (
  `id_repertuaru` int(11) NOT NULL,
  `id_filmu` int(50) NOT NULL,
  `id_sali` int(11) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `repertuar`
--

INSERT INTO `repertuar` (`id_repertuaru`, `id_filmu`, `id_sali`, `data`) VALUES
(1, 1, 1, '2020-02-29 08:00:00'),
(2, 2, 2, '2020-02-29 12:00:00'),
(3, 3, 3, '2020-02-29 19:00:00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rezerwacja`
--

CREATE TABLE `rezerwacja` (
  `id_rezerwacji` int(11) NOT NULL,
  `bilet` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ilosc_uczen_senior` int(11) NOT NULL,
  `ilosc_student` int(11) NOT NULL,
  `id_repertuaru` int(11) NOT NULL,
  `cena` double NOT NULL,
  `imie` varchar(25) COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` varchar(25) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `rezerwacja`
--

INSERT INTO `rezerwacja` (`id_rezerwacji`, `bilet`, `user_id`, `ilosc_uczen_senior`, `ilosc_student`, `id_repertuaru`, `cena`, `imie`, `nazwisko`) VALUES
(3, 1, 2, 1, 1, 3, 55, 'Adam', 'Nowak'),
(4, 0, 7, 0, 0, 3, 50, 'Konrad', 'Diusz'),
(5, 0, 7, 0, 1, 2, 37.5, 'Konrad', 'Diusz'),
(6, 0, 5, 0, 0, 2, 25, 'Marek', 'Karet'),
(7, 1, 1, 0, 0, 3, 25, 'Mateusz', 'Więch'),
(8, 0, 2, 0, 0, 3, 25, 'Arkadiusz', 'Kartacz');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rezerwacje_miejsca`
--

CREATE TABLE `rezerwacje_miejsca` (
  `id_rezerwacji` int(11) NOT NULL,
  `id_miejsca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `rezerwacje_miejsca`
--

INSERT INTO `rezerwacje_miejsca` (`id_rezerwacji`, `id_miejsca`) VALUES
(3, 89),
(3, 90),
(3, 91),
(4, 32),
(4, 33),
(5, 33),
(5, 34),
(6, 77),
(7, 92),
(8, 105);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sala`
--

CREATE TABLE `sala` (
  `id_sali` int(11) NOT NULL,
  `numer_sali` int(11) NOT NULL,
  `liczba_miejsc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `sala`
--

INSERT INTO `sala` (`id_sali`, `numer_sali`, `liczba_miejsc`) VALUES
(1, 1, 170),
(2, 2, 170),
(3, 3, 170);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `uprawnienia_administracyjne` tinyint(1) NOT NULL,
  `nick` text COLLATE utf8_polish_ci NOT NULL,
  `mail` text COLLATE utf8_polish_ci NOT NULL,
  `haslo` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `imie` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` varchar(255) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`user_id`, `uprawnienia_administracyjne`, `nick`, `mail`, `haslo`, `imie`, `nazwisko`) VALUES
(1, 2, 'cos', 'cos@mail.pl', 'test', 'Adam', 'Rape'),
(2, 0, 'cos2', 'cos2@mail.pl', 'test', 'Kamil', 'Miodek'),
(3, 1, 'cosP', 'cosP@mail.pl', 'test', 'Patryk', 'Rozwadek'),
(4, 1, 'Pani_z_okienka_1', 'anetka@kinourz.pl', 'test', 'Aneta', 'Zawada'),
(5, 0, 'Mareczek1', 'fdsa@wpl.pl', 'test', 'Marek', 'Warara'),
(6, 0, 'Tera13', 'lko@op.pl', 'test', 'Anna', 'Mariope'),
(7, 0, 'konridiusz', 'konridiusz@konridiusz.pl', 'test', 'Konrad', 'Diusz');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id_filmu`);

--
-- Indeksy dla tabeli `miejsca`
--
ALTER TABLE `miejsca`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `repertuar`
--
ALTER TABLE `repertuar`
  ADD PRIMARY KEY (`id_repertuaru`);

--
-- Indeksy dla tabeli `rezerwacja`
--
ALTER TABLE `rezerwacja`
  ADD PRIMARY KEY (`id_rezerwacji`);

--
-- Indeksy dla tabeli `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`id_sali`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT dla tabel zrzutów
--

--
-- AUTO_INCREMENT dla tabeli `film`
--
ALTER TABLE `film`
  MODIFY `id_filmu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `miejsca`
--
ALTER TABLE `miejsca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `repertuar`
--
ALTER TABLE `repertuar`
  MODIFY `id_repertuaru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `rezerwacja`
--
ALTER TABLE `rezerwacja`
  MODIFY `id_rezerwacji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `sala`
--
ALTER TABLE `sala`
  MODIFY `id_sali` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
