<?php
// controllers/expedientesController.php
require_once(__DIR__ . '/../models/ExpedienteModel.php');
require_once(__DIR__ . '/../config/database.php');
if (session_status() == PHP_SESSION_NONE) {
    // Start the session
    session_start();
}

class ExpedienteController
{
    public function index()
    {
        global $conn;
        $studentModel = new StudentModel();
        if (session_status() == PHP_SESSION_NONE) {
            // Start the session
            session_start();
        }

        //obtenemos el numero de estudiante        
        if (isset($_SESSION['student_num'])) {
            $student_num = $_SESSION['student_num'];
        }

        //get student info
        $studentInfo = $studentModel->getStudentInfo($conn, $student_num);

        // if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selectedCoursesList'])) {
        //     // Verifica si los campos del formulario no están vacíos
        //     if (empty($_POST['selectedCoursesList'])) {
        //         // Al menos uno de los campos está vacío, redirige al usuario a loginView.php
        //         header("Location: ../views/counselingView.php");
        //         exit;
        //     }
        //     $selectedCourses = $_POST['selectedCoursesList'];

        //     $counselingModel->insertCourse($conn, $student_num, $selectedCourses);
        //     header("Location: ../index.php");
        //     exit;
        // }

        require_once(__DIR__ . '/../views/expedienteView.php');
    }
}

$expedienteController = new ExpedienteController();
$expedienteController->index();
