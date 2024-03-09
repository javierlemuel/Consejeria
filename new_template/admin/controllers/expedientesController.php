<?php
if(!isset($_SESSION['authenticated']) && $_SESSION['authenticated'] !== true)
{
    header("Location: ../index.php");
    exit;
}
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
                if($success == TRUE)
                {
                    $mensaje = "studentAdded";
                }
                else
                {
                    $mensaje = "studentNotAdded";
                }
            }
            elseif ($action === 'selecteStudent')
            {
                $student_num = $_POST['student_num'];
                $studentData = $studentModel->selectStudent($student_num, $conn);
                $minors = $minorModel->getMinors($conn);
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
                $archivoRegistro = __DIR__ . '/archivo_de_registro.txt';

                // info del estudiatne
                $student_num = $_POST['student_num'];
                $studentData = $studentModel->selectStudent($student_num, $conn);
                $studentCohort = $studentData['cohort_year'];
                $studentRecommendedTerms = $studentModel->studentRecommendedTerms($student_num, $conn);
                if(isset($_POST['selectedTerm']) && !empty($_POST['selectedTerm'])) {
                    $selectedTerm = $_POST['selectedTerm']; // term seleccionado en el select de counseling view
                    $studentRecommendedClasses = $studentModel->studentRecommendedClasses($student_num, $selectedTerm, $conn); // clases recomendadas en ese term
                }
                else{
                    $studentRecommendedClasses = NULL;
                }
                // variables para las notas
                $ccomByCohort = $classesModel->getCohortCoursesWgradesCCOM($conn, $studentCohort, $student_num);
                $ccomFreeByNotCohort = $classesModel->getCohortCoursesWgradesCCOMfree($conn, $studentCohort, $student_num);
                $notccomByCohort = $classesModel->getCohortCoursesWgradesNotCCOM($conn, $studentCohort, $student_num);
                $notccomByNotCohort = $classesModel->getCohortCoursesWgradesNotCCOMfree($conn, $studentCohort, $student_num);
                $otherClasses = $classesModel->getAllOtherCoursesWgrades($conn, $student_num);

                // variables para las recomendaciones
                $mandatoryClasses = $classesModel->getCcomCourses($conn);
                $dummyClasses = $classesModel->getDummyCourses($conn);
                $generalClasses = $classesModel->getGeneralCourses($conn);

                require_once(__DIR__ . '/../views/counselingView.php');
                return;
            }
            elseif ($action === 'uploadCSV')
            {
                $archivoRegistro = __DIR__ . '/archivo_de_registro.txt';

                $currentDateTime = date("Y-m-d H:i:s");
                $logMessage = "\n" . $currentDateTime . "\n";
                error_log($logMessage, 3, $archivoRegistro);

                // Verificamos si se han subido archivos
                if (!empty($_FILES['files']['name']) && !empty($_FILES['files2']['name'])) {
                    $file_tmp = $_FILES['files']['tmp_name'];
                    $file_tmp2 = $_FILES['files2']['tmp_name'];
                
                    // Validamos que el primer archivo sea de tipo texto
                    if ($_FILES['files']['type'] == "text/plain") {
                        // Leemos el contenido del primer archivo CSV
                        $file_content = file_get_contents($file_tmp);
                
                        // Dividimos el contenido por líneas
                        $lines = explode("\n", $file_content);
                
                        // Leemos el contenido del segundo archivo CSV
                        $file_content2 = file_get_contents($file_tmp2);
                        $lines2 = explode("\n", $file_content2);
                        $birthdays = [];
                
                        foreach ($lines2 as $line2) {
                            $data2 = explode(",", $line2);
                            $student_num2 = trim($data2[0]);
                            $birthday = trim($data2[count($data2) - 2]); // Asumiendo que la fecha de nacimiento está en el penúltimo índice
                
                            // Almacenar la fecha de nacimiento asociada al número de estudiante
                            $birthdays[$student_num2] = $birthday;
                        }
                        
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
                        
                            $email = trim($data[12]);

                            // Obtener la fecha de nacimiento del array $birthdays si está disponible
                            $birthdate = isset($birthdays[$student_num]) ? $birthdays[$student_num] : '';

                            //hacer que los nombre comienzen con letra mayuscula y el resto sea minusculas.
                            $nombre = ucwords(strtolower($nombre));
                            $segundo_nombre = ucwords(strtolower($segundo_nombre));
                            $apellido_paterno = ucwords(strtolower($apellido_paterno));
                            $apellido_materno = ucwords(strtolower($apellido_materno));
                            $email = strtolower($email) . "@upr.edu";
                            
                            if($birthdate != '')
                            {
                                $student = $studentModel->selectStudent($student_num, $conn);
                                if($student != NULL)
                                {
                                    error_log("El estudiante: " . $student_num . " ya existia en la base de datos. \n", 3, $archivoRegistro);
                                }
                                else
                                {
                                    // Llamamos a la función del modelo para insertar el estudiante
                                    $studentModel->insertStudentCSV($conn, $student_num, $nombre, $segundo_nombre, $apellido_materno, $apellido_paterno, $email, $birthdate);
                                    $archivoRegistroModel = __DIR__ . '/../models/archivo_de_registro.txt';
                                }
                            }
                            else
                            {
                                error_log("El estudiante: " . $student_num . " no tiene fecha de nacimiento \n", 3, $archivoRegistro);
                            }   
                        }                                                                                                                      
                        //exito
                        $result = "Archivos CSV procesados correctamente.";
                        error_log("Archivos procesados correctamente \n", 3, $archivoRegistro);
                    } else {
                        // el archivo no es .txt
                        $result = "Error: El archivo debe ser de tipo texto (.txt).";
                        error_log("El archivo debe ser tipo texto \n", 3, $archivoRegistro);
                    }
                } else {
                    // no se mando ningun arhivo o solo 1
                    $result = "Error: No se ha seleccionado ningún archivo.";
                    error_log("No se a seleccionado ningun archivo \n", 3, $archivoRegistro);
                }
            }
            elseif ($action === 'makecounseling')
            {
                require_once(__DIR__ . '/../models/ClassesModel.php');
                $classesModel = new ClassesModel();

                $archivoRegistro = __DIR__ . '/archivo_de_registro.txt';

                $currentDateTime = date("Y-m-d H:i:s");
                $logMessage = "\n" . $currentDateTime . "\n";
                error_log($logMessage, 3, $archivoRegistro);

                $student_num = $_POST['student_num'];
                $term = $classesModel->getTerm($conn);

                if (isset($_POST['seleccion']) && is_array($_POST['seleccion']))
                {
                    // Obtiene los valores de los checkboxes seleccionados
                    $selectedClasses = $_POST['seleccion'];

                    foreach ($selectedClasses as $class)
                    {
                        $result = $studentModel->alreadyRecomended($student_num, $class, $term, $conn);

                        if($result == TRUE)
                        {
                            error_log("La clase $class ya estaba recomendada para este semestre. \n", 3, $archivoRegistro);
                        }
                        else
                        {
                            $results = $studentModel->insertRecomendation($student_num, $class, $term, $conn);
                            if($results == TRUE)
                            {
                                error_log("La clase $class se anadio a recommended courses. \n", 3, $archivoRegistro);
                            }
                            else
                            {
                                error_log("Hubo un error insertando la clase. \n", 3, $archivoRegistro);
                            }
                        }
                    }
                }
                else
                {
                    // No se seleccionaron clases
                    error_log("No se seleccionaron clases \n", 3, $archivoRegistro);
                }

                $studentData = $studentModel->selectStudent($student_num, $conn);
                $studentCohort = $studentData['cohort_year'];

                $ccomByCohort = $classesModel->getCohortCoursesWgradesCCOM($conn, $studentCohort, $student_num);
                $ccomFreeByNotCohort = $classesModel->getCohortCoursesWgradesCCOMfree($conn, $studentCohort, $student_num);
                $notccomByCohort = $classesModel->getCohortCoursesWgradesNotCCOM($conn, $studentCohort, $student_num);
                $notccomByNotCohort = $classesModel->getCohortCoursesWgradesNotCCOMfree($conn, $studentCohort, $student_num);
                $otherClasses = $classesModel->getAllOtherCoursesWgrades($conn, $student_num);

                $mandatoryClasses = $classesModel->getCcomCourses($conn);
                $dummyClasses = $classesModel->getDummyCourses($conn);
                $generalClasses = $classesModel->getGeneralCourses($conn);

                require_once(__DIR__ . '/../views/counselingView.php');
                return;
            }
            elseif ($action === 'updateGrade')
            {
                require_once(__DIR__ . '/../models/ClassModel.php');
                $classModel = new ClassModel();
                require_once(__DIR__ . '/../models/ClassesModel.php');
                $classesModel = new ClassesModel();

                $archivoRegistro = __DIR__ . '/archivo_de_registro.txt';

                $currentDateTime = date("Y-m-d H:i:s");
                $logMessage = "\n" . $currentDateTime . "\n";
                error_log($logMessage, 3, $archivoRegistro);

                $student_num = $_POST['student_num'];
                $course_code = $_POST['crse_code'];
                $grade = $_POST['grade'];
                $equi = $_POST['equivalencia'];
                $conva = $_POST['convalidacion'];

                $term = $classesModel->getTerm($conn);
                $course_info = $classModel->selectCourse($conn, $course_code);
                $credits = $course_info['credits'];
                $type = $course_info['type'];

                $result = $studentModel->studentAlreadyHasGrade($student_num, $course_code, $conn);

                if($result == TRUE)
                {
                    $studentModel->UpdateStudentGrade($student_num, $course_code, $grade, $equi, $conva, $credits, $term, $type, $conn);
                }
                else
                {
                    $studentModel->InsertStudentGrade($student_num, $course_code, $grade, $equi, $conva, $credits, $term, $type, $conn);
                }

                $studentData = $studentModel->selectStudent($student_num, $conn);
                $studentCohort = $studentData['cohort_year'];

                $ccomByCohort = $classesModel->getCohortCoursesWgradesCCOM($conn, $studentCohort, $student_num);
                $ccomFreeByNotCohort = $classesModel->getCohortCoursesWgradesCCOMfree($conn, $studentCohort, $student_num);
                $notccomByCohort = $classesModel->getCohortCoursesWgradesNotCCOM($conn, $studentCohort, $student_num);
                $notccomByNotCohort = $classesModel->getCohortCoursesWgradesNotCCOMfree($conn, $studentCohort, $student_num);
                $otherClasses = $classesModel->getAllOtherCoursesWgrades($conn, $student_num);

                $mandatoryClasses = $classesModel->getCcomCourses($conn);
                $dummyClasses = $classesModel->getDummyCourses($conn);
                $generalClasses = $classesModel->getGeneralCourses($conn);

                require_once(__DIR__ . '/../views/counselingView.php');
                return;
            }
            elseif ($action === 'updateGradeCSV')
            {
                $archivoRegistro = __DIR__ . '/archivo_de_registro.txt';

                $currentDateTime = date("Y-m-d H:i:s");
                $logMessage = "\n" . $currentDateTime . "\n";
                error_log($logMessage, 3, $archivoRegistro);

                // Verificamos si se han subido archivos
                if (!empty($_FILES['files']['name']))
                {
                    // Obtén el archivo temporal subido
                    $tmpName = $_FILES['files']['tmp_name'];

                    // Abre el archivo para leer
                    $file = fopen($tmpName, 'r');

                    // Itera sobre cada línea del archivo
                    while (($line = fgetcsv($file)) !== FALSE)
                    {
                        // Asigna cada dato a una variable
                        $semester = $line[0];
                        $studentNumber = $line[1];
                        //le quita los guiones al numero de estudiantes.
                        $studentNumber = str_replace("-", "", $studentNumber);
                        $class = $line[2];
                        //Se toman solo los primeros 8 caracteres de la clase ya que el archivo incluye las secciones y no nos interesa esa informacion
                        $class = substr($class, 0, 8);
                        $creditAmount = $line[3];
                        $grade = $line[5];

                        $studentData = $studentModel->selectStudent($studentNumber, $conn);
                        // El estudiante no existe en la base de datos.
                        if ($studentData == NULL)
                        {
                            error_log("El estudiante: " . $studentNumber . " no existe en la base de datos.\n", 3, $archivoRegistro);
                        }
                        else
                        {
                            if($creditAmount != 0)
                            {
                                $result = $studentModel->studentAlreadyHasGrade($studentNumber, $class, $conn);
                                //el estudiante ya tiene una nota en esa clase
                                if ($result == TRUE)
                                {
                                    error_log("Nota del estudiante " . $studentNumber . "en la clase " . $class . " fue actualizada\n", 3, $archivoRegistro);
                                    $equi = "";
                                    $conva = 0;
                                    $type = "mandatory";
                                    $result = $studentModel->UpdateStudentGrade($studentNumber, $class, $grade, $equi, $conva, $creditAmount, $semester, $type, $conn);
                                }
                                else // el estudiante no tiene una nota en esa clase.
                                {
                                    error_log("Nota del estudiante " . $studentNumber . "en la clase " . $class . " fue insertada\n", 3, $archivoRegistro);
                                    $equi = "";
                                    $conva = 0;
                                    $type = "mandatory";
                                    $result = $studentModel->InsertStudentGrade($studentNumber, $class, $grade, $equi, $conva, $creditAmount, $semester, $type, $conn);
                                }
                            }
                        }
                    }

                    // Cierra el archivo
                    fclose($file);
                }
            }
        }

        // Parámetros de paginación
        $studentsPerPage = 9; // Cambia esto al número deseado
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


        if(isset($archivoRegistro))
        {
            $fileContent = file_get_contents($archivoRegistro);
            $_SESSION['registertxt'] = $fileContent;
        }


        if(isset($archivoRegistroModel))
        {
            $fileContentModel = file_get_contents($archivoRegistroModel);

            if($fileContentModel != "")
                $_SESSION['registermodeltxt'] = $fileContentModel;
        }
        
        require_once(__DIR__ . '/../views/expedientesView.php');
    }
}

$expedientesController = new ExpedientesController();
$expedientesController->index();
?>
