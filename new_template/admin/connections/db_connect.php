<?php
$servername = "localhost"; // Cambia esto a la dirección de tu servidor MySQL
$username = "root"; // Cambia esto a tu nombre de usuario de MySQL
$password = "contra"; // Cambia esto a tu contraseña de MySQL
$database = "counseling"; // Cambia esto al nombre de tu base de datos

// Crear una conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>