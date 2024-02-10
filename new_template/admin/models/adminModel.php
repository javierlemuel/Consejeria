<?php

class AdminModel {
    public function getAdmins($conn)
    {
        $sql = "SELECT *
                FROM advisor
                ORDER BY email ASC";

        $result = $conn->query($sql);

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        return $result;
    }

    public function registerAdmin($conn, $email, $name, $lname, $pass, $privileges)
    {
        //Verifica que ese email de admin no exista ya
        $sql = "SELECT *
                FROM advisor
                WHERE email = '$email'";

        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            // Rows exist with the provided email
            return 'exist';
        }

        //Inserte el admin nuevo
        $sql2 = "INSERT INTO advisor
                VALUES('$email', '$pass', '$name', '$lname', $privileges)";
        $result2 = $conn->query($sql2);

        //Devuelva failure o success dependiendo si se pudo insertar o no
        if ($result2 === false) {
            return "failure";
        }

        return "success";
    }

}