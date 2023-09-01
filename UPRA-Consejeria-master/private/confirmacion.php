<?php
session_start();
if (isset($_POST['confirm-submit'])) {
require 'dbconnect.php';
    $stdnt_number = $_SESSION['stdnt_number'];
    $ids = $_POST['crse_code'];

  
    if (count($ids) > 0) { 
      foreach ($ids as $crse_code) {  
        $sql = "SELECT crse_code FROM stdnt_record
          WHERE stdnt_number = '$stdnt_number' AND crse_code = '$crse_code'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck > 0){
          $sql = "UPDATE stdnt_record SET crse_status = 4 WHERE crse_code = '$crse_code' AND stdnt_number = '$stdnt_number'";
                  // Prepare statement
                  $stmt = $conn->prepare($sql);
                  // execute the query
                  $stmt->execute();
        }else {
          $sql = "INSERT INTO stdnt_record (stdnt_number, crse_code, crse_status)
                  VALUES ('$stdnt_number', '$crse_code', 4)";
                  // Prepare statement
                  $stmt = $conn->prepare($sql);
                  // execute the query
                  $stmt->execute();
        }
        
                  //exit
      }

    }
    $sql = "UPDATE record_details SET conducted_counseling = 1 WHERE stdnt_number = '$stdnt_number'";
                  // Prepare statement
                  $stmt = $conn->prepare($sql);
                  // execute the query
                  $stmt->execute();
      header("Location: ../consejeria.php");
                  exit();
    }

?>