<?php
if (isset($_POST['activate'])){
require 'connection.php';
    $stdnt_number = $_POST['activate'];

    $sql = "UPDATE record_details SET conducted_counseling = 0 WHERE stdnt_number = '$stdnt_number'";
    // Prepare statement
    $stmt = $conn->prepare($sql);
    // execute the query
    $stmt->execute();

    $sql= "SELECT crse_code, date_R FROM `stdnt_record` WHERE stdnt_number = '$stdnt_number' AND crse_status = 4";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    
            if($resultCheck > 0){
                while ($row = mysqli_fetch_assoc($result)){
                    if ($row['date_R'] != NULL){
                        $sql = "UPDATE stdnt_record SET crse_status = 3 WHERE crse_code = '{$row['crse_code']}'";
                    }else { 
                            $sql = "UPDATE stdnt_record SET crse_status = 0 WHERE crse_code = '{$row['crse_code']}'";
                    }
                }
            }
    // Prepare statement
    $stmt = $conn->prepare($sql);
    // execute the query
    $stmt->execute();
    //exit
    header("Location: ../est_profile.php");
    exit();
}
?>