-- phpMyAdmin SQL Dump
-- version 5.2.1deb1+deb12u1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Mag 23, 2025 alle 07:51
-- Versione del server: 10.11.11-MariaDB-0+deb12u1
-- Versione PHP: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hu_magazzino`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `articoli`
--

CREATE TABLE `articoli` (
  `A_id` char(15) NOT NULL,
  `descrizione` varchar(35) DEFAULT NULL,
  `quantita` int(11) DEFAULT NULL,
  `prezzo` double DEFAULT NULL,
  `FK_fornitore` char(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `articoli`
--

INSERT INTO `articoli` (`A_id`, `descrizione`, `quantita`, `prezzo`, `FK_fornitore`) VALUES
('11111111', 'Cacciaviti a croce', 5, 15, '12345698715'),
('22222222', 'Cacciaviti piano', 3, 10, '12345698715'),
('33333333', 'Bomboletta Gas', 6, 18, '85697451255'),
('44444444', 'Fornellino Gas', 3, 25, '85697451255'),
('55555555', 'Guanti Gomma', 1, 12, '98765432101'),
('66666666', 'Filo decespugliatore', 1, 7, '98765432101'),
('77777777', 'Calibro', 3, 30, '12345698715'),
('77777788', 'Avvitatore', -3, 30, '12345698715');

-- --------------------------------------------------------

--
-- Struttura della tabella `fornitori`
--

CREATE TABLE `fornitori` (
  `F_id` char(11) NOT NULL,
  `ragione_sociale` varchar(40) DEFAULT NULL,
  `indirizzo` varchar(35) DEFAULT NULL,
  `cap` char(5) DEFAULT NULL,
  `citta` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `fornitori`
--

INSERT INTO `fornitori` (`F_id`, `ragione_sociale`, `indirizzo`, `cap`, `citta`) VALUES
('12345698715', 'Beta utensili', 'Milano', '20100', 'MI\r\n'),
('85697451255', 'Europagas', 'Roma', '00100', 'RM\r\n'),
('98765432101', 'Franzini', 'Firenze', '50100', 'FI\r\n');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `articoli`
--
ALTER TABLE `articoli`
  ADD PRIMARY KEY (`A_id`),
  ADD KEY `FK_fornitore` (`FK_fornitore`);

--
-- Indici per le tabelle `fornitori`
--
ALTER TABLE `fornitori`
  ADD PRIMARY KEY (`F_id`);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `articoli`
--
ALTER TABLE `articoli`
  ADD CONSTRAINT `articoli_ibfk_1` FOREIGN KEY (`FK_fornitore`) REFERENCES `fornitori` (`F_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
