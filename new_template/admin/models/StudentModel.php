<?php
// models/StudentModel.php
class StudentModel {
    public function getStudentsByPageAndStatus($conn, $perPage, $currentPage, $status) {
        $offset = ($currentPage - 1) * $perPage;

        // Modificamos la consulta SQL para incluir el filtro de estado
        if ($status === 'Activos') {
            $statusCondition = "status = 'Activo'";
        } elseif ($status === 'Inactivos') {
            $statusCondition = "status = 'Inactivo'";
        } else {
            $statusCondition = "1"; // Sin filtro, mostrar todos
        }

        $sql = "SELECT student_num, name1, name2, last_name1, last_name2, conducted_counseling, status 
                FROM student 
                WHERE $statusCondition 
                ORDER BY name1 ASC 
                LIMIT $perPage 
                OFFSET $offset";

        $result = $conn->query($sql);

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        $students = [];
        while ($row = $result->fetch_assoc()) {
            $student_num = $row['student_num'];
            $formatted_student_num = substr($student_num, 0, 3) . '-' . substr($student_num, 3, 2) . '-' . substr($student_num, 5);
            $row['formatted_student_num'] = $formatted_student_num;
            $students[] = $row;
        }

        return $students;
    }

    public function getTotalStudentsByStatus($conn, $status) {
        // Modificamos la consulta SQL para incluir el filtro de estado
        if ($status === 'Activos') {
            $statusCondition = "status = 'Activo'";
        } elseif ($status === 'Inactivos') {
            $statusCondition = "status = 'Inactivo'";
        } else {
            $statusCondition = "1"; // Sin filtro, contar todos
        }

        $sql = "SELECT COUNT(*) as total 
                FROM student 
                WHERE $statusCondition";

        $result = $conn->query($sql);

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        $row = $result->fetch_assoc();
        return $row['total'];
    }
}
?>
