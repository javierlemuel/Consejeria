<?php

if (session_status() == PHP_SESSION_NONE) {
    // Start the session
    session_start();
}
if (!isset($_SESSION['student_authenticated']) || $_SESSION['student_authenticated'] !== true) {
    header("Location: ../index.php");
    exit;
} else {

    // controllers/expedientesController.php
    require_once(__DIR__ . '/../models/CounselingModel.php');
    require_once(__DIR__ . '/../config/database.php');

    class CounselingController
    {
        public function index()
        {
            $selectedCourses = "";
            global $conn;
            $counselingModel = new CounselingModel();


            //obtenemos el numero de estudiante        
            if (isset($_SESSION['student_num'])) {
                $student_num = $_SESSION['student_num'];
            }

            // Obtenemos la lista de las clases recomendadas
            $recommendedCourses = $counselingModel->getRecommendedCourses($conn, $student_num);

            // Obtenemos la lista de las clases de concentracion
            $concentrationCourses = $counselingModel->getConcentrationCourses($conn, $student_num);

            // Obtenemos la lista de las clases generales
            $generalCourses = $counselingModel->getGeneralCourses($conn, $student_num);

            $studentInfo = $counselingModel->getStudentInfo($conn, $student_num);

            if (isset($_SESSION['student_num'])) {
                $_SESSION['full_student_name'] = $studentInfo['full_student_name'];
                $_SESSION['formatted_student_num'] = $studentInfo['formatted_student_num'];
                $_SESSION['email'] = $studentInfo['email'];
                $_SESSION['student_note'] = $studentInfo['student_note'];
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // You should check if the selectedCoursesList is not empty before proceeding.
                if (!isset($_POST['selectedCoursesList']) || empty($_POST['selectedCoursesList'])) {
                    header("Location: ../index.php");
                    exit;
                } else if (isset($_POST['selectedCoursesList'])) {

                    $selectedCourses = $_POST['selectedCoursesList'];

                    // Save selected courses to the database using the Model
                    $counselingModel->setCourses($conn, $student_num, $selectedCourses);

                    header("Location: ../index.php");
                    exit;
                }
            }

            $conducted_counseling = $counselingModel->getCounselingStatus($conn, $student_num);
            if ($conducted_counseling === 1) {
                $_SESSION['counseling_button'] = '<button type="submit" value="Submit" id="counseling_button" class="btn btn-warning self-end" disabled>Confirmar Consejeria</button>';
            } else {
                $_SESSION['counseling_button']  = '<button type="submit" value="Submit" id="counseling_button" class="btn btn-warning self-end">Confirmar Consejeria</button>';
            }


            require_once(__DIR__ . '/../views/counselingView.php');
            require_once(__DIR__ . '/../views/layouts/sidebar.php');
            require_once(__DIR__ . '/../views/layouts/header.php');
        }
    }

    $counselingController = new CounselingController();
    $counselingController->index();
}
