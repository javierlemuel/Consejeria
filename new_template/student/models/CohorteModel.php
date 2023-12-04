<?php
// models/StudentModel.php
class CohorteModel
{

    public function getCohort($conn, $cohot_year)
    {

        $sql = "SELECT c.cohort_year, c.crse_code, c.crse_year, c.crse_semester, 
                COALESCE(cc.credits, gc.credits, dc.credits) AS credits,
                COALESCE(cc.name, gc.name, dc.name) AS name
                FROM cohort AS c
                LEFT JOIN ccom_courses AS cc ON c.crse_code = cc.crse_code
                LEFT JOIN general_courses AS gc ON c.crse_code = gc.crse_code
                LEFT JOIN dummy_courses AS dc ON c.crse_code = dc.crse_code
                WHERE cohort_year = ?";

        $stmt = $conn->prepare($sql);

        // sustituye el ? por el valor de $student_num
        $stmt->bind_param("s", $cohot_year);

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
