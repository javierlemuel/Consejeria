<?php
if (isset($_POST['stdnt_password'])){
    session_start();
    require 'dbconnect.php';
    $id = $_SESSION['stdnt_number'];
    $stdnt_password = mysqli_real_escape_string($conn, $_POST['stdnt_password']);

    $encrypted = crypt($stdnt_password);

    $sql = "UPDATE student SET stdnt_password = '$encrypted' WHERE stdnt_number = '$id'";
    // Prepare statement
    $stmt = $conn->prepare($sql);
    // execute the query
    $stmt->execute();
    //exit
    header("Location: ../consejeria.php");
    exit();
}
?>