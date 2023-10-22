<?php
// controllers/expedientesController.php
require_once(__DIR__ . '/../models/StudentModel.php');
require_once(__DIR__ . '/../config/database.php');

class ExpedientesController {
    public function index() {
        global $conn;
        $studentModel = new StudentModel();

        // Parámetros de paginación
        $studentsPerPage = 2; // Cambia esto al número deseado
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        // Obtenemos la lista de estudiantes para la página actual
        $students = $studentModel->getStudentsByPage($conn, $studentsPerPage, $currentPage);

        // Contamos el total de estudiantes
        $totalStudents = $studentModel->getTotalStudents($conn);

        // Calculamos el número de páginas
        $totalPages = ceil($totalStudents / $studentsPerPage);

        require_once(__DIR__ . '/../views/expedientesView.php');
    }
}

$expedientesController = new ExpedientesController();
$expedientesController->index();
?>
