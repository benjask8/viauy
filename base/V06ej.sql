-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jul 31, 2023 at 01:17 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alquiler`
--
DROP DATABASE IF EXISTS `alquiler`;
CREATE DATABASE IF NOT EXISTS `alquiler` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `alquiler`;

-- --------------------------------------------------------

--
-- Table structure for table `alquiler`
--

DROP TABLE IF EXISTS `alquiler`;
CREATE TABLE `alquiler` (
  `id` int(11) NOT NULL,
  `persona_id` int(11) NOT NULL,
  `casa_id` int(11) NOT NULL,
  `duracionMeses` int(11) NOT NULL,
  `costo` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alquiler`
--

INSERT INTO `alquiler` (`id`, `persona_id`, `casa_id`, `duracionMeses`, `costo`) VALUES
(1, 1, 1, 5, '10000'),
(2, 2, 3, 9, '15000');

-- --------------------------------------------------------

--
-- Table structure for table `casa`
--

DROP TABLE IF EXISTS `casa`;
CREATE TABLE `casa` (
  `id` int(11) NOT NULL,
  `calle` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `casa`
--

INSERT INTO `casa` (`id`, `calle`, `numero`) VALUES
(1, 'rivera', 123),
(2, 'canelones', 128),
(3, 'artigas', 236),
(4, 'maldonado', 256);

-- --------------------------------------------------------

--
-- Table structure for table `persona`
--

DROP TABLE IF EXISTS `persona`;
CREATE TABLE `persona` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `persona`
--

INSERT INTO `persona` (`id`, `nombre`) VALUES
(1, 'juan'),
(2, 'maria');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alquiler`
--
ALTER TABLE `alquiler`
  ADD PRIMARY KEY (`id`),
  ADD KEY `casaid` (`casa_id`),
  ADD KEY `personaid` (`persona_id`);

--
-- Indexes for table `casa`
--
ALTER TABLE `casa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alquiler`
--
ALTER TABLE `alquiler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `casa`
--
ALTER TABLE `casa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alquiler`
--
ALTER TABLE `alquiler`
  ADD CONSTRAINT `casaid` FOREIGN KEY (`casa_id`) REFERENCES `casa` (`id`),
  ADD CONSTRAINT `personaid` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
