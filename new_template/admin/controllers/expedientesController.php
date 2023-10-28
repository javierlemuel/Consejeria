<?php
// controllers/expedientesController.php
require_once(__DIR__ . '/../models/StudentModel.php');
require_once(__DIR__ . '/../config/database.php');

class ExpedientesController {
    public function index() {
        global $conn;
        $studentModel = new StudentModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $action = isset($_POST['action']) ? $_POST['action'] : '';
            if ($action === 'addStudent') {
                // Obtén y procesa los datos para agregar un estudiante
                $nombre = $_POST['nombre'];
                $nombre2 = $_POST['nombre2'];
                $apellidoP = $_POST['apellidoP'];
                $apellidoM = $_POST['apellidoM'];
                $email = $_POST['email'];
                $minor = $_POST['minor'];
                $numero = $_POST['numero_estu'];
                $cohorte = $_POST['cohorte'];
                $estatus = $_POST['estatus'];
                $birthday = $_POST['birthday'];

                // Llama al modelo para insertar el estudiante en la base de datos
                $success = $studentModel->insertStudent($conn, $nombre, $nombre2, $apellidoP, $apellidoM, $email, $minor, $numero, $cohorte, $estatus, $birthday);
            }
        }

        // Parámetros de paginación
        $studentsPerPage = 2; // Cambia esto al número deseado
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
