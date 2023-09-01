<?php
require('fpdf.php');
require('private/dbconnect.php');
session_start();
$id= $_SESSION['stdnt_number'];
$sql = "SELECT stdnt_name,stdnt_lastname1,stdnt_lastname2 FROM student WHERE stdnt_number = '$id'";
                 $result = mysqli_query($conn, $sql);
                 $resultCheck = mysqli_num_rows($result);
                 $nombre_est = mysqli_fetch_assoc($result);
$nombre = "{$nombre_est['stdnt_name']} {$nombre_est['stdnt_lastname1']} {$nombre_est['stdnt_lastname2']}";

$sql_cohorte = "SELECT stdnt_major FROM `student` WHERE stdnt_number = '$id'";
$result = mysqli_query($conn, $sql_cohorte);
$resultCheck = mysqli_num_rows($result);
if ($resultCheck > 0) {
  $row = mysqli_fetch_assoc($result);
  $cohort = $row['stdnt_major'];
}

class PDF extends FPDF
{
// Page header
function Header()
{
    global $nombre;
    // Logo
    $this->Image('photos/uprarecibo.png',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',18);
    // Move to the right
    $this->Cell(80);
    // Title
//    $this->SetTextColor(16,87,97);
    $this->Cell(30,10,utf8_decode('Expediente Académico: '),0,0,'C');
    $this->SetDrawColor(240, 220, 22);
    $this->SetLineWidth(2);
    $this->Line(60,$this->GetY() + 10,150, $this->GetY() + 10);
    $this->SetTextColor(0,0,0);
    // Line break
    $this->Ln();
    $this->Cell(80);
    $this->Ln();
    $this->SetFont('Arial','B',14);
    //$this->Cell(55,10,' ',0,0,'C');
    $this->Cell(200,10,utf8_decode("$nombre"),0,0,'C');
    $this->Ln(10);
    $this->Cell(200,10,utf8_decode('Cursos confirmados para el siguiente semestre Académico: '),0,0,'C');
    //$this->Cell(41,10,utf8_decode("$nombre"),0,0,'C');
    $this->Ln(10);
    $this->SetDrawColor(0,0,0);
    $this->SetFillColor(240, 220, 22);
    $this->SetLineWidth(0);
    $this->Cell(40, 10, 'Curso', 1, 0, 'C', 1);
    $this->Cell(105, 10,utf8_decode( 'Descripción'), 1, 0, 'C', 1);
    $this->Cell(27, 10,utf8_decode( 'Créditos'), 1, 0, 'C', 1);
    $this->Cell(15, 10, 'Nota', 1,1,'C',1);
    
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,12,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}

$consulta = "SELECT * FROM mandatory_courses INNER JOIN cohort USING (crse_code) WHERE crse_major = '$cohort' UNION
             SELECT * FROM general_courses INNER JOIN cohort USING (crse_code) WHERE crse_major = '$cohort'";

$confirmar = "SELECT crse_code,  crse_description, crse_credits, crse_grade
                FROM stdnt_record
                INNER JOIN mandatory_courses USING (crse_code)
                WHERE stdnt_record.stdnt_number = '$id' AND (stdnt_record.crse_status = 4)
                UNION(SELECT crse_code,  crse_description, crse_credits, crse_grade
                FROM stdnt_record
                INNER JOIN general_courses USING (crse_code)
                WHERE stdnt_record.stdnt_number = '$id' AND (stdnt_record.crse_status = 4))
                UNION(SELECT crse_code,  crse_description, crse_credits, crse_grade
                FROM stdnt_record
                INNER JOIN departmental_courses USING (crse_code)
                WHERE stdnt_record.stdnt_number = '$id' AND (stdnt_record.crse_status = 4))
                UNION(SELECT crse_code,  crse_description, crse_credits, crse_grade
                FROM stdnt_record
                INNER JOIN general_education_huma USING (crse_code)
                WHERE stdnt_record.stdnt_number = '$id' AND (stdnt_record.crse_status = 4))
                UNION(SELECT crse_code,  crse_description, crse_credits, crse_grade
                FROM stdnt_record
                INNER JOIN general_education_ciso USING (crse_code)
                WHERE stdnt_record.stdnt_number = '$id' AND (stdnt_record.crse_status = 4))
                UNION(SELECT crse_code,  crse_description, crse_credits, crse_grade
                FROM stdnt_record
                INNER JOIN free_courses USING (crse_code)
                WHERE stdnt_record.stdnt_number = '$id' AND (stdnt_record.crse_status = 4))
                ORDER BY crse_code";

$resultado1 = $conn->query($confirmar);
$resultado2 = $conn->query($consulta);

$pdf = new PDF();
$pdf-> AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',16);

while($row = $resultado1->fetch_assoc()){
    $pdf->SetFillColor(101, 236, 227);
    $pdf->Cell(40, 10, $row['crse_code'], 1, 0, 'C', 1);
    $pdf->Cell(105, 10,utf8_decode($row['crse_description']), 1, 0, 'C', 1);
    $pdf->Cell(27, 10, $row['crse_credits'], 1, 0, 'C', 1);
    $pdf->Cell(15, 10, '', 1, 1, 'C', 1);
}

$pdf->Ln(10);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetFillColor(240, 220, 22);
    $pdf->SetLineWidth(0);
    $pdf->Cell(40, 10, 'Curso', 1, 0, 'C', 1);
    $pdf->Cell(105, 10,utf8_decode( 'Descripción'), 1, 0, 'C', 1);
    $pdf->Cell(27, 10,utf8_decode( 'Créditos'), 1, 0, 'C', 1);
    $pdf->Cell(15, 10, 'Nota', 1,1,'C',1);

while($row = $resultado2->fetch_assoc()){
    $sql_S ="SELECT * FROM stdnt_record WHERE stdnt_number = '$id' AND crse_code = '{$row['crse_code']}'";
                      $result_S = mysqli_query($conn, $sql_S);
                      $resultCheck_S = mysqli_num_rows($result_S);
                      
    
    $pdf->SetFillColor(235,235,238);
    $pdf->Cell(40, 10, $row['crse_code'], 1, 0, 'C', 1);
    $pdf->Cell(105, 10,utf8_decode( $row['crse_description']), 1, 0, 'C', 1);
    $pdf->Cell(27, 10, $row['crse_credits'], 1, 0, 'C', 1);
     if($resultCheck_S != null){
         $row_S = mysqli_fetch_assoc($result_S);
         $pdf->Cell(15, 10, $row_S['crse_grade'], 1, 1, 'C', 1);
    }
    else {
        $pdf->Cell(15, 10, null, 1, 1, 'C', 1);
    }
    
}

$pdf->Output();
?>