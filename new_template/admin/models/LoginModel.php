<?php
// models/LoginModel.php
class LoginModel {
    public function authenticateUser($conn, $email, $password) {
        // Implementa la lógica de autenticación aquí
        // Por ejemplo, puedes realizar una consulta SQL para verificar las credenciales
        $email = mysqli_real_escape_string($conn, $email); // Evita inyección SQL
        $password = mysqli_real_escape_string($conn, $password);

        $sql = "SELECT * FROM advisor WHERE email = '$email' AND pass = '$password'";

        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            // Las credenciales son correctas, el usuario está autenticado
            return true;
        } else {
            // Las credenciales son incorrectas, la autenticación falló
            return false;
        }
    }
}
?>
