<?php
// controllers/expedientesController.php
require_once '../models/StudentModel.php';
require_once '../config/database.php';

class ExpedientesController {
    public function index() {
        global $conn;
        $studentModel = new StudentModel();
        $students = $studentModel->getAllStudents($conn);
        require_once '../views/expedientesView.php';
    }
}

$expedientesController = new ExpedientesController();
$expedientesController->index();
?>