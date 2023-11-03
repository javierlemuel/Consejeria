<?php
require_once(__DIR__ . '/../models/ClassesModel.php');
require_once(__DIR__ . '/../config/database.php');


class ClassesController{
    public function index() {
        global $conn;
        $classesModel = new ClassesModel();

        if(isset($_GET['ccomelectives'])){
            $courses = $classesModel->getCcomElectives($conn);
            $category = 'electivas';
        }

        elseif(isset($_GET['generalclasses'])){
            $courses = $classesModel->getGeneralCourses($conn);
            $category = 'generales';
        }

        elseif(isset($_GET['offer'])){
            $courses = $classesModel->getOfferCourses($conn);
            $term = $classesModel->getTerm($conn);
            $category = 'oferta';
        }

        elseif(isset($_GET['addOffer']) && isset($_GET['code']))
        {
            $courseID = $_GET['code'];
            $message = $classesModel->addToOffer($conn,$courseID);
            $courses = $classesModel->getCcomCourses($conn);
            $category = 'concentracion';
            header('Location: ?classes&message='.$message);
            die;
        }

        elseif(isset($_GET['removeOffer']) && isset($_GET['code']))
        {
            $courseID = $_GET['code'];
            $classesModel->removeFromOffer($conn,$courseID);
            $courses = $classesModel->getOfferCourses($conn);
            $term = $classesModel->getTerm($conn);
            $category = 'oferta';
            header('Location: ?offer');
            die;
        }

        elseif(isset($_GET['newterm']))
        {
            if(isset($_POST['term']))
            {
                $term = $_POST['term'];
                $classesModel->setNewTerm($conn, $term);
            }
            else    
                $term = $classesModel->getTerm($conn);


            $courses = $classesModel->getOfferCourses($conn);
            $category = 'oferta';
            header('Location: ?offer');
            die;
        }

        else //isset 'classes'
        {
            $courses = $classesModel->getCcomCourses($conn);
            $category = 'concentracion';
        }

        require_once(__DIR__ . '/../views/classesView.php');
    }

    public function getMatriculados($course)
    {
        global $conn;
        $classesModel = new ClassesModel();
        return $classesModel->getMatriculadosModel($conn, $course); 
    }
}

$classesController = new ClassesController();
$classesController->index();

// if (isset($_GET['callController'])) {
//     $classesController = new classesController();
//     $classesController->index();
// }
?>