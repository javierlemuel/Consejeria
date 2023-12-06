<?php
// controllers/loginController.php
require_once(__DIR__ . '/../models/LoginModel.php');
require_once(__DIR__ . '/../config/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica si los campos del formulario no están vacíos
    if (empty($_POST['email']) || empty($_POST['dob']) || empty($_POST['student_num'])) { //check if email is empty
        header("Location: ../index.php?error=Todos los campos son requeridos.");
        exit();
    }

    // Ambos campos tienen información, procede a la autenticación
    require_once(__DIR__ . '/../models/LoginModel.php');
    require_once(__DIR__ . '/../config/database.php');

    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $student_num = $_POST['student_num'];

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
    }
    else
    {
        header("Location: ../index.php");
        exit;
    }
}
require_once(__DIR__ . '/../views/loginView.php');
