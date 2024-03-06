<?php
// config/database.php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'counseling_db';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
