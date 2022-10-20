-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 20-10-2022 a las 14:20:26
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
-- Estructura de tabla para la tabla `actividad_tareas`
--

CREATE TABLE `actividad_tareas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fco_id` bigint(20) UNSIGNED NOT NULL,
  `detalle_operacion_id` bigint(20) UNSIGNED NOT NULL,
  `lugar_responsable_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `actividad_tareas`
--

INSERT INTO `actividad_tareas` (`id`, `fco_id`, `detalle_operacion_id`, `lugar_responsable_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2022-10-17 19:40:26', '2022-10-17 19:40:26'),
(2, 1, 2, 2, '2022-10-17 19:40:26', '2022-10-17 19:40:26'),
(3, 2, 6, 3, '2022-10-17 19:40:26', '2022-10-17 19:40:26'),
(4, 2, 7, 3, '2022-10-17 19:40:27', '2022-10-17 19:40:27'),
(5, 3, 9, 4, '2022-10-17 22:09:09', '2022-10-17 22:09:09'),
(6, 3, 10, 4, '2022-10-17 22:09:09', '2022-10-17 22:09:09'),
(7, 4, 11, 5, '2022-10-17 22:09:09', '2022-10-17 22:09:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `certificacions`
--

CREATE TABLE `certificacions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `formulario_id` bigint(20) UNSIGNED NOT NULL,
  `fco_id` bigint(20) UNSIGNED NOT NULL,
  `actividad_tarea_id` bigint(20) UNSIGNED NOT NULL,
  `partida_id` bigint(20) UNSIGNED NOT NULL,
  `cantidad_usar` double NOT NULL,
  `presupuesto_usarse` decimal(24,2) NOT NULL,
  `justificacion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `archivo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correlativo` bigint(20) NOT NULL,
  `solicitante_id` bigint(20) UNSIGNED NOT NULL,
  `superior_id` bigint(20) UNSIGNED NOT NULL,
  `ue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prog` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proy` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `act` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ff` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `of` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inicio` date DEFAULT NULL,
  `final` date DEFAULT NULL,
  `codigo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `certificacions`
--

INSERT INTO `certificacions` (`id`, `formulario_id`, `fco_id`, `actividad_tarea_id`, `partida_id`, `cantidad_usar`, `presupuesto_usarse`, `justificacion`, `archivo`, `correlativo`, `solicitante_id`, `superior_id`, `ue`, `prog`, `proy`, `act`, `ff`, `of`, `inicio`, `final`, `codigo`, `accion`, `estado`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 2, 24, '27768.00', 'JUSTITICACION DE PRUEBA', NULL, 1, 2, 3, '01', '01', '11', '10', '11', '11', NULL, NULL, '33', 'ACCION DE CORTO PLAZO', 'APROBADO', '2022-10-17', '2022-10-17 19:42:10', '2022-10-17 21:10:38'),
(2, 2, 3, 5, 10, 2, '74.00', 'JUSTIFICACION DE PRUEBA', NULL, 2, 3, 2, '01', '01', '33', '10', '33', '33', NULL, NULL, '11', 'ACCION DE CORTO PLAZO', 'PENDIENTE', '2022-10-17', '2022-10-17 22:15:20', '2022-10-17 22:15:20'),
(3, 1, 1, 1, 1, 100, '20.00', 'EE', NULL, 3, 2, 3, '01', '01', '33', '10', '33', '33', '2022-10-07', '2022-10-20', '33', 'GFF', 'PENDIENTE', '2022-10-20', '2022-10-20 14:14:29', '2022-10-20 14:19:49');

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
(1, 'SISTEMA DE PROGRAMACIÓN OPERATIVA ANUAL', 'SISPOA', 'RAZON SOCIAL DE PRUEBA', 'LA PAZ', 'LOS OLIVOS', '222222', '', 'ACTIVIDAD', '', '1665947357_logo.png', NULL, '2022-10-16 19:09:17');

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
(2, 2, '2022-10-17', '2022-10-17 22:06:22', '2022-10-17 22:06:22');

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
(7, 2, 10.00, 'CONTAR CON MATERIAL PROMOCIONAL E INFORMATIVO', 'INFORME', '4.2.2', 'ELABORACION Y DIFUSION DE MATERIALES PROMOCIONALES INFORMATIVOS E INSTITUCIONALES', '', '', '', '', '', '11', '', '', '', '', '', '1', '2022-03-01', '2022-12-15', '2022-10-17 19:31:23', '2022-10-17 19:31:23'),
(8, 2, 10.00, 'TRES REVISTAS INSTITUCIONALES DE LA ASUSS', 'REVISTAS', '4.2.3', 'ELABORACIÓN DE LA REVISTA DE LA ASUSS', '', '', '', '1', '', '', '', '1', '', '', '', '1', '2022-04-01', '2022-12-31', '2022-10-17 19:31:23', '2022-10-17 19:31:23'),
(9, 3, 20.00, 'RESULTAOD ESPERADO DE LA TAREA', 'MEDIO DE VERIFICACION', '1.1', 'ACTIVIDAD 1', '', '1', '', '', '1', '', '', '', '', '', '', '1', '2022-01-01', '2022-12-12', '2022-10-17 22:06:22', '2022-10-17 22:06:22'),
(10, 3, 20.00, 'RESULTADO ESPERADO DE LA ACTIVIDAD', 'MEDIO DE VERIFICACION', '1.2.', 'ACTIVIDAD 2', '', '', '', '', '', '', '1', '', '', '', '', '1', '2022-03-03', '2022-12-01', '2022-10-17 22:06:22', '2022-10-17 22:06:22'),
(11, 4, 40.00, 'RESULTADO ESPERADO', 'MEDIO', '2.1.2', 'ACTIVIDAD 2.1', '', '1', '', '', '', '', '', '', '', '', '', '', '2022-03-03', '2022-06-06', '2022-10-17 22:06:22', '2022-10-17 22:06:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formulario_cinco`
--

CREATE TABLE `formulario_cinco` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `formulario_id` bigint(20) UNSIGNED NOT NULL,
  `total_formulario` decimal(24,2) NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `formulario_cinco`
--

INSERT INTO `formulario_cinco` (`id`, `formulario_id`, `total_formulario`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(1, 1, '667703.00', '2022-10-17', '2022-10-17 19:40:26', '2022-10-17 19:44:23'),
(2, 2, '9074.00', '2022-10-17', '2022-10-17 22:09:09', '2022-10-17 22:09:09');

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
(2, '2.333.44', 'ACCION DE PRUEBA', 'INDICADOR DE PRUEBA', '2.333.44', 'ACCION DE CORTO PLAZO DE PRUEBA', 'RESULTADO ESPERADO DE PRUEBA', '350000.00', 20.00, 2, '2022-10-17', '2022-10-17 21:59:36', '2022-10-17 21:59:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `f_c_operacions`
--

CREATE TABLE `f_c_operacions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `formulario_cinco_id` bigint(20) UNSIGNED NOT NULL,
  `operacion_id` bigint(20) UNSIGNED NOT NULL,
  `total_operacion` decimal(24,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `f_c_operacions`
--

INSERT INTO `f_c_operacions` (`id`, `formulario_cinco_id`, `operacion_id`, `total_operacion`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '162495.00', '2022-10-17 19:40:26', '2022-10-17 19:40:26'),
(2, 1, 2, '505208.00', '2022-10-17 19:40:26', '2022-10-17 19:40:26'),
(3, 2, 3, '6374.00', '2022-10-17 22:09:09', '2022-10-17 22:09:09'),
(4, 2, 4, '2700.00', '2022-10-17 22:09:09', '2022-10-17 22:09:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugar_responsables`
--

CREATE TABLE `lugar_responsables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fco_id` bigint(20) UNSIGNED NOT NULL,
  `lugar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `responsable` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `lugar_responsables`
--

INSERT INTO `lugar_responsables` (`id`, `fco_id`, `lugar`, `responsable`, `created_at`, `updated_at`) VALUES
(1, 1, 'NACIONAL', 'RESPONSABLE DE ÁREA DE COMUNICACIÓN SOCIAL TÉCNICO DE ÁREA DE COMUNICACION SOCIAL', '2022-10-17 19:40:26', '2022-10-17 19:40:26'),
(2, 1, 'NACIONAL', 'RESPONSABLE DE ÁREA DE COMUNICACIÓN SOCIAL TÉCNICO DE ÁREA DE COMUNICACION SOCIAL', '2022-10-17 19:40:26', '2022-10-17 19:40:26'),
(3, 2, 'LA PAZ', 'RESPONSABLE DE ÁREA DE COMUNICACIÓN SOCIAL Y TÉCNICO DE ÁREA DE COMUNICACIÓN SOCIAL', '2022-10-17 19:40:26', '2022-10-17 19:40:26'),
(4, 3, 'NACIONAL', 'RESPONSABLE', '2022-10-17 22:09:09', '2022-10-17 22:09:09'),
(5, 4, 'LA PAZ', 'REPSONSABLE', '2022-10-17 22:09:09', '2022-10-17 22:09:09');

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
(9, '2022_10_13_140144_create_formulario_cinco_table', 1),
(11, '2022_10_13_142014_create_lugar_responsables_table', 1),
(14, '2022_10_13_140145_create_f_c_operacions_table', 2),
(15, '2022_10_13_141806_create_lugar_responsables_table', 3),
(16, '2022_10_13_141807_create_actividad_tareas_table', 4),
(17, '2022_10_13_142633_create_partidas_table', 5),
(23, '2022_10_13_143018_create_certificacions_table', 6);

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
(4, 2, '2.1', 'OPERACION 2', '2022-10-17 22:06:22', '2022-10-17 22:06:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidas`
--

CREATE TABLE `partidas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lugar_responsable_id` bigint(20) UNSIGNED NOT NULL,
  `actividad_tarea_id` bigint(20) UNSIGNED NOT NULL,
  `partida` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cantidad` double NOT NULL,
  `unidad` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `costo` decimal(24,2) NOT NULL,
  `t42` decimal(24,2) NOT NULL,
  `ue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prog` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `act` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otros` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `partidas`
--

INSERT INTO `partidas` (`id`, `lugar_responsable_id`, `actividad_tarea_id`, `partida`, `descripcion`, `cantidad`, `unidad`, `costo`, `t42`, `ue`, `prog`, `act`, `otros`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '25600', 'SERVICIOS DE IMPRENTA,FOTOCOPIADO Y FOTOGRAFICOS(FOTOCOPIAS)', 100, 'unidad', '0.20', '20.00', '01', '01', '10', NULL, '2022-10-17 19:40:26', '2022-10-17 19:40:26'),
(2, 2, 2, '22110', 'PASAJES AL INTERIOR DEL PAÍS', 25, 'pasaje', '1157.00', '28925.00', '01', '01', '10', NULL, '2022-10-17 19:40:26', '2022-10-17 19:40:26'),
(3, 2, 2, '22210', 'VIATICOS POR VIAJES AL INTERIOR DEL PAÍS', 50, 'dpia', '371.00', '18550.00', '01', '01', '10', NULL, '2022-10-17 19:40:26', '2022-10-17 19:40:26'),
(4, 2, 2, '43700', 'OTRA MAQUINARIA Y EQUIPO', 1, 'global', '100000.00', '100000.00', '01', '01', '10', NULL, '2022-10-17 19:40:26', '2022-10-17 19:40:26'),
(5, 2, 2, '32500', 'PERIODICOS (SUSCRIPCION)', 1, 'global', '15000.00', '15000.00', '01', '01', '10', NULL, '2022-10-17 19:40:26', '2022-10-17 19:40:26'),
(6, 3, 3, '25600', 'SERVICIOS DE IMPRENTA FOTOCOPIADO Y FOTOGRÁFICOS(MEMORIA INSTITUCIONAL)', 150, 'unidad', '200.00', '30000.00', '01', '01', '10', NULL, '2022-10-17 19:40:27', '2022-10-17 19:40:27'),
(7, 3, 4, '25600', 'SERVICIO DE IMPRENTA FOTOCOPIADO Y FOTOGRÁFICOS (ELABORACIÓN DISEÑO Y DIAGRAMACIÓN DE MINIMEDIOS AGENDAS CALENDARIOSY OTROS', 1, 'global', '386000.00', '386000.00', '01', '01', '10', NULL, '2022-10-17 19:40:27', '2022-10-17 19:40:27'),
(8, 3, 4, '25220', 'CONSULTORÍAS EN LÍNEA', 9, 'meses', '9550.00', '85950.00', '01', '01', '10', NULL, '2022-10-17 19:40:27', '2022-10-17 19:40:27'),
(9, 3, 4, '31110', 'GASTOS POR REFRIGERIOS AL PERSONAL PERMANENTE, EVENTUAL Y CONSULTORES INDIVIDUALES DE LÍNEA DE LAS INSTITUCIONES PÚBLICAS', 181, 'días', '18.00', '3258.00', '01', '01', '10', NULL, '2022-10-17 19:40:27', '2022-10-17 19:40:27'),
(10, 4, 5, '222', 'DESCRIPCION GASTO', 2, 'unidad', '37.00', '74.00', '01', '01', '10', NULL, '2022-10-17 22:09:09', '2022-10-17 22:09:09'),
(11, 4, 5, '333', 'DESCRIPCION GASTO 2', 3, 'unidad', '100.00', '300.00', '01', '01', '100', NULL, '2022-10-17 22:09:09', '2022-10-17 22:09:09'),
(12, 4, 6, '333', 'DESCRIPCION', 20, 'unidad', '300.00', '6000.00', '01', '01', '10', NULL, '2022-10-17 22:09:09', '2022-10-17 22:09:09'),
(13, 5, 7, '444', 'DESC', 30, 'dias', '90.00', '2700.00', '01', '01', '10', NULL, '2022-10-17 22:09:09', '2022-10-17 22:09:09');

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
(2, 'UNIDAD 2', '2022-10-17 21:58:59', '2022-10-17 21:58:59');

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
  `dir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fono` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cel` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cargo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unidad_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `usuario`, `nombre`, `paterno`, `materno`, `ci`, `ci_exp`, `dir`, `correo`, `fono`, `cel`, `cargo`, `unidad_id`, `tipo`, `foto`, `password`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', '', NULL, '', '', '', NULL, '', '', '', NULL, 'ADMINISTRADOR', 'default.png', '$2y$10$cDSOdzTsMDQAfqcb6.WFtu40s.wmQ4Jl8poIwW69MSZnnedD3prKu', '2022-10-13', NULL, NULL),
(2, 'JPERES', 'JUAN', 'PERES', '', '1234', 'LP', 'LOS OLIVOS', '', '22222', '7777777', 'RESPONSABLE DE OFICINA DEPARTAMENTAL POTOSÍ', 1, 'ADMINISTRADOR', 'default.png', '$2y$10$1hgmqNI9y8FEfM2ZY/scau4SFqC055G7U.NowDmBkJrCuORkfzLuu', '2022-10-16', '2022-10-16 17:47:11', '2022-10-16 17:47:12'),
(3, 'RCOLQUE', 'RUBEN', 'COLQUE', '', '2222', 'LP', 'LOS OLIVOS', '', '22222', '7777777', 'RESPONSABLE REGIONAL LA PAZ', 1, 'ADMINISTRADOR', 'default.png', '$2y$10$BTLd1mspf9zY1UaBWWgnz.ktFLPIQtvRAuL0IfI45M6GnpQCbmu2O', '2022-10-16', '2022-10-16 17:47:49', '2022-10-16 17:47:50');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad_tareas`
--
ALTER TABLE `actividad_tareas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `actividad_tareas_fco_id_foreign` (`fco_id`),
  ADD KEY `actividad_tareas_detalle_operacion_id_foreign` (`detalle_operacion_id`),
  ADD KEY `actividad_tareas_lugar_responsable_id_foreign` (`lugar_responsable_id`);

--
-- Indices de la tabla `certificacions`
--
ALTER TABLE `certificacions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `certificacions_formulario_id_foreign` (`formulario_id`),
  ADD KEY `certificacions_fco_id_foreign` (`fco_id`),
  ADD KEY `certificacions_actividad_tarea_id_foreign` (`actividad_tarea_id`),
  ADD KEY `certificacions_partida_id_foreign` (`partida_id`),
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
-- Indices de la tabla `formulario_cinco`
--
ALTER TABLE `formulario_cinco`
  ADD PRIMARY KEY (`id`),
  ADD KEY `formulario_cinco_formulario_id_foreign` (`formulario_id`);

--
-- Indices de la tabla `formulario_cuatro`
--
ALTER TABLE `formulario_cuatro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `formulario_cuatro_unidad_id_foreign` (`unidad_id`);

--
-- Indices de la tabla `f_c_operacions`
--
ALTER TABLE `f_c_operacions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f_c_operacions_formulario_cinco_id_foreign` (`formulario_cinco_id`),
  ADD KEY `f_c_operacions_operacion_id_foreign` (`operacion_id`);

--
-- Indices de la tabla `lugar_responsables`
--
ALTER TABLE `lugar_responsables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lugar_responsables_fco_id_foreign` (`fco_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `partidas_lugar_responsable_id_foreign` (`lugar_responsable_id`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad_tareas`
--
ALTER TABLE `actividad_tareas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `certificacions`
--
ALTER TABLE `certificacions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `configuracions`
--
ALTER TABLE `configuracions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_formularios`
--
ALTER TABLE `detalle_formularios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detalle_operacions`
--
ALTER TABLE `detalle_operacions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `formulario_cinco`
--
ALTER TABLE `formulario_cinco`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `formulario_cuatro`
--
ALTER TABLE `formulario_cuatro`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `f_c_operacions`
--
ALTER TABLE `f_c_operacions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `lugar_responsables`
--
ALTER TABLE `lugar_responsables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `operacions`
--
ALTER TABLE `operacions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `partidas`
--
ALTER TABLE `partidas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `unidads`
--
ALTER TABLE `unidads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividad_tareas`
--
ALTER TABLE `actividad_tareas`
  ADD CONSTRAINT `actividad_tareas_detalle_operacion_id_foreign` FOREIGN KEY (`detalle_operacion_id`) REFERENCES `detalle_operacions` (`id`),
  ADD CONSTRAINT `actividad_tareas_fco_id_foreign` FOREIGN KEY (`fco_id`) REFERENCES `f_c_operacions` (`id`),
  ADD CONSTRAINT `actividad_tareas_lugar_responsable_id_foreign` FOREIGN KEY (`lugar_responsable_id`) REFERENCES `lugar_responsables` (`id`);

--
-- Filtros para la tabla `certificacions`
--
ALTER TABLE `certificacions`
  ADD CONSTRAINT `certificacions_actividad_tarea_id_foreign` FOREIGN KEY (`actividad_tarea_id`) REFERENCES `actividad_tareas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `certificacions_fco_id_foreign` FOREIGN KEY (`fco_id`) REFERENCES `f_c_operacions` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `certificacions_formulario_id_foreign` FOREIGN KEY (`formulario_id`) REFERENCES `formulario_cuatro` (`id`),
  ADD CONSTRAINT `certificacions_partida_id_foreign` FOREIGN KEY (`partida_id`) REFERENCES `partidas` (`id`) ON UPDATE CASCADE,
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
  ADD CONSTRAINT `formulario_cinco_formulario_id_foreign` FOREIGN KEY (`formulario_id`) REFERENCES `formulario_cuatro` (`id`);

--
-- Filtros para la tabla `formulario_cuatro`
--
ALTER TABLE `formulario_cuatro`
  ADD CONSTRAINT `formulario_cuatro_unidad_id_foreign` FOREIGN KEY (`unidad_id`) REFERENCES `unidads` (`id`);

--
-- Filtros para la tabla `f_c_operacions`
--
ALTER TABLE `f_c_operacions`
  ADD CONSTRAINT `f_c_operacions_formulario_cinco_id_foreign` FOREIGN KEY (`formulario_cinco_id`) REFERENCES `formulario_cinco` (`id`),
  ADD CONSTRAINT `f_c_operacions_operacion_id_foreign` FOREIGN KEY (`operacion_id`) REFERENCES `operacions` (`id`);

--
-- Filtros para la tabla `lugar_responsables`
--
ALTER TABLE `lugar_responsables`
  ADD CONSTRAINT `lugar_responsables_fco_id_foreign` FOREIGN KEY (`fco_id`) REFERENCES `f_c_operacions` (`id`);

--
-- Filtros para la tabla `operacions`
--
ALTER TABLE `operacions`
  ADD CONSTRAINT `operacions_detalle_formulario_id_foreign` FOREIGN KEY (`detalle_formulario_id`) REFERENCES `detalle_formularios` (`id`);

--
-- Filtros para la tabla `partidas`
--
ALTER TABLE `partidas`
  ADD CONSTRAINT `partidas_lugar_responsable_id_foreign` FOREIGN KEY (`lugar_responsable_id`) REFERENCES `lugar_responsables` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_unidad_id_foreign` FOREIGN KEY (`unidad_id`) REFERENCES `unidads` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
