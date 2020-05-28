-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 31-05-2018 a las 02:43:40
-- Versión del servidor: 5.5.20
-- Versión de PHP: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `simple_invoice`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arte`
--

CREATE TABLE IF NOT EXISTS `arte` (
  `id_especie` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_especie` int(11) NOT NULL,
  `nombre_especie` varchar(50) NOT NULL,
  `status_especie` varchar(50) NOT NULL,
  `date_added` date NOT NULL,
  `precio_especie` varchar(50) NOT NULL,
  PRIMARY KEY (`id_especie`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
 
-- --------------------------------------------------------

--


--
- 

--
-- Estructura de tabla para la tabla `detalle_desembarques`
--

CREATE TABLE IF NOT EXISTS `detalle_desembarques` (
  `id_desembarque` int(11) NOT NULL AUTO_INCREMENT,
  `numero_desembarque` int(11) NOT NULL,
  `id_especie` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` double NOT NULL,
  PRIMARY KEY (`id_desembarque`),
 
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
 

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `desembarque`
--

CREATE TABLE IF NOT EXISTS `desembarques` (
  `id_desembarque` int(11) NOT NULL AUTO_INCREMENT,
  `numero_desembarque` int(11) NOT NULL,
  `fecha_desembarque` date NOT NULL,
  `id_embarcacion` int(11) NOT NULL,
  `id_puerto` int(11) NOT NULL,
  `condiciones` varchar(30) NOT NULL,
  `total_venta` varchar(20) NOT NULL,
  `estado_desembarque` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_desembarque`),
 
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 
--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
  `id_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_empresa` varchar(150) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `codigo_postal` varchar(100) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(64) NOT NULL,
  `impuesto` int(2) NOT NULL,
  `moneda` varchar(6) NOT NULL,
  `logo_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id_perfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id_perfil`, `nombre_empresa`, `direccion`, `ciudad`, `codigo_postal`, `estado`, `telefono`, `email`, `impuesto`, `moneda`, `logo_url`) VALUES
(1, 'SISTEMAS DE GESTION PESQUERA', 'FFDGF', 'GFDGDF', 'GDFGDG', 'DFGDF', 'GDFG', 'GDFGDFG', 0, '', 'img/1478792451_google30.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especies`
--

CREATE TABLE IF NOT EXISTS `especies` (
  `id_especie` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_especie` char(20) NOT NULL,
  `nombre_especie` char(255) NOT NULL,
  `status_especie` tinyint(4) NOT NULL,
  `date_added` datetime NOT NULL,
  `precio_especie` double NOT NULL,
  PRIMARY KEY (`id_especie`),
 
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcado de datos para la tabla `products`
--

 

  

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmp`
--

CREATE TABLE IF NOT EXISTS `tmp` (
  `id_tmp` int(11) NOT NULL AUTO_INCREMENT,
  `id_especie` int(11) NOT NULL,
  `cantidad_tmp` int(11) NOT NULL,
  `precio_tmp` double(8,2) DEFAULT NULL,
  `session_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_tmp`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puerto_base`
--

CREATE TABLE IF NOT EXISTS `puerto_base` (
  `id_puerto` int(11) NOT NULL AUTO_INCREMENT COMMENT,
  `nombre_puerto` varchar(20) NOT NULL,
  `direccion_puerto` varchar(20)  NOT NULL,
  `municipio` varchar(64)   NOT NULL COMMENT  ,
  `inspectoria` varchar(255)  NOT NULL COMMENT  ,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id_puerto`),
 
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci  AUTO_INCREMENT=1 ;

--
