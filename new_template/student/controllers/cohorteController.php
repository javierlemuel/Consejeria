<?php
// controllers/expedientesController.php
require_once(__DIR__ . '/../models/CohorteModel.php');
require_once(__DIR__ . '/../config/database.php');

class CohorteController
{
    //funcion para obtener los cursos pertenecientes a la secuencia curricular cohorte 2017
    public function cohorte2017()
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

        //sacas los cursos de un json file
        $allCourses = file_get_contents(__DIR__ . '/../views/assets/json/cohort.json');
        $allCourses = json_decode($allCourses, true);

        require_once(__DIR__ . '/../views/cohorte2017View.php');
    }

    //funcion para obtener los cursos pertenecientes a la secuencia curricular cohorte 2017
    public function cohorte2022()
    {
        global $conn;
        $counselingModel = new CohorteModel();
        if (session_status() == PHP_SESSION_NONE) {
            // Start the session
            session_start();
        }

        //si existe la variable en la session, obtenemos el numero de estudiante        
        if (isset($_SESSION['student_num'])) {
            $student_num = $_SESSION['student_num'];
        }

        //sacas los cursos de un json file
        $allCourses = file_get_contents(__DIR__ . '/../views/assets/json/cohort.json');
        $allCourses = json_decode($allCourses, true);
        require_once(__DIR__ . '/../views/cohorte2022View.php');
    }
}

if (isset($_GET['page'])) {
    if ($_GET['page'] === "2017") {
        $cohorteController = new CohorteController();
        $cohorteController->cohorte2017();
    } else if ($_GET['page'] === "2022") {
        $cohorteController = new CohorteController();
        $cohorteController->cohorte2022();
    }
}
