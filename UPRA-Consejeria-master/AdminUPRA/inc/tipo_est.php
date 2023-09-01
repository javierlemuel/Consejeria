<?php
if (isset($_POST['tipo_est-submit'])) {
require '../../private/dbconnect.php';
    $stdnt_number = mysqli_real_escape_string($conn, $_POST['stdnt_number']);
    $tipo = mysqli_real_escape_string($conn, $_POST['tipo']);

    $sql = "UPDATE student SET stdnt_type = '$tipo' WHERE stdnt_number = '$stdnt_number'";
    // Prepare statement
    $stmt = $conn->prepare($sql);
    // execute the query
    $stmt->execute();
    //exit
    header("Location: ../recomendaciones_C.php");
    exit();
}
    ?>