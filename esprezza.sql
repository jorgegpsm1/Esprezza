-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-06-2016 a las 00:26:30
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 7.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `esprezza`
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
(1, 'Sistemas', 1),
(2, 'Direccion General', 1),
(3, 'Sub Direccion Administracion y Finanzas', 1),
(4, 'Nominas', 1);

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
(1, 'Area A', 1);

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
(1, 'Area A', 1);

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
(1, 'Area a', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `department_area_4`
--

CREATE TABLE `department_area_4` (
  `id_area` tinyint(4) NOT NULL,
  `area_name` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `area_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `department_area_4`
--

INSERT INTO `department_area_4` (`id_area`, `area_name`, `area_status`) VALUES
(1, 'Area_1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `department_area_user_access_1_1`
--

CREATE TABLE `department_area_user_access_1_1` (
  `ID_USER` tinyint(4) NOT NULL,
  `USER_DEPARTMENT_AREA_STATUS` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `department_area_user_access_1_1`
--

INSERT INTO `department_area_user_access_1_1` (`ID_USER`, `USER_DEPARTMENT_AREA_STATUS`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 0),
(6, 0),
(7, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `department_area_user_access_2_1`
--

CREATE TABLE `department_area_user_access_2_1` (
  `ID_USER` tinyint(4) NOT NULL,
  `USER_DEPARTMENT_AREA_STATUS` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `department_area_user_access_2_1`
--

INSERT INTO `department_area_user_access_2_1` (`ID_USER`, `USER_DEPARTMENT_AREA_STATUS`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 0),
(6, 1),
(7, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `department_area_user_access_3_1`
--

CREATE TABLE `department_area_user_access_3_1` (
  `ID_USER` tinyint(4) NOT NULL,
  `USER_DEPARTMENT_AREA_STATUS` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `department_area_user_access_3_1`
--

INSERT INTO `department_area_user_access_3_1` (`ID_USER`, `USER_DEPARTMENT_AREA_STATUS`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `department_area_user_access_4_1`
--

CREATE TABLE `department_area_user_access_4_1` (
  `id_user` tinyint(4) NOT NULL,
  `user_department_area_status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `department_area_user_access_4_1`
--

INSERT INTO `department_area_user_access_4_1` (`id_user`, `user_department_area_status`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1);

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
(2, 1),
(3, 1),
(4, 1),
(5, 0),
(6, 0),
(7, 0);

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
(2, 1),
(3, 1),
(4, 1),
(5, 0),
(6, 1),
(7, 0);

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
(2, 0),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `department_user_access_4`
--

CREATE TABLE `department_user_access_4` (
  `id_user` tinyint(4) NOT NULL,
  `user_department_status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `department_user_access_4`
--

INSERT INTO `department_user_access_4` (`id_user`, `user_department_status`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1);

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
(2, 'pablo', '$2y$10$fUnSHnudXf0vm6yZ0Tv4VOhIRo5sTE4SzKgt4AIK5ydjuOtvv9lZu', 1),
(3, 'arodriguez', '$2y$10$rrcV1dkxpVRrHazFBF2Cp.3XEFrhBhfkY9cbw3Rhxv0l3KTEPtm0i', 1),
(4, 'kvalencia', '$2y$10$Uez4emDD2n9zFyMhXzuN2./eEvhyLUXZkEm7FUyIY53p9zz3o.WJ.', 1),
(5, 'dmilan', '$2y$10$Y11huZM7nO8TBxNDxXf2ZuqWqnFzfuOXEz7sfDfsBxh6xklxOQ1w2', 1),
(6, 'ffigueroa', '$2y$10$Y389iyuGgVf/lBaPlwU8z.KPyMUENwTAvM5jk0UweMF5BxtDUiq12', 1),
(7, 'vmurillo', '$2y$10$01TQk7hB74mGnTjsv7wYxuL9NA2y5zuq5qdDWwQeUpeEld603kEzm', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_info`
--

CREATE TABLE `user_info` (
  `id_user` tinyint(4) NOT NULL,
  `id_job` tinyint(3) UNSIGNED NOT NULL,
  `user_name` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `user_last_name` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `user_img` varchar(120) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `user_info`
--

INSERT INTO `user_info` (`id_user`, `id_job`, `user_name`, `user_last_name`, `user_img`) VALUES
(1, 1, 'Jorge', 'Garcia', 'default_avatar_male.jpg'),
(3, 1, 'Aristeo', 'Rodriguez', 'profile-bg.jpg'),
(4, 1, 'Karla', 'Valencia', 'profile-cover.jpg'),
(5, 3, 'Diego', 'Milan', 'coming-soon.jpg'),
(6, 2, 'Francisco', 'Figueroa', 'user-4.jpg'),
(7, 4, 'Victor', 'Murillo', 'user-13.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_job`
--

CREATE TABLE `user_job` (
  `id_job` tinyint(3) UNSIGNED NOT NULL,
  `job_name` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `job_status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `user_job`
--

INSERT INTO `user_job` (`id_job`, `job_name`, `job_status`) VALUES
(1, 'Sistemas', 1),
(2, 'Dirección General', 1),
(3, 'Dirección Financiera', 1),
(4, 'Nominas', 1);

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
(1, 'dbdfbcc1014b01c9040717827d1c0ef25f09f57f', '2016-05-24 16:56:35', '2016-05-24 16:56:35', '2016-05-24 16:56:35', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(2, '7436818f86a0603a832658514aee955283ff0591', '2016-05-25 14:34:17', '2016-05-25 14:34:17', '2016-05-25 14:34:17', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(3, 'c344d40a90d14d02f806f4c423aa371b563393ae', '2016-05-26 15:59:17', '2016-05-26 15:59:17', '2016-05-26 15:59:17', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(4, '879019ca2239951437f3701dce2551', '2016-05-26 15:59:42', '2016-05-26 15:59:42', '2016-05-26 15:59:42', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(5, '14c955624703ce83a5e0c04fae18681349317aa5', '2016-05-26 16:26:01', '2016-05-26 16:26:01', '2016-05-26 16:26:01', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(6, '04b4bbba57fc471b26346064ab7808ad36b33f7a', '2016-05-26 19:49:09', '2016-05-26 19:49:09', '2016-05-26 19:49:09', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(7, '3c13763d901f0bbe6be80b59c975bca617a767e6', '2016-05-30 14:24:05', '2016-05-30 14:24:05', '2016-05-30 14:24:05', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(8, 'ec0f3034cc8a442b22a88500ef7f76fce258ba77', '2016-05-30 14:25:28', '2016-05-30 14:25:28', '2016-05-30 14:25:28', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(9, '032cf128f9310ab3a7da7673ac5d1eb4b0ec243e', '2016-05-31 17:02:05', '2016-05-31 17:02:05', '2016-05-31 17:02:05', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(10, '49b4757ffface909d53fff8d9c6ff94ba382b9ec', '2016-05-31 17:31:49', '2016-05-31 17:31:49', '2016-05-31 17:31:49', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(11, '914fb390bff2520e34d86013a348435426368f35', '2016-06-01 14:32:47', '2016-06-01 14:32:47', '2016-06-01 14:32:47', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(12, '9e62bb453b7a1cb01fb2ed5bf445379aa34ec914', '2016-06-01 20:52:02', '2016-06-01 20:52:02', '2016-06-01 20:52:02', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(13, '7b26cd79bad12da483709d3d444d0d89bc802566', '2016-06-02 14:22:39', '2016-06-02 14:22:39', '2016-06-02 14:22:39', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(14, '4d6d502644d091f4238c096913285221ef166abd', '2016-06-02 16:42:58', '2016-06-02 16:42:58', '2016-06-02 16:42:58', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(15, 'aebadc2f9e2bfa5b7a31cda672391805daead487', '2016-06-02 17:18:05', '2016-06-02 17:18:05', '2016-06-02 17:18:05', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(16, 'd35fc8c2135d853118863df19551d9905eebf3ee', '2016-06-02 18:14:21', '2016-06-02 18:14:21', '2016-06-02 18:14:21', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(17, '03aca5d7c51b21da269f05b21d86a1f3c238a698', '2016-06-02 18:29:12', '2016-06-02 18:29:12', '2016-06-02 18:29:12', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(18, 'cf417f9fd5a4e8c25de1f052f4d2943cab17101e', '2016-06-02 19:18:56', '2016-06-02 19:18:56', '2016-06-02 19:18:56', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(19, 'b1e53cb53f0a05316cabb66e8179edc3270a9169', '2016-06-02 19:54:24', '2016-06-02 19:54:24', '2016-06-02 19:54:24', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(20, 'c34627557f46b2ebfd07499f4ce20c35daffd6dd', '2016-06-02 20:34:28', '2016-06-02 20:34:28', '2016-06-02 20:34:28', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(21, '653adab96fbab0a90342ec9e656ebb3abe1fd5c0', '2016-06-02 21:17:31', '2016-06-02 21:17:31', '2016-06-02 21:17:31', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(22, 'f28b111a7abfc826bbbc883c01a057c2b158557c', '2016-06-02 21:36:03', '2016-06-02 21:36:03', '2016-06-02 21:36:03', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(23, 'f7b4b06b66c61ba063378027085523724954868b', '2016-06-02 21:41:58', '2016-06-02 21:41:58', '2016-06-02 21:41:58', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(24, 'd3192ba7b4025b30e4782fa6a34c857c35ed4737', '2016-06-02 21:54:13', '2016-06-02 21:54:13', '2016-06-02 21:54:13', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(25, '612f65d8f25ef80e3402d6b280b56a5a238a09a7', '2016-06-02 21:56:04', '2016-06-02 21:56:04', '2016-06-02 21:56:04', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(26, 'e81424f494d156e43be7559c711f99cb47d6edfc', '2016-06-02 22:11:50', '2016-06-02 22:11:50', '2016-06-02 22:11:50', '192.168.0.{Random(0,254)}', 'Chrome', 1);

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
(1, '9e5b27127dc499de4f175edeee50fb7a9972903d', '2016-05-24 18:07:29', '2016-05-24 18:07:29', '2016-05-24 18:07:29', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(2, 'bfc4ed301c64a1ee27e5f12437743261c5ddef11', '2016-05-24 18:11:09', '2016-05-24 18:11:09', '2016-05-24 18:11:09', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(3, 'f41a2b4ff8ff3ea3746bed66fc1cc2a9ecc02629', '2016-05-25 14:34:39', '2016-05-25 14:34:39', '2016-05-25 14:34:39', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(4, '78651f427813d2a28052ef3e2660132eff1104d9', '2016-05-26 16:10:26', '2016-05-26 16:10:26', '2016-05-26 16:10:26', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(5, '2637c488008752b2448b4fcc70af8c850344ef96', '2016-06-02 17:22:18', '2016-06-02 17:22:18', '2016-06-02 17:22:18', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(6, '1e3b6c591919bd32282f911414eda28cefda78a8', '2016-06-02 17:31:45', '2016-06-02 17:31:45', '2016-06-02 17:31:45', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(7, '10150ffb6e75a9ca7a4902cac7857ce2820d5c96', '2016-06-02 17:33:19', '2016-06-02 17:33:19', '2016-06-02 17:33:19', '192.168.0.{Random(0,254)}', 'Chrome', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_sessions_access_3`
--

CREATE TABLE `user_sessions_access_3` (
  `id_session` tinyint(4) NOT NULL,
  `user_key` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `user_date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_date_current` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_date_temp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_ip` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `user_browser` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `user_session_temp` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `user_sessions_access_3`
--

INSERT INTO `user_sessions_access_3` (`id_session`, `user_key`, `user_date_created`, `user_date_current`, `user_date_temp`, `user_ip`, `user_browser`, `user_session_temp`) VALUES
(1, '49f3f0c226007bde0f7e4994c882d03223d8d177', '2016-05-31 16:57:54', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(2, '693bd30bf5d1061a5e29ad67baa58250d6dab6e9', '2016-05-31 17:55:52', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(3, 'aa9fe2faf1658db7172a4331740fa1a671d53aaa', '2016-06-02 17:20:02', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(4, '2b0da2a4150816215a61419f1dbe45cf7547405c', '2016-06-02 18:25:16', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(5, 'fe977d09c421751b67b2604f8ef8d3cdd4bb5a94', '2016-06-02 18:31:53', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(6, '496be4beee0701cf061cb1a9deec6bd316e99ce0', '2016-06-02 19:10:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(7, '6c10ad6db822711207a0420f38e8ca46b9f7abbe', '2016-06-02 19:20:56', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(8, '88b6eb7ef4164c5d0115c438ef5069ca57c4eae9', '2016-06-02 19:25:26', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(9, '7b5ccd45f0bfa488a93d5cd7a95a140e87a37acc', '2016-06-02 20:18:07', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(10, '586ba7517b41ca028c53c785be008b2a9c9af6cf', '2016-06-02 20:35:36', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(11, 'a470414770110b07437d4555994607dd897a0543', '2016-06-02 21:18:29', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(12, '91b37677295910f69f94f4491cdb1dd43a7b8f8c', '2016-06-02 21:35:50', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(13, '847502946464a3f26172a2aeeb6f63001155bf84', '2016-06-02 22:09:26', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(14, 'd9288e1f474b17631b1fe1ff6f10bb90aaae18f1', '2016-06-02 22:17:56', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(15, '900fda65a851670579457e0ca3832583bf9bb24a', '2016-06-02 22:22:49', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_sessions_access_4`
--

CREATE TABLE `user_sessions_access_4` (
  `id_session` tinyint(4) NOT NULL,
  `user_key` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `user_date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_date_current` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_date_temp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_ip` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `user_browser` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `user_session_temp` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `user_sessions_access_4`
--

INSERT INTO `user_sessions_access_4` (`id_session`, `user_key`, `user_date_created`, `user_date_current`, `user_date_temp`, `user_ip`, `user_browser`, `user_session_temp`) VALUES
(1, '43b2402cb1ce9f818bcf7e77086a171b3e92350b', '2016-05-31 18:03:46', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(2, 'c5f4110e65f19f1e02b120ad7dd0cd0750a3c7e6', '2016-06-02 17:20:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(3, '68e122bcf4b2ed170ec875ca21d9c144c13d9d9a', '2016-06-02 18:28:43', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(4, '37091ffdf2dd63d0a21134db027108cc762496b6', '2016-06-02 19:05:36', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(5, '24654fa7f08c5fa505e242905d60e5b746350327', '2016-06-02 19:09:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(6, '6b9c1ad8e4acbb334b140971b66cb8146241b656', '2016-06-02 19:26:20', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(7, '3b2cd582440d0e45937636e9665c414f9c525342', '2016-06-02 19:34:54', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(8, 'd7fa48f9caa748889a9bb322bb6045eaae02ae14', '2016-06-02 20:34:45', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(9, '86ea9a6ef8a6b5a115b010cdaa8c5899bcf28547', '2016-06-02 21:10:50', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(10, '3c3d3c3c4ec13d43b55abc87774b368dd51218c5', '2016-06-02 21:18:38', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(11, '5ee7fcec3342fc939c5d75853194ed84ba84caf8', '2016-06-02 21:52:27', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_sessions_access_5`
--

CREATE TABLE `user_sessions_access_5` (
  `id_session` tinyint(4) NOT NULL,
  `user_key` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `user_date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_date_current` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_date_temp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_ip` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `user_browser` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `user_session_temp` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `user_sessions_access_5`
--

INSERT INTO `user_sessions_access_5` (`id_session`, `user_key`, `user_date_created`, `user_date_current`, `user_date_temp`, `user_ip`, `user_browser`, `user_session_temp`) VALUES
(1, '246180d71bb4835f68aae46b94c3169fe8ba67a1', '2016-05-31 17:53:20', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(2, '4c89c5535d8536196c4ea9b25c868b48309c1d2e', '2016-05-31 17:56:30', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(3, '95cfad048a3cfe58a973d70efc4259e8fd19b879', '2016-06-02 21:18:09', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(4, '2a4c457298fcea131d93a28510602ef6a13c580f', '2016-06-02 21:39:11', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(5, 'b0b3cdf74346f71285644387a7a27edde288f184', '2016-06-02 21:42:32', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(6, '9d77eb2f6464e728962437f78e3069569abf9eea', '2016-06-02 21:54:22', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(7, '259d02ee2df87be7f6d4d4d3ebc88c3bfad3a73e', '2016-06-02 22:06:17', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(8, 'c2f08e6089248091215bc4fddc487926196caeab', '2016-06-02 22:06:32', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(9, '3c6dc975d6c5cc5323c14889522be881a2451a1a', '2016-06-02 22:08:30', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(10, 'c3a48f2cf9ee9b09567bd6677e31feee1aef8f5b', '2016-06-02 22:19:58', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_sessions_access_6`
--

CREATE TABLE `user_sessions_access_6` (
  `id_session` tinyint(4) NOT NULL,
  `user_key` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `user_date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_date_current` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_date_temp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_ip` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `user_browser` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `user_session_temp` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `user_sessions_access_6`
--

INSERT INTO `user_sessions_access_6` (`id_session`, `user_key`, `user_date_created`, `user_date_current`, `user_date_temp`, `user_ip`, `user_browser`, `user_session_temp`) VALUES
(1, '668ee4a1f17836b02cf6d3344b7d4239e86bae2c', '2016-05-31 17:16:36', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(2, 'bf67f6ad851e4b3e5982b88e3e3c83c3e2cbd3ec', '2016-05-31 17:58:06', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(3, '7e5dcc01387e377b738440dabe04ab76301cfeea', '2016-06-02 21:38:45', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(4, 'c22521881fd59c277454c8d432fc1727a6a6fb13', '2016-06-02 22:10:17', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(5, 'e19ae23933106dd5d8e9f731055022a4687ae6c1', '2016-06-02 22:21:55', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_sessions_access_7`
--

CREATE TABLE `user_sessions_access_7` (
  `id_session` tinyint(4) NOT NULL,
  `user_key` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `user_date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_date_current` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_date_temp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_ip` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `user_browser` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `user_session_temp` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `user_sessions_access_7`
--

INSERT INTO `user_sessions_access_7` (`id_session`, `user_key`, `user_date_created`, `user_date_current`, `user_date_temp`, `user_ip`, `user_browser`, `user_session_temp`) VALUES
(1, '6b153d8878e34dd6467dd40eec390eb70b8b0ace', '2016-05-31 17:05:31', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 0),
(2, '4088e6848dd54d05a56530b37c39068a043fca17', '2016-05-31 17:49:47', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(3, '8a8ec8b4d942310f4d2b05254393de742f9e1891', '2016-05-31 17:58:48', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1),
(4, 'a24b3b67b81bae44003fd410e92e3b6d2d5b8c17', '2016-05-31 18:15:03', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '192.168.0.{Random(0,254)}', 'Chrome', 1);

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
(1, 26, '123'),
(2, 7, '123'),
(3, 15, '123'),
(4, 11, '123'),
(5, 10, '123'),
(6, 5, '123'),
(7, 4, '123');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`ID_DEPARTMENT`);

--
-- Indices de la tabla `department_area_1`
--
ALTER TABLE `department_area_1`
  ADD PRIMARY KEY (`ID_AREA`);

--
-- Indices de la tabla `department_area_2`
--
ALTER TABLE `department_area_2`
  ADD PRIMARY KEY (`ID_AREA`);

--
-- Indices de la tabla `department_area_3`
--
ALTER TABLE `department_area_3`
  ADD PRIMARY KEY (`ID_AREA`);

--
-- Indices de la tabla `department_area_4`
--
ALTER TABLE `department_area_4`
  ADD PRIMARY KEY (`id_area`);

--
-- Indices de la tabla `department_area_user_access_1_1`
--
ALTER TABLE `department_area_user_access_1_1`
  ADD PRIMARY KEY (`ID_USER`);

--
-- Indices de la tabla `department_area_user_access_2_1`
--
ALTER TABLE `department_area_user_access_2_1`
  ADD PRIMARY KEY (`ID_USER`);

--
-- Indices de la tabla `department_area_user_access_3_1`
--
ALTER TABLE `department_area_user_access_3_1`
  ADD PRIMARY KEY (`ID_USER`);

--
-- Indices de la tabla `department_area_user_access_4_1`
--
ALTER TABLE `department_area_user_access_4_1`
  ADD PRIMARY KEY (`id_user`);

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
  ADD PRIMARY KEY (`id_user`);

--
-- Indices de la tabla `user_access`
--
ALTER TABLE `user_access`
  ADD PRIMARY KEY (`ID_USER`);

--
-- Indices de la tabla `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_job` (`id_job`);

--
-- Indices de la tabla `user_job`
--
ALTER TABLE `user_job`
  ADD PRIMARY KEY (`id_job`);

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
-- Indices de la tabla `user_sessions_access_3`
--
ALTER TABLE `user_sessions_access_3`
  ADD UNIQUE KEY `id_session` (`id_session`);

--
-- Indices de la tabla `user_sessions_access_4`
--
ALTER TABLE `user_sessions_access_4`
  ADD UNIQUE KEY `id_session` (`id_session`);

--
-- Indices de la tabla `user_sessions_access_5`
--
ALTER TABLE `user_sessions_access_5`
  ADD UNIQUE KEY `id_session` (`id_session`);

--
-- Indices de la tabla `user_sessions_access_6`
--
ALTER TABLE `user_sessions_access_6`
  ADD UNIQUE KEY `id_session` (`id_session`);

--
-- Indices de la tabla `user_sessions_access_7`
--
ALTER TABLE `user_sessions_access_7`
  ADD UNIQUE KEY `id_session` (`id_session`);

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
  MODIFY `ID_USER` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `user_job`
--
ALTER TABLE `user_job`
  MODIFY `id_job` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `department_area_user_access_1_1`
--
ALTER TABLE `department_area_user_access_1_1`
  ADD CONSTRAINT `department_area_user_access_1_1_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `user_access` (`ID_USER`);

--
-- Filtros para la tabla `department_area_user_access_2_1`
--
ALTER TABLE `department_area_user_access_2_1`
  ADD CONSTRAINT `department_area_user_access_2_1_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `user_access` (`ID_USER`);

--
-- Filtros para la tabla `department_area_user_access_3_1`
--
ALTER TABLE `department_area_user_access_3_1`
  ADD CONSTRAINT `department_area_user_access_3_1_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `user_access` (`ID_USER`);

--
-- Filtros para la tabla `department_area_user_access_4_1`
--
ALTER TABLE `department_area_user_access_4_1`
  ADD CONSTRAINT `department_area_user_access_4_1_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user_access` (`ID_USER`);

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
  ADD CONSTRAINT `department_user_access_4_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user_access` (`ID_USER`);

--
-- Filtros para la tabla `user_info`
--
ALTER TABLE `user_info`
  ADD CONSTRAINT `user_info_ibfk_1` FOREIGN KEY (`id_job`) REFERENCES `user_job` (`id_job`),
  ADD CONSTRAINT `user_info_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user_access` (`ID_USER`);

--
-- Filtros para la tabla `user_session_access`
--
ALTER TABLE `user_session_access`
  ADD CONSTRAINT `user_session_access_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `user_access` (`ID_USER`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
