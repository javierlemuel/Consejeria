<?php
session_start();
if (isset($_POST['status-submit'])) {
require 'connection.php';
    $stdnt_number = mysqli_real_escape_string($conn, $_POST['stdnt_number']);
    $status = mysqli_real_escape_string($conn, $_POST['status-submit']);

    $sql = "UPDATE record_details SET record_status = $status WHERE stdnt_number = '$stdnt_number'";
    // Prepare statement
    $stmt = $conn->prepare($sql);
    // execute the query
    $stmt->execute();
    //exit
    header("Location: ../inicio.php");
    exit();

}

?>