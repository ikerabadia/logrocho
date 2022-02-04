-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-02-2022 a las 12:21:57
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `logrocho`
--
CREATE DATABASE IF NOT EXISTS `logrocho` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `logrocho`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

CREATE TABLE `likes` (
  `idLike` int(11) NOT NULL,
  `fkUsuario` int(11) DEFAULT NULL,
  `fkReseña` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pinchos`
--

CREATE TABLE `pinchos` (
  `idPincho` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `precio` double NOT NULL,
  `fkBar` int(11) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pinchos`
--

INSERT INTO `pinchos` (`idPincho`, `nombre`, `precio`, `fkBar`, `descripcion`) VALUES
(1, 'pincho1', 10, 1, 'Pincho 1 del Restaurante 1'),
(2, 'croquetas', 13, 2, 'croquetas rikas'),
(4, 'jamon', 3, 10, 'plato de jamon serrano'),
(5, 'zapatilla', 4, 13, 'zapatilla de jamon '),
(6, 'champiñones', 2, 2, 'champiñones de Pradejon'),
(7, 'pan', 1, 12, 'Si, solo pan pero esta bueno'),
(14, 'calamares', 5, 13, 'calamares fritos'),
(16, 'aceitunas', 1, 10, 'Un platito de aceitunas'),
(17, 'tigre', 1, 12, 'tigres fritos, especialidad de la casa'),
(18, 'mejillones', 9, 13, 'Mejillones en salsa'),
(19, 'Pate con tostadas', 6, 14, 'pate casero con tostadas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reseñas`
--

CREATE TABLE `reseñas` (
  `idReseña` int(11) NOT NULL,
  `fkUsuario` int(11) NOT NULL,
  `fkPincho` int(11) NOT NULL,
  `nota` int(11) NOT NULL,
  `textoReseña` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reseñas`
--

INSERT INTO `reseñas` (`idReseña`, `fkUsuario`, `fkPincho`, `nota`, `textoReseña`) VALUES
(1, 1, 1, 6, 'Muy rico pero feo'),
(2, 1, 1, 3, 'kemalo puag'),
(4, 2, 2, 9, 'aiboludo keweno'),
(5, 2, 2, 8, 'muy rikas las kroketitas :O'),
(6, 2, 2, 5, 'croquetas pochas x.X'),
(7, 2, 2, 3, 'terribles kroquetillas las de mi abuela estan mas rikas'),
(8, 2, 2, 7, 'noestan mal'),
(9, 2, 2, 1, 'las peores croketas ke probe en mi vida boludo'),
(10, 2, 2, 9, 'pero kewenas estan estas croqueottas siuuu'),
(11, 2, 2, 10, 'las mejores croquetas ke probe en mi vida jeje'),
(12, 2, 2, 6, 'las mias tan mas ricas pero weno no estan mal'),
(13, 2, 2, 10, 'Me hallo agradecido a Dios pues me ha permitido probar estas croquetas angelicales, Amén');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurantes`
--

CREATE TABLE `restaurantes` (
  `idRestaurante` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `localizacion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `restaurantes`
--

INSERT INTO `restaurantes` (`idRestaurante`, `nombre`, `descripcion`, `localizacion`) VALUES
(1, 'Restaurante 1', 'Pincho 1 del Restaurante 1', 'Calle Laurel Nº 13'),
(2, 'Restaurante3', 'Descripcion restaurante 3', 'Localizacion restaurante 3'),
(8, 'Restaurante4', 'Descripcion restaurante 4', 'Localizacion restaurante 4'),
(9, 'Restaurante5', 'Descripcion restaurante 5', 'Localizacion restaurante 5'),
(10, 'Restaurante6', 'Descripcion restaurante 6', 'Localizacion restaurante 6'),
(11, 'Restaurante7', 'Descripcion restaurante 7', 'Localizacion restaurante 7'),
(12, 'Restaurante8', 'Descripcion restaurante 8', 'Localizacion restaurante 8'),
(13, 'Restaurante9', 'Descripcion restaurante 9', 'Localizacion restaurante 9'),
(14, 'Restaurante10', 'Descripcion restaurante 10', 'Localizacion restaurante 10'),
(16, 'Restaurante12', 'Descripcion restaurante 12', 'Localizacion restaurante 12'),
(17, 'Restaurante 13', 'Descripcion restaurante 13', 'Localizacion restaurante 13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido1` varchar(50) NOT NULL,
  `apellido2` varchar(50) NOT NULL,
  `correoElectronico` varchar(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombre`, `apellido1`, `apellido2`, `correoElectronico`, `user`, `password`, `admin`) VALUES
(1, 'admin', 'admin', 'admin', 'admin@admin.com', 'admin', 'admin', 1),
(2, 'usuario11', 'apellido1', 'apellido1_1', 'usuario1@usuario1.com', 'usuario11', 'usuario11', 1),
(4, 'iker', 'abadia', 'conejos', 'ikerabadiaconejos@gmail.com', 'ikerabadia', 'org', 1),
(6, 'nicolas', 'yeti', 'nieve', 'nicoyeti@gmail.com', 'nicoyeti', 'nicoyeti', 0),
(7, 'jesus', 'hijo', 'dios', 'jesusdios@gmail.com', 'jesusdios', 'jesusdios', 0),
(8, 'baki', 'hanma', 'pelion', 'bakihanma@gmail.com', 'bakihanma', 'bakihanma', 0),
(9, 'mike', 'tyson', 'tyson', 'miketyson@gmail.com', 'miketyson', 'miketyson', 0),
(10, 'rafael', 'nadal', 'nadal', 'rafanadal@gmail.com', 'rafanadal', 'rafanadal', 0),
(11, 'cristiano', 'ronaldo', 'dosantos', 'elbicho@gmail.com', 'serresiete', 'serresiete', 0),
(12, 'lionel', 'messi', 'pulga', 'lapulga@gmail.com', 'messi', 'messi', 0),
(13, 'dwaine', 'jonson', 'therock', 'therock@gmail.com', 'therock', 'therock', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`idLike`),
  ADD KEY `fkReseña` (`fkReseña`),
  ADD KEY `fkUsuario` (`fkUsuario`);

--
-- Indices de la tabla `pinchos`
--
ALTER TABLE `pinchos`
  ADD PRIMARY KEY (`idPincho`),
  ADD KEY `fk_restaurante` (`fkBar`);

--
-- Indices de la tabla `reseñas`
--
ALTER TABLE `reseñas`
  ADD PRIMARY KEY (`idReseña`),
  ADD KEY `fk_usuario` (`fkUsuario`),
  ADD KEY `fk_pincho` (`fkPincho`);

--
-- Indices de la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  ADD PRIMARY KEY (`idRestaurante`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `likes`
--
ALTER TABLE `likes`
  MODIFY `idLike` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pinchos`
--
ALTER TABLE `pinchos`
  MODIFY `idPincho` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `reseñas`
--
ALTER TABLE `reseñas`
  MODIFY `idReseña` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  MODIFY `idRestaurante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`fkReseña`) REFERENCES `reseñas` (`idReseña`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`fkUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pinchos`
--
ALTER TABLE `pinchos`
  ADD CONSTRAINT `fk_restaurante` FOREIGN KEY (`fkBar`) REFERENCES `restaurantes` (`idRestaurante`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reseñas`
--
ALTER TABLE `reseñas`
  ADD CONSTRAINT `fk_pincho` FOREIGN KEY (`fkPincho`) REFERENCES `pinchos` (`idPincho`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`fkUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
