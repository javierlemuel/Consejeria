<?php
require_once(__DIR__ . '/../models/CohorteModel.php');
require_once(__DIR__ . '/../config/database.php');


class CohorteController{
    public function index(){
       global $conn;
       $cohorteModel = new CohorteModel();

       $cohortes = [];

       $result = $cohorteModel->getCohorteYears($conn);

       foreach ($result as $r)
           $cohortes[] = $r['cohort_year'];

       require_once(__DIR__ . '/../views/cohortesView.php');
    }

    public function viewCohorte($message)
    {
        global $conn;
        $cohorteModel = new CohorteModel();

        if(isset($_GET['cohort']) && isset($_GET['year']))
        {
            $cohort = $_GET['cohort'];
            $year = $_GET['year'];

            $firstSem  = $cohorteModel->getFirstSem($conn, $cohort, $year);
            $secondSem  = $cohorteModel->getSecondSem($conn, $cohort, $year);

            if($year == 1)
                $category = 'primer';
            else if($year == 2)
                $category = 'segundo';
            else if($year == 3)
                $category = 'tercer';
            else if($year == 4)
                $category = 'cuarto';

            require_once(__DIR__ . '/../views/cohorteView.php');
        }
    }

    public function removeFromCohorte()
    {
        global $conn;
        $cohorteModel = new CohorteModel();

        if(isset($_GET['cohort']) && isset($_GET['courseID']) && isset($_GET['year']))
        {
            $cohort = $_GET['cohort'];
            $courseID = $_GET['courseID'];
            $year = $_GET['year'];

            $cohorteModel->removeFromCohorteModel($conn, $cohort, $courseID);

            header('Location: ?cohort='.$cohort.'&year='.$year);
                die;
        }
        else
            header('Location: ?cohort');
    }

    public function addToCohorte()
    {
        global $conn;
        $cohorteModel = new CohorteModel();

        $cohort = $_GET['cohort'];

        $course = $_POST['course'];
        $year = $_POST['year'];
        $semester = $_POST['semester'];
        $type = $_POST['type'];

        $message = $cohorteModel->addToCohorteModel($conn, $cohort, $course, $year, $semester, $type);

        header('Location: ?cohort='.$cohort.'&year=1&message='.$message);
        die;
    }

    public function getCohorteReq($cohort)
    {
        global $conn;
        $cohorteModel = new CohorteModel();

        return $cohorteModel->getCohorteReqModel($conn, $cohort);

    }


    public function editCohorteReq(){
        global $conn;
        $cohorteModel = new CohorteModel();

        $cohort = intval($_GET['cohort']);
        $dept = intval($_POST['dept']);
        $libre = intval($_POST['free']);
        $huma = intval($_POST['huma']);
        $ciso = intval($_POST['ciso']);
        $int = intval($_POST['int']);
        $avz = intval($_POST['avz']);

        $cohorteModel->editCohorteReqModel($conn, $cohort, $dept, $libre, $huma, $ciso, $int, $avz);

        header('Location: ?cohort='.$cohort.'&year=1');
        die;
    }

    public function newCohorte()
    {
        global $conn;
        $cohorteModel = new CohorteModel();
        $cohort = $_POST['cohort'];

        $message = $cohorteModel->createCohorte($conn, $cohort);

        header('Location: ?cohort&message='.$message);
        die;
    }
}


$cohorteController = new CohorteController();
//$cohorteController->index();

if(isset($_GET['cohort']) && isset($_GET['courseID']) && isset($_GET['year']))
    $cohorteController->removeFromCohorte();
else if(isset($_GET['cohort']) && isset($_GET['year']))
    $cohorteController->viewCohorte('...');
else if(isset($_GET['cohort']) && isset($_GET['addToCohort']))
    $cohorteController->addToCohorte();
else if(isset($_GET['cohort']) && isset($_GET['editCohortReq']))
    $cohorteController->editCohorteReq();
else if(isset($_GET['newcohort']))
    $cohorteController->newCohorte();
else if (isset($_GET['cohort']))
    $cohorteController->index();