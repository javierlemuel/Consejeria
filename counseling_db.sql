-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2024 at 09:22 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ccom_requirements`
--

INSERT INTO `ccom_requirements` (`crse_code`, `cohort_year`, `type`, `req_crse_code`) VALUES
('CCOM3002', '2017', 'pre', 'CCOM3001');

-- --------------------------------------------------------

--
-- Table structure for table `cohort`
--

CREATE TABLE `cohort` (
  `cohort_year` varchar(4) NOT NULL,
  `crse_code` varchar(8) NOT NULL,
  `crse_year` tinyint(1) NOT NULL,
  `crse_semester` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
('2021', 'CCOM3001', 1, 1),
('2023', 'CCOM3001', 1, 1),
('2025', 'CCOM3001', 1, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dummy_courses`
--

INSERT INTO `dummy_courses` (`crse_code`, `name`, `credits`) VALUES
('HUMAXXXX', 'Electiva General de HUMA', 3),
('CISOXXXX', 'Electiva General de CISO', 3),
('CCOMINTX', 'Electiva Intermedia de CCOM', 3),
('CCOMAVZX', 'Electiva Avanzada de CCOM', 3),
('FREEXXXX', 'Electiva Libre', 3);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `general_courses`
--

INSERT INTO `general_courses` (`crse_code`, `name`, `credits`, `required`, `type`) VALUES
('ESPA3101', 'ESPAÑOL BÁSICO I', 3, 1, 'ESPA'),
('ESPA3102', 'ESPAÑOL BÁSICO II', 3, 1, 'ESPA'),
('ESPA3208', 'REDACCIÓN Y ESTILO', 3, 1, 'ESPA'),
('ESPA3003', 'Fundamentos de lengua y discurso I', 3, 1, 'ESPA'),
('ESPA3004', 'Fundamentos de lengua y discurso II', 3, 1, 'ESPA'),
('INGL3101', 'Basic English I', 3, 1, 'INGL'),
('INGL3102', 'Basic English II', 3, 1, 'INGL'),
('INGL3103', 'Intermediate English I', 3, 1, 'INGL'),
('INGL3104', 'Intermediate English II', 3, 1, 'INGL'),
('INGL3011', 'Honor\'s English I', 3, 1, 'INGL'),
('INGL3012', 'Honor\'s English II', 3, 1, 'INGL'),
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
('CISO3122', 'Introducción a las Ciencias Sociales II', 3, 1, 'CISO');

-- --------------------------------------------------------

--
-- Table structure for table `general_requirements`
--

CREATE TABLE `general_requirements` (
  `crse_code` varchar(8) NOT NULL,
  `cohort_year` varchar(4) NOT NULL,
  `type` varchar(3) NOT NULL,
  `req_crse_code` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `minor`
--

CREATE TABLE `minor` (
  `ID` smallint(3) NOT NULL,
  `name` varchar(50) NOT NULL,
  `required_credits` smallint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`crse_code`, `term`) VALUES
('XXXX', 'BB0'),
('CCOM3001', 'BB0'),
('CCOM3002', 'BB0');

-- --------------------------------------------------------

--
-- Table structure for table `recommended_courses`
--

CREATE TABLE `recommended_courses` (
  `student_num` int(9) NOT NULL,
  `crse_code` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(840182717, 'HUMAXXXX');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_num`, `email`, `name1`, `name2`, `last_name1`, `last_name2`, `dob`, `conducted_counseling`, `minor`, `cohort_year`, `status`, `edited_flag`, `grad_term`, `student_note`, `admin_note`) VALUES
(840171234, 'mariana.rios@upr.edu', 'Mariana', NULL, 'Santiago', 'Soto', '1999-10-04', 0, 0, '2017', 'Activo', 1, NULL, NULL, NULL),
(840182717, 'javier.quinones3@upr.edu', 'Javier', 'Lemuel', 'Quinones', 'Galan', '2000-01-05', 1, 1, '2017', 'Activo', 1, NULL, NULL, NULL),
(840191234, 'elaine.sanchez7@upr.edu', 'Elaine', NULL, 'Sanchez', 'Rios', '1999-02-02', 0, 1, '2017', 'Activo', 1, NULL, NULL, NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `takes`
--

CREATE TABLE `takes` (
  `student_num` varchar(9) NOT NULL,
  `crse_code` varchar(8) NOT NULL,
  `term` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `takes`
--

INSERT INTO `takes` (`student_num`, `crse_code`, `term`) VALUES
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
