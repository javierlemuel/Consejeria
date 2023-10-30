<?php
// models/StudentModel.php
class StudentModel {
    public function getStudentsByPageAndStatusAndSearch($conn, $perPage, $currentPage, $status, $search) {
        $offset = ($currentPage - 1) * $perPage;
    
        if ($status === 'Activos') {
            $statusCondition = "status = 'Activo'";
        } elseif ($status === 'Inactivos') {
            $statusCondition = "status = 'Inactivo'";
        } else {
            $statusCondition = "1"; // Sin filtro, mostrar todos
        }
    
        // Modificar la consulta SQL para incluir el filtro de estado y búsqueda
        $sql = "SELECT student_num, name1, name2, last_name1, last_name2, conducted_counseling, status 
                FROM student 
                WHERE $statusCondition 
                AND name1 LIKE ? 
                ORDER BY name1 ASC 
                LIMIT ? 
                OFFSET ?";
    
        $stmt = $conn->prepare($sql);
    
        // Modificar el filtro de búsqueda para buscar en cualquier parte del nombre
        $searchKeyword = "%$search%";
        $stmt->bind_param("sii", $searchKeyword, $perPage, $offset);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $students = [];
        while ($row = $result->fetch_assoc()) {
            $student_num = $row['student_num'];
            $formatted_student_num = substr($student_num, 0, 3) . '-' . substr($student_num, 3, 2) . '-' . substr($student_num, 5);
            $row['formatted_student_num'] = $formatted_student_num;
            $students[] = $row;
        }
    
        return $students;
    }    

    public function getTotalStudentsByStatusAndSearch($conn, $status, $search) {
        if ($status === 'Activos') {
            $statusCondition = "status = 'Activo'";
        } elseif ($status === 'Inactivos') {
            $statusCondition = "status = 'Inactivo'";
        } else {
            $statusCondition = "1"; // Sin filtro, contar todos
        }
    
        // Modificar la consulta SQL para incluir el filtro de estado y búsqueda
        $sql = "SELECT COUNT(*) as total 
                FROM student 
                WHERE $statusCondition 
                AND name1 LIKE ?";
    
        $stmt = $conn->prepare($sql);
    
        // Modificar el filtro de búsqueda para buscar en cualquier parte del nombre
        $searchKeyword = "%$search%";
        $stmt->bind_param("s", $searchKeyword);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $row = $result->fetch_assoc();
        return $row['total'];
    }    

    public function insertStudent($conn, $nombre, $nombre2, $apellidoP, $apellidoM, $email, $minor, $numero, $cohorte, $estatus, $birthday) {
        // Preparar la consulta SQL
        $sql = "INSERT INTO student (name1, name2, last_name1, last_name2, email, minor, student_num, cohort_year, status, dob) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Preparar la sentencia
        $stmt = $conn->prepare($sql);

        // Vincular los parámetros con los valores
        $stmt->bind_param("ssssssssss", $nombre, $nombre2, $apellidoP, $apellidoM, $email, $minor, $numero, $cohorte, $estatus, $birthday);

        // Ejecutar la sentencia
        $result = $stmt->execute();

        // Verificar si la inserción se realizó con éxito
        if ($result === true) {
            // Inserción exitosa
            return true;
        } else {
            // Error en la inserción
            return false;
        }
    }

    public function selectStudent($student_num, $conn) {
        // Preparar la consulta SQL
        $sql = "SELECT * FROM student WHERE student_num = ?";
        // Preparar la sentencia
        $stmt = $conn->prepare($sql);
        // Vincular el parámetro con el valor
        $stmt->bind_param("s", $student_num);
        // Ejecutar la sentencia
        $stmt->execute();
        // Obtener el resultado de la consulta
        $result = $stmt->get_result();
        // Verificar si se encontraron resultados
        if ($result->num_rows == 1) {
            while ($row = $result->fetch_assoc()) {
                $studentData = $row;
            }
        } else {
            echo"Querie ejecutado con error en el selectstudent.";
        }
        // Cierra la sentencia
        //$stmt->close();
        //$conn->close();
        // Devuelve los datos del estudiante
        return $studentData;
    }

    public function editStudent($nombre, $nombre2, $apellidoP, $apellidoM, $email, $numeroEst, $fechaNac, $cohorte, $minor, $graduacion, $notaAdmin, $notaEstudiante, $status, $conn) {
        // Preparar la consulta SQL
        $sql = "UPDATE student SET name1 = ?, name2 = ?, last_name1 = ?, last_name2 = ?, email = ?, dob = ?, cohort_year = ?, minor = ?, grad_term = ?, admin_note = ?, student_note = ?, status = ? WHERE student_num = ?";

        // Preparar los datos para la consulta
        $params = array($nombre, $nombre2, $apellidoP, $apellidoM, $email, $fechaNac, $cohorte, $minor, $graduacion, $notaAdmin, $notaEstudiante, $status, $numeroEst);

        // Ejecutar la consulta
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute($params);

        // Devolver true si la consulta se ejecutó correctamente, o false en caso contrario
        return $result !== false;
    }
    
}
?>
