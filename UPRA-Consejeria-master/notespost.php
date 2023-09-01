<?php
if (isset($_POST['notes-submit'])) {
require 'connection.php';
    $stdnt_number = mysqli_real_escape_string($conn, $_POST['stdnt_number']);
    $crse_name = mysqli_real_escape_string($conn, $_POST['crse_name']);
    $crseR_status = mysqli_real_escape_string($conn, $_POST['crseR_status']); 

            if($crseR_status == 0){
                $sql = "UPDATE stdnt_record SET crseR_status = 1 WHERE stdnt_number = $stdnt_number AND crse_name = '$crse_name'";
            }else{
                $sql = "UPDATE stdnt_record SET crseR_status = 0 WHERE stdnt_number = $stdnt_number AND crse_name = '$crse_name'";
            }
            // Prepare statement
            $stmt = $conn->prepare($sql);
            // execute the query
            $stmt->execute();
            //exit
            header("Location: ../est_prostdnt_record.php");
            exit();
    
    }
else {
    header("Location: ../est_prostdnt_record.php");
    exit();
}
?>