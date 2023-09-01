-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-08-2023 a las 01:35:24
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `counseling`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `advisor`
--

CREATE TABLE `advisor` (
  `adv_email` varchar(50) NOT NULL,
  `adv_password` text NOT NULL,
  `adv_lastname` varchar(20) NOT NULL,
  `adv_name` varchar(20) NOT NULL,
  `adv_major` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `advisor`
--

INSERT INTO `advisor` (`adv_email`, `adv_password`, `adv_lastname`, `adv_name`, `adv_major`) VALUES
('eliana.valenzuela@upr.edu', 'prueba', 'Valenzuela', 'Eliana', 'CC-COMS-BCN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `appointment`
--

CREATE TABLE `appointment` (
  `appt_id` int(11) NOT NULL,
  `adv_email` varchar(50) NOT NULL,
  `stdnt_number` varchar(20) NOT NULL,
  `appt_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cohort`
--

CREATE TABLE `cohort` (
  `crse_code` varchar(50) NOT NULL,
  `cohort_year` varchar(20) NOT NULL,
  `crse_year` int(11) NOT NULL,
  `crse_semester` int(11) NOT NULL,
  `crse_major` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cohort`
--

INSERT INTO `cohort` (`crse_code`, `cohort_year`, `crse_year`, `crse_semester`, `crse_major`) VALUES
('BIOL3011', '2022', 1, 2, 'BI-MICM-BCN'),
('BIOL3013', '2022', 1, 2, 'BI-MICM-BCN'),
('QUIM3131', '2022', 1, 2, 'BI-MICM-BCN'),
('QUIM3133', '2022', 1, 2, 'BI-MICM-BCN'),
('BIOL3012', '2022', 1, 1, 'BI-MICM-BCN'),
('BIOL3014', '2022', 1, 1, 'BI-MICM-BCN'),
('QUIM3132', '2022', 1, 1, 'BI-MICM-BCN'),
('QUIM3134', '2022', 1, 1, 'BI-MICM-BCN'),
('MATE3171', '2022', 1, 2, 'BI-MICM-BCN'),
('ESPA3101', '2022', 1, 2, 'BI-MICM-BCN'),
('INGL3101', '2022', 1, 2, 'BI-MICM-BCN'),
('CCOM3001', '2017', 1, 1, 'CC-COMS-BCN'),
('CCOM3002', '2017', 1, 2, 'CC-COMS-BCN'),
('CCOM3025', '2017', 1, 1, 'CC-COMS-BCN'),
('CCOM3010', '2017', 1, 1, 'CC-COMS-BCN'),
('CCOM3015', '2017', 1, 2, 'CC-COMS-BCN'),
('CCOM3035', '2017', 1, 2, 'CC-COMS-BCN'),
('CCOM4005', '2017', 2, 1, 'CC-COMS-BCN'),
('CCOM4006', '2017', 2, 2, 'CC-COMS-BCN'),
('CCOM4007', '2017', 2, 2, 'CC-COMS-BCN'),
('CCOM3020', '2017', 2, 1, 'CC-COMS-BCN'),
('CCOM4065', '2017', 2, 2, 'CC-COMS-BCN'),
('CCOM3041', '2017', 3, 1, 'CC-COMS-BCN'),
('CCOM4025', '2017', 3, 1, 'CC-COMS-BCN'),
('CCOM4115', '2017', 3, 2, 'CC-COMS-BCN'),
('CCOM4075', '2017', 4, 1, 'CC-COMS-BCN'),
('CCOM4095', '2017', 4, 2, 'CC-COMS-BCN'),
('ESPA3101', '2017', 2, 1, 'CC-COMS-BCN'),
('ESPA3102', '2017', 2, 2, 'CC-COMS-BCN'),
('ESPA3112', '2017', 2, 1, 'CC-COMS-BCN'),
('ESPA3113', '2017', 2, 2, 'CC-COMS-BCN'),
('ESPA3208', '2017', 3, 1, 'CC-COMS-BCN'),
('INGL3101', '2017', 1, 1, 'CC-COMS-BCN'),
('INGL3102', '2017', 1, 2, 'CC-COMS-BCN'),
('INGL3103', '2017', 1, 1, 'CC-COMS-BCN'),
('INGL3104', '2017', 1, 2, 'CC-COMS-BCN'),
('INGL3011', '2017', 1, 1, 'CC-COMS-BCN'),
('INGL3012', '2017', 1, 2, 'CC-COMS-BCN'),
('INGL3015', '2017', 3, 2, 'CC-COMS-BCN'),
('MATE3171', '2017', 1, 3, 'CC-COMS-BCN'),
('MATE3172', '2017', 1, 3, 'CC-COMS-BCN'),
('MATE3031', '2017', 2, 3, 'CC-COMS-BCN'),
('CIBI3001', '2017', 2, 1, 'CC-COMS-BCN'),
('CIBI3002', '2017', 2, 2, 'CC-COMS-BCN'),
('FISI3011', '2017', 3, 1, 'CC-COMS-BCN'),
('FISI3012', '2017', 3, 1, 'CC-COMS-BCN'),
('FISI3013', '2017', 3, 2, 'CC-COMS-BCN'),
('FISI3014', '2017', 3, 2, 'CC-COMS-BCN'),
('CCOM3001', '2022', 1, 1, 'CC-COMS-BCN'),
('CCOM3002', '2022', 1, 2, 'CC-COMS-BCN'),
('CCOM3025', '2022', 1, 1, 'CC-COMS-BCN'),
('CCOM3010', '2022', 1, 1, 'CC-COMS-BCN'),
('CCOM3015', '2022', 1, 2, 'CC-COMS-BCN'),
('CCOM3035', '2022', 1, 2, 'CC-COMS-BCN'),
('CCOM4005', '2022', 2, 1, 'CC-COMS-BCN'),
('CCOM4006', '2022', 2, 2, 'CC-COMS-BCN'),
('CCOM3020', '2022', 2, 1, 'CC-COMS-BCN'),
('CCOM4065', '2022', 2, 2, 'CC-COMS-BCN'),
('CCOM3041', '2022', 3, 1, 'CC-COMS-BCN'),
('CCOM4115', '2022', 3, 2, 'CC-COMS-BCN'),
('CCOM4075', '2022', 4, 1, 'CC-COMS-BCN'),
('CCOM4095', '2022', 4, 2, 'CC-COMS-BCN'),
('CCOM4007', '2022', 2, 2, 'CC-COMS-BCN'),
('CCOM4025', '2022', 3, 1, 'CC-COMS-BCN'),
('ESPA3101', '2022', 2, 1, 'CC-COMS-BCN'),
('ESPA3102', '2022', 2, 2, 'CC-COMS-BCN'),
('ESPA3112', '2022', 2, 1, 'CC-COMS-BCN'),
('ESPA3208', '2022', 3, 1, 'CC-COMS-BCN'),
('INGL3101', '2022', 1, 1, 'CC-COMS-BCN'),
('INGL3102', '2022', 1, 2, 'CC-COMS-BCN'),
('INGL3103', '2022', 1, 1, 'CC-COMS-BCN'),
('INGL3104', '2022', 1, 2, 'CC-COMS-BCN'),
('INGL3011', '2022', 1, 1, 'CC-COMS-BCN'),
('INGL3015', '2022', 3, 2, 'CC-COMS-BCN'),
('MATE3171', '2022', 1, 3, 'CC-COMS-BCN'),
('MATE3172', '2022', 1, 3, 'CC-COMS-BCN'),
('MATE3031', '2022', 2, 3, 'CC-COMS-BCN'),
('CIBI3001', '2022', 2, 1, 'CC-COMS-BCN'),
('CIBI3002', '2022', 2, 2, 'CC-COMS-BCN'),
('FISI3011', '2022', 3, 1, 'CC-COMS-BCN'),
('FISI3012', '2022', 3, 1, 'CC-COMS-BCN'),
('FISI3013', '2022', 3, 2, 'CC-COMS-BCN'),
('FISI3014', '2022', 3, 2, 'CC-COMS-BCN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crsecredits_extra`
--

CREATE TABLE `crsecredits_extra` (
  `crseCredits_huma` int(11) DEFAULT NULL,
  `crseCredits_ciso` int(11) DEFAULT NULL,
  `crseCredits_dept` int(11) DEFAULT NULL,
  `crseCredits_avz` int(11) DEFAULT NULL,
  `crseCredits_int` int(11) DEFAULT NULL,
  `crseCredits_free` int(11) DEFAULT NULL,
  `crse_major` text NOT NULL,
  `cohort_year` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `crsecredits_extra`
--

INSERT INTO `crsecredits_extra` (`crseCredits_huma`, `crseCredits_ciso`, `crseCredits_dept`, `crseCredits_avz`, `crseCredits_int`, `crseCredits_free`, `crse_major`, `cohort_year`) VALUES
(6, 6, 12, 6, 6, 12, 'CC-COMS-BCN', '2017'),
(6, 6, 12, NULL, NULL, 12, 'CC-COMS-BCN', '2022');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departmental_courses`
--

CREATE TABLE `departmental_courses` (
  `crse_code` varchar(50) NOT NULL,
  `crse_description` text NOT NULL,
  `crse_credits` int(11) NOT NULL,
  `crse_major` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `departmental_courses`
--

INSERT INTO `departmental_courses` (`crse_code`, `crse_description`, `crse_credits`, `crse_major`) VALUES
('CCOM3027', 'Programación Orientada a Objetos', 3, 'CC-COMS-BCN'),
('CCOM3036', 'Programación Visual', 3, 'CC-COMS-BCN'),
('CCOM3042', 'Arquitectura de Computadoras', 3, 'CC-COMS-BCN'),
('CCOM3115', 'Aplicaciones de Microprocesadores', 3, 'CC-COMS-BCN'),
('CCOM3985', 'Investigación Sub-graduada', 2, 'CC-COMS-BCN'),
('CCOM4018', 'Redes de Computadoras', 3, 'CC-COMS-BCN'),
('CCOM4019', 'Programación Web', 3, 'CC-COMS-BCN'),
('CCOM4125', 'Inteligencia Artificial', 3, 'CC-COMS-BCN'),
('CCOM4135', 'Diseño Compiladores', 3, 'CC-COMS-BCN'),
('CCOM4305', 'Introducción Diseño Web', 3, 'CC-COMS-BCN'),
('CCOM4306', 'Optimización Gráficas', 3, 'CC-COMS-BCN'),
('CCOM4307', ' Mantenimiento de PC’s', 4, 'CC-COMS-BCN'),
('CCOM4401', 'Desarrollo de Aplicaciones Móviles', 3, 'CC-COMS-BCN'),
('CCOM4420', 'Cloud Computing Apps', 3, 'CC-COMS-BCN'),
('CCOM4501', 'Robótica', 4, 'CC-COMS-BCN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `free_courses`
--

CREATE TABLE `free_courses` (
  `crse_code` varchar(50) NOT NULL,
  `crse_description` text DEFAULT NULL,
  `crse_credits` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `free_courses`
--

INSERT INTO `free_courses` (`crse_code`, `crse_description`, `crse_credits`) VALUES
('ARTE2012', NULL, NULL),
('BIOL3109', NULL, NULL),
('BIOL3110', NULL, NULL),
('CCOM3005', NULL, NULL),
('CCOM3135', NULL, NULL),
('ESPA3007', NULL, NULL),
('ESPA3229', NULL, NULL),
('ESPA3231', NULL, NULL),
('ESTA3412', NULL, NULL),
('FISI3071', NULL, NULL),
('FISI3073', NULL, NULL),
('HIST3142', NULL, NULL),
('HUMA2453', NULL, NULL),
('INGE2341', NULL, NULL),
('INGE4311', NULL, NULL),
('INGL3012', NULL, NULL),
('MATE2912', NULL, NULL),
('MATE3104', NULL, NULL),
('MATE4055', NULL, NULL),
('MATW2031', NULL, NULL),
('MUSI2110', NULL, NULL),
('TEAT2233', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `general_courses`
--

CREATE TABLE `general_courses` (
  `crse_code` varchar(50) NOT NULL,
  `crse_description` text NOT NULL,
  `crse_credits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `general_courses`
--

INSERT INTO `general_courses` (`crse_code`, `crse_description`, `crse_credits`) VALUES
('CIBI3001', 'Instrucción a Ciencias Biológicas I', 3),
('CIBI3002', 'Instrucción a Ciencias Biológicas II', 3),
('CISO3121', 'Introduccion a las Ciencias Sociales I', 3),
('CISO3122', 'Introduccion a las Ciencias Sociales II', 3),
('ESPA', 'Español', 3),
('ESPA3101', 'Español Basico I', 3),
('ESPA3102', 'Español Basico II', 3),
('ESPA3111', 'Lengua y discurso nivel honor I', 3),
('ESPA3112', 'Lengua y discurso nivel honor II', 3),
('ESPA3208', 'Redacción y Estilo', 3),
('FISI3011', 'Fisica Universitaria I', 3),
('FISI3012', 'Fisica Universitaria II', 3),
('FISI3013', 'Lab Fisica Universitaria I', 1),
('FISI3014', 'Lab Fisica Universitaria II', 1),
('INGL', 'Ingles ', 3),
('INGL3011', 'Inglés Honor I', 3),
('INGL3015', 'Inglés de Ciencia y Tecnología', 3),
('INGL3101', 'Ingles Basico I', 3),
('INGL3102', 'Ingles Basico II', 3),
('INGL3103', 'Inglés Intermedio I', 3),
('INGL3104', 'Inglés Intermedio II', 3),
('INGL3113', 'Práct. Oral Inglés Básico I', 0),
('INGL3114', 'Práct. Oral Inglés Básico II', 0),
('MATE0008', 'Desarrollo de Destrezas Básicas', 0),
('MATE3026', 'Introducción a la Estadistica Computadora', 3),
('MATE3031', 'Calculo I', 4),
('MATE3171', 'Pre-Calculo I', 3),
('MATE3172', 'Pre-Calculo II', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `general_education_ciso`
--

CREATE TABLE `general_education_ciso` (
  `crse_code` varchar(50) NOT NULL,
  `crse_description` text NOT NULL,
  `crse_credits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `general_education_ciso`
--

INSERT INTO `general_education_ciso` (`crse_code`, `crse_description`, `crse_credits`) VALUES
('ANTR3006', 'Antropología Sociocultural', 3),
('CIPO3011', ' Principios y Problemas de las Ciencias Políticas', 3),
('CISO 3122', 'Introducción a Ciencias Sociales II', 3),
('CISO3121', 'Introducción a Ciencias Sociales I', 3),
('CISO3155', 'Fundamentos de Razonamiento Estadístico', 3),
('ECON3005', ' Introducción a la Economía', 3),
('ECON3021', 'Principios de Economía I ', 3),
('ECON3022', 'Principios de Economía II', 3),
('GEOG3155', ' Elementos de Geografía', 3),
('PSIC3003', ' Introducción a la Psicología', 3),
('PSIC3005', 'Psicología General', 3),
('PSIC3006', ' Psicología Social', 3),
('PSIC3048', 'Dinámica de Grupo', 3),
('PSIC3116', ' 	Psicología Industrial', 3),
('SOCI1001', ' Fundamentos Sociológicos de la Educación Ambiental', 3),
('SOCI3245', 'Principios de Sociología', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `general_education_huma`
--

CREATE TABLE `general_education_huma` (
  `crse_code` varchar(50) NOT NULL,
  `crse_description` text NOT NULL,
  `crse_credits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `general_education_huma`
--

INSERT INTO `general_education_huma` (`crse_code`, `crse_description`, `crse_credits`) VALUES
('ARTE3115', ' Apreciación del Arte', 2),
('ARTE3116', ' Historia del Arte', 3),
('ARTE3118', 'Arte de Puerto Rico', 3),
('ESIN4001', ' Seminario de Investigación de Estudios Puertorriqueños', 3),
('FILO3001', 'Introducción a la Filosofía I', 3),
('FILO3002', 'Introducción a la Filosofía II', 3),
('FILO3005', ' Ética', 3),
('FILO4006', 'Lógica I', 3),
('FILO4027', ' Bioética', 3),
('HIST3111', 'Historia de Estados Unidos I', 3),
('HIST3112', ' 	Historia de Estados Unidos II', 3),
('HIST3165', 'Historia del Renacimiento', 3),
('HIST3177', ' Historia de Puerto Rico', 3),
('HIST3179', 'Historia de Estados Unidos', 3),
('HIST3241', 'Historia de Puerto Rico I', 3),
('HIST3242', 'Historia de Puerto Rico II', 3),
('HUMA3101', 'Western Civilization I', 3),
('HUMA3102', 'Western Civilization II', 3),
('HUMA3145', ' Seminario de Integración de las Herramientas de la Web 2.0', 3),
('HUMA3201', 'Western Civilization III', 3),
('HUMA3202', 'Western Civilization IV', 3),
('INTD3046', 'Escrituras Femeninas', 3),
('LITE3011', 'Literatura Moderna', 3),
('LITE3012', 'Literatura Contemporánea', 3),
('LITE3035', 'Mitología en la Literatura Occidental', 3),
('LITE3055', 'Literatura Digital', 3),
('MUSI3225', 'Historia de la Música', 3),
('MUSI3235', 'Apreciación de la Música', 2),
('TEAT3025', 'Apreciación del Arte Dramático', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mandatory_courses`
--

CREATE TABLE `mandatory_courses` (
  `crse_code` varchar(50) NOT NULL,
  `crse_description` text NOT NULL,
  `crse_credits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mandatory_courses`
--

INSERT INTO `mandatory_courses` (`crse_code`, `crse_description`, `crse_credits`) VALUES
('BIOL3011', 'Biologia General I', 4),
('BIOL3012', 'Biologia General II', 4),
('BIOL3013', 'Lab Biologia General I', 0),
('BIOL3014', 'Lab Biologia General II', 0),
('BIOL3115', 'Ecologia General', 3),
('BIOL3116', 'Lab Ecologia General', 1),
('BIOL3207', 'Introduccion a la Biotecnologia', 3),
('BIOL3731', 'Microbiologia General', 4),
('BIOL3732', 'Lab Microbiologia General', 1),
('BIOL3733', 'Microbiologia Ambiental', 3),
('BIOL3734', 'Lab Microbiologia Ambiental', 1),
('BIOL3745', 'Micologia Medica', 3),
('BIOL3746', 'Lab Micologia Medica', 1),
('BIOL3747', 'Ecologia Microorganismo', 3),
('BIOL3748', 'Lab Ecologia Microorganismo', 1),
('BIOL3905', 'Genetica de Bacteria', 3),
('BIOL3907', 'Biologia Molecular', 3),
('BIOL3908', 'Lab Biologia Molecular', 0),
('BIOL3909', 'Seminario Integrador', 1),
('BIOL3910', 'Seminario Bioinformatica', 1),
('BIOL3915', 'Micologia Industrial', 3),
('BIOL3916', 'Lab Micologia Industrial', 1),
('BIOL3917', 'Bacteriologia Industrial', 3),
('BIOL3918', 'Lab Bacteriologia Industrial', 1),
('BIOL3919', 'Microbiologia del Agua', 3),
('BIOL3920', 'Lab Microbiologia del Agua', 0),
('BIOL3926', 'Microbiologia de Alimentos', 3),
('BIOL3929', 'Micologia Ambiental', 3),
('BIOL4006', 'Bacteriologia Medica', 3),
('BIOL4020', 'Validacion de Procesos Industriales', 3),
('BIOL4023', 'Fundamentos de Inmunologia', 2),
('BIOL4024', 'Lab Fundamentos de Inmunologia', 1),
('BIOL4426', 'Parasitologia General', 3),
('BIOL4427', 'Lab Parasitologia General', 1),
('BIOL4438', 'Introduccion a la Virologia', 3),
('CCOM3001', 'Programación I', 5),
('CCOM3002', 'Programación II', 5),
('CCOM3010', 'Niveles Lógicos', 3),
('CCOM3015', 'Computadoras en la 	Sociedad', 3),
('CCOM3020', 'Matemáticas discretas', 3),
('CCOM3025', 'Sistemas de 	Computadoras', 3),
('CCOM3035', 'Organización de 	Computadoras', 3),
('CCOM3041', 'Sistemas Operativos', 3),
('CCOM4005', 'Estructura de Datos', 3),
('CCOM4006', 'Diseño y análisis de algoritmo', 3),
('CCOM4007', 'Estadística aplicada a CCOM', 4),
('CCOM4025', 'Lenguajes de Programación', 3),
('CCOM4065', 'Algebra lineal Numérica', 3),
('CCOM4075', 'Ingeniería de software', 3),
('CCOM4095', 'Proyecto Ingeniería de 	programación', 3),
('CCOM4115', 'Bases de Datos', 3),
('CCOM4201', 'Teoría de Grafos', 3),
('QUIM3131', 'Quimica General I', 3),
('QUIM3132', 'Quimica General II', 3),
('QUIM3133', 'Lab Quimica General I', 1),
('QUIM3134', 'Lab Quimica General II', 1),
('QUIM3461', 'Quimica Organica I', 3),
('QUIM3462', 'Lab Quimica Organica I', 1),
('QUIM3463', 'Quimica Organica II', 3),
('QUIM3464', 'Lab Quimica Organica II', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `record_details`
--

CREATE TABLE `record_details` (
  `stdnt_number` varchar(20) NOT NULL,
  `performed_date` date NOT NULL,
  `modify_date` date NOT NULL,
  `adv_comments` text DEFAULT NULL,
  `conducted_counseling` tinyint(1) DEFAULT NULL,
  `record_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `record_details`
--

INSERT INTO `record_details` (`stdnt_number`, `performed_date`, `modify_date`, `adv_comments`, `conducted_counseling`, `record_status`) VALUES
('840-20-0000', '2020-10-05', '2021-02-16', 'Cita', 1, 1),
('840-20-1111', '2020-10-05', '2021-02-16', NULL, 0, 1),
('840-19-2222', '2020-10-05', '2021-02-16', NULL, 0, 1),
('840-19-3333', '2020-10-05', '2021-02-16', NULL, 0, 1),
('840-18-4444', '2020-10-05', '2021-02-16', NULL, 0, 1),
('840-18-5555', '2020-10-05', '2021-02-16', NULL, 0, 1),
('840-17-6666', '2020-10-05', '2021-02-16', NULL, 1, 1),
('840-17-7777', '2020-10-05', '2021-02-16', NULL, 0, 1),
('840-18-9999', '2020-10-05', '2021-02-16', NULL, 0, 1),
('802-18-8888', '2020-10-05', '2021-02-16', NULL, 0, 1),
('840-16-4235', '2020-10-05', '2021-02-16', NULL, 1, 1),
('840-17-7530', '2023-04-02', '2023-04-02', NULL, 0, 1),
('840-18-2405', '2023-04-02', '2023-04-02', NULL, 0, 1),
('840-18-1204', '2023-05-14', '2023-05-14', NULL, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `scheme`
--

CREATE TABLE `scheme` (
  `crse_code` varchar(50) NOT NULL,
  `crse_PRE` varchar(50) DEFAULT NULL,
  `crse_CO` varchar(50) DEFAULT NULL,
  `cohort_year` varchar(20) NOT NULL,
  `crse_major` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `scheme`
--

INSERT INTO `scheme` (`crse_code`, `crse_PRE`, `crse_CO`, `cohort_year`, `crse_major`) VALUES
('CCOM3002', 'CCOM3001', 'MATE3171', '2017', 'CC-COMS-BCN'),
('CCOM3035', 'CCOM3025', NULL, '2017', 'CC-COMS-BCN'),
('MATE3172', 'MATE3172', NULL, '2017', 'CC-COMS-BCN'),
('CCOM4005', 'CCOM3002', NULL, '2017', 'CC-COMS-BCN'),
('CCOM3020', 'MATE3171', NULL, '2017', 'CC-COMS-BCN'),
('CCOM4006', 'CCOM4005', 'CCOM4007', '2017', 'CC-COMS-BCN'),
('CCOM4007', 'MATE3031', NULL, '2017', 'CC-COMS-BCN'),
('CCOM4007', 'CCOM3020', NULL, '2017', 'CC-COMS-BCN'),
('CCOM4065', 'CCOM4005', NULL, '2017', 'CC-COMS-BCN'),
('CCOM4065', 'MATE3031', NULL, '2017', 'CC-COMS-BCN'),
('CCOM3041', 'CCOM3015', NULL, '2017', 'CC-COMS-BCN'),
('CCOM3041', 'CCOM3035', NULL, '2017', 'CC-COMS-BCN'),
('CCOM4025', 'CCOM4005', NULL, '2017', 'CC-COMS-BCN'),
('CCOM4115', 'CCOM4025', NULL, '2017', 'CC-COMS-BCN'),
('CCOM4075', 'CCOM3041', NULL, '2017', 'CC-COMS-BCN'),
('CCOM4075', 'CCOM4115', NULL, '2017', 'CC-COMS-BCN'),
('CCOM4075', 'CCOM4006', NULL, '2017', 'CC-COMS-BCN'),
('CCOM4075', 'CCOM4007', NULL, '2017', 'CC-COMS-BCN'),
('CCOM4095', 'CCOM4075', NULL, '2017', 'CC-COMS-BCN'),
('MATE3172', 'MATE3171', NULL, '2017', 'CC-COMS-BCN'),
('MATE3031', 'MATE3172', NULL, '2017', 'CC-COMS-BCN'),
('INGL3104', 'INGL3103', NULL, '2017', 'CC-COMS-BCN'),
('INGL3102', 'INGL3101', NULL, '2017', 'CC-COMS-BCN'),
('INGL3012', 'INGL3011', NULL, '2017', 'CC-COMS-BCN'),
('FISI3014', 'FISI3013', NULL, '2017', 'CC-COMS-BCN'),
('FISI3012', 'FISI3011', NULL, '2017', 'CC-COMS-BCN'),
('ESPA3112', 'ESPA3111', NULL, '2017', 'CC-COMS-BCN'),
('ESPA3102', 'ESPA3101', NULL, '2017', 'CC-COMS-BCN'),
('CIBI3002', 'CIBI3001', NULL, '2017', 'CC-COMS-BCN'),
('FISI3013', NULL, 'MATE3031', '2017', 'CC-COMS-BCN'),
('FISI3011', NULL, 'MATE3031', '2017', 'CC-COMS-BCN'),
('CCOM3002', 'CCOM3001', 'CCOM3001', '2022', 'CC-COMS-BCN'),
('CCOM3035', 'CCOM3025', 'CCOM3025', '2022', 'CC-COMS-BCN'),
('CCOM4005', 'CCOM3002', 'CCOM3002', '2022', 'CC-COMS-BCN'),
('CCOM4006', 'CCOM4005', 'CCOM4005', '2022', 'CC-COMS-BCN'),
('CCOM4007', 'MATE3031', 'MATE3031', '2022', 'CC-COMS-BCN'),
('CCOM3020', 'MATE3171', 'MATE3171', '2022', 'CC-COMS-BCN'),
('CCOM4065', 'CCOM4005', 'CCOM4005', '2022', 'CC-COMS-BCN'),
('CCOM3041', 'CCOM3015', 'CCOM3015', '2022', 'CC-COMS-BCN'),
('CCOM4025', 'CCOM4005', 'CCOM4005', '2022', 'CC-COMS-BCN'),
('CCOM4115', 'CCOM4025', 'CCOM4025', '2022', 'CC-COMS-BCN'),
('CCOM4075', 'CCOM3041', 'CCOM3041', '2022', 'CC-COMS-BCN'),
('CCOM4095', 'CCOM4075', 'CCOM4075', '2022', 'CC-COMS-BCN'),
('ESPA3102', 'ESPA3101', 'ESPA3101', '2022', 'CC-COMS-BCN'),
('ESPA3112', 'ESPA3111', 'ESPA3111', '2022', 'CC-COMS-BCN'),
('INGL3102', 'INGL3101', 'INGL3101', '2022', 'CC-COMS-BCN'),
('INGL3104', 'INGL3103', 'INGL3103', '2022', 'CC-COMS-BCN'),
('MATE3172', 'MATE3172', 'MATE3172', '2022', 'CC-COMS-BCN'),
('MATE3031', 'MATE3172', 'MATE3172', '2022', 'CC-COMS-BCN'),
('CIBI3002', 'CIBI3001', 'CIBI3001', '2022', 'CC-COMS-BCN'),
('FISI3011', '-', '-', '2022', 'CC-COMS-BCN'),
('FISI3012', 'FISI3011', 'FISI3011', '2022', 'CC-COMS-BCN'),
('FISI3013', '-', '-', '2022', 'CC-COMS-BCN'),
('FISI3014', 'FISI3013', 'FISI3013', '2022', 'CC-COMS-BCN'),
('CCOM3002', 'CCOM3001', 'CCOM3001', '2022', 'CC-COMS-BCN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stdnt_record`
--

CREATE TABLE `stdnt_record` (
  `stdnt_number` varchar(20) NOT NULL,
  `crse_code` varchar(50) NOT NULL,
  `crse_grade` varchar(5) DEFAULT NULL,
  `crse_status` int(11) NOT NULL,
  `semester_pass` varchar(10) DEFAULT NULL,
  `crseR_status` tinyint(1) NOT NULL,
  `crse_equivalence` text DEFAULT NULL,
  `crse_recognition` text DEFAULT NULL,
  `crse_credits_ER` int(11) DEFAULT NULL,
  `date_R` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `stdnt_record`
--

INSERT INTO `stdnt_record` (`stdnt_number`, `crse_code`, `crse_grade`, `crse_status`, `semester_pass`, `crseR_status`, `crse_equivalence`, `crse_recognition`, `crse_credits_ER`, `date_R`) VALUES
('840-16-4235', 'CCOM3001', 'B', 1, 'B71', 0, NULL, NULL, NULL, NULL),
('840-16-4235', 'CCOM3002', 'A', 1, 'B72', 0, NULL, NULL, NULL, '2017-01-08'),
('840-16-4235', 'CCOM3010', 'A', 1, 'B81', 0, NULL, NULL, NULL, '2017-01-08'),
('840-16-4235', 'CCOM3015', 'A', 1, 'B72', 0, NULL, NULL, NULL, '2017-01-08'),
('840-16-4235', 'CCOM3020', 'A', 1, 'B81', 0, NULL, NULL, NULL, '2017-01-08'),
('840-16-4235', 'CCOM3025', 'A', 1, 'B81', 0, NULL, NULL, NULL, '2018-01-02'),
('840-16-4235', 'CCOM3035', 'B', 1, 'B82', 0, NULL, NULL, NULL, '2018-01-02'),
('840-16-4235', 'CCOM3041', 'A', 1, 'B91', 0, NULL, NULL, NULL, '2018-01-02'),
('840-16-4235', 'CCOM4005', 'B', 1, 'B81', 0, NULL, NULL, NULL, '2018-01-02'),
('840-16-4235', 'CCOM4006', 'A', 1, 'B82', 0, NULL, NULL, NULL, '2018-01-08'),
('840-16-4235', 'CCOM4007', 'A', 1, 'B82', 0, NULL, NULL, NULL, '2018-01-08'),
('840-16-4235', 'CCOM4025', 'A', 1, 'B91', 0, NULL, NULL, NULL, '2018-01-08'),
('840-16-4235', 'CCOM4065', 'A', 1, 'B92', 0, NULL, NULL, NULL, '2019-01-02'),
('840-16-4235', 'CCOM4115', 'A', 1, 'B92', 0, NULL, NULL, NULL, '2019-01-02'),
('840-16-4235', 'CCOM4075', 'A', 1, 'C01', 0, NULL, NULL, NULL, '2019-01-02'),
('840-16-4235', 'CCOM4095', NULL, 2, 'C02', 0, NULL, NULL, NULL, '2019-01-08'),
('840-16-4235', 'INGL3101', 'B', 1, 'B61', 0, NULL, NULL, NULL, '2019-01-02'),
('840-16-4235', 'INGL3102', 'A', 1, 'B62', 0, NULL, NULL, NULL, NULL),
('840-16-4235', 'CISO3121', 'A', 1, 'B72', 0, NULL, NULL, NULL, NULL),
('840-16-4235', 'PSIC3116', 'A', 1, 'B91', 0, NULL, NULL, NULL, NULL),
('840-16-4235', 'FILO3001', 'B', 1, 'B81', 0, NULL, NULL, NULL, NULL),
('840-16-4235', 'HUMA3202', 'A', 1, 'B91', 0, NULL, NULL, NULL, NULL),
('840-16-4235', 'ESPA3208', 'A', 1, 'B71', 0, NULL, NULL, NULL, NULL),
('840-16-4235', 'ESPA3101', 'B', 1, 'B61', 0, NULL, NULL, NULL, NULL),
('840-16-4235', 'ESPA3102', 'A', 1, 'B62', 0, NULL, NULL, NULL, NULL),
('840-16-4235', 'CIBI3001', 'C', 1, 'B61', 0, 'BIOL 3011', NULL, 4, NULL),
('840-16-4235', 'CIBI3002', 'A', 1, 'B92', 0, NULL, NULL, NULL, NULL),
('840-16-4235', 'FISI3011', 'B', 1, 'B71', 0, 'FISI 3171', NULL, 4, NULL),
('840-16-4235', 'FISI3013', 'B', 1, 'B71', 0, 'FISI 3173', NULL, 1, NULL),
('840-16-4235', 'FISI3012', 'B', 1, 'B92', 0, NULL, NULL, NULL, NULL),
('840-16-4235', 'FISI3014', 'B', 1, 'B92', 0, NULL, NULL, NULL, NULL),
('840-16-4235', 'INGL3015', 'A', 1, 'B72', 0, NULL, NULL, NULL, NULL),
('840-16-4235', 'MATE3171', 'B', 1, 'B71', 0, NULL, NULL, NULL, NULL),
('840-16-4235', 'MATE3172', 'A', 1, 'B72', 0, NULL, NULL, NULL, NULL),
('840-16-4235', 'MATE3031', 'B', 1, 'B81', 0, NULL, NULL, NULL, NULL),
('840-16-4235', 'CCOM3036', 'A', 1, 'B82', 0, NULL, NULL, NULL, NULL),
('840-16-4235', 'CCOM4306', 'A', 1, 'B82', 0, NULL, NULL, NULL, NULL),
('840-16-4235', 'CCOM4307', 'A', 1, 'B92', 0, NULL, NULL, NULL, NULL),
('840-16-4235', 'CCOM3985', 'A', 1, 'B92', 0, 'MATE 4055', NULL, 2, NULL),
('840-16-4235', 'MATE4055', 'A', 1, 'B82', 0, NULL, NULL, NULL, NULL),
('840-16-4235', 'MATE4055', 'A', 1, 'B91', 0, NULL, NULL, NULL, NULL),
('840-16-4235', 'QUIM3133', 'A', 1, 'B61', 0, NULL, NULL, NULL, NULL),
('840-16-4235', 'INTD4995', 'A', 1, 'C01', 0, NULL, NULL, NULL, NULL),
('840-16-4235', 'INTD4995', NULL, 2, 'C02', 0, NULL, NULL, NULL, NULL),
('840-20-0000', 'CCOM3001', NULL, 4, NULL, 0, NULL, NULL, NULL, NULL),
('840-20-0000', 'CCOM3025', NULL, 4, NULL, 0, NULL, NULL, NULL, NULL),
('840-20-0000', 'MATE3171', NULL, 4, NULL, 0, NULL, NULL, NULL, NULL),
('840-20-0000', 'MUSI3225', NULL, 4, NULL, 0, NULL, NULL, NULL, NULL),
('840-20-0000', 'CCOM4401', NULL, 4, NULL, 0, NULL, NULL, NULL, NULL),
('840-16-4235', 'ECON3005', NULL, 0, NULL, 0, NULL, NULL, NULL, '2023-02-04'),
('840-16-4235', 'INGL3104', NULL, 0, NULL, 0, NULL, NULL, NULL, '2023-05-17'),
('840-17-6666', 'CCOM3001', NULL, 4, NULL, 0, NULL, NULL, NULL, NULL),
('840-17-6666', 'ESPA3208', NULL, 4, NULL, 0, NULL, NULL, NULL, NULL),
('840-17-6666', 'CIBI3002', NULL, 4, NULL, 0, NULL, NULL, NULL, NULL),
('840-17-6666', 'ARTE3115', NULL, 4, NULL, 0, NULL, NULL, NULL, NULL),
('840-17-6666', 'FILO3002', NULL, 4, NULL, 0, NULL, NULL, NULL, NULL),
('840-17-6666', 'ANTR3006', NULL, 4, NULL, 0, NULL, NULL, NULL, NULL),
('840-17-6666', 'GEOG3155', NULL, 4, NULL, 0, NULL, NULL, NULL, NULL),
('840-17-6666', 'PSIC3003', NULL, 4, NULL, 0, NULL, NULL, NULL, NULL),
('840-17-6666', 'CCOM3027', NULL, 4, NULL, 0, NULL, NULL, NULL, NULL),
('840-17-7530', 'CIBI3001', 'B', 1, 'C01', 0, NULL, NULL, NULL, NULL),
('840-17-7530', 'FISI3011', 'P', 1, 'C01', 0, NULL, NULL, NULL, NULL),
('840-17-7530', 'FISI3013', 'P', 1, 'C01', 0, NULL, NULL, NULL, NULL),
('840-17-7530', 'INGL3015', 'A', 1, 'B81', 0, NULL, NULL, NULL, NULL),
('840-17-7530', 'MATE3031', 'D', 1, 'B92', 0, NULL, NULL, NULL, NULL),
('840-17-7530', 'ESPA3101', 'B', 1, 'B91', 0, NULL, NULL, NULL, NULL),
('840-17-7530', 'ESPA3102', 'A', 1, 'B92', 0, NULL, NULL, NULL, NULL),
('840-17-7530', 'INGL3103', 'A', 1, 'B71', 0, NULL, NULL, NULL, NULL),
('840-17-7530', 'MATE3104', 'A', 1, 'B72', 0, NULL, NULL, NULL, NULL),
('840-17-7530', 'MATE3171', 'C', 1, 'B72', 0, NULL, NULL, NULL, NULL),
('840-17-7530', 'MATE3172', 'C', 1, 'B82', 0, NULL, NULL, NULL, NULL),
('840-17-7530', 'CISO3121', 'A', 1, 'B81', 0, NULL, NULL, NULL, NULL),
('840-17-7530', 'CISO3122', 'A', 1, 'B82', 0, NULL, NULL, NULL, NULL),
('840-17-7530', 'CCOM3001', 'F*', 3, 'B71', 0, NULL, NULL, NULL, '2023-04-03'),
('840-17-7530', 'CCOM3002', 'A', 1, 'B72', 0, NULL, NULL, NULL, NULL),
('840-17-7530', 'CCOM3015', 'A', 1, 'B72', 0, NULL, NULL, NULL, NULL),
('840-17-7530', 'CCOM3020', 'B', 1, 'B81', 0, NULL, NULL, NULL, NULL),
('840-17-7530', 'CCOM3025', 'A', 1, 'B71', 0, NULL, NULL, NULL, NULL),
('840-17-7530', 'CCOM3035', 'C', 1, 'B72', 0, NULL, NULL, NULL, NULL),
('840-17-7530', 'CCOM3041', 'B', 1, 'B91', 0, NULL, NULL, NULL, NULL),
('840-17-7530', 'CCOM4005', 'B', 1, 'B81', 0, NULL, NULL, NULL, NULL),
('840-17-7530', 'CCOM4006', 'A', 1, 'B82', 0, NULL, NULL, NULL, NULL),
('840-17-7530', 'CCOM4025', 'C', 1, 'B91', 0, NULL, NULL, NULL, NULL),
('840-17-7530', 'CCOM4115', 'B', 1, 'B92', 0, NULL, NULL, NULL, NULL),
('840-17-7530', 'CCOM3027', 'B', 1, 'B81', 0, NULL, NULL, NULL, NULL),
('840-17-7530', 'CCOM3135', 'A', 1, 'B71', 0, NULL, NULL, NULL, NULL),
('840-17-7530', 'CCOM3985', 'A', 1, 'B82', 0, NULL, NULL, NULL, NULL),
('840-17-7530', 'CCOM4401', 'A', 1, 'B82', 0, NULL, NULL, NULL, NULL),
('840-17-7530', 'CCOM4007', 'NP', 1, 'C01', 0, NULL, NULL, NULL, NULL),
('840-17-7530', 'CCOM4075', 'B', 1, 'C01', 0, NULL, NULL, NULL, NULL),
('840-17-7530', 'CCOM3036', 'W*', 1, 'B82', 0, NULL, NULL, NULL, NULL),
('840-17-7530', 'CCOM3005', 'P', 1, 'B63', 0, NULL, NULL, NULL, NULL),
('840-17-7530', 'MATE0008', 'P', 1, 'B71', 0, NULL, NULL, NULL, NULL),
('840-17-7530', 'CCOM3010', NULL, 3, NULL, 0, NULL, NULL, NULL, '2023-04-03'),
('840-17-7530', 'ESPA3112', NULL, 3, NULL, 0, NULL, NULL, NULL, '2023-04-03'),
('840-17-7530', 'ESPA3208', NULL, 3, NULL, 0, NULL, NULL, NULL, '2023-04-03'),
('840-17-7530', 'INGL3101', NULL, 3, NULL, 0, NULL, NULL, NULL, '2023-04-03'),
('840-17-7530', 'INGL3011', NULL, 3, NULL, 0, NULL, NULL, NULL, '2023-04-03'),
('840-17-7530', 'FISI3012', NULL, 3, NULL, 0, NULL, NULL, NULL, '2023-04-03'),
('840-18-1204', 'CCOM3001', NULL, 0, NULL, 0, NULL, NULL, NULL, '2023-05-17'),
('840-18-1204', 'CCOM3002', NULL, 0, NULL, 0, NULL, NULL, NULL, '2023-05-17'),
('840-20-0000', 'CCOM3002', NULL, 0, NULL, 0, NULL, NULL, NULL, '2023-05-17'),
('840-18-1204', 'CCOM3025', NULL, 0, NULL, 0, NULL, NULL, NULL, '2023-05-17'),
('840-18-1204', 'CCOM3010', NULL, 0, NULL, 0, NULL, NULL, NULL, '2023-05-17'),
('840-18-1204', 'CCOM3015', NULL, 0, NULL, 0, NULL, NULL, NULL, '2023-05-17'),
('840-18-1204', 'CCOM3035', NULL, 0, NULL, 0, NULL, NULL, NULL, '2023-05-17'),
('840-18-1204', 'CCOM4006', NULL, 3, NULL, 0, NULL, NULL, NULL, '2023-05-17'),
('840-16-4235', 'ESPA3112', NULL, 0, NULL, 0, NULL, NULL, NULL, '2023-05-17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `student`
--

CREATE TABLE `student` (
  `stdnt_email` tinytext NOT NULL,
  `stdnt_password` text NOT NULL,
  `stdnt_number` varchar(20) NOT NULL,
  `stdnt_lastname1` varchar(20) NOT NULL,
  `stdnt_lastname2` varchar(20) NOT NULL,
  `stdnt_name` varchar(20) NOT NULL,
  `stdnt_initial` varchar(5) DEFAULT NULL,
  `stdnt_major` text NOT NULL,
  `cohort_year` varchar(20) NOT NULL,
  `stdnt_origin` varchar(100) DEFAULT NULL,
  `stdnt_minor` int(11) DEFAULT NULL,
  `stdnt_dob` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `student`
--

INSERT INTO `student` (`stdnt_email`, `stdnt_password`, `stdnt_number`, `stdnt_lastname1`, `stdnt_lastname2`, `stdnt_name`, `stdnt_initial`, `stdnt_major`, `cohort_year`, `stdnt_origin`, `stdnt_minor`, `stdnt_dob`) VALUES
('coral.montes@upr.edu', '$1$vAKvYmZo$SwxUgY/jSa5yOmOnuvfEF1', '802-18-8888', 'Tier', '', 'Coral', 'Monte', 'CC-COMS-BCN', '2017', 'Traslado', NULL, NULL),
('liz.matos2@upr.edu', '$1$3WuibwT9$1FS/VxzZFJYrzfxJL8/RP.', '840-16-4235', 'Rivera', '', 'Liz', 'Matos', 'CC-COMS-BCN', '2017', 'Readmision', 1, NULL),
('roman.diaz@upr.edu', '$1$UJOqSMnn$nxJhb.6SvEGPGLMT8uqyY/', '840-17-6666', 'Santiago', '', 'Roman', 'Diaz', 'CC-COMS-BCN', '2017', 'Regular', NULL, NULL),
('alan.rivera5@upr.edu', '$1$Cznrtdc7$Q3KUiaA0omlXwdjYsIfVv0', '840-17-7530', 'Rivera', 'Muñiz', 'Alan', 'L', 'CC-COMS-BCN', '2017', 'Regular', NULL, NULL),
('hila.rodriguez@upr.edu', '$1$RCtBPU4W$Tz8whIVSoBbG6J6SetTch1', '840-17-7777', 'Sal', '', 'Hila', 'Rodri', 'CC-COMS-BCN', '2017', 'Regular', NULL, NULL),
('jean.gonzalez@upr.edu', '', '840-18-1204', 'Rodriguez', 'Gonzalez', 'Jean', 'P', 'CC-COMS-BCN', '2022', 'Regular', NULL, '2000-01-31'),
('kasiy.fonseca@upr.edu', '$1$2lP0gZfM$/uBwSegLyVGXSzpNRQcpt.', '840-18-2405', 'Fonseca', 'Cedeño', 'Kaisy', 'A', 'CC-COMS-BCN', '2017', 'Regular', NULL, NULL),
('wanda.miranda@upr.edu', '$1$p0DYbYmH$egYJhmG5O4ITHc0frlxQ./', '840-18-4444', 'Violeta', '', 'Wanda', 'Miran', 'CC-COMS-BCN', '2017', 'Readmision', NULL, NULL),
('kydanie.vazquez@upr.edu', 'Hola', '840-18-4851', 'Vazquez', 'Maldonado', 'Kydanie', 'Manue', 'CC-COMS-BCN', '2022', 'Regular', 1, '2000-02-11'),
('wanda.miranda@upr.edu', '$1$kiO4XSfF$KSY7k7oXOxOCU6digy5JW0', '840-18-5555', 'Violeta', '', 'Wanda', 'Miran', 'CC-COMS-BCN', '2017', 'Transferencia', NULL, NULL),
('moana.tonui@upr.edu', '$1$go653SXX$i8DM/NhFsFtl4j4c9fg.J.', '840-18-9999', 'Tfti', '', 'Moana', 'Tonui', 'CC-COMS-BCN', '2017', 'Regular', NULL, NULL),
('marcos.gris@upr.edu', '$1$xpMKihcu$tG6MbJakeBDZEHGKWf92J0', '840-19-2222', 'Smith', '', 'Marcos', 'Gris', 'CC-COMS-BCN', '2017', 'Regular', NULL, NULL),
('flor.scott@upr.edu', '$1$m1rVJ18g$Gi6DBQjf5gW/AHKlHfDRU0', '840-19-3333', 'Gonzalez', '', 'Flor', 'Scott', 'CC-COMS-BCN', '2017', 'Regular', NULL, NULL),
('juan.santiago33@upr.edu', '$1$m/cFrLSL$iBqpwaWWyU8fkKPAKsL/b.', '840-20-0000', 'Colon', '', 'Juan', 'Santi', 'CC-COMS-BCN', '2017', 'Regular', NULL, NULL),
('maria.lopez93@upr.edu', '$1$eRaAbQ04$tpEvUX1ZKKXROo2Mw06UN/', '840-20-1111', 'Jimez', '', 'Maria', 'Lopez', 'CC-COMS-BCN', '2017', 'Regular', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `advisor`
--
ALTER TABLE `advisor`
  ADD PRIMARY KEY (`adv_email`);

--
-- Indices de la tabla `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appt_id`),
  ADD KEY `adv_email` (`adv_email`),
  ADD KEY `stdnt_number` (`stdnt_number`);

--
-- Indices de la tabla `departmental_courses`
--
ALTER TABLE `departmental_courses`
  ADD PRIMARY KEY (`crse_code`);

--
-- Indices de la tabla `free_courses`
--
ALTER TABLE `free_courses`
  ADD PRIMARY KEY (`crse_code`);

--
-- Indices de la tabla `general_courses`
--
ALTER TABLE `general_courses`
  ADD PRIMARY KEY (`crse_code`);

--
-- Indices de la tabla `general_education_ciso`
--
ALTER TABLE `general_education_ciso`
  ADD PRIMARY KEY (`crse_code`);

--
-- Indices de la tabla `general_education_huma`
--
ALTER TABLE `general_education_huma`
  ADD PRIMARY KEY (`crse_code`);

--
-- Indices de la tabla `mandatory_courses`
--
ALTER TABLE `mandatory_courses`
  ADD PRIMARY KEY (`crse_code`);

--
-- Indices de la tabla `record_details`
--
ALTER TABLE `record_details`
  ADD KEY `stdnt_number` (`stdnt_number`);

--
-- Indices de la tabla `stdnt_record`
--
ALTER TABLE `stdnt_record`
  ADD KEY `stdnt_number` (`stdnt_number`);

--
-- Indices de la tabla `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`stdnt_number`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`adv_email`) REFERENCES `advisor` (`adv_email`),
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`stdnt_number`) REFERENCES `student` (`stdnt_number`);

--
-- Filtros para la tabla `record_details`
--
ALTER TABLE `record_details`
  ADD CONSTRAINT `record_details_ibfk_1` FOREIGN KEY (`stdnt_number`) REFERENCES `student` (`stdnt_number`);

--
-- Filtros para la tabla `stdnt_record`
--
ALTER TABLE `stdnt_record`
  ADD CONSTRAINT `stdnt_record_ibfk_1` FOREIGN KEY (`stdnt_number`) REFERENCES `student` (`stdnt_number`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
