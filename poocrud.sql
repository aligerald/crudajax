-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 07-07-2022 a las 17:37:15
-- Versión del servidor: 8.0.29-0ubuntu0.20.04.3
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `poocrud`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persons`
--

CREATE TABLE `persons` (
  `id_per` int NOT NULL,
  `name_per` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8_spanish_ci NOT NULL,
  `lastname_per` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8_spanish_ci NOT NULL,
  `datebirth_per` date NOT NULL,
  `address_per` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8_spanish_ci NOT NULL,
  `phone_per` int NOT NULL,
  `email_per` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `persons`
--

INSERT INTO `persons` (`id_per`, `name_per`, `lastname_per`, `datebirth_per`, `address_per`, `phone_per`, `email_per`) VALUES
(1, 'Edwin Ivan', 'Calderon G', '1995-01-15', 'Bilbao', 310, 'edwin@gmail.com'),
(3, 'Gabriela', 'Camacho', '2012-10-30', 'El Porvenir', 311, 'gaby@gmail.com'),
(5, 'Dina M', 'Alvarez', '2022-07-02', '4343re', 2121, '22112'),
(6, 'Laur', 'Mar', '2022-07-12', 'Calle', 321, 'lau@gma.com'),
(7, 'Carmen', 'Rincon', '2021-08-08', 'Boyaca', 32145, 'carmen@gmail.com'),
(8, 'Carmen', 'Rincon', '2021-08-08', 'Boyaca', 32145, 'carmen@gmail.com'),
(9, 'Luca', 'Lombardi', '1998-02-13', 'Lond', 4577, 'luquita@gmail.com'),
(10, 'Mariano', 'Gustamante', '1996-06-12', 'Vainilla', 657788, 'mari@gmail.com'),
(11, 'Luis', 'Bernal', '2020-07-08', 'Calle 1', 678, 'lucho@gmail.es'),
(12, 'Luna', 'Calderon', '2010-07-15', 'Interior 15', 310, 'lunita@.com'),
(13, 'Dina', 'Alvarez', '2022-06-26', 'bosa', 300, 'dinaalvare@gmail.com'),
(14, 'Carolain', 'Bit01', '2022-07-05', 'Hospital Las Margaritas', 321, 'carolain@gmail.01'),
(15, 'Wendy', 'Calderon', '1997-06-21', 'Bilbao', 3, 'wendygmail.com'),
(16, 'Oswaldo', 'Ruiz', '2022-07-04', 'Londrss', 3578, 'lon@gm');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `persons`
--
ALTER TABLE `persons`
  ADD PRIMARY KEY (`id_per`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `persons`
--
ALTER TABLE `persons`
  MODIFY `id_per` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
