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

//session_destroy();
// Verifica si la sesión de autenticación está establecida
if (isset($_SESSION['student_authenticated']) && $_SESSION['student_authenticated'] === true) {
    // La sesión está autenticada, muestra la página de expedientes
    $page = $_GET['page'] ?? 'counseling';

    // Load the appropriate view based on the page parameter
    if ($page === 'expediente') {
        // Load the "About Us" view
        require_once 'controllers/expedienteController.php';
    } else if ($page === '2017' || $page === '2022') {
        require_once 'controllers/cohorteController.php';
    } else if ($page === 'links') {
        require_once 'views/links.php';
    } else {
        // carga la pagina de consegeria 
        require_once 'controllers/counselingController.php';
    }
} else {
    // La sesión no está autenticada, muestra la página de inicio de sesión
    require_once 'views/loginView.php';
}
