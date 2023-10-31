<?php
// index.php
require_once 'config/database.php';

// Inicia o reanuda la sesión
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['signout'])) {
        // Si se ha enviado el formulario de cierre de sesión
        // Destruir la sesión actual y redirigir al inicio de sesión

        session_start();
        $_SESSION = array(); // Limpiar todas las variables de sesión
        session_destroy(); // Destruir la sesión

        // Redirigir al usuario al inicio de sesión
        header("Location: index.php");
        exit;
    }
}
// Verifica si la sesión de autenticación está establecida
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    // La sesión está autenticada, muestra la página de expedientes
    require_once 'controllers/expedientesController.php'; // Incluye aquí
} else {
    // La sesión no está autenticada, muestra la página de inicio de sesión
    require_once 'views/loginView.php';
}
?>
