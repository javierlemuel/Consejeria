<?php
// controllers/expedientesController.php
require_once(__DIR__ . '/../models/CounselingModel.php');
require_once(__DIR__ . '/../config/database.php');

class CounselingController
{
    public function index()
    {
        $selectedCourses = "";
        $value = "*";
        global $conn;
        $counselingModel = new CounselingModel();
        if (session_status() == PHP_SESSION_NONE) {
            // Start the session
            session_start();
        }

        //obtenemos el numero de estudiante        
        if (isset($_SESSION['student_num'])) {
            $student_num = $_SESSION['student_num'];
        }

        // Obtenemos la lista de las clases recomendadas
        $recommendedCourses = $counselingModel->getRecommendedCourses($conn, $student_num);

        // Obtenemos la lista de las clases de concentracion
        $concentrationCourses = $counselingModel->getConcentrationCourses($conn);

        // Obtenemos la lista de las clases generales
        $generalCourses = $counselingModel->getGeneralCourses($conn);

        $studentInfo = $counselingModel->getStudentInfo($conn, $student_num);

        if (isset($_SESSION['student_num'])) {
            $_SESSION['full_student_name'] = $studentInfo['full_student_name'];
            $_SESSION['formatted_student_num'] = $studentInfo['formatted_student_num'];
            $_SESSION['email'] = $studentInfo['email'];
        }

        if (isset($_POST['selectedCoursesList'])) {
            // You should check if the selectedCoursesList is not empty before proceeding.
            if (empty($_POST['selectedCoursesList'])) {
                header("Location: ../index.php");
                exit;
            }

            // Store selected courses in a session for later use
            //$_SESSION['selectedCourses'] = $_POST['selectedCoursesList'];

            $selectedCourses = $_POST['selectedCoursesList'];
            $value = $_POST['selectedCourseList'][0];

            // Save selected courses to the database using the Model
            $counselingModel->setCourses($conn, $student_num, $selectedCourses);

            header("Location: ../index.php?value=" . count($selectedCourses) . "");
            exit;
        }


        require_once(__DIR__ . '/../views/counselingView.php');
        require_once(__DIR__ . '/../views/layouts/sidebar.php');
        require_once(__DIR__ . '/../views/layouts/header.php');
    }
}

$counselingController = new CounselingController();
$counselingController->index();
