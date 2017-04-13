-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 13 apr 2017 om 15:48
-- Serverversie: 10.1.21-MariaDB
-- PHP-versie: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizza`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestellijn`
--

CREATE TABLE `bestellijn` (
  `id` int(11) NOT NULL DEFAULT '0',
  `bestellingId` int(11) NOT NULL,
  `aantal` int(11) NOT NULL,
  `productId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Gegevens worden geëxporteerd voor tabel `bestellijn`
--

INSERT INTO `bestellijn` (`id`, `bestellingId`, `aantal`, `productId`) VALUES
(1, 1, 2, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestellingen`
--

CREATE TABLE `bestellingen` (
  `id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `tijdstip` time NOT NULL,
  `info` varchar(500) COLLATE utf8_bin NOT NULL,
  `klantNummer` int(11) NOT NULL,
  `straatId` int(11) NOT NULL,
  `plaatsId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Gegevens worden geëxporteerd voor tabel `bestellingen`
--

INSERT INTO `bestellingen` (`id`, `datum`, `tijdstip`, `info`, `klantNummer`, `straatId`, `plaatsId`) VALUES
(1, '2017-04-12', '10:24:00', 'vierde verdiep', 2, 1, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `extras`
--

CREATE TABLE `extras` (
  `bestelId` int(11) NOT NULL,
  `productId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gastenboek`
--

CREATE TABLE `gastenboek` (
  `zaakId` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `boodschap` varchar(140) COLLATE utf8_bin NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `klantNummer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klant`
--

CREATE TABLE `klant` (
  `klantNummer` int(11) NOT NULL,
  `naam` varchar(45) COLLATE utf8_bin NOT NULL,
  `voornaam` varchar(45) COLLATE utf8_bin NOT NULL,
  `telefoon` int(10) NOT NULL,
  `emailadres` varchar(100) COLLATE utf8_bin NOT NULL,
  `wachtwoord` varchar(255) COLLATE utf8_bin NOT NULL,
  `opmerking` varchar(500) COLLATE utf8_bin NOT NULL,
  `promo` tinyint(1) NOT NULL DEFAULT '0',
  `beheerder` tinyint(1) NOT NULL DEFAULT '0',
  `stadId` int(11) NOT NULL,
  `straatId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Gegevens worden geëxporteerd voor tabel `klant`
--

INSERT INTO `klant` (`klantNummer`, `naam`, `voornaam`, `telefoon`, `emailadres`, `wachtwoord`, `opmerking`, `promo`, `beheerder`, `stadId`, `straatId`) VALUES
(2, 'Sagaert', 'Stijn', 477176085, 'stijn.sagaert@outlook.be', '$2y$10$qKb1J8Ucy.xet/hetYVXF.J4CwE1MNGkwYCat/35H/zg67h8zFLiC', 'beste klant', 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `levergebied`
--

CREATE TABLE `levergebied` (
  `zaakId` int(11) NOT NULL,
  `plaatsId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `naam` varchar(50) COLLATE utf8_bin NOT NULL,
  `prijs` double NOT NULL,
  `beginDatum` date NOT NULL,
  `eindDatum` date NOT NULL,
  `promoKorting` double NOT NULL,
  `omschrijving` varchar(500) COLLATE utf8_bin NOT NULL,
  `extra` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Gegevens worden geëxporteerd voor tabel `product`
--

INSERT INTO `product` (`id`, `naam`, `prijs`, `beginDatum`, `eindDatum`, `promoKorting`, `omschrijving`, `extra`) VALUES
(1, 'Peporon', 10.25, '2017-04-12', '2017-04-26', 0.95, 'Beste peporoni pizza', 0),
(3, 'black pepper', 0.2, '2017-04-01', '2017-04-30', 0.1, 'beste zwarte peper in de wereld', 1),
(4, 'Hawai', 25, '2017-04-13', '2017-04-21', 0.1, 'best hawai pizza buiten hawai', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `stad`
--

CREATE TABLE `stad` (
  `id` int(11) NOT NULL,
  `postcode` int(4) NOT NULL,
  `stad` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT;

--
-- Gegevens worden geëxporteerd voor tabel `stad`
--

INSERT INTO `stad` (`id`, `postcode`, `stad`) VALUES
(1, 8800, 'Roeselare'),
(2, 8400, 'Oostende'),
(5, 8700, 'Tilt');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `straat`
--

CREATE TABLE `straat` (
  `id` int(11) NOT NULL,
  `straat` varchar(50) COLLATE utf8_bin NOT NULL,
  `huisnummer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Gegevens worden geëxporteerd voor tabel `straat`
--

INSERT INTO `straat` (`id`, `straat`, `huisnummer`) VALUES
(1, 'Oude stationstraat', 30),
(2, 'statiestraat', 28),
(3, 'statiestraat', 29);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `zaak`
--

CREATE TABLE `zaak` (
  `id` int(11) NOT NULL,
  `naam` varchar(45) COLLATE utf8_bin NOT NULL,
  `voorwaarden` varchar(500) COLLATE utf8_bin NOT NULL,
  `beginPromoDatum` date NOT NULL,
  `eindPromoDatum` date NOT NULL,
  `promoAantalBestellingen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Gegevens worden geëxporteerd voor tabel `zaak`
--

INSERT INTO `zaak` (`id`, `naam`, `voorwaarden`, `beginPromoDatum`, `eindPromoDatum`, `promoAantalBestellingen`) VALUES
(1, 'Papi Pizza', 'We zijn niet verantwoordelijk voor te warm eten.', '2017-04-11', '2017-04-11', 5);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `klantNummer` (`klantNummer`),
  ADD KEY `stad bestelling` (`plaatsId`),
  ADD KEY `straat bestelling` (`straatId`);

--
-- Indexen voor tabel `extras`
--
ALTER TABLE `extras`
  ADD PRIMARY KEY (`bestelId`,`productId`);

--
-- Indexen voor tabel `gastenboek`
--
ALTER TABLE `gastenboek`
  ADD PRIMARY KEY (`zaakId`,`id`),
  ADD KEY `gastenboekId` (`id`),
  ADD KEY `klanten boodschap` (`klantNummer`);

--
-- Indexen voor tabel `klant`
--
ALTER TABLE `klant`
  ADD PRIMARY KEY (`klantNummer`),
  ADD KEY `straat` (`straatId`),
  ADD KEY `stad` (`stadId`);

--
-- Indexen voor tabel `levergebied`
--
ALTER TABLE `levergebied`
  ADD PRIMARY KEY (`zaakId`,`plaatsId`),
  ADD KEY `plaats levering` (`plaatsId`);

--
-- Indexen voor tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_2` (`id`),
  ADD KEY `id` (`id`);

--
-- Indexen voor tabel `stad`
--
ALTER TABLE `stad`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plaatsId` (`id`,`postcode`,`stad`);

--
-- Indexen voor tabel `straat`
--
ALTER TABLE `straat`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `zaak`
--
ALTER TABLE `zaak`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `gastenboek`
--
ALTER TABLE `gastenboek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `klant`
--
ALTER TABLE `klant`
  MODIFY `klantNummer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT voor een tabel `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT voor een tabel `stad`
--
ALTER TABLE `stad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT voor een tabel `straat`
--
ALTER TABLE `straat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT voor een tabel `zaak`
--
ALTER TABLE `zaak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  ADD CONSTRAINT `klantNummer` FOREIGN KEY (`klantNummer`) REFERENCES `klant` (`klantNummer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stad bestelling` FOREIGN KEY (`plaatsId`) REFERENCES `stad` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `straat bestelling` FOREIGN KEY (`straatId`) REFERENCES `straat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `gastenboek`
--
ALTER TABLE `gastenboek`
  ADD CONSTRAINT `klanten boodschap` FOREIGN KEY (`klantNummer`) REFERENCES `klant` (`klantNummer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `zaak gastenboek` FOREIGN KEY (`zaakId`) REFERENCES `zaak` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `klant`
--
ALTER TABLE `klant`
  ADD CONSTRAINT `stad` FOREIGN KEY (`stadId`) REFERENCES `stad` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `straat` FOREIGN KEY (`straatId`) REFERENCES `straat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `levergebied`
--
ALTER TABLE `levergebied`
  ADD CONSTRAINT `plaats levering` FOREIGN KEY (`plaatsId`) REFERENCES `stad` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `zaak` FOREIGN KEY (`zaakId`) REFERENCES `zaak` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
