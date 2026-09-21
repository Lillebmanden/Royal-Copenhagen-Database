-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Vært: 127.0.0.1
-- Genereringstid: 21. 09 2026 kl. 12:42:03
-- Serverversion: 10.4.32-MariaDB
-- PHP-version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `royal`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `bruger`
--

CREATE TABLE `bruger` (
  `Medlemsnummer` int(11) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Brugernavn` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Data dump for tabellen `bruger`
--

INSERT INTO `bruger` (`Medlemsnummer`, `Password`, `Brugernavn`) VALUES
(1, 'Password1234', 'lilleB');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `har_lavet`
--

CREATE TABLE `har_lavet` (
  `Produktionsnumre` int(11) NOT NULL,
  `Kunstnernumre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Data dump for tabellen `har_lavet`
--

INSERT INTO `har_lavet` (`Produktionsnumre`, `Kunstnernumre`) VALUES
(1, 1),
(2, 3),
(2, 1),
(3, 2),
(4, 2),
(5, 3),
(6, 1),
(6, 2),
(6, 3);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `kunst`
--

CREATE TABLE `kunst` (
  `Navn` varchar(30) NOT NULL,
  `Efternavn` varchar(30) NOT NULL,
  `Kunstnernumre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Data dump for tabellen `kunst`
--

INSERT INTO `kunst` (`Navn`, `Efternavn`, `Kunstnernumre`) VALUES
('Rasmus', 'Berlin', 1),
('Søren', 'Rasmusen', 2),
('Mark', 'Moore', 3);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `medlem`
--

CREATE TABLE `medlem` (
  `Navn` varchar(30) NOT NULL,
  `Efternavn` varchar(30) NOT NULL,
  `Status` varchar(20) NOT NULL,
  `Medlemsnummer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Data dump for tabellen `medlem`
--

INSERT INTO `medlem` (`Navn`, `Efternavn`, `Status`, `Medlemsnummer`) VALUES
('Bertil', 'Larsen', 'Uverificeret', 1),
('Holden', 'Andersen', 'Admin', 2),
('Emil', 'Sørensen', 'Ejer', 3);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `serv`
--

CREATE TABLE `serv` (
  `Produktionsnummer` int(11) NOT NULL,
  `Navn` varchar(30) NOT NULL,
  `Type` varchar(20) NOT NULL,
  `Pris` float NOT NULL,
  `Farve` varchar(15) NOT NULL,
  `Medlemsnummer` int(11) NOT NULL,
  `Stelnummer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Data dump for tabellen `serv`
--

INSERT INTO `serv` (`Produktionsnummer`, `Navn`, `Type`, `Pris`, `Farve`, `Medlemsnummer`, `Stelnummer`) VALUES
(1, 'Ultra koppen', 'Kop', 4500, 'Blå', 3, 1),
(2, 'Den trælse kop', 'Kop', 0, 'Sort', 0, 2),
(3, 'Rund tallerken', 'Tallerken', 2100, 'Blå', 1, 1),
(4, 'Urund tallerken', 'Tallerken', 2150, 'Grøn', 2, 2),
(5, 'Vandkanden', 'Kande', 1200, 'Grøn', 2, 1),
(6, 'Måge koppen', 'Kop', 92000, 'Orange', 3, 1);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `stel`
--

CREATE TABLE `stel` (
  `Navn` varchar(30) NOT NULL,
  `Stelnummer` int(11) NOT NULL,
  `Årgang` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Data dump for tabellen `stel`
--

INSERT INTO `stel` (`Navn`, `Stelnummer`, `Årgang`) VALUES
('Det Facy stel', 1, '0000'),
('Pøbbel stellet', 2, '2026');

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `kunst`
--
ALTER TABLE `kunst`
  ADD PRIMARY KEY (`Kunstnernumre`);

--
-- Indeks for tabel `medlem`
--
ALTER TABLE `medlem`
  ADD PRIMARY KEY (`Medlemsnummer`);

--
-- Indeks for tabel `serv`
--
ALTER TABLE `serv`
  ADD PRIMARY KEY (`Produktionsnummer`);

--
-- Indeks for tabel `stel`
--
ALTER TABLE `stel`
  ADD PRIMARY KEY (`Stelnummer`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `kunst`
--
ALTER TABLE `kunst`
  MODIFY `Kunstnernumre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tilføj AUTO_INCREMENT i tabel `medlem`
--
ALTER TABLE `medlem`
  MODIFY `Medlemsnummer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
