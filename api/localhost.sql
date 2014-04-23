-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 15-04-2014 a las 00:41:52
-- Versión del servidor: 5.5.35
-- Versión de PHP: 5.3.10-1ubuntu3.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `flisol`
--
CREATE DATABASE `flisol` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `flisol`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `api_key`
--

CREATE TABLE IF NOT EXISTS `api_key` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `key` varchar(100) NOT NULL,
  `vencimiento` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usuario_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`),
  KEY `FKapi_key949879` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `api_key`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE IF NOT EXISTS `ciudad` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`id`, `nombre`) VALUES
(1, 'FLORENCIA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE IF NOT EXISTS `comentario` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL,
  `estado_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKcomentario493735` (`estado_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `comentario`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE IF NOT EXISTS `equipo` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(30) NOT NULL,
  `marca` varchar(30) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `persona_id` int(10) NOT NULL,
  `evento_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `dueno` (`persona_id`),
  KEY `FKequipo378048` (`evento_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `equipo`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE IF NOT EXISTS `estado` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tiempo` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tipo` enum('INGRESO','EN_INSTALACION','INSTALANDO','CONFIGURANDO','TERMINANDO','SALIDA','EN_RECEPCION','ENTREGADO') NOT NULL,
  `equipo_id` int(10) NOT NULL,
  `persona_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tipo` (`tipo`),
  UNIQUE KEY `equipo_id` (`equipo_id`),
  KEY `FKestado729101` (`equipo_id`),
  KEY `participante` (`persona_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `estado`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE IF NOT EXISTS `evento` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `organizador_id` int(10) NOT NULL,
  `version_id` int(10) NOT NULL,
  `sede_id` int(10) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `fecha_inicial` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fecha_final` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `FKevento909108` (`sede_id`),
  KEY `FKevento881320` (`organizador_id`),
  KEY `FKevento216800` (`version_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `evento`
--

INSERT INTO `evento` (`id`, `organizador_id`, `version_id`, `sede_id`, `estado`, `fecha_inicial`, `fecha_final`) VALUES
(1, 1, 1, 1, 'ACTIVO', '2014-04-30 08:00:00', '2014-04-30 20:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `organizador`
--

CREATE TABLE IF NOT EXISTS `organizador` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `logo` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `organizador`
--

INSERT INTO `organizador` (`id`, `nombre`, `descripcion`, `logo`) VALUES
(1, 'AULUA', 'Asociaciòn de Usuarios Linux de la Universidad de la Amazonia', 'img/aulua.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participante`
--

CREATE TABLE IF NOT EXISTS `participante` (
  `usuario_id` int(10) NOT NULL,
  `evento_id` int(10) NOT NULL,
  `rol` enum('RECEPCIONISTA','INSTALADOR','DIRECTOR_INSTALACION','TRANSPORTADOR','ADMINISTRADOR') NOT NULL,
  PRIMARY KEY (`usuario_id`,`evento_id`),
  KEY `FKparticipan320372` (`usuario_id`),
  KEY `FKparticipan138855` (`evento_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `participante`
--

INSERT INTO `participante` (`usuario_id`, `evento_id`, `rol`) VALUES
(1, 1, 'RECEPCIONISTA'),
(2, 1, 'INSTALADOR'),
(3, 1, 'DIRECTOR_INSTALACION'),
(4, 1, 'TRANSPORTADOR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE IF NOT EXISTS `persona` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `documento` varchar(30) NOT NULL,
  `tipo_documento` enum('CEDULA','TARJETA IDENTIDAD','PASE','CARNET_UNIVERSIDAD') NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `email` varchar(200) NOT NULL,
  `imagen` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `documento`, `tipo_documento`, `nombre`, `telefono`, `email`, `imagen`) VALUES
(1, '1117516483', 'CEDULA', 'Sergio Andrés Ñustes', '3115561825', 'infinito84@gmail.com', 'img/sergio.png'),
(2, '1118021357', 'CEDULA', 'Cristiam Diaz', '3144681029', 'c.diaz@udla.edu.co', 'img/cristiam.png'),
(3, '1094905443', 'CEDULA', 'Juan David Echeverry', '', 'ingenierojuand@gmail.com', 'img/juan.png'),
(4, '1132', 'CEDULA', 'ASDF', '651561', '', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sede`
--

CREATE TABLE IF NOT EXISTS `sede` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `ciudad_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKsede816815` (`ciudad_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `sede`
--

INSERT INTO `sede` (`id`, `nombre`, `direccion`, `ciudad_id`) VALUES
(1, 'Universidad de la Amazonia', 'Calle 17 Diagonal 17 con Carrera 3F - Barrio Porvenir', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(30) NOT NULL,
  `clave` varchar(80) NOT NULL,
  `persona_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKusuario234753` (`persona_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `usuario`, `clave`, `persona_id`) VALUES
(1, 'sergio', '3bffa4ebdf4874e506c2b12405796aa5', 1),
(2, 'cristiam', '7c924a80ba0322956c768ebc0a74da31', 2),
(3, 'juan', 'a94652aa97c7211ba8954dd15a3cf838', 3),
(4, 'anonimo', 'anonimo', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `version`
--

CREATE TABLE IF NOT EXISTS `version` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `version`
--

INSERT INTO `version` (`id`, `descripcion`) VALUES
(1, 'FLISOL X - 2014');

--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `api_key`
--
ALTER TABLE `api_key`
  ADD CONSTRAINT `FKapi_key949879` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `FKcomentario493735` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`id`);

--
-- Filtros para la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD CONSTRAINT `FKequipo378048` FOREIGN KEY (`evento_id`) REFERENCES `evento` (`id`),
  ADD CONSTRAINT `dueno` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`);

--
-- Filtros para la tabla `estado`
--
ALTER TABLE `estado`
  ADD CONSTRAINT `FKestado729101` FOREIGN KEY (`equipo_id`) REFERENCES `equipo` (`id`),
  ADD CONSTRAINT `participante` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`);

--
-- Filtros para la tabla `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `FKevento216800` FOREIGN KEY (`version_id`) REFERENCES `version` (`id`),
  ADD CONSTRAINT `FKevento881320` FOREIGN KEY (`organizador_id`) REFERENCES `organizador` (`id`),
  ADD CONSTRAINT `FKevento909108` FOREIGN KEY (`sede_id`) REFERENCES `sede` (`id`);

--
-- Filtros para la tabla `participante`
--
ALTER TABLE `participante`
  ADD CONSTRAINT `FKparticipan138855` FOREIGN KEY (`evento_id`) REFERENCES `evento` (`id`),
  ADD CONSTRAINT `FKparticipan320372` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `sede`
--
ALTER TABLE `sede`
  ADD CONSTRAINT `FKsede816815` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudad` (`id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FKusuario234753` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`);
