-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-05-2016 a las 01:03:57
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 7.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ume`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `department`
--

CREATE TABLE `department` (
  `ID_DEPARTMENT` tinyint(4) NOT NULL,
  `DEPARTMENT_NAME` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `DEPARTMENT_STATUS` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `department`
--

INSERT INTO `department` (`ID_DEPARTMENT`, `DEPARTMENT_NAME`, `DEPARTMENT_STATUS`) VALUES
(1, 'Direccion General', 1),
(2, 'Administracion y Finanzas', 1),
(3, 'Impuestos', 1),
(4, 'Tesoreria', 1),
(5, 'Cobranza', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `department_area_1`
--

CREATE TABLE `department_area_1` (
  `ID_AREA` tinyint(4) NOT NULL,
  `AREA_NAME` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `AREA_STATUS` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `department_area_1`
--

INSERT INTO `department_area_1` (`ID_AREA`, `AREA_NAME`, `AREA_STATUS`) VALUES
(1, 'AREA_A', 1),
(2, 'AREA_B', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `department_area_2`
--

CREATE TABLE `department_area_2` (
  `ID_AREA` tinyint(4) NOT NULL,
  `AREA_NAME` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `AREA_STATUS` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `department_area_2`
--

INSERT INTO `department_area_2` (`ID_AREA`, `AREA_NAME`, `AREA_STATUS`) VALUES
(1, 'AREA_A', 1),
(2, 'AREA_B', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `department_area_3`
--

CREATE TABLE `department_area_3` (
  `ID_AREA` tinyint(4) NOT NULL,
  `AREA_NAME` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `AREA_STATUS` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `department_area_3`
--

INSERT INTO `department_area_3` (`ID_AREA`, `AREA_NAME`, `AREA_STATUS`) VALUES
(1, 'AREA_A', 1),
(2, 'AREA_B', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `department_area_4`
--

CREATE TABLE `department_area_4` (
  `ID_AREA` tinyint(4) NOT NULL,
  `AREA_NAME` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `AREA_STATUS` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `department_area_4`
--

INSERT INTO `department_area_4` (`ID_AREA`, `AREA_NAME`, `AREA_STATUS`) VALUES
(1, 'AREA_A', 1),
(2, 'AREA_B', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `department_area_5`
--

CREATE TABLE `department_area_5` (
  `ID_AREA` tinyint(4) NOT NULL,
  `AREA_NAME` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `AREA_STATUS` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `department_area_5`
--

INSERT INTO `department_area_5` (`ID_AREA`, `AREA_NAME`, `AREA_STATUS`) VALUES
(1, 'AREA_A', 1),
(2, 'AREA_B', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `department_area_user_access_1_1`
--

CREATE TABLE `department_area_user_access_1_1` (
  `ID_USER` tinyint(4) NOT NULL,
  `USER_DEPARTMENT_STATUS` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `department_area_user_access_1_1`
--

INSERT INTO `department_area_user_access_1_1` (`ID_USER`, `USER_DEPARTMENT_STATUS`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `department_area_user_access_1_2`
--

CREATE TABLE `department_area_user_access_1_2` (
  `ID_USER` tinyint(4) NOT NULL,
  `USER_DEPARTMENT_STATUS` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `department_area_user_access_1_2`
--

INSERT INTO `department_area_user_access_1_2` (`ID_USER`, `USER_DEPARTMENT_STATUS`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `department_area_user_access_2_1`
--

CREATE TABLE `department_area_user_access_2_1` (
  `ID_USER` tinyint(4) NOT NULL,
  `USER_DEPARTMENT_STATUS` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `department_area_user_access_2_1`
--

INSERT INTO `department_area_user_access_2_1` (`ID_USER`, `USER_DEPARTMENT_STATUS`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `department_area_user_access_2_2`
--

CREATE TABLE `department_area_user_access_2_2` (
  `ID_USER` tinyint(4) NOT NULL,
  `USER_DEPARTMENT_STATUS` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `department_area_user_access_2_2`
--

INSERT INTO `department_area_user_access_2_2` (`ID_USER`, `USER_DEPARTMENT_STATUS`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `department_area_user_access_3_1`
--

CREATE TABLE `department_area_user_access_3_1` (
  `ID_USER` tinyint(4) NOT NULL,
  `USER_DEPARTMENT_STATUS` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `department_area_user_access_3_1`
--

INSERT INTO `department_area_user_access_3_1` (`ID_USER`, `USER_DEPARTMENT_STATUS`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `department_area_user_access_3_2`
--

CREATE TABLE `department_area_user_access_3_2` (
  `ID_USER` tinyint(4) NOT NULL,
  `USER_DEPARTMENT_STATUS` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `department_area_user_access_3_2`
--

INSERT INTO `department_area_user_access_3_2` (`ID_USER`, `USER_DEPARTMENT_STATUS`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `department_area_user_access_4_1`
--

CREATE TABLE `department_area_user_access_4_1` (
  `ID_USER` tinyint(4) NOT NULL,
  `USER_DEPARTMENT_STATUS` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `department_area_user_access_4_1`
--

INSERT INTO `department_area_user_access_4_1` (`ID_USER`, `USER_DEPARTMENT_STATUS`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `department_area_user_access_4_2`
--

CREATE TABLE `department_area_user_access_4_2` (
  `ID_USER` tinyint(4) NOT NULL,
  `USER_DEPARTMENT_STATUS` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `department_area_user_access_4_2`
--

INSERT INTO `department_area_user_access_4_2` (`ID_USER`, `USER_DEPARTMENT_STATUS`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `department_area_user_access_5_1`
--

CREATE TABLE `department_area_user_access_5_1` (
  `ID_USER` tinyint(4) NOT NULL,
  `USER_DEPARTMENT_STATUS` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `department_area_user_access_5_1`
--

INSERT INTO `department_area_user_access_5_1` (`ID_USER`, `USER_DEPARTMENT_STATUS`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `department_area_user_access_5_2`
--

CREATE TABLE `department_area_user_access_5_2` (
  `ID_USER` tinyint(4) NOT NULL,
  `USER_DEPARTMENT_STATUS` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `department_area_user_access_5_2`
--

INSERT INTO `department_area_user_access_5_2` (`ID_USER`, `USER_DEPARTMENT_STATUS`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `department_user_access_1`
--

CREATE TABLE `department_user_access_1` (
  `ID_USER` tinyint(4) NOT NULL,
  `USER_DEPARTMENT_STATUS` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `department_user_access_1`
--

INSERT INTO `department_user_access_1` (`ID_USER`, `USER_DEPARTMENT_STATUS`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `department_user_access_2`
--

CREATE TABLE `department_user_access_2` (
  `ID_USER` tinyint(4) NOT NULL,
  `USER_DEPARTMENT_STATUS` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `department_user_access_2`
--

INSERT INTO `department_user_access_2` (`ID_USER`, `USER_DEPARTMENT_STATUS`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `department_user_access_3`
--

CREATE TABLE `department_user_access_3` (
  `ID_USER` tinyint(4) NOT NULL,
  `USER_DEPARTMENT_STATUS` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `department_user_access_3`
--

INSERT INTO `department_user_access_3` (`ID_USER`, `USER_DEPARTMENT_STATUS`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `department_user_access_4`
--

CREATE TABLE `department_user_access_4` (
  `ID_USER` tinyint(4) NOT NULL,
  `USER_DEPARTMENT_STATUS` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `department_user_access_4`
--

INSERT INTO `department_user_access_4` (`ID_USER`, `USER_DEPARTMENT_STATUS`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `department_user_access_5`
--

CREATE TABLE `department_user_access_5` (
  `ID_USER` tinyint(4) NOT NULL,
  `USER_DEPARTMENT_STATUS` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `department_user_access_5`
--

INSERT INTO `department_user_access_5` (`ID_USER`, `USER_DEPARTMENT_STATUS`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_access`
--

CREATE TABLE `user_access` (
  `ID_USER` tinyint(4) NOT NULL,
  `USER_LOGIN_NAME` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `USER_LOGIN_PASS` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `USER_STATUS` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `user_access`
--

INSERT INTO `user_access` (`ID_USER`, `USER_LOGIN_NAME`, `USER_LOGIN_PASS`, `USER_STATUS`) VALUES
(1, 'jorge', '$2y$10$Gb7Nvwm4xAMwAjEHwjfAi.MrnFnDapR85FLpexUetOd4VuLpofT9m', 1),
(2, 'pablo', '$2y$10$fUnSHnudXf0vm6yZ0Tv4VOhIRo5sTE4SzKgt4AIK5ydjuOtvv9lZu', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_sessions_access_1`
--

CREATE TABLE `user_sessions_access_1` (
  `ID_SESSION` tinyint(4) NOT NULL,
  `USER_KEY` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `USER_DATE_CREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `USER_DATE_CURRENT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `USER_DATE_TEMP` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `USER_IP` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `USER_BROWSER` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `USER_SESSION_TEMP` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `user_sessions_access_1`
--

INSERT INTO `user_sessions_access_1` (`ID_SESSION`, `USER_KEY`, `USER_DATE_CREATED`, `USER_DATE_CURRENT`, `USER_DATE_TEMP`, `USER_IP`, `USER_BROWSER`, `USER_SESSION_TEMP`) VALUES
(1, 'dbdfbcc1014b01c9040717827d1c0ef25f09f57f', '2016-05-16 18:28:23', '2016-05-16 18:28:23', '2016-05-16 18:28:23', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(2, '7436818f86a0603a832658514aee955283ff0591', '2016-05-16 18:28:47', '2016-05-16 18:28:47', '2016-05-16 18:28:47', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(3, 'c344d40a90d14d02f806f4c423aa371b563393ae', '2016-05-16 18:29:42', '2016-05-16 18:29:42', '2016-05-16 18:29:42', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(4, '879019ca2239951437f3701dce2551ee7929c405', '2016-05-16 18:30:55', '2016-05-16 18:30:55', '2016-05-16 18:30:55', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(5, '14c955624703ce83a5e0c04fae18681349317aa5', '2016-05-16 18:43:09', '2016-05-16 18:43:09', '2016-05-16 18:43:09', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(6, '04b4bbba57fc471b26346064ab7808ad36b33f7a', '2016-05-16 18:50:58', '2016-05-16 18:50:58', '2016-05-16 18:50:58', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(7, '3c13763d901f0bbe6be80b59c975bca617a767e6', '2016-05-16 18:54:50', '2016-05-16 18:54:50', '2016-05-16 18:54:50', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(8, 'ec0f3034cc8a442b22a88500ef7f76fce258ba77', '2016-05-16 19:04:06', '2016-05-16 19:04:06', '2016-05-16 19:04:06', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(9, '032cf128f9310ab3a7da7673ac5d1eb4b0ec243e', '2016-05-16 19:05:58', '2016-05-16 19:05:58', '2016-05-16 19:05:58', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(10, '49b4757ffface909d53fff8d9c6ff94ba382b9ec', '2016-05-16 19:18:54', '2016-05-16 19:18:54', '2016-05-16 19:18:54', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(11, '914fb390bff2520e34d86013a348435426368f35', '2016-05-16 19:25:13', '2016-05-16 19:25:13', '2016-05-16 19:25:13', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(12, '9e62bb453b7a1cb01fb2ed5bf445379aa34ec914', '2016-05-16 19:57:33', '2016-05-16 19:57:33', '2016-05-16 19:57:33', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(13, '7b26cd79bad12da483709d3d444d0d89bc802566', '2016-05-16 20:01:26', '2016-05-16 20:01:26', '2016-05-16 20:01:26', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(14, '4d6d502644d091f4238c096913285221ef166abd', '2016-05-16 20:04:55', '2016-05-16 20:04:55', '2016-05-16 20:04:55', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(15, 'aebadc2f9e2bfa5b7a31cda672391805daead487', '2016-05-16 20:08:41', '2016-05-16 20:08:41', '2016-05-16 20:08:41', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(16, 'd35fc8c2135d853118863df19551d9905eebf3ee', '2016-05-16 20:09:31', '2016-05-16 20:09:31', '2016-05-16 20:09:31', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(17, '03aca5d7c51b21da269f05b21d86a1f3c238a698', '2016-05-16 20:12:35', '2016-05-16 20:12:35', '2016-05-16 20:12:35', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(18, 'cf417f9fd5a4e8c25de1f052f4d2943cab17101e', '2016-05-16 20:16:14', '2016-05-16 20:16:14', '2016-05-16 20:16:14', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(19, 'b1e53cb53f0a05316cabb66e8179edc3270a9169', '2016-05-16 20:28:12', '2016-05-16 20:28:12', '2016-05-16 20:28:12', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(20, 'c34627557f46b2ebfd07499f4ce20c35daffd6dd', '2016-05-16 20:33:21', '2016-05-16 20:33:21', '2016-05-16 20:33:21', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(21, '653adab96fbab0a90342ec9e656ebb3abe1fd5c0', '2016-05-16 20:34:10', '2016-05-16 20:34:10', '2016-05-16 20:34:10', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(22, 'f28b111a7abfc826bbbc883c01a057c2b158557c', '2016-05-16 20:35:02', '2016-05-16 20:35:02', '2016-05-16 20:35:02', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(23, 'f7b4b06b66c61ba063378027085523724954868b', '2016-05-16 20:36:48', '2016-05-16 20:36:48', '2016-05-16 20:36:48', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(24, 'd3192ba7b4025b30e4782fa6a34c857c35ed4737', '2016-05-16 20:37:22', '2016-05-16 20:37:22', '2016-05-16 20:37:22', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(25, '612f65d8f25ef80e3402d6b280b56a5a238a09a7', '2016-05-16 20:41:20', '2016-05-16 20:41:20', '2016-05-16 20:41:20', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(26, 'e81424f494d156e43be7559c711f99cb47d6edfc2', '2016-05-16 20:44:55', '2016-05-16 20:44:55', '2016-05-16 20:44:55', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(27, 'c611a66223c8f054b74a079200ba96fdb7a5a21a', '2016-05-16 21:01:55', '2016-05-16 21:01:55', '2016-05-16 21:01:55', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(28, '5e0ffff2c56bd7284f669755bad820d06e22fe1a', '2016-05-16 21:02:28', '2016-05-16 21:02:28', '2016-05-16 21:02:28', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(29, '03901fedfd76679d3041b1110b31271ec17e3f2a', '2016-05-16 21:06:12', '2016-05-16 21:06:12', '2016-05-16 21:06:12', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(30, '1f20304095869581110c6ecdd1f2cc2b4469475a', '2016-05-16 21:27:33', '2016-05-16 21:27:33', '2016-05-16 21:27:33', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(31, 'f9e056b3761e137fd9210c95f35a1be6c2904fda', '2016-05-16 21:44:19', '2016-05-16 21:44:19', '2016-05-16 21:44:19', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(32, 'ef4bd91be3959801238a1cc146a69937e4fc700a', '2016-05-17 16:09:25', '2016-05-17 16:09:25', '2016-05-17 16:09:25', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(33, 'ae4eb93dee4e31b14a3b7e1cb538e831bec39fac', '2016-05-17 16:18:40', '2016-05-17 16:18:40', '2016-05-17 16:18:40', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(34, '1889461ce9c2f61e65b1384257016e78e801e7ec', '2016-05-18 17:07:13', '2016-05-18 17:07:13', '2016-05-18 17:07:13', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(35, 'a402274d86b2d77b013b99e0431ba1ab66973c75', '2016-05-18 17:12:07', '2016-05-18 17:12:07', '2016-05-18 17:12:07', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(36, '359be95978af436062c0c4d7e85a8953f0e6e6c7', '2016-05-18 17:13:17', '2016-05-18 17:13:17', '2016-05-18 17:13:17', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(37, '776c4d173729662a5fc346a9dfe3545144c7ecaa', '2016-05-18 17:21:13', '2016-05-18 17:21:13', '2016-05-18 17:21:13', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(38, '95de601462bc13465cb841b49c06aded0bd63e79', '2016-05-18 20:31:06', '2016-05-18 20:31:06', '2016-05-18 20:31:06', '192.168.0.{Random(0,254)}', 'Chrome', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_sessions_access_2`
--

CREATE TABLE `user_sessions_access_2` (
  `ID_SESSION` tinyint(4) NOT NULL,
  `USER_KEY` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `USER_DATE_CREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `USER_DATE_CURRENT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `USER_DATE_TEMP` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `USER_IP` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `USER_BROWSER` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `USER_SESSION_TEMP` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `user_sessions_access_2`
--

INSERT INTO `user_sessions_access_2` (`ID_SESSION`, `USER_KEY`, `USER_DATE_CREATED`, `USER_DATE_CURRENT`, `USER_DATE_TEMP`, `USER_IP`, `USER_BROWSER`, `USER_SESSION_TEMP`) VALUES
(1, '9e5b27127dc499de4f175edeee50fb7a9972903d', '2016-05-17 16:13:38', '2016-05-17 16:13:38', '2016-05-17 16:13:38', '192.168.0.{Random(0,254)}', 'Chrome', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_session_access`
--

CREATE TABLE `user_session_access` (
  `ID_USER` tinyint(4) NOT NULL,
  `USER_SESSIONS` tinyint(4) NOT NULL DEFAULT '0',
  `USER_SESSION_PASS` varchar(255) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `user_session_access`
--

INSERT INTO `user_session_access` (`ID_USER`, `USER_SESSIONS`, `USER_SESSION_PASS`) VALUES
(1, 38, 'f03bce9aa957ea8aa00f0de99ad143bab00f4aa0'),
(2, 1, '2');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`ID_DEPARTMENT`);

--
-- Indices de la tabla `department_area_2`
--
ALTER TABLE `department_area_2`
  ADD PRIMARY KEY (`ID_AREA`);

--
-- Indices de la tabla `department_area_user_access_1_1`
--
ALTER TABLE `department_area_user_access_1_1`
  ADD PRIMARY KEY (`ID_USER`);

--
-- Indices de la tabla `department_area_user_access_1_2`
--
ALTER TABLE `department_area_user_access_1_2`
  ADD PRIMARY KEY (`ID_USER`);

--
-- Indices de la tabla `department_area_user_access_2_1`
--
ALTER TABLE `department_area_user_access_2_1`
  ADD PRIMARY KEY (`ID_USER`);

--
-- Indices de la tabla `department_area_user_access_2_2`
--
ALTER TABLE `department_area_user_access_2_2`
  ADD PRIMARY KEY (`ID_USER`);

--
-- Indices de la tabla `department_area_user_access_3_1`
--
ALTER TABLE `department_area_user_access_3_1`
  ADD PRIMARY KEY (`ID_USER`);

--
-- Indices de la tabla `department_area_user_access_3_2`
--
ALTER TABLE `department_area_user_access_3_2`
  ADD PRIMARY KEY (`ID_USER`);

--
-- Indices de la tabla `department_area_user_access_4_1`
--
ALTER TABLE `department_area_user_access_4_1`
  ADD PRIMARY KEY (`ID_USER`);

--
-- Indices de la tabla `department_area_user_access_4_2`
--
ALTER TABLE `department_area_user_access_4_2`
  ADD PRIMARY KEY (`ID_USER`);

--
-- Indices de la tabla `department_area_user_access_5_1`
--
ALTER TABLE `department_area_user_access_5_1`
  ADD PRIMARY KEY (`ID_USER`);

--
-- Indices de la tabla `department_area_user_access_5_2`
--
ALTER TABLE `department_area_user_access_5_2`
  ADD PRIMARY KEY (`ID_USER`);

--
-- Indices de la tabla `department_user_access_1`
--
ALTER TABLE `department_user_access_1`
  ADD PRIMARY KEY (`ID_USER`);

--
-- Indices de la tabla `department_user_access_2`
--
ALTER TABLE `department_user_access_2`
  ADD PRIMARY KEY (`ID_USER`);

--
-- Indices de la tabla `department_user_access_3`
--
ALTER TABLE `department_user_access_3`
  ADD PRIMARY KEY (`ID_USER`);

--
-- Indices de la tabla `department_user_access_4`
--
ALTER TABLE `department_user_access_4`
  ADD PRIMARY KEY (`ID_USER`);

--
-- Indices de la tabla `department_user_access_5`
--
ALTER TABLE `department_user_access_5`
  ADD PRIMARY KEY (`ID_USER`);

--
-- Indices de la tabla `user_access`
--
ALTER TABLE `user_access`
  ADD PRIMARY KEY (`ID_USER`);

--
-- Indices de la tabla `user_sessions_access_1`
--
ALTER TABLE `user_sessions_access_1`
  ADD UNIQUE KEY `ID_SESSION` (`ID_SESSION`);

--
-- Indices de la tabla `user_sessions_access_2`
--
ALTER TABLE `user_sessions_access_2`
  ADD UNIQUE KEY `ID_SESSION` (`ID_SESSION`);

--
-- Indices de la tabla `user_session_access`
--
ALTER TABLE `user_session_access`
  ADD PRIMARY KEY (`ID_USER`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `user_access`
--
ALTER TABLE `user_access`
  MODIFY `ID_USER` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `department_area_user_access_1_1`
--
ALTER TABLE `department_area_user_access_1_1`
  ADD CONSTRAINT `department_area_user_access_1_1_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `user_access` (`ID_USER`);

--
-- Filtros para la tabla `department_area_user_access_1_2`
--
ALTER TABLE `department_area_user_access_1_2`
  ADD CONSTRAINT `department_area_user_access_1_2_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `user_access` (`ID_USER`);

--
-- Filtros para la tabla `department_area_user_access_2_1`
--
ALTER TABLE `department_area_user_access_2_1`
  ADD CONSTRAINT `department_area_user_access_2_1_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `user_access` (`ID_USER`);

--
-- Filtros para la tabla `department_area_user_access_2_2`
--
ALTER TABLE `department_area_user_access_2_2`
  ADD CONSTRAINT `department_area_user_access_2_2_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `user_access` (`ID_USER`);

--
-- Filtros para la tabla `department_area_user_access_3_1`
--
ALTER TABLE `department_area_user_access_3_1`
  ADD CONSTRAINT `department_area_user_access_3_1_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `user_access` (`ID_USER`);

--
-- Filtros para la tabla `department_area_user_access_3_2`
--
ALTER TABLE `department_area_user_access_3_2`
  ADD CONSTRAINT `department_area_user_access_3_2_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `user_access` (`ID_USER`);

--
-- Filtros para la tabla `department_area_user_access_4_1`
--
ALTER TABLE `department_area_user_access_4_1`
  ADD CONSTRAINT `department_area_user_access_4_1_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `user_access` (`ID_USER`);

--
-- Filtros para la tabla `department_area_user_access_4_2`
--
ALTER TABLE `department_area_user_access_4_2`
  ADD CONSTRAINT `department_area_user_access_4_2_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `user_access` (`ID_USER`);

--
-- Filtros para la tabla `department_area_user_access_5_1`
--
ALTER TABLE `department_area_user_access_5_1`
  ADD CONSTRAINT `department_area_user_access_5_1_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `user_access` (`ID_USER`);

--
-- Filtros para la tabla `department_area_user_access_5_2`
--
ALTER TABLE `department_area_user_access_5_2`
  ADD CONSTRAINT `department_area_user_access_5_2_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `user_access` (`ID_USER`);

--
-- Filtros para la tabla `department_user_access_1`
--
ALTER TABLE `department_user_access_1`
  ADD CONSTRAINT `department_user_access_1_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `user_access` (`ID_USER`);

--
-- Filtros para la tabla `department_user_access_2`
--
ALTER TABLE `department_user_access_2`
  ADD CONSTRAINT `department_user_access_2_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `user_access` (`ID_USER`);

--
-- Filtros para la tabla `department_user_access_3`
--
ALTER TABLE `department_user_access_3`
  ADD CONSTRAINT `department_user_access_3_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `user_access` (`ID_USER`);

--
-- Filtros para la tabla `department_user_access_4`
--
ALTER TABLE `department_user_access_4`
  ADD CONSTRAINT `department_user_access_4_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `user_access` (`ID_USER`);

--
-- Filtros para la tabla `department_user_access_5`
--
ALTER TABLE `department_user_access_5`
  ADD CONSTRAINT `department_user_access_5_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `user_access` (`ID_USER`);

--
-- Filtros para la tabla `user_session_access`
--
ALTER TABLE `user_session_access`
  ADD CONSTRAINT `user_session_access_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `user_access` (`ID_USER`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
