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

        //obtenemos el numero de estudiante
        $student_num = $_SESSION['student_num'];

        // Obtenemos la lista de estudiantes según el filtro
        $recommendedCourses = $counselingModel->getRecommendedCourses($conn, $student_num);

        // Obtenemos la lista de estudiantes según el filtro
        $concentrationCourses = $counselingModel->getConcentrationCourses($conn);

        // Obtenemos la lista de estudiantes según el filtro
        $generalCourses = $counselingModel->getGeneralCourses($conn);

        require_once(__DIR__ . '/../views/counselingView.php');
    }
}

$counselingController = new CounselingController();
$counselingController->index();
