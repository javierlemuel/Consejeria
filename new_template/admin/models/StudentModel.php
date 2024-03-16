<?php
// models/StudentModel.php
class StudentModel {
    public function getStudentsByPageAndStatusAndSearch($conn, $perPage, $currentPage, $status, $search) {
        $offset = ($currentPage - 1) * $perPage;
    
        if ($status === 'Activos') {
            $statusCondition = "status = 'Activo'";
        } elseif ($status === 'Inactivos') {
            $statusCondition = "status = 'Inactivo'";
        } elseif ($status === 'Graduados') {
            $statusCondition = "status = 'Graduado'";
        } else {
            $statusCondition = "1"; // Sin filtro, mostrar todos
        }
    
        // Modificar la consulta SQL para incluir el filtro de estado y búsqueda
        //JAVIER//
        $sql = "SELECT student_num, name1, name2, last_name1, last_name2, conducted_counseling, status, edited_date
                FROM student 
                WHERE $statusCondition
                AND (name1 LIKE ? OR student_num LIKE ?)
                ORDER BY name1 ASC 
                LIMIT ? 
                OFFSET ?
                ";
        //
    
        $stmt = $conn->prepare($sql);
    
        // Modificar el filtro de búsqueda para buscar en cualquier parte del nombre
        $searchKeyword = "%$search%";
        $stmt->bind_param("ssii", $searchKeyword, $searchKeyword, $perPage, $offset);
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
        $stmt->close();
    
        return $students;
    }    

    public function getTotalStudentsByStatusAndSearch($conn, $status, $search) {
        if ($status === 'Activos') {
            $statusCondition = "status = 'Activo'";
        } elseif ($status === 'Inactivos') {
            $statusCondition = "status = 'Inactivo'";
        } elseif ($status === 'Graduados') {
            $statusCondition = "status = 'Graduado'";
        } else {
            $statusCondition = "1"; // Sin filtro, contar todos
        }
    
        // Modificar la consulta SQL para incluir el filtro de estado y búsqueda
        $sql = "SELECT COUNT(*) as total 
                FROM student 
                WHERE $statusCondition 
                AND (name1 LIKE ? OR student_num LIKE ?)";
    
        $stmt = $conn->prepare($sql);
    
        // Modificar el filtro de búsqueda para buscar en cualquier parte del nombre
        $searchKeyword = "%$search%";
        $stmt->bind_param("ss", $searchKeyword, $searchKeyword);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['total'];
    }    

    public function insertStudent($conn, $nombre, $nombre2, $apellidoP, $apellidoM, $email, $minor, $numero, $cohorte, $estatus, $birthday) {
        // Preparar la consulta SQL
        $sql = "INSERT INTO student (name1, name2, last_name1, last_name2, email, minor, student_num, cohort_year, status, dob, edited_date, conducted_counseling) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Preparar la sentencia
        $stmt = $conn->prepare($sql);

        $edited = date("Y-m-d");

        // Vincular los parámetros con los valores
        $stmt->bind_param("ssssssssssss", $nombre, $nombre2, $apellidoP, $apellidoM, $email, $minor, $numero, $cohorte, $estatus, $birthday, $edited, $edited);

        // Ejecutar la sentencia
        $result = $stmt->execute();
        $stmt->close();
        // Verificar si la inserción se realizó con éxito
        if ($result === true) {
            // Inserción exitosa
            return TRUE;
        } else {
            // Error en la inserción
            return FALSE;
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
        $stmt->close();
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

    public function studentRecommendedTerms($student_num, $conn) {
        // Preparar la consulta SQL
        $sql = "SELECT DISTINCT term FROM recommended_courses WHERE student_num = ?;";
        // Preparar la sentencia
        $stmt = $conn->prepare($sql);
        // Vincular el parámetro con el valor
        $stmt->bind_param("s", $student_num);
        // Ejecutar la sentencia
        $stmt->execute();
        // Obtener el resultado de la consulta
        $result = $stmt->get_result();
        $stmt->close();
        // Verificar si se encontraron resultados
        $terms = array(); // Inicializar un array para almacenar los términos
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $terms[] = $row['term']; // Agregar el término al array
            }
        } else {
            return NULL;
        }
    
        return $terms;
    }

    public function studentRecommendedClasses($student_num, $selectedTerm, $conn) {
        // Preparar la consulta SQL para obtener los cursos recomendados
        $sql = "
        SELECT
            COALESCE(courses.name, '') AS name,
            COALESCE(courses.credits, '') AS credits,
            recommended_courses.crse_code
        FROM
            recommended_courses
        LEFT JOIN
            (SELECT crse_code, name, credits FROM ccom_courses
             UNION
             SELECT crse_code, name, credits FROM general_courses) AS courses
        ON
            recommended_courses.crse_code = courses.crse_code
        WHERE
            recommended_courses.student_num = ?
            AND recommended_courses.term = ?";
            
        // Preparar la sentencia
        $stmt = $conn->prepare($sql);
        // Vincular los parámetros con los valores
        $stmt->bind_param("ss", $student_num, $selectedTerm);
        // Ejecutar la sentencia
        $stmt->execute();
        // Obtener el resultado de la consulta
        $result = $stmt->get_result();
        // Cerrar la sentencia
        $stmt->close();
        
        // Verificar si hay resultados
        if ($result->num_rows === 0) {
            return NULL; // Devolver NULL si no hay filas
        } else {
            // Obtener los resultados como un array asociativo
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data; // Devolver los resultados
        }
    }

    public function editStudent($nombre, $nombre2, $apellidoP, $apellidoM, $email, $numeroEst, $fechaNac, $cohorte, $minor, $graduacion, $notaAdmin, $notaEstudiante, $status, $date, $conn) {
        // Preparar la consulta SQL
        $sql = "UPDATE student 
                SET name1 = ?, 
                    name2 = ?, 
                    last_name1 = ?, 
                    last_name2 = ?, 
                    email = ?, 
                    dob = ?, 
                    cohort_year = ?, 
                    minor = ?, 
                    grad_term = ?, 
                    admin_note = ?, 
                    student_note = ?, 
                    status = ?, 
                    edited_date = ? 
                WHERE student_num = ?";
    
        // Preparar los datos para la consulta
        $params = array(
            $nombre, 
            $nombre2, 
            $apellidoP, 
            $apellidoM, 
            $email, 
            $fechaNac, 
            $cohorte, 
            $minor, 
            $graduacion, 
            $notaAdmin, 
            $notaEstudiante, 
            $status, 
            $date, 
            $numeroEst
        );
    
        // Tipos de datos para los parámetros
        $types = 'sssssssisssssi';
    
        // Ejecutar la consulta
        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, ...$params);
    
        $result = $stmt->execute();
    
        // Cerrar la conexión
        $stmt->close();
    
        // Devolver true si la consulta se ejecutó correctamente, o false en caso contrario
        return $result !== false;
    }
    
    
    public function insertStudentCSV($conn, $student_num, $nombre, $segundo_nombre, $apellido_materno, $apellido_paterno, $email, $birthdate) {
        $archivoRegistro = __DIR__ . '/archivo_de_registro.txt';

        $currentDateTime = date("Y-m-d H:i:s");
        $logMessage = "\n" . $currentDateTime . "\n";
        error_log($logMessage, 3, $archivoRegistro);

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
        $query = "INSERT INTO student (student_num, email, name1, name2, last_name1, last_name2, dob, conducted_counseling, minor, cohort_year, status, edited_date)
                  VALUES ('$student_num', '$email', '$nombre', '$segundo_nombre', '$apellido_paterno', '$apellido_materno', '$birthdate_formatted', '0000-00-00', 0, $cohort_year, 'Activo', NULL)";
    
        // Ejecuta el query
        if ($conn->query($query) === TRUE) {
            // Insert exitoso
            error_log("Estudiante insertado correctamente en la base de datos.\n", 3, $archivoRegistro);
        } else {
            // querie fallo
            error_log("Error al insertar estudiante en la base de datos: " . $conn->error . "\n", 3, $archivoRegistro);
        }
    }
    
    public function alreadyRecomended($student_num, $class, $term, $conn) {
        // Preparar la consulta SQL
        $sql = "SELECT * FROM recommended_courses WHERE student_num = ? AND crse_code = ? AND term = ?";
        // Preparar la sentencia
        $stmt = $conn->prepare($sql);
        // Vincular el parámetro con el valor
        $stmt->bind_param("sss", $student_num, $class, $term);
        // Ejecutar la sentencia
        $stmt->execute();
        // Obtener el resultado de la consulta
        $result = $stmt->get_result();
        // Verificar si se encontraron resultados
        $stmt->close();
        if ($result->num_rows > 0)
            {
                return TRUE;
            }
        else 
        {
            return FALSE;
        }
    }

    public function insertRecomendation($student_num, $class, $term, $conn) {
        // Preparar la consulta SQL
        $sql = "INSERT INTO recommended_courses (student_num, crse_code, term) VALUES (?, ?, ?)";
        
        // Preparar la declaración
        $stmt = $conn->prepare($sql);
        
        // Vincular los parámetros
        $stmt->bind_param("iss", $student_num, $class, $term);
        
        // Ejecutar la consulta
        $result = $stmt->execute();
        
        // Verificar si la inserción fue exitosa
        if ($result)
        {
            // Obtener la fecha actual
            $date = date("Y-m-d");

            // Consulta SQL para actualizar la columna conducted_counseling
            $sql = "UPDATE student SET conducted_counseling = ? WHERE student_num = ?";

            // Preparar la declaración
            $stmt = $conn->prepare($sql);

            // Vincular los parámetros
            $stmt->bind_param("si", $date, $student_num);

            // Ejecutar la consulta
            $result = $stmt->execute();

            // Cerrar la declaración
            $stmt->close();

            return TRUE;
        } 
        else
        {
            // Cerrar la declaración
            $stmt->close();
            return FALSE;
        }
        
    }

    public function deleteRecomendation($student_num, $class, $term, $conn) {
        // Preparar la consulta SQL
        $sql = "DELETE FROM recommended_courses WHERE student_num = ? AND crse_code = ? AND term = ?";
        
        // Preparar la declaración
        $stmt = $conn->prepare($sql);
        
        // Vincular los parámetros
        $stmt->bind_param("sss", $student_num, $class, $term);
        
        // Ejecutar la consulta
        $result = $stmt->execute();
        
        // Verificar si la eliminación fue exitosa
        if ($result)
        {
            // Obtener la fecha actual
            $date = date("Y-m-d");
    
            // Consulta SQL para actualizar la columna conducted_counseling
            $sql = "UPDATE student SET conducted_counseling = ? WHERE student_num = ?";
    
            // Preparar la declaración
            $stmt = $conn->prepare($sql);
    
            // Vincular los parámetros
            $stmt->bind_param("ss", $date, $student_num);
    
            // Ejecutar la consulta
            $result = $stmt->execute();
    
            // Cerrar la declaración
            $stmt->close();
    
            return TRUE;
        } 
        else
        {
            // Cerrar la declaración
            $stmt->close();
            return FALSE;
        }
    }  
    
    public function studentAlreadyHasGrade($student_num, $code, $conn) {
        // Preparar la consulta SQL
        $sql = "SELECT * FROM student_courses WHERE student_num = ? AND crse_code = ?";
        // Preparar la sentencia
        $stmt = $conn->prepare($sql);
        // Vincular el parámetro con el valor
        $stmt->bind_param("ss", $student_num, $code);
        // Ejecutar la sentencia
        $stmt->execute();
        // Obtener el resultado de la consulta
        $result = $stmt->get_result();
        // Verificar si se encontraron resultados
        $stmt->close();
        if ($result->num_rows > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function UpdateStudentGrade($student_num, $course_code, $grade, $equi, $conva, $credits, $term, $type, $old_term, $conn) {
        // Preparar la consulta SQL para la actualización
        $sql = "UPDATE student_courses 
                SET credits = ?, type = ?, crse_grade = ?, crse_status = 'P', term = ?, equivalencia = ?, convalidacion = ?
                WHERE student_num = ? AND crse_code = ? AND term = ?";
        
        // Preparar la sentencia
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            // Manejar el error de preparación de la consulta
            return FALSE;
        }
        
        // Vincular los parámetros con los valores
        $stmt->bind_param("sssssssss", $credits, $type, $grade, $term, $equi, $conva, $student_num, $course_code, $old_term);
        
        // Ejecutar la sentencia
        if ($stmt->execute()) {
            // Verificar si la actualización fue exitosa
            if ($stmt->affected_rows > 0) {
                $stmt->close();
                return TRUE; // La actualización fue exitosa
            } else {
                $stmt->close();
                return FALSE; // La actualización no tuvo ningún efecto (ninguna fila afectada)
            }
        } else {
            // Ocurrió un error al ejecutar la consulta
            // Manejar el error según sea necesario
            $stmt->close();
            return FALSE;
        }
    }

    public function InsertStudentGrade($student_num, $course_code, $grade, $equi, $conva, $credits, $term, $type, $conn) {
        // Preparar la consulta SQL para la inserción
        $sql = "INSERT INTO student_courses (student_num, crse_code, credits, type, crse_grade, crse_status, term, equivalencia, convalidacion)
                VALUES (?, ?, ?, ?, ?, 'P', ?, ?, ?)";
        
        // Preparar la sentencia
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            // Manejar el error de preparación de la consulta
            return FALSE;
        }
        
        // Vincular los parámetros con los valores
        $stmt->bind_param("ssssssss", $student_num, $course_code, $credits, $type, $grade, $term, $equi, $conva);
        
        // Ejecutar la sentencia
        if ($stmt->execute()) {
            // Verificar si la inserción fue exitosa
            if ($stmt->affected_rows > 0) {
                $stmt->close();
                return TRUE; // La inserción fue exitosa
            } else {
                $stmt->close();
                return FALSE; // La inserción no tuvo ningún efecto (ninguna fila afectada)
            }
        } else {
            // Ocurrió un error al ejecutar la consulta
            // Manejar el error según sea necesario
            $stmt->close();
            return FALSE;
        }
    }
    
    public function alreadyHasGradeInTerm($student_num, $class, $term, $conn) {
        // Preparar la consulta SQL
        $sql = "SELECT * FROM student_courses WHERE student_num = ? AND crse_code = ? AND term = ?";
        // Preparar la sentencia
        $stmt = $conn->prepare($sql);
        // Vincular el parámetro con el valor
        $stmt->bind_param("sss", $student_num, $class, $term);
        // Ejecutar la sentencia
        $stmt->execute();
        // Obtener el resultado de la consulta
        $result = $stmt->get_result();
        // Verificar si se encontraron resultados
        $stmt->close();
        if ($result->num_rows > 0)
            {
                return TRUE;
            }
        else 
        {
            return FALSE;
        }
    }
}
?>
