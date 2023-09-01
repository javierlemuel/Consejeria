<?php
if (isset($_POST['conv_env-submit'])) {
require 'dbconnect.php';
    $estatus = mysqli_real_escape_string($conn, $_POST['estatus']);
    $stdnt_number = mysqli_real_escape_string($conn, $_POST['stdnt_number']);
    $crse_code = mysqli_real_escape_string($conn, $_POST['conv_env-submit']);

    $sql = "SELECT crseR_status FROM stdnt_record WHERE stdnt_number = '$stdnt_number' 
    AND crse_code = '$crse_code'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    echo $sql;
              
                if($resultCheck > 0){
                    $sql = "UPDATE stdnt_record SET crseR_status = $estatus 
                    WHERE stdnt_number = '$stdnt_number' AND crse_code = '$crse_code'";    
            
            // Prepare statement
            $stmt = $conn->prepare($sql);
            // execute the query
            $stmt->execute();
            //exit
            header("Location: ../consejeria.php");
            exit();
        }
        }else {
   header("Location: ../consejeria.php");
   exit();
}
?>