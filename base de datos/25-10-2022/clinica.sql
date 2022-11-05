-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-10-2022 a las 23:38:20
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `clinica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE `cuenta` (
  `cod_cuenta` int(11) NOT NULL,
  `nom_cuenta` varchar(50) NOT NULL,
  `pas_cuenta` varchar(255) NOT NULL,
  `Per_cod` int(10) UNSIGNED NOT NULL,
  `firstlogin_cuenta` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabla cuenta se ocupará para procesar el login, de manera que este tenga datos registrados por\r\nel personal de tipo TÉCNICO, y quienes sean TÉCNICOS por código de Personal será capaz de tener opciones de administración.\r\n\r\nLos tipos de SALUD podrán ingresar pacientes y registrar turnos. TÉCNICO serán capaz de remover personal.';

--
-- Volcado de datos para la tabla `cuenta`
--

INSERT INTO `cuenta` (`cod_cuenta`, `nom_cuenta`, `pas_cuenta`, `Per_cod`, `firstlogin_cuenta`) VALUES
(1, 'Pablo5', '$2y$10$5450l5BD0lN2LdbHacjmm.Op9XzcQC50NEBTGKkAbC1jpkFQAVLhO', 1, 1),
(2, 'Castro5', '$2y$10$w/L92J0XKLBBfrrXyGEEwe7PgPkBx1jYSA0SpKMw3DlrZUNkFgC4u', 4, 1),
(3, 'Simpleton', '$2y$10$GaSKqDWc.fI8JxOX4MSyr.OSkP0yMFmiZ9M62FqxPerBYJ4azImJC', 3, 1),
(4, 'TEST', '$2y$10$n3U1DVhfLWzmz0/cpaAK4e5Y50osCnmDJISpUHX9QfVJ7PoxGKcd2', 5, 1),
(5, 'TEST2', '$2y$10$ag582tMBT4IRWW.6NafV8uPvxLFbfdOlv8G/lkh.hAMxURnD5w8r6', 2, 1),
(6, 'Jacob_Denton', '$2y$10$Sp8Um/Ve/by6tHwDiTrhU.GPs6OeT9DriL2EFXpu4KFPYQBI4Dwn6', 101, 1),
(7, 'Test_5', '$2y$10$Z.eN5xBSsjbhed/R4fOFfOxFAO7pGK4Sajx.d4zMC0yMrn4maV6GS', 103, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `Pac_rut` int(9) NOT NULL,
  `Pac_nom` varchar(30) NOT NULL DEFAULT '',
  `Pac_edad` smallint(3) NOT NULL DEFAULT 0,
  `Pac_gen` char(1) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='rut = rut\r\nnom = nombre\r\nedad = edad\r\ngen = M(Masculino), F(Femenino), O(Otro)';

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`Pac_rut`, `Pac_nom`, `Pac_edad`, `Pac_gen`) VALUES
(111111111, 'SEBASTIAN', 21, 'M'),
(203828159, 'Testnuevo', 18, 'M'),
(203828160, 'DIEGO', 22, 'M'),
(203828161, 'TEST2', 199, 'O'),
(203828162, 'TEST', 19, 'O'),
(203828167, 'TEST', 20, 'O');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `Per_cod` int(10) UNSIGNED NOT NULL,
  `Per_nom` varchar(30) NOT NULL,
  `Per_edad` smallint(6) NOT NULL,
  `Per_gen` char(1) NOT NULL,
  `Per_tipo` tinyint(3) NOT NULL,
  `Per_espec` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='cod = código\r\nnom = nombre\r\nedad = edad\r\ngen = M(Masculino), F(Femenino), O(Otro)\r\ntipo = 1 (Salud), 2 (Técnico), 3 (Limpieza)\r\nespec = Especialización (SOLO PARA QUIENES SEAN TIPO SALUD)';

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`Per_cod`, `Per_nom`, `Per_edad`, `Per_gen`, `Per_tipo`, `Per_espec`) VALUES
(1, 'SEBASTIÁN', 21, 'M', 1, 'DOCTOR'),
(2, 'PABLO', 30, 'M', 1, 'PIRATA'),
(3, 'PEDRO', 35, 'M', 1, 'HACKER'),
(4, 'CASTRO', 40, 'M', 2, ''),
(5, 'TEST', 18, 'M', 2, NULL),
(101, 'Jacob Denton', 18, 'M', 2, NULL),
(103, 'Test5', 18, 'F', 2, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_personal`
--

CREATE TABLE `tipo_personal` (
  `tipo_cod` tinyint(4) NOT NULL DEFAULT 1,
  `tipo_nom` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='1 = SALUD, 2 = TÉCNICO, 3 = LIMPIEZA';

--
-- Volcado de datos para la tabla `tipo_personal`
--

INSERT INTO `tipo_personal` (`tipo_cod`, `tipo_nom`) VALUES
(1, 'SALUD'),
(2, 'TÉCNICO'),
(3, 'LIMPIEZA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_turno`
--

CREATE TABLE `tipo_turno` (
  `turn_tipo_cod` tinyint(3) NOT NULL DEFAULT 1,
  `turn_tipo_nom` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='1 = Diurno\r\n2 = Nocturno';

--
-- Volcado de datos para la tabla `tipo_turno`
--

INSERT INTO `tipo_turno` (`turn_tipo_cod`, `turn_tipo_nom`) VALUES
(1, 'DIURNO'),
(2, 'NOCTURNO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turno`
--

CREATE TABLE `turno` (
  `Turn_cod` int(11) NOT NULL DEFAULT 0,
  `Turn_hora_entrada` time DEFAULT NULL,
  `Turn_hora_salida` time DEFAULT NULL,
  `Turn_fecha` date DEFAULT NULL,
  `Turn_tipo` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='cod = codigo (date)\r\ntipo = 1 (Diurno), 2 (Nocturno)';

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD PRIMARY KEY (`cod_cuenta`),
  ADD UNIQUE KEY `cod_cuenta` (`cod_cuenta`),
  ADD KEY `FK_cuenta_per` (`Per_cod`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`Pac_rut`),
  ADD UNIQUE KEY `Pac_rut` (`Pac_rut`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`Per_cod`),
  ADD UNIQUE KEY `Per_cod` (`Per_cod`),
  ADD KEY `FK_personal_tipos` (`Per_tipo`);

--
-- Indices de la tabla `tipo_personal`
--
ALTER TABLE `tipo_personal`
  ADD PRIMARY KEY (`tipo_cod`),
  ADD UNIQUE KEY `tipo_cod` (`tipo_cod`);

--
-- Indices de la tabla `tipo_turno`
--
ALTER TABLE `tipo_turno`
  ADD PRIMARY KEY (`turn_tipo_cod`),
  ADD UNIQUE KEY `turn_tipo_cod` (`turn_tipo_cod`);

--
-- Indices de la tabla `turno`
--
ALTER TABLE `turno`
  ADD PRIMARY KEY (`Turn_cod`),
  ADD UNIQUE KEY `Turn_cod` (`Turn_cod`),
  ADD KEY `FK_turno_tipo_turno` (`Turn_tipo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  MODIFY `cod_cuenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD CONSTRAINT `FK_cuenta_per` FOREIGN KEY (`Per_cod`) REFERENCES `personal` (`Per_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `personal`
--
ALTER TABLE `personal`
  ADD CONSTRAINT `FK_personal_tipos` FOREIGN KEY (`Per_tipo`) REFERENCES `tipo_personal` (`tipo_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `turno`
--
ALTER TABLE `turno`
  ADD CONSTRAINT `FK_turno_tipo_turno` FOREIGN KEY (`Turn_tipo`) REFERENCES `tipo_turno` (`turn_tipo_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
