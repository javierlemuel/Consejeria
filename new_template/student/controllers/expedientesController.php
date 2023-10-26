<?php
// controllers/expedientesController.php
require_once(__DIR__ . '/../models/StudentModel.php');
require_once(__DIR__ . '/../config/database.php');

class ExpedientesController {
    public function index() {
        global $conn;
        $studentModel = new StudentModel();

        // Parámetros de paginación
        $studentsPerPage = 1; // Cambia esto al número deseado
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        // Agregar un filtro para estudiantes activos o inactivos
        $statusFilter = isset($_GET['status']) ? $_GET['status'] : 'Todos';

        // Obtenemos la lista de estudiantes según el filtro
        $students = $studentModel->getStudentsByPageAndStatus($conn, $studentsPerPage, $currentPage, $statusFilter);

        // Contamos el total de estudiantes según el filtro
        $totalStudents = $studentModel->getTotalStudentsByStatus($conn, $statusFilter);

        // Calculamos el número de páginas
        $totalPages = ceil($totalStudents / $studentsPerPage);

        require_once(__DIR__ . '/../views/expedientesView.php');
    }
}

$expedientesController = new ExpedientesController();
$expedientesController->index();
?>
