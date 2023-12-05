<?php
// controllers/expedientesController.php
require_once(__DIR__ . '/../models/StudentModel.php');
//JAVIER
require_once(__DIR__ . '/../models/MinorModel.php');
//
require_once(__DIR__ . '/../config/database.php');

class ExpedientesController {
    public function index() {
        global $conn;
        $studentModel = new StudentModel();
        //JAVIER
        $minorModel = new MinorModel();
        //

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
                //JAVIER
                $date = date("Y-m-d");
                $result = $studentModel->editStudent($nombre, $nombre2, $apellidoP, $apellidoM, $email, $numeroEst, $fechaNac, $cohorte, $minor, $graduacion, $notaAdmin, $notaEstudiante, $status, $date, $conn);
                $minors = $minorModel->getMinors($conn);
                //
                $studentData = $studentModel->selectStudent($numeroEst, $conn);
                require_once(__DIR__ . '/../views/editStudentView.php');
                return;
            }
            elseif ($action === 'studentCounseling')
            {
                require_once(__DIR__ . '/../models/ClassesModel.php');
                $classesModel = new ClassesModel();

                $student_num = $_POST['student_num'];
                $studentData = $studentModel->selectStudent($student_num, $conn);
                $studentCohort = $studentData['cohort_year'];

                $ccomByCohort = $classesModel->getCohortCoursesWgradesCCOM($conn, $studentCohort, $student_num);
                $notccomByCohort = $classesModel->getCohortCoursesWgradesNotCCOM($conn, $studentCohort, $student_num);

                $mandatoryClasses = $classesModel->getCcomCourses($conn);
                $dummyClasses = $classesModel->getDummyCourses($conn);
                $generalClasses = $classesModel->getGeneralCourses($conn);

                require_once(__DIR__ . '/../views/counselingView.php');
                return;
            }
            elseif ($action === 'uploadCSV')
            {
                $archivoRegistro = __DIR__ . '/archivo_de_registro.txt';
                error_log("Estoy en el uploadCSV \n", 3, $archivoRegistro);

                // Verificamos si se han subido archivos
                if (!empty($_FILES['files']['name'])) {
                    $file_tmp = $_FILES['files']['tmp_name'];
                    $file_type = $_FILES['files']['type'];
                    $file_size = $_FILES['files']['size'];
                    
                    // Validamos que el archivo sea de tipo texto
                    if ($file_type == "text/plain") {
                        // Leemos el contenido del archivo
                        $file_content = file_get_contents($file_tmp);

                        // Dividimos el contenido por líneas
                        $lines = explode("\n", $file_content);

                        foreach ($lines as $line) {
                            // Dividimos cada línea por el delimitador ";"
                            $data = explode(";", $line);
                        
                            // Aplicamos trim a cada parte para eliminar espacios en blanco
                            $student_num = trim($data[0]);
                            
                            // Obtenemos el apellido paterno y materno
                            $apellidos_nombres = explode(",", trim($data[1]));
                            $apellidos = $apellidos_nombres[0];
                        
                            // Verificamos si hay un segundo apellido (materno)
                            $apellido_paterno = $apellido_materno = "";
                        
                            if (strpos($apellidos, ' ') !== false) {
                                list($apellido_paterno, $apellido_materno) = explode(' ', $apellidos, 2);
                            } else {
                                $apellido_paterno = $apellidos;
                            }
                        
                            // Obtenemos el nombre y segundo nombre
                            $nombres = explode(" ", trim($apellidos_nombres[1]));
                            $nombre = isset($nombres[0]) ? trim($nombres[0]) : "";
                            $segundo_nombre = isset($nombres[1]) ? trim($nombres[1]) : "";
                        
                            $salon_hogar = trim($data[2]);
                            $phone = trim($data[3]);
                            $license = trim($data[4]);
                            $average = trim($data[5]);
                            $department = trim($data[6]);
                            $address1 = trim($data[7]);
                            $address2 = trim($data[8]);
                            $residence = trim($data[9]);
                            $state = trim($data[10]);
                            $zipcode = trim($data[11]);
                            $email = trim($data[12]);
                        
                            // Llamamos a la función del modelo para insertar el estudiante
                            $studentModel->insertStudentCSV($conn, $student_num, $nombre, $segundo_nombre, $apellido_materno, $apellido_paterno, $salon_hogar, $phone, $license, $average, $department, $address1, $address2, $residence, $state, $zipcode, $email);
                        }                                                                                              

                        // Puedes agregar un mensaje de éxito o realizar alguna acción adicional si es necesario
                        $result = "Archivos CSV procesados correctamente.";
                    } else {
                        // Puedes manejar el caso en el que el archivo no sea de tipo texto
                        $result = "Error: El archivo debe ser de tipo texto (.txt).";
                    }
                } else {
                    // Puedes manejar el caso en el que no se haya subido ningún archivo
                    $result = "Error: No se ha seleccionado ningún archivo.";
                }
            }
            
        }

        // Parámetros de paginación
        $studentsPerPage = 8; // Cambia esto al número deseado
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

        //JAVIER (Add minors)
        $minors = $minorModel->getMinors($conn);
        //

        require_once(__DIR__ . '/../views/expedientesView.php');
    }
}

$expedientesController = new ExpedientesController();
$expedientesController->index();
?>
