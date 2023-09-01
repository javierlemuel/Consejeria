<?php
include 'dbconnect.php';

$stmt = $conn->prepare("SELECT appt_date FROM appointment WHERE stdnt_number = ?");

$stmt->bind_param('i', $_SESSION['stdnt_number']);

$stmt->execute();

$stmt->store_result();
  
$isAppointmentValid = FALSE;

if ($stmt->num_rows > 0) {
    $stmt->bind_result($appt_date);
    $stmt->fetch();
    
    $current_date= date_create();
    $current_date = date_format($current_date,"Y-m-d H:i:s");
   

    if($appt_date > $current_date){
        $isAppointmentValid  = TRUE;
       
    } else {
         // DELETE APPOINTMENT FROM DATABASE
         $stmt = $conn->prepare("DELETE FROM appointment WHERE stdnt_number = ?");

         $stmt->bind_param('i', $_SESSION['stdnt_number']);

         $stmt->execute();
    }
    
}

$stmt->close();