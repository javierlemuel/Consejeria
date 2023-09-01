<?php
if (isset($_POST['edit_crse-submit'])) {
require '../../private/dbconnect.php';
session_start();

    $stdnt_number = $_SESSION['stdnt_number'];
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $grade = mysqli_real_escape_string($conn, $_POST['grade']);
    $semester = mysqli_real_escape_string($conn, $_POST['semester']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
    $creditos = mysqli_real_escape_string($conn, $_POST['creditos']);

    
        $sql = "SELECT crse_code, semester_pass, crse_grade FROM stdnt_record WHERE crse_code = '$course'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);   

        if($resultCheck > 0){
            $row = mysqli_fetch_assoc($result);
            if ($grade == '') {
                $grade = $row['crse_grade'];
            }

            if ($semester == '') {
                $semester = $row['semester_pass'];
            }
            $sql = "UPDATE stdnt_record SET crse_grade = '$grade', semester_pass = '$semester' WHERE stdnt_number = '$stdnt_number' AND crse_code = '$course'";
            // Prepare statement
            $stmt = $conn->prepare($sql);
            // execute the query
            $stmt->execute();
        }else{
            header("Location: ../est_profile.php?=ERROR:UPDATE-FAILED");
            exit();   
        }

    $sql = "SELECT crse_code,'mandatory_courses' AS Result, crse_description, crse_credits FROM mandatory_courses WHERE crse_code = '$course' 
            UNION SELECT crse_code,'departmental_courses' AS Result, crse_description, crse_credits FROM departmental_courses WHERE crse_code = '$course' 
            UNION SELECT crse_code,'general_courses' AS Result, crse_description, crse_credits FROM general_courses WHERE crse_code = '$course' 
            UNION SELECT crse_code,'free_courses' AS Result, crse_description, crse_credits FROM free_courses WHERE crse_code = '$course'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0){
        $row = mysqli_fetch_assoc($result);
        if($descripcion == '') {
            $descripcion = $row['crse_description'];
        }

        if ($creditos == '') {
            $creditos = $row['crse_credits'];
        }
        $sql = "UPDATE {$row['Result']} SET crse_description = '$descripcion', crse_credits = '$creditos' WHERE crse_code = '$course'";
            // Prepare statement
            $stmt = $conn->prepare($sql);
            // execute the query
            $stmt->execute();
    }

    //exit
    header("Location: ../est_profile.php");
    exit(); 
}
?>