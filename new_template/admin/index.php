<?php
// index.php
//require_once 'controllers/expedientesController.php';

// Inicia o reanuda la sesión
session_start();

// Verifica si la sesión de autenticación está establecida
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    // La sesión está autenticada, muestra la página de expedientes
    $expedientesController = new ExpedientesController();
    $expedientesController->index();
} else {
    // La sesión no está autenticada, muestra la página de inicio de sesión
    require_once 'views/loginView.php';
}
?>
