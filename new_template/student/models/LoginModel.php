<?php
// models/LoginModel.php
class LoginModel {
    public function authenticateUser($conn, $email, $dob, $student_num) {
        // Implementa la lógica de autenticación aquí
        // Por ejemplo, puedes realizar una consulta SQL para verificar las credenciales
        $email = mysqli_real_escape_string($conn, $email); // Evita inyección SQL
        $dob = mysqli_real_escape_string($conn, $dob);
        $student_num = mysqli_real_escape_string($conn, $student_num);

        $sql = "SELECT * FROM student WHERE email = '$email' AND dob = '$dob' AND student_num = $student_num";

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
