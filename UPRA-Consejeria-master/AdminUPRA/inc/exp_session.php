<?php
if (isset($_POST['est-submit'])) {
    include_once 'connection.php';
    $stdnt_number = mysqli_real_escape_string($conn, $_POST['stdnt_number']);
    header('Location: ../est_profile.php?stdnt_number=' . $stdnt_number);
    exit();
}
?>
