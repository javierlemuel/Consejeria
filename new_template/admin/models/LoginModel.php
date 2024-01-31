<?php
// models/LoginModel.php
session_start();
class LoginModel {
    public function authenticateUser($conn, $email, $password) {
        // Implementa la lógica de autenticación aquí
        // Por ejemplo, puedes realizar una consulta SQL para verificar las credenciales
        $email = mysqli_real_escape_string($conn, $email); // Evita inyección SQL

        $sql = "SELECT * FROM advisor WHERE email = '$email'";

        $result = $conn->query($sql);

        if ($result && $result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['pass'])) {
                // Las credenciales son correctas, el usuario está autenticado
                return true;
            } else {
                // Las credenciales son incorrectas, la autenticación falló
                $_SESSION['message'] = "no admin";
                return false;
            }
        } else {
            // El email no existe en la base de datos
            $_SESSION['message'] = "no admin";
            return false;
        }
    }
}
?>
