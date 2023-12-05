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
        //JAVIER//
        $sql = "SELECT student_num, name1, name2, last_name1, last_name2, given_counseling, status 
                FROM student 
                WHERE $statusCondition
                AND name1 LIKE ? 
                ORDER BY name1 ASC 
                LIMIT ? 
                OFFSET ?";
        //
    
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

            //JAVIER (Add si el estudiante hizo consejeria)
            $sql2 = "SELECT DISTINCT will_take.student_num
                FROM will_take NATURAL JOIN student
                WHERE will_take.student_num = $student_num
                AND student.name1 LIKE '$searchKeyword'";
             $result2 = $conn->query($sql2);

            if ($result2 === false) {
                throw new Exception("Error en la consulta SQL: " . $conn->error);
            }

            $counseling = 0;

            foreach($result2 as $res)
                $counseling = 1;

            $row['conducted_counseling'] = $counseling;
            //

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
        $sql = "INSERT INTO student (name1, name2, last_name1, last_name2, email, minor, student_num, cohort_year, status, dob, edited) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Preparar la sentencia
        $stmt = $conn->prepare($sql);

        $edited = '0000-00-00'

        // Vincular los parámetros con los valores
        $stmt->bind_param("sssssssssss", $nombre, $nombre2, $apellidoP, $apellidoM, $email, $minor, $numero, $cohorte, $estatus, $birthday, $edited);

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
            return NULL;
        }
        // Cierra la sentencia
        //$stmt->close();
        //$conn->close();
        // Devuelve los datos del estudiante
        return $studentData;
    }

    //JAVIER
    public function editStudent($nombre, $nombre2, $apellidoP, $apellidoM, $email, $numeroEst, $fechaNac, $cohorte, $minor, $graduacion, $notaAdmin, $notaEstudiante, $status, $date, $conn) {
        // Preparar la consulta SQL
        $sql = "UPDATE student SET name1 = ?, name2 = ?, last_name1 = ?, 
        last_name2 = ?, email = ?, dob = ?, cohort_year = ?, minor = ?, 
        grad_term = ?, admin_note = ?, student_note = ?, status = ?, 
        edited = ? WHERE student_num = ?";

        // Preparar los datos para la consulta
        $params = array($nombre, $nombre2, $apellidoP, $apellidoM, $email, $fechaNac, 
        $cohorte, $minor, $graduacion, $notaAdmin, $notaEstudiante, $status, $date, $numeroEst);

        //$types = str_repeat('s', count($params) - 2) . 'ii';  
        $types = ('sssssssisssssi');

        // Ejecutar la consulta
        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, ...$params);

        $result = $stmt->execute();
     // Cambios para que recoja el array bien y considerando que dos de ellos no son string. También puse el 'edited' date

        // Devolver true si la consulta se ejecutó correctamente, o false en caso contrario
        return $result !== false;
    }
    
    public function insertStudentCSV($conn, $student_num, $nombre, $segundo_nombre, $apellido_materno, $apellido_paterno, $email, $birthdate) {
        $archivoRegistro = __DIR__ . '/archivo_de_registro.txt';

        if(strlen($birthdate) == 5)
            $birthdate = '0'.$birthdate;
    
        // Extraer el mes, día y año de $birthdate
        $mes = substr($birthdate, 0, 2);
        $dia = substr($birthdate, 2, 2);
        $axo = substr($birthdate, 4, 2);

        if($axo > 50)
        {
            $axo = $axo + 1900;
        }
        else
        {
            $axo = $axo + 2000;
        }
        $birthdate_formatted = sprintf("%04d-%02d-%02d", $axo, $mes, $dia);

        $numberStr = (string) $student_num;

        // Check if the number has at least 5 digits
        if (strlen($numberStr) >= 5) {
            // Extract the 4th and 5th digits
            $fourthDigit = $numberStr[3];
            $fifthDigit = $numberStr[4];

            // Concatenate the 4th and 5th digits into a single string
            $combinedDigits = $fourthDigit . $fifthDigit;
        }

        if(intval($combinedDigits) <= 21)
            $cohort_year = '2017';
        else    
            $cohort_year = '2022';
    
        // Ejecuta el query de inserción
        $query = "INSERT INTO student (student_num, email, name1, name2, last_name1, last_name2, dob, given_counseling, minor, cohort_year, status, edited, type)
                  VALUES ('$student_num', '$email', '$nombre', '$segundo_nombre', '$apellido_paterno', '$apellido_materno', '$birthdate_formatted', '0000-00-00', 0, $cohort_year, 'Activo', '0000-00-00', '')";
    
        // Ejecuta el query
        if ($conn->query($query) === TRUE) {
            // Insert exitoso
            error_log("Estudiante insertado correctamente en la base de datos.\n", 3, $archivoRegistro);
        } else {
            // querie fallo
            error_log("Error al insertar estudiante en la base de datos: " . $conn->error . "\n", 3, $archivoRegistro);
        }
    }    
}
?>
