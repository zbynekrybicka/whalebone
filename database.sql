-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Počítač: db
-- Vytvořeno: Pon 01. lis 2021, 12:13
-- Verze serveru: 8.0.27
-- Verze PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Databáze: `test_db`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `device`
--

CREATE TABLE `device` (
  `id` int UNSIGNED NOT NULL,
  `hostname` char(255) NOT NULL,
  `device_type_id` int UNSIGNED NOT NULL,
  `os_id` int UNSIGNED NOT NULL,
  `owner` char(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Vypisuji data pro tabulku `device`
--

INSERT INTO `device` (`id`, `hostname`, `device_type_id`, `os_id`, `owner`) VALUES
(1, 'localhost', 1, 1, 'Rybička'),
(2, 'coruscant', 1, 1, 'Procházka'),
(3, 'alderaan', 1, 1, 'Novák'),
(4, 'tatooine', 1, 1, 'Jelínek'),
(5, 'geonosis', 1, 1, 'Vomáčka'),
(6, 'mustafar', 1, 1, 'Vopršálek'),
(7, 'naboo', 1, 1, 'Obi-wan'),
(8, 'hoth', 1, 1, 'Lando');

-- --------------------------------------------------------

--
-- Struktura tabulky `device_type`
--

CREATE TABLE `device_type` (
  `id` int UNSIGNED NOT NULL,
  `title` char(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Vypisuji data pro tabulku `device_type`
--

INSERT INTO `device_type` (`id`, `title`) VALUES
(1, 'PC'),
(2, 'Laptop'),
(3, 'Mobil');

-- --------------------------------------------------------

--
-- Struktura tabulky `os`
--

CREATE TABLE `os` (
  `id` int UNSIGNED NOT NULL,
  `title` char(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Vypisuji data pro tabulku `os`
--

INSERT INTO `os` (`id`, `title`) VALUES
(1, 'Windows'),
(2, 'Linux'),
(3, 'macOS'),
(4, 'iOS'),
(5, 'Android');

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`id`),
  ADD KEY `device_device_type` (`device_type_id`),
  ADD KEY `device_os` (`os_id`);

--
-- Indexy pro tabulku `device_type`
--
ALTER TABLE `device_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `os`
--
ALTER TABLE `os`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `device`
--
ALTER TABLE `device`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pro tabulku `device_type`
--
ALTER TABLE `device_type`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pro tabulku `os`
--
ALTER TABLE `os`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `device`
--
ALTER TABLE `device`
  ADD CONSTRAINT `device_device_type` FOREIGN KEY (`device_type_id`) REFERENCES `device_type` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `device_os` FOREIGN KEY (`os_id`) REFERENCES `os` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;
