<?php
include("connection.php");

if(isset($_POST["stdnt_number"])){
  $student_id = $_POST['stdnt_number'];
} 

if(!isset($student_id)){
  header("Location: ../inicio.php");
    exit();
}

$query = "SELECT DISTINCT crse_major, cohort_year FROM student NATURAL JOIN cohort WHERE student.stdnt_number = '$student_id'";
$result = mysqli_query($conn, $query);
$resultCheck = mysqli_num_rows($result);
$isRecordPresentInDB = FALSE;

if($resultCheck > 0){
  $isRecordPresentInDB = TRUE;
  $row = mysqli_fetch_assoc($result);
  $cohort = $row['crse_major'];
  $cohort_year = $row['cohort_year'];
}

$mes = date("m");
if ($mes<7)
$semestre = 1;
else 
$semestre = 2;

$mydate=getdate(date("U"));
        if ($mydate[mon] < 10 && $mydate[mday] < 10) 
        $date = "$mydate[year]-0$mydate[mon]-0$mydate[mday]";
        else if($mydate[mon] < 10)
        $date = "$mydate[year]-0$mydate[mon]-$mydate[mday]";
        else if($mydate[mday] < 10)
        $date = "$mydate[year]-$mydate[mon]-0$mydate[mday]";
        else
        $date = "$mydate[year]-$mydate[mon]-$mydate[mday]";
 
$sql = "SELECT stdnt_number
        FROM student
        WHERE stdnt_number = '$student_id'";
                  $result = mysqli_query($conn, $sql);
                  $resultCheck = mysqli_num_rows($result);
                  $row = mysqli_fetch_assoc($result);
$est_year = date('Y')-(substr($row['stdnt_number'], 4,2) + 1999);

$sql_SA =  "SELECT crse_code, crse_year, crse_semester 
            FROM cohort
            WHERE crse_major = '$cohort'";
                      $result_SA = mysqli_query($conn, $sql_SA);
                      $resultCheck_SA = mysqli_num_rows($result_SA);

  if($resultCheck_SA > 0){
  while($row_SA = mysqli_fetch_assoc($result_SA)){
$sql_P =  "SELECT crse_code, crse_PRE
FROM cohort INNER JOIN scheme USING (crse_code,crse_major,cohort_year)
WHERE crse_code = '".$row_SA['crse_code']."' AND crse_major = '$cohort' AND cohort_year = $cohort_year";
                      $result_P = mysqli_query($conn, $sql_P);
                      $resultCheck_P = mysqli_num_rows($result_P); 

     $sql_GR = "SELECT crse_code, crse_grade
     FROM stdnt_record
     WHERE crse_code = '".$row_SA['crse_code']."' AND stdnt_number = '$student_id'";
     $result_GR = mysqli_query($conn, $sql_GR);
     $resultCheck_GR = mysqli_num_rows($result_GR);
     $Pre_disp = 0;
     $Cant_Nota = 0;

     if ($resultCheck_GR > 0){
       $row_GR = mysqli_fetch_assoc($result_GR);
    
      if (($row_SA['crse_year'] <= $est_year && ($row_SA['crse_semester'] == $semestre || $row_SA['crse_semester'] == 3)) && ($row_GR['crse_grade'] != "A" && $row_GR['crse_grade'] != "B" && $row_GR['crse_grade'] != "C" && $row_GR['crse_grade'] != "P")){            
         
        if($resultCheck_P > 0){
                      while($row_P = mysqli_fetch_assoc($result_P)){
                        $Pre_disp++;
                        $sql_PG =  "SELECT crse_code, crse_grade
                        FROM stdnt_record
                        WHERE crse_code = '".$row_P['crse_code']."' AND stdnt_number = '".$student_id."'";
                          $result_PG = mysqli_query($conn, $sql_PG);
                          $resultCheck_PG = mysqli_num_rows($result_PG);
                          $row_PG = mysqli_fetch_assoc($result_PG);
                            if($resultCheck_PG > 0){
                              if ($row_PG['crse_grade']=='A' || $row_PG['crse_grade']=='B' || $row_PG['crse_grade']=='C' || $row_PG['crse_grade']=='P')
                                  $Cant_Nota++;
                            } 
                              }    
                        } 
                      if ($Pre_disp ==  $Cant_Nota) {
                        $sql_rec = "UPDATE stdnt_record SET crse_status = 3, date_R = '$date' WHERE stdnt_number= '".$student_id."' AND crse_code = '".$row_SA['crse_code']."' "; 
                        // Prepare statement
                        $stmt = $conn->prepare($sql_rec);
                        // execute the query
                        $stmt->execute();
                      }
                    } 
                  }else {
                    if ($row_SA['crse_year'] <= $est_year && ($row_SA['crse_semester'] == $semestre || $row_SA['crse_semester'] == 3)){            
                      $sql_rec = "INSERT INTO stdnt_record (stdnt_number, crse_code, crse_status, date_R) 
                        VALUES ('".$student_id."','".$row_SA['crse_code']."', 3, '$date')";
                      // Prepare statement
                      $stmt = $conn->prepare($sql_rec);
                      // execute the query
                      $stmt->execute();
                    }
                  }
      }
                    
    }       
          //exit
    header("Location: ../inicio.php");
    exit();
 ?>