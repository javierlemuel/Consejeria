<?php
if (!isset($_SESSION['student_authenticated']) && $_SESSION['student_authenticated'] !== true) {
    header("Location: ./index.php");
    exit;
}

// controllers/expedientesController.php
require_once(__DIR__ . '/../models/CohorteModel.php');
require_once(__DIR__ . '/../config/database.php');

class CohorteController
{
    //funcion para obtener los cursos pertenecientes a la secuencia curricular cohorte 2017
    public function cohorte($cohort_year)
    {
        global $conn;
        $cohorteModel = new CohorteModel();
        if (session_status() == PHP_SESSION_NONE) {
            // Start the session
            session_start();
        }

        //si existe la variable en la session, obtenemos el numero de estudiante        
        if (isset($_SESSION['student_num'])) {
            $student_num = $_SESSION['student_num'];
        }

        $cohorte = $cohorteModel->getCohort($conn, $cohort_year);
        require_once(__DIR__ . '/../views/cohorteView.php');
    }
}


if (isset($_GET['page'])) {
    $cohorteController = new CohorteController();
    $cohorteController->cohorte($_GET['page']);
}
