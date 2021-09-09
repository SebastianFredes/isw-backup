-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 01-08-2021 a las 06:07:05
-- Versión del servidor: 8.0.23
-- Versión de PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `empresaa_bd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anexo`
--

CREATE TABLE `anexo` (
  `id_anexos` int NOT NULL,
  `id_contrato` int NOT NULL,
  `descripcion` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion`
--

CREATE TABLE `asignacion` (
  `id_asignacion` int NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `encargado_rut_encargado` int NOT NULL,
  `usuario_id_usuario` int NOT NULL,
  `equipo_id_equipo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `causales`
--

CREATE TABLE `causales` (
  `id_causales` int NOT NULL,
  `caucion_porcentaje` float DEFAULT NULL,
  `horas_incontinuidad_servicio` int DEFAULT NULL,
  `dias_liquidacion_en_contra` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `componentes`
--

CREATE TABLE `componentes` (
  `id_componentes` int NOT NULL,
  `id_tipo_componente` int NOT NULL,
  `perfil_idperfil` int NOT NULL,
  `tipo_modelo` varchar(70) DEFAULT NULL,
  `tipo_descripcion` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `componentes`
--

INSERT INTO `componentes` (`id_componentes`, `id_tipo_componente`, `perfil_idperfil`, `tipo_modelo`, `tipo_descripcion`) VALUES
(1, 1, 1, 'Corsair Vengeance', '8GB DDR4'),
(2, 2, 1, 'Kingston A400', '512GB Sata3 2.5 '),
(3, 4, 1, 'Spektra MS-500', 'Mouse Óptico USB'),
(4, 5, 1, 'Spektra KB-500', 'Number Pad USB Negro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrato`
--

CREATE TABLE `contrato` (
  `id_contrato` int NOT NULL,
  `id_ficha_juridica` int DEFAULT NULL,
  `id_ficha_administrativa` int DEFAULT NULL,
  `duracion_contrato` int DEFAULT NULL,
  `nombrecontrato` varchar(45) DEFAULT NULL,
  `numero_adquisision` int DEFAULT NULL,
  `decreto_universitario` int DEFAULT NULL,
  `fecha_decreto_universitario` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `contrato`
--

INSERT INTO `contrato` (`id_contrato`, `id_ficha_juridica`, `id_ficha_administrativa`, `duracion_contrato`, `nombrecontrato`, `numero_adquisision`, `decreto_universitario`, `fecha_decreto_universitario`) VALUES
(1, 1, NULL, 32, 'Contrato_1', NULL, NULL, '2021-07-21'),
(2, 2, NULL, 24, 'Contrato_2', NULL, NULL, NULL),
(3, NULL, NULL, NULL, 'Contrato_3', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `despacho`
--

CREATE TABLE `despacho` (
  `id_despacho` int NOT NULL,
  `fecha_despacho` date DEFAULT NULL,
  `contrato_idcontrato` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle`
--

CREATE TABLE `detalle` (
  `id_detalle` int NOT NULL,
  `id_perfil` int NOT NULL,
  `id_anexos` int DEFAULT NULL,
  `id_contrato` int NOT NULL,
  `cantidad_total_perfil` int DEFAULT NULL,
  `cantidad_recepcionados` int DEFAULT NULL,
  `cantidad_listos` int DEFAULT NULL,
  `fecha_inicio_contrato` date DEFAULT NULL,
  `precio_perfil` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `detalle`
--

INSERT INTO `detalle` (`id_detalle`, `id_perfil`, `id_anexos`, `id_contrato`, `cantidad_total_perfil`, `cantidad_recepcionados`, `cantidad_listos`, `fecha_inicio_contrato`, `precio_perfil`) VALUES
(1, 1, NULL, 1, 10, 10, 0, NULL, NULL),
(2, 2, NULL, 1, 15, 15, 0, NULL, NULL),
(3, 3, NULL, 2, 20, 20, 0, NULL, NULL),
(4, 4, NULL, 2, 10, 10, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_entrega`
--

CREATE TABLE `detalle_entrega` (
  `Detalle_id_detalle` int NOT NULL,
  `entrega_identrega` int DEFAULT NULL,
  `cantidad_perfil_llegada` int DEFAULT NULL,
  `lote_id_lote` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `detalle_entrega`
--

INSERT INTO `detalle_entrega` (`Detalle_id_detalle`, `entrega_identrega`, `cantidad_perfil_llegada`, `lote_id_lote`) VALUES
(1, 1, 10, 1),
(2, 1, 15, 2),
(3, 2, 20, 3),
(4, 2, 10, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_solicitud`
--

CREATE TABLE `detalle_solicitud` (
  `idperfil` int NOT NULL,
  `cantidad` varchar(45) DEFAULT NULL,
  `idsolicitud` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id_empresa` int NOT NULL,
  `rut_empresa` varchar(12) DEFAULT NULL,
  `empresa_nombre` varchar(45) DEFAULT NULL,
  `direccion_empresa` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrega`
--

CREATE TABLE `entrega` (
  `idEntrega` int NOT NULL,
  `Lugar_de_Entrega` varchar(255) DEFAULT NULL,
  `direccion_recibo` varchar(255) DEFAULT NULL,
  `recepcionista_nombre` varchar(45) DEFAULT NULL,
  `recepcionista_apellido` varchar(45) DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `usuario_id_usuario` int NOT NULL,
  `cantidad_entregada` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `entrega`
--

INSERT INTO `entrega` (`idEntrega`, `Lugar_de_Entrega`, `direccion_recibo`, `recepcionista_nombre`, `recepcionista_apellido`, `fecha_entrega`, `usuario_id_usuario`, `cantidad_entregada`) VALUES
(1, 'Sede Concepcion', 'Collao Nº1202', 'Ignacio', 'Jara', '2021-07-22', 1, 25),
(2, 'Sede Chillan', 'Avda. Andrés Bello 720', 'Jose', 'Medina', '2021-07-26', 3, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `id_equipo` int NOT NULL,
  `id_interno` varchar(45) DEFAULT NULL,
  `fecha_recepcion` date DEFAULT NULL,
  `rechazo` varchar(200) DEFAULT NULL,
  `observacion` varchar(200) DEFAULT NULL,
  `fecha_inicio_revision` date DEFAULT NULL,
  `contrato_idcontrato` int NOT NULL,
  `perfil_idperfil` int NOT NULL,
  `Estado_id_estado_revision` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`id_equipo`, `id_interno`, `fecha_recepcion`, `rechazo`, `observacion`, `fecha_inicio_revision`, `contrato_idcontrato`, `perfil_idperfil`, `Estado_id_estado_revision`) VALUES
(1, NULL, '2021-07-21', NULL, NULL, NULL, 1, 1, 1),
(2, NULL, '2021-07-21', NULL, NULL, NULL, 1, 1, 1),
(3, NULL, '2021-07-21', NULL, NULL, NULL, 1, 1, 1),
(4, NULL, '2021-07-21', NULL, NULL, NULL, 1, 1, 1),
(5, NULL, '2021-07-21', NULL, NULL, NULL, 1, 1, 1),
(6, NULL, '2021-07-21', NULL, NULL, NULL, 1, 1, 1),
(7, NULL, '2021-07-21', NULL, NULL, NULL, 1, 1, 1),
(8, NULL, '2021-07-21', NULL, NULL, NULL, 1, 1, 1),
(9, NULL, '2021-07-21', NULL, NULL, NULL, 1, 1, 1),
(10, NULL, '2021-07-21', NULL, NULL, NULL, 1, 1, 1),
(11, NULL, '2021-07-23', NULL, NULL, NULL, 1, 2, 1),
(12, NULL, '2021-07-23', NULL, NULL, NULL, 1, 2, 1),
(13, NULL, '2021-07-23', NULL, NULL, NULL, 1, 2, 1),
(14, NULL, '2021-07-23', NULL, NULL, NULL, 1, 2, 1),
(15, NULL, '2021-07-23', NULL, NULL, NULL, 1, 2, 1),
(16, NULL, '2021-07-23', NULL, NULL, NULL, 1, 2, 1),
(17, NULL, '2021-07-23', NULL, NULL, NULL, 1, 2, 1),
(18, NULL, '2021-07-23', NULL, NULL, NULL, 1, 2, 1),
(19, NULL, '2021-07-23', NULL, NULL, NULL, 1, 2, 1),
(20, NULL, '2021-07-23', NULL, NULL, NULL, 1, 2, 1),
(21, NULL, '2021-07-23', NULL, NULL, NULL, 1, 2, 1),
(22, NULL, '2021-07-23', NULL, NULL, NULL, 1, 2, 1),
(23, NULL, '2021-07-23', NULL, NULL, NULL, 1, 2, 1),
(24, NULL, '2021-07-23', NULL, NULL, NULL, 1, 2, 1),
(25, NULL, '2021-07-07', NULL, NULL, NULL, 1, 2, 1),
(26, NULL, '2021-09-08', NULL, NULL, NULL, 2, 3, 1),
(27, NULL, '2021-09-08', NULL, NULL, NULL, 2, 3, 1),
(28, NULL, '2021-09-08', NULL, NULL, NULL, 2, 3, 1),
(29, NULL, '2021-09-08', NULL, NULL, NULL, 2, 3, 1),
(30, NULL, '2021-09-08', NULL, NULL, NULL, 2, 3, 1),
(31, NULL, '2021-09-08', NULL, NULL, NULL, 2, 3, 1),
(32, NULL, '2021-09-08', NULL, NULL, NULL, 2, 3, 1),
(33, NULL, '2021-09-08', NULL, NULL, NULL, 2, 3, 1),
(34, NULL, '2021-09-08', NULL, NULL, NULL, 2, 3, 1),
(35, NULL, '2021-09-08', NULL, NULL, NULL, 2, 3, 1),
(36, NULL, '2021-09-08', NULL, NULL, NULL, 2, 3, 1),
(37, NULL, '2021-09-08', NULL, NULL, NULL, 2, 3, 1),
(38, NULL, '2021-09-08', NULL, NULL, NULL, 2, 3, 1),
(39, NULL, '2021-09-08', NULL, NULL, NULL, 2, 3, 1),
(40, NULL, '2021-09-08', NULL, NULL, NULL, 2, 3, 1),
(41, NULL, '2021-09-08', NULL, NULL, NULL, 2, 3, 1),
(42, NULL, '2021-09-08', NULL, NULL, NULL, 2, 3, 1),
(43, NULL, '2021-09-08', NULL, NULL, NULL, 2, 3, 1),
(44, NULL, '2021-09-08', NULL, NULL, NULL, 2, 3, 1),
(45, NULL, '2021-09-08', NULL, NULL, NULL, 2, 3, 1),
(46, NULL, '2021-12-09', NULL, NULL, NULL, 2, 4, 1),
(47, NULL, '2021-12-09', NULL, NULL, NULL, 2, 4, 1),
(48, NULL, '2021-12-09', NULL, NULL, NULL, 2, 4, 1),
(49, NULL, '2021-12-09', NULL, NULL, NULL, 2, 4, 1),
(50, NULL, '2021-12-09', NULL, NULL, NULL, 2, 4, 1),
(51, NULL, '2021-12-09', NULL, NULL, NULL, 2, 4, 1),
(52, NULL, '2021-12-09', NULL, NULL, NULL, 2, 4, 1),
(53, NULL, '2021-12-09', NULL, NULL, NULL, 2, 4, 1),
(54, NULL, '2021-12-09', NULL, NULL, NULL, 2, 4, 1),
(55, NULL, '2021-12-09', NULL, NULL, NULL, 2, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_contrato`
--

CREATE TABLE `estado_contrato` (
  `id_estado_cto` int NOT NULL,
  `id_contrato` int NOT NULL,
  `fecha_estado_contrato` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `estado_contrato`
--

INSERT INTO `estado_contrato` (`id_estado_cto`, `id_contrato`, `fecha_estado_contrato`) VALUES
(4, 1, '2021-07-01'),
(4, 2, '2021-07-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_cto`
--

CREATE TABLE `estado_cto` (
  `id_estado_cto` int NOT NULL,
  `estado_descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `estado_cto`
--

INSERT INTO `estado_cto` (`id_estado_cto`, `estado_descripcion`) VALUES
(1, 'vacio'),
(2, 'incompleto'),
(3, 'completo'),
(4, 'confirmado'),
(5, 'vigente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_equipo`
--

CREATE TABLE `estado_equipo` (
  `id_estado_revision` int NOT NULL,
  `id_equipo` int NOT NULL,
  `fecha_estado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `estado_equipo`
--

INSERT INTO `estado_equipo` (`id_estado_revision`, `id_equipo`, `fecha_estado`) VALUES
(1, 1, '2021-07-21 19:48:38'),
(1, 2, '2021-07-21 19:48:38'),
(1, 3, '2021-07-21 19:48:38'),
(1, 4, '2021-07-21 19:48:38'),
(1, 5, '2021-07-21 19:48:38'),
(1, 6, '2021-07-21 19:48:38'),
(1, 7, '2021-07-21 19:48:38'),
(1, 8, '2021-07-21 19:48:38'),
(1, 9, '2021-07-21 19:48:38'),
(1, 10, '2021-07-21 19:48:38'),
(1, 11, '2021-07-23 20:48:38'),
(1, 12, '2021-07-23 20:48:38'),
(1, 13, '2021-07-23 20:48:38'),
(1, 14, '2021-07-23 20:48:38'),
(1, 15, '2021-07-23 20:48:38'),
(1, 16, '2021-07-23 20:48:38'),
(1, 17, '2021-07-23 20:48:38'),
(1, 18, '2021-07-23 20:48:38'),
(1, 19, '2021-07-23 20:48:38'),
(1, 20, '2021-07-23 20:48:38'),
(1, 21, '2021-07-23 20:48:38'),
(1, 22, '2021-07-23 20:48:38'),
(1, 23, '2021-07-23 20:48:38'),
(1, 24, '2021-07-23 20:48:38'),
(1, 25, '2021-07-23 20:48:38'),
(1, 26, '2021-09-08 21:48:38'),
(1, 27, '2021-09-08 21:48:38'),
(1, 28, '2021-09-08 21:48:38'),
(1, 29, '2021-09-08 21:48:38'),
(1, 30, '2021-09-08 21:48:38'),
(1, 31, '2021-09-08 21:48:38'),
(1, 32, '2021-09-08 21:48:38'),
(1, 33, '2021-09-08 21:48:38'),
(1, 34, '2021-09-08 21:48:38'),
(1, 35, '2021-09-08 21:48:38'),
(1, 36, '2021-09-08 21:48:38'),
(1, 37, '2021-09-08 21:48:38'),
(1, 38, '2021-09-08 21:48:38'),
(1, 39, '2021-09-08 21:48:38'),
(1, 40, '2021-09-08 21:48:38'),
(1, 41, '2021-09-08 21:48:38'),
(1, 42, '2021-09-08 21:48:38'),
(1, 43, '2021-09-08 21:48:38'),
(1, 44, '2021-09-08 21:48:38'),
(1, 45, '2021-09-08 21:48:38'),
(1, 46, '2021-12-09 22:48:38'),
(1, 47, '2021-12-09 22:48:38'),
(1, 48, '2021-12-09 22:48:38'),
(1, 49, '2021-12-09 22:48:38'),
(1, 50, '2021-12-09 22:48:38'),
(1, 51, '2021-12-09 22:48:38'),
(1, 52, '2021-12-09 22:48:38'),
(1, 53, '2021-12-09 22:48:38'),
(1, 54, '2021-12-09 22:48:38'),
(1, 55, '2021-12-09 22:48:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_revision`
--

CREATE TABLE `estado_revision` (
  `id_estado_revision` int NOT NULL,
  `nombre_estado` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `estado_revision`
--

INSERT INTO `estado_revision` (`id_estado_revision`, `nombre_estado`) VALUES
(1, 'nuevo'),
(2, 'faltante'),
(3, 'revision hw'),
(4, 'revision sw'),
(5, 'devolucion'),
(6, 'listo'),
(7, 'espera asignacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `es_cubierta`
--

CREATE TABLE `es_cubierta` (
  `id_ficha_administrativa` int NOT NULL,
  `id_tipo_cobertura` int NOT NULL,
  `descripcion_es_cubierta` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha_administrativa`
--

CREATE TABLE `ficha_administrativa` (
  `id_ficha_administrativa` int NOT NULL,
  `nombre_ficha_administrativa` varchar(256) DEFAULT NULL,
  `num_resolucion_universitaria` varchar(255) DEFAULT NULL,
  `año_resolucion_universitaria` int DEFAULT NULL,
  `num_decreto_universitario` varchar(256) DEFAULT NULL,
  `año_decreto_universitario` int DEFAULT NULL,
  `num_boleta` varchar(256) DEFAULT NULL,
  `vigencia_boleta` date DEFAULT NULL,
  `plazo_devolucion` int DEFAULT NULL,
  `corre_facturacion` varchar(256) DEFAULT NULL,
  `veces_aunmento_renta` varchar(4256) DEFAULT NULL,
  `dias_incumplimiento_pago` varchar(256) DEFAULT NULL,
  `hora_tiempo_solucion` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha_juridica`
--

CREATE TABLE `ficha_juridica` (
  `id_ficha_juridica` int NOT NULL,
  `id_representante` int DEFAULT NULL,
  `universidad_rut` varchar(12) DEFAULT NULL,
  `rut_vicerrector` varchar(45) DEFAULT NULL,
  `primer_nombre_vicerrector` varchar(45) DEFAULT NULL,
  `segundo_nombre_vicerrector` varchar(45) DEFAULT NULL,
  `primer_apellido_vicerector` varchar(45) DEFAULT NULL,
  `segundo_apellido_vicerrector` varchar(45) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_termino` date DEFAULT NULL,
  `correo_soporte` varchar(256) DEFAULT NULL,
  `dias_habiles_empresa` int DEFAULT NULL,
  `lugar_contrato` varchar(255) DEFAULT NULL,
  `direccion_universidad` varchar(255) DEFAULT NULL,
  `nombre_ficha_juridica` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ficha_juridica`
--

INSERT INTO `ficha_juridica` (`id_ficha_juridica`, `id_representante`, `universidad_rut`, `rut_vicerrector`, `primer_nombre_vicerrector`, `segundo_nombre_vicerrector`, `primer_apellido_vicerector`, `segundo_apellido_vicerrector`, `fecha_inicio`, `fecha_termino`, `correo_soporte`, `dias_habiles_empresa`, `lugar_contrato`, `direccion_universidad`, `nombre_ficha_juridica`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-21', '2023-07-21', NULL, NULL, NULL, NULL, NULL),
(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-05-21', '2022-03-09', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha_juridica_causales`
--

CREATE TABLE `ficha_juridica_causales` (
  `id_ficha_juridica` int NOT NULL,
  `id_causales` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote`
--

CREATE TABLE `lote` (
  `id_lote` int NOT NULL,
  `desc_lote` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `lote`
--

INSERT INTO `lote` (`id_lote`, `desc_lote`) VALUES
(1, NULL),
(2, NULL),
(3, NULL),
(4, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `id_perfil` int NOT NULL,
  `perfil_nombre` varchar(50) DEFAULT NULL,
  `gabinete` varchar(50) DEFAULT NULL,
  `CPU` varchar(50) DEFAULT NULL,
  `varios` varchar(50) DEFAULT NULL,
  `nombre_modelo` varchar(50) DEFAULT NULL,
  `GPU` varchar(50) DEFAULT NULL,
  `SO` varchar(50) DEFAULT NULL,
  `fecha_perfil` date DEFAULT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `fuente` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id_perfil`, `perfil_nombre`, `gabinete`, `CPU`, `varios`, `nombre_modelo`, `GPU`, `SO`, `fecha_perfil`, `marca`, `fuente`) VALUES
(1, 'Perfil 1', 'Gear Slim mATX S610', 'Intel Core i5-10400', NULL, 'SLIM-125i', 'Gráficos UHD Intel® 630', 'Windows 10', '2021-07-21', 'Gear', 'PSU 300W 80 plus'),
(2, 'Perfil 2', NULL, 'Intel Core i5-10300H', NULL, 'HP Omen 15-EK0010LA', 'NVIDIA GeForce RTX 2060', 'Windows 10', '2021-01-05', 'HP', NULL),
(3, 'Perfil 1', 'Gabinete ATX Wavetreck', 'Intel Core i7-10700', NULL, 'SLIM-124i', 'Gráficos UHD Intel® 630', 'Windows 10', '2021-04-01', 'Gear', 'PSU P450B 450W 80 plus'),
(4, 'Perfil 2', 'Deepcool® Matrexx 55Wavetreck', 'Intel Core i5-10400', NULL, 'GAMER-201i', 'NVIDIA GTX1650', 'Windows 10', '2021-04-01', 'Gear', '500W 80+ Bronceplus');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prorroga`
--

CREATE TABLE `prorroga` (
  `id_prorroga` int NOT NULL,
  `id_ficha_juridica` int DEFAULT NULL,
  `fecha_prorroga_inicio` date DEFAULT NULL,
  `fecha_prorroga_termino` date DEFAULT NULL,
  `prorroga_descripcion` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reparticion`
--

CREATE TABLE `reparticion` (
  `id_reparticion` int NOT NULL,
  `nombre_reparticion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `reparticion`
--

INSERT INTO `reparticion` (`id_reparticion`, `nombre_reparticion`) VALUES
(1, 'FACE'),
(2, 'Arquitectura'),
(3, 'Mecanica'),
(4, 'Ciencias');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `representante_empresa`
--

CREATE TABLE `representante_empresa` (
  `id_representante` int NOT NULL,
  `id_empresa` int DEFAULT NULL,
  `representante_rut` varchar(12) DEFAULT NULL,
  `representante_primer_nombre` varchar(45) DEFAULT NULL,
  `representante_segundo_nombre` varchar(45) DEFAULT NULL,
  `representante_primer_apellido` varchar(45) DEFAULT NULL,
  `representante_segundo_apellido` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int NOT NULL,
  `nombre_cargo` varchar(45) DEFAULT NULL,
  `descripcion_cargo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre_cargo`, `descripcion_cargo`) VALUES
(1, 'Jefe Servicios', 'El men con permisos de admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sede`
--

CREATE TABLE `sede` (
  `id_sede` int NOT NULL,
  `nombre_sede` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `sede`
--

INSERT INTO `sede` (`id_sede`, `nombre_sede`) VALUES
(1, 'Concepcion'),
(2, 'Chillan');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sede_reparticion`
--

CREATE TABLE `sede_reparticion` (
  `sede_id_sede` int NOT NULL,
  `reparticion_id_reparticion` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `sede_reparticion`
--

INSERT INTO `sede_reparticion` (`sede_id_sede`, `reparticion_id_reparticion`) VALUES
(1, 1),
(2, 2),
(1, 3),
(2, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguro`
--

CREATE TABLE `seguro` (
  `idseguro` int NOT NULL,
  `seguro_obs` varchar(180) NOT NULL,
  `fecha_ingreso_seg` date DEFAULT NULL,
  `equipo_id_equipo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_de_equipo`
--

CREATE TABLE `solicitud_de_equipo` (
  `id_solicitud` int NOT NULL,
  `nombre_usua` varchar(45) DEFAULT NULL,
  `encargado` varchar(45) DEFAULT NULL,
  `departamento` varchar(45) DEFAULT NULL,
  `tipo_uso` varchar(45) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `prioridad` varchar(45) DEFAULT NULL,
  `observaciones` varchar(45) DEFAULT NULL,
  `adjuntar` longblob,
  `idusuario` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cobertura`
--

CREATE TABLE `tipo_cobertura` (
  `id_tipo_cobertura` int NOT NULL,
  `descripcion_garantia` varchar(255) DEFAULT NULL,
  `hora_tiempo_respuesta` int DEFAULT NULL,
  `hora_solucion` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_componente`
--

CREATE TABLE `tipo_componente` (
  `id_tipo_componente` int NOT NULL,
  `nombre_componente` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tipo_componente`
--

INSERT INTO `tipo_componente` (`id_tipo_componente`, `nombre_componente`) VALUES
(1, 'RAM'),
(2, 'SSD'),
(3, 'HDD'),
(4, 'Mouse'),
(5, 'Teclado'),
(6, 'Monitor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int NOT NULL,
  `rut_usuario` varchar(12) DEFAULT NULL,
  `universidad_rut` varchar(12) DEFAULT NULL,
  `idrol` int NOT NULL,
  `nombre_usuario` varchar(45) DEFAULT NULL,
  `apellido_usuario` varchar(45) DEFAULT NULL,
  `Sede_has_Reparticion_Sede_Id_sede` int NOT NULL,
  `Sede_has_Reparticion_Reparticion_Id_reparticion` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `rut_usuario`, `universidad_rut`, `idrol`, `nombre_usuario`, `apellido_usuario`, `Sede_has_Reparticion_Sede_Id_sede`, `Sede_has_Reparticion_Reparticion_Id_reparticion`) VALUES
(1, '19470795-9', '60911006-6', 1, 'Tania', 'Bravo Romanini', 1, 1),
(2, '8357104-7', '60911006-6', 1, 'Joao', 'Santos Nourin', 1, 3),
(3, '21648853-9', '60911006-6', 1, 'Antonia', 'Mella Sahueza', 2, 2),
(4, '12695661-4', '60911006-6', 1, 'Noelia', 'Provoste Ramirez', 2, 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anexo`
--
ALTER TABLE `anexo`
  ADD PRIMARY KEY (`id_anexos`),
  ADD KEY `id_Contrato_idx` (`id_contrato`);

--
-- Indices de la tabla `asignacion`
--
ALTER TABLE `asignacion`
  ADD PRIMARY KEY (`id_asignacion`),
  ADD KEY `fk_Asignacion_Usuario1_idx` (`usuario_id_usuario`),
  ADD KEY `fk_Asignacion_Equipo1_idx` (`equipo_id_equipo`);

--
-- Indices de la tabla `causales`
--
ALTER TABLE `causales`
  ADD PRIMARY KEY (`id_causales`);

--
-- Indices de la tabla `componentes`
--
ALTER TABLE `componentes`
  ADD PRIMARY KEY (`id_componentes`,`id_tipo_componente`),
  ADD KEY `fk_Componentes_has_Tipo_Componente_Tipo_Componente1_idx` (`id_tipo_componente`),
  ADD KEY `fk_Componentes_has_Tipo_Componente_Perfil1_idx` (`perfil_idperfil`);

--
-- Indices de la tabla `contrato`
--
ALTER TABLE `contrato`
  ADD PRIMARY KEY (`id_contrato`),
  ADD KEY `id_Ficha_Administrativa_idx` (`id_ficha_administrativa`),
  ADD KEY `id_Ficha_Juridica_idx` (`id_ficha_juridica`);

--
-- Indices de la tabla `despacho`
--
ALTER TABLE `despacho`
  ADD PRIMARY KEY (`id_despacho`),
  ADD KEY `fk_Depacho_Contrato1_idx` (`contrato_idcontrato`);

--
-- Indices de la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_Perfil_idx` (`id_perfil`),
  ADD KEY `fk_Detalle_entrega_Contrato1_idx` (`id_contrato`),
  ADD KEY `fk_Det_Con_perfil_Anexo1_idx` (`id_anexos`);

--
-- Indices de la tabla `detalle_entrega`
--
ALTER TABLE `detalle_entrega`
  ADD KEY `fk_Det_Con_perfil_has_Entrega_Entrega1_idx` (`entrega_identrega`),
  ADD KEY `fk_Det_Con_perfil_has_Entrega_Det_Con_perfil1_idx` (`Detalle_id_detalle`),
  ADD KEY `fk_Det_Con_perfil_has_Entrega_Lote1_idx` (`lote_id_lote`);

--
-- Indices de la tabla `detalle_solicitud`
--
ALTER TABLE `detalle_solicitud`
  ADD PRIMARY KEY (`idperfil`,`idsolicitud`),
  ADD KEY `fk_Detalle solicitud_has_Perfil_Perfil1_idx` (`idperfil`),
  ADD KEY `fk_Perfil_detalle solicitud_Solicitud1_idx` (`idsolicitud`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `entrega`
--
ALTER TABLE `entrega`
  ADD PRIMARY KEY (`idEntrega`),
  ADD KEY `fk_Entrega_Usuario1_idx` (`usuario_id_usuario`);

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`id_equipo`),
  ADD KEY `fk_Equipo_Contrato1_idx` (`contrato_idcontrato`),
  ADD KEY `fk_Equipo_Perfil1_idx` (`perfil_idperfil`),
  ADD KEY `fk_Equipo_Estado_revision1_idx` (`Estado_id_estado_revision`);

--
-- Indices de la tabla `estado_contrato`
--
ALTER TABLE `estado_contrato`
  ADD PRIMARY KEY (`id_estado_cto`,`id_contrato`),
  ADD KEY `fk_Estado_cto_has_Contrato_Contrato1_idx` (`id_contrato`),
  ADD KEY `fk_Estado_cto_has_Contrato_Estado_cto1_idx` (`id_estado_cto`);

--
-- Indices de la tabla `estado_cto`
--
ALTER TABLE `estado_cto`
  ADD PRIMARY KEY (`id_estado_cto`);

--
-- Indices de la tabla `estado_equipo`
--
ALTER TABLE `estado_equipo`
  ADD PRIMARY KEY (`id_estado_revision`,`id_equipo`),
  ADD KEY `fk_Estado_eq_has_Equipo_Equipo1_idx` (`id_equipo`),
  ADD KEY `fk_Estado_eq_has_Equipo_Estado_eq1_idx` (`id_estado_revision`);

--
-- Indices de la tabla `estado_revision`
--
ALTER TABLE `estado_revision`
  ADD PRIMARY KEY (`id_estado_revision`);

--
-- Indices de la tabla `es_cubierta`
--
ALTER TABLE `es_cubierta`
  ADD KEY `fk_esCubierta_Ficha_administrativa1_idx` (`id_ficha_administrativa`),
  ADD KEY `fk_esCubierta_Tipo_cobertura1_idx` (`id_tipo_cobertura`);

--
-- Indices de la tabla `ficha_administrativa`
--
ALTER TABLE `ficha_administrativa`
  ADD PRIMARY KEY (`id_ficha_administrativa`);

--
-- Indices de la tabla `ficha_juridica`
--
ALTER TABLE `ficha_juridica`
  ADD PRIMARY KEY (`id_ficha_juridica`),
  ADD KEY `id_empresa_representante_idx` (`id_representante`);

--
-- Indices de la tabla `ficha_juridica_causales`
--
ALTER TABLE `ficha_juridica_causales`
  ADD PRIMARY KEY (`id_ficha_juridica`,`id_causales`),
  ADD KEY `fk_Ficha Juridica_has_Causales_Causales1_idx` (`id_causales`),
  ADD KEY `fk_Ficha Juridica_has_Causales_Ficha Juridica1_idx` (`id_ficha_juridica`);

--
-- Indices de la tabla `lote`
--
ALTER TABLE `lote`
  ADD PRIMARY KEY (`id_lote`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Indices de la tabla `prorroga`
--
ALTER TABLE `prorroga`
  ADD PRIMARY KEY (`id_prorroga`),
  ADD KEY `id_Ficha_Juridica_idx` (`id_ficha_juridica`);

--
-- Indices de la tabla `reparticion`
--
ALTER TABLE `reparticion`
  ADD PRIMARY KEY (`id_reparticion`);

--
-- Indices de la tabla `representante_empresa`
--
ALTER TABLE `representante_empresa`
  ADD PRIMARY KEY (`id_representante`),
  ADD KEY `id_empresa_idx` (`id_empresa`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `sede`
--
ALTER TABLE `sede`
  ADD PRIMARY KEY (`id_sede`);

--
-- Indices de la tabla `sede_reparticion`
--
ALTER TABLE `sede_reparticion`
  ADD PRIMARY KEY (`sede_id_sede`,`reparticion_id_reparticion`),
  ADD KEY `fk_Sede_has_Reparticion_Reparticion1_idx` (`reparticion_id_reparticion`),
  ADD KEY `fk_Sede_has_Reparticion_Sede1_idx` (`sede_id_sede`);

--
-- Indices de la tabla `seguro`
--
ALTER TABLE `seguro`
  ADD PRIMARY KEY (`idseguro`),
  ADD KEY `fk_Seguro_Equipo1_idx` (`equipo_id_equipo`);

--
-- Indices de la tabla `solicitud_de_equipo`
--
ALTER TABLE `solicitud_de_equipo`
  ADD PRIMARY KEY (`id_solicitud`),
  ADD KEY `fk_Solicitud_de_equipo_Usuario1_idx` (`idusuario`);

--
-- Indices de la tabla `tipo_cobertura`
--
ALTER TABLE `tipo_cobertura`
  ADD PRIMARY KEY (`id_tipo_cobertura`);

--
-- Indices de la tabla `tipo_componente`
--
ALTER TABLE `tipo_componente`
  ADD PRIMARY KEY (`id_tipo_componente`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_Rol_idx` (`idrol`),
  ADD KEY `fk_Usuario_Sede_has_Reparticion1_idx` (`Sede_has_Reparticion_Sede_Id_sede`,`Sede_has_Reparticion_Reparticion_Id_reparticion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anexo`
--
ALTER TABLE `anexo`
  MODIFY `id_anexos` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `asignacion`
--
ALTER TABLE `asignacion`
  MODIFY `id_asignacion` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `causales`
--
ALTER TABLE `causales`
  MODIFY `id_causales` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `componentes`
--
ALTER TABLE `componentes`
  MODIFY `id_componentes` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `contrato`
--
ALTER TABLE `contrato`
  MODIFY `id_contrato` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `despacho`
--
ALTER TABLE `despacho`
  MODIFY `id_despacho` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle`
--
ALTER TABLE `detalle`
  MODIFY `id_detalle` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `entrega`
--
ALTER TABLE `entrega`
  MODIFY `idEntrega` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `id_equipo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `estado_contrato`
--
ALTER TABLE `estado_contrato`
  MODIFY `id_estado_cto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estado_cto`
--
ALTER TABLE `estado_cto`
  MODIFY `id_estado_cto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estado_revision`
--
ALTER TABLE `estado_revision`
  MODIFY `id_estado_revision` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `ficha_administrativa`
--
ALTER TABLE `ficha_administrativa`
  MODIFY `id_ficha_administrativa` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ficha_juridica`
--
ALTER TABLE `ficha_juridica`
  MODIFY `id_ficha_juridica` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ficha_juridica_causales`
--
ALTER TABLE `ficha_juridica_causales`
  MODIFY `id_ficha_juridica` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lote`
--
ALTER TABLE `lote`
  MODIFY `id_lote` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id_perfil` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `prorroga`
--
ALTER TABLE `prorroga`
  MODIFY `id_prorroga` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reparticion`
--
ALTER TABLE `reparticion`
  MODIFY `id_reparticion` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `representante_empresa`
--
ALTER TABLE `representante_empresa`
  MODIFY `id_representante` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `sede`
--
ALTER TABLE `sede`
  MODIFY `id_sede` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sede_reparticion`
--
ALTER TABLE `sede_reparticion`
  MODIFY `sede_id_sede` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `solicitud_de_equipo`
--
ALTER TABLE `solicitud_de_equipo`
  MODIFY `id_solicitud` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_cobertura`
--
ALTER TABLE `tipo_cobertura`
  MODIFY `id_tipo_cobertura` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_componente`
--
ALTER TABLE `tipo_componente`
  MODIFY `id_tipo_componente` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anexo`
--
ALTER TABLE `anexo`
  ADD CONSTRAINT `anexo_ibfk_1` FOREIGN KEY (`id_contrato`) REFERENCES `contrato` (`id_contrato`);

--
-- Filtros para la tabla `asignacion`
--
ALTER TABLE `asignacion`
  ADD CONSTRAINT `asignacion_ibfk_1` FOREIGN KEY (`usuario_id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `asignacion_ibfk_2` FOREIGN KEY (`equipo_id_equipo`) REFERENCES `equipo` (`id_equipo`);

--
-- Filtros para la tabla `componentes`
--
ALTER TABLE `componentes`
  ADD CONSTRAINT `componentes_ibfk_1` FOREIGN KEY (`id_tipo_componente`) REFERENCES `tipo_componente` (`id_tipo_componente`),
  ADD CONSTRAINT `componentes_ibfk_2` FOREIGN KEY (`perfil_idperfil`) REFERENCES `perfil` (`id_perfil`);

--
-- Filtros para la tabla `contrato`
--
ALTER TABLE `contrato`
  ADD CONSTRAINT `contrato_ibfk_1` FOREIGN KEY (`id_ficha_juridica`) REFERENCES `ficha_juridica` (`id_ficha_juridica`),
  ADD CONSTRAINT `contrato_ibfk_2` FOREIGN KEY (`id_ficha_administrativa`) REFERENCES `ficha_administrativa` (`id_ficha_administrativa`);

--
-- Filtros para la tabla `despacho`
--
ALTER TABLE `despacho`
  ADD CONSTRAINT `despacho_ibfk_1` FOREIGN KEY (`contrato_idcontrato`) REFERENCES `contrato` (`id_contrato`);

--
-- Filtros para la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD CONSTRAINT `detalle_ibfk_1` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id_perfil`),
  ADD CONSTRAINT `detalle_ibfk_2` FOREIGN KEY (`id_contrato`) REFERENCES `contrato` (`id_contrato`),
  ADD CONSTRAINT `detalle_ibfk_3` FOREIGN KEY (`id_anexos`) REFERENCES `anexo` (`id_anexos`);

--
-- Filtros para la tabla `detalle_entrega`
--
ALTER TABLE `detalle_entrega`
  ADD CONSTRAINT `detalle_entrega_ibfk_1` FOREIGN KEY (`Detalle_id_detalle`) REFERENCES `detalle` (`id_detalle`),
  ADD CONSTRAINT `detalle_entrega_ibfk_2` FOREIGN KEY (`entrega_identrega`) REFERENCES `entrega` (`idEntrega`),
  ADD CONSTRAINT `detalle_entrega_ibfk_3` FOREIGN KEY (`lote_id_lote`) REFERENCES `lote` (`id_lote`);

--
-- Filtros para la tabla `detalle_solicitud`
--
ALTER TABLE `detalle_solicitud`
  ADD CONSTRAINT `detalle_solicitud_ibfk_1` FOREIGN KEY (`idperfil`) REFERENCES `perfil` (`id_perfil`),
  ADD CONSTRAINT `detalle_solicitud_ibfk_2` FOREIGN KEY (`idsolicitud`) REFERENCES `solicitud_de_equipo` (`id_solicitud`);

--
-- Filtros para la tabla `entrega`
--
ALTER TABLE `entrega`
  ADD CONSTRAINT `entrega_ibfk_1` FOREIGN KEY (`usuario_id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD CONSTRAINT `equipo_ibfk_1` FOREIGN KEY (`contrato_idcontrato`) REFERENCES `contrato` (`id_contrato`),
  ADD CONSTRAINT `equipo_ibfk_2` FOREIGN KEY (`perfil_idperfil`) REFERENCES `perfil` (`id_perfil`),
  ADD CONSTRAINT `equipo_ibfk_3` FOREIGN KEY (`Estado_id_estado_revision`) REFERENCES `estado_revision` (`id_estado_revision`);

--
-- Filtros para la tabla `estado_contrato`
--
ALTER TABLE `estado_contrato`
  ADD CONSTRAINT `estado_contrato_ibfk_1` FOREIGN KEY (`id_estado_cto`) REFERENCES `estado_cto` (`id_estado_cto`),
  ADD CONSTRAINT `estado_contrato_ibfk_2` FOREIGN KEY (`id_contrato`) REFERENCES `contrato` (`id_contrato`);

--
-- Filtros para la tabla `estado_equipo`
--
ALTER TABLE `estado_equipo`
  ADD CONSTRAINT `estado_equipo_ibfk_1` FOREIGN KEY (`id_estado_revision`) REFERENCES `estado_revision` (`id_estado_revision`),
  ADD CONSTRAINT `estado_equipo_ibfk_2` FOREIGN KEY (`id_equipo`) REFERENCES `equipo` (`id_equipo`);

--
-- Filtros para la tabla `es_cubierta`
--
ALTER TABLE `es_cubierta`
  ADD CONSTRAINT `es_cubierta_ibfk_1` FOREIGN KEY (`id_ficha_administrativa`) REFERENCES `ficha_administrativa` (`id_ficha_administrativa`),
  ADD CONSTRAINT `es_cubierta_ibfk_2` FOREIGN KEY (`id_tipo_cobertura`) REFERENCES `tipo_cobertura` (`id_tipo_cobertura`);

--
-- Filtros para la tabla `ficha_juridica`
--
ALTER TABLE `ficha_juridica`
  ADD CONSTRAINT `ficha_juridica_ibfk_1` FOREIGN KEY (`id_representante`) REFERENCES `representante_empresa` (`id_representante`);

--
-- Filtros para la tabla `ficha_juridica_causales`
--
ALTER TABLE `ficha_juridica_causales`
  ADD CONSTRAINT `ficha_juridica_causales_ibfk_1` FOREIGN KEY (`id_causales`) REFERENCES `causales` (`id_causales`),
  ADD CONSTRAINT `fk_Ficha Juridica_has_Causales_Ficha Juridica1` FOREIGN KEY (`id_ficha_juridica`) REFERENCES `ficha_juridica` (`id_ficha_juridica`);

--
-- Filtros para la tabla `prorroga`
--
ALTER TABLE `prorroga`
  ADD CONSTRAINT `prorroga_ibfk_1` FOREIGN KEY (`id_ficha_juridica`) REFERENCES `ficha_juridica` (`id_ficha_juridica`);

--
-- Filtros para la tabla `representante_empresa`
--
ALTER TABLE `representante_empresa`
  ADD CONSTRAINT `representante_empresa_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id_empresa`);

--
-- Filtros para la tabla `sede_reparticion`
--
ALTER TABLE `sede_reparticion`
  ADD CONSTRAINT `sede_reparticion_ibfk_1` FOREIGN KEY (`sede_id_sede`) REFERENCES `sede` (`id_sede`),
  ADD CONSTRAINT `sede_reparticion_ibfk_2` FOREIGN KEY (`reparticion_id_reparticion`) REFERENCES `reparticion` (`id_reparticion`);

--
-- Filtros para la tabla `seguro`
--
ALTER TABLE `seguro`
  ADD CONSTRAINT `seguro_ibfk_1` FOREIGN KEY (`equipo_id_equipo`) REFERENCES `equipo` (`id_equipo`);

--
-- Filtros para la tabla `solicitud_de_equipo`
--
ALTER TABLE `solicitud_de_equipo`
  ADD CONSTRAINT `solicitud_de_equipo_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idrol`) REFERENCES `rol` (`id_rol`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`Sede_has_Reparticion_Sede_Id_sede`,`Sede_has_Reparticion_Reparticion_Id_reparticion`) REFERENCES `sede_reparticion` (`sede_id_sede`, `reparticion_id_reparticion`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
