<?php
// controllers/expedientesController.php
require_once(__DIR__ . '/../models/CohorteModel.php');
require_once(__DIR__ . '/../config/database.php');

class Cohorte2022Controller
{
    public function cohorte2022()
    {
        global $conn;
        $counselingModel = new CohorteModel();
        if (session_status() == PHP_SESSION_NONE) {
            // Start the session
            session_start();
        }

        //obtenemos el numero de estudiante        
        if (isset($_SESSION['student_num'])) {
            $student_num = $_SESSION['student_num'];
        }

        //editar todo esto //////////////////////////
        // Obtenemos la lista de las clases de concentracion
        $concentrationCourses = $counselingModel->getConcentrationCourses($conn);

        // Obtenemos la lista de las clases generales
        $generalCourses = $counselingModel->getGeneralCourses($conn);



        require_once(__DIR__ . '/../views/cohorte2022View.php');
    }
}

$cohorteController = new Cohorte2022Controller();
$cohorteController->cohorte2022();
