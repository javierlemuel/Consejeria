<?php
if(!isset($_SESSION['authenticated']) && $_SESSION['authenticated'] !== true)
{
    header("Location: ../index.php");
    exit;
}
require_once(__DIR__ . '/../models/ReporteModel.php');
require_once(__DIR__ . '/../config/database.php');

class ReporteController{
    public function index() {   
        global $conn;
        $reporteModel = new ReporteModel();

        $studentsAconsejados = $reporteModel->getStudentsAconsejados($conn);
        $studentsSinCCOM = $reporteModel->getStudentsSinCCOM($conn);
        $studentsRegistrados = $reporteModel->getRegistrados($conn);
        $studentsEditados = $reporteModel->getEditados($conn);
        $studentsPerClass = $reporteModel->getStudentsPerClass($conn);
        $term = $reporteModel->getTerm($conn);
        $count = 0;

        if(isset($_GET['code']))
        {
            $type = $_GET['code'];

            $studentsInfo = $reporteModel->getStudentsInfo($conn, $type);
            // Data array for the second table
            $TableData = [];
            if (isset($studentsInfo)) {
                foreach ($studentsInfo as $s) {
                    $TableData[] = [$s['student_num'], $s['full_name']];
                }
            }

            $combinedCsvContent = "Num de estudiante,Nombre\n";
                foreach ($TableData as $row) {
                    $combinedCsvContent .= implode(',', $row) . "\n";
                }

            $_SESSION['csv_content'] = $combinedCsvContent;
            if($type == 'consCCOM')
                $combinedCsvFileName = "Report_Aconsejados_".$term.".csv";
            else if($type == 'consSinCCOM')
                $combinedCsvFileName = "Report_Aconsejados_Sin_CCOM_".$term.".csv";
            $_SESSION['filename'] = $combinedCsvFileName;

        }

        require_once(__DIR__ . '/../views/reporteView.php');

    }
}

$reporteController = new ReporteController();
$reporteController->index();

?>