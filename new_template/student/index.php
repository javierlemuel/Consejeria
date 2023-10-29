<?php
// index.php
require_once 'config/database.php';

// Inicia o reanuda la sesión
session_start();

//session_destroy();
// Verifica si la sesión de autenticación está establecida
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    // La sesión está autenticada, muestra la página de expedientes
    $page = $_GET['page'] ?? 'counseling';

    // Load the appropriate view based on the page parameter
    if ($page === 'expediente') {
        // Load the "About Us" view
        require_once 'controllers/expedienteController.php';
    } else {
        // carga la pagina de consegeria 
        require_once 'controllers/counselingController.php';
    }
} else {
    // La sesión no está autenticada, muestra la página de inicio de sesión
    require_once 'views/loginView.php';
}
