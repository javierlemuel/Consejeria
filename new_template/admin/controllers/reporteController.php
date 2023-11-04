<?php
require_once(__DIR__ . '/../models/ReporteModel.php');
require_once(__DIR__ . '/../config/database.php');

class ReporteController{
    public function index() {   
        global $conn;
        $reporteModel = new ReporteModel();

        $studentsAconsejados = $reporteModel->getStudentsAconsejados($conn);
        $studentsSinCCOM = $reporteModel->getStudentsSinCCOM($conn);
        $studentsRegistrados = $reporteModel->getRegistrados($conn);
        $studentsEditados = $reporteModel->getEditados($conn);
        $studentsPerClass = $reporteModel->getStudentsPerClass($conn);
        $count = 0;

        require_once(__DIR__ . '/../views/reporteView.php');

    }
}

$reporteController = new ReporteController();
$reporteController->index();

?>