<?php
// models/StudentModel.php
class CohorteModel
{

    public function getConcentrationCourses($conn)
    {

        $sql = "SELECT DISTINCT crse_code, name, credits 
                FROM ccom_courses
                WHERE crse_code NOT IN (SELECT crse_code FROM recommended_courses)";

        $stmt = $conn->prepare($sql);

        // ejecuta el statement
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        $courses = [];
        while ($row = $result->fetch_assoc()) {
            $courses[] = $row;
        }

        return $courses;
    }

    public function getGeneralCourses($conn)
    {

        $sql = "SELECT DISTINCT crse_code, name, credits 
        FROM general_courses
        WHERE crse_code NOT IN (SELECT crse_code FROM recommended_courses)";

        $stmt = $conn->prepare($sql);
        // ejecuta el statement
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        $courses = [];
        while ($row = $result->fetch_assoc()) {
            $courses[] = $row;
        }

        return $courses;
    }
}
