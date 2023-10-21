<?php
// config/database.php
$host = 'localhost';
$username = 'root';
$password = 'contra';
$database = 'counseling_draft';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
