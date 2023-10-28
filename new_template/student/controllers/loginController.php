<?php
// controllers/loginController.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica si los campos del formulario no están vacíos
    if (empty($_POST['email']) || empty($_POST['dob']) || empty($_POST['student_num'])) {
        // Al menos uno de los campos está vacío, redirige al usuario a loginView.php
        header("Location: ../index.php");
        exit;
    }

    // Ambos campos tienen información, procede a la autenticación
    require_once(__DIR__ . '/../models/LoginModel.php');
    require_once(__DIR__ . '/../config/database.php');

    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $student_num = $_POST['student_num'];

    // Realiza la autenticación en el modelo (debes implementar esta lógica en LoginModel.php)
    $loginModel = new LoginModel();
    $authenticated = $loginModel->authenticateUser($conn, $email, $dob, $student_num);

    if ($authenticated) {
        // La autenticación fue exitosa, establece la variable de sesión "authenticated" en true
        session_start();
        $_SESSION['authenticated'] = true;
        $_SESSION['student_num'] = $student_num;

        // Redirige al usuario a la página de expedientes
        header("Location: ../index.php");
        exit;
    } else {
        // La autenticación falló, redirige al usuario nuevamente a loginView.php
        header("Location: ../index.php");
        exit;
    }
}
