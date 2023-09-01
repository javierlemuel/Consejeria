<?php
if (isset($_POST['rec-submit'])) {
require 'connection.php';
    $stdnt_number = mysqli_real_escape_string($conn, $_POST['stdnt_number']);
    $crse_code = mysqli_real_escape_string($conn, $_POST['crse_code']);

    $sql = "SELECT crse_code, crse_status FROM stdnt_record WHERE crse_code = '$crse_code' AND stdnt_number = '$stdnt_number'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);

    if($row['crse_status'] == 0){
        $crse_status = 3; 
    } else {
        $crse_status = 0; 
    }
    $mydate=getdate(date("U"));
        if ($mydate[mon] < 10 && $mydate[mday] < 10) 
        $date = "$mydate[year]-0$mydate[mon]-0$mydate[mday]";
        else if($mydate[mon] < 10)
        $date = "$mydate[year]-0$mydate[mon]-$mydate[mday]";
        else if($mydate[mday] < 10)
        $date = "$mydate[year]-$mydate[mon]-0$mydate[mday]";
        else
        $date = "$mydate[year]-$mydate[mon]-$mydate[mday]";

    if($resultCheck > 0){
    $sql = "UPDATE stdnt_record SET crse_status = $crse_status, date_R = '$date' 
    WHERE stdnt_number = '$stdnt_number' AND crse_code = '$crse_code'";
    // Prepare statement
    $stmt = $conn->prepare($sql);
    // execute the query
    $stmt->execute();
    //exit
   header("Location: ../est_profile.php?stdnt_number=" . $stdnt_number);
    exit();
    } else {
        $sql = "INSERT INTO stdnt_record (stdnt_number, crse_code, crse_status, date_R) 
        VALUES ('$stdnt_number','$crse_code', 3, '$date')";
    // Prepare statement
    $stmt = $conn->prepare($sql);
    // execute the query
    $stmt->execute();
    //exit
   header("Location: ../est_profile.php?stdnt_number=" . $stdnt_number);

    exit();
    }
}
?>