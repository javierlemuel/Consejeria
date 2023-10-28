<?php
// index.php
require_once 'config/database.php';

// Inicia o reanuda la sesión
session_start();
//session_destroy();
// Verifica si la sesión de autenticación está establecida
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    // La sesión está autenticada, muestra la página de expedientes
    require_once 'controllers/counselingController.php'; // Incluye aquí
} else {
    // La sesión no está autenticada, muestra la página de inicio de sesión
    require_once 'views/loginView.php';
}
