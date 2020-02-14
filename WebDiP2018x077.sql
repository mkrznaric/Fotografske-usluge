-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 08, 2019 at 01:35 PM
-- Server version: 5.5.62-0+deb8u1
-- PHP Version: 7.2.15-1+0~20190209065041.16+jessie~1.gbp3ad8c0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `WebDiP2018x077`
--

-- --------------------------------------------------------

--
-- Table structure for table `dnevnik_aktivnosti`
--

CREATE TABLE `dnevnik_aktivnosti` (
  `id_dnevnik_aktivnosti` int(11) NOT NULL,
  `aktivnost` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `datum_vrijeme` datetime DEFAULT NULL,
  `korisnik_id_korisnik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dnevnik_aktivnosti`
--

INSERT INTO `dnevnik_aktivnosti` (`id_dnevnik_aktivnosti`, `aktivnost`, `datum_vrijeme`, `korisnik_id_korisnik`) VALUES
(1, 'Kreiranje lokacije', '2019-04-08 01:00:00', 1),
(2, 'Pregledavanje zahtjeva', '2019-04-08 02:00:00', 2),
(3, 'Kreiranje zahtjeva', '2019-04-08 03:00:00', 3),
(4, 'Pregledavanje lokacija', '2019-04-08 04:20:27', 4),
(5, 'Kreiranje zahtjeva', '2019-04-08 05:00:00', 5),
(6, 'Pregledavanje zahtjeva', '2019-04-08 06:00:00', 6),
(7, 'Pregledavanje zahtjeva', '2019-04-08 07:00:00', 7),
(8, 'Gledanje slika', '2019-04-08 08:00:00', 8),
(9, 'Gledanje slika', '2019-04-08 09:00:00', 9),
(10, 'Pretraživanje opreme', '2019-04-08 10:00:00', 10);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id_korisnik` int(11) NOT NULL,
  `ime` varchar(45) CHARACTER SET latin1 NOT NULL,
  `prezime` varchar(45) CHARACTER SET latin1 NOT NULL,
  `korisnicko_ime` varchar(45) CHARACTER SET latin1 NOT NULL,
  `lozinka` varchar(45) CHARACTER SET latin1 NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 NOT NULL,
  `datum_vrijme_registracije` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `uloga_id_uloga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id_korisnik`, `ime`, `prezime`, `korisnicko_ime`, `lozinka`, `email`, `datum_vrijme_registracije`, `status`, `uloga_id_uloga`) VALUES
(1, 'Matej', 'Krznaric', 'mkrznaric', 'lozinka123', 'mkrznaric@foi.hr', '2019-04-08 12:00:00', 1, 1),
(2, 'Dino', 'Krznaric', 'dkrznaric', '123lozinka123', 'krznaric339@gmail.com', '2019-04-02 06:22:24', 1, 2),
(3, 'Nikola', 'Krznaric', 'nikola_krznaric', 'loz1nka', 'nikola.krznaric@gmail.com', '2019-04-08 07:00:00', 1, 3),
(4, 'Goran', 'Krznaric', 'goran_krznaric', '1234567', 'goran.krznaric@gmail.com', NULL, 1, 4),
(5, 'Sanda', 'Krznaric', 'sanda.krznaric', '5678910', 'sanda.krznaric@gmail.com', NULL, 0, 4),
(6, 'Berislav', 'Baricic', 'bbaricic', 'bebrina19', 'bbaricic@foi.hr', '2019-04-02 03:19:23', 1, 2),
(7, 'Marko', 'Parac', 'maki', 'maki123', 'marko.parac@gmail.com', '2019-04-04 04:44:44', 1, 3),
(8, 'Matej', 'Kolaric', 'mkolaric', 'sifra223', 'mkolaric@foi.hr', '2019-04-02 06:45:25', 1, 3),
(9, 'Katja', 'Jelavic', 'kjelavic', 's1fra234', 'kjelavic@foi.hr', '2019-03-28 12:39:27', 1, 3),
(10, 'Matea', 'Aleksic', 'maleksic', '123987', 'matea.aleksic@gmail.com', NULL, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `lokacija`
--

CREATE TABLE `lokacija` (
  `id_lokacija` int(11) NOT NULL,
  `naziv` varchar(45) CHARACTER SET latin1 NOT NULL,
  `zupanija` varchar(45) CHARACTER SET latin1 NOT NULL,
  `dodatne_informacije` varchar(45) CHARACTER SET latin1 NOT NULL,
  `korisnik_id_korisnik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lokacija`
--

INSERT INTO `lokacija` (`id_lokacija`, `naziv`, `zupanija`, `dodatne_informacije`, `korisnik_id_korisnik`) VALUES
(1, 'Varaždin', 'Varaždinska', 'Grad Varaždin', 1),
(2, 'Vinkovci', 'Vukovarsko-srijemska', 'Grad Vinkovci', 1),
(3, 'Osijek', 'Osjecko-baranjska', 'Grad Osijek', 1),
(4, 'Cakovec', 'Medimurska', 'Grad Cakovec', 1),
(5, 'Dubrovnik', 'Dubrovacko-neretvanska', 'Grad Dubrovnik', 1),
(6, 'Vukovar', 'Vukovarsko-srijemska', 'Grad Vukovar', 1),
(7, 'Zadar', 'Zadarska', 'Grad Zadar', 1),
(8, 'Sibenik', 'Sibensko-kninska', 'Grad Sibenik', 1),
(9, 'Korcula', 'Dubrovacko-neretvanska', 'Grad Korcula, otok Korcula', 1),
(10, 'Bjelovar', 'Bjelovarsko-bilogorska', 'Grad Bjelovar', 1);

-- --------------------------------------------------------

--
-- Table structure for table `moderator`
--

CREATE TABLE `moderator` (
  `id_moderator` int(11) NOT NULL,
  `korisnik_id_korisnik` int(11) NOT NULL,
  `lokacija_id_lokacija` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `moderator`
--

INSERT INTO `moderator` (`id_moderator`, `korisnik_id_korisnik`, `lokacija_id_lokacija`) VALUES
(1, 2, 1),
(2, 6, 2),
(3, 2, 3),
(4, 6, 4),
(5, 2, 5),
(6, 6, 6),
(7, 2, 7),
(8, 6, 8),
(9, 2, 9),
(10, 6, 10);

-- --------------------------------------------------------

--
-- Table structure for table `oprema`
--

CREATE TABLE `oprema` (
  `id_oprema` int(11) NOT NULL,
  `naziv` varchar(45) CHARACTER SET latin1 NOT NULL,
  `dostupnost` tinyint(4) NOT NULL,
  `zahtjev_za_najam_opreme_id_zahtjev_za_najam_opreme` int(11) NOT NULL,
  `korisnik_id_korisnik` int(11) NOT NULL,
  `lokacija_id_lokacija` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oprema`
--

INSERT INTO `oprema` (`id_oprema`, `naziv`, `dostupnost`, `zahtjev_za_najam_opreme_id_zahtjev_za_najam_opreme`, `korisnik_id_korisnik`, `lokacija_id_lokacija`) VALUES
(1, 'Fotoaparat Nikon', 1, 1, 1, 1),
(2, 'Fotoaparat Canon', 0, 2, 2, 2),
(3, 'Fotoaparat Sony', 1, 3, 3, 3),
(4, 'Fotoaparat Lumix', 0, 4, 4, 4),
(5, 'Fotoaparat Fujifilm', 1, 5, 5, 5),
(6, 'Fotoaparat Samsung', 0, 6, 6, 6),
(7, 'Kamera Samsung', 0, 7, 7, 7),
(8, 'Kamera Sony', 1, 8, 8, 8),
(9, 'Kamera Fujifilm', 1, 9, 9, 9),
(10, 'Kamera Canon', 0, 10, 10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `slika`
--

CREATE TABLE `slika` (
  `id_slika` int(11) NOT NULL,
  `tag` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `naziv` varchar(45) CHARACTER SET latin1 NOT NULL,
  `velicina` int(11) NOT NULL,
  `korisnik_id_korisnik` int(11) NOT NULL,
  `oprema_id_oprema` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `slika`
--

INSERT INTO `slika` (`id_slika`, `tag`, `naziv`, `velicina`, `korisnik_id_korisnik`, `oprema_id_oprema`) VALUES
(1, 'Oznaka', 'Slika 1', 500, 2, 1),
(2, 'Oznaka', 'Slika 2', 650, 6, 2),
(3, 'Oznaka', 'Slika 3', 879, 2, 3),
(4, 'Oznaka', 'Slika 4', 900, 6, 4),
(5, 'Oznaka', 'Slika 5', 999, 2, 5),
(6, 'Oznaka', 'Slika 6', 1024, 6, 6),
(7, 'Oznaka', 'Slika 7', 1048, 2, 7),
(8, 'Oznaka', 'Slika 8', 1200, 6, 8),
(9, 'Oznaka', 'Slika 9', 1500, 2, 9),
(10, 'Oznaka', 'Slika 10', 2500, 6, 10);

-- --------------------------------------------------------

--
-- Table structure for table `status_zahtjeva`
--

CREATE TABLE `status_zahtjeva` (
  `id_status_zahtjeva` int(11) NOT NULL,
  `prihvaceno` tinyint(4) NOT NULL,
  `opis` varchar(45) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `status_zahtjeva`
--

INSERT INTO `status_zahtjeva` (`id_status_zahtjeva`, `prihvaceno`, `opis`) VALUES
(1, 1, 'Prihvaceno.'),
(2, 0, 'Odbijeno.'),
(3, 1, 'Prihvaceno.'),
(4, 0, 'Odbijeno.'),
(5, 1, 'Prihvaceno.'),
(6, 0, 'Odbijeno.'),
(7, 1, 'Prihvaceno.'),
(8, 0, 'Odbijeno.'),
(9, 1, 'Prihvaceno.'),
(10, 0, 'Odbijeno.');

-- --------------------------------------------------------

--
-- Table structure for table `uloga`
--

CREATE TABLE `uloga` (
  `id_uloga` int(11) NOT NULL,
  `naziv` varchar(45) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `uloga`
--

INSERT INTO `uloga` (`id_uloga`, `naziv`) VALUES
(1, 'Administrator'),
(2, 'Moderator'),
(3, 'Registrirani korisnik'),
(4, 'Neregistrirani korisnik');

-- --------------------------------------------------------

--
-- Table structure for table `zahtjev_za_najam_opreme`
--

CREATE TABLE `zahtjev_za_najam_opreme` (
  `id_zahtjev_za_najam_opreme` int(11) NOT NULL,
  `prihvaceno` tinyint(4) NOT NULL,
  `pocetak_koristenja` datetime NOT NULL,
  `zavrsetak_koristenja` datetime NOT NULL,
  `korisnik_id_korisnik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `zahtjev_za_najam_opreme`
--

INSERT INTO `zahtjev_za_najam_opreme` (`id_zahtjev_za_najam_opreme`, `prihvaceno`, `pocetak_koristenja`, `zavrsetak_koristenja`, `korisnik_id_korisnik`) VALUES
(1, 1, '2019-03-04 03:12:09', '2019-03-06 07:33:26', 2),
(2, 0, '2019-03-07 07:09:00', '2019-03-08 05:10:12', 6),
(3, 1, '2019-03-09 05:08:10', '2019-03-12 08:08:09', 2),
(4, 0, '2019-03-13 03:18:25', '2019-03-15 07:28:29', 6),
(5, 1, '2019-03-20 04:19:21', '2019-03-25 12:30:34', 2),
(6, 0, '2019-03-27 17:33:39', '2019-03-30 13:23:29', 6),
(7, 1, '2019-04-01 19:16:29', '2019-04-02 06:24:16', 2),
(8, 0, '2019-04-03 09:25:21', '2019-04-04 08:22:24', 6),
(9, 1, '2019-04-05 19:30:00', '2019-04-06 09:36:00', 2),
(10, 0, '2019-04-07 12:35:00', '2019-04-08 08:37:33', 6);

-- --------------------------------------------------------

--
-- Table structure for table `zahtjev_za_usluge_slikanja`
--

CREATE TABLE `zahtjev_za_usluge_slikanja` (
  `id_zahtjev_za_usluge_slikanja` int(11) NOT NULL,
  `opis` varchar(200) CHARACTER SET latin1 NOT NULL,
  `datum_vrijeme_odobravanja_odbijanja` datetime NOT NULL,
  `dozvoli_tag` tinyint(4) NOT NULL,
  `dozvoli_slike_maketing` tinyint(4) NOT NULL,
  `korisnik_id_korisnik` int(11) NOT NULL,
  `lokacija_id_lokacija` int(11) NOT NULL,
  `status_zahtjeva_id_status_zahtjeva` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `zahtjev_za_usluge_slikanja`
--

INSERT INTO `zahtjev_za_usluge_slikanja` (`id_zahtjev_za_usluge_slikanja`, `opis`, `datum_vrijeme_odobravanja_odbijanja`, `dozvoli_tag`, `dozvoli_slike_maketing`, `korisnik_id_korisnik`, `lokacija_id_lokacija`, `status_zahtjeva_id_status_zahtjeva`) VALUES
(1, 'Iz zraka.', '2019-04-02 04:15:15', 1, 1, 3, 1, 1),
(2, 'U vodi.', '2019-04-03 17:15:11', 1, 1, 7, 2, 2),
(3, 'Po kisi.', '2019-04-04 09:23:24', 1, 1, 8, 3, 3),
(4, 'Po suncu.', '2019-04-05 11:19:19', 1, 0, 9, 4, 4),
(5, 'Po magli.', '2019-04-06 13:19:00', 0, 1, 3, 5, 5),
(6, 'S poda.', '2019-04-07 13:00:00', 0, 0, 7, 6, 6),
(7, 'Po snijegu.', '2019-04-08 07:00:00', 1, 1, 8, 7, 7),
(8, 'Riblje oko.', '2019-03-20 09:21:00', 1, 0, 9, 8, 8),
(9, 'Pticja perspektiva.', '2019-03-29 15:22:39', 0, 0, 3, 9, 9),
(10, 'Zablja perspektiva.', '2019-04-01 11:21:14', 1, 1, 7, 10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `zahtjev_za_usluge_slikanja_has_slika`
--

CREATE TABLE `zahtjev_za_usluge_slikanja_has_slika` (
  `zahtjev_za_usluge_slikanja_id_zahtjev_za_usluge_slikanja` int(11) NOT NULL,
  `slika_id_slika` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `zahtjev_za_usluge_slikanja_has_slika`
--

INSERT INTO `zahtjev_za_usluge_slikanja_has_slika` (`zahtjev_za_usluge_slikanja_id_zahtjev_za_usluge_slikanja`, `slika_id_slika`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dnevnik_aktivnosti`
--
ALTER TABLE `dnevnik_aktivnosti`
  ADD PRIMARY KEY (`id_dnevnik_aktivnosti`),
  ADD KEY `fk_dnevnik_aktivnosti_korisnik1_idx` (`korisnik_id_korisnik`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id_korisnik`),
  ADD KEY `fk_korisnik_uloga1_idx` (`uloga_id_uloga`);

--
-- Indexes for table `lokacija`
--
ALTER TABLE `lokacija`
  ADD PRIMARY KEY (`id_lokacija`),
  ADD KEY `fk_lokacija_korisnik1_idx` (`korisnik_id_korisnik`);

--
-- Indexes for table `moderator`
--
ALTER TABLE `moderator`
  ADD PRIMARY KEY (`id_moderator`),
  ADD KEY `fk_moderator_korisnik1_idx` (`korisnik_id_korisnik`),
  ADD KEY `fk_moderator_lokacija1_idx` (`lokacija_id_lokacija`);

--
-- Indexes for table `oprema`
--
ALTER TABLE `oprema`
  ADD PRIMARY KEY (`id_oprema`),
  ADD KEY `fk_oprema_zahtjev_za_najam_opreme1_idx` (`zahtjev_za_najam_opreme_id_zahtjev_za_najam_opreme`),
  ADD KEY `fk_oprema_korisnik1_idx` (`korisnik_id_korisnik`),
  ADD KEY `fk_oprema_lokacija1_idx` (`lokacija_id_lokacija`);

--
-- Indexes for table `slika`
--
ALTER TABLE `slika`
  ADD PRIMARY KEY (`id_slika`),
  ADD KEY `fk_slika_korisnik1_idx` (`korisnik_id_korisnik`),
  ADD KEY `fk_slika_oprema1_idx` (`oprema_id_oprema`);

--
-- Indexes for table `status_zahtjeva`
--
ALTER TABLE `status_zahtjeva`
  ADD PRIMARY KEY (`id_status_zahtjeva`);

--
-- Indexes for table `uloga`
--
ALTER TABLE `uloga`
  ADD PRIMARY KEY (`id_uloga`);

--
-- Indexes for table `zahtjev_za_najam_opreme`
--
ALTER TABLE `zahtjev_za_najam_opreme`
  ADD PRIMARY KEY (`id_zahtjev_za_najam_opreme`),
  ADD KEY `fk_zahtjev_za_najam_opreme_korisnik1_idx` (`korisnik_id_korisnik`);

--
-- Indexes for table `zahtjev_za_usluge_slikanja`
--
ALTER TABLE `zahtjev_za_usluge_slikanja`
  ADD PRIMARY KEY (`id_zahtjev_za_usluge_slikanja`),
  ADD KEY `fk_zahtjev_za_usluge_slikanja_korisnik1_idx` (`korisnik_id_korisnik`),
  ADD KEY `fk_zahtjev_za_usluge_slikanja_lokacija1_idx` (`lokacija_id_lokacija`),
  ADD KEY `fk_zahtjev_za_usluge_slikanja_status_zahtjeva1_idx` (`status_zahtjeva_id_status_zahtjeva`);

--
-- Indexes for table `zahtjev_za_usluge_slikanja_has_slika`
--
ALTER TABLE `zahtjev_za_usluge_slikanja_has_slika`
  ADD PRIMARY KEY (`zahtjev_za_usluge_slikanja_id_zahtjev_za_usluge_slikanja`,`slika_id_slika`),
  ADD KEY `fk_zahtjev_za_usluge_slikanja_has_slika_slika1_idx` (`slika_id_slika`),
  ADD KEY `fk_zahtjev_za_usluge_slikanja_has_slika_zahtjev_za_usluge_s_idx` (`zahtjev_za_usluge_slikanja_id_zahtjev_za_usluge_slikanja`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dnevnik_aktivnosti`
--
ALTER TABLE `dnevnik_aktivnosti`
  MODIFY `id_dnevnik_aktivnosti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id_korisnik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `lokacija`
--
ALTER TABLE `lokacija`
  MODIFY `id_lokacija` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `moderator`
--
ALTER TABLE `moderator`
  MODIFY `id_moderator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `oprema`
--
ALTER TABLE `oprema`
  MODIFY `id_oprema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `slika`
--
ALTER TABLE `slika`
  MODIFY `id_slika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `status_zahtjeva`
--
ALTER TABLE `status_zahtjeva`
  MODIFY `id_status_zahtjeva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `uloga`
--
ALTER TABLE `uloga`
  MODIFY `id_uloga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `zahtjev_za_najam_opreme`
--
ALTER TABLE `zahtjev_za_najam_opreme`
  MODIFY `id_zahtjev_za_najam_opreme` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `zahtjev_za_usluge_slikanja`
--
ALTER TABLE `zahtjev_za_usluge_slikanja`
  MODIFY `id_zahtjev_za_usluge_slikanja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `dnevnik_aktivnosti`
--
ALTER TABLE `dnevnik_aktivnosti`
  ADD CONSTRAINT `fk_dnevnik_aktivnosti_korisnik1` FOREIGN KEY (`korisnik_id_korisnik`) REFERENCES `korisnik` (`id_korisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `fk_korisnik_uloga1` FOREIGN KEY (`uloga_id_uloga`) REFERENCES `uloga` (`id_uloga`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `lokacija`
--
ALTER TABLE `lokacija`
  ADD CONSTRAINT `fk_lokacija_korisnik1` FOREIGN KEY (`korisnik_id_korisnik`) REFERENCES `korisnik` (`id_korisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `moderator`
--
ALTER TABLE `moderator`
  ADD CONSTRAINT `fk_moderator_korisnik1` FOREIGN KEY (`korisnik_id_korisnik`) REFERENCES `korisnik` (`id_korisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_moderator_lokacija1` FOREIGN KEY (`lokacija_id_lokacija`) REFERENCES `lokacija` (`id_lokacija`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `oprema`
--
ALTER TABLE `oprema`
  ADD CONSTRAINT `fk_oprema_korisnik1` FOREIGN KEY (`korisnik_id_korisnik`) REFERENCES `korisnik` (`id_korisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_oprema_lokacija1` FOREIGN KEY (`lokacija_id_lokacija`) REFERENCES `lokacija` (`id_lokacija`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_oprema_zahtjev_za_najam_opreme1` FOREIGN KEY (`zahtjev_za_najam_opreme_id_zahtjev_za_najam_opreme`) REFERENCES `zahtjev_za_najam_opreme` (`id_zahtjev_za_najam_opreme`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `slika`
--
ALTER TABLE `slika`
  ADD CONSTRAINT `fk_slika_korisnik1` FOREIGN KEY (`korisnik_id_korisnik`) REFERENCES `korisnik` (`id_korisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_slika_oprema1` FOREIGN KEY (`oprema_id_oprema`) REFERENCES `oprema` (`id_oprema`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `zahtjev_za_najam_opreme`
--
ALTER TABLE `zahtjev_za_najam_opreme`
  ADD CONSTRAINT `fk_zahtjev_za_najam_opreme_korisnik1` FOREIGN KEY (`korisnik_id_korisnik`) REFERENCES `korisnik` (`id_korisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `zahtjev_za_usluge_slikanja`
--
ALTER TABLE `zahtjev_za_usluge_slikanja`
  ADD CONSTRAINT `fk_zahtjev_za_usluge_slikanja_korisnik1` FOREIGN KEY (`korisnik_id_korisnik`) REFERENCES `korisnik` (`id_korisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_zahtjev_za_usluge_slikanja_lokacija1` FOREIGN KEY (`lokacija_id_lokacija`) REFERENCES `lokacija` (`id_lokacija`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_zahtjev_za_usluge_slikanja_status_zahtjeva1` FOREIGN KEY (`status_zahtjeva_id_status_zahtjeva`) REFERENCES `status_zahtjeva` (`id_status_zahtjeva`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `zahtjev_za_usluge_slikanja_has_slika`
--
ALTER TABLE `zahtjev_za_usluge_slikanja_has_slika`
  ADD CONSTRAINT `fk_zahtjev_za_usluge_slikanja_has_slika_slika1` FOREIGN KEY (`slika_id_slika`) REFERENCES `slika` (`id_slika`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_zahtjev_za_usluge_slikanja_has_slika_zahtjev_za_usluge_sli1` FOREIGN KEY (`zahtjev_za_usluge_slikanja_id_zahtjev_za_usluge_slikanja`) REFERENCES `zahtjev_za_usluge_slikanja` (`id_zahtjev_za_usluge_slikanja`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
