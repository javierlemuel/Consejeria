-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2024 at 07:21 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `counseling_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `advisor`
--

CREATE TABLE `advisor` (
  `email` varchar(40) NOT NULL,
  `pass` varchar(60) NOT NULL,
  `name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `privileges` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `advisor`
--

INSERT INTO `advisor` (`email`, `pass`, `name`, `last_name`, `privileges`) VALUES
('eliana.valenzuela@upr.edu', '$2y$10$7Jn997dBkgv/j8yCZ.u3/OO0RANOu1TOxFZ.nvLzVMoFA.Ok/V6Nq', 'Eliana', 'Valenzuela', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ccom_courses`
--

CREATE TABLE `ccom_courses` (
  `crse_code` varchar(8) NOT NULL,
  `name` varchar(40) NOT NULL,
  `credits` tinyint(1) NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT '0',
  `level` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ccom_courses`
--

INSERT INTO `ccom_courses` (`crse_code`, `name`, `credits`, `type`, `level`) VALUES
('CCOM3001', 'PROGRAMACIÓN DE COMPUTADORAS I', 5, 'mandatory', 'NULL'),
('CCOM3002', 'PROGRAMACIÓN DE COMPUTADORAS II', 5, 'mandatory', NULL),
('CCOM3010', 'NIVELES LÓGICOS', 3, 'mandatory', NULL),
('CCOM3017', 'SEGURIDAD DE LAS COMPUTADORAS Y DE LA IN', 3, 'mandatory', NULL),
('CCOM3020', 'MATEMÁTICAS DISCRETAS', 3, 'mandatory', NULL),
('CCOM3025', 'INTRODUCCIÓN SISTEMAS DE COMPUTADORAS', 3, 'mandatory', NULL),
('CCOM3027', 'PROGRAMACIÓN EN LENGUAJE ORIENTADO A OBJ', 3, 'elective', 'intermediate'),
('CCOM3035', 'ORGANIZACIÓN DE COMPUTADORAS', 3, 'mandatory', NULL),
('CCOM3036', 'PROGRAMACIÓN VISUAL', 3, 'elective', 'intermediate'),
('CCOM3041', 'SISTEMAS OPERATIVOS', 3, 'mandatory', NULL),
('CCOM3042', 'ARQUITECTURA DE COMPUTADORAS', 3, 'elective', 'advanced'),
('CCOM3115', 'APLICACIONES BÁSICAS MICROPROCESADORES', 3, 'elective', 'advanced'),
('CCOM3135', 'TEMAS EN CIENCIA DE CÓMPUTOS', 3, 'elective', 'advanced'),
('CCOM3985', 'INVESTIGACIÓN SUBGRADUADA EN TÓPICOS DE ', 2, 'elective', 'variable'),
('CCOM4005', 'ESTRUCTURAS DE DATOS', 3, 'mandatory', NULL),
('CCOM4006', 'DISEÑO Y ANÁLISIS ALGORITMOS', 3, 'mandatory', NULL),
('CCOM4007', 'ESTADÍSTICA CON APLICACIONES A LA CIENCI', 4, 'mandatory', NULL),
('CCOM4018', 'REDES DE COMPUTADORAS', 3, 'elective', 'advanced'),
('CCOM4019', 'PROGRAMACIÓN WEB CON PHP/MYSQL', 3, '1', NULL),
('CCOM4025', 'ORGANIZACIÓN DE LENGUAJES DE PROGRAMACIÓ', 3, 'mandatory', NULL),
('CCOM4065', 'ÁLGEBRA LINEAL', 3, 'mandatory', NULL),
('CCOM4075', 'INGENIERÍA DE PROGRAMACIÓN', 3, 'mandatory', NULL),
('CCOM4095', 'PROYECTO DE INGENIERÍA DE PROGRAMACIÓN', 3, 'mandatory', NULL),
('CCOM4115', 'DISEÑO DE BASE DE DATOS', 3, 'mandatory', NULL),
('CCOM4125', 'INTELIGENCIA ARTIFICIAL', 3, 'elective', 'advanced'),
('CCOM4135', 'INTRODUCCIÓN AL DISEÑO DE COMPILADORES', 3, 'elective', 'advanced'),
('CCOM4201', 'TEORÍA DE GRAFOS', 3, 'mandatory', NULL),
('CCOM4305', 'INTRODUCCIÓN AL DISEÑO DE PÁGINAS PARA W', 3, '1', NULL),
('CCOM4306', 'CREACIÓN, MANEJO Y OPTIMIZACIÓN DE GRÁFI', 3, '1', NULL),
('CCOM4307', 'MANTENIMIENTO DE COMPUTADORAS', 4, 'elective', 'advanced'),
('CCOM4401', 'DESARROLLO DE APLICACIONES MÓVILES', 3, 'elective', 'advanced'),
('CCOM4420', 'APLICACIONES DE COMPUTACIÓN EN LA NUBE', 3, 'elective', 'advanced'),
('CCOM4440', 'PYTHON (INTRODUCCIÓN A VIDEOJUEGOS)', 3, 'elective', 'intermediate'),
('CCOM4501', 'INTRODUCCIÓN A LA ROBÓTICA', 4, 'elective', 'intermediate'),
('CCOM4991', 'ESTUDIO INDEPENDIENTE I', 3, 'elective', 'advanced'),
('CCOM4992', 'ESTUDIO INDEPENDIENTE II', 3, 'elective', 'advanced');

-- --------------------------------------------------------

--
-- Table structure for table `ccom_requirements`
--

CREATE TABLE `ccom_requirements` (
  `crse_code` varchar(8) NOT NULL,
  `cohort_year` varchar(4) NOT NULL,
  `type` varchar(3) NOT NULL,
  `req_crse_code` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ccom_requirements`
--

INSERT INTO `ccom_requirements` (`crse_code`, `cohort_year`, `type`, `req_crse_code`) VALUES
('CCOM3002', '2017', 'pre', 'CCOM3001'),
('CCOM3035', '2017', 'pre', 'CCOM3025'),
('CCOM3041', '2017', 'pre', 'CCOM3035'),
('CCOM3041', '2017', 'pre', 'CCOM4005'),
('CCOM4005', '2017', 'pre', 'CCOM3002'),
('CCOM4005', '2017', 'pre', 'MATE3171'),
('CCOM4005', '2017', 'co', 'CCOM3020'),
('CCOM3020', '2017', 'pre', 'MATE3171'),
('MATE3172', '2017', 'pre', 'MATE3171'),
('CCOM4006', '2017', 'pre', 'CCOM4005'),
('CCOM4006', '2017', 'pre', 'CCOM3020'),
('MATE3031', '2017', 'pre', 'MATE3172'),
('CCOM4025', '2017', 'pre', 'CCOM4005'),
('CCOM4115', '2017', 'pre', 'CCOM4025'),
('CCOM4007', '2017', 'pre', 'CCOM3020'),
('CCOM4007', '2017', 'pre', 'MATE3172'),
('CCOM4065', '2017', 'pre', 'CCOM3002'),
('CCOM4065', '2017', 'pre', 'MATE3031'),
('CCOM4075', '2017', 'pre', 'CCOM3041'),
('CCOM4075', '2017', 'pre', 'CCOM4115'),
('CCOM4075', '2017', 'pre', 'CCOM4006'),
('CCOM4075', '2017', 'pre', 'CCOM4007'),
('CCOM4095', '2017', 'pre', 'CCOM4075');

-- --------------------------------------------------------

--
-- Table structure for table `cohort`
--

CREATE TABLE `cohort` (
  `cohort_year` varchar(4) NOT NULL,
  `crse_code` varchar(8) NOT NULL,
  `crse_year` tinyint(1) NOT NULL,
  `crse_semester` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cohort`
--

INSERT INTO `cohort` (`cohort_year`, `crse_code`, `crse_year`, `crse_semester`) VALUES
('2017', 'CCOM3010', 1, 1),
('2017', 'CCOM3025', 1, 1),
('2017', 'MATE3171', 1, 1),
('2017', 'CCOM3002', 1, 2),
('2017', 'CCOM3015', 1, 2),
('2017', 'CCOM3035', 1, 2),
('2017', 'MATE3172', 1, 2),
('2017', 'CCOM4005', 2, 1),
('2017', 'MATE3031', 2, 1),
('2017', 'CCOM3020', 2, 1),
('2017', 'CIBI3001', 2, 1),
('2017', 'CCOM4006', 2, 2),
('2017', 'CCOM4007', 2, 2),
('2017', 'CCOM4065', 2, 2),
('2017', 'CIBI3002', 2, 2),
('2017', 'FISI3013', 3, 1),
('2017', 'CCOM3041', 3, 1),
('2017', 'CCOM4025', 3, 1),
('2017', 'FISI3012', 3, 2),
('2017', 'FISI3014', 3, 2),
('2017', 'CCOM4115', 3, 2),
('2017', 'CCOM4075', 4, 1),
('2017', 'CCOM4095', 4, 2),
('2017', 'CCOM3001', 1, 1),
('2017', 'INGL3101', 1, 1),
('2017', 'INGL3113', 1, 1),
('2017', 'INGL3102', 1, 2),
('2017', 'INGL3114', 1, 2),
('2017', 'ESPA3101', 2, 1),
('2017', 'ESPA3102', 2, 2),
('2017', 'FISI3011', 3, 1),
('2017', 'ESPA3208', 3, 1),
('2017', 'INGL3015', 3, 2),
('2017', 'FREEXXXX', 3, 2),
('2017', 'HUMAXXXX', 4, 1),
('2017', 'HUMAXXXX', 4, 2),
('2017', 'CISOXXXX', 4, 1),
('2017', 'CISOXXXX', 4, 2),
('2017', 'CCOMXXXX', 3, 2),
('2017', 'CCOMXXXX', 4, 1),
('2017', 'CCOMXXXX', 4, 1),
('2017', 'FREEXXXX', 4, 2),
('2017', 'FREEXXXX', 4, 2),
('2022', 'CCOM3017', 2, 1),
('2022', 'CCOM3025', 1, 1),
('2022', 'MATE3171', 1, 1),
('2022', 'CCOM3035', 1, 2),
('2022', 'MATE3172', 1, 2),
('2022', 'CCOM4005', 2, 1),
('2022', 'MATE3031', 2, 1),
('2022', 'CIBI3001', 2, 1),
('2022', 'CCOM4006', 2, 2),
('2022', 'CCOM4007', 2, 2),
('2022', 'CCOM4065', 2, 2),
('2022', 'CIBI3002', 2, 2),
('2022', 'FISI3013', 3, 1),
('2022', 'CCOM3041', 3, 1),
('2022', 'CCOM4025', 3, 1),
('2022', 'FISI3012', 3, 2),
('2022', 'FISI3014', 3, 2),
('2022', 'CCOM4115', 3, 2),
('2022', 'CCOM4075', 4, 1),
('2022', 'CCOM4095', 4, 2),
('2022', 'CCOM3001', 1, 1),
('2022', 'CCOM3002', 1, 2),
('2022', 'INGL3101', 1, 1),
('2022', 'INGL3113', 1, 1),
('2022', 'INGL3102', 1, 2),
('2022', 'INGL3114', 1, 2),
('2022', 'ESPA3101', 1, 1),
('2022', 'ESPA3102', 1, 2),
('2022', 'FISI3011', 3, 1),
('2022', 'ESPA3208', 3, 1),
('2022', 'INGL3015', 2, 2),
('2022', 'FREEXXXX', 3, 2),
('2022', 'HUMAXXXX', 4, 1),
('2022', 'HUMAXXXX', 4, 2),
('2022', 'CISOXXXX', 4, 1),
('2022', 'CISOXXXX', 4, 2),
('2022', 'CCOMXXXX', 3, 2),
('2022', 'CCOMXXXX', 4, 1),
('2022', 'FREEXXXX', 4, 2),
('2022', 'FREEXXXX', 4, 2),
('2022', 'CCOM3020', 2, 1),
('2022', 'CCOM4201', 3, 2),
('2022', 'FREEXXXX', 4, 1),
('2022', 'FREEXXXX', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cohort_requirements`
--

CREATE TABLE `cohort_requirements` (
  `cohort_year` varchar(4) NOT NULL,
  `credits_huma` tinyint(2) NOT NULL,
  `credits_ciso` tinyint(2) NOT NULL,
  `credits_dept` tinyint(2) NOT NULL,
  `credits_int` tinyint(2) NOT NULL,
  `credits_free` tinyint(2) NOT NULL,
  `credits_avz` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cohort_requirements`
--

INSERT INTO `cohort_requirements` (`cohort_year`, `credits_huma`, `credits_ciso`, `credits_dept`, `credits_int`, `credits_free`, `credits_avz`) VALUES
('2017', 21, 21, 7, 3, 14, 4);

-- --------------------------------------------------------

--
-- Table structure for table `dummy_courses`
--

CREATE TABLE `dummy_courses` (
  `crse_code` varchar(8) NOT NULL,
  `name` varchar(50) NOT NULL,
  `credits` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dummy_courses`
--

INSERT INTO `dummy_courses` (`crse_code`, `name`, `credits`) VALUES
('HUMAXXXX', 'Electiva General de HUMA', 3),
('CISOXXXX', 'Electiva General de CISO', 3),
('CCOMINTX', 'Electiva Intermedia de CCOM', 3),
('CCOMAVZX', 'Electiva Avanzada de CCOM', 3),
('FREEXXXX', 'Electiva Libre', 3),
('CCOMXXXX', 'Electiva Departamental', 3);

-- --------------------------------------------------------

--
-- Table structure for table `general_courses`
--

CREATE TABLE `general_courses` (
  `crse_code` varchar(8) NOT NULL,
  `name` varchar(40) NOT NULL,
  `credits` tinyint(1) NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT 0,
  `type` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `general_courses`
--

INSERT INTO `general_courses` (`crse_code`, `name`, `credits`, `required`, `type`) VALUES
('ESPA3101', 'ESPAÑOL BÁSICO I', 3, 1, 'ESPA'),
('ESPA3102', 'ESPAÑOL BÁSICO II', 3, 1, 'ESPA'),
('ESPA3208', 'REDACCIÓN Y ESTILO', 3, 1, 'ESPA'),
('ESPA3003', 'Fundamentos de lengua y discurso I', 3, 0, 'ESPA'),
('ESPA3004', 'Fundamentos de lengua y discurso II', 3, 0, 'ESPA'),
('INGL3101', 'Basic English I', 3, 1, 'INGL'),
('INGL3102', 'Basic English II', 3, 1, 'INGL'),
('INGL3103', 'Intermediate English I', 3, 0, 'INGL'),
('INGL3104', 'Intermediate English II', 3, 0, 'INGL'),
('INGL3011', 'Honor\'s English I', 3, 0, 'INGL'),
('INGL3012', 'Honor\'s English II', 3, 0, 'INGL'),
('INGL3015', 'English for Science and Tecnology I', 3, 1, 'INGL'),
('MATE3171', 'Pre-Cálculo I', 3, 1, 'MATE'),
('MATE3172', 'Pre-Cálculo II', 3, 1, 'MATE'),
('MATE3031', 'Cálculo I', 4, 1, 'MATE'),
('CIBI3001', 'Int. Cs. Biológicas I', 3, 1, 'CIBI'),
('CIBI3002', 'Int. Cs. Biológicas II', 3, 1, 'CIBI'),
('FISI3011', 'Física Universitaria I', 3, 1, 'FISI'),
('FISI3013', 'Laboratorio Física Univ. I', 1, 1, 'FISI'),
('FISI3012', 'Física Universitaria II', 3, 1, 'FISI'),
('FISI3014', 'Laboratorio Física Univ. II', 1, 1, 'FISI'),
('CISO3121', 'Introducción a las Ciencias Sociales I', 3, 1, 'CISO'),
('CISO3122', 'Introducción a las Ciencias Sociales II', 3, 1, 'CISO'),
('INGL3113', 'Práct. Oral Inglés Básico I', 0, 1, 'INGL'),
('INGL3114', 'Práct. Oral Inglés Básico Ii', 0, 1, 'INGL'),
('HUMA3101', 'Cultura Occidental I', 3, 0, 'HUMA'),
('CISO3121', 'Introducción Ciencias Sociales', 3, 0, 'CISO'),
('GEOG3155', 'Elementos de Geografía', 3, 0, 'CISO'),
('ASTR3009', 'Astronomía General', 3, 0, 'FREE'),
('HUMA3102', 'Cultura Occidental II', 3, 0, 'HUMA');

-- --------------------------------------------------------

--
-- Table structure for table `general_requirements`
--

CREATE TABLE `general_requirements` (
  `crse_code` varchar(8) NOT NULL,
  `cohort_year` varchar(4) NOT NULL,
  `type` varchar(3) NOT NULL,
  `req_crse_code` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `general_requirements`
--

INSERT INTO `general_requirements` (`crse_code`, `cohort_year`, `type`, `req_crse_code`) VALUES
('INGL3102', '2017', 'pre', 'INGL3101'),
('INGL3101', '2017', 'co', 'INGL3113'),
('MATE3172', '2017', 'pre', 'MATE3171'),
('INGL3102', '2017', 'co', 'INGL3114'),
('MATE3031', '2017', 'pre', 'MATE3172'),
('ESPA3102', '2017', 'pre', 'ESPA3101'),
('CIBI3002', '2017', 'pre', 'CIBI3001'),
('FISI3011', '2017', 'co', 'FISI3013'),
('FISI3012', '2017', 'co', 'FISI3014'),
('ESPA3208', '2017', 'pre', 'ESPA3102'),
('INGL3015', '2017', 'pre', 'INGL3102'),
('FISI3012', '2017', 'pre', 'FISI3011');

-- --------------------------------------------------------

--
-- Table structure for table `minor`
--

CREATE TABLE `minor` (
  `ID` smallint(3) NOT NULL,
  `name` varchar(50) NOT NULL,
  `required_credits` smallint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `minor`
--

INSERT INTO `minor` (`ID`, `name`, `required_credits`) VALUES
(1, 'Web Design', 9);

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE `offer` (
  `crse_code` varchar(8) NOT NULL,
  `term` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`crse_code`, `term`) VALUES
('FISI3014', 'BB0'),
('FISI3012', 'BB0'),
('CCOM4095', 'BB0'),
('INGL3102', 'BB0'),
('INGL3114', 'BB0'),
('MATE3172', 'BB0'),
('CCOM3036', 'BB0'),
('ESPA3111', 'BB0'),
('ESPA3102', 'BB0');

-- --------------------------------------------------------

--
-- Table structure for table `recommended_courses`
--

CREATE TABLE `recommended_courses` (
  `student_num` int(9) NOT NULL,
  `crse_code` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recommended_courses`
--

INSERT INTO `recommended_courses` (`student_num`, `crse_code`) VALUES
(840182717, 'CCOM3001'),
(840182717, 'CCOM3002'),
(840192717, 'CCOM3010'),
(840192717, 'CCOM3035'),
(840201010, 'CCOM3010'),
(840990101, 'INGL3101'),
(840990101, 'ESPAXXXX'),
(840781818, 'TEQU1234'),
(840121234, 'ESPA1234'),
(840182717, 'HUMAXXXX'),
(840194867, 'CCOM4095'),
(840194867, 'FISI3012'),
(840194867, 'FISI3014');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_num` int(9) NOT NULL,
  `email` varchar(40) NOT NULL,
  `name1` varchar(15) NOT NULL,
  `name2` varchar(15) DEFAULT NULL,
  `last_name1` varchar(20) NOT NULL,
  `last_name2` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `conducted_counseling` tinyint(1) NOT NULL DEFAULT 0,
  `minor` tinyint(3) NOT NULL DEFAULT 0,
  `cohort_year` varchar(4) NOT NULL,
  `status` varchar(8) NOT NULL DEFAULT 'Activo',
  `edited_flag` tinyint(1) NOT NULL DEFAULT 1,
  `grad_term` varchar(3) DEFAULT NULL,
  `student_note` varchar(150) DEFAULT NULL,
  `admin_note` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_num`, `email`, `name1`, `name2`, `last_name1`, `last_name2`, `dob`, `conducted_counseling`, `minor`, `cohort_year`, `status`, `edited_flag`, `grad_term`, `student_note`, `admin_note`) VALUES
(440209162, 'sebastian.valentin4@upr.edu', 'Sebastian', '', 'Valentin', 'Vega', '2000-01-18', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(440211066, 'dereck.declet@upr.edu', 'Dereck', 'G', 'Declet', 'Aquino', '2001-08-06', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(440239593, 'alexander.martinez14@upr.edu', 'Alexander', 'J', 'Martinez', 'Montijo', '2004-12-27', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(801207906, 'yairaliz.cepeda@upr.edu', 'Yairaliz', '', 'Cepeda', 'Martinez', '2002-09-23', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(801219365, 'dereck.curbelo@upr.edu', 'Dereck', '', 'Curbelo', 'Rojas', '2003-07-15', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(802142384, 'eddy.figueroa1@upr.edu', 'Eddy', 'J.', 'Figueroa', 'Picon', '1996-01-10', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(802175140, 'elvin.rivera8@upr.edu', 'Elvin', 'J.', 'Rivera', 'Rivera', '1999-09-27', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(802180273, 'juan.melendez28@upr.edu', 'Juan', 'A.', 'Melendez', 'Camacho', '2000-11-17', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(802184212, 'giovanni.nieves3@upr.edu', 'Giovanni', 'A.', 'Nieves', 'Rivera', '2000-04-17', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(802190825, 'oscar.fournier@upr.edu', 'Oscar', 'A.', 'Fournier', 'Rodriguez', '2001-02-01', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(802193390, 'ernesto.montes@upr.edu', 'Ernesto', 'J.', 'Montes', 'Malave', '2001-06-15', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(802202308, 'efran.vera@upr.edu', 'Efran', 'X.', 'Vera', 'Sonera', '2002-08-31', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(802209022, 'brian.negron2@upr.edu', 'Brian', 'A.', 'Negron', 'Ramirez', '2002-12-16', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(804205386, 'diego.garcia10@upr.edu', 'Diego', '', 'Garcia', 'Berrios', '2001-12-28', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840122568, 'luis.galarza4@upr.edu', 'Luis', 'L', 'Galarza', 'Figueroa', '1994-10-24', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840128114, 'carlos.santaella@upr.edu', 'Carlos', 'E.', 'Santaella', 'Cordero', '1994-03-09', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840141632, 'benjie.cruz@upr.edu', 'Benjie', 'X', 'Cruz', 'Cruz', '1996-04-07', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840156684, 'anthony.reyes4@upr.edu', 'Anthony', 'J', 'Reyes', 'Hernandez', '1997-11-27', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840166237, 'andre.rivera3@upr.edu', 'Andre', 'G', 'Rivera', 'Arroyo', '1998-04-26', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840168888, 'pedro.vazquez13@upr.edu', 'Pedro', 'M', 'Vazquez', 'Gonzalez', '1999-10-05', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840170954, 'joseph.solivan@upr.edu', 'Joseph', 'L', 'Solivan', 'Burgos', '1999-02-04', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840171562, 'steven.rodriguez18@upr.edu', 'Steven', '', 'Rodriguez', 'De Jesus', '1999-06-28', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840175562, 'gabriel.velazquez4@upr.edu', 'Gabriel', 'A', 'Velazquez', 'Flanegien', '1999-06-19', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840178590, 'cesar.roman3@upr.edu', 'Cesar', 'Javier', 'Roman', 'Toledo', '1999-09-13', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840181542, 'yadiel.cruzado@upr.edu', 'Yadiel', '', 'Cruzado', 'Rodriguez', '2000-03-28', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840181702, 'joseph.figueroa4@upr.edu', 'Joseph', 'A', 'Figueroa', 'Romero', '2000-02-01', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840181953, 'ambar.pallette@upr.edu', 'Ambar', 'N', 'Pallette', 'Hernandez', '2000-11-27', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840182717, 'javier.quinones3@upr.edu', 'Javier', 'L', 'Quinones', 'Galan', '2000-01-05', 127, 0, '2017', 'Activo', 127, '', '', ''),
(840183098, 'gustavo.rassi@upr.edu', 'Gustavo', 'A.', 'Rassi', 'Fuentes', '2000-03-31', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840183196, 'christopher.gonzalez22@upr.edu', 'Christopher', 'W', 'Gonzalez', 'Velez', '2000-02-09', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840188246, 'willys.vargas@upr.edu', 'Willys', 'R', 'Vargas', 'Feliciano', '2000-09-18', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840189901, 'john.astor@upr.edu', 'John', 'M', 'Astor', 'Torres', '2000-11-06', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840189941, 'cesar.rivera18@upr.edu', 'Cesar', 'A', 'Rivera', 'Rosado', '2000-05-17', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840192186, 'luis.ortega6@upr.edu', 'Luis', 'G', 'Ortega', 'San Miguel', '2001-02-17', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840193945, 'taylor.rosa@upr.edu', 'Taylor', '', 'Rosa', 'Segarra', '2000-12-27', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840194022, 'jean.serrano7@upr.edu', 'Jean', 'C', 'Serrano', 'Cruz', '2001-06-29', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840194298, 'michael.sanchez7@upr.edu', 'Michael', 'G', 'Sanchez', 'Reyes', '2001-07-06', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840194867, 'natasha.ramos5@upr.edu', 'Natasha', 'P', 'Ramos', 'Rivera', '2001-05-19', 0, 0, '2017', 'Activo', 0, NULL, NULL, NULL),
(840196624, 'gabriel.sanchez17@upr.edu', 'Gabriel', '', 'Sanchez', 'Maldonado', '2001-11-15', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840197384, 'alexis.ruiz8@upr.edu', 'Alexis', 'J', 'Ruiz', 'Velez', '2001-03-08', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840197915, 'ian.miranda2@upr.edu', 'Ian', 'I', 'Miranda', 'Medina', '2001-09-03', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840198401, 'victor.torres32@upr.edu', 'Victor', 'M', 'Torres', 'Santiago', '2001-02-14', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840198616, 'mariliana.barrientos@upr.edu', 'Mariliana', 'T', 'Barrientos', 'Martinez', '2001-11-07', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840199514, 'javier.rosendo@upr.edu', 'Javier', 'A', 'Rosendo', 'Ocasio', '2001-02-08', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840199656, 'jared.pupo@upr.edu', 'Jared', 'J', 'Pupo', 'Morales', '2001-03-31', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840199857, 'emanuel.martinez8@upr.edu', 'Emanuel', 'D', 'Martinez', 'Sanchez', '2001-04-08', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840200668, 'oscar.baez@upr.edu', 'Oscar', 'A', 'Baez', 'Rico', '2002-01-13', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840200905, 'john.pagan1@upr.edu', 'John', 'J.', 'Pagan', 'Burgos', '2002-01-08', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840201052, 'fernando.zeno@upr.edu', 'Fernando', '', 'Zeno', 'Miranda', '2002-02-03', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840202803, 'diego.mendoza@upr.edu', 'Diego', 'A', 'Mendoza', 'Ibarra', '2002-12-13', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840203557, 'christian.giraud@upr.edu', 'Christian', 'G', 'Giraud', 'Rodriguez', '2002-09-11', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840203799, 'rosana.rodriguez4@upr.edu', 'Rosana', '', 'Rodriguez', 'Berrios', '2002-07-09', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840205207, 'alexander.martinez8@upr.edu', 'Alexander', 'Y', 'Martinez', 'Cruz', '2002-07-15', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840205612, 'zulymar.garcia@upr.edu', 'Zulymar', '', 'Garcia', 'Sonera', '2002-07-17', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840205863, 'francisco.marrero7@upr.edu', 'Francisco', 'J', 'Marrero', 'Miranda', '2001-12-04', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840206966, 'jeriel.centeno@upr.edu', 'Jeriel', '', 'Centeno', 'Martinez', '2002-08-14', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840207545, 'ruben.morales8@upr.edu', 'Ruben', 'O', 'Morales', 'Ramos', '2002-09-06', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840208195, 'jahaziel.mercado@upr.edu', 'Jahaziel', '', 'Mercado', 'Rivera', '2002-11-05', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840208498, 'ricardo.gonzalez44@upr.edu', 'Ricardo', 'E', 'Gonzalez', 'Morales', '2002-04-08', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840208614, 'carlos.forteza@upr.edu', 'Carlos', 'D', 'Forteza', 'Hernandez', '2002-02-05', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840208993, 'aleph.gonzalez@upr.edu', 'Aleph', 'M', 'Gonzalez', 'Pagan', '2002-09-09', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840210071, 'juan.rodriguez199@upr.edu', 'Juan', 'E', 'Rodriguez', 'Horta', '2002-10-27', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840211270, 'javier.negron11@upr.edu', 'Javier', 'A', 'Negron', 'Vazquez', '2004-01-23', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840211534, 'kevin.serrano7@upr.edu', 'Kevin', '', 'Serrano', 'Rosado', '2003-04-09', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840211948, 'jeremy.cordero@upr.edu', 'Jeremy', '', 'Cordero', 'Martinez', '2002-09-03', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840212061, 'aidan.varela@upr.edu', 'Aidan', 'G', 'Varela', 'Soto', '2003-03-16', 127, 0, '2017', 'Activo', 127, '', '', ''),
(840212493, 'elaine.torres2@upr.edu', 'Elaine', '', 'Torres', 'Quijano', '2003-06-10', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840212593, 'luis.mont@upr.edu', 'Luis', 'G', 'Mont', 'Cartagena', '2002-12-12', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840213076, 'christian.velez26@upr.edu', 'Christian', 'J', 'Velez', 'Roman', '2003-07-01', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840213149, 'sebastian.soto5@upr.edu', 'Sebastian', 'R', 'Soto', 'Delgado', '2003-04-17', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840213469, 'kevin.aviles6@upr.edu', 'Kevin', '', 'Aviles', 'Rivera', '2003-10-28', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840213494, 'enrique.pereira1@upr.edu', 'Enrique', 'A', 'Pereira', 'Montalvo', '2003-07-06', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840213727, 'eddie.silva@upr.edu', 'Eddie', 'O', 'Silva', 'Perez', '2003-01-20', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840213978, 'fabian.lopez6@upr.edu', 'Fabian', 'A', 'Lopez', 'Perez', '2003-12-24', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840214190, 'herreld.rosado@upr.edu', 'Herreld', 'G', 'Rosado', 'Ortiz', '2003-07-12', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840214536, 'dylan.perez1@upr.edu', 'Dylan', '', 'Perez', 'Santiago', '2003-06-19', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840214962, 'albin.menendez@upr.edu', 'Albin', 'S', 'Menendez', 'Pineda', '2003-04-15', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840215737, 'michael.velez12@upr.edu', 'Michael', 'G', 'Velez', 'Badillo', '2003-03-24', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840215847, 'rey.gonzalez6@upr.edu', 'Rey', 'A', 'Gonzalez', 'Martinez', '2003-02-20', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840216429, 'joshua.valentin2@upr.edu', 'Joshua', '', 'Valentin', 'Quinones', '2003-01-17', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840216794, 'cairaliz.cepeda@upr.edu', 'Cairaliz', '', 'Cepeda', 'Martinez', '2003-09-27', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840216810, 'gabriela.melendez12@upr.edu', 'Gabriela', '', 'Melendez', 'Marrero', '2003-10-29', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840216972, 'juan.delarosa1@upr.edu', 'Juan', 'A', 'De', 'La Rosa Campos', '2003-09-29', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840216975, 'lian.melendez@upr.edu', 'Lian', 'I', 'Melendez', 'Santana', '2003-10-17', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840217612, 'jiullianlee.vargas@upr.edu', 'Jiullian-lee', 'M', 'Vargas', 'Ruiz', '2003-01-28', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840218120, 'ricardo.morales25@upr.edu', 'Ricardo', 'L', 'Morales', 'Crespo', '2003-10-15', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840218756, 'yaniel.rivera5@upr.edu', 'Yaniel', 'A', 'Rivera', 'Rodriguez', '2003-07-14', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840219180, 'andre.negron@upr.edu', 'Andre', 'S', 'Negron', 'Perez', '2003-08-26', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840219383, 'daniel.lopez27@upr.edu', 'Daniel', 'A', 'Lopez', 'Garcia', '2003-10-11', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840219509, 'andres.rodriguez37@upr.edu', 'Andres', 'L', 'Rodriguez', 'Suarez', '2003-08-28', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840219554, 'pablo.dejesus4@upr.edu', 'Pablo', 'E', 'De', 'Jesus Beauchamp', '2003-03-19', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840219574, 'carlos.barreto12@upr.edu', 'Carlos', 'A', 'Barreto', 'Hernandez', '2003-09-05', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840219588, 'joel.gonzalez35@upr.edu', 'Joel', 'M', 'Gonzalez', 'Rodriguez', '2003-03-18', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840219767, 'ian.ramos4@upr.edu', 'Ian', 'R', 'Ramos', 'Rosario', '2003-03-17', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840221078, 'joseph.carrero@upr.edu', 'Joseph', 'E', 'Carrero', 'Ramirez', '2004-10-15', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840221084, 'john.lopez9@upr.edu', 'John', 'A', 'Lopez', 'Crespo', '2004-09-14', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840221465, 'dylan.jimenez@upr.edu', 'Dylan', 'O', 'Jimenez', 'Collazo', '2004-09-02', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840221632, 'efrain.santiago13@upr.edu', 'Efrain', 'J', 'Santiago', 'Atiles', '2004-09-09', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840221685, 'wilmarys.cruz@upr.edu', 'Wilmarys', '', 'Cruz', 'Lopez', '2004-10-19', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840221924, 'robertojunior.reyes@upr.edu', 'Roberto', 'Junior', 'Reyes', 'Reyes', '2004-10-19', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840222239, 'kevin.rodriguez79@upr.edu', 'Kevin', 'M', 'Rodriguez', 'Molina', '2004-05-20', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840222830, 'gustavo.ayala6@upr.edu', 'Gustavo', '', 'Ayala', 'Berdecia', '2004-08-01', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840223019, 'kenneth.cruz6@upr.edu', 'Kenneth', 'Y', 'Cruz', 'Perez', '2004-01-30', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840223271, 'david.lopez26@upr.edu', 'David', 'E', 'Lopez', 'Rosado', '2004-04-22', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840223326, 'ricardo.romero6@upr.edu', 'Ricardo', 'G', 'Romero', 'Gonzalez', '2004-12-14', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840223509, 'derek.perez@upr.edu', 'Derek', 'Y', 'Perez', 'Velez', '2004-12-08', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840223566, 'jesus.lopez32@upr.edu', 'Jesus', 'E', 'Lopez', 'Rosado', '2004-04-22', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840223701, 'alanis.correa@upr.edu', 'Alanis', 'N', 'Correa', 'Rodriguez', '2004-08-25', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840223746, 'kenai.cancel@upr.edu', 'Kenai', '', 'Cancel', 'Ortiz', '2004-12-23', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840223940, 'kevin.santiago33@upr.edu', 'Kevin', 'Y', 'Santiago', 'Matos', '2004-06-20', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840224325, 'jonathan.vega14@upr.edu', 'Jonathan', 'J', 'Vega', 'Rivera', '2004-05-20', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840224452, 'alberto.rivera53@upr.edu', 'Alberto', 'M', 'Rivera', 'Morales', '2004-08-17', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840224813, 'alondra.colon10@upr.edu', 'Alondra', 'D', 'Colon', 'Rivera', '2004-04-12', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840224835, 'tamish.rodriguez@upr.edu', 'Tamish', 'Y', 'Rodriguez', 'Cruz', '2004-02-04', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840224876, 'mario.rios3@upr.edu', 'Mario', 'A', 'Rios', 'Rosario', '2004-01-29', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840225232, 'diego.rivera51@upr.edu', 'Diego', 'A', 'Rivera', 'Burgos', '2004-10-28', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840226146, 'sariel.lopez@upr.edu', 'Sariel', 'J', 'Lopez', 'Aviles', '2004-10-06', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840226187, 'derek.juarbe@upr.edu', 'Derek', 'J', 'Juarbe', 'Cuevas', '2004-08-03', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840226314, 'adriana.rodriguez74@upr.edu', 'Adriana', 'S', 'Rodriguez', 'Rodriguez', '2004-12-12', 127, 0, '2017', 'Activo', 127, '', '', ''),
(840226533, 'jandre.rivera@upr.edu', 'Jandre', 'E', 'Rivera', 'Agosto', '2004-07-01', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840226624, 'derek.pantoja@upr.edu', 'Derek', 'R', 'Pantoja', 'Martinez', '2004-11-09', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840227945, 'yarelis.laureano@upr.edu', 'Yarelis', '', 'Laureano', 'Rosado', '2004-02-15', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840228454, 'jorge.gonzalez84@upr.edu', 'Jorge', 'A', 'Gonzalez', 'Rivera', '2004-06-29', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840228846, 'carlos.ocasio21@upr.edu', 'Carlos', '', 'Ocasio', '', '2004-08-31', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840229007, 'giovaniel.mejias@upr.edu', 'Giovaniel', '', 'Mejias', 'Perez', '2004-10-27', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840229140, 'jorge.arce4@upr.edu', 'Jorge', 'J', 'Arce', 'Vazquez', '2004-08-02', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840229293, 'joselyn.perez7@upr.edu', 'Joselyn', '', 'Perez', 'Davisson', '2004-04-02', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840229641, 'elnet.delgado@upr.edu', 'Elnet', 'Y', 'Delgado', 'Hernandez', '2003-07-22', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840230034, 'edgardo.feliciano6@upr.edu', 'Edgardo', 'J', 'Feliciano', 'Aponte', '2005-05-04', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840230146, 'rayhan.velez@upr.edu', 'Rayhan', 'J', 'Velez', 'Gomez', '2005-01-11', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840230274, 'manuel.freytes1@upr.edu', 'Manuel', 'E', 'Freytes', 'Guzman', '2005-07-15', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840230427, 'kenay.soto@upr.edu', 'Kenay', 'J', 'Soto', 'Mendez', '2005-08-11', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840230466, 'ana.correa3@upr.edu', 'Ana', 'P', 'Correa', 'Fernandez', '2005-04-11', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840230570, 'alanis.soto5@upr.edu', 'Alanis', 'Z', 'Soto', 'Gonzalez', '2005-10-27', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840230687, 'xavier.gonzalez19@upr.edu', 'Xavier', '', 'Gonzalez', 'Rivera', '2005-09-11', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840231139, 'ivan.gonzalez36@upr.edu', 'Ivan', 'Y', 'Gonzalez', 'Rivera', '2005-07-30', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840231207, 'roberto.castro6@upr.edu', 'Roberto', '', 'Castro', 'Rodriguez', '2005-06-21', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840231444, 'alanis.oliveras1@upr.edu', 'Alanis', 'K', 'Oliveras', 'Perez', '2005-04-14', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840231659, 'jared.rivera6@upr.edu', 'Jared', '', 'Rivera', 'Montalvo', '2006-02-28', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840231728, 'xul.gonzalez@upr.edu', 'Xul', 'M', 'Gonzalez', 'Pagan', '2004-12-15', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840231902, 'fabian.colon7@upr.edu', 'Fabian', 'M', 'Colon', 'Vazquez', '2005-10-17', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840232174, 'yasiel.otero@upr.edu', 'Yasiel', 'M', 'Otero', 'Cardona', '2005-10-11', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840232870, 'marangelis.ocasio@upr.edu', 'Marangelis', '', 'Ocasio', 'Narvaez', '2005-03-19', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840232886, 'gustavo.vazquez3@upr.edu', 'Gustavo', '', 'Vazquez', 'Rivera', '2005-04-12', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840233124, 'lenny.mejias@upr.edu', 'Lenny', 'L', 'Mejias', 'Sanchez', '2004-11-10', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840233214, 'esteban.rodriguez13@upr.edu', 'Esteban', 'F', 'Rodriguez', 'Denis', '2005-05-05', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840233670, 'david.sandoval@upr.edu', 'David', 'E', 'Sandoval', 'Gierbolini', '2005-09-12', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840233729, 'joisen.reyes@upr.edu', 'Joisen', 'R', 'Reyes', 'Arocho', '2005-05-12', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840234221, 'carlos.castillo23@upr.edu', 'Carlos', 'D', 'Castillo', 'Rivera', '2005-08-31', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840234536, 'diego.muniz5@upr.edu', 'Diego', 'A', 'Muniz', 'Torres', '2005-02-08', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840234619, 'bryan.martinez17@upr.edu', 'Bryan', 'R', 'Martinez', 'Perez', '2005-06-24', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840234620, 'jengis.dejesus@upr.edu', 'Jengis', 'T', 'De', 'Jesus Rodriguez', '2005-04-30', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840234636, 'yeriel.santiago2@upr.edu', 'Yeriel', 'Y', 'Santiago', 'Lopez', '2005-05-27', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840234901, 'juan.estrella1@upr.edu', 'Juan', 'C', 'Estrella', 'Vargas', '2005-06-01', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840235102, 'keniell.barreto@upr.edu', 'Keniell', 'J', 'Barreto', 'Hernandez', '2005-05-27', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840235583, 'kendrick.despiau@upr.edu', 'Kendrick', '', 'Despiau', 'Rivera', '2004-12-06', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840235751, 'rodney.aletriz@upr.edu', 'Rodney', '', 'Aletriz', 'Contes', '2005-06-22', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840235853, 'kendrick.perez@upr.edu', 'Kendrick', '', 'Perez', 'Gonzalez', '2005-02-17', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840236020, 'jamieson.molina@upr.edu', 'Jamieson', 'A', 'Molina', 'Baez', '2005-12-05', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840236285, 'justine.velez@upr.edu', 'Justine', 'O', 'Velez', 'Paniagua', '2005-11-15', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840236479, 'gabriel.cruz50@upr.edu', 'Gabriel', 'Y', 'Cruz', 'Freytes', '2005-07-19', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840236647, 'miguel.jimenez12@upr.edu', 'Miguel', 'A', 'Jimenez', 'Vicente', '2005-09-08', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840236773, 'vivianna.gonzalez@upr.edu', 'Vivianna', 'C', 'Gonzalez', 'Sanchez', '2005-03-26', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(840238659, 'arianne.gonzalez1@upr.edu', 'Arianne', '', 'Gonzalez', 'Velazquez', '2005-07-05', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(844168218, 'briana.santiago@upr.edu', 'Briana', 'L.', 'Santiago', 'Nieves', '1998-11-26', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(844209341, 'ismael.lopez1@upr.edu', 'Ismael', '', 'Lopez', 'Perez', '2001-11-07', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL),
(846168988, 'celymar.torres1@upr.edu', 'Celymar', '', 'Torres', 'Crespo', '1998-06-03', 0, 0, '2022', 'Activo', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_courses`
--

CREATE TABLE `student_courses` (
  `student_num` int(9) NOT NULL,
  `crse_code` varchar(8) NOT NULL,
  `credits` tinyint(1) NOT NULL,
  `type` varchar(10) NOT NULL,
  `crse_grade` varchar(2) NOT NULL,
  `crse_status` varchar(10) NOT NULL,
  `term` varchar(3) NOT NULL,
  `equivalencia` varchar(100) NOT NULL,
  `convalidacion` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_courses`
--

INSERT INTO `student_courses` (`student_num`, `crse_code`, `credits`, `type`, `crse_grade`, `crse_status`, `term`, `equivalencia`, `convalidacion`) VALUES
(840182717, 'CCOM3001', 5, 'mandatory', 'A', 'P', 'XXX', 'INGE3011[2]+INGE3016[3]', '1'),
(840182717, 'CCOM3002', 5, 'mandatory', 'A', 'P', 'XXX', '', '0'),
(840182717, 'CCOM3010', 3, 'mandatory', 'A', 'P', 'XXX', '', '0'),
(840182717, 'CCOM3015', 3, 'mandatory', 'A', 'P', 'XXX', '', '0'),
(840182717, 'CCOM3020', 3, 'mandatory', 'A', 'P', 'XXX', '', '0'),
(840182717, 'CCOM3025', 3, 'mandatory', 'A', 'P', 'XXX', '', '0'),
(840182717, 'CCOM3035', 3, 'mandatory', 'A', 'P', 'XXX', '', '0'),
(840182717, 'CCOM3041', 3, 'mandatory', 'A', 'P', 'XXX', '', '0'),
(840182717, 'CCOM4005', 3, 'mandatory', 'A', 'P', 'XXX', '', '0'),
(840182717, 'CCOM4006', 3, 'mandatory', 'A', 'P', 'XXX', '', '0'),
(840182717, 'CCOM4007', 4, 'mandatory', 'A', 'P', 'XXX', '', '0'),
(840182717, 'CCOM4025', 3, 'mandatory', 'A', 'P', 'XXX', '', '0'),
(840182717, 'CCOM4065', 3, 'mandatory', 'A', 'P', 'XXX', '', '0'),
(840182717, 'CCOM3015', 3, 'mandatory', 'A', 'P', 'XXX', '', '0'),
(840182717, 'CCOM4115', 3, 'mandatory', 'A', 'P', 'XXX', '', '0'),
(840182717, 'ESPA3101', 3, 'ESPA', 'P', 'P', 'XXX', '', '0'),
(840182717, 'ESPA3102', 3, 'ESPA', 'P', 'P', 'XXX', '', '0'),
(840182717, 'ESPA3208', 3, 'ESPA', 'A', 'P', 'XXX', '', '0'),
(840182717, 'INGL3101', 3, 'INGL', 'P', 'P', 'XXX', '', '0'),
(840182717, 'INGL3102', 3, 'INGL', 'P', 'P', 'XXX', '', '0'),
(840182717, 'INGL3015', 3, 'INGL', 'A', 'P', 'XXX', '', '0'),
(840182717, 'MATE3171', 3, 'MATE', 'A', 'P', 'XXX', '', '0'),
(840182717, 'MATE3172', 3, 'MATE', 'A', 'P', 'XXX', '', '0'),
(840182717, 'MATE3031', 4, 'MATE', 'B', 'P', 'XXX', '', '0'),
(840182717, 'MUSI3225', 3, 'HUMA', 'A', 'P', 'XXX', '', '0'),
(840182717, 'HIST3241', 3, 'HUMA', 'A', 'P', 'XXX', '', '0'),
(840182717, 'CISO3121', 3, 'CISO', 'B', 'P', 'XXX', '', '0'),
(840182717, 'ECON3021', 3, 'CISO', 'A', 'P', 'XXX', '', '0'),
(840182717, 'CIBI3001', 3, 'CIBI', 'A', 'P', 'XXX', '', '0'),
(840182717, 'CIBI3002', 3, 'CIBI', 'A', 'P', 'XXX', '', '0'),
(840182717, 'ESPA3101', 3, 'ESPA', 'P', 'P', 'XXX', '', '0'),
(840182717, 'FISI3011', 3, 'FISI', 'B', 'P', 'XXX', 'FISI3171', '1'),
(840182717, 'FISI3013', 1, 'FISI', 'A', 'P', 'XXX', 'FISI3173', '1'),
(840182717, 'FISI3012', 3, 'FISI', 'B', 'P', 'XXX', '', '0'),
(840182717, 'FISI3014', 1, 'FISI', 'A', 'P', 'XXX', '', '0'),
(840182717, 'INGL3221', 3, 'elec_free', 'A', 'P', 'XXX', '', '0'),
(840182717, 'MUSI3175', 3, 'elec_free', 'A', 'P', 'XXX', '', '0'),
(840182717, 'INGL3011', 3, 'elec_free', 'A', 'P', 'XXX', '', '0'),
(840182717, 'INGL3012', 3, 'elec_free', 'A', 'P', 'XXX', '', '0'),
(840182717, 'CCOM4305', 3, 'elec_free', 'A', 'P', 'XXX', '', '0'),
(840182717, 'CCOM4306', 3, 'elec_free', 'A', 'P', 'XXX', '', '0'),
(840182717, 'CCOM4019', 3, 'elec_free', 'A', 'P', 'XXX', '', '0'),
(840182717, 'INGL3238', 3, 'elec_free', 'A', 'P', 'XXX', '', '0'),
(840182717, 'CCOM4991', 3, 'elec_free', 'A', 'P', 'XXX', '', '0'),
(840182717, 'INTD4995', 3, 'elec_free', 'A', 'P', 'XXX', '', '0'),
(840194867, 'CCOM3001', 5, 'mandatory', 'A', 'P', 'XXX', '', ''),
(840194867, 'CCOM3002', 5, 'mandatory', 'A', 'P', 'XXX', '', ''),
(840194867, 'CCOM3010', 3, 'mandatory', 'A', 'P', 'XXX', '', ''),
(840194867, 'CCOM3020', 3, 'mandatory', 'B', 'P', 'XXX', '', ''),
(840194867, 'CCOM3025', 3, 'mandatory', 'A', 'P', 'XXX', '', ''),
(840194867, 'CCOM3035', 3, 'mandatory', 'A', 'P', 'XXX', '', ''),
(840194867, 'CCOM3041', 3, 'mandatory', 'A', 'P', 'XXX', '', ''),
(840194867, 'CCOM4005', 3, 'mandatory', 'A', 'P', 'XXX', '', ''),
(840194867, 'CCOM4006', 3, 'mandatory', 'B', 'P', 'XXX', '', ''),
(840194867, 'CCOM4007', 4, 'mandatory', 'B', 'P', 'XXX', '', ''),
(840194867, 'CCOM4025', 3, 'mandatory', 'B', 'P', 'XXX', '', ''),
(840194867, 'CCOM4065', 3, 'mandatory', 'B', 'P', 'XXX', '', ''),
(840194867, 'CCOM4115', 3, 'mandatory', 'B', 'P', 'XXX', '', ''),
(840194867, 'ESPA3101', 3, 'ESPA', 'P', 'P', 'XXX', '', ''),
(840194867, 'ESPA3208', 3, 'ESPA', 'B', 'P', 'XXX', '', ''),
(840194867, 'INGL3101', 3, 'INGL', 'C', 'P', 'XXX', '', ''),
(840194867, 'INGL3102', 3, 'INGL', 'B', 'P', 'XXX', '', ''),
(840194867, 'MATE3171', 3, 'MATE', 'B', 'P', 'XXX', '', ''),
(840194867, 'MATE3172', 3, 'MATE', 'D', 'P', 'XXX', '', ''),
(840194867, 'MATE3031', 4, 'MATE', 'C', 'P', 'XXX', '', ''),
(840194867, 'HUMA3101', 3, 'HUMA', 'B', 'P', 'XXX', '', ''),
(840194867, 'CISO3121', 3, 'CISO', 'C', 'P', 'XXX', '', ''),
(840194867, 'GEOG3155', 3, 'CISO', 'A', 'P', 'XXX', '', ''),
(840194867, 'CIBI3001', 3, 'CIBI', 'B', 'P', 'XXX', '', ''),
(840194867, 'CIBI3002', 3, 'CIBI', 'A', 'P', 'XXX', '', ''),
(840194867, 'FISI3011', 3, 'FISI', 'B', 'P', 'XXX', '', ''),
(840194867, 'CCOM4305', 3, 'elec_free', 'A', 'P', 'XXX', '', ''),
(840194867, 'CCOM4306', 3, 'elec_free', 'A', 'P', 'XXX', '', ''),
(840194867, 'ASTR3009', 3, 'elec_free', 'A', 'P', 'XXX', '', ''),
(840194867, 'CCOM3015', 3, 'mandatory', 'A', 'P', 'XXX', '', ''),
(840194867, 'INGL3015', 3, 'INGL', 'A', 'P', 'XXX', '', ''),
(840194867, 'FISI3013', 1, 'FISI', 'B', 'P', 'XXX', '', ''),
(840194867, 'CCOM3027', 3, 'elec_ccom', 'A', 'P', 'XXX', '', ''),
(840194867, 'INTD4995', 3, 'elec_ccom', 'A', 'P', 'XXX', '', ''),
(840194867, 'INTD4995', 3, 'elec_ccom', 'A', 'P', 'XXX', '', ''),
(840194867, 'CCOM3985', 2, 'elec_free', 'A', 'P', 'XXX', '', ''),
(840194867, 'CCOM4075', 3, 'mandatory', '', 'm', 'XXX', '', ''),
(840194867, 'HUMA3102', 3, 'HUMA', '', 'm', 'XXX', '', ''),
(840194867, 'CCOM4019', 3, 'elec_free', '', 'm', 'XXX', '', ''),
(840194867, 'CCOM3031', 3, 'elec_ccom', '', 'm', 'XXX', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `will_take`
--

CREATE TABLE `will_take` (
  `student_num` varchar(9) NOT NULL,
  `crse_code` varchar(8) NOT NULL,
  `term` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `will_take`
--

INSERT INTO `will_take` (`student_num`, `crse_code`, `term`) VALUES
('840182717', 'CCOM3001', 'BB0'),
('840182717', 'CCOM3002', 'BB0'),
('840201040', 'CCOM3001', 'BB0'),
('840201040', 'CCOM3010', 'BB0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ccom_courses`
--
ALTER TABLE `ccom_courses`
  ADD PRIMARY KEY (`crse_code`);

--
-- Indexes for table `cohort_requirements`
--
ALTER TABLE `cohort_requirements`
  ADD PRIMARY KEY (`cohort_year`);

--
-- Indexes for table `minor`
--
ALTER TABLE `minor`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_num`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `minor`
--
ALTER TABLE `minor`
  MODIFY `ID` smallint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
