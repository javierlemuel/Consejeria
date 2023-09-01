<?php
if (isset($_POST['minor-submit'])) {
session_start();
require 'connection.php';
    $minor = mysqli_real_escape_string($conn, $_POST['minor-submit']);
    $student_id = $_SESSION['stdnt_number'];

    $sql = "UPDATE student SET stdnt_minor = $minor WHERE stdnt_number = '$student_id'";
    echo $sql;
    // Prepare statement
    $stmt = $conn->prepare($sql);
    // execute the query
    $stmt->execute();
    //exit
    header("Location: ../est_profile.php");
    exit();
    
}
?>