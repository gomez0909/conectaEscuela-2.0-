-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-08-2026 a las 05:21:39
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `conectaescuela_2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha` date NOT NULL,
  `lugar` varchar(150) NOT NULL,
  `horas` int(11) NOT NULL,
  `cupos` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL DEFAULT 'disponible',
  `creado_por` int(11) NOT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id`, `nombre`, `descripcion`, `fecha`, `lugar`, `horas`, `cupos`, `estado`, `creado_por`, `creado_en`) VALUES
(1, 'Jornada Ambiental', 'Limpieza y recuperaciÃ³n de las zonas verdes de la instituciÃ³n.', '2026-08-30', 'INEM JosÃ© FÃ©lix De Restrepo', 4, 20, 'disponible', 2, '2026-08-19 02:16:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones`
--

CREATE TABLE `inscripciones` (
  `id` int(11) NOT NULL,
  `estudiante_id` int(11) NOT NULL,
  `actividad_id` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL DEFAULT 'inscrito',
  `inscrito_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `inscripciones`
--

INSERT INTO `inscripciones` (`id`, `estudiante_id`, `actividad_id`, `estado`, `inscrito_en`) VALUES
(1, 1, 1, 'inscrito', '2026-08-19 03:11:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `codigo_estudiantil` varchar(30) NOT NULL,
  `grado` varchar(20) NOT NULL,
  `seccion` varchar(20) NOT NULL,
  `rol` varchar(20) NOT NULL DEFAULT 'estudiante',
  `estado` varchar(20) NOT NULL DEFAULT 'activo',
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `correo`, `password`, `codigo_estudiantil`, `grado`, `seccion`, `rol`, `estado`, `creado_en`) VALUES
(1, 'Luis Mateo', 'GÃ³mez Alzate', 'luis.gomezalzate@inemjose.edu.co', '$2y$10$qMFUn2xp41MPIotH8KhY5uv/CcH4RuqIRQ7Tr37NkC.Z4Ibg5fo4a', '84', '11', '10', 'estudiante', 'activo', '2026-08-18 00:58:26'),
(2, 'Luis Felipe', 'DÃ­az Vega', 'luis.diazvega@inemjose.edu.co', '$2y$10$.sVTnt0bN4/r52lrkxYucuJqzrv/DRNdoMjsezOadMc84P4/KDLZ2', '85', '11', '10', 'coordinador', 'activo', '2026-08-18 03:00:54'),
(3, 'Isaac', 'Arroyave Ãlvarez', 'isaac.arroyavealvarez@inemjose.edu.co', '$2y$10$ls1zyj7kngR8Lg1gm/g7uedstMcGLVXCYXCo9CWNTVKvbVr6CqTle', '86', '11', '10', 'administrador', 'activo', '2026-08-18 03:01:37');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creado_por` (`creado_por`);

--
-- Indices de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estudiante_id` (`estudiante_id`),
  ADD KEY `actividad_id` (`actividad_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD UNIQUE KEY `codigo_estudiantil` (`codigo_estudiantil`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
