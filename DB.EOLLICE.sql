-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 29-05-2014 a las 17:21:28
-- Versión del servidor: 5.5.37-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `eollice_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compania_ejecutor`
--

CREATE TABLE IF NOT EXISTS `compania_ejecutor` (
  `id_compania` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `proyectos_realizados` int(11) DEFAULT NULL,
  `potencia_instalada` int(11) DEFAULT NULL,
  `pagina_web` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_compania`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `compania_ejecutor`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE IF NOT EXISTS `contacto` (
  `id_contacto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `mensaje` text NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id_contacto`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=73 ;

--
-- Volcado de datos para la tabla `contacto`
--


--
-- Estructura de tabla para la tabla `cuentas_bancarias`
--

CREATE TABLE IF NOT EXISTS `cuentas_bancarias` (
  `id_cuenta` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `numero_cuenta_banco` varchar(255) NOT NULL,
  `banco` varchar(255) NOT NULL,
  `tipo_de_cuenta` varchar(255) NOT NULL,
  PRIMARY KEY (`id_cuenta`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=136 ;

--
-- Volcado de datos para la tabla `cuentas_bancarias`
--
--------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_usuario`
--

CREATE TABLE IF NOT EXISTS `datos_usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `ubicacion` varchar(255) NOT NULL,
  `tipo_usuario` int(1) NOT NULL,
  `breve_descripcion` varchar(255) DEFAULT NULL,
  `domicilio` varchar(255) NOT NULL,
  `rut` varchar(15) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `datos_usuario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_proyectos`
--

CREATE TABLE IF NOT EXISTS `imagenes_proyectos` (
  `id_proyecto` int(11) DEFAULT NULL,
  `id_imagen` int(11) NOT NULL DEFAULT '0',
  `source` varchar(255) DEFAULT NULL,
  `portrait` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_imagen`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `imagenes_proyectos`
--
----------------------------------

--
-- Estructura de tabla para la tabla `inversion_proyecto`
--

CREATE TABLE IF NOT EXISTS `inversion_proyecto` (
  `id_inversion` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `codigo_khipu` text NOT NULL,
  `codigo_transfer` varchar(15) NOT NULL,
  `monto_inversion` int(11) NOT NULL,
  `coi` int(11) NOT NULL,
  `fecha_inversion` datetime NOT NULL,
  `token_transaccion` varchar(255) NOT NULL,
  `id_proyecto` int(11) DEFAULT NULL,
  `id_cuenta_bancaria` int(11) DEFAULT NULL,
  `confirmado` tinyint(1) DEFAULT NULL,
  `preconfirmado` int(1) NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY (`id_inversion`),
  KEY `fk_inversion_proyecto_users1_idx` (`id_user`),
  KEY `fk_inversion_proyecto_proyecto1_idx` (`id_proyecto`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=106 ;

--
-- Volcado de datos para la tabla `inversion_proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listado_bancos`
--

CREATE TABLE IF NOT EXISTS `listado_bancos` (
  `id_banco` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `web` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_banco`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Volcado de datos para la tabla `listado_bancos`
--

INSERT INTO `listado_bancos` (`id_banco`, `nombre`, `location`, `web`) VALUES
(1, 'Banco BICE', 'Teatinos 220, Santiago', 'www.bice.cl'),
(2, 'Banco de Chile', 'Ahumada 251, Santiago', 'www.bancochile.cl'),
(3, 'Banco Consorcio', 'Av. El Bosque Sur 130, piso 7, Las Condes, Santiago', 'www.bancoconsorcio.cl'),
(4, 'Banco de Crédito e Inversiones', 'Huérfanos 1134, Santiago', 'www.bci.cl'),
(5, 'Banco de la Nación Argentina', 'Morandé 223, Santiago', 'www.bnach.cl'),
(6, 'Banco do Brasil', 'Apoquindo 3001, Las Condes, Santiago', 'www.bb.com.br'),
(7, 'Banco Falabella', 'Moneda 970, piso 7, Santiago', 'www.bancofalabella.cl'),
(8, 'Banco Internacional', 'Moneda 818, Santiago', 'www.bancointernacional.cl'),
(9, 'Banco Itaú Chile', 'Enrique Foster Sur 20, Las Condes, Santiago', 'www.itau.cl'),
(10, 'Banco Paris', 'Morandé 115, piso 4, Santiago', 'www.bancoparis.cl'),
(11, 'Banco Penta', 'Av. El Bosque Norte 0440, piso 14, Las Condes, Santiago', 'www.bancopenta.cl'),
(12, 'Banco Ripley', 'Húerfanos 1060, entrepiso, Santiago', 'www.bancoripley.cl'),
(13, 'Banco Santander-Chile', 'Bandera 140, Santiago', 'www.santandersantiago.cl'),
(14, 'Banco Security', 'Apoquindo 3150, Las Condes, Santiago', 'www.security.cl'),
(15, 'BBVA', 'Pedro de Valdivia 100, piso 17, Providencia, Santiago', 'www.bbva.cl'),
(16, 'CorpBanca', 'Huérfanos 1072, Santiago', 'www.corpbanca.cl'),
(17, 'Deutsche Bank', 'Av. El Bosque Sur 130, piso 5, Las Condes, Santiago', ''),
(18, 'HSBC Bank Chile', 'Av. Isidora Goyenechea 2800, piso 23, Las Condes, Santiago', 'www.hsbc.cl'),
(19, 'JPMorgan Chase Bank', 'Mariano Sánchez Fontecilla 310, piso 9, Las Condes, Santiago', 'www.jpmorganchase.com'),
(20, 'Rabobank Chile', 'Av. del Valle 714, Ciudad Empresarial, Huechuraba, Santiago', 'www.rabobank.cl'),
(21, 'Scotiabank Chile', 'Morandé 226, Santiago', 'www.scotiabank.cl'),
(22, 'The Bank of Tokyo-Mitsubishi UFJ, Ltd.', 'Mariano Sánchez Fontecilla 310, of. 701-C, Las Condes, Santiago', NULL),
(23, 'Banco Estado', NULL, 'http://www.bancoestado.cl#sthash.zzWv5oBr.dpuf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_espera`
--

CREATE TABLE IF NOT EXISTS `lista_espera` (
  `id_lista` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id_lista`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=85 ;

--
-- Volcado de datos para la tabla `lista_espera`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_n`
--

CREATE TABLE IF NOT EXISTS `pago_n` (
  `id_pago` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `numero_pago` varchar(50) DEFAULT NULL,
  `fecha_transaccion` datetime DEFAULT NULL,
  `total_pagado` int(11) DEFAULT NULL,
  `interes` int(4) DEFAULT NULL,
  `nocional` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_pago`),
  KEY `fk_pago_n_users1_idx` (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE IF NOT EXISTS `proyecto` (
  `id_proyecto` int(11) NOT NULL AUTO_INCREMENT,
  `tecnologia` varchar(255) DEFAULT NULL,
  `tamano` float(10,2) DEFAULT NULL,
  `energia_anual` int(11) DEFAULT NULL,
  `toneladas_co2` int(11) DEFAULT NULL,
  `marca_equipo` varchar(255) DEFAULT NULL,
  `garantia_equipo` int(2) DEFAULT NULL,
  `marca_inversor` varchar(255) DEFAULT NULL,
  `garantia_inversor` int(2) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_compania` int(11) DEFAULT NULL,
  `garantia_inversion` int(3) DEFAULT NULL,
  `deadline` datetime NOT NULL,
  `inicio_date` datetime NOT NULL,
  `financiado` tinyint(4) NOT NULL,
  `landing` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_proyecto`),
  KEY `fk_proyecto_datos_usuario1_idx` (`id_usuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `proyecto`
--
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resumen`
--

CREATE TABLE IF NOT EXISTS `resumen` (
  `id_proyecto` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) DEFAULT NULL,
  `breve_descripcion` varchar(255) DEFAULT NULL,
  `tasa_interes_anual` int(4) DEFAULT NULL,
  `plazo` int(2) DEFAULT NULL,
  `monto_total` int(11) DEFAULT NULL,
  `tir` int(2) DEFAULT NULL,
  `info_detail` text NOT NULL,
  `contrato` text NOT NULL,
  PRIMARY KEY (`id_proyecto`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Volcado de datos para la tabla `resumen`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `session_log`
--

CREATE TABLE IF NOT EXISTS `session_log` (
  `token` varchar(255) NOT NULL DEFAULT '',
  `id_user` int(11) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `session_log`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8 NOT NULL,
  `lastname_father` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `lastname_mother` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `active` tinyint(1) NOT NULL,
  `opeToken` text CHARACTER SET utf8 NOT NULL,
  `recoverToken` varchar(255) CHARACTER SET utf8 NOT NULL,
  `rut` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `telefono` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `domicilio` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `numero_domicilio` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `numero_depto` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `edificio` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `ciudad` varchar(255) CHARACTER SET utf8 NOT NULL,
  `complete` int(1) NOT NULL,
  `comuna` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC AUTO_INCREMENT=667 ;

--
-- Volcado de datos para la tabla `users`
-
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
