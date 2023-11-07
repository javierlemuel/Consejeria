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
            elseif ($action === 'selecteStudent')
            {
                $student_num = $_POST['student_num'];
                $studentData = $studentModel->selectStudent($student_num, $conn);
                require_once(__DIR__ . '/../views/editStudentView.php');
                return;
            }
            elseif ($action === 'editStudent')
            {

                $nombre = $_POST['nombre'];
                $nombre2 = $_POST['nombre2'];
                $apellidoP = $_POST['apellidoP'];
                $apellidoM = $_POST['apellidoM'];
                $email = $_POST['email'];
                $numeroEst = $_POST['numeroEstu'];
                $fechaNac = $_POST['fechaNac'];
                $cohorte = $_POST['cohorte'];
                $minor = $_POST['minor'];
                $graduacion = $_POST['graduacion'];
                $notaAdmin = $_POST['notaAdmin'];
                $notaEstudiante = $_POST['notaEstudiante'];
                $status = $_POST['estatus'];
                $result = $studentModel->editStudent($nombre, $nombre2, $apellidoP, $apellidoM, $email, $numeroEst, $fechaNac, $cohorte, $minor, $graduacion, $notaAdmin, $notaEstudiante, $status, $conn);
                $studentData = $studentModel->selectStudent($numeroEst, $conn);
                require_once(__DIR__ . '/../views/editStudentView.php');
                return;
            }
            elseif ($action === 'studentCounseling')
            {
                $student_num = $_POST['student_num'];
                $studentData = $studentModel->selectStudent($student_num, $conn);
                require_once(__DIR__ . '/../views/counseling.php');
                return;
            }
        }

        // Parámetros de paginación
        $studentsPerPage = 2; // Cambia esto al número deseado
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        // Obtener los parámetros del filtro de estado y búsqueda
        $statusFilter = isset($_GET['status']) ? $_GET['status'] : 'Todos';
        $searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';

        // Obtenemos la lista de estudiantes según el filtro y la búsqueda
        $students = $studentModel->getStudentsByPageAndStatusAndSearch($conn, $studentsPerPage, $currentPage, $statusFilter, $searchKeyword);

        // Contamos el total de estudiantes según el filtro y la búsqueda
        $totalStudents = $studentModel->getTotalStudentsByStatusAndSearch($conn, $statusFilter, $searchKeyword);

        // Calculamos el número de páginas
        $totalPages = ceil($totalStudents / $studentsPerPage);

        require_once(__DIR__ . '/../views/expedientesView.php');
    }
}

$expedientesController = new ExpedientesController();
$expedientesController->index();
?>
