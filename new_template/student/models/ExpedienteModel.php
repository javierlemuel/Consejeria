<?php
// models/LoginModel.php
class StudentModel
{
    public function getStudentInfo($conn, $student_num)
    {
        $sql = "SELECT email, name1, name2, last_name1, last_name2, cohort_year
                FROM student
                WHERE student.student_num = ?";

        $stmt = $conn->prepare($sql);

        // sustituye el ? por el valor de $student_num
        $stmt->bind_param("s", $student_num);

        // ejecuta el statement
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        $studentInfo = $result->fetch_assoc();
        if ($studentInfo['name2'] != null) {
            $studentName = $studentInfo['name1'] . " " . $studentInfo['name2'] . " " . $studentInfo['last_name1'] . " " . $studentInfo['last_name2'];
        } else
            $studentName = $studentInfo['name1'] . " " . $studentInfo['last_name1'] . " " . $studentInfo['last_name2'];

        $studentInfo['full_student_name'] = $studentName;
        $formatted_student_num = substr($student_num, 0, 3) . '-' . substr($student_num, 3, 2) . '-' . substr($student_num, 5);
        $studentInfo['formatted_student_num'] = $formatted_student_num;

        return $studentInfo;
    }

    public function getStudentCCOMCourses($conn, $student_num, $cohort_year)
    {
        // $sql = "SELECT ccom_courses.crse_code, ccom_courses.name, ccom_courses.credits, student_courses.crse_grade, student_courses.crse_status, 
        //         student_courses.convalidacion, student_courses.equivalencia,  student_courses.term, ccom_courses.type
        // FROM ccom_courses
        // LEFT JOIN student_courses ON ccom_courses.crse_code = student_courses.crse_code
        // AND student_courses.student_num = ? WHERE ccom_courses.type = 'mandatory' ";

        $sql = "SELECT ccom_courses.crse_code, ccom_courses.name, ccom_courses.credits, student_courses.crse_grade, student_courses.crse_status, 
                student_courses.convalidacion, student_courses.equivalencia,  student_courses.term, ccom_courses.type,
                cohort.cohort_year
        FROM ccom_courses
        LEFT JOIN student_courses ON ccom_courses.crse_code = student_courses.crse_code
                AND student_courses.student_num = ?
        LEFT JOIN cohort ON ccom_courses.crse_code = cohort.crse_code
        WHERE ccom_courses.type = 'mandatory' AND cohort.cohort_year = ?
        ORDER BY ccom_courses.crse_code ASC;";

        $stmt = $conn->prepare($sql);

        // sustituye el ? por el valor de $student_num
        $stmt->bind_param("ss", $student_num, $cohort_year);

        // ejecuta el statement
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        $studentRecord = [];
        while ($row = $result->fetch_assoc()) {
            $studentRecord[] = $row;
        }
        return $studentRecord;
    }

    public function getStudentGeneralCourses($conn, $student_num, $cohort_year)
    {
        // $sql = "SELECT general_courses.crse_code, general_courses.name, general_courses.credits, student_courses.crse_grade, student_courses.crse_status, 
        //                 student_courses.convalidacion, student_courses.equivalencia,  student_courses.term, general_courses.type
        //         FROM general_courses
        //         LEFT JOIN student_courses ON general_courses.crse_code = student_courses.crse_code
        //         AND student_courses.student_num = ?";
        $sql = "SELECT general_courses.crse_code, general_courses.name, general_courses.credits, student_courses.crse_grade, student_courses.crse_status, 
                        student_courses.convalidacion, student_courses.equivalencia,  student_courses.term, general_courses.type
                FROM general_courses
                LEFT JOIN student_courses ON general_courses.crse_code = student_courses.crse_code
                AND student_courses.student_num = ?
                JOIN cohort on cohort.crse_code = general_courses.crse_code
                WHERE cohort.cohort_year = ? AND general_courses.crse_code NOT IN ('INGL3113', 'INGL3114');";

        $stmt = $conn->prepare($sql);

        // sustituye el ? por el valor de $student_num
        $stmt->bind_param("ss", $student_num, $cohort_year);

        // ejecuta el statement
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        $studentRecord = [];
        while ($row = $result->fetch_assoc()) {
            $studentRecord[] = $row;
        }
        return $studentRecord;
    }

    public function getCCOMElectives($conn, $student_num)
    {

        $sql = "SELECT cc.crse_code, cc.name, cc.credits, sc.crse_grade, sc.term, sc.equivalencia, sc.convalidacion
        FROM ccom_courses AS cc
        JOIN student_courses AS sc
        ON cc.crse_code = sc.crse_code
        WHERE sc.type = 'elec_ccom' AND sc.student_num = ?";

        $stmt = $conn->prepare($sql);

        // sustituye el ? por el valor de $student_num
        $stmt->bind_param("s", $student_num);

        // ejecuta el statement
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        $studentRecord = [];
        while ($row = $result->fetch_assoc()) {
            $studentRecord[] = $row;
        }
        return $studentRecord;
    }

    public function getFREElectives($conn, $student_num)
    {

        $sql = "SELECT sc.crse_code, sc.crse_grade, sc.term, sc.equivalencia, sc.convalidacion,
        COALESCE(cc.name, gc.name) AS name,
        COALESCE(cc.credits, gc.credits) AS credits
        FROM student_courses AS sc
        LEFT JOIN ccom_courses AS cc ON sc.crse_code = cc.crse_code
        LEFT JOIN general_courses AS gc ON sc.crse_code = gc.crse_code
        WHERE sc.student_num = ? AND sc.type = 'elec_free'";

        $stmt = $conn->prepare($sql);

        // sustituye el ? por el valor de $student_num
        $stmt->bind_param("s", $student_num);

        // ejecuta el statement
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        $studentRecord = [];
        while ($row = $result->fetch_assoc()) {
            $studentRecord[] = $row;
        }
        return $studentRecord;
    }
}
