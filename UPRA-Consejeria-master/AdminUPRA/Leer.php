<?php
require 'inc/connection.php';

$array = file("Expediente.txt");
// print_r($array);
    
$class = array();
    

foreach ($array as $item) {
    $parts = explode(";", $item);

    $res_sem = array(trim($parts[0]));
    $res_num = array(trim($parts[1]));
    $class_code_parts = explode('-', trim($parts[2]));
    $res_code = array($class_code_parts[0]);
    $res_grade = array(trim($parts[5]));

$Existe = "SELECT * FROM `student` WHERE stdnt_number = '{$res_num[0]}'";
$result_E = mysqli_query($conn, $Existe);
$resultCheck_E = mysqli_num_rows($result_E);  

    if($resultCheck_E > 0){
    $Clase = "SELECT *  FROM stdnt_record WHERE crse_code = '".$res_code[0]."' AND stdnt_number = '{$res_num[0]}'";
    $cohort_year = $row_E['cohort_year'];
    $result_C = mysqli_query($conn, $Clase);
    $resultCheck_C = mysqli_num_rows($result_C);  
         if($resultCheck_C > 0){
         $row_C = mysqli_fetch_assoc($result_C);
         if($row_C['crse_grade'] == 'A'){
          $grade_old = 1;
         }elseif ($row_C['crse_grade'] == 'P') {
          $grade_old = 2;
        }elseif ($row_C['crse_grade'] == 'B') {
          $grade_old = 3;
         }elseif ($row_C['crse_grade'] == 'C') {
          $grade_old = 5;
        }elseif ($row_C['crse_grade'] == 'D') {
          $grade_old = 7;
        }elseif ($row_C['crse_grade'] == 'F') {
          $grade_old = 10;
        }elseif ($row_C['crse_grade'] == 'NP') {
          $grade_old = 9;
        }elseif ($row_C['crse_grade'] == 'IB') {
          $grade_old = 4;
        }elseif ($row_C['crse_grade'] == 'IC') {
          $grade_old = 6;
        }elseif ($row_C['crse_grade'] == 'ID') {
          $grade_old = 8;
        }elseif ($row_C['crse_grade'] == 'IF') {
          $grade_old = 11;
        }

        if($res_grade[0] == 'A'){
          $grade_new = 1;
         }elseif ($res_grade[0] == 'P') {
          $grade_new = 2;
        }elseif ($res_grade[0] == 'B') {
          $grade_new = 3;
         }elseif ($res_grade[0] == 'C') {
          $grade_new = 5;
        }elseif ($res_grade[0] == 'D') {
          $grade_new = 7;
        }elseif ($res_grade[0] == 'F') {
          $grade_new = 10;
        }elseif ($res_grade[0] == 'NP') {
          $grade_new = 9;
        }elseif ($res_grade[0] == 'IB') {
          $grade_new= 4;
        }elseif ($res_grade[0] == 'IC') {
          $grade_new= 6;
        }elseif ($res_grade[0] == 'ID') {
          $grade_new = 8;
        }elseif ($res_grade[0] == 'IF') {
          $grade_new = 11;
        }
        
         if ($row_C['crse_grade'] == NULL || $grade_new < $grade_old){
            $sql = "UPDATE stdnt_record SET crse_grade = '".$res_grade[0]."', crse_status = 1 WHERE crse_code = 'CCOM3001' AND stdnt_number = '".$res_num[0]."'" ;
            // Prepare statement
            $stmt = $conn->prepare($sql);
            // execute the query
            $stmt->execute();
            echo $sql;
          }    
         
    } else {
      if($res_grade[0] != '') {
        $sql = "INSERT INTO stdnt_record (stdnt_number, crse_code, crse_grade, crse_status, semester_pass, crseR_status) 
        VALUES ('".$res_num[0]."','".$res_code[0]."', '".$res_grade[0]."', 1,'".$res_sem[0]."', 0)";
      }else {
        $sql = "INSERT INTO stdnt_record (stdnt_number, crse_code, crse_grade, crse_status, semester_pass, crseR_status) 
        VALUES ('".$res_num[0]."','".$res_code[0]."', '".$res_grade[0]."', 0,'".$res_sem[0]."', 0)";
      }
        // Prepare statement
        $stmt = $conn->prepare($sql);
        // execute the query
        $stmt->execute();
    } 
        
      $Subir_Free = "SELECT crse_code FROM mandatory_courses WHERE crse_code = '".$res_code[0]."'
                    UNION 
                    SELECT crse_code FROM general_courses   WHERE crse_code = '".$res_code[0]."'
                    UNION 
                    SELECT crse_code FROM general_education_huma WHERE crse_code = '".$res_code[0]."'
                    UNION 
                    SELECT crse_code FROM general_education_ciso WHERE crse_code = '".$res_code[0]."'
                    UNION 
                    SELECT crse_code FROM departmental_courses WHERE crse_code = '".$res_code[0]."'
                    UNION 
                    SELECT crse_code FROM free_courses WHERE crse_code = '".$res_code[0]."'";
                        $result_Free = mysqli_query($conn, $Subir_Free);
                        $resultCheck_Free = mysqli_num_rows($result_Free); 
                        $row_Free = mysqli_fetch_assoc($result_Free);
        if ($row_Free == 0 ){
            $sql = "INSERT INTO free_courses(crse_code, crse_description, crse_credits) VALUES('".$res_code[0]."',NULL, NULL)";
            // Prepare statement
            $stmt = $conn->prepare($sql);
            // execute the query
            $stmt->execute();
        }
}else {
  $error = 1;
}
}
if(isset($error)){
  //exit
  echo "
  <form id='error_form' method='POST' action='inicio.php'>
  <input type='hidden' name='error' value='No se pudo Subir Expediente : Estudiante No Existe!'>
  </form>
  <script>
  document.getElementById('error_form').submit();
  </script>";
  exit();
}else {
//exit
echo "
<form id='myForm' method='POST' action='inc/Cod_Recomendar.php'>
<input type='hidden' name='stdnt_number' value='".$res_num[0]."'>
</form>
<script>
document.getElementById('myForm').submit();
</script>";
exit();
}
?>