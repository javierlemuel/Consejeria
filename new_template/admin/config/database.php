<?php

// config/database.php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'counseling_db';

/*
$host = "136.145.29.193"; // XAMPP crea el localhost
$username = "emamarsa"; // Usuario de phpMyAdmin
$password = "ema84023"; //contrasena de phpMyAdmin
$database = "emamarsa_db"; 
*/

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
