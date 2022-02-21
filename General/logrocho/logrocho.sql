-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-02-2022 a las 15:50:57
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
-- Estructura de tabla para la tabla `imagenes_bares`
--

CREATE TABLE `imagenes_bares` (
  `id` int(11) NOT NULL,
  `fk_bar` int(11) NOT NULL,
  `imagen` text NOT NULL,
  `numeroImagen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `imagenes_bares`
--

INSERT INTO `imagenes_bares` (`id`, `fk_bar`, `imagen`, `numeroImagen`) VALUES
(10, 1, 'http://localhost/logrocho/imagenes/restaurantes/1/imagen2/tabernaTioBlas2.png', 2),
(12, 1, 'http://localhost/logrocho/imagenes/restaurantes/1/imagen1/tabernaTioBlas1.jfif', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_pincho`
--

CREATE TABLE `imagenes_pincho` (
  `id` int(11) NOT NULL,
  `fk_pincho` int(11) NOT NULL,
  `imagen` text NOT NULL,
  `numeroImagen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `imagenes_pincho`
--

INSERT INTO `imagenes_pincho` (`id`, `fk_pincho`, `imagen`, `numeroImagen`) VALUES
(1, 1, 'http://localhost/logrocho/imagenes/pinchos/1/imagen1/imgPincho1.jpg', 1),
(3, 1, 'http://localhost/logrocho/imagenes/pinchos/1/imagen2/imgPincho2.jpg', 2),
(4, 1, 'http://localhost/logrocho/imagenes/pinchos/1/imagen3/imgPincho3.jpg', 3),
(18, 22, 'http://localhost/logrocho/imagenes/pinchos/22/imagen1/R.jfif', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_usuarios`
--

CREATE TABLE `imagenes_usuarios` (
  `id` int(11) NOT NULL,
  `imagen` text NOT NULL,
  `fk_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `imagenes_usuarios`
--

INSERT INTO `imagenes_usuarios` (`id`, `imagen`, `fk_usuario`) VALUES
(6, 'http://localhost/logrocho/imagenes/usuarios/2/pepe.jfif', 2),
(18, 'http://localhost/logrocho/imagenes/usuarios/4/Yeti.png', 4),
(19, 'http://localhost/logrocho/imagenes/usuarios/6/3988591_yeti_copier.jpg', 6),
(20, 'http://localhost/logrocho/imagenes/usuarios/7/B1p9NtRF8rS._SS500_.jpg', 7),
(21, 'http://localhost/logrocho/imagenes/usuarios/8/171127170442-02-yeti-or-not-large-169.jpg', 8),
(22, 'http://localhost/logrocho/imagenes/usuarios/9/Minionmorado.jpg', 9),
(24, 'http://localhost/logrocho/imagenes/usuarios/1/Captura.PNG', 1),
(25, 'http://localhost/logrocho/imagenes/usuarios/10/hqdefault.jpg', 10),
(26, 'http://localhost/logrocho/imagenes/usuarios/11/broob-broseidon.gif', 11);

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
(19, 'Pate con tostadas', 6, 14, 'pate casero con tostadas'),
(21, 'Muslo de pollo', 4.25, 20, 'Muslo de pollo de la taberna del tio blas, asado a la leña y con patatas'),
(22, 'Tortilla de patatas', 3.5, 1, 'Tortilla de patatas sin cebolla muy jugosa y con chorizo ');

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
(13, 2, 2, 10, 'Me hallo agradecido a Dios pues me ha permitido probar estas croquetas angelicales, Amén'),
(17, 7, 2, 7, 'Unas croquetas en un buen punto de fritura pero la bechamel un poco sosa');

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
(17, 'Restaurante 13', 'Descripcion restaurante 13', 'Localizacion restaurante 13'),
(19, 'El riko pincho', 'El mejor restaurante de la calle laurel asegurado', 'Calle laurel 32'),
(20, 'La taberna del tio blas', 'Pinchos muy buenos, cachopos, chuletas, chuletones, y mucho mas', 'Calle laurel 17'),
(21, 'El bar de los champiñones', 'Los champiñones mas ricos de todo Logroño, solo aqui en la laurel', 'Calle laurel 78'),
(22, 'Tortillas S.A', 'Tortillas muy buenas solo en nuestro restaurante.\nGanamos un premio el año pasado', 'Calle laurel 12');

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
(13, 'dwaine', 'jonson', 'therock', 'therock@gmail.com', 'therock', 'therock', 0),
(14, 'prueba1', 'prueba1', 'prueba1', 'prueba1@gmail.com', 'prueba1', 'prueba1', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `imagenes_bares`
--
ALTER TABLE `imagenes_bares`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurante` (`fk_bar`);

--
-- Indices de la tabla `imagenes_pincho`
--
ALTER TABLE `imagenes_pincho`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pincho` (`fk_pincho`);

--
-- Indices de la tabla `imagenes_usuarios`
--
ALTER TABLE `imagenes_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fk_usuario` (`fk_usuario`);

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
-- AUTO_INCREMENT de la tabla `imagenes_bares`
--
ALTER TABLE `imagenes_bares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `imagenes_pincho`
--
ALTER TABLE `imagenes_pincho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `imagenes_usuarios`
--
ALTER TABLE `imagenes_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `likes`
--
ALTER TABLE `likes`
  MODIFY `idLike` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pinchos`
--
ALTER TABLE `pinchos`
  MODIFY `idPincho` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `reseñas`
--
ALTER TABLE `reseñas`
  MODIFY `idReseña` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  MODIFY `idRestaurante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `imagenes_bares`
--
ALTER TABLE `imagenes_bares`
  ADD CONSTRAINT `imagenes_bares_ibfk_1` FOREIGN KEY (`fk_bar`) REFERENCES `restaurantes` (`idRestaurante`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `imagenes_pincho`
--
ALTER TABLE `imagenes_pincho`
  ADD CONSTRAINT `imagenes_pincho_ibfk_1` FOREIGN KEY (`fk_pincho`) REFERENCES `pinchos` (`idPincho`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `imagenes_usuarios`
--
ALTER TABLE `imagenes_usuarios`
  ADD CONSTRAINT `imagenes_usuarios_ibfk_1` FOREIGN KEY (`fk_usuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

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
