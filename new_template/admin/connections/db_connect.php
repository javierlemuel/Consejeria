<?php
$servername = "localhost"; // XAMPP crea el localhost
$username = "root"; // Usuario de phpMyAdmin
$password = "contra"; //contrasena de phpMyAdmin
$database = "consejeria"; 

$conn = new mysqli($servername, $username, $password, $database); // Crear una conexión

if ($conn->connect_error) { // Si en el proceso pasa un error de coneccion
    die("Error de conexión: " . $conn->connect_error); //die es una funcion que termina el programa y printea un mensaje. el valor de connect_error es un bool.
}
?>