<?php
// controllers/loginController.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica si los campos del formulario no están vacíos
    if (empty($_POST['email']) || empty($_POST['password'])) {
        // Al menos uno de los campos está vacío, redirige al usuario a loginView.php
        header("Location: ../index.php");
        exit;
    }

    // Ambos campos tienen información, procede a la autenticación
    require_once(__DIR__ . '/../models/LoginModel.php');
    require_once(__DIR__ . '/../config/database.php');

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Realiza la autenticación en el modelo
    $loginModel = new LoginModel();
    $authenticated = $loginModel->authenticateUser($conn, $email, $password);

    if ($authenticated) {
        // La autenticación fue exitosa, establece la variable de sesión "authenticated" en true
        session_start();
        $_SESSION['authenticated'] = true;

        // Redirige al usuario a la página de expedientes
        header("Location: ../index.php");
        exit;
    } else {
        // La autenticación falló, redirige al usuario nuevamente a loginView.php
        header("Location: ../index.php");
        exit;
    }
}
else{
    header("Location: ../index.php");
}
?>
