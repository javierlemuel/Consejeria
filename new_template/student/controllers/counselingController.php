<?php
// controllers/expedientesController.php
require_once(__DIR__ . '/../models/CounselingModel.php');
require_once(__DIR__ . '/../config/database.php');

class CounselingController
{
    public function index()
    {
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

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selectedCoursesList'])) {
            // Verifica si los campos del formulario no están vacíos
            if (empty($_POST['selectedCoursesList'])) {
                // Al menos uno de los campos está vacío, redirige al usuario a loginView.php
                header("Location: ../views/counselingView.php");
                exit;
            }
            $selectedCourses = $_POST['selectedCoursesList'];

            $counselingModel->insertCourse($conn, $student_num, $selectedCourses);
            header("Location: ../index.php");
            exit;
        }

        require_once(__DIR__ . '/../views/counselingView.php');
    }
}

$counselingController = new CounselingController();
$counselingController->index();
