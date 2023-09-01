<?php
if (isset($_POST['add-submit'])) {
require 'connection.php';
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $credits = mysqli_real_escape_string($conn, $_POST['creditos']);
    $tabla = mysqli_real_escape_string($conn, $_POST['tabla']);
    echo $tabla, $course, $description, $credits;
    if($tabla == 'free_courses'){
    $sql = "SELECT crse_code FROM free_courses WHERE crse_name = '$course'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck != 1){
    $sql = "INSERT INTO free_courses ( crse_description, crse_credits, crse_id) VALUES ('$course', '$description', $credits, 7)";
    // Prepare statement
    $stmt = $conn->prepare($sql);
    // execute the query
    $stmt->execute();
    //exit
    header("Location: ../inicio.php");
    exit();
    }
}
}
?>