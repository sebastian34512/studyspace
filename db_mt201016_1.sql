-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: mysql5
-- Erstellungszeit: 24. Feb 2022 um 20:52
-- Server-Version: 5.7.33-0ubuntu0.16.04.1
-- PHP-Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `db_mt201016_1`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sp_Adressen`
--

CREATE TABLE `sp_Adressen` (
  `AdressenID` int(11) NOT NULL,
  `Postleitzahl` int(11) DEFAULT NULL,
  `Land` varchar(50) NOT NULL,
  `Ort` varchar(50) NOT NULL,
  `Strasse` varchar(50) NOT NULL,
  `Hausnummer` varchar(50) NOT NULL,
  `Stiege` varchar(50) DEFAULT NULL,
  `Tuer` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `sp_Adressen`
--

INSERT INTO `sp_Adressen` (`AdressenID`, `Postleitzahl`, `Land`, `Ort`, `Strasse`, `Hausnummer`, `Stiege`, `Tuer`) VALUES
(1, 1020, 'Austria', 'Wien', 'Praterstrasse', '7', '1', '5'),
(2, 1210, 'Austria', 'Wien', 'Franklinstrasse', '24', NULL, NULL),
(3, 1010, 'Austria', 'WIen', 'Filialstrasse', '1', NULL, NULL),
(4, 1220, 'Oesterreich', 'Wien', 'Hauptstrasse', '5', '5', '6'),
(5, 2342, 'asdfdsaf', 'gfdg', 'asdfa', '2', '3', '4'),
(6, 2000, 'Austria', 'Korneuburg', 'Schulstrasse', '1', '', ''),
(7, 1111, 'Test1', 'Test1', 'Test1', '1', '', ''),
(8, 2222, 'test2', 'test2', 'test2', '2', '', ''),
(9, 333, 'test3', 'test3', 'test3', '3', '', ''),
(10, 444, 'test4', 'test4', 'test4', '4', '', ''),
(11, 5555, 'test5', 'test5', 'test5', '5', '', ''),
(12, 6666, 'test6', 'test6', 'tset6', '6', '', ''),
(13, 434, 'gfdg', 'gdfgd', 'gfdgd', '3', '', ''),
(14, 32432, 'fsdaf', 'asdsd', 'sdafds', '3', '', ''),
(15, 23432, 'fasdf', 'dsads', 'fdsaf', '3', '', ''),
(16, 342, 'cyscsd', 'fdsaf', 'dsafsfd', '3', '', ''),
(17, 777, 'test7', 'test7', 'test7', '7', '', ''),
(18, 8888, 'test8', 'test8', 'test8', '8', '', ''),
(19, 435435, 'fdsaf', 'fdsafds', 'dsafsf', '324', '', ''),
(20, 2343, 'fdsaf', 'adsfasd', 'dfsadf', '23', '', ''),
(21, 32424, 'fdsfas', 'fasdf', 'fdsagf', '435', '', ''),
(22, 43534, 'gsdfg', 'gfsdg', 'gfsdg', '435', '', ''),
(23, 435435, 'gadsg', 'sgffdg', 'fdgfdg', '5345', '43', ''),
(24, 435, 'gffdg', 'dfgfsd', 'sadf', '23432', '', ''),
(25, 645645, 'fasdf', 'asdf', 'asfdsd', '45435', '', ''),
(26, 1200, 'Austria', 'Wien', 'Hauptstrasse', '2', '5', '21'),
(27, 1230, 'Austria', 'Wien', 'Poststrasse', '78', '', ''),
(28, 9999, 'test99', 'test99', 'test99', '99', '99', '99'),
(29, 888, 'test88', 'test888', 'test8', '8', '', ''),
(30, 1020, 'Austria', 'Wien', 'Taborstrasse', '5', '7', '78'),
(31, 7777, 'test77', 'test77', 'test77', '77', '', ''),
(32, 1030, 'Austria', 'Wien', 'Hauptstrasse', '8', '9', '1'),
(33, 1220, 'Austria', 'Wien', 'Schulstrasse', '8', '', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sp_Arbeitsstunden`
--

CREATE TABLE `sp_Arbeitsstunden` (
  `ArbeitszeitID` int(11) NOT NULL,
  `BesuchID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `sp_Arbeitsstunden`
--

INSERT INTO `sp_Arbeitsstunden` (`ArbeitszeitID`, `BesuchID`) VALUES
(1, 3),
(2, 4);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sp_Arbeitszeit`
--

CREATE TABLE `sp_Arbeitszeit` (
  `ArbeitszeitID` int(11) NOT NULL,
  `MitarbeiterID` int(11) NOT NULL,
  `ArbeitsbeginnSOLL` datetime NOT NULL,
  `ArbeitsendeSOLL` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `sp_Arbeitszeit`
--

INSERT INTO `sp_Arbeitszeit` (`ArbeitszeitID`, `MitarbeiterID`, `ArbeitsbeginnSOLL`, `ArbeitsendeSOLL`) VALUES
(1, 23, '2022-02-23 08:00:00', '2022-02-23 15:30:00'),
(2, 23, '2022-02-24 10:00:00', '2022-02-24 17:30:00'),
(3, 23, '2022-03-01 09:00:00', '2022-02-23 16:30:00'),
(4, 23, '2022-03-03 11:30:00', '2022-03-03 18:30:00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sp_Benutzer`
--

CREATE TABLE `sp_Benutzer` (
  `BenutzerID` int(11) NOT NULL,
  `Passwort` varchar(100) NOT NULL,
  `DatumRegistrierung` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `PersonID` int(11) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `sp_Benutzer`
--

INSERT INTO `sp_Benutzer` (`BenutzerID`, `Passwort`, `DatumRegistrierung`, `PersonID`, `email`) VALUES
(1, 'hallo', '2022-02-21 15:34:17', 1, 'hans@123.com'),
(2, 'tschau', '2022-02-21 15:34:17', 2, 'peter@567.at'),
(3, 'huhu', '2022-02-21 15:56:42', 3, 'brigitte@890.de'),
(4, 'Test1', '2022-02-22 17:41:38', 3, 'test1'),
(5, 'test2', '2022-02-22 18:07:18', 3, 'test2'),
(6, 'test3', '2022-02-22 18:08:06', 4, 'test3'),
(7, 'test4', '2022-02-22 19:02:41', 4, 'test4'),
(8, 'test5', '2022-02-22 19:03:38', 4, 'test5'),
(9, 'test6', '2022-02-22 19:05:07', 5, 'test6'),
(10, 'fdsaf', '2022-02-22 19:06:31', 6, 'hgfdh'),
(11, 'fdsafdsa', '2022-02-22 19:09:09', 7, 'fdasfd'),
(12, 'fdsfa', '2022-02-22 19:10:50', 8, 'dsafds'),
(13, 'fdsafd', '2022-02-22 19:11:40', 8, 'fdsaf'),
(14, 'test7', '2022-02-22 19:12:50', 9, 'test7'),
(15, 'test8', '2022-02-22 21:32:32', 10, 'test8'),
(16, 'fasdfasdf', '2022-02-22 21:34:21', 11, 'fdsfa'),
(17, 'fasdfsd', '2022-02-22 21:35:14', 12, 'fdsaf'),
(18, 'afdsdsf', '2022-02-22 21:36:16', 13, 'fdsf'),
(19, 'gfsdgf', '2022-02-22 21:39:14', 14, 'gfdsg'),
(20, 'gfsdgf', '2022-02-22 21:42:50', 15, 'rewqrwqe'),
(21, 'dsafdsf', '2022-02-22 21:46:12', 16, 'gfdsg'),
(22, 'fdsaf', '2022-02-22 21:49:35', 17, 'fdsf'),
(23, 'Mark1', '2022-02-22 21:55:20', 18, 'mark.mitarbeiter@studyspace.at'),
(24, 'Timon1', '2022-02-23 00:13:41', 19, 'timon.testuser@studyspace.at'),
(25, 'test99', '2022-02-24 16:40:28', 20, 'test99'),
(26, '$2y$10$/bhsz0c8F4RanaFNF/SSVu23eihPJ4lE6gleIGEFXFpHNk6CTxKNe', '2022-02-24 17:08:38', 21, 'test88'),
(27, '$2y$10$.EN.pc65EvqybHBJkuA0oOY2XjkCizmrT.29dSMksdp3SbMGD4B5.', '2022-02-24 20:32:57', 21, 'manfred.mitarbeiter@studyspace.ta'),
(28, '$2y$10$hxwljFIkr5sppIzcIMRMP.0wKDgYdXrzdfQqVbU.kkXtvUta2qKxO', '2022-02-24 20:40:49', 22, 'test77'),
(29, '$2y$10$Hnlyr283KqUv5OQ4jarWvOPEfP8AfQlClbfnvrpWrqqTZv4rkbcbe', '2022-02-24 20:43:27', 23, 'marianne.mitarbeiter@studyspace.at'),
(30, '$2y$10$VTzx.vk3TdbLqy3Qn4BmXe3jaqNiNYyjNpKqeNayNKUp9SlmdUZ46', '2022-02-24 20:48:37', 24, 'kurt.kunde@studyspace.at');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sp_Besuche`
--

CREATE TABLE `sp_Besuche` (
  `BesuchID` int(11) NOT NULL,
  `Eintritt` datetime NOT NULL,
  `Austritt` datetime NOT NULL,
  `PersonID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `sp_Besuche`
--

INSERT INTO `sp_Besuche` (`BesuchID`, `Eintritt`, `Austritt`, `PersonID`) VALUES
(1, '2022-02-01 10:57:24', '2022-02-01 15:57:24', 24),
(2, '2022-02-02 08:37:24', '2022-02-02 09:57:24', 24),
(3, '2022-02-23 07:48:03', '2022-02-23 15:37:10', 23),
(4, '2022-02-24 09:55:38', '2022-02-24 18:29:16', 23);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sp_Filiale`
--

CREATE TABLE `sp_Filiale` (
  `FilialenID` int(11) NOT NULL,
  `Quadratmeter` int(11) DEFAULT NULL,
  `AdressenID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `sp_Filiale`
--

INSERT INTO `sp_Filiale` (`FilialenID`, `Quadratmeter`, `AdressenID`) VALUES
(1, 20, 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sp_Instandhaltung`
--

CREATE TABLE `sp_Instandhaltung` (
  `InstandhaltungsID` int(11) NOT NULL,
  `ProduktID` int(11) DEFAULT NULL,
  `FilialenID` int(11) DEFAULT NULL,
  `PersonID` int(11) DEFAULT NULL,
  `Taetigkeit` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sp_Inventar`
--

CREATE TABLE `sp_Inventar` (
  `InventarID` int(11) NOT NULL,
  `ProduktID` int(11) NOT NULL,
  `FilialenID` int(11) NOT NULL,
  `Lagerbestand` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `sp_Inventar`
--

INSERT INTO `sp_Inventar` (`InventarID`, `ProduktID`, `FilialenID`, `Lagerbestand`) VALUES
(1, 2, 1, 5),
(2, 1, 1, 50);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sp_Meldung`
--

CREATE TABLE `sp_Meldung` (
  `MeldungID` int(11) NOT NULL,
  `BenutzerID` int(11) DEFAULT NULL,
  `InstandhaltungsID` int(11) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  `Datum` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Text` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `sp_Meldung`
--

INSERT INTO `sp_Meldung` (`MeldungID`, `BenutzerID`, `InstandhaltungsID`, `Status`, `Datum`, `Text`) VALUES
(1, 24, NULL, 'fertig', '2022-02-23 20:46:05', 'Milch von Kaffeemaschine leer'),
(2, 24, NULL, 'offen', '2022-02-23 20:46:05', 'Tisch Nr 5 wackelt'),
(3, 18, NULL, 'offen', '2022-02-23 20:59:12', 'Aepfel leer'),
(4, 18, NULL, 'offen', '2022-02-24 16:15:36', 'Lokal geschlossen'),
(5, 18, NULL, 'offen', '2022-02-24 16:29:58', 'Glas zerbrochen');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sp_Mitarbeiter`
--

CREATE TABLE `sp_Mitarbeiter` (
  `MitarbeiterID` int(11) NOT NULL,
  `Sozialversicherung` int(11) NOT NULL,
  `Funktion` varchar(50) DEFAULT NULL,
  `Arbeitszeit` int(11) DEFAULT NULL,
  `Beitrittsdatum` date NOT NULL,
  `FilialenID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `sp_Mitarbeiter`
--

INSERT INTO `sp_Mitarbeiter` (`MitarbeiterID`, `Sozialversicherung`, `Funktion`, `Arbeitszeit`, `Beitrittsdatum`, `FilialenID`) VALUES
(3, 4567, 'Barista', 20, '2021-12-12', 1),
(18, 8762, 'Barista', 15, '2021-10-11', 1),
(23, 3789, 'Barista', 15, '2021-06-15', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sp_Personen`
--

CREATE TABLE `sp_Personen` (
  `PersonID` int(11) NOT NULL,
  `Vorname` varchar(50) DEFAULT NULL,
  `Nachname` varchar(50) NOT NULL,
  `Geburtsdatum` date DEFAULT NULL,
  `AdressenID` int(11) DEFAULT NULL,
  `Geschlecht` varchar(10) DEFAULT NULL,
  `Telefonnummer` int(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `sp_Personen`
--

INSERT INTO `sp_Personen` (`PersonID`, `Vorname`, `Nachname`, `Geburtsdatum`, `AdressenID`, `Geschlecht`, `Telefonnummer`) VALUES
(1, 'Hans', 'Mayer', '1970-01-01', 1, 'm', 664123456),
(2, 'Peter', 'Huber', '1980-02-02', 2, 'm', 9999999),
(3, 'Brigitte', 'Schmidt', '1990-05-05', 1, 'w', 12345435),
(4, 'test3', 'test3', NULL, 9, 'm', 3333),
(5, 'tes6', 'test6', '1970-01-01', 12, 'm', 6666),
(6, 'gfhdgdfj', 'gfdhgfh', NULL, 13, 'm', 43543),
(7, 'fasdf', 'fwaefrdsf', '1970-01-01', 14, 'm', 34223),
(8, 'fdsaf', 'fasdf', '1970-01-01', 15, 'm', 234324),
(9, 'test7', 'test7', '2021-09-10', 17, 'm', 777),
(10, 'test8', 'test8', '2021-05-12', 18, 'm', 888),
(11, 'sadfsa', 'fasdfsad', '2022-02-02', 19, 'm', 43545),
(12, 'dsfasdf', 'dsafsadf', '2021-12-18', 20, 'm', 43543),
(13, 'fdasf', 'fdsafd', '2021-11-12', 21, 'm', 43544),
(14, 'gfsdg', 'gfdsg', '2022-02-11', 22, 'm', 345),
(15, 'fasdf', 'fdsafa', '2022-02-03', 23, 'm', 24324),
(16, 'fasdf', 'ggdfg', '2022-02-11', 24, 'm', 345),
(17, 'dasfsdf', 'dsfasd', '2022-02-11', 25, 'm', 324234),
(18, 'Mark', 'Mitarbeiter', '1992-07-24', 26, 'm', 6604646),
(19, 'Tim', 'Testuser', '2002-06-23', 27, 'm', 6768989),
(20, 'test99', 'test99', '2022-02-03', 28, 'w', 99999),
(21, 'test88', 'test88', '2022-02-09', 29, 'm', 8888),
(22, 'test77', 'test77', '2022-02-08', 31, 'm', 7777),
(23, 'Marianne', 'Mitarbeiter', '1992-02-05', 32, 'w', 6646464),
(24, 'Kurt', 'Kunde', '1992-07-09', 33, 'm', 699454545);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sp_Produkt`
--

CREATE TABLE `sp_Produkt` (
  `ProduktID` int(11) NOT NULL,
  `Bezeichnung` varchar(50) NOT NULL,
  `Verkaufspreis` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `sp_Produkt`
--

INSERT INTO `sp_Produkt` (`ProduktID`, `Bezeichnung`, `Verkaufspreis`) VALUES
(1, 'Kaffee schwarz', 2),
(2, 'Apfel', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sp_ProduktBeiBesuch`
--

CREATE TABLE `sp_ProduktBeiBesuch` (
  `ProduktID` int(11) NOT NULL,
  `BesuchID` int(11) NOT NULL,
  `Menge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `sp_ProduktBeiBesuch`
--

INSERT INTO `sp_ProduktBeiBesuch` (`ProduktID`, `BesuchID`, `Menge`) VALUES
(1, 1, 3),
(1, 2, 3),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sp_Zugangscode`
--

CREATE TABLE `sp_Zugangscode` (
  `Code` varchar(10) NOT NULL,
  `Ablaufsdatum` datetime NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `sp_Zugangscode`
--

INSERT INTO `sp_Zugangscode` (`Code`, `Ablaufsdatum`, `UserID`) VALUES
('194515', '2022-03-24 21:49:35', 22),
('220707', '2022-03-24 21:46:12', 21),
('229677', '2022-03-25 00:13:41', 24),
('294067', '2022-03-26 16:40:28', 25),
('304290', '2022-03-26 20:40:49', 28),
('325245', '2022-03-24 21:55:20', 23),
('437229', '2022-03-26 17:08:38', 26),
('538879', '2022-03-26 20:48:37', 30),
('575665', '2022-03-26 20:43:27', 29),
('805029', '2022-03-24 21:42:50', 4),
('965572', '2022-03-26 20:32:57', 27);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `sp_Adressen`
--
ALTER TABLE `sp_Adressen`
  ADD PRIMARY KEY (`AdressenID`);

--
-- Indizes für die Tabelle `sp_Arbeitsstunden`
--
ALTER TABLE `sp_Arbeitsstunden`
  ADD PRIMARY KEY (`ArbeitszeitID`,`BesuchID`),
  ADD KEY `BesuchID` (`BesuchID`);

--
-- Indizes für die Tabelle `sp_Arbeitszeit`
--
ALTER TABLE `sp_Arbeitszeit`
  ADD PRIMARY KEY (`ArbeitszeitID`),
  ADD KEY `MitarbeiterID` (`MitarbeiterID`);

--
-- Indizes für die Tabelle `sp_Benutzer`
--
ALTER TABLE `sp_Benutzer`
  ADD PRIMARY KEY (`BenutzerID`),
  ADD KEY `PersonID` (`PersonID`);

--
-- Indizes für die Tabelle `sp_Besuche`
--
ALTER TABLE `sp_Besuche`
  ADD PRIMARY KEY (`BesuchID`),
  ADD KEY `PersonID` (`PersonID`);

--
-- Indizes für die Tabelle `sp_Filiale`
--
ALTER TABLE `sp_Filiale`
  ADD PRIMARY KEY (`FilialenID`),
  ADD KEY `AdressenID` (`AdressenID`);

--
-- Indizes für die Tabelle `sp_Instandhaltung`
--
ALTER TABLE `sp_Instandhaltung`
  ADD PRIMARY KEY (`InstandhaltungsID`),
  ADD KEY `ProduktID` (`ProduktID`),
  ADD KEY `FilialenID` (`FilialenID`),
  ADD KEY `PersonID` (`PersonID`);

--
-- Indizes für die Tabelle `sp_Inventar`
--
ALTER TABLE `sp_Inventar`
  ADD PRIMARY KEY (`InventarID`),
  ADD KEY `ProduktID` (`ProduktID`),
  ADD KEY `FilialenID` (`FilialenID`);

--
-- Indizes für die Tabelle `sp_Meldung`
--
ALTER TABLE `sp_Meldung`
  ADD PRIMARY KEY (`MeldungID`),
  ADD KEY `BenutzerID` (`BenutzerID`),
  ADD KEY `InstandhaltungsID` (`InstandhaltungsID`);

--
-- Indizes für die Tabelle `sp_Mitarbeiter`
--
ALTER TABLE `sp_Mitarbeiter`
  ADD PRIMARY KEY (`MitarbeiterID`),
  ADD KEY `FilialenID` (`FilialenID`);

--
-- Indizes für die Tabelle `sp_Personen`
--
ALTER TABLE `sp_Personen`
  ADD PRIMARY KEY (`PersonID`),
  ADD KEY `AdressenID` (`AdressenID`);

--
-- Indizes für die Tabelle `sp_Produkt`
--
ALTER TABLE `sp_Produkt`
  ADD PRIMARY KEY (`ProduktID`);

--
-- Indizes für die Tabelle `sp_ProduktBeiBesuch`
--
ALTER TABLE `sp_ProduktBeiBesuch`
  ADD PRIMARY KEY (`ProduktID`,`BesuchID`),
  ADD KEY `BesuchID` (`BesuchID`);

--
-- Indizes für die Tabelle `sp_Zugangscode`
--
ALTER TABLE `sp_Zugangscode`
  ADD PRIMARY KEY (`Code`),
  ADD KEY `UserID` (`UserID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `sp_Adressen`
--
ALTER TABLE `sp_Adressen`
  MODIFY `AdressenID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT für Tabelle `sp_Arbeitszeit`
--
ALTER TABLE `sp_Arbeitszeit`
  MODIFY `ArbeitszeitID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `sp_Benutzer`
--
ALTER TABLE `sp_Benutzer`
  MODIFY `BenutzerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT für Tabelle `sp_Besuche`
--
ALTER TABLE `sp_Besuche`
  MODIFY `BesuchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `sp_Filiale`
--
ALTER TABLE `sp_Filiale`
  MODIFY `FilialenID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `sp_Instandhaltung`
--
ALTER TABLE `sp_Instandhaltung`
  MODIFY `InstandhaltungsID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `sp_Inventar`
--
ALTER TABLE `sp_Inventar`
  MODIFY `InventarID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `sp_Meldung`
--
ALTER TABLE `sp_Meldung`
  MODIFY `MeldungID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `sp_Personen`
--
ALTER TABLE `sp_Personen`
  MODIFY `PersonID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT für Tabelle `sp_Produkt`
--
ALTER TABLE `sp_Produkt`
  MODIFY `ProduktID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `sp_Arbeitsstunden`
--
ALTER TABLE `sp_Arbeitsstunden`
  ADD CONSTRAINT `sp_Arbeitsstunden_ibfk_1` FOREIGN KEY (`ArbeitszeitID`) REFERENCES `sp_Arbeitszeit` (`ArbeitszeitID`),
  ADD CONSTRAINT `sp_Arbeitsstunden_ibfk_2` FOREIGN KEY (`BesuchID`) REFERENCES `sp_Besuche` (`BesuchID`);

--
-- Constraints der Tabelle `sp_Arbeitszeit`
--
ALTER TABLE `sp_Arbeitszeit`
  ADD CONSTRAINT `sp_Arbeitszeit_ibfk_1` FOREIGN KEY (`MitarbeiterID`) REFERENCES `sp_Mitarbeiter` (`MitarbeiterID`);

--
-- Constraints der Tabelle `sp_Benutzer`
--
ALTER TABLE `sp_Benutzer`
  ADD CONSTRAINT `sp_Benutzer_ibfk_1` FOREIGN KEY (`PersonID`) REFERENCES `sp_Personen` (`PersonID`);

--
-- Constraints der Tabelle `sp_Besuche`
--
ALTER TABLE `sp_Besuche`
  ADD CONSTRAINT `sp_Besuche_ibfk_1` FOREIGN KEY (`PersonID`) REFERENCES `sp_Personen` (`PersonID`);

--
-- Constraints der Tabelle `sp_Filiale`
--
ALTER TABLE `sp_Filiale`
  ADD CONSTRAINT `sp_Filiale_ibfk_1` FOREIGN KEY (`AdressenID`) REFERENCES `sp_Adressen` (`AdressenID`);

--
-- Constraints der Tabelle `sp_Instandhaltung`
--
ALTER TABLE `sp_Instandhaltung`
  ADD CONSTRAINT `sp_Instandhaltung_ibfk_1` FOREIGN KEY (`ProduktID`) REFERENCES `sp_Produkt` (`ProduktID`),
  ADD CONSTRAINT `sp_Instandhaltung_ibfk_2` FOREIGN KEY (`FilialenID`) REFERENCES `sp_Filiale` (`FilialenID`),
  ADD CONSTRAINT `sp_Instandhaltung_ibfk_3` FOREIGN KEY (`PersonID`) REFERENCES `sp_Personen` (`PersonID`);

--
-- Constraints der Tabelle `sp_Inventar`
--
ALTER TABLE `sp_Inventar`
  ADD CONSTRAINT `sp_Inventar_ibfk_1` FOREIGN KEY (`ProduktID`) REFERENCES `sp_Produkt` (`ProduktID`),
  ADD CONSTRAINT `sp_Inventar_ibfk_2` FOREIGN KEY (`FilialenID`) REFERENCES `sp_Filiale` (`FilialenID`);

--
-- Constraints der Tabelle `sp_Meldung`
--
ALTER TABLE `sp_Meldung`
  ADD CONSTRAINT `sp_Meldung_ibfk_1` FOREIGN KEY (`BenutzerID`) REFERENCES `sp_Benutzer` (`BenutzerID`),
  ADD CONSTRAINT `sp_Meldung_ibfk_2` FOREIGN KEY (`InstandhaltungsID`) REFERENCES `sp_Instandhaltung` (`InstandhaltungsID`);

--
-- Constraints der Tabelle `sp_Mitarbeiter`
--
ALTER TABLE `sp_Mitarbeiter`
  ADD CONSTRAINT `sp_Mitarbeiter_ibfk_1` FOREIGN KEY (`MitarbeiterID`) REFERENCES `sp_Personen` (`PersonID`),
  ADD CONSTRAINT `sp_Mitarbeiter_ibfk_2` FOREIGN KEY (`FilialenID`) REFERENCES `sp_Filiale` (`FilialenID`);

--
-- Constraints der Tabelle `sp_Personen`
--
ALTER TABLE `sp_Personen`
  ADD CONSTRAINT `sp_Personen_ibfk_1` FOREIGN KEY (`AdressenID`) REFERENCES `sp_Adressen` (`AdressenID`);

--
-- Constraints der Tabelle `sp_ProduktBeiBesuch`
--
ALTER TABLE `sp_ProduktBeiBesuch`
  ADD CONSTRAINT `sp_ProduktBeiBesuch_ibfk_1` FOREIGN KEY (`ProduktID`) REFERENCES `sp_Produkt` (`ProduktID`),
  ADD CONSTRAINT `sp_ProduktBeiBesuch_ibfk_2` FOREIGN KEY (`BesuchID`) REFERENCES `sp_Besuche` (`BesuchID`);

--
-- Constraints der Tabelle `sp_Zugangscode`
--
ALTER TABLE `sp_Zugangscode`
  ADD CONSTRAINT `sp_Zugangscode_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `sp_Benutzer` (`BenutzerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
