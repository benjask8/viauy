DROP DATABASE IF EXISTS `f01`;
CREATE DATABASE IF NOT EXISTS `f01` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `f01`;


DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `productos` (`id`, `codigo`, `descripcion`, `precio`, `fecha`, `url`) VALUES
(1, 'codigo01', 'descripcion01', '26.00', '2021-09-15', ''),
(2, 'codigo02', 'descripcion02', '20.90', '2013-08-15', ''),
(5, 'codigo03', 'descripcion03', '2.00', '2020-02-28', ''),
(6, 'codigo04', 'descripcion04', '23.30', '2012-12-30', ''),
(11, 'codigo05', 'desdescripcion05', '26.00', '2013-12-29', '');

ALTER TABLE `productos`
  ADD UNIQUE KEY `codigo` (`codigo`);


