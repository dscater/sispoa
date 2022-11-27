-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 27-11-2022 a las 12:52:03
-- Versión del servidor: 5.7.33
-- Versión de PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sispoa_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad_realizadas`
--

CREATE TABLE `actividad_realizadas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `archivo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `actividad_realizadas`
--

INSERT INTO `actividad_realizadas` (`id`, `descripcion`, `archivo`, `estado`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(1, 'ACTIVIDAD REALIZADA 1', '1667660327_actividad_realizada1.pdf', '', '2022-11-05', '2022-11-05 14:58:47', '2022-11-05 19:03:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `certificacions`
--

CREATE TABLE `certificacions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `formulario_id` bigint(20) UNSIGNED NOT NULL,
  `mo_id` bigint(20) UNSIGNED NOT NULL,
  `cantidad_usar` double NOT NULL,
  `presupuesto_usarse` decimal(24,2) NOT NULL,
  `archivo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correlativo` bigint(20) NOT NULL,
  `solicitante_id` bigint(20) UNSIGNED NOT NULL,
  `superior_id` bigint(20) UNSIGNED NOT NULL,
  `inicio` date NOT NULL,
  `final` date NOT NULL,
  `personal_designado` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departamento` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `municipio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `certificacions`
--

INSERT INTO `certificacions` (`id`, `formulario_id`, `mo_id`, `cantidad_usar`, `presupuesto_usarse`, `archivo`, `correlativo`, `solicitante_id`, `superior_id`, `inicio`, `final`, `personal_designado`, `departamento`, `municipio`, `estado`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 100, '20.00', NULL, 1, 2, 3, '2022-01-01', '2022-03-03', 'JUAN PERES', 'DEPARTAMENTO', 'MUNICIPIO', 'PENDIENTE', '2022-11-04', '2022-11-05 01:05:38', '2022-11-27 12:37:22'),
(3, 2, 6, 12, '144.00', NULL, 2, 6, 5, '2022-11-02', '2022-12-12', 'ORLANDO PAREDES', NULL, NULL, 'PENDIENTE', '2022-11-19', '2022-11-19 13:21:15', '2022-11-19 13:21:20'),
(4, 3, 16, 2, '31.40', NULL, 3, 3, 5, '2022-11-18', '2022-11-30', 'JOSE PERES', 'DEPARTAMENTO', '', 'PENDIENTE', '2022-11-27', '2022-11-27 12:41:57', '2022-11-27 12:41:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracions`
--

CREATE TABLE `configuracions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_sistema` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `razon_social` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ciudad` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fono` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `web` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actividad` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `configuracions`
--

INSERT INTO `configuracions` (`id`, `nombre_sistema`, `alias`, `razon_social`, `ciudad`, `dir`, `fono`, `web`, `actividad`, `correo`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'SISTEMA DE PROGRAMACIÓN OPERATIVA ANUAL', 'SISPOA', 'RAZON SOCIAL DE PRUEBA', 'LA PAZ', 'LOS OLIVOS', '222222', '', 'ACTIVIDAD', '', '1665947357_logo.png', NULL, '2022-11-05 01:54:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_formularios`
--

CREATE TABLE `detalle_formularios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `formulario_id` bigint(20) UNSIGNED NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_formularios`
--

INSERT INTO `detalle_formularios` (`id`, `formulario_id`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-10-17', '2022-10-17 19:31:22', '2022-10-17 19:31:22'),
(2, 2, '2022-10-17', '2022-10-17 22:06:22', '2022-10-17 22:06:22'),
(3, 3, '2022-10-20', '2022-10-20 14:28:57', '2022-10-20 14:28:57'),
(4, 4, '2022-11-05', '2022-11-05 20:42:44', '2022-11-05 20:42:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_operacions`
--

CREATE TABLE `detalle_operacions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `operacion_id` bigint(20) UNSIGNED NOT NULL,
  `ponderacion` double(8,2) NOT NULL,
  `resultado_esperado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `medios_verificacion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo_tarea` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actividad_tarea` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pt_e` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pt_f` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pt_m` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `st_a` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `st_m` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `st_j` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tt_j` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tt_a` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tt_s` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ct_o` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ct_n` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ct_d` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inicio` date NOT NULL,
  `final` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_operacions`
--

INSERT INTO `detalle_operacions` (`id`, `operacion_id`, `ponderacion`, `resultado_esperado`, `medios_verificacion`, `codigo_tarea`, `actividad_tarea`, `pt_e`, `pt_f`, `pt_m`, `st_a`, `st_m`, `st_j`, `tt_j`, `tt_a`, `tt_s`, `ct_o`, `ct_n`, `ct_d`, `inicio`, `final`, `created_at`, `updated_at`) VALUES
(1, 1, 10.00, 'PLAN ESTRATEGICO COMUNICACIONAL 2022', 'INFORME', '4.1.1', 'ELABORACIÓN DE PLAN ESTRATEGICO COMUNICACIONAL 2022', '1', '', '', '', '', '', '', '', '', '', '', '', '2022-01-03', '2022-03-31', '2022-10-17 19:31:22', '2022-10-17 19:31:22'),
(2, 1, 20.00, 'POBLACION BOLIVIANA CONOCE LAS ACCIONES Y RESULTADOSDE LA ASUSS', 'INFORMES', '4.1.2', 'COBERTURA DE PRENSA PARA LA GESTIÓN DE INFORMACIÓN', '', '', '1', '', '', '1', '', '', '1', '', '', '1', '2022-01-03', '2022-12-31', '2022-10-17 19:31:22', '2022-10-17 19:31:22'),
(3, 1, 20.00, 'LA POBLACION BOLIVIANA CONOCE LAS ACCIONES Y LOS RESULTADOS DE LA ASUSS', 'INFORME', '4.1.3.', 'REALIZAR LAS GESTIONES PARA LA DIFUSION EN MEDIOS DE COMUNICACIÓN TRADICIONALES', '', '', '', '', '', '', '', '', '', '', '', '1', '2022-03-01', '2022-12-15', '2022-10-17 19:31:22', '2022-10-17 19:31:22'),
(4, 1, 10.00, 'VISIBILIZAR LA IMAGEN INSTITUCIONAL DE LA ASUSS', 'INFORME', '4.1.4', 'ADMINISTRACION DE REDES SOCIALES DE LA ASUSS', '', '', '', '', '', '', '', '', '', '', '', '', '2022-01-03', '2022-12-31', '2022-10-17 19:31:22', '2022-10-17 19:31:22'),
(5, 1, 10.00, 'LA POBLACION BOLIVIANA CONOCE LAS ACCIONES Y LOS RESULTADOS DE LA ASUSS', 'INFORME', '4.1.5', 'PARTICIPACION EN FERIAS Y EVENTOS', '', '', '', '', '', '', '', '', '', '', '', '', '2022-01-03', '2022-12-31', '2022-10-17 19:31:22', '2022-10-17 19:31:22'),
(6, 2, 10.00, 'MEMORIA INSTITUCIONAL DE LA GESTIÓN 2021 Y MEMORIA INSTITUCIONAL DE LA GESTIÓN 2022', 'INFORME', '4.2.1', 'ELABORACIÓN  DE LA MEMORIA INSTITUCIONAL', '', '', '', '1', '', '', '', '', '', '', '', '1', '2022-03-01', '2022-12-31', '2022-10-17 19:31:22', '2022-10-17 19:31:22'),
(7, 2, 10.00, 'CONTAR CON MATERIAL PROMOCIONAL E INFORMATIVO', 'INFORME', '4.2.2', 'ELABORACION Y DIFUSION DE MATERIALES PROMOCIONALES INFORMATIVOS E INSTITUCIONALES', '', '', '', '', '', '1', '', '', '', '', '', '1', '2022-03-01', '2022-12-15', '2022-10-17 19:31:23', '2022-11-11 01:56:44'),
(9, 3, 20.00, 'RESULTAOD ESPERADO DE LA TAREA', 'MEDIO DE VERIFICACION', '1.1', 'ACTIVIDAD 1', '', '1', '', '', '1', '', '', '', '', '', '', '1', '2022-01-01', '2022-12-12', '2022-10-17 22:06:22', '2022-10-17 22:06:22'),
(10, 3, 20.00, 'RESULTADO ESPERADO DE LA ACTIVIDAD', 'MEDIO DE VERIFICACION', '1.2.', 'ACTIVIDAD 2', '', '', '', '', '', '', '1', '', '', '', '', '1', '2022-03-03', '2022-12-01', '2022-10-17 22:06:22', '2022-10-17 22:06:22'),
(11, 4, 40.00, 'RESULTADO ESPERADO', 'MEDIO', '2.1.2', 'ACTIVIDAD 2.1', '', '1', '', '', '', '', '', '', '', '', '', '', '2022-03-03', '2022-06-06', '2022-10-17 22:06:22', '2022-10-17 22:06:22'),
(12, 5, 10.00, 'DESC', 'DESC', '1.1', 'ACT 1', '', '', '', '', '', '', '', '', '1', '', '', '', '2022-10-27', '2022-11-03', '2022-10-20 14:28:57', '2022-10-20 14:28:57'),
(13, 6, 20.00, 'RESULTADO ESPERADO', 'MEDIO DE VERIFICACION', '1.1.1', 'TAREA 1', '', '', '', '1', '1', '', '', '', '1', '', '', '', '2022-03-04', '2022-09-09', '2022-11-05 20:42:44', '2022-11-05 20:42:44'),
(14, 7, 20.00, 'RESULTADO', 'MEDIO DE VERIFICACION', '2.1.1.', 'ACTIVIDAD TAREA', '1', '', '', '', '1', '', '', '', '', '', '', '', '2022-01-01', '2022-12-12', '2022-11-19 11:51:53', '2022-11-19 11:51:53'),
(16, 9, 40.00, 'INTERMEDIO', 'MEDIO DE VERIFICACION UNEVO', '3.1.1..1', 'ACTIVIDAD TAREA', '', '', '', '', '', '', '', '', '1', '1', '', '', '2022-04-04', '2022-10-10', '2022-11-19 11:53:24', '2022-11-19 11:53:24'),
(17, 6, 20.00, 'INTEERMEDIO 2', 'VERIFICACION 2', '1.2.', 'ACTIVIDAD 1.2.', '', '', '', '', '', '', '', '1', '', '', '', '', '2022-04-04', '2022-09-09', '2022-11-19 11:55:40', '2022-11-19 11:55:40'),
(18, 6, 10.00, 'INTEERMEDIO 1.3.', 'VERIFICACION 1-3', '1.3.3.', 'ACTIVIDAD TAREA 1-3', '', '', '', '', '', '1', '', '1', '', '', '', '', '2022-05-04', '2022-10-10', '2022-11-19 11:55:40', '2022-11-19 11:55:40'),
(19, 6, 1.40, 'RESULTADO 1.4', 'MEDIO VERIFICACINO 1-4', '1.4.1', 'ACTIVIDAD 1-4', '', '', '', '', '', '', '', '', '1', '', '', '1', '2022-05-05', '2022-12-12', '2022-11-19 11:55:40', '2022-11-19 11:55:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `financieras`
--

CREATE TABLE `financieras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `archivo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `financieras`
--

INSERT INTO `financieras` (`id`, `descripcion`, `archivo`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(1, 'FINANCIERO 1', '1667580590_financiera1.jpg', '2022-11-04', '2022-11-04 16:49:23', '2022-11-05 17:53:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fisicos`
--

CREATE TABLE `fisicos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `archivo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `fisicos`
--

INSERT INTO `fisicos` (`id`, `descripcion`, `archivo`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(1, 'DESCRIPCION FISICO 1', '1667580480_fisico1.jpg', '2022-11-04', '2022-11-04 16:24:57', '2022-11-04 16:48:00'),
(2, 'FISICO 2', '1667580485_fisico2.jpg', '2022-11-04', '2022-11-04 16:44:25', '2022-11-04 16:48:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formulario_cinco`
--

CREATE TABLE `formulario_cinco` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `memoria_id` bigint(20) UNSIGNED NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `formulario_cinco`
--

INSERT INTO `formulario_cinco` (`id`, `memoria_id`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-11-04', '2022-11-04 21:56:18', '2022-11-04 21:56:18'),
(2, 4, '2022-11-04', '2022-11-04 21:56:24', '2022-11-04 21:56:24'),
(5, 7, '2022-11-19', '2022-11-19 12:23:53', '2022-11-19 12:23:53'),
(7, 9, '2022-11-23', '2022-11-23 12:32:59', '2022-11-23 12:32:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formulario_cuatro`
--

CREATE TABLE `formulario_cuatro` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `codigo_pei` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accion_institucional` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `indicador` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo_poa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accion_corto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resultado_esperado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `presupuesto` decimal(24,2) NOT NULL,
  `ponderacion` double(8,2) NOT NULL,
  `unidad_id` bigint(20) UNSIGNED NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `formulario_cuatro`
--

INSERT INTO `formulario_cuatro` (`id`, `codigo_pei`, `accion_institucional`, `indicador`, `codigo_poa`, `accion_corto`, `resultado_esperado`, `presupuesto`, `ponderacion`, `unidad_id`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(1, '11.1.298.4', 'CONSOLIDAR LA CAPACIDAD TÉCNICA TECNOLOGICA FINANCIERA Y NORMATIVA DE LA AUTORIDAD DE SUPERVISIÓN DE CORTO PLAZO', 'INCREMENTAR EL ÍNDICE DE EFICACIA DE LA ASUSS', '11.1.298.4', 'CONSOLIDAR LA ESTRUCTURA INSTITUCIONAL TÉCNICA, ADMINISTRATIVA, FINANCIERA Y JURÍDICA DE LA AUTORIDAD DE SUPERVISIÓN DE LA SEGURIDAD SOCIAL DE CORTO PLAZO A NIVEL NACIONAL', 'EJECUCIÓN FÍSICA 90% Y FINANCIERA 90%', '2081175.00', 20.00, 1, '2022-10-17', '2022-10-17 19:23:24', '2022-10-17 19:23:24'),
(2, '2.333.44', 'ACCION DE PRUEBA', 'INDICADOR DE PRUEBA', '2.333.44', 'ACCION DE CORTO PLAZO DE PRUEBA', 'RESULTADO ESPERADO DE PRUEBA', '350000.00', 20.00, 2, '2022-10-17', '2022-10-17 21:59:36', '2022-10-17 21:59:36'),
(3, '3.33', 'ACCION', 'INDICADOR', '3.33', 'ACCION', 'RESULTADO', '30000.00', 10.00, 3, '2022-10-20', '2022-10-20 14:28:04', '2022-10-20 14:28:04'),
(4, '3.33.11', 'ACCION INSTITCIONAL ESPECIFICA', 'INDICADOR DE PROCESO DESDE JEFE DE UNIDAD', '3.33.11', 'ACCION DE CORTO PLAZO', 'RESULTADO ESPERADO', '20000.00', 20.00, 3, '2022-11-05', '2022-11-05 20:36:21', '2022-11-05 20:36:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `memoria_calculos`
--

CREATE TABLE `memoria_calculos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `formulario_id` bigint(20) UNSIGNED NOT NULL,
  `total_actividades` decimal(24,2) NOT NULL,
  `total_ene` decimal(24,2) NOT NULL,
  `total_feb` decimal(24,2) NOT NULL,
  `total_mar` decimal(24,2) NOT NULL,
  `total_abr` decimal(24,2) NOT NULL,
  `total_may` decimal(24,2) NOT NULL,
  `total_jun` decimal(24,2) NOT NULL,
  `total_jul` decimal(24,2) NOT NULL,
  `total_ago` decimal(24,2) NOT NULL,
  `total_sep` decimal(24,2) NOT NULL,
  `total_oct` decimal(24,2) NOT NULL,
  `total_nov` decimal(24,2) NOT NULL,
  `total_dic` decimal(24,2) NOT NULL,
  `total_final` decimal(24,2) NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `memoria_calculos`
--

INSERT INTO `memoria_calculos` (`id`, `formulario_id`, `total_actividades`, `total_ene`, `total_feb`, `total_mar`, `total_abr`, `total_may`, `total_jun`, `total_jul`, `total_ago`, `total_sep`, `total_oct`, `total_nov`, `total_dic`, `total_final`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(1, 1, '60846.80', '20.00', '2399.70', '3682.80', '6082.70', '6082.70', '6082.70', '6082.70', '6082.70', '6082.70', '6082.70', '6082.70', '6082.70', '60846.80', '2022-11-04', '2022-11-04 20:19:23', '2022-11-19 14:38:42'),
(4, 2, '22233.89', '0.00', '0.00', '144.00', '0.00', '20990.00', '1099.89', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '22233.89', '2022-11-04', '2022-11-04 21:20:16', '2022-11-23 12:31:57'),
(7, 4, '40.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '20.00', '20.00', '0.00', '0.00', '0.00', '0.00', '40.00', '2022-11-19', '2022-11-19 12:23:53', '2022-11-19 12:23:53'),
(9, 3, '31.40', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '31.40', '0.00', '0.00', '0.00', '0.00', '31.40', '2022-11-23', '2022-11-23 12:32:58', '2022-11-23 12:34:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `memoria_operacions`
--

CREATE TABLE `memoria_operacions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `memoria_id` bigint(20) UNSIGNED NOT NULL,
  `ue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prog` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `act` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `operacion_id` bigint(20) UNSIGNED NOT NULL,
  `detalle_operacion_id` bigint(20) UNSIGNED NOT NULL,
  `lugar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `responsable` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `partida_id` bigint(20) UNSIGNED NOT NULL,
  `partida` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nro` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion_detallada` text COLLATE utf8mb4_unicode_ci,
  `cantidad` double(8,2) NOT NULL,
  `unidad` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `costo` decimal(24,2) NOT NULL,
  `total` decimal(24,2) NOT NULL,
  `justificacion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ene` decimal(24,2) DEFAULT NULL,
  `feb` decimal(24,2) DEFAULT NULL,
  `mar` decimal(24,2) DEFAULT NULL,
  `abr` decimal(24,2) DEFAULT NULL,
  `may` decimal(24,2) DEFAULT NULL,
  `jun` decimal(24,2) DEFAULT NULL,
  `jul` decimal(24,2) DEFAULT NULL,
  `ago` decimal(24,2) DEFAULT NULL,
  `sep` decimal(24,2) DEFAULT NULL,
  `oct` decimal(24,2) DEFAULT NULL,
  `nov` decimal(24,2) DEFAULT NULL,
  `dic` decimal(24,2) DEFAULT NULL,
  `total_operacion` decimal(24,2) NOT NULL,
  `fecha_registro` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `memoria_operacions`
--

INSERT INTO `memoria_operacions` (`id`, `memoria_id`, `ue`, `prog`, `act`, `operacion_id`, `detalle_operacion_id`, `lugar`, `responsable`, `partida_id`, `partida`, `nro`, `descripcion`, `descripcion_detallada`, `cantidad`, `unidad`, `costo`, `total`, `justificacion`, `ene`, `feb`, `mar`, `abr`, `may`, `jun`, `jul`, `ago`, `sep`, `oct`, `nov`, `dic`, `total_operacion`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(1, 1, '01', '01', '10', 1, 1, 'LA PAZ', 'JUAN PERES', 1, '25600', '1', 'SERVICIOS DE FOTOCOPIADO Y FOTOGRAFICO', NULL, 100.00, 'COPIA', '0.20', '20.00', 'ELABORACIPON DEL PLAN ESTRATEGICO COMUNICACIONAL 2023', '20.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20.00', '2022-11-04', '2022-11-04 20:19:23', '2022-11-19 14:38:42'),
(6, 4, '01', '01', '10', 3, 9, 'ASDASD', 'ASDASD', 1, '25600', '1', 'SERVICIOS DE FOTOCOPIADO Y FOTOGRAFICO', 'DESCRIPCION DETALLADA OPERACION 1', 12.00, 'UNIDAD', '12.00', '144.00', 'JUSTIFICACION DE PRUEBA', NULL, NULL, '144.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '144.00', '2022-11-04', '2022-11-04 21:20:16', '2022-11-23 12:31:56'),
(7, 1, '01', '01', '10', 1, 2, 'LA PAZ', 'JUAN PERES', 1, '25600', '2', 'SERVICIOS DE FOTOCOPIADO Y FOTOGRAFICO', NULL, 30.00, 'PASAJE', '1282.90', '38487.00', 'COBERTURA DE PRENSA PARA LA GESTIÓN DE IFNORMACIÓN', NULL, '1282.90', '2565.80', '3848.70', '3848.70', '3848.70', '3848.70', '3848.70', '3848.70', '3848.70', '3848.70', '3848.70', '38487.00', '2022-11-04', '2022-11-04 21:44:45', '2022-11-19 14:38:42'),
(8, 1, '01', '01', '10', 1, 3, 'LA PAZ', 'JUAN PERES', 2, '21002', '3', 'SERVICIOS DE PRUEBA', NULL, 60.00, 'DÍA', '372.33', '22339.80', 'COBERTURA DE PRENSA PARA LA GESTIÓN DE INFORMACIÓN', NULL, '1116.80', '1117.00', '2234.00', '2234.00', '2234.00', '2234.00', '2234.00', '2234.00', '2234.00', '2234.00', '2234.00', '22339.80', '2022-11-04', '2022-11-04 21:46:34', '2022-11-19 14:38:42'),
(9, 4, '01', '01', '10', 4, 11, 'LA PAZ', 'JUAN PERES', 1, '25600', '2', 'SERVICIOS DE FOTOCOPIADO Y FOTOGRAFICO', 'DESCRIPCION DETALLADA OPERACION 2', 10.00, 'UNIDAD', '2099.00', '20990.00', 'JUSTIFICACION', NULL, NULL, NULL, NULL, '20990.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20990.00', '2022-11-05', '2022-11-05 15:39:44', '2022-11-23 12:31:57'),
(10, 4, '01', '01', '10', 3, 10, 'LA PAZ', 'JUAN PERES', 1, '25600', '3', 'SERVICIOS DE FOTOCOPIADO Y FOTOGRAFICO', 'DESCRIPCION DETALLADA OPERACION 3', 11.00, 'UNIDAD', '99.99', '1099.89', 'JUSTIFICACION', NULL, NULL, NULL, NULL, NULL, '1099.89', NULL, NULL, NULL, NULL, NULL, NULL, '1099.89', '2022-11-05', '2022-11-05 15:43:21', '2022-11-23 12:31:57'),
(13, 7, '01', '01', '10', 6, 13, 'LA PAZ', 'RESPONSABLE TECNICO DE COMUNICACIONES', 1, '1', '1', 'DESCRIPCION DE PARTIDA', NULL, 1.00, 'UNIDAD', '40.00', '40.00', 'JUSTIFICACION', NULL, NULL, NULL, NULL, NULL, NULL, '20.00', '20.00', NULL, NULL, NULL, NULL, '40.00', '2022-11-19', '2022-11-19 12:23:53', '2022-11-19 12:23:53'),
(16, 9, '01', '01', '10', 5, 12, 'LA PAZ', 'TECNICO DE TELECOMUNICACIONES', 1, '25600', '1', 'SERVICIOS DE FOTOCOPIADO Y FOTOGRAFICO', 'DESCRIPCION DETALLADA DE ITEM DE PRUEBA, PAR BIEN O SERVICIO', 2.00, 'UNIDAD', '15.70', '31.40', 'JUSTIFICACION', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '31.40', NULL, NULL, NULL, NULL, '31.40', '2022-11-23', '2022-11-23 12:32:58', '2022-11-23 12:34:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2022_10_13_132625_create_configuracions_table', 1),
(3, '2022_10_13_132626_create_unidads_table', 1),
(4, '2022_10_13_132627_create_users_table', 1),
(5, '2022_10_13_134551_create_formulario_cuatro_table', 1),
(6, '2022_10_13_135025_create_detalle_formularios_table', 1),
(7, '2022_10_13_135026_create_operacions_table', 1),
(8, '2022_10_13_135709_create_detalle_operacions_table', 1),
(11, '2022_10_13_142014_create_lugar_responsables_table', 1),
(14, '2022_10_13_140145_create_f_c_operacions_table', 2),
(15, '2022_10_13_141806_create_lugar_responsables_table', 3),
(16, '2022_10_13_141807_create_actividad_tareas_table', 4),
(17, '2022_10_13_142633_create_partidas_table', 5),
(24, '2022_11_04_115914_create_fisicos_table', 7),
(25, '2022_11_04_120025_create_financieras_table', 8),
(26, '2022_11_04_120034_create_semaforos_table', 9),
(27, '2022_10_13_140142_create_memoria_calculos_table', 10),
(28, '2022_11_04_133608_create_memoria_operacions_table', 11),
(29, '2022_10_13_140144_create_formulario_cinco_table', 12),
(30, '2022_10_13_143018_create_certificacions_table', 13),
(31, '2022_11_04_221949_create_verificacion_actividads_table', 14),
(32, '2022_11_05_102322_create_actividad_realizadas_table', 15),
(33, '2022_11_19_083815_create_partidas_table', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operacions`
--

CREATE TABLE `operacions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `detalle_formulario_id` bigint(20) UNSIGNED NOT NULL,
  `codigo_operacion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `operacion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `operacions`
--

INSERT INTO `operacions` (`id`, `detalle_formulario_id`, `codigo_operacion`, `operacion`, `created_at`, `updated_at`) VALUES
(1, 1, '4.1', 'VISIBILIZAR Y POSICIONAR LA AUTORIDAD DE SUPERVISIÓN DE LA SEGURIDAD SOCIAL DE CORTO PLAZO A NIVEL REGIONAL Y NACIONAL', '2022-10-17 19:31:22', '2022-10-17 19:31:22'),
(2, 1, '4.2', 'ELABORACIÓN Y PUBLICACIÓN DE CONTENIDOS DE LA AUTORIDAD DE SUPERVISIÓN DE LA SEGURIDAD SOCIAL DE CORTO PLAZO', '2022-10-17 19:31:22', '2022-10-17 19:31:22'),
(3, 2, '1', 'OPERACION 1', '2022-10-17 22:06:22', '2022-10-17 22:06:22'),
(4, 2, '2.1', 'OPERACION 2', '2022-10-17 22:06:22', '2022-10-17 22:06:22'),
(5, 3, '1', 'OP 1', '2022-10-20 14:28:57', '2022-10-20 14:28:57'),
(6, 4, '1.1', 'OPERACION CREADA DESDE JEFE DE UNIDAD', '2022-11-05 20:42:44', '2022-11-05 20:42:44'),
(7, 4, '2.1', 'OPERACIÓN', '2022-11-19 11:51:53', '2022-11-19 11:51:53'),
(9, 4, '3.1.1.', 'OPERACION', '2022-11-19 11:53:24', '2022-11-19 11:53:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidas`
--

CREATE TABLE `partidas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `partida` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `partidas`
--

INSERT INTO `partidas` (`id`, `partida`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, '25600', 'SERVICIOS DE FOTOCOPIADO Y FOTOGRAFICO', '2022-11-19 12:39:02', '2022-11-19 12:39:12'),
(2, '21002', 'SERVICIOS DE PRUEBA', '2022-11-19 12:47:59', '2022-11-19 12:47:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semaforos`
--

CREATE TABLE `semaforos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `archivo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `semaforos`
--

INSERT INTO `semaforos` (`id`, `descripcion`, `archivo`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(1, 'SEMAFORO 1', '1667580599_semaforo1.jpg', '2022-11-04', '2022-11-04 16:49:59', '2022-11-04 16:49:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidads`
--

CREATE TABLE `unidads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `unidads`
--

INSERT INTO `unidads` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'ÁREA DE COMUNICACIÓN SOCIAL DE LA ASUSS', '2022-10-14 20:27:10', '2022-10-14 20:27:10'),
(2, 'UNIDAD 2', '2022-10-17 21:58:59', '2022-10-17 21:58:59'),
(3, 'UNIDAD 3', '2022-10-20 14:26:12', '2022-10-20 14:26:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paterno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `materno` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ci` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ci_exp` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fono` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cargo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unidad_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acceso` int(11) NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `usuario`, `nombre`, `paterno`, `materno`, `ci`, `ci_exp`, `fono`, `cargo`, `unidad_id`, `tipo`, `foto`, `password`, `acceso`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', '', NULL, '', '', '', '', NULL, 'SUPER USUARIO', 'default.png', '$2y$10$cDSOdzTsMDQAfqcb6.WFtu40s.wmQ4Jl8poIwW69MSZnnedD3prKu', 1, '2022-10-13', NULL, NULL),
(2, 'JPERES', 'JUAN', 'PERES', '', '1234', 'LP', '22222', 'RESPONSABLE DE OFICINA DEPARTAMENTAL POTOSÍ', 1, 'ENLACE', 'default.png', '$2y$10$1hgmqNI9y8FEfM2ZY/scau4SFqC055G7U.NowDmBkJrCuORkfzLuu', 1, '2022-10-16', '2022-10-16 17:47:11', '2022-11-05 20:21:29'),
(3, 'RCOLQUE', 'RUBEN', 'COLQUE', '', '2222', 'LP', '22222', 'RESPONSABLE REGIONAL LA PAZ', 1, 'MAE', 'default.png', '$2y$10$BTLd1mspf9zY1UaBWWgnz.ktFLPIQtvRAuL0IfI45M6GnpQCbmu2O', 1, '2022-10-16', '2022-10-16 17:47:49', '2022-11-04 14:00:02'),
(4, 'AGONZALES', 'ALBERTO', 'GONZALES', '', '3333', 'LP', '2222', 'CARGO', 1, 'FINANCIERA', 'default.png', '$2y$10$hjd0GxLr801x/JTYDuuAZeObvjdgMs1RKMDY1YiOhELF7SXjSMGge', 1, '2022-11-04', '2022-11-04 13:56:22', '2022-11-05 20:00:56'),
(5, 'PALBES', 'PEDRO', 'ALBES', 'CONDORI', '4444', 'CB', '22222', 'CARGO 4', 3, 'JEFES DE UNIDAD', 'default.png', '$2y$10$r3IopSrAc4DPjUVhYCod1OfcykM//CP9gPRlpg4RXoAquhtA09.I6', 1, '2022-11-05', '2022-11-05 20:00:43', '2022-11-05 20:00:48'),
(6, 'CSANCHEZ', 'CARLOS', 'SANCHEZ', '', '5555', 'LP', '2222', 'CARGO 5', 1, 'DIRECTORES', 'default.png', '$2y$10$75Xh3l4YZqj5gccjdI3jcObhRQrc5sOJBIKTSM0L7P12PCT0Xr8bW', 1, '2022-11-05', '2022-11-05 20:13:26', '2022-11-05 20:13:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `verificacion_actividads`
--

CREATE TABLE `verificacion_actividads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gestion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actividad` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `verificacion_actividads`
--

INSERT INTO `verificacion_actividads` (`id`, `gestion`, `actividad`, `created_at`, `updated_at`) VALUES
(1, '2022', 'La actividad se encuentra en el Plan Operativo Anual de la gestión 2022 de la Autoridad de Supervisión de la Seguridad Social de Corto Plazo, aprobado mediante la Resolución Administrativa N° 043 de 10 de septiembre de 2021 (Para su aprobación)', NULL, '2022-11-19 13:30:12');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad_realizadas`
--
ALTER TABLE `actividad_realizadas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `certificacions`
--
ALTER TABLE `certificacions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `certificacions_formulario_id_foreign` (`formulario_id`),
  ADD KEY `certificacions_mo_id_foreign` (`mo_id`),
  ADD KEY `certificacions_solicitante_id_foreign` (`solicitante_id`),
  ADD KEY `certificacions_superior_id_foreign` (`superior_id`);

--
-- Indices de la tabla `configuracions`
--
ALTER TABLE `configuracions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_formularios`
--
ALTER TABLE `detalle_formularios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_formularios_formulario_id_foreign` (`formulario_id`);

--
-- Indices de la tabla `detalle_operacions`
--
ALTER TABLE `detalle_operacions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_operacions_operacion_id_foreign` (`operacion_id`);

--
-- Indices de la tabla `financieras`
--
ALTER TABLE `financieras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fisicos`
--
ALTER TABLE `fisicos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `formulario_cinco`
--
ALTER TABLE `formulario_cinco`
  ADD PRIMARY KEY (`id`),
  ADD KEY `formulario_cinco_memoria_id_foreign` (`memoria_id`);

--
-- Indices de la tabla `formulario_cuatro`
--
ALTER TABLE `formulario_cuatro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `formulario_cuatro_unidad_id_foreign` (`unidad_id`);

--
-- Indices de la tabla `memoria_calculos`
--
ALTER TABLE `memoria_calculos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `memoria_operacions`
--
ALTER TABLE `memoria_operacions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `memoria_operacions_memoria_id_foreign` (`memoria_id`),
  ADD KEY `memoria_operacions_operacion_id_foreign` (`operacion_id`),
  ADD KEY `memoria_operacions_detalle_operacion_id_foreign` (`detalle_operacion_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `operacions`
--
ALTER TABLE `operacions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `operacions_detalle_formulario_id_foreign` (`detalle_formulario_id`);

--
-- Indices de la tabla `partidas`
--
ALTER TABLE `partidas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `semaforos`
--
ALTER TABLE `semaforos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `unidads`
--
ALTER TABLE `unidads`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_usuario_unique` (`usuario`),
  ADD KEY `users_unidad_id_foreign` (`unidad_id`);

--
-- Indices de la tabla `verificacion_actividads`
--
ALTER TABLE `verificacion_actividads`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad_realizadas`
--
ALTER TABLE `actividad_realizadas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `certificacions`
--
ALTER TABLE `certificacions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `configuracions`
--
ALTER TABLE `configuracions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_formularios`
--
ALTER TABLE `detalle_formularios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `detalle_operacions`
--
ALTER TABLE `detalle_operacions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `financieras`
--
ALTER TABLE `financieras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `fisicos`
--
ALTER TABLE `fisicos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `formulario_cinco`
--
ALTER TABLE `formulario_cinco`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `formulario_cuatro`
--
ALTER TABLE `formulario_cuatro`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `memoria_calculos`
--
ALTER TABLE `memoria_calculos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `memoria_operacions`
--
ALTER TABLE `memoria_operacions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `operacions`
--
ALTER TABLE `operacions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `partidas`
--
ALTER TABLE `partidas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `semaforos`
--
ALTER TABLE `semaforos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `unidads`
--
ALTER TABLE `unidads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `verificacion_actividads`
--
ALTER TABLE `verificacion_actividads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `certificacions`
--
ALTER TABLE `certificacions`
  ADD CONSTRAINT `certificacions_formulario_id_foreign` FOREIGN KEY (`formulario_id`) REFERENCES `formulario_cuatro` (`id`),
  ADD CONSTRAINT `certificacions_mo_id_foreign` FOREIGN KEY (`mo_id`) REFERENCES `memoria_operacions` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `certificacions_solicitante_id_foreign` FOREIGN KEY (`solicitante_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `certificacions_superior_id_foreign` FOREIGN KEY (`superior_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_formularios`
--
ALTER TABLE `detalle_formularios`
  ADD CONSTRAINT `detalle_formularios_formulario_id_foreign` FOREIGN KEY (`formulario_id`) REFERENCES `formulario_cuatro` (`id`);

--
-- Filtros para la tabla `detalle_operacions`
--
ALTER TABLE `detalle_operacions`
  ADD CONSTRAINT `detalle_operacions_operacion_id_foreign` FOREIGN KEY (`operacion_id`) REFERENCES `operacions` (`id`);

--
-- Filtros para la tabla `formulario_cinco`
--
ALTER TABLE `formulario_cinco`
  ADD CONSTRAINT `formulario_cinco_memoria_id_foreign` FOREIGN KEY (`memoria_id`) REFERENCES `memoria_calculos` (`id`);

--
-- Filtros para la tabla `formulario_cuatro`
--
ALTER TABLE `formulario_cuatro`
  ADD CONSTRAINT `formulario_cuatro_unidad_id_foreign` FOREIGN KEY (`unidad_id`) REFERENCES `unidads` (`id`);

--
-- Filtros para la tabla `memoria_operacions`
--
ALTER TABLE `memoria_operacions`
  ADD CONSTRAINT `memoria_operacions_detalle_operacion_id_foreign` FOREIGN KEY (`detalle_operacion_id`) REFERENCES `detalle_operacions` (`id`),
  ADD CONSTRAINT `memoria_operacions_memoria_id_foreign` FOREIGN KEY (`memoria_id`) REFERENCES `memoria_calculos` (`id`),
  ADD CONSTRAINT `memoria_operacions_operacion_id_foreign` FOREIGN KEY (`operacion_id`) REFERENCES `operacions` (`id`);

--
-- Filtros para la tabla `operacions`
--
ALTER TABLE `operacions`
  ADD CONSTRAINT `operacions_detalle_formulario_id_foreign` FOREIGN KEY (`detalle_formulario_id`) REFERENCES `detalle_formularios` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_unidad_id_foreign` FOREIGN KEY (`unidad_id`) REFERENCES `unidads` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
