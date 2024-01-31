<?php
if(!isset($_SESSION['authenticated']) && $_SESSION['authenticated'] !== true)
{
    header("Location: ../index.php");
    exit;
}
require_once(__DIR__ . '/../models/ClassModel.php');
require_once(__DIR__ . '/../config/database.php');

//echo"hey";

class ClassController{
    public function index() {   
        if(isset($_GET['class'])) {
            $course = $_GET['class'];
            global $conn;
            $classModel = new ClassModel();
    
            $class = $classModel->getCourse($conn, $course);
            $minors = $classModel->getMinors($conn);
    
            require_once(__DIR__ . '/../views/classView.php');
        }

        elseif(isset($_GET['edit']))
        {
            if((strpos($_POST['code'], 'CCOM') !== false))
            {
                global $conn;
                $old_course_id = $_POST['oldcode'];
                $course_id = $_POST['code'];
                $course_name = $_POST['name'];
                $credits = $_POST['cred'];
                $type = $_POST['type'];
                $level = $_POST['level'];

                $classModel = new ClassModel();

                $classModel->updateCourse($conn, $old_course_id, $course_id, 
                                            $course_name, $credits, $type, $level);
            }
            else
            {
                global $conn;
                $old_course_id = $_POST['oldcode'];
                $course_id = $_POST['code'];
                $course_name = $_POST['name'];
                $credits = $_POST['cred'];
                $type = $_POST['type'];
                $required = $_POST['required'];

                $classModel = new ClassModel();

                $classModel->updateGeneralCourse($conn, $old_course_id, $course_id, 
                $course_name, $credits, $type, $required);
            }

            //require_once('../?classes');
            header('Location: ?classes');
            die;
        }

        elseif(isset($_GET['editReqs']))
        {
            global $conn;
            $classModel = new ClassModel();

            $course = $_POST['course'];
            if((strpos($course, 'CCOM') !== false)) 
                $table = 'ccom_requirements';
            else    
                $table = 'general_requirements';

            if($_POST['action'] == 'edit')
            {
                if(isset($_POST['req']))
                    $req = $_POST['req'];
                else    
                    $req = 'none';

                if(isset($_POST['old_req']))
                    $oldreq = $_POST['old_req'];
                else  
                    $oldprereq = 'none';

                $cohort = $_POST['cohort'];
                $oldcohort = $_POST['oldcohort'];
                $type = $_POST['type'];

                $message = $classModel->editRequisites($conn, $course, $table, $req, $oldreq, $cohort, $oldcohort, $type);
            }   

            elseif($_POST['action'] == 'delete')
            {
                $req = $_POST['old_req'];
                $cohort = $_POST['oldcohort'];

                $message = $classModel->deleteReq($conn, $course, $req, $cohort, $table);
            }

            

            $class = $classModel->getCourse($conn, $course);
    
            require_once(__DIR__ . '/../views/classView.php');
        }

        elseif(isset($_GET['addReq']))
        {
            global $conn;
            $classModel = new ClassModel(); 

            $course = $_POST['course'];
            $req = $_POST['req'];
            $cohort = $_POST['cohort'];
            $type = $_POST['type'];

            if((strpos($course, 'CCOM') !== false)) 
                $table = 'ccom_requirements';
            else    
                $table = 'general_requirements';

            $message = $classModel->addReq($conn, $course, $req, $cohort, $type, $table);

            $class = $classModel->getCourse($conn, $course);
    
            require_once(__DIR__ . '/../views/classView.php');
        }
       
    }


    public function getRequisitos($course)
    {
        global $conn;
        $classModel = new ClassModel();

        if((strpos($course, 'CCOM') !== false)) 
            $table = 'ccom_requirements';
        else    
            $table = 'general_requirements';

        $requisitos = $classModel->getRequisitosModel($conn, $table, $course);

        

        return $requisitos;



    }
}

$classController = new ClassController();
$classController->index();

?>