-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-08-2016 a las 19:55:10
-- Versión del servidor: 10.1.10-MariaDB
-- Versión de PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `curriculums`
--
CREATE DATABASE IF NOT EXISTS `curriculums` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `curriculums`;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `avatares`
--
CREATE TABLE `avatares` (
`ID` int(11)
,`Login` varchar(15)
,`Foto` varchar(255)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `IdCategorias` int(11) NOT NULL,
  `NombreCategoria` varchar(45) CHARACTER SET utf32 COLLATE utf32_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`IdCategorias`, `NombreCategoria`) VALUES
(1, 'Básico'),
(2, 'Moda'),
(3, 'Informática'),
(4, 'Administración'),
(5, 'Estética');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `IdComentarios` int(11) NOT NULL,
  `Valoracion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `FechaEntrevista` date DEFAULT NULL,
  `Redactor` int(11) NOT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`IdComentarios`, `Valoracion`, `FechaEntrevista`, `Redactor`, `ID`) VALUES
(2, 'Positiva', NULL, 3, 1),
(3, 'Negativa', NULL, 3, 2);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `curriculums`
--
CREATE TABLE `curriculums` (
`ID` int(11)
,`Login` varchar(15)
,`Email` varchar(100)
,`Nombre` varchar(45)
,`Apellidos` varchar(45)
,`FechaNacimiento` date
,`Direccion` varchar(45)
,`Telefono` varchar(10)
,`Nacionalidad` varchar(45)
,`Foto` varchar(255)
,`DescripcionFR` varchar(45)
,`Categoria` int(11)
,`Titulacion` int(11)
,`FechaTitulo` date
,`NombreFNR` varchar(45)
,`DescripcionFNR` varchar(45)
,`TipoFNR` varchar(45)
,`DescripcionHobbie` varchar(200)
,`NombreHobbie` varchar(45)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos`
--

CREATE TABLE `datos` (
  `titulo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `categoria` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `contenido` text COLLATE utf8_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `datos`
--

INSERT INTO `datos` (`titulo`, `categoria`, `contenido`) VALUES
('contenido', 'contenido', 'Cree un Curriculum exitoso en pocos minutos, gracias a nuestras herramientas de diseño y contenido de plantillas predefinidas totalmente customizables.'),
('Descripcion', 'descripcion_tienda', '<h1>Elige el diseño de tu Curriculum Vitae</h1>\n<p>Elige entre las diferentes plantillas y diseños de CV profesionales\n</p>\n<br />\n<h1>Inserta nuestros ejemplos predefinidos</h1>\n<p>Olvídate de redactar: basta con seleccionar y hacer clic </p>\n<br /><h1>Tu Curriculum ideal en pocos minutos</h1>\n<p>Redactar un Curriculum ideal nunca ha sido tan fácil. Elige uno de nuestros diseños que consiguen trabajos y completa tu Curriculum con nuestras viñetas de texto predefinidas.</p>'),
('Slogan', 'Slogan', '¡¡Sube tu curriculum, y triunfa en el mercado laboral!!'),
('Telefono', 'telefono_tienda', '971 271 388');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datospersonales`
--

CREATE TABLE `datospersonales` (
  `IDdatosPersonales` int(11) NOT NULL,
  `Nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `Apellidos` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `Direccion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Telefono` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Nacionalidad` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `Foto` varchar(255) COLLATE utf8_spanish_ci DEFAULT 'nofoto.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `datospersonales`
--

INSERT INTO `datospersonales` (`IDdatosPersonales`, `Nombre`, `Apellidos`, `FechaNacimiento`, `Direccion`, `Telefono`, `Nacionalidad`, `Foto`) VALUES
(2, 'Miguel', 'Jimenez Mateo', '1990-06-30', 'C/ Lleida nº3', '690652537', 'Española', 'miguel.jpg'),
(3, 'Pepito', 'De los Plotes', '1977-03-09', 'Santa Maria del Camí', '852697185', 'Española', 'david.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudios`
--

CREATE TABLE `estudios` (
  `IDEstudios` int(11) NOT NULL,
  `NombreEstudio` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estudios`
--

INSERT INTO `estudios` (`IDEstudios`, `NombreEstudio`) VALUES
(1, 'Primaria'),
(2, 'ESO'),
(3, 'Bachiller'),
(4, 'FP Grado Medio'),
(5, 'FP Grado Superior'),
(6, 'Universitario'),
(7, 'Máster');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formacionnoreglada`
--

CREATE TABLE `formacionnoreglada` (
  `IdFormacionNoReglada` int(11) DEFAULT NULL,
  `NombreFNR` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `DescripcionFNR` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `TipoFNR` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `formacionnoreglada`
--

INSERT INTO `formacionnoreglada` (`IdFormacionNoReglada`, `NombreFNR`, `DescripcionFNR`, `TipoFNR`, `ID`) VALUES
(2, 'Título Japones', 'Noken5', 'Titulación oficial', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formacionreglada`
--

CREATE TABLE `formacionreglada` (
  `IDFormacionReglada` int(11) DEFAULT NULL,
  `DescripcionFR` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `Categoria` int(11) DEFAULT NULL,
  `Titulacion` int(11) NOT NULL DEFAULT '0',
  `FechaTitulo` date DEFAULT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `formacionreglada`
--

INSERT INTO `formacionreglada` (`IDFormacionReglada`, `DescripcionFR`, `Categoria`, `Titulacion`, `FechaTitulo`, `ID`) VALUES
(2, 'Educación Primaria Básica', 1, 1, '2012-06-21', 1),
(2, 'Título ESO', 1, 2, '2006-06-23', 2),
(3, 'Bachiller', 1, 3, '2016-04-20', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hobbies`
--

CREATE TABLE `hobbies` (
  `IDHobbies` int(11) NOT NULL,
  `DescripcionHobbie` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `NombreHobbie` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `hobbies`
--

INSERT INTO `hobbies` (`IDHobbies`, `DescripcionHobbie`, `NombreHobbie`, `ID`) VALUES
(2, NULL, 'Informática', 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `menucurriculum`
--
CREATE TABLE `menucurriculum` (
`ID` int(11)
,`Nombre` varchar(45)
,`Apellidos` varchar(45)
,`Email` varchar(100)
,`FechaNacimiento` date
,`Direccion` varchar(45)
,`Telefono` varchar(10)
,`Nacionalidad` varchar(45)
,`Foto` varchar(255)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `Login` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `Password` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `Email` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `Tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `Login`, `Password`, `Email`, `Tipo`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', 2),
(2, 'Miguel', '21232f297a57a5a743894a0e4a801fc3', 'miguelito@hotmail.com', 1),
(3, 'RRHH', '21232f297a57a5a743894a0e4a801fc3 	', 'usuario@gmail.com', 3),
(4, 'admin9', '21232f297a57a5a743894a0e4a801fc3', 'ascension9@hotmail.com', 1),
(5, 'admin60', '07e50bb1e7d00649f12f5045e40032a6', 'ascension60@hotmail.com', 1);

-- --------------------------------------------------------

--
-- Estructura para la vista `avatares`
--
DROP TABLE IF EXISTS `avatares`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `avatares`  AS  select `v`.`ID` AS `ID`,`v`.`Login` AS `Login`,`b`.`Foto` AS `Foto` from (`datospersonales` `b` join `usuarios` `v` on((`b`.`IDdatosPersonales` = `v`.`ID`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `curriculums`
--
DROP TABLE IF EXISTS `curriculums`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `curriculums`  AS  select `u`.`ID` AS `ID`,`u`.`Login` AS `Login`,`u`.`Email` AS `Email`,`d`.`Nombre` AS `Nombre`,`d`.`Apellidos` AS `Apellidos`,`d`.`FechaNacimiento` AS `FechaNacimiento`,`d`.`Direccion` AS `Direccion`,`d`.`Telefono` AS `Telefono`,`d`.`Nacionalidad` AS `Nacionalidad`,`d`.`Foto` AS `Foto`,`fr`.`DescripcionFR` AS `DescripcionFR`,`fr`.`Categoria` AS `Categoria`,`fr`.`Titulacion` AS `Titulacion`,`fr`.`FechaTitulo` AS `FechaTitulo`,`fn`.`NombreFNR` AS `NombreFNR`,`fn`.`DescripcionFNR` AS `DescripcionFNR`,`fn`.`TipoFNR` AS `TipoFNR`,`h`.`DescripcionHobbie` AS `DescripcionHobbie`,`h`.`NombreHobbie` AS `NombreHobbie` from ((((`usuarios` `u` join `datospersonales` `d` on((`u`.`ID` = `d`.`IDdatosPersonales`))) join `formacionreglada` `fr` on((`u`.`ID` = `fr`.`IDFormacionReglada`))) join `formacionnoreglada` `fn` on((`u`.`ID` = `fn`.`IdFormacionNoReglada`))) join `hobbies` `h` on((`u`.`ID` = `h`.`IDHobbies`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `menucurriculum`
--
DROP TABLE IF EXISTS `menucurriculum`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `menucurriculum`  AS  select `u`.`ID` AS `ID`,`d`.`Nombre` AS `Nombre`,`d`.`Apellidos` AS `Apellidos`,`u`.`Email` AS `Email`,`d`.`FechaNacimiento` AS `FechaNacimiento`,`d`.`Direccion` AS `Direccion`,`d`.`Telefono` AS `Telefono`,`d`.`Nacionalidad` AS `Nacionalidad`,`d`.`Foto` AS `Foto` from (`usuarios` `u` join `datospersonales` `d` on((`u`.`ID` = `d`.`IDdatosPersonales`))) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`IdCategorias`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Comentarios_ibfk_1` (`IdComentarios`),
  ADD KEY `Comentarios_ibfk_2` (`Redactor`);

--
-- Indices de la tabla `datos`
--
ALTER TABLE `datos`
  ADD PRIMARY KEY (`titulo`);

--
-- Indices de la tabla `datospersonales`
--
ALTER TABLE `datospersonales`
  ADD PRIMARY KEY (`IDdatosPersonales`);

--
-- Indices de la tabla `estudios`
--
ALTER TABLE `estudios`
  ADD PRIMARY KEY (`IDEstudios`);

--
-- Indices de la tabla `formacionnoreglada`
--
ALTER TABLE `formacionnoreglada`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FormacionNoReglada_ibfk_1` (`IdFormacionNoReglada`);

--
-- Indices de la tabla `formacionreglada`
--
ALTER TABLE `formacionreglada`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FormacionReglada_ibfk_1` (`IDFormacionReglada`),
  ADD KEY `FormacionReglada_ibfk_2` (`Categoria`),
  ADD KEY `Titulacion` (`Titulacion`);

--
-- Indices de la tabla `hobbies`
--
ALTER TABLE `hobbies`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Hobbies_ibfk_1` (`IDHobbies`),
  ADD KEY `NombreHobbie` (`NombreHobbie`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `IdCategorias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `estudios`
--
ALTER TABLE `estudios`
  MODIFY `IDEstudios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `formacionnoreglada`
--
ALTER TABLE `formacionnoreglada`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `formacionreglada`
--
ALTER TABLE `formacionreglada`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `hobbies`
--
ALTER TABLE `hobbies`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `Comentarios_ibfk_1` FOREIGN KEY (`IdComentarios`) REFERENCES `usuarios` (`ID`),
  ADD CONSTRAINT `Comentarios_ibfk_2` FOREIGN KEY (`Redactor`) REFERENCES `usuarios` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `datospersonales`
--
ALTER TABLE `datospersonales`
  ADD CONSTRAINT `DatosPersonales_ibfk_1` FOREIGN KEY (`IDdatosPersonales`) REFERENCES `usuarios` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `formacionnoreglada`
--
ALTER TABLE `formacionnoreglada`
  ADD CONSTRAINT `FormacionNoReglada_ibfk_1` FOREIGN KEY (`IdFormacionNoReglada`) REFERENCES `usuarios` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `formacionreglada`
--
ALTER TABLE `formacionreglada`
  ADD CONSTRAINT `FormacionReglada_ibfk_1` FOREIGN KEY (`IDFormacionReglada`) REFERENCES `usuarios` (`ID`),
  ADD CONSTRAINT `FormacionReglada_ibfk_2` FOREIGN KEY (`Categoria`) REFERENCES `categorias` (`IdCategorias`),
  ADD CONSTRAINT `FormacionReglada_ibfk_3` FOREIGN KEY (`Titulacion`) REFERENCES `estudios` (`IDEstudios`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `hobbies`
--
ALTER TABLE `hobbies`
  ADD CONSTRAINT `Hobbies_ibfk_1` FOREIGN KEY (`IDHobbies`) REFERENCES `usuarios` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
